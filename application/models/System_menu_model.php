<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_menu_model extends CI_Model
{
    protected $_table = 'system_menu';

    public function get($limit = null, $offset = 0)
    {
        $this->db->order_by('urutan', 'asc');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null)
    {
        $this->db->order_by('urutan', 'asc');
        $this->db->like('name', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count()
    {
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
