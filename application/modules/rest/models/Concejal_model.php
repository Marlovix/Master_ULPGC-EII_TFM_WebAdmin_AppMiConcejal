<?php

class Concejal_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('concejal', 'id_concejal');
    }

    public function getConcejal($id) {
        return $this->getDataTables($id);
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields();
        $fields_user = $this->getFields('users');
        $distrito_fields = $this->getFields('distrito');
        $partido_politico_fields = $this->getFields('partido_politico');
        $ayuntamiento_fields = $this->getFields('ayuntamiento');
        $columns = array(
            $fields[0] => 'ID',
            $fields[1] => 'ID Usuario',
            $fields_user[13] => 'Nombre',
            $fields_user[14] => 'Apellidos',
            $fields_user[5] => 'Email',
            $fields_user[16] => 'Teléfono',
            $ayuntamiento_fields[0] => 'ID Ayuntamiento',
            $distrito_fields[0] => 'ID Distrito',
            $distrito_fields[1] => 'Distrito',
            $fields[2] => 'Vocal',
            $fields[3] => 'Cargo',
            $partido_politico_fields[0] => 'ID Partido Político',
            $partido_politico_fields[1] => 'Partido Político',
            $fields_user[10] => 'Creación',
            $fields_user[3] => 'Contraseña',
            'state' => 'Estado'
        );
        return $columns;
    }

    public function getDataTables($id = null) {
        $idAyuntamiento = $this->session->get_userdata()['id_ayuntamiento'];
        $fields = array_keys($this->getDataTablesColumns());
        $select = $this->getSelectDataTables($fields);
        $query = $this->db
                ->select($select)
                ->from($this->getTable())
                ->join('users', 'concejal.id_user = users.id')
                ->join('distrito', 'id_distrito', 'left')
                ->join('partido_politico', 'id_partido_politico')
                ->where($this->getTable() . '.id_ayuntamiento', $idAyuntamiento);
        if (!is_null($id)) {
            $query = $query->where($this->getTable() . '.' . $this->getPrimaryKey(), $id);
            $result = $query->get();
            return $result->row_array();
        }
        $result = $query->get();
        return $result->result_array();
    }

    public function getIdConcejalInput($concejal = null) {
        $index = 0;
        $invisible = '';
        if (is_null($concejal)) {
            $invisible .= ' invisible-input';
        }

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($concejal)) ? '' : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getNombreInput($concejal = null) {
        $index = 2;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($concejal)) ? '' : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getApellidosInput($concejal = null) {
        $index = 3;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($concejal)) ? '' : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getEmailInput($concejal = null) {
        $index = 4;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($concejal)) ? '' : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'type' => 'email',
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'required' => true,
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getTelefonoInput($concejal = null) {
        $index = 5;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($concejal)) ? '' : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getDistritoInput($concejal = null) {
        $index = 8;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $options = $this->distrito->getOptions('id_distrito', 'distrito');
        $selected = is_null($concejal[$fields[$index - 1]]) ? null : $concejal[$fields[$index - 1]];

        $input = form_label($columns[$name], $fields[$index - 1]);
        $input .= form_dropdown($fields[$index - 1], $options, $selected, array(
            'class' => 'form-control'
        ));
        return $input;
    }

    public function getVocalInput($concejal = null) {
        $index = 9;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $options = ['' => '', 1 => 'Sí', 0 => 'No'];
        $selected = is_null($concejal[$name]) ? null : $concejal[$name];
        $properties = array(
            'class' => 'form-control'
        );

        if (is_null($concejal)) {
            $properties['disabled'] = true;
        } else if ($concejal['id_distrito'] == null) {
            $properties['disabled'] = true;
        }

        $input = form_label($columns[$name], $name);
        $input .= form_dropdown($name, $options, $selected, $properties);
        return $input;
    }

    public function getPartidoPoliticoInput($concejal = null) {
        $index = 12;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $options = $this->partido_politico->getOptions();
        $selected = is_null($concejal[$fields[$index - 1]]) ? null : $concejal[$fields[$index - 1]];

        $input = form_label($columns[$name], $fields[$index - 1]);
        $input .= form_dropdown($fields[$index - 1], $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));
        return $input;
    }

    public function getCargoInput($concejal = null) {
        $index = 10;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $options = ['' => '', 'GOBIERNO' => 'GOBIERNO', 'OPOSICIÓN' => 'OPOSICIÓN'];
        $selected = is_null($concejal[$name]) ? null : $concejal[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_dropdown($name, $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));
        return $input;
    }

    public function getCreacionInput($concejal = null) {
        $invisible = '';
        $index = 13;
        if (is_null($concejal)) {
            $invisible .= ' invisible-input';
        }

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $value = (is_null($concejal)) ? '' : $concejal[$fields[$index]];

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_input(array(
            'name' => $fields[$index],
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getPasswordInput($concejal = null) {
        $invisible = '';
        $index = 14;

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $value = (is_null($concejal)) ? '' : $concejal[$fields[$index]];

        if (!is_null($concejal)) {
            $invisible .= ' invisible-input';
            $value = ''; // Hide the password when the user is edited //
        }

        $properties = [
            'type' => 'password',
            'name' => $fields[$index],
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'placeholder' => 'Escriba una contraseña'];

        if (is_null($concejal)) {
            $properties['required'] = true;
        }

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_input($properties);

        return $input;
    }

    public function getRepeatPasswordInput($concejal = null) {
        $invisible = '';
        if (!is_null($concejal)) {
            $invisible .= ' invisible-input';
        }

        $properties = [
            'type' => 'password',
            'name' => 'repeat_password',
            'class' => 'form-control' . $invisible,
            'placeholder' => 'Repita la contraseña'];

        if (is_null($concejal)) {
            $properties['required'] = true;
        }

        $input = form_label('Confirmación', 'repeat_password');
        $input .= form_input($properties);
        return $input;
    }

    public function getStateInput($concejal = null) {
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $options = ['' => '', 1 => 'Activo', 0 => 'Inactivo'];
        $selected = (is_null($concejal)) ? 1 : $concejal['state'];
        $index = 15;

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_dropdown($fields[$index], $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));

        return $input;
    }

    public function getButtonsInput($concejal = null) {
        $buttons = '';
        if (is_null($concejal)) {
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
        switch ($field) {
            case 'id':
                return 'users.' . $field;
            case 'created_on':
                return "FROM_UNIXTIME(" . $field . ", '%d/%m/%Y') AS " . $field;
            case 'repeat_password':
                return '';
            case 'id_ayuntamiento':
                return 'concejal.id_ayuntamiento AS id_ayuntamiento';
            case 'id_group':
                return 'groups.id AS id_group';
            case 'state':
                return 'active AS state';
            default:
                return $field;
        }
    }

    // Abstract method //
    public function formatDataToDB($value, $field) {
        switch ($field) {
            case 'password':
                return $this->bcrypt->hash($value);
            case 'created_on':
                return time();
            case 'id_distrito':
                if ($value == '') {
                    return NULL;
                } else {
                    return $value;
                }
            default:
                return $value;
        }
    }

}
