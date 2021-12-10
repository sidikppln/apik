<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_jenis_model extends CI_Model
{
    protected $_table = 'view_jenis';

    public function get()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getPenerimaan()
    {
        $this->db->where(['kode_kelompok' => '1', 'status' => 'Debet']);
        return $this->db->get($this->_table)->result_array();
    }

    public function getPerNota($kode_nota)
    {
        $this->db->where('kode_nota', $kode_nota);
        return $this->db->get($this->_table)->result_array();
    }
}
