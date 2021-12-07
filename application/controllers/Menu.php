<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('System_menu_model', 'sys_menu_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('menu/index');
        $config['total_rows'] = $this->sys_menu_m->count();
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
            $data['menu'] = $this->sys_menu_m->find($name);
        } else {
            $data['menu'] = $this->sys_menu_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true))
            ];
            $this->sys_menu_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('menu');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['menu'] = $this->sys_menu_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true))
            ];
            $this->sys_menu_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('menu');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->sys_menu_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('menu');
    }
}
