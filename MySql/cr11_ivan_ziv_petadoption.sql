-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 01:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_ivan_ziv_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_ivan_ziv_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_ivan_ziv_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `ID` int(11) NOT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `HOBBIES` varchar(255) DEFAULT NULL,
  `AGE` varchar(255) DEFAULT NULL,
  `CITY` varchar(255) DEFAULT NULL,
  `ZIP` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `SIZE` enum('small','large','senior') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`ID`, `IMG`, `NAME`, `DESCRIPTION`, `HOBBIES`, `AGE`, `CITY`, `ZIP`, `ADDRESS`, `SIZE`) VALUES
(1, 'https://praxistipps.s3.amazonaws.com/2018-11/lop-eared-314881_1280.jpg', 'Rabbit', 'Rabbits are small, furry mammals with long ears, short fluffy tails, and strong, large hind legs.', 'I love to hop around', '2', 'New York', '10001', 'Wallstreet 21', 'small'),
(2, 'https://images.theconversation.com/files/344413/original/file-20200629-104494-bs7tcm.jpeg?ixlib=rb-1.1.0&rect=7%2C159%2C2527%2C1261&q=45&auto=format&w=1356&h=668&fit=crop', 'Mouse', 'A mouse has a pointed snout, small rounded ears, a body-length scaly tail and a high breeding rate.', 'I love to scare humans', '4', 'Los Angeles', '90001', 'Rodeo Drive 23', 'small'),
(3, 'https://media.tag24.de/951x634/0/d/0dkrr3obh9mrx4n10z0m559zu0hjc8xq.jpg', 'Hamster', 'Hamsters are typically stout-bodied, with tails shorter than body length, and have small, furry ears, short, stocky legs, and wide feet.', 'I love jogging', '1', 'Vancouver', 'v5h3z7', 'Granville Street 14', 'small'),
(4, 'https://cdn.britannica.com/37/125637-050-775F1B98/Agama.jpg', 'Lizard', 'Lizards are scaly-skinned reptiles that are usually distinguished from snakes by the possession of legs, movable eyelids, and external ear openings.', 'I love sunbathing', '3', 'Mexico City', '00810', 'Avenida de los Insurgentes 1', 'small'),
(5, 'https://www.cesarsway.com/wp-content/uploads/2019/10/AdobeStock_190562703.jpeg', 'Dog', 'Dogs are domesticated mammals, not natural wild animals. They were originally bred from wolves. ', 'I love to play ball', '5', 'Michigan City', '46361', 'Park Avenue 45', 'large'),
(6, 'https://www.katzeninfo.com/images/KIN/pro-senior-vorteile-aelterer-katzen.jpg', 'Cat', 'Cats are small, carnivorous mammals, of the family Felidae.', 'I love hunting', '4', 'San Francisco', '94016', 'Lombard Street 121', 'large'),
(7, 'https://i.pinimg.com/originals/71/32/20/713220becfac36f731c546194e7b6aa0.jpg', 'Parrot', 'Parrots have a heavy, in relation to their size, and compact body with a large head and a short neck. Their beaks are short, strong and curved. ', 'I love to trashtalk people', '2', 'Vienna', '1006', 'Mariahilfer Straße 10', 'large'),
(8, 'https://www.colorado.edu/cumuseum/sites/default/files/styles/widescreen/public/slider/coachwhip2_1.jpg?itok=ImtHEWPe', 'Snake', 'Snakes are ectothermic, amniote vertebrates covered in overlapping scales.', 'I love to dance', '5', 'Cape Town', '6665', 'Kloof Street 67', 'large'),
(9, 'https://img.zeit.de/wissen/2016-04/tiger-artenschutz-population/wide__1300x731', 'Tiger', 'Tiger have a muscular body with powerful forelimbs, a large head and a tail that is about half the length of its body.', 'I love to play catch', '15', 'Las Vegas', '88901', 'Fremont Street 99', 'senior'),
(10, 'https://www.allyourhorses.de/var/public/images/d1/03/AdobeStock_175202465.jpg', 'Horse', 'Horses have long tails, short hair, muscular torsos, long thick necks and elongated heads. ', 'I love to race', '17', 'Vienna', '1120', 'Meidlinger Hauptstraße 21', 'senior'),
(11, 'https://www.fazemag.de/wp-content/uploads/2019/07/Alligator_Florida_wikipedia-1280x640.jpg', 'Crocodile', 'Crocodiles have powerful jaws with many conical teeth and short legs with clawed webbed toes. ', 'I love to play golf', '40', 'Miami', '33101', 'Ocean Drive 45', 'senior'),
(12, 'https://www.ukfalcons.com/falcon_breeders_birdmart/images/listings/2020-04/female_harris_hawk-1586952495-861-e.jpg', 'Hawk', 'Hawks are a group of medium-sized diurnal birds of prey of the family Accipitridae. ', 'I love to fly', '21', 'Berlin', '10115', 'Schönhauser Straße 12', 'senior');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASS` varchar(255) NOT NULL,
  `STATUS` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `NAME`, `EMAIL`, `PASS`, `STATUS`) VALUES
(3, 'Halo halo', 'halo@halo.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'admin'),
(4, 'youyou', 'you@you.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user'),
(5, 'Ivan', 'ivan@ivan.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user'),
(6, 'ziv', 'ziv@ziv.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user'),
(7, 'master', 'master@master.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
