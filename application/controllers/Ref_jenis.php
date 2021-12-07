<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_jenis_model', 'ref_jenis_m');
    }

    public function index($ref_kelompok_id)
    {
        $data['ref_kelompok_id'] = $ref_kelompok_id;
        // setting halaman
        $config['base_url'] = base_url('ref-jenis/index/' . $ref_kelompok_id . '');
        $config['total_rows'] = $this->ref_jenis_m->count($ref_kelompok_id);
        $config['per_page'] = 10;
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
            $data['ref_jenis'] = $this->ref_jenis_m->find($name, $ref_kelompok_id);
        } else {
            $data['ref_jenis'] = $this->ref_jenis_m->get($limit, $offset, $ref_kelompok_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/index', $data);
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

    public function create($ref_kelompok_id)
    {
        $data['ref_kelompok_id'] = $ref_kelompok_id;
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'status' => htmlspecialchars($this->input->post('status', true)),
                'ref_kelompok_id' => $ref_kelompok_id
            ];
            $this->ref_jenis_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('ref-jenis/index/' . $ref_kelompok_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/create', $data);
        $this->load->view('template/footer');
    }

    public function update($id, $ref_kelompok_id)
    {
        if (!isset($id)) show_404();

        $data['ref_kelompok_id'] = $ref_kelompok_id;
        $data['ref_jenis'] = $this->ref_jenis_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'status' => htmlspecialchars($this->input->post('status', true)),
                'ref_kelompok_id' => $ref_kelompok_id
            ];
            $this->ref_jenis_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('ref-jenis/index/' . $ref_kelompok_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id, $ref_kelompok_id)
    {
        if (!isset($id)) show_404();

        if ($this->ref_jenis_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('ref-jenis/index/' . $ref_kelompok_id . '');
    }
}
