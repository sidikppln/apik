<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_nota_model extends CI_Model
{
    protected $_table = 'view_nota';

    public function get($limit = null, $offset = 0, $aktivitas_id = 0, $status = 0)
    {
        $this->db->select('a.*, b.nama AS nama_nota');
        $this->db->from('view_nota a');
        $this->db->join('view_ref_nota b', 'a.kode_nota =b.kode', 'left');
        $this->db->where(['a.aktivitas_id' => $aktivitas_id, 'a.status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function find($name = null, $aktivitas_id = 0, $status = 0)
    {
        $this->db->select('a.*, b.nama AS nama_nota');
        $this->db->from('view_nota a');
        $this->db->join('view_ref_nota b', 'a.kode_nota =b.kode', 'left');
        $this->db->where(['a.aktivitas_id' => $aktivitas_id, 'a.status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->like('a.nomor', $name);
        return $this->db->get()->result_array();
    }

    public function count($status = 0)
    {
        $this->db->where('status', $status);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        return $this->db->get($this->_table)->num_rows();
    }


    public function getBeranda($status = null)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->where('status', $status);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getJenisAktivitas($status = 0)
    {
        $query = "SELECT DISTINCT b.kode,b.nama FROM view_nota a LEFT JOIN ref_jenis_aktivitas b ON a.jenis_aktivitas=b.kode WHERE a.kdsatker=" . kdsatker() . " AND a.tahun=" . tahun() . " AND a.status='$status'";
        return $this->db->query($query)->result_array();
    }

    public function getAktivitas($limit = null, $offset = 0, $jenis_aktivitas = 1, $status = 0)
    {
        $this->db->distinct()->select('b.id,b.kode,b.nama,b.status');
        $this->db->from('view_nota a');
        $this->db->join('data_aktivitas b', 'a.aktivitas_id=b.id', 'left');
        $this->db->where(['a.kdsatker' => kdsatker(), 'a.tahun' => tahun(), 'a.status' => $status, 'a.jenis_aktivitas' => $jenis_aktivitas]);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function findAktivitas($name = null, $jenis_aktivitas = 1, $status = 0)
    {
        $this->db->distinct()->select('b.id,b.kode,b.nama,b.status');
        $this->db->from('view_nota a');
        $this->db->join('data_aktivitas b', 'a.jenis_aktivitas=b.kode', 'left');
        $this->db->where(['a.kdsatker' => kdsatker(), 'a.tahun' => tahun(), 'a.status' => $status, 'a.jenis_aktivitas' => $jenis_aktivitas]);
        $this->db->like('b.nama', $name);
        return $this->db->get()->result_array();
    }

    public function countAktivitas($jenis_aktivitas = 1, $status = 0)
    {
        $this->db->distinct()->select('b.id,b.kode,b.nama,b.status');
        $this->db->from('view_nota a');
        $this->db->join('data_aktivitas b', 'a.jenis_aktivitas=b.kode', 'left');
        $this->db->where(['a.kdsatker' => kdsatker(), 'a.tahun' => tahun(), 'a.status' => $status, 'a.jenis_aktivitas' => $jenis_aktivitas]);
        return $this->db->get()->num_rows();
    }

    public function getAll($limit = null, $offset = 0, $status = 0)
    {
        $this->db->select('a.*, b.nama AS nama_nota');
        $this->db->from('view_nota a');
        $this->db->join('view_ref_nota b', 'a.kode_nota =b.kode', 'left');
        $this->db->where(['a.status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }
}
