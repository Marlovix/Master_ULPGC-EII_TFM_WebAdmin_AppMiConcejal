<?php

class Menu_model extends CI_Model {

    public function all() {
        $group = $this->db
                        ->select('group_id, name')
                        ->from('users_groups')
                        ->join('groups', 'users_groups.group_id = groups.id')
                        ->where('user_id', $_SESSION['user_id'])
                        ->get()->row_array();
        $this->session->set_userdata(['group_id' => $group['group_id']]);
        $this->session->set_userdata(['group' => $group['name']]);
        $menus = $this->db
                        ->select('menus.id_menu, menus.parent, menus.name, menus.icon, menus.slug, menus.number')
                        ->from("menus")
                        ->join("menus_groups", "id_menu")
                        ->where("group_id", $group['group_id'])
                        ->get()->result_array();
        return $menus;
    }

}
