-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 02 Nov 2021 pada 15.47
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
-- Struktur dari tabel `ref_sub_jenis`
--

CREATE TABLE `ref_sub_jenis` (
  `id` int(11) NOT NULL,
  `kode` varchar(1) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `ref_jenis_id` int(11) DEFAULT NULL,
  `kode_kontra` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_sub_jenis`
--

INSERT INTO `ref_sub_jenis` (`id`, `kode`, `nama`, `ref_jenis_id`, `kode_kontra`) VALUES
(1, '1', 'Uang Jaminan Lelang', 1, '231'),
(2, '1', 'Pelunasan Lelang', 2, NULL),
(3, '2', 'Kekurangan Pelunasan Lelang', 2, NULL),
(4, '3', 'Kelebihan Pelunasan Lelang', 2, NULL),
(5, '1', 'Angsuran', 3, NULL),
(6, '2', 'Kelebihan Setoran', 3, NULL),
(7, '1', 'Dana Dalam Konfirmasi', 4, NULL),
(8, '2', 'PNBP', 4, NULL),
(9, '3', 'PPh', 4, NULL),
(10, '1', 'PPh Final', 5, NULL),
(11, '1', 'Bea Permohonan Lelang', 6, NULL),
(12, '2', 'Bea Lelang', 6, NULL),
(13, '3', 'Bea Lelang Batal', 6, NULL),
(14, '4', 'Bea Penggantian Kutipan Risalah Lelang', 6, NULL),
(15, '5', 'Bea Lelang Wanprestasi', 6, NULL),
(16, '6', 'Biaya Administrasi Pengurusan Piutang Negara', 6, NULL),
(17, '7', 'Jasa Lainnya', 6, NULL),
(18, '1', 'Pengembalian Uang Jaminan Lelang', 7, NULL),
(19, '2', 'Hasil Bersih Lelang', 7, NULL),
(20, '3', 'Kelebihan Pelunasan Lelang', 7, NULL),
(21, '4', 'Pemindahbukuan Wanprestasi Lelang', 7, NULL),
(22, '5', 'Hak Penyerah Piutang Negara', 7, NULL),
(23, '6', 'Kelebihan Setoran Piutang Negara', 7, NULL),
(24, '4', 'Kekurangan Hasil Bersih', 2, '232'),
(25, '5', 'Bea Lelang', 2, '222'),
(26, '6', 'PPh', 2, '211');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ref_sub_jenis`
--
ALTER TABLE `ref_sub_jenis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ref_sub_jenis`
--
ALTER TABLE `ref_sub_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
