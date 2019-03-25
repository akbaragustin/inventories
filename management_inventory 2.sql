/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 100131
 Source Host           : localhost:3306
 Source Schema         : management_inventory

 Target Server Type    : MariaDB
 Target Server Version : 100131
 File Encoding         : 65001

 Date: 25/03/2019 14:50:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asset_transactions
-- ----------------------------
DROP TABLE IF EXISTS `asset_transactions`;
CREATE TABLE `asset_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `date_transaction` datetime NOT NULL,
  `location_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `shift` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_fk0` (`status_id`),
  KEY `assets_fk1` (`created_by`),
  CONSTRAINT `assets_fk0` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `assets_fk1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asset_transactions
-- ----------------------------
BEGIN;
INSERT INTO `asset_transactions` VALUES (1, 'akbar agustin', '2019-03-14 04:50:28', '2019-03-16 18:55:56', 3, 2000000, 2, 41, '12852.png', '2019-03-12 00:00:00', 9, 'bla', '1');
INSERT INTO `asset_transactions` VALUES (2, 'akbar agustin', '2019-03-14 04:50:28', '2019-03-14 04:50:28', 3, 2000000, 2, 41, '43983.png', '2019-03-12 00:00:00', 9, 'bla', '1');
INSERT INTO `asset_transactions` VALUES (3, 'akbar agustin', '2019-03-14 06:56:49', '2019-03-14 06:56:49', 3, 2000000, 2, 41, '38461.png', '2019-03-12 00:00:00', 9, 'bla', '1');
INSERT INTO `asset_transactions` VALUES (4, 'Panci', '2019-03-14 15:43:47', '2019-03-14 15:43:47', 3, 2000000, 2, 41, '27883.png', '2019-03-12 00:00:00', 8, 'bla 2', '1');
INSERT INTO `asset_transactions` VALUES (5, 'Katel', '2019-03-14 15:53:57', '2019-03-14 15:53:57', 1, 2000000, 2, 41, '95271.png', '2019-03-20 00:00:00', 8, 'bla', '2');
INSERT INTO `asset_transactions` VALUES (6, 'Coliving Checking', '2019-03-14 15:54:47', '2019-03-14 15:54:47', 1, 232222000, 545, 41, '78452.png', '2019-03-13 00:00:00', 8, 'bla', '2');
COMMIT;

-- ----------------------------
-- Table structure for detail_transaction_goods
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaction_goods`;
CREATE TABLE `detail_transaction_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_path` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `price` float NOT NULL,
  `date_transaction` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_transaction_goods
-- ----------------------------
BEGIN;
INSERT INTO `detail_transaction_goods` VALUES (2, '29917.png', 9, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 41, 2, 232222000, '2019-03-20 00:00:00', 3, 'bla');
INSERT INTO `detail_transaction_goods` VALUES (3, '85703.png', 8, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 41, 1, 232222000, '2019-03-21 00:00:00', 3, 'bla');
COMMIT;

-- ----------------------------
-- Table structure for foods
-- ----------------------------
DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_goods_fk0` (`created_by`),
  CONSTRAINT `stock_goods_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of foods
-- ----------------------------
BEGIN;
INSERT INTO `foods` VALUES (11, 'Gula', '2019-03-19 17:54:35', '2019-03-19 17:54:35', 41, 'kg');
INSERT INTO `foods` VALUES (12, 'Kecap', '2019-03-19 17:54:45', '2019-03-19 17:54:45', 41, 'pcs');
INSERT INTO `foods` VALUES (13, 'aqua', '2019-03-19 17:54:57', '2019-03-19 17:54:57', 41, 'pcs');
INSERT INTO `foods` VALUES (14, 'Gas', '2019-03-19 17:58:33', '2019-03-19 17:58:33', 41, 'pcs');
COMMIT;

-- ----------------------------
-- Table structure for location_inventories
-- ----------------------------
DROP TABLE IF EXISTS `location_inventories`;
CREATE TABLE `location_inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location_inventories_fk0` (`asset_id`),
  KEY `location_inventories_fk1` (`location_id`),
  KEY `location_inventories_fk2` (`created_by`),
  CONSTRAINT `location_inventories_fk0` FOREIGN KEY (`asset_id`) REFERENCES `asset_transactions` (`id`),
  CONSTRAINT `location_inventories_fk1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `location_inventories_fk2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for locations
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_fk0` (`status_id`),
  KEY `locations_fk1` (`created_by`),
  CONSTRAINT `locations_fk0` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `locations_fk1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of locations
-- ----------------------------
BEGIN;
INSERT INTO `locations` VALUES (5, 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', 3, '2019-03-03 15:24:00', '2019-03-03 15:24:00', 41);
INSERT INTO `locations` VALUES (7, 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', 3, '2019-03-03 15:27:37', '2019-03-03 15:27:37', 41);
INSERT INTO `locations` VALUES (8, 'Cirebon 1', 'bla', 'Cirebon', 'Indonesia', 1, '2019-03-04 04:01:23', '2019-03-04 04:01:23', 41);
INSERT INTO `locations` VALUES (9, 'Cirebon 2', 'bla 2', 'Cirebon', 'Indonesia', 1, '2019-03-04 04:01:50', '2019-03-04 04:01:50', 41);
COMMIT;

-- ----------------------------
-- Table structure for positions
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of positions
-- ----------------------------
BEGIN;
INSERT INTO `positions` VALUES (1, 'Super Admin');
INSERT INTO `positions` VALUES (2, 'Admin');
INSERT INTO `positions` VALUES (3, 'User');
COMMIT;

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------
BEGIN;
INSERT INTO `status` VALUES (1, 'active', 'all component active');
INSERT INTO `status` VALUES (2, 'inactive', 'all component inactive');
INSERT INTO `status` VALUES (3, 'delete', 'all component is deleted');
COMMIT;

-- ----------------------------
-- Table structure for transaction_goods
-- ----------------------------
DROP TABLE IF EXISTS `transaction_goods`;
CREATE TABLE `transaction_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_transaction_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` float(11,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_goods_fk0` (`detail_transaction_id`),
  KEY `transaction_goods_fk1` (`food_id`),
  KEY `transaction_goods_fk2` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of transaction_goods
-- ----------------------------
BEGIN;
INSERT INTO `transaction_goods` VALUES (2, 2, 11, 41, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 10);
INSERT INTO `transaction_goods` VALUES (3, 2, 12, 41, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 19);
INSERT INTO `transaction_goods` VALUES (4, 3, 11, 41, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 10);
INSERT INTO `transaction_goods` VALUES (5, 3, 12, 41, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 9);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `position_id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `password` (`password`),
  KEY `users_fk0` (`position_id`),
  CONSTRAINT `users_fk0` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (41, 'akbar 123', 'admin@cohive.co', '123s', '2019-03-03 13:11:39', '2019-03-03 14:04:07', 2, '75166.jpg', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `users` VALUES (42, 'akbar agustin', 'admin@cohive.co', '66', '2019-03-03 13:43:13', '2019-03-03 13:43:13', 1, '21710.jpg', 'c4ca4238a0b923820dcc509a6f75849b');
INSERT INTO `users` VALUES (43, 'anjay', 'akbar.agustin55@gmail.com', '123', '2019-03-14 04:04:28', '2019-03-14 04:04:28', 1, '96052.png', 'E69DC2C09E8DA6259422D987CCBE95B5');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
