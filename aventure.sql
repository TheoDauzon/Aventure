-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 29 avr. 2021 à 20:34
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `aventure`
--
CREATE DATABASE IF NOT EXISTS `aventure` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aventure`;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `genreId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `genreNom` varchar(20) NOT NULL,
  PRIMARY KEY (`genreId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`genreId`, `genreNom`) VALUES
(1, 'Masculin'),
(2, 'Féminin');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `joueurId` int(11) NOT NULL AUTO_INCREMENT,
  `joueurLogin` varchar(255) NOT NULL,
  `joueurMdp` varchar(255) NOT NULL,
  PRIMARY KEY (`joueurId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`joueurId`, `joueurLogin`, `joueurMdp`) VALUES
(2, 'tartar@gmail.com', '$2y$10$jwfpwAqfi2LCjozOvP.1CeyWcQYPXJjeQMFi7S5AkJrjlxiIG15Uu'),
(3, 'tortor@gmail.com', '$2y$10$zTwk1PnznGj.81xJa6Zmv.Gn6k4JKp9HlTq0h7UNH3Jz65rPpWG4a'),
(4, 'tirtir@gmail.com', '$2y$10$GjRcXetOWucU1aQdPtwhTe9sGaxmkPCwz5KyOlZjXzOlYkUxbvuC2'),
(5, 'turtur@gmail.com', '$2y$10$gvuaNaL.GuuoxB7i0/7A1.zFehE63HGf.KTfqXHHkuFpqTjcSrFwy');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `persoId` int(11) NOT NULL AUTO_INCREMENT,
  `persoNom` varchar(50) NOT NULL,
  `persoFor` tinyint(4) NOT NULL,
  `persoDex` tinyint(4) NOT NULL,
  `persoCon` tinyint(4) NOT NULL,
  `persoAgi` tinyint(4) NOT NULL,
  `persoMag` tinyint(4) NOT NULL,
  `genreIdfk` tinyint(4) NOT NULL,
  `joueurIdfk` int(11) NOT NULL,
  PRIMARY KEY (`persoId`),
  KEY `Fk_joueurId` (`joueurIdfk`),
  KEY `FK_genreId` (`genreIdfk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`persoId`, `persoNom`, `persoFor`, `persoDex`, `persoCon`, `persoAgi`, `persoMag`, `genreIdfk`, `joueurIdfk`) VALUES
(4, 'Tartar', 10, 10, 10, 10, 10, 1, 2),
(5, 'tortor', 10, 10, 15, 10, 5, 1, 3),
(6, 'Tirtir', 15, 5, 12, 10, 8, 2, 4),
(7, 'tutur', 10, 10, 10, 10, 10, 1, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `FK_genreId` FOREIGN KEY (`genreIdfk`) REFERENCES `genre` (`genreId`),
  ADD CONSTRAINT `Fk_joueurId` FOREIGN KEY (`joueurIdfk`) REFERENCES `joueur` (`joueurId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
