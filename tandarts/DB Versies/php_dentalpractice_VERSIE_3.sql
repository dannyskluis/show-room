-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 01:42 PM
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
-- Database: `php_dentalpractice`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `APPOINTMENT_ID` int(11) NOT NULL,
  `APPOINTMENT_EMPLOYEE_ID` int(11) NOT NULL,
  `APPOINTMENT_PATIENT_ID` int(11) NOT NULL,
  `APPOINTMENT_DATETIME` datetime NOT NULL,
  `APPOINTMENT_PATIENT_COMMENT` text DEFAULT NULL,
  `APPOINTMENT_EMPLOYEE_COMMENT` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EMPLOYEE_ID` int(11) NOT NULL,
  `EMPLOYEE_FIRSTNAME` varchar(255) NOT NULL,
  `EMPLOYEE_LASTNAME` varchar(255) NOT NULL,
  `EMPLOYEE_PRIVATE_EMAIL` varchar(255) NOT NULL,
  `EMPLOYEE_WORK_EMAIL` varchar(255) NOT NULL,
  `EMPLOYEE_PHONENUMBER` int(10) NOT NULL,
  `EMPLOYEE_BIRTHDAY` date NOT NULL,
  `EMPLOYEE_FUNCTION` varchar(255) NOT NULL,
  `EMPLOYEE_SALARY` int(11) NOT NULL,
  `EMPLOYEE_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_reviews`
--

CREATE TABLE `employee_reviews` (
  `REVIEW_ID` int(11) NOT NULL,
  `REVIEW_PATIENT_ID` int(11) NOT NULL,
  `REVIEW_APPOINTMENT_ID` int(11) NOT NULL,
  `REVIEW_DATE` date NOT NULL,
  `RATING` enum('1','2','3','4','5') NOT NULL,
  `REVIEW_TEXT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_details`
--

CREATE TABLE `insurance_details` (
  `INSURANCE_ID` int(11) NOT NULL,
  `INSURANCE_PATIENT_ID` int(11) NOT NULL,
  `INSURANCE_PROVIDER` varchar(255) NOT NULL,
  `POLICY_NUMBER` varchar(255) NOT NULL,
  `COVERAGE_DETAILS` text NOT NULL,
  `INSURANCE_START_DATE` date NOT NULL,
  `INSURANCE_EXPIRY_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance_details`
--

INSERT INTO `insurance_details` (`INSURANCE_ID`, `INSURANCE_PATIENT_ID`, `INSURANCE_PROVIDER`, `POLICY_NUMBER`, `COVERAGE_DETAILS`, `INSURANCE_START_DATE`, `INSURANCE_EXPIRY_DATE`) VALUES
(1, 1, 'bannaan', '785', 'fgsg', '2024-09-03', '2024-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `MESSAGE_ID` int(11) NOT NULL,
  `MESSAGE_PATIENT_ID` int(11) NOT NULL,
  `MESSAGE_EMPLOYEE_ID` int(11) NOT NULL,
  `MESSAGE_CONTENT` text NOT NULL,
  `MESSAGE_SENDER` varchar(20) NOT NULL,
  `MESSAGE_TIMESTAMP` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PATIENT_ID` int(11) NOT NULL,
  `PATIENT_FIRSTNAME` varchar(255) NOT NULL,
  `PATIENT_LASTNAME` varchar(255) NOT NULL,
  `PATIENT_EMAIL` varchar(255) NOT NULL,
  `PATIENT_PHONENUMBER` int(10) NOT NULL,
  `PATIENT_BIRTHDATE` date NOT NULL,
  `PATIENT_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PATIENT_ID`, `PATIENT_FIRSTNAME`, `PATIENT_LASTNAME`, `PATIENT_EMAIL`, `PATIENT_PHONENUMBER`, `PATIENT_BIRTHDATE`, `PATIENT_PASSWORD`) VALUES
