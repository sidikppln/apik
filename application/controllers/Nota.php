<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Ref_nota_model', 'ref_nota_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('nota/index');
        $config['total_rows'] = $this->ref_nota_m->count();
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
            $data['nota'] = $this->ref_nota_m->find($name);
        } else {
            $data['nota'] = $this->ref_nota_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'kode',
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
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'kode_kelompok' => htmlspecialchars($this->input->post('kode_kelompok', true)),
                'kode_jenis' => htmlspecialchars($this->input->post('kode_jenis', true)),
                'status' => htmlspecialchars($this->input->post('status', true))
            ];
            $this->ref_nota_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['nota'] = $this->ref_nota_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'kode_kelompok' => htmlspecialchars($this->input->post('kode_kelompok', true)),
                'kode_jenis' => htmlspecialchars($this->input->post('kode_jenis', true)),
                'status' => htmlspecialchars($this->input->post('status', true))
            ];
            $this->ref_nota_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('nota');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->ref_nota_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota');
    }
}
