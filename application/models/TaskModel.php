<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskModel extends CI_Model {

    private $table = 't_transaction'; 
    public function insert_file($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_reports_by_date($date)
    {
        $this->db->where('DATE(created_at)', $date);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
