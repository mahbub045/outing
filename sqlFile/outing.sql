-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 07:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outing`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `curDate` date NOT NULL,
  `blgTitle` varchar(255) NOT NULL,
  `blgText` varchar(255) NOT NULL,
  `blgImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `username`, `curDate`, `blgTitle`, `blgText`, `blgImg`) VALUES
(1, 'Test User1', '2023-08-19', 'Blog title1', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e0cead60424pexels-mert-coşkun-17997548.jpg'),
(3, 'Test User1', '2023-08-20', 'Blog title3 edited', 'Massachusetts Institute of Technology is a private land-grant research university in Cambridge, Massachusetts. Established in 1861, MIT has played a significant.', '64e0cfb7e4631pexels-mert-coşkun-17997548.jpg'),
(4, 'Md Mahbub Rahman', '2023-08-19', 'Blog Title4', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e0cff13589bpexels-mert-coşkun-17997548.jpg'),
(6, 'Md Mahbub Rahman', '2023-08-19', 'Blog Title6', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e0d2b661c8cpexels-mert-coşkun-17997548.jpg'),
(7, 'Md Mahbub Rahman', '2023-08-19', 'Blog Title7', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e0d34c256d8pexels-otavio-henrique-17673164.jpg'),
(10, 'Md Mahbub Rahman', '2023-08-20', 'Blog Title8', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e10d967e8c3pexels-jovan-vasiljević-17907904.jpg'),
(11, 'Test User1', '2023-08-20', 'Blog Title9', 'Massachusetts Institute of Technology is a private land-grant research university in Cambridge, Massachusetts. Established in 1861, MIT has played a significant.', '64e1982bb0fb3pexels-otavio-henrique-17673164.jpg'),
(12, 'Rana Ali', '2023-08-20', 'The Seven Seas', 'The Seven Seas include the Arctic, North Atlantic, South Atlantic, North Pacific, South Pacific, Indian, and Southern oceans. The exact origin of the phrase', '64e199b07b923pexels-otavio-henrique-17673164.jpg'),
(13, 'Rana Ali', '2023-08-20', 'Blog Title5', 'Lorem ipsum dolor, sit amet consectetur adipisicing, elit. Aspernatur nisi deleniti nam enim ullam cumque debitis facere officiis repellat voluptates!', '64e19ba33074bpexels-bagus-pangestu-1464815.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Md Mahbub Rahman', 'm@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Test User1', 't@gmail.com', 'b59c67bf196a4758191e42f76670ceba'),
(3, 'Rana Ali', 'rana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
