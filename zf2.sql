-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 21 Janvier 2016 à 20:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `zf2`
--

-- --------------------------------------------------------

--
-- Structure de la table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(256) NOT NULL,
  `theme` varchar(256) NOT NULL,
  `lien` varchar(256) NOT NULL,
  `journal` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `device`
--

INSERT INTO `device` (`id`, `titre`, `theme`, `lien`, `journal`) VALUES
(1, 'test', 'essaie nucléaire', 'www.google.fr', 'Le monde'),
(2, 'test2', 'économie', 'www.economie.fr', 'Charlies Mensuel');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `is_admin`) VALUES
(5, 'tt@tt.fr', 'e7260ffd15d41204651359cda3e274fce44f88d5', 0),
(6, 't@t.fr', '90c62b7c360038ecf0764fbf2e1035d87f39eeb7', 0),
(7, 'tt@admin.fr', 'cbcb6a5567f37111c9fb280f235d42b3fa832db6', 0),
(8, 'admin@admin.fr', '90c62b7c360038ecf0764fbf2e1035d87f39eeb7', 1),
(9, 'test@test.fr', '90c62b7c360038ecf0764fbf2e1035d87f39eeb7', 0);

-- --------------------------------------------------------

--
-- Structure de la table `wish`
--

CREATE TABLE IF NOT EXISTS `wish` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(245) NOT NULL,
  `lien` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
