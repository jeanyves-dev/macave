-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 30 Janvier 2017 à 14:29
-- Version du serveur :  5.5.53-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `macave`
--
CREATE DATABASE IF NOT EXISTS `macave` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `macave`;

-- --------------------------------------------------------

--
-- Structure de la table `util`
--

CREATE TABLE `util` (
  `inutil` varchar(5) NOT NULL,
  `mputil` varchar(8) NOT NULL,
  `noutil` varchar(50) NOT NULL,
  `prutil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `util`
--
ALTER TABLE `util`
  ADD PRIMARY KEY (`inutil`);


INSERT INTO `mens` (`demens`, `remenu`, `limenu`, `norang`) VALUES
('Utilisateurs', 8, '../liste/util.liste.php', 15);
