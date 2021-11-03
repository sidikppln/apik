-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 02 Nov 2021 pada 15.46
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
-- Struktur dari tabel `data_nota_pengeluaran`
--

CREATE TABLE `data_nota_pengeluaran` (
  `id` int(11) NOT NULL,
  `nomor` varchar(64) DEFAULT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `debet` decimal(15,2) DEFAULT NULL,
  `kode_kelompok` varchar(1) DEFAULT NULL,
  `kode_jenis` varchar(1) DEFAULT NULL,
  `kode_sub_jenis` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_nota_pengeluaran`
--
ALTER TABLE `data_nota_pengeluaran`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_nota_pengeluaran`
--
ALTER TABLE `data_nota_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
