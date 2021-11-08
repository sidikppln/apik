<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_penerimaan_model extends CI_Model
{
    private $_table = 'data_penerimaan';

    public function get($limit = null, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.nama_sub_jenis AS jenis FROM data_penerimaan a LEFT JOIN view_jenis b ON a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis AND a.kode_sub_jenis=b.kode_sub_jenis LIMIT $limit OFFSET $offset")->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null)
    {
        return $this->db->query("SELECT a.*, b.nama_sub_jenis AS jenis FROM data_nota_pengeluaran a LEFT JOIN view_jenis b ON a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis AND a.kode_sub_jenis=b.kode_sub_jenis WHERE a.nomor LIKE '%$name%'")->result_array();
    }

    public function count()
    {
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

    public function countPerNota($nota_penerimaan_id = null)
    {
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        return $this->db->get($this->_table)->num_rows();
    }

    public function findPerNota($name = null, $nota_penerimaan_id = null)
    {
        return $this->db->query("SELECT a.*, b.nama_sub_jenis AS jenis FROM data_penerimaan a LEFT JOIN view_jenis b ON a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis AND a.kode_sub_jenis=b.kode_sub_jenis WHERE a.nota_penerimaan_id='$nota_penerimaan_id' AND b.nama_sub_jenis LIKE '%$name%'")->result_array();
    }

    public function getPerNota($limit = null, $offset = 0, $nota_penerimaan_id = null)
    {
        return $this->db->query("SELECT a.*, b.nama_sub_jenis AS jenis FROM data_penerimaan a LEFT JOIN view_jenis b ON a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis AND a.kode_sub_jenis=b.kode_sub_jenis WHERE a.nota_penerimaan_id='$nota_penerimaan_id' LIMIT $limit OFFSET $offset")->result_array();
    }

    public function getAll($limit = null, $offset = 0, $kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('nota_penerimaan_id', null);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findAll($name = null, $kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('nota_penerimaan_id', null);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countAll($kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('nota_penerimaan_id', null);
        return $this->db->get($this->_table)->num_rows();
    }

    public function sumDebet($nota_penerimaan_id = null)
    {
        return $this->db->query("SELECT nota_penerimaan_id, SUM(debet) AS debet FROM data_penerimaan WHERE nota_penerimaan_id='$nota_penerimaan_id' GROUP BY nota_penerimaan_id")->row_array();
    }

    public function getForPengeluaran($limit = null, $offset = 0)
    {
        $this->db->where('nota_penerimaan_id > ', 0);
        $this->db->where('status', 0);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findForPengeluaran($name = null)
    {
        $this->db->where('nota_penerimaan_id > ', 0);
        $this->db->where('status', 0);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countForPengeluaran()
    {
        $this->db->where('nota_penerimaan_id > ', 0);
        $this->db->where('status', 0);
        return $this->db->get($this->_table)->num_rows();
    }
}
