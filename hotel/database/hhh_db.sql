-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 06:33 PM
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
-- Database: `hhh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(2, 'admin', 'admin@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `holiday_homes`
--

CREATE TABLE `holiday_homes` (
  `home_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `availability_status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday_homes`
--

INSERT INTO `holiday_homes` (`home_id`, `name`, `location`, `availability_status`, `description`, `rating`, `image_path`, `price`) VALUES
(1, 'Green Leaf Hotel', 'Gensan', 'available', 'This luxury holiday home in Florida, USA is filled to the brim with an array of amazing facilities and luxury amenities. With 15,000 square feet of space, the unique mansion is just over five miles from Disneyland and has views over the world-famous Jack Nicklaus golf course. But there\'s something surprising here that may keep you indoors.', 20.0, '../assets/img/holiday-homes/hotel1.jpg', 500.00),
(2, 'CitiPark Hotel', 'Gensan', 'not_available', 'This modern apartment in Buena Vista, Colorado is the ideal space for a weekend getaway and holds a secret inside that\'s perfect for the active holidaymaker. With its own garden and seating area, it can sleep up to four people and has all the latest modern amenities.', 4.2, '../assets/img/holiday-homes/hotel 2.jpg', 400.00),
(3, 'Royal Hotel ', 'Gensan', 'available', 'However, hidden deep in the house is the ultimate in luxury entertainment: a bowling alley! With two lanes, it\'s the perfect place to get competitive and even has a comfortable lounge space and TV screens so you can keep track of who\'s winning. At £2,052 ($2,608) a night, with a minimum stay of four nights, it\'ll be an expensive game of bowling. ', 4.3, '../assets/img/holiday-homes/hotel 3.jpg', 300.00),
(4, 'Sydney Hotel', 'Gensan', 'available', 'Designed as a break from busy city life, guests walk into a magical forest where the relaxing living room features a log stool and a fun swinging chair. The enchanting woodland doesn\'t come without modern-day amenities and includes a smart TV and air-conditioning. ', 3.9, '../assets/img/holiday-homes/hotel 4.jpg', 360.00),
(6, 'Home Crest Hotel', 'Davao', 'available', 'Located on the first floor of the house, the living room and kitchen are full of original features including a basalt stone fireplace, terracotta floors and wooden beams, which all date from the 14th century. Overall the villa can sleep six people in three bedrooms which are surrounded by arched doorways and exposed tufa rock.', 3.7, '../assets/img/holiday-homes/home-crest-hotel.jpg', 470.00);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `user_email`, `otp_code`, `timestamp`) VALUES
(19, 'adhiraj.saha.mca24@heritageit.edu.in', 146275, '2023-11-04 17:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `home_id` int(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`) VALUES
(14, 'jrtaraktarak', 'fontface86@gmail.com', '0975685464', '418000ba259f0053047077f6f7afeef8b8c2b848da21505961f6aad5c74b9c67');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holiday_homes`
--
ALTER TABLE `holiday_homes`
  ADD PRIMARY KEY (`home_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `foreign_key_user_id` (`user_id`),
  ADD KEY `foreign_key_home_id` (`home_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holiday_homes`
--
ALTER TABLE `holiday_homes`
  MODIFY `home_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `foreign_key_home_id` FOREIGN KEY (`home_id`) REFERENCES `holiday_homes` (`home_id`),
  ADD CONSTRAINT `foreign_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
