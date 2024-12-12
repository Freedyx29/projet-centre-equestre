-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 déc. 2024 à 14:04
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

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`idcoursseance`, `idcoursbase`, `datecours`, `supprime`) VALUES
(4028, 79, '2024-01-01', 0),
(4029, 79, '2024-01-08', 0),
(4030, 79, '2024-01-15', 0),
(4031, 79, '2024-01-22', 0),
(4032, 79, '2024-01-29', 0),
(4033, 79, '2024-02-05', 0),
(4034, 79, '2024-02-12', 0),
(4035, 79, '2024-02-19', 0),
(4036, 79, '2024-02-26', 0),
(4037, 79, '2024-03-04', 0),
(4038, 79, '2024-03-11', 0),
(4039, 79, '2024-03-18', 0),
(4040, 79, '2024-03-25', 0),
(4041, 79, '2024-04-01', 0),
(4042, 79, '2024-04-08', 0),
(4043, 79, '2024-04-15', 0),
(4044, 79, '2024-04-22', 0),
(4045, 79, '2024-04-29', 0),
(4046, 79, '2024-05-06', 0),
(4047, 79, '2024-05-13', 0),
(4048, 79, '2024-05-20', 0),
(4049, 79, '2024-05-27', 0),
(4050, 79, '2024-06-03', 0),
(4051, 79, '2024-06-10', 0),
(4052, 79, '2024-06-17', 0),
(4053, 79, '2024-06-24', 0),
(4054, 79, '2024-07-01', 0),
(4055, 79, '2024-07-08', 0),
(4056, 79, '2024-07-15', 0),
(4057, 79, '2024-07-22', 0),
(4058, 79, '2024-07-29', 0),
(4059, 79, '2024-08-05', 0),
(4060, 79, '2024-08-12', 0),
(4061, 79, '2024-08-19', 0),
(4062, 79, '2024-08-26', 0),
(4063, 79, '2024-09-02', 0),
(4064, 79, '2024-09-09', 0),
(4065, 79, '2024-09-16', 0),
(4066, 79, '2024-09-23', 0),
(4067, 79, '2024-09-30', 0),
(4068, 79, '2024-10-07', 0),
(4069, 79, '2024-10-14', 0),
(4070, 79, '2024-10-21', 0),
(4071, 79, '2024-10-28', 0),
(4072, 79, '2024-11-04', 0),
(4073, 79, '2024-11-11', 0),
(4074, 79, '2024-11-18', 0),
(4075, 79, '2024-11-25', 0),
(4076, 79, '2024-12-02', 0),
(4077, 79, '2024-12-09', 0),
(4078, 79, '2024-12-16', 0),
(4079, 79, '2024-12-23', 0),
(4080, 79, '2024-12-30', 0);

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
(3, 'Tornade', '2016-10-10', '156', 1, 2, 0),
(4, 'Cookie', '2014-06-15', '187', 4, 9, 0),
(5, 'Mustang', '2014-10-24', '187', 1, 12, 0),
(6, 'Melike', '2009-07-18', '155', 15, 5, 0),
(7, 'Aya', '2006-10-10', '145', 2, 2, 0),
(8, 'rtze', '2024-12-13', '145', 6, 10, 0);

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

