/*
 Navicat Premium Data Transfer

 Source Server         : db_YPMB
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_jkt

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 04/05/2024 13:35:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for fanbase
-- ----------------------------
DROP TABLE IF EXISTS `fanbase`;
CREATE TABLE `fanbase`  (
  `id_fanbase` int NOT NULL AUTO_INCREMENT,
  `nama_fanbase` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_fanbase`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fanbase
-- ----------------------------
INSERT INTO `fanbase` VALUES (1, 'MarshaOshi');
INSERT INTO `fanbase` VALUES (2, 'Gitroops');
INSERT INTO `fanbase` VALUES (3, 'Jessination');
INSERT INTO `fanbase` VALUES (5, 'FlorisenID');

-- ----------------------------
-- Table structure for generasi
-- ----------------------------
DROP TABLE IF EXISTS `generasi`;
CREATE TABLE `generasi`  (
  `id_gen` int NOT NULL AUTO_INCREMENT,
  `gen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_gen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of generasi
-- ----------------------------
INSERT INTO `generasi` VALUES (2, 'Generasi 1');
INSERT INTO `generasi` VALUES (3, 'Generasi 2');
INSERT INTO `generasi` VALUES (5, 'Generasi 4');
INSERT INTO `generasi` VALUES (6, 'Generasi 5');
INSERT INTO `generasi` VALUES (7, 'Generasi 6');
INSERT INTO `generasi` VALUES (9, 'Generasi 7');
INSERT INTO `generasi` VALUES (11, 'Generasi 8');
INSERT INTO `generasi` VALUES (12, 'Generasi 9');
INSERT INTO `generasi` VALUES (13, 'Generasi 3');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gol_darah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `horoskop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tinggi_badan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_gen` int NOT NULL,
  `id_fanbase` int NOT NULL,
  PRIMARY KEY (`id_member`) USING BTREE,
  INDEX `fk_fanbase`(`id_fanbase` ASC) USING BTREE,
  INDEX `fk_gen`(`id_gen` ASC) USING BTREE,
  CONSTRAINT `fk_fanbase` FOREIGN KEY (`id_fanbase`) REFERENCES `fanbase` (`id_fanbase`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gen` FOREIGN KEY (`id_gen`) REFERENCES `generasi` (`id_gen`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (5, 'Marsha Lenathea', '9 Januari 2006', ' O', 'Capricorn', '163cm', 'marsha_lenathea.jpg', 12, 1);
INSERT INTO `member` VALUES (6, ' Flora Shafiq', ' 4 April 2005', 'B', ' Aries', ' 149cm', 'flora_shafiq.jpg', 11, 5);

SET FOREIGN_KEY_CHECKS = 1;
