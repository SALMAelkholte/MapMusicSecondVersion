-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 29 mai 2019 à 04:09
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `musicmap`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `nomalbum` varchar(100) DEFAULT NULL,
  `coveralbum` varchar(100) DEFAULT NULL,
  `idartist` int(11) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`idalbum`, `nomalbum`, `coveralbum`, `idartist`, `date_sortie`) VALUES
(1, 'Summer dreams', NULL, NULL, '2019-05-01'),
(2, 'Ne me quitte pas', NULL, NULL, '2019-05-03'),
(3, 'cause u love me', NULL, NULL, '2019-05-22');

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `idartiste` int(50) NOT NULL,
  `nomartiste` varchar(100) DEFAULT NULL,
  `bio` text,
  `imgartiste` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`idartiste`, `nomartiste`, `bio`, `imgartiste`) VALUES
(1, 'Dire Straits', '\nDire Straits were a British rock band from Newcastle, United Kingdom,  formed in 1977 by Mark Knopfler (guitar and vocals), his brother David Knopfler (guitar), John Illsley (bass), and Pick Withers (drums), and subsequently managed by Ed Bicknell. The band were inducted into the Rock and Roll Hall of Fame in 2018.\n\nDire Straits emerged during the post-punk era of the late \'70s, and while their sound was minimalistic and stripped down, they owed little to punk. <a href=\"https://www.last.fm/music/Dire+Straits\">Read more on Last.fm</a>', 'img/1.jpg'),
(2, 'Celine Dion', 'Céline Marie Claudette Dion (born March 30, 1968 in Charlemagne, Quebec, Canada) is a Canadian singer. Regarded as one of pop music\'s most influential voices, Céline Dion remains the best-selling Canadian artist and one of the best-selling artists of all time with record sales of over 200 million copies worldwide.  To date, Céline Dion has won five Grammy Awards, including Album of the Year and Record of the Year.  She is the second best-selling female artist in the US during the Nielsen SoundScan era. <a href=\"https://www.last.fm/music/+noredirect/C%C3%A9line+Dion\">Read more on Last.fm</a>', 'img/2.jpg'),
(3, 'Queen', '\nQueen were an English rock band originally consisting of four members: vocalist and pianist Freddie Mercury, guitarist Brian May, bass guitarist John Deacon, and drummer Roger Taylor.\n\nThe band formed in London in 1970 after May and Taylor\'s former band Smile split after having released an album and single. Freddie replaced lead vocalist Tim Staffell, after the latter\'s departure from the original trio. \n\nThere was much deliberation as to what the band\'s name would be. <a href=\"https://www.last.fm/music/Queen\">Read more on Last.fm</a>', 'img/3.jpg'),
(4, 'Black Sabbath', 'Black Sabbath was an English heavy metal band that formed in 1968 in Birmingham, West Midlands, England, United Kingdom and disbanded in 2017, originally comprising Ozzy Osbourne (vocals), Tony Iommi (guitar), Geezer Butler (bass), and Bill Ward (drums). In the early 70s, they were the first to pair heavily distorted, sonically dissonant blues rock at slow speeds with lyrics about drugs, mental pain and abominations of war, thus giving birth to generations of metal bands that followed in their wake. <a href=\"https://www.last.fm/music/Black+Sabbath\">Read more on Last.fm</a>', 'img/4.jpg'),
(5, 'Maître Gims', 'Telephone can refer to one of two unrelated groups: a French rock band, or a music project from the US.\n\n[1] Téléphone was an extremely popular French rock band that formed in 1976 and disbanded in 1986. \n\nTéléphone re-energised rock in France with their electrifying concerts, yet they remained largely unknown in non french-speaking countries, probably because they always sang in French.\n\nAlmost all of its members went on to solo careers.\n\nMembers list: <a href=\"https://www.last.fm/music/+noredirect/T%C3%A9l%C3%A9phone\">Read more on Last.fm</a>', 'img/5.jpg'),
(7, 'BB King', 'Black Sabbath was an English heavy metal band that formed in 1968 in Birmingham, West Midlands, England, United Kingdom and disbanded in 2017, originally comprising Ozzy Osbourne (vocals), Tony Iommi (guitar), Geezer Butler (bass), and Bill Ward (drums). In the early 70s, they were the first to pair heavily distorted, sonically dissonant blues rock at slow speeds with lyrics about drugs, mental pain and abominations of war, thus giving birth to generations of metal bands that followed in their wake. <a href=\"https://www.last.fm/music/Black+Sabbath\">Read more on Last.fm</a>', 'img/7.jpg'),
(8, 'Leonard Cohen', 'Telephone can refer to one of two unrelated groups: a French rock band, or a music project from the US.\r\n\r\n[1] Téléphone was an extremely popular French rock band that formed in 1976 and disbanded in 1986. \r\n\r\nTéléphone re-energised rock in France with their electrifying concerts, yet they remained largely unknown in non french-speaking countries, probably because they always sang in French.\r\n\r\nAlmost all of its members went on to solo careers.\r\n\r\nMembers list: <a href=\"https://www.last.fm/music/+noredirect/T%C3%A9l%C3%A9phone\">Read more on Last.fm</a>', 'img/8.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `avoir_genre`
--

CREATE TABLE `avoir_genre` (
  `idgenres` int(11) NOT NULL,
  `idmusique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `avoir_playlist`
--

CREATE TABLE `avoir_playlist` (
  `mailclient` varchar(50) DEFAULT NULL,
  `idplaylist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avoir_playlist`
--

INSERT INTO `avoir_playlist` (`mailclient`, `idplaylist`) VALUES
('takichy', 1),
('lina', 3),
('lina@gmail.com', 2);

-- --------------------------------------------------------

--
-- Structure de la table `a_sortie`
--

CREATE TABLE `a_sortie` (
  `idartiste` int(11) NOT NULL,
  `idalbum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `idclassement` int(11) NOT NULL,
  `nomclassement` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `nomclient` varchar(100) DEFAULT NULL,
  `prenomclient` varchar(100) DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdpclient` varchar(100) DEFAULT NULL,
  `mailclient` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`nomclient`, `prenomclient`, `pseudo`, `mdpclient`, `mailclient`) VALUES
('salma', 'elkholte', 'lina', '123456', 'lina'),
('yasmina', 'elkholte', 'yasmina', '123456', 'lina@gmail.com'),
('takichy', 'takichy', 'takichy', 'takichy', 'takichy');

-- --------------------------------------------------------

--
-- Structure de la table `dans_album`
--

CREATE TABLE `dans_album` (
  `idalbum` int(11) NOT NULL,
  `idmusique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dans_album`
--

INSERT INTO `dans_album` (`idalbum`, `idmusique`) VALUES
(1, 1),
(1, 2),
(1, 5),
(1, 6),
(2, 3),
(2, 4),
(2, 7),
(2, 8),
(3, 9),
(3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `dans_playlist`
--

CREATE TABLE `dans_playlist` (
  `idplaylist` int(11) NOT NULL,
  `idmusique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dans_playlist`
--

INSERT INTO `dans_playlist` (`idplaylist`, `idmusique`) VALUES
(1, 2),
(1, 4),
(1, 5),
(2, 2),
(2, 7),
(3, 1),
(3, 2),
(3, 3),
(3, 5),
(3, 6),
(3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `etre_classee`
--

CREATE TABLE `etre_classee` (
  `idmusique` int(11) NOT NULL,
  `idclassement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `idgenres` int(11) NOT NULL,
  `nomgenre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `interprete`
--

CREATE TABLE `interprete` (
  `idartiste` int(11) NOT NULL,
  `idmusique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `interprete`
--

INSERT INTO `interprete` (`idartiste`, `idmusique`) VALUES
(1, 1),
(1, 5),
(2, 2),
(2, 6),
(3, 3),
(3, 7),
(4, 4),
(4, 8),
(7, 9),
(8, 10);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `idlocalisation` int(11) NOT NULL,
  `pays` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `musique`
--

CREATE TABLE `musique` (
  `idmusique` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `urldeezer` varchar(200) DEFAULT NULL,
  `iddeezer` varchar(200) DEFAULT NULL,
  `tempo` float DEFAULT NULL,
  `dansability` float DEFAULT NULL,
  `energy` float DEFAULT NULL,
  `popularity` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `musique`
--

INSERT INTO `musique` (`idmusique`, `titre`, `duree`, `urldeezer`, `iddeezer`, `tempo`, `dansability`, `energy`, `popularity`) VALUES
(1, 'To day', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 14),
(2, 'To night', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 7),
(3, '50 cent', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 8),
(4, 'Let Me Love You', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 6),
(5, 'Gone', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 3),
(6, 'No Way', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 17),
(7, 'Save me', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 8),
(8, 'You Are', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 10),
(9, 'The Sky is Crying', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 2),
(10, 'Make it rain', '00:04:35', 'audio/dummy-audio.mp3', NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `origine`
--

CREATE TABLE `origine` (
  `idartiste` int(11) NOT NULL,
  `idlocalisation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

CREATE TABLE `playlist` (
  `idplaylist` int(11) NOT NULL,
  `nomplaylist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `playlist`
--

INSERT INTO `playlist` (`idplaylist`, `nomplaylist`) VALUES
(1, 1),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `similaire`
--

CREATE TABLE `similaire` (
  `idartiste1` int(11) DEFAULT NULL,
  `idartiste2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`);

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`idartiste`);

--
-- Index pour la table `avoir_genre`
--
ALTER TABLE `avoir_genre`
  ADD PRIMARY KEY (`idgenres`,`idmusique`),
  ADD KEY `idmusique` (`idmusique`);

--
-- Index pour la table `avoir_playlist`
--
ALTER TABLE `avoir_playlist`
  ADD KEY `mailclient` (`mailclient`),
  ADD KEY `idplaylist` (`idplaylist`);

--
-- Index pour la table `a_sortie`
--
ALTER TABLE `a_sortie`
  ADD PRIMARY KEY (`idartiste`,`idalbum`),
  ADD KEY `idalbum` (`idalbum`);

--
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`idclassement`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`mailclient`);

--
-- Index pour la table `dans_album`
--
ALTER TABLE `dans_album`
  ADD PRIMARY KEY (`idalbum`,`idmusique`),
  ADD KEY `idmusique` (`idmusique`);

--
-- Index pour la table `dans_playlist`
--
ALTER TABLE `dans_playlist`
  ADD PRIMARY KEY (`idplaylist`,`idmusique`),
  ADD KEY `idmusique` (`idmusique`);

--
-- Index pour la table `etre_classee`
--
ALTER TABLE `etre_classee`
  ADD PRIMARY KEY (`idmusique`,`idclassement`),
  ADD KEY `idclassement` (`idclassement`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idgenres`);

--
-- Index pour la table `interprete`
--
ALTER TABLE `interprete`
  ADD PRIMARY KEY (`idartiste`,`idmusique`),
  ADD KEY `idmusique` (`idmusique`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`idlocalisation`);

--
-- Index pour la table `musique`
--
ALTER TABLE `musique`
  ADD PRIMARY KEY (`idmusique`);

--
-- Index pour la table `origine`
--
ALTER TABLE `origine`
  ADD PRIMARY KEY (`idartiste`,`idlocalisation`),
  ADD KEY `idlocalisation` (`idlocalisation`);

--
-- Index pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`idplaylist`);

--
-- Index pour la table `similaire`
--
ALTER TABLE `similaire`
  ADD KEY `idartiste1` (`idartiste1`),
  ADD KEY `idartiste2` (`idartiste2`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avoir_genre`
--
ALTER TABLE `avoir_genre`
  ADD CONSTRAINT `AVOIR_GENRE_ibfk_1` FOREIGN KEY (`idmusique`) REFERENCES `musique` (`idmusique`),
  ADD CONSTRAINT `AVOIR_GENRE_ibfk_2` FOREIGN KEY (`idgenres`) REFERENCES `genre` (`idgenres`);

--
-- Contraintes pour la table `avoir_playlist`
--
ALTER TABLE `avoir_playlist`
  ADD CONSTRAINT `AVOIR_PLAYLIST_ibfk_1` FOREIGN KEY (`mailclient`) REFERENCES `client` (`mailclient`),
  ADD CONSTRAINT `AVOIR_PLAYLIST_ibfk_2` FOREIGN KEY (`idplaylist`) REFERENCES `playlist` (`idplaylist`);

--
-- Contraintes pour la table `a_sortie`
--
ALTER TABLE `a_sortie`
  ADD CONSTRAINT `A_SORTIE_ibfk_1` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`),
  ADD CONSTRAINT `A_SORTIE_ibfk_2` FOREIGN KEY (`idartiste`) REFERENCES `artiste` (`idartiste`);

--
-- Contraintes pour la table `dans_album`
--
ALTER TABLE `dans_album`
  ADD CONSTRAINT `DANS_ALBUM_ibfk_1` FOREIGN KEY (`idmusique`) REFERENCES `musique` (`idmusique`),
  ADD CONSTRAINT `DANS_ALBUM_ibfk_2` FOREIGN KEY (`idalbum`) REFERENCES `album` (`idalbum`);

--
-- Contraintes pour la table `dans_playlist`
--
ALTER TABLE `dans_playlist`
  ADD CONSTRAINT `DANS_PLAYLIST_ibfk_1` FOREIGN KEY (`idmusique`) REFERENCES `musique` (`idmusique`),
  ADD CONSTRAINT `DANS_PLAYLIST_ibfk_2` FOREIGN KEY (`idplaylist`) REFERENCES `playlist` (`idplaylist`);

--
-- Contraintes pour la table `etre_classee`
--
ALTER TABLE `etre_classee`
  ADD CONSTRAINT `ETRE_CLASSEE_ibfk_1` FOREIGN KEY (`idclassement`) REFERENCES `classement` (`idclassement`),
  ADD CONSTRAINT `ETRE_CLASSEE_ibfk_2` FOREIGN KEY (`idmusique`) REFERENCES `musique` (`idmusique`);

--
-- Contraintes pour la table `interprete`
--
ALTER TABLE `interprete`
  ADD CONSTRAINT `INTERPRETE_ibfk_1` FOREIGN KEY (`idmusique`) REFERENCES `musique` (`idmusique`),
  ADD CONSTRAINT `INTERPRETE_ibfk_2` FOREIGN KEY (`idartiste`) REFERENCES `artiste` (`idartiste`);

--
-- Contraintes pour la table `origine`
--
ALTER TABLE `origine`
  ADD CONSTRAINT `ORIGINE_ibfk_1` FOREIGN KEY (`idlocalisation`) REFERENCES `localisation` (`idlocalisation`),
  ADD CONSTRAINT `ORIGINE_ibfk_2` FOREIGN KEY (`idartiste`) REFERENCES `artiste` (`idartiste`);

--
-- Contraintes pour la table `similaire`
--
ALTER TABLE `similaire`
  ADD CONSTRAINT `SIMILAIRE_ibfk_1` FOREIGN KEY (`idartiste1`) REFERENCES `artiste` (`idartiste`),
  ADD CONSTRAINT `SIMILAIRE_ibfk_2` FOREIGN KEY (`idartiste2`) REFERENCES `artiste` (`idartiste`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
