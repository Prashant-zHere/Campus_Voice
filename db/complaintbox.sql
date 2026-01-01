-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2025 at 02:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaintbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
create Database complaintbox;

use complaintbox;


CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `department` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `department`) VALUES
('AD-072350556', 'Prahsant', 'fa4185561@gmail.com', '12345678', 'admin'),
('AD-074852629', 'zedd', 'zedd.prashant@gmail.com', '12345678', 'library');

-- --------------------------------------------------------

--
-- Table structure for table `admin_complaint`
--

CREATE TABLE `admin_complaint` (
  `admin_id` varchar(20) NOT NULL,
  `complaint_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_complaint`
--

INSERT INTO `admin_complaint` (`admin_id`, `complaint_id`) VALUES
('AD-074852629', 'CMP-20250316171755'),
('AD-074852629', 'CMP-20250309103550');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `complaint_id` varchar(20) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `cid` int(2) NOT NULL,
  `cname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`cid`, `cname`) VALUES
(1, 'BBA'),
(2, 'BBA[IB]'),
(3, 'BBA[CA]'),
(4, 'BCOM'),
(5, 'BVOC');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_suggestion`
--

CREATE TABLE `complaint_suggestion` (
  `stud_id` varchar(20) NOT NULL,
  `complaint_id` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `subject` varchar(400) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `complaint_id` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(20) NOT NULL,
  `rno` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `year` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `rno`, `name`, `class`, `year`, `email`, `password`) VALUES
('ST-11010', 10, 'Ashutosh', 'BBA', 1, 'vishwakarmaashutosh864@gmail.com', '12345678'),
('ST-11012', 12, 'Abhay Sharma', 'BBA', 1, 'fa4185561@gmail.com', '12345678'),
('ST-21001', 1, 'komal agarwal', 'BBA', 2, 'komalagarwal24102005@gmail.com', '12345678'),
('ST-41074', 74, 'Abhay', 'BBA', 4, 'zedd.prashant@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD UNIQUE KEY `unq` (`file_name`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `complaint_suggestion`
--
ALTER TABLE `complaint_suggestion`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
