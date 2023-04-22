-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2022 at 02:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Email`, `Password`) VALUES
('6ebdb757-3e46-4086-ba27-ec67e8d1d798\r\n', 'admin@gmail.com', 'admin'),
('2bacecc5-114d-49e8-9148-653316416bac', 'admin@gmail.com', '$2b$10$3ZsjJdDo3jteGYLGzAglY.yUl/nFHjGuH6AnE7zcUxB...\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_id` varchar(50) NOT NULL,
  `User_id` varchar(50) DEFAULT NULL,
  `diagnose` varchar(250) NOT NULL,
  `symptoms` varchar(250) NOT NULL,
  `tested` varchar(250) NOT NULL,
  `neighbor` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `Staff_id` varchar(50) NOT NULL,
  `Not_pending` tinyint(1) DEFAULT 0,
  `Role` varchar(255) DEFAULT NULL,
  `Appointment_Time` varchar(250) DEFAULT NULL,
  `history` tinyint(1) DEFAULT 0,
  `email` varchar(250) DEFAULT NULL,
  `start` varchar(250) DEFAULT NULL,
  `end` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_id`, `User_id`, `diagnose`, `symptoms`, `tested`, `neighbor`, `gender`, `date`, `status`, `Staff_id`, `Not_pending`, `Role`, `Appointment_Time`, `history`, `email`, `start`, `end`) VALUES
('bfb2e90b-e7bd-4cb3-98c7-d6cf2b757af9', NULL, 'Yes', 'Loss of Taste/Smell', 'Yes', 'Yes', 'Yes', '2022-04-27', 0, '', 0, NULL, '', 0, NULL, NULL, NULL),
('5a66cce4-9427-45ba-9393-f8edfd7852fa', NULL, 'No', 'Runny Nose', 'No', 'No', 'No', '2022-04-29', 0, '', 0, NULL, '', 0, NULL, NULL, NULL),
('47d5140a-bd91-4da2-8ec5-c01524b28030', '72cf5a72-c51f-4587-a7de-d1bd2a99bebb', 'Yes', 'Loss of Taste/Smell', 'Yes', 'Yes', 'Yes', '2022-04-29', 0, '', 0, NULL, '', 0, NULL, NULL, NULL),
('42bd101e-470c-4b02-8660-b8f9b889eaec', NULL, 'No', 'Runny Nose', 'No', 'No', 'No', '2022-05-13', 0, '', 0, 'Library Staff', NULL, 0, 'john@gmail.com', NULL, NULL),
('248c5f9d-4ab2-43a0-a4dc-134f10296f5a', '1cc79f0c-4f93-4b73-a719-29f7e518cec9', 'Yes', 'Runny Nose', 'No', 'Yes', 'No', '2022-05-19', 0, '', 0, 'Library Staff', NULL, 0, 'john@gmail.com', NULL, NULL),
('71997be9-b74f-43c5-9d75-89b010de9968', '52b7cbb3-21fe-45b2-b3ab-190c16e3853e', 'No', 'Difficulty Breathing', 'No', 'No', 'No', '2022-05-13', 0, '', 0, 'Library Staff', NULL, 0, 'marloaquino0213@gmail.com', NULL, NULL),
('6f411b01-2891-47f5-ae11-8a651bb402a9', '52b7cbb3-21fe-45b2-b3ab-190c16e3853e', 'No', 'Difficulty Breathing', 'No', 'No', 'No', '2022-05-12', 0, '1cc79f0c-4f93-4b73-a719-29f7e518cec9', 1, 'Professor', '2022-05-02 14:46:28', 0, 'marloaquino0213@gmail.com', '06:30', '07:30'),
('0651236b-45e5-4427-b81c-8a1f47f28eda', '539005e8-d358-4028-82b6-0a449aa8f7ce', 'No', 'Runny Nose', 'No', 'No', 'No', '2022-05-21', 0, '1cc79f0c-4f93-4b73-a719-29f7e518cec9', 1, 'Professor', '2022-05-14 12:49:44', 0, 'marloaquino080621@gmail.com', '02:49', '02:49'),
('46f6e7a4-ed1b-4ef1-8546-f6276c909c8d', '539005e8-d358-4028-82b6-0a449aa8f7ce', 'No', 'None', 'No', 'No', 'No', '2022-05-20', 0, '1cc79f0c-4f93-4b73-a719-29f7e518cec9', 1, 'Professor', '2022-05-14 12:51:51', 0, 'marloaquino080621@gmail.com', '12:54', '00:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `expires` int(11) UNSIGNED NOT NULL,
  `data` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `expires`, `data`) VALUES
('bFV_n7x7LhsBvuau1q9k17yvIuy_-r1q', 1652590312, '{\"cookie\":{\"originalMaxAge\":86400000,\"expires\":\"2022-05-15T04:51:51.736Z\",\"httpOnly\":true,\"path\":\"/\"},\"flash\":{},\"passport\":{\"user\":{\"Staff_id\":\"1cc79f0c-4f93-4b73-a719-29f7e518cec9\"}}}');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_id` varchar(50) NOT NULL,
  `Fname` varchar(250) NOT NULL,
  `Mname` varchar(250) DEFAULT NULL,
  `Lname` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Role` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_id`, `Fname`, `Mname`, `Lname`, `Email`, `Password`, `Role`) VALUES
('1cc79f0c-4f93-4b73-a719-29f7e518cec9', 'John', 'M', 'Doe', 'john@gmail.com', '$2b$10$sQXvU5DbtQCYvC.98yn5s.rfp7bXB1UFdsrjOouc0NWWE5z7E9HuS', 'Professor'),
('f3f3eb45-1de1-403c-abd5-6296db69b13d', 'Febbie', 'L', 'Garcia', 'Febbie@gmail.com', '$2b$10$9poL0KNKwRFlw3nKxTgVrONJ85cj6EEqLvVeQnlzWLj6RH39ZYrcu', 'Library Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` varchar(40) NOT NULL,
  `Fname` varchar(250) NOT NULL,
  `Mname` varchar(250) DEFAULT NULL,
  `Lname` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Fname`, `Mname`, `Lname`, `Email`, `Password`, `Verified`) VALUES
('72cf5a72-c51f-4587-a7de-d1bd2a99bebb', 'Febbie', 'L', 'Garcia', 'Febbie@gmail.com', '$2b$10$8iwpX0iMLrRilhiVsgw.ue6VSInNFma6Oo8r7GbsQEMua.ksWwl5S', 0),
('539005e8-d358-4028-82b6-0a449aa8f7ce', 'Student', 'M', 'Student', 'marloaquino080621@gmail.com', '$2b$10$582ue58Cz70xyYb6RBiDQeV3vQ9ItLJeChKseNtzOJ0KeaXnST6AW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
