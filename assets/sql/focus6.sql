-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2024 at 03:36 PM
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
-- Database: `focus6`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactinfo`
--

CREATE TABLE `contactinfo` (
  `id` int NOT NULL,
  `naam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `bericht` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contactinfo`
--

INSERT INTO `contactinfo` (`id`, `naam`, `email`, `bericht`) VALUES
(1, 'Julia', 'julia.brouwervanoudshoorn@gmail.com', 'Ello my name jeff');

-- --------------------------------------------------------

--
-- Table structure for table `logininfo`
--

CREATE TABLE `logininfo` (
  `id` int NOT NULL,
  `gebruikersnaam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wachtwoord` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `logininfo`
--

INSERT INTO `logininfo` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'admin', '$2y$10$AYL/dfvt3afDg2H3n0erB.ClRJ3zRE7KNLup5evNGY9c3B2EL8bm.'),
(2, '22', '$2y$10$tACGBlX.sCQDGXdzWgz5Vu/z/HonpyPgURyurwQiNrkK7jhoYZd1u');

-- --------------------------------------------------------

--
-- Table structure for table `paginagrid`
--

CREATE TABLE `paginagrid` (
  `id` int NOT NULL,
  `rowPosition` int NOT NULL,
  `columnType` int NOT NULL,
  `pageValue` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paginagrid`
--

INSERT INTO `paginagrid` (`id`, `rowPosition`, `columnType`, `pageValue`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 4),
(3, 2, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `paginainfo`
--

CREATE TABLE `paginainfo` (
  `id` int NOT NULL,
  `informatie` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `row` int NOT NULL,
  `colum` int NOT NULL,
  `foto` tinyint(1) DEFAULT '0',
  `backgroundColor` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paginas`
--

CREATE TABLE `paginas` (
  `id` int NOT NULL,
  `paginaNaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paginas`
--

INSERT INTO `paginas` (`id`, `paginaNaam`) VALUES
(1, 'Home'),
(2, 'Contact'),
(3, 'pagina1'),
(4, 'pagina10000');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int NOT NULL,
  `naam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD KEY `Constraint_FK_position` (`row`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logininfo`
--
ALTER TABLE `logininfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paginagrid`
--
ALTER TABLE `paginagrid`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paginainfo`
--
ALTER TABLE `paginainfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paginas`
--
ALTER TABLE `paginas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paginagrid`
--
ALTER TABLE `paginagrid`
  ADD CONSTRAINT `Constraint_FK_page_type` FOREIGN KEY (`pageValue`) REFERENCES `paginas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `paginainfo`
--
ALTER TABLE `paginainfo`
  ADD CONSTRAINT `Constraint_FK_position` FOREIGN KEY (`row`) REFERENCES `paginagrid` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
