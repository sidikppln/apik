<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekening_Koran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_rekening_koran_model', 'rekening_koran_m');
        $this->load->model('View_jenis_model', 'view_jenis_m');
        $this->load->model('View_rekening_koran_model', 'view_rekening_koran_m');
        $this->load->model('Ref_bank_model', 'ref_bank_m');
    }

    public function index($kode_bank = 1)
    {
        $data['kode_bank'] = $kode_bank;
        $data['ref_bank'] = $this->view_rekening_koran_m->getKodeBank();

        // setting halaman
        $config['base_url'] = base_url('rekening-koran/index/' . $kode_bank . '');
        $config['total_rows'] = $this->view_rekening_koran_m->count($kode_bank);
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
            $data['view_rekening_koran'] = $this->view_rekening_koran_m->find($name, $kode_bank);
        } else {
            $data['view_rekening_koran'] = $this->view_rekening_koran_m->get($limit, $offset, $kode_bank);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rekening_koran/index', $data);
        $this->load->view('template/footer');
    }

    public function detail($tanggal = null, $kode_bank = 1)
    {
        $data['kode_bank'] = $kode_bank;

        // setting halaman
        $config['base_url'] = base_url('rekening-koran/detail/' . $tanggal . '/' . $kode_bank . '');
        $config['total_rows'] = $this->rekening_koran_m->countTanggal($tanggal, $kode_bank);
        $config['per_page'] = 10;
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
            $data['rekening_koran'] = $this->rekening_koran_m->findTanggal($tanggal, $kode_bank, $name);
        } else {
            $data['rekening_koran'] = $this->rekening_koran_m->getTanggal($tanggal, $kode_bank, $limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rekening_koran/detail', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'uraian',
            'label' => 'Uraian',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'debet',
            'label' => 'Debet',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'kredit',
            'label' => 'Kredit',
            'rules' => 'required|trim'
        ]
    ];

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->rekening_koran_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('rekening-koran');
    }

    public function import()
    {
        $data['ref_bank'] = $this->ref_bank_m->get();

        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file_csv']['name']) && in_array($_FILES['file_csv']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file_csv']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $reader->setDelimiter(",");
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file_csv']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 1; $i < count($sheetData); $i++) {
                $tanggal = $sheetData[$i]['0'];
                $uraian = $sheetData[$i]['4'];
                $debet = $sheetData[$i]['5'];
                $kredit = $sheetData[$i]['6'];
                $data = [
                    'kdsatker' => kdsatker(),
                    'tahun' => tahun(),
                    'kode_bank' => htmlspecialchars($this->input->post('kode_bank', true)),
                    'tanggal' => $tanggal,
                    'uraian' => $uraian,
                    'debet' => $debet,
                    'kredit' => $kredit
                ];
                $this->db->insert('data_rekening_koran', $data);
            }
            $this->session->set_flashdata('pesan', 'Data berhasil diimpor.');
            redirect('rekening-koran');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rekening_koran/import', $data);
        $this->load->view('template/footer');
    }
}
