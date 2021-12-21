<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_pembantu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('View_kas_umum_model', 'view_kas_umum_m');
    }

    public function index($kode_kelompok = 1)
    {
        $data['ref_kode_kelompok'] = $this->view_kas_umum_m->getKodeKelompok();

        $data['kode_kelompok'] = $kode_kelompok;
        // setting halaman
        $config['base_url'] = base_url('buku-pembantu/index/' . $kode_kelompok . '');
        $config['total_rows'] = $this->view_kas_umum_m->countPembantu($kode_kelompok);
        $config['per_page'] = 100;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['kas_umum'] = $this->view_kas_umum_m->findPembantu($name, $kode_kelompok);
        } else {
            $data['kas_umum'] = $this->view_kas_umum_m->getPembantu($limit, $offset, $kode_kelompok);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('buku_pembantu/index', $data);
        $this->load->view('template/footer');
    }
}
