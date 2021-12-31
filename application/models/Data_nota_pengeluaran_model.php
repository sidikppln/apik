<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_nota_pengeluaran_model extends CI_Model
{
    private $_table = 'data_nota_pengeluaran';

    public function get($limit = null, $offset = 0, $aktivitas_id = null, $status = 0)
    {
        $this->db->select('a.*, b.nama AS nama_nota');
        $this->db->from('data_nota_pengeluaran a');
        $this->db->join('view_ref_nota b', 'a.kode_nota =b.kode', 'left');
        $this->db->where(['a.aktivitas_id' => $aktivitas_id, 'a.status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function getDetail($id = null)
    {
        return $this->db->get_where($this->_table, ['id' => $id])->row_array();
    }

    public function find($name = null, $aktivitas_id = null, $status = 0)
    {
        $this->db->select('a.*, b.nama AS nama_nota');
        $this->db->from('data_nota_pengeluaran a');
        $this->db->join('view_ref_nota b', 'a.kode_nota =b.kode', 'left');
        $this->db->where(['a.aktivitas_id' => $aktivitas_id, 'a.status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->like('a.nomor', $name);
        return $this->db->get()->result_array();
    }

    public function count($aktivitas_id = null, $status = 0)
    {
        $this->db->where(['aktivitas_id' => $aktivitas_id, 'status' => $status]);
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
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

    public function getBeranda()
    {
        $this->db->where(['kdsatker' => kdsatker(), 'tahun' => tahun()]);
        $this->db->where('status', 0);
        return $this->db->get($this->_table)->num_rows();
    }
}
