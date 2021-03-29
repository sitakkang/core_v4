-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 09:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_core_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `conf_level`
--

CREATE TABLE `conf_level` (
  `id_level` tinyint(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_level`
--

INSERT INTO `conf_level` (`id_level`, `name`) VALUES
(1, 'Superadmin'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `conf_menu`
--

CREATE TABLE `conf_menu` (
  `id_menu` int(10) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `icon2` varchar(150) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `akses` tinyint(1) NOT NULL,
  `sub` tinyint(1) NOT NULL,
  `level` text NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_menu`
--

INSERT INTO `conf_menu` (`id_menu`, `icon`, `icon2`, `name`, `link`, `status`, `akses`, `sub`, `level`, `position`) VALUES
(1, 'fa-desktop', '', 'Dashboard', 'home', 1, 1, 1, '\"1\",\"2\"', 1),
(2, 'fa-cogs', '', 'Configuration', 'admin/gen_modul', 1, 1, 1, '\"1\",\"2\"', 2);

-- --------------------------------------------------------

--
-- Table structure for table `conf_submenu`
--

CREATE TABLE `conf_submenu` (
  `id_submenu` int(5) NOT NULL,
  `id_menu` int(5) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `icon2` varchar(150) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `level` text NOT NULL,
  `position` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `conf_users`
--

CREATE TABLE `conf_users` (
  `id_user` int(10) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `salt` varchar(15) NOT NULL,
  `level` tinyint(2) NOT NULL,
  `last_login` datetime NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `conf_users`
--

INSERT INTO `conf_users` (`id_user`, `fullname`, `avatar`, `username`, `password`, `salt`, `level`, `last_login`, `ip_address`, `status`) VALUES
(1, 'Superadmin', 'img/avatar/6U6lk2At.jpg', 'admin', '89a0c6ee2ad740022ce185004dd64cca98c04b51', 'Wb8e.?s5', 1, '2021-02-16 12:04:44', '::1', 1),
(2, 'Ardi S', '', 'ardi', '00cc677ebf28c2788351082fe42ccc8982437a9c', '+qt_a0Wy', 1, '0000-00-00 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_number` varchar(25) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_number`, `item_name`) VALUES
(1, '15000001', 'Laptop IMIP'),
(2, '15000002', 'Komputer IMIP'),
(3, '15000003', 'Seragam IMIP'),
(4, '15000004', 'Buku IMIP'),
(7, '15000005', 'Manchess IMIP');

-- --------------------------------------------------------

--
-- Table structure for table `items_brands`
--

CREATE TABLE `items_brands` (
  `id` int(8) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_brands`
--

INSERT INTO `items_brands` (`id`, `name`, `description`) VALUES
(6, 'Aqua', '600 ml'),
(7, 'Aqua', '300 ml'),
(8, 'Aqua', '900 ml');

-- --------------------------------------------------------

--
-- Table structure for table `items_type`
--

CREATE TABLE `items_type` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_type`
--

INSERT INTO `items_type` (`id`, `name`, `description`) VALUES
(1, 'Bumbu', 'Bumbu masak'),
(2, 'Capcai', 'Capcay');

-- --------------------------------------------------------

--
-- Table structure for table `items_unit`
--

CREATE TABLE `items_unit` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_unit`
--

INSERT INTO `items_unit` (`id`, `name`, `description`) VALUES
(1, 'Kg', 'Kilogram'),
(3, 'Gr', 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `request_items`
--

CREATE TABLE `request_items` (
  `request_number` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `user` int(8) NOT NULL,
  `status` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_items`
--

INSERT INTO `request_items` (`request_number`, `date`, `user`, `status`) VALUES
('100000', '2021-02-15', 1, 1),
('10001', '2021-02-15', 1, 1),
('1002', '0000-00-00', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `request_items_detail`
--

CREATE TABLE `request_items_detail` (
  `id` int(8) NOT NULL,
  `request_items` varchar(25) NOT NULL,
  `items` int(8) NOT NULL,
  `items_unit` int(8) NOT NULL,
  `items_brands` int(8) NOT NULL,
  `items_type` int(8) NOT NULL,
  `total` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_items_detail`
--

INSERT INTO `request_items_detail` (`id`, `request_items`, `items`, `items_unit`, `items_brands`, `items_type`, `total`) VALUES
(1, '1002', 1, 1, 6, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `temp_login`
--

CREATE TABLE `temp_login` (
  `id_temp` int(10) NOT NULL,
  `id_user` int(5) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_login`
--

INSERT INTO `temp_login` (`id_temp`, `id_user`, `tanggal`, `ip_address`, `nama_user`) VALUES
(1, 1, '2021-02-11 14:51:12', '::1', 'Superadmin'),
(2, 1, '2021-02-13 18:14:32', '::1', 'Superadmin'),
(3, 1, '2021-02-13 21:40:49', '::1', 'Superadmin'),
(4, 1, '2021-02-14 21:31:25', '::1', 'Superadmin'),
(5, 1, '2021-02-15 11:59:50', '::1', 'Superadmin'),
(6, 1, '2021-02-15 14:00:51', '::1', 'Superadmin'),
(7, 1, '2021-02-15 20:49:18', '::1', 'Superadmin'),
(8, 1, '2021-02-15 22:13:44', '::1', 'Superadmin'),
(9, 1, '2021-02-16 12:04:44', '::1', 'Superadmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conf_level`
--
ALTER TABLE `conf_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `conf_menu`
--
ALTER TABLE `conf_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `conf_users`
--
ALTER TABLE `conf_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_number` (`item_number`);

--
-- Indexes for table `items_brands`
--
ALTER TABLE `items_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_type`
--
ALTER TABLE `items_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_unit`
--
ALTER TABLE `items_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_items`
--
ALTER TABLE `request_items`
  ADD PRIMARY KEY (`request_number`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `request_items_detail`
--
ALTER TABLE `request_items_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items` (`items`,`items_unit`,`items_brands`,`items_type`),
  ADD KEY `request_items` (`request_items`),
  ADD KEY `items_brands` (`items_brands`),
  ADD KEY `items_type` (`items_type`),
  ADD KEY `items_unit` (`items_unit`);

--
-- Indexes for table `temp_login`
--
ALTER TABLE `temp_login`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conf_level`
--
ALTER TABLE `conf_level`
  MODIFY `id_level` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conf_menu`
--
ALTER TABLE `conf_menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  MODIFY `id_submenu` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_users`
--
ALTER TABLE `conf_users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items_brands`
--
ALTER TABLE `items_brands`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items_type`
--
ALTER TABLE `items_type`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items_unit`
--
ALTER TABLE `items_unit`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_items_detail`
--
ALTER TABLE `request_items_detail`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_login`
--
ALTER TABLE `temp_login`
  MODIFY `id_temp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_items`
--
ALTER TABLE `request_items`
  ADD CONSTRAINT `request_items_ibfk_1` FOREIGN KEY (`user`) REFERENCES `conf_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_items_detail`
--
ALTER TABLE `request_items_detail`
  ADD CONSTRAINT `request_items_detail_ibfk_2` FOREIGN KEY (`items_brands`) REFERENCES `items_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_items_detail_ibfk_3` FOREIGN KEY (`items_type`) REFERENCES `items_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_items_detail_ibfk_4` FOREIGN KEY (`items_unit`) REFERENCES `items_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_items_detail_ibfk_5` FOREIGN KEY (`request_items`) REFERENCES `request_items` (`request_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_items_detail_ibfk_6` FOREIGN KEY (`items`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
