-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2014 at 10:33 AM
-- Server version: 5.6.17
-- PHP Version: 5.4.30

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tango`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
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
  `public` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `category_id`, `name`, `slug`, `biography`, `createdat`, `updatedat`, `file`, `slogan`, `googleplus`, `facebook`, `twitter`, `instagram`, `url`, `address`, `telephone`, `latitude`, `longitude`, `public`) VALUES
(1, 1, 2, 'Projecto Tango', 'projecto-tango', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet, leo vitae finibus rutrum, lorem est malesuada magna, sed pulvinar ante risus ac dui. Donec cursus ex non luctus fringilla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec vel dictum erat. Praesent fringilla cursus leo. Donec eleifend lectus non libero tristique, sit amet finibus ipsum tempor. Vivamus dictum eros cursus odio pharetra, at mollis metus convallis.</p>\r\n\r\n<p>Suspendisse sit amet sodales lacus. Pellentesque pharetra lectus suscipit accumsan luctus. Etiam nec purus accumsan, mollis nibh nec, fermentum odio. Vivamus mollis, orci vitae iaculis fringilla, quam mi maximus felis, nec accumsan ipsum lorem et ipsum. Nunc semper scelerisque tellus, at sodales ante ultricies eu. Vivamus sed tristique purus. Nullam bibendum ex id commodo imperdiet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam nec est sed urna egestas venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam sodales sapien ac dignissim pellentesque.</p>\r\n', '2014-10-24 12:52:08', '2014-10-26 10:31:21', '/documents/profiles/projecto-tango/milonga3.jpg', 'Passion first!', '+shinesoftwareitalia', 'shinesoftware', 'shine_software', 'cataniatrieste', 'http://www.itango.it', 'Via Belpoggio, 6\r\n34123 Trieste', '+39.123456789', 45.6449, 13.7605, 1),
(2, 2, 5, 'Michelangelo Turillo', 'michelangelo', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit ligula. Etiam imperdiet, libero quis porta auctor, lorem arcu pharetra mauris, vel feugiat eros nibh vel massa. Sed ut scelerisque enim. Ut tempus, lectus sit amet commodo ultricies, velit ante dignissim augue, quis molestie risus turpis sed velit. Aliquam placerat ipsum turpis, quis gravida nunc suscipit ac. Vivamus suscipit eros nec metus ultricies, commodo ultricies ante vulputate.</p>\r\n\r\n<p>Vestibulum luctus lacinia sem, in egestas justo dictum nec. Sed tincidunt dui risus, quis gravida sem consequat eu. Curabitur elit mauris, gravida in magna in, ullamcorper ultrices purus. Vestibulum euismod, justo pharetra consequat sagittis, purus orci congue ipsum, quis maximus ipsum lorem a lectus. Pellentesque laoreet, lacus vel dictum volutpat, arcu quam dapibus tellus, et aliquam nisi augue sed neque.</p>\r\n', '2014-10-25 20:56:51', '2014-10-26 09:20:28', '/documents/profiles/michelangelo/milonga4.jpg', 'Passion first!', '', '', '', '', NULL, 'Via Belpoggio, 6\r\n34123 Trieste', '3395383338', 45.6449, 13.7605, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_category`
--

DROP TABLE IF EXISTS `profile_category`;
CREATE TABLE IF NOT EXISTS `profile_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `profile_category`
--

INSERT INTO `profile_category` (`id`, `category`, `visible`) VALUES
(1, 'Association', 1),
(2, 'Academia / School', 1),
(3, 'Maestro', 1),
(4, 'Musicalizadores', 1),
(5, 'Tanguero', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `profile_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
