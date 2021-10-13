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

 Date: 13/10/2021 15:38:16
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
  `tanggal` int(11) NULL DEFAULT NULL,
  `jurnal_id` int(11) NULL DEFAULT NULL,
  `uraian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nominal_debet` decimal(64, 0) NULL DEFAULT NULL,
  `nominal_kredit` decimal(64, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ref_jenis
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis`;
CREATE TABLE `ref_jenis`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_kelompok` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ref_jenis
-- ----------------------------
INSERT INTO `ref_jenis` VALUES (1, 'Uang Jaminan Lelang', '1');
INSERT INTO `ref_jenis` VALUES (2, 'Pelunasan_Lelang', '1');
INSERT INTO `ref_jenis` VALUES (4, 'Lain-lain', '1');
INSERT INTO `ref_jenis` VALUES (5, 'PPh Final', '2');
INSERT INTO `ref_jenis` VALUES (6, 'PNBP', '2');
INSERT INTO `ref_jenis` VALUES (7, 'Pihak Ketiga', '2');

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

SET FOREIGN_KEY_CHECKS = 1;
