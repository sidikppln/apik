<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_menu_model extends CI_Model
{
    protected $_table = 'view_menu';

    public function getMenu($role_id)
    {
        return $this->db->query("SELECT DISTINCT id_menu, nama_menu FROM view_menu WHERE role_id='$role_id' ORDER BY id_menu ASC")->result_array();
    }

    public function getSubMenu($id_menu, $role_id)
    {
        return $this->db->query("SELECT DISTINCT id_sub_menu, nama_sub_menu, url_sub_menu, icon_sub_menu FROM view_menu WHERE id_menu='$id_menu' AND role_id='$role_id' ORDER BY id_sub_menu ASC")->result_array();
    }

    public function getSubSubMenu($id_sub_menu, $role_id)
    {
        return $this->db->query("SELECT DISTINCT id_sub_sub_menu, nama_sub_sub_menu, url_sub_sub_menu, icon_sub_sub_menu FROM view_menu WHERE id_sub_menu='$id_sub_menu' AND role_id='$role_id' ORDER BY id_sub_sub_menu ASC")->result_array();
    }
}
