<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_user_model extends CI_Model
{
    protected $_table = 'system_user';

    public function get($limit = null, $offset = 0)
    {
        // $this->db->limit($limit, $offset);
        return $this->db->query("SELECT a.*, b.name AS nama_role FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id LIMIT $limit OFFSET $offset")->result_array();
    }

    public function getDetail($id)
    {
        return $this->db->query("SELECT a.*, b.name AS nama_role FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id WHERE a.id='$id'")->row_array();
    }

    public function find($name = null)
    {
        return $this->db->query("SELECT a.*, b.name AS nama_role FROM system_user a LEFT JOIN system_role b ON a.role_id=b.id WHERE a.nama LIKE '%$name%'")->result_array();
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

    public function getNip($nip)
    {
        return $this->db->get_where($this->_table, ['nip' => $nip])->row_array();
    }
}
