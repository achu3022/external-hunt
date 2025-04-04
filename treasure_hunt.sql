-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2025 at 06:52 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `treasure_hunt`
--

-- --------------------------------------------------------

--
-- Table structure for table `level3_questions`
--

DROP TABLE IF EXISTS `level3_questions`;
CREATE TABLE IF NOT EXISTS `level3_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `level3_scores`
--

DROP TABLE IF EXISTS `level3_scores`;
CREATE TABLE IF NOT EXISTS `level3_scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `score` int DEFAULT '0',
  `status` enum('pending','win','fail') DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level4_identification`
--

DROP TABLE IF EXISTS `level4_identification`;
CREATE TABLE IF NOT EXISTS `level4_identification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clue` text NOT NULL,
  `option_1` varchar(100) NOT NULL,
  `option_2` varchar(100) NOT NULL,
  `option_3` varchar(100) NOT NULL,
  `option_4` varchar(100) NOT NULL,
  `correct_answer` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level4_scores`
--

DROP TABLE IF EXISTS `level4_scores`;
CREATE TABLE IF NOT EXISTS `level4_scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_answer` varchar(255) DEFAULT NULL,
  `score` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

DROP TABLE IF EXISTS `passwords`;
CREATE TABLE IF NOT EXISTS `passwords` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `level` int NOT NULL,
  `passcode` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `correct_answers` int DEFAULT NULL,
  `total_questions` int DEFAULT '25',
  `score` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `moves` int NOT NULL,
  `completion_time` datetime DEFAULT NULL,
  `status` enum('Failed','Win') DEFAULT 'Failed',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `played` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `th_memory_game`
--

DROP TABLE IF EXISTS `th_memory_game`;
CREATE TABLE IF NOT EXISTS `th_memory_game` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_attempts` int DEFAULT '0',
  `time_taken` int DEFAULT '0',
  `status` tinyint DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `winner_position` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `winner_position` (`winner_position`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `th_mystery_box`
--

DROP TABLE IF EXISTS `th_mystery_box`;
CREATE TABLE IF NOT EXISTS `th_mystery_box` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` varchar(255) NOT NULL,
  `hint` text,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `th_mystery_box_scores`
--

DROP TABLE IF EXISTS `th_mystery_box_scores`;
CREATE TABLE IF NOT EXISTS `th_mystery_box_scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `attempts` int DEFAULT '0',
  `solved_at` timestamp NULL DEFAULT NULL,
  `score` int DEFAULT '0',
  `question_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `th_prizes`
--

DROP TABLE IF EXISTS `th_prizes`;
CREATE TABLE IF NOT EXISTS `th_prizes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `winner_position` int NOT NULL,
  `prize_name` varchar(50) NOT NULL,
  `prize_amount` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `winner_position` (`winner_position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `qualification` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `referral_code` varchar(10) DEFAULT NULL,
  `referred_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `level` int NOT NULL,
  `status` enum('locked','unlocked','completed') DEFAULT 'locked',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_level` (`user_id`,`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `user_id` int NOT NULL,
  `status` enum('win','fail') NOT NULL,
  `completed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
