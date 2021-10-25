<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_jenis_model', 'ref_jenis_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('ref-jenis/index');
        $config['total_rows'] = $this->ref_jenis_m->count();
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
            $data['ref_jenis'] = $this->ref_jenis_m->find($name);
        } else {
            $data['ref_jenis'] = $this->ref_jenis_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'nama_jenis',
            'label' => 'nama_jenis',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'id_kelompok',
            'label' => 'id_kelompok',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nama_jenis' => htmlspecialchars($this->input->post('nama_jenis', true)),
                'id_kelompok' => htmlspecialchars($this->input->post('id_kelompok', true))
            ];
            $this->ref_jenis_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('ref-jenis');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['ref_jenis'] = $this->ref_jenis_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nama_jenis' => htmlspecialchars($this->input->post('nama_jenis', true)),
                'id_kelompok' => htmlspecialchars($this->input->post('id_kelompok', true))
            ];
            $this->ref_jenis_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('ref-jenis');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_jenis/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->ref_jenis_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('ref-jenis');
    }
}
