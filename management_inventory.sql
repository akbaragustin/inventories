-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 06:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_transactions`
--

CREATE TABLE `asset_transactions` (
  `id` int(11) NOT NULL,
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
  `shift` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_transactions`
--

INSERT INTO `asset_transactions` (`id`, `name`, `created_at`, `updated_at`, `status_id`, `price`, `quantity`, `created_by`, `file_path`, `date_transaction`, `location_id`, `description`, `shift`) VALUES
(1, 'akbar agustin', '2019-03-14 04:50:28', '2019-03-16 18:55:56', 3, 2000000, 2, 41, '12852.png', '2019-03-12 00:00:00', 9, 'bla', '1'),
(2, 'akbar agustin', '2019-03-14 04:50:28', '2019-03-14 04:50:28', 3, 2000000, 2, 41, '43983.png', '2019-03-12 00:00:00', 9, 'bla', '1'),
(3, 'akbar agustin', '2019-03-14 06:56:49', '2019-03-14 06:56:49', 3, 2000000, 2, 41, '38461.png', '2019-03-12 00:00:00', 9, 'bla', '1'),
(4, 'Panci', '2019-03-14 15:43:47', '2019-03-14 15:43:47', 3, 2000000, 2, 41, '27883.png', '2019-03-12 00:00:00', 8, 'bla 2', '1'),
(5, 'Katel', '2019-03-14 15:53:57', '2019-03-14 15:53:57', 3, 2000000, 2, 41, '95271.png', '2019-03-20 00:00:00', 8, 'bla', '2'),
(6, 'Coliving Checking', '2019-03-14 15:54:47', '2019-03-14 15:54:47', 3, 232222000, 545, 41, '78452.png', '2019-03-13 00:00:00', 8, 'bla', '2'),
(7, 'Katel', '2019-04-14 15:10:22', '2019-04-14 15:10:40', 1, 9090850, 12, 43, '28736.jpeg', '2019-03-21 00:00:00', 9, '23sdsd', '2');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction_goods`
--

CREATE TABLE `detail_transaction_goods` (
  `id` int(11) NOT NULL,
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
  `income` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaction_goods`
--

