<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Ref_user_model', 'user_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('pengguna/index');
        $config['total_rows'] = $this->user_m->count();
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
            $data['pengguna'] = $this->user_m->find($name);
        } else {
            $data['pengguna'] = $this->user_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengguna/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'nip',
            'label' => 'NIP',
            'rules' => 'required|trim|exact_length[18]'
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
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),
                'date_created' => time()
            ];
            $this->user_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('pengguna');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengguna/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['pengguna'] = $this->user_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'password' => password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),
                'date_created' => time()
            ];
            $this->user_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('pengguna');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengguna/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->user_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('pengguna');
    }
}
