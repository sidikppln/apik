<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_bank extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_transaksi_bank_model', 'transaksi_bank_m');
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('transaksi-bank/index');
        $config['total_rows'] = $this->transaksi_bank_m->count();
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
            $data['transaksi_bank'] = $this->transaksi_bank_m->find($name);
        } else {
            $data['transaksi_bank'] = $this->transaksi_bank_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_bank/index', $data);
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
            'rules' => 'required|numeric'
        ],
        [
            'field' => 'kredit',
            'label' => 'Kredit',
            'rules' => 'required|numeric'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'uraian' => htmlspecialchars($this->input->post('uraian', true)),
                'debet' => htmlspecialchars($this->input->post('debet', true)),
                'kredit' => htmlspecialchars($this->input->post('kredit', true))
            ];
            $this->transaksi_bank_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('transaksi-bank');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_bank/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['transaksi_bank'] = $this->transaksi_bank_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'uraian' => htmlspecialchars($this->input->post('uraian', true)),
                'debet' => htmlspecialchars($this->input->post('debet', true)),
                'kredit' => htmlspecialchars($this->input->post('kredit', true))
            ];
            $this->transaksi_bank_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('transaksi_bank');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_bank/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->transaksi_bank_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('transaksi-bank');
    }

    public function import()
    {
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
                    'tanggal' => $tanggal,
                    'uraian' => $uraian,
                    'debet' => $debet,
                    'kredit' => $kredit
                ];
                $this->db->insert('data_transaksi_bank', $data);
            }
            $this->session->set_flashdata('pesan', 'Data berhasil diimpor.');
            redirect('transaksi_bank');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('transaksi_bank/import');
        $this->load->view('template/footer');
    }
}
