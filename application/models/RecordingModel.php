<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecordingModel extends CI_Model
{
    private $asterisk_db;
    private $table = 'tblCallDataRecords_click_to_call';

    public function __construct()
    {
        parent::__construct();
        $this->asterisk_db = $this->load->database('asterisk', TRUE);
    }

    public function getDataRecording()
    {
        $this->asterisk_db->select('calldate, src, duration, billsec, disposition, userfield, dst');
        $this->asterisk_db->from($this->table);
        $this->asterisk_db->order_by('calldate', 'DESC');
        $this->asterisk_db->limit(20);

        if ($this->session->userdata('is_admin') == 0){
            $this->asterisk_db->where('src', $this->session->userdata('number'));
        }

        $query = $this->asterisk_db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->getDataRecording();
        return $this->asterisk_db->count_all_results();
    }

    public function count_all()
    {
        return $this->asterisk_db->count_all($this->table);
    }
}
