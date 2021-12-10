<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_pengeluaran_model extends CI_Model
{
    private $_table = 'data_pengeluaran';

    public function get($limit = null, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.nama_sub_jenis AS jenis FROM data_pengeluaran a LEFT JOIN view_jenis b ON a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis AND a.kode_sub_jenis=b.kode_sub_jenis LIMIT $limit OFFSET $offset")->result_array();
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

    public function sumKredit($nota_pengeluaran_id = null)
    {
        return $this->db->query("SELECT nota_pengeluaran_id, SUM(kredit) AS kredit FROM data_pengeluaran WHERE nota_pengeluaran_id='$nota_pengeluaran_id' GROUP BY nota_pengeluaran_id")->row_array();
    }
}
