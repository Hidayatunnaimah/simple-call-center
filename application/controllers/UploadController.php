<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TaskModel');
        check_auth();
    }

    public function read_csv() {
        if (!isset($_FILES['file']['name'])) {
            echo json_encode(['status' => 'error', 'message' => 'No choosen File uploaded']);
            return;
        }

        $file = $_FILES['file'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (strtolower($ext) !== 'csv') {
            echo json_encode(['status' => 'error', 'message' => 'File type must be a CSV']);
            return;
        }

        $upload_path = FCPATH . 'uploads/temp/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0777, true);
        $file_path = $upload_path . time() . '_' . $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal upload file']);
            return;
        }

        $rows = $this->parse_csv($file_path);
        if (empty($rows)) {
            echo json_encode(['status' => 'error', 'message' => 'CSV kosong atau tidak valid']);
            return;
        }

        foreach ($rows as $x) {
            $data = [
            'report_code' => $x['report_code'],
            'customer_name' => $x['customer_name'],
            'address' => $x['address'],
            'phone_1' => $x['phone_1'],
            'phone_2' => $x['phone_2'],
            'emergency_contact' => $x['emergency_contact'],
            'emergency_contact_number' => $x['emergency_contact_number'],
            'bill' => $x['bill'],
            'desc' => $x['desc'],

            ];

            $this->TaskModel->insert_file($data);
        }

        echo json_encode(['status' => 'success', 'message' => 'CSV dibaca']);
        exit;
    }

    private function parse_csv($file_path) {
        $rows = [];
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $rows[] = array_combine($headers, $data);
            }
            fclose($handle);
        }
        return $rows;
    }
}
