-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 14 jan 2023 om 16:04
-- Serverversie: 10.9.3-MariaDB-1:10.9.3+maria~ubu2204
-- PHP-versie: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodies`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Favourites`
--

CREATE TABLE `Favourites` (
  `user_id` int(11) NOT NULL,
  `recipe_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `Favourites`
--

INSERT INTO `Favourites` (`user_id`, `recipe_id`) VALUES
(4, '47746'),
(4, '46956'),
(4, '47269');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`, `role`) VALUES
(4, 'luc', 'luc.moetwil@gmail.com', '$2y$10$FW02KH7bSeaYAVytOZB2C.5i9jSOm7vIbXkCSV485bNpMS2H/sDWy', 1),
(6, 'mark', 'mark@mail.com', '$2y$10$1uLor.N5JXlLnBW1CFeMw.MSnYNCQqXBzftVJVx5ThtOGgAKbgDA.', 0),
(9, 'rick', 'rick@mail.com', '$2y$10$FW02KH7bSeaYAVytOZB2C.5i9jSOm7vIbXkCSV485bNpMS2H/sDWy', 0),
(10, 'bart', 'bart@mail.com', '$2y$10$FW02KH7bSeaYAVytOZB2C.5i9jSOm7vIbXkCSV485bNpMS2H/sDWy', 0),
(11, 'gerrit', 'gerrit@mail.com', '$2y$10$FW02KH7bSeaYAVytOZB2C.5i9jSOm7vIbXkCSV485bNpMS2H/sDWy', 0),
(12, 'henk', 'henk@mail.com', '$2y$10$FW02KH7bSeaYAVytOZB2C.5i9jSOm7vIbXkCSV485bNpMS2H/sDWy', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
