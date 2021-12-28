<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('System_menu_model', 'sys_menu_m');
        $this->load->model('System_sub_menu_model', 'sys_sub_menu_m');
        $this->load->model('System_sub_sub_menu_model', 'sys_sub_sub_menu_m');
        $this->load->model('System_sub_sub_sub_menu_model', 'sys_sub_sub_sub_menu_m');
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

    public function submenu($menu_id = null)
    {
        $data['menu_id'] = $menu_id;

        // setting halaman
        $config['base_url'] = base_url('menu/submenu/' . $menu_id . '');
        $config['total_rows'] = $this->sys_sub_menu_m->count($menu_id);
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
            $data['sub_menu'] = $this->sys_sub_menu_m->find($name, $menu_id);
        } else {
            $data['sub_menu'] = $this->sys_sub_menu_m->get($limit, $offset, $menu_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/submenu', $data);
        $this->load->view('template/footer');
    }

    public function create_submenu($menu_id = null)
    {
        $data['menu_id'] = $menu_id;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id
            ];
            $this->sys_sub_menu_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('menu/submenu/' . $menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/create_submenu', $data);
        $this->load->view('template/footer');
    }

    public function update_submenu($id, $menu_id)
    {
        if (!isset($id)) show_404();

        $data['menu_id'] = $menu_id;
        $data['sub_menu'] = $this->sys_sub_menu_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id
            ];
            $this->sys_sub_menu_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('menu/submenu/' . $menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/update_submenu', $data);
        $this->load->view('template/footer');
    }

    public function delete_submenu($id, $menu_id)
    {
        if (!isset($id)) show_404();

        if ($this->sys_sub_menu_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('menu/submenu/' . $menu_id . '');
    }

    public function subsubmenu($menu_id = null, $sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;

        // setting halaman
        $config['base_url'] = base_url('menu/subsubmenu/' . $menu_id . '/' . $sub_menu_id . '/a');
        $config['total_rows'] = $this->sys_sub_sub_menu_m->count($sub_menu_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->find($name, $sub_menu_id);
        } else {
            $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->get($limit, $offset, $sub_menu_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/subsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function create_subsubmenu($menu_id = null, $sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id
            ];
            $this->sys_sub_sub_menu_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('menu/subsubmenu/' . $menu_id . '/' . $sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/create_subsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function update_subsubmenu($id, $menu_id, $sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu'] = $this->sys_sub_sub_menu_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id
            ];
            $this->sys_sub_sub_menu_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('menu/subsubmenu/' . $menu_id . '/' . $sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/update_subsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function delete_subsubmenu($id, $menu_id, $sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->sys_sub_sub_menu_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('menu/subsubmenu/' . $menu_id . '/' . $sub_menu_id . '');
    }

    public function subsubsubmenu($menu_id = null, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;

        // setting halaman
        $config['base_url'] = base_url('menu/subsubsubmenu/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        $config['total_rows'] = $this->sys_sub_sub_sub_menu_m->count($sub_sub_menu_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->find($name, $sub_menu_id, $sub_sub_menu_id);
        } else {
            $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->get($limit, $offset, $sub_menu_id, $sub_sub_menu_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/subsubsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function create_subsubsubmenu($menu_id = null, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id,
                'sub_sub_menu_id' => $sub_sub_menu_id
            ];
            $this->sys_sub_sub_sub_menu_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('menu/subsubsubmenu/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/create_subsubsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function update_subsubsubmenu($id, $menu_id, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        $data['menu_id'] = $menu_id;
        $data['sub_menu_id'] = $sub_menu_id;
        $data['sub_sub_menu_id'] = $sub_sub_menu_id;
        $data['sub_sub_sub_menu'] = $this->sys_sub_sub_sub_menu_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'urutan' => htmlspecialchars($this->input->post('urutan', true)),
                'menu_id' => $menu_id,
                'sub_menu_id' => $sub_menu_id
            ];
            $this->sys_sub_sub_sub_menu_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('menu/subsubsubmenu/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('menu/update_subsubsubmenu', $data);
        $this->load->view('template/footer');
    }

    public function delete_subsubsubmenu($id, $menu_id, $sub_menu_id = null, $sub_sub_menu_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->sys_sub_sub_sub_menu_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('menu/subsubsubmenu/' . $menu_id . '/' . $sub_menu_id . '/' . $sub_sub_menu_id . '');
    }
}
