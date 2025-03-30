-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 01:09 PM
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
  `APPOINTMENT_EMPLOYEE_COMMENT` text DEFAULT NULL,
  `APPOINTMENT_STATUS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`APPOINTMENT_ID`, `APPOINTMENT_EMPLOYEE_ID`, `APPOINTMENT_PATIENT_ID`, `APPOINTMENT_DATETIME`, `APPOINTMENT_PATIENT_COMMENT`, `APPOINTMENT_EMPLOYEE_COMMENT`, `APPOINTMENT_STATUS`) VALUES
(1, 1, 1, '2024-10-10 10:00:00', 'Looking forward to the appointment.', NULL, 'Done'),
(2, 2, 2, '2024-10-11 14:00:00', NULL, 'Patient is a bit anxious.', 'Done'),
(3, 1, 3, '2024-10-12 09:30:00', 'Need a follow-up.', 'Test results to be discussed.', 'Done'),
(4, 3, 1, '2024-10-13 13:00:00', NULL, NULL, 'Done'),
(5, 1, 11, '2024-10-21 08:00:00', 'My teeth hurt', NULL, 'Scheduled'),
(6, 6, 10, '2024-10-22 14:00:00', 'Broken tooth', NULL, 'Scheduled'),
(7, 7, 9, '2024-10-23 10:00:00', '', NULL, 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `education_articles`
--

CREATE TABLE `education_articles` (
  `ARTICLE_ID` int(11) NOT NULL,
  `ARTICLE_TITLE` varchar(255) NOT NULL,
  `ARTICLE_DESCRIPTION` varchar(255) NOT NULL,
  `ARTICLE_LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_articles`
--

INSERT INTO `education_articles` (`ARTICLE_ID`, `ARTICLE_TITLE`, `ARTICLE_DESCRIPTION`, `ARTICLE_LINK`) VALUES
(1, 'What\'s the right way to brush your teeth?', '', 'https://www.health.harvard.edu/blog/whats-the-right-way-to-brush-your-teeth'),
(2, 'The senior\'s guide to dental care', '', 'https://www.health.harvard.edu/staying-healthy/the-seniors-guide-to-dental-care'),
(3, 'Halitosis: Common causes, effective treatments, and powerful prevention for bad breath', '', 'https://www.health.harvard.edu/staying-healthy/halitosis-common-causes-effective-treatments-and-powerful-prevention-for-bad-breath'),
(4, 'What does a cavity look like?', '', 'https://www.health.harvard.edu/staying-healthy/what-does-a-cavity-look-like'),
(5, 's that dental pain an emergency?', '', 'https://www.health.harvard.edu/pain/is-that-dental-pain-an-emergency'),
(6, 'One more reason to brush your teeth?', '', 'https://www.health.harvard.edu/blog/one-more-reason-to-brush-your-teeth-202402263019');

-- --------------------------------------------------------

--
-- Table structure for table `education_downloadable`
--

CREATE TABLE `education_downloadable` (
  `DOWNLOAD_ID` int(11) NOT NULL,
  `DOWNLOAD_TITLE` varchar(255) NOT NULL,
  `DOWNLOAD_DESCRIPTION` varchar(255) NOT NULL,
  `DOWNLOAD_PATH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_downloadable`
--

INSERT INTO `education_downloadable` (`DOWNLOAD_ID`, `DOWNLOAD_TITLE`, `DOWNLOAD_DESCRIPTION`, `DOWNLOAD_PATH`) VALUES
(1, 'The Impact of Dental Care Programs on Individuals and Their Families A Scoping Review', '', 'Education_Material/PDF/The Impact of Dental Care Programs on Individuals and Their Families A Scoping Review.pdf'),
(2, 'Dentists and Preventive Oral Health Care', '', 'Education_Material/PDF/Dentists and Preventive Oral Health Care.pdf'),
(3, 'Explore The Importance Of Preventive Dental Care In Maintaining A Healthy And Radiant Smile Throughout Lifetime.', '', 'Education_Material/PDF/Explore The Importance Of Preventive Dental Care In Maintaining A Healthy And Radiant Smile Throughout Lifetime..pdf');

-- --------------------------------------------------------

--
-- Table structure for table `education_questions`
--

CREATE TABLE `education_questions` (
  `QUESTION_ID` int(11) NOT NULL,
  `QUESTION_TITLE` varchar(255) NOT NULL,
  `QUESTION_DESCRIPTION` text NOT NULL,
  `QUESTION_ANSWER` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_questions`
