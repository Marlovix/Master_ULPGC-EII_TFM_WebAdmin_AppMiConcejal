<?php

class Group_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->setCRUD('groups', 'id');
    }
    
    public function getSuperUserOptions($id, $value) {
        $query = $this->db
                ->select($id . ',' . $value)
                ->from($this->getTable())
                ->where('id', '1') // SUPERUSUARIOS
                ->or_where('id', '2'); // ADMINISTRADORESﬁ
        $result = $query->get();

        $options = ['' => ''];
        foreach ($result->result_array() as $option) {
            $options[$option[$id]] = ucfirst($option[$value]);
        }
        return $options;
    }

    public function getGroup($id) {
        $select = [];
        foreach ($this->getFields($this->getTable()) as $field) {
            $select[] = $this->formatDataToShow($field);
        }
        $query = $this->db
                ->select($select)
                ->from($this->getTable())
                ->where($this->getPrimaryKey(), $id);
        $result = $query->get();
        return $result->row_array();
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
