<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_pengeluaran_model', 'pengeluaran_m');
        $this->load->model('Data_nota_pengeluaran_model', 'nota_pengeluaran_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('nota-pengeluaran/index');
        $config['total_rows'] = $this->nota_pengeluaran_m->count();
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
            $data['nota_pengeluaran'] = $this->nota_pengeluaran_m->find($name);
        } else {
            $data['nota_pengeluaran'] = $this->nota_pengeluaran_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode Pengeluaran',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        $kdsatker = $this->session->userdata('kdsatker');
        $no_nota = NoNotaPengeluaran($kdsatker)['no_nota'];
        $no_nota_next = NoNotaPengeluaran($kdsatker)['no_nota_next'];
        $data['view_jenis'] = $this->view_jenis_m->get(2);

        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'nomor' => $no_nota,
                'tanggal' => time(),
                'kode_kelompok' => substr($kode, 0, 1),
                'kode_jenis' => substr($kode, 1, 1),
                'kode_sub_jenis' => substr($kode, 2, 1)
            ];
            $this->ref_satker_m->updateNoNotaPengeluaran(['no_nota_pengeluaran' => $no_nota_next], $kdsatker);
            $this->nota_pengeluaran_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-pengeluaran');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/create', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['view_jenis'] = $this->view_jenis_m->get(1);
        $data['np'] = $this->nota_pengeluaran_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'kode_kelompok' => substr($kode, 0, 1),
                'kode_jenis' => substr($kode, 1, 1),
                'kode_sub_jenis' => substr($kode, 2, 1)
            ];
            $this->nota_pengeluaran_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('nota-pengeluaran');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->nota_pengeluaran_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-pengeluaran');
    }
}
