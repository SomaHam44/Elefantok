-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 01. 18:06
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `elefantok`
--
CREATE DATABASE IF NOT EXISTS `elefantok` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `elefantok`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allatkertiek`
--

CREATE TABLE `allatkertiek` (
  `id` int(11) NOT NULL,
  `nev` varchar(45) NOT NULL,
  `fajta` varchar(45) NOT NULL,
  `szuletesiDatum` date NOT NULL,
  `suly` int(11) NOT NULL,
  `nem` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `allatkertiek`
--

INSERT INTO `allatkertiek` (`id`, `nev`, `fajta`, `szuletesiDatum`, `suly`, `nem`) VALUES
(1, 'Jena', 'Ázsiai elefánt', '2016-01-02', 3, 'nöstény'),
(2, 'Nara', 'Afrikai elefánt', '2020-05-03', 2, 'nöstény'),
(3, 'Tamo', 'Indiai elefánt', '2011-06-15', 4, 'hím'),
(4, 'Bono', 'Ázsiai elefánt', '2012-01-03', 5, 'hím'),
(8, 'Komia', 'Afrikai elefánt', '2015-04-07', 4, 'nöstény'),
(12, 'Hun', 'Afrikai elefánt', '2014-01-02', 5, 'hím'),
(16, 'Csorgo', 'Ázsiai elefánt', '2015-06-02', 5, 'hím'),
(23, 'Kornelia', 'Indiai elefánt', '2013-06-14', 3, 'nöstény'),
(24, 'Csamolia', 'Ázsiai elefánt', '2016-11-24', 3, 'nöstény'),
(27, 'Finn', 'Afrikai elefánt', '2018-01-30', 5, 'hím'),
(28, 'Finn', '', '2018-02-02', 5, 'hím'),
(29, 'Tonos', 'Afrikai elefánt', '2019-10-09', 6, 'hím'),
(86, 'Nora', 'Ázsiai elefánt', '2021-08-01', 1, 'nöstény'),
(90, 'Manny', 'Ázsiai elefánt', '2011-11-11', 4, 'hím'),
(92, 'Tzun', 'Afrikai elefánt', '2021-11-01', 6, 'hím');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allatkertiek`
--
ALTER TABLE `allatkertiek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allatkertiek`
--
ALTER TABLE `allatkertiek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
