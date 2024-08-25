-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 jan 2024 om 23:47
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
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `jaar` varchar(100) NOT NULL,
  `kenteken` varchar(100) NOT NULL,
  `beschikbaarheid` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cars`
--

INSERT INTO `cars` (`id`, `merk`, `model`, `jaar`, `kenteken`, `beschikbaarheid`, `image`) VALUES
(5, 'aap', 'g', '2000', 'fdsdg5', 'ja', 'vehicles-8.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `rental_cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `rental_cost`) VALUES
(1, 2, 5, '2024-01-17', '2024-01-31', 7000.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `driverLicenseNumber` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_form`
--

INSERT INTO `user_form` (`id`, `fullName`, `adres`, `driverLicenseNumber`, `phoneNumber`, `email`, `password`, `user_type`) VALUES
(1, 'danny', 'Grondzeiler', '12345678', '12345678', '2150270@talnet.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(2, 'deadpool', 'highway', '98765432', '98765432', 'cool@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(5, 'harry', 'Grondzeiler', '43567', '35678', '2150270@talnet.com', '12345', 'user');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexen voor tabel `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
