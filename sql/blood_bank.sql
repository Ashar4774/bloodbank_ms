-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 10:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_org`
--

CREATE TABLE `blood_org` (
  `id` int(255) NOT NULL,
  `blood_id` int(255) NOT NULL,
  `org_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `id` int(255) NOT NULL,
  `org_id` int(255) DEFAULT NULL,
  `abo_type` varchar(2) NOT NULL COMMENT 'The ABO group system gives the letter part of your blood type',
  `rh_system` tinytext NOT NULL COMMENT 'Rh system gives the positive or negative part'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`id`, `org_id`, `abo_type`, `rh_system`) VALUES
(6, 3, 'AB', '+'),
(7, 2, 'B', '+'),
(8, 2, 'AB', '+'),
(9, 2, 'A', '+'),
(10, 3, 'AB', '+');

-- --------------------------------------------------------

--
-- Table structure for table `donars`
--

CREATE TABLE `donars` (
  `id` int(255) NOT NULL,
  `org_id` int(255) DEFAULT NULL,
  `cnic` text DEFAULT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone_no` tinytext NOT NULL,
  `abo_type` varchar(2) NOT NULL,
  `rh_system` tinytext NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donars`
--

INSERT INTO `donars` (`id`, `org_id`, `cnic`, `name`, `address`, `phone_no`, `abo_type`, `rh_system`, `status`) VALUES
(3, 2, '37303-1234567-1', 'Donar1', 'Mirpur', '0333-1234567', 'AB', '+', 'approved'),
(4, 2, '30301-1234567-3', 'Donar2', 'Mirpur', '0333-1234567', 'O', '+', 'approved'),
(6, NULL, '37305-1234567-8', 'Unknown Donar', 'Mirpur', '0321-1234567', 'AB', '+', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `address`, `phone_no`) VALUES
(2, 'Organization2', 'Mirpur', '0555-123345'),
(3, 'Tanzeem-e-amal', 'Mirpur', '0555-123345');

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` int(255) NOT NULL,
  `cnic` text NOT NULL,
  `name` text NOT NULL,
  `phone_no` tinytext NOT NULL,
  `address` text DEFAULT NULL,
  `abo_type` varchar(2) NOT NULL,
  `rh_system` tinytext NOT NULL,
  `bottle_qty` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `cnic`, `name`, `phone_no`, `address`, `abo_type`, `rh_system`, `bottle_qty`, `status`) VALUES
(1, '37301-4747471-1', 'Receiver1', '0302-1234567', 'Mirpur', 'AB', '+', 2, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `cnic` text DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `password` text NOT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `cnic`, `phone_no`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, NULL, 'admin123', 0),
(2, 'ashar muhammad', 'ashar.muhammad74@gmail.com', '37301-4736343-7', '+923341234567', 'Ashar123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_org`
--
ALTER TABLE `blood_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `donars`
--
ALTER TABLE `donars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_org`
--
ALTER TABLE `blood_org`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `donars`
--
ALTER TABLE `donars`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD CONSTRAINT `org_id` FOREIGN KEY (`org_id`) REFERENCES `organizations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
