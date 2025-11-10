<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResultModel extends CI_Model
{

    private $table = 'v_report_result';
    private $column_order = ['report_code', 'customer_name', 'address', 'phone1', 'phone2', 'real_name', 'result', 'bill', 'note'];
    private $column_search = ['report_code', 'customer_name', 'address', 'phone_1', 'phone_2', 'result'];
    private $order = ['created_at' => 'DESC'];

    private function _get_datatables_query($start_date, $end_date, $result, $status)
    {
        $this->db->from($this->table);

        // Filter tanggal
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('DATE(created_at) >=', $start_date);
            $this->db->where('DATE(created_at) <=', $end_date);
        }

        // Filter result
        if (!empty($result) && $result != '0') {
            $this->db->where('result', $result);
        }

        // Filter status
        if (!empty($status)) {
            if ($status == '1') {
                $this->db->where('status', 'Final');
            } elseif ($status == '2') {
                $this->db->where_in('status', ['Waiting', 'On Progress']);
            }
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    public function get_datatables($start_date, $end_date, $result, $status)
    {
        $this->_get_datatables_query($start_date, $end_date, $result, $status);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        return $this->db->get()->result();
    }

    public function count_filtered($start_date, $end_date, $result, $status)
    {
        $this->_get_datatables_query($start_date, $end_date, $result, $status);
        return $this->db->count_all_results();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_user_pending_report($user_id)
    {
        $this->db->where('user_assigned', $user_id);
        $this->db->where('result IS NULL', null, false);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_unassigned_report()
    {
        $this->db->where('user_assigned IS NULL', null, false);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table, 1);
        return $query->row();
    }

    public function assign_report($id_transaction, $user_id)
    {
        $data = [
            'transaction_id' => $id_transaction,
            'user_assigned'  => $user_id,
        ];
        return $this->db->insert('t_transaction_assigned', $data);
    }

    public function closed_transaction($transaction_id, $result, $notes)
    {
        return $this->db->insert('t_transaction_final', [
            'transaction_id' =>  $transaction_id,
            'result'        => $result,
            'note'          => $notes,
            'updated_at'    => date('Y-m-d H:i:s')
        ]);
    }

    public function agentByCategoryResult($user_id)
    {
        $this->db->select('result, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('user_assigned', $user_id);
        $this->db->where('DATE(assign_created)', date('Y-m-d'));
        $this->db->group_by('result');

        $query = $this->db->get();
        $data = $query->result_array();

        $mapping = [
            1 => 'PAID',
            2 => 'PTP',
            3 => 'MSG',
            4 => 'NOAN',
            5 => 'BPH'
        ];

        $resultData = [];
        foreach ($mapping as $num => $label) {
            $found = array_filter($data, function ($row) use ($num) {
                return $row['result'] == $num;
            });
            $resultData[] = [
                'result_label' => $label,
                'total' => $found ? array_values($found)[0]['total'] : 0
            ];
        }

        return $resultData;
    }
}
