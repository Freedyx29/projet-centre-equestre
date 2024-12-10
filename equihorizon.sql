-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 10 déc. 2024 à 08:31
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
  `idcoursseance` int(11) NOT NULL,
  `idcoursbase` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `cavaliers`
--

CREATE TABLE `cavaliers` (
  `idcava` int(11) NOT NULL,
  `nomcava` varchar(50) NOT NULL,
  `prenomcava` varchar(50) NOT NULL,
  `datenacava` date NOT NULL,
  `numlic` varchar(50) NOT NULL,
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
DELIMITER $$
CREATE TRIGGER `log_cavaliers_update` BEFORE UPDATE ON `cavaliers` FOR EACH ROW BEGIN
    INSERT INTO logs_cavaliers (
        idcava,
        nomcava_old, nomcava_new,
        prenomcava_old, prenomcava_new,
        datenacava_old, datenacava_new,
        numlic_old, numlic_new,
        nomresp_old, nomresp_new,
        prenomresp_old, prenomresp_new,
        rueresp_old, rueresp_new,
        vilresp_old, vilresp_new,
        cpresp_old, cpresp_new,
        telresp_old, telresp_new,
        emailresp_old, emailresp_new,
        password_old, password_new,
        assurance_old, assurance_new,
        idgalop_old, idgalop_new
    ) VALUES (
        NEW.idcava,
        OLD.nomcava, NEW.nomcava,
        OLD.prenomcava, NEW.prenomcava,
        OLD.datenacava, NEW.datenacava,
        OLD.numlic, NEW.numlic,
        OLD.nomresp, NEW.nomresp,
        OLD.prenomresp, NEW.prenomresp,
        OLD.rueresp, NEW.rueresp,
        OLD.vilresp, NEW.vilresp,
        OLD.cpresp, NEW.cpresp,
        OLD.telresp, NEW.telresp,
        OLD.emailresp, NEW.emailresp,
        OLD.password, NEW.password,
        OLD.assurance, NEW.assurance,
        OLD.idgalop, NEW.idgalop
    );
END
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

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `refidcava` int(11) NOT NULL,
  `refidcoursbase` int(11) NOT NULL,
  `refidcoursseance` int(11) NOT NULL,
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
  `idcava` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `idphotos` int(11) NOT NULL,
  `lienphoto` varchar(50) NOT NULL,
  `ideve` int(11) NOT NULL,
  `numsire` int(11) DEFAULT NULL,
  `supprime` tinyint(1) DEFAULT 0
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

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idrace` int(11) NOT NULL,
  `librace` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idrobe` int(11) NOT NULL,
  `librobe` varchar(50) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idcoursseance`,`idcoursbase`),
  ADD KEY `fk_cours_basse` (`idcoursbase`);

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
-- Index pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_logs_cavaliers_cavaliers` (`idcava`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`refidcava`,`refidcoursbase`,`refidcoursseance`),
  ADD KEY `fk_participe_coursbase` (`refidcoursbase`),
  ADD KEY `fk_participe_coursseance` (`refidcoursseance`);

--
-- Index pour la table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`idpen`),
  ADD KEY `fk_pension_numsire` (`numsire`),
  ADD KEY `fk_pension_cava` (`idcava`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`idphotos`),
  ADD KEY `fk_photos_numsire` (`numsire`);

--
-- Index pour la table `prend`
--
ALTER TABLE `prend`
  ADD PRIMARY KEY (`refidcava`,`refidpen`),
  ADD KEY `fk_prend_pension` (`refidpen`);

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
  ADD PRIMARY KEY (`iduti`),
  ADD UNIQUE KEY `mailuti` (`mailuti`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `idcoursseance` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idphotos` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `iduti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `fk_cours_basse` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

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
-- Contraintes pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  ADD CONSTRAINT `fk_logs_cavaliers_cavaliers` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `fk_participe_cavaliers` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_participe_coursbase` FOREIGN KEY (`refidcoursbase`) REFERENCES `cours` (`idcours`),
  ADD CONSTRAINT `fk_participe_coursseance` FOREIGN KEY (`refidcoursseance`) REFERENCES `calendrier` (`idcoursseance`);

--
-- Contraintes pour la table `pension`
--
ALTER TABLE `pension`
  ADD CONSTRAINT `fk_pension_cava` FOREIGN KEY (`idcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_pension_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photos_numsire` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `prend`
--
ALTER TABLE `prend`
  ADD CONSTRAINT `fk_prend_cavaliers` FOREIGN KEY (`refidcava`) REFERENCES `cavaliers` (`idcava`),
  ADD CONSTRAINT `fk_prend_pension` FOREIGN KEY (`refidpen`) REFERENCES `pension` (`idpen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
