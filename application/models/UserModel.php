<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $table = 'm_user';

    public function getAll()
    {
        $this->db->select('m_user.*, m_role.role_name');
        $this->db->from($this->table);
        $this->db->join('m_role', 'm_role.id = m_user.role_id', 'left');
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select('m_user.*, m_role.role_name');
        $this->db->from($this->table);
        $this->db->join('m_role', 'm_role.id = m_user.role_id', 'left');
        $this->db->where('m_user.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
