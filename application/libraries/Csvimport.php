<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csvimport {

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function get_array($file_path, $delimiter) {
        if (!file_exists($file_path) || !is_readable($file_path)) {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($file_path, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
