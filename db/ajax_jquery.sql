-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2023 at 09:15 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajax_jquery`
--

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(4) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `tel` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id`, `civilite`, `nom`, `prenom`, `email`, `photo`, `tel`) VALUES
(36, 'Mme', 'Oppong Doe', 'John', 'oppong@gmail.com', 'kcrops.png', '0602762665'),
(37, 'Mme', 'Khandil', 'Marwa', 'khandil.marwa@gmail.com', 'smiling_woman.png', '0602762665'),
(41, 'Mme', 'Clinton', 'Bills', 'bills.clinton@gmail.com', 'man2.jpeg', '0602762665'),
(42, 'Mr', 'Clever', 'Pauls', 'clever.pauls@gmail.com', 'old man.jpeg', '0602762665'),
(44, 'Mr', 'Selim', 'Hajja', 'selim.hajja@gmail.com', 'lady4.jpeg', '0602762665'),
(45, 'Mme', 'Wiam', 'Brills', 'wiam.brills@gmail.com', 'image3.jpeg', '0602762665'),
(57, 'Mlle', 'Frimpong', 'Gills', 'gills.frimpong@gmail.com', 'santiveri-quantisol-huile-bronzage-bio.jpg', '0602762665'),
(68, 'Mr', 'Omar', 'Hassan', 'omar.hassan@gmail.com', 'man1.jpeg', '+212713701881'),
(69, 'Mr', 'Muhammed', 'Achraf', 'muhammed.achraf@gmail.com', 'man2.jpeg', '0698495906'),
(70, 'Mr', 'Peters', 'Saint', 'saint.peters@gmail.com', 'getleman.jpeg', '0698495906'),
(71, 'Mr', 'Johnson', 'Philips', 'johnson.philips@gmail.com', 'john smiles sample.jpeg', '+212713701881'),
(72, 'Mr', 'Oppong', 'John', 'oppong@gmail.com', 'kcrops.png', '0602762665'),
(73, 'Mr', 'Slim', 'James', 'slim.james@gmail.com', 'big man size.jpeg', '0698495906'),
(74, 'Mr', 'Oppong', 'John', 'oppong@gmail.com', 'smiling_woman.png', '0602762665'),
(75, '', '', '', 'oppongjohn278@gmail.com', '', ''),
(76, '', '', '', 'oppongjohn278@gmail.com', '', ''),
(77, '', '', '', 'oppongjohn278@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `role`, `pwd`) VALUES
(1, 'John', 'Oppong', 'oppongjohn278@gmail.com', 'USER ADMIN', 'admin'),
(13, 'John', 'Oppong', 'oppongjohn278@gmail.com', 'USER ADMIN', 'undefined'),
(12, 'Emmanuel', 'Oppong', 'oppong.emma@gmail.com', 'USER', 'emma'),
(11, 'Agnes', 'Oppong', 'oppong.agnes111@gmail.com', 'USER', 'agnes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
