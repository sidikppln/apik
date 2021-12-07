<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_kegiatan_model', 'kegiatan_m');
    }

    public function index($jenis = 0)
    {
        if (!isset($jenis)) $jenis = 0;
        $data['jenis'] = $jenis;

        // setting halaman
        $config['base_url'] = base_url('kegiatan/index/' . $jenis . '');
        $config['total_rows'] = $this->kegiatan_m->count($jenis);
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
            $data['kegiatan'] = $this->kegiatan_m->find($name, $jenis);
        } else {
            $data['kegiatan'] = $this->kegiatan_m->get($limit, $offset, $jenis);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'kode',
            'rules' => 'required|trim|max_length[6]'
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create($jenis = 0)
    {
        $data['jenis'] = $jenis;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis' => $jenis
            ];
            $this->kegiatan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('kegiatan/index/' . $jenis . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;

        $data['kegiatan'] = $this->kegiatan_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->kegiatan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('kegiatan/index/' . $jenis . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->kegiatan_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('kegiatan/index/' . $jenis . '');
    }
}
