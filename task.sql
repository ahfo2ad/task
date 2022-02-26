-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2022 at 09:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `taskmanager`
--

DROP TABLE IF EXISTS `taskmanager`;
CREATE TABLE `taskmanager` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taskmanager`
--

INSERT INTO `taskmanager` (`id`, `name`, `date`, `description`, `status`) VALUES
(1, 'ahmed', '2022-02-02', 'any thing njnjnjnjnjjjjjjjjjjjj', 0),
(2, 'mkmkkm', '2022-02-26', 'mkkmmkmkmkkmmkkmkkmmkmkmkmk', 1),
(3, 'hh', '2022-02-26', 'hhhhhhhhhhhhhhhhhhhh', 1),
(4, 'logo', '2022-02-26', 'logo design is required now', 0),
(5, 'header', '2022-02-26', 'design the header', 1),
(6, 'footer', '2022-02-26', 'noonononononono', 1),
(7, 'eslam', '2022-02-26', 'logo design is required nowmkmk', 0),
(8, 'osa', '0000-00-00', 'jnnnnnnnnnnnnnnnnnn', 0),
(9, 'njjjnj', '0000-00-00', 'njnjnjnjnjnjnjnjnjnj', 0),
(10, 'last', '2021-11-03', 'last editing', 0),
(11, 'test', '2021-10-18', 'tasting last one', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `taskmanager`
--
ALTER TABLE `taskmanager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `taskmanager`
--
ALTER TABLE `taskmanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
