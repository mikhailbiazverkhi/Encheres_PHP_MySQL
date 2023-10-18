-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 07 mai 2023 à 18:50
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `enchères`
--

-- --------------------------------------------------------

--
-- Structure de la table `catégorie`
--

CREATE TABLE `catégorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `catégorie`
--

INSERT INTO `catégorie` (`id`, `nom`) VALUES
(5, 'Maison'),
(6, 'Appartement'),
(7, 'Duplex'),
(8, 'Triplex');

-- --------------------------------------------------------

--
-- Structure de la table `enchères`
--

CREATE TABLE `enchères` (
  `id` int(11) NOT NULL,
  `utilisateur_a_id` int(11) NOT NULL,
  `objet_proposé_id` int(11) NOT NULL,
  `prix_proposé` decimal(10,2) NOT NULL,
  `changement_prix` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enchères`
--

INSERT INTO `enchères` (`id`, `utilisateur_a_id`, `objet_proposé_id`, `prix_proposé`, `changement_prix`) VALUES
(73, 3, 4, 124.00, '2023-05-06 21:15:20'),
(74, 3, 4, 150.00, '2023-05-06 21:16:16'),
(75, 3, 5, 1000000.00, '2023-05-06 22:19:59'),
(76, 3, 5, 1000001.00, '2023-05-06 22:20:32'),
(77, 3, 5, 1223463.00, '2023-05-06 22:20:59'),
(78, 3, 8, 123000.00, '2023-05-06 22:37:09'),
(79, 3, 8, 125000.00, '2023-05-06 22:37:42'),
(80, 3, 9, 100001.00, '2023-05-06 22:44:27'),
(81, 3, 4, 151.00, '2023-05-07 01:57:20'),
(82, 29, 21, 12000.00, '2023-05-07 11:19:19'),
(83, 29, 22, 16000.00, '2023-05-07 11:23:18'),
(84, 29, 23, 51000.00, '2023-05-07 11:23:45'),
(85, 29, 8, 126000.00, '2023-05-07 12:37:33'),
(86, 29, 8, 127000.00, '2023-05-07 12:39:07'),
(87, 29, 24, 25000.00, '2023-05-07 12:43:17');

-- --------------------------------------------------------

--
-- Structure de la table `objet_proposé`
--

