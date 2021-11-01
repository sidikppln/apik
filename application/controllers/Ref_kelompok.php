<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_kelompok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_kelompok_model', 'ref_kelompok_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('ref-kelompok/index');
        $config['total_rows'] = $this->ref_kelompok_m->count();
        $config['per_page'] = 10;
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
            $data['ref_kelompok'] = $this->ref_kelompok_m->find($name);
        } else {
            $data['ref_kelompok'] = $this->ref_kelompok_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_kelompok/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'nama',
            'label' => 'nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->ref_kelompok_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('ref-kelompok');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_kelompok/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['ref_kelompok'] = $this->ref_kelompok_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->ref_kelompok_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('ref-kelompok');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_kelompok/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->ref_kelompok_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('ref-kelompok');
    }
}
