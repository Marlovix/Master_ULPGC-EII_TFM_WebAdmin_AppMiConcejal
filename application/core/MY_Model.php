<?php

abstract class MY_Model extends CI_Model {

    private $dbTable;
    private $primaryKey;

    public function __construct() {
        parent::__construct();
    }

    public function setCRUD($table, $primaryKey) {
        $this->dbTable = $table;
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getTable() {
        return $this->dbTable;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function getFields($dbTable = null) {
        if (is_null($dbTable))
            return $this->db->list_fields($this->dbTable);
        else
            return $this->db->list_fields($dbTable);
    }

    public function get() {
        $query = $this->db
                ->select('*')
                ->from($this->dbTable);
        $result = $query->get();
        return $result->result_array();
    }

    public function find($id = null) {
        if (!is_null($id)) {
            $query = $this->db
                    ->select('*')
                    ->from($this->dbTable)
                    ->where($this->primaryKey, $id);
            $result = $query->get();
            if ($result->num_rows() == 1)
                return $result->row_array();
        }
        return false;
    }

    public function save($modal) {
        $this->db
                ->set($this->_setModal($modal))
                ->insert($this->dbTable);
        if ($this->db->insert_id())
            return $this->db->insert_id();

        return false;
    }

    public function update($id, $modal) {
        $this->db
                ->set($this->_setModal($modal))
                ->where($this->primaryKey, $id)
                ->update($this->dbTable);
        if ($this->db->insert_id())
            return $this->db->insert_id();

        return false;
    }

    public function delete($id) {
        $this->db
                ->where($this->primaryKey, $id)
                ->delete($this->dbTable);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

    protected function getSelectDataTables($columns = null) {
        if (is_null($columns)) {
            $columns = array_keys($this->getDataTablesColumns());
        }
        $select = [];
        foreach ($columns as $field) {
            $select[] = $this->formatDataToShow($field);
        }
        return $select;
    }

    public function search($wildcard, $select, $field) {
        $query = $this->db
                ->select($select)
                ->from($this->getTable())
                ->like($field, $wildcard);
        $result = $query->get();
        return $result->result_array();
    }

    private function _setModal($modal) {
        $set_modal = array();
        foreach ($this->getFields() as $field) {
            if (isset($modal[$field])) {
                $value = $modal[$field];
                $data = $this->formatDataToDB($value, $field);
                $set_modal[$field] = $data;
            }
        }
        return $set_modal;
    }

    // They must return false if fields do not match //
    abstract protected function formatDataToDB($value, $field);

    abstract protected function formatDataToShow($field);
}
