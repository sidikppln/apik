<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_pengeluaran_model', 'pengeluaran_m');
        $this->load->model('Data_nota_pengeluaran_model', 'nota_pengeluaran_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
        $this->load->model('Data_koreksi_model', 'koreksi_m');
    }

    public function show($nota_pengeluaran_id, $kode)
    {
        $data['nota_pengeluaran_id'] = $nota_pengeluaran_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('pengeluaran/index/' . $nota_pengeluaran_id . '/' . $kode . '');
        $config['total_rows'] = $this->pengeluaran_m->countPerNota($nota_pengeluaran_id);
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
            $data['pengeluaran'] = $this->pengeluaran_m->findPerNota($name, $nota_pengeluaran_id);
        } else {
            $data['pengeluaran'] = $this->pengeluaran_m->getPerNota($limit, $offset, $nota_pengeluaran_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengeluaran/show', $data);
        $this->load->view('template/footer');
    }

    public function create($nota_pengeluaran_id = null, $kode = null)
    {
        $data['nota_pengeluaran_id'] = $nota_pengeluaran_id;
        $data['kode'] = $kode;

        // setting halaman
        $config['base_url'] = base_url('pengeluaran/create/' . $nota_pengeluaran_id . '/' . $kode . '');
        $config['total_rows'] = $this->penerimaan_m->countForPengeluaran();
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
            $data['penerimaan'] = $this->penerimaan_m->findForPengeluaran($name);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->getForPengeluaran($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengeluaran/create', $data);
        $this->load->view('template/footer');
    }

    public function pilih($id, $nota_pengeluaran_id, $kode, $kode_balik)
    {
        if (!isset($nota_pengeluaran_id)) show_404();
        $kdsatker = $this->session->userdata('kdsatker');

        $kode_kontra = $this->view_jenis_m->getKontra($kode);
        // jika ujl dicatat sebagai hasil bersih lelang
        $kode_balik == '232' ? $kode_kontra = '237' : $kode_kontra = $kode_kontra;
        // jika ujl dicatat sebagai nota koreksi
        if ($kode_balik == '234') {
            $kode_kontra = '234';
            // pembuatan transaksi wanprestasi lelang - keluar
            $penerimaan = $this->penerimaan_m->getDetail($id);
            $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr($kode_kontra, 0, 1),
                'kode_jenis' => substr($kode_kontra, 1, 1),
                'kode_sub_jenis' => substr($kode_kontra, 2, 1),
                'no_urut' => $no_urut,
                'debet' => $penerimaan['kredit'],
                'virtual_account' => '',
                'kode_lelang' => $penerimaan['kode_lelang'],
                'penerimaan_id' => $id,
                'nota_pengeluaran_id' => $nota_pengeluaran_id
            ];
            $this->pengeluaran_m->create($data);
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            $this->penerimaan_m->update(['status' => 1], $id);
            // pembuatan transaksi koreksi pnbp - keluar
            $kode_kontra = '225';
            $koreksi = $this->koreksi_m->getDetail($nota_pengeluaran_id);
            $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr($kode_kontra, 0, 1),
                'kode_jenis' => substr($kode_kontra, 1, 1),
                'kode_sub_jenis' => substr($kode_kontra, 2, 1),
                'no_urut' => $no_urut,
                'debet' => $koreksi['debet'],
                'virtual_account' => '',
                'kode_lelang' => $penerimaan['kode_lelang'],
                'penerimaan_id' => $id,
                'nota_pengeluaran_id' => $nota_pengeluaran_id
            ];
            $this->pengeluaran_m->create($data);
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            // pembuatan transaksi koreksi pnbp - masuk
            $kode_kontra = '142';
            $koreksi = $this->koreksi_m->getDetail($nota_pengeluaran_id);
            $no_urut = NoUrutPenerimaan($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPenerimaan($kdsatker)['no_urut_next'];
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr($kode_kontra, 0, 1),
                'kode_jenis' => substr($kode_kontra, 1, 1),
                'kode_sub_jenis' => substr($kode_kontra, 2, 1),
                'no_urut' => $no_urut,
                'kredit' => $koreksi['kredit'],
                'virtual_account' => '',
                'kode_lelang' => $penerimaan['kode_lelang'],
                'transaksi_bank_id' => '',
                'nota_penerimaan_id' => $nota_pengeluaran_id
            ];
            $this->penerimaan_m->create($data);
            $this->ref_satker_m->updateNoUrutPenerimaan(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
        } else {
            $penerimaan = $this->penerimaan_m->getDetail($id);
            $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr($kode_kontra, 0, 1),
                'kode_jenis' => substr($kode_kontra, 1, 1),
                'kode_sub_jenis' => substr($kode_kontra, 2, 1),
                'no_urut' => $no_urut,
                'debet' => $penerimaan['kredit'],
                'virtual_account' => '',
                'kode_lelang' => $penerimaan['kode_lelang'],
                'penerimaan_id' => $id,
                'nota_pengeluaran_id' => $nota_pengeluaran_id
            ];
            $this->pengeluaran_m->create($data);
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            $this->penerimaan_m->update(['status' => 1], $id);
        }

        // update tabel data_nota_pengeluaran
        $debet = $this->pengeluaran_m->sumDebet($nota_pengeluaran_id)['debet'];
        $this->nota_pengeluaran_m->update(['debet' => $debet], $nota_pengeluaran_id);
        $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
        redirect('pengeluaran/show/' . $nota_pengeluaran_id . '/' . $kode_balik . '');
    }

    public function delete($id, $nota_pengeluaran_id, $kode, $penerimaan_id)
    {
        if (!isset($id)) show_404();

        if ($this->pengeluaran_m->delete($id)) {
            $this->penerimaan_m->update(['status' => 0], $penerimaan_id);
            // update tabel data_nota_pengeluaran
            $debet = $this->pengeluaran_m->sumDebet($nota_pengeluaran_id)['debet'];
            $this->nota_pengeluaran_m->update(['debet' => $debet], $nota_pengeluaran_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('pengeluaran/show/' . $nota_pengeluaran_id . '/' . $kode . '');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('pengeluaran/index');
        $config['total_rows'] = $this->pengeluaran_m->count();
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
            $data['pengeluaran'] = $this->pengeluaran_m->find($name);
        } else {
            $data['pengeluaran'] = $this->pengeluaran_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pengeluaran/index', $data);
        $this->load->view('template/footer');
    }

    public function true_delete($id = null, $penerimaan_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->pengeluaran_m->delete($id)) {
            $this->penerimaan_m->update(['status' => 0], $penerimaan_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('pengeluaran/index');
    }
}
