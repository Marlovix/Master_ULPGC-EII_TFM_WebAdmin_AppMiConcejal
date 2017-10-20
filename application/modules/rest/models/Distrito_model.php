<?php

class Distrito_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('distrito', 'id_distrito');
    }

    public function getDistrito($id) {
        return $this->getDataTables($id);
    }

    public function getOptions() {
        $idAyuntamiento = $this->session->get_userdata()['id_ayuntamiento'];
        $query = $this->db
                ->select('id_distrito, distrito')
                ->from($this->getTable())
                ->where('id_ayuntamiento', $idAyuntamiento);
        $result = $query->get();

        $options = ['' => ''];
        foreach ($result->result_array() as $option) {
            $options[$option['id_distrito']] = ucfirst($option['distrito']);
        }
        return $options;
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields();
        $fields_ayuntamiento = $this->getFields('ayuntamiento');
        $columns = array(
            $fields[0] => 'ID',
            $fields[1] => 'Distrito',
            $fields_ayuntamiento[0] => 'ID Ayuntamiento',
            $fields_ayuntamiento[1] => 'Ayuntamiento'
        );
        return $columns;
    }

    public function getDataTables($id = null) {
        $distritos = [];
        $idAyuntamiento = $this->session->get_userdata()['id_ayuntamiento'];
        $ayuntamiento = $this->session->get_userdata()['ayuntamiento'];
        $fields = array_keys($this->getDataTablesColumns());
        $select = $this->getSelectDataTables($fields);
        $query = $this->db
                ->select($select)
                ->from($this->getTable())
                ->join('ayuntamiento', 'id_ayuntamiento')
                ->where('id_ayuntamiento', $idAyuntamiento);
        if (!is_null($id)) {
            return $query->where($this->getPrimaryKey(), $id)->get()->row_array();
        } else {
            foreach ($query->get()->result_array() as $distrito) {
                $distrito['ayuntamiento'] = $ayuntamiento;
                $distritos[] = $distrito;
            }
            return $distritos;
        }
    }

    public function getIdDistritoInput($distrito = null) {
        $invisible = '';
        if (is_null($distrito)) {
            $invisible .= ' invisible-input';
        }

        $index = 0;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($distrito)) ? '' : $distrito[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getDistritoInput($distrito = null) {
        $index = 1;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($distrito)) ? '' : $distrito[$name];

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

    public function getButtonsInput($distrito = null) {
        $buttons = '';
        if (is_null($distrito)) {
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
