-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 09:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senior_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_tbl`
--

CREATE TABLE `action_tbl` (
  `action_id` int(11) NOT NULL,
  `action_done` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_tbl`
--

INSERT INTO `action_tbl` (`action_id`, `action_done`) VALUES
(1, 'Accept Senior'),
(2, 'Add Senior'),
(3, 'Remove Senior'),
(4, 'Add User'),
(5, 'Remove User'),
(6, 'Create Post'),
(7, 'Printed ID');

-- --------------------------------------------------------

--
-- Table structure for table `activity_tbl`
--

CREATE TABLE `activity_tbl` (
  `post_id` int(11) NOT NULL,
  `post_emp_id` int(11) DEFAULT NULL,
  `post_admin_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `event_type_id` int(11) NOT NULL,
  `post_description` varchar(500) DEFAULT NULL,
  `post_pic` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `post_loc` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_tbl`
--

INSERT INTO `activity_tbl` (`post_id`, `post_emp_id`, `post_admin_id`, `post_title`, `event_type_id`, `post_description`, `post_pic`, `post_date`, `date_created`, `time_created`, `post_loc`, `time_start`, `time_end`) VALUES
(49, NULL, 1, NULL, 1, 'practice post for not deleting the post after its due date', 'post20234815.jpg', '2023-09-02', '2023-09-02', '09:39:20', 'pulo', NULL, NULL),
(50, NULL, 1, NULL, 3, 'practice post for not deleting items', 'post20235198.jpg', '2023-09-02', '2023-09-02', '12:42:07', 'pulo', NULL, NULL),
(51, NULL, 1, NULL, 2, 'This an example post for the activites/event page', NULL, '2023-09-17', '2023-09-16', '10:01:11', 'Pulo, San Isidro, Nueva Ecija', NULL, NULL),
(52, NULL, 1, NULL, 1, 'Event that is ongoing', 'post20231038.jpg', '2023-09-16', '2023-09-16', '10:22:03', 'Pulo', NULL, NULL),
(53, NULL, 1, NULL, 1, 'EVent that is going on', NULL, '2023-09-16', '2023-09-16', '10:22:47', 'pulo', NULL, NULL),
(54, NULL, 1, NULL, 3, 'practice test for this lunch time', 'post20233987.jpg', '2023-09-16', '2023-09-16', '11:25:59', 'PUlo', NULL, NULL),
(55, NULL, 1, NULL, 2, 'This a post to fix the scanning function, to see if the seniors have attended this event or activity', NULL, '2023-09-27', '2023-09-26', '17:56:04', 'Pulo, San Isidro, Nueva Ecija', NULL, NULL),
(56, NULL, 1, NULL, 3, 'Practice event for scanning the senior\'s qr code for attendance', 'post20235335.jpg', '2023-10-10', '2023-09-30', '14:55:45', 'Pulo, San Isidro, Nueva Ecija', NULL, NULL),
(57, NULL, 1, NULL, 2, 'post for the calendar', 'post20231675.jpg', '2023-10-12', '2023-10-03', '18:26:04', 'Pulo, San Isidro, Nueva Ecija', NULL, NULL),
(58, NULL, 1, NULL, 2, 'calendar event practice', NULL, '2023-10-10', '2023-10-07', '19:23:39', 'Pulo, San Isidro, Nueva Ecija', NULL, NULL),
(59, NULL, 1, NULL, 1, 'practice post', NULL, '2023-10-09', '2023-10-09', '23:40:34', '', NULL, NULL),
(60, NULL, 1, 'Pension for Seniors', 2, 'practice post to see the event on the calendar and to see if the create post function is working', 'post20236558.jpg', '2023-11-09', '2023-11-06', '21:22:58', 'Pulo, San Isidro, Nueva Ecija', '2023-11-09T09:00:00+08:00', '2023-11-09T16:00:00+08:00'),
(62, NULL, 1, 'Free check ups', 3, 'Free check for all registered senior citizens', 'post20235594.jpg', '2023-11-07', '2023-11-06', '23:06:23', 'Pulo, San Isidro, Nueva Ecija', '2023-11-07T10:00:00+08:00', '2023-11-07T15:00:00+08:00'),
(63, 1, NULL, 'let\'s go', 1, 'go guys', 'post20234408.png', '2023-10-11', '2023-11-09', '21:13:53', 'Pulo, San Isidro, Nueva Ecija', '2023-11-11T09:00:00+08:00', '2023-11-11T22:13:00+08:00'),
(64, NULL, 1, 'bruh', 1, 'why won\'t the post work for the employees?', 'post20236883.png', '2023-11-13', '2023-11-09', '21:26:35', 'Pulo, San Isidro, Nueva Ecija', '2023-11-13T11:26:00+08:00', '2023-11-13T23:26:00+08:00'),
(65, 1, NULL, 'emp', 3, 'will it show now? for the employees?\r\n', 'post20238835.png', '2023-11-14', '2023-11-09', '21:27:42', 'Pulo, San Isidro, Nueva Ecija', '2023-11-14T11:27:00+08:00', '2023-11-14T23:28:00+08:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_status` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `extension` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_status`, `admin_username`, `admin_password`, `first_name`, `middle_name`, `last_name`, `extension`) VALUES
(1, 'Active', 'admin', 'admin', 'admin', 'is', 'the', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attend_tbl`
--

CREATE TABLE `attend_tbl` (
  `attend_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `senior_attend` int(11) NOT NULL,
  `senior_barangay` int(11) NOT NULL,
  `attend_date` date NOT NULL,
  `attend_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attend_tbl`
--

INSERT INTO `attend_tbl` (`attend_id`, `activity_id`, `senior_attend`, `senior_barangay`, `attend_date`, `attend_time`) VALUES
(1, 55, 1, 6, '2023-09-26', '15:11:19'),
(2, 55, 1, 6, '2023-09-30', '08:47:44'),
(3, 55, 1, 6, '2023-09-30', '08:48:04'),
(4, 56, 1, 6, '2023-09-30', '08:58:25'),
(5, 56, 11, 3, '2023-09-30', '08:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_tbl`
--

CREATE TABLE `barangay_tbl` (
  `barangay_id` int(11) NOT NULL,
  `barangay_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_tbl`
--

INSERT INTO `barangay_tbl` (`barangay_id`, `barangay_name`) VALUES
(1, 'Alua'),
(2, 'Calaba'),
(3, 'Malapit'),
(4, 'Mangga'),
(5, 'Poblacion'),
(6, 'Pulo'),
(7, 'San Roque'),
(8, 'Santo Cristo'),
(9, 'Tabon');

-- --------------------------------------------------------

--
-- Table structure for table `blood_tbl`
--

CREATE TABLE `blood_tbl` (
  `blood_id` int(11) NOT NULL,
  `blood_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_tbl`
--

INSERT INTO `blood_tbl` (`blood_id`, `blood_type`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'B+'),
(4, 'B-'),
(5, 'AB+'),
(6, 'AB-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `del_tbl`
--

CREATE TABLE `del_tbl` (
  `del_id` int(11) NOT NULL,
  `senior_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mid_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `senior_purok_id` int(11) NOT NULL,
  `senior_barangay_id` int(11) NOT NULL,
  `senior_municipality_id` int(11) NOT NULL,
  `senior_province_id` int(11) NOT NULL,
  `date_birth` date NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `blood_type` varchar(255) DEFAULT NULL,
  `physical_disability` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `other_health` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `cell_no` bigint(20) NOT NULL,
  `emergency_no` bigint(11) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `civil_status` varchar(100) NOT NULL,
  `senior_email` varchar(255) NOT NULL,
  `senior_password` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `bar_certificate` varchar(255) DEFAULT NULL,
  `qr_contents` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `del_tbl`
--

INSERT INTO `del_tbl` (`del_id`, `senior_id`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `date_birth`, `birth_place`, `sex`, `citizenship`, `age`, `blood_type`, `physical_disability`, `health`, `other_health`, `education`, `cell_no`, `emergency_no`, `religion`, `civil_status`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `qr_contents`) VALUES
(2, 2, 'Robbie San Nicolas Magtalas', 'Robbie', 'San Nicolas', 'Magtalas', NULL, 7, 6, 1, 1, '1960-04-04', 'New York', 'Male', 'Dual Citizen ', '65', NULL, NULL, NULL, NULL, NULL, 9184573889, NULL, NULL, 'Single', 'robbie@gmail.com', '2023-2663', '64d8d209c899a20230813.png', 'Carlson_San Nicolas_Magtalasid_pic.jpg', 'Carlson_San Nicolas_Magtalasbirth_cert.jpg', '', 'senior64d8d209c89739.42890703'),
(3, 2, 'Robbie San Nicolas Magtalas', 'Robbie', 'San Nicolas', 'Magtalas', NULL, 7, 6, 1, 1, '1960-04-04', 'New York', 'Male', 'Dual Citizen ', '65', NULL, NULL, NULL, NULL, NULL, 9184573889, NULL, NULL, 'Single', 'robbie@gmail.com', '2023-2663', '64d8d209c899a20230813.png', 'Carlson_San Nicolas_Magtalasid_pic.jpg', 'Carlson_San Nicolas_Magtalasbirth_cert.jpg', '', 'senior64d8d209c89739.42890703');

-- --------------------------------------------------------

--
-- Table structure for table `education_tbl`
--

CREATE TABLE `education_tbl` (
  `education_id` int(11) NOT NULL,
  `education_attainment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_tbl`
--

INSERT INTO `education_tbl` (`education_id`, `education_attainment`) VALUES
(1, 'no education'),
(2, 'Elementary Graduate'),
(3, 'Highschool Graduate'),
(4, 'College Graduate'),
(5, 'Vocational'),
(6, 'Master\'s Degree'),
(7, 'Doctoral');

-- --------------------------------------------------------

--
-- Table structure for table `emp_log`
--

CREATE TABLE `emp_log` (
  `log_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `out_date` date DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `session_no` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_log`
--

INSERT INTO `emp_log` (`log_id`, `emp_id`, `login_date`, `login_time`, `out_date`, `out_time`, `session_no`) VALUES
(1, 1, '2023-08-22', '14:25:09', NULL, NULL, '750415'),
(2, 1, '2023-08-22', '17:18:56', NULL, NULL, '671420'),
(3, 1, '2023-08-22', '17:24:02', NULL, NULL, '467477'),
(4, 1, '2023-08-22', '17:25:03', NULL, NULL, '272485'),
(5, 1, '2023-08-22', '17:27:22', NULL, NULL, '979654'),
(6, 1, '2023-08-22', '17:33:46', NULL, NULL, '360929'),
(7, 1, '2023-08-22', '17:40:49', NULL, NULL, '372992'),
(8, 1, '2023-08-22', '18:05:34', NULL, NULL, '580415'),
(9, 1, '2023-08-22', '18:16:05', NULL, NULL, '878809'),
(10, 2, '2023-08-22', '18:20:25', NULL, NULL, '581954'),
(11, 1, '2023-08-22', '18:35:00', NULL, NULL, '713496'),
(12, 1, '2023-08-23', '07:04:47', NULL, NULL, '275421'),
(13, 1, '2023-10-04', '07:08:46', NULL, NULL, '775759'),
(14, 1, '2023-10-07', '11:51:53', NULL, NULL, '176779');

-- --------------------------------------------------------

--
-- Table structure for table `emp_tbl`
--

CREATE TABLE `emp_tbl` (
  `emp_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `age` varchar(45) DEFAULT NULL,
  `sex` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `cell_no` bigint(20) NOT NULL,
  `purok_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `account_time` time NOT NULL,
  `account_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emp_tbl`
--

INSERT INTO `emp_tbl` (`emp_id`, `status`, `full_name`, `first_name`, `middle_name`, `last_name`, `extension`, `birth_date`, `birth_place`, `age`, `sex`, `civil_status`, `citizenship`, `cell_no`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `emp_email`, `emp_password`, `id_pic`, `account_time`, `account_date`) VALUES
(1, 'Inactive', 'Magtalas  Carlson', 'Magtalas', '', 'Carlson', '', '2002-04-02', 'New York', '21', 'Male', 'Single', 'Dual Citizen', 9814573889, 7, 6, 1, 1, 'magtalascarlson@gmail.com', '2023-5448', 'Magtalas__Carlsonid_pic.jpg', '17:20:25', '2023-08-11'),
(2, 'Active', 'Robbie San Nicolas Magtalas', 'Robbie', 'San Nicolas', 'Magtalas', '', '2002-04-27', 'New York', '21', 'Male', 'Single', 'Dual Citizen', 9163432459, 7, 6, 1, 1, 'robbiemagtalas@gmail.com', '2023-4757', 'Robbie_San Nicolas_Magtalasid_pic.jpg', '17:55:54', '2023-08-11'),
(3, 'Inactive', 'Magtalas San Nicolas Magtalas', 'Magtalas', 'San Nicolas', 'Magtalas', '', '1950-02-04', 'New York', '73', 'Male', 'Single', 'Dual Citizen', 9814573889, 2, 1, 1, 1, 'magtalascarlson@gmail.com', '2023-8757', 'Magtalas_San Nicolas_Magtalasid_pic.jpg', '09:37:37', '2023-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE `event_log` (
  `event_id` int(11) NOT NULL,
  `act_emp_id` int(11) DEFAULT NULL,
  `act_senior_id` int(11) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `act_date` date DEFAULT NULL,
  `act_time` time DEFAULT NULL,
  `act_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_log`
--

INSERT INTO `event_log` (`event_id`, `act_emp_id`, `act_senior_id`, `action_id`, `act_date`, `act_time`, `act_admin_id`) VALUES
(1, NULL, 1, 7, '2023-08-26', '01:45:00', NULL),
(2, 1, NULL, 1, '2023-08-26', '01:45:00', NULL),
(3, NULL, 11, 5, '2023-08-26', '01:45:00', NULL),
(4, NULL, 11, 2, '2023-09-30', '13:23:00', NULL),
(5, NULL, NULL, 1, '2023-10-03', '15:15:54', 1),
(6, NULL, NULL, 1, '2023-11-06', '19:13:38', 1),
(7, 1, NULL, 2, '2023-11-09', '23:32:38', NULL),
(8, NULL, NULL, 1, '2023-11-10', '03:42:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_tbl`
--

CREATE TABLE `message_tbl` (
  `message_id` int(11) NOT NULL,
  `messages` varchar(255) NOT NULL,
  `incoming_id` varchar(255) NOT NULL,
  `outgoing_ic` varchar(255) NOT NULL,
  `message_time` varchar(255) DEFAULT NULL,
  `message_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `municipality_tbl`
--

CREATE TABLE `municipality_tbl` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `municipality_tbl`
--

INSERT INTO `municipality_tbl` (`municipality_id`, `municipality_name`) VALUES
(1, 'San Isidro');

-- --------------------------------------------------------

--
-- Table structure for table `province_tbl`
--

CREATE TABLE `province_tbl` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `province_tbl`
--

INSERT INTO `province_tbl` (`province_id`, `province_name`) VALUES
(1, 'Nueva Ecija');

-- --------------------------------------------------------

--
-- Table structure for table `purok_tbl`
--

CREATE TABLE `purok_tbl` (
  `purok_id` int(11) NOT NULL,
  `purok_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purok_tbl`
--

INSERT INTO `purok_tbl` (`purok_id`, `purok_no`) VALUES
(1, '#1'),
(2, '#2'),
(3, '#3'),
(4, '#4'),
(5, '#5'),
(6, '#6'),
(7, '#7'),
(8, '#8'),
(9, '#9'),
(10, '#10');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `request_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `purok_id` int(11) NOT NULL,
  `barangay_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `age` int(11) NOT NULL,
  `place_birth` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `physical_disability` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `other_health` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `senior_email` varchar(100) NOT NULL,
  `cell_no` bigint(20) NOT NULL,
  `emergency_no` bigint(11) DEFAULT NULL,
  `civil_status` varchar(100) NOT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `id_pic` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `barangay_certificate` varchar(255) DEFAULT NULL,
  `request_date` date NOT NULL,
  `request_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `senior_log`
--

CREATE TABLE `senior_log` (
  `log_id` int(11) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_date` date NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `out_date` date DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `senior_id` int(11) NOT NULL,
  `session_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senior_log`
--

INSERT INTO `senior_log` (`log_id`, `login_name`, `login_date`, `login_time`, `out_date`, `out_time`, `senior_id`, `session_no`) VALUES
(1, 'Carlson San Nicolas Magtalas', '2023-08-10', '07:37:33', NULL, NULL, 1, '775845'),
(2, 'Carlson San Nicolas Magtalas', '2023-08-13', '21:06:43', '2023-08-13', '21:38:45', 1, '115133'),
(3, 'Carlson San Nicolas Magtalas', '2023-08-13', '21:39:18', '2023-08-13', '21:39:32', 1, '108592'),
(4, 'Carlson San Nicolas Magtalas', '2023-08-13', '21:40:12', '2023-08-13', '21:41:44', 1, '873686'),
(5, 'Carlson San Nicolas Magtalas', '2023-08-13', '21:42:17', '2023-08-13', '21:42:39', 1, '374813'),
(6, 'Carlson San Nicolas Magtalas', '2023-08-22', '14:35:22', '2023-08-22', '14:36:07', 1, '325276'),
(7, 'Carlson San Nicolas Magtalas', '2023-08-22', '14:37:39', '2023-08-22', '17:18:42', 1, '696462'),
(8, 'Carlson San Nicolas Magtalas', '2023-08-22', '19:58:43', '2023-08-22', '21:57:26', 1, '391758'),
(9, 'Carlson San Nicolas Magtalas', '2023-08-23', '15:49:33', '2023-08-23', '15:49:41', 1, '206739'),
(10, 'Carlson San Nicolas Magtalas', '2023-10-07', '11:48:11', NULL, NULL, 1, '634223'),
(11, 'Daniel Binuya Taberna', '2023-11-09', '21:01:51', NULL, NULL, 3, '427380');

-- --------------------------------------------------------

--
-- Table structure for table `senior_tbl`
--

CREATE TABLE `senior_tbl` (
  `senior_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mid_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `senior_purok_id` int(11) NOT NULL,
  `senior_barangay_id` int(11) NOT NULL,
  `senior_municipality_id` int(11) NOT NULL,
  `senior_province_id` int(11) NOT NULL,
  `date_birth` date NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `blood_id` int(11) DEFAULT NULL,
  `physical_disability` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `other_health` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `cell_no` bigint(20) NOT NULL,
  `emergency_no` bigint(11) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `civil_status` varchar(100) NOT NULL,
  `senior_email` varchar(255) NOT NULL,
  `senior_password` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `bar_certificate` varchar(255) DEFAULT NULL,
  `qr_contents` varchar(255) DEFAULT NULL,
  `account_time` time NOT NULL,
  `account_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `senior_tbl`
--

INSERT INTO `senior_tbl` (`senior_id`, `status`, `full_name`, `first_name`, `mid_name`, `last_name`, `extension`, `message_id`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `date_birth`, `birth_place`, `sex`, `citizenship`, `age`, `blood_id`, `physical_disability`, `health`, `other_health`, `education`, `cell_no`, `emergency_no`, `religion`, `civil_status`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `qr_contents`, `account_time`, `account_date`) VALUES
(1, 'Active', 'Carlson San Nicolas Magtalas', 'Carlson', 'San Nicolas', 'Magtalas', '', 654, 7, 6, 1, 1, '1960-02-04', 'New York', 'Male', 'Dual Citizen', '65', NULL, NULL, NULL, NULL, NULL, 9163432459, NULL, NULL, 'Single', 'carlsonmagtalas@gmail.com', '2023-2662', '64d8d209c899a20230813.png', 'Carlson_San Nicolas_Magtalasid_pic.jpg', 'Carlson_San Nicolas_Magtalasbirth_cert.jpg', '', 'senior64d8d209c89739.42890703', '20:52:25', '2023-08-13'),
(3, 'Active', 'Daniel Binuya Taberna', 'Daniel', 'Binuya', 'Taberna', '', 654, 1, 1, 1, 1, '1960-09-16', 'Philippines', 'Male', 'Filipino', '62', NULL, NULL, NULL, NULL, NULL, 9122343456, NULL, NULL, 'Single', 'taberna@gmail.com', '2023-9774', '64e406eed4a1f20230822.png', 'Daniel_Binuya_Tabernaid_pic.jpg', 'Daniel_Binuya_Tabernabirth_cert.jpg', '', 'senior64e406eed4a122.10385643', '08:53:02', '2023-08-22'),
(11, 'Inactive', 'Another  Cat', 'Another', '', 'Cat', '', 654, 9, 3, 1, 1, '1950-02-04', 'Philippines', 'Rather not say', 'Dual Citizen', '73', NULL, NULL, NULL, NULL, NULL, 9873451234, NULL, NULL, 'Single', 'emwail@gmail.com', '2023-2293', '64e549376690220230823.png', 'Another__Catid_pic.jpg', 'Another__Catbirth_cert.jpg', '', 'senior64e54937668f75.16531810', '07:48:07', '2023-08-23'),
(12, 'Active', 'Raymond The Spaymond', 'Raymond', 'The', 'Spaymond', 'Jr.', 654, 2, 2, 1, 1, '1950-04-02', 'City of Meow', 'Rather not say', 'Meowtizen', '73', NULL, NULL, NULL, NULL, NULL, 9163432459, NULL, NULL, 'Married', 'RaymondSpaymond@gmail.com', '2023-4741', '64e54a94d17b620230823.png', 'Raymond_The_Spaymondid_pic.jpg', 'Raymond_The_Spaymondbirth_cert.jpg', '', 'senior64e54a94d17ad4.32971401', '07:53:56', '2023-08-23'),
(13, 'Inactive', 'Spraymond The Cat', 'Spraymond', 'The', 'Cat', 'Extension', 654, 2, 3, 1, 1, '1950-02-04', 'Philippines', 'Male', 'Filipino', '73', NULL, NULL, NULL, NULL, NULL, 9711231234, NULL, NULL, 'Single', 'fasdfs@gmail.com', '2023-5409', '64e959b340d5520230826.png', 'Spraymond_The_Catid_pic.jpg', 'Spraymond_The_Catbirth_cert.jpg', '', 'senior64e959b340d441.75937595', '09:47:30', '2023-08-26'),
(14, 'Inactive', 'Mouse The House', 'Mouse', 'The', 'House', 'Extension', 654, 4, 9, 1, 1, '1950-02-04', 'Philippines', 'Rather not say', 'Filipino', '73', NULL, NULL, NULL, NULL, NULL, 9181231234, NULL, NULL, 'Divorced', 'mousehouse@gmail.com', '2023-1976', '651bbfaa0611420231003.png', 'Mouse_The_Houseid_pic.jpg', 'Mouse_The_Housebirth_cert.jpg', 'Mouse_The_Housebar_cert.jpg', 'senior651bbfaa061056.23715613', '15:15:53', '2023-10-03'),
(15, 'Inactive', 'house  the mouse', 'house ', 'the', 'mouse', 'Jr.', 654, 8, 6, 1, 1, '1950-02-09', 'New York', 'Female', 'Filipino', '73', NULL, NULL, NULL, NULL, NULL, 9151431234, NULL, NULL, 'Married', 'housemouse@gmail.com', '2023-5200', '651ca0b09be1f20231004.png', 'house _the_mouseid_pic.jpg', 'house _the_mousebirth_cert.jpg', NULL, 'senior651ca0b09be120.49274854', '07:16:00', '2023-10-04'),
(16, 'Inactive', 'huh says cat', 'huh', 'says', 'cat', '', 654, 7, 1, 1, 1, '1906-02-04', 'New York', 'Female', 'Dual Citizen', '117', NULL, NULL, NULL, NULL, NULL, 9151431234, NULL, NULL, 'Single', 'shelyca.neust.sic.cict@gmail.com', '$2y$10$5HichBlZydLrdvJLmHuMl.70vfQoqhbIU6JCDme5t0DUGROzsNhQq', '6548ca6215f3c20231106.png', 'huh_says_catid_pic.jpg', 'huh_says_catbirth_cert.jpg', 'huh_says_catbar_cert.jpg', 'senior6548ca6215f303.68042336', '19:13:37', '2023-11-06'),
(18, 'Inactive', 'Will the Pill', 'Will', 'the', 'Pill', 'Jr', NULL, 9, 8, 1, 1, '1960-01-01', 'Philippines', 'Male', 'Dual Citizen', '63', 6, 'none', 'a:3:{i:0;s:12:\"Hypertension\";i:1;s:14:\"Arthritis/Gout\";i:2;s:8:\"Diabetes\";}', 'none', 'Highschool', 9151231234, 9171232346, 'Born again', 'Single', 'willpill@gmail.com', '$2y$10$mKO4bbj4rO6T2Lz3fsEScOxe5RZnzgy7SpzthWmZlKFFe7W9yAkHa', '654cfb967f23520231109.png', 'Will_the_Pillid_pic.jpeg', 'Will_the_Pillbirth_cert.jpeg', 'Will_the_Pillbar_cert.jpg', 'senior654cfb967f2234.72765735', '23:32:38', '2023-11-09'),
(19, 'Inactive', 'Cat says Huh', 'Cat', 'says', 'Huh', 'Jr', NULL, 5, 7, 1, 1, '1950-01-01', 'New York', 'Female', 'Dual Citizen', '73', NULL, NULL, NULL, NULL, NULL, 9151231234, NULL, NULL, 'Single', 'catsayshuh@gmail.com', '$2y$10$a734ysdnh4IcMADNhvveuuk33/3uNjB7Mrxa.TwFcJMgqJExr.SXG', '654d3615aa65520231110.png', 'Cat_says_Huhid_pic.jpeg', 'Cat_says_Huhbirth_cert.jpg', 'Cat_says_Huhbar_cert.jpg', 'senior654d3615aa63a6.06852228', '03:42:13', '2023-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `type_tbl`
--

CREATE TABLE `type_tbl` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_tbl`
--

INSERT INTO `type_tbl` (`type_id`, `type_name`) VALUES
(1, 'Recreational Event'),
(2, 'Claim Pensions'),
(3, 'Health Related Event'),
(4, 'Announcement');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_tbl`
--
ALTER TABLE `action_tbl`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `activity_tbl`
--
ALTER TABLE `activity_tbl`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `emp_id_idx` (`post_emp_id`),
  ADD KEY `admin_id_idx` (`post_admin_id`),
  ADD KEY `type_id_idx` (`event_type_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attend_tbl`
--
ALTER TABLE `attend_tbl`
  ADD PRIMARY KEY (`attend_id`);

--
-- Indexes for table `barangay_tbl`
--
ALTER TABLE `barangay_tbl`
  ADD PRIMARY KEY (`barangay_id`);

--
-- Indexes for table `blood_tbl`
--
ALTER TABLE `blood_tbl`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `del_tbl`
--
ALTER TABLE `del_tbl`
  ADD PRIMARY KEY (`del_id`),
  ADD KEY `purok_id_idx` (`senior_purok_id`),
  ADD KEY `senior_barangay_id_idx` (`senior_barangay_id`),
  ADD KEY `senior_municipality_id_idx` (`senior_municipality_id`),
  ADD KEY `senior_province_id_idx` (`senior_province_id`);

--
-- Indexes for table `education_tbl`
--
ALTER TABLE `education_tbl`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `emp_log`
--
ALTER TABLE `emp_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `purok_id_idx` (`purok_id`),
  ADD KEY `barangay_id_idx` (`barangay_id`),
  ADD KEY `municipality_id_idx` (`municipality_id`),
  ADD KEY `province_id_idx` (`province_id`);

--
-- Indexes for table `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `emp_id_idx` (`act_emp_id`),
  ADD KEY `senior_id_idx` (`act_senior_id`),
  ADD KEY `action_id_idx` (`action_id`);

--
-- Indexes for table `message_tbl`
--
ALTER TABLE `message_tbl`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `municipality_tbl`
--
ALTER TABLE `municipality_tbl`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `province_tbl`
--
ALTER TABLE `province_tbl`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `purok_tbl`
--
ALTER TABLE `purok_tbl`
  ADD PRIMARY KEY (`purok_id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `purok_id_idx` (`purok_id`),
  ADD KEY `barangay_id_idx` (`barangay_id`),
  ADD KEY `municipality_id_idx` (`municipality_id`),
  ADD KEY `province_id_idx` (`province_id`);

--
-- Indexes for table `senior_log`
--
ALTER TABLE `senior_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `senior_tbl`
--
ALTER TABLE `senior_tbl`
  ADD PRIMARY KEY (`senior_id`),
  ADD KEY `purok_id_idx` (`senior_purok_id`),
  ADD KEY `senior_barangay_id_idx` (`senior_barangay_id`),
  ADD KEY `senior_municipality_id_idx` (`senior_municipality_id`),
  ADD KEY `senior_province_id_idx` (`senior_province_id`),
  ADD KEY `blood_id` (`blood_id`);

--
-- Indexes for table `type_tbl`
--
ALTER TABLE `type_tbl`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_tbl`
--
ALTER TABLE `action_tbl`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `activity_tbl`
--
ALTER TABLE `activity_tbl`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attend_tbl`
--
ALTER TABLE `attend_tbl`
  MODIFY `attend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barangay_tbl`
--
ALTER TABLE `barangay_tbl`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blood_tbl`
--
ALTER TABLE `blood_tbl`
  MODIFY `blood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `del_tbl`
--
ALTER TABLE `del_tbl`
  MODIFY `del_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education_tbl`
--
ALTER TABLE `education_tbl`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emp_log`
--
ALTER TABLE `emp_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_log`
--
ALTER TABLE `event_log`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `municipality_tbl`
--
ALTER TABLE `municipality_tbl`
  MODIFY `municipality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `province_tbl`
--
ALTER TABLE `province_tbl`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purok_tbl`
--
ALTER TABLE `purok_tbl`
  MODIFY `purok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `senior_log`
--
ALTER TABLE `senior_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `senior_tbl`
--
ALTER TABLE `senior_tbl`
  MODIFY `senior_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `type_tbl`
--
ALTER TABLE `type_tbl`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_tbl`
--
ALTER TABLE `activity_tbl`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`post_admin_id`) REFERENCES `admin_tbl` (`admin_id`),
  ADD CONSTRAINT `emp_id` FOREIGN KEY (`post_emp_id`) REFERENCES `emp_tbl` (`emp_id`),
  ADD CONSTRAINT `event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `type_tbl` (`type_id`);

--
-- Constraints for table `emp_tbl`
--
ALTER TABLE `emp_tbl`
  ADD CONSTRAINT `barangay_id` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_tbl` (`barangay_id`),
  ADD CONSTRAINT `municipality_id` FOREIGN KEY (`municipality_id`) REFERENCES `municipality_tbl` (`municipality_id`),
  ADD CONSTRAINT `province_id` FOREIGN KEY (`province_id`) REFERENCES `province_tbl` (`province_id`),
  ADD CONSTRAINT `purok_id` FOREIGN KEY (`purok_id`) REFERENCES `purok_tbl` (`purok_id`);

--
-- Constraints for table `senior_tbl`
--
ALTER TABLE `senior_tbl`
  ADD CONSTRAINT `blood_id` FOREIGN KEY (`blood_id`) REFERENCES `blood_tbl` (`blood_id`),
  ADD CONSTRAINT `senior_barangay_id` FOREIGN KEY (`senior_barangay_id`) REFERENCES `barangay_tbl` (`barangay_id`),
  ADD CONSTRAINT `senior_municipality_id` FOREIGN KEY (`senior_municipality_id`) REFERENCES `municipality_tbl` (`municipality_id`),
  ADD CONSTRAINT `senior_province_id` FOREIGN KEY (`senior_province_id`) REFERENCES `province_tbl` (`province_id`),
  ADD CONSTRAINT `senior_purok_id` FOREIGN KEY (`senior_purok_id`) REFERENCES `purok_tbl` (`purok_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
