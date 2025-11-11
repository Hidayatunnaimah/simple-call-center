<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        check_auth();
        $this->load->model('UserModel', 'user');
        $this->load->model('RoleModel', 'role');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $data['users'] = $this->user->getAll();
        $data['roles'] = $this->role->getAll();
        $this->load->view('components/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('components/footer');
    }

    public function create()
    {
        $data = [
            'real_name' => $this->input->post('real_name'),
            'username'  => $this->input->post('username'),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'number'    => $this->input->post('number'),
            'role_id'   => $this->input->post('role_id'),
            'is_admin'  => $this->input->post('is_admin') ? 1 : 0,
            'is_active' => 1
        ];

        $this->user->insert($data);
        $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
        redirect('user');
    }

    public function edit($id)
    {
        $data = $this->user->getById($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $update = [
            'real_name' => $this->input->post('real_name'),
            'username'  => $this->input->post('username'),
            'number'    => $this->input->post('number'),
            'role_id'   => $this->input->post('role_id'),
            'is_admin'  => $this->input->post('is_admin') ? 1 : 0,
        ];

        if ($this->input->post('password')) {
            $update['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->user->update($id, $update);
        $this->session->set_flashdata('success', 'User berhasil diupdate!');
        redirect('user');
    }

    public function delete($id)
    {
        $this->user->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('user');
    }
}
