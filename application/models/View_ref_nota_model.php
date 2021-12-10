<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_ref_nota_model extends CI_Model
{
    protected $_table = 'view_ref_nota';

    public function get($status = null)
    {
        $this->db->where('status', $status);
        $this->db->order_by('kode', 'asc');
        return $this->db->get($this->_table)->result_array();
    }

    public function find($name = null, $status = null)
    {
        $this->db->where('status', $status);
        $this->db->like('tanggal', $name);
        return $this->db->get($this->_table)->result_array();
    }

    public function count($status = null)
    {
        $this->db->where('status', $status);
        return $this->db->get($this->_table)->num_rows();
    }
}
