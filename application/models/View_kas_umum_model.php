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

    public function getBerandaAktivitas()
    {
        $query = "SELECT b.nama, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit FROM view_kas_umum a LEFT JOIN ref_jenis_aktivitas b ON a.jenis_aktivitas=b.kode WHERE a.kdsatker=" . kdsatker() . " AND a.tahun=" . tahun() . " GROUP BY b.nama";
        return $this->db->query($query)->result_array();
    }

    public function getBerandaKelompok()
    {
        $query = "SELECT b.nama, SUM(a.debet) AS debet, SUM(a.kredit) AS kredit FROM view_kas_umum a LEFT JOIN ref_kelompok b ON a.kode_kelompok=b.kode WHERE a.kdsatker=" . kdsatker() . " AND a.tahun=" . tahun() . " GROUP BY b.nama";
        return $this->db->query($query)->result_array();
    }

    public function getKodeKelompok()
    {
        $query = "SELECT distinct b.kode,b.nama FROM view_kas_umum a LEFT JOIN ref_kelompok b ON a.kode_kelompok=b.kode";
        return $this->db->query($query)->result_array();
    }
}
