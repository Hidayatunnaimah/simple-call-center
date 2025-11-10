<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TaskFinalModel extends CI_Model
{

    private $table = 't_transaction_final';

    public function totalTaskAgentToday($user_id)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from($this->table);
        $this->db->join('t_transaction_assigned', 't_transaction_final.transaction_id = t_transaction_assigned.transaction_id', 'left');
        $this->db->where('t_transaction_assigned.user_assigned', $user_id);
        $this->db->where('DATE(t_transaction_assigned.created_at)', date('Y-m-d'));

        $query = $this->db->get();
        return $query->row()->total;
    }
}
