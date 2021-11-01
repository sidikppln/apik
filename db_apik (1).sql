-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 01 Nov 2021 pada 04.05
-- Versi server: 5.7.26
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `nomor` varchar(64) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  `kode_kelompok` varchar(1) DEFAULT NULL,
  `kode_jenis` varchar(1) DEFAULT NULL,
  `kode_sub_jenis` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `data_nota_penerimaan`
--

INSERT INTO `data_nota_penerimaan` (`id`, `nomor`, `tanggal`, `kredit`, `kode_kelompok`, `kode_jenis`, `kode_sub_jenis`) VALUES
(4, '00001', 1635738783, NULL, '1', '1', '1'),
(5, '00002', 1635738786, NULL, '1', '2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_nota_pengeluaran`
--

CREATE TABLE `data_nota_pengeluaran` (
  `id` int(11) NOT NULL,
  `nomor_nota` varchar(64) DEFAULT NULL,
  `tanggal_nota` varchar(11) DEFAULT NULL
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
  `kode_jenis` varchar(1) DEFAULT NULL,
  `kode_sub_jenis` varchar(1) DEFAULT NULL,
  `no_urut` varchar(5) DEFAULT NULL,
  `kredit` decimal(15,2) DEFAULT NULL,
  `virtual_account` varchar(16) DEFAULT NULL,
  `kode_lelang` varchar(6) DEFAULT NULL,
  `transaksi_bank_id` int(11) DEFAULT NULL,
  `nota_penerimaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `data_penerimaan`
--

INSERT INTO `data_penerimaan` (`id`, `tanggal`, `kdsatker`, `tahun`, `kode_kelompok`, `kode_jenis`, `kode_sub_jenis`, `no_urut`, `kredit`, `virtual_account`, `kode_lelang`, `transaksi_bank_id`, `nota_penerimaan_id`) VALUES
(11, 1635120000, '537831', '2021', '1', '1', '1', '00002', '400000000.00', '9880052121102502', 'OKUSYW', 125, NULL),
(12, 1635206400, '537831', '2021', '1', '1', '1', '00003', '400000000.00', '9880052121101902', 'OKUSYW', 138, NULL),
(13, 1635206400, '537831', '2021', '1', '1', '1', '00004', '400000000.00', '9880052121102202', 'OKUSYW', 141, NULL),
(14, 1635206400, '537831', '2021', '1', '1', '1', '00005', '192000000.00', '9880052121102505', '2FD0VS', 136, NULL),
(15, 1635206400, '537831', '2021', '1', '1', '1', '00006', '200000000.00', '9880052121102203', 'I3OHQI', 137, NULL),
(16, 1635120000, '537831', '2021', '1', '1', '1', '00007', '130000000.00', '9880052121102501', '5SWOB3', 124, NULL),
(17, 1635120000, '537831', '2021', '1', '1', '1', '00008', '250000.00', '6013010854786945', 'OM3600', 133, NULL),
(20, 1635120000, '537831', '2021', '1', '1', '1', '00009', '150000.00', '5307952026839705', 'S1ACMB', 122, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pengeluaran`
--

CREATE TABLE `data_pengeluaran` (
  `id` int(11) NOT NULL,
  `nota_pengeluaran_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_transaksi_bank`
--

CREATE TABLE `data_transaksi_bank` (
  `id` int(11) NOT NULL,
  `tanggal` varchar(255) DEFAULT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `debet` varchar(255) DEFAULT NULL,
  `kredit` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `data_transaksi_bank`
--

INSERT INTO `data_transaksi_bank` (`id`, `tanggal`, `uraian`, `debet`, `kredit`, `status`) VALUES
(121, '25/10/21 08.59.34', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 486201000046505 | 6013012085777990 | 00861109        2594', '0', '150,000.00', 0),
(122, '25/10/21 10.03.31', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 54603 | 5307952026839705 | S1ACMB9503      7863', '0', '150,000.00', 1),
(123, '25/10/21 10.20.10', 'SETOR TUNAI | Sdr VINCENTIUS HERU CHANDRA | PEMBATALAN LELANG DEBITUR PANIN DUBAI AN ZULFARIDA', '0', '250,000.00', 0),
(124, '25/10/21 10.39.44', 'KREDIT LAIN-LAIN | 9880052121102501 BAMBANG SUTRISNO 5SWOB3 | 002 BAMBANG SUTRISN JMNN LLNG SHM10737 9DES2016 90', '0', '130,000,000.00', 1),
(125, '25/10/21 11.38.46', 'KREDIT LAIN-LAIN | 9880052121102502 Kevin lionodjaya OKUSYW | 028 KEVIN LIONODJAY', '0', '400,000,000.00', 1),
(126, '25/10/21 11.39.57', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 76408 | 6019004526587371 | S1G997Z427      6980 | 9880052121021305 KPKNL Tangerang', '0', '21,829,999.00', 0),
(127, '25/10/21 13.19.49', 'TRANSFER KE | BILL PAYMENT (MPN G2 IDR  ) NO :820211025229541', '15,800,000.00', '0', 0),
(128, '25/10/21 13.19.51', 'TRANSFER KE | BILL PAYMENT (MPN G2 IDR  ) NO :820211025230016', '316,000.00', '0', 0),
(129, '25/10/21 14.02.31', 'TRF/PAY/TOP-UP ECHANNEL | 6013010854786945 | OM360002000088880833', '0', '150,000.00', 0),
(130, '25/10/21 15.34.25', 'SETOR TUNAI | RPL 127 KPKNL TANGERANG UTK LE | PT. BINANGUN AGRO LESTARI', '0', '150,000.00', 0),
(131, '25/10/21 15.51.57', 'TRANSFER DARI | PEMINDAHAN DARI 144845762 Bpk IWAN  KUSTIAWAN | 9880052121101301 Iwan Kustiawan EFNHUP', '0', '84,123,124.00', 0),
(132, '25/10/21 16.07.25', 'TRF/PAY/TOP-UP ECHANNEL | 5221842154674797 | 00000000300008901987', '0', '150,000.00', 0),
(133, '25/10/21 17.00.48', 'TRF/PAY/TOP-UP ECHANNEL | 6013010854786945 | OM360002000088884040', '0', '250,000.00', 1),
(134, '26/10/21 09.23.05', 'TRANSFER KE | MPN G2 IDR  820211025230557', '780,000.00', '0', 0),
(135, '26/10/21 09.25.54', 'TRANSFER KE | Hasil lelang rampasan Tabung LPG | SIMSEM PAYROLL BNI DIRECT-LLG', '25,999,999.00', '0', 0),
(136, '26/10/21 10.38.48', 'SETOR TUNAI | 9880052121102505 Aidil Adhisaputra 2FD0VS', '0', '192,000,000.00', 1),
(137, '26/10/21 11.05.08', 'TRANSFER DARI | 9880052121102203 NATASYA CHAO I3OHQI | Sdri NATASYA  CHAO   ', '0', '200,000,000.00', 1),
(138, '26/10/21 11.52.29', 'TRANSFER DARI | 9880052121101902 tris chandra putra OKUSYW | Sdr ONGKY GANTENG VEDAYOKO   ', '0', '400,000,000.00', 1),
(139, '26/10/21 12.06.13', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN OSMOND VALENTINO', '0', '150,000.00', 0),
(140, '26/10/21 12.07.10', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN ANDREAS WILLIAWAN', '0', '150,000.00', 0),
(141, '26/10/21 12.29.33', 'TRANSFER DARI | 9880052121102202 Dyah Nurmalitasari OKUSYW |DYAH NURMALITASARI', '0', '400,000,000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis`
--

CREATE TABLE `ref_jenis` (
  `id` int(11) NOT NULL,
  `kode` varchar(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `ref_kelompok_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_jenis`
--

INSERT INTO `ref_jenis` (`id`, `kode`, `nama`, `ref_kelompok_id`) VALUES
(1, '1', 'Uang Jaminan Lelang', 1),
(2, '2', 'Pelunasan Lelang', 1),
(3, '3', 'Setoran', 1),
(4, '4', 'Lain-lain', 1),
(5, '1', 'PPh Final', 2),
(6, '2', 'PNBP', 2),
(7, '3', 'Pihak Ketiga', 2);

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
(1, '1', 'Penerimaan'),
(2, '2', 'Pengeluaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rekening`
--

CREATE TABLE `ref_rekening` (
  `id` int(11) NOT NULL,
  `nomor` varchar(16) DEFAULT NULL,
  `nama_bank` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
(6, '537831', 'KPKNL Medan', '00002', '00001', '00003', NULL),
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
  `ref_jenis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_sub_jenis`
--

INSERT INTO `ref_sub_jenis` (`id`, `kode`, `nama`, `ref_jenis_id`) VALUES
(1, '1', 'Uang Jaminan Lelang', 1),
(2, '1', 'Pelunasan Lelang', 2),
(3, '2', 'Kekurangan Pelunasan Lelang', 2),
(4, '3', 'Kelebihan Pelunasan Lelang', 2),
(5, '1', 'Angsuran', 3),
(6, '2', 'Kelebihan Setoran', 3),
(7, '1', 'Dana Dalam Konfirmasi', 4),
(8, '2', 'PNBP', 4),
(9, '3', 'PPh', 4),
(10, '1', 'PPh Final', 5),
(11, '1', 'Bea Permohonan Lelang', 6),
(12, '2', 'Bea Lelang', 6),
(13, '3', 'Bea Lelang Batal', 6),
(14, '4', 'Bea Penggantian Kutipan Risalah Lelang', 6),
(15, '5', 'Bea Lelang Wanprestasi', 6),
(16, '6', 'Biaya Administrasi Pengurusan Piutang Negara', 6),
(17, '7', 'Jasa Lainnya', 6),
(18, '1', 'Pengembalian Uang Jaminan Lelang', 7),
(19, '2', 'Hasil Bersih Lelang', 7),
(20, '3', 'Kelebihan Pelunasan Lelang', 7),
(21, '4', 'Pemindahbukuan Wanprestasi Lelang', 7),
(22, '5', 'Hak Penyerah Piutang Negara', 7),
(23, '6', 'Kelebihan Setoran Piutang Negara', 7);

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
(12, 5, 7),
(14, 6, 7),
(15, 5, 1),
(16, 5, 2),
(17, 5, 3),
(18, 5, 10),
(20, 5, 11),
(21, 6, 9),
(22, 5, 9),
(23, 5, 12),
(24, 5, 13),
(25, 5, 7),
(26, 5, 12),
(27, 5, 13),
(28, 5, 14),
(29, 5, 15),
(30, 5, 16),
(31, 5, 17),
(32, 5, 18),
(33, 5, 19),
(34, 5, 20),
(35, 5, 21),
(36, 5, 22),
(37, 5, 23),
(38, 5, 24),
(39, 5, 25),
(40, 5, 26),
(41, 5, 27),
(42, 5, 28),
(43, 5, 29),
(44, 5, 30),
(45, 5, 31),
(47, 5, 33),
(48, 5, 34),
(49, 5, 35),
(50, 9, 17),
(51, 9, 18),
(53, 9, 36),
(54, 9, 37),
(55, 9, 23),
(56, 9, 24),
(57, 9, 26),
(58, 9, 27),
(59, 9, 28),
(60, 9, 29),
(61, 9, 30),
(62, 9, 31),
(63, 9, 33),
(64, 9, 34),
(65, 9, 35),
(66, 6, 13),
(67, 6, 22),
(68, 5, 38),
(69, 5, 39),
(70, 5, 40),
(71, 10, 7),
(72, 10, 9),
(73, 10, 12),
(74, 10, 14),
(75, 10, 25),
(76, 10, 16),
(77, 10, 19),
(78, 10, 20),
(79, 10, 21),
(80, 5, 42),
(81, 9, 42),
(82, 5, 44),
(83, 10, 44);

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_menu`
--

CREATE TABLE `system_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_menu`
--

INSERT INTO `system_menu` (`id`, `name`) VALUES
(1, 'Halaman Utama'),
(2, 'Data'),
(3, 'Monitoring'),
(4, 'Referensi'),
(5, 'Sistem');

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
(5, 'Administrator'),
(6, 'Otorisator'),
(9, 'Bendahara Penerimaan'),
(10, 'Verifikator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_sub_menu`
--

CREATE TABLE `system_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_sub_menu`
--

INSERT INTO `system_sub_menu` (`id`, `menu_id`, `name`, `url`, `icon`) VALUES
(1, 1, 'Beranda', 'beranda', 'nav-icon fas fa-tachometer-alt'),
(2, 5, 'Setting', '#', 'nav-icon fas fa-wrench'),
(21, 3, 'Monitoring', 'monitoring', 'nav-icon fas fa-chart-line'),
(26, 2, 'Lelang', 'lelang', 'nav-icon fas fa-tasks'),
(27, 2, 'Piutang', 'piutang', 'nav-icon fas fa-columns'),
(36, 1, 'Timeline', 'timeline', 'nav-icon fas fa-chart-line'),
(37, 4, 'Laporan', 'laporan', 'nav-icon fas fa-chart-pie');

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
  `icon` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `system_sub_sub_menu`
--

INSERT INTO `system_sub_sub_menu` (`id`, `menu_id`, `sub_menu_id`, `name`, `url`, `icon`) VALUES
(1, 5, 2, 'Role', 'role', 'nav-icon fas fa-angle-right'),
(2, 5, 2, 'Menu', 'menu', 'nav-icon fas fa-angle-right'),
(3, 5, 2, 'User', 'user', 'nav-icon fas fa-angle-right'),
(7, 2, 26, 'Data Bank', 'transaksi-bank', 'nav-icon fas fa-angle-right'),
(9, 2, 27, 'Data Bank', 'transaksi-bank-pn', 'nav-icon fas fa-angle-right'),
(10, 1, 36, 'Referensi Satker', 'ref-satker', 'nav-icon fas fa-angle-right'),
(11, 4, 37, 'Jenis', 'ref_kelompok', 'nav-icon fas fa-angle-right'),
(12, 2, 26, 'Penerimaan', 'nota-penerimaan', 'nav-icon fas fa-angle-right'),
(13, 2, 26, 'Pengesahan', 'pengesahan', 'nav-icon fas fa-angle-right'),
(14, 2, 26, 'Rincian Hasil Lelang', 'rincian-hasil', 'nav-icon fas fa-angle-right'),
(15, 2, 26, 'Reklasifikasi', 'reklasifikasi', 'nav-icon fas fa-angle-right'),
(16, 2, 26, 'Pengeluaran', 'pengeluaran', 'nav-icon fas fa-angle-right'),
(17, 2, 26, 'Konfirmasi Pembukuan', 'pembukuan', 'nav-icon fas fa-angle-right'),
(18, 2, 26, 'Konfirmasi Pengeluaran', 'konfirmasi-pengeluaran', 'nav-icon fas fa-angle-right'),
(19, 2, 27, 'Penerimaan', 'penerimaan-pn', 'nav-icon fas fa-angle-right'),
(20, 2, 27, 'Rincian Penerimaan', 'rincian-pn', 'nav-icon fas fa-angle-right'),
(21, 2, 27, 'Pengeluaran', 'pengeluaran-pn', 'nav-icon fas fa-angle-right'),
(22, 2, 27, 'Pengesahan', 'pengesahan-pn', 'nav-icon fas fa-angle-right'),
(23, 2, 27, 'Konfirmasi Pembukuan', 'pembukuan-pn', 'nav-icon fas fa-angle-right'),
(24, 2, 27, 'Konfirmasi Pengeluaran', 'konfirmasi-pengeluaran-pn', 'nav-icon fas fa-angle-right'),
(25, 2, 27, 'Koreksi', 'koreksi-pn', 'nav-icon fas fa-angle-right'),
(26, 4, 37, 'BKU', 'bku', 'nav-icon fas fa-angle-right'),
(27, 4, 37, 'BKU Detail', 'bku-detail', 'nav-icon fas fa-angle-right'),
(28, 4, 37, 'BP Dana Pihak Ketiga', 'bp-dpk', 'nav-icon fas fa-angle-right'),
(29, 4, 37, 'BP PNBP', 'bp-pnbp', 'nav-icon fas fa-angle-right'),
(30, 4, 37, 'BP Pajak', 'bp-pajak', 'nav-icon fas fa-angle-right'),
(31, 1, 1, 'Dashboard', 'beranda', 'nav-icon fas fa-angle-right'),
(33, 3, 21, 'Pengembalian UJL', 'pengembalian-ujl', 'nav-icon fas fa-angle-right'),
(34, 3, 21, 'Penerimaan-Pengeluaran', 'penerimaan-pengeluaran', 'nav-icon fas fa-angle-right'),
(35, 3, 21, 'Dana Tidak Jelas', 'dana-tidak-jelas', 'nav-icon fas fa-angle-right'),
(36, 3, 21, 'Rekening Lelang', 'rekening-lelang', 'nav-icon fas fa-angle-right'),
(37, 3, 21, 'Rekening Piutang', 'rekening-piutang', 'nav-icon fas fa-angle-right'),
(38, 3, 21, 'Belum dibukukan', 'belum-buku', 'nav-icon fas fa-angle-right'),
(39, 3, 21, 'Belum Setor PNBP', 'belum-setor-pnbp', 'nav-icon fas fa-angle-right'),
(40, 3, 21, 'Belum Pindah Buku', 'belum-pindah-buku', 'nav-icon fas fa-angle-right'),
(41, 3, 21, 'PNBP Lewat 1 Hari', 'pnbp-lewat', 'nav-icon fas fa-angle-right'),
(42, 2, 26, 'Kuitansi Pelunasan', 'kuitansi', 'nav-icon fas fa-angle-right'),
(44, 2, 26, 'UJL Wanprestasi', 'wanprestasi', 'nav-icon fas fa-angle-right');

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
  `icon` varchar(64) DEFAULT NULL
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
(7, '333333333333333333', 'Cepot', '$2y$10$Eqb8FU8OO2Fn9yib6F9wCei.bmb63/NH7s/X4GnfkZVps1aGHPZNu', 6, NULL, 1635241153),
(8, '123456789012345678', 'benma', '$2y$10$Qf3vW6uDl4XpbIsD8oNTj.VrQ3x5boufEJTNmEm2KiPaftcxnsd56', 9, NULL, 1635431296),
(9, '999999999999999999', 'Verifikator', '$2y$10$sHxXA/b4dFQzRGCWh6ipROtdX0ykyK09Ey2bsD14eH5tUtlg5gcBC', 10, NULL, 1635432152),
(10, '111111111111111111', 'Tes', '$2y$10$7mlDPlp29pUPD4.9h8/y/O4VCxGp.0c.X9QzxbyzOHqpKBiiMNGwu', 9, '537827', 1635437286);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_jenis`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_jenis` (
`kode_kelompok` varchar(1)
,`kode_jenis` varchar(1)
,`kode_sub_jenis` varchar(1)
,`nama_sub_jenis` varchar(64)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_menu`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_menu` (
`id_menu` int(11)
,`nama_menu` varchar(64)
,`id_sub_menu` int(11)
,`nama_sub_menu` varchar(64)
,`url_sub_menu` varchar(128)
,`icon_sub_menu` varchar(64)
,`id_sub_sub_menu` int(11)
,`nama_sub_sub_menu` varchar(64)
,`url_sub_sub_menu` varchar(128)
,`icon_sub_sub_menu` varchar(64)
,`role_id` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_jenis`
--
DROP TABLE IF EXISTS `view_jenis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jenis`  AS  select `a`.`kode` AS `kode_kelompok`,`b`.`kode` AS `kode_jenis`,`c`.`kode` AS `kode_sub_jenis`,`c`.`nama` AS `nama_sub_jenis` from ((`ref_kelompok` `a` left join `ref_jenis` `b` on((`a`.`id` = `b`.`ref_kelompok_id`))) left join `ref_sub_jenis` `c` on((`b`.`id` = `c`.`ref_jenis_id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS  select `a`.`id` AS `id_menu`,`a`.`name` AS `nama_menu`,`b`.`id` AS `id_sub_menu`,`b`.`name` AS `nama_sub_menu`,`b`.`url` AS `url_sub_menu`,`b`.`icon` AS `icon_sub_menu`,`c`.`id` AS `id_sub_sub_menu`,`c`.`name` AS `nama_sub_sub_menu`,`c`.`url` AS `url_sub_sub_menu`,`c`.`icon` AS `icon_sub_sub_menu`,`d`.`role_id` AS `role_id` from (((`system_menu` `a` left join `system_sub_menu` `b` on((`a`.`id` = `b`.`menu_id`))) left join `system_sub_sub_menu` `c` on((`b`.`id` = `c`.`sub_menu_id`))) left join `system_access` `d` on((`c`.`id` = `d`.`sub_sub_menu_id`))) ;

--
-- Indexes for dumped tables
--

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
-- Indeks untuk tabel `data_transaksi_bank`
--
ALTER TABLE `data_transaksi_bank`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `ref_jenis`
--
ALTER TABLE `ref_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_kelompok`
--
ALTER TABLE `ref_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ref_rekening`
--
ALTER TABLE `ref_rekening`
  ADD PRIMARY KEY (`id`) USING BTREE;

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
-- AUTO_INCREMENT untuk tabel `data_contoh`
--
ALTER TABLE `data_contoh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_nota_penerimaan`
--
ALTER TABLE `data_nota_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_nota_pengeluaran`
--
ALTER TABLE `data_nota_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_penerimaan`
--
ALTER TABLE `data_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `data_transaksi_bank`
--
ALTER TABLE `data_transaksi_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT untuk tabel `ref_jenis`
--
ALTER TABLE `ref_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ref_kelompok`
--
ALTER TABLE `ref_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ref_rekening`
--
ALTER TABLE `ref_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ref_satker`
--
ALTER TABLE `ref_satker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT untuk tabel `ref_sub_jenis`
--
ALTER TABLE `ref_sub_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `system_access`
--
ALTER TABLE `system_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `system_menu`
--
ALTER TABLE `system_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `system_role`
--
ALTER TABLE `system_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `system_sub_menu`
--
ALTER TABLE `system_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `system_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `system_sub_sub_sub_menu`
--
ALTER TABLE `system_sub_sub_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
