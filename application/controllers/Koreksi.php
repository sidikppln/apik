<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koreksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_koreksi_model', 'koreksi_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('koreksi/index');
        $config['total_rows'] = $this->koreksi_m->count();
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
            $data['koreksi'] = $this->koreksi_m->find($name);
        } else {
            $data['koreksi'] = $this->koreksi_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('koreksi/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode',
            'rules' => 'required|trim|exact_length[6]'
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
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'debet' => htmlspecialchars($this->input->post('debet', true)),
                'kredit' => htmlspecialchars($this->input->post('kredit', true))
            ];
            $this->koreksi_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('koreksi');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('koreksi/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['koreksi'] = $this->koreksi_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'debet' => htmlspecialchars($this->input->post('debet', true)),
                'kredit' => htmlspecialchars($this->input->post('kredit', true))
            ];
            $this->koreksi_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('koreksi');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('koreksi/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->koreksi_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('koreksi');
    }
}