INSERT INTO `detail_transaction_goods` (`id`, `file_path`, `location_id`, `created_at`, `updated_at`, `created_by`, `shift`, `price`, `date_transaction`, `status_id`, `description`, `income`) VALUES
(2, '29917.png', 9, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 41, 2, 232222000, '2019-03-20 00:00:00', 2, 'bla', 0),
(3, '85703.png', 8, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 41, 1, 232222000, '2019-03-21 00:00:00', 2, 'bla', 0),
(4, '40687.jpeg', 8, '2019-04-13 19:54:49', '2019-04-13 19:54:49', 43, 1, 9090850, '2019-03-20 00:00:00', 3, '23', 1),
(5, '89501.jpeg', 8, '2019-04-13 20:51:33', '2019-04-13 20:51:33', 43, 2, 2333330000, '2019-04-14 00:00:00', 1, '23sdsd', 1),
(6, '78167.jpeg', 8, '2019-04-14 10:58:54', '2019-04-14 10:58:54', 43, 2, 2333330000, '2019-04-14 00:00:00', 3, '23', 1),
(9, '48155.jpeg', 8, '2019-04-14 11:05:54', '2019-04-14 11:05:54', 43, 2, 2333330000, '2019-04-14 00:00:00', 3, '23', 1),
(10, '64549.jpeg', 8, '2019-04-14 11:06:23', '2019-04-14 11:06:23', 43, 2, 2333330000, '2019-04-14 00:00:00', 3, '23sdsd', 1),
(11, '53994.jpeg', 9, '2019-04-14 11:07:08', '2019-04-14 11:07:08', 43, 2, 2333330000, '2019-04-14 00:00:00', 3, '23', 1),
(14, '79402.jpeg', 9, '2019-04-14 11:10:42', '2019-04-14 11:10:42', 43, 2, 9090850, '2019-04-14 00:00:00', 1, '23', 1),
(15, '92142.jpeg', 9, '2019-04-14 11:13:44', '2019-04-14 11:13:44', 43, 2, 2333330000, '2019-04-14 00:00:00', 1, '23sdsd', 1),
(16, '21106.jpeg', 8, '2019-04-14 11:14:23', '2019-04-14 11:14:23', 43, 2, 9090850, '2019-04-14 00:00:00', 1, '23', 0),
(17, '58656.jpeg', 9, '2019-04-14 14:57:52', '2019-04-14 14:57:52', 43, 2, 2222220, '2019-04-12 00:00:00', 1, '23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `created_at`, `updated_at`, `created_by`, `unit`) VALUES
(11, 'Gula', '2019-03-19 10:54:35', '2019-03-19 17:54:35', 41, 'kg'),
(12, 'Kecap', '2019-03-19 10:54:45', '2019-03-19 17:54:45', 41, 'pcs'),
(13, 'aqua', '2019-03-19 10:54:57', '2019-03-19 17:54:57', 41, 'pcs'),
(14, 'Gas', '2019-03-19 10:58:33', '2019-03-19 17:58:33', 41, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `city`, `country`, `status_id`, `created_at`, `updated_at`, `created_by`) VALUES
(5, 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', 3, '2019-03-03 15:24:00', '2019-03-03 15:24:00', 41),
(7, 'akbar agustin', 'bla', 'Jakarta', 'Indonesia', 3, '2019-03-03 15:27:37', '2019-03-03 15:27:37', 41),
(8, 'Cirebon 1', 'bla', 'Cirebon', 'Indonesia', 1, '2019-03-04 04:01:23', '2019-04-14 16:17:10', 43),
(9, 'Cirebon 2', 'bla 2', 'Cirebon', 'Indonesia', 1, '2019-03-04 04:01:50', '2019-03-04 04:01:50', 41),
(10, 'testing', '23sdsd', 'sd21', 'Indonesia', 1, '2019-04-14 16:16:51', '2019-04-14 16:16:51', 43);

-- --------------------------------------------------------

--
-- Table structure for table `location_inventories`
--

CREATE TABLE `location_inventories` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `description`) VALUES
(1, 'active', 'all component active'),
(2, 'inactive', 'all component inactive'),
(3, 'delete', 'all component is deleted');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_goods`
--

CREATE TABLE `transaction_goods` (
  `id` int(11) NOT NULL,
  `detail_transaction_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` float(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_goods`
--

INSERT INTO `transaction_goods` (`id`, `detail_transaction_id`, `food_id`, `created_by`, `created_at`, `updated_at`, `quantity`) VALUES
(2, 2, 11, 41, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 10),
(3, 2, 12, 41, '2019-03-20 08:29:16', '2019-03-20 08:29:16', 19),
(4, 3, 11, 41, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 10),
(5, 3, 12, 41, '2019-03-20 17:30:54', '2019-03-20 17:30:54', 9),
(6, 4, 11, 43, '2019-04-13 19:54:49', '2019-04-13 19:54:49', 2),
(7, 4, 12, 43, '2019-04-13 19:54:49', '2019-04-13 19:54:49', 2),
(8, 5, 11, 43, '2019-04-13 20:51:33', '2019-04-13 20:51:33', 2),
(9, 5, 12, 43, '2019-04-13 20:51:33', '2019-04-13 20:51:33', 5),
(10, 6, 11, 43, '2019-04-14 10:58:54', '2019-04-14 10:58:54', 2),
(11, 6, 12, 43, '2019-04-14 10:58:54', '2019-04-14 10:58:54', 1),
(12, 9, 11, 43, '2019-04-14 11:05:54', '2019-04-14 11:05:54', 3),
(13, 9, 12, 43, '2019-04-14 11:05:54', '2019-04-14 11:05:54', 0),
(14, 10, 11, 43, '2019-04-14 11:06:23', '2019-04-14 11:06:23', 0),
(15, 10, 12, 43, '2019-04-14 11:06:23', '2019-04-14 11:06:23', 0),
(16, 11, 11, 43, '2019-04-14 11:07:08', '2019-04-14 11:07:08', 8),
(17, 11, 12, 43, '2019-04-14 11:07:08', '2019-04-14 11:07:08', 0),
(18, 14, 11, 43, '2019-04-14 11:10:42', '2019-04-14 11:10:42', 0),
(19, 14, 12, 43, '2019-04-14 11:10:42', '2019-04-14 11:10:42', 19),
(20, 15, 11, 43, '2019-04-14 11:13:44', '2019-04-14 11:13:44', 2),
(21, 16, 11, 43, '2019-04-14 11:14:23', '2019-04-14 11:14:23', 100),
(22, 17, 11, 43, '2019-04-14 14:57:52', '2019-04-14 14:57:52', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `position_id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `date_payday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `created_at`, `updated_at`, `position_id`, `file_path`, `password`, `date_payday`) VALUES
(41, 'akbar 123', 'admin@cohive.co', '123s', '2019-03-03 13:11:39', '2019-03-03 14:04:07', 2, '75166.jpg', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00'),
(42, 'akbar agustin', 'admin@cohive.co', '66', '2019-03-03 13:43:13', '2019-03-03 13:43:13', 1, '21710.jpg', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00'),
(43, 'anjay', 'akbar.agustin55@gmail.com', '123', '2019-03-14 04:04:28', '2019-03-14 04:04:28', 1, '96052.png', 'E69DC2C09E8DA6259422D987CCBE95B5', '2019-04-14'),
(44, 'testing', 'akbar.testing@gmail.com', '123123', '2019-04-14 12:10:56', '2019-04-14 12:10:56', 1, '68379.jpeg', '4cd1daae40762c819c248eb9a99cd678', '2019-04-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assets_fk0` (`status_id`),
  ADD KEY `assets_fk1` (`created_by`);

--
-- Indexes for table `detail_transaction_goods`
--
ALTER TABLE `detail_transaction_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_goods_fk0` (`created_by`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_fk0` (`status_id`),
  ADD KEY `locations_fk1` (`created_by`);

--
-- Indexes for table `location_inventories`
--
ALTER TABLE `location_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_inventories_fk0` (`asset_id`),
  ADD KEY `location_inventories_fk1` (`location_id`),
  ADD KEY `location_inventories_fk2` (`created_by`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_goods`
--
ALTER TABLE `transaction_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_goods_fk0` (`detail_transaction_id`),
  ADD KEY `transaction_goods_fk1` (`food_id`),
  ADD KEY `transaction_goods_fk2` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `users_fk0` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_transaction_goods`
--
ALTER TABLE `detail_transaction_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location_inventories`
--
ALTER TABLE `location_inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_goods`
--
ALTER TABLE `transaction_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset_transactions`
--
ALTER TABLE `asset_transactions`
  ADD CONSTRAINT `assets_fk0` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `assets_fk1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `stock_goods_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_fk0` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `locations_fk1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `location_inventories`
--
ALTER TABLE `location_inventories`
  ADD CONSTRAINT `location_inventories_fk0` FOREIGN KEY (`asset_id`) REFERENCES `asset_transactions` (`id`),
  ADD CONSTRAINT `location_inventories_fk1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `location_inventories_fk2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
