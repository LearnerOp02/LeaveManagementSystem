-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2025 at 05:11 AM
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
-- Database: `awtproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `user_id`, `title`, `leave_type`, `from_date`, `to_date`, `reason`, `status`, `created_at`, `total_days`) VALUES
(1, 1, 'Demo1', 'sick', '2025-09-19', '2025-09-20', 'Having fever ', 'approved', '2025-09-19 05:08:18', 2),
(2, 3, 'Leave Due to Health Issue', 'sick', '2025-09-28', '2025-09-29', 'I was experiencing slight pain in my heart and need rest/medical consultation. Hence, I am unable to attend on the mentioned date.', 'approved', '2025-09-28 13:39:18', 2),
(3, 9, 'Annual Vacation - Demo Leave', 'vacation', '2025-11-07', '2025-11-28', 'dsdswqsw', 'approved', '2025-11-07 17:09:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('employee','owner') DEFAULT 'employee',
  `phone` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `account_holder_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`id`, `name`, `email`, `password`, `role`, `phone`, `date_of_birth`, `gender`, `account_holder_name`, `account_number`, `ifsc_code`, `bank_name`, `branch_name`, `created_at`) VALUES
(1, 'Demo User', 'demo.user@company.com', '$2b$12$MoubV.HxFnq67M0vy9prHefIl42MjDTQiYhLtQaAwt4X1PPf0GY9y', 'employee', '9998887777', '1995-01-15', 'male', 'Demo User', '112233445566', 'SBIN0001234', 'State Bank of India', 'Nerul Branch', '2025-09-19 05:05:13'),
(2, 'Owner Admin', 'owner.admin@example.com', '$2b$12$npZynNs6IN1pxoMtDhM8Qu39cZsvtD0AhYhednBgYjShri6djTGzK', 'owner', '9887766554', '1980-12-05', 'male', 'Owner Admin', '556677889900', 'HDFC0004321', 'HDFC Bank', 'Navi Mumbai Branch', '2025-09-19 05:10:34'),
(3, 'Demo User 2', 'demo.user2@company.com', '$2y$10$u5MiXiRyJH2XuablE1kEs.fAnrKF4NOJmQ5x26r6/InvSwhqnzLEa', 'employee', '1234567890', '2002-06-03', 'male', 'Demo User2', '1234567890', 'NBIN123456', 'SBI', 'Mulund', '2025-09-19 05:55:18'),
(4, 'Amol Patil', 'amol.patil@company.com', '$2y$10$1GKgixXWNERsUI9Tv55tpekiY4Mo/rTFd1tCYda5w3m7fWdoJbaPm', 'employee', '1234567890', '2002-06-04', 'male', 'Amol Patil', '1234567890', 'NBIN123456', 'SBI', 'Mulund', '2025-10-01 13:56:07'),
(9, 'Sakshi Patil', 'sakshi.patil@company.com', '$2y$10$lICHxlkYuWEobDvuPhP/JuzbN0JQ5/uA/Lxw1KnQFpkoqFN/boks6', 'employee', '8855393477', '2025-11-14', 'female', 'Sakshi Patil', '1234567890', '12345678', 'ICIC', 'Parel', '2025-11-07 17:08:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD CONSTRAINT `leave_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_db` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
