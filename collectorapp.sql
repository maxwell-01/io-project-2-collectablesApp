-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Feb 07, 2022 at 02:04 PM
-- Server version: 5.7.37
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collectorapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bottles`
--

CREATE TABLE `bottles` (
  `id` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `purchaselocation` varchar(255) NOT NULL,
  `purchasedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bottles`
--

INSERT INTO `bottles` (`id`, `itemname`, `purchaselocation`, `purchasedate`) VALUES
(1, 'Park Distillery - Park Maple Rye', 'Banff National Park, Alberta, Canada', '2022-01-04'),
(2, 'Dead Man\'s Fingers Rum', 'Bristol, UK', '2021-03-17'),
(3, 'Aval Dor Cornish Vodka', 'Colwith Farm Distillery', '2022-02-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bottles`
--
ALTER TABLE `bottles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bottles`
--
ALTER TABLE `bottles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
