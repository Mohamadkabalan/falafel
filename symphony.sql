-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 02:16 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symphony`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Price` int(11) NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID`, `Name`, `Price`, `Image`) VALUES
(8, 'a', 19, '9582ae92a0821f5d4a8cda8472d49804.jpeg'),
(9, 'b', 21, '2aa21c4be26c1ae9da23738d7749998f.jpeg'),
(10, 'c', 22, 'fe6b77ae66c3d100d0728484a9cb2510.jpeg'),
(11, 'd', 24, 'c232285ad83e5e8361f2bf57e486a17d.jpeg'),
(12, 'e', 25, 'a700e5b0e941e89ceaa3e24d6f46531d.jpeg'),
(13, 'f', 26, 'df81d979d0e68cfdd67c1817fa7ae215.jpeg'),
(14, 'g', 27, '1392baf579f5b76beea472fb8fc04e95.jpeg'),
(15, 'h', 28, '42c19934a9de4d1a0f49888cc7489a85.jpeg'),
(16, 'j', 30, 'c9b5b502396ca7826df97e6b539d179e.jpeg'),
(17, 'k', 28, 'f2c47acb955e134e363640d1213742a1.jpeg'),
(18, 'l', 30, '92ebd2f152c576cc8d3d36fc6328a30d.jpeg'),
(19, 'z', 31, 'f7447ff061f05916c2b3c6d3ade4e58d.jpeg'),
(20, 'x', 32, '0db41a0a3e6009ec513465bd2aceb37e.jpeg'),
(22, 'tt', 88, 'f19a39f443f94b7e66d701c7b04e4979.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Address` text NOT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`ID`, `Name`, `Address`, `Image`) VALUES
(1, 'dar chamal', 'tripoli', 'dar_chamal.jpg'),
(2, 'antoine', 'beirut', 'antoine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `library_book`
--

CREATE TABLE `library_book` (
  `id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library_book`
--

INSERT INTO `library_book` (`id`, `library_id`, `book_id`) VALUES
(1, 1, 8),
(2, 1, 9),
(3, 1, 10),
(4, 1, 11),
(5, 1, 12),
(6, 1, 13),
(7, 2, 14),
(8, 2, 15),
(9, 2, 16),
(10, 2, 17),
(11, 2, 18),
(12, 2, 19),
(13, 2, 20),
(14, 2, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `library_book`
--
ALTER TABLE `library_book`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `library_book`
--
ALTER TABLE `library_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
