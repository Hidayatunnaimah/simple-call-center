<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_auth();
        $this->load->model('RecordingModel', 'audio');
    }

    public function index()
    {
        $this->load->view('components/sidebar');
        $this->load->view('result/recording');
        $this->load->view('components/footer');
    }

    public function get_recording_data()
    {
        $data = $this->audio->getDataRecording();

        $result = [];
        $no = 0;
        foreach ($data as $r) {
            $no++;
            $result[] = [
                'no' => $no,
                'calldate' => $r->calldate,
                'src' => $r->src,
                'duration' => $r->duration,
                'billsec' => $r->billsec,
                'disposition' => $r->disposition,
                'dst' => $r->dst,
                'userfield' => $r->userfield,
                'action' => `<a clas="btn btn-success">Dengarkan</a> <a clas="btn btn-danger">Download</a>`
            ];
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $this->audio->count_all(),
            "recordsFiltered" => 20,
            "data" => $result
        ];

        echo json_encode($output);
    }

    public function convert_to_mp3()
    {
        $name   = $this->input->post('source');
        $files  = recording_file($name);
        $exist  = file_exists($files['destination']);

        if (!$exist) {
            $ssh = check_ssh();
            if ($ssh) {
                // echo "Connected!";
                $stream = ssh2_exec($ssh, "/usr/local/bin/sox -t gsm " . $files['source'] . " " . $files['destination'] . "");
                echo json_encode(array("status" => TRUE, "data" => $files['destination']));
            }
        } else {
            echo json_encode(["status" => TRUE, "data" => $files['base_filename']]);
        }
    }

    public function play()
    {
        $filename = $_GET['filename'];

        if (!isset($filename)) {
            echo json_encode(["status" => FALSE, "data" => 'No file requested found']);
            return;
        }

        $ssh    = check_ssh();
        $sftp   = ftp_conn($ssh, $filename);
        
        header('Content-Type: audio/mpeg');
        header('Content-Disposition: inline; filename="' . basename($filename) . '"');

        $remote_handle = fopen($sftp, 'r');
        if ($remote_handle === false) {
            echo json_encode(["status" => FALSE, "data" => 'Failed to read remote file']);
            return;
        }

        while (!feof($remote_handle)) {
            echo fread($remote_handle, 8192);
            flush();
        }

        fclose($remote_handle);
        exit;
    }

    public function download_file()
    {
        $name = $this->input->post('source');
        $files = recording_file($name);

        if (!$name) {
            echo json_encode(["status" => FALSE, "data" => 'Nama file tidak diberikan']);
            return;
        }

        $connection = check_ssh();
        $sftp       = ftp_conn($connection, $files['destination']);
        

        if (!file_exists($sftp)) {
            echo json_encode(["status" => FALSE, "data" => 'File tidak ditemukan di server']);
            return;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $files['base_filename'] . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($sftp));

        $handle = fopen($sftp, 'r');
        if ($handle === false) {
            echo json_encode(["status" => FALSE, "data" => 'Gagal membuka file']);
            return;
        }

        while (!feof($handle)) {
            echo fread($handle, 8192);
            flush();
        }

        fclose($handle);
        exit;
    }
}
