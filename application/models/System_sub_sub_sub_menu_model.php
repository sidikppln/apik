<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_sub_sub_sub_menu_model extends CI_Model
{
    protected $_table = 'system_sub_sub_sub_menu';

    public function get($limit = null, $offset = 0, $id = null)
    {
        $this->db->where('sub_menu_id', $id);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null, $id = null)
    {
        $this->db->like('nama', $name);
        $this->db->where('sub_menu_id', $id);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($id)
    {
        $this->db->where('sub_menu_id', $id);
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

    public function getSubSubSubMenu($sub_sub_menu_id)
    {
        return $this->db->get_where($this->_table, ['sub_sub_menu_id' => $sub_sub_menu_id])->result_array();
    }
}
