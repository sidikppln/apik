<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_rekening_koran_model extends CI_Model
{
    protected $_table = 'data_rekening_koran';

    public function getTanggal($tanggal = null, $kode_bank = 1, $limit = null, $offset = 0)
    {
        $query = "SELECT * FROM data_rekening_koran WHERE substr(tanggal,1,2)=substr('$tanggal',1,2) AND substr(tanggal,4,2)=substr('$tanggal',4,2) AND kode_bank='$kode_bank'";
        $this->db->limit($limit, $offset);
        return $this->db->query($query)->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function findTanggal($tanggal = null, $kode_bank = 1, $name = null)
    {
        $this->db->where('substr(tanggal,0,2)', substr($tanggal, 0, 2));
        $this->db->where('kode_bank', $kode_bank);
        $this->db->like('uraian', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function countTanggal($tanggal = null, $kode_bank = 1)
    {
        $this->db->where('substr(tanggal,0,2)', substr($tanggal, 0, 2));
        $this->db->where('kode_bank', $kode_bank);
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

    public function get($limit = null, $offset = 0, $status = 0)
    {
        $this->db->where(['status' => $status, 'debet' => '0']);
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null, $status = 0)
    {
        $this->db->where(['status' => $status, 'debet' => '0']);
        $this->db->like('uraian', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($status = 0)
    {
        $this->db->where(['status' => $status, 'debet' => '0']);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getBeranda()
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->where(['status' => 0, 'debet' => '0']);
        return $this->db->get($this->_table)->num_rows();
    }
}
