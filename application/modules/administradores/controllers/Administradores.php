<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administradores extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Administradores';
        $this->data['dbTable'] = 'users';
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/administradores.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "administradores';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a administradores'
        ];
        $this->data['backButton'] = form_button($backButton);
        
        $user = null;
        if (!is_null($id)) {
            $user = $this->user->find($id);
            if (!$user)
                $this->render('templates/no_found_element');
        }
        $administrador = $this->administrador->getAdministrador($id);

        $this->use_select2_builder();

        $this->data['scripts'][] = ['script' => assets_url() . 'js/administrador_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];
        $this->data['hidden']['id_user'] = $id;

        $this->prepareInputs($administrador);
        $this->render(['administrador_form', 'rest/accept_modal']);
    }

    private function prepareInputs($administrador = null) {
        if(!is_null($administrador)){
            $this->data['hidden']['method_ayuntamiento'] = 'PUT';
        }else{
            $this->data['hidden']['method_ayuntamiento'] = 'POST';
        }
        $this->data['input_id_ayuntamiento'] = $this->administrador->getIDAyuntamientoInput($administrador);
        $this->data['input_buttons'] = $this->administrador->getButtonsInput();
    }

}
