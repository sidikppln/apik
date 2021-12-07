<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian_piutang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rincian_piutang_model', 'rincian_piutang_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('rincian-piutang/index');
        $config['total_rows'] = $this->rincian_piutang_m->count();
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
            $data['rincian_piutang'] = $this->rincian_piutang_m->find($name);
        } else {
            $data['rincian_piutang'] = $this->rincian_piutang_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_piutang/index', $data);
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
            'label' => 'nama',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'hak_pp',
            'label' => 'hak_pp',
            'rules' => 'numeric'
        ],
        [
            'field' => 'biad_ppn',
            'label' => 'biad_ppn',
            'rules' => 'numeric'
        ],
        [
            'field' => 'lebih',
            'label' => 'lebih',
            'rules' => 'numeric'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'hak_pp' => htmlspecialchars($this->input->post('hak_pp', true)),
                'biad_ppn' => htmlspecialchars($this->input->post('biad_ppn', true)),
                'lebih' => htmlspecialchars($this->input->post('lebih', true))
            ];
            $this->rincian_piutang_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('rincian-piutang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_piutang/create');
        $this->load->view('template/footer');
    }

    public function update($id = null)
    {
        if (!isset($id)) show_404();

        $data['rincian_piutang'] = $this->rincian_piutang_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'hak_pp' => htmlspecialchars($this->input->post('hak_pp', true)),
                'biad_ppn' => htmlspecialchars($this->input->post('biad_ppn', true)),
                'lebih' => htmlspecialchars($this->input->post('lebih', true))
            ];
            $this->rincian_piutang_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('rincian-piutang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_piutang/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->rincian_piutang_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('rincian-piutang');
    }

    public function detail($id = null)
    {
        if (!isset($id)) show_404();

        $data['rincian_piutang'] = $this->rincian_piutang_m->getDetail($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_piutang/detail', $data);
        $this->load->view('template/footer');
    }
}
