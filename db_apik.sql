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

 Date: 13/10/2021 13:32:07
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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_contoh
-- ----------------------------
INSERT INTO `data_contoh` VALUES (1, 1213, 'hhhh');
INSERT INTO `data_contoh` VALUES (2, 21212, 'jjjjj');
INSERT INTO `data_contoh` VALUES (3, 21212, 'hkhl');

SET FOREIGN_KEY_CHECKS = 1;
