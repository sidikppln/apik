<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contoh extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Contoh_model', 'contoh_m');
    }

    public function index()
    {
        $data['contoh'] = $this->contoh_m->get();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('contoh/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'nomor',
            'label' => 'Nomor',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->contoh_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('contoh');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('contoh/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['contoh'] = $this->contoh_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->contoh_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('contoh');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('contoh/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->contoh_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('contoh');
    }
}
