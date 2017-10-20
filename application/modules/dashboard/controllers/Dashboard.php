<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
        if (!array_key_exists("ayuntamiento", $this->session->get_userdata())) {
            $this->data['titlePage'] = 'Bienvenido a la administración de AppMiConcejal';
        } else {
            $ayuntamiento = $this->session->get_userdata()['ayuntamiento'];
            $this->data['titlePage'] = 'Bienvenido a la administración del <b>' . $ayuntamiento . '</b>';
        }
    }

    public function index() {
        $this->render('dashboard');
    }

}
