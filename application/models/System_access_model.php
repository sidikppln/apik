<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_access_model extends CI_Model
{
    protected $_table = 'system_access';

    public function get($limit = null, $offset = 0, $id = null)
    {
        return $this->db->query("SELECT a.id, a.role_id, b.name, c.name AS nama_sub_menu, d.name AS nama_menu FROM system_access a LEFT JOIN system_sub_sub_menu b ON a.sub_sub_menu_id = b.id LEFT JOIN system_sub_menu c ON b.sub_menu_id=c.id LEFT JOIN system_menu d ON b.menu_id=d.id WHERE a.role_id = '$id' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null, $id = null)
    {
        return $this->db->query("SELECT a.id, a.role_id, b.name, c.name AS nama_sub_menu, d.name AS nama_menu FROM system_access a LEFT JOIN system_sub_sub_menu b ON a.sub_sub_menu_id = b.id LEFT JOIN system_sub_menu c ON b.sub_menu_id=c.id LEFT JOIN system_menu d ON b.menu_id=d.id WHERE a.role_id = '$id' AND b.name LIKE '%$name%'")->result_array();
    }

    public function count($id)
    {
        $this->db->where('role_id', $id);
        return $this->db->get($this->_table)->num_rows();
    }

    public function create($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function createBatch($data)
    {
        $this->db->insert_batch($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update($this->_table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete($this->_table, ['id' => $id]);
        return $this->db->affected_rows();
    }
}
