-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 06:07 PM
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
-- Database: `covid_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_id`, `name`, `email`, `phone`, `date`, `department`, `message`) VALUES
(2, NULL, 'umer', 'umer@gmail.com', '1234567890', '2025-11-22', 'covid', 'qwertyuio'),
(3, NULL, 'Muhammad Fazil', 'zaakiafazil@gmail.com', '03222047411', '2025-11-25', 'covid', ''),
(4, NULL, 'mazia', 'mazia@gmail.com', '0000000000000', '2025-11-26', 'covid', ''),
(5, NULL, 'bisma', 'bisma@gmail.com', '1234567890', '2025-11-27', 'covid', 'qwertyui');

-- --------------------------------------------------------

--
-- Table structure for table `covid_test`
--

CREATE TABLE `covid_test` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `result` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `covid_test_requests`
--

CREATE TABLE `covid_test_requests` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `hospital_name` varchar(150) DEFAULT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `request_status` varchar(20) DEFAULT 'Pending',
  `covid_result` varchar(50) DEFAULT NULL,
  `result` varchar(20) DEFAULT '',
  `remarks` text DEFAULT NULL,
  `result_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `covid_test_requests`
--

INSERT INTO `covid_test_requests` (`id`, `patient_name`, `email`, `phone`, `symptoms`, `hospital_name`, `request_date`, `request_status`, `covid_result`, `result`, `remarks`, `result_file`) VALUES
(1, 'asiya', '123@gmail.com', '1234567890', 'coughing', 'city hospital', '2025-11-21 14:35:32', 'Pending', NULL, 'Negative', '', NULL),
(2, 'asiya', '123@gmail.com', '1234567890', 'qwerty', 'city hospital', '2025-11-21 14:35:32', 'Pending', NULL, 'Positive', '', NULL),
(3, 'Muhammad Fazil', 'zaakiafazil@gmail.com', '03222047411', 'coughing fever ', 'city hospital', '2025-11-21 16:31:34', 'Pending', NULL, 'Positive', '', NULL),
(4, 'Muhammad Fazil', 'zaakiafazil@gmail.com', '03222047411', 'coughing fever ', 'city hospital', '2025-11-21 16:32:57', 'Pending', NULL, 'Positive', '', NULL),
(5, 'mazia', 'mazia@gmail.com', '000000000000', 'flu', 'city hospital', '2025-11-24 14:19:48', 'Pending', NULL, 'Positive', '', NULL),
(6, 'bisma', 'bisma@gmail.com', '123456789000', 'coughing,fever', 'city hospital', '2025-11-25 14:18:24', 'Pending', NULL, 'Positive', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'City Hospital', '123 Main Street, Karachi', '03001234567', 'cityhospital@gmail.com'),
(2, 'Hope Hospital', '45 Hope Road, Lahore', '03007654321', 'hopehospital@gmail.com'),
(3, 'Care Hospital', '67 Care Avenue, Islamabad', '03009876543', 'carehospital@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_login`
--

CREATE TABLE `hospital_login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_login`
--

