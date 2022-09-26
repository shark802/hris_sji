-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 05:20 AM
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
-- Database: `hris_sji`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_fee`
--

CREATE TABLE `additional_fee` (
  `id` int(11) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_fee`
--

INSERT INTO `additional_fee` (`id`, `fee`, `amount`, `status`) VALUES
(4, 'Advisory Pay', '-', 'UserDefine'),
(5, 'Overload Pay', '200', 'Fixed'),
(6, 'Chinese Premiums', '100', 'Fixed'),
(8, 'Financial Aid', '1500', 'Fixed'),
(9, 'Position Honorarium', '1000', 'Fixed'),
(10, 'Moderator', '-', 'UserDefine'),
(11, 'Substitution Pay', '-', 'UserDefine'),
(12, 'Adjustment Refund', '-', 'UserDefine');

-- --------------------------------------------------------

--
-- Table structure for table `additional_fee_details`
--

CREATE TABLE `additional_fee_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `additional_fee_id` int(11) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'jpacia', '$2y$10$W1x7mroSH4Vr2O1THmopB.rJTD8Ggr7e2cPjM6r4MNPhtKTAK.Bjy', 'Janrenzo', 'Pacia', 'facebook-profile-image.jpeg', '2018-04-30'),
(3, 'jason.delosreyes', '26a050b5fca66e78e03f753802b51849', 'JaOsn', 'de los Reyes', '9fedc9614a591b7e3f03a080a690506d.jpg', '2018-04-30'),
(4, 'jcordova', '$2y$10$W1x7mroSH4Vr2O1THmopB.rJTD8Ggr7e2cPjM6r4MNPhtKTAK.Bjy', 'Jerico', 'Cordova', 'indexss.jpg', '2018-04-30'),
(5, 'jhilardino', '$2y$10$W1x7mroSH4Vr2O1THmopB.rJTD8Ggr7e2cPjM6r4MNPhtKTAK.Bjy', 'Jay Bryan', 'HIlardino', 'khazix-dark-star.jpg', '2018-04-30'),
(8, 'bparade', '$2y$10$vzkGwGP2/3320pJHCCXvr.u2sy849oQbw98g58e6j4M8JWiQqOt.S', 'Black', 'Parade', '', '2022-08-18'),
(9, 'bparade', '$2y$10$W1x7mroSH4Vr2O1THmopB.rJTD8Ggr7e2cPjM6r4MNPhtKTAK.Bjy', 'Black', 'Parade', '', '2022-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `applied_leave`
--

CREATE TABLE `applied_leave` (
  `id` int(11) NOT NULL,
  `application_reference` varchar(225) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `leave_type` varchar(225) NOT NULL,
  `num_leave` varchar(225) NOT NULL,
  `reason` varchar(225) NOT NULL,
  `supervisor_approval` varchar(1) NOT NULL,
  `hr_approval` varchar(1) NOT NULL,
  `principal_approval` varchar(1) NOT NULL,
  `status` varchar(225) NOT NULL,
  `Payroll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `clocked` varchar(225) NOT NULL,
  `status` varchar(255) NOT NULL,
  `shift` int(11) NOT NULL,
  `num_hr` double NOT NULL,
  `late` varchar(225) NOT NULL,
  `remarks` int(11) NOT NULL,
  `absent` int(11) NOT NULL,
  `undertime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `benefits_contributions`
--

CREATE TABLE `benefits_contributions` (
  `id` int(11) NOT NULL,
  `deduction` varchar(225) NOT NULL,
  `scheme` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(225) NOT NULL,
  `abbreviations` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `abbreviations`, `address`) VALUES
(1, 'St. Johns Institute', 'SJI', 'Hilado Ext. Capitol Height, Bacolod City Negros Occidental'),
(3, 'St. Johns Institute - North Point', 'SJI - NP', 'Ayala');

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE `component` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `basic_pay` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `departments` varchar(225) NOT NULL,
  `abbreviation` varchar(225) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dependent`
--

