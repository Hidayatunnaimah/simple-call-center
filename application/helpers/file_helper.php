<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('recording_file')) {

    function recording_file($file)
    {
        $files = str_replace('\\', '', explode('/', $file));
        $mp3_name = '/var/spool/asterisk/monitor/player/' . $files[3] . ".mp3";
        $replaced = '/var/spool/asterisk/monitor/' . $file . ".gsm";
        $data = [
            "base_filename" => $files[3] . ".mp3",
            "source" => str_replace(['\\', ':'], '', $replaced),
            "destination" => str_replace(['\\', ':'], '', $mp3_name),
        ];

        return $data;
    }
}
