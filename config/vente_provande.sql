-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 fév. 2023 à 22:30
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vente_provande`
--

-- --------------------------------------------------------

--
-- Structure de la table `aprov`
--

CREATE TABLE `aprov` (
  `idAp` int(11) NOT NULL,
  `qtAp` float NOT NULL,
  `dateAp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prodAp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `aprov`
--

INSERT INTO `aprov` (`idAp`, `qtAp`, `dateAp`, `prodAp`) VALUES
(1, 5, '2023-02-27 18:19:51', 11),
(2, 4, '2023-02-27 18:20:13', 7),
(3, 4, '2023-02-27 18:20:53', 7),
(4, 5, '2023-02-27 18:22:25', 7),
(5, 5, '2023-02-27 18:22:27', 7),
(6, 5, '2023-02-27 18:23:04', 7),
(7, 10, '2023-02-27 18:23:51', 6),
(8, 10, '2023-02-27 18:28:18', 5),
(9, 2, '2023-02-27 18:28:41', 8),
(10, 5, '2023-02-27 21:27:21', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_com` int(4) NOT NULL,
  `design` varchar(255) NOT NULL,
  `qtAchete` float NOT NULL,
  `pu` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `dateAchat` timestamp NOT NULL DEFAULT current_timestamp(),
  `idProP` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_com`, `design`, `qtAchete`, `pu`, `montant`, `dateAchat`, `idProP`) VALUES
(25, 'BOTSAKO', 9, 2000, 18000, '2023-02-27 12:14:15', 7),
(26, 'DEMMARAGE', 5, 3000, 15000, '2023-02-27 20:58:58', 1),
(27, 'FINITION', 10.5, 2900, 30450, '2023-02-27 20:59:29', 2),
(28, 'TOURTAUX', 17, 3000, 51000, '2023-02-27 21:22:21', 9);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_prod` int(4) NOT NULL,
  `nom_prod` varchar(255) NOT NULL,
  `qt_prod_detail` float NOT NULL,
  `prix_detail` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_prod`, `nom_prod`, `qt_prod_detail`, `prix_detail`) VALUES
(1, 'DEMMARAGE', 45, 3000),
(2, 'FINITION', 44, 2900),
(5, 'FEEDMAX CROISS', 30, 2700),
(6, 'FEEDMAX FINITION', 20, 3000),
(7, 'BOTSAKO', 55, 2000),
(8, 'SEMOULE', 50, 1900),
(9, 'TOURTAUX', 33, 3000),
(11, '210', 50, 1200);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aprov`
--
ALTER TABLE `aprov`
  ADD PRIMARY KEY (`idAp`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_com`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_prod`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `aprov`
--
ALTER TABLE `aprov`
  MODIFY `idAp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_com` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_prod` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
