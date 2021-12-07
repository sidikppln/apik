<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_pembantu_pnbp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('View_kas_umum_model', 'view_kas_umum_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('kas-umum/index');
        $config['total_rows'] = $this->view_kas_umum_m->countPembantu('2');
        $config['per_page'] = 100;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['kas_umum'] = $this->view_kas_umum_m->findPembantu($name, '2');
        } else {
            $data['kas_umum'] = $this->view_kas_umum_m->getPembantu($limit, $offset, '2');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('buku_pembantu_pnbp/index', $data);
        $this->load->view('template/footer');
    }
}
