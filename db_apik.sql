-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 21 Des 2021 pada 01.55
-- Versi server: 5.7.34
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_aktivitas`
--

CREATE TABLE `data_aktivitas` (
  `id` int(11) NOT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `kode` varchar(6) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `pokok` decimal(15,0) DEFAULT '0',
  `hasil_bersih` decimal(15,0) DEFAULT '0',
  `bea_pembeli` decimal(15,0) DEFAULT '0',
  `bea_penjual` decimal(15,0) DEFAULT '0',
  `bea_batal` decimal(15,0) DEFAULT '0',
  `pph_final` decimal(15,0) DEFAULT '0',
  `ujl_wanprestasi` decimal(15,0) DEFAULT '0',
  `jml_peserta` decimal(15,0) DEFAULT '0',
  `ujl` decimal(15,0) DEFAULT '0',
  `hak_pp` decimal(15,0) DEFAULT '0',
  `biad_ppn` decimal(15,0) DEFAULT '0',
  `lebih` decimal(15,0) DEFAULT '0',
  `lainnya` decimal(15,0) DEFAULT '0',
  `jenis_aktivitas` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_aktivitas`
--

INSERT INTO `data_aktivitas` (`id`, `kdsatker`, `tahun`, `kode`, `nama`, `pokok`, `hasil_bersih`, `bea_pembeli`, `bea_penjual`, `bea_batal`, `pph_final`, `ujl_wanprestasi`, `jml_peserta`, `ujl`, `hak_pp`, `biad_ppn`, `lebih`, `lainnya`, `jenis_aktivitas`, `status`) VALUES
(10, '537831', '2021', 'BTIGSD', 'Sebidang tanah seluas 148 m2 berikut bangunan diatasnya terletak di Kelurahan/Desa Pondok Karya, Kecamatan Pondok Aren, Kabupaten/Kotamadya Tangerang, Provinsi Jawa Barat, sesuai Sertifikat Hak Milk Nomor 02858/Pondok Karya atas nama Nona Tanti Novian (se', '881818188', '842136369', '17636364', '17636364', '0', '22045455', '0', '4', '160000000', '0', '0', '0', '0', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_contoh`
--

CREATE TABLE `data_contoh` (
  `id` int(11) NOT NULL,
  `nomor` int(5) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `data_contoh`
--

INSERT INTO `data_contoh` (`id`, `nomor`, `nama`) VALUES
(1, 3333, 'Budi'),
(3, 21212, 'hkhl'),
(4, 6666, 'Thjjaggd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nota_penerimaan`
--

CREATE TABLE `data_nota_penerimaan` (
  `id` int(11) NOT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `nomor` varchar(64) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `debet` decimal(15,2) DEFAULT NULL,
  `kode_nota` varchar(2) DEFAULT NULL,
  `aktivitas_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nota_pengeluaran`
--

CREATE TABLE `data_nota_pengeluaran` (
  `id` int(11) NOT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `nomor` varchar(64) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  `kode_nota` varchar(2) DEFAULT NULL,
  `aktivitas_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penerimaan`
--

CREATE TABLE `data_penerimaan` (
  `id` int(11) NOT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `kode_kelompok` varchar(1) DEFAULT NULL,
  `kode_jenis` varchar(2) DEFAULT NULL,
  `no_urut` varchar(5) DEFAULT NULL,
  `debet` decimal(15,2) DEFAULT NULL,
  `virtual_account` varchar(16) DEFAULT NULL,
  `rekening_koran_id` int(11) DEFAULT NULL,
  `nota_penerimaan_id` int(11) DEFAULT NULL,
  `jenis_aktivitas` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pengeluaran`
--

CREATE TABLE `data_pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `kode_kelompok` varchar(1) DEFAULT NULL,
  `kode_jenis` varchar(2) DEFAULT NULL,
  `no_urut` varchar(5) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  `nota_pengeluaran_id` int(11) DEFAULT NULL,
  `jenis_aktivitas` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_rekening_koran`
--

CREATE TABLE `data_rekening_koran` (
  `id` int(11) NOT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `kode_bank` int(1) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `debet` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_bank`
--

CREATE TABLE `ref_bank` (
  `id` int(11) NOT NULL,
  `kode` int(1) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `rekening` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_bank`
--

INSERT INTO `ref_bank` (`id`, `kode`, `nama`, `rekening`) VALUES
(1, 1, 'Bank BNI', '1234567890'),
(2, 2, 'Bank Mandiri', '1234567890'),
(3, 3, 'Bank BRI', '1234567890');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis`
--

CREATE TABLE `ref_jenis` (
  `id` int(11) NOT NULL,
  `kode` varchar(2) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `ref_kelompok_id` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_jenis`
--

INSERT INTO `ref_jenis` (`id`, `kode`, `nama`, `ref_kelompok_id`, `status`) VALUES
(1, '01', 'Uang Jaminan Lelang', 1, 'Debet'),
(2, '02', 'Pelunasan Lelang', 1, 'Debet'),
(3, '03', 'Pengembalian UJL', 1, 'Kredit'),
(4, '04', 'Pemindahbukuan HBL', 1, 'Kredit'),
(5, '05', 'UJL Wanprestasi', 1, 'Kredit'),
(6, '06', 'Setoran Debitur', 1, 'Debet'),
(7, '07', 'Hak Penyerah Piutang', 1, 'Kredit'),
(8, '08', 'Transaksi Lain-lain', 1, 'Debet'),
(9, '01', 'Bea Lelang Penjual', 2, 'Debet'),
(10, '02', 'Bea Lelang Penjual', 2, 'Kredit'),
(11, '03', 'Bea Lelang Pembeli', 2, 'Debet'),
(12, '04', 'Bea Lelang Pembeli', 2, 'Kredit'),
(13, '05', 'Bea Lelang Wanprestasi', 2, 'Debet'),
(14, '06', 'Bea Lelang Wanprestasi', 2, 'Kredit'),
(15, '07', 'Biaya Administrasi', 2, 'Debet'),
(16, '08', 'Biaya Administrasi', 2, 'Kredit'),
(17, '01', 'PPh Pasal 21 Final', 3, 'Debet'),
(18, '02', 'PPh Pasal 21 Final', 3, 'Kredit'),
(19, '09', 'Bea Lelang Batal', 2, 'Debet'),
(20, '10', 'Bea Lelang Batal', 2, 'Kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis_aktivitas`
--

CREATE TABLE `ref_jenis_aktivitas` (
  `id` int(11) NOT NULL,
  `kode` int(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_jenis_aktivitas`
--

INSERT INTO `ref_jenis_aktivitas` (`id`, `kode`, `nama`) VALUES
(1, 1, 'Lelang'),
(2, 2, 'Piutang Negara'),
(3, 3, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kelompok`
--

CREATE TABLE `ref_kelompok` (
  `id` int(11) NOT NULL,
  `kode` varchar(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_kelompok`
--

INSERT INTO `ref_kelompok` (`id`, `kode`, `nama`) VALUES
(1, '1', 'Dana Pihak Ketiga'),
(2, '2', 'PNBP'),
(3, '3', 'PPh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_nota`
--

CREATE TABLE `ref_nota` (
  `id` int(11) NOT NULL,
  `kode` varchar(2) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `kode_kelompok` varchar(1) DEFAULT NULL,
  `kode_jenis` varchar(2) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_nota`
--

INSERT INTO `ref_nota` (`id`, `kode`, `nama`, `kode_kelompok`, `kode_jenis`, `status`) VALUES
(1, '01', 'Uang Jaminan Lelang', '1', '01', 'Debet'),
(2, '02', 'Pelunasan Lelang', '1', '02', 'Debet'),
(3, '03', 'Setoran Debitur', '1', '06', 'Debet'),
(4, '04', 'Transaksi Lain-lain', '1', '08', 'Debet'),
(5, '05', 'Pengembalian UJL', '1', '03', 'Kredit'),
(6, '06', 'Pemindahbukuan HBL', '1', '04', 'Kredit'),
(9, '02', 'Pelunasan Lelang', '2', '01', 'Debet'),
(10, '07', 'Bea Lelang', '2', '02', 'Kredit'),
(11, '02', 'Pelunasan Lelang', '2', '03', 'Debet'),
(12, '07', 'Bea Lelang', '2', '04', 'Kredit'),
(14, '02', 'Pelunasan Lelang', '3', '01', 'Debet'),
(15, '08', 'PPh Final', '3', '02', 'Kredit'),
(16, '09', 'Nota Koreksi', '1', '05', 'Kredit'),
(17, '10', 'Hak Penyerah Piutang', '1', '07', 'Kredit'),
(18, '11', 'Biaya Administrasi', '2', '08', 'Kredit'),
(19, '12', 'Bea Lelang Batal', '2', '09', 'Debet'),
(20, '13', 'Bea Lelang Batal', '2', '10', 'Kredit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_satker`
--

CREATE TABLE `ref_satker` (
  `id` int(11) NOT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `nmsatker` varchar(128) DEFAULT NULL,
  `no_urut_penerimaan` varchar(5) DEFAULT NULL,
  `no_urut_pengeluaran` varchar(5) DEFAULT NULL,
  `no_nota_penerimaan` varchar(5) DEFAULT NULL,
  `no_nota_pengeluaran` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_satker`
--

INSERT INTO `ref_satker` (`id`, `kdsatker`, `nmsatker`, `no_urut_penerimaan`, `no_urut_pengeluaran`, `no_nota_penerimaan`, `no_nota_pengeluaran`) VALUES
(1, '411792', 'Kantor Pusat DJKN', NULL, NULL, NULL, NULL),
(2, '506050', 'Kanwil DJKN Aceh', NULL, NULL, NULL, NULL),
(3, '537827', 'KPKNL Banda Aceh', NULL, NULL, NULL, NULL),
(4, '506069', 'KPKNL Lhokseumawe', NULL, NULL, NULL, NULL),
(5, '411806', 'Kanwil DJKN Sumatera Utara', NULL, NULL, NULL, NULL),
(6, '537831', 'KPKNL Medan', '00116', '00113', '00045', '00036'),
(7, '119703', 'KPKNL Pematang Siantar', NULL, NULL, NULL, NULL),
(8, '506081', 'KPKNL Kisaran', NULL, NULL, NULL, NULL),
(9, '506090', 'KPKNL Padang Sidimpuan', NULL, NULL, NULL, NULL),
(10, '506101', 'Kanwil DJKN Riau, Sumatera Barat, dan Kepulauan Riau', NULL, NULL, NULL, NULL),
(11, '537848', 'KPKNL Padang', NULL, NULL, NULL, NULL),
(12, '119745', 'KPKNL Bukittinggi', NULL, NULL, NULL, NULL),
(13, '537852', 'KPKNL Pekanbaru', NULL, NULL, NULL, NULL),
(14, '119656', 'KPKNL Batam', NULL, NULL, NULL, NULL),
(15, '506461', 'KPKNL Dumai', NULL, NULL, NULL, NULL),
(16, '537880', 'Kanwil DJKN Sumatera Selatan, Jambi, dan Bangka Belitung', NULL, NULL, NULL, NULL),
(17, '537873', 'KPKNL Jambi', NULL, NULL, NULL, NULL),
(18, '537894', 'KPKNL Palembang', NULL, NULL, NULL, NULL),
(19, '506126', 'KPKNL Lahat', NULL, NULL, NULL, NULL),
(20, '119809', 'KPKNL Pangkal Pinang', NULL, NULL, NULL, NULL),
(21, '506142', 'Kanwil DJKN Lampung dan Bengkulu', NULL, NULL, NULL, NULL),
(22, '538154', 'KPKNL Bengkulu', NULL, NULL, NULL, NULL),
(23, '537902', 'KPKNL Bandar Lampung', NULL, NULL, NULL, NULL),
(24, '506157', 'KPKNL Metro', NULL, NULL, NULL, NULL),
(25, '506172', 'Kanwil DJKN Banten', NULL, NULL, NULL, NULL),
(26, '119724', 'KPKNL Serang', NULL, NULL, NULL, NULL),
(27, '506188', 'KPKNL Tangerang I', NULL, NULL, NULL, NULL),
(28, '506194', 'KPKNL Tangerang II', NULL, NULL, NULL, NULL),
(29, '411852', 'Kanwil DJKN DKI Jakarta', NULL, NULL, NULL, NULL),
(30, '537721', 'KPKNL Jakarta I', NULL, NULL, NULL, NULL),
(31, '604442', 'KPKNL Jakarta II', NULL, NULL, NULL, NULL),
(32, '537916', 'KPKNL Jakarta III', NULL, NULL, NULL, NULL),
(33, '537937', 'KPKNL Jakarta IV', NULL, NULL, NULL, NULL),
(34, '119312', 'KPKNL Jakarta V', NULL, NULL, NULL, NULL),
(35, '411812', 'Kanwil DJKN Jawa Barat', NULL, NULL, NULL, NULL),
(36, '537738', 'KPKNL Bandung', NULL, NULL, NULL, NULL),
(37, '604460', 'KPKNL Bekasi', NULL, NULL, NULL, NULL),
(38, '537759', 'KPKNL Bogor', NULL, NULL, NULL, NULL),
(39, '506208', 'KPKNL Purwakarta', NULL, NULL, NULL, NULL),
(40, '525343', 'KPKNL Tasikmalaya', NULL, NULL, NULL, NULL),
(41, '119393', 'KPKNL Cirebon', NULL, NULL, NULL, NULL),
(42, '411821', 'Kanwil DJKN Jawa Tengah dan D.I. Yogyakarta', NULL, NULL, NULL, NULL),
(43, '537763', 'KPKNL Semarang', NULL, NULL, NULL, NULL),
(44, '119511', 'KPKNL Surakarta', NULL, NULL, NULL, NULL),
(45, '506239', 'KPKNL Pekalongan', NULL, NULL, NULL, NULL),
(46, '411786', 'KPKNL Tegal', NULL, NULL, NULL, NULL),
(47, '537784', 'KPKNL Yogyakarta', NULL, NULL, NULL, NULL),
(48, '537770', 'KPKNL Purwokerto', NULL, NULL, NULL, NULL),
(49, '411837', 'Kanwil DJKN Jawa Timur', NULL, NULL, NULL, NULL),
(50, '537791', 'KPKNL Surabaya', NULL, NULL, NULL, NULL),
(51, '506276', 'KPKNL Sidoarjo', NULL, NULL, NULL, NULL),
(52, '537810', 'KPKNL Malang', NULL, NULL, NULL, NULL),
(53, '538140', 'KPKNL Jember', NULL, NULL, NULL, NULL),
(54, '506282', 'KPKNL Pamekasan', NULL, NULL, NULL, NULL),
(55, '537920', 'KPKNL Madiun', NULL, NULL, NULL, NULL),
(56, '506291', 'Kanwil DJKN Kalimantan Barat', NULL, NULL, NULL, NULL),
(57, '604456', 'KPKNL Pontianak', NULL, NULL, NULL, NULL),
(58, '506302', 'KPKNL Singkawang', NULL, NULL, NULL, NULL),
(59, '506327', 'Kanwil DJKN Kalimantan Selatan dan Tengah', NULL, NULL, NULL, NULL),
(60, '119834', 'KPKNL Palangka Raya', NULL, NULL, NULL, NULL),
(61, '506333', 'KPKNL Pangkalan Bun', NULL, NULL, NULL, NULL),
(62, '537958', 'KPKNL Banjarmasin', NULL, NULL, NULL, NULL),
(63, '506358', 'Kanwil DJKN Kalimantan Timur dan Utara', NULL, NULL, NULL, NULL),
(64, '537962', 'KPKNL Balikpapan', NULL, NULL, NULL, NULL),
(65, '537941', 'KPKNL Samarinda', NULL, NULL, NULL, NULL),
(66, '506364', 'KPKNL Tarakan', NULL, NULL, NULL, NULL),
(67, '506370', 'KPKNL Bontang', NULL, NULL, NULL, NULL),
(68, '538051', 'Kanwil DJKN Bali dan Nusa Tenggara', NULL, NULL, NULL, NULL),
(69, '538065', 'KPKNL Denpasar', NULL, NULL, NULL, NULL),
(70, '525591', 'KPKNL Singaraja', NULL, NULL, NULL, NULL),
(71, '538086', 'KPKNL Mataram', NULL, NULL, NULL, NULL),
(72, '538072', 'KPKNL Bima', NULL, NULL, NULL, NULL),
(73, '538108', 'KPKNL Kupang', NULL, NULL, NULL, NULL),
(74, '411843', 'Kanwil DJKN Sulawesi Selatan, Tenggara, dan Barat', NULL, NULL, NULL, NULL),
(75, '538019', 'KPKNL Makassar', NULL, NULL, NULL, NULL),
(76, '538190', 'KPKNL Pare-Pare', NULL, NULL, NULL, NULL),
(77, '119944', 'KPKNL Palopo', NULL, NULL, NULL, NULL),
(78, '538030', 'KPKNL Kendari', NULL, NULL, NULL, NULL),
(79, '418495', 'KPKNL Mamuju', NULL, NULL, NULL, NULL),
(80, '537979', 'Kanwil DJKN Sulawesi Utara, Tengah, Gorontalo, dan Maluku Utara', NULL, NULL, NULL, NULL),
(81, '538023', 'KPKNL Gorontalo', NULL, NULL, NULL, NULL),
(82, '538002', 'KPKNL Palu', NULL, NULL, NULL, NULL),
(83, '538133', 'KPKNL Ternate', NULL, NULL, NULL, NULL),
(84, '537983', 'KPKNL Manado', NULL, NULL, NULL, NULL),
(85, '506409', 'Kanwil DJKN Papua, Papua Barat, dan Maluku', NULL, NULL, NULL, NULL),
(86, '538129', 'KPKNL Jayapura', NULL, NULL, NULL, NULL),
(87, '537990', 'KPKNL Sorong', NULL, NULL, NULL, NULL),
(88, '525474', 'KPKNL Biak', NULL, NULL, NULL, NULL),
(89, '538044', 'KPKNL Ambon', NULL, NULL, NULL, NULL),
(90, '604445', 'Lembaga Manajemen Aset Negara', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_sub_jenis`
--

CREATE TABLE `ref_sub_jenis` (
  `id` int(11) NOT NULL,
  `kode` varchar(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `ref_jenis_id` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_access`
--

CREATE TABLE `system_access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `sub_sub_menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_access`
--

INSERT INTO `system_access` (`id`, `role_id`, `sub_sub_menu_id`) VALUES
(15, 5, 1),
(16, 5, 2),
(17, 5, 3),
(23, 5, 12),
(85, 5, 7),
(97, 5, 54),
(98, 5, 31),
(100, 5, 33),
(102, 5, 57),
(107, 5, 60),
(110, 5, 63),
(111, 5, 64),
(112, 5, 65),
(113, 5, 66),
(116, 5, 69),
(117, 5, 70),
(118, 5, 71),
(119, 5, 72);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_menu`
--

CREATE TABLE `system_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_menu`
--

INSERT INTO `system_menu` (`id`, `name`, `urutan`) VALUES
(1, 'Halaman Utama', 1),
(2, 'Data', 2),
(3, 'Laporan', 3),
(5, 'Sistem', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_role`
--

CREATE TABLE `system_role` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_role`
--

INSERT INTO `system_role` (`id`, `name`) VALUES
(5, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_sub_menu`
--

CREATE TABLE `system_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_sub_menu`
--

INSERT INTO `system_sub_menu` (`id`, `menu_id`, `name`, `url`, `icon`, `urutan`) VALUES
(1, 1, 'Beranda', 'beranda', 'nav-icon fas fa-tachometer-alt', 1),
(2, 5, 'Setting', '#', 'nav-icon fas fa-wrench', 2),
(21, 3, 'Buku Bendahara', '#', 'nav-icon fas fa-chart-line', 1),
(26, 2, 'Verifikator', '#', 'nav-icon fas fa-home', 2),
(40, 2, 'API', '#', 'nav-icon fas fa-building', 1),
(41, 2, 'Otorisator', '#', 'nav-icon fas fa-archway', 3),
(42, 5, 'Referensi', '#', 'nav-icon fas fa-history', 1),
(43, 2, 'Bendahara', '#', 'nav-icon fas fa-user-tie', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_sub_sub_menu`
--

CREATE TABLE `system_sub_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_sub_sub_menu`
--

INSERT INTO `system_sub_sub_menu` (`id`, `menu_id`, `sub_menu_id`, `name`, `url`, `icon`, `urutan`) VALUES
(1, 5, 2, 'Role', 'role', 'nav-icon fas fa-angle-right', 2),
(2, 5, 2, 'Menu', 'menu', 'nav-icon fas fa-angle-right', 3),
(3, 5, 2, 'User', 'user', 'nav-icon fas fa-angle-right', 1),
(7, 2, 26, 'Proses Verifikasi', 'verifikasi', 'nav-icon fas fa-angle-right', 1),
(12, 2, 26, 'Nota Penerimaan', 'nota-penerimaan', 'nav-icon fas fa-angle-right', 2),
(31, 1, 1, 'Penting Hari Ini', 'beranda', 'nav-icon fas fa-angle-right', 1),
(33, 3, 21, 'Buku Kas Umum', 'buku-kas-umum', 'nav-icon fas fa-angle-right', 1),
(54, 2, 40, 'Rekening Koran', 'rekening-koran', 'nav-icon fa fa-angle-right', 1),
(57, 2, 40, 'Aktivitas', 'aktivitas', 'nav-icon fa fa-angle-right', 2),
(60, 3, 21, 'Buku Pembantu', 'buku-pembantu', 'nav-icon fa fa-angle-right', 2),
(63, 2, 26, 'Nota Pengeluaran', 'nota-pengeluaran', 'nav-icon fa fa-angle-right', 3),
(64, 2, 41, 'Pengesahan', 'pengesahan', 'nav-icon fa fa-angle-right', 1),
(65, 5, 42, 'Satker', 'satker', 'nav-icon fa fa-angle-right', 1),
(66, 5, 42, 'Kodifikasi', 'kodifikasi', 'nav-icon fa fa-angle-right', 2),
(69, 5, 42, 'Nota', 'nota', 'nav-icon fa fa-angle-right', 3),
(70, 2, 43, 'Pemindahbukuan', 'pemindahbukuan', 'nav-icon fa fa-angle-right', 1),
(71, 2, 43, 'Pencatatan', 'pencatatan', 'nav-icon fa fa-angle-right', 2),
(72, 2, 43, 'Pengarsipan', 'pengarsipan', 'nav-icon fa fa-angle-right', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_sub_sub_sub_menu`
--

CREATE TABLE `system_sub_sub_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_menu_id` int(11) DEFAULT NULL,
  `sub_sub_menu_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_user`
--

CREATE TABLE `system_user` (
  `id` int(11) NOT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `kdsatker` varchar(6) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_user`
--

INSERT INTO `system_user` (`id`, `nip`, `nama`, `password`, `role_id`, `kdsatker`, `date_created`) VALUES
(1, '198407022003121004', 'Dana Kristiawan', '$2y$10$9PNofw93gxaK/fOynGDB7.qrKEv3kTXllTUJVKbDzUpw8Yy9TAbBW', 5, '537831', 1635437332),
(10, '111111111111111111', 'Tes', '$2y$10$7mlDPlp29pUPD4.9h8/y/O4VCxGp.0c.X9QzxbyzOHqpKBiiMNGwu', 9, '537827', 1635437286);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_jenis`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_jenis` (
`kode_kelompok` varchar(1)
,`kode_jenis` varchar(2)
,`nama_jenis` varchar(131)
,`status` varchar(8)
,`kode_nota` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_kas_umum`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_kas_umum` (
`tanggal` int(11)
,`kdsatker` varchar(6)
,`tahun` varchar(4)
,`kode_kelompok` varchar(1)
,`kode_jenis` varchar(2)
,`no_urut` varchar(5)
,`nama` varchar(131)
,`kredit` decimal(15,2)
,`debet` decimal(18,2)
,`jenis_aktivitas` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_menu`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_menu` (
`id_menu` int(11)
,`nama_menu` varchar(64)
,`urutan_menu` int(2)
,`id_sub_menu` int(11)
,`nama_sub_menu` varchar(64)
,`url_sub_menu` varchar(128)
,`icon_sub_menu` varchar(64)
,`urutan_sub_menu` int(2)
,`id_sub_sub_menu` int(11)
,`nama_sub_sub_menu` varchar(64)
,`url_sub_sub_menu` varchar(128)
,`icon_sub_sub_menu` varchar(64)
,`urutan_sub_sub_menu` int(2)
,`role_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_nota`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_nota` (
`id` int(11)
,`kdsatker` varchar(6)
,`tahun` varchar(4)
,`nomor` varchar(64)
,`tanggal` int(11)
,`kode_nota` varchar(2)
,`aktivitas_id` int(11)
,`status` int(11)
,`debet` decimal(18,2)
,`kredit` decimal(15,2)
,`jenis_nota` bigint(20)
,`jenis_aktivitas` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_penerimaan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_penerimaan` (
`id` int(11)
,`tanggal` int(11)
,`kdsatker` varchar(6)
,`tahun` varchar(4)
,`kode_kelompok` varchar(1)
,`kode_jenis` varchar(2)
,`no_urut` varchar(5)
,`debet` decimal(15,2)
,`virtual_account` varchar(16)
,`rekening_koran_id` int(11)
,`nota_penerimaan_id` int(11)
,`status` int(1)
,`nama_jenis` varchar(131)
,`kode_nota` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pengeluaran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pengeluaran` (
`id` int(11)
,`tanggal` int(11)
,`kdsatker` varchar(6)
,`tahun` varchar(4)
,`kode_kelompok` varchar(1)
,`kode_jenis` varchar(2)
,`no_urut` varchar(5)
,`kredit` decimal(15,2)
,`nota_pengeluaran_id` int(11)
,`status` int(1)
,`nama_jenis` varchar(131)
,`kode_nota` varchar(2)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_ref_nota`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_ref_nota` (
`kode` varchar(2)
,`nama` varchar(64)
,`status` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_rekening_koran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_rekening_koran` (
`kdsatker` varchar(6)
,`thn` varchar(4)
,`kode_bank` int(1)
,`tanggal` varchar(2)
,`bulan` varchar(2)
,`tahun` varchar(2)
,`jumlah` bigint(21)
,`debet` bigint(21)
,`kredit` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_jenis`
--
DROP TABLE IF EXISTS `view_jenis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jenis`  AS SELECT `a`.`kode` AS `kode_kelompok`, `b`.`kode` AS `kode_jenis`, concat(`a`.`nama`,' - ',`b`.`nama`) AS `nama_jenis`, `b`.`status` AS `status`, `c`.`kode` AS `kode_nota` FROM ((`ref_kelompok` `a` left join `ref_jenis` `b` on((`a`.`id` = `b`.`ref_kelompok_id`))) left join `ref_nota` `c` on(((`a`.`kode` = `c`.`kode_kelompok`) and (`b`.`kode` = `c`.`kode_jenis`)))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_kas_umum`
--
DROP TABLE IF EXISTS `view_kas_umum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kas_umum`  AS SELECT `data_penerimaan`.`tanggal` AS `tanggal`, `data_penerimaan`.`kdsatker` AS `kdsatker`, `data_penerimaan`.`tahun` AS `tahun`, `data_penerimaan`.`kode_kelompok` AS `kode_kelompok`, `data_penerimaan`.`kode_jenis` AS `kode_jenis`, `data_penerimaan`.`no_urut` AS `no_urut`, `view_jenis`.`nama_jenis` AS `nama`, 0 AS `kredit`, `data_penerimaan`.`debet` AS `debet`, `data_penerimaan`.`jenis_aktivitas` AS `jenis_aktivitas` FROM (`data_penerimaan` left join `view_jenis` on(((`data_penerimaan`.`kode_kelompok` = convert(`view_jenis`.`kode_kelompok` using utf8mb4)) and (`data_penerimaan`.`kode_jenis` = convert(`view_jenis`.`kode_jenis` using utf8mb4))))) WHERE (`data_penerimaan`.`nota_penerimaan_id` > 0) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS SELECT `a`.`id` AS `id_menu`, `a`.`name` AS `nama_menu`, `a`.`urutan` AS `urutan_menu`, `b`.`id` AS `id_sub_menu`, `b`.`name` AS `nama_sub_menu`, `b`.`url` AS `url_sub_menu`, `b`.`icon` AS `icon_sub_menu`, `b`.`urutan` AS `urutan_sub_menu`, `c`.`id` AS `id_sub_sub_menu`, `c`.`name` AS `nama_sub_sub_menu`, `c`.`url` AS `url_sub_sub_menu`, `c`.`icon` AS `icon_sub_sub_menu`, `c`.`urutan` AS `urutan_sub_sub_menu`, `d`.`role_id` AS `role_id` FROM (((`system_menu` `a` left join `system_sub_menu` `b` on((`a`.`id` = `b`.`menu_id`))) left join `system_sub_sub_menu` `c` on((`b`.`id` = `c`.`sub_menu_id`))) left join `system_access` `d` on((`c`.`id` = `d`.`sub_sub_menu_id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_nota`
--
DROP TABLE IF EXISTS `view_nota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nota`  AS SELECT `data_nota_penerimaan`.`id` AS `id`, `data_nota_penerimaan`.`kdsatker` AS `kdsatker`, `data_nota_penerimaan`.`tahun` AS `tahun`, `data_nota_penerimaan`.`nomor` AS `nomor`, `data_nota_penerimaan`.`tanggal` AS `tanggal`, `data_nota_penerimaan`.`kode_nota` AS `kode_nota`, `data_nota_penerimaan`.`aktivitas_id` AS `aktivitas_id`, `data_nota_penerimaan`.`status` AS `status`, `data_nota_penerimaan`.`debet` AS `debet`, 0 AS `kredit`, 1 AS `jenis_nota`, `data_aktivitas`.`jenis_aktivitas` AS `jenis_aktivitas` FROM (`data_nota_penerimaan` left join `data_aktivitas` on((`data_nota_penerimaan`.`aktivitas_id` = `data_aktivitas`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_penerimaan`
--
DROP TABLE IF EXISTS `view_penerimaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_penerimaan`  AS SELECT `a`.`id` AS `id`, `a`.`tanggal` AS `tanggal`, `a`.`kdsatker` AS `kdsatker`, `a`.`tahun` AS `tahun`, `a`.`kode_kelompok` AS `kode_kelompok`, `a`.`kode_jenis` AS `kode_jenis`, `a`.`no_urut` AS `no_urut`, `a`.`debet` AS `debet`, `a`.`virtual_account` AS `virtual_account`, `a`.`rekening_koran_id` AS `rekening_koran_id`, `a`.`nota_penerimaan_id` AS `nota_penerimaan_id`, `a`.`status` AS `status`, `b`.`nama_jenis` AS `nama_jenis`, `c`.`kode` AS `kode_nota` FROM ((`data_penerimaan` `a` left join `view_jenis` `b` on(((`a`.`kode_kelompok` = convert(`b`.`kode_kelompok` using utf8mb4)) and (`a`.`kode_jenis` = convert(`b`.`kode_jenis` using utf8mb4))))) left join `ref_nota` `c` on(((`a`.`kode_kelompok` = convert(`c`.`kode_kelompok` using utf8mb4)) and (`a`.`kode_jenis` = convert(`c`.`kode_jenis` using utf8mb4))))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pengeluaran`
--
DROP TABLE IF EXISTS `view_pengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pengeluaran`  AS SELECT `a`.`id` AS `id`, `a`.`tanggal` AS `tanggal`, `a`.`kdsatker` AS `kdsatker`, `a`.`tahun` AS `tahun`, `a`.`kode_kelompok` AS `kode_kelompok`, `a`.`kode_jenis` AS `kode_jenis`, `a`.`no_urut` AS `no_urut`, `a`.`kredit` AS `kredit`, `a`.`nota_pengeluaran_id` AS `nota_pengeluaran_id`, `a`.`status` AS `status`, `b`.`nama_jenis` AS `nama_jenis`, `c`.`kode` AS `kode_nota` FROM ((`data_pengeluaran` `a` left join `view_jenis` `b` on(((`a`.`kode_kelompok` = convert(`b`.`kode_kelompok` using utf8mb4)) and (`a`.`kode_jenis` = convert(`b`.`kode_jenis` using utf8mb4))))) left join `ref_nota` `c` on(((`a`.`kode_kelompok` = convert(`c`.`kode_kelompok` using utf8mb4)) and (`a`.`kode_jenis` = convert(`c`.`kode_jenis` using utf8mb4))))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_ref_nota`
--
DROP TABLE IF EXISTS `view_ref_nota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ref_nota`  AS SELECT DISTINCT `ref_nota`.`kode` AS `kode`, `ref_nota`.`nama` AS `nama`, `ref_nota`.`status` AS `status` FROM `ref_nota` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_rekening_koran`
--
DROP TABLE IF EXISTS `view_rekening_koran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rekening_koran`  AS SELECT `data_rekening_koran`.`kdsatker` AS `kdsatker`, `data_rekening_koran`.`tahun` AS `thn`, `data_rekening_koran`.`kode_bank` AS `kode_bank`, left(`data_rekening_koran`.`tanggal`,2) AS `tanggal`, substr(`data_rekening_koran`.`tanggal`,4,2) AS `bulan`, substr(`data_rekening_koran`.`tanggal`,7,2) AS `tahun`, count(`data_rekening_koran`.`uraian`) AS `jumlah`, count(if((`data_rekening_koran`.`debet` <> '0'),`data_rekening_koran`.`debet`,NULL)) AS `debet`, count(if((`data_rekening_koran`.`kredit` <> '0'),`data_rekening_koran`.`kredit`,NULL)) AS `kredit` FROM `data_rekening_koran` GROUP BY `data_rekening_koran`.`kdsatker`, `data_rekening_koran`.`tahun`, `data_rekening_koran`.`kode_bank`, left(`data_rekening_koran`.`tanggal`,2), substr(`data_rekening_koran`.`tanggal`,4,2), substr(`data_rekening_koran`.`tanggal`,7,2) ORDER BY substr(`data_rekening_koran`.`tanggal`,4,2) ASC, left(`data_rekening_koran`.`tanggal`,2) ASC, substr(`data_rekening_koran`.`tanggal`,7,2) ASC ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_aktivitas`
--
ALTER TABLE `data_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_contoh`
--
ALTER TABLE `data_contoh`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `data_nota_penerimaan`
--
ALTER TABLE `data_nota_penerimaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `data_nota_pengeluaran`
--
ALTER TABLE `data_nota_pengeluaran`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `data_penerimaan`
--
ALTER TABLE `data_penerimaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `data_pengeluaran`
--
ALTER TABLE `data_pengeluaran`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `data_rekening_koran`
--
ALTER TABLE `data_rekening_koran`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `ref_bank`
--
ALTER TABLE `ref_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_jenis`
--
ALTER TABLE `ref_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_jenis_aktivitas`
--
ALTER TABLE `ref_jenis_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_kelompok`
--
ALTER TABLE `ref_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_nota`
--
ALTER TABLE `ref_nota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_satker`
--
ALTER TABLE `ref_satker`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `ref_sub_jenis`
--
ALTER TABLE `ref_sub_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `system_access`
--
ALTER TABLE `system_access`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_menu`
--
ALTER TABLE `system_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_role`
--
ALTER TABLE `system_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_sub_menu`
--
ALTER TABLE `system_sub_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_sub_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_sub_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_aktivitas`
--
ALTER TABLE `data_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `data_contoh`
--
ALTER TABLE `data_contoh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_nota_penerimaan`
--
ALTER TABLE `data_nota_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `data_nota_pengeluaran`
--
ALTER TABLE `data_nota_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `data_penerimaan`
--
ALTER TABLE `data_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT untuk tabel `data_pengeluaran`
--
ALTER TABLE `data_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `data_rekening_koran`
--
ALTER TABLE `data_rekening_koran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5471;

--
-- AUTO_INCREMENT untuk tabel `ref_bank`
--
ALTER TABLE `ref_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ref_jenis`
--
ALTER TABLE `ref_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `ref_jenis_aktivitas`
--
ALTER TABLE `ref_jenis_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ref_kelompok`
--
ALTER TABLE `ref_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ref_nota`
--
ALTER TABLE `ref_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `ref_satker`
--
ALTER TABLE `ref_satker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `ref_sub_jenis`
--
ALTER TABLE `ref_sub_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `system_access`
--
ALTER TABLE `system_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `system_menu`
--
ALTER TABLE `system_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `system_role`
--
ALTER TABLE `system_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `system_sub_menu`
--
ALTER TABLE `system_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `system_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `system_sub_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
