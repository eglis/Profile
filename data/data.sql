-- phpMyAdmin SQL Dump
-- version 4.6.3deb1~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ago 04, 2016 alle 11:59
-- Versione del server: 10.0.25-MariaDB-0ubuntu0.16.04.1
-- Versione PHP: 7.0.8-0ubuntu0.16.04.2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eurocv2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `biography` text,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `slogan` varchar(250) DEFAULT NULL,
  `googleplus` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `paypal` varchar(150) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `address` text,
  `telephone` varchar(50) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `public` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `category_id`, `name`, `slug`, `biography`, `createdat`, `updatedat`, `file`, `slogan`, `googleplus`, `facebook`, `twitter`, `instagram`, `paypal`, `url`, `address`, `telephone`, `latitude`, `longitude`, `public`) VALUES
(1, 2, 5, 'Michelangelo Turillo', 'michelangelo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit ligula. Etiam imperdiet, libero quis porta auctor, lorem arcu pharetra mauris, vel feugiat eros nibh vel massa. Sed ut scelerisque enim. Ut tempus, lectus sit amet commodo ultricies, velit ante dignissim augue, quis molestie risus turpis sed velit. Aliquam placerat ipsum turpis, quis gravida nunc suscipit ac. Vivamus suscipit eros nec metus ultricies, commodo ultricies ante vulputate.</p>\r\n\r\n<p>Vestibulum luctus lacinia sem, in egestas justo dictum nec. Sed tincidunt dui risus, quis gravida sem consequat eu. Curabitur elit mauris, gravida in magna in, ullamcorper ultrices purus. Vestibulum euismod, justo pharetra consequat sagittis, purus orci congue ipsum, quis maximus ipsum lorem a lectus. Pellentesque laoreet, lacus vel dictum volutpat, arcu quam dapibus tellus, et aliquam nisi augue sed neque.</p>\r\n', '2014-10-25 20:56:51', '2014-10-26 09:20:28', '/documents/profiles/michelangelo/milonga4.jpg', 'Passion first!', '', '', '', '', NULL, NULL, 'Via Belpoggio, 6\r\n34123 Trieste', '3395383338', 45.6449, 13.7605, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `profile_category`
--

DROP TABLE IF EXISTS `profile_category`;
CREATE TABLE `profile_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `profile_category`
--

INSERT INTO `profile_category` (`id`, `category`, `visible`) VALUES
(1, 'Association', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `profile_category`
--
ALTER TABLE `profile_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `profile_category`
--
ALTER TABLE `profile_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
