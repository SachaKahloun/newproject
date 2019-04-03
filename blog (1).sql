-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 27 mars 2019 à 14:10
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `summary` text,
  `content` longtext,
  `is_published` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `category_id`, `title`, `date`, `summary`, `content`, `is_published`) VALUES
(1, 47, 'Hellfest 2018, l\'affiche quasi-complète', '2017-01-06', 'Résumé de l\'article Hellfest', '', 1),
(2, 9, 'Critique « Star Wars 8 – Les derniers Jedi » de Rian Johnson : le renouveau de la saga ?', '2017-01-07', 'Résumé de l\'article Star Wars 8', '<p>Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.</p>', 0),
(3, 47, 'Revue - The Ramones', '2017-01-01', 'Résumé de l\'article The Ramones', '<p>Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.</p>', 0),
(4, 108, 'De “Skyrim” à “L.A. Noire” ou “Doom” : pourquoi les vieux jeux sont meilleurs sur la Switch', '2017-01-03', 'Résumé de l\'article Switch', '<p>Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>', 0),
(5, 108, 'Comment “Assassin’s Creed” trouve un nouveau souffle en Egypte', '2017-01-04', 'Résumé de l\'article Assassin’s Creed', '<p>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar.</p>', 0),
(6, 47, 'BO de « Les seigneurs de Dogtown » : l’époque bénie du rock.', '2017-01-05', 'Résumé de l\'article Les seigneurs de Dogtown', '<p>Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula.</p>', 0),
(7, 108, 'Pourquoi \"Destiny 2\" est un remède à l’ultra-moderne solitude', '2017-01-09', 'Résumé de l\'article Destiny 2', '<p>Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam.</p>', 0),
(8, 108, 'Pourquoi \"Mario + Lapins Crétins : Kingdom Battle\" est le jeu de la rentrée', '2017-01-08', 'Résumé de l\'article Mario + Lapins Crétins', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', 0),
(9, 108, '« Le Crime de l’Orient Express » : rencontre avec Kenneth Branagh', '2017-01-02', 'Résumé de l\'article Le Crime de l’Orient Express', '', 1),
(12, 108, 'yes', '2019-03-29', 'bro', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(5, 'Théâtre', 'Dates, représentations, avis...'),
(9, 'Cinéma', 'Trailers, infos, sorties...'),
(47, 'Musique', 'Concerts, sorties d\'albums, festivals...'),
(108, 'Jeux vidéos', 'Videos, tests...'),
(109, 'hejc', 'hgvc'),
(110, 'hrjegfnv', 'hejqbds'),
(111, 'iuqjfs', 'jkb<srg'),
(112, 'Sacha ', 'bonjour'),
(113, 'Sacha ', 'kahkah'),
(114, 'Bonjour', 'egfzja'),
(115, 'Sacha ', 'yess'),
(116, 'Sacha ', 'rufjbc'),
(117, 'Sacha ', 'fh'),
(119, 'yugj', ''),
(120, 'hjbn', 'hjbjn'),
(121, 'hvjb', ',n hvjbnvg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `biography` text,
  `is_admin` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `biography`, `is_admin`) VALUES
(1, 'sachaa', 'kahloun', 'kahloun.sacha@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', 1),
(2, 'sacha', 'kahloun', 'kahloun.sacha@gmail.com', 'cc8c0a97c2dfcd73caff160b65aa39e2', '', 0),
(3, 'sacha', 'kahloun', 'kahloun.sacha@gmail.com', '810db8842da8cf65c5d50c8e340f1328', '', 0),
(4, 'sacha', 'kahloun', 'kahloun.sacha@gmail.com', '810db8842da8cf65c5d50c8e340f1328', '', 0),
(5, 'sacha', 'kahloun', 'kahloun.sacha@gmail.com', '810db8842da8cf65c5d50c8e340f1328', '', 0),
(6, 'hjcs', 'hjcvt', 'kahloun.sacha@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', 0),
(7, 'John', 'kahloun', 'kahloun.sacha@gmail.com', '85db457f686c158a00525eef7e6c8cdf', '', 0),
(8, 'John', 'kahloun', 'kahloun.sacha@gmail.com', '373633ec8af28e5afaf6e5f4fd87469b', '', 0),
(9, 'John', 'kahloun', 'johno@gmail.com', 'df753f70daadd2a2674add120cf517e5', '', 0),
(10, 'John', 'kahloun', 'kahloun.sacha@gmail.com', '3cf804e7182ab12879c33c914e1c5cd8', '', 0),
(11, 'John', 'kahloun', 'kahloun.sacha@gmail.com', '3cf804e7182ab12879c33c914e1c5cd8', '', 0),
(12, 'sacha', 'kahloun', 'kahloun.sacha@gmail.com', 'ec3807a97f2bae47b0d9840d22351ade', '', 0),
(13, 'John', 'kahloun', 'kahloun.sacha@gmail.com', 'a9f05953ecfdece37960c0a531627f36', '', 0),
(14, 'John', 'kahloun', 'kahloun.sacha@gmail.com', 'a9f05953ecfdece37960c0a531627f36', '', 0),
(15, 'thoms', 'tom', 't@mail.fr', '0a5b3913cbc9a9092311630e869b4442', 'aze', 0),
(16, 't', 't', 't@mail.fr', '13085a63a2b3e4beb7ab10ee395aefe4', 'eeeee', 0),
(17, 't', 't', 'kahloun.sacha@gmail.com', 'e358efa489f58062f10dd7316b65649e', 't', 0),
(18, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0),
(19, '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0),
(20, 'ytu', 'gh', 'johno@gmail.com', '1f28e49f34e2406fdb6d6158eebd793b', '', 0),
(21, 'jhgtfr', 'yhgtfrde', 'kahlllon.sacha@gmail.com', 'f2a7e899b5af7365d70d252f3fd387dd', '', 0),
(22, 'John', 'kahloun', 'johnoff@gmail.com', '5e36941b3d856737e81516acd45edc50', '', 0),
(23, 'tgrfeds', 'grfeds', 'johnovv@gmail.com', '06a699c21b3219c05484e43bdfb4cc05', '', 0),
(24, 'sacha', 'edelman', 'kahlouyyyn.sacha@gmail.com', '2510c39011c5be704182423e3a695e91', '', 1),
(25, 'John', 'kahloun', 'kahlldhoun.sacha@gmail.com', '8277e0910d750195b448797616e091ad', '', 0),
(26, 'John', 'kahloun', 'johrfgno@gmail.com', 'c4e39d6ded17f86e7a817851322821a5', 'btt', 0),
(27, 'jbn,', 'ter', 't@mail.net', '0a5b3913cbc9a9092311630e869b4442', '', 0),
(28, 'John', 'kahloun', 'kayfguehloun.sacha@gmail.com', '5b593c651bda77f2b449220326ad4346', 'khavn,bdscn', 0),
(30, 'sacha', 'kahloun', 'kahloune.sacha@gmail.com', '0a5b3913cbc9a9092311630e869b4442', NULL, 1),
(31, 'sachak', 'kahloun', 'kahloune.sacha@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