INSERT INTO `cavaliers` (`idcava`, `nomcava`, `prenomcava`, `datenacava`, `numlic`, `nomresp`, `prenomresp`, `rueresp`, `vilresp`, `cpresp`, `telresp`, `emailresp`, `password`, `assurance`, `idgalop`, `supprime`) VALUES
(1, 'Dupont', 'Lola', '2005-12-16', '0001', 'Dupont', 'Clara', '12 Rue de la paix', 'Paris', '75001', '06 41 64 89 61', 'clara.dupont@gmail.com', 'azerty', 'AXA', 5, 0),
(2, 'Martin', 'Lukas', '2004-05-29', '0002', 'Martin', 'Emma', '45 Avenue des Champs', 'Lyon', '69003', '06 27 91 74 09', 'emma.martin@gmail.com', 'azerty', 'Allianz', 4, 0),
(3, 'Lefevre', 'Léa', '2002-05-03', '0003', 'Lefevre', 'Nicolas', '78 Rue des Fleurs', 'Marseille', '13005', '06 12 34 56 78', 'nicolas.lefevre@gmail.com', 'azerty', 'MAAF', 3, 0),
(4, 'Bernard', 'Hugo', '2004-06-22', '0004', 'Bernard', 'Charlotte', '33 Rue de la Mer', 'Nantes', '44000', '06 21 76 93 52', 'charlotte.bernard@gmail.com', 'azerty', 'MACIF', 6, 0),
(5, 'Dubois', 'Chloé', '2006-06-22', '0005', 'Dubois', 'Damien', '58 Boulevard', 'Toulouse', '31000', '06 23 45 67 90', 'damien.dubois@gmail.com', 'azerty', 'Generali', 2, 0),
(6, 'Faure', 'Mila', '2003-07-14', '0006', 'Faure', 'Isabelle', '91 Rue de l\'Eglise', 'Bordeaux', '33000', '06 12 34 56 78', 'isabelle.faure@gmail.com', 'azerty', 'Groupama', 7, 0),
(7, 'Moreau', 'Tom', '2006-09-27', '0007', 'Moreau', 'Laurent', '24 Rue de l\'Arcade', 'Lille', '59000', '06 21 43 65 87', 'laurent.moreau@gmail.com', 'azerty', 'AXA', 5, 0),
(8, 'Boucher', 'Maxime', '2007-01-30', '0008', 'Boucher', 'Thierry', '13 Rue de l\'Océan', 'Brest', '44000', '06 99 88 77 66', 'thierry.boucher@gmail.com', 'azerty', 'MAAF', 1, 0),
(9, 'Lemon', 'Arthur', '2004-06-12', '0009', 'Lemon', 'Laure', '80 Avenue Victor', 'Toulouse', '31000', '06 67 89 01 23', 'laure.lemon@gmail.com', 'azerty', 'Generali', 2, 0),
(10, 'Charpentier', 'Eva', '2005-01-21', '0010', 'Charpentier', 'Marc', '51 Rue de la Gare', 'Toulouse', '31000', '06 67 89 01 23', 'marc.charpentier@gmail.com', 'azerty', 'MACIF', 6, 0),
(11, 'Rousseau', 'Zoé', '2008-10-02', '0011', 'Rousseau', 'Stéphanie', '16 Avenue de la Mer', 'Nantes', '44000', '07 54 21 33 77', 'steaphanie.rousseau@gmai.com', 'azerty', 'Allianz', 1, 0),
(12, 'Lemoine', 'Léonard', '2006-10-17', '0012', 'Lemoine', 'Sophie', '25 Boulevard de la Liberté', 'Lyon', '69007', '07 72 89 01 23', 'sophie.lemoine@gmail.com', 'azerty', 'Groupama', 7, 0),
(13, 'Chevalier', 'Jade', '2007-05-09', '0013', 'Chevalier', 'Patrick', '21 Rue de la Rue', 'Paris', '75002', '07 23 45 78 90', 'patrick.chevalier@gmail.com', 'azerty', 'AXA', 5, 0),
(14, 'Bessaguet', 'Camille', '2003-08-20', '0014', 'Bessaguet', 'Pierre', '19 Rue de l\'Avenir', 'Paris', '75015', '06 80 89 99 76', 'pierre.bessaguet@gmail.com', 'azerty', 'Allianz', 4, 0),
(15, 'Vincent', 'Inès', '2002-11-28', '0015', 'Vincent', 'Olivier', '17 Rue de la Libération', 'Nantes', '44010', '07 99 88 67 45', 'olivier.vincent@gmail.com', 'azerty', 'MAAF', 3, 0),
(16, 'azr', 'zara', '2024-12-11', 'eza', 'azr', 'rza', 'zer', 'arz', 'zae', 'azr', 'azr@email.com', 'azr', 'aze', 4, 0);

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

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idcours`, `libcours`, `hdebut`, `hfin`, `jour`, `supprime`) VALUES
(79, 'Galop 1', '10:00:00', '11:00:00', 'Lundi', 0);

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

--
-- Déchargement des données de la table `inscrit`
--

INSERT INTO `inscrit` (`refidcours`, `refidcava`, `supprime`) VALUES
(79, 2, 1),
(79, 6, 0);

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
  `participe` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`refidcava`, `refidcoursbase`, `refidcoursseance`, `participe`) VALUES
(2, 79, 4028, 1),
(2, 79, 4029, 1),
(2, 79, 4030, 1),
(2, 79, 4031, 1),
(2, 79, 4032, 1),
(2, 79, 4033, 1),
(2, 79, 4034, 1),
(2, 79, 4035, 1),
(2, 79, 4036, 1),
(2, 79, 4037, 1),
(2, 79, 4038, 1),
(2, 79, 4039, 1),
(2, 79, 4040, 1),
(2, 79, 4041, 1),
(2, 79, 4042, 1),
(2, 79, 4043, 1),
(2, 79, 4044, 1),
(2, 79, 4045, 1),
(2, 79, 4046, 1),
(2, 79, 4047, 1),
(2, 79, 4048, 1),
(2, 79, 4049, 1),
(2, 79, 4050, 1),
(2, 79, 4051, 1),
(2, 79, 4052, 1),
(2, 79, 4053, 1),
(2, 79, 4054, 1),
(2, 79, 4055, 1),
(2, 79, 4056, 1),
(2, 79, 4057, 1),
(2, 79, 4058, 1),
(2, 79, 4059, 1),
(2, 79, 4060, 1),
(2, 79, 4061, 1),
(2, 79, 4062, 1),
(2, 79, 4063, 1),
(2, 79, 4064, 1),
(2, 79, 4065, 1),
(2, 79, 4066, 1),
(2, 79, 4067, 1),
(2, 79, 4068, 1),
(2, 79, 4069, 1),
(2, 79, 4070, 1),
(2, 79, 4071, 1),
(2, 79, 4072, 1),
(2, 79, 4073, 1),
(2, 79, 4074, 1),
(2, 79, 4075, 1),
(2, 79, 4076, 1),
(2, 79, 4077, 1),
(2, 79, 4078, 1),
(2, 79, 4079, 1),
(2, 79, 4080, 1),
(6, 79, 4028, 1),
(6, 79, 4029, 1),
(6, 79, 4030, 1),
(6, 79, 4031, 1),
(6, 79, 4032, 1),
(6, 79, 4033, 1),
(6, 79, 4034, 1),
(6, 79, 4035, 1),
(6, 79, 4036, 1),
(6, 79, 4037, 1),
(6, 79, 4038, 1),
(6, 79, 4039, 1),
(6, 79, 4040, 1),
(6, 79, 4041, 1),
(6, 79, 4042, 1),
(6, 79, 4043, 1),
(6, 79, 4044, 1),
(6, 79, 4045, 1),
(6, 79, 4046, 1),
(6, 79, 4047, 1),
(6, 79, 4048, 1),
(6, 79, 4049, 1),
(6, 79, 4050, 1),
(6, 79, 4051, 1),
(6, 79, 4052, 1),
(6, 79, 4053, 1),
(6, 79, 4054, 1),
(6, 79, 4055, 1),
(6, 79, 4056, 1),
(6, 79, 4057, 1),
(6, 79, 4058, 1),
(6, 79, 4059, 1),
(6, 79, 4060, 1),
(6, 79, 4061, 1),
(6, 79, 4062, 1),
(6, 79, 4063, 1),
(6, 79, 4064, 1),
(6, 79, 4065, 1),
(6, 79, 4066, 1),
(6, 79, 4067, 1),
(6, 79, 4068, 1),
(6, 79, 4069, 1),
(6, 79, 4070, 1),
(6, 79, 4071, 1),
(6, 79, 4072, 1),
(6, 79, 4073, 1),
(6, 79, 4074, 1),
(6, 79, 4075, 1),
(6, 79, 4076, 1),
(6, 79, 4077, 1),
(6, 79, 4078, 1),
(6, 79, 4079, 1),
(6, 79, 4080, 1);

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

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `idphotos` int(11) NOT NULL,
  `lienphoto` varchar(50) NOT NULL,
  `ideve` int(11) NOT NULL,
  `numsire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`idphotos`, `lienphoto`, `ideve`, `numsire`) VALUES
