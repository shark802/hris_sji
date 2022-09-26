-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2018 at 08:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`) VALUES
(1, 'nurhodelta', '$2y$10$fCOiMky4n5hCJx3cpsG20Od4wHtlkCLKmO6VLobJNRIg9ooHTkgjK', 'Neovic', 'Devierte', 'facebook-profile-image.jpeg', '2018-04-30'),
(2, 'jpacia', '$2y$10$fCOiMky4n5hCJx3cpsG20Od4wHtlkCLKmO6VLobJNRIg9ooHTkgjK', 'Janrenzo', 'Pacia', 'facebook-profile-image.jpeg', '2018-04-30'),
(3, 'jdelosreyes', '$2y$10$PNRUPexnXBe3yLajFBIW6uTOQrQPqU3xoZ77Kftlj/LWhwYxJ8Nza', 'Jason', 'Delos Reyes', 'jd.jpg', '2018-04-30'),
(4, 'jcordova', '$2y$10$LaWWi1.XlUpUKQtLPMlnHeUYWsjen9evnMaByNITGBOGuR2JBPY5u', 'Jerico', 'Cordova', 'indexss.jpg', '2018-04-30'),
(5, 'jhilardino', '$2y$10$f86QEm76Sg0RzXLm80VrPeWigLAai32vSguffm265OT0Hj6KecF/q', 'Jay Bryan', 'HIlardino', 'khazix-dark-star.jpg', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(13, 26, '2018-04-27', '08:00:00', 1, '17:00:00', 8),
(14, 26, '2018-04-28', '08:00:00', 1, '17:00:00', 8),
(96, 27, '2018-04-27', '08:00:00', 1, '17:00:00', 8),
(97, 13, '2018-04-28', '08:00:00', 1, '17:00:00', 8),
(98, 12, '2018-09-17', '07:45:36', 0, '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cashadvance`
--

