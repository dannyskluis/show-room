-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 03:10 PM
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
-- Database: `platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `firstname`, `lastname`, `email`, `phone_number`) VALUES
(1, 'Mario', 'Kart', 'MarioKart@gmail.com', '0619384992'),
(2, 'Luigi', 'Mansion', 'LuigiMansion@gmail.com', '0712456789'),
(3, 'Princess', 'Peach', 'Peach123@yahoo.com', '0785123456'),
(4, 'Yoshi', 'Green', 'YoshiGreen@hotmail.com', '0649873210'),
(5, 'Toad', 'Stool', 'ToadStool@gmail.com', '0798765432'),
(6, 'Donkey', 'Kong', 'DKong@gmail.com', '0765432198'),
(7, 'Link', 'Hero', 'LinkHero@hotmail.com', '0654321876'),
(8, 'Samus', 'Aran', 'SamusAran@gmail.com', '0723456789'),
(9, 'Zelda', 'Princess', 'ZeldaPrincess@yahoo.com', '0732109876'),
(10, 'Ganondorf', 'Dorf', 'GanondorfDorf@hotmail.com', '0789012345');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `zzpr_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `project_status` enum('Planned','In Progress','Completed') DEFAULT 'Planned',
  `project_history` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `zzpr_id`, `project_name`, `client_id`, `start_date`, `end_date`, `hourly_rate`, `project_status`, `project_history`) VALUES
(1, 1, 'Vloer leggen', 1, '2024-02-05', '2024-02-22', 70.00, 'Planned', NULL),
(2, 1, 'Tuin Maken', 1, '2024-02-08', '2024-02-15', 60.00, 'Planned', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_history`
--

CREATE TABLE `project_history` (
  `history_id` int(11) NOT NULL,
  `beschrijving` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zzprs`
--

CREATE TABLE `zzprs` (
  `zzpr_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zzprs`
--

INSERT INTO `zzprs` (`zzpr_id`, `firstname`, `lastname`, `email`, `phone_number`, `password`) VALUES
(1, 'Julie', 'Kraanen', 'admin@gmail.com', 675934002, '$2y$10$lLVWRtBKkz/MrikyALyf9uIerm.Nsl6ublB0qQffKCSR8IvflUur6'),
(2, 'danny', 'Meijer', 'Dannyadmin@platform.nl', NULL, '$2y$10$drdJg1XLqums6gyuIZDGSumGPqzDw773eP9z5l96fJrZmUZfadnOW'),
(3, 'Jeremiah', 'MarioKart', 'Jeremiahadmin@platform.nl', NULL, '$2y$10$.GBhK8xGdbjvwoMj2gy2FOHQQ33puLpRjrPbmdUQ3GqjHNl.hZ4mW'),
(4, 'Sofyan', 'Luigi', 'Sofyanadmin@platform.nl', NULL, '$2y$10$SlGaWCjcvxKCi.fCjwIefOhXUr.Om9/UAXkODCmvy9y49C1nbcxeK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_history` (`project_history`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `zzpr_id` (`zzpr_id`);

--
-- Indexes for table `project_history`
--
ALTER TABLE `project_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `zzprs`
--
ALTER TABLE `zzprs`
  ADD PRIMARY KEY (`zzpr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_history`
--
ALTER TABLE `project_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zzprs`
--
ALTER TABLE `zzprs`
  MODIFY `zzpr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`project_history`) REFERENCES `project_history` (`history_id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `projects_ibfk_3` FOREIGN KEY (`zzpr_id`) REFERENCES `zzprs` (`zzpr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
