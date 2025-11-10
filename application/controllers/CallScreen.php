<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CallScreen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ResultModel');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id'); 
        $data['report'] = $this->ResultModel->get_user_pending_report($user_id);

        if (!$data['report']) {
            $next_report = $this->ResultModel->get_unassigned_report();

            if ($next_report) {
                $this->ResultModel->assign_report($next_report->id, $user_id);
                redirect('CallScreen');
            } else {
                $this->load->view('components/sidebar');
                $this->load->view('call_screen/no_call');
                $this->load->view('components/footer');
                return;
            }
        }

        $this->load->view('components/sidebar');
        $this->load->view('call_screen/index', $data);
        $this->load->view('components/footer');
    }

    public function submit_result() {
        $transaction_id = $this->input->post('transaction_id');
        $result         = $this->input->post('result');
        $note          = $this->input->post('note');

        $update = $this->ResultModel->closed_transaction($transaction_id, $result, $note);

        echo json_encode(['status' => $update ? 'success' : 'failed']);
    }
}
