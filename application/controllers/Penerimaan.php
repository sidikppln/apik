<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
    }

    public function index($nota_penerimaan_id, $kode)
    {
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('penerimaan/index/' . $nota_penerimaan_id . '/' . $kode . '');
        $config['total_rows'] = $this->penerimaan_m->countPerNota($nota_penerimaan_id);
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
            $data['penerimaan'] = $this->penerimaan_m->findPerNota($name, $nota_penerimaan_id);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getPerNota($limit, $offset, $nota_penerimaan_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    public function create($nota_penerimaan_id, $kode)
    {
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('penerimaan/create/' . $nota_penerimaan_id . '/' . $kode . '/a');
        $config['total_rows'] = $this->penerimaan_m->countAll($kode);
        $config['per_page'] = 5;
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
            $data['penerimaan'] = $this->penerimaan_m->findAll($name, $kode);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getAll($limit, $offset, $kode);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penerimaan/create', $data);
        $this->load->view('template/footer');
    }

    public function pilih($id, $nota_penerimaan_id, $kode)
    {
        if (!isset($nota_penerimaan_id)) show_404();

        $data = [
            'nota_penerimaan_id' => $nota_penerimaan_id
        ];
        $this->penerimaan_m->update($data, $id);
        $kredit = $this->penerimaan_m->sumKredit($nota_penerimaan_id)['kredit'];
        $this->nota_penerimaan_m->update(['kredit' => $kredit], $nota_penerimaan_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('penerimaan/index/' . $nota_penerimaan_id . '/' . $kode . '');
    }

    public function delete($id, $nota_penerimaan_id, $kode)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->update(['nota_penerimaan_id' => null], $id)) {
            $kredit = $this->penerimaan_m->sumKredit($nota_penerimaan_id)['kredit'];
            $this->nota_penerimaan_m->update(['kredit' => $kredit], $nota_penerimaan_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('penerimaan/index/' . $nota_penerimaan_id . '/' . $kode . '');
    }
}
