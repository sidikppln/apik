<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_aktivitas_model extends CI_Model
{
    private $_table = 'data_aktivitas';

    public function get($limit = null, $offset = 0, $jenis_aktivitas = 1, $status = 0)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun(), 'status' => $status]);
        $this->db->where('jenis_aktivitas', $jenis_aktivitas);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null, $jenis_aktivitas = 1, $status = 0)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun(), 'status' => $status]);
        $this->db->where('jenis_aktivitas', $jenis_aktivitas);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($jenis_aktivitas = 1, $status = 0)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun(), 'status' => $status]);
        $this->db->where('jenis_aktivitas', $jenis_aktivitas);
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

    public function getJenisAktivitas($status = 0)
    {
        $query = "SELECT DISTINCT b.kode,b.nama FROM data_aktivitas a LEFT JOIN ref_jenis_aktivitas b ON a.jenis_aktivitas=b.kode WHERE a.kdsatker=" . kdsatker() . " AND a.tahun=" . tahun() . " AND a.status='$status'";
        return $this->db->query($query)->result_array();
    }

    public function getBeranda($status = 0)
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun(), 'status' => $status]);
        return $this->db->get($this->_table)->num_rows();
    }
}