CREATE TABLE `dependent` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `dependent_name` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dependent_deduct`
--

CREATE TABLE `dependent_deduct` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount_deduct` int(11) NOT NULL,
  `num_dependent` int(11) NOT NULL,
  `date_deduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(150) NOT NULL,
  `email_address` varchar(225) NOT NULL,
  `password` varchar(150) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `account_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employment_records`
--

CREATE TABLE `employment_records` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `mandatory_government` int(11) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `ip_address`
--

CREATE TABLE `ip_address` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `date_modify` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ip_address`
--

INSERT INTO `ip_address` (`id`, `ip_address`, `status`, `date_modify`) VALUES
(4, '111.68.58.24', 'Active', '2022-09-19 06:04:08'),
(5, '111.68.58.25', 'Active', '2022-09-19 06:04:08'),
(6, '111.68.58.26', 'Active', '2022-09-19 06:04:08'),
(7, '111.68.58.27', 'Active', '2022-09-19 06:04:08'),
(8, '111.68.58.28', 'Active', '2022-09-19 06:04:08'),
(9, '111.68.58.29', 'Active', '2022-09-19 06:04:08'),
(10, '111.68.58.30', 'Active', '2022-09-19 06:04:08'),
(11, '111.68.58.31', 'Active', '2022-09-19 06:04:08'),
(12, '111.68.58.32', 'Active', '2022-09-19 06:04:08'),
(13, '111.68.58.50', 'Active', '2022-09-19 06:04:08'),
(14, '111.68.58.51', 'Active', '2022-09-19 06:04:08'),
(15, '111.68.58.52', 'Active', '2022-09-19 06:04:08'),
(16, '111.68.58.53', 'Active', '2022-09-19 06:04:08'),
(17, '111.68.58.54', 'Active', '2022-09-19 06:04:08'),
(18, '111.68.58.55', 'Active', '2022-09-19 06:04:08'),
(19, '111.68.58.56', 'Active', '2022-09-19 06:04:08'),
(20, '111.68.58.57', 'Active', '2022-09-19 06:04:08'),
(21, '111.68.58.58', 'Active', '2022-09-19 06:04:08'),
(22, '192.92.140.211', 'Active', '2022-09-19 06:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `ip_restrict`
--

CREATE TABLE `ip_restrict` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ip_restrict`
--

INSERT INTO `ip_restrict` (`id`, `status`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_credit`
--

CREATE TABLE `leave_credit` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` varchar(225) NOT NULL,
  `used_leave` varchar(225) NOT NULL,
  `unused_leave` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(225) NOT NULL,
  `abbreviation` varchar(225) NOT NULL,
  `employment_status` int(11) NOT NULL,
  `total_use` int(11) NOT NULL,
  `monthly_accumulation` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loantable`
--

CREATE TABLE `loantable` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `loan_type` int(11) NOT NULL,
  `date_loan` date NOT NULL,
  `loan_amount` varchar(225) NOT NULL,
  `payment_term` varchar(225) NOT NULL,
  `balance` varchar(225) NOT NULL,
  `obligation` varchar(225) NOT NULL,
  `total_amount_paid` varchar(225) NOT NULL,
  `total_month_paid` varchar(225) NOT NULL,
  `Impasse_date` date NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int(11) NOT NULL,
  `loan_type` varchar(225) NOT NULL,
  `modified_by` varchar(225) NOT NULL,
  `modified_date` date NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `loan_type`, `modified_by`, `modified_date`, `status`) VALUES
(2, 'Laptop Loans', '', '2022-08-30', 'Active'),
(3, 'Pag-ibig Calamity Loan', '', '2022-08-30', 'Active'),
(4, 'SSS Calamity Loan', '', '2022-08-30', 'Active'),
(5, 'Pag-ibig MPL', '', '2022-08-30', 'Active'),
(6, 'School Cash Loans', '', '2022-08-30', 'Active'),
(7, 'SSS Salary Loan', '', '2022-08-30', 'Active');

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

-- --------------------------------------------------------

--
-- Table structure for table `mandatory_contribution_record`
--

