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
-- Struktur untuk view `view_jenis`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jenis`  AS  select `a`.`kode` AS `kode_kelompok`,`b`.`kode` AS `kode_jenis`,`c`.`kode` AS `kode_sub_jenis`,`c`.`nama` AS `nama_sub_jenis`,`c`.`kode_kontra` AS `kode_kontra` from ((`ref_kelompok` `a` left join `ref_jenis` `b` on((`a`.`id` = `b`.`ref_kelompok_id`))) left join `ref_sub_jenis` `c` on((`b`.`id` = `c`.`ref_jenis_id`))) ;

--
-- VIEW  `view_jenis`
-- Data: Tidak ada
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
