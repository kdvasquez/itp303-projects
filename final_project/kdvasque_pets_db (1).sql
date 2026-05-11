-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2024 at 02:22 AM
-- Server version: 8.0.37
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kdvasque_pets_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `breeds`
--

CREATE TABLE `breeds` (
  `breed_id` int NOT NULL,
  `breed` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `breeds`
--

INSERT INTO `breeds` (`breed_id`, `breed`) VALUES
(1, 'Corgi'),
(2, 'Ragdoll'),
(3, 'Labrador Retriever'),
(4, 'German Shepherd'),
(5, 'Australian Shepherd'),
(6, 'Exotic Shorthair'),
(7, 'Shih Tzu'),
(8, 'Poodle'),
(9, 'Chihuahua'),
(10, 'Beagle'),
(11, 'American Curl'),
(12, 'Scottish Fold'),
(13, 'British Shorthair'),
(14, 'Goldendoodle'),
(15, 'Siberian Husky');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` int NOT NULL,
  `gender` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_id` int NOT NULL,
  `pet_name` varchar(64) NOT NULL,
  `breed_id` int NOT NULL,
  `gender_id` int NOT NULL,
  `age` int NOT NULL,
  `type_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_id`, `pet_name`, `breed_id`, `gender_id`, `age`, `type_id`) VALUES
(1, 'Conan', 1, 1, 3, 1),
(2, 'Vanessa', 2, 2, 1, 2),
(3, 'Sandy', 3, 2, 7, 1),
(4, 'Tom', 4, 1, 8, 1),
(5, 'Ausie', 5, 1, 10, 1),
(6, 'Cone', 6, 1, 7, 2),
(7, 'SuSu', 7, 2, 7, 1),
(9, 'Henry', 9, 1, 7, 1),
(10, 'Bagel', 10, 1, 4, 1),
(11, 'Carrie', 11, 2, 3, 1),
(12, 'Ghostly', 12, 1, 5, 2),
(13, 'William', 13, 1, 6, 2),
(14, 'Kate', 14, 2, 5, 1),
(15, 'Icy', 15, 2, 1, 1),
(16, 'Jorge', 10, 1, 4, 1),
(17, 'Chloe', 9, 2, 3, 1),
(18, 'Matcha', 7, 2, 7, 1),
(19, 'Tea', 8, 1, 8, 1),
(20, 'Bagel', 3, 1, 10, 1),
(21, 'Yellow', 1, 2, 3, 1),
(22, 'Harold', 1, 2, 8, 1),
(23, 'Susana', 1, 2, 8, 1),
(26, 'George', 1, 1, 1, 2),
(27, 'Billy', 1, 1, 17, 1),
(28, 'Chloe', 1, 2, 1, 1),
(76, 'Test', 7, 1, 1, 2),
(77, 'Testinggg', 1, 1, 17, 1),
(78, 'Testtttt', 1, 1, 10, 1),
(79, 'Susieeee', 1, 2, 1, 1),
(80, 'Help', 1, 1, 2, 1),
(81, 'lo', 1, 2, 8, 1),
(83, 'Su', 1, 2, 17, 1),
(84, 'Sun', 9, 1, 2, 1),
(86, 'Susie', 1, 1, 10, 1),
(89, 'Susie', 2, 2, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type`) VALUES
(1, 'Dog'),
(2, 'Cat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breeds`
--
ALTER TABLE `breeds`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `breed_id` (`breed_id`,`gender_id`,`type_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breeds`
--
ALTER TABLE `breeds`
  MODIFY `breed_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `pets_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `pets_ibfk_3` FOREIGN KEY (`breed_id`) REFERENCES `breeds` (`breed_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
