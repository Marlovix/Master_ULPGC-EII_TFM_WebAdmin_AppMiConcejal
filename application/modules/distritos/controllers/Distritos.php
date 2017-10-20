<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Distritos extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Distritos';
        $this->data['dbTable'] = $this->distrito->getTable();
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/distritos.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "distritos';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a distritos'
        ];
        $this->data['backButton'] = form_button($backButton);
        
        $distrito = null;
        if (!is_null($id)) {
            $distrito = $this->distrito->getDistrito($id);
            if (!$distrito)
                $this->render('templates/no_found_element');
        }

        $this->data['scripts'][] = ['script' => assets_url() . 'js/distrito_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];

        $this->prepareInputs($distrito);
        $this->render(['distrito_form', 'rest/accept_modal']);
    }

    private function prepareInputs($distrito = null) {
        $idAyuntamiento = $this->session->get_userdata()['id_ayuntamiento'];
        $this->data['hidden'] = ['id_ayuntamiento' => $idAyuntamiento];
        $this->data['input_id_distrito'] = $this->distrito->getIdDistritoInput($distrito);
        $this->data['input_distrito'] = $this->distrito->getDistritoInput($distrito);
        $this->data['input_buttons'] = $this->distrito->getButtonsInput($distrito);
    }

}
