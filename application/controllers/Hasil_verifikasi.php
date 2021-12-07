<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_verifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_rekening_koran_model', 'rekening_koran_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('hasil-verifikasi/index');
        $config['total_rows'] = $this->penerimaan_m->count();
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
            $data['penerimaan'] = $this->penerimaan_m->find($name);
        } else {
            $data['penerimaan'] = $this->penerimaan_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('hasil_verifikasi/index', $data);
        $this->load->view('template/footer');
    }

    public function delete($id = null, $transaksi_bank_id = null)
    {
        if (!isset($id)) show_404();

        if ($this->penerimaan_m->delete($id)) {
            $this->rekening_koran_m->update(['status' => 0], $transaksi_bank_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('hasil-verifikasi/index');
    }
}
