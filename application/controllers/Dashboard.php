<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TaskFinalModel', 'final');
		$this->load->model('ResultModel', 'result');
		check_auth();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function index()
	{
		if ($this->session->userdata('is_admin') == 1) {
			return $this->admin();
		} else if ($this->session->userdata('is_admin') == 0) {
			return $this->agent();
		}
	}
	public function admin()
	{
		$this->load->view('components/sidebar');
		$this->load->view('dashboard/admin');
		$this->load->view('components/footer');
	}

	public function agent()
	{
		$user_id = $this->session->userdata('user_id');
		$data['total_task_today'] = $this->final->totalTaskAgentToday($user_id);
		$data['agent_result'] = $this->result->agentByCategoryResult($user_id);

		$this->load->view('components/sidebar');
		$this->load->view('dashboard/agent', $data);
		$this->load->view('components/footer');
	}
}
