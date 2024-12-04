-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 09:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `focus6`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactinfo`
--

CREATE TABLE `contactinfo` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bericht` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `id` int(11) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'admin', '$2y$10$AYL/dfvt3afDg2H3n0erB.ClRJ3zRE7KNLup5evNGY9c3B2EL8bm.'),
(2, '22', '$2y$10$tACGBlX.sCQDGXdzWgz5Vu/z/HonpyPgURyurwQiNrkK7jhoYZd1u');

-- --------------------------------------------------------

--
-- Table structure for table `notities`
--

CREATE TABLE `notities` (
  `id` int(11) NOT NULL,
  `notitie` varchar(500) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paginagrid`
--

CREATE TABLE `paginagrid` (
  `id` int(11) NOT NULL,
  `rowPosition` int(11) NOT NULL,
  `columnType` int(11) NOT NULL,
  `pageValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginagrid`
--

INSERT INTO `paginagrid` (`id`, `rowPosition`, `columnType`, `pageValue`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 2, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 1, 1, 2),
(7, 2, 1, 2),
(8, 3, 1, 2),
(10, 5, 3, 2),
(12, 6, 1, 2),
(13, 7, 2, 2),
(14, 1, 4, 3),
(15, 2, 4, 3),
(16, 3, 4, 3),
(17, 4, 4, 3),
(18, 5, 4, 3),
(19, 6, 4, 3),
(20, 7, 4, 3),
(21, 8, 4, 3),
(22, 9, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `paginainfo`
--

CREATE TABLE `paginainfo` (
  `id` int(11) NOT NULL,
  `informatie` varchar(1000) NOT NULL,
  `whichRow` int(11) NOT NULL,
  `colum` int(11) NOT NULL,
  `foto` tinyint(1) DEFAULT 0,
  `backgroundColor` tinyint(1) NOT NULL DEFAULT 0,
  `bold` tinyint(1) NOT NULL DEFAULT 0,
  `italic` tinyint(1) NOT NULL DEFAULT 0,
  `opacity` int(11) NOT NULL DEFAULT 10,
  `kleur` varchar(10) NOT NULL DEFAULT '#ff000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginainfo`
--

INSERT INTO `paginainfo` (`id`, `informatie`, `whichRow`, `colum`, `foto`, `backgroundColor`, `bold`, `italic`, `opacity`, `kleur`) VALUES
(1, 'IMG_9579.jpeg', 1, 1, 1, 0, 0, 0, 6, '#000000'),
(2, 'Focus6 biedt met haar Spiegelconcept een inspirerende en doeltreffende aanpak voor de ontwikkeling van een lerende organisatie. Ons Spiegelconcept combineert reflectie, actie en groei om teams en organisaties naar een hoger niveau te tillen. Dit innovatieve concept kan eenvoudig worden ingezet op teamniveau, waardoor de focus ligt op directe samenwerking en resultaten. Tegelijkertijd biedt het de flexibiliteit om snel op te schalen naar organisatieniveau, zodat de gehele organisatie kan profiteren van de geleerde inzichten en verbeterde dynamiek.', 2, 1, 0, 0, 0, 0, 10, '#000000'),
(3, 'Wat Focus6 uniek maakt, is dat het Spiegelconcept volledig in de praktijk is ontwikkeld en getest. Het is geen theoretisch model, maar een aanpak die zijn waarde heeft bewezen in echte organisatiesituaties. We geloven sterk in de kracht van teams: een goed functionerend team is de motor van innovatie, samenwerking en groei. In onze visie onderscheidt een team zich wanneer het in staat is om effectief samen te werken, continu te leren van ervaringen, en vernieuwend te zijn om steeds betere prestaties te leveren.', 3, 1, 0, 1, 1, 0, 10, '#000000'),
(4, 'image1.png', 3, 2, 1, 1, 0, 0, 10, '#000000'),
(5, ' Met het Spiegelconcept geven we teams niet alleen de tools om succesvoller te worden, maar ook om als inspiratie te dienen voor de rest van de organisatie. Samen bouwen we aan een cultuur van leren, verbeteren en presteren.', 4, 1, 0, 0, 0, 0, 10, '#000000'),
(6, 'Kortom: focus op succes!', 5, 1, 0, 0, 1, 1, 10, '#000000'),
(7, 'Met het Spiegelconcept geeft u invulling aan een lerende organisatie. Met deze aanpak spiegel je je als professional, team en organisatie systematisch aan de hoogste kwaliteitsstandaarden en de behoeften vanuit je omgeving. Je gebruikt de leerpunten die hieruit naar voren komen om je dienstverlening te ontwikkelen. ', 6, 1, 0, 0, 0, 0, 10, '#000000'),
(10, 'In het Spiegelconcept ligt de focus op teamontwikkeling. Daar vindt de feitelijke dienstverlening immers plaats. Het Spiegelconcept is makkelijk schaalbaar. Daardoor is het concept ook organisatiebreed toepasbaar. ', 7, 1, 0, 0, 0, 0, 10, '#000000'),
(11, 'Uit ervaring weten we dat de motivatie van in publieke organisaties wel in orde is.  Winst is vooral te behalen als professionals gaan samenwerken aan gedeelde doelen in het team. Daarbij dient het gesprek zich te richten op de prestaties en de kwaliteit van het team. Door de teamleden voortdurend in dialoog te laten gaan, wisselen zij verschillende perspectieven en zienswijzen uit.. Zo leren de teamleden van elkaar en ontstaat ruimte voor vernieuwing. Het team ervaart energie, inspiratie en verbinding. Het team bouwt aan een lerende cultuur.', 8, 1, 0, 0, 0, 0, 10, '#000000'),
(15, 'Screenshot 2023-09-21 134947.png', 10, 1, 1, 1, 0, 0, 10, '#000000'),
(16, 'Vanuit een positieve insteek willen wij eraan bijdragen dat teams beter functioneren en plezier beleven in hun werk. De omgeving waarin de teams opereren is complex  en clienten en stakeholders zijn kritisch. Van het team vraagt dit daadkracht, professionaliteit en flexibliteit.\r\n\r\n\r\n\r\nOp een praktische en speelse manier helpen we teams om deze dynamiek hanteerbaar te maken. Door als team samen sturing te geven aan deze ontwikkelingen kan zij de dienstverlening daarop aanpassen. Wij noemen dat Samen Sturen. Ieder draagt vanuit zijn eigen rol en verantwoordelijkheid bij aan de doelen van het team, of je nu manager, professional of ondersteuner bent.', 10, 2, 0, 1, 0, 0, 10, '#ffffff'),
(20, 'Het Spiegelspel kan kleinschalig worden toegepast, bijvoorbeeld voor één team of een aantal pilot teams. Vanuit zo\'n kleinschalige startopstelling kan het Spiegelconcept opgeschaald worden naar een organisatiebreed toepassing. Zij kan zich hierin door ons laten begeleiden of via een train-de-trainer constructie de implementatie zelf ter hand nemen. Bij een organisatiebrede toepassing van het Spiegelconceptdoorloop je een vergelijkbare aanpak (als bij de teams) maar dan op concernniveau. De speerpunten van het concern geven dan richting aan de invulling van de teamplannen en de analyse van de teamplannen levert input voor het concernplan, in de vorm van \'rode draden\' voor verbetering en ontwikkeling.', 12, 1, 0, 0, 0, 0, 10, '#000000'),
(21, 'Indien uw organisatie aan de slag gaat met het Spiegelconcept, kunt u, als u dat wenst, ook voldoen aan de certificeringseisen van de ISO 9001 (of HKZ). \r\n\r\n\r\n\r\nIn de aanpak zijn vele normvereisten geborgd, zoals leiderschap, interne audits en PDCA. Als u reeds een certificaat heeft kan dit naadloos ingepast worden.\r\n\r\n\r\n\r\nMocht u nog niet voldoen aan de gestelde vereisten dan kunt u met de Spiegelconcept aanpak gaan voldoen aan de vereisten en uw certificaat behalen.', 13, 1, 0, 0, 0, 0, 10, '#000000'),
(22, 'image1.png', 13, 2, 1, 0, 0, 0, 10, '#000000'),
(23, 'TeamKompas', 14, 1, 0, 0, 1, 0, 10, '#000000'),
(24, 'Zelfevaluatie', 14, 2, 0, 0, 1, 0, 10, '#000000'),
(25, 'Prestatiesturing', 14, 3, 0, 0, 1, 0, 10, '#000000'),
(26, 'Door samen de bedoeling en de leidende principes te bepalen, geven we uw team het kompas voor de toekomst.', 15, 1, 0, 0, 0, 0, 10, '#000000'),
(27, 'Samen met het team doen we een zelfevaluatie met het Spiegelspel dat resulteert in een ontwikkelplan.', 15, 2, 0, 0, 0, 0, 10, '#000000'),
(28, 'Samen met het team bepalen we de kritische prestatie-indicatoren.', 15, 3, 0, 0, 0, 0, 10, '#000000'),
(29, '', 16, 1, 0, 0, 0, 0, 10, '#000000'),
(30, '', 16, 2, 0, 0, 1, 0, 10, '#000000'),
(31, '', 16, 3, 0, 0, 1, 0, 10, '#000000'),
(32, 'Screenshot 2023-09-21 150148.png', 17, 1, 1, 0, 0, 0, 10, '#000000'),
(33, 'Screenshot 2023-09-21 150254.png', 17, 2, 1, 0, 0, 0, 10, '#000000'),
(34, 'Screenshot 2023-09-21 150418.png', 17, 3, 1, 0, 0, 0, 10, '#000000'),
(35, 'Omgevingsanalyse -en aanpak', 18, 1, 0, 0, 1, 0, 10, '#000000'),
(36, 'Teamplan en -evaluatie', 18, 2, 0, 0, 1, 0, 10, '#000000'),
(37, 'Stakeholdersanalyse en -strategie', 18, 3, 0, 0, 1, 0, 10, '#000000'),
(38, 'Met het team maken we een omgevingsanalyse en bepalen we de prio\'s voor de strategie.', 19, 1, 0, 0, 0, 0, 10, '#000000'),
(39, 'Met het team evalueren we het \'oude\' plan en stellen een nieuw meerjarenplan op.', 19, 2, 0, 0, 0, 0, 10, '#000000'),
(40, 'Met het team maken we een analyse van de stakeholders en bepalen we de strategie.', 19, 3, 0, 0, 0, 0, 10, '#000000'),
(41, 'Processen', 20, 1, 0, 0, 1, 0, 10, '#000000'),
(42, 'Projectmanagement', 20, 2, 0, 0, 1, 0, 10, '#000000'),
(43, 'Teamontwikkeling en persoonlijke ontwikkeling', 20, 3, 0, 0, 1, 0, 10, '#000000'),
(44, 'We bepalen de kritische processen en onderkende risico\'s dekken we af met maatregelen.', 21, 1, 0, 0, 0, 0, 10, '#000000'),
(45, 'Wij ondersteunen uw project(team) met training, monitoring, coaching, expertise en daadkracht.', 21, 2, 0, 0, 0, 0, 10, '#000000'),
(46, 'Wij helpen bij de ontwikkeling van uw team en medewerkers.', 21, 3, 0, 0, 0, 0, 10, '#000000'),
(47, 'IMG_9579.jpeg', 22, 1, 1, 0, 0, 0, 10, '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `paginas`
--

CREATE TABLE `paginas` (
  `id` int(11) NOT NULL,
  `paginaNaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paginas`
--

INSERT INTO `paginas` (`id`, `paginaNaam`) VALUES
(1, 'Home'),
(2, 'Spiegelconcept'),
(3, 'Dienstverlening'),
(4, 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `link` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logininfo`
--
ALTER TABLE `logininfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notities`
--
ALTER TABLE `notities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paginagrid`
--
ALTER TABLE `paginagrid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `paginainfo`
--
ALTER TABLE `paginainfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
