<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Asignar_perfil_rest extends API_REST {

    public function __construct() {
        parent::__construct($this->asignar_perfil);
    }

}