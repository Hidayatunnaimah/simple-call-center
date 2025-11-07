<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskAssignModel extends CI_Model {

    private $table = 't_transaction_assigned'; 
    public function assign($data) {
        return $this->db->insert($this->table, $data);
    }

}
