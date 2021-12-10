<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_pengeluaran_model extends CI_Model
{
    private $_table = 'view_pengeluaran';

    public function get($limit = null, $offset = 0, $status = 0, $nota_pengeluaran_id = null)
    {
        $this->db->where(['status' => $status, 'nota_pengeluaran_id' => $nota_pengeluaran_id]);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null, $status = 0, $nota_pengeluaran_id = null)
    {
        $this->db->where(['status' => $status, 'nota_pengeluaran_id' => $nota_pengeluaran_id]);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($status = 0, $nota_pengeluaran_id = null)
    {
        $this->db->where(['status' => $status, 'nota_pengeluaran_id' => $nota_pengeluaran_id]);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getPerKode($limit = null, $offset = 0, $status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findPerKode($name = null, $status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countPerKode($status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }
}
