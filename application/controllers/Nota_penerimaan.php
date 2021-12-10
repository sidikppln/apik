<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_kegiatan_model', 'kegiatan_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        $this->load->model('View_ref_nota_model', 'view_ref_nota_m');
        $this->load->model('View_penerimaan_model', 'view_penerimaan_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
    }

    public function index($jenis = 0)
    {
        $data['jenis'] = $jenis;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/index/' . $jenis . '');
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
        $this->load->view('nota_penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($jenis = 0, $kegiatan_id = null)
    {
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $status = 0;
        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/detail/' . $jenis . '/' . $kegiatan_id . '');
        $config['total_rows'] = $this->nota_penerimaan_m->count($kegiatan_id, $status);
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
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->find($name, $kegiatan_id, $status);
        } else {
            $data['nota_penerimaan'] = $this->nota_penerimaan_m->get($limit, $offset, $kegiatan_id, $status);
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

    public function create($jenis = 0, $kegiatan_id = null)
    {
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $kdsatker = $this->session->userdata('kdsatker');


        $no_nota = NoNotaPenerimaan($kdsatker)['no_nota'];
        $no_nota_next = NoNotaPenerimaan($kdsatker)['no_nota_next'];
        $data['ref_nota'] = $this->view_ref_nota_m->get('debet');

        $validation = $this->form_validation->set_rules($this->rules);
        if ($validation->run()) {
            $data = [
                'nomor' => $no_nota,
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true)),
                'kegiatan_id' =>  $kegiatan_id,
                'tanggal' => time()
            ];
            $this->ref_satker_m->updateNoNotaPenerimaan(['no_nota_penerimaan' => $no_nota_next], $kdsatker);
            $this->nota_penerimaan_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-penerimaan/detail/' . $jenis . '/' . $kegiatan_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis = 0, $kegiatan_id = null, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
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
            redirect('nota-penerimaan/detail/' . $jenis . '/' . $kegiatan_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis = 0, $kegiatan_id = null, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->nota_penerimaan_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan/detail/' . $jenis . '/' . $kegiatan_id . '');
    }

    public function transaksi($jenis = 0, $kegiatan_id = null, $nota_penerimaan_id = null, $kode_nota = null)
    {
        if (!isset($nota_penerimaan_id)) show_404();
        $status = 1;
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
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

    public function create_transaksi($jenis = 0, $kegiatan_id = null, $nota_penerimaan_id = null, $kode_nota = null)
    {
        $status = 0;
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-penerimaan/create-transaksi/' . $jenis . '/' . $kegiatan_id . '/'  . $nota_penerimaan_id . '/' . $kode_nota . '');
        $config['total_rows'] = $this->view_penerimaan_m->countPerKode($status, $kode_nota);
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
            $data['penerimaan'] = $this->view_penerimaan_m->findPerKode($name, $status, $kode_nota);
        } else {
            $data['penerimaan'] = $this->view_penerimaan_m->getPerKode($limit, $offset, $status, $kode_nota);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_penerimaan/create_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function pilih_transaksi($jenis = 0, $kegiatan_id = null, $nota_penerimaan_id = null, $kode_nota = null, $id = null)
    {
        if (!isset($id)) show_404();

        //khusus transaksi pelunasan
        if ($kode_nota == '02') {
            $penerimaan = $this->penerimaan_m->getDetail($id);
            $kegiatan = $this->kegiatan_m->getDetail($kegiatan_id);
            $bea_penjual = $kegiatan['bea_penjual'];
            $bea_pembeli = $kegiatan['bea_pembeli'];
            $pph_final = $kegiatan['pph_final'];
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
                    'status' => 1
                ];
                $this->penerimaan_m->create($data);
            }
            $this->penerimaan_m->delete($id);
        } else {
            $data = [
                'nota_penerimaan_id' => $nota_penerimaan_id,
                'status' => 1
            ];
            $this->penerimaan_m->update($data, $id);
        }

        $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
        $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('nota-penerimaan/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }

    public function delete_transaksi($jenis = 0, $kegiatan_id = null, $nota_penerimaan_id = null, $kode_nota = null, $id = null)
    {
        if (!isset($id)) show_404();
        $data = [
            'nota_penerimaan_id' => null,
            'status' => 0
        ];

        if ($this->penerimaan_m->update($data, $id)) {
            $debet = $this->penerimaan_m->sumDebet($nota_penerimaan_id)['debet'];
            $this->nota_penerimaan_m->update(['debet' => $debet], $nota_penerimaan_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-penerimaan/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_penerimaan_id . '/' . $kode_nota . '');
    }
}
