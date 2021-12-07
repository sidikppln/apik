<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        // $this->load->model('View_jenis_model', 'view_jenis_m');
        $this->load->model('Ref_nota_model', 'ref_nota_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/index');
        $config['total_rows'] = $this->nota_penerimaan_m->count();
        $config['per_page'] = 5;
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
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->find($name);
        } else {
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode Penerimaan',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        $kdsatker = $this->session->userdata('kdsatker');
        $no_nota = NoNotaPenerimaan($kdsatker)['no_nota'];
        $no_nota_next = NoNotaPenerimaan($kdsatker)['no_nota_next'];
        $data['ref_nota'] = $this->ref_nota_m->getPenerimaan();

        if ($validation->run()) {
            $data = [
                'nomor' => $no_nota,
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true)),
                'tanggal' => time()
            ];
            $this->ref_satker_m->updateNoNotaPenerimaan(['no_nota_penerimaan' => $no_nota_next], $kdsatker);
            $this->nota_penerimaan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-penerimaan');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/create', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['view_jenis'] = $this->view_jenis_m->get(1);
        $data['np'] = $this->nota_penerimaan_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'kode_kelompok' => substr($kode, 0, 1),
                'kode_jenis' => substr($kode, 1, 1)
            ];
            $this->nota_penerimaan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('nota-penerimaan');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->nota_penerimaan_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan');
    }

    public function detail($nota_penerimaan_id = null, $kode_nota = null)
    {
        if (!isset($nota_penerimaan_id)) show_404();

        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/detail/' . $nota_penerimaan_id . '/' . $kode_nota . '');
        $config['total_rows'] = $this->penerimaan_m->countPerNota($nota_penerimaan_id);
        $config['per_page'] = 10;
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
        $this->load->view('nota_penerimaan/detail', $data);
        $this->load->view('template/footer');
    }

    public function create_detail($nota_penerimaan_id = null, $kode_nota = null)
    {
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/create-detail/' . $nota_penerimaan_id . '/' . $kode_nota . '');
        $config['total_rows'] = $this->penerimaan_m->countAll($kode_nota);
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
            $data['penerimaan'] = $this->penerimaan_m->findAll($name, $kode_nota);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getAll($limit, $offset, $kode_nota);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/create_detail', $data);
        $this->load->view('template/footer');
    }

    public function pilih($id, $nota_penerimaan_id, $kode_nota)
    {
        if (!isset($nota_penerimaan_id)) show_404();

        $this->penerimaan_m->update(['nota_penerimaan_id' => $nota_penerimaan_id], $id);
        $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
        $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('nota-penerimaan/detail/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }

    public function delete_detail($id, $nota_penerimaan_id, $kode_nota)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->update(['nota_penerimaan_id' => null], $id)) {
            $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
            $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan/detail/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }
}
