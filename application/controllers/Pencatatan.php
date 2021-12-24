<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pencatatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('View_nota_model', 'view_nota_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        $this->load->model('Data_nota_pengeluaran_model', 'nota_pengeluaran_m');
        $this->load->model('View_penerimaan_model', 'view_penerimaan_m');
        $this->load->model('View_pengeluaran_model', 'view_pengeluaran_m');
    }

    public function index($jenis_aktivitas = 1)
    {
        $status = 3;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['ref_jenis_aktivitas'] = $this->view_nota_m->getJenisAktivitas($status);

        // setting halaman
        $config['base_url'] = base_url('pencatatan/index/' . $jenis_aktivitas . '');
        $config['total_rows'] = $this->view_nota_m->countAktivitas($jenis_aktivitas, $status);
        $config['per_page'] = 5;
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
            $data['aktivitas'] = $this->view_nota_m->findAktivitas($name, $jenis_aktivitas, $status);
        } else {
            $data['aktivitas'] = $this->view_nota_m->getAktivitas($limit, $offset, $jenis_aktivitas, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pencatatan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($jenis_aktivitas = 1, $aktivitas_id = null)
    {
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $status = 3;
        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
        $config['total_rows'] = $this->view_nota_m->count($aktivitas_id, $status);
        $config['per_page'] = 5;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['nota'] = $this->view_nota_m->find($name, $aktivitas_id, $status);
        } else {
            $data['nota'] = $this->view_nota_m->get($limit, $offset, $aktivitas_id, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pencatatan/detail', $data);
        $this->load->view('template/footer');
    }

    public function transaksi_penerimaan($jenis_aktivitas = 1, $aktivitas_id = null, $nota_penerimaan_id = null)
    {
        if (!isset($nota_penerimaan_id)) show_404();
        $status = 1;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;

        // setting halaman
        $config['base_url'] = base_url('pencatatan/transaksi-penerimaan/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_penerimaan_id . '');
        $config['total_rows'] = $this->view_penerimaan_m->count($status, $nota_penerimaan_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['penerimaan'] = $this->view_penerimaan_m->find($name, $status, $nota_penerimaan_id,);
        } else {
            $data['penerimaan'] = $this->view_penerimaan_m->get($limit, $offset, $status, $nota_penerimaan_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pencatatan/transaksi_penerimaan', $data);
        $this->load->view('template/footer');
    }

    public function transaksi_pengeluaran($jenis_aktivitas = 2, $aktivitas_id = null, $nota_pengeluaran_id = null)
    {
        if (!isset($nota_pengeluaran_id)) show_404();
        $status = 1;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $data['nota_pengeluaran_id'] = $nota_pengeluaran_id;

        // setting halaman
        $config['base_url'] = base_url('pencatatan/transaksi-pengeluaran/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_pengeluaran_id . '');
        $config['total_rows'] = $this->view_pengeluaran_m->count($status, $nota_pengeluaran_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['pengeluaran'] = $this->view_pengeluaran_m->find($name, $status, $nota_pengeluaran_id,);
        } else {
            $data['pengeluaran'] = $this->view_pengeluaran_m->get($limit, $offset, $status, $nota_pengeluaran_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pencatatan/transaksi_pengeluaran', $data);
        $this->load->view('template/footer');
    }

    public function proses($jenis_aktivitas = 0, $aktivitas_id = null, $id = null, $jenis_nota = 1)
    {
        if (!isset($id)) show_404();

        $data = ['status' => 4];
        $jenis_nota == 1 ? $nota = 'nota_penerimaan_m' : $nota = 'nota_pengeluaran_m';
        if ($this->$nota->update($data, $id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
        }
        redirect('pencatatan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
    }

    public function tolak($jenis_aktivitas = 0, $aktivitas_id = null, $id = null, $jenis_nota = 1)
    {
        if (!isset($id)) show_404();

        $data = ['status' => 2];
        $jenis_nota == 1 ? $nota = 'nota_penerimaan_m' : $nota = 'nota_pengeluaran_m';
        if ($this->$nota->update($data, $id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil ditolak.');
        }
        redirect('pencatatan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
    }
}