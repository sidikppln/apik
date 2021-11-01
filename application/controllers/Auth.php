<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('nip')) {
      redirect('beranda');
    }

    $this->form_validation->set_rules('nip', 'NIP', 'required|trim|exact_length[18]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    if ($this->form_validation->run() == false) {
      $this->load->view('template/auth_header');
      $this->load->view('auth/login');
      $this->load->view('template/auth_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $nip = htmlspecialchars($this->input->post('nip'));
    $password = htmlspecialchars($this->input->post('password'));

    $user = $this->sys_user_m->getNip($nip);
    // jika usernya ada
    if ($user) {
      // cek password
      if (password_verify($password, $user['password'])) {
        $data = [
          'nip' => $user['nip'],
          'nama' => $user['nama'],
          'role_id' => $user['role_id'],
          'kdsatker' => $user['kdsatker'],
          'tahun' => date('Y')
        ];
        $this->session->set_userdata($data);
        redirect('beranda');
      } else {
        $this->session->set_flashdata('pesan', 'password Anda salah.');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('pesan', 'NIP Anda tidak terdaftar.');
      redirect('auth');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('nip');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('tahun');
    $this->session->sess_destroy();

    redirect('auth');
  }

  public function blocked()
  {
    $this->load->view('template/header');
    $this->load->view('template/sidebar');
    $this->load->view('auth/blocked');
    $this->load->view('template/footer');
  }

  public function blocked_all()
  {
    $this->load->view('auth/blocked_all');
  }
}
