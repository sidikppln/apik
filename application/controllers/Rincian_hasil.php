<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian_hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_lelang_model', 'lelang_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('rincian-hasil/index');
        $config['total_rows'] = $this->lelang_m->count();
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
            $data['lelang'] = $this->lelang_m->find($name);
        } else {
            $data['lelang'] = $this->lelang_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_hasil/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode Lelang',
            'rules' => 'required|trim|exact_length[6]'
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
                'pnbp' => htmlspecialchars($this->input->post('pnbp', true)),
                'pph' => htmlspecialchars($this->input->post('pph', true)),
                'bersih' => htmlspecialchars($this->input->post('bersih', true))
            ];
            $this->lelang_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('rincian-hasil');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_hasil/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['lelang'] = $this->lelang_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'pnbp' => htmlspecialchars($this->input->post('pnbp', true)),
                'pph' => htmlspecialchars($this->input->post('pph', true)),
                'bersih' => htmlspecialchars($this->input->post('bersih', true))
            ];
            $this->lelang_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('rincian-hasil');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_hasil/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->lelang_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('rincian-hasil');
    }
}
