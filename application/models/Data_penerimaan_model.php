<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_penerimaan_model extends CI_Model
{
    private $_table = 'data_penerimaan';

    public function get($limit = null, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
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
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function getPerNota($limit = null, $offset = 0, $nota_penerimaan_id = null)
    {
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function getAll($limit = null, $offset = 0, $kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('kode_sub_jenis', substr($kode, 2, 1));
        $this->db->where('nota_penerimaan_id', null);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function findAll($name = null, $kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('kode_sub_jenis', substr($kode, 2, 1));
        $this->db->where('nota_penerimaan_id', null);
        $this->db->like('nama', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countAll($kode = null)
    {
        $this->db->where('kode_kelompok', substr($kode, 0, 1));
        $this->db->where('kode_jenis', substr($kode, 1, 1));
        $this->db->where('kode_sub_jenis', substr($kode, 2, 1));
        $this->db->where('nota_penerimaan_id', null);
        return $this->db->get($this->_table)->num_rows();
    }

    public function sumKredit($nota_penerimaan_id = null)
    {
        return $this->db->query("SELECT nota_penerimaan_id, SUM(kredit) AS kredit FROM data_penerimaan WHERE nota_penerimaan_id='$nota_penerimaan_id' GROUP BY nota_penerimaan_id")->row_array();
    }
}
