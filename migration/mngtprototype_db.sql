-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2017 at 03:27 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mngtprototype_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bus_id` int(7) UNSIGNED NOT NULL COMMENT 'Bus'' Id ( Primary )',
  `bus_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Name',
  `plate_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Plate Number',
  `bus_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Description',
  `bus_type` int(7) UNSIGNED NOT NULL COMMENT 'Bus'' Type ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bus_id`, `bus_name`, `plate_number`, `bus_desc`, `bus_type`, `created_at`, `updated_at`) VALUES
(1, 'Bus 001', 'PAP-IUAQ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 13, '2017-04-08 13:26:28', '2017-04-08 13:26:28'),
(2, 'Bus 002', 'PASQ-NNMN', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 17, '2017-04-08 13:26:49', '2017-04-08 13:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `bus_type`
--

CREATE TABLE `bus_type` (
  `bus_type_id` int(7) UNSIGNED NOT NULL COMMENT 'Bus Type''s Id',
  `bus_type_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus Type''s Name',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bus_type`
--

INSERT INTO `bus_type` (`bus_type_id`, `bus_type_name`, `created_at`, `updated_at`) VALUES
(11, 'Sun Bus ( 35 pax )', '2017-04-05 22:18:55', '2017-04-06 18:34:21'),
(12, 'City Bus ( 20 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(13, 'City Bus ( 14 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(14, 'Jeepney ( 20 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(15, 'LimoTuk ( 11 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(16, 'FG Hybrid Tuk Tuk ( 6 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(17, 'W5 Tuk Tuk ( 5 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(18, 'Revolution ( 5 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(19, 'Solar Car ( 4 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(20, 'E-Van Passenger ( 7-11 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `terminal_id` int(7) UNSIGNED NOT NULL COMMENT 'Terminal ID',
  `terminal_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Terminal Name',
  `latitude` decimal(27,20) NOT NULL COMMENT 'Latitude Value on Google Map',
  `longitude` decimal(27,20) NOT NULL COMMENT 'Longitude Value on Google Map',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`terminal_id`, `terminal_name`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Puregold Head Office', '14.58672955375435400000', '120.98740154288328000000', '2017-04-08 10:35:12', '2017-04-08 12:38:14'),
(2, 'Cebu Oversea', '14.58932529323732000000', '120.98706894896543000000', '2017-04-08 10:50:48', '2017-04-08 12:38:37'),
(3, 'Unilevel Ph', '14.58660023395050800000', '120.99224372883600000000', '2017-04-08 10:59:47', '2017-04-08 12:39:03'),
(4, 'Intra Golf Club', '14.58414416680946600000', '120.97656541846311000000', '2017-04-08 11:05:03', '2017-04-08 11:05:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `bus_id_3` (`bus_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `bus_id_2` (`bus_id`),
  ADD KEY `bus_id_4` (`bus_id`);

--
-- Indexes for table `bus_type`
--
ALTER TABLE `bus_type`
  ADD PRIMARY KEY (`bus_type_id`),
  ADD UNIQUE KEY `bus_type_id_2` (`bus_type_id`),
  ADD KEY `bus_type_id` (`bus_type_id`);

--
-- Indexes for table `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`terminal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus'' Id ( Primary )', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bus_type`
--
ALTER TABLE `bus_type`
  MODIFY `bus_type_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus Type''s Id', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `terminals`
--
ALTER TABLE `terminals`
  MODIFY `terminal_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Terminal ID', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
