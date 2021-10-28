<?php
defined('BASEPATH') or exit('No direct script akses allowed');

class Akses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('System_access_model', 'sys_access_m');
        $this->load->model('System_sub_sub_menu_model', 'sys_sub_sub_menu_m');
    }

    public function index($role_id)
    {
        $data['role_id'] = $role_id;

        // setting halaman
        $config['base_url'] = base_url('akses/index/' . $role_id . '');
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
        $this->load->view('akses/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'name',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create($role_id)
    {
        $data['role_id'] = $role_id;

        // setting halaman
        $config['base_url'] = base_url('akses/create/' . $role_id . '');
        $config['total_rows'] = $this->sys_sub_sub_menu_m->countAll();
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
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->findAll($name);
        } else {
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->getAll($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('akses/create', $data);
        $this->load->view('template/footer');
    }

    public function delete($id, $role_id)
    {
        if (!isset($id)) show_404();

        if ($this->sys_access_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('akses/index/' . $role_id . '');
    }

    public function pilih($sub_sub_menu_id, $role_id)
    {
        if (!isset($role_id)) show_404();

        $data = [
            'role_id' => $role_id,
            'sub_sub_menu_id' => $sub_sub_menu_id
        ];
        $this->sys_access_m->create($data);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('akses/index/' . $role_id . '');
    }
}
