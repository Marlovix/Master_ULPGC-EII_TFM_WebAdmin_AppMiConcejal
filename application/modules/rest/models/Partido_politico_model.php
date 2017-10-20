<?php

class Partido_politico_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('partido_politico', 'id_partido_politico');
    }

    public function getPartidoPolitico($id) {
        return $this->find($id);
    }

    public function getOptions() {
        $query = $this->db
                ->select('id_partido_politico, partido_politico')
                ->from($this->getTable());
        $result = $query->get();

        $options = ['' => ''];
        foreach ($result->result_array() as $option) {
            $options[$option['id_partido_politico']] = ucfirst($option['partido_politico']);
        }
        return $options;
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields($this->getTable());
        $columns = array(
            $fields[0] => 'ID',
            $fields[1] => 'Partido Político',
            $fields[2] => 'Acrónimo',
            $fields[3] => 'Logotipo',
            $fields[4] => 'Color'
        );
        return $columns;
    }

    public function getDataTables() {
        return $this->get();
    }

    public function getIdPartidoPoliticoInput($partido_politico = null) {
        $invisible = '';
        if (is_null($partido_politico)) {
            $invisible .= ' invisible-input';
        }

        $index = 0;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($partido_politico)) ? '' : $partido_politico[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getPartidoPoliticoInput($partido_politico = null) {
        $index = 1;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($partido_politico)) ? '' : $partido_politico[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Escriba el nombre del ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getAcronimoInput($partido_politico = null) {
        $index = 2;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($partido_politico)) ? '' : $partido_politico[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getLogotipoInput($partido_politico = null) {
        $index = 3;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($partido_politico)) ? '' : $partido_politico[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'type' => 'file',
            'name' => $name,
            'class' => 'form-control',
            'accept' => 'image/*',
            'url_image' => $value
        ));
        return $input;
    }

    public function getColorInput($partido_politico = null) {
        $index = 4;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($partido_politico)) ? '' : $partido_politico[$name];

        $input = form_label($columns[$name], $name);
        $input .= '<div id="' . $name . '" class="input-group colorpicker-component">';
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        $input .= '<span class="input-group-addon"><i></i></span></div>';
        return $input;
    }

    public function getButtonsInput($partido_politico = null) {
        $buttons = '';
        if (is_null($partido_politico)) {
            $buttons = form_submit('submit', 'Guardar', array(
                'class' => 'btn btn-success form-control'));
        } else {
            $buttons = form_button('delete', 'Borrar', array(
                'class' => 'btn btn-danger pull-left'));
            $buttons .= form_submit('submit', 'Guardar', array(
                'class' => 'btn btn-success pull-right'));
        }
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
                if ($value == '')
                    return null;
                else
                    return $value;
        }
    }

}
