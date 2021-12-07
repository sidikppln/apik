<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rekening_koran_model', 'rekening_koran_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('verifikasi-penerimaan/index');
        $config['total_rows'] = $this->rekening_koran_m->countVerifikasiPenerimaan();
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
            $data['verifikasi_penerimaan'] = $this->rekening_koran_m->findVerifikasiPenerimaan($name);
        } else {
            $data['verifikasi_penerimaan'] = $this->rekening_koran_m->getVerifikasiPenerimaan($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi_penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'uraian',
            'label' => 'Uraian',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'debet',
            'label' => 'Debet',
            'rules' => 'required|numeric'
        ],
        [
            'field' => 'kredit',
            'label' => 'Kredit',
            'rules' => 'required|numeric'
        ]
    ];

    public function process($id)
    {
        if (!isset($id)) show_404();

        $kdsatker = $this->session->userdata('kdsatker');
        $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
        $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];

        $data['verifikasi_penerimaan'] = $this->rekening_koran_m->getDetail($id);
        $data['view_jenis'] = $this->view_jenis_m->getPenerimaan();
        $validation = $this->form_validation->set_rules('virtual_account', 'Virtual Account', 'trim');
        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr($kode, 0, 1),
                'kode_jenis' => substr($kode, 1, 2),
                'no_urut' => $no_urut,
                'debet' => (preg_replace("/[^0-9]/", "", $data['verifikasi_penerimaan']['kredit'])) / 100,
                'virtual_account' => htmlspecialchars($this->input->post('virtual_account', true)),
                'rekening_koran_id' => $id
            ];
            $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            $this->rekening_koran_m->update(['status' => 1], $id);
            $this->penerimaan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
            redirect('verifikasi-penerimaan');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi_penerimaan/process', $data);
        $this->load->view('template/footer');
    }
}
