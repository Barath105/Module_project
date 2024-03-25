-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 04:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminhr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `issue` text NOT NULL,
  `file_data` longblob NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `req_date`, `username`, `mail`, `issue`, `file_data`, `file_name`) VALUES
(8, '2023-11-13 06:10:17', 'Harish', 'hash@gmail.com', 'asd', 0x75706c6f6164732f41646d697420636172642e706466, 'Admit card.pdf'),
(9, '2023-11-13 06:11:00', 'sadsad', 'sadasd@gmail.com', 'asdasdasdasd', 0x75706c6f6164732f4b204261726174682e706466, 'K Barath.pdf'),
(10, '2023-11-13 06:12:13', 'Harish', 'hash@gmail.com', 'asd', 0x75706c6f6164732f41646d697420636172642e706466, 'Admit card.pdf'),
(11, '2023-11-13 06:12:30', 'Harish', 'hash@gmail.com', 'asd', 0x75706c6f6164732f41646d697420636172642e706466, 'Admit card.pdf'),
(12, '2023-12-07 03:34:10', 'HI', 'barathmahi632@gmail.com', '12eqwdwqdwdqdq', 0x75706c6f6164732f6172696e2e6a7067, 'arin.jpg'),
(13, '2023-12-28 12:08:38', 'asdasd', 'arin@gmail.com', 'asdasda s', 0x75706c6f6164732f4b204261726174682e6a7067, 'K Barath.jpg'),
(14, '2023-12-28 12:19:34', 'qdasd', 'arin@gmail.com', 'asdasd', 0x75706c6f6164732f4b204261726174682e6a7067, 'K Barath.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`id`, `userid`, `username`, `profile_pic`, `age`, `password`, `DOB`, `gender`, `role`, `organization`, `address`, `phone`, `mail`) VALUES
(1, 'AD12', 'Barath', '', 22, 'barath', '2024-01-06', 'Male', 'Developer', 'SSE Soft Tech', 'Chennai', 21312312, 'barath@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `holidaycalendar`
--

CREATE TABLE `holidaycalendar` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidaycalendar`
--

INSERT INTO `holidaycalendar` (`id`, `date`, `purpose`) VALUES
(1, '2023-10-20', 'Company Holiday');

-- --------------------------------------------------------

--
-- Table structure for table `hratt`
--

CREATE TABLE `hratt` (
  `id` int(11) NOT NULL,
  `hrname` varchar(255) DEFAULT NULL,
  `hrid` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `att1` varchar(255) DEFAULT 'absent',
  `late` varchar(255) DEFAULT NULL,
  `att2` varchar(255) DEFAULT 'absent',
  `att3` varchar(255) DEFAULT 'absent',
  `att4` varchar(255) DEFAULT 'absent',
  `att1_time` time DEFAULT NULL,
  `att2_time` time DEFAULT NULL,
  `att3_time` time DEFAULT NULL,
  `att4_time` time DEFAULT NULL,
  `overall_att` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hratt`
--

INSERT INTO `hratt` (`id`, `hrname`, `hrid`, `attendance_date`, `att1`, `late`, `att2`, `att3`, `att4`, `att1_time`, `att2_time`, `att3_time`, `att4_time`, `overall_att`) VALUES
(2, 'Arin', 101, '2023-10-28', 'absent', NULL, 'present', 'absent', 'absent', NULL, '09:49:10', NULL, NULL, 'Present'),
(3, 'Arin', 101, '2023-10-30', 'present', NULL, 'present', 'present', 'absent', '08:26:50', '08:33:53', '10:44:10', NULL, 'Present'),
(4, 'Arin', 101, '2023-11-02', 'absent', NULL, 'absent', 'present', 'absent', NULL, NULL, '14:07:33', NULL, 'Present'),
(5, 'Arin', 0, '2023-11-30', 'absent', NULL, 'absent', 'present', 'absent', NULL, NULL, '11:55:17', NULL, 'Present'),
(6, 'Arin', 0, '2023-12-07', 'absent', NULL, 'present', 'present', 'absent', NULL, '08:57:03', '14:41:16', NULL, 'Absent'),
(7, 'Arin', 0, '2023-12-08', 'absent', NULL, 'absent', 'present', 'absent', NULL, NULL, '10:05:03', NULL, 'Late'),
(8, 'Arin', 0, '2023-12-11', 'absent', NULL, 'absent', 'present', 'absent', NULL, NULL, '12:10:42', NULL, 'Late'),
(9, 'Arin', 0, '2023-12-18', 'present', NULL, 'absent', 'absent', 'absent', '08:02:42', NULL, NULL, NULL, 'Absent'),
(10, 'Arin', 0, '2023-12-20', 'absent', NULL, 'present', 'absent', 'absent', NULL, '09:44:26', NULL, NULL, ''),
(11, 'Arin', 0, '2024-01-10', 'absent', NULL, 'present', 'absent', 'absent', NULL, '08:49:19', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `hrfeed`
--

CREATE TABLE `hrfeed` (
  `id` int(255) NOT NULL,
  `feeds` text NOT NULL,
  `pdf` longblob NOT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hrfeed`
--

INSERT INTO `hrfeed` (`id`, `feeds`, `pdf`, `pdf_name`, `date`) VALUES
(25, 'Check', 0x75706c6f6164732f4b204261726174682e706466, 'K Barath.pdf', '2023-11-16 14:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `hrinfo`
--

CREATE TABLE `hrinfo` (
  `id` int(255) NOT NULL,
  `hrid` varchar(255) NOT NULL,
  `hrname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `profile_pic` longblob DEFAULT 'default_profile_pic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hrinfo`
--

INSERT INTO `hrinfo` (`id`, `hrid`, `hrname`, `password`, `organization`, `role`, `DOB`, `address`, `phone`, `gender`, `mail`, `profile_pic`) VALUES
(1, 'HR100', 'Barath', 'boss', 'SSE Tech', 'HR', '1995-10-10', 'Chennai', 1234567890, 'Male', 'arin@gmail.com', 0x75706c6f6164732f363566613763356236306639315f4b5f4261726174682e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `hrleave`
--

CREATE TABLE `hrleave` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `leaveType` varchar(50) NOT NULL,
  `casual_leave` int(255) NOT NULL DEFAULT 0,
  `sick_leave` int(255) NOT NULL DEFAULT 4,
  `employeeId` int(50) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `no-of-days` int(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `pdf` longblob NOT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrod`
--

CREATE TABLE `hrod` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `employeeId` varchar(255) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `no-of-days` int(255) NOT NULL,
  `pdf` longblob NOT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrovertime`
--

CREATE TABLE `hrovertime` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `request_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrpassword`
--

CREATE TABLE `hrpassword` (
  `id` int(11) NOT NULL,
  `userid` varchar(11) NOT NULL,
  `new_password` varchar(11) NOT NULL,
  `reenter_password` varchar(11) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hrpassword`
--

INSERT INTO `hrpassword` (`id`, `userid`, `new_password`, `reenter_password`, `status`) VALUES
(10, '1001', 'anuu', 'anuu', 'Completed'),
(11, '1001', 'anuu', 'anuu', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `hrpayslip`
--

CREATE TABLE `hrpayslip` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `request_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hrpayslip`
--

INSERT INTO `hrpayslip` (`id`, `userid`, `username`, `request_on`, `date`, `status`) VALUES
(42, '1001', 'Aaksh', '2024-03-20 08:00:51', '2024-03-20', 'Pending'),
(43, '1002', 'Barath', '2024-03-20 14:38:21', '2024-03-20', 'Pending'),
(44, '1001', 'Aaksh', '2024-03-21 03:32:16', '2024-03-20', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `hrpermission`
--

CREATE TABLE `hrpermission` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `req_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `pdf` longblob DEFAULT NULL,
  `pdf_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrproduct`
--

CREATE TABLE `hrproduct` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `client_mail` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `totalcost` varchar(255) NOT NULL,
  `advance_paid` varchar(255) NOT NULL,
  `amount_remaining` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `current_status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useratt`
--

CREATE TABLE `useratt` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `attendance_date` date NOT NULL,
  `att1` varchar(10) DEFAULT 'absent',
  `late` varchar(255) NOT NULL,
  `att2` varchar(10) DEFAULT 'absent',
  `att1_time` time DEFAULT NULL,
  `late_time` time NOT NULL,
  `att2_time` time DEFAULT NULL,
  `overall_att` varchar(255) NOT NULL,
  `CL` int(255) NOT NULL DEFAULT 12
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useratt`
--

INSERT INTO `useratt` (`id`, `username`, `userid`, `attendance_date`, `att1`, `late`, `att2`, `att1_time`, `late_time`, `att2_time`, `overall_att`, `CL`) VALUES
(17, 'Harish', '1001', '2023-10-18', 'present', 'present', 'present', NULL, '00:00:00', NULL, 'present', 12),
(18, 'Harish', '1001', '2023-10-21', 'present', '', 'present', NULL, '00:00:00', NULL, 'present', 12),
(19, 'Harish', '1001', '2023-10-22', 'present', '', 'present', NULL, '00:00:00', NULL, 'present', 12),
(20, 'Harish', '1001', '2023-10-23', 'present', '', 'present', NULL, '00:00:00', '11:32:13', 'present', 12),
(21, 'Harish', '1001', '2023-10-24', 'present', '', 'present', NULL, '00:00:00', '11:06:51', 'present', 12),
(22, 'Harish', '1001', '2023-10-25', 'present', '', 'present', '08:26:55', '00:00:00', NULL, 'present', 12),
(23, 'Harish', '1001', '2023-10-27', 'present', '', 'present', '08:25:55', '00:00:00', NULL, 'present', 12),
(24, 'Harish', '1001', '2023-10-30', 'present', '', 'present', '08:30:03', '00:00:00', '08:32:27', 'present', 12),
(25, 'Harish', '1001', '2023-11-17', 'absent', '', 'absent', NULL, '00:00:00', NULL, 'absent', 12),
(28, 'Harish', '1001', '2023-11-21', 'absent', '', 'absent', NULL, '00:00:00', NULL, 'absent', 12),
(45, 'Harish', '1001', '2023-11-22', 'present', 'present', 'absent', NULL, '14:37:50', '00:00:00', 'half', 12),
(47, 'Harish', '1001', '2023-11-26', 'present', 'present', 'present', '21:03:08', '21:02:35', '21:04:08', 'present', 12),
(48, 'Arin', '2001', '2023-12-14', 'present', 'present', 'present', '08:59:27', '00:00:00', NULL, 'present', 12),
(49, 'Arin', '2001', '2023-12-27', 'present', '', 'absent', '08:50:25', '00:00:00', NULL, 'absent', 12),
(50, 'Harish', '1001', '2023-12-27', 'present', 'present', 'present', '08:54:14', '00:00:00', NULL, 'present', 12),
(51, 'Harish', '1001', '2023-12-28', 'present', '', 'absent', '10:15:57', '00:00:00', NULL, 'absent', 12),
(52, 'Harish', '1001', '2024-01-21', 'absent', '', 'absent', NULL, '00:00:00', NULL, 'absent', 12),
(80, 'Harish', '1001', '2024-01-31', 'present', '', 'absent', '10:02:22', '00:00:00', NULL, 'absent', 12),
(81, 'Harish', '1001', '2024-02-03', 'absent', '', 'present', NULL, '00:00:00', '11:05:48', 'absent', 12),
(82, 'Harish', '1001', '2024-02-19', 'present', '', 'absent', '10:03:10', '00:00:00', NULL, 'absent', 12),
(83, 'Harish', '1001', '2024-02-23', 'absent', '', 'present', NULL, '00:00:00', '11:37:18', 'absent', 12),
(88, 'Harish', '1001', '2024-02-28', 'present', '', 'present', '20:15:30', '00:00:00', '20:16:40', 'present', 12),
(89, 'Harish', '1001', '2024-03-13', 'absent', '', 'present', NULL, '00:00:00', '12:13:07', 'absent', 12),
(90, 'Anu', '1001', '2024-03-14', 'absent', '', 'present', NULL, '00:00:00', '13:36:45', 'absent', 12),
(92, 'Anu', '1001', '2024-03-18', 'absent', '', 'present', NULL, '00:00:00', '15:16:45', 'absent', 12),
(94, 'Aaksh', '1001', '2024-03-19', 'absent', '', 'present', NULL, '00:00:00', '14:36:00', 'absent', 12),
(95, 'Aaksh', '1001', '2024-03-20', 'present', '', 'present', NULL, '00:00:00', '13:30:08', 'present', 12),
(96, 'Aaksh', '1001', '2024-03-24', 'absent', '', 'present', NULL, '00:00:00', '12:46:56', 'absent', 12);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_pic` longblob NOT NULL,
  `age` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `basic_salary` int(255) NOT NULL DEFAULT 50000,
  `house_rent` int(255) NOT NULL DEFAULT 5000,
  `tax` int(255) NOT NULL DEFAULT 1000,
  `provident_fund` int(255) NOT NULL DEFAULT 500
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `userid`, `username`, `profile_pic`, `age`, `password`, `DOB`, `gender`, `role`, `organization`, `address`, `phone`, `mail`, `basic_salary`, `house_rent`, `tax`, `provident_fund`) VALUES
(1, '1001', 'Aaksh', 0x75706c6f6164732f363566613734383638646132345f4b204261726174682e6a7067, 22, 'aaksh', '2023-12-10', 'male', 'Backend', 'SSE Soft Tech', 'Chennai', '1232432424', 'aaksh@gmail.com', 50000, 5000, 1000, 500),
(2, '1002', 'Barath', '', 0, 'barath', '2024-03-18', 'Male', 'Web Developer', 'SSE', 'Erode', '123456', 'barath@gmail.com', 50000, 5000, 1000, 500),
(3, '1003', 'Anu', '', 0, 'anu', '2024-03-18', 'Female', 'Software Testing', 'SSE', 'Chennai', '242341', 'anu@gmail.com', 50000, 5000, 1000, 500),
(4, '1004', 'Sunil', '', 0, 'sunil', '2024-03-18', 'Male', 'Software Testing', 'SSE', 'Chennai', '1212412123', 'sunil@gmail.com', 50000, 5000, 1000, 500),
(5, '1005', 'Sujith', '', 0, 'sujith', '2024-03-18', 'Male', 'Web Developer', 'SSE', 'Chennai', '213123', 'sujith@gmail.com', 50000, 5000, 1000, 500),
(6, '1011', 'Shyam', '', 0, 'shyam', '2024-03-18', 'Male', 'UI/UX', 'SSE', 'Chennai', '12312', 'shyam@gmail.com', 50000, 5000, 1000, 500),
(7, '1012', 'Priya', '', 0, 'anu', '2024-03-18', 'Female', 'UI/UX', 'SSE', 'Chennai', '123231', 'anu@gmail.com', 50000, 5000, 1000, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidaycalendar`
--
ALTER TABLE `holidaycalendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hratt`
--
ALTER TABLE `hratt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrfeed`
--
ALTER TABLE `hrfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrinfo`
--
ALTER TABLE `hrinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrleave`
--
ALTER TABLE `hrleave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrod`
--
ALTER TABLE `hrod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrovertime`
--
ALTER TABLE `hrovertime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrpassword`
--
ALTER TABLE `hrpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrpayslip`
--
ALTER TABLE `hrpayslip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrpermission`
--
ALTER TABLE `hrpermission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrproduct`
--
ALTER TABLE `hrproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useratt`
--
ALTER TABLE `useratt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `holidaycalendar`
--
ALTER TABLE `holidaycalendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hratt`
--
ALTER TABLE `hratt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hrfeed`
--
ALTER TABLE `hrfeed`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hrinfo`
--
ALTER TABLE `hrinfo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrleave`
--
ALTER TABLE `hrleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `hrod`
--
ALTER TABLE `hrod`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hrovertime`
--
ALTER TABLE `hrovertime`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hrpassword`
--
ALTER TABLE `hrpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hrpayslip`
--
ALTER TABLE `hrpayslip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `hrpermission`
--
ALTER TABLE `hrpermission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `hrproduct`
--
ALTER TABLE `hrproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `useratt`
--
ALTER TABLE `useratt`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
