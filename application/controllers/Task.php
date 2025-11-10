<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('TaskModel');
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
		$this->load->view('components/sidebar');
		$this->load->view('task/index');
		$this->load->view('components/footer');
	}

	public function search()
    {
        if($this->input->post('date')) {
            $date = $this->input->post('date');
            $reports = $this->TaskModel->get_reports_by_date($date);
            echo json_encode($reports);
        }
    }

	public function download_template(){
		$file_path = FCPATH . 'assets/template/Template_import_task.csv';

        if (!file_exists($file_path)) {
            show_404();
            return;
        }

        $this->load->helper('download');
        $data = file_get_contents($file_path);
        force_download('template.csv', $data);
	}
}