<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_aktivitas_model', 'aktivitas_m');
        $this->load->model('Data_rekening_koran_model', 'rekening_koran_m');
        $this->load->model('Data_penerimaan_model', 'penerimaan_m');
        $this->load->model('Data_nota_penerimaan_model', 'nota_penerimaan_m');
        $this->load->model('Data_nota_pengeluaran_model', 'nota_pengeluaran_m');
        $this->load->model('View_kas_umum_model', 'view_kas_umum_m');
        $this->load->model('View_nota_model', 'view_nota_m');
    }

    public function index()
    {
        $data['aktivitas'] = $this->aktivitas_m->getBeranda(0);
        $data['rekening_koran'] = $this->rekening_koran_m->getBeranda();
        $data['penerimaan'] = $this->penerimaan_m->getBeranda();
        $data['nota_penerimaan'] = $this->nota_penerimaan_m->getBeranda();
        $data['nota_pengeluaran'] = $this->nota_pengeluaran_m->getBeranda();
        $data['jenis_aktivitas'] = $this->view_kas_umum_m->getBerandaAktivitas();
        $data['kelompok'] = $this->view_kas_umum_m->getBerandaKelompok();
        $data['verifikasi'] = $this->view_nota_m->getBeranda(0);
        $data['pengesahan'] = $this->view_nota_m->getBeranda(1);
        $data['pemindahbukuan'] = $this->view_nota_m->getBeranda(2);
        $data['pencatatan'] = $this->view_nota_m->getBeranda(3);
        $data['arsip'] = $this->view_nota_m->getAll(10, 0, 4);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('beranda/index', $data);
        $this->load->view('template/footer');
    }

    public function efretz()
    {
        //ini perubahan efretz
    }
}
