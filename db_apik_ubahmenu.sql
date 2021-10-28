/*
 Navicat Premium Data Transfer

 Source Server         : koneksi
 Source Server Type    : MySQL
 Source Server Version : 100419
 Source Host           : localhost:3306
 Source Schema         : db_apik

 Target Server Type    : MySQL
 Target Server Version : 100419
 File Encoding         : 65001

 Date: 28/10/2021 22:12:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_contoh
-- ----------------------------
DROP TABLE IF EXISTS `data_contoh`;
CREATE TABLE `data_contoh`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` int(5) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_contoh
-- ----------------------------
INSERT INTO `data_contoh` VALUES (1, 3333, 'Budi');
INSERT INTO `data_contoh` VALUES (3, 21212, 'hkhl');
INSERT INTO `data_contoh` VALUES (4, 6666, 'Thjjaggd');

-- ----------------------------
-- Table structure for data_nota_penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `data_nota_penerimaan`;
CREATE TABLE `data_nota_penerimaan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_nota` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_nota` int(11) NULL DEFAULT NULL,
  `jenis_nota` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nominal` decimal(32, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_nota_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `data_nota_pengeluaran`;
CREATE TABLE `data_nota_pengeluaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_nota` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_nota` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `data_penerimaan`;
CREATE TABLE `data_penerimaan`  (
  `id` int(11) NOT NULL,
  `nota_penerimaan_id` int(11) NULL DEFAULT NULL,
  `tanggal` int(11) NULL DEFAULT NULL,
  `nominal` decimal(32, 0) NULL DEFAULT NULL,
  `uraian` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_penerimaan` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `data_pengeluaran`;
CREATE TABLE `data_pengeluaran`  (
  `id` int(11) NOT NULL,
  `nota_pengeluaran_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_transaksi_bank
-- ----------------------------
DROP TABLE IF EXISTS `data_transaksi_bank`;
CREATE TABLE `data_transaksi_bank`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uraian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `debet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kredit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_transaksi_bank
-- ----------------------------
INSERT INTO `data_transaksi_bank` VALUES (79, '26/10/21 09.23.05', 'TRANSFER KE | MPN G2 IDR  820211025230557', '780,000.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (80, '26/10/21 09.25.54', 'TRANSFER KE | Hasil lelang rampasan Tabung LPG | SIMSEM PAYROLL BNI DIRECT-LLG', '25,999,999.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (81, '26/10/21 10.38.48', 'SETOR TUNAI | 9880052121102505 Aidil Adhisaputra 2FD0VS', '0', '192,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (82, '26/10/21 11.05.08', 'TRANSFER DARI | 9880052121102203 NATASYA CHAO I3OHQI | Sdri NATASYA  CHAO   ', '0', '200,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (83, '26/10/21 11.52.29', 'TRANSFER DARI | 9880052121101902 tris chandra putra OKUSYW | Sdr ONGKY GANTENG VEDAYOKO   ', '0', '400,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (84, '26/10/21 12.06.13', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN OSMOND VALENTINO', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (85, '26/10/21 12.07.10', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN ANDREAS WILLIAWAN', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (86, '26/10/21 12.29.33', 'TRANSFER DARI | 9880052121102202 Dyah Nurmalitasari OKUSYW |DYAH NURMALITASARI', '0', '400,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (87, '26/10/21 09.23.05', 'TRANSFER KE | MPN G2 IDR  820211025230557', '780,000.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (88, '26/10/21 09.25.54', 'TRANSFER KE | Hasil lelang rampasan Tabung LPG | SIMSEM PAYROLL BNI DIRECT-LLG', '25,999,999.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (89, '26/10/21 10.38.48', 'SETOR TUNAI | 9880052121102505 Aidil Adhisaputra 2FD0VS', '0', '192,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (90, '26/10/21 11.05.08', 'TRANSFER DARI | 9880052121102203 NATASYA CHAO I3OHQI | Sdri NATASYA  CHAO   ', '0', '200,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (91, '26/10/21 11.52.29', 'TRANSFER DARI | 9880052121101902 tris chandra putra OKUSYW | Sdr ONGKY GANTENG VEDAYOKO   ', '0', '400,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (92, '26/10/21 12.06.13', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN OSMOND VALENTINO', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (93, '26/10/21 12.07.10', 'SETOR TUNAI | ABDUL MUIS SH  BIAYA PENDAFTARAN LELANG AN ANDREAS WILLIAWAN', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (94, '26/10/21 12.29.33', 'TRANSFER DARI | 9880052121102202 Dyah Nurmalitasari OKUSYW |DYAH NURMALITASARI', '0', '400,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (95, '25/10/21 08.59.34', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 486201000046505 | 6013012085777990 | 00861109        2594', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (96, '25/10/21 10.03.31', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 54603 | 5307952026839705 | S1ACMB9503      7863', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (97, '25/10/21 10.20.10', 'SETOR TUNAI | Sdr VINCENTIUS HERU CHANDRA | PEMBATALAN LELANG DEBITUR PANIN DUBAI AN ZULFARIDA', '0', '250,000.00');
INSERT INTO `data_transaksi_bank` VALUES (98, '25/10/21 10.39.44', 'KREDIT LAIN-LAIN | 9880052121102501 BAMBANG SUTRISNO 5SWOB3 | 002 BAMBANG SUTRISN JMNN LLNG SHM10737 9DES2016 90', '0', '130,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (99, '25/10/21 11.38.46', 'KREDIT LAIN-LAIN | 9880052121102502 Kevin lionodjaya OKUSYW | 028 KEVIN LIONODJAY', '0', '400,000,000.00');
INSERT INTO `data_transaksi_bank` VALUES (100, '25/10/21 11.39.57', 'TRF/PAY/TOP-UP ECHANNEL | PEMINDAHAN DARI 76408 | 6019004526587371 | S1G997Z427      6980 | 9880052121021305 KPKNL Tangerang', '0', '21,829,999.00');
INSERT INTO `data_transaksi_bank` VALUES (101, '25/10/21 13.19.49', 'TRANSFER KE | BILL PAYMENT (MPN G2 IDR  ) NO :820211025229541', '15,800,000.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (102, '25/10/21 13.19.51', 'TRANSFER KE | BILL PAYMENT (MPN G2 IDR  ) NO :820211025230016', '316,000.00', '0');
INSERT INTO `data_transaksi_bank` VALUES (103, '25/10/21 14.02.31', 'TRF/PAY/TOP-UP ECHANNEL | 6013010854786945 | OM360002000088880833', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (104, '25/10/21 15.34.25', 'SETOR TUNAI | RPL 127 KPKNL TANGERANG UTK LE | PT. BINANGUN AGRO LESTARI', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (105, '25/10/21 15.51.57', 'TRANSFER DARI | PEMINDAHAN DARI 144845762 Bpk IWAN  KUSTIAWAN | 9880052121101301 Iwan Kustiawan EFNHUP', '0', '84,123,124.00');
INSERT INTO `data_transaksi_bank` VALUES (106, '25/10/21 16.07.25', 'TRF/PAY/TOP-UP ECHANNEL | 5221842154674797 | 00000000300008901987', '0', '150,000.00');
INSERT INTO `data_transaksi_bank` VALUES (107, '25/10/21 17.00.48', 'TRF/PAY/TOP-UP ECHANNEL | 6013010854786945 | OM360002000088884040', '0', '250,000.00');

-- ----------------------------
-- Table structure for ref_jenis
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis`;
CREATE TABLE `ref_jenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_kelompok` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_jenis
-- ----------------------------
INSERT INTO `ref_jenis` VALUES (1, 'Uang Jaminan Lelang', '1');
INSERT INTO `ref_jenis` VALUES (2, 'Pelunasan Lelang', '1');
INSERT INTO `ref_jenis` VALUES (4, 'Lain-lain', '1');
INSERT INTO `ref_jenis` VALUES (5, 'PPh Final', '2');
INSERT INTO `ref_jenis` VALUES (6, 'PNBP', '2');
INSERT INTO `ref_jenis` VALUES (7, 'Pihak Ketiga', '2');

-- ----------------------------
-- Table structure for ref_kpknl
-- ----------------------------
DROP TABLE IF EXISTS `ref_kpknl`;
CREATE TABLE `ref_kpknl`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kpknl` int(11) NULL DEFAULT NULL,
  `nama_kpknl` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ref_rekening
-- ----------------------------
DROP TABLE IF EXISTS `ref_rekening`;
CREATE TABLE `ref_rekening`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_bank` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ref_subjenis
-- ----------------------------
DROP TABLE IF EXISTS `ref_subjenis`;
CREATE TABLE `ref_subjenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_subjenis` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_jenis` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_subjenis
-- ----------------------------
INSERT INTO `ref_subjenis` VALUES (2, 'Bea Permohonan Lelang', '6');
INSERT INTO `ref_subjenis` VALUES (3, 'Bea Lelang', '6');
INSERT INTO `ref_subjenis` VALUES (4, 'Bea Lelang Batal', '6');
INSERT INTO `ref_subjenis` VALUES (5, 'Bea Lelang Penggantian Kutipan', '6');
INSERT INTO `ref_subjenis` VALUES (6, 'Bea Lelang Wanprestasi', '6');
INSERT INTO `ref_subjenis` VALUES (7, 'Biaya Administrasi PPN', '6');
INSERT INTO `ref_subjenis` VALUES (8, 'Jasa Lainnya', '6');
INSERT INTO `ref_subjenis` VALUES (9, 'Pengembalian Uang Jaminan', '7');
INSERT INTO `ref_subjenis` VALUES (10, 'Hasil Bersih Lelang', '7');
INSERT INTO `ref_subjenis` VALUES (11, 'Kelebihan Pelunasan', '7');
INSERT INTO `ref_subjenis` VALUES (12, 'Pemindahbukuan Wanprestasi Lelang', '7');
INSERT INTO `ref_subjenis` VALUES (13, 'Hak Penyerah Piutang', '7');
INSERT INTO `ref_subjenis` VALUES (14, 'Kelebihan Setoran Piutang Negara', '7');
INSERT INTO `ref_subjenis` VALUES (15, 'Uang Jaminan Lelang', '1');
INSERT INTO `ref_subjenis` VALUES (16, 'Pelunasan Lelang', '2');
INSERT INTO `ref_subjenis` VALUES (17, 'Kekurangan Pelunasan Lelang', '2');
INSERT INTO `ref_subjenis` VALUES (18, 'Kelebihan Pelunasan Lelang', '2');
INSERT INTO `ref_subjenis` VALUES (19, 'Angsuran', '3');
INSERT INTO `ref_subjenis` VALUES (20, 'Kelebihan Setoran', '3');
INSERT INTO `ref_subjenis` VALUES (21, 'Dana Dalam Konfirmasi', '4');
INSERT INTO `ref_subjenis` VALUES (22, 'PNBP', '4');
INSERT INTO `ref_subjenis` VALUES (23, 'PPh', '4');

-- ----------------------------
-- Table structure for ref_user
-- ----------------------------
DROP TABLE IF EXISTS `ref_user`;
CREATE TABLE `ref_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_user
-- ----------------------------
INSERT INTO `ref_user` VALUES (1, '198407212006021005', '1');

-- ----------------------------
-- Table structure for system_access
-- ----------------------------
DROP TABLE IF EXISTS `system_access`;
CREATE TABLE `system_access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `sub_sub_menu_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 84 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_access
-- ----------------------------
INSERT INTO `system_access` VALUES (12, 5, 7);
INSERT INTO `system_access` VALUES (14, 6, 7);
INSERT INTO `system_access` VALUES (15, 5, 1);
INSERT INTO `system_access` VALUES (16, 5, 2);
INSERT INTO `system_access` VALUES (17, 5, 3);
INSERT INTO `system_access` VALUES (18, 5, 10);
INSERT INTO `system_access` VALUES (20, 5, 11);
INSERT INTO `system_access` VALUES (21, 6, 9);
INSERT INTO `system_access` VALUES (22, 5, 9);
INSERT INTO `system_access` VALUES (23, 5, 12);
INSERT INTO `system_access` VALUES (24, 5, 13);
INSERT INTO `system_access` VALUES (25, 5, 7);
INSERT INTO `system_access` VALUES (26, 5, 12);
INSERT INTO `system_access` VALUES (27, 5, 13);
INSERT INTO `system_access` VALUES (28, 5, 14);
INSERT INTO `system_access` VALUES (29, 5, 15);
INSERT INTO `system_access` VALUES (30, 5, 16);
INSERT INTO `system_access` VALUES (31, 5, 17);
INSERT INTO `system_access` VALUES (32, 5, 18);
INSERT INTO `system_access` VALUES (33, 5, 19);
INSERT INTO `system_access` VALUES (34, 5, 20);
INSERT INTO `system_access` VALUES (35, 5, 21);
INSERT INTO `system_access` VALUES (36, 5, 22);
INSERT INTO `system_access` VALUES (37, 5, 23);
INSERT INTO `system_access` VALUES (38, 5, 24);
INSERT INTO `system_access` VALUES (39, 5, 25);
INSERT INTO `system_access` VALUES (40, 5, 26);
INSERT INTO `system_access` VALUES (41, 5, 27);
INSERT INTO `system_access` VALUES (42, 5, 28);
INSERT INTO `system_access` VALUES (43, 5, 29);
INSERT INTO `system_access` VALUES (44, 5, 30);
INSERT INTO `system_access` VALUES (45, 5, 31);
INSERT INTO `system_access` VALUES (47, 5, 33);
INSERT INTO `system_access` VALUES (48, 5, 34);
INSERT INTO `system_access` VALUES (49, 5, 35);
INSERT INTO `system_access` VALUES (50, 9, 17);
INSERT INTO `system_access` VALUES (51, 9, 18);
INSERT INTO `system_access` VALUES (53, 9, 36);
INSERT INTO `system_access` VALUES (54, 9, 37);
INSERT INTO `system_access` VALUES (55, 9, 23);
INSERT INTO `system_access` VALUES (56, 9, 24);
INSERT INTO `system_access` VALUES (57, 9, 26);
INSERT INTO `system_access` VALUES (58, 9, 27);
INSERT INTO `system_access` VALUES (59, 9, 28);
INSERT INTO `system_access` VALUES (60, 9, 29);
INSERT INTO `system_access` VALUES (61, 9, 30);
INSERT INTO `system_access` VALUES (62, 9, 31);
INSERT INTO `system_access` VALUES (63, 9, 33);
INSERT INTO `system_access` VALUES (64, 9, 34);
INSERT INTO `system_access` VALUES (65, 9, 35);
INSERT INTO `system_access` VALUES (66, 6, 13);
INSERT INTO `system_access` VALUES (67, 6, 22);
INSERT INTO `system_access` VALUES (68, 5, 38);
INSERT INTO `system_access` VALUES (69, 5, 39);
INSERT INTO `system_access` VALUES (70, 5, 40);
INSERT INTO `system_access` VALUES (71, 10, 7);
INSERT INTO `system_access` VALUES (72, 10, 9);
INSERT INTO `system_access` VALUES (73, 10, 12);
INSERT INTO `system_access` VALUES (74, 10, 14);
INSERT INTO `system_access` VALUES (75, 10, 25);
INSERT INTO `system_access` VALUES (76, 10, 16);
INSERT INTO `system_access` VALUES (77, 10, 19);
INSERT INTO `system_access` VALUES (78, 10, 20);
INSERT INTO `system_access` VALUES (79, 10, 21);
INSERT INTO `system_access` VALUES (80, 5, 42);
INSERT INTO `system_access` VALUES (81, 9, 42);
INSERT INTO `system_access` VALUES (82, 5, 44);
INSERT INTO `system_access` VALUES (83, 10, 44);

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES (1, 'Halaman Utama');
INSERT INTO `system_menu` VALUES (2, 'Data');
INSERT INTO `system_menu` VALUES (3, 'Monitoring');
INSERT INTO `system_menu` VALUES (4, 'Referensi');
INSERT INTO `system_menu` VALUES (5, 'Sistem');

-- ----------------------------
-- Table structure for system_role
-- ----------------------------
DROP TABLE IF EXISTS `system_role`;
CREATE TABLE `system_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_role
-- ----------------------------
INSERT INTO `system_role` VALUES (5, 'Administrator');
INSERT INTO `system_role` VALUES (6, 'Otorisator');
INSERT INTO `system_role` VALUES (9, 'Bendahara Penerimaan');
INSERT INTO `system_role` VALUES (10, 'Verifikator');

-- ----------------------------
-- Table structure for system_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_sub_menu`;
CREATE TABLE `system_sub_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_sub_menu
-- ----------------------------
INSERT INTO `system_sub_menu` VALUES (1, 1, 'Beranda', 'beranda', 'nav-icon fas fa-tachometer-alt');
INSERT INTO `system_sub_menu` VALUES (2, 5, 'Setting', '#', 'nav-icon fas fa-wrench');
INSERT INTO `system_sub_menu` VALUES (21, 3, 'Monitoring', 'monitoring', 'nav-icon fas fa-chart-line');
INSERT INTO `system_sub_menu` VALUES (26, 2, 'Lelang', 'lelang', 'nav-icon fas fa-tasks');
INSERT INTO `system_sub_menu` VALUES (27, 2, 'Piutang', 'piutang', 'nav-icon fas fa-columns');
INSERT INTO `system_sub_menu` VALUES (36, 1, 'Timeline', 'timeline', 'nav-icon fas fa-chart-line');
INSERT INTO `system_sub_menu` VALUES (37, 4, 'Laporan', 'laporan', 'nav-icon fas fa-chart-pie');

-- ----------------------------
-- Table structure for system_sub_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_sub_sub_menu`;
CREATE TABLE `system_sub_sub_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `sub_menu_id` int(11) NULL DEFAULT NULL,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_sub_sub_menu
-- ----------------------------
INSERT INTO `system_sub_sub_menu` VALUES (1, 5, 2, 'Role', 'role', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (2, 5, 2, 'Menu', 'menu', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (3, 5, 2, 'User', 'user', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (7, 2, 26, 'Data Bank', 'transaksi-bank', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (9, 2, 27, 'Data Bank', 'transaksi-bank-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (10, 1, 36, 'Testing', 'testing', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (11, 4, 37, 'Jenis', 'ref_jenis', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (12, 2, 26, 'Penerimaan', 'penerimaan', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (13, 2, 26, 'Pengesahan', 'pengesahan', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (14, 2, 26, 'Rincian Hasil Lelang', 'rincian-hasil', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (15, 2, 26, 'Reklasifikasi', 'reklasifikasi', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (16, 2, 26, 'Pengeluaran', 'pengeluaran', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (17, 2, 26, 'Konfirmasi Pembukuan', 'pembukuan', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (18, 2, 26, 'Konfirmasi Pengeluaran', 'konfirmasi-pengeluaran', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (19, 2, 27, 'Penerimaan', 'penerimaan-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (20, 2, 27, 'Rincian Penerimaan', 'rincian-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (21, 2, 27, 'Pengeluaran', 'pengeluaran-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (22, 2, 27, 'Pengesahan', 'pengesahan-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (23, 2, 27, 'Konfirmasi Pembukuan', 'pembukuan-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (24, 2, 27, 'Konfirmasi Pengeluaran', 'konfirmasi-pengeluaran-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (25, 2, 27, 'Koreksi', 'koreksi-pn', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (26, 4, 37, 'BKU', 'bku', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (27, 4, 37, 'BKU Detail', 'bku-detail', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (28, 4, 37, 'BP Dana Pihak Ketiga', 'bp-dpk', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (29, 4, 37, 'BP PNBP', 'bp-pnbp', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (30, 4, 37, 'BP Pajak', 'bp-pajak', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (31, 1, 1, 'Dashboard', 'beranda', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (33, 3, 21, 'Pengembalian UJL', 'pengembalian-ujl', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (34, 3, 21, 'Penerimaan-Pengeluaran', 'penerimaan-pengeluaran', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (35, 3, 21, 'Dana Tidak Jelas', 'dana-tidak-jelas', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (36, 3, 21, 'Rekening Lelang', 'rekening-lelang', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (37, 3, 21, 'Rekening Piutang', 'rekening-piutang', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (38, 3, 21, 'Belum dibukukan', 'belum-buku', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (39, 3, 21, 'Belum Setor PNBP', 'belum-setor-pnbp', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (40, 3, 21, 'Belum Pindah Buku', 'belum-pindah-buku', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (41, 3, 21, 'PNBP Lewat 1 Hari', 'pnbp-lewat', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (42, 2, 26, 'Kuitansi Pelunasan', 'kuitansi', 'nav-icon fas fa-angle-right');
INSERT INTO `system_sub_sub_menu` VALUES (44, 2, 26, 'UJL Wanprestasi', 'wanprestasi', 'nav-icon fas fa-angle-right');

-- ----------------------------
-- Table structure for system_sub_sub_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_sub_sub_sub_menu`;
CREATE TABLE `system_sub_sub_sub_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `sub_menu_id` int(11) NULL DEFAULT NULL,
  `sub_sub_menu_id` int(11) NULL DEFAULT NULL,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `date_created` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_user
-- ----------------------------
INSERT INTO `system_user` VALUES (1, '198407022003121004', 'Dana Kristiawan', '$2y$10$5TLLsGK6ppGwTZLAH5ZjGuhAZFJsY.GsK/7LJ0KH9wU1GGbNuUhZO', 5, 1635241141);
INSERT INTO `system_user` VALUES (7, '333333333333333333', 'Cepot', '$2y$10$Eqb8FU8OO2Fn9yib6F9wCei.bmb63/NH7s/X4GnfkZVps1aGHPZNu', 6, 1635241153);
INSERT INTO `system_user` VALUES (8, '123456789012345678', 'benma', '$2y$10$Qf3vW6uDl4XpbIsD8oNTj.VrQ3x5boufEJTNmEm2KiPaftcxnsd56', 9, 1635431296);
INSERT INTO `system_user` VALUES (9, '999999999999999999', 'Verifikator', '$2y$10$sHxXA/b4dFQzRGCWh6ipROtdX0ykyK09Ey2bsD14eH5tUtlg5gcBC', 10, 1635432152);

-- ----------------------------
-- View structure for view_menu
-- ----------------------------
DROP VIEW IF EXISTS `view_menu`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_menu` AS select `a`.`id` AS `id_menu`,`a`.`name` AS `nama_menu`,`b`.`id` AS `id_sub_menu`,`b`.`name` AS `nama_sub_menu`,`b`.`url` AS `url_sub_menu`,`b`.`icon` AS `icon_sub_menu`,`c`.`id` AS `id_sub_sub_menu`,`c`.`name` AS `nama_sub_sub_menu`,`c`.`url` AS `url_sub_sub_menu`,`c`.`icon` AS `icon_sub_sub_menu`,`d`.`role_id` AS `role_id` from (((`system_menu` `a` left join `system_sub_menu` `b` on((`a`.`id` = `b`.`menu_id`))) left join `system_sub_sub_menu` `c` on((`b`.`id` = `c`.`sub_menu_id`))) left join `system_access` `d` on((`c`.`id` = `d`.`sub_sub_menu_id`))) ;

SET FOREIGN_KEY_CHECKS = 1;
