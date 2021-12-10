<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_kas_umum_model extends CI_Model
{
    protected $_table = 'view_kas_umum';

    public function get($limit = null, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by('tanggal', 'asc');
        $this->db->order_by('kode_kelompok', 'asc');
        $this->db->order_by('kode_jenis', 'asc');
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null)
    {
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function getPembantu($limit = null, $offset = 0, $kode_kelompok = null)
    {
        $this->db->where('kode_kelompok', $kode_kelompok);
        $this->db->limit($limit, $offset);
        $this->db->order_by('tanggal', 'asc');
        $this->db->order_by('kode_kelompok', 'asc');
        $this->db->order_by('kode_jenis', 'asc');
        return $this->db->get($this->_table)->result_array();
    }

    public function findPembantu($name = null, $kode_kelompok = null)
    {
        $this->db->where('kode_kelompok', $kode_kelompok);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countPembantu($kode_kelompok = null)
    {
        $this->db->where('kode_kelompok', $kode_kelompok);
        return $this->db->get($this->_table)->num_rows();
    }
}
