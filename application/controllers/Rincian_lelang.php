<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian_lelang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rincian_lelang_model', 'rincian_lelang_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('rincian-lelang/index');
        $config['total_rows'] = $this->rincian_lelang_m->count();
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
            $data['rincian_lelang'] = $this->rincian_lelang_m->find($name);
        } else {
            $data['rincian_lelang'] = $this->rincian_lelang_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_lelang/index', $data);
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
            'field' => 'pokok',
            'label' => 'pokok',
            'rules' => 'numeric'
        ],
        [
            'field' => 'hasil_bersih',
            'label' => 'hasil_bersih',
            'rules' => 'numeric'
        ],
        [
            'field' => 'bea_pembeli',
            'label' => 'bea_pembeli',
            'rules' => 'numeric'
        ],
        [
            'field' => 'bea_penjual',
            'label' => 'bea_penjual',
            'rules' => 'numeric'
        ],
        [
            'field' => 'bea_batal',
            'label' => 'bea_batal',
            'rules' => 'numeric'
        ],
        [
            'field' => 'pph_final',
            'label' => 'pph_final',
            'rules' => 'numeric'
        ],
        [
            'field' => 'ujl_wanprestasi',
            'label' => 'ujl_wanprestasi',
            'rules' => 'numeric'
        ],
        [
            'field' => 'jml_peserta',
            'label' => 'jml_peserta',
            'rules' => 'numeric'
        ],
        [
            'field' => 'ujl',
            'label' => 'ujl',
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
                'pokok' => htmlspecialchars($this->input->post('pokok', true)),
                'hasil_bersih' => htmlspecialchars($this->input->post('hasil_bersih', true)),
                'bea_pembeli' => htmlspecialchars($this->input->post('bea_pembeli', true)),
                'bea_penjual' => htmlspecialchars($this->input->post('bea_penjual', true)),
                'bea_batal' => htmlspecialchars($this->input->post('bea_batal', true)),
                'pph_final' => htmlspecialchars($this->input->post('pph_final', true)),
                'ujl_wanprestasi' => htmlspecialchars($this->input->post('ujl_wanprestasi', true)),
                'jml_peserta' => htmlspecialchars($this->input->post('jml_peserta', true)),
                'ujl' => htmlspecialchars($this->input->post('ujl', true))

            ];
            $this->rincian_lelang_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('rincian-lelang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_lelang/create');
        $this->load->view('template/footer');
    }

    public function update($id = null)
    {
        if (!isset($id)) show_404();

        $data['rincian_lelang'] = $this->rincian_lelang_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'pokok' => htmlspecialchars($this->input->post('pokok', true)),
                'hasil_bersih' => htmlspecialchars($this->input->post('hasil_bersih', true)),
                'bea_pembeli' => htmlspecialchars($this->input->post('bea_pembeli', true)),
                'bea_penjual' => htmlspecialchars($this->input->post('bea_penjual', true)),
                'bea_batal' => htmlspecialchars($this->input->post('bea_batal', true)),
                'pph_final' => htmlspecialchars($this->input->post('pph_final', true)),
                'ujl_wanprestasi' => htmlspecialchars($this->input->post('ujl_wanprestasi', true)),
                'jml_peserta' => htmlspecialchars($this->input->post('jml_peserta', true)),
                'ujl' => htmlspecialchars($this->input->post('ujl', true))
            ];
            $this->rincian_lelang_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('rincian-lelang');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_lelang/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->rincian_lelang_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('rincian-lelang');
    }

    public function detail($id = null)
    {
        if (!isset($id)) show_404();

        $data['rincian_lelang'] = $this->rincian_lelang_m->getDetail($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rincian_lelang/detail', $data);
        $this->load->view('template/footer');
    }
}
