-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2016 at 04:05 PM
-- Server version: 5.6.28
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockticker`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(30) NOT NULL,
  `id` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `id`, `password`, `role`) VALUES
('Jay', 'jay', '$2y$10$COyb8GZ6cZ0BoKMJUWaxweBYC9xBIjcBM5tSyag6iIZyEYETf.kri', 'admin'),
('Matt', 'matt', '$2y$10$2DY1Dn.EhKcabt.TgmsQoerHp6NM7LK6jlJ3ljSTDv.CNVHzRS91C', 'admin'),
('Spencer', 'spencer', '$2y$10$mk8UpRX8LEMtRXVWYcBLa.uQaZYJ//VlmgPUs42KXVqRld4TOSP8W', 'admin'),
('Tyler', 'tyler', '$2y$10$NTW7XCRzOoNrISbhJERxGedwryXHVLGE8TyT2baQSEMM3bYa0zYwu', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
