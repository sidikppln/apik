<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_rekening_koran_model extends CI_Model
{
    protected $_table = 'view_rekening_koran';

    public function get($limit = null, $offset = 0, $kode_bank = 1)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'thn' => tahun()]);
        $this->db->where('kode_bank', $kode_bank);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null, $kode_bank = 1)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'thn' => tahun()]);
        $this->db->where('kode_bank', $kode_bank);
        $this->db->like('tanggal', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($kode_bank = 1)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'thn' => tahun()]);
        $this->db->where('kode_bank', $kode_bank);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getKodeBank()
    {
        $query = "SELECT DISTINCT b.kode,b.nama FROM view_rekening_koran a LEFT JOIN ref_bank b ON a.kode_bank=b.kode WHERE a.kdsatker=" . kdsatker() . " AND a.thn=" . tahun() . "";
        return $this->db->query($query)->result_array();
    }
}
