<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel', 'auth');
        $this->load->library('session');
        $this->load->helper(array('cookie', 'url', 'form'));
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('is_admin'));
        } else {
            $this->load->view('login');
        }
    }

    public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->auth->get_user_by_username($username);

        if (!$user || !password_verify($password, $user->password)) {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth');
        }

        $token = bin2hex(random_bytes(32));

        $this->auth->update_user_token($user->id, $token);

        set_cookie('login_token', $token, 8 * 60 * 60);

        $session_data = array(
            'user_id'   => $user->id,
            'username'  => $user->username,
            'real_name' => $user->real_name,
            'number'    => $user->number,
            'role_id'   => $user->role_id,
            'is_admin'  => $user->is_admin,
            'logged_in' => TRUE,
            'login_time' => time()
        );

        $this->session->set_userdata($session_data);

        $this->_redirect_by_role($user->is_admin);
    }

    public function logout()
    {
        $token = get_cookie('login_token');
        if ($token) {
            $this->auth->clear_token($token);
            delete_cookie('login_token');
        }

        $this->session->sess_destroy();
        redirect('auth');
    }

    private function _check_session_timeout()
    {
        $login_time = $this->session->userdata('login_time');
        if ($login_time && (time() - $login_time) > (8 * 60 * 60)) {
            $this->logout();
            exit;
        }
    }

    private function _redirect_by_role($is_admin)
    {
        if ($is_admin == 1) {
            redirect('dashboard/admin');
        } elseif ($is_admin == 0) {
            redirect('dashboard/agent');
        } else {
            redirect('auth');
        }
    }

    public function hash_tool()
    {
        $password = 12345;
        $hash = password_hash($password, PASSWORD_DEFAULT);
         echo "Hash untuk '{$password}' adalah:<br>{$hash}";
    }
}
