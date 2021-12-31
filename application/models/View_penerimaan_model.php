<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_penerimaan_model extends CI_Model
{
    private $_table = 'view_penerimaan';

    public function get($limit = null, $offset = 0, $status = 0, $nota_penerimaan_id = null)
    {
        $this->db->where(['status' => $status, 'nota_penerimaan_id' => $nota_penerimaan_id]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null, $status = 0, $nota_penerimaan_id = null)
    {
        $this->db->where(['status' => $status, 'nota_penerimaan_id' => $nota_penerimaan_id]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($status = 0, $nota_penerimaan_id = null)
    {
        $this->db->where(['status' => $status, 'nota_penerimaan_id' => $nota_penerimaan_id]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getPerKode($limit = null, $offset = 0, $status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findPerKode($name = null, $status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countPerKode($status = 0, $kode_nota = null)
    {
        $this->db->where(['status' => $status, 'kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getPerKodeUjl($limit = null, $offset = 0, $kode_nota = null)
    {
        $this->db->where(['kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findPerKodeUjl($name = null, $kode_nota = null)
    {
        $this->db->where(['kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countPerKodeUjl($kode_nota = null)
    {
        $this->db->where(['kode_nota' => $kode_nota]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }
}