(1, 'JulieMario', 'KraanenKart', 'jkMK@gmail.com', 653927420, '2006-09-12', '$2y$10$uXYlaGCA7n8AbIQf6V47XOuADJzx2vmIjSb6yLMFY85yPDchcEc1K');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_history`
--

CREATE TABLE `treatment_history` (
  `TREATMENT_ID` int(11) NOT NULL,
  `TREATMENT_APPOINTMENT_ID` int(11) NOT NULL,
  `TREATMENT_PATIENT_ID` int(11) NOT NULL,
  `TREATMENT_EMPLOYEE_ID` int(11) NOT NULL,
  `TREATMENT_DESCRIPTION` text DEFAULT NULL,
  `TREATMENT_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`APPOINTMENT_ID`),
  ADD KEY `APPOINTMENT_EMPLOYEE_ID` (`APPOINTMENT_EMPLOYEE_ID`),
  ADD KEY `APPOINTMENT_PATIENT_ID` (`APPOINTMENT_PATIENT_ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EMPLOYEE_ID`);

--
-- Indexes for table `employee_reviews`
--
ALTER TABLE `employee_reviews`
  ADD PRIMARY KEY (`REVIEW_ID`),
  ADD KEY `REVIEW_APPOINTMENT_ID` (`REVIEW_APPOINTMENT_ID`),
  ADD KEY `REVIEW_PATIENT_ID` (`REVIEW_PATIENT_ID`);

--
-- Indexes for table `insurance_details`
--
ALTER TABLE `insurance_details`
  ADD PRIMARY KEY (`INSURANCE_ID`),
  ADD KEY `INSURANCE_PATIENT_ID` (`INSURANCE_PATIENT_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MESSAGE_ID`),
  ADD KEY `MESSAGE_EMPLOYEE_ID` (`MESSAGE_EMPLOYEE_ID`),
  ADD KEY `MESSAGE_PATIENT_ID` (`MESSAGE_PATIENT_ID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PATIENT_ID`);

--
-- Indexes for table `treatment_history`
--
ALTER TABLE `treatment_history`
  ADD PRIMARY KEY (`TREATMENT_ID`),
  ADD KEY `TREATMENT_EMPLOYEE_ID` (`TREATMENT_EMPLOYEE_ID`),
  ADD KEY `TREATMENT_PATIENT_ID` (`TREATMENT_PATIENT_ID`),
  ADD KEY `TREATMENT_APPOINTMENT_ID` (`TREATMENT_APPOINTMENT_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `APPOINTMENT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_reviews`
--
ALTER TABLE `employee_reviews`
  MODIFY `REVIEW_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_details`
--
ALTER TABLE `insurance_details`
  MODIFY `INSURANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treatment_history`
--
ALTER TABLE `treatment_history`
  MODIFY `TREATMENT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`APPOINTMENT_EMPLOYEE_ID`) REFERENCES `employees` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`APPOINTMENT_PATIENT_ID`) REFERENCES `patients` (`PATIENT_ID`);

--
-- Constraints for table `employee_reviews`
--
ALTER TABLE `employee_reviews`
  ADD CONSTRAINT `employee_reviews_ibfk_1` FOREIGN KEY (`REVIEW_APPOINTMENT_ID`) REFERENCES `appointments` (`APPOINTMENT_ID`),
  ADD CONSTRAINT `employee_reviews_ibfk_2` FOREIGN KEY (`REVIEW_PATIENT_ID`) REFERENCES `patients` (`PATIENT_ID`);

--
-- Constraints for table `insurance_details`
--
ALTER TABLE `insurance_details`
  ADD CONSTRAINT `insurance_details_ibfk_1` FOREIGN KEY (`INSURANCE_PATIENT_ID`) REFERENCES `patients` (`PATIENT_ID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`MESSAGE_EMPLOYEE_ID`) REFERENCES `employees` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`MESSAGE_PATIENT_ID`) REFERENCES `patients` (`PATIENT_ID`);

--
-- Constraints for table `treatment_history`
--
ALTER TABLE `treatment_history`
  ADD CONSTRAINT `treatment_history_ibfk_1` FOREIGN KEY (`TREATMENT_EMPLOYEE_ID`) REFERENCES `employees` (`EMPLOYEE_ID`),
  ADD CONSTRAINT `treatment_history_ibfk_2` FOREIGN KEY (`TREATMENT_PATIENT_ID`) REFERENCES `patients` (`PATIENT_ID`),
  ADD CONSTRAINT `treatment_history_ibfk_3` FOREIGN KEY (`TREATMENT_APPOINTMENT_ID`) REFERENCES `appointments` (`APPOINTMENT_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
