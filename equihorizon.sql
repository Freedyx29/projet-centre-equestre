-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 oct. 2024 à 11:09
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

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `idcoursbase` int(11) NOT NULL,
  `idcoursassocie` int(11) NOT NULL,
  `datecours` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

CREATE TABLE `cavalerie` (
  `numsire` int(11) NOT NULL,
  `nomche` varchar(50) NOT NULL,
  `datenache` varchar(50) NOT NULL,
  `garrot` varchar(50) NOT NULL,
  `idrace` int(11) NOT NULL,
  `idrobe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `idgalop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idcours` int(11) NOT NULL,
  `libcours` varchar(50) NOT NULL,
  `hdebut` time NOT NULL,
  `hfin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ideve` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `commentaire` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE `galop` (
  `idgalop` int(11) NOT NULL,
  `libgalop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `idcours` int(11) NOT NULL,
  `idcava` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `idcava` int(11) NOT NULL,
  `idcoursbase` int(11) NOT NULL,
  `idcoursassocie` int(11) NOT NULL,
  `participation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE `pension` (
  `idpen` int(11) NOT NULL,
  `libpen` varchar(50) NOT NULL,
  `numsire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `idphoto` int(11) NOT NULL,
  `lienphoto` varchar(50) NOT NULL,
  `ideve` int(11) NOT NULL,
  `numsire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE `prend` (
  `idcava` int(11) NOT NULL,
  `idpen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idrace` int(11) NOT NULL,
  `librace` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idrobe` int(11) NOT NULL,
  `librobe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `iduti` int(11) NOT NULL,
  `mailuti` varchar(50) NOT NULL,
  `nomuti` varchar(50) NOT NULL,
  `prenomuti` varchar(50) NOT NULL,
  `mdputi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idcoursbase`,`idcoursassocie`),
  ADD KEY `fk_cal_idcoursassocie` (`idcoursassocie`);

--
-- Index pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD PRIMARY KEY (`numsire`),
  ADD KEY `fk_cavalerie_idrace` (`idrace`),
  ADD KEY `fk_cavalerie_idrobe` (`idrobe`);

--
-- Index pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  ADD PRIMARY KEY (`idcava`),
  ADD KEY `fk_cavaliers_idgalop` (`idgalop`);

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
  ADD PRIMARY KEY (`idcours`,`idcava`),
  ADD KEY `fk_inscrit_idcava` (`idcava`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`idcava`,`idcoursbase`,`idcoursassocie`),
  ADD KEY `fk_parti_idcoursbase` (`idcoursbase`),
  ADD KEY `fk_parti_idcoursassocie` (`idcoursassocie`);

--
-- Index pour la table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`idpen`),
  ADD KEY `fk_pen_numsire` (`numsire`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`idphoto`);

--
-- Index pour la table `prend`
--
ALTER TABLE `prend`
  ADD PRIMARY KEY (`idcava`,`idpen`),
  ADD KEY `fk_idpen` (`idpen`);

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
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`iduti`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `numsire` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idgalop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idrace` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idrobe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `iduti` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `fk_cal_idcoursassocie` FOREIGN KEY (`idcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_cal_idcoursbase` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD CONSTRAINT `fk_cavalerie_idrace` FOREIGN KEY (`idrace`) REFERENCES `race` (`idrace`),
  ADD CONSTRAINT `fk_cavalerie_idrobe` FOREIGN KEY (`idrobe`) REFERENCES `robe` (`idrobe`);

--
-- Contraintes pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  ADD CONSTRAINT `fk_cavaliers_idgalop` FOREIGN KEY (`idgalop`) REFERENCES `galop` (`idgalop`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `fk_inscrit_idcava` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_inscrit_idcours` FOREIGN KEY (`idcours`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_parti_idcava` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_parti_idcoursassocie` FOREIGN KEY (`idcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_parti_idcoursbase` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_pen_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photo_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `prend`
--
ALTER TABLE `prend`
  ADD CONSTRAINT `fk_idpen` FOREIGN KEY (`idpen`) REFERENCES `pension` (`idpen`),
  ADD CONSTRAINT `fk_pen_idcava` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
