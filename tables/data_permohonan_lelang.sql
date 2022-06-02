-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 02 Jun 2022 pada 13.07
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
-- Struktur dari tabel `data_permohonan_lelang`
--

CREATE TABLE `data_permohonan_lelang` (
  `id` int(11) NOT NULL,
  `nomor` varchar(64) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `nama_pemohon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `data_permohonan_lelang`
--

INSERT INTO `data_permohonan_lelang` (`id`, `nomor`, `tanggal`, `nama_pemohon`) VALUES
(6, '124151', 1646154000, 'Testing aplikasi'),
(7, '3252', 1650733200, 'testing testing');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_permohonan_lelang`
--
ALTER TABLE `data_permohonan_lelang`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_permohonan_lelang`
--
ALTER TABLE `data_permohonan_lelang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
