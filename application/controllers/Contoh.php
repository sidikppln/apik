<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contoh extends CI_Controller {

    public function __construct()
        {
            parent::__construct();
            $this->load->model('Contoh_model', 'contoh_m');
        }

	public function index()
	{
        //load data
        $data['contoh']=$this->contoh_m->get();
        
//form
		$this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('contoh/index', $data);
        $this->load->view('template/footer');

	}
}
