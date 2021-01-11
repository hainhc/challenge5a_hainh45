/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : qldaotao

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 10/01/2021 19:48:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for challenge
-- ----------------------------
DROP TABLE IF EXISTS `challenge`;
CREATE TABLE `challenge`  (
  `challengeid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goiy` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`challengeid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of challenge
-- ----------------------------
INSERT INTO `challenge` VALUES (1, 'Phòng SOC có mấy nữ?');
INSERT INTO `challenge` VALUES (2, 'zzzz');

-- ----------------------------
-- Table structure for exercise
-- ----------------------------
DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise`  (
  `ExerciseID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Createtor` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ExerciseFilePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ExerciseID`, `ExerciseFilePath`) USING BTREE,
  INDEX `ExerciseID`(`ExerciseID`) USING BTREE,
  INDEX `exercise_1`(`Createtor`) USING BTREE,
  CONSTRAINT `exercise_1` FOREIGN KEY (`Createtor`) REFERENCES `info` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercise
-- ----------------------------
INSERT INTO `exercise` VALUES (1, 'teacher1', 'exam/teacher1_1.txt', 'Bài 1');
INSERT INTO `exercise` VALUES (2, 'teacher2', 'exam/teacher2_2.txt', 'Bài 2');
INSERT INTO `exercise` VALUES (3, 'z', 'exam/z_1.txt', 'z thêm');
INSERT INTO `exercise` VALUES (4, 'z', 'exam/z_2.txt', 'z thêm lại');

-- ----------------------------
-- Table structure for info
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info`  (
  `Username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `permiss` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`Username`) USING BTREE,
  INDEX `Username`(`Username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of info
-- ----------------------------
INSERT INTO `info` VALUES ('admin', '1', 'admin', 'hainh45@viettel.com.vn', '0963120438', 3);
INSERT INTO `info` VALUES ('student1', '123456a@A', 'Nguyễn Hoàng Hải', 'hainh45@viettel.com.vn', '0963120438', 2);
INSERT INTO `info` VALUES ('student2', '123456a@A', 'Monkey D.Luffy', 'luffy@viettel.com.vn', '03030202', 2);
INSERT INTO `info` VALUES ('teacher1', '123456a@A', '', NULL, NULL, 1);
INSERT INTO `info` VALUES ('teacher2', '123456a@A', '', NULL, NULL, 1);
INSERT INTO `info` VALUES ('x', 'x', 'xx', 'x@viettel.com.vn', '123123123', 2);
INSERT INTO `info` VALUES ('z', '1', 'zz', 'z', 'z', 1);

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `messageid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `messagefrom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `messageto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `messagetext` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `readed` int(1) UNSIGNED ZEROFILL NULL DEFAULT 0,
  PRIMARY KEY (`messageid`) USING BTREE,
  INDEX `mess_from`(`messagefrom`) USING BTREE,
  INDEX `mess_to`(`messageto`) USING BTREE,
  CONSTRAINT `mess_from` FOREIGN KEY (`messagefrom`) REFERENCES `info` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mess_to` FOREIGN KEY (`messageto`) REFERENCES `info` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES (43, 'x', 'student1', '2021-01-09 05:46:20', 'xxxxxxxxxxxxxxxx', 0);
INSERT INTO `message` VALUES (44, 'x', 'z', '2021-01-09 05:52:50', 'xxx', 0);
INSERT INTO `message` VALUES (47, 'z', 'teacher1', '2021-01-10 07:29:51', 'aloha', 0);

-- ----------------------------
-- Table structure for student_exam
-- ----------------------------
DROP TABLE IF EXISTS `student_exam`;
CREATE TABLE `student_exam`  (
  `Student` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Message` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ExerciseID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Student`, `ExerciseID`) USING BTREE,
  INDEX `ste_2`(`ExerciseID`) USING BTREE,
  CONSTRAINT `ste_1` FOREIGN KEY (`Student`) REFERENCES `info` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ste_2` FOREIGN KEY (`ExerciseID`) REFERENCES `exercise` (`ExerciseID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_exam
-- ----------------------------
INSERT INTO `student_exam` VALUES ('student1', NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;
