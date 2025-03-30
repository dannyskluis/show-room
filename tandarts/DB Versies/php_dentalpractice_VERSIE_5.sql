-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 12:15 PM
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
(1, 1, 1, '2024-09-20 12:42:03', 'hihihi', 'yessss', 'Done'),
(2, 3, 1, '2024-09-27 15:30:00', 'am yellow', 'good teeth', 'Done'),
(3, 1, 3, '2024-10-10 14:25:00', 'am hungry', 'me too', 'Done'),
(4, 1, 6, '2024-10-11 11:00:00', 'Am sick', 'nicee', 'Cancelled'),
(5, 1, 6, '2024-10-10 16:00:00', 'you sick', 'me too sick', 'Done'),
(6, 1, 6, '2024-10-11 00:00:00', 'you sick', 'me too sick', 'Done'),
(7, 1, 6, '2024-10-10 16:10:00', 'you sick', 'me too sick', 'Done'),
(8, 1, 6, '2024-10-10 16:15:00', '', '', 'Done'),
(9, 1, 6, '2024-10-11 09:00:00', '', '', 'Done'),
(10, 1, 6, '2024-10-11 10:00:00', '', '', 'Done'),
(11, 1, 6, '2024-10-11 13:00:00', '', '', 'Cancelled'),
(12, 1, 6, '2024-10-11 08:00:00', '', '', 'Done'),
(13, 1, 6, '2024-10-02 08:00:00', '', '', 'Done'),
(14, 1, 6, '2024-10-10 14:50:00', '', '', 'Done'),
(15, 1, 6, '2024-10-10 14:45:00', '', '', 'Done'),
(16, 1, 6, '2024-10-11 10:30:00', '', '', 'Done'),
(17, 1, 6, '2024-10-10 14:30:00', '', '', 'Done'),
(18, 1, 6, '2024-10-11 15:30:00', '', '', 'Cancelled'),
(19, 3, 6, '2024-10-10 14:00:00', '', '', 'Done'),
(20, 1, 6, '2024-10-11 12:30:00', '', NULL, 'Cancelled'),
(21, 1, 6, '2024-10-19 15:30:00', '', NULL, 'Cancelled'),
(22, 1, 6, '2024-10-11 16:00:00', '', NULL, 'Cancelled'),
(23, 3, 6, '2024-10-17 08:00:00', '', NULL, 'Cancelled'),
(24, 1, 6, '2024-10-12 14:00:00', '', NULL, 'Cancelled'),
(26, 1, 6, '2024-10-22 16:00:00', 'avsecwt3tv', NULL, 'Cancelled'),
(27, 1, 6, '2024-10-11 13:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci a odio, tincidunt lacinia. Morbi nunc odio, gravida at cursus nec, luctus a lorem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci a odio, tincidunt lacinia. Morbi nunc odio, gravida at cursus nec, luctus a lorem.', 'Done'),
(28, 3, 6, '2024-10-19 08:00:00', 'have pain at my left front tooth', NULL, 'Cancelled'),
(29, 3, 6, '2024-10-19 16:00:00', 'have pain at my left front tooth', NULL, 'Cancelled'),
(30, 3, 6, '2024-10-17 11:15:00', 'Would this work?', 'Maybe?', 'Done'),
(31, 1, 6, '2024-10-19 08:00:00', '', NULL, 'Cancelled'),
(32, 1, 6, '2024-10-18 08:00:00', '', NULL, 'Done'),
(33, 1, 6, '2024-10-18 10:00:00', '', NULL, 'Done'),
(34, 1, 7, '2024-10-18 08:30:00', '', NULL, 'Cancelled'),
(35, 1, 6, '2024-10-19 08:00:00', '', NULL, 'Scheduled');

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
(1, 'test', 'test2', 'admin@gmail.com', 'test2@gmail.com', 0, '2006-09-04', '', 0, '$2y$10$WGoj41Mw0NLsHxOlPxsT/epQSEpysTLCWs2p7K6zrMFpLq5B7X4JG'),
(3, 'richie', 'rich', 'john.doe@example.com', 'admin@gmail.com', 78589058, '1974-03-07', '', 0, '$2y$10$i9QYPhPdFUW.s8rebS90teZ2ciQqUaIJHpejgO3.k.ze7CIYzNMIy');

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
(1, 6, 5, '2024-10-11', '1', 'good appoinment and treatmnet'),
(2, 6, 6, '2024-10-11', '5', 'good'),
(3, 6, 7, '2024-10-11', '3', 'ssdasd'),
(4, 6, 8, '2024-10-11', '4', 'asfAEGEW'),
(5, 6, 9, '2024-10-11', '3', 'ASFASF'),
(6, 6, 10, '2024-10-11', '1', 'ASF'),
(7, 6, 12, '2024-10-11', '5', 'FASF'),
(8, 6, 14, '2024-10-11', '5', 'ASFA'),
(9, 6, 15, '2024-10-11', '3', 'FAEFA'),
(10, 6, 16, '2024-10-11', '3', 'EFAF'),
(11, 6, 17, '2024-10-11', '3', 'AEFVf'),
(12, 6, 19, '2024-10-11', '4', 'ASFw'),
(13, 6, 19, '2024-10-11', '4', 'ASFw'),
(14, 6, 19, '2024-10-11', '4', 'ASFw'),
(15, 6, 19, '2024-10-11', '4', 'ASFw'),
(16, 6, 27, '2024-10-11', '4', 'had pijn aan mijn mond erna'),
(17, 6, 27, '2024-10-11', '4', 'had pijn aan mijn mond erna'),
(18, 6, 27, '2024-10-11', '4', 'had pijn aan mijn mond erna'),
(19, 6, 30, '2024-10-17', '5', 'Goede tandarts'),
(20, 6, 13, '2024-10-17', '2', 'Bad tandarts no fun'),
(21, 6, 32, '2024-10-18', '4', 'nicceee');

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
(1, 'Julie', 'Kraanen', 'jk@gmail.com', 653927420, '2006-09-12', '$2y$10$uXYlaGCA7n8AbIQf6V47XOuADJzx2vmIjSb6yLMFY85yPDchcEc1K'),
(2, 'Mario', 'Kart', 'MK@gmail.com', 6241002, '2024-09-02', '$2y$10$wLogss7xb3VcT.6Ol2XtR.EQlOlK0rcKRJpo4KemopBRXiuIi0Qzq'),
(3, 'test', 'test', 'test@gmail.com', 0, '2006-09-20', '$2y$10$fGzF9TmthvawtPUPjgM6S.DFH1Fy2GFaRhVqdT9YWMmkaKQNLUL4G'),
(5, 'Mario', 'Kart', 'admin@gmail.com', 6241002, '2006-10-09', '$2y$10$2EgzUMq5Smukz6NLFMrV0uJ65QxZOx7Gn5sJfPaDKKfsWjn9TLb1S'),
(6, 'Julie', 'Kraanen', 'juliekraanen@gmail.com', 6241002, '2006-10-10', '$2y$10$d7DGJjKSm5HRi2I731sd/uTW13SwhOIHJYZwqkNIvK6NZyjXKEk2a'),
(7, 'Peter', 'Nice', 'Suzukidr125parts@gmail.com', 234567890, '2005-07-29', '$2y$10$Uz2hIqJzT4AqjEZKSWCGy.HtUB1qQIXBpjiS7eXlgw/P9Yjq0PlnG'),
(8, 'Mario', 'Nice', 'juliekraanen2@gmail.com', 2345678, '2006-10-12', '$2y$10$bK3Yy2DpGq5cdWUil3FkJ.xOsvEesgKuOEhZvtsqz26RWpB9oZlPu');

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
  MODIFY `APPOINTMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `EMPLOYEE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_reviews`
--
ALTER TABLE `employee_reviews`
  MODIFY `REVIEW_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `PATIENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
