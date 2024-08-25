-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 jan 2024 om 09:33
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `megasoft`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adressen`
--

CREATE TABLE `adressen` (
  `adress_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middle_initials` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `mv` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `nr` int(11) DEFAULT NULL,
  `Add_` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `adressen`
--

INSERT INTO `adressen` (`adress_id`, `firstname`, `middle_initials`, `lastname`, `mv`, `street`, `nr`, `Add_`, `zipcode`, `place`, `country`) VALUES
(1, 'John', 'A.', 'Doe', 'Mr.', 'Main Street', 123, 'Apt 4', '12345', 'Cityville', 'Countryland'),
(2, 'Jane', 'B.', 'Smith', 'Ms.', 'Oak Avenue', 456, 'Suite 7', '54321', 'Townsville', 'Countryland'),
(3, 'Michael', 'C.', 'Jones', 'Dr.', 'Maple Lane', 789, 'Unit 12', '67890', 'Villagetown', 'Countryland'),
(4, 'Emily', 'D.', 'Brown', 'Mrs.', 'Cedar Road', 101, 'Floor 3', '13579', 'Hamletville', 'Countryland'),
(5, 'William', 'E.', 'Miller', 'Mr.', 'Pine Street', 202, 'Room 8', '24680', 'Hilltop', 'Countryland');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `peoplesadresses`
--

CREATE TABLE `peoplesadresses` (
  `ismain` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `adress_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `peoplesadresses`
--

INSERT INTO `peoplesadresses` (`ismain`, `person_id`, `adress_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `infix` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `ismale` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `persons`
--

INSERT INTO `persons` (`person_id`, `firstname`, `infix`, `lastname`, `ismale`) VALUES
(1, 'Alice', 'M.', 'Johnson', 0),
(2, 'Bob', '', 'Williams', 1),
(3, 'Eva', 'N.', 'Taylor', 0),
(4, 'David', 'O.', 'Anderson', 1),
(5, 'Sophia', 'P.', 'White', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `adressen`
--
ALTER TABLE `adressen`
  ADD PRIMARY KEY (`adress_id`);

--
-- Indexen voor tabel `peoplesadresses`
--
ALTER TABLE `peoplesadresses`
  ADD PRIMARY KEY (`ismain`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `adress_id` (`adress_id`);

--
-- Indexen voor tabel `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `adressen`
--
ALTER TABLE `adressen`
  MODIFY `adress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `peoplesadresses`
--
ALTER TABLE `peoplesadresses`
  MODIFY `ismain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `peoplesadresses`
--
ALTER TABLE `peoplesadresses`
  ADD CONSTRAINT `peoplesadresses_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`),
  ADD CONSTRAINT `peoplesadresses_ibfk_2` FOREIGN KEY (`adress_id`) REFERENCES `adressen` (`adress_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
