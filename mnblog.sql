-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 27 juin 2021 à 09:34
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mnblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS comments ;
CREATE TABLE IF NOT EXISTS comments (
  `comment_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(13) NOT NULL,
  `post_id` smallint(5) UNSIGNED NOT NULL,
  `date_creat` timestamp NOT NULL,
  `date_modify` datetime NOT NULL,
  `comment` text NOT NULL,
  `author` char(20) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_posts1_idx` (`post_id`),
  KEY `fk_comments_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO comments (`comment_id`, `uuid`, `post_id`, `date_creat`, `date_modify`, `comment`, `author`, `valide`, `user_id`) VALUES
(12, '60b4c0dacc512', 11, '2021-05-31 10:56:26', '2021-05-31 12:56:26', 'un autre commentaire qu\'on va essayer de mettre un peut plus long pour tester ce qui va ce passer', 'util1', 1, 3),
(13, '60b4cc0bf088b', 11, '2021-05-31 11:44:11', '2021-05-31 13:44:11', 'un autre autre nouveau commentaire', 'mecbil', 1, 1),
(14, '60b4d0b38101d', 11, '2021-05-31 12:04:03', '2021-05-31 14:04:03', 'les oiseaux sont nombreux', 'einstein', 1, 3),
(17, '60b4d2523b382', 9, '2021-05-31 12:10:58', '2021-05-31 14:10:58', 'le commentair de coucou', 'coucou', 1, 5),
(18, '60bbb8019559e', 12, '2021-06-05 17:44:33', '2021-06-05 19:44:33', 'commentaire de teste leroi', 'leroi', 1, 2),
(24, '60bfd40c0a19c', 12, '2021-06-08 20:33:16', '2021-06-08 22:33:16', 'deuxième test', 'mecbil', 1, 1),
(47, '60d0707adeb3a', 12, '2021-06-21 10:56:58', '2021-06-21 12:56:58', 'teste après supp d\'un else', 'util1', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS posts ;
CREATE TABLE IF NOT EXISTS posts (
  `post_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(13) NOT NULL,
  `date_creat` timestamp NOT NULL,
  `date_modify` datetime NOT NULL,
  `chapo` char(100) NOT NULL,
  `content` text NOT NULL,
  `title` char(50) NOT NULL,
  `author` char(20) NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fk_posts_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO posts (`post_id`, `uuid`, `date_creat`, `date_modify`, `chapo`, `content`, `title`, `author`, `user_id`) VALUES
(1, '608fb4bc9f83d', '2021-04-20 10:32:16', '2021-05-05 21:36:52', 'Le Chapô c\'est quoi au fait? utilisé surtous dans les journaux il serait une sorte de résumé ou pas', 'Le Chapô doit impérativement contenir des informations de base, identifiées grâce à la méthode des QQOQP (ou 5W en anglais) : Qui ? Quoi ? Où ? Quand ? Pourquoi ? et complété éventuellement par Combien ? et Comment ? C’est pourquoi il est plus facile de composer le chapô en dernier, en partant du contenu l’article.', 'Rédiger le chapô en dernier', 'mecbil', 1),
(3, '608fb4fd2cf69', '2021-04-21 11:07:16', '2021-05-17 21:36:52', 'bloum bloum', 'Le Chapô doit impérativement contenir des informations de base, identifiées grâce à la méthode des QQOQP (ou 5W en anglais) : Qui ? Quoi ? Où ? Quand ? Pourquoi ? et complété éventuellement par Combien ? et Comment ? C’est pourquoi il est plus facile de composer le chapô en dernier, en partant du contenu l’article.', 'les autres', 'mecbil', 1),
(4, '608fb528c0151', '2021-04-23 15:36:55', '2021-05-17 21:36:52', 'Faudra peut être pas toucher à ce sujet', 'Les echecs c\'est ceci et cela etc..', 'Les echecs', 'Admin', 2),
(8, '60aa0e4a36fe6', '2021-05-23 06:11:54', '2021-05-23 08:11:54', 'Sont-ils des fake news ou pas', '1- Les vaccins seront bientôt obligatoire\r\n2- Au mois de Juillet les masques vont tombées', 'Fake news', 'Admin', 1),
(9, '60ab9bb697a43', '2021-05-24 10:27:34', '2021-05-24 12:27:34', 'dfgdfgdf', 'lkjlkj', 'dfgdfgdfg', 'lmlkm', 1),
(10, '60b0b397a54ff', '2021-05-28 07:10:47', '2021-05-28 09:10:47', 'Le PHP domine le marché de la Programmation Orienté Objet partie Back end mais pas seulement, ..', 'PHP: Hypertext Preprocessor, plus connu sous son sigle PHP (sigle auto-référentiel), est un langage de programmation libre19, principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP18, mais pouvant également fonctionner comme n\'importe quel langage interprété de façon locale. PHP est un langage impératif orienté objet.\r\n\r\nPHP a permis de créer un grand nombre de sites web célèbres, comme Facebook et Wikipédia20. Il est considéré comme une des bases de la création de sites web dits dynamiques mais également des applications web. ', 'Le php un language parfait', 'mecbil', 1),
(11, '60b2062b8b3b0', '2021-05-29 07:15:23', '2021-06-04 05:04:57', 'Nouveau chapo en ajoutant un truc', 'nouveau texte', 'Nouveau post', 'mecbil', 1),
(12, '60b9ef6640634', '2021-06-04 07:16:22', '2021-06-21 11:28:03', 'chapo test avec plein de texte qui sera réduit bien sur', 'content text', 'titre teste', 'mecbil', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS users ;
CREATE TABLE IF NOT EXISTS users (
  `user_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` char(13) NOT NULL,
  `nickname` char(20) NOT NULL,
  `password` char(72) NOT NULL,
  `mail` char(50) NOT NULL,
  `role` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO users (`user_id`, `uuid`, `nickname`, `password`, `mail`, `role`) VALUES
(1, '608fac92b0b1f', 'mecbil', '$2y$10$vC/S4Aj7msr.UZp.ChPqC.Ta18PwT14X62zSkBCWBnNf9BbhMI0Tq', 'mecbil@moi.fr', 1),
(2, '608facccba0fc', 'leroi', '$2y$10$3yAnI0xvPKGRgIuE.T8a4uRbZ4ayuLUEy6dTu8dJDe3RHdD4lYbCO', 'leroi@lui.fr', 0),
(3, '60b26849e18eb', 'util1', '$2y$10$PcFjv32PVGQCnMbwAzanK.A1yMQgi1LEZ9KK7JU6EASAQlNM2uYTm', 'util1@util1.fr', NULL),
(4, '60b268a248f36', 'util2', '$2y$10$a.cuCZFVrPj4SI8D5lLvmu1FqtClebsS6g7liVDX3FSMFqiWayXlC', 'util2@util2.fr', NULL),
(5, '60b4d11b83bef', 'coucou', '$2y$10$A/X89adr06tZxDh0WjDfb.2vNZmDXFNKhpxTwinPdaBz/KQjJIdbe', 'coucou@coucou.com', NULL),
(6, '60bc78c301698', 'usertest', '$2y$10$s3uvAUfqTLRhFTN2VOhLnO3x7UYGRrEzsUnmc3KjPsulcpXw0V2KG', 'user@user.fr', NULL),
(7, '60bc79e3805b9', 'usertest2', '$2y$10$DTuu5VCXgzBU4mrh8y4RK.bDMRvu2ZPunQyADbaasZDAPzLqPE6oG', 'usertest2@usertest2.fr', NULL),
(8, '60bc857d98c70', 'billy', '$2y$10$X0Q9Latt4pljxtinLFSTY.Ss9.DkUczSReQRFMx2c3x.dos0vxGQy', 'billy@billy.com', NULL),
(9, '60c742cdd9c64', 'nabil', '$2y$10$YbQREwYM6pSWI0TpytEzMupqpLT6Jb6vQ12jM2c7PWm0l51744O9y', 'mecbil@moi.fr', NULL),
(10, '60d2eec2aafc7', 'pseudo12', '$2y$10$YGJdyiHMrhY4seBS1qHMwOmUEuNbrKEJmViFZvbYEfKSrapT257di', 'nabil@nabil.fr', NULL),
(11, '60d2ef4445074', 'pseudotest', '$2y$10$Gd4fNrz.EM0MZENRTrSqbeCvcTFznhIAbnoWFiN7Ag5los9cGLcDe', 'teste@teste.fr', NULL),
(12, '60d2ef9a27003', 'pseudotest', '$2y$10$Ea1bRPdp1mBkBUS/KJhrNuwkFYrdmEEpg4/nLca9bfelHK7waImrO', 'teste@teste.fr', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table comments
--
ALTER TABLE comments
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE posts
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
