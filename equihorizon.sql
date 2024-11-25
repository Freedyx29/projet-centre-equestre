-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 nov. 2024 à 15:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CavaliersALL` ()   SELECT * FROM cavaliers$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `idcoursbase` int(11) NOT NULL,
  `idcoursassocie` int(11) NOT NULL,
  `datecours` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

CREATE TABLE `cavalerie` (
  `numsire` int(11) NOT NULL,
  `nomche` varchar(50) NOT NULL,
  `datenache` date NOT NULL,
  `garrot` varchar(50) NOT NULL,
  `idrace` int(11) NOT NULL,
  `idrobe` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cavalerie`
--

INSERT INTO `cavalerie` (`numsire`, `nomche`, `datenache`, `garrot`, `idrace`, `idrobe`, `supprime`) VALUES
(1, 'Pepito', '2017-03-10', '178', 1, 1, 0),
(2, 'Athena', '2021-11-25', '178', 2, 2, 0),
(3, 'Tornade', '2016-10-10', '156', 1, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cavaliers`
--

CREATE TABLE `cavaliers` (
  `idcava` int(11) NOT NULL,
  `nomcava` varchar(50) NOT NULL,
  `prenomcava` varchar(50) NOT NULL,
  `datenacava` varchar(50) NOT NULL,
  `numlic` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `nomresp` varchar(50) NOT NULL,
  `prenomresp` varchar(50) NOT NULL,
  `rueresp` varchar(50) NOT NULL,
  `vilresp` varchar(50) NOT NULL,
  `cpresp` varchar(50) NOT NULL,
  `telresp` varchar(50) NOT NULL,
  `emailresp` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `assurance` varchar(50) NOT NULL,
  `idgalop` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déclencheurs `cavaliers`
--
DELIMITER $$
CREATE TRIGGER `BU_cavaliers` BEFORE UPDATE ON `cavaliers` FOR EACH ROW UPDATE cours
SET libcours = 'oui'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idcours` int(11) NOT NULL,
  `libcours` varchar(50) NOT NULL,
  `hdebut` time NOT NULL,
  `hfin` time NOT NULL,
  `jour` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ideve` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE `galop` (
  `idgalop` int(11) NOT NULL,
  `libgalop` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idgalop`, `libgalop`, `supprime`) VALUES
(1, 'Galop 1', 0),
(2, 'Galop 2', 0),
(3, 'Galop 3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `refidcours` int(11) NOT NULL,
  `refidcava` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `idcava` int(11) NOT NULL,
  `idcoursbase` int(11) NOT NULL,
  `idcoursassocie` int(11) NOT NULL,
  `participe` tinyint(4) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE `pension` (
  `idpen` int(11) NOT NULL,
  `libpen` varchar(50) NOT NULL,
  `dateD` date NOT NULL,
  `dateF` date NOT NULL,
  `tarif` varchar(50) NOT NULL,
  `numsire` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`idpen`, `libpen`, `dateD`, `dateF`, `tarif`, `numsire`, `supprime`) VALUES
(4, 'Pension 1', '2024-11-01', '2024-11-30', '700', 1, 0),
(5, 'Pension 2', '2024-05-01', '2024-05-30', '670', 2, 0),
(6, 'Pension 3', '2018-01-01', '2018-01-31', '258', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `idphotos` int(11) NOT NULL,
  `lienphoto` varchar(50) NOT NULL,
  `ideve` int(11) NOT NULL,
  `numsire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE `prend` (
  `refidcava` int(11) NOT NULL,
  `redifpen` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idrace` int(11) NOT NULL,
  `librace` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`idrace`, `librace`, `supprime`) VALUES
(1, 'Pur-sang', 0),
(2, 'Haflinger', 0);

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idrobe` int(11) NOT NULL,
  `librobe` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`idrobe`, `librobe`, `supprime`) VALUES
(1, 'Bai', 0),
(2, 'Alezan', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idcoursbase`,`idcoursassocie`),
  ADD KEY `fk_calendrier_coursassocie` (`idcoursassocie`);

--
-- Index pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD PRIMARY KEY (`numsire`),
  ADD KEY `fk_cavalerie_race` (`idrace`),
  ADD KEY `fk_cavalerie_robe` (`idrobe`);

--
-- Index pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  ADD PRIMARY KEY (`idcava`),
  ADD KEY `fk_cavaliers_galop` (`idgalop`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idcours`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`ideve`);

--
-- Index pour la table `galop`
--
ALTER TABLE `galop`
  ADD PRIMARY KEY (`idgalop`);

--
-- Index pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD PRIMARY KEY (`refidcours`,`refidcava`),
  ADD KEY `fk_inscrit_cava` (`refidcava`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`idcava`,`idcoursbase`,`idcoursassocie`),
  ADD KEY `fk_participe_coursbase` (`idcoursbase`),
  ADD KEY `fk_participe_coursassocie` (`idcoursassocie`);

--
-- Index pour la table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`idpen`),
  ADD KEY `fk_pension_cavalerie` (`numsire`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`idphotos`);

--
-- Index pour la table `prend`
--
ALTER TABLE `prend`
  ADD PRIMARY KEY (`refidcava`,`redifpen`),
  ADD KEY `fk_prend_pension` (`redifpen`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`idrace`);

--
-- Index pour la table `robe`
--
ALTER TABLE `robe`
  ADD PRIMARY KEY (`idrobe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `numsire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  MODIFY `idcava` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idcours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ideve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idgalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idphotos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idrace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idrobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `fk_calendrier_coursassocie` FOREIGN KEY (`idcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_calendrier_coursbase` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD CONSTRAINT `fk_cavalerie_race` FOREIGN KEY (`idrace`) REFERENCES `race` (`idrace`),
  ADD CONSTRAINT `fk_cavalerie_robe` FOREIGN KEY (`idrobe`) REFERENCES `robe` (`idrobe`);

--
-- Contraintes pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  ADD CONSTRAINT `fk_cavaliers_galop` FOREIGN KEY (`idgalop`) REFERENCES `galop` (`idgalop`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `fk_inscrit_cava` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_inscrit_cours` FOREIGN KEY (`refidcours`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_participe_cavaliers` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_participe_coursassocie` FOREIGN KEY (`idcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_participe_coursbase` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_pension_cavalerie` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `prend`
--
ALTER TABLE `prend`
  ADD CONSTRAINT `fk_prend_cavaliers` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_prend_pension` FOREIGN KEY (`redifpen`) REFERENCES `pension` (`idpen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