CREATE TABLE `mandatory_contribution_record` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `ss` varchar(32) NOT NULL,
  `pagibig` varchar(32) NOT NULL,
  `philhealth` varchar(32) NOT NULL,
  `tin` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mandatory_deduction`
--

CREATE TABLE `mandatory_deduction` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sss` varchar(225) NOT NULL,
  `hdmf` varchar(225) NOT NULL,
  `philhealth` varchar(225) NOT NULL,
  `date_deduct` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `month_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `month_name`) VALUES
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December'),
(1, 'January'),
(2, 'February');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pagibig_table`
--

CREATE TABLE `pagibig_table` (
  `id` int(11) NOT NULL,
  `range_from` varchar(225) NOT NULL,
  `range_to` varchar(225) NOT NULL,
  `employerShare` varchar(225) NOT NULL,
  `employeeShare` varchar(225) NOT NULL,
  `totalMonthlyPremium` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagibig_table`
--

INSERT INTO `pagibig_table` (`id`, `range_from`, `range_to`, `employerShare`, `employeeShare`, `totalMonthlyPremium`) VALUES
(3, '0', '1500', '2', '1', '3'),
(4, '1500', 'above', '2', '2', '4');

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `leave_type` int(11) NOT NULL,
  `leave_use` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `month` varchar(11) NOT NULL,
  `payroll_period` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` int(11) NOT NULL,
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(225) NOT NULL,
  `monthly_basic` varchar(225) NOT NULL,
  `monthly_aid` varchar(225) NOT NULL,
  `monthly_total` varchar(225) NOT NULL,
  `payroll_basic` varchar(225) NOT NULL,
  `payroll_others` varchar(225) NOT NULL,
  `payroll_total` varchar(225) NOT NULL,
  `position_honorarium` varchar(225) NOT NULL,
  `chinese_prems` varchar(225) NOT NULL,
  `advisory` varchar(225) NOT NULL,
  `moderator` varchar(225) NOT NULL,
  `overload` varchar(225) NOT NULL,
  `sub_pay` varchar(225) NOT NULL,
  `adj_refund` varchar(225) NOT NULL,
  `overtime_pay` varchar(225) NOT NULL,
  `sss` varchar(225) NOT NULL,
  `hdmf` varchar(225) NOT NULL,
  `philhealth` varchar(225) NOT NULL,
  `wtax` varchar(225) NOT NULL,
  `sss_salaryLoan` varchar(225) NOT NULL,
  `sss_calamityLoan` varchar(225) NOT NULL,
  `hdmf_calamityLoan` varchar(225) NOT NULL,
  `hdmf_mpl` varchar(225) NOT NULL,
  `other_deductions` varchar(225) NOT NULL,
  `absences_total` varchar(225) NOT NULL,
  `deduction_aid` varchar(225) NOT NULL,
  `undertime_late` varchar(225) NOT NULL,
  `ca` varchar(225) NOT NULL,
  `total_gross_pay` varchar(225) NOT NULL,
  `total_deduction` varchar(225) NOT NULL,
  `net_pay` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `module` varchar(11) NOT NULL,
  `access` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ph_table`
--

CREATE TABLE `ph_table` (
  `id` int(11) NOT NULL,
  `range_from` varchar(225) NOT NULL,
  `range_to` varchar(225) NOT NULL,
  `employerShare` varchar(225) NOT NULL,
  `employeeShare` varchar(225) NOT NULL,
  `totalMonthlyPremium` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ph_table`
--

INSERT INTO `ph_table` (`id`, `range_from`, `range_to`, `employerShare`, `employeeShare`, `totalMonthlyPremium`) VALUES
(2, '0', '10,000.00', '2', '2', '400'),
(3, '10,000.01', '79,999.99', '2', '2', '400.00 to 3,200.00'),
(4, '80,000.00', 'above', '2', '2', '3,200.00');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `basic_salary` varchar(225) NOT NULL,
  `daily_rate` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `supervisory_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `grace_period` varchar(11) NOT NULL,
  `workdays` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sss_table`
--

CREATE TABLE `sss_table` (
  `id` int(11) NOT NULL,
  `range_from` varchar(225) NOT NULL,
  `range_to` varchar(225) NOT NULL,
  `er` varchar(225) NOT NULL,
  `ee` varchar(225) NOT NULL,
  `ss_contribution` varchar(225) NOT NULL,
  `ec` varchar(225) NOT NULL,
  `total_contribution` varchar(225) NOT NULL,
  `se_monthlyCredit` varchar(225) NOT NULL,
  `se_ssContribution` varchar(225) NOT NULL,
  `monthly_salaryCredit` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sss_table`
--

INSERT INTO `sss_table` (`id`, `range_from`, `range_to`, `er`, `ee`, `ss_contribution`, `ec`, `total_contribution`, `se_monthlyCredit`, `se_ssContribution`, `monthly_salaryCredit`) VALUES
(1, '0', '2250', '160', '80', '240', '10', '250', '2000', '240', '2000'),
(52, '2250', '2749.99', '200', '100', '300', '10', '310', '2500', '300', '2500'),
(53, '2750', '3249.99', '240', '120', '360', '10', '370', '3000', '360', '3000'),
(54, '3250', '3749.99', '280', '140', '420', '10', '430', '3500', '420', '3500'),
(55, '3750', '4249.99', '320', '160', '480', '10', '490', '4000', '480', '4000'),
(56, '4250', '4749.99', '360', '180', '540', '10', '550', '4500', '540', '4500'),
(57, '4750', '5249.99', '400', '200', '600', '10', '610', '5000', '600', '5000'),
(58, '5250', '5749.99', '440', '220', '660', '10', '670', '5500', '660', '5500'),
(59, '5750', '6249.99', '480', '240', '720', '10', '730', '6000', '720', '6000'),
(60, '6250', '6749.99', '520', '260', '780', '10', '790', '6500', '780', '6500'),
(61, '6750', '7249.99', '560', '280', '840', '10', '850', '7000', '840', '7000'),
(62, '7250', '7749.99', '600', '300', '900', '10', '910', '7500', '900', '7500'),
(63, '7750', '8249.99', '640', '320', '960', '10', '970', '8000', '960', '8000'),
(64, '8250', '8749.99', '680', '340', '1020', '10', '1030', '8500', '1020', '8500'),
(65, '8750', '9249.99', '720', '360', '1080', '10', '1090', '9000', '1080', '9000'),
(66, '9250', '9749.99', '760', '380', '1140', '10', '1150', '9500', '1140', '9500'),
(67, '9750', '10249.99', '800', '400', '1200', '10', '1210', '10000', '1200', '10000'),
(68, '10250', '10749.99', '840', '420', '1260', '10', '1270', '10500', '1260', '10500'),
(69, '10750', '11249.99', '880', '440', '1320', '10', '1330', '11000', '1320', '11000'),
(70, '11250', '11749.99', '920', '460', '1380', '10', '1390', '11500', '1380', '11500'),
(71, '11750', '12249.99', '960', '480', '1440', '10', '1450', '12000', '1440', '12000'),
(72, '12250', '12749.99', '1000', '500', '1500', '10', '1510', '12500', '1500', '12500'),
(73, '12750', '13249.99', '1040', '520', '1560', '10', '1570', '13000', '1560', '13000'),
(74, '13250', '13749.99', '1080', '540', '1620', '10', '1630', '13500', '1620', '13500'),
(75, '13750', '14249.99', '1120', '560', '1680', '10', '1690', '14000', '1680', '14000'),
(76, '14250', '14749.99', '1160', '580', '1740', '10', '1750', '14500', '1740', '14500'),
(77, '14750', '15249.99', '1200', '600', '1800', '30', '1830', '15000', '1800', '15000'),
(78, '15250', '15749.99', '1240', '620', '1860', '30', '1890', '15500', '1860', '15500'),
(79, '15750', '16249.99', '1280', '640', '1920', '30', '1950', '16000', '1920', '16000'),
(80, '16250', '16749.99', '1320', '660', '1980', '30', '2010', '16500', '1980', '16500'),
(81, '16750', '17249.99', '1360', '680', '2040', '30', '2070', '17000', '2040', '17000'),
(82, '17250', '17749.99', '1400', '700', '2100', '30', '2130', '17500', '2100', '17500'),
(83, '17750', '18249.99', '1440', '720', '2160', '30', '2190', '18000', '2160', '18000'),
(84, '18250', '18749.99', '1480', '740', '2220', '30', '2250', '18500', '2220', '18500'),
(85, '18750', '19249.99', '1520', '760', '2280', '30', '2310', '19000', '2280', '19000'),
(86, '19250', '19749.99', '1560', '780', '2340', '30', '2370', '19500', '2340', '19500'),
(87, '19750', 'above', '1600', '800', '2400', '30', '2430', '20000', '2400', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Full Time'),
(2, 'Part Time'),
(3, 'Probitionary');

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

CREATE TABLE `tax_table` (
  `id` int(11) NOT NULL,
  `excess_percentage` varchar(11) NOT NULL,
  `annual_income_from` varchar(225) NOT NULL,
  `annual_income_to` varchar(225) NOT NULL,
  `monthly_income_from` varchar(225) NOT NULL,
  `monthly_income_to` varchar(225) NOT NULL,
  `base_tax` varchar(225) NOT NULL,
  `excess_income` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tax_table`
--

INSERT INTO `tax_table` (`id`, `excess_percentage`, `annual_income_from`, `annual_income_to`, `monthly_income_from`, `monthly_income_to`, `base_tax`, `excess_income`) VALUES
(1, '0', '0', '250000', '0', '20833', '0', '0'),
(2, '20', '250001', '400000', '20834', '33333', '0', '20833'),
(3, '25', '400000', '800000', '33333', '66666', '2500', '33333'),
(4, '30', '800000', '2000000', '66667', '166666', '10833.33', '66667'),
(5, '32', '2000000', '8000000', '166667', '666666', '40833.33', '166667'),
(6, '35', '8000000', 'above', '666667', 'above', '200833.33', '666667');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_fee`
--
ALTER TABLE `additional_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_fee_details`
--
ALTER TABLE `additional_fee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_leave`
--
ALTER TABLE `applied_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefits_contributions`
--
ALTER TABLE `benefits_contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvance`
--
ALTER TABLE `cashadvance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dependent`
--
ALTER TABLE `dependent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_records`
--
ALTER TABLE `employment_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidayschedules`
--
ALTER TABLE `holidayschedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_address`
--
ALTER TABLE `ip_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_restrict`
--
ALTER TABLE `ip_restrict`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_credit`
--
ALTER TABLE `leave_credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loantable`
--
ALTER TABLE `loantable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandatory_contribution_record`
--
ALTER TABLE `mandatory_contribution_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandatory_deduction`
--
ALTER TABLE `mandatory_deduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagibig_table`
--
ALTER TABLE `pagibig_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ph_table`
--
ALTER TABLE `ph_table`
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
-- Indexes for table `sss_table`
--
ALTER TABLE `sss_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_table`
--
ALTER TABLE `tax_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_fee`
--
ALTER TABLE `additional_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `additional_fee_details`
--
ALTER TABLE `additional_fee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `applied_leave`
--
ALTER TABLE `applied_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `benefits_contributions`
--
ALTER TABLE `benefits_contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashadvance`
--
ALTER TABLE `cashadvance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dependent`
--
ALTER TABLE `dependent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employment_records`
--
ALTER TABLE `employment_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidayschedules`
--
ALTER TABLE `holidayschedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ip_address`
--
ALTER TABLE `ip_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ip_restrict`
--
ALTER TABLE `ip_restrict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_credit`
--
ALTER TABLE `leave_credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loantable`
--
ALTER TABLE `loantable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandatory_contribution_record`
--
ALTER TABLE `mandatory_contribution_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mandatory_deduction`
--
ALTER TABLE `mandatory_deduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagibig_table`
--
ALTER TABLE `pagibig_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ph_table`
--
ALTER TABLE `ph_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sss_table`
--
ALTER TABLE `sss_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tax_table`
--
ALTER TABLE `tax_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
