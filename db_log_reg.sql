-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 08:11 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_log_reg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `email`, `password`) VALUES
(16, 'Ridan Kabir', 'Ridan', 'ridan123@gmail.com', 'e382f2984a31aae795ac0b2a9cf9f7ce'),
(17, 'Tamim Islam', 'Tamim', 'tamim123@gmail.com', '72504da994f0a242efd705f40adb6ee4'),
(18, 'Ezaz Ahamed', 'Ezaz', 'ezaz123@gmail.com', 'c49682ab85a364c77c41d72a60f4ef16'),
(19, 'Foisal Ahamed', 'Foisal', 'ridankabir123@gmail.com', 'aea42bd8082962b44280800d7ef6a7aa'),
(20, 'Shahajan', 'Abid', 'ridankabir0wr@gmail.com', '6a070093ab4603a04521b9aca965cd9b'),
(21, 'Foisal Hamid', 'Faisal', 'fasial123@gmail.com', 'ffee9142549f740f58529ff32d17df2f'),
(22, 'Delowar Jahan Imran', 'Imran', 'jahan123@gmail.com', 'e4c8a7e15425ddeb272031ec334b44fa'),
(23, 'Sabuj Ahamed', 'Sabuj', 'sabuj123@gmail.com', '5430aaea532f7af0b3b0c00f1e33a695'),
(24, 'Rezaul Karim', 'Rezaul', 'rezaul123@gmail.com', 'd9a3ca6550d64e7eb059632984985f55'),
(25, 'Mehedi Hasan', 'Mehedi', 'mehedi123@gmail.com', '1e2c292dc43e97a130b6940492ba1c98'),
(26, 'Minhaz Foisal', 'Minhaz', 'minhaz123@gmail.com', '73e5857487d331b21f58cc882ecae59d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
