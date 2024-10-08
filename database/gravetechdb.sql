-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 05:29 PM
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
  `password` varchar(255) NOT NULL,
  `profile_pictures` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guesttbl`
--

INSERT INTO `guesttbl` (`id`, `full_name`, `grave_name`, `grave_location`, `email`, `password`, `profile_pictures`) VALUES
(10, 'Jay Aspacio', 'dela cruz', 'B3', 'yajaspacio@gmail.com', '$2y$10$6SkZFY.3cZtI/7uC6iuuBuc5kBA15ugFrm43JrTZNn6hQAXmRdq46', '../../../uploads/guest_pictures/profile_icon.png');

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
(1, 'Garden Of Memories', 'Administrator', 'IT Department', '../../../uploads/super_admin_pictures/1.png', 'itdept@gmail.com', '$2y$10$etjlCHhfLnEljmlxcEdT9Oj7WykQtCHlCE2z/BJFX9YdCs0/Zm316', 'admin'),
(10, 'Jay', 'Aspacio', 'Janitor', '../../../uploads/department_pictures/profile_icon.png', 'yajaspacio@gmail.com', '$2y$10$kCYjRjsbOPR3WDC/L28wwOUtn/RclrNqBiPlK03eJIf0vdYdgep0.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guesttbl`
--
ALTER TABLE `guesttbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userdepartmenttbl`
--
ALTER TABLE `userdepartmenttbl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
