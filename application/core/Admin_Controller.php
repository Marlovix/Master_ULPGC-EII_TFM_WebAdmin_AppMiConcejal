<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }

        $user_id = $this->session->get_userdata()['user_id'];
        $group = $this->ion_auth->get_group($user_id);

        // SUPERUSUARIOS o ADMINISTRADORES //
        if (!($group['group_id'] == 1 || $group['group_id'] == 2)) {
            redirect('auth/logout', 'refresh');
        }

        $this->session->set_userdata('id_group', $group['group_id']);
        $this->session->set_userdata('group', $group['name']);

        $this->use_jquery();
        $this->use_bootstrap();
        $this->use_metisMenu();
        $this->use_sbAdmin_template();
        $this->use_font_awesome();
        $this->use_rest();

        $ayuntamiento = $this->administrador->getAyuntamiento();
        if (!is_null($ayuntamiento)) {
            $this->session->set_userdata('id_ayuntamiento', $ayuntamiento['id_ayuntamiento']);
            $this->session->set_userdata('ayuntamiento', $ayuntamiento['ayuntamiento']);
        } else {
            if ($group['group_id'] == 2) {
                redirect('auth/logout', 'refresh');
            }
        }

        $this->data['user_nav_actions'][] = [
            'site' => base_url() . '/auth/logout',
            'icon' => 'fa-sign-out',
            'label' => 'Cerrar sesión'];
        $ayuntamiento_administrador = (isset($ayuntamiento['ayuntamiento'])) ?
                ': ' . $ayuntamiento['ayuntamiento'] : '';
        $this->data['user_group'] = $group['name'] . $ayuntamiento_administrador;
        $this->data['width_form_class'] = 'col-sm-offset-3 col-sm-6';
        $this->data['width_input_class'] = 'col-sm-4';
        $this->data['backButton'] = '';

        /* $this->ci = & get_instance();
          $segment = $this->ci->uri->segment(2); // Segundo nivel del menú //
          if (is_null($segment)) {
          $this->reset_userdata();
          } else {
          $this->data['iconPage'] = $this->session->userdata('iconPage');
          $this->data['titlePage'] = $this->session->userdata('titlePage');
          $this->data['slug'] = $this->session->userdata('slug');
          } */

        //$this->data['currentUser'] = $this->ion_auth->user()->row();
        //$this->data['currentUserMenu'] = $this->ion_auth->user()->row();
        if ($this->ion_auth->in_group('admin')) {
            //$this->data['currentUserMenu'] = $this->load->view('admin/templates/_parts/user_menu_admin.php', NULL, TRUE);
        }


        $this->load->library('multi_menu');

        $this->load->model('menu_model', 'menu');
    }

    private function reset_userdata() {
        $this->session->unset_userdata('iconPage');
        $this->session->unset_userdata('titlePage');
        $this->session->unset_userdata('slug');
    }

    protected function render($view = NULL, $template = 'templates/admin_master') {
        $items = $this->menu->all();
        $this->multi_menu->set_items($items);
        $this->data['menus'] = $this->multi_menu->render();

        $this->data['header'] = $this->parser->parse('templates/_parts/header', $this->data, TRUE);
        $this->data['navigation'] = $this->parser->parse('templates/_parts/navigation', $this->data, TRUE);
        $this->data['sidebar'] = $this->parser->parse('templates/_parts/sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->parser->parse('templates/_parts/footer', $this->data, TRUE);

        parent::render($view, $template);
    }

}
