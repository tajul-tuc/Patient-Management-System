-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2018 at 09:32 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctors_id` int(100) NOT NULL,
  `doctors_firstName` varchar(50) NOT NULL,
  `doctors_lastName` varchar(50) NOT NULL,
  `doctors_address` varchar(100) NOT NULL,
  `doctors_city` varchar(100) NOT NULL,
  `doctors_email` varchar(100) NOT NULL,
  `doctors_phnNumber` int(12) NOT NULL,
  `doctors_password` varchar(100) NOT NULL,
  `doctors_regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doctors_updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctors_id`, `doctors_firstName`, `doctors_lastName`, `doctors_address`, `doctors_city`, `doctors_email`, `doctors_phnNumber`, `doctors_password`, `doctors_regDate`, `doctors_updationDate`) VALUES
(1, 'Dr', 'Parvaz', 'baddha', 'Dhaka', 'dr@gmail.com', 181, '1234', '2018-05-11 14:06:36', '0000-00-00 00:00:00'),
(2, 'Dr', 'Tajul', 'dhanmondi', 'Dhaka', 'drt@gmail.com', 85657, '1234', '2018-05-11 17:18:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patients_id` int(100) NOT NULL,
  `patients_firstName` varchar(50) NOT NULL,
  `patients_lastName` varchar(50) NOT NULL,
  `patients_address` varchar(100) NOT NULL,
  `patients_city` varchar(100) NOT NULL,
  `patients_email` varchar(100) NOT NULL,
  `patients_phnNumber` int(12) NOT NULL,
  `patients_password` varchar(100) NOT NULL,
  `patients_regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `patients_updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patients_id`, `patients_firstName`, `patients_lastName`, `patients_address`, `patients_city`, `patients_email`, `patients_phnNumber`, `patients_password`, `patients_regDate`, `patients_updationDate`) VALUES
(1, 'Tajul', 'Parvaz', '260/1', 'Dhaka', 'tp@gmail.com', 1781569961, '1234', '2018-05-11 06:55:05', '0000-00-00 00:00:00'),
(2, 'Hello', 'World', '240/45 badda', 'Dhaka', 'hello@gmail.com', 1629553087, '12345', '2018-05-11 09:39:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `patients_id` int(100) NOT NULL,
  `doctors_id` int(100) NOT NULL,
  `prescription` varchar(20) NOT NULL,
  `appoitment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prescriptionCreationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`patients_id`, `doctors_id`, `prescription`, `appoitment_date`, `prescriptionCreationdate`) VALUES
(1, 1, 'ffgb', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(1, 1, 'done', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(2, 1, 'hi its 2', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(1, 1, 'dcvevevev', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(1, 1, 'ddvedsve', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(1, 1, 'Ok fine', '2018-05-12 23:03:28', '2018-05-12 23:03:28'),
(1, 2, 'hashd asgdghagd', '2018-05-12 23:26:53', '2018-05-12 23:26:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctors_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patients_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctors_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patients_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
