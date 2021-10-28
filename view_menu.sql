-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 28 Okt 2021 pada 00.43
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
-- Struktur untuk view `view_menu`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS  select `a`.`id` AS `id_menu`,`a`.`name` AS `nama_menu`,`b`.`id` AS `id_sub_menu`,`b`.`name` AS `nama_sub_menu`,`b`.`url` AS `url_sub_menu`,`b`.`icon` AS `icon_sub_menu`,`c`.`id` AS `id_sub_sub_menu`,`c`.`name` AS `nama_sub_sub_menu`,`c`.`url` AS `url_sub_sub_menu`,`c`.`icon` AS `icon_sub_sub_menu`,`d`.`role_id` AS `role_id` from (((`system_menu` `a` left join `system_sub_menu` `b` on((`a`.`id` = `b`.`menu_id`))) left join `system_sub_sub_menu` `c` on((`b`.`id` = `c`.`sub_menu_id`))) left join `system_access` `d` on((`c`.`id` = `d`.`sub_sub_menu_id`))) ;

--
-- VIEW  `view_menu`
-- Data: Tidak ada
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
