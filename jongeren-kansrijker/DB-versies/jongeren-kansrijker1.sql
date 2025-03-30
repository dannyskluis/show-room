-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 nov 2024 om 10:19
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
-- Database: `jongeren-kansrijker`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `coworkers`
--

CREATE TABLE `coworkers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `coworkers`
--

INSERT INTO `coworkers` (`id`, `username`, `password`) VALUES
(1, 'testuser', '$2y$10$Hpvrv5etLapcMGvzDx1sA.69ui77R65JfxMF8cBmDaas/vNCPwlVm');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `coworkers`
--
ALTER TABLE `coworkers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `coworkers`
--
ALTER TABLE `coworkers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Tabel voor Activiteiten
CREATE TABLE activiteiten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    beschrijving TEXT NOT NULL,
    datum DATETIME NOT NULL,
    locatie VARCHAR(255) NOT NULL
);

-- Tabel voor Gebruikers (voor inlogbeheer, optioneel)
CREATE TABLE gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(255) UNIQUE NOT NULL,
    wachtwoord VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    rol VARCHAR(50) NOT NULL DEFAULT 'gebruiker',
    aangemaakt_op DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Optionele Tabel voor Activiteit Deelnemers (relatie tussen gebruikers en activiteiten)
CREATE TABLE activiteit_deelnemers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activiteit_id INT NOT NULL,
    gebruiker_id INT NOT NULL,
    ingeschreven_op DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (activiteit_id) REFERENCES activiteiten(id),
    FOREIGN KEY (gebruiker_id) REFERENCES gebruikers(id)
);
