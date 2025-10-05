-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 25 sep. 2025 à 18:28
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `testoo_2`
--
DROP DATABASE IF EXISTS `testoo_2`;
CREATE DATABASE IF NOT EXISTS `testoo_2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testoo_2`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
                                         `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                         `article_title` varchar(120) NOT NULL,
                                         `article_slug` varchar(125) NOT NULL,
                                         `article_text` text DEFAULT NULL,
                                         `article_date` timestamp NULL DEFAULT current_timestamp(),
                                         `article_visibility` tinyint(1) UNSIGNED DEFAULT 1,
                                         PRIMARY KEY (`id`),
                                         UNIQUE KEY `article_slug` (`article_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `article_title`, `article_slug`, `article_text`, `article_date`, `article_visibility`) VALUES
                                                                                                                        (1, 'Propriétés ACID', 'c688-proprietes-acid', 'En informatique, les propriétés ACID (atomicité, cohérence, isolation et durabilité) sont un ensemble de propriétés qui garantissent qu&#039;une transaction informatique est exécutée de façon fiable.\r\n\r\nDans le domaine des bases de données, une opération sur les données est appelée une transaction ou transaction informatique. Par exemple, un transfert de fonds d&#039;un compte de banque à un autre, même s&#039;il implique plusieurs actions comme le débit d&#039;un compte et le crédit d&#039;un autre, est une seule transaction.\r\n\r\nJim Gray a défini les propriétés qui garantissent des transactions fiables à la fin des années 1970 et a développé des technologies pour les mettre en œuvre automatiquement.\r\n\r\nEn 1983, Andreas Reuter et Theo Härder ont créé l&#039;acronyme ACID pour désigner ces propriétés.\r\n\r\nIl faut noter qu&#039;il existe des modèles de bases de données qui s&#039;écartent des propriétés ACID, pour répondre à d&#039;autres priorités comme la gestion de données massives et distribuées pour les usages du Big Data notamment par les géants d&#039;Internet: ce sont les bases NoSQL', '2025-08-14 15:08:27', 1),
                                                                                                                        (2, 'Structured Query Language', '77dc-structured-query-language', 'SQL (sigle de Structured Query Language, en français langage de requête structurée) est un langage informatique normalisé servant à exploiter des bases de données relationnelles. La partie langage de manipulation des données de SQL permet de rechercher, d&#039;ajouter, de modifier ou de supprimer des données dans les bases de données relationnelles.\r\n\r\nOutre le langage de manipulation des données :\r\n\r\nle langage de définition des données permet de créer et de modifier l&#039;organisation des données dans la base de données,\r\nle langage de contrôle de transaction permet de commencer et de terminer des transactions,\r\nle langage de contrôle des données permet d&#039;autoriser ou d&#039;interdire l&#039;accès à certaines données à certaines personnes.\r\nCréé en 1974, normalisé depuis 1986, le langage est reconnu par la grande majorité des systèmes de gestion de bases de données relationnelles (abrégé SGBDR) du marché.\r\n\r\nSQL fait partie de la même famille que les langages ALPHA (dont il est le descendant), SQUARE, QUEL (intégré à Ingres) ou QBE (Zloof). Il a été appelé SEQUEL à sa naissance, mais ce nom a été changé en SQL du fait que SEQUEL était une marque déposée de l&#039;avionneur Hawker-Siddeley.\r\n\r\nEn juin 1970, Edgar Frank Codd publia l&#039;article A Relational Model of Data for Large Shared Data Banks (« Un référentiel de données relationnel pour de grandes banques de données partagées ») dans la revue Communications of the ACM (Association for Computing Machinery).\r\n\r\nCe référentiel relationnel fondé sur la logique des prédicats du premier ordre a été rapidement reconnu comme un modèle théorique intéressant, pour l&#039;interrogation des bases de données, et a inspiré le développement du langage Structured English QUEry Language (SEQUEL) (« langage d&#039;interrogation structuré en anglais »), renommé ultérieurement SQL pour cause de conflit de marque déposée.\r\n\r\nDéveloppée chez IBM en 1970 par Donald Chamberlin et Raymond Boyce, cette première version a été conçue pour manipuler et éditer des données stockées dans la base de données relationnelle à l&#039;aide du système de gestion de base de données IBM System R. Le nom SEQUEL, qui était déposé commercialement par l&#039;avionneur Hawker Siddeley pour un système d&#039;acquisition de données, a été abandonné et contracté en SQL en 1975. SQL était censé alors devenir un élément clé du futur projet FS.\r\n\r\nEn 1979, Relational Software, Inc. (actuellement Oracle Corporation) présenta la première version commercialement disponible de SQL, rapidement imité par d&#039;autres fournisseurs.\r\n\r\nSQL a été adopté comme recommandation par l&#039;Institut de normalisation américaine (ANSI) en 1986, puis comme norme internationale par l&#039;ISO en 1987 sous le nom de ISO/CEI 9075 - Technologies de l&#039;information - Langages de base de données - SQL.', '2025-08-20 09:10:02', 1),
                                                                                                                        (3, 'MongoDB', 'f7a0-mongodb', 'MongoDB (de l&#039;anglais humongous qui peut être traduit par « énorme ») est un système de gestion de base de données orienté documents, répartissable sur un nombre quelconque d&#039;ordinateurs et ne nécessitant pas de schéma prédéfini des données. Il est écrit en C++. Le serveur et les outils sont distribués sous licence SSPL, les pilotes sous licence Apache et la documentation sous licence Creative Commons. Il fait partie de la mouvance NoSQL.\r\n\r\nMongoDB est développé depuis 2007 par MongoDB. Cette entreprise travaillait alors sur un système de Cloud computing, informatique à données largement réparties, similaire au service Google App Engine de Google.\r\n\r\nIl est depuis devenu un des SGBD les plus utilisés, notamment pour les sites web de Craigslist, eBay, Foursquare, SourceForge.net, Viacom, pagesjaunes et le New York Times.\r\n\r\nMongoDB permet de manipuler des objets structurés au format BSON (JSON binaire), sans schéma prédéterminé. En d&#039;autres termes, des clés peuvent être ajoutées à tout moment « à la volée », sans reconfiguration de la base.\r\n\r\nLes données prennent la forme de documents enregistrés eux-mêmes dans des collections, une collection contenant un nombre quelconque de documents. Les collections sont comparables aux tables, et les documents aux enregistrements des bases de données relationnelles. Contrairement aux bases de données relationnelles, les champs d&#039;un enregistrement sont libres et peuvent être différents d&#039;un enregistrement à un autre au sein d&#039;une même collection. Le seul champ commun et obligatoire est le champ de clé principale («id»). Par ailleurs, MongoDB ne permet ni les requêtes très complexes standardisées, ni les JOIN, mais permet de programmer des requêtes spécifiques en JavaScript.', '2025-09-09 06:36:54', 0);

-- --------------------------------------------------------

--
-- Structure de la table `article_has_category`
--

DROP TABLE IF EXISTS `article_has_category`;
CREATE TABLE IF NOT EXISTS `article_has_category` (
                                                      `article_id` int(10) UNSIGNED NOT NULL,
                                                      `category_id` int(10) UNSIGNED NOT NULL,
                                                      PRIMARY KEY (`article_id`,`category_id`),
                                                      KEY `fk_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article_has_category`
--

INSERT INTO `article_has_category` (`article_id`, `category_id`) VALUES
    (2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
                                          `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `category_name` varchar(80) NOT NULL,
                                          `category_slug` varchar(84) NOT NULL,
                                          `category_desc` varchar(300) DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `category_slug` (`category_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_slug`, `category_desc`) VALUES
    (1, 'SQL', 'sql', 'Langage pour interroger et gérer les bases de données relationnelles.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article_has_category`
--
ALTER TABLE `article_has_category`
    ADD CONSTRAINT `fk_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