--

INSERT INTO `education_questions` (`QUESTION_ID`, `QUESTION_TITLE`, `QUESTION_DESCRIPTION`, `QUESTION_ANSWER`) VALUES
(1, 'How often should I brush my teeth?', '', 'You should brush your teeth at least twice a day, preferably in the morning and before bed.'),
(2, 'How often should I floss?', '', 'Flossing once a day is recommended to remove plaque and food particles from between the teeth.'),
(3, 'What type of toothbrush should I use?', '', 'A soft-bristled toothbrush is usually best, as it’s gentle on your gums. An electric toothbrush can also be effective.'),
(4, 'What is the best toothpaste to use?', '', 'Look for fluoride toothpaste, which helps prevent cavities and strengthens tooth enamel.'),
(5, 'How often should I visit the dentist?', '', 'It’s recommended to visit the dentist every six months for routine check-ups and cleanings.'),
(6, 'What can I expect during a dental cleaning?', '', 'A dental cleaning typically involves a thorough cleaning of your teeth, including scaling to remove plaque and tartar, followed by polishing and fluoride treatment.\r\n'),
(7, 'Does dental insurance cover preventive care?', '', 'Most dental insurance plans cover preventive care, including regular check-ups and cleanings, but it’s essential to check your specific plan for details.');

-- --------------------------------------------------------

--
-- Table structure for table `education_video`
--

