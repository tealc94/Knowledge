-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 juil. 2024 à 19:49
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `knowledge`
--

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `theme_id` int DEFAULT NULL,
  `name_cursus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `fichiers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_255A0C359027487` (`theme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`id`, `theme_id`, `name_cursus`, `price`, `created_at`, `updated_at`, `fichiers`) VALUES
(1, 1, 'Cursus d’initiation à la guitare', 50.00, '2024-07-01 19:09:17', '2024-07-08 18:09:10', 'cursus-guitare-668c2b46396f9788182626.txt'),
(2, 1, 'Cursus d’initiation au piano', 50.00, '2024-07-01 19:09:21', '2024-07-08 18:08:15', 'cursus-piano-668c2b0f23941317769105.txt'),
(3, 2, 'Cursus d’initiation au développement web', 60.00, '2024-07-01 19:09:25', '2024-07-08 18:14:38', 'cursus-developpement-web-668c2c8e8c069347714354.txt'),
(4, 3, 'Cursus d’initiation au jardinage', 30.00, '2024-07-01 19:09:28', '2024-07-08 18:14:58', 'cursus-jardinage-668c2ca2c39e2621402859.txt'),
(5, 4, 'Cursus d’initiation à la cuisine', 44.00, '2024-07-01 19:09:31', '2024-07-08 18:15:28', 'cursus-cuisine-668c2cc0a78f3157956929.txt'),
(6, 4, 'Cursus d’initiation à l’art du dressage culinaire', 48.00, '2024-07-01 19:09:34', '2024-07-08 18:15:49', 'cursus-dressage-culinaire-668c2cd53032a415540477.txt');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240707145908', '2024-07-07 14:59:14', 61),
('DoctrineMigrations\\Version20240707150810', '2024-07-07 15:08:15', 64),
('DoctrineMigrations\\Version20240707151506', '2024-07-07 15:15:11', 57),
('DoctrineMigrations\\Version20240707153701', '2024-07-07 15:37:06', 25),
('DoctrineMigrations\\Version20240707154252', '2024-07-07 15:42:56', 25),
('DoctrineMigrations\\Version20240707165241', '2024-07-07 16:52:50', 27),
('DoctrineMigrations\\Version20240707175814', '2024-07-07 17:58:19', 38),
('DoctrineMigrations\\Version20240708195947', '2024-07-08 19:59:57', 57),
('DoctrineMigrations\\Version20240709184359', '2024-07-09 18:44:09', 177),
('DoctrineMigrations\\Version20240709191624', '2024-07-09 19:16:35', 123),
('DoctrineMigrations\\Version20240709200458', '2024-07-09 20:05:06', 115),
('DoctrineMigrations\\Version20240710125029', '2024-07-10 12:50:36', 176),
('DoctrineMigrations\\Version20240713141422', '2024-07-13 14:14:29', 348),
('DoctrineMigrations\\Version20240713173844', '2024-07-13 17:38:50', 190),
('DoctrineMigrations\\Version20240714074358', '2024-07-14 07:44:03', 204);

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cursus_id` int DEFAULT NULL,
  `name_lesson` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `fichiers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F4218D940AEF4B9` (`cursus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lessons`
--

INSERT INTO `lessons` (`id`, `cursus_id`, `name_lesson`, `price`, `created_at`, `updated_at`, `fichiers`) VALUES
(1, 1, 'Leçon n°1 : Découverte de l’instrument', 26.00, '2024-07-01 19:12:21', '2024-07-08 20:08:28', 'lesson-1-guitare-668c473c9d4e6138616151.txt'),
(2, 1, 'Leçon n°2 : Les accords et les gammes', 26.00, '2024-07-01 19:12:25', '2024-07-08 20:08:42', 'lesson-2-guitare-668c474a4f0d6219280048.txt'),
(3, 2, 'Leçon n°1 : Découverte de l’instrument', 26.00, '2024-07-01 19:12:29', '2024-07-08 20:15:53', 'lesson-1-piano-668c48f9e4559995919301.txt'),
(4, 2, 'Leçon n°2 : Les accords et les gammes', 26.00, '2024-07-01 19:12:33', '2024-07-08 20:16:06', 'lesson-2-piano-668c4906f0fda416959700.txt'),
(5, 3, 'Leçon n°1 : Les langages Html et CSS', 32.00, '2024-07-01 19:12:38', '2024-07-08 20:11:59', 'lesson-1-develeppement-web-668c480f89d04710966294.txt'),
(6, 3, 'Leçon n°2 : Dynamiser votre site avec Javascript', 32.00, '2024-07-01 19:12:41', '2024-07-08 20:12:40', 'lesson-2-develeppement-web-668c4838b28a7666746293.txt'),
(7, 4, 'Leçon n°1 : Les outils du jardinier', 16.00, '2024-07-01 19:12:45', '2024-07-08 20:18:33', 'lesson-1-jardinage-668c4999ba098065698426.txt'),
(8, 4, 'Leçon n°2 : Jardiner avec la lune', 16.00, '2024-07-01 19:12:48', '2024-07-08 20:18:50', 'lesson-2-jardinage-668c49aa17536328022185.txt'),
(9, 5, 'Leçon n°1 : Les modes de cuisson', 23.00, '2024-07-01 19:12:51', '2024-07-08 20:20:18', 'lesson-1-cuisine-668c4a0243753690184818.txt'),
(10, 5, 'Leçon n°2 : Les saveurs', 23.00, '2024-07-01 19:12:54', '2024-07-08 20:20:49', 'lesson-2-cuisine-668c4a21596cb737337670.txt'),
(11, 6, 'Leçon n°1 : Mettre en oeuvre le style dans l’assiette', 26.00, '2024-07-01 19:12:58', '2024-07-08 20:23:31', 'lesson-1-dressage-culinaire-668c4ac3dfb13651091757.txt'),
(12, 6, 'Leçon n°2 : Harmoniser un repas à quatre plats', 26.00, '2024-07-01 19:13:02', '2024-07-08 20:24:05', 'lesson-2-dressage-culinaire-668c4ae5ef83e464999016.txt');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:171:\\\"http://127.0.0.1:8000/verify/email?expires=1719346523&signature=%2F6FEXuINP0znK0hHj8ft8oB46TVTAKOjydA6ACfI0ZI%3D&token=u%2BNOsl2Lq0BICC%2BzIK%2FGsVFBEveYxEESFq0pANyBgTM%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"tealc972@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:9:\\\"Knowledge\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"tealc972@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-06-25 19:15:24', '2024-06-25 19:15:24', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:30:\\\"reset_password/email.html.twig\\\";i:1;N;i:2;a:1:{s:10:\\\"resetToken\\\";O:58:\\\"SymfonyCasts\\\\Bundle\\\\ResetPassword\\\\Model\\\\ResetPasswordToken\\\":4:{s:65:\\\"\\0SymfonyCasts\\\\Bundle\\\\ResetPassword\\\\Model\\\\ResetPasswordToken\\0token\\\";s:40:\\\"Xbjfck1xh5eSStZP36YUd6DJpHbbL2BGEILZKBbg\\\";s:69:\\\"\\0SymfonyCasts\\\\Bundle\\\\ResetPassword\\\\Model\\\\ResetPasswordToken\\0expiresAt\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2024-06-25 20:35:34.458408\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}s:71:\\\"\\0SymfonyCasts\\\\Bundle\\\\ResetPassword\\\\Model\\\\ResetPasswordToken\\0generatedAt\\\";i:1719344134;s:73:\\\"\\0SymfonyCasts\\\\Bundle\\\\ResetPassword\\\\Model\\\\ResetPasswordToken\\0transInterval\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"tealc972@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:9:\\\"Knowledge\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"tealc972@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:27:\\\"Your password reset request\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-06-25 19:35:34', '2024-06-25 19:35:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `cursus_id` int NOT NULL,
  `purchase_date` datetime NOT NULL,
  `cursus_validate` tinyint(1) NOT NULL,
  `lesson_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6117D13BA76ED395` (`user_id`),
  KEY `IDX_6117D13B40AEF4B9` (`cursus_id`),
  KEY `IDX_6117D13BCDF80196` (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `cursus_id`, `purchase_date`, `cursus_validate`, `lesson_id`) VALUES
(15, 20, 1, '2024-07-12 13:17:51', 1, NULL),
(16, 20, 5, '2024-07-12 13:17:51', 1, NULL),
(26, 20, 3, '2024-07-15 18:48:25', 1, 6),
(27, 20, 3, '2024-07-15 20:04:05', 1, 5),
(28, 20, 4, '2024-07-17 11:20:09', 1, 7),
(29, 20, 4, '2024-07-17 11:21:52', 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `name_theme`, `created_at`, `updated_at`) VALUES
(1, 'Musique', '2024-07-01 19:08:29', '2024-07-06 17:13:05'),
(2, 'Informatique', '2024-07-01 19:08:34', '2024-07-06 17:13:11'),
(3, 'Jardinage', '2024-07-01 19:08:38', '2024-07-06 17:13:14'),
(4, 'Cuisine', '2024-07-01 19:08:41', '2024-07-06 17:13:17');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `username`, `created_at`, `updated_at`) VALUES
(4, 'jdoe@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$gG9eUaX3PGlObSV29.4qsusi66vdS6X5qA8.vSmaBTsn2Mn0d9Agq', 1, 'John Doe', '2024-07-01 19:08:03', '2024-07-06 17:12:41'),
(20, 'dupond@gmail.com', '[]', '$2y$13$rToJsO4leTb1LHAK2Tt8o.PNSfGFOALKODNxQEFCInr1ka8Cngusy', 1, 'Martin', '2024-07-02 20:12:29', '2024-07-06 17:12:51');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `FK_255A0C359027487` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Contraintes pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_3F4218D940AEF4B9` FOREIGN KEY (`cursus_id`) REFERENCES `cursus` (`id`);

--
-- Contraintes pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `FK_6117D13B40AEF4B9` FOREIGN KEY (`cursus_id`) REFERENCES `cursus` (`id`),
  ADD CONSTRAINT `FK_6117D13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_6117D13BCDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
