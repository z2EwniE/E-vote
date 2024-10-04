-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 01:05 PM
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
-- Database: `evote`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `candidate_position` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `candidate_position`, `candidate_name`, `department`) VALUES
(1, 0, 'Romel Moster', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'College of Arts and Science'),
(2, 'College of Teacher and Education'),
(3, 'College of Business Management and Entrepreneurship');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `login_attempts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attempt` int(10) NOT NULL DEFAULT 1,
  `ip_address` varchar(24) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`login_attempts_id`, `user_id`, `attempt`, `ip_address`, `date`) VALUES
(2, 1, 1, '::1', '2024-08-17'),
(3, 1, 1, '::1', '2024-08-27'),
(4, 1, 1, '::1', '2024-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `login_sessions`
--

CREATE TABLE `login_sessions` (
  `login_sessions_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `ip_address` varchar(24) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_sessions`
--

INSERT INTO `login_sessions` (`login_sessions_id`, `user_id`, `fingerprint`, `user_agent`, `ip_address`, `datetime`) VALUES
(1, 1, '1b3a35342f7756d39a7bc2a244ce9153cb59cb9c2cb74f131d3065136d18a07c', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', '::1', '2024-10-03 00:56:40'),
(2, 2, '1b3a35342f7756d39a7bc2a244ce9153cb59cb9c2cb74f131d3065136d18a07c', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', '::1', '2024-08-17 17:23:31'),
(3, 1, 'b4c57aa41b7aa9c6952423c308c0141e4549c3ffe8d62cadd8277e2cf2e1d6c5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', '::1', '2024-08-27 01:40:16'),
(4, 1, 'fec84459f8d2acb8064fc3faada61513ba1a3f7d96699e765d2ace4330d6fde0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '::1', '2024-09-28 22:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `partylists`
--

CREATE TABLE `partylists` (
  `partylist_id` int(11) NOT NULL,
  `partylist_name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partylists`
--

INSERT INTO `partylists` (`partylist_id`, `partylist_name`, `department`) VALUES
(1, 'Kahit tress lang', 1),
(2, 'Pasado', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_valid` enum('0','1') NOT NULL DEFAULT '1',
  `expire_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `user_id`, `token`, `is_valid`, `expire_at`) VALUES
(1, 1, '8a990b902372fc6eaf94d4a5495d1016', '0', '2024-08-17 16:51:21'),
(2, 1, 'f7990478f1e1618f8a4fa59bd6400e65', '1', '2024-08-18 01:09:29'),
(3, 1, '41fb29703b69e81524c016e82d778cfc', '0', '2024-08-17 17:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`) VALUES
(1, 'PRESIDENT'),
(2, 'VICE-PRESIDENT INTERNAL'),
(3, 'VICE-PRESIDENT EXTERNAL'),
(4, 'SECRETARY'),
(5, 'ASSISTANT SECRETARY'),
(6, 'TREASURER'),
(7, 'AUDITOR'),
(8, 'PUBLIC INFORMATION OFFICER'),
(9, 'BUSINESS MANAGER'),
(10, 'BUSINESS MANAGER'),
(11, 'SERGEANT-AT-ARMS'),
(12, 'SERGEANT-AT-ARMS'),
(13, 'SERGEANT-AT-ARMS');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) NOT NULL,
  `course` varchar(10) NOT NULL,
  `year_level` varchar(10) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `course`, `year_level`, `department`) VALUES
(1, 'E21-00955', 'Calvin Andrei', 'Caguioa', 'Flores', 'N/A', 'BSIT', '4', 1),
(2, 'E21-00272', 'Romel', 'Candilario', 'Moster', '', 'BSIT', '4', 1),
(4, 'E21-00273', 'Robert', 'Camanzi', 'Estrada', '', 'BSIT', '4', 1),
(5, 'E21-00273', 'John', 'David', 'Santiago', '', 'BSIT', '4', 1),
(6, 'E21-00274', 'Maria', 'Angel', 'Cruz', '', 'BSIT', '4', 1),
(7, 'E22-00278', 'Daniel', 'Joseph', 'Mendoza', '', 'BSIT', '3', 1),
(8, 'E22-00279', 'Sophia', 'Grace', 'Villanueva', '', 'BSIT', '3', 1),
(9, 'E22-00280', 'Joshua', 'Luis', 'Hernandez', '', 'BSIT', '3', 1),
(10, 'E22-00281', 'Isabella', 'Marie', 'Santos', '', 'BSIT', '3', 1),
(11, 'E22-00282', 'Benjamin', 'Francis', 'De Guzman', '', 'BSIT', '3', 1),
(12, 'E23-00283', 'Elijah', 'Andrew', 'Ramirez', '', 'BSIT', '2', 1),
(13, 'E23-00284', 'Chloe', 'Mae', 'Bautista', '', 'BSIT', '2', 1),
(14, 'E23-00285', 'Ethan', 'Gabriel', 'Navarro', '', 'BSIT', '2', 1),
(15, 'E23-00286', 'Olivia', 'Rose', 'Aquino', '', 'BSIT', '2', 1),
(16, 'E23-00287', 'Lucas', 'Xavier', 'Fernandez', '', 'BSIT', '2', 1),
(22, 'E24-00288', 'Samuel', 'Isaiah', 'Morales', '', 'BSIT', '1', 1),
(23, 'E24-00289', 'Mia', 'Claire', 'Rodriguez', '', 'BSIT', '1', 1),
(24, 'E24-00290', 'Aiden', 'Thomas', 'Del Rosario', '', 'BSIT', '1', 1),
(25, 'E24-00291', 'Emily', 'Jade', 'Vergara', '', 'BSIT', '1', 1),
(26, 'E24-00292', 'James', 'Alexander', 'Castillo', '', 'BSIT', '1', 1),
(27, 'E21-00294', 'Sarah', 'Elizabeth', 'Ramirez', '', 'BSMATH', '4', 1),
(28, 'E21-00295', 'Nathan', 'Oliver', 'Cruz', '', 'BSMATH', '4', 1),
(29, 'E21-00296', 'Lily', 'Anne', 'Mendoza', '', 'BSMATH', '4', 1),
(30, 'E21-00297', 'Daniel', 'Christopher', 'Reyes', '', 'BSMATH', '4', 1),
(31, 'E21-00298', 'Emma', 'Kate', 'Flores', '', 'BSMATH', '4', 1),
(32, 'E22-00293', 'Kevin', 'James', 'Gonzales', '', 'BSMATH', '3', 1),
(33, 'E22-00294', 'Grace', 'Anne', 'Bautista', '', 'BSMATH', '3', 1),
(34, 'E22-00295', 'Miguel', 'Angel', 'Lim', '', 'BSMATH', '3', 1),
(35, 'E22-00296', 'Vanessa', 'Joy', 'Santos', '', 'BSMATH', '3', 1),
(36, 'E22-00297', 'Christopher', 'Ryan', 'Morales', '', 'BSMATH', '3', 1),
(42, 'E23-00288', 'Olivia', 'Marie', 'Reyes', '', 'BSMATH', '2', 1),
(43, 'E23-00289', 'Lucas', 'James', 'Torres', '', 'BSMATH', '2', 1),
(44, 'E23-00290', 'Mia', 'Claire', 'Valdez', '', 'BSMATH', '2', 1),
(45, 'E23-00291', 'Noah', 'Daniel', 'Fernandez', '', 'BSMATH', '2', 1),
(46, 'E23-00292', 'Emma', 'Rose', 'Santos', '', 'BSMATH', '2', 1),
(47, 'E24-00293', 'Aiden', 'Leo', 'Ramirez', '', 'BSMATH', '1', 1),
(48, 'E24-00294', 'Sophia', 'Jade', 'Villanueva', '', 'BSMATH', '1', 1),
(49, 'E24-00295', 'Ethan', 'Paul', 'Cruz', '', 'BSMATH', '1', 1),
(50, 'E24-00296', 'Ava', 'Lynn', 'Santos', '', 'BSMATH', '1', 1),
(51, 'E24-00297', 'James', 'Kyle', 'Torres', '', 'BSMATH', '1', 1),
(52, 'E21-00300', 'Daniel', 'Joseph', 'Mendoza', '', 'BAEL', '4', 1),
(53, 'E21-00301', 'Isabella', 'Marie', 'Santos', '', 'BAEL', '4', 1),
(54, 'E21-00302', 'Samuel', 'Isaiah', 'Morales', '', 'BAEL', '4', 1),
(55, 'E21-00303', 'Emily', 'Claire', 'Rodriguez', '', 'BAEL', '4', 1),
(56, 'E21-00304', 'Benjamin', 'Andrew', 'Cruz', '', 'BAEL', '4', 1),
(57, 'E22-00300', 'Mia', 'Kate', 'Villanueva', '', 'BAEL', '3', 1),
(58, 'E22-00301', 'Elijah', 'Thomas', 'Ramirez', '', 'BAEL', '3', 1),
(59, 'E22-00302', 'Grace', 'Anne', 'Bautista', '', 'BAEL', '3', 1),
(60, 'E22-00303', 'Aiden', 'Lucas', 'Fernandez', '', 'BAEL', '3', 1),
(61, 'E22-00304', 'Noah', 'Paul', 'Torres', '', 'BAEL', '3', 1),
(62, 'E23-00300', 'Lucas', 'James', 'Gonzales', '', 'BAEL', '2', 1),
(63, 'E23-00301', 'Olivia', 'Rose', 'Aquino', '', 'BAEL', '2', 1),
(64, 'E23-00302', 'Sophia', 'Claire', 'Valdez', '', 'BAEL', '2', 1),
(65, 'E23-00303', 'Ethan', 'Gabriel', 'Navarro', '', 'BAEL', '2', 1),
(66, 'E23-00304', 'Emma', 'Joy', 'Santos', '', 'BAEL', '2', 1),
(67, 'E24-00300', 'Kevin', 'Michael', 'Reyes', '', 'BAEL', '1', 1),
(68, 'E24-00301', 'Vanessa', 'Joy', 'Morales', '', 'BAEL', '1', 1),
(69, 'E24-00302', 'Aiden', 'Leo', 'Lim', '', 'BAEL', '1', 1),
(70, 'E24-00303', 'Daniel', 'Christopher', 'Santos', '', 'BAEL', '1', 1),
(71, 'E24-00304', 'Sarah', 'Elizabeth', 'Cruz', '', 'BAEL', '1', 1),
(72, 'E21-00300', 'Daniel', 'Joseph', 'Mendoza', '', 'BPA', '4', 1),
(73, 'E21-00301', 'Isabella', 'Marie', 'Santos', '', 'BPA', '4', 1),
(74, 'E21-00302', 'Samuel', 'Isaiah', 'Morales', '', 'BPA', '4', 1),
(75, 'E21-00303', 'Emily', 'Claire', 'Rodriguez', '', 'BPA', '4', 1),
(76, 'E21-00304', 'Benjamin', 'Andrew', 'Cruz', '', 'BPA', '4', 1),
(77, 'E22-00300', 'Mia', 'Kate', 'Villanueva', '', 'BPA', '3', 1),
(78, 'E22-00301', 'Elijah', 'Thomas', 'Ramirez', '', 'BPA', '3', 1),
(79, 'E22-00302', 'Grace', 'Anne', 'Bautista', '', 'BPA', '3', 1),
(80, 'E22-00303', 'Aiden', 'Lucas', 'Fernandez', '', 'BPA', '3', 1),
(81, 'E22-00304', 'Noah', 'Paul', 'Torres', '', 'BPA', '3', 1),
(82, 'E23-00300', 'Lucas', 'James', 'Gonzales', '', 'BPA', '2', 1),
(83, 'E23-00301', 'Olivia', 'Rose', 'Aquino', '', 'BPA', '2', 1),
(84, 'E23-00302', 'Sophia', 'Claire', 'Valdez', '', 'BPA', '2', 1),
(85, 'E23-00303', 'Ethan', 'Gabriel', 'Navarro', '', 'BPA', '2', 1),
(86, 'E23-00304', 'Emma', 'Joy', 'Santos', '', 'BPA', '2', 1),
(87, 'E24-00300', 'Kevin', 'Michael', 'Reyes', '', 'BPA', '1', 1),
(88, 'E24-00301', 'Vanessa', 'Joy', 'Morales', '', 'BPA', '1', 1),
(89, 'E24-00302', 'Aiden', 'Leo', 'Lim', '', 'BPA', '1', 1),
(90, 'E24-00303', 'Daniel', 'Christopher', 'Santos', '', 'BPA', '1', 1),
(91, 'E24-00304', 'Sarah', 'Elizabeth', 'Cruz', '', 'BPA', '1', 1),
(92, 'E21-00300', 'Michael', 'Anthony', 'Santos', '', 'BAP', '4', 1),
(93, 'E21-00301', 'Charlotte', 'Lee', 'Garcia', '', 'BAP', '4', 1),
(94, 'E21-00302', 'David', 'Aaron', 'Cruz', '', 'BAP', '4', 1),
(95, 'E21-00303', 'Sophia', 'Jane', 'Villanueva', '', 'BAP', '4', 1),
(96, 'E21-00304', 'William', 'Jacob', 'Reyes', '', 'BAP', '4', 1),
(97, 'E22-00300', 'Emma', 'Lynn', 'Morales', '', 'BAP', '3', 1),
(98, 'E22-00301', 'Liam', 'George', 'Bautista', '', 'BAP', '3', 1),
(99, 'E22-00302', 'Ava', 'Claire', 'Mendoza', '', 'BAP', '3', 1),
(100, 'E22-00303', 'Noah', 'Michael', 'Ramirez', '', 'BAP', '3', 1),
(101, 'E22-00304', 'Isabella', 'Rose', 'Aquino', '', 'BAP', '3', 1),
(102, 'E23-00300', 'Lucas', 'Ethan', 'Gonzales', '', 'BAP', '2', 1),
(103, 'E23-00301', 'Mia', 'Grace', 'Valdez', '', 'BAP', '2', 1),
(104, 'E23-00302', 'Oliver', 'Jude', 'Torres', '', 'BAP', '2', 1),
(105, 'E23-00303', 'Chloe', 'Marie', 'Castillo', '', 'BAP', '2', 1),
(106, 'E23-00304', 'Aiden', 'Jack', 'Fernandez', '', 'BAP', '2', 1),
(107, 'E24-00300', 'Sarah', 'Anne', 'Lim', '', 'BAP', '1', 1),
(108, 'E24-00301', 'Daniel', 'Christian', 'Santos', '', 'BAP', '1', 1),
(109, 'E24-00302', 'Vanessa', 'Joy', 'Morales', '', 'BAP', '1', 1),
(110, 'E24-00303', 'Kevin', 'Joshua', 'Reyes', '', 'BAP', '1', 1),
(111, 'E24-00304', 'Emily', 'Grace', 'Cruz', '', 'BAP', '1', 1),
(112, 'E21-00300', 'Anthony', 'James', 'Castillo', '', 'BASS', '4', 1),
(113, 'E21-00301', 'Victoria', 'Anne', 'Ramirez', '', 'BASS', '4', 1),
(114, 'E21-00302', 'Christopher', 'Ryan', 'Mendoza', '', 'BASS', '4', 1),
(115, 'E21-00303', 'Samantha', 'Joy', 'Villanueva', '', 'BASS', '4', 1),
(116, 'E21-00304', 'Benjamin', 'Leo', 'Bautista', '', 'BASS', '4', 1),
(117, 'E22-00300', 'Sophia', 'Marie', 'Morales', '', 'BASS', '3', 1),
(118, 'E22-00301', 'Liam', 'Joseph', 'Santos', '', 'BASS', '3', 1),
(119, 'E22-00302', 'Ava', 'Claire', 'Cruz', '', 'BASS', '3', 1),
(120, 'E22-00303', 'Elijah', 'Thomas', 'Aquino', '', 'BASS', '3', 1),
(121, 'E22-00304', 'Mia', 'Grace', 'Valdez', '', 'BASS', '3', 1),
(122, 'E23-00300', 'Oliver', 'David', 'Torres', '', 'BASS', '2', 1),
(123, 'E23-00301', 'Chloe', 'Elizabeth', 'Fernandez', '', 'BASS', '2', 1),
(124, 'E23-00302', 'Aiden', 'Jack', 'Lim', '', 'BASS', '2', 1),
(125, 'E23-00303', 'Emily', 'Kate', 'Reyes', '', 'BASS', '2', 1),
(126, 'E23-00304', 'Lucas', 'Henry', 'Gonzales', '', 'BASS', '2', 1),
(127, 'E24-00300', 'Sarah', 'Joy', 'Mendoza', '', 'BASS', '1', 1),
(128, 'E24-00301', 'Daniel', 'Leo', 'Villanueva', '', 'BASS', '1', 1),
(129, 'E24-00302', 'Vanessa', 'Claire', 'Cruz', '', 'BASS', '1', 1),
(130, 'E24-00303', 'Kevin', 'Christian', 'Santos', '', 'BASS', '1', 1),
(131, 'E24-00304', 'Emma', 'Rose', 'Ramirez', '', 'BASS', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmation_key` varchar(120) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `tfa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `tfa_secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `confirmation_key`, `status`, `date_created`, `tfa_enabled`, `tfa_secret`) VALUES
(1, 'qoshima', 'florescalvs@gmail.com', '$2y$10$HPZvkd8VtukeUijpKMchZukOtLER.CbB9Ttu1CYEy8QKj5o/UhOFm', 'e366acd3386965cfe2106b23587933a3', '1', '2024-08-17 16:43:50', 0, NULL),
(2, 'bitress', 'bytress@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVNMZnRhL1Z2aUExY0tVbw$v+RTRtvGwNm6t++rnEM8n1XmNY8evlSU4OeXAUqPE2o', 'e01b607dffad74f35022f1badfee73f3', '1', '2024-08-17 17:21:20', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `user_activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`user_activity_id`, `user_id`, `last_activity`) VALUES
(1, 1, '2024-09-29 12:15:17'),
(2, 2, '2024-08-17 05:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/images/default/default.png',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `avatar`, `first_name`, `last_name`, `birthdate`) VALUES
(1, 1, 'uploads/avatars/4080221d39566f0e01ccccba0b54ff44.jpg', '', '', '2024-01-01'),
(2, 2, 'assets/images/default/default.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `partylist_id` int(11) DEFAULT NULL,
  `voted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`login_attempts_id`);

--
-- Indexes for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD PRIMARY KEY (`login_sessions_id`);

--
-- Indexes for table `partylists`
--
ALTER TABLE `partylists`
  ADD PRIMARY KEY (`partylist_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`user_activity_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `partylist_id` (`partylist_id`),
  ADD KEY `votes_ibfk_3` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `login_attempts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_sessions`
--
ALTER TABLE `login_sessions`
  MODIFY `login_sessions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partylists`
--
ALTER TABLE `partylists`
  MODIFY `partylist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `user_activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_4` FOREIGN KEY (`partylist_id`) REFERENCES `partylists` (`partylist_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