(2, '../uploads/c5.png', 0, 5),
(3, '../uploads/c1.png', 0, 4),
(4, '../uploads/c2.png', 0, 1),
(5, '../uploads/c4.png', 0, 2),
(6, '../uploads/c4.png', 0, 3),
(8, '../uploads/c3.png', 0, 7),
(9, '../uploads/c2.png', 0, 8),
(12, '../uploads/c5.png', 0, 6);

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
(2, 'Haflinger', 0),
(3, 'Arabe', 0),
(4, 'Quarter Horse', 0),
(5, 'Appaloosa', 0),
(6, 'Akhal-Teke', 0),
(7, 'Barbe', 0),
(8, 'Criollo', 0),
(9, 'Andalou', 0),
(10, 'Lusitanien', 0),
(11, 'Mustang', 0),
(12, 'Shetland', 0),
(13, 'Camargue', 0),
(14, 'Connemara', 0),
(15, 'Dartmoor', 0);

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
(2, 'Alezan', 0),
(3, 'Noir', 0),
(4, 'Blanc', 0),
(5, 'Rouan', 0),
(6, 'Isabelle', 0),
(7, 'Palomino', 0),
(8, 'Pie', 0),
(9, 'Cafe au lait', 0),
(10, 'Fauve', 0),
(11, 'Tachete', 0),
(12, 'Grisonnant', 0),
(13, 'Gris', 0),
(14, 'Bringe', 0),
(15, 'Cremello', 0);

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
(1, 'admin1@gmail.com', 'Admin1', 'User1', '$2y$10$4UYsSyOCh8OPLOqGaPEN4.oqhN6nV0Xkuw2EVHms3z5Qv4WTO64o2'),
(2, 'admin2@gmail.com', 'Admin2', 'User2', '$2y$10$yLJfcJq8Z4F8.QrY9ObeKeg4bw944IcdbcQIl3TRXK/dqlMeVSBKe'),
(3, 'admin3@gmail.com', 'Admin3', 'User3', '$2y$10$HK2CpQyMUTRo2mngzNT8IusdMME7GdzXmKnRi.GTQ/lkjcTckx5Au');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idcoursseance`,`idcoursbase`),
  ADD KEY `fk_cours_base` (`idcoursbase`);

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
  ADD KEY `fk_pension_cavalerie` (`numsire`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`idphotos`),
  ADD KEY `fk_photos_cavalerie` (`numsire`);

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
  MODIFY `idcoursseance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4081;

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `numsire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `cavaliers`
--
ALTER TABLE `cavaliers`
  MODIFY `idcava` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idcours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ideve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idgalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `logs_cavaliers`
--
ALTER TABLE `logs_cavaliers`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idpen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `idphotos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idrace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idrobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `fk_cours_base` FOREIGN KEY (`idcoursbase`) REFERENCES `cours` (`idcours`);

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
  ADD CONSTRAINT `fk_pension_cavalerie` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `fk_photos_cavalerie` FOREIGN KEY (`numsire`) REFERENCES `cavalerie` (`numsire`);

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
