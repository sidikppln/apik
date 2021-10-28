<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_jenis_model extends CI_Model
{
    protected $_table = 'view_jenis';

    public function get($kode_kelompok)
    {
        return $this->db->query("SELECT CONCAT(kode_kelompok,kode_jenis,kode_sub_jenis) AS kode, nama_sub_jenis AS nama FROM view_jenis WHERE kode_kelompok='$kode_kelompok'")->result_array();
    }
}
