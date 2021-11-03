<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_kas_umum_model extends CI_Model
{
    protected $_table = 'view_kas_umum';

    public function get($limit = null, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by('tanggal', 'asc');
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
}
