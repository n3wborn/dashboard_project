-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Jul 28, 2020 at 09:40 AM
-- Server version: 10.4.13-MariaDB-1:10.4.13+maria~focal
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `achat_materiel`
--

CREATE TABLE `achat_materiel` (
  `ID` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `ref_product` varchar(20) NOT NULL,
  `categories` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `garanty_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `advice` varchar(256) DEFAULT NULL,
  `picture` int(11) DEFAULT NULL,
  `manual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'electro-menager'),
(4, 'vetements'),
(5, 'vehicules'),
(6, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `manu`
--

CREATE TABLE `manu` (
  `id` int(11) NOT NULL,
  `manual` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `id` int(11) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`) VALUES
(1, 'gefz'),
(2, 'gez'),
(3, 'https://www.wix.com/'),
(4, 'https://www.cdiscount.com/'),
(5, 'https://www.amazon.fr/'),
(6, 'https://www.zalando.fr/'),
(7, 'https://www.veepee.fr/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achat_materiel`
--
ALTER TABLE `achat_materiel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `location` (`location`),
  ADD KEY `categories` (`categories`),
  ADD KEY `picture` (`picture`,`manual`),
  ADD KEY `manual` (`manual`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manu`
--
ALTER TABLE `manu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achat_materiel`
--
ALTER TABLE `achat_materiel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manu`
--
ALTER TABLE `manu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achat_materiel`
--
ALTER TABLE `achat_materiel`
  ADD CONSTRAINT `achat_materiel_ibfk_1` FOREIGN KEY (`categories`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_2` FOREIGN KEY (`location`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_3` FOREIGN KEY (`picture`) REFERENCES `pic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_4` FOREIGN KEY (`manual`) REFERENCES `manu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
