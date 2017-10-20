<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Concejales extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Concejales';
        $this->data['dbTable'] = $this->concejal->getTable();
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/concejales.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "concejales';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a concejales'
        ];
        $this->data['backButton'] = form_button($backButton);

        $concejal = null;
        if (!is_null($id)) {
            $concejal = $this->concejal->getConcejal($id);
            if (!$concejal)
                $this->render('templates/no_found_element');
        }

        $this->use_select2_builder();

        $this->data['scripts'][] = ['script' => assets_url() . 'js/concejal_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];

        $this->prepareInputs($concejal);
        $this->render(['concejal_form', 'rest/accept_modal']);
    }

    private function prepareInputs($concejal = null) {
        $this->data['hidden'] = [];
        if (is_null($concejal)) {
            $this->data['hidden'] = ['created_on' => ''];
            $this->data['hidden'] = ['last_login' => ''];
            $this->data['hidden'] = ['id_user' => ''];
        } else {
            $this->data['hidden'] = ['id_user' => $concejal['id_user']];
        }
        $this->data['hidden'] = ['id_ayuntamiento' => $concejal['id_ayuntamiento']];
        $this->data['input_id_administracion'] = $this->concejal->getIdConcejalInput($concejal);
        $this->data['input_nombre'] = $this->concejal->getNombreInput($concejal);
        $this->data['input_apellidos'] = $this->concejal->getApellidosInput($concejal);
        $this->data['input_email'] = $this->concejal->getEmailInput($concejal);
        $this->data['input_telefono'] = $this->concejal->getTelefonoInput($concejal);
        $this->data['input_distrito'] = $this->concejal->getDistritoInput($concejal);
        $this->data['input_vocal'] = $this->concejal->getVocalInput($concejal);
        $this->data['input_cargo'] = $this->concejal->getCargoInput($concejal);
        $this->data['input_partido_politico'] = $this->concejal->getPartidoPoliticoInput($concejal);
        $this->data['input_creacion'] = $this->concejal->getCreacionInput($concejal);
        $this->data['input_password'] = $this->concejal->getPasswordInput($concejal);
        $this->data['input_repeat_password'] = $this->concejal->getRepeatPasswordInput($concejal);
        $this->data['input_state'] = $this->concejal->getStateInput($concejal);
        $this->data['input_buttons'] = $this->concejal->getButtonsInput($concejal);
    }

}
