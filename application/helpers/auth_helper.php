<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_auth')) {
    function check_auth() {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('cookie');
        $CI->load->model('AuthModel', 'auth');

        if ($CI->session->userdata('logged_in')) {
            $login_time = $CI->session->userdata('login_time');
            if ($login_time && (time() - $login_time) > (8 * 60 * 60)) {
                $token = get_cookie('login_token');
                if ($token) {
                    $CI->auth->clear_token($token);
                    delete_cookie('login_token');
                }
                $CI->session->sess_destroy();
                redirect('auth');
            }
            return TRUE;
        }

        $token = get_cookie('login_token');
        if ($token) {
            $user = $CI->auth->get_user_by_token($token);
            if ($user) {
                $session_data = array(
                    'user_id'   => $user->id,
                    'username'  => $user->username,
                    'real_name' => $user->real_name,
                    'number'    => $user->number,
                    'role_id'   => $user->role_id,
                    'logged_in' => TRUE,
                    'login_time'=> time()
                );
                $CI->session->set_userdata($session_data);
                return TRUE;
            }
        }
        
        redirect('auth');
    }
}
