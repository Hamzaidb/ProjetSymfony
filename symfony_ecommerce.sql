-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 15 juin 2025 à 21:12
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony_ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250615145214', '2025-06-15 14:52:29', 175),
('DoctrineMigrations\\Version20250615151832', '2025-06-15 15:18:40', 54);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `message` longtext COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`),
  KEY `IDX_BF5476CAA76ED395` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `label`, `user_id`, `type`, `created_at`, `updated_at`, `message`) VALUES
(1, 'Suppression de produit', 1, 'produit', '2025-06-14 20:25:41', '2025-06-14 20:25:41', 'Produit \"t-shirt\" supprimé par hh le 14/06/2025 20:25'),
(2, 'Modification de produit', 1, 'produit', '2025-06-14 20:26:01', '2025-06-14 20:26:01', 'Produit \"Iphonedd\" modifié par hh le 14/06/2025 20:26'),
(3, 'Achat de produit', 2, 'achat', '2025-06-15 13:45:59', '2025-06-15 13:45:59', 'Achat du produit \"Iphonedd\" par userdd le 15/06/2025 13:45'),
(4, 'Modification de produit', 1, 'produit', '2025-06-15 15:12:36', '2025-06-15 15:12:36', 'Produit \"Iphonedd\" modifié par hh le 15/06/2025 15:12'),
(5, 'Modification de produit', 1, 'produit', '2025-06-15 15:20:09', '2025-06-15 15:20:09', 'Produit \"Iphone 16\" modifié par hh le 15/06/2025 15:20'),
(6, 'Achat de produit', 2, 'achat', '2025-06-15 15:30:37', '2025-06-15 15:30:37', 'Achat du produit \"Iphone 16\" par userdd le 15/06/2025 15:30'),
(7, 'Ajout de produit', 1, 'produit', '2025-06-15 19:09:27', '2025-06-15 19:09:27', 'Produit \"Produit 3\" ajouté par idb le 15/06/2025 19:09');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `prix` int(5) NOT NULL,
  `description` longtext COLLATE utf8mb4_bin,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27A76ED395` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `description`, `user_id`, `created_at`, `updated_at`, `category`) VALUES
(2, 'Iphone 16', 500, 'Iphone 16 PRO MAXXX', 1, '2025-06-14 19:28:00', '2025-06-15 15:20:09', 'smartphone'),
(3, 'Porsche 911', 80000, 'Icone', 1, '2025-06-14 22:02:00', '2025-06-14 22:02:00', ''),
(4, 'Produit 3', 50, 'produit', 1, '2025-06-15 19:09:27', '2025-06-15 19:09:27', 'produit');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_bin NOT NULL,
  `roles` json NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `points` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `nom`, `prenom`, `points`, `actif`, `password`) VALUES
(1, 'hamza@gmail.com', '[\"ROLE_ADMIN\"]', 'idb', 'hamza', 11001, 1, '$2y$13$d2D6x90ZsX.1K./B6DQFwuTZ7RgBXEg16DlWHvnfHiN.YAcIFdD06'),
(2, 'user@gmail.com', '[\"ROLE_USER\"]', 'userdd', 'userss', 4500, 1, '$2y$13$bn47V4OGrnghkNME6mPVs.jM9wdtqbu60PO0dvOmrcvT/nVYFXlxa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
