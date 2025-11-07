<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ResultModel', 'report');
    }

    public function index() {
		$this->load->view('components/sidebar');
        $this->load->view('result/index');
		$this->load->view('components/footer');
    }

    public function get_data() {

        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
        $result     = $this->input->post('result');
        $status     = $this->input->post('status');

		// var_dump($result);


        $list = $this->report->get_datatables($start_date, $end_date, $result, $status);
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $r) {
            $no++;
            $data[] = [
                'no' => $no,
                'report_code' => $r->report_code,
                'customer_name' => $r->customer_name,
                'address' => $r->address,
                'phone1' => $r->phone_1,
                'phone2' => $r->phone_2,
                'real_name' => $r->real_name,
                'result' => $r->result,
                'bill' => $r->bill,
                'note' => $r->note
            ];
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $this->report->count_all(),
            "recordsFiltered" => $this->report->count_filtered($start_date, $end_date, $result, $status),
            "data" => $data
        ];
        echo json_encode($output);
    }
}
