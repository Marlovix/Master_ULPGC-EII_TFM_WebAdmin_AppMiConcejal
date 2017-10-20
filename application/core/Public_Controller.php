<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->use_jquery();
        $this->use_bootstrap();
        $this->use_metisMenu();
        $this->use_sbAdmin_template();
    }

    protected function render($view = NULL, $template = 'templates/public_master') {
        $this->data['header'] = $this->parser->parse('templates/_parts/header', $this->data, TRUE);
        $this->data['navigation'] = $this->parser->parse('templates/_parts/navigation', $this->data, TRUE);
        $this->data['sidebar'] = $this->parser->parse('templates/_parts/sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->parser->parse('templates/_parts/public_footer', $this->data, TRUE);
        parent::render($view, $template);
    }

}
