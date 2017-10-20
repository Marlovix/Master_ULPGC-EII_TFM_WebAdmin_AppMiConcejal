<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partidos_politicos extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Partidos políticos';
        $this->data['dbTable'] = $this->partido_politico->getTable();
        $this->data['controller'] = strtolower($this->data['titlePage']);
    }

    public function index() {
        $this->use_dataTable_builder();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/partidos_politicos.js'];
        $this->render('templates/list_datatable');
    }

    public function form($id = null) {
        $backButton = [
            'id' => 'back-button',
            'onclick' => "window.location.href = '" . base_url() . "partidos_politicos';",
            'class' => 'btn btn-default pull-right',
            'content' => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Volver a partidos políticos'
        ];
        $this->data['backButton'] = form_button($backButton);
        
        $partido_politico = null;
        if (!is_null($id)) {
            $partido_politico = $this->partido_politico->getPartidoPolitico($id);
            if (!$partido_politico)
                $this->render('templates/no_found_element');
        }
        
        $this->use_bootstrap_colorpicker_builder();
        $this->use_bootstrap_filestyle_builder();

        $this->data['scripts'][] = ['script' => assets_url() . 'js/partido_politico_form.js'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/validator.js'];

        $this->prepareInputs($partido_politico);
        $this->render(['partido_politico_form', 'rest/accept_modal']);
    }

    private function prepareInputs($partido_politico = null) {
        $this->data['input_id_partido_politico'] = $this->partido_politico->getIdPartidoPoliticoInput($partido_politico);
        $this->data['input_partido_politico'] = $this->partido_politico->getPartidoPoliticoInput($partido_politico);
        $this->data['input_acronimo'] = $this->partido_politico->getAcronimoInput($partido_politico);
        $this->data['input_logotipo'] = $this->partido_politico->getLogotipoInput($partido_politico);
        $this->data['input_color'] = $this->partido_politico->getColorInput($partido_politico);
        $this->data['input_buttons'] = $this->partido_politico->getButtonsInput($partido_politico);
    }

}
