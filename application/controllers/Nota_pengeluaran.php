<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota_pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_kegiatan_model', 'kegiatan_m');
        $this->load->model('Data_nota_pengeluaran_model', 'nota_pengeluaran_m');
        $this->load->model('Data_pengeluaran_model', 'pengeluaran_m');
        $this->load->model('View_ref_nota_model', 'view_ref_nota_m');
        $this->load->model('View_pengeluaran_model', 'view_pengeluaran_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
    }

    public function index($jenis = 0)
    {
        $data['jenis'] = $jenis;

        // setting halaman
        $config['base_url'] = base_url('nota-pengeluaran/index/' . $jenis . '');
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
        $this->load->view('nota_pengeluaran/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($jenis = 0, $kegiatan_id = null)
    {
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $status = 0;
        // setting halaman
        $config['base_url'] = base_url('nota-pengeluaran/detail/' . $jenis . '/' . $kegiatan_id . '');
        $config['total_rows'] = $this->nota_pengeluaran_m->count($kegiatan_id, $status);
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
            $data['nota_pengeluaran'] = $this->nota_pengeluaran_m->find($name, $kegiatan_id, $status);
        } else {
            $data['nota_pengeluaran'] = $this->nota_pengeluaran_m->get($limit, $offset, $kegiatan_id, $status);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/detail', $data);
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


        $no_nota = NoNotaPengeluaran($kdsatker)['no_nota'];
        $no_nota_next = NoNotaPengeluaran($kdsatker)['no_nota_next'];
        $data['ref_nota'] = $this->view_ref_nota_m->get('kredit');

        $validation = $this->form_validation->set_rules($this->rules);
        if ($validation->run()) {
            $data = [
                'nomor' => $no_nota,
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true)),
                'kegiatan_id' =>  $kegiatan_id,
                'tanggal' => time()
            ];
            $this->ref_satker_m->updateNoNotaPengeluaran(['no_nota_pengeluaran' => $no_nota_next], $kdsatker);
            $this->nota_pengeluaran_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-pengeluaran/detail/' . $jenis . '/' . $kegiatan_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/create', $data);
        $this->load->view('template/footer');
    }

    public function update($jenis = 0, $kegiatan_id = null, $id = null)
    {
        if (!isset($id)) show_404();
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $data['ref_nota'] = $this->view_ref_nota_m->get('kredit');
        $data['np'] = $this->nota_pengeluaran_m->getDetail($id);

        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $kode = htmlspecialchars($this->input->post('kode', true));
            $data = [
                'kode_nota' =>  htmlspecialchars($this->input->post('kode', true))
            ];
            $this->nota_pengeluaran_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('nota-pengeluaran/detail/' . $jenis . '/' . $kegiatan_id . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($jenis = 0, $kegiatan_id = null, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->nota_pengeluaran_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-pengeluaran/detail/' . $jenis . '/' . $kegiatan_id . '');
    }

    public function transaksi($jenis = 0, $kegiatan_id = null, $nota_pengeluaran_id = null, $kode_nota = null)
    {
        if (!isset($nota_pengeluaran_id)) show_404();
        $status = 1;
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $data['nota_pengeluaran_id'] = $nota_pengeluaran_id;
        $data['kode_nota'] = $kode_nota;

        // setting halaman
        $config['base_url'] = base_url('nota-pengeluaran/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_pengeluaran_id . '/' . $kode_nota . '');
        $config['total_rows'] = $this->view_pengeluaran_m->count($status, $nota_pengeluaran_id);
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
            $data['pengeluaran'] = $this->view_pengeluaran_m->find($name, $status, $nota_pengeluaran_id,);
        } else {
            $data['pengeluaran'] = $this->view_pengeluaran_m->get($limit, $offset, $status, $nota_pengeluaran_id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/transaksi', $data);
        $this->load->view('template/footer');
    }

    public function create_transaksi($jenis = 0, $kegiatan_id = null, $nota_pengeluaran_id = null, $kode_nota = null)
    {
        $data['jenis'] = $jenis;
        $data['kegiatan_id'] = $kegiatan_id;
        $data['nota_pengeluaran_id'] = $nota_pengeluaran_id;
        $data['kode_nota'] = $kode_nota;
        $kdsatker = $this->session->userdata('kdsatker');
        $data['view_jenis'] = $this->view_jenis_m->getPerNota($kode_nota);
        $kegiatan = $this->kegiatan_m->getDetail($kegiatan_id);
        switch ($kode_nota) {
            case '05':
                $kredit = $kegiatan['ujl'] * ($kegiatan['jml_peserta'] - 1);
                break;
            case '06':
                $kredit = $kegiatan['hasil_bersih'];
                break;
            case '07':
                $kredit = $kegiatan['bea_penjual'];
                break;
            case '08':
                $kredit = $kegiatan['pph_final'];
                break;
            case '09':
                $kredit = $kegiatan['ujl_wanprestasi'];
                break;
            case '10':
                $kredit = $kegiatan['hak_pp'];
                break;
            case '11':
                $kredit = $kegiatan['biad_ppn'];
                break;
        }

        $validation = $this->form_validation->set_rules($this->rules);
        if ($validation->run()) {
            $no_urut = NoUrutPengeluaran($kdsatker)['no_urut'];
            $no_urut_next = NoUrutPengeluaran($kdsatker)['no_urut_next'];
            $data = [
                'tanggal' => time(),
                'kdsatker' => $kdsatker,
                'tahun' => $this->session->userdata('tahun'),
                'kode_kelompok' => substr(htmlspecialchars($this->input->post('kode', true)), 0, 1),
                'kode_jenis' => substr(htmlspecialchars($this->input->post('kode', true)), 1, 2),
                'no_urut' => $no_urut,
                'kredit' => $kredit,
                'nota_pengeluaran_id' => $nota_pengeluaran_id,
                'status' => 1
            ];
            $this->pengeluaran_m->create($data);
            $this->ref_satker_m->updateNoUrutPengeluaran(['no_urut_pengeluaran' => $no_urut_next], $kdsatker);
            $kredit = $this->pengeluaran_m->sumKredit($nota_pengeluaran_id)['kredit'];
            $this->nota_pengeluaran_m->update(['kredit' => $kredit], $nota_pengeluaran_id);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('nota-pengeluaran/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_pengeluaran_id . '/' . $kode_nota . '');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('nota_pengeluaran/create_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function delete_transaksi($jenis = 0, $kegiatan_id = null, $nota_pengeluaran_id = null, $kode_nota = null, $id = null)
    {
        if (!isset($id)) show_404();

        if ($this->pengeluaran_m->delete($id)) {
            $kredit = $this->pengeluaran_m->sumKredit($nota_pengeluaran_id)['kredit'];
            $this->nota_pengeluaran_m->update(['kredit' => $kredit], $nota_pengeluaran_id);
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('nota-pengeluaran/transaksi/' . $jenis . '/' . $kegiatan_id . '/' . $nota_pengeluaran_id . '/' . $kode_nota . '');
    }
}
