-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-server
-- Généré le : mar. 10 mars 2026 à 08:03
-- Version du serveur : 8.4.8
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `csm_fight_team`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--
DROP DATABASE IF EXISTS csm_fight_team;

CREATE DATABASE csm_fight_team;
USE csm_fight_team;

CREATE TABLE `album` (
  `id_album` int UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `cover_img` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int UNSIGNED NOT NULL,
  `date_event` date DEFAULT NULL,
  `img_event` varchar(255) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article_comment`
--

CREATE TABLE `article_comment` (
  `id_article` int UNSIGNED NOT NULL,
  `id_comment` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

CREATE TABLE `article_tag` (
  `id_article` int UNSIGNED NOT NULL,
  `id_tag` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Form_contact`
--

CREATE TABLE `Form_contact` (
  `id_form` int UNSIGNED NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mail` varchar(254) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_email` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int UNSIGNED NOT NULL,
  `alt_text` varchar(250) NOT NULL,
  `img_path` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo_album`
--

CREATE TABLE `photo_album` (
  `id_album` int UNSIGNED NOT NULL,
  `id_photo` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `slot_day`
--

CREATE TABLE `slot_day` (
  `id_slot_day` int UNSIGNED NOT NULL,
  `training_day` enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int UNSIGNED NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `time_slot`
--

CREATE TABLE `time_slot` (
  `id_time_slot` int UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `label_cours` varchar(100) DEFAULT NULL,
  `age_min` tinyint UNSIGNED NOT NULL,
  `age_max` tinyint UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Structure de la table `time_slot_day`
--

CREATE TABLE `time_slot_day` (
  `id_time_slot` int UNSIGNED NOT NULL,
  `id_slot_day` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_`
--

CREATE TABLE `user_` (
  `id_user` int UNSIGNED NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mail` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(100) DEFAULT NULL,
  `expiry_reset` datetime DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_comment`
--

CREATE TABLE `user_comment` (
  `id_user` int UNSIGNED NOT NULL,
  `id_comment` int UNSIGNED NOT NULL,
  `like_dislike` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `article_comment`
--
ALTER TABLE `article_comment`
  ADD PRIMARY KEY (`id_article`,`id_comment`),
  ADD KEY `id_comment` (`id_comment`);

--
-- Index pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id_article`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `Form_contact`
--
ALTER TABLE `Form_contact`
  ADD PRIMARY KEY (`id_form`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- Index pour la table `photo_album`
--
ALTER TABLE `photo_album`
  ADD PRIMARY KEY (`id_album`,`id_photo`),
  ADD KEY `id_photo` (`id_photo`);

--
-- Index pour la table `slot_day`
--
ALTER TABLE `slot_day`
  ADD PRIMARY KEY (`id_slot_day`),
  ADD UNIQUE KEY `training_day` (`training_day`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `tag` (`tag`);

--
-- Index pour la table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`id_time_slot`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `time_slot_day`
--
ALTER TABLE `time_slot_day`
  ADD PRIMARY KEY (`id_time_slot`,`id_slot_day`),
  ADD KEY `id_slot_day` (`id_slot_day`);

--
-- Index pour la table `user_`
--
ALTER TABLE `user_`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Index pour la table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`id_user`,`id_comment`),
  ADD KEY `id_comment` (`id_comment`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Form_contact`
--
ALTER TABLE `Form_contact`
  MODIFY `id_form` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `slot_day`
--
ALTER TABLE `slot_day`
  MODIFY `id_slot_day` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `id_time_slot` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_`
--
ALTER TABLE `user_`
  MODIFY `id_user` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`);

--
-- Contraintes pour la table `article_comment`
--
ALTER TABLE `article_comment`
  ADD CONSTRAINT `article_comment_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `article_comment_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`);

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `article_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`);

--
-- Contraintes pour la table `photo_album`
--
ALTER TABLE `photo_album`
  ADD CONSTRAINT `photo_album_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`),
  ADD CONSTRAINT `photo_album_ibfk_2` FOREIGN KEY (`id_photo`) REFERENCES `photo` (`id_photo`);

--
-- Contraintes pour la table `time_slot`
--
ALTER TABLE `time_slot`
  ADD CONSTRAINT `time_slot_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`);

--
-- Contraintes pour la table `time_slot_day`
--
ALTER TABLE `time_slot_day`
  ADD CONSTRAINT `time_slot_day_ibfk_1` FOREIGN KEY (`id_time_slot`) REFERENCES `time_slot` (`id_time_slot`),
  ADD CONSTRAINT `time_slot_day_ibfk_2` FOREIGN KEY (`id_slot_day`) REFERENCES `slot_day` (`id_slot_day`);

--
-- Contraintes pour la table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `user_comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_` (`id_user`),
  ADD CONSTRAINT `user_comment_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id_comment`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
