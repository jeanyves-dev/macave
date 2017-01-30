-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 16 Janvier 2017 à 11:00
-- Version du serveur :  5.5.53-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `macave`
--
CREATE DATABASE IF NOT EXISTS `macave_test03` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `macave_test03`;

-- --------------------------------------------------------

--
-- Structure de la table `acco`
--

CREATE TABLE `acco` (
  `reacco` int(11) NOT NULL,
  `revins` int(11) NOT NULL,
  `replat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `appe`
--

CREATE TABLE `appe` (
  `reappe` int(11) NOT NULL,
  `deappe` varchar(100) NOT NULL,
  `reregi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appe`
--

INSERT INTO `appe` (`reappe`, `deappe`, `reregi`) VALUES
(1, 'Côtes de Thongues', 4),
(2, 'Coteaux du Layon Faye', 3),
(3, 'Beaujolais village', 11),
(4, 'Bugey Manicle Blanc', 9),
(5, 'Bugey blanc', 9),
(6, 'Gigondas', 2),
(7, 'Muscat de Beaumes-de-Venise blanc', 2),
(8, 'Saumur rouge', 3),
(9, 'Bordeaux Rouge', 1),
(10, 'Côtes du Rhône Villages Visan', 2),
(11, 'Côte du Rhône', 2),
(12, 'Roussette de savoie', 8),
(13, 'Vin de table', 4),
(14, 'Arbois', 12),
(15, 'Alsace Granc Cru', 6),
(16, 'Côtes de Gascogne', 5),
(17, 'Autre', 13),
(18, 'Alsace', 6),
(19, 'Coteaux d\'Aix en Provence', 10),
(20, 'Crozes Hermitage', 2),
(21, 'Pays ile de beauté', 14),
(22, 'Beaumes de Venise', 2),
(23, 'Lalande de Pomerol', 1),
(24, 'Hautes côtes de Nuits', 15),
(25, 'Côte Chalonnaise', 15),
(26, 'Pineau des Charentes', 16),
(27, 'Cognac', 16),
(28, 'Vin de pays Charentais', 16),
(29, 'Monbazillac', 5),
(30, 'Saumur Champigny', 3),
(31, 'Jurançon', 5),
(32, 'Rivesaltes', 4),
(33, 'Madiran', 5),
(34, 'Vacqueras', 2),
(35, 'Côtes du Roussillon', 4),
(36, 'Thézac-Perricard', 5),
(37, 'Bouche-du-Rhône', 2),
(38, 'Medoc', 1),
(39, 'Abymes Vin de Savoie', 8),
(40, 'Ardèche', 2),
(41, 'Blaye Cotes de bordeaux', 1),
(42, 'Bordeaux Blanc', 1),
(43, 'Bordeaux Supérieur', 1),
(44, 'Ardèche', 18),
(45, 'Pays d\'oc', 5),
(46, 'Saint-Joseph', 2),
(47, 'Vin de pays de l\'ile de beauté', 14),
(48, 'Languedoc', 4),
(49, 'Vin de savoie', 8),
(50, 'Bugey', 9),
(51, 'Grison', 19),
(52, 'Valais', 20),
(53, 'Tessin', 21),
(54, 'Cerdon', 9),
(55, 'Genève', 22),
(56, 'Vin de pays du Vaucluse', 2),
(57, 'Bergerac', 5),
(58, 'Muscadet Sevre et Maine', 3),
(59, 'Coteaux du Layon', 3),
(60, 'Coteaux de l\'aubance', 3),
(61, 'Gaillac', 5),
(62, 'Coteaux Varois en Provence', 10),
(63, 'Bourgogne', 15),
(64, 'Bourgogne Aligoté', 15),
(65, 'Cotes de Bergerac blanc', 5),
(66, 'Cotes de Bergerac blanc', 5),
(67, 'Pays d\'Oc', 4),
(68, 'Gewurztraminer', 6);

-- --------------------------------------------------------

--
-- Structure de la table `appr`
--

CREATE TABLE `appr` (
  `reappr` int(11) NOT NULL,
  `deappr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appr`
--

INSERT INTO `appr` (`reappr`, `deappr`) VALUES
(1, ''),
(2, 'Excellent'),
(3, 'Mauvais');

-- --------------------------------------------------------

--
-- Structure de la table `bout`
--

CREATE TABLE `bout` (
  `rebout` int(11) NOT NULL,
  `revins` int(11) NOT NULL,
  `regaba` int(11) NOT NULL,
  `anmile` int(4) NOT NULL,
  `anapog` int(4) NOT NULL,
  `anaboi` int(4) NOT NULL,
  `bonote` int(2) NOT NULL,
  `degres` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `casi`
--

CREATE TABLE `casi` (
  `recasi` int(11) NOT NULL,
  `decasi` varchar(50) NOT NULL,
  `recolo` int(11) NOT NULL,
  `nbrlig` int(11) NOT NULL,
  `nbrcol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cepa`
--

CREATE TABLE `cepa` (
  `recepa` int(11) NOT NULL,
  `decepa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cepa`
--

INSERT INTO `cepa` (`recepa`, `decepa`) VALUES
(1, 'Cabernet'),
(2, 'Syrah'),
(3, 'Grenache'),
(4, 'Sauvignon'),
(5, 'Merlot'),
(6, 'Gros Manseng'),
(7, 'Gewurztraminer'),
(8, 'Petit Manseng'),
(9, 'Trousseau'),
(10, 'Muscat'),
(11, 'Counoise'),
(12, 'Vermentino'),
(13, 'Grenache Blanc'),
(14, 'Clairette '),
(15, 'Cabernet Franc'),
(16, 'Melon Blanc'),
(17, 'Melon B');

-- --------------------------------------------------------

--
-- Structure de la table `cepv`
--

CREATE TABLE `cepv` (
  `revins` int(11) NOT NULL,
  `recepa` int(11) NOT NULL,
  `qtcepv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `clas`
--

CREATE TABLE `clas` (
  `reclas` int(11) NOT NULL,
  `declas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clas`
--

INSERT INTO `clas` (`reclas`, `declas`) VALUES
(1, ''),
(2, 'AOC'),
(3, 'IGP'),
(4, 'AOP'),
(5, 'Vin de pays'),
(6, 'DOC');

-- --------------------------------------------------------

--
-- Structure de la table `colo`
--

CREATE TABLE `colo` (
  `recolo` int(11) NOT NULL,
  `decolo` varchar(50) NOT NULL,
  `reempl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conc`
--

CREATE TABLE `conc` (
  `reconc` int(11) NOT NULL,
  `deconc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `coul`
--

CREATE TABLE `coul` (
  `recoul` int(11) NOT NULL,
  `decoul` varchar(20) NOT NULL,
  `cocoul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `coul`
--

INSERT INTO `coul` (`recoul`, `decoul`, `cocoul`) VALUES
(1, 'Rouge', '../img/rouge.png'),
(2, 'Blanc', '../img/blanc.png'),
(3, 'Rosé', '../img/rose.png'),
(4, 'Champagne', ''),
(5, 'Pétillant Rosé', '');

-- --------------------------------------------------------

--
-- Structure de la table `degl`
--

CREATE TABLE `degl` (
  `redegl` int(11) NOT NULL,
  `redegu` int(11) NOT NULL,
  `rebout` int(11) NOT NULL,
  `visuel` text NOT NULL,
  `odorat` text NOT NULL,
  `bouche` text NOT NULL,
  `codegl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `degu`
--

CREATE TABLE `degu` (
  `redegu` int(11) NOT NULL,
  `nodegu` varchar(60) NOT NULL,
  `dadegu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `empl`
--

CREATE TABLE `empl` (
  `reempl` int(11) NOT NULL,
  `deempl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `four`
--

CREATE TABLE `four` (
  `refour` int(11) NOT NULL,
  `defour` varchar(50) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `adresb` varchar(100) NOT NULL,
  `codpos` varchar(10) NOT NULL,
  `villef` varchar(50) NOT NULL,
  `numtel` varchar(20) NOT NULL,
  `numfax` varchar(20) NOT NULL,
  `admail` varchar(100) NOT NULL,
  `sitweb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gaba`
--

CREATE TABLE `gaba` (
  `regaba` int(11) NOT NULL,
  `degaba` varchar(50) NOT NULL,
  `conten` decimal(11,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gaba`
--

INSERT INTO `gaba` (`regaba`, `degaba`, `conten`) VALUES
(1, 'Bouteille', '0.750'),
(2, 'Magnum', '1.500'),
(3, 'Fillette', '0.375'),
(4, 'Clavelin', '0.620');

-- --------------------------------------------------------

--
-- Structure de la table `meda`
--

CREATE TABLE `meda` (
  `remeda` int(11) NOT NULL,
  `revins` int(11) NOT NULL,
  `reconc` int(11) NOT NULL,
  `nimeda` varchar(50) NOT NULL,
  `period` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mens`
--

CREATE TABLE `mens` (
  `remens` int(11) NOT NULL,
  `demens` varchar(50) NOT NULL,
  `remenu` int(11) NOT NULL,
  `limenu` varchar(100) NOT NULL,
  `norang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `mens`

INSERT INTO `mens` (`remens`, `demens`, `remenu`, `limenu`, `norang`) VALUES
(1, 'Les vins', 2, '../liste/vins.liste.php', 1),
(2, 'Mes bouteilles', 2, '../liste/bout.liste.php', 2),
(3, 'Pays', 8, '../liste/pays.liste.php', 1),
(4, 'Region', 8, '../liste/regi.liste.php', 2),
(5, 'Appellation', 8, '../liste/appe.liste.php', 3),
(6, 'Couleurs', 8, '../liste/coul.liste.php', 4),
(7, 'Type de vins', 8, '../liste/typv.liste.php', 5),
(8, 'Classement', 8, '../liste/clas.liste.php', 6),
(9, 'Cepages', 8, '../liste/cepa.liste.php', 7),
(10, 'Gabarit', 8, '../liste/gaba.liste.php', 8),
(11, 'Producteur', 8, '../liste/prod.liste.php', 9),
(12, 'Fournisseur', 8, '../liste/four.liste.php', 10),
(13, 'Categorie RDV', 8, '../liste/rdvc.liste.php', 11),
(14, 'Type de recette', 8, '../liste/rect.liste.php', 12),
(15, 'Plat', 8, '../liste/plat.liste.php', 13),
(30, 'Appréciation', 8, '../liste/appr.liste.php', 14),
(16, 'Inventaire', 2, '../liste/boutb.liste.php', 3),
(17, 'Les entrées', 2, '../liste/mven.liste.php', 4),
(18, 'Les sorties', 2, '../liste/mvso.liste.php', 5),
(19, 'Les vins à boire', 3, '../liste/boutc.liste.php', 1),
(20, 'Calendrier de conso', 3, '../liste/boutd.liste.php', 2),
(21, 'Historique', 3, '', 3),
(22, 'Recette', 2, '../liste/rece.liste.php', 7),
(23, 'Accord', 2, '../liste/acco.liste.php', 8),
(24, 'Dégustation', 2, '../liste/degu.liste.php', 9),
(25, 'Menu', 9, '../liste/menu.liste.php', 1),
(26, 'Sous menu', 9, '../liste/mens.liste.php', 2),
(27, 'Tabelles', 9, '../liste/tbsd.liste.php', 4),
(28, 'Créer classe', 9, '../admin/Generer.frm.php', 5),
(29, 'Entete tabelle', 9, '../liste/tbse.liste.php', 3);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `remenu` int(11) NOT NULL,
  `demenu` varchar(50) NOT NULL,
  `limenu` varchar(100) NOT NULL,
  `norang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`remenu`, `demenu`, `limenu`, `norang`) VALUES
(1, 'Accueil', '../index/accueil.php', 1),
(2, 'Gestion', '../index/gestion.php', 2),
(3, 'Echéancier', '../index/Echeancier.php', 3),
(4, 'Rangement', '', 4),
(5, 'Calendrier', '', 5),
(6, 'Statistiques', '../stat/stat.menu.php', 6),
(7, 'Impression', '', 7),
(8, 'Paramétrage', '../index/parametrage.php', 8),
(9, 'Administration', '../index/admin.php', 9);

-- --------------------------------------------------------

--
-- Structure de la table `mvel`
--

CREATE TABLE `mvel` (
  `remvel` int(11) NOT NULL,
  `remven` int(11) NOT NULL,
  `rebout` int(11) NOT NULL,
  `nomvel` varchar(100) NOT NULL,
  `qtmvel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mven`
--

CREATE TABLE `mven` (
  `remven` int(11) NOT NULL,
  `damven` date NOT NULL,
  `refour` int(11) NOT NULL,
  `nomven` varchar(100) NOT NULL,
  `canapp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mvsl`
--

CREATE TABLE `mvsl` (
  `remvsl` int(11) NOT NULL,
  `remvso` int(11) NOT NULL,
  `rebout` int(11) NOT NULL,
  `nomvsl` varchar(100) NOT NULL,
  `qtmvsl` int(11) NOT NULL,
  `reappr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mvso`
--

CREATE TABLE `mvso` (
  `remvso` int(11) NOT NULL,
  `damvso` date NOT NULL,
  `nomvso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `opts`
--

CREATE TABLE `opts` (
  `reopts` int(11) NOT NULL,
  `deopts` varchar(50) NOT NULL,
  `vaopts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `repays` int(11) NOT NULL,
  `depays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`repays`, `depays`) VALUES
(1, 'France'),
(2, 'Suisse'),
(3, 'Espagne'),
(4, 'Italie');

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `replat` int(11) NOT NULL,
  `deplat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prod`
--

CREATE TABLE `prod` (
  `reprod` int(11) NOT NULL,
  `deprod` varchar(100) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `adresb` varchar(100) NOT NULL,
  `codpos` varchar(10) NOT NULL,
  `villep` varchar(50) NOT NULL,
  `typrop` varchar(10) NOT NULL,
  `admail` varchar(100) NOT NULL,
  `adrweb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

CREATE TABLE `rang` (
  `rerang` int(11) NOT NULL,
  `recasi` int(11) NOT NULL,
  `rebout` int(11) NOT NULL,
  `poslig` int(11) NOT NULL,
  `poscol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rdvc`
--

CREATE TABLE `rdvc` (
  `rerdvc` int(11) NOT NULL,
  `derdvc` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rdvo`
--

CREATE TABLE `rdvo` (
  `reredv` int(11) NOT NULL,
  `deredv` varchar(50) NOT NULL,
  `datdeb` date NOT NULL,
  `heudeb` time NOT NULL,
  `datfin` date NOT NULL,
  `heufin` time NOT NULL,
  `notrdv` text NOT NULL,
  `cardvo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rece`
--

CREATE TABLE `rece` (
  `rerece` int(11) NOT NULL,
  `derece` varchar(100) NOT NULL,
  `rerect` int(11) NOT NULL,
  `replat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rect`
--

CREATE TABLE `rect` (
  `rerect` int(11) NOT NULL,
  `derect` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `regi`
--

CREATE TABLE `regi` (
  `reregi` int(11) NOT NULL,
  `deregi` varchar(50) NOT NULL,
  `repays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `regi`
--

INSERT INTO `regi` (`reregi`, `deregi`, `repays`) VALUES
(1, 'Bordeaux', 1),
(2, 'Vallée du Rhône', 1),
(3, 'Vallée de la loire', 1),
(4, 'Languedoc-Roussillon', 1),
(5, 'Sud-Ouest', 1),
(6, 'Alsace', 1),
(7, 'Lorraine', 1),
(8, 'Savoie', 1),
(9, 'Bugey', 1),
(10, 'Provence', 1),
(11, 'Beaujolais', 1),
(12, 'Jura', 1),
(13, 'Barcelone', 3),
(14, 'Corse', 1),
(15, 'Bourgogne', 1),
(16, 'Cognac', 1),
(17, 'Autre', 4),
(18, 'Ardèche', 1),
(19, 'Grison', 2),
(20, 'Valais', 2),
(21, 'Tessin', 2),
(22, 'Genève', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tari`
--

CREATE TABLE `tari` (
  `retari` int(11) NOT NULL,
  `rebout` int(11) NOT NULL,
  `mtbout` decimal(10,2) NOT NULL,
  `datari` date NOT NULL,
  `tytari` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tbsd`
--

CREATE TABLE `tbsd` (
  `codtab` varchar(6) NOT NULL,
  `retbsd` varchar(10) NOT NULL,
  `detbsd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbsd`
--

INSERT INTO `tbsd` (`codtab`, `retbsd`, `detbsd`) VALUES
('tytari', '01', 'Entrée de stock'),
('tytari', '02', 'Manuel'),
('canapp', '01', 'Salon'),
('canapp', '02', 'Cadeau'),
('canapp', '03', 'Coopérative'),
('canapp', '04', 'Revendeur de vin'),
('canapp', '05', 'Supermarché'),
('canapp', '00', ''),
('canapp', '06', 'Agri Sud Est'),
('canapp', '07', 'Magasin bio'),
('canapp', '08', 'Repas'),
('canapp', '09', 'Producteur'),
('nimeda', '01', ''),
('nimeda', '02', 'Médaille OR'),
('nimeda', '03', 'Médaille ARGENT'),
('nimeda', '04', 'Médaille BRONZE'),
('nimeda', '05', 'Récompensé'),
('nimeda', '06', 'Participant'),
('canapp', '10', 'Inventaire'),
('typrop', '01', 'Domaine'),
('typrop', '02', 'Chateau'),
('typrop', '00', ''),
('typrop', '03', 'Vignoble'),
('typrop', '04', 'Gaec');

-- --------------------------------------------------------

--
-- Structure de la table `tbse`
--

CREATE TABLE `tbse` (
  `retbse` int(11) NOT NULL,
  `codtab` varchar(6) NOT NULL,
  `detbse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbse`
--

INSERT INTO `tbse` (`retbse`, `codtab`, `detbse`) VALUES
(1, 'tytari', 'Type de tarif'),
(2, 'canapp', 'Canal d\'approvisionnement'),
(3, 'nimeda', 'Niveau médaille'),
(4, 'typrop', 'Type de propriété');

-- --------------------------------------------------------

--
-- Structure de la table `trie`
--

CREATE TABLE `trie` (
  `retabl` varchar(20) NOT NULL,
  `champs` varchar(11) NOT NULL,
  `senstr` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `trie`
--

INSERT INTO `trie` (`retabl`, `champs`, `senstr`) VALUES
('regi', 'deregi', 'DESC'),
('vins', 'vins.devins', 'ASC');

-- --------------------------------------------------------

--
-- Structure de la table `typv`
--

CREATE TABLE `typv` (
  `retypv` int(11) NOT NULL,
  `detypv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typv`
--

INSERT INTO `typv` (`retypv`, `detypv`) VALUES
(1, ''),
(2, 'Vin'),
(3, 'Champagne'),
(4, 'Eau de vie'),
(5, 'Pétillant');

-- --------------------------------------------------------

--
-- Structure de la table `vins`
--

CREATE TABLE `vins` (
  `revins` int(11) NOT NULL,
  `devins` varchar(50) NOT NULL,
  `repays` int(11) NOT NULL,
  `reregi` int(11) NOT NULL,
  `reappe` int(11) NOT NULL,
  `reprod` int(11) NOT NULL,
  `recoul` int(11) NOT NULL,
  `favori` tinyint(1) NOT NULL,
  `retypv` int(11) NOT NULL,
  `reclas` int(11) NOT NULL,
  `cuvins` varchar(100) NOT NULL,
  `devinb` varchar(100) NOT NULL,
  `imvins` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acco`
--
ALTER TABLE `acco`
  ADD PRIMARY KEY (`reacco`),
  ADD KEY `revins` (`revins`,`replat`);

--
-- Index pour la table `appe`
--
ALTER TABLE `appe`
  ADD PRIMARY KEY (`reappe`),
  ADD KEY `reregi` (`reregi`);

--
-- Index pour la table `appr`
--
ALTER TABLE `appr`
  ADD PRIMARY KEY (`reappr`);

--
-- Index pour la table `bout`
--
ALTER TABLE `bout`
  ADD PRIMARY KEY (`rebout`),
  ADD KEY `revins` (`revins`,`anmile`,`anapog`,`anaboi`,`bonote`),
  ADD KEY `regaba` (`regaba`);

--
-- Index pour la table `casi`
--
ALTER TABLE `casi`
  ADD PRIMARY KEY (`recasi`),
  ADD KEY `recolo` (`recolo`,`nbrlig`),
  ADD KEY `nbrcol` (`nbrcol`);

--
-- Index pour la table `cepa`
--
ALTER TABLE `cepa`
  ADD PRIMARY KEY (`recepa`);

--
-- Index pour la table `cepv`
--
ALTER TABLE `cepv`
  ADD KEY `revins` (`revins`,`recepa`);

--
-- Index pour la table `clas`
--
ALTER TABLE `clas`
  ADD PRIMARY KEY (`reclas`);

--
-- Index pour la table `colo`
--
ALTER TABLE `colo`
  ADD PRIMARY KEY (`recolo`),
  ADD KEY `reempl` (`reempl`);

--
-- Index pour la table `conc`
--
ALTER TABLE `conc`
  ADD PRIMARY KEY (`reconc`);

--
-- Index pour la table `coul`
--
ALTER TABLE `coul`
  ADD PRIMARY KEY (`recoul`);

--
-- Index pour la table `degl`
--
ALTER TABLE `degl`
  ADD PRIMARY KEY (`redegl`),
  ADD KEY `redegu` (`redegu`,`rebout`);

--
-- Index pour la table `degu`
--
ALTER TABLE `degu`
  ADD PRIMARY KEY (`redegu`),
  ADD KEY `dadegu` (`dadegu`);

--
-- Index pour la table `empl`
--
ALTER TABLE `empl`
  ADD PRIMARY KEY (`reempl`);

--
-- Index pour la table `four`
--
ALTER TABLE `four`
  ADD PRIMARY KEY (`refour`);

--
-- Index pour la table `gaba`
--
ALTER TABLE `gaba`
  ADD PRIMARY KEY (`regaba`);

--
-- Index pour la table `meda`
--
ALTER TABLE `meda`
  ADD PRIMARY KEY (`remeda`),
  ADD KEY `rebout` (`revins`,`reconc`,`nimeda`,`period`);

--
-- Index pour la table `mens`
--
ALTER TABLE `mens`
  ADD PRIMARY KEY (`remens`),
  ADD KEY `remenu` (`remenu`),
  ADD KEY `limenu` (`limenu`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`remenu`),
  ADD KEY `limenu` (`limenu`),
  ADD KEY `norang` (`norang`);

--
-- Index pour la table `mvel`
--
ALTER TABLE `mvel`
  ADD PRIMARY KEY (`remvel`),
  ADD KEY `remven` (`remven`,`rebout`);

--
-- Index pour la table `mven`
--
ALTER TABLE `mven`
  ADD PRIMARY KEY (`remven`),
  ADD KEY `damven` (`damven`),
  ADD KEY `refour` (`refour`),
  ADD KEY `canapp` (`canapp`);

--
-- Index pour la table `mvsl`
--
ALTER TABLE `mvsl`
  ADD PRIMARY KEY (`remvsl`),
  ADD KEY `remvso` (`remvso`,`rebout`,`reappr`);

--
-- Index pour la table `mvso`
--
ALTER TABLE `mvso`
  ADD PRIMARY KEY (`remvso`),
  ADD KEY `damvso` (`damvso`);

--
-- Index pour la table `opts`
--
ALTER TABLE `opts`
  ADD PRIMARY KEY (`reopts`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`repays`);

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`replat`);

--
-- Index pour la table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`reprod`),
  ADD KEY `typrop` (`typrop`);

--
-- Index pour la table `rang`
--
ALTER TABLE `rang`
  ADD PRIMARY KEY (`rerang`),
  ADD KEY `recasi` (`recasi`,`rebout`);

--
-- Index pour la table `rdvc`
--
ALTER TABLE `rdvc`
  ADD PRIMARY KEY (`rerdvc`);

--
-- Index pour la table `rdvo`
--
ALTER TABLE `rdvo`
  ADD PRIMARY KEY (`reredv`),
  ADD KEY `cardvo` (`cardvo`);

--
-- Index pour la table `rece`
--
ALTER TABLE `rece`
  ADD PRIMARY KEY (`rerece`),
  ADD KEY `rerect` (`rerect`,`replat`);

--
-- Index pour la table `rect`
--
ALTER TABLE `rect`
  ADD PRIMARY KEY (`rerect`);

--
-- Index pour la table `regi`
--
ALTER TABLE `regi`
  ADD PRIMARY KEY (`reregi`),
  ADD KEY `repays` (`repays`);

--
-- Index pour la table `tari`
--
ALTER TABLE `tari`
  ADD PRIMARY KEY (`retari`),
  ADD KEY `rebout` (`rebout`,`datari`,`tytari`);

--
-- Index pour la table `tbsd`
--
ALTER TABLE `tbsd`
  ADD KEY `codtab` (`codtab`,`retbsd`);

--
-- Index pour la table `tbse`
--
ALTER TABLE `tbse`
  ADD PRIMARY KEY (`retbse`),
  ADD KEY `codtab` (`codtab`);

--
-- Index pour la table `trie`
--
ALTER TABLE `trie`
  ADD KEY `retabl` (`retabl`,`champs`,`senstr`);

--
-- Index pour la table `typv`
--
ALTER TABLE `typv`
  ADD PRIMARY KEY (`retypv`);

--
-- Index pour la table `vins`
--
ALTER TABLE `vins`
  ADD PRIMARY KEY (`revins`),
  ADD KEY `repays` (`repays`),
  ADD KEY `reregi` (`reregi`,`reappe`,`reprod`,`recoul`),
  ADD KEY `favori` (`favori`),
  ADD KEY `retypv` (`retypv`,`reclas`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acco`
--
ALTER TABLE `acco`
  MODIFY `reacco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `appe`
--
ALTER TABLE `appe`
  MODIFY `reappe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `appr`
--
ALTER TABLE `appr`
  MODIFY `reappr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `bout`
--
ALTER TABLE `bout`
  MODIFY `rebout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT pour la table `casi`
--
ALTER TABLE `casi`
  MODIFY `recasi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cepa`
--
ALTER TABLE `cepa`
  MODIFY `recepa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `clas`
--
ALTER TABLE `clas`
  MODIFY `reclas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `colo`
--
ALTER TABLE `colo`
  MODIFY `recolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `conc`
--
ALTER TABLE `conc`
  MODIFY `reconc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `coul`
--
ALTER TABLE `coul`
  MODIFY `recoul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `degl`
--
ALTER TABLE `degl`
  MODIFY `redegl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `degu`
--
ALTER TABLE `degu`
  MODIFY `redegu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `empl`
--
ALTER TABLE `empl`
  MODIFY `reempl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `four`
--
ALTER TABLE `four`
  MODIFY `refour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `gaba`
--
ALTER TABLE `gaba`
  MODIFY `regaba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `meda`
--
ALTER TABLE `meda`
  MODIFY `remeda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `mens`
--
ALTER TABLE `mens`
  MODIFY `remens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `remenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `mvel`
--
ALTER TABLE `mvel`
  MODIFY `remvel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT pour la table `mven`
--
ALTER TABLE `mven`
  MODIFY `remven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `mvsl`
--
ALTER TABLE `mvsl`
  MODIFY `remvsl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT pour la table `mvso`
--
ALTER TABLE `mvso`
  MODIFY `remvso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pour la table `opts`
--
ALTER TABLE `opts`
  MODIFY `reopts` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `repays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `replat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `prod`
--
ALTER TABLE `prod`
  MODIFY `reprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `rang`
--
ALTER TABLE `rang`
  MODIFY `rerang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rdvc`
--
ALTER TABLE `rdvc`
  MODIFY `rerdvc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rdvo`
--
ALTER TABLE `rdvo`
  MODIFY `reredv` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rece`
--
ALTER TABLE `rece`
  MODIFY `rerece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `rect`
--
ALTER TABLE `rect`
  MODIFY `rerect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `regi`
--
ALTER TABLE `regi`
  MODIFY `reregi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `tari`
--
ALTER TABLE `tari`
  MODIFY `retari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `tbse`
--
ALTER TABLE `tbse`
  MODIFY `retbse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `typv`
--
ALTER TABLE `typv`
  MODIFY `retypv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `vins`
--
ALTER TABLE `vins`
  MODIFY `revins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
