-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 14 nov. 2024 à 16:51
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
  `refidcoursbase` int(11) NOT NULL,
  `refidcoursassocie` int(11) NOT NULL,
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
(1, 'Tornade', '2014-08-05', '90 cm', 12, 2, 0),
(2, 'Fantôme', '2018-05-29', '155 cm', 19, 1, 0);

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
-- Déchargement des données de la table `cavaliers`
--

INSERT INTO `cavaliers` (`idcava`, `nomcava`, `prenomcava`, `datenacava`, `numlic`, `photo`, `nomresp`, `prenomresp`, `rueresp`, `vilresp`, `cpresp`, `telresp`, `emailresp`, `password`, `assurance`, `idgalop`, `supprime`) VALUES
(4, 'Grimaud', 'Lukas', '29/05/2004', '0001', 'photo.png', 'Mitou', 'Quentin', '41bis avenue Edmend Michelet', 'Brive', '19100', '06 56 34 17 78', 'quentinmitou@gmail.com', '1234', 'credit', 1, 0),
(5, 'Mitou', 'z', 'e', 'r', 't', 'y', 'u', 'o', 'p', 'k', 'b', 'df', 'qsd', 'aze', 3, 0),
(6, 'Rouan', 'Aya', '10/10/2005', '0003', 'photo2.png', 'Kiris', 'Melike', '56 rue brive', 'Brive', '19101', '06 67 83 07 45', 'melikekiris@gmail.com', '134656', 'frfr', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idcours` int(11) NOT NULL,
  `libcours` varchar(50) NOT NULL,
  `hdebut` time NOT NULL,
  `hfin` time NOT NULL,
  `jour` varchar(30) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idcours`, `libcours`, `hdebut`, `hfin`, `jour`, `supprime`) VALUES
(1, 'SLAM', '13:03:00', '17:53:00', '', 0),
(2, 'SISR', '13:00:00', '18:00:00', '', 0);

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
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `backgroundColor` varchar(7) DEFAULT '#ffffff',
  `textColor` varchar(7) DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `backgroundColor`, `textColor`) VALUES
(1, 'Galop 1', '2023-01-08 00:00:00', '2023-01-09 00:00:00', '#ff0000', '#ffffff'),
(2, 'Galop 2', '2023-01-07 00:00:00', '2023-01-10 00:00:00', '#00ff00', '#000000'),
(3, 'Galop 3', '2023-01-11 00:00:00', '2023-01-13 00:00:00', '#0000ff', '#ffffff');

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
(3, 'Galop 3', 0),
(4, 'Galop 4', 0),
(5, 'Galop 5', 0),
(6, 'Galop 6', 0),
(7, 'Galop 7', 0);

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
  `refidcava` int(11) NOT NULL,
  `refidcoursbase` int(11) NOT NULL,
  `refidcoursassocie` int(11) NOT NULL,
  `participation` tinyint(1) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE `pension` (
  `idpen` int(11) NOT NULL,
  `libpen` varchar(50) NOT NULL,
  `numsire` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`idpen`, `libpen`, `numsire`, `supprime`) VALUES
(1, 'Pension equihorizon', 2, 0);

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
  `refidcava` int(11) NOT NULL,
  `refidpen` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prend`
--

INSERT INTO `prend` (`refidcava`, `refidpen`, `supprime`) VALUES
(6, 1, 0);

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
(2, 'Arabe', 0),
(3, 'Frison', 0),
(4, 'Percheron', 0),
(5, 'Selle Français', 0),
(6, 'Quarter Horse', 0),
(7, 'Appaloosa', 0),
(8, 'Andalou', 0),
(9, 'Lusitanien', 0),
(10, 'Akhal-Teke', 0),
(11, 'Haflinger', 0),
(12, 'Shire', 0),
(13, 'Clydesdale', 0),
(14, 'Paint Horse', 0),
(15, 'Connemara', 0),
(16, 'Trakehner', 0),
(17, 'Lipizzan', 0),
(18, 'Criollo', 0),
(19, 'Mustang', 0),
(20, 'Poney Shetland', 0);

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
(1, 'Alezan', 0),
(2, 'Bai', 0),
(3, 'Gris', 0),
(4, 'Isabelle', 0),
(5, 'Noir', 0),
(6, 'Rouan', 0),
(7, 'Pie', 0),
(8, 'Palomino', 0),
(9, 'Aubère', 0),
(10, 'Dun', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `iduti` int(11) NOT NULL,
  `mailuti` varchar(50) NOT NULL,
  `nomuti` varchar(50) NOT NULL,
  `prenomuti` varchar(50) NOT NULL,
  `mdputi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`refidcoursbase`,`refidcoursassocie`),
  ADD KEY `fk_cal_idcoursassocie` (`refidcoursassocie`);

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
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `fk_inscrit_idcava` (`refidcava`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`refidcava`,`refidcoursbase`,`refidcoursassocie`),
  ADD KEY `fk_parti_idcoursbase` (`refidcoursbase`),
  ADD KEY `fk_parti_idcoursassocie` (`refidcoursassocie`);

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
  ADD PRIMARY KEY (`refidcava`,`refidpen`),
  ADD KEY `fk_idpen` (`refidpen`);

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
  MODIFY `numsire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  MODIFY `idcava` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idcours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ideve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idgalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idrace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idrobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `fk_cal_idcoursassocie` FOREIGN KEY (`refidcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_cal_idcoursbase` FOREIGN KEY (`refidcoursbase`) REFERENCES `cours` (`idcours`);

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
  ADD CONSTRAINT `fk_inscrit_idcava` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_inscrit_idcours` FOREIGN KEY (`refidcours`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_parti_idcava` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_parti_idcoursassocie` FOREIGN KEY (`refidcoursassocie`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_parti_idcoursbase` FOREIGN KEY (`refidcoursbase`) REFERENCES `cours` (`idcours`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_pen_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `prend`
--
ALTER TABLE `prend`
  ADD CONSTRAINT `fk_idpen` FOREIGN KEY (`refidpen`) REFERENCES `pension` (`idpen`),
  ADD CONSTRAINT `fk_pen_idcava` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
