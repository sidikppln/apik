<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rekening_koran_model', 'rekening_koran_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
        $this->load->model('View_penerimaan_model', 'view_penerimaan_m');
    }

    public function index($jenis = 0)
    {
        $status = 0;
        $data['jenis'] = $jenis;

        // setting halaman
        $config['base_url'] = base_url('verifikasi/index/' . $jenis . '');
        $config['total_rows'] = $jenis == 0 ? $this->rekening_koran_m->count($status) : $this->view_penerimaan_m->count($status);
        $config['per_page'] = 10;
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
            $data['verifikasi'] = $jenis == 0 ? $this->rekening_koran_m->find($name, $status) : $this->view_penerimaan_m->find($name, $status);
        } else {
            $data['verifikasi'] = $jenis == 0 ? $this->rekening_koran_m->get($limit, $offset, $status) : $this->view_penerimaan_m->get($limit, $offset, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi/index', $data);
        $this->load->view('template/footer');
    }

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
            redirect('verifikasi/index/0');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi/process', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null, $transaksi_bank_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->delete($id)) {
            $this->rekening_koran_m->update(['status' => 0], $transaksi_bank_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('verifikasi/index/1');
    }
}
