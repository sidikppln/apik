<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('System_role_model', 'sys_role_m');
        $this->load->model('System_access_model', 'sys_access_m');
        $this->load->model('System_sub_sub_menu_model', 'sys_sub_sub_menu_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('role/index');
        $config['total_rows'] = $this->sys_role_m->count();
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
            $data['role'] = $this->sys_role_m->find($name);
        } else {
            $data['role'] = $this->sys_role_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('role/index', $data);
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
                'name' => htmlspecialchars($this->input->post('name', true))
            ];
            $this->sys_role_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('role');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('role/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['role'] = $this->sys_role_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true))
            ];
            $this->sys_role_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('role');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('role/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->sys_role_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('role');
    }

    public function detail($role_id = null)
    {
        if (!isset($role_id)) show_404();

        $data['role_id'] = $role_id;

        // setting halaman
        $config['base_url'] = base_url('role/detail/' . $role_id . '');
        $config['total_rows'] = $this->sys_access_m->count($role_id);
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
            $data['access'] = $this->sys_access_m->find($name, $role_id);
        } else {
            $data['access'] = $this->sys_access_m->get($limit, $offset, $role_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('role/detail', $data);
        $this->load->view('template/footer');
    }

    public function create_detail($role_id = null)
    {
        if (!isset($role_id)) show_404();
        $data['role_id'] = $role_id;

        // setting halaman
        $config['base_url'] = base_url('role/create-detail/' . $role_id . '');
        $config['total_rows'] = $this->sys_sub_sub_menu_m->countAll($role_id);
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
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->findAll($name, $role_id);
        } else {
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->getAll($limit, $offset, $role_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('role/create_detail', $data);
        $this->load->view('template/footer');
    }

    public function delete_detail($id, $role_id)
    {
        if (!isset($id)) show_404();

        if ($this->sys_access_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('role/detail/' . $role_id . '');
    }

    public function pilih_detail($sub_sub_menu_id, $role_id)
    {
        if (!isset($role_id)) show_404();

        $data = [
            'role_id' => $role_id,
            'sub_sub_menu_id' => $sub_sub_menu_id
        ];
        $this->sys_access_m->create($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('role/detail/' . $role_id . '');
    }
}
