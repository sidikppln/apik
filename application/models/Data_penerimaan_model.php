<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_penerimaan_model extends CI_Model
{
    private $_table = 'data_penerimaan';

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
}
