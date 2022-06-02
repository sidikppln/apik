<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_aktivitas_model', 'aktivitas_m');
        $this->load->model('Ref_jenis_aktivitas_model', 'jenis_aktivitas_m');
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

    public function index($jenis_aktivitas = 1)
    {
        $status = 0;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['ref_jenis_aktivitas'] = $this->aktivitas_m->getJenisAktivitas($status);

        // setting halaman
        $config['base_url'] = base_url('aktivitas/index/' . $jenis_aktivitas . '');
        $config['total_rows'] = $this->aktivitas_m->count($jenis_aktivitas, $status);
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
            $data['aktivitas'] = $this->aktivitas_m->find($name, $jenis_aktivitas, $status);
        } else {
            $data['aktivitas'] = $this->aktivitas_m->get($limit, $offset, $jenis_aktivitas, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/index', $data);
        $this->load->view('template/footer');
    }

    public function create()
    {
        $data['ref_jenis_aktivitas'] = $this->jenis_aktivitas_m->get();

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kdsatker' => kdsatker(),
                'tahun' => tahun(),
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis_aktivitas' => htmlspecialchars($this->input->post('jenis_aktivitas', true))
            ];
            $this->aktivitas_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('aktivitas');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis_aktivitas = 1, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['ref_jenis_aktivitas'] = $this->jenis_aktivitas_m->get();
        $data['aktivitas'] = $this->aktivitas_m->getDetail($id);

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kode' => htmlspecialchars($this->input->post('kode', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'jenis_aktivitas' => htmlspecialchars($this->input->post('jenis_aktivitas', true))
            ];
            $this->aktivitas_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('aktivitas/index/' . $jenis_aktivitas . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis_aktivitas = 0, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->aktivitas_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('aktivitas/index/' . $jenis_aktivitas . '');
    }

    public function detail($jenis_aktivitas = 0, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['id'] = $id;
        $data['aktivitas'] = $this->aktivitas_m->getDetail($id);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        if ($jenis_aktivitas == 1) {
            $this->load->view('aktivitas/detail_lelang', $data);
        } else if ($jenis_aktivitas == 2) {
            $this->load->view('aktivitas/detail_piutang', $data);
        } else {
            $this->load->view('aktivitas/detail_lainnya', $data);
        }
        $this->load->view('template/footer');
    }

    public function update_lelang($jenis_aktivitas = 1, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['id'] = $id;
        $data['aktivitas'] = $this->aktivitas_m->getDetail($id);
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
            $this->aktivitas_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('aktivitas/detail/' . $jenis_aktivitas . '/' . $id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/update_lelang', $data);
        $this->load->view('template/footer');
    }

    // ini perubahan dana


    public function update_piutang($jenis_aktivitas = 1, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['id'] = $id;
        $data['aktivitas'] = $this->aktivitas_m->getDetail($id);
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
            $this->aktivitas_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('aktivitas/detail/' . $jenis_aktivitas . '/' . $id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/update_piutang', $data);
        $this->load->view('template/footer');
    }

    public function update_lainnya($jenis_aktivitas = 1, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['id'] = $id;
        $data['aktivitas'] = $this->aktivitas_m->getDetail($id);
        $rules = [
            [
                'field' => 'lainnya',
                'label' => 'lainnya',
                'rules' => 'numeric'
            ]
        ];
        $validation = $this->form_validation->set_rules($rules);
        if ($validation->run()) {
            $data = [
                'lainnya' => htmlspecialchars($this->input->post('lainnya', true))
            ];
            $this->aktivitas_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('aktivitas/detail/' . $jenis_aktivitas . '/' . $id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('aktivitas/update_lainnya', $data);
        $this->load->view('template/footer');
    }
}
