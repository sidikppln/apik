<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_sub_jenis_model extends CI_Model
{
    protected $_table = 'ref_sub_jenis';

    public function get($limit = null, $offset = 0, $ref_jenis_id)
    {
        $this->db->where('ref_jenis_id', $ref_jenis_id);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null, $ref_jenis_id)
    {
        $this->db->where('ref_jenis_id', $ref_jenis_id);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($ref_jenis_id)
    {
        $this->db->where('ref_jenis_id', $ref_jenis_id);
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

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }
}
