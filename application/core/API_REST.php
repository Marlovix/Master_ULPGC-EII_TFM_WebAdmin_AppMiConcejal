<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class API_REST extends REST_Controller {

    private $model;

    public function __construct($model) {
        parent::__construct();
        $this->model = $model;
        $this->lang->load('rest_controller_lang', 'spanish');
    }

    public function getModel() {
        return $this->model;
    }

    public function index_get() {
        $result = $this->model->get();
        if (is_null($result)) {
            $error = $this->lang->line('text_rest_not_found');
            $this->response(array('error' => $error), 404);
        } else
            $this->response(array('success' => $result), 200);
    }

    public function find_get($id) {
        $error = $this->lang->line('text_rest_not_found');
        if (!$id) {
            $this->response(array('error' => $error), 404);
        }
        $result = $this->model->find($id);
        if (is_null($result) || empty($result)) {
            $this->response(array('error' => $error), 404);
        } else
            $this->response(array('success' => $result), 200);
    }

    public function index_post() {
        $error = $this->lang->line('text_rest_error');
        if (!$this->post()) {
            $this->response(array('error' => $this->post()), 400);
        }
        $id = $this->model->save($this->post());
        if (!is_null($id)) {
            $success = sprintf($this->lang->line('text_rest_create_success'), $id);
            $this->response(array('success' => $success), 200);
        } else {
            $this->response(array('error' => $this->db->_error_message()), 400);
        }
    }

    public function index_put($id) {
        $error = $this->lang->line('text_rest_error');
        if (!$this->put() || !$id) {
            $this->response(array('error' => $error), 400);
        }
        $update = $this->model->update($id, $this->put());
        if (is_null($update)) {
            $this->response(array('error' => $error), 400);
        } else {
            $success = sprintf($this->lang->line('text_rest_update_success'), $id);
            $this->response(array('success' => $success), 200);
        }
    }

    public function index_delete($id) {
        $error = $this->lang->line('text_rest_error');
        if (!$id) {
            $this->response(array('error' => $error), 400);
        }
        $delete = $this->model->delete($id);
        if (!is_null($delete)) {
            $success = sprintf($this->lang->line('text_rest_delete_success'), $id);
            $this->response(array('success' => $success), 200);
        } else {
            $this->response(array('error' => $error), 400);
        }
    }

    public function table_columns_get() {
        $this->response(array('success' => $this->getModel()->getDataTablesColumns()), 200);
    }

    public function datatables_get() {
        $this->response(array('success' => $this->getModel()->getDataTables()), 200);
    }

}
