<?php

defined('BASEPATH') or exit('No direct script access allowed');

// function is_logged_in()
// {
//   $ci = get_instance();
//   if (!$ci->session->userdata('nik')) {
//     redirect('auth');
//   } else {
//     $nik = $ci->session->userdata('nik');
//     $result = $ci->db->query("SELECT role_id FROM system_user WHERE nik='$nik'")->row_array();
//     $role_id = $result['role_id'];
//     $submenu = $ci->uri->segment(1);
//     $subsubmenu = $ci->uri->segment(1) . '/' . $ci->uri->segment(2);

//     $queryMenu = $ci->db->get_where('system_sub_menu', ['url' => $submenu])->row_array();
//     if ($queryMenu) {
//       $menu_id = $queryMenu['menu_id'];
//     } else {
//       $queryMenu = $ci->db->query("SELECT menu_id FROM system_sub_sub_menu WHERE url='$submenu' OR url='$subsubmenu'")->row_array();
//       $menu_id = $queryMenu['menu_id'];
//     }

//     $userAccess = $ci->db->get_where('system_access', [
//       'role_id' => $role_id,
//       'menu_id' => $menu_id
//     ]);

//     if ($userAccess->num_rows() < 1) {
//       redirect('auth/blocked');
//     }
//   }
// }

function is_logged_in()
{
  $ci = get_instance();
  if (!$ci->session->userdata('nip')) {
    redirect('auth');
  }
}


function tanggal($tgl)
{
  $bulan = date('m', $tgl);
  $daftar_bulan = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];
  $nama_bulan = $daftar_bulan[$bulan];
  return date('d', $tgl) . ' ' . $nama_bulan . ' ' . date('Y', $tgl);
}

function jam($tgl)
{
  return date('H:i', $tgl);
}

function hari($tgl)
{
  $hari = date('l', $tgl);
  $daftar_hari = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
  ];
  $nama_hari = $daftar_hari[$hari];
  return $nama_hari;
}

function bulan($tgl)
{
  $bulan = date('m', $tgl);
  $daftar_bulan = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];
  $nama_bulan = $daftar_bulan[$bulan];
  return $nama_bulan;
}
