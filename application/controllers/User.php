<?
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

    protected $a = 1;
    public function index()
    {
        var_dump($this->a);
        // $this->load->view('components/sidebar');
        // $this->load->view('user/index');
        // $this->load->view('components/footer');
    }
}