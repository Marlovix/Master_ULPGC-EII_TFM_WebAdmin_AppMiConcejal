<?php

class User_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('users', 'id');
    }

    public function getUser($id) {
        return $this->getDataTables($id);
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields();
        $group_fields = $this->getFields('groups');
        $columns = array(
            $fields[0] => 'ID',
            $fields[13] => 'Nombre',
            $fields[14] => 'Apellidos',
            $fields[5] => 'Email',
            $fields[16] => 'Teléfono',
            'id_group' => 'ID Perfil',
            $group_fields[1] => 'Perfil',
            $fields[10] => 'Creación',
            $fields[11] => 'Último acceso',
            $fields[3] => 'Contraseña',
            'state' => 'Estado'
        );
        return $columns;
    }

    public function getDataTables($id = null) {
        $fields = array_keys($this->getDataTablesColumns());
        $select = $this->getSelectDataTables($fields);
        $query = $this->db
                ->select($select)
                ->from($this->getTable())
                ->join('users_groups', 'users_groups.user_id = users.id')
                ->join('groups', 'users_groups.group_id = groups.id');
        if (!is_null($id)) {
            $query = $query->where($this->getTable() . '.' . $this->getPrimaryKey(), $id);
            $result = $query->get();
            return $result->row_array();
        }
        $result = $query->get();
        return $result->result_array();
    }

    public function getIdUserInput($user = null) {
        $index = 0;
        $invisible = '';
        if (is_null($user)) {
            $invisible .= ' invisible-input';
        }

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($user)) ? '' : $user[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getNombreInput($user = null) {
        $index = 1;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($user)) ? '' : $user[$name];

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

    public function getApellidosInput($user = null) {
        $index = 2;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($user)) ? '' : $user[$name];

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

    public function getEmailInput($user = null) {
        $index = 3;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($user)) ? '' : $user[$name];

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

    public function getTelefonoInput($user = null) {
        $index = 4;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $name = $fields[$index];
        $value = (is_null($user)) ? '' : $user[$name];

        $input = form_label($columns[$name], $name);
        $input .= form_input(array(
            'name' => $name,
            'value' => $value,
            'class' => 'form-control',
            'placeholder' => 'Escriba el ' . mb_strtolower($columns[$name], 'UTF-8')
        ));
        return $input;
    }

    public function getPerfilInput($user = null) {
        $index = 6;
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $options = $this->group->getSuperUserOptions('id', 'name');
        $selected = is_null($user[$fields[$index - 1]]) ? null : $user[$fields[$index - 1]];

        $input = form_label($columns[$fields[$index]], $fields[$index - 1]);
        $input .= form_dropdown($fields[$index - 1], $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));
        return $input;
    }

    public function getCreacionInput($user = null) {
        $invisible = '';
        $index = 7;
        if (is_null($user)) {
            $invisible .= ' invisible-input';
        }

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $value = (is_null($user)) ? '' : $user[$fields[$index]];

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_input(array(
            'name' => $fields[$index],
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getUltimoAccesoInput($user = null) {
        $invisible = '';
        $index = 8;
        if (is_null($user)) {
            $invisible .= ' invisible-input';
        }

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $value = (is_null($user)) ? '' : $user[$fields[$index]];

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_input(array(
            'name' => $fields[$index],
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'readonly' => true
        ));
        return $input;
    }

    public function getPasswordInput($user = null) {
        $invisible = '';
        $index = 9;

        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $value = (is_null($user)) ? '' : $user[$fields[$index]];

        if (!is_null($user)) {
            $invisible .= ' invisible-input';
            $value = ''; // Hide the password when the user is edited //
        }

        $properties = [
            'type' => 'password',
            'name' => $fields[$index],
            'value' => $value,
            'class' => 'form-control' . $invisible,
            'placeholder' => 'Escriba una contraseña'];

        if (is_null($user)) {
            $properties['required'] = true;
        }

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_input($properties);

        return $input;
    }

    public function getRepeatPasswordInput($user = null) {
        $invisible = '';
        if (!is_null($user)) {
            $invisible .= ' invisible-input';
        }

        $properties = [
            'type' => 'password',
            'name' => 'repeat_password',
            'class' => 'form-control' . $invisible,
            'placeholder' => 'Repita la contraseña'];

        if (is_null($user)) {
            $properties['required'] = true;
        }

        $input = form_label('Confirmación', 'repeat_password');
        $input .= form_input($properties);
        return $input;
    }

    public function getStateInput($user = null) {
        $columns = $this->getDataTablesColumns();
        $fields = array_keys($columns);
        $options = ['' => '', 1 => 'Activo', 0 => 'Inactivo'];
        $selected = (is_null($user)) ? 1 : $user['state'];
        $index = 10;

        $input = form_label($columns[$fields[$index]], $fields[$index]);
        $input .= form_dropdown($fields[$index], $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));

        return $input;
    }

    public function getButtonsInput($user = null) {
        $buttons = '';
        if (is_null($user)) {
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
            case 'last_login':
                return "FROM_UNIXTIME(" . $field . ", '%d/%m/%Y') AS " . $field;
            case 'repeat_password':
                return '';
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
            case 'last_login':
                return time();
            default:
                return $value;
        }
    }

}
