<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function file_view() {
        $this->load->view('file_view', array('error' => ' '));
    }

    public function do_upload() {
        $config = array(
            'upload_path' => "assets/uploads/partidos_politicos/logotipos",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('logotipo')) {
            //$newFileName = generateRandomString() . ".pdf";
            $data = array('success' => $this->upload->data());
            echo json_encode($data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        }
    }
}
