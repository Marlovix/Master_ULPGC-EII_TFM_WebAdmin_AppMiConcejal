<?php

class Asignar_perfil_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('users_groups', 'id');
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
