<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        $this->load->model('Data_lelang_model', 'lelang_m');
        $this->load->model('Data_transaksi_bank_model', 'transaksi_bank_m');
    }

    public function show($nota_penerimaan_id, $kode)
    {
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('penerimaan/index/' . $nota_penerimaan_id . '/' . $kode . '');
        $config['total_rows'] = $this->penerimaan_m->countPerNota($nota_penerimaan_id);
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
            $data['penerimaan'] = $this->penerimaan_m->findPerNota($name, $nota_penerimaan_id);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getPerNota($limit, $offset, $nota_penerimaan_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penerimaan/show', $data);
        $this->load->view('template/footer');
    }

    public function create($nota_penerimaan_id, $kode)
    {
        $data['nota_penerimaan_id'] = $nota_penerimaan_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('penerimaan/create/' . $nota_penerimaan_id . '/' . $kode . '/a');
        $config['total_rows'] = $this->penerimaan_m->countAll($kode);
        $config['per_page'] = 5;
        $config["num_links"] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
        $limit = $config["per_page"];
        $offset = $data['page'];

        // menangkap pencarian jika ada
        $name = $this->input->post('name');
        $data['name'] = $name;

        // pilih tampilan data, semua atau berdasarkan pencarian
        if ($name) {
            $data['penerimaan'] = $this->penerimaan_m->findAll($name, $kode);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getAll($limit, $offset, $kode);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penerimaan/create', $data);
        $this->load->view('template/footer');
    }

    public function pilih($id, $nota_penerimaan_id, $kode)
    {
        if (!isset($nota_penerimaan_id)) show_404();

        $kdsatker = $this->session->userdata('kdsatker');

        $data = [
            'nota_penerimaan_id' => $nota_penerimaan_id
        ];
        $this->penerimaan_m->update($data, $id);
        if ($kode === '121') {
            // update tabel data_lelang
            $pelunasan = $this->penerimaan_m->sumKredit($nota_penerimaan_id, $kode)['kredit'];
            $this->lelang_m->update(['pelunasan' => $pelunasan], $nota_penerimaan_id);
            $lelang = $this->lelang_m->getDetail($nota_penerimaan_id);
            $data_lelang = [
                'pnbp' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.020,
                'pph' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.025,
                'bersih' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.955
            ];
            $this->lelang_m->update($data_lelang, $nota_penerimaan_id);
            // pembuatan transaksi kekurangan hasil bersih
            $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
            $data_hasil_bersih = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => '1',
                'kode_jenis' => '2',
                'kode_sub_jenis' => '4',
                'no_urut' => $no_urut,
                'kredit' => $lelang['pelunasan'] - ($data_lelang['pnbp'] + $data_lelang['pph']),
                'virtual_account' => '',
                'kode_lelang' => $lelang['kode'],
                'transaksi_bank_id' => ''
            ];
            $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            $this->penerimaan_m->create($data_hasil_bersih);
            // pembuatan transaksi bea lelang
            $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
            $data_pnbp = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => '1',
                'kode_jenis' => '2',
                'kode_sub_jenis' => '5',
                'no_urut' => $no_urut,
                'kredit' => $data_lelang['pnbp'],
                'virtual_account' => '',
                'kode_lelang' => $lelang['kode'],
                'transaksi_bank_id' => ''
            ];
            $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            $this->penerimaan_m->create($data_pnbp);
            // pembuatan transaksi pph
            $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
            $data_pph = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => '1',
                'kode_jenis' => '2',
                'kode_sub_jenis' => '6',
                'no_urut' => $no_urut,
                'kredit' => $data_lelang['pph'],
                'virtual_account' => '',
                'kode_lelang' => $lelang['kode'],
                'transaksi_bank_id' => ''
            ];
            $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_penerimaan' => $no_urut_next], $kdsatker);
            $this->penerimaan_m->create($data_pph);
        } else {
            // update tabel data_nota_penerimaan
            $kredit = $this->penerimaan_m->sumKredit($nota_penerimaan_id)['kredit'];
            $this->nota_penerimaan_m->update(['kredit' => $kredit], $nota_penerimaan_id);
        }
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('penerimaan/show/' . $nota_penerimaan_id . '/' . $kode . '');
    }

    public function delete($id, $nota_penerimaan_id, $kode)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->update(['nota_penerimaan_id' => null], $id)) {
            if ($kode === '121') {
                $pelunasan = $this->penerimaan_m->sumKredit($nota_penerimaan_id)['kredit'];
                $this->lelang_m->update(['pelunasan' => $pelunasan], $nota_penerimaan_id);
                $lelang = $this->lelang_m->getDetail($nota_penerimaan_id);
                $data_lelang = [
                    'pnbp' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.020,
                    'pph' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.025,
                    'bersih' => ($lelang['jaminan'] + $lelang['pelunasan']) * 0.955
                ];
                $this->lelang_m->update($data_lelang, $nota_penerimaan_id);
            } else {
                $kredit = $this->penerimaan_m->sumKredit($nota_penerimaan_id)['kredit'];
                $this->nota_penerimaan_m->update(['kredit' => $kredit], $nota_penerimaan_id);
            }
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('penerimaan/show/' . $nota_penerimaan_id . '/' . $kode . '');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('penerimaan/index');
        $config['total_rows'] = $this->penerimaan_m->count();
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
            $data['penerimaan'] = $this->penerimaan_m->find($name);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penerimaan/index', $data);
        $this->load->view('template/footer');
    }

    public function true_delete($id = null, $transaksi_bank_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->delete($id)) {
            $this->transaksi_bank_m->update(['status' => 0], $transaksi_bank_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('penerimaan/index');
    }
}
