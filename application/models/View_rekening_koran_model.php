<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_rekening_koran_model extends CI_Model
{
    protected $_table = 'view_rekening_koran';

    public function get($limit = null, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null)
    {
        $this->db->like('tanggal', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count()
    {
        return $this->db->get($this->_table)->num_rows();
    }
}
