<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    protected $data = array();

    function __construct() {
        parent::__construct();
        $this->data['titlePage'] = 'Intranet | Spar Gran Canaria';
        $this->data['favicon'] = assets_url() . 'img/favicon.ico';
        $this->data['logoPage'] = assets_url() . 'img/spar-logo.png';
        $this->data['site'] = site_url('');
        $this->data['styles'][] = ['style' => assets_url() . 'css/style.css'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/common.js'];
    }

    protected function render($view = NULL, $template = '') {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->parser->parse($view, $this->data);
        } else {
            if (is_array($view)) {
                $this->data['contentView'] = $this->concatenateViews($view);
            } else {
                $this->data['contentView'] = (is_null($view)) ? '' : $this->parser->parse($view, $this->data, TRUE);
            }
            $this->parser->parse($template, $this->data);
        }
    }

    private function concatenateViews($views) {
        $result = '';
        foreach ($views as $view) {
            $result .= $this->parser->parse($view, $this->data, TRUE);
        }
        return $result;
    }

    protected function use_bootstrap() {
        $this->data['styles'][] = ['style' => bower_url() . 'bootstrap/dist/css/bootstrap.min.css'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap/dist/js/bootstrap.min.js'];
    }

    protected function use_bootstrap_colorpicker() {
        $this->data['styles'][] = ['style' => bower_url() . 'bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'];
    }

    protected function use_bootstrap_colorpicker_builder() {
        $this->use_bootstrap_colorpicker();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/colorpicker_builder.js'];
    }

    protected function use_bootstrap_filestyle() {
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-filestyle/src/bootstrap-filestyle.min.js'];
    }

    protected function use_bootstrap_filestyle_builder() {
        $this->use_bootstrap_filestyle();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/filestyle_builder.js'];
    }

    protected function use_selectpicker() {
        $this->data['styles'][] = ['style' => bower_url() . 'bootstrap-select/dist/css/bootstrap-select.min.css'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-select/dist/js/bootstrap-select.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-select/dist/js/i18n/defaults-es_ES.js"'];
    }

    protected function use_font_awesome() {
        $this->data['styles'][] = ['style' => bower_url() . 'font-awesome/css/font-awesome.min.css'];
    }

    protected function use_metisMenu() {
        $this->data['styles'][] = ['style' => bower_url() . 'metismenu/dist/metisMenu.min.css'];
        $this->data['scripts'][] = ['script' => bower_url() . 'metismenu/dist/metisMenu.min.js'];
    }

    protected function use_sbAdmin_template() {
        $this->data['styles'][] = ['style' => assets_url() . 'css/sb-admin-2.min.css'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/sb-admin-2.min.js'];
    }

    protected function use_rest() {
        $this->data['styles'][] = ['style' => assets_url() . 'css/loading.css'];
        $this->data['scripts'][] = ['script' => assets_url() . 'js/util/rest.js'];
    }

    protected function use_dataTables($bootstrap = true) {
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net/js/jquery.dataTables.min.js'];
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => bower_url() . 'datatables.net-bs/css/dataTables.bootstrap.min.css'];
            $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-bs/js/dataTables.bootstrap.min.js'];
        }
    }

    protected function use_dataTables_autoFill($bootstrap = true) {
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-autofill/js/dataTables.autoFill.min.js'];
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => bower_url() . 'datatables-autofill-bootstrap/css/autoFill.bootstrap.min.css'];
            $this->data['scripts'][] = ['script' => bower_url() . 'datatables-autofill-bootstrap/js/autoFill.bootstrap.min.js'];
        }
    }

    protected function use_dataTables_buttons($bootstrap = true) {
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-buttons/js/dataTables.buttons.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'jszip/dist/jszip.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'pdfmake/build/pdfmake.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'pdfmake/build/vfs_fonts.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-buttons/js/buttons.html5.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-buttons/js/buttons.print.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-buttons/js/buttons.colVis.min.js'];
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => bower_url() . 'datatables.net-buttons-bs/css/buttons.bootstrap.min.css'];
            $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-buttons-bs/js/buttons.bootstrap.min.js'];
        }
    }

    protected function use_dataTables_responsive($bootstrap = true) {
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => bower_url() . 'datatables.net-responsive-bs/css/responsive.bootstrap.min.css'];
        }
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-responsive/js/dataTables.responsive.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'datatables.net-responsive-bs/js/responsive.bootstrap.min.js'];
    }

    protected function use_dataTable_builder() {
        $this->use_dataTables();
        $this->use_dataTables_autoFill();
        $this->use_dataTables_responsive();
        $this->use_dataTables_buttons();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/dataTables-builder.js'];
    }

    protected function use_datepicker() {
        $this->data['styles'][] = ['style' => bower_url() . 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js'];
    }

    protected function use_datepicker_builder() {
        $this->use_datepicker();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/datepicker-builder.js'];
    }

    protected function use_jquery() {
        $this->data['scripts'][] = ['script' => bower_url() . 'jquery/dist/jquery.min.js'];
    }

    protected function use_select2($bootstrap = true) {
        $this->data['styles'][] = ['style' => bower_url() . 'select2/dist/css/select2.min.css'];
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => bower_url() . 'bootstrap-select2/select2-bootstrap.min.css'];
        }
        $this->data['scripts'][] = ['script' => bower_url() . 'select2/dist/js/select2.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'select2/dist/js/i18n/es.js'];
    }

    protected function use_select2_builder() {
        $this->use_select2();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/select2-builder.js'];
    }

    protected function use_typeahead($bootstrap = true) {
        $this->data['scripts'][] = ['script' => bower_url() . 'typeahead.js/dist/bloodhound.min.js'];
        $this->data['scripts'][] = ['script' => bower_url() . 'typeahead.js/dist/typeahead.jquery.min.js'];
        if ($bootstrap) {
            $this->data['styles'][] = ['style' => assets_url() . 'css/typeahead.bundle.css'];
        }
    }

    protected function use_typeahead_builder() {
        $this->use_typeahead();
        $this->data['scripts'][] = ['script' => assets_url() . 'js/lib/typeahead-builder.js'];
    }

}