INSERT INTO `hospital_login` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'My Hospital', 'hospital@example.com', '1234', '2025-11-21 15:03:28'),
(2, 'health hospital', 'health@gmail.com', '8900', '2025-11-24 15:08:49'),
(3, 'hope hospital', 'hope@gmail.com', '', '2025-11-24 15:09:31'),
(4, 'jinnah hospital', 'jinnah@gmail.com', '7890', '2025-11-25 14:22:30'),
(5, 'jinnah ', '123@gmail.com', '5890', '2025-11-25 15:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_login_requests`
--

CREATE TABLE `hospital_login_requests` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_login_requests`
--

INSERT INTO `hospital_login_requests` (`id`, `hospital_name`, `address`, `email`, `phone`, `status`) VALUES
(1, 'hope hospital', 'qwertyui', 'hope@gmail.com', '', 'approved'),
(2, 'health hospital', 'karachi', 'health@gmail.com', '12345678900', 'approved'),
(3, 'jinnah hospital', 'karachi', 'jinnah@gmail.com', '1234567890', 'approved'),
(4, 'jinnah ', 'karachi', '123@gmail.com', '12345890', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_vaccines`
--

CREATE TABLE `hospital_vaccines` (
  `id` int(11) NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `status` varchar(30) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospital_vaccines`
--

INSERT INTO `hospital_vaccines` (`id`, `hospital_id`, `vaccine_name`, `quantity`, `status`) VALUES
(1, 1, 'Pfizer–BioNTech', 50, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','hospital','patient') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `email`, `password`, `role`) VALUES
(1, 'zaakiafazil@gmail.com', '$2y$10$tLDryMTgYPi1w3q/zTCKTeyRjQ5vX3wp7JbRVb/rQ50rG21h8pXIO', 'patient'),
(2, 'umer@gmail.com', '$2y$10$HYu0139ImiiH6Cv6ugMWiuv4oLBY7XBaiC78sL6sYHCYRmubOat9S', 'patient'),
(3, 'umer@gmail.com', '$2y$10$laD7YCrn4AtAy7692YaU0etzrUi62SGYwx.thj3SfOL4iWCI8OzLW', 'patient'),
(4, 'umer@gmail.com', '$2y$10$paIgwJHhXwkEu/9Auu7AOeMU/3z4eilAJ43Jl/QWcsk29PL7QDTqK', 'patient'),
(5, '123@gmail.com', '123456', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `password`, `age`, `gender`, `phone`, `address`) VALUES
(1, 'Muhammad Fazil', 'zaakiafazil@gmail.com', '$2y$10$tLDryMTgYPi1w3q/zTCKTeyRjQ5vX3wp7JbRVb/rQ50rG21h8pXIO', 19, 'Male', '03222047411', 'Main liaquat Ali Khan road model colony malir near seed super store'),
(2, 'umer', 'umer@gmail.com', '$2y$10$HYu0139ImiiH6Cv6ugMWiuv4oLBY7XBaiC78sL6sYHCYRmubOat9S', 19, 'Male', '03222047411', 'Main liaquat Ali Khan road model colony malir near seed super store'),
(3, 'umer', 'umer@gmail.com', '$2y$10$laD7YCrn4AtAy7692YaU0etzrUi62SGYwx.thj3SfOL4iWCI8OzLW', 19, 'Male', '03222047411', 'Main liaquat Ali Khan road model colony malir near seed super store'),
(4, 'umer', 'umer@gmail.com', '$2y$10$paIgwJHhXwkEu/9Auu7AOeMU/3z4eilAJ43Jl/QWcsk29PL7QDTqK', 19, 'Male', '03222047411', 'Main liaquat Ali Khan road model colony malir near seed super store'),
(5, 'asiya', '123@gmail.com', '123456', 19, 'Female', '12345678900', 'qwertyuioplkjhgfds'),
(6, 'bisma', 'bisma@gmail.com', '$2y$10$q0ZiCGtc7Z0Vhh/yFenQYeq.tDUJmYWJmY76L08ftYUd6/ycwNtYy', 25, 'Female', '12345678900', 'qwertyui'),
(7, 'maaz', 'maaz@gmail.com', '$2y$10$dTuGbQ.yzAL6.pjigmluyOmsPPLyEyTGCV27RbcgIVR.WDeZuVMMG', 23, 'Male', '03482191802', 'asdasdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `dose1_date` date DEFAULT NULL,
  `dose2_date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Not Vaccinated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`id`, `patient_id`, `dose1_date`, `dose2_date`, `status`) VALUES
(1, 1, '2025-12-01', NULL, 'Vaccinated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `covid_test`
--
ALTER TABLE `covid_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `covid_test_requests`
--
ALTER TABLE `covid_test_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_login`
--
ALTER TABLE `hospital_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hospital_login_requests`
--
ALTER TABLE `hospital_login_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital_vaccines`
--
ALTER TABLE `hospital_vaccines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `covid_test`
--
ALTER TABLE `covid_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `covid_test_requests`
--
ALTER TABLE `covid_test_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospital_login`
--
ALTER TABLE `hospital_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital_login_requests`
--
ALTER TABLE `hospital_login_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital_vaccines`
--
ALTER TABLE `hospital_vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
