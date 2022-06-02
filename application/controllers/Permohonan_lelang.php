<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permohonan_lelang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_permohonan_lelang_model', 'permohonan_lelang_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('permohonan-lelang/index');
        $config['total_rows'] = $this->permohonan_lelang_m->count();
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
            $data['permohonan_lelang'] = $this->permohonan_lelang_m->find($name);
        } else {
            $data['permohonan_lelang'] = $this->permohonan_lelang_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('permohonan_lelang/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'nomor',
            'label' => 'Nomor',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'nama_pemohon',
            'label' => 'Nama Pemohon',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'tanggal' => strtotime(htmlspecialchars($this->input->post('tanggal', true))),
                'nama_pemohon' => htmlspecialchars($this->input->post('nama_pemohon', true))
            ];
            $this->permohonan_lelang_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('permohonan-lelang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('permohonan_lelang/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['permohonan_lelang'] = $this->permohonan_lelang_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'tanggal' => strtotime(htmlspecialchars($this->input->post('tanggal', true))),
                'nama_pemohon' => htmlspecialchars($this->input->post('nama_pemohon', true))
            ];
            $this->permohonan_lelang_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('permohonan-lelang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('permohonan_lelang/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->permohonan_lelang_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('permohonan-lelang');
    }
}
