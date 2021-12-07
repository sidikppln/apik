<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_penerimaan_model extends CI_Model
{
    private $_table = 'data_penerimaan';

    public function get($limit = null, $offset = 0)
    {
        $this->db->select('a.*,b.nama_jenis');
        $this->db->from('data_penerimaan a');
        $this->db->join('view_jenis b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function find($name = null)
    {
        $this->db->select('a.*,b.nama_jenis');
        $this->db->from('data_penerimaan a');
        $this->db->join('view_jenis b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->like('b.nama_jenis', $name);
        return $this->db->get()->result_array();
    }

    public function count()
    {
        return $this->db->get($this->_table)->num_rows();
    }

    public function getPerNota($limit = null, $offset = 0, $nota_penerimaan_id = null)
    {
        $this->db->select('a.*,b.nama_jenis');
        $this->db->from('data_penerimaan a');
        $this->db->join('view_jenis b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function findPerNota($name = null, $nota_penerimaan_id = null)
    {
        $this->db->select('a.*,b.nama_jenis');
        $this->db->from('data_penerimaan a');
        $this->db->join('view_jenis b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        $this->db->like('b.nama_jenis', $name);
        return $this->db->get()->result_array();
    }

    public function countPerNota($nota_penerimaan_id = null)
    {
        $this->db->where('nota_penerimaan_id', $nota_penerimaan_id);
        return $this->db->get($this->_table)->num_rows();
    }

    public function getAll($limit = null, $offset = 0, $kode_nota = null)
    {
        $this->db->select('b.*');
        $this->db->from('ref_nota a');
        $this->db->join('data_penerimaan b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->where(['a.kode' => $kode_nota, 'b.nota_penerimaan_id' => null]);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function findAll($name = null, $kode_nota = null)
    {
        $this->db->select('b.*');
        $this->db->from('ref_nota a');
        $this->db->join('data_penerimaan b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->where(['a.kode' => $kode_nota, 'b.nota_penerimaan_id' => null]);
        $this->db->like('nama', $name);
        return $this->db->get()->result_array();
    }

    public function countAll($kode_nota = null)
    {
        $this->db->select('b.*');
        $this->db->from('ref_nota a');
        $this->db->join('data_penerimaan b', 'a.kode_kelompok=b.kode_kelompok AND a.kode_jenis=b.kode_jenis', 'left');
        $this->db->where(['a.kode' => $kode_nota, 'b.nota_penerimaan_id' => null]);
        return $this->db->get()->num_rows();
    }

    public function getDetail($id)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
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
