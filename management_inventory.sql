/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : management_inventory

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 03/06/2019 13:55:27 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `asset_transactions`
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
  `type` tinyint(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `shift` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_fk0` (`status_id`),
  KEY `assets_fk1` (`created_by`),
  CONSTRAINT `assets_fk0` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `assets_fk1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `location_inventories`
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
--  Table structure for `locations`
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
--  Records of `locations`
-- ----------------------------
BEGIN;
INSERT INTO `locations` VALUES ('5', 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', '3', '2019-03-03 15:24:00', '2019-03-03 15:24:00', '41'), ('7', 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', '3', '2019-03-03 15:27:37', '2019-03-03 15:27:37', '41'), ('8', 'Cirebon 1', 'bla', 'Cirebon', 'Indonesia', '1', '2019-03-04 04:01:23', '2019-03-04 04:01:23', '41'), ('9', 'Cirebon 2', 'bla 2', 'Cirebon', 'Indonesia', '1', '2019-03-04 04:01:50', '2019-03-04 04:01:50', '41');
COMMIT;

-- ----------------------------
--  Table structure for `positions`
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `positions`
-- ----------------------------
BEGIN;
INSERT INTO `positions` VALUES ('1', 'Super Admin'), ('2', 'Admin'), ('3', 'User');
COMMIT;

-- ----------------------------
--  Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `status`
-- ----------------------------
BEGIN;
INSERT INTO `status` VALUES ('1', 'active', 'all component active'), ('2', 'inactive', 'all component inactive'), ('3', 'delete', 'all component is deleted');
COMMIT;

-- ----------------------------
--  Table structure for `stock_goods`
-- ----------------------------
DROP TABLE IF EXISTS `stock_goods`;
CREATE TABLE `stock_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL,
  `capacity` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `price` float NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_goods_fk0` (`created_by`),
  CONSTRAINT `stock_goods_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `transaction_goods`
-- ----------------------------
DROP TABLE IF EXISTS `transaction_goods`;
CREATE TABLE `transaction_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `stock_goods_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_goods_fk0` (`location_id`),
  KEY `transaction_goods_fk1` (`stock_goods_id`),
  KEY `transaction_goods_fk2` (`created_by`),
  CONSTRAINT `transaction_goods_fk0` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `transaction_goods_fk1` FOREIGN KEY (`stock_goods_id`) REFERENCES `stock_goods` (`id`),
  CONSTRAINT `transaction_goods_fk2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `users`
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('41', 'akbar 123', 'admin@cohive.co', '123s', '2019-03-03 13:11:39', '2019-03-03 14:04:07', '2', '75166.jpg', '21232f297a57a5a743894a0e4a801fc3'), ('42', 'akbar agustin', 'admin@cohive.co', '66', '2019-03-03 13:43:13', '2019-03-03 13:43:13', '1', '21710.jpg', 'c4ca4238a0b923820dcc509a6f75849b');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
