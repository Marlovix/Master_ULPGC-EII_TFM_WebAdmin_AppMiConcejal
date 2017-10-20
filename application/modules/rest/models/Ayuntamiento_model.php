<?php

class Ayuntamiento_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('ayuntamiento', 'id_ayuntamiento');
    }

    public function getAyuntamiento($id) {
        return $this->find($id);
    }

    public function getOptions() {
        $query = $this->db
                ->select('id_ayuntamiento, ayuntamiento')
                ->from($this->getTable());
        $result = $query->get();

        $options = ['' => ''];
        foreach ($result->result_array() as $option) {
            $options[$option['id_ayuntamiento']] = ucfirst($option['ayuntamiento']);
        }
        return $options;
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields($this->getTable());
        $columns = array(
            $fields[0] => 'ID',
            $fields[1] => 'Ayuntamiento',
            $fields[2] => 'Facebook',
            $fields[3] => 'Twitter'
        );
        return $columns;
    }

    public function getDataTables() {
        return $this->get();
    }
    
    public function getIdAyuntamientoInput($ayuntamiento = null) {
        $invisible = '';
        if (is_null($ayuntamiento)) {
            $invisible .= ' invisible-input';
        }

        $index = 0;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($ayuntamiento)) ? '' : $ayuntamiento[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }
    
    public function getAyuntamientoInput($ayuntamiento = null) {
        $index = 1;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($ayuntamiento)) ? '' : $ayuntamiento[$name];

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
    
    public function getFacebookInput($ayuntamiento = null) {
        $index = 2;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($ayuntamiento)) ? '' : $ayuntamiento[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }
    
    public function getTwitterInput($ayuntamiento = null) {
        $index = 3;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($ayuntamiento)) ? '' : $ayuntamiento[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }
    
    public function getButtonsInput($ayuntamiento = null) {
        $buttons = '';
        if (is_null($ayuntamiento)) {
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
                return $value;
        }
    }

}