CREATE TABLE `education_video` (
  `VIDEO_ID` int(11) NOT NULL,
  `VIDEO_TITLE` varchar(255) NOT NULL,
  `VIDEO_DESCRIPTION` varchar(255) NOT NULL,
  `VIDEO_LINK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_video`
--

INSERT INTO `education_video` (`VIDEO_ID`, `VIDEO_TITLE`, `VIDEO_DESCRIPTION`, `VIDEO_LINK`) VALUES
(1, 'Oral Health Awareness', '', 'https://www.youtube.com/watch?v=9Qa2K1CC3Hw'),
(2, 'The Perfect Oral Health Care Routine (3 easy steps)', '', 'https://www.youtube.com/watch?v=5J89gCDt_rk'),
(3, 'Oral Health Awareness - Tooth Decay', '', 'https://www.youtube.com/watch?v=cRWCHwt4_xQ'),
(4, 'Dental Health PSA (short)', '', 'https://www.youtube.com/watch?v=I6fKzygrgfE'),
(5, 'What causes tooth decay?', '', 'https://www.youtube.com/watch?v=BE_h4bTdcdQ');

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

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EMPLOYEE_ID`, `EMPLOYEE_FIRSTNAME`, `EMPLOYEE_LASTNAME`, `EMPLOYEE_PRIVATE_EMAIL`, `EMPLOYEE_WORK_EMAIL`, `EMPLOYEE_PHONENUMBER`, `EMPLOYEE_BIRTHDAY`, `EMPLOYEE_FUNCTION`, `EMPLOYEE_SALARY`, `EMPLOYEE_PASSWORD`) VALUES
(1, 'Sarah', 'Connor', 'sarah.connor@gmail.com', 'sarah.connor@tinytoothdental.com', 2147483647, '1980-06-01', 'Doctor', 90000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(2, 'Joy', 'Taylor', 'joy.taylor@gmail.com', 'joy.taylor@tinytoothdental.com', 2147483647, '1983-07-11', 'Doctor', 60000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(3, 'Mark', 'Wilson', 'mark.wilson@gmail.com', 'mark.wilson@tinytoothdental.com', 2147483647, '1978-09-19', 'Receptionist', 40000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(4, 'Hayat', 'Markiet', '2127694@talnet.nl', 'Hayat.Markiet@tinytoothdental.com', 45776543, '1994-10-06', 'Doctor', 6000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(5, 'Danny', 'Meijer', '2150270@talnet.nl', 'Danny.Markiet@tinytoothdental.com', 462364499, '1991-10-02', 'Doctor', 10000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(6, 'Julie', 'Kraanen', '2165220@talnet.nl', 'Julie.Kraanen@tinytoothdental.com', 628234443, '1994-10-08', 'Doctor', 15000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(7, 'Toei', 'Oemraw', '2112252@talnet.nl', 'Toei.Oemraw@tinytoothdental.com', 628235547, '1994-09-03', 'Doctor', 3000, '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reviews`
--

CREATE TABLE `employee_reviews` (
  `REVIEW_ID` int(11) NOT NULL,
  `REVIEW_PATIENT_ID` int(11) NOT NULL,
  `REVIEW_APPOINTMENT_ID` int(11) NOT NULL,
  `REVIEW_DATE` date NOT NULL,
  `RATING` enum('0','1','2','3','4','5') NOT NULL,
  `REVIEW_TEXT` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_reviews`
--

INSERT INTO `employee_reviews` (`REVIEW_ID`, `REVIEW_PATIENT_ID`, `REVIEW_APPOINTMENT_ID`, `REVIEW_DATE`, `RATING`, `REVIEW_TEXT`) VALUES
(1, 1, 1, '2024-10-01', '5', 'Excellent service! Very friendly.'),
(2, 2, 2, '2024-10-02', '4', 'Good experience, but waiting time was a bit long.'),
(3, 1, 3, '2024-10-03', '3', 'Average visit, not much interaction.');

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
(1, 1, 'Health Insure Co.', 'POL123456', 'Full Coverage', '2022-01-01', '2024-01-01'),
(2, 2, 'LifeCare Insurance', 'LIFE987654', 'Basic Coverage', '2023-05-15', '2025-05-15');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MESSAGE_ID`, `MESSAGE_PATIENT_ID`, `MESSAGE_EMPLOYEE_ID`, `MESSAGE_CONTENT`, `MESSAGE_SENDER`, `MESSAGE_TIMESTAMP`) VALUES
(1, 1, 1, 'Hello, I would like to confirm my appointment.', 'patient', '2024-10-18 12:31:12'),
(2, 2, 2, 'Can I get a prescription refill?', 'patient', '2024-10-18 12:31:12'),
(3, 1, 3, 'Thank you for your help today.', 'patient', '2024-10-18 12:31:12'),
(4, 3, 1, 'Your test results are ready.', 'employee', '2024-10-18 12:31:12');

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
(5, 'John', 'Doe', 'john.doe@gmail.com', 1234567890, '1985-01-15', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(6, 'Jane', 'Smith', 'jane.smith@gmail.com', 2147483647, '1990-02-20', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(7, 'Alice', 'Johnson', 'alice.johnson@gmail.com', 2147483647, '1988-03-10', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(8, 'Bob', 'Brown', 'bob.brown@gmail.com', 2147483647, '1975-04-25', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(9, 'Hayat', 'Markiet', '2127694@talnet.nl', 45776543, '1994-10-06', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(10, 'Danny', 'Meijer', '2150270@talnet.nl', 462364499, '1991-10-02', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(11, 'Julie', 'Kraanen', '2165220@talnet.nl', 628234443, '1994-10-08', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2'),
(12, 'Toei', 'Oemraw', '2112252@talnet.nl', 628235547, '1994-09-03', '$2y$10$Ivs2MHactAcl5GcJCrkVpeLbHVVCiRlDnEdCUwEJHWjJYCx7ClzP2');

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
-- Indexes for table `education_articles`
--
ALTER TABLE `education_articles`
  ADD PRIMARY KEY (`ARTICLE_ID`);

--
-- Indexes for table `education_downloadable`
--
ALTER TABLE `education_downloadable`
  ADD PRIMARY KEY (`DOWNLOAD_ID`);

--
-- Indexes for table `education_questions`
--
ALTER TABLE `education_questions`
  ADD PRIMARY KEY (`QUESTION_ID`);

--
-- Indexes for table `education_video`
--
ALTER TABLE `education_video`
  ADD PRIMARY KEY (`VIDEO_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `APPOINTMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `education_articles`
--
ALTER TABLE `education_articles`
  MODIFY `ARTICLE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `education_downloadable`
--
ALTER TABLE `education_downloadable`
  MODIFY `DOWNLOAD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `education_questions`
--
ALTER TABLE `education_questions`
  MODIFY `QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `education_video`
--
ALTER TABLE `education_video`
  MODIFY `VIDEO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_reviews`
--
ALTER TABLE `employee_reviews`
  MODIFY `REVIEW_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `insurance_details`
--
ALTER TABLE `insurance_details`
  MODIFY `INSURANCE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
