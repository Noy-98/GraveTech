-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 01:13 AM
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
-- Database: `gravetechdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `guesttbl`
--

CREATE TABLE `guesttbl` (
  `id` int(15) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `grave_name` varchar(255) NOT NULL,
  `grave_location` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guesttbl`
--

INSERT INTO `guesttbl` (`id`, `full_name`, `grave_name`, `grave_location`, `email`, `password`) VALUES
(2, 'Jay', 'joy', 'makati', 'noy@gmail.com', '$2y$10$1WHONR4iUq6aIDaxoMD8k.AQGvtgJc38mJLV0kic40.LBygh4XoT2');

-- --------------------------------------------------------

--
-- Table structure for table `userdepartmenttbl`
--

CREATE TABLE `userdepartmenttbl` (
  `id` int(15) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `profile_pictures` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdepartmenttbl`
--

INSERT INTO `userdepartmenttbl` (`id`, `first_name`, `last_name`, `department_name`, `profile_pictures`, `email`, `password`, `user_type`) VALUES
(1, 'Jay', 'Aspacio', 'Janitor', '', 'noy@gmail.com', '$2y$10$jhf/3TB/tb3JwITi6bK.xOsQD5e6sQ8juxBB6aI7F.TDq/4d8IUL.', 'admin'),
(2, 'Department', 'Department', 'Janitor', '', 'janitor@gmail.com', '$2y$10$nNutgXguMT7nyne2u03y6.pXjI0v6dQrPkKJ59dDsluV9pCkFGlTu', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guesttbl`
--
ALTER TABLE `guesttbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdepartmenttbl`
--
ALTER TABLE `userdepartmenttbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guesttbl`
--
ALTER TABLE `guesttbl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdepartmenttbl`
--
ALTER TABLE `userdepartmenttbl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
