<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_satker_model extends CI_Model
{
    private $_table = 'ref_satker';

    public function get($limit = null, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null)
    {
        $this->db->like('nmsatker', $name);
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

    public function getNoUrutPenerimaan($kdsatker)
    {
        return $this->db->get_where($this->_table, ['kdsatker' => $kdsatker])->row_array()['no_urut_penerimaan'];
    }

    public function updateNoUrutPenerimaan($data, $kdsatker)
    {
        $this->db->update($this->_table, $data, ['kdsatker' => $kdsatker]);
        return $this->db->affected_rows();
    }

    public function getNoNotaPenerimaan($kdsatker)
    {
        return $this->db->get_where($this->_table, ['kdsatker' => $kdsatker])->row_array()['no_nota_penerimaan'];
    }

    public function updateNoNotaPenerimaan($data, $kdsatker)
    {
        $this->db->update($this->_table, $data, ['kdsatker' => $kdsatker]);
        return $this->db->affected_rows();
    }

    public function getNoUrutPengeluaran($kdsatker)
    {
        return $this->db->get_where($this->_table, ['kdsatker' => $kdsatker])->row_array()['no_urut_pengeluaran'];
    }

    public function updateNoUrutPengeluaran($data, $kdsatker)
    {
        $this->db->update($this->_table, $data, ['kdsatker' => $kdsatker]);
        return $this->db->affected_rows();
    }

    public function getNoNotaPengeluaran($kdsatker)
    {
        return $this->db->get_where($this->_table, ['kdsatker' => $kdsatker])->row_array()['no_nota_pengeluaran'];
    }

    public function updateNoNotaPengeluaran($data, $kdsatker)
    {
        $this->db->update($this->_table, $data, ['kdsatker' => $kdsatker]);
        return $this->db->affected_rows();
    }
}
