-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 23 fév. 2020 à 11:15
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camping`
--
CREATE DATABASE IF NOT EXISTS `camping` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `camping`;

-- --------------------------------------------------------

--
-- Structure de la table `reservationplace`
--

DROP TABLE IF EXISTS `reservationplace`;
CREATE TABLE IF NOT EXISTS `reservationplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `emplacement` varchar(25) NOT NULL,
  `habitat` varchar(25) NOT NULL,
  `dureesejour` int(11) NOT NULL,
  `borne` varchar(25) NOT NULL,
  `disco` varchar(25) NOT NULL,
  `yfs` varchar(25) NOT NULL,
  `prixtotal` int(25) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reservationplace`
--

INSERT INTO `reservationplace` (`id`, `date`, `emplacement`, `habitat`, `dureesejour`, `borne`, `disco`, `yfs`, `prixtotal`, `id_utilisateur`) VALUES
(167, '2020-02-20', 'maquis', 'cpgcar', 2, 'non', 'non', 'non', 20, 9),
(172, '2020-02-14', 'maquis', 'tente', 2, 'non', 'non', 'non', 20, 9),
(173, '2020-02-15', 'pins', 'tente', 2, 'non', 'non', 'non', 20, 9),
(174, '2020-02-15', 'pins', 'tente', 2, 'non', 'non', 'non', 20, 9),
(175, '2020-02-13', 'plage', 'tente', 3, 'oui', 'non', 'non', 36, 9);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id`, `login`, `password`) VALUES
(9, 'amine', '$2y$10$/cHRVqXMO9AoIW/nTtJYQ.I7CRa7MuqRhRPGCo03HNGOSe.e1TPVC'),
(8, 'rrr', '$2y$10$yXg8dDRZylJT9IRqmirYgeDFLlKKgfzswAJ71PiTk7/yNc3Uat17S');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
