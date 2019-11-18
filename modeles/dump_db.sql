-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 16:11
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mvc_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `validated` tinyint(1) NOT NULL,
  `creation_time` datetime NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `validated`, `creation_time`, `id_post`, `id_user`) VALUES
(1, 'bravo', 1, '2019-11-11 03:00:00', 1, 3),
(2, '&lt;script&gt;alert(\'coucou\');&lt;/script&gt;', 0, '2019-11-11 04:00:00', 5, 3),
(4, 'Wahoo!', 1, '2019-11-11 05:11:08', 5, 4),
(6, 'O&ugrave; peut-on acheter des actions FDJ?', 1, '2019-11-11 06:12:00', 5, 4),
(7, 'Ils l\'ont bien m&eacute;rit&eacute;', 1, '2019-11-11 07:24:10', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `headnote` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `creation_time` datetime NOT NULL,
  `revision_time` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `title`, `headnote`, `content`, `creation_time`, `revision_time`, `id_user`) VALUES
(1, 'Coupe du monde de rugby', 'Remise de la coupe du monde de rugby', 'La remise de la coupe du monde de rugby a eu lieu aujourd\'hui au japon.\r\nLa remise de la coupe du monde de rugby a eu lieu aujourd\'hui au japon.\r\nLa remise de la coupe du monde de rugby a eu lieu aujourd\'hui au japon.\r\nLa remise de la coupe du monde de rugby a eu lieu aujourd\'hui au japon.', '2019-11-02 10:05:08', '2019-11-02 10:05:08', 2),
(2, 'Halloween', 'Soirée d\'Halloween', 'La soirée d\'Halloween à eu lieu ce vendredi soir dans la Capitale dans un calme apparent.\r\nLa soirée d\'Halloween à eu lieu ce vendredi soir dans la Capitale dans un calme apparent.\r\nLa soirée d\'Halloween à eu lieu ce vendredi soir dans la Capitale dans un calme apparent.\r\nLa soirée d\'Halloween à eu lieu ce vendredi soir dans la Capitale dans un calme apparent.', '2019-11-01 07:50:53', '2019-11-01 07:50:53', 2),
(3, 'Grève de la SNCF', 'La grève de la SNCF', 'La grève de la SNCF se poursuit encore, les usagers continuent de subir sans pouvoirs trouver d\'alternative viable.\r\nLa grève de la SNCF se poursuit encore, les usagers continuent de subir sans pouvoirs trouver d\'alternative viable.\r\nLa grève de la SNCF se poursuit encore, les usagers continuent de subir sans pouvoirs trouver d\'alternative viable.', '2019-10-31 09:22:54', '2019-10-31 09:22:54', 2),
(5, 'La FDJ en bourse!', 'Entr&eacute;e en bourse de la fran&ccedil;aise des jeux', 'La fran&ccedil;aise des jeux entre en bourse. De belles &eacute;conomies en perspectives pour le gouvernement. \r\nLa fran&ccedil;aise des jeux entre en bourse. De belles &eacute;conomies en perspectives pour le gouvernement. \r\nLa fran&ccedil;aise des jeux entre en bourse. De belles &eacute;conomies en perspectives pour le gouvernement.\r\nLa fran&ccedil;aise des jeux entre en bourse. De belles &eacute;conomies en perspectives pour le gouvernement.', '2019-11-06 12:05:42', '2019-11-18 15:18:21', 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` char(60) NOT NULL,
  `register_date` date NOT NULL,
  `admin_granted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password_hash`, `register_date`, `admin_granted`) VALUES
(2, 'johnnycash', 'johnnycash@free.fr', '$2y$10$E4Thlm/6ogI79jVfl0Zu1uBJKYD9ifeynNsB/1ekXXgEH.mA5Ud7W', '2019-11-02', 0),
(3, 'marty', 'marty@gmail.com', '$2y$10$JUgAlMt492MyCyfYpsWR6uHonxWCLAsOJ9epchFPRX6D.gINXmoD6', '2019-11-04', 0),
(4, 'barry', 'barry@altavista.com', '$2y$10$PsJUXR1EXjcsenqFpYyQ/eVeZIqQte1k6vCG/651mn5karG5a5dFu', '2019-11-06', 1),
(5, 'john', 'john@wanadoo.fr', '$2y$10$pSc3abQPXX0BvhjNvfHo2uQYFS1zyPYwE3fhAO/iLpfa8fpuTREKG', '2019-11-06', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