CREATE TABLE `objet_proposé` (
  `id` int(11) NOT NULL,
  `utilisateur_v_id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prix_initial` decimal(10,2) NOT NULL,
  `début_enchères` datetime NOT NULL DEFAULT current_timestamp(),
  `fin_enchères` datetime NOT NULL,
  `catégorie_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `chemin_photo` varchar(300) NOT NULL,
  `estVendu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `objet_proposé`
--

INSERT INTO `objet_proposé` (`id`, `utilisateur_v_id`, `nom`, `prix_initial`, `début_enchères`, `fin_enchères`, `catégorie_id`, `description`, `chemin_photo`, `estVendu`) VALUES
(4, 1, 'SSS', 123.00, '2023-05-04 11:10:27', '2023-05-06 11:10:00', 6, 'Bonne maison', 'uploads/1683213027_téléchargement.jpg', 1),
(5, 1, 'GGGG', 100000.00, '2023-05-04 11:13:11', '2023-05-06 22:21:00', 8, 'Bonne maison', 'uploads/1683213191_OIP.jpg', 1),
(6, 1, 'Obj Name', 100000.00, '2023-05-04 11:14:25', '2023-05-05 11:14:00', 5, 'Bonnemaison', 'uploads/1683213265_OIP.jpg', 1),
(7, 1, 'Obj Name', 100000.00, '2023-05-05 22:23:17', '2023-05-06 21:32:00', 8, 'Bonnefffmaison', 'uploads/1683339797_OIP.jpg', 1),
(8, 1, 'Obj Name', 100000.00, '2023-05-05 22:24:51', '2023-05-17 22:24:00', 6, 'Bonne asdvsadv maison', 'uploads/1683339891_OIP.jpg', 0),
(9, 1, 'Obj Name', 100000.00, '2023-05-05 22:28:16', '2023-05-27 22:28:00', 6, 'Bonne maison', 'uploads/1683340096_téléchargement.jpg', 0),
(10, 1, 'Obj Name', 100000.00, '2023-05-05 22:29:21', '2023-05-19 22:29:00', 7, 'fff Bonne    ffff  maison', 'uploads/1683340161_OIP.jpg', 0),
(15, 5, '', 0.00, '2023-05-06 21:21:46', '2023-05-07 03:19:23', 6, '', '', 1),
(16, 1, 'GGGG', 100000.00, '2023-05-04 11:13:11', '2023-05-06 21:59:00', 8, 'Bonne maison', 'uploads/1683213191_OIP.jpg', 1),
(17, 1, 'New', 10.00, '2023-05-07 01:26:54', '2023-05-08 01:26:00', 7, 'Bonne maison', 'uploads/1683437214_téléchargement.jpg', 0),
(18, 1, 'Obj Name1', 100000.00, '2023-05-07 01:46:28', '2023-05-07 04:46:00', 5, 'Bonne maison', 'uploads/1683438388_OIP.jpg', 1),
(19, 1, 'Obj Name111', 100000.00, '2023-05-07 01:52:23', '2023-05-07 05:52:00', 5, 'rftgerfg', 'uploads/1683438743_OIP.jpg', 1),
(20, 1, 'Obj Namedd', 100000.00, '2023-05-07 01:55:17', '2023-05-07 06:55:00', 5, 'Bonne maison', 'uploads/1683438917_OIP.jpg', 1),
(21, 28, 'Car', 10000.00, '2023-05-07 11:17:00', '2023-05-07 12:16:00', 7, 'Bonne car', 'uploads/1683472620_OIP111.jpg', 1),
(22, 28, 'Car2', 15000.00, '2023-05-07 11:21:06', '2023-05-07 11:26:00', 6, 'Bonne car2', 'uploads/1683472866_OIP 2222.jpg', 1),
(23, 28, 'wer', 50000.00, '2023-05-07 11:22:25', '2023-05-07 11:25:00', 6, 'Bonne maison1', 'uploads/1683472945_OIP.jpg', 1),
(24, 28, 'Car333', 20000.00, '2023-05-07 12:41:43', '2023-05-07 12:45:00', 6, 'Bonne car333', 'uploads/1683477703_OIP 2222.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_adhésion` datetime NOT NULL DEFAULT current_timestamp(),
  `nombre_objets` int(11) NOT NULL DEFAULT 0,
  `courriel` varchar(255) NOT NULL,
  `login` varchar(100) NOT NULL,
  `mot_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date_adhésion`, `nombre_objets`, `courriel`, `login`, `mot_passe`) VALUES
(1, 'Biazverkhi', 'Mike', '2023-05-03 13:16:53', 0, 'asas@wer.we', 'Admin', '202cb962ac59075b964b07152d234b70'),
(3, 'Biazverkhi', 'Mike', '2023-05-03 13:17:52', 0, 'asas@wer.we', 'rtydfhg', '202cb962ac59075b964b07152d234b70'),
(5, 'xxx', 'xxx', '2023-05-04 11:07:09', 0, 'asas@wer.we', 'QWERTY', '202cb962ac59075b964b07152d234b70'),
(8, 'dfhgfgh', 'ghdfghfhdf', '2023-05-04 11:24:14', 0, 'asas@wer.we', 'Admin111111', '202cb962ac59075b964b07152d234b70'),
(9, 'fffffff', 'fffffffff', '2023-05-04 11:26:38', 0, 'asas@wer.we', 'rgtfhfdhfghfdhfh', '202cb962ac59075b964b07152d234b70'),
(11, 'sdf', 'sadfff', '2023-05-04 11:43:29', 0, 'asas@wer.we', 'sda', '202cb962ac59075b964b07152d234b70'),
(13, 'Biazverkhi', 'Mike', '2023-05-04 11:46:48', 0, 'asas@wer.we', 'Admin1111', '202cb962ac59075b964b07152d234b70'),
(15, '', '', '2023-05-06 13:13:18', 0, '', '', 'd41d8cd98f00b204e9800998ecf8427e'),
(26, 'Biazverkhi', 'Mike', '2023-05-07 00:29:23', 0, 'asas@wer.we', 'Admin1', '202cb962ac59075b964b07152d234b70'),
(28, 'Alex', 'Alex', '2023-05-07 11:15:21', 0, 'sd@vv.vv', 'vendeur', '202cb962ac59075b964b07152d234b70'),
(29, 'Foux', 'Alain', '2023-05-07 11:18:11', 0, 'zzz@zz.wz', 'acheteur', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Structure de la table `évaluation`
--

CREATE TABLE `évaluation` (
  `id` int(11) NOT NULL,
  `utilisateur_v_id` int(11) NOT NULL,
  `utilisateur_a_id` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(500) DEFAULT NULL,
  `date_évaluation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `évaluation`
--

INSERT INTO `évaluation` (`id`, `utilisateur_v_id`, `utilisateur_a_id`, `note`, `commentaire`, `date_évaluation`) VALUES
(1, 1, 3, 1, '32r', '2023-05-07 10:24:59'),
(2, 1, 3, 5, 'sdfgvbsdfbsdfgb', '2023-05-07 10:31:29'),
(3, 1, 3, 4, 'erwgwerg v3w yrregertherthjhe4tytjtytje4tyjetyjetyj', '2023-05-07 11:05:30'),
(4, 1, 3, 4, 'erwgwerg v3w yrregertherthjhe4tytjtytje4tyjetyjetyj', '2023-05-07 11:06:07'),
(5, 1, 3, 4, '34263463465346', '2023-05-07 11:08:33'),
(105, 1, 3, 4, '34263463465346', '2023-05-07 11:09:00'),
(205, 1, 3, 4, '34263463465346', '2023-05-07 11:09:23'),
(265, 1, 3, 3, '213t234g', '2023-05-07 11:09:48'),
(266, 28, 29, 9, 'waerreg 243qg 134egt 134t g234qtr 134t', '2023-05-07 12:40:06'),
(267, 28, 29, 5, '4w5thy35  hub3tetrhg gwresg yvwerey v3245gtr ywrg vwrg wrreg wrfg wregf 3wrweg ', '2023-05-07 12:42:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `catégorie`
--
ALTER TABLE `catégorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enchères`
--
ALTER TABLE `enchères`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_a_id` (`utilisateur_a_id`),
  ADD KEY `objet_proposé_id` (`objet_proposé_id`);

--
-- Index pour la table `objet_proposé`
--
ALTER TABLE `objet_proposé`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_v_id` (`utilisateur_v_id`),
  ADD KEY `catégorie_id` (`catégorie_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `évaluation`
--
ALTER TABLE `évaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_v_id` (`utilisateur_v_id`),
  ADD KEY `utilisateur_a_id` (`utilisateur_a_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `catégorie`
--
ALTER TABLE `catégorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `enchères`
--
ALTER TABLE `enchères`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `objet_proposé`
--
ALTER TABLE `objet_proposé`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `évaluation`
--
ALTER TABLE `évaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchères`
--
ALTER TABLE `enchères`
  ADD CONSTRAINT `enchères_ibfk_1` FOREIGN KEY (`utilisateur_a_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `enchères_ibfk_2` FOREIGN KEY (`objet_proposé_id`) REFERENCES `objet_proposé` (`id`);

--
-- Contraintes pour la table `objet_proposé`
--
ALTER TABLE `objet_proposé`
  ADD CONSTRAINT `objet_proposé_ibfk_1` FOREIGN KEY (`utilisateur_v_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `objet_proposé_ibfk_2` FOREIGN KEY (`catégorie_id`) REFERENCES `catégorie` (`id`);

--
-- Contraintes pour la table `évaluation`
--
ALTER TABLE `évaluation`
  ADD CONSTRAINT `évaluation_ibfk_1` FOREIGN KEY (`utilisateur_v_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `évaluation_ibfk_2` FOREIGN KEY (`utilisateur_a_id`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
