<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_lelang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rincian_lelang_model', 'rincian_lelang_m');
        $this->load->model('Data_pengeluaran_model', 'pengeluaran_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Ref_satker_model', 'ref_satker_m');
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
        $this->load->view('pengeluaran_lelang/index', $data);
        $this->load->view('template/footer');
    }

    // public function create()
    // {
    //     $validation = $this->form_validation->set_rules($this->rules);

    //     if ($validation->run()) {
    //         $data = [
    //             'kode' => htmlspecialchars($this->input->post('kode', true)),
    //             'nama' => htmlspecialchars($this->input->post('nama', true)),
    //             'pokok' => htmlspecialchars($this->input->post('pokok', true)),
    //             'hasil_bersih' => htmlspecialchars($this->input->post('hasil_bersih', true)),
    //             'bea_pembeli' => htmlspecialchars($this->input->post('bea_pembeli', true)),
    //             'bea_penjual' => htmlspecialchars($this->input->post('bea_penjual', true)),
    //             'bea_batal' => htmlspecialchars($this->input->post('bea_batal', true)),
    //             'pph_final' => htmlspecialchars($this->input->post('pph_final', true)),
    //             'ujl_wanprestasi' => htmlspecialchars($this->input->post('ujl_wanprestasi', true))

    //         ];
    //         $this->rincian_lelang_m->create($data);
    //         $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
    //         redirect('rincian-lelang');
    //     }

    //     $this->load->view('template/header');
    //     $this->load->view('template/sidebar');
    //     $this->load->view('rincian_lelang/create');
    //     $this->load->view('template/footer');
    // }

    // public function update($id = null)
    // {
    //     if (!isset($id)) show_404();

    //     $data['rincian_lelang'] = $this->rincian_lelang_m->getDetail($id);
    //     $validation = $this->form_validation->set_rules($this->rules);

    //     if ($validation->run()) {
    //         $data = [
    //             'kode' => htmlspecialchars($this->input->post('kode', true)),
    //             'nama' => htmlspecialchars($this->input->post('nama', true)),
    //             'pokok' => htmlspecialchars($this->input->post('pokok', true)),
    //             'hasil_bersih' => htmlspecialchars($this->input->post('hasil_bersih', true)),
    //             'bea_pembeli' => htmlspecialchars($this->input->post('bea_pembeli', true)),
    //             'bea_penjual' => htmlspecialchars($this->input->post('bea_penjual', true)),
    //             'bea_batal' => htmlspecialchars($this->input->post('bea_batal', true)),
    //             'pph_final' => htmlspecialchars($this->input->post('pph_final', true)),
    //             'ujl_wanprestasi' => htmlspecialchars($this->input->post('ujl_wanprestasi', true))
    //         ];
    //         $this->rincian_lelang_m->update($data, $id);
    //         $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
    //         redirect('rincian-lelang');
    //     }

    //     $this->load->view('template/header');
    //     $this->load->view('template/sidebar');
    //     $this->load->view('rincian_lelang/update', $data);
    //     $this->load->view('template/footer');
    // }

    // public function delete($id = null)
    // {
    //     if (!isset($id)) show_404();

    //     if ($this->rincian_lelang_m->delete($id)) {
    //         $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
    //     }
    //     redirect('rincian-lelang');
    // }

    public function detail($id = null)
    {
        if (!isset($id)) show_404();

        $data['rincian_lelang'] = $this->rincian_lelang_m->getDetail($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengeluaran_lelang/detail', $data);
        $this->load->view('template/footer');
    }

    public function pengembalian_ujl($id = null)
    {
        if (!isset($id)) show_404();
        $kdsatker = $this->session->userdata('kdsatker');

        $lelang = $this->rincian_lelang_m->getDetail($id);
        $jml_peserta = $lelang['jml_peserta'];
        $ujl = $lelang['ujl'];

        $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
        $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
        $data = [
            'tanggal' => time(),
            'kdsatker' => $kdsatker,
            'tahun' => $this->session->userdata('tahun'),
            'kode_kelompok' => '1',
            'kode_jenis' => '03',
            'no_urut' => $no_urut,
            'kredit' => ($jml_peserta - 1) * $ujl,
            'virtual_account' => '',
            'kode_lelang' => '',
            'penerimaan_id' => $id,
            'nota_pengeluaran_id' => 1
        ];

        if ($this->pengeluaran_m->create($data)) {
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
        }
        redirect('pengeluaran-lelang/detail/' . $id . '');
    }

    public function hasil_bersih($id = null)
    {
        if (!isset($id)) show_404();
        $kdsatker = $this->session->userdata('kdsatker');

        $lelang = $this->rincian_lelang_m->getDetail($id);
        $hasil_bersih = $lelang['hasil_bersih'];

        $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
        $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
        $data = [
            'tanggal' => time(),
            'kdsatker' => $kdsatker,
            'tahun' => $this->session->userdata('tahun'),
            'kode_kelompok' => '1',
            'kode_jenis' => '04',
            'no_urut' => $no_urut,
            'kredit' => $hasil_bersih,
            'virtual_account' => '',
            'kode_lelang' => '',
            'penerimaan_id' => $id,
            'nota_pengeluaran_id' => 1
        ];

        if ($this->pengeluaran_m->create($data)) {
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
        }
        redirect('pengeluaran-lelang/detail/' . $id . '');
    }

    public function bea_lelang($id = null)
    {
        if (!isset($id)) show_404();
        $kdsatker = $this->session->userdata('kdsatker');

        $lelang = $this->rincian_lelang_m->getDetail($id);
        $bea_lelang = $lelang['bea_penjual'];

        $akun = [
            [
                'kode_kelompok' => '1',
                'kode_jenis' => '05',
                'status' => 'kredit'
            ],
            [
                'kode_kelompok' => '1',
                'kode_jenis' => '06',
                'status' => 'kredit'
            ],
            [
                'kode_kelompok' => '2',
                'kode_jenis' => '01',
                'status' => 'debet'
            ],
            [
                'kode_kelompok' => '2',
                'kode_jenis' => '02',
                'status' => 'kredit'
            ],
            [
                'kode_kelompok' => '2',
                'kode_jenis' => '03',
                'status' => 'debet'
            ],
            [
                'kode_kelompok' => '2',
                'kode_jenis' => '04',
                'status' => 'kredit'
            ]
        ];

        foreach ($akun as $r) {
            if ($r['status'] == 'debet') {
                $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
                $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
                $data = [
                    'tanggal' => time(),
                    'kdsatker' => $kdsatker,
                    'tahun' => $this->session->userdata('tahun'),
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $no_urut,
                    'debet' => $bea_lelang,
                    'virtual_account' => '',
                    'nota_penerimaan_id' => 1
                ];
                $this->penerimaan_m->create($data);
                $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            } else {
                $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
                $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
                $data = [
                    'tanggal' => time(),
                    'kdsatker' => $kdsatker,
                    'tahun' => $this->session->userdata('tahun'),
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $no_urut,
                    'kredit' => $bea_lelang,
                    'virtual_account' => '',
                    'nota_pengeluaran_id' => 1
                ];
                $this->pengeluaran_m->create($data);
                $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            }
        }
        $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
        redirect('pengeluaran-lelang/detail/' . $id . '');
    }

    public function pph_final($id = null)
    {
        if (!isset($id)) show_404();
        $kdsatker = $this->session->userdata('kdsatker');

        $lelang = $this->rincian_lelang_m->getDetail($id);
        $pph_final = $lelang['pph_final'];

        $akun = [
            [
                'kode_kelompok' => '1',
                'kode_jenis' => '07',
                'status' => 'kredit'
            ],
            [
                'kode_kelompok' => '3',
                'kode_jenis' => '01',
                'status' => 'debet'
            ],
            [
                'kode_kelompok' => '3',
                'kode_jenis' => '02',
                'status' => 'kredit'
            ]
        ];
        foreach ($akun as $r) {
            if ($r['status'] == 'debet') {
                $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
                $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
                $data = [
                    'tanggal' => time(),
                    'kdsatker' => $kdsatker,
                    'tahun' => $this->session->userdata('tahun'),
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $no_urut,
                    'debet' => $pph_final,
                    'virtual_account' => '',
                    'nota_penerimaan_id' => 1
                ];
                $this->penerimaan_m->create($data);
                $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            } else {
                $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
                $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
                $data = [
                    'tanggal' => time(),
                    'kdsatker' => $kdsatker,
                    'tahun' => $this->session->userdata('tahun'),
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $no_urut,
                    'kredit' => $pph_final,
                    'virtual_account' => '',
                    'nota_pengeluaran_id' => 1
                ];
                $this->pengeluaran_m->create($data);
                $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            }
        }
        $this->session->set_flashdata('pesan', 'Data berhasil diproses.');
        redirect('pengeluaran-lelang/detail/' . $id . '');
    }
}
