<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleModel extends CI_Model {

    private $table = 'm_role';

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }
}