CREATE TABLE `cashadvance` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvance`
--

INSERT INTO `cashadvance` (`id`, `date_advance`, `employee_id`, `amount`) VALUES
(3, '2018-09-11', '1', 100),
(4, '2018-09-11', '13', 106);

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `description`, `amount`) VALUES
(1, 'SSS', 100),
(2, 'Pagibig', 150),
(3, 'PhilHealth', 155),
(5, 'HDMF', 101);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `account_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `password`, `firstname`, `lastname`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_on`, `account_info`) VALUES
(12, 'Alba.Michelle', '12345', 'Michelle', 'Alba', 'Bago City', '0000-00-00', '', 'Female', 6, 3, 'Hydrangeas.jpg', '2018-09-14', 'Active'),
(13, 'Amacio.John Rey', '12345', 'John Rey', 'Amacio', 'Bago City', '0000-00-00', '', 'Female', 6, 4, 'Tulips.jpg', '2018-09-14', 'Active'),
(14, 'Anover.Mary Mae', '12345', 'Mary Mae', 'Anover', 'Bago City', '0000-00-00', '', 'Female', 6, 4, 'Penguins.jpg', '2018-09-14', 'Active'),
(15, 'Baladero.Sharine', '12345', 'Sharine', 'Baladero', 'Bago City', '0000-00-00', '', 'Female', 6, 6, 'Lighthouse.jpg', '2018-09-14', 'Active'),
(16, 'Bona.Benedict', '12345', 'Benedict', 'Bona', 'Bago City', '0000-00-00', '', 'Male', 6, 1, 'Hydrangeas.jpg', '2018-09-14', 'Active'),
(17, 'Borbon.April Rose', '12345', 'April Rose', 'Borbon', 'Bago City', '0000-00-00', '', 'Female', 6, 1, 'Jellyfish.jpg', '2018-09-14', 'Active'),
(18, 'Campaner.Reshel', '12345', 'Reshel', 'Campaner', 'Bago City', '0000-00-00', '', 'Female', 6, 1, 'Chrysanthemum.jpg', '2018-09-14', 'Active'),
(19, 'Concepcion.Ruth Ann', '12345', 'Ruth Ann', 'Concepcion', 'Bago City', '0000-00-00', '', 'Female', 6, 3, 'Desert.jpg', '2018-09-14', 'Active'),
(20, 'Delacruz.Cristy Ann', '12345', 'Cristy Ann', 'Delacruz', 'Bago City', '0000-00-00', '', 'Female', 6, 1, 'Tulips.jpg', '2018-09-14', 'Active'),
(21, 'Desbaro.Zarah Jane', '12345', 'Zarah Jane', 'Desbaro', 'Bago City', '0000-00-00', '', 'Female', 6, 4, 'Hydrangeas.jpg', '2018-09-14', 'Active'),
(22, 'Diva.Sarrah Jane', '12345', 'Sarrah Jane', 'Diva', 'Bago City', '0000-00-00', '', 'Female', 6, 4, 'Chrysanthemum.jpg', '2018-09-14', 'Active'),
(23, 'Donato.Lariene', '12345', 'Lariene', 'Donato', 'Bago City', '0000-00-00', '', 'Female', 6, 6, 'Penguins.jpg', '2018-09-14', 'Active'),
(24, 'Enrile.Chris Jan', '12345', 'Chris Jan', 'Enrile', 'Bago City', '0000-00-00', '', 'Male', 6, 1, 'Desert.jpg', '2018-09-14', 'Active'),
(25, 'Escanilla.Shaira May', '12345', 'Shaira May', 'Escanilla', 'Bago City', '0000-00-00', '', 'Female', 6, 3, 'Tulips.jpg', '2018-09-14', 'Active'),
(26, 'Espanola.Kent David', '12345', 'Kent David', 'Espanola', 'Bago City', '0000-00-00', '', 'Male', 6, 4, 'aurelion-sol-mecha.jpg', '2018-09-14', 'Active'),
(27, 'Fernandez.Eddie', '12345', 'Eddie', 'Fernandez', 'Bago City', '0000-00-00', '', 'Male', 6, 3, 'Penguins.jpg', '2018-09-14', 'Active'),
(28, 'Flandez.James Bryan', '12345', 'James Bryan', 'Flandez', 'Bago City', '0000-00-00', '', 'Male', 6, 1, 'Jellyfish.jpg', '2018-09-14', 'Active'),
(29, 'Gaylan.Reymus', '12345', 'Reymus', 'Gaylan', 'Bago City', '0000-00-00', '', 'Male', 6, 3, 'Desert.jpg', '2018-09-14', 'Active'),
(30, 'Gonzaga.Darwin John', '12345', 'Darwin John', 'Gonzaga', 'Bago City', '0000-00-00', '', 'Male', 6, 4, 'Desert.jpg', '2018-09-14', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `holidayschedules`
--

CREATE TABLE `holidayschedules` (
  `id` int(11) NOT NULL,
  `holiday_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidayschedules`
--

INSERT INTO `holidayschedules` (`id`, `holiday_type`, `description`, `date`) VALUES
(1, 'Legal Holiday', 'New Year', '2018-09-10 11:07:13'),
(3, 'Legal', 'Christmas Day', '2018-12-01'),
(5, 'Special', 'Masskara', '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `loantable`
--

CREATE TABLE `loantable` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `date_file` varchar(255) NOT NULL,
  `loan_amount` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `obligation` varchar(255) NOT NULL,
  `loan_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loantable`
--

INSERT INTO `loantable` (`id`, `employee_id`, `loan_type`, `date_file`, `loan_amount`, `balance`, `obligation`, `loan_status`) VALUES
(1, 1, 'SSS Loan', '2018-09-09 12:07:07', '2000', '0', '100', 'Paid'),
(2, 3, 'HDMF Loan', '2018-09-10 07:20:13', '2000', '2000', '2000', 'Paid'),
(3, 1, 'SSS Loan', '2018-09-11 10:03:53', '2000', '0', '100', 'Paid'),
(4, 1, 'HDMF Loan', '2018-09-11 10:04:29', '2000', '0', '109', 'Paid'),
(5, 5, 'SSS Loan', '2018-09-14 01:15:50', '2000', '1700', '100', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`id`, `firstname`, `lastname`, `position`) VALUES
(1, '- - - - - - - - -', '- - - - - - - - -', 'CEO\r\n'),
(2, '- - - - - - - - -', '- - - - - - - - -', 'Prism Over-All Manager'),
(3, '- - - - - - - - -', '- - - - - - - - -', 'Human Resource Manager'),
(4, '- - - - - - - - -', '- - - - - - - - -', 'Operation Manager'),
(5, '- - - - - - - - -', '- - - - - - - - -', 'Sales Manager'),
(6, '- - - - - - - - -', '- - - - - - - - -', 'Production Manager'),
(7, '- - - - - - - - -', '- - - - - - - - -', 'Maintenance Manager'),
(8, '- - - - - - - - -', '- - - - - - - - -', 'Office Admin'),
(9, '- - - - - - - - -', '- - - - - - - - -', 'Accountant / Bookkeeper'),
(10, '- - - - - - - - -', '- - - - - - - - -', 'Treasury'),
(11, '- - - - - - - - -', '- - - - - - - - -', 'Auditor'),
(12, '- - - - - - - - -', '- - - - - - - - -', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `rate`, `date_overtime`) VALUES
(4, '26', 4.0666666666667, 100, '2018-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `hourlyrate` double NOT NULL,
  `dailyrate` double NOT NULL,
  `allowance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `hourlyrate`, `dailyrate`, `allowance`) VALUES
(1, 'Programmer', 12.625, 101, 202),
(3, 'Manager', 13.375, 107, 208),
(4, 'Supervisor', 12.875, 103, 204),
(6, 'Staff', 13.125, 105, 206),
(7, 'Programmer', 12.625, 101, 202),
(8, 'Manager', 13.375, 107, 208),
(9, 'Supervisor', 12.875, 103, 204),
(10, 'Staff', 13.125, 105, 206),
(11, 'Staff', 13.125, 105, 206),
(12, 'Programmer', 12.625, 101, 202),
(13, 'Manager', 13.375, 107, 208),
(14, 'Supervisor', 12.875, 103, 204);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(1, '07:00:00', '16:00:00'),
(3, '09:00:00', '18:00:00'),
(4, '10:00:00', '19:00:00'),
(6, '01:00:00', '01:00:00'),
(8, '01:00:00', '01:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidayschedules`
--
ALTER TABLE `holidayschedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loantable`
--
ALTER TABLE `loantable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `holidayschedules`
--
ALTER TABLE `holidayschedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loantable`
--
ALTER TABLE `loantable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
