<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Call extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once APPPATH . 'third_party/phpagi/src/phpagi-asmanager.php';
    }

    public function index()
    {
        $ai = $this->session->userdata('username');
        $an = $this->session->userdata('real_name');
        $nk = $this->input->post('phone_number');
        $do = 'testing';
        $cn = $this->input->post('customer_name');

        $PassedInfo = 'PassedInfo=' . $ai . '-' . $an . '-' . $nk . '-' . $cn . '-' . $do;

        $ext = $this->session->userdata('number');
        $prefix = '1111';

        $as = new AGI_AsteriskManager();
        $res = $as->connect();
        if (!$res) {
            echo json_encode(array(
                "status" => FALSE,
                "data" => "Cannot Connect to Server",
            ));
        } else {
            $channel = "SIP/" . $ext;
            $exten = $prefix . $nk;
            $context = "agentvisit";
            $priority = 1;
            $application = NULL;
            $data = NULL;
            $timeout = 5000;
            $callerid = $ext . " <" . $ext . ">";
            $variable = $PassedInfo;
            $account = NULL;
            $async = TRUE;
            $actionid = NULL;

            $has = $as->Originate($channel, $exten, $context, $priority, $application, $data, $timeout, $callerid, $variable, $account, $async, $actionid);

            echo json_encode(array("status" => TRUE, "data" => 'Calling Success Please Wait Micro SIP to Show Up..'));

            $as->disconnect();
        }
    }
}
