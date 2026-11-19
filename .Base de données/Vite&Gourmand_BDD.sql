-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : sam. 24 oct. 2026 à 14:06
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
-- Base de données : `vite & gourmand`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int(100) NOT NULL,
  `id_utilisateur` int(100) NOT NULL,
  `id_menu` int(100) NOT NULL,
  `statut` int(255) NOT NULL,
  `prix_total` decimal(10,0) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `nb_personnes_min` int(11) NOT NULL,
  `regime` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `conditions_menu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id_menu`, `nom`, `prix`, `description`, `image`, `theme`, `nb_personnes_min`, `regime`, `stock`, `conditions_menu`) VALUES
(1, 'Menu Gourmand', 15.90, 'Entrée, plat et dessert', 'agneau 2', '', 0, '', 0, ''),
(2, 'Menu Végétarien', 14.99, 'Menu sans viande', '', '', 0, '', 0, ''),
(3, 'Menu Express', 12.00, 'Formule rapide et complète', '', '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `menu_plats`
--

CREATE TABLE `menu_plats` (
  `id_menu` int(11) NOT NULL,
  `id_plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

CREATE TABLE `plats` (
  `id_plat` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id_plat`, `nom`, `type`) VALUES
(1, 'Salade César', 'Entrée'),
(2, 'Soupe de légumes', 'Entrée'),
(3, 'Carpaccio de boeuf', 'Entrée'),
(4, 'Burger maison', 'Plat'),
(5, 'Poulet rôti et pommes de terre', 'Plat'),
(6, 'Saumon grillé et légumes', 'Plat'),
(7, 'Tarte aux pommes', 'Dessert'),
(8, 'Tiramisu', 'Dessert'),
(9, 'Fondant au chocolat', 'Dessert');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prénom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `role` varchar(11) NOT NULL,
  `date_creation` date NOT NULL,
  `statut` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prénom`, `email`, `mot_de_passe`, `telephone`, `role`, `date_creation`, `statut`) VALUES
(1, 'Andrieu', 'Julie', 'Andouilette@hotmail.fin', '$2y$10$duEqftV46l/MZYUWnWMVYuWzWXH/w5FVjTr/cytT7Yex3/FMUV0Bm', '061234589', 'Administrat', '2026-08-24', 0),
(2, 'Fernando', 'José', 'josé.fernando@assitant.miam', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '0600000002', 'employee', '2026-10-19', 1),
(3, 'Martin', 'Sophie', 'sophie.martin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '0600000001', 'employee', '2026-10-19', 1),
(4, 'Petit', 'Léa', 'lea.petit@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.', '0600000003', 'employee', '2026-10-19', 0),
(5, 'Dupont', 'Kévin', 'Jeanmiche@hotmail.zut', '$2y$10$Ux6ZVtptQaJAh1xAP7x7eCb4M0mlucZbeSImD/5Ab0...', '0615832467', 'client', '2026-08-24', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`);

--
-- Index pour la table `menu_plats`
--
ALTER TABLE `menu_plats`
  ADD PRIMARY KEY (`id_menu`,`id_plat`),
  ADD KEY `id_plat` (`id_plat`);

--
-- Index pour la table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id_plat`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `plats`
--
ALTER TABLE `plats`
  MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `menu_plats`
--
ALTER TABLE `menu_plats`
  ADD CONSTRAINT `menu_plats_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`),
  ADD CONSTRAINT `menu_plats_ibfk_2` FOREIGN KEY (`id_plat`) REFERENCES `plats` (`id_plat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
