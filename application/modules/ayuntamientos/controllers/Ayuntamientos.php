<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ayuntamientos extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Ayuntamientos';
        $this->data['dbTable'] = $this->ayuntamiento->getTable();
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/ayuntamientos.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "ayuntamientos';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a ayuntamientos'
        ];
        $this->data['backButton'] = form_button($backButton);
        
        $ayuntamiento = null;
        if (!is_null($id)) {
            $ayuntamiento = $this->ayuntamiento->getAyuntamiento($id);
            if (!$ayuntamiento)
                $this->render('templates/no_found_element');
        }

        $this->data['scripts'][] = ['script' => assets_url() . 'js/ayuntamiento_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];

        $this->prepareInputs($ayuntamiento);
        $this->render(['ayuntamiento_form', 'rest/accept_modal']);
    }

    private function prepareInputs($ayuntamiento = null) {
        $this->data['input_id_ayuntamiento'] = $this->ayuntamiento->getIdAyuntamientoInput($ayuntamiento);
        $this->data['input_ayuntamiento'] = $this->ayuntamiento->getAyuntamientoInput($ayuntamiento);
        $this->data['input_facebook'] = $this->ayuntamiento->getFacebookInput($ayuntamiento);
        $this->data['input_twitter'] = $this->ayuntamiento->getTwitterInput($ayuntamiento);
        $this->data['input_buttons'] = $this->ayuntamiento->getButtonsInput($ayuntamiento);
    }

}
