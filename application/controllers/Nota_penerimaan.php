<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_aktivitas_model', 'aktivitas_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        $this->load->model('View_ref_nota_model', 'view_ref_nota_m');
        $this->load->model('View_penerimaan_model', 'view_penerimaan_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
    }

    public function index($jenis_aktivitas = 1)
    {
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['ref_jenis_aktivitas'] = $this->aktivitas_m->getJenisAktivitas();

        // setting halaman
        $config['base_url'] = base_url('aktivitas/index/' . $jenis_aktivitas . '');
        $config['total_rows'] = $this->aktivitas_m->count($jenis_aktivitas);
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
            $data['aktivitas'] = $this->aktivitas_m->find($name, $jenis_aktivitas);
        } else {
            $data['aktivitas'] = $this->aktivitas_m->get($limit, $offset, $jenis_aktivitas);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($jenis_aktivitas = 1, $aktivitas_id = null)
    {
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $status = 0;
        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
        $config['total_rows'] = $this->nota_penerimaan_m->count($aktivitas_id, $status);
        $config['per_page'] = 5;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->find($name, $aktivitas_id, $status);
        } else {
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->get($limit, $offset, $aktivitas_id, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/detail', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kode',
            'label' => 'Kode Penerimaan',
            'rules' => 'required|trim'
        ]
    ];

    public function create($jenis_aktivitas = 1, $aktivitas_id = null)
    {
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $kdsatker = $this->session->userdata('kdsatker');


        $no_nota = NoNotaPenerimaan($kdsatker)['no_nota'];
        $no_nota_next = NoNotaPenerimaan($kdsatker)['no_nota_next'];
        $data['ref_nota'] = $this->view_ref_nota_m->get('debet');

        $validation = $this->form_validation->set_rules($this->rules);
        if ($validation->run()) {
            $data = [
                'kdsatker' => kdsatker(),
                'tahun' => tahun(),
                'nomor' => $no_nota,
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true)),
                'aktivitas_id' =>  $aktivitas_id,
                'tanggal' => time()
            ];
            $this->ref_satker_m->updateNoNotaPenerimaan(['no_nota_penerimaan' => $no_nota_next], $kdsatker);
            $this->nota_penerimaan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis_aktivitas = 1, $aktivitas_id = null, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $data['ref_nota'] = $this->view_ref_nota_m->get('debet');
        $data['np'] = $this->nota_penerimaan_m->getDetail($id);

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true))
            ];
            $this->nota_penerimaan_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis_aktivitas = 0, $aktivitas_id = null, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->nota_penerimaan_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
    }

    public function transaksi($jenis_aktivitas = 1, $aktivitas_id = null, $nota_penerimaan_id = null, $kode_nota = null)
    {
        if (!isset($nota_penerimaan_id)) show_404();
        $status = 1;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/transaksi/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
        $config['total_rows'] = $this->view_penerimaan_m->count($status, $nota_penerimaan_id);
        $config['per_page'] = 10;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['penerimaan'] = $this->view_penerimaan_m->find($name, $status, $nota_penerimaan_id,);
        } else {
            $data['penerimaan'] = $this->view_penerimaan_m->get($limit, $offset, $status, $nota_penerimaan_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/transaksi', $data);
        $this->load->view('template/footer');
    }

    public function create_transaksi($jenis_aktivitas = 1, $aktivitas_id = null, $nota_penerimaan_id = null, $kode_nota = null)
    {
        $status = 0;
        $data['jenis_aktivitas'] = $jenis_aktivitas;
        $data['aktivitas_id'] = $aktivitas_id;
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/create-transaksi/' . $jenis_aktivitas . '/' . $aktivitas_id . '/'  . $nota_penerimaan_id . '/' . $kode_nota . '');
        if ($kode_nota == '01') {
            $config['total_rows'] = $this->view_penerimaan_m->countPerKodeUjl($kode_nota);
        } else {
            $config['total_rows'] = $this->view_penerimaan_m->countPerKode($status, $kode_nota);
        }
        $config['per_page'] = 5;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            if ($kode_nota == '01') {
                $data['penerimaan'] = $this->view_penerimaan_m->findPerKodeUjl($name, $kode_nota);
            } else {
                $data['penerimaan'] = $this->view_penerimaan_m->findPerKode($name, $status, $kode_nota);
            }
        } else {
            if ($kode_nota == '01') {
                $data['penerimaan'] = $this->view_penerimaan_m->getPerKodeUjl($limit, $offset, $kode_nota);
            } else {
                $data['penerimaan'] = $this->view_penerimaan_m->getPerKode($limit, $offset, $status, $kode_nota);
            }
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        if ($kode_nota == '01') {
            $this->load->view('nota_penerimaan/create_transaksi_ujl', $data);
        } else {
            $this->load->view('nota_penerimaan/create_transaksi', $data);
        }
        $this->load->view('template/footer');
    }

    public function pilih_transaksi($jenis_aktivitas = 1, $aktivitas_id = null, $nota_penerimaan_id = null, $kode_nota = null, $id = null)
    {
        if (!isset($id)) show_404();

        //khusus transaksi pelunasan
        if ($kode_nota == '02') {
            $penerimaan = $this->penerimaan_m->getDetail($id);
            $aktivitas = $this->aktivitas_m->getDetail($aktivitas_id);
            $bea_penjual = $aktivitas['bea_penjual'];
            $bea_pembeli = $aktivitas['bea_pembeli'];
            $pph_final = $aktivitas['pph_final'];
            $sisa = $penerimaan['debet'] - ($bea_penjual + $bea_pembeli + $pph_final);
            $transaksi = [
                [
                    'kode_kelompok' => '1',
                    'kode_jenis' => '02',
                    'debet' => $sisa
                ],
                [
                    'kode_kelompok' => '2',
                    'kode_jenis' => '01',
                    'debet' => $bea_penjual
                ],
                [
                    'kode_kelompok' => '2',
                    'kode_jenis' => '03',
                    'debet' => $bea_pembeli
                ],
                [
                    'kode_kelompok' => '3',
                    'kode_jenis' => '01',
                    'debet' => $pph_final
                ]
            ];
            foreach ($transaksi as $r) {
                $data = [
                    'tanggal' => $penerimaan['tanggal'],
                    'kdsatker' => $penerimaan['kdsatker'],
                    'tahun' => $penerimaan['tahun'],
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $penerimaan['no_urut'],
                    'debet' => $r['debet'],
                    'virtual_account' => $penerimaan['virtual_account'],
                    'rekening_koran_id' => $penerimaan['rekening_koran_id'],
                    'nota_penerimaan_id' => $nota_penerimaan_id,
                    'jenis_aktivitas' => $jenis_aktivitas,
                    'status' => 1
                ];
                $this->penerimaan_m->create($data);
            }
            $this->penerimaan_m->delete($id);
            //khusus transaksi setoran pn
        } else if ($kode_nota == '03') {
            $penerimaan = $this->penerimaan_m->getDetail($id);
            $hak_pp = $penerimaan['debet'] * 0.9;
            $biad = $penerimaan['debet'] * 0.1;
            $transaksi = [
                [
                    'kode_kelompok' => '1',
                    'kode_jenis' => '06',
                    'debet' => $hak_pp
                ],
                [
                    'kode_kelompok' => '2',
                    'kode_jenis' => '07',
                    'debet' => $biad
                ]
            ];
            foreach ($transaksi as $r) {
                $data = [
                    'tanggal' => $penerimaan['tanggal'],
                    'kdsatker' => $penerimaan['kdsatker'],
                    'tahun' => $penerimaan['tahun'],
                    'kode_kelompok' => $r['kode_kelompok'],
                    'kode_jenis' => $r['kode_jenis'],
                    'no_urut' => $penerimaan['no_urut'],
                    'debet' => $r['debet'],
                    'virtual_account' => $penerimaan['virtual_account'],
                    'rekening_koran_id' => $penerimaan['rekening_koran_id'],
                    'nota_penerimaan_id' => $nota_penerimaan_id,
                    'jenis_aktivitas' => $jenis_aktivitas,
                    'status' => 1
                ];
                $this->penerimaan_m->create($data);
            }
            $this->penerimaan_m->delete($id);
        } else {
            $data = [
                'nota_penerimaan_id' => $nota_penerimaan_id,
                'jenis_aktivitas' => $jenis_aktivitas,
                'status' => 1
            ];
            $this->penerimaan_m->update($data, $id);
        }

        $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
        $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('nota-penerimaan/transaksi/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }

    public function pilih_transaksi_ujl()
    {
        $nota_penerimaan_id = $this->input->post('nota_penerimaan_id');
        $id = $this->input->post('id');
        $result = $this->penerimaan_m->cekStatus($id, 1);
        if ($result) {
            $data = [
                'nota_penerimaan_id' => null,
                'jenis_aktivitas' => null,
                'status' => 0
            ];
        } else {
            $data = [
                'nota_penerimaan_id' => $nota_penerimaan_id,
                'jenis_aktivitas' => 1,
                'status' => 1
            ];
        }
        $this->penerimaan_m->update($data, $id);

        $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
        $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
    }

    public function pilih_semua_transaksi_ujl($jenis_aktivitas = 1, $aktivitas_id = null, $nota_penerimaan_id = null, $kode_nota = null)
    {
        $transaksi = $this->view_penerimaan_m->getPerKode(null, 0, 0, $kode_nota);
        foreach ($transaksi as $r) {
            $data = [
                'nota_penerimaan_id' => $nota_penerimaan_id,
                'jenis_aktivitas' => 1,
                'status' => 1
            ];
            $this->penerimaan_m->update($data, $r['id']);
        }

        $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
        $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('nota-penerimaan/create-transaksi/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }

    public function delete_transaksi($jenis_aktivitas = 0, $aktivitas_id = null, $nota_penerimaan_id = null, $kode_nota = null, $id = null)
    {
        if (!isset($id)) show_404();
        $data = [
            'nota_penerimaan_id' => null,
            'jenis_aktivitas' => null,
            'status' => 0
        ];

        if ($this->penerimaan_m->update($data, $id)) {
            $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
            $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan/transaksi/' . $jenis_aktivitas . '/' . $aktivitas_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }

    public function kirim($jenis_aktivitas = 0, $aktivitas_id = null, $id = null)
    {
        if (!isset($id)) show_404();

        $data = ['status' => 1];

        if ($this->nota_penerimaan_m->update($data, $id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dikirim.');
        }
        redirect('nota-penerimaan/detail/' . $jenis_aktivitas . '/' . $aktivitas_id . '');
    }
}
