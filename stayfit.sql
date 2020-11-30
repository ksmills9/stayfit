-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 12:22 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stayfit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` varchar(255) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ask_approval_for_removal`
--

CREATE TABLE `ask_approval_for_removal` (
  `Admin_ID` varchar(255) NOT NULL,
  `Staff_ID` varchar(255) NOT NULL,
  `Request_ID` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookablelocation`
--

CREATE TABLE `bookablelocation` (
  `Space_ID` varchar(255) NOT NULL,
  `Space_name` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Capacity` varchar(255) NOT NULL,
  `Open_time` time NOT NULL,
  `Close_time` time NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` varchar(255) NOT NULL,
  `Client_ID` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Start_time` time NOT NULL,
  `End_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `Equipment_ID` varchar(255) NOT NULL,
  `Client_ID` varchar(255) NOT NULL,
  `Purchase_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Client_ID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_booking`
--

CREATE TABLE `equipment_booking` (
  `Client_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL,
  `Equipment_ID` varchar(255) NOT NULL,
  `Quantity_booked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gym_booking`
--

CREATE TABLE `gym_booking` (
  `Client_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL,
  `No_of_guests` int(11) NOT NULL,
  `Space_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `made_past_booking`
--

CREATE TABLE `made_past_booking` (
  `Member_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Client_ID` varchar(255) NOT NULL,
  `Member_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `non_member`
--

CREATE TABLE `non_member` (
  `Client_ID` varchar(255) NOT NULL,
  `last_visited_date` date NOT NULL,
  `last_entry_time` time NOT NULL,
  `last_exit_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL,
  `Amount_paid` float NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `Client_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchasable_equipment`
--

CREATE TABLE `purchasable_equipment` (
  `Equipment_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `In_Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `Purchase_ID` varchar(255) NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rentable_equipment`
--

CREATE TABLE `rentable_equipment` (
  `Equipment_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `space_booking`
--

CREATE TABLE `space_booking` (
  `Client_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL,
  `No_of_guests` int(11) NOT NULL,
  `Space_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `JobTitle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `ask_approval_for_removal`
--
ALTER TABLE `ask_approval_for_removal`
  ADD PRIMARY KEY (`Request_ID`),
  ADD KEY `Admin_IDRefKey` (`Admin_ID`),
  ADD KEY `Staff_IDRefKey` (`Staff_ID`);

--
-- Indexes for table `bookablelocation`
--
ALTER TABLE `bookablelocation`
  ADD PRIMARY KEY (`Space_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `ClientBookingRefKey` (`Client_ID`) USING BTREE;

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`Purchase_ID`),
  ADD KEY `clientBuyRef` (`Client_ID`),
  ADD KEY `equipmentBuyRef` (`Equipment_ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Client_ID`);

--
-- Indexes for table `equipment_booking`
--
ALTER TABLE `equipment_booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `eqClientRef` (`Client_ID`),
  ADD KEY `eqEquipmentRef` (`Equipment_ID`);

--
-- Indexes for table `gym_booking`
--
ALTER TABLE `gym_booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `gymClientRef` (`Client_ID`),
  ADD KEY `gymSpaceRef` (`Space_ID`);

--
-- Indexes for table `made_past_booking`
--
ALTER TABLE `made_past_booking`
  ADD KEY `memberRef` (`Member_ID`),
  ADD KEY `pastBookingRef` (`Booking_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_ID`),
  ADD KEY `MemberClientKey` (`Client_ID`);

--
-- Indexes for table `non_member`
--
ALTER TABLE `non_member`
  ADD PRIMARY KEY (`Client_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `payBookingRef` (`Booking_ID`),
  ADD KEY `payClientRef` (`Client_ID`);

--
-- Indexes for table `purchasable_equipment`
--
ALTER TABLE `purchasable_equipment`
  ADD PRIMARY KEY (`Equipment_ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`Purchase_ID`);

--
-- Indexes for table `rentable_equipment`
--
ALTER TABLE `rentable_equipment`
  ADD PRIMARY KEY (`Equipment_ID`);

--
-- Indexes for table `space_booking`
--
ALTER TABLE `space_booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `spaceClientRef` (`Client_ID`),
  ADD KEY `spaceIDRef` (`Space_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ask_approval_for_removal`
--
ALTER TABLE `ask_approval_for_removal`
  ADD CONSTRAINT `Admin_IDRefKey` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `Staff_IDRefKey` FOREIGN KEY (`Staff_ID`) REFERENCES `staff` (`Staff_ID`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `Client_IDRefKey` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `clientBuyRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `equipmentBuyRef` FOREIGN KEY (`Equipment_ID`) REFERENCES `purchasable_equipment` (`Equipment_ID`),
  ADD CONSTRAINT `purchaseBuyRef` FOREIGN KEY (`Purchase_ID`) REFERENCES `purchase` (`Purchase_ID`);

--
-- Constraints for table `equipment_booking`
--
ALTER TABLE `equipment_booking`
  ADD CONSTRAINT `eqBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`),
  ADD CONSTRAINT `eqClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `eqEquipmentRef` FOREIGN KEY (`Equipment_ID`) REFERENCES `rentable_equipment` (`Equipment_ID`);

--
-- Constraints for table `gym_booking`
--
ALTER TABLE `gym_booking`
  ADD CONSTRAINT `gymBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`),
  ADD CONSTRAINT `gymClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `gymSpaceRef` FOREIGN KEY (`Space_ID`) REFERENCES `bookablelocation` (`Space_ID`);

--
-- Constraints for table `made_past_booking`
--
ALTER TABLE `made_past_booking`
  ADD CONSTRAINT `memberRef` FOREIGN KEY (`Member_ID`) REFERENCES `member` (`Member_ID`),
  ADD CONSTRAINT `pastBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `MemberClientKey` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `non_member`
--
ALTER TABLE `non_member`
  ADD CONSTRAINT `nonMemClientRefKey` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`),
  ADD CONSTRAINT `payClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`);

--
-- Constraints for table `space_booking`
--
ALTER TABLE `space_booking`
  ADD CONSTRAINT `spaceBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`),
  ADD CONSTRAINT `spaceClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`),
  ADD CONSTRAINT `spaceIDRef` FOREIGN KEY (`Space_ID`) REFERENCES `bookablelocation` (`Space_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
