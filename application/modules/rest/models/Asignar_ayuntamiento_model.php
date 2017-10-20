<?php

class Asignar_ayuntamiento_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('administrador', 'id_user');
    }

    public function getAsignarAyuntamientoInput($ayuntamiento_asignado) {
        $options = $this->ayuntamiento->getOptions();
        $selected = ($ayuntamiento_asignado) ? $ayuntamiento_asignado['id_ayuntamiento'] : null;

        $input = form_label('Asignar ayuntamiento', 'id_ayuntamiento');
        $input .= form_dropdown('id_ayuntamiento', $options, $selected, array(
            'class' => 'form-control select2',
            'required' => true
        ));
        return $input;
    }

    public function getButtonsInput() {
        $buttons = form_button('submit', 'Guardar', array(
            'class' => 'btn btn-success form-control'));
        return $buttons;
    }

    // Abstract method //
    public function formatDataToShow($field) {
        return $field;
    }

    // Abstract method //
    public function formatDataToDB($value, $field) {
        switch ($field) {
            default:
                return $value;
        }
    }

}
