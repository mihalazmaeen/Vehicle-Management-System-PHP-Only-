-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2022 at 06:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_number` varchar(255) NOT NULL,
  `car_licence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `car_name`, `car_number`, `car_licence`) VALUES
(1, 'Toyota Allion', 'TA-001', 'TA-001L'),
(2, 'Toyota Corolla', 'TC-001', 'TC-001L'),
(3, 'LancerX', 'MBL-001', 'MBL-001L');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `commission_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `commision_amount` float NOT NULL,
  `driver_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`commission_id`, `trip_id`, `commision_amount`, `driver_name`) VALUES
(20, 16, 2550, 'Alex'),
(21, 17, 3910, 'John');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `district_distance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`, `district_distance`) VALUES
(1, 'Dhaka', 90),
(2, 'Rajshahi', 90),
(3, 'Tangail', 50),
(4, 'Mymensingh', 75),
(5, 'Cumilla', 76),
(6, 'Bogura', 85),
(7, 'Sirajganj', 78),
(8, 'Sylhet', 65);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `d_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `car_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`d_id`, `car_id`, `driver_name`, `phone`, `address`, `car_name`) VALUES
(1, 1, 'Alex', '01918100000', 'Khilgaon', 'Toyota Allion'),
(2, 2, 'David', '01615600000', 'Uttara', 'Toyota Corolla'),
(3, 3, 'John', '01314500000', 'Mirpur', 'LancerX');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `trip_id`, `type`, `item`, `quantity`, `cost`) VALUES
(20, 16, 'Tyre Burst', '1000', 3, 3000),
(21, 17, 'Tyre Burst', '1000', 4, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `road_cost`
--

CREATE TABLE `road_cost` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `r_type` varchar(255) NOT NULL,
  `r_amount` int(11) NOT NULL,
  `r_quantity` int(11) NOT NULL,
  `r_total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `road_cost`
--

INSERT INTO `road_cost` (`id`, `trip_id`, `r_type`, `r_amount`, `r_quantity`, `r_total_cost`) VALUES
(11, 16, 'Toll', 1000, 2, 2000),
(12, 17, 'Toll', 1500, 2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `today_date` date NOT NULL DEFAULT current_timestamp(),
  `trip_date` date NOT NULL,
  `car_number` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `gross_income` int(11) NOT NULL,
  `net_income` int(11) NOT NULL,
  `road_cost` int(11) NOT NULL,
  `maintenance_cost` int(11) NOT NULL,
  `driver_commission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `today_date`, `trip_date`, `car_number`, `driver_name`, `gross_income`, `net_income`, `road_cost`, `maintenance_cost`, `driver_commission`) VALUES
(16, '2022-09-25', '2022-09-26', 'TA-001', 'Alex', 22000, 14450, 2000, 3000, 2550),
(17, '2022-09-25', '2022-09-27', 'MBL-001', 'John', 30000, 19090, 3000, 4000, 3910);

-- --------------------------------------------------------

--
-- Table structure for table `trip_infos`
--

CREATE TABLE `trip_infos` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `destination_from` varchar(255) DEFAULT NULL,
  `destination_to` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip_infos`
--

INSERT INTO `trip_infos` (`id`, `trip_id`, `destination_from`, `destination_to`) VALUES
(16, 16, 'Dhaka', 'Rajshahi'),
(17, 16, 'Khulna', 'Sylhet'),
(18, 17, 'Khulna', 'Rajshahi'),
(19, 17, 'Mymensingh', 'Kishorganj');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`commission_id`),
  ADD KEY `commission_ibfk_1` (`trip_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `relation_1` (`car_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `road_cost`
--
ALTER TABLE `road_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_infos`
--
ALTER TABLE `trip_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_infos_ibfk_1` (`trip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `commission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `road_cost`
--
ALTER TABLE `road_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `trip_infos`
--
ALTER TABLE `trip_infos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commission`
--
ALTER TABLE `commission`
  ADD CONSTRAINT `commission_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `relation_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `road_cost`
--
ALTER TABLE `road_cost`
  ADD CONSTRAINT `road_cost_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_infos`
--
ALTER TABLE `trip_infos`
  ADD CONSTRAINT `trip_infos_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
