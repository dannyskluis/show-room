-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 mrt 2025 om 11:02
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
-- Database: `hotel_ter_duin`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kamers`
--

CREATE TABLE `kamers` (
  `kamer_id` int(11) NOT NULL,
  `kamertype` varchar(50) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `status` enum('beschikbaar','bezet') DEFAULT 'beschikbaar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `kamers`
--

INSERT INTO `kamers` (`kamer_id`, `kamertype`, `prijs`, `status`) VALUES
(1, 'Single', 100.00, 'bezet'),
(2, 'Double', 150.00, 'bezet'),
(3, 'Suite', 250.00, 'bezet'),
(4, 'Single', 100.00, 'bezet'),
(5, 'Double', 150.00, 'beschikbaar'),
(6, 'Suite', 250.00, 'beschikbaar'),
(7, 'Single', 100.00, 'bezet'),
(8, 'Double', 150.00, 'bezet'),
(9, 'Suite', 250.00, 'bezet'),
(10, 'Single', 100.00, 'bezet');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klant_id` int(11) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `telefoonnummer` varchar(20) DEFAULT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klant_id`, `voornaam`, `achternaam`, `e_mail`, `telefoonnummer`, `wachtwoord`) VALUES
(1, 'test', 'user', 'testuser@login.nl', '12345678', '$2y$10$N2WQP6eq0hsWyFtYIXDW9.6SeprJy68RhujvZNOH4Hibw1zoeMBte'),
(2, 'danny', 'meijer', 'appel@peer.com', '87654321', '$2y$10$HoVHh598ssQRE84cDaefquukbNLjfaq5IEh4FYIodplf8eKcLC/VK');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

CREATE TABLE `medewerkers` (
  `medewerker_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `rol` enum('admin','receptionist') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`medewerker_id`, `naam`, `e_mail`, `wachtwoord`, `rol`) VALUES
(1, 'admin', 'admin@mail.nl', '$2y$10$zcE408GqBZs2ZKlvEHnA8uLQkmh16Cj753BmpGRbAF1sGaiua.3lu', 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

CREATE TABLE `reserveringen` (
  `reservering_id` int(11) NOT NULL,
  `klant_id` int(11) DEFAULT NULL,
  `kamer_id` int(11) DEFAULT NULL,
  `check_in_datum` date NOT NULL,
  `check_out_datum` date NOT NULL,
  `status` enum('geboekt','geannuleerd') DEFAULT 'geboekt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reserveringen`
--

INSERT INTO `reserveringen` (`reservering_id`, `klant_id`, `kamer_id`, `check_in_datum`, `check_out_datum`, `status`) VALUES
(7, 1, 5, '2025-03-24', '2025-03-28', 'geannuleerd'),
(8, 1, 5, '2025-03-24', '2025-03-28', 'geannuleerd');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `kamers`
--
ALTER TABLE `kamers`
  ADD PRIMARY KEY (`kamer_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klant_id`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- Indexen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD PRIMARY KEY (`medewerker_id`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- Indexen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD PRIMARY KEY (`reservering_id`),
  ADD KEY `klant_id` (`klant_id`),
  ADD KEY `kamer_id` (`kamer_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `kamers`
--
ALTER TABLE `kamers`
  MODIFY `kamer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  MODIFY `medewerker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  MODIFY `reservering_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD CONSTRAINT `reserveringen_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`klant_id`),
  ADD CONSTRAINT `reserveringen_ibfk_2` FOREIGN KEY (`kamer_id`) REFERENCES `kamers` (`kamer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
