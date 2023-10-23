-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 12:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dtr_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CalculateTotalHours` (IN `emp_id` INT, IN `log_date` DATE)   BEGIN
    DECLARE total_hours DECIMAL(5, 2);
    SELECT 
        (TIME_TO_SEC(Time_Out_AM) - TIME_TO_SEC(Time_In_AM) + TIME_TO_SEC(Time_Out_PM) - TIME_TO_SEC(Time_In_PM)) / 3600
    INTO total_hours
    FROM Attendance
    WHERE Employee_ID = emp_id AND Date = log_date;
    
    UPDATE Attendance
    SET Total_Hours = total_hours
    WHERE Employee_ID = emp_id AND Date = log_date;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Attendance_ID` int(11) NOT NULL,
  `Employee_ID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time_In_AM` time DEFAULT NULL,
  `Time_Out_AM` time DEFAULT NULL,
  `Time_In_PM` time DEFAULT NULL,
  `Time_Out_PM` time DEFAULT NULL,
  `Total_Hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Attendance_ID`, `Employee_ID`, `Date`, `Time_In_AM`, `Time_Out_AM`, `Time_In_PM`, `Time_Out_PM`, `Total_Hours`) VALUES
(1, 1, '2023-10-23', '07:30:00', '11:30:00', '13:00:00', '00:00:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Employee_ID` int(11) NOT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Employee_ID`, `First_Name`, `Last_Name`, `Department`, `Email`) VALUES
(1, 'Justin', 'Cauilan', 'CICS', 'cuilanjustin@sjcbi.edu.ph'),
(2, 'Reden Jester', 'Ocon', 'CICS', 'oconredenjester@sjcbi.edu.ph');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Attendance_ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `Employee_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
