-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Jul 01, 2025 at 05:58 PM
=======
-- Generation Time: Jul 05, 2025 at 01:18 AM
>>>>>>> d7aca8882a6184d0254eb83905785e062caec041
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
-- Database: `juno_hotel_db`
--

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_type` enum('room','suite') NOT NULL,
  `size` int(11) NOT NULL,
  `max_guests` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `available_rooms` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_type`, `size`, `max_guests`, `price`, `description`, `image_url`, `available_rooms`, `is_active`) VALUES
(1, 'Solo Nook Room', 'room', 60, 1, 11250.00, 'A cozy, stylish retreat for the solo traveler.', '../assets/images/solo_nook.jpg', 10, 1),
(2, 'Twin Horizon Room', 'room', 120, 2, 16250.00, 'Designed for comfort and space of two people.', '../assets/images/twin_horizon.jpg', 5, 1),
(3, 'Queen Serenity Suite', 'suite', 120, 2, 18250.00, 'Enjoy luxurious sleep in a queen-sized bed surrounded by ambient lighting and calming textures.', '../assets/images/queen_serenity.jpg', 5, 1),
(4, 'Juno Signature King Suite', 'suite', 150, 4, 20000.00, 'Balance luxury and mindfulness in this calming suite inspired with our signature style king suite.', '../assets/images/signature_king.jpg', 2, 1),
(5, 'Courtyard Family Haven Suite', 'suite', 160, 5, 25000.00, 'Experience contemporary comfort and breathtaking views overlooking the Gulf in this Suite.', '../assets/images/courtyard_haven.jpg', 2, 1);

-- --------------------------------------------------------

--
>>>>>>> d7aca8882a6184d0254eb83905785e062caec041
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `is_banned` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `is_banned`, `created_at`) VALUES
(6, 'ashklve', '$2y$10$uHyNbKiQg6M/w04hauffj.3Ni6MW51hD/ahzxD.pgTvyHYxI2emau', 'hilaryashpagadora@gmail.com', 'user', 0, '2025-06-29 10:22:44'),
(7, 'nidare', '$2y$10$6C0/7BTzpMLGhgxDZqT4oO8EAGkW5rRaN8rJTLReChqbegSAJ5aQa', 'hilaryashleypagador@gmail.com', 'user', 0, '2025-06-29 12:37:03'),
(8, 'rujinu', '$2y$10$39t4Gb4dcb96xFKck4QKL.hMcpjVLJv0c0Os.qlvvIZPtcDqeOif.', 'radyn@mailinator.com', 'user', 0, '2025-07-01 14:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `user_id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `address_line3` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Philippines'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`user_id`, `title`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `nationality`, `address_line1`, `address_line2`, `address_line3`, `city`, `zip_code`, `country`) VALUES
(6, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Philippines'),
(7, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Philippines'),
(8, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Philippines');

--
-- Indexes for dumped tables
--

--
<<<<<<< HEAD
=======
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
>>>>>>> d7aca8882a6184d0254eb83905785e062caec041
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
<<<<<<< HEAD
=======
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
>>>>>>> d7aca8882a6184d0254eb83905785e062caec041
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
