-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2024 at 03:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focus6plushomepage`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactinfo`
--

CREATE TABLE `contactinfo` (
  `id` int NOT NULL,
  `naam` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bericht` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactinfo`
--

INSERT INTO `contactinfo` (`id`, `naam`, `email`, `bericht`) VALUES
(3, 'dhdrh', 'Julia@Julia.com', 'Hallo! Ik ben een mens.');

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `id` int NOT NULL,
  `gebruikersnaam` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `wachtwoord` mediumtext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'arthur', '$2y$10$4tJIfHC2GQsNC.R7f.TPGu0agJ3cV57yu8J3nYqnL/q8bX7PxX67S');

-- --------------------------------------------------------

--
-- Table structure for table `notities`
--

CREATE TABLE `notities` (
  `id` int NOT NULL,
  `notitie` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paginagrid`
--

CREATE TABLE `paginagrid` (
  `id` int NOT NULL,
  `rowPosition` int NOT NULL,
  `columnType` int NOT NULL,
  `pageValue` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginagrid`
--

INSERT INTO `paginagrid` (`id`, `rowPosition`, `columnType`, `pageValue`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 2, 1),
(4, 4, 1, 1),
(5, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paginainfo`
--

CREATE TABLE `paginainfo` (
  `id` int NOT NULL,
  `informatie` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `whichRow` int NOT NULL,
  `colum` int NOT NULL,
  `foto` tinyint(1) DEFAULT '0',
  `backgroundColor` tinyint(1) NOT NULL DEFAULT '0',
  `bold` tinyint(1) NOT NULL DEFAULT '0',
  `italic` tinyint(1) NOT NULL DEFAULT '0',
  `opacity` int NOT NULL DEFAULT '10',
  `kleur` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '#ff0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginainfo`
--

INSERT INTO `paginainfo` (`id`, `informatie`, `whichRow`, `colum`, `foto`, `backgroundColor`, `bold`, `italic`, `opacity`, `kleur`) VALUES
(1, 'IMG_9579.jpeg', 1, 1, 1, 0, 1, 1, 6, '#000000'),
(2, 'Focus6 biedt met haar Spiegelconcept een inspirerende en doeltreffende aanpak voor de ontwikkeling van een lerende organisatie. Ons Spiegelconcept combineert reflectie, actie en groei om teams en organisaties naar een hoger niveau te tillen. Dit innovatieve concept kan eenvoudig worden ingezet op teamniveau, waardoor de focus ligt op directe samenwerking en resultaten. Tegelijkertijd biedt het de flexibiliteit om snel op te schalen naar organisatieniveau, zodat de gehele organisatie kan profiteren van de geleerde inzichten en verbeterde dynamiek.', 2, 1, 0, 0, 0, 0, 10, '#000000'),
(3, 'Wat Focus6 uniek maakt, is dat het Spiegelconcept volledig in de praktijk is ontwikkeld en getest. Het is geen theoretisch model, maar een aanpak die zijn waarde heeft bewezen in echte organisatiesituaties. We geloven sterk in de kracht van teams: een goed functionerend team is de motor van innovatie, samenwerking en groei. In onze visie onderscheidt een team zich wanneer het in staat is om effectief samen te werken, continu te leren van ervaringen, en vernieuwend te zijn om steeds betere prestaties te leveren.', 3, 1, 0, 1, 1, 0, 10, '#000000'),
(4, 'image1.png', 3, 2, 1, 1, 0, 0, 10, '#000000'),
(5, ' Met het Spiegelconcept geven we teams niet alleen de tools om succesvoller te worden, maar ook om als inspiratie te dienen voor de rest van de organisatie. Samen bouwen we aan een cultuur van leren, verbeteren en presteren.', 4, 1, 0, 0, 0, 0, 10, '#000000'),
(6, 'Kortom: focus op succes!', 5, 1, 0, 0, 1, 1, 10, '#009dff');

-- --------------------------------------------------------

--
-- Table structure for table `paginas`
--

CREATE TABLE `paginas` (
  `id` int NOT NULL,
  `paginaNaam` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginas`
--

INSERT INTO `paginas` (`id`, `paginaNaam`) VALUES
(1, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int NOT NULL,
  `naam` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactinfo`
--
ALTER TABLE `contactinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logininfo`
--
ALTER TABLE `logininfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notities`
--
ALTER TABLE `notities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Constraint_FK_klant` (`contact_id`);

--
-- Indexes for table `paginagrid`
--
ALTER TABLE `paginagrid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Constraint_FK_page_type` (`pageValue`);

--
-- Indexes for table `paginainfo`
--
ALTER TABLE `paginainfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Constraint_FK_position` (`whichRow`);

--
-- Indexes for table `paginas`
--
ALTER TABLE `paginas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactinfo`
--
ALTER TABLE `contactinfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logininfo`
--
ALTER TABLE `logininfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notities`
--
ALTER TABLE `notities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paginagrid`
--
ALTER TABLE `paginagrid`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paginainfo`
--
ALTER TABLE `paginainfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notities`
--
ALTER TABLE `notities`
  ADD CONSTRAINT `Constraint_FK_klant` FOREIGN KEY (`contact_id`) REFERENCES `contactinfo` (`id`);

--
-- Constraints for table `paginagrid`
--
ALTER TABLE `paginagrid`
  ADD CONSTRAINT `Constraint_FK_page_type` FOREIGN KEY (`pageValue`) REFERENCES `paginas` (`id`);

--
-- Constraints for table `paginainfo`
--
ALTER TABLE `paginainfo`
  ADD CONSTRAINT `Constraint_FK_position` FOREIGN KEY (`whichRow`) REFERENCES `paginagrid` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
