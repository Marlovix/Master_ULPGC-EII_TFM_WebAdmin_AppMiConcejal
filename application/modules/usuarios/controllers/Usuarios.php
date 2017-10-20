<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Usuarios';
        $this->data['dbTable'] = $this->user->getTable();
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/users.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "usuarios';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a usuarios'
        ];
        $this->data['backButton'] = form_button($backButton);
        
        $user = null;
        if (!is_null($id)) {
            $user = $this->user->getUser($id);
            if (!$user)
                $this->render('templates/no_found_element');
        }

        $this->use_select2_builder();

        $this->data['scripts'][] = ['script' => assets_url() . 'js/user_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];

        $this->prepareInputs($user);
        $this->render(['user_form', 'rest/accept_modal']);
    }

    private function prepareInputs($user = null) {
        $this->data['hidden'] = [];
        if (is_null($user)) {
            $this->data['hidden'] = ['created_on' => ''];
            $this->data['hidden'] = ['last_login' => ''];
        }
        $this->data['input_id_administracion'] = $this->user->getIdUserInput($user);
        $this->data['input_nombre'] = $this->user->getNombreInput($user);
        $this->data['input_apellidos'] = $this->user->getApellidosInput($user);
        $this->data['input_email'] = $this->user->getEmailInput($user);
        $this->data['input_telefono'] = $this->user->getTelefonoInput($user);
        $this->data['input_perfil'] = $this->user->getPerfilInput($user);
        $this->data['input_creacion'] = $this->user->getCreacionInput($user);
        $this->data['input_ultimo_acceso'] = $this->user->getUltimoAccesoInput($user);
        $this->data['input_password'] = $this->user->getPasswordInput($user);
        $this->data['input_repeat_password'] = $this->user->getRepeatPasswordInput($user);
        $this->data['input_state'] = $this->user->getStateInput($user);
        $this->data['input_buttons'] = $this->user->getButtonsInput($user);
    }

}
