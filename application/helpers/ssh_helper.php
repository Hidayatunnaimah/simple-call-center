<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('check_ssh')) {
    function check_ssh()
    {
        $conn = ssh2_connect('10.10.8.38', 22);
        $auth = ssh2_auth_password($conn, 'root', 'mGurvDsy');

        if (!$conn) {
            echo json_encode(["status" => FALSE, "data" => "Can't connect to asterisk server"]);
            return;
        }

        if (!$auth) {
            echo json_encode(["status" => FALSE, "data" => 'Wrong Password for connect to server']);
            return;
        }

        return $conn;
    }
}

if (!function_exists('check_ftp')) {
    function ftp_conn($ssh, $filename, $mode = FTP_BINARY)
    {
        $sftp   = ssh2_sftp($ssh);

        if (!$sftp) {
            echo json_encode(["status" => FALSE, "data" => "Can't connect to FTP server."]);
            return;
        }

        $remote_file = "ssh2.sftp://$sftp" . $filename;

        if (!file_exists($remote_file)) {
            echo json_encode(["status" => FALSE, "data" => 'File Not Found']);
            return;
        }

        return $remote_file;
    }
}
