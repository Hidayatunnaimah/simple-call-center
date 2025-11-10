<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    private $table = 'm_user';

    public function get_user_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row();
    }

    public function update_user_token($user_id, $token) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->table, ['token' => $token]);
    }

    public function clear_token($token) {
        $this->db->where('token', $token);
        return $this->db->update($this->table, ['token' => NULL]);
    }

    public function get_user_by_token($token) {
        return $this->db->get_where($this->table, ['token' => $token])->row();
    }
}
