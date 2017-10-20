<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Menus';
    }

    public function index() {
        $this->render('dashboard');
    }

}
