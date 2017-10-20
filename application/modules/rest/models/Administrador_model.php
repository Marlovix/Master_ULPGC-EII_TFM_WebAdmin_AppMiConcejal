<?php

class Administrador_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('administrador', 'id_user');
    }

    public function getAdministrador($id) {
        $query = $this->db
                ->select('id_user, id_ayuntamiento')
                ->from('administrador')
                ->where('id_user', $id);
        $result = $query->get();
        return $result->row_array();
    }

    public function getAyuntamiento() {
        $id_user = $this->session->get_userdata()['user_id'];
        return $this->db
                        ->select('id_ayuntamiento, ayuntamiento')
                        ->from('administrador')
                        ->join('ayuntamiento', 'id_ayuntamiento')
                        ->where('id_user', $id_user)
                        ->get()
                        ->row_array();
    }

    public function getDataTablesColumns() {
        $fields = $this->getFields('users');
        $ayuntamiento_fields = $this->getFields('ayuntamiento');
        $columns = array(
            $fields[0] => 'ID',
            $fields[13] => 'Nombre',
            $fields[14] => 'Apellidos',
            $fields[5] => 'Email',
            $fields[16] => 'Teléfono',
            $ayuntamiento_fields[0] => 'ID Ayuntamiento',
            $ayuntamiento_fields[1] => 'Ayuntamiento',
            $fields[10] => 'Creación',
            $fields[11] => 'Último acceso',
            'state' => 'Estado'
        );
        return $columns;
    }

    public function getDataTables() {
        $select = $this->getSelectDataTables();
        $query = $this->db
                ->select($select)
                ->from('users')
                ->join($this->getTable(), 'administrador.id_user = users.id', 'left')
                ->join('ayuntamiento', 'id_ayuntamiento', 'left')
                ->join('users_groups', 'users_groups.user_id = users.id', 'left')
                ->where('group_id', '2'); // group_id = 2 -> ADMINISTRADORES
        $result = $query->get();
        return $result->result_array();
    }

    public function getIDAyuntamientoInput($administrador = null) {
        $options = $this->ayuntamiento->getOptions();
        $selected = (is_null($administrador)) ? null : $administrador['id_ayuntamiento'];

        $input = form_label('Ayuntamiento', 'id_ayuntamiento');
        $input .= form_dropdown('id_ayuntamiento', $options, $selected, array(
            'class' => 'form-control',
            'required' => true
        ));

        return $input;
    }

    public function getButtonsInput() {
        return form_submit('submit', 'Guardar', array(
            'class' => 'btn btn-success form-control'));
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
            case 'state':
                return 'active AS state';
            default:
                return $field;
        }

        return false;
    }

    // Abstract method //
    public function formatDataToDB($value, $field) {
        switch ($field) {
            case 'created_on':
            case 'last_login':
                return time();
            default:
                return $value;
        }

        return false;
    }

}
