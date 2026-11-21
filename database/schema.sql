-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 nov. 2026 à 03:54
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom-troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('available','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `image`, `status`, `user_id`, `created_at`) VALUES
(2, 'Wabi Sabi', 'Beth Kempton', 'Une introduction à la philosophie japonaise qui trouve la beauté dans l’imperfection. Un livre apaisant, facile à lire, qui donne envie de simplifier son quotidien.', '8462e04aa979ca810b2e993bb987dea6.webp', 'unavailable', 1, '2026-10-18 22:51:54'),
(3, 'A Book Full Of Hope', 'Rupi Kaur', 'Un recueil de poèmes lumineux, pensé comme un compagnon pour les jours difficiles. Les textes courts se lisent d’une traite ou au compte-gouttes, et laissent une impression de douceur. Un livre qu’on garde sur sa table de chevet.', NULL, 'available', 2, '2026-10-19 08:52:03'),
(4, 'The Subtle Art Of', 'Mark Manson', 'Un guide direct et plein d’humour pour apprendre à se concentrer sur ce qui compte vraiment. L’auteur explique pourquoi vouloir tout contrôler épuise, et comment choisir ses combats. Une lecture franche, qui secoue sans jamais moraliser.', NULL, 'unavailable', 2, '2026-10-19 08:52:54'),
(5, 'Narnia', 'C.S Lewis', 'Quatre enfants découvrent un monde caché derrière la porte d’une armoire. Entre créatures parlantes, quêtes et batailles, ils deviennent les héros d’une histoire qui marque plusieurs générations de lecteurs. Un classique à relire à tout âge.', NULL, 'available', 1, '2026-10-19 08:54:34');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `content`, `sent_at`) VALUES
(1, 2, 1, 'Salut tu vas bien', '2026-10-19 03:55:37'),
(2, 1, 2, 'Salut tranquille et toi ?', '2026-10-19 17:00:56'),
(3, 1, 2, 'Qu\'est ce que tu fais de beau ?', '2026-10-21 17:24:24'),
(4, 1, 2, 'Ok comment vas tu', '2026-10-24 10:03:16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`) VALUES
(1, 'Juopo788', 'juopo788@proton.me', '$2y$10$S00/rBBOV3uGoKb8Ldmoz.aRjiWcK9mw3qnDID7KAdtG6mkQYbB4S', '544073e85b3f72e2f86699998be3680a.jpg', '2026-10-18 12:30:56'),
(2, 'Nikola75', 'nikola75@gmail.com', '$2y$10$h/iyqm4nbYKCoOzmQ8F9x.HIW8ygGDgdHmbm5vpKeumIEV8.TZ232', NULL, '2026-10-19 03:46:43');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
