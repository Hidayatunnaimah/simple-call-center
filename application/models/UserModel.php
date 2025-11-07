<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{

    private $table = "m_user";
    public function __construct()
    {  }

    public function get_user($id){

        $query = $this->db->get($this->table)->join("","","left")->get();

        if ($id != null) {
            $query->where("id", $id);
        }
        return $query->result_array();
    }

    public function show(array $data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){ 
        $this->db->where("id", $id);
    }

    public function delete($id){
        $this->db->delete($this->table, array('id' => $id));
    }


}