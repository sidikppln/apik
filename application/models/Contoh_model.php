<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contoh_model extends CI_Model {

public function get()
{
    return $this->db->get('data_contoh')->result_array();
    


}

}
