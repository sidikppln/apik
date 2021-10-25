<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_transaksi_bank extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Data_transaksi_bank_model', 'data_transaksi_bank_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('data-transaksi-bank/index');
        $config['total_rows'] = $this->data_transaksi_bank_m->count();
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['uraian'] = $uraian;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($uraian) {
            $data['transaksi_bank'] = $this->data_transaksi_bank_m->find($uraian);
        } else {
            $data['transaksi_bank'] = $this->data_transaksi_bank_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('data_transaksi_bank/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'nomor',
            'label' => 'Nomor',
            'rules' => 'required|trim|max_length[5]'
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
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->contoh_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('transaksi_bank');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('data_transaksi_bank/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['transaksi_bank'] = $this->contoh_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'nomor' => htmlspecialchars($this->input->post('nomor', true)),
                'uraian' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->contoh_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('contoh');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('data_transaksi_bank/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->contoh_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('data-transaksi-bank');
    }
}
