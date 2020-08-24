-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 24 août 2020 à 14:52
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dashboard_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat_materiel`
--

DROP TABLE IF EXISTS `achat_materiel`;
CREATE TABLE IF NOT EXISTS `achat_materiel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `ref_product` varchar(20) NOT NULL,
  `categories` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `garanty_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `advice` varchar(256) DEFAULT NULL,
  `picture` int(11) DEFAULT NULL,
  `manual` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `location` (`location`),
  KEY `categories` (`categories`),
  KEY `picture` (`picture`,`manual`),
  KEY `manual` (`manual`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achat_materiel`
--

INSERT INTO `achat_materiel` (`ID`, `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`, `picture`, `manual`) VALUES
(4, 5, 'TV', 'AZ32P', 3, '2018-03-10', '2020-03-11', 450, 'Ne pas coller ses yeux à l\'écran', 2, 1),
(6, 3, 'Chaîne hi-fi', '34ZDT', 3, '2019-07-11', '2020-07-11', 329, 'Disponibilité des pièces détachées (données fournisseur) : Pendant 3 ans', 2, 1),
(7, 8, 'Autruche', 'PET547', 7, '2020-07-01', '2027-07-01', 530, 'Inutile de la lancer d\'un immeuble pour la voir voler ...', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Appliances'),
(4, 'Clothes'),
(5, 'Vehicles'),
(6, 'Sport'),
(7, 'Animals'),
(8, 'Home & Kitchen'),
(9, 'Outdoors'),
(10, 'Decoration');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `user`, `password`) VALUES
(1, 'steph', '$2y$10$sQfDMujXbG6uqiFoxplpEupLpCPxccgx46nNZq7LEknQxV66edwgS'),
(2, 'lea', '$2y$10$0ceYF9oGxQOnGDm2F2u6ce7R2w3AA9R1Qa/8JAjYe4EBXh6YRVSY2');

-- --------------------------------------------------------

--
-- Structure de la table `manu`
--

DROP TABLE IF EXISTS `manu`;
CREATE TABLE IF NOT EXISTS `manu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `man_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manu`
--

INSERT INTO `manu` (`id`, `name`, `man_url`) VALUES
(1, 'medias/manuel1.pdf', ''),
(2, 'medias/manuel2.pdf', ''),
(3, 'medias/manuel3.pdf', ''),
(12, 'medias/manuel3.pdf', 'manuel3.pdf'),
(13, 'medias/acs besancon postcovid.pdf', 'acs besancon postcovid.pdf'),
(14, 'medias/Pluchart-Stephane-Lettre-de-Motivation.pdf', 'Pluchart-Stephane-Lettre-de-Motivation.pdf'),
(15, 'medias/533ea8de6172e.pdf', '533ea8de6172e.pdf'),
(16, 'medias/533ea8de6172e.pdf', '533ea8de6172e.pdf'),
(17, 'medias/manuel3.pdf', 'manuel3.pdf'),
(18, 'medias/ZL_Lettre_motivation.pdf', 'ZL_Lettre_motivation.pdf'),
(19, 'medias/Exercice_1_-_Algo.pdf', 'Exercice_1_-_Algo.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `pic`
--

DROP TABLE IF EXISTS `pic`;
CREATE TABLE IF NOT EXISTS `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pic`
--

INSERT INTO `pic` (`id`, `name`, `file_url`) VALUES
(1, 'medias/ticket1.png', ''),
(2, 'medias/ticket2.png', ''),
(3, 'medias/autruche.jpg', ''),
(20, 'medias/IMG_2608.JPG', 'IMG_2608.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sites`
--

INSERT INTO `sites` (`id`, `name`) VALUES
(1, 'gefz'),
(2, 'Amazon'),
(3, 'https://www.wix.com/'),
(4, 'https://www.cdiscount.com/'),
(5, 'https://www.amazon.fr/'),
(6, 'https://www.zalando.fr/'),
(7, 'https://www.veepee.fr/'),
(8, 'Vesoul');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `test`
--

INSERT INTO `test` (`img_id`, `name`, `file_url`) VALUES
(1, 'zombie_cats-wallpaper-1366x768.jpg', 'medias/zombie_cats-wallpaper-1366x768.jpg'),
(2, 'IMG_2608.JPG', 'medias/IMG_2608.JPG');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_materiel`
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
