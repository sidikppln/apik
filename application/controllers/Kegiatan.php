<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_kegiatan_model', 'kegiatan_m');
    }

    public function index($jenis = 0)
    {
        $data['jenis'] = $jenis;

        // setting halaman
        $config['base_url'] = base_url('kegiatan/index/' . $jenis . '');
        $config['total_rows'] = $this->kegiatan_m->count($jenis);
        $config['per_page'] = 5;
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
            $data['kegiatan'] = $this->kegiatan_m->find($name, $jenis);
        } else {
            $data['kegiatan'] = $this->kegiatan_m->get($limit, $offset, $jenis);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'kode',
            'rules' => 'required|trim|max_length[6]'
        ],
        [
            'field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required|trim'
        ]
    ];

    public function create($jenis = 0)
    {
        $data['jenis'] = $jenis;

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis' => $jenis
            ];
            $this->kegiatan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('kegiatan/index/' . $jenis . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;

        $data['kegiatan'] = $this->kegiatan_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true))
            ];
            $this->kegiatan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('kegiatan/index/' . $jenis . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->kegiatan_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('kegiatan/index/' . $jenis . '');
    }

    public function detail($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;
        $data['id'] = $id;
        $data['kegiatan'] = $this->kegiatan_m->getDetail($id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $jenis == 0 ? $this->load->view('kegiatan/detail_lelang', $data) : $this->load->view('kegiatan/detail_piutang', $data);
        $this->load->view('template/footer');
    }

    public function update_lelang($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;
        $data['id'] = $id;
        $data['kegiatan'] = $this->kegiatan_m->getDetail($id);
        $rules = [
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
        $validation = $this->form_validation->set_rules($rules);
        if ($validation->run()) {
            $data = [
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
            $this->kegiatan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('kegiatan/detail/' . $jenis . '/' . $id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/update_lelang', $data);
        $this->load->view('template/footer');
    }

    public function update_piutang($jenis = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;
        $data['id'] = $id;
        $data['kegiatan'] = $this->kegiatan_m->getDetail($id);
        $rules = [
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
        $validation = $this->form_validation->set_rules($rules);
        if ($validation->run()) {
            $data = [
                'hak_pp' => htmlspecialchars($this->input->post('hak_pp', true)),
                'biad_ppn' => htmlspecialchars($this->input->post('biad_ppn', true)),
                'lebih' => htmlspecialchars($this->input->post('lebih', true))
            ];
            $this->kegiatan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('kegiatan/detail/' . $jenis . '/' . $id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kegiatan/update_piutang', $data);
        $this->load->view('template/footer');
    }
}
