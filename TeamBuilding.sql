-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2023 at 10:46 PM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TeamBuilding`
--

-- --------------------------------------------------------

--
-- Table structure for table `activite`
--

CREATE TABLE `activite` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `nbmax` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activite`
--

INSERT INTO `activite` (`id`, `nom`, `nbmax`) VALUES
(1, 'Atelier cuisine', 15),
(2, 'Simulation de courses (jeux sur console)', 6),
(3, 'Course de karting', 12),
(4, 'Escape Game', 16),
(5, 'Ne participe pas', 20);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(10, 'petrucci@dream.us', '$2y$10$wvlKx1Ohlgi9H/oZ7.0Z0e/9Cr5J7nHNpVvu/bxXKbLE74TjoFI8O'),
(11, 'jason@newstead.ca', '$2y$10$ksE.K0Xhx2ycqY0Ia5y.be7JIVdru6sdasmI5bLnpqf75E.5TZ1BC'),
(13, 'raphaelv@ifosup.be', '$2y$10$sp4zEJL78Z8JuVE5kCHDHOChVE4hhFXJWru1duIb5FbCuelSw2vNq');

-- --------------------------------------------------------

--
-- Table structure for table `cp`
--

CREATE TABLE `cp` (
  `id` smallint NOT NULL,
  `cp` smallint NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cp`
--

INSERT INTO `cp` (`id`, `cp`, `nom`) VALUES
(1, 1300, 'Wavre'),
(2, 1301, 'Bierge'),
(3, 1310, 'La Hulpe');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, 'Comptabilité'),
(2, 'R&D'),
(3, 'ICT'),
(4, 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `souper` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fk_cp` smallint NOT NULL,
  `fk_locomotion` int NOT NULL,
  `fk_departement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`id`, `nom`, `prenom`, `mail`, `souper`, `fk_cp`, `fk_locomotion`, `fk_departement`) VALUES
(16, 'Holland', 'Dexter', 'theoffspring@smash.us', 'oui', 2, 2, 4),
(17, 'Hans', 'zimmer', 'zim@zim.de', 'non', 3, 1, 1),
(18, 'Kursh', 'Hansi', 'kush@blind.de', 'non', 2, 1, 2),
(19, 'Lione', 'Fabio', 'Rhapsody@fire.it', 'non', 2, 1, 1),
(20, 'Lione', 'Fabio', 'Rhapsody@fire.it', 'non', 2, 1, 1),
(22, 'Kursh', 'Ansi', 'azer@rte.com', 'oui', 2, 2, 4),
(23, 'Lucassen', 'Arjen', 'ayreon@outlook.de', 'non', 3, 2, 2),
(24, 'Lucassen', 'Arjen', 'ayreon@outlook.de', 'non', 2, 2, 3),
(25, 'sonata', 'artica', 'arctica@outlook.com', 'oui', 2, 2, 3),
(26, 'Michael', 'Kane', 'kane@gmail.com', 'oui', 1, 2, 3),
(27, 'Shaffer', 'John', 'johnshaffer@iced.earth', 'non', 2, 2, 2),
(28, 'King', 'Kerry', 'slayer@trash.us', 'non', 1, 1, 4),
(29, 'Araya', 'Tom', 'slayer@trash.us', 'oui', 2, 2, 2),
(30, 'Gossow', 'Angelz', 'arch@enemy.de', 'non', 2, 1, 3),
(31, 'Hammet', 'Kurk', 'larsulrich@metalic.ca', 'non', 1, 1, 4),
(32, 'Mast', 'todon', 'mast@todon.us', 'non', 2, 1, 2),
(37, 'er', 'ee', 'azer@rte.com', 'non', 1, 2, 4),
(39, 't', 'r', 'e@rker.gf', 'non', 1, 1, 3),
(41, 'dalriada', 'dfe', 'davemurray@maiden.uk', 'non', 1, 1, 3),
(42, 'reer', 'eze', 'larsulrich@metalic.ca', 'non', 2, 2, 2),
(43, 'ethan', 'hunt', 'ethan@metalic.ca', 'oui', 2, 3, 2),
(44, 'damon', 'drift', 'larsulri@metalic.ca', 'oui', 2, 1, 3),
(46, 'ds', 'sd', 'larsulrich@metalic.ca', 'non', 1, 1, 2),
(48, 'eraezra', 'zearrzae', 'axelrose@guns.us', 'oui', 2, 2, 3),
(50, 'ffg', 'ggdf', 'axelroso@guns.us', 'non', 1, 2, 2),
(52, 'Tankian', 'Serj', 'serj@system.down', 'non', 1, 2, 2),
(53, 'Daaron', 'Malakian', 'rpr@errr.po', 'non', 1, 1, 3),
(64, 'Smith', 'Adrian', 'adriansmith@maiden.uk', 'non', 2, 1, 4),
(65, 'Geers', 'Jannick', 'jannickgeers@maiden.uk', 'oui', 2, 1, 4),
(66, 'Young', 'Angus', 'ac@dc.au', 'oui', 2, 2, 3),
(67, 'Myung', 'John', 'dream@theater.us', 'oui', 2, 2, 3),
(68, 'Rudess', 'Jordan', 'jordan@key.us', 'non', 1, 1, 3),
(69, 'Portnoy', 'Mike', 'mike@dt.us', 'oui', 3, 2, 2),
(70, 'Petrucci', 'John', 'john@gmail.ud', 'oui', 2, 2, 2),
(71, 'King', 'Kerry', 'slayer@raining.re', 'non', 2, 2, 3),
(72, 'Bertels', 'Jeff', 'Bertels@outlook.be', 'oui', 2, 3, 3),
(73, 'Laiho', 'Alexi', 'bodom@gmail.com', 'non', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employe_activite`
--

CREATE TABLE `employe_activite` (
  `id` int NOT NULL,
  `fk_activite` int NOT NULL,
  `fk_employe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employe_activite`
--

INSERT INTO `employe_activite` (`id`, `fk_activite`, `fk_employe`) VALUES
(14, 5, 16),
(15, 4, 17),
(16, 2, 18),
(17, 4, 19),
(18, 4, 20),
(19, 3, 23),
(20, 4, 24),
(21, 1, 25),
(22, 5, 26),
(23, 1, 27),
(24, 2, 28),
(25, 1, 29),
(26, 5, 30),
(27, 3, 44),
(30, 1, 48),
(31, 3, 44),
(32, 3, 44),
(34, 2, 50),
(36, 5, 52),
(37, 1, 53),
(48, 5, 64),
(49, 5, 65),
(50, 2, 66),
(51, 1, 67),
(52, 5, 68),
(53, 2, 69),
(54, 2, 70),
(55, 4, 71),
(56, 4, 72),
(57, 3, 73);

-- --------------------------------------------------------

--
-- Table structure for table `Locomotion`
--

CREATE TABLE `Locomotion` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Locomotion`
--

INSERT INTO `Locomotion` (`id`, `nom`) VALUES
(1, 'Voiture'),
(2, 'Train'),
(3, 'Bus'),
(4, 'Vélo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp`
--
ALTER TABLE `cp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cp` (`fk_cp`),
  ADD KEY `fk_locomotion` (`fk_locomotion`),
  ADD KEY `fk_departement` (`fk_departement`);

--
-- Indexes for table `employe_activite`
--
ALTER TABLE `employe_activite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activite` (`fk_activite`),
  ADD KEY `fk_employe` (`fk_employe`);

--
-- Indexes for table `Locomotion`
--
ALTER TABLE `Locomotion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activite`
--
ALTER TABLE `activite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cp`
--
ALTER TABLE `cp`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `employe_activite`
--
ALTER TABLE `employe_activite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `Locomotion`
--
ALTER TABLE `Locomotion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`fk_departement`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`fk_locomotion`) REFERENCES `Locomotion` (`id`),
  ADD CONSTRAINT `employe_ibfk_3` FOREIGN KEY (`fk_cp`) REFERENCES `cp` (`id`);

--
-- Constraints for table `employe_activite`
--
ALTER TABLE `employe_activite`
  ADD CONSTRAINT `employe_activite_ibfk_1` FOREIGN KEY (`fk_activite`) REFERENCES `activite` (`id`),
  ADD CONSTRAINT `employe_activite_ibfk_2` FOREIGN KEY (`fk_employe`) REFERENCES `employe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
