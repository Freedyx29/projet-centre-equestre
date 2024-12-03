-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 03 déc. 2024 à 08:25
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
-- Structure de la table `logs_cavaliers`
--

CREATE TABLE `logs_cavaliers` (
  `idlog` int(11) NOT NULL,
  `datelog` datetime DEFAULT current_timestamp(),
  `nomcava_old` varchar(50) DEFAULT NULL,
  `nomcava_new` varchar(50) DEFAULT NULL,
  `prenomcava_old` varchar(50) DEFAULT NULL,
  `prenomcava_new` varchar(50) DEFAULT NULL,
  `datenacava_old` varchar(50) DEFAULT NULL,
  `datenacava_new` varchar(50) DEFAULT NULL,
  `numlic_old` varchar(50) DEFAULT NULL,
  `numlic_new` varchar(50) DEFAULT NULL,
  `nomresp_old` varchar(50) DEFAULT NULL,
  `nomresp_new` varchar(50) DEFAULT NULL,
  `prenomresp_old` varchar(50) DEFAULT NULL,
  `prenomresp_new` varchar(50) DEFAULT NULL,
  `rueresp_old` varchar(50) DEFAULT NULL,
  `rueresp_new` varchar(50) DEFAULT NULL,
  `vilresp_old` varchar(50) DEFAULT NULL,
  `vilresp_new` varchar(50) DEFAULT NULL,
  `cpresp_old` varchar(50) DEFAULT NULL,
  `cpresp_new` varchar(50) DEFAULT NULL,
  `telresp_old` varchar(50) DEFAULT NULL,
  `telresp_new` varchar(50) DEFAULT NULL,
  `emailresp_old` varchar(50) DEFAULT NULL,
  `emailresp_new` varchar(50) DEFAULT NULL,
  `password_old` varchar(50) DEFAULT NULL,
  `password_new` varchar(50) DEFAULT NULL,
  `assurance_old` varchar(50) DEFAULT NULL,
  `assurance_new` varchar(50) DEFAULT NULL,
  `idgalop_old` int(11) DEFAULT NULL,
  `idgalop_new` int(11) DEFAULT NULL,
  `idcava` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `logs_cavaliers`
--

INSERT INTO `logs_cavaliers` (`idlog`, `datelog`, `nomcava_old`, `nomcava_new`, `prenomcava_old`, `prenomcava_new`, `datenacava_old`, `datenacava_new`, `numlic_old`, `numlic_new`, `nomresp_old`, `nomresp_new`, `prenomresp_old`, `prenomresp_new`, `rueresp_old`, `rueresp_new`, `vilresp_old`, `vilresp_new`, `cpresp_old`, `cpresp_new`, `telresp_old`, `telresp_new`, `emailresp_old`, `emailresp_new`, `password_old`, `password_new`, `assurance_old`, `assurance_new`, `idgalop_old`, `idgalop_new`, `idcava`) VALUES
(5, '2024-11-28 16:41:03', 'DDDD', 'DDDD', 'mel', 'mel', '2024-11-27', '2024-11-27', '1', '1', 'Kiris', 'Kiris', 'melike', 'melike', '49', '49', 'Brive la Gaillarde', 'Brive la Gaillarde', '19100', '19100', '0666283132', '0666283132', 'melike@gmail.com', 'melike@gmail.com', 'dfsfdf', 'dfsfdf', 'AYTA', 'ati', 1, 1, 6),
(6, '2024-11-28 16:48:17', 'sqqsd', 'luna', 'qsdqsd', 'arim', '2024-11-15', '2024-11-15', 'sqsd', '23', 'qsdqs', 'Grimaud', 'sqdqs', 'Lukas', 'sqdqs', '28', 'qsdqd', 'Brive la Gaillarde', 'qsdds', '19100', 'qdqds', '0777898098', 'sqsq@gmail.com', 'sqsq@gmail.com', 'sdqs', 'sdqs', 'dsqsd', 'poi', 2, 2, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_logs_cavaliers_cavaliers` (`idcava`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  ADD CONSTRAINT `fk_logs_cavaliers_cavaliers` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
