<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_jenis_model extends CI_Model
{
    protected $_table = 'view_jenis';

    public function get($kode_kelompok)
    {
        return $this->db->query("SELECT CONCAT(kode_kelompok,kode_jenis,kode_sub_jenis) AS kode, nama_sub_jenis AS nama FROM view_jenis WHERE kode_kelompok='$kode_kelompok'")->result_array();
    }

    public function getKontra($kode)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('kode_sub_jenis', substr($kode, 2, 1));
        return $this->db->get($this->_table)->row_array()['kode_kontra'];
    }
}
