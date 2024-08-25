-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 08 dec 2023 om 11:12
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
-- Database: `nextlogic`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `loggedhours`
--

CREATE TABLE `loggedhours` (
  `ID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LogDate` date DEFAULT NULL,
  `HoursWorked` decimal(5,2) DEFAULT NULL,
  `Comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `loggedhours`
--

INSERT INTO `loggedhours` (`ID`, `ProjectID`, `UserID`, `LogDate`, `HoursWorked`, `Comments`) VALUES
(1, 1, 1, '2022-01-13', 1.00, '1'),
(2, 1, 2, '2023-12-01', 1.00, '1'),
(3, 2, 2, '2023-11-30', 6.00, 'gewerkt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projectdata`
--

CREATE TABLE `projectdata` (
  `ID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `EntryDT` date DEFAULT NULL,
  `WorkDT` time DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `projectdata`
--

INSERT INTO `projectdata` (`ID`, `ProjectID`, `UserID`, `EntryDT`, `WorkDT`, `Description`) VALUES
(2, 2, 2, '2022-02-01', '09:30:00', 'Joined Another Project'),
(3, 3, 3, '2022-03-01', '10:45:00', 'Started contributing to Exciting Project');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projects`
--

CREATE TABLE `projects` (
  `ID` int(11) NOT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `ActualTitle` varchar(255) DEFAULT NULL,
  `StartDT` date DEFAULT NULL,
  `EndDT` date DEFAULT NULL,
  `MaxHours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `projects`
--

INSERT INTO `projects` (`ID`, `Active`, `Code`, `ActualTitle`, `StartDT`, `EndDT`, `MaxHours`) VALUES
(1, 1, 'PRJ-001', 'My Project', '2022-01-01', '2022-01-31', 8),
(2, 1, 'PRJ-002', 'Another Project', '2022-02-01', '2022-02-28', 4),
(3, 1, 'PRJ-003', 'Exciting Project', '2022-03-01', '2022-03-31', 15);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projectusers`
--

CREATE TABLE `projectusers` (
  `ID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `MayManage` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `projectusers`
--

INSERT INTO `projectusers` (`ID`, `ProjectID`, `UserID`, `MayManage`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 0),
(3, 3, 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`ID`, `Active`, `Name`) VALUES
(1, 1, 'John Doe'),
(2, 1, 'Jane Smith'),
(3, 1, 'Alice Johnson');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `loggedhours`
--
ALTER TABLE `loggedhours`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `projectdata`
--
ALTER TABLE `projectdata`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `projectusers`
--
ALTER TABLE `projectusers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `loggedhours`
--
ALTER TABLE `loggedhours`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `loggedhours`
--
ALTER TABLE `loggedhours`
  ADD CONSTRAINT `loggedhours_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ID`),
  ADD CONSTRAINT `loggedhours_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Beperkingen voor tabel `projectdata`
--
ALTER TABLE `projectdata`
  ADD CONSTRAINT `projectdata_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ID`),
  ADD CONSTRAINT `projectdata_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Beperkingen voor tabel `projectusers`
--
ALTER TABLE `projectusers`
  ADD CONSTRAINT `projectusers_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ID`),
  ADD CONSTRAINT `projectusers_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
