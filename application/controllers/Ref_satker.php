<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_satker extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        // setting halaman
        $config['base_url'] = base_url('ref-satker/index');
        $config['total_rows'] = $this->ref_satker_m->count();
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
            $data['ref_satker'] = $this->ref_satker_m->find($name);
        } else {
            $data['ref_satker'] = $this->ref_satker_m->get($limit, $offset);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_satker/index', $data);
        $this->load->view('template/footer');
    }

    private $rules = [
        [
            'field' => 'kdsatker',
            'label' => 'Kode Satker',
            'rules' => 'required|trim|exact_length[6]'
        ],
        [
            'field' => 'nmsatker',
            'label' => 'Nama Satker',
            'rules' => 'required|trim'
        ]
    ];

    public function create()
    {
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kdsatker' => htmlspecialchars($this->input->post('kdsatker', true)),
                'nmsatker' => htmlspecialchars($this->input->post('nmsatker', true)),
                'no_urut_penerimaan' => htmlspecialchars($this->input->post('no_urut_penerimaan', true)),
                'no_nota_penerimaan' => htmlspecialchars($this->input->post('no_nota_penerimaan', true)),
                'no_urut_pengeluaran' => htmlspecialchars($this->input->post('no_urut_pengeluaran', true)),
                'no_nota_pengeluaran' => htmlspecialchars($this->input->post('no_nota_pengeluaran', true))
            ];
            $this->ref_satker_m->create($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah.');
            redirect('ref-satker');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_satker/create');
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        if (!isset($id)) show_404();

        $data['ref_satker'] = $this->ref_satker_m->getDetail($id);
        $validation = $this->form_validation->set_rules($this->rules);

        if ($validation->run()) {
            $data = [
                'kdsatker' => htmlspecialchars($this->input->post('kdsatker', true)),
                'nmsatker' => htmlspecialchars($this->input->post('nmsatker', true)),
                'no_urut_penerimaan' => htmlspecialchars($this->input->post('no_urut_penerimaan', true)),
                'no_nota_penerimaan' => htmlspecialchars($this->input->post('no_nota_penerimaan', true)),
                'no_urut_pengeluaran' => htmlspecialchars($this->input->post('no_urut_pengeluaran', true)),
                'no_nota_pengeluaran' => htmlspecialchars($this->input->post('no_nota_pengeluaran', true))
            ];
            $this->ref_satker_m->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil diubah.');
            redirect('ref-satker');
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('ref_satker/update', $data);
        $this->load->view('template/footer');
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->ref_satker_m->delete($id)) {
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        }
        redirect('ref-satker');
    }
}
