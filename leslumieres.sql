-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 10 juin 2022 à 12:53
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leslumieres`
--

-- --------------------------------------------------------

--
-- Structure de la table `geantemarmotte_comments`
--

CREATE TABLE `geantemarmotte_comments` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `username_author` varchar(255) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_publication` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `geantemarmotte_comments`
--

INSERT INTO `geantemarmotte_comments` (`id`, `id_author`, `username_author`, `id_subject`, `content`, `date_publication`) VALUES
(22, 24, 'gab', 47, 'prout', '10/06/2022'),
(23, 24, 'gab', 47, 'prout', '10/06/2022'),
(24, 24, 'gab', 47, 'prout', '10/06/2022'),
(25, 24, 'gab', 61, 'Je confirme un chef-d\'œuvre malgré les 3h de film', '10/06/2022');

-- --------------------------------------------------------

--
-- Structure de la table `geantemarmotte_forum`
--

CREATE TABLE `geantemarmotte_forum` (
  `id` int(11) NOT NULL,
  `film_subject` varchar(60) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `id_author` int(11) NOT NULL,
  `username_author` varchar(255) NOT NULL,
  `date_publication` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `geantemarmotte_forum`
--

INSERT INTO `geantemarmotte_forum` (`id`, `film_subject`, `title`, `content`, `id_author`, `username_author`, `date_publication`) VALUES
(47, 'rien est fini ...', 'Une histoire incroyable qui me rappel tellement de chose ....', 'SALE PUTE KATYA TU M\'ENTENDS SALOPE', 16, 'gab', '10/06/2022'),
(49, 'le goat', 'Bleach &gt;&gt;&gt;&gt;&gt;&gt; all ?', 'Ichigo fait moi des gosses', 16, 'gab', '10/06/2022'),
(50, 'omen, au mcdo', 'Omen le roi ', 'Le roi des smokers', 16, 'gab', '10/06/2022'),
(51, 'le goat', 'OAPZUIYHFDZAE ZIPETTE FIXETTE SUR MA POUDRE', 'OE OE COUTEAU DRILL ', 16, 'gab', '10/06/2022'),
(52, 'le goat', 'test', 'test', 16, 'gab', '10/06/2022'),
(53, 'le goat', 'test', 'test', 16, 'gab', '10/06/2022'),
(54, 'le goat', 'test', 'test', 16, 'gab', '10/06/2022'),
(55, 'le goat', 'tests', 'test', 16, 'gab', '10/06/2022'),
(56, 'le goat', 'testt', 'tsett', 16, 'gab', '10/06/2022'),
(57, 'le goat', 'testest', 'tsett', 16, 'gab', '10/06/2022'),
(58, 'le goat', 'estestest', 'teststest', 16, 'gab', '10/06/2022'),
(59, 'le goat', 'testtes', 'teststes', 16, 'gab', '10/06/2022'),
(60, 'le goat', 'ichigo le roi', 'er', 16, 'gab', '10/06/2022'),
(61, 'batman', 'batman incroyable', 'dedeed', 16, 'gab', '10/06/2022'),
(62, 'rien est fini ...', 'Oh la folle elle veut du gucci', 'sale pute', 19, 'gabuser', '10/06/2022');

-- --------------------------------------------------------

--
-- Structure de la table `grandcanard_logs`
--

CREATE TABLE `grandcanard_logs` (
  `id` int(11) NOT NULL,
  `view` varchar(50) NOT NULL,
  `connection` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `grandcanard_logs`
--

INSERT INTO `grandcanard_logs` (`id`, `view`, `connection`) VALUES
(1, 'index.php', 49),
(2, 'users.php', 53),
(3, 'logs.php', 3),
(4, 'films.php', 19);

-- --------------------------------------------------------

--
-- Structure de la table `grandegirafe_pwd_recover`
--

CREATE TABLE `grandegirafe_pwd_recover` (
  `id` int(11) NOT NULL,
  `token_user` varchar(64) NOT NULL,
  `token` varchar(64) NOT NULL,
  `date_recover` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `grandegirafe_pwd_recover`
--

INSERT INTO `grandegirafe_pwd_recover` (`id`, `token_user`, `token`, `date_recover`) VALUES
(1, '1c654724db4ca9747786f21b1d790feffc8def8e', 'fc703bd41a400d8887ea87e96587b1ee802e4ed6a7b64a28', '2022-06-08 17:04:09');

-- --------------------------------------------------------

--
-- Structure de la table `groschien_film`
--

CREATE TABLE `groschien_film` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(60) NOT NULL,
  `genre` varchar(20) NOT NULL,
  `maker` varchar(40) NOT NULL,
  `actors` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `featured` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groschien_film`
--

INSERT INTO `groschien_film` (`id`, `image_path`, `title`, `genre`, `maker`, `actors`, `info`, `creation_date`, `update_date`, `featured`) VALUES
(2, '../Images/Movies/Ez7ayTrWQAYLGhe.jpg', 'omen, au mcdo', 'action', 'riot', 'omen', '', '2022-06-03 14:11:33', '2022-06-03 14:11:33', 1),
(3, '../Images/Movies/0b6883b7-d434-4dbd-9c90-a073088af93a.png', 'le goat', 'action', 'effefe', 'feffffe', 'efeffee', '2022-06-10 10:17:21', '2022-06-10 10:17:21', 1),
(4, '../Images/Movies/MV5BMTYwNjAyODIyMF5BMl5BanBnXkFtZTYwNDMwMDk2._V1_SX300.jpg', 'batman', 'action', 'batman', 'batman', 'ezfdezzf', '2022-06-10 10:19:23', '2022-06-10 10:19:23', 1),
(5, '../Images/Movies/rien_est_fini.jpg', 'rien est fini ...', 'drame', 'dedeedd', 'dedeed', 'dededed', '2022-06-10 10:20:01', '2022-06-10 10:20:01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `megalapin_ticket`
--

CREATE TABLE `megalapin_ticket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `film_name` varchar(50) NOT NULL,
  `ticket` varchar(70) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `minisculecome_newsletter`
--

CREATE TABLE `minisculecome_newsletter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(90) DEFAULT NULL,
  `content` varchar(250) DEFAULT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `moyenlezard_user_logs`
--

CREATE TABLE `moyenlezard_user_logs` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `moyenlezard_user_logs`
--

INSERT INTO `moyenlezard_user_logs` (`id`, `type`, `date`, `user_id`) VALUES
(1, 'login.', '2022-06-01 10:30:54', 14),
(2, 'login.', '2022-06-01 12:46:10', 14),
(3, 'added a movie:le goat.', '2022-06-10 10:17:21', 24),
(4, 'added a movie:batman.', '2022-06-10 10:19:23', 24),
(5, 'added a movie:rien est fini ....', '2022-06-10 10:20:01', 24);

-- --------------------------------------------------------

--
-- Structure de la table `petitchat_user`
--

CREATE TABLE `petitchat_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statut` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `token` varchar(40) DEFAULT NULL,
  `confirmKey` int(11) DEFAULT NULL,
  `newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `banned` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `petitchat_user`
--

INSERT INTO `petitchat_user` (`id`, `email`, `username`, `pwd`, `creation_date`, `update_date`, `statut`, `is_admin`, `token`, `confirmKey`, `newsletter`, `banned`) VALUES
(1, 'jordan.dfrsne@dufrsne.com', 'jdufresne3', '$2y$10$2xkaDyqa5UkuhjH3qYL7Mu2GQxp2RltzlC1Ka0dj5e5loC3ZH944K', '2022-04-12 15:05:47', '2022-05-31 10:09:03', 1, 0, 'b76f91a2e17ce9d019354849c5ca51c6a0e83391', NULL, 0, 0),
(4, 'sananes@esgi.fr', 'sananes', '$2y$10$HEaYSc1Fk3FtL0nh/1Cn7O3xLhR52S06ds0/YUSJW9dMF9dfHPJSC', '2022-04-12 15:35:24', '2022-06-01 19:52:39', 0, 0, NULL, NULL, 0, 0),
(14, 'jdrpythontest@gmail.com', 'jordan95va', '$2y$10$8mtvoCCPabJSqoXchOh0lOiG0BYuA4pHHdZttlC2hDkDAqYpEJgTi', '2022-05-09 10:37:42', '2022-06-04 18:38:03', 1, 1, '75e1f7c1ff5c7bb9ce11332649df06efe92b6e4c', 7206144, 1, 0),
(16, 'pivatygabriel@gmail.com', 'gab', '$2y$10$ppsYxt3zGe5igIb77MBbteAsM1iEENS3bbnKb1PieDfNSSoCeWyqm', '2022-06-01 13:12:21', '2022-06-09 20:11:38', 1, 1, '7435ef3d769e114ac07ead93d1166a63f44f047c', 3244503, 1, 0),
(17, 'dasim27847@falkyz.com', 'dasim27847', '$2y$10$A6MTdExvfXOVYciOZV7rYOWcQCVL7xHzZwSlZ7345TkaeSkVle8Ei', '2022-06-04 13:27:47', '2022-06-08 15:06:12', 1, 0, 'ead96c345fcc5339c918955f4564271cfeeb237d', 3381213, 1, 0),
(18, 'test@test.com', 'test', '$2y$10$2Dxs7HEuQpIBR/jSzy9EhOLUV7sTpkBxtWR0z.v8Y96R.YwLVH4uG', '2022-06-04 18:01:04', '2022-06-04 18:01:04', 0, 0, NULL, 3132944, 1, 0),
(19, 'pivatygabriel+@gmail.com', 'gabuser', '$2y$10$4TsKbzCUI1J5DNxebASlhuEXF75pLQclQetmJwpWcr1R9FKl.chxa', '2022-06-05 15:26:06', '2022-06-10 12:20:37', 1, 0, '236d52c4df0d8d4906520797d20e711b03ba5e3a', 7519828, 1, 0),
(20, 'nakihe9292@iconzap.com', 'nakihe9292', '$2y$10$ri6LwuxVbHSrcEV.hvv9GORDpq715/4O3ripsUacyBHMRKP8aDBzu', '2022-06-08 15:01:54', '2022-06-08 15:01:54', 0, 0, NULL, 4156835, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `geantemarmotte_comments`
--
ALTER TABLE `geantemarmotte_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `geantemarmotte_forum`
--
ALTER TABLE `geantemarmotte_forum`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `grandcanard_logs`
--
ALTER TABLE `grandcanard_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `grandegirafe_pwd_recover`
--
ALTER TABLE `grandegirafe_pwd_recover`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groschien_film`
--
ALTER TABLE `groschien_film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `megalapin_ticket`
--
ALTER TABLE `megalapin_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `minisculecome_newsletter`
--
ALTER TABLE `minisculecome_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `moyenlezard_user_logs`
--
ALTER TABLE `moyenlezard_user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `petitchat_user`
--
ALTER TABLE `petitchat_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `geantemarmotte_comments`
--
ALTER TABLE `geantemarmotte_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `geantemarmotte_forum`
--
ALTER TABLE `geantemarmotte_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `grandcanard_logs`
--
ALTER TABLE `grandcanard_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `grandegirafe_pwd_recover`
--
ALTER TABLE `grandegirafe_pwd_recover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groschien_film`
--
ALTER TABLE `groschien_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `megalapin_ticket`
--
ALTER TABLE `megalapin_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `minisculecome_newsletter`
--
ALTER TABLE `minisculecome_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `moyenlezard_user_logs`
--
ALTER TABLE `moyenlezard_user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `petitchat_user`
--
ALTER TABLE `petitchat_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
