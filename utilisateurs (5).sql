-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 déc. 2024 à 14:40
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `equihorizon`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `iduti` int(11) NOT NULL,
  `mailuti` varchar(100) NOT NULL,
  `nomuti` varchar(50) NOT NULL,
  `prenomuti` varchar(50) NOT NULL,
  `mdputi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`iduti`, `mailuti`, `nomuti`, `prenomuti`, `mdputi`) VALUES
(1, 'admin1@gmail.com', 'Admin1', 'User1', '$2y$10$IYyCGH9L0wIG9pM5DDM4WuKHLBRR5O6Jrx/xaeWvZhNxlnQVFcxk6'),
(2, 'admin2@gmail.com', 'Admin2', 'User2', '$2y$10$0T47Ou5Wxxd1T3xpA3j.auTjakNPXLgqmb94TTDw3IBpEDgPtyiVe'),
(3, 'admin3@gmail.com', 'Admin3', 'User3', '$2y$10$r5cZZJAo528nLjPWfAiLW.m7O6ahUQYlTpbQ0gTRnvhSojbYWhEli');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`iduti`),
  ADD UNIQUE KEY `mailuti` (`mailuti`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `iduti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
