-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 01:28 PM
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
-- Database: `midproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(5441, 'bob4', '$2y$10$LvYTe56dPe2a65Q8PNIKOuqfomjPJ2qTpdbNba6IkwnrUiL6wEFj6'),
(23150, 'bob', '$2y$10$iBRh5Tnua.e32m6TYCbkJ.qvYXuPXyv8gQGOSpypuTb56nv7S9asK'),
(25516, 'nic', '$2y$10$BplC17VJerYbEjuMuU2IL.ZV4s.d4KdqYisjRpNOF35H6C3mMCNmW'),
(40693, 'toni', '$2y$10$jvOEszkf8U6DZ9KocqKqw./8ihXn9su.q25C0yxGg9jWHXWSZb3Fq'),
(66887, 'hasta', '$2y$10$kVlaogLTZOGNm9Iwx2w4P.04uSzD8vbJJIzcGxuF9QNgwYngjCFVm'),
(86235, 'test', '$2y$10$lMz5wQTxUkIb1BApnSOMyuOBfF5P5OCwPEYpp7qYrYdI8AjzVuo66'),
(96040, 'test2', '$2y$10$D.4d4.d6fLLRGcdhVlXliut1tzgsYO1RAKt31KXgPtBrbIhjgPZIK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
