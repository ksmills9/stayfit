-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2020 at 07:08 PM
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

--
-- Dumping data for table `bookablelocation`
--

INSERT INTO `bookablelocation` (`Space_ID`, `Space_name`, `Location`, `Capacity`, `Open_time`, `Close_time`, `Price`) VALUES
('G101', 'Fitness Centre/Gym', 'Kinesiology Block', '500', '07:00:00', '18:00:00', 4),
('SC101', 'Squash Court 1', 'Kinesiology Block', '2', '07:00:00', '18:00:00', 2),
('TC101', 'Tennis Court 1', 'Behind Cascade Hall', '8', '08:00:00', '20:00:00', 6);

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

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `Client_ID`, `Date`, `Start_time`, `End_time`) VALUES
('E236435434', '23455', '2020-10-15', '15:00:00', '17:00:00'),
('E23696734', '23455', '2020-10-17', '10:00:00', '12:00:00'),
('E24387924097', '12345', '2020-09-14', '13:00:00', '14:00:00'),
('E66555555', '23455', '2019-05-15', '15:00:00', '17:00:00'),
('E6666661', '23455', '2020-09-18', '10:00:00', '13:00:00'),
('E67760', '23455', '2015-09-19', '13:00:00', '14:00:00'),
('E6776060', '23455', '2020-06-19', '15:00:00', '17:00:00'),
('E677606780', '23455', '2020-06-19', '15:00:00', '17:00:00'),
('E6777660', '23455', '2020-06-19', '15:00:00', '17:00:00'),
('E6777710', '23455', '2020-06-19', '15:00:00', '17:00:00'),
('E677777', '23455', '2020-06-19', '15:00:00', '17:00:00'),
('E7474747', '23455', '2020-10-15', '10:00:00', '13:00:00'),
('E7474748', '23455', '2020-12-15', '10:00:00', '13:00:00'),
('G11111', '23455', '2020-07-19', '16:00:00', '17:00:00'),
('G22222', '23455', '2020-07-20', '15:00:00', '17:00:00'),
('S11111', '12345', '2020-07-19', '16:00:00', '17:00:00'),
('S22222', '12345', '2020-07-29', '10:00:00', '12:00:00'),
('S33333', '33456', '2019-07-29', '10:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `Equipment_ID` varchar(255) NOT NULL,
  `Client_ID` varchar(255) NOT NULL,
  `Purchase_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`Equipment_ID`, `Client_ID`, `Purchase_ID`) VALUES
('1', '23455', '1'),
('1', '23455', '10'),
('1', '23455', '4');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Client_ID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Client_ID`, `FirstName`, `LastName`) VALUES
('12345', 'Kevin', 'Test'),
('23455', 'Bryan', 'Test'),
('33456', 'Aryo', 'Test');

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

--
-- Dumping data for table `equipment_booking`
--

INSERT INTO `equipment_booking` (`Client_ID`, `Booking_ID`, `Equipment_ID`, `Quantity_booked`) VALUES
('23455', 'E236435434', 'T232232', 4),
('23455', 'E23696734', 'T232232', 3),
('12345', 'E24387924097', 'T232232', 7),
('23455', 'E66555555', 'T232232', 4),
('23455', 'E6666661', 'T232232', 1),
('23455', 'E67760', 'T232232', 2),
('23455', 'E6776060', 'T232232', 1),
('23455', 'E677606780', 'T232232', 1),
('23455', 'E6777660', 'T232232', 1),
('23455', 'E6777710', 'T232232', 1),
('23455', 'E677777', 'T232232', 1),
('23455', 'E7474747', 'T232232', 2),
('23455', 'E7474748', 'T232232', 2);

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

--
-- Dumping data for table `gym_booking`
--

INSERT INTO `gym_booking` (`Client_ID`, `Booking_ID`, `No_of_guests`, `Space_ID`) VALUES
('23455', 'G11111', 4, 'G101'),
('23455', 'G22222', 4, 'G101');

-- --------------------------------------------------------

--
-- Table structure for table `made_past_booking`
--

CREATE TABLE `made_past_booking` (
  `Member_ID` varchar(255) NOT NULL,
  `Booking_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `made_past_booking`
--

INSERT INTO `made_past_booking` (`Member_ID`, `Booking_ID`) VALUES
('24858202', 'G11111'),
('24858202', 'G22222'),
('24858202', 'E66555555'),
('30592224', 'S11111'),
('30592224', 'S22222'),
('24858202', 'E7474747'),
('24858202', 'E7474748');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Client_ID` varchar(255) NOT NULL,
  `Member_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Client_ID`, `Member_ID`) VALUES
('12345', '30592224'),
('23455', '24858202');

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

--
-- Dumping data for table `non_member`
--

INSERT INTO `non_member` (`Client_ID`, `last_visited_date`, `last_entry_time`, `last_exit_time`) VALUES
('33456', '2020-10-06', '10:50:00', '12:00:00');

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

--
-- Dumping data for table `purchasable_equipment`
--

INSERT INTO `purchasable_equipment` (`Equipment_ID`, `Name`, `Price`, `In_Stock`) VALUES
('1', 'Tennis Ball', '4', 89);

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

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`Purchase_ID`, `Time`, `Date`, `Quantity`) VALUES
('1', '10:00:00', '2019-07-29', 2),
('10', '13:00:00', '2020-07-29', 5),
('4', '12:00:00', '2019-07-29', 4);

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

--
-- Dumping data for table `rentable_equipment`
--

INSERT INTO `rentable_equipment` (`Equipment_ID`, `Name`, `Quantity`, `Price`) VALUES
('T232232', 'Tennis Racket', 92, 1.5);

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

--
-- Dumping data for table `space_booking`
--

INSERT INTO `space_booking` (`Client_ID`, `Booking_ID`, `No_of_guests`, `Space_ID`) VALUES
('12345', 'S11111', 1, 'SC101'),
('12345', 'S22222', 1, 'TC101'),
('33456', 'S33333', 2, 'TC101');

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
  ADD CONSTRAINT `eqBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eqClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eqEquipmentRef` FOREIGN KEY (`Equipment_ID`) REFERENCES `rentable_equipment` (`Equipment_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gym_booking`
--
ALTER TABLE `gym_booking`
  ADD CONSTRAINT `gymBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gymClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gymSpaceRef` FOREIGN KEY (`Space_ID`) REFERENCES `bookablelocation` (`Space_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `made_past_booking`
--
ALTER TABLE `made_past_booking`
  ADD CONSTRAINT `memberRef` FOREIGN KEY (`Member_ID`) REFERENCES `member` (`Member_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pastBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `MemberClientKey` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `non_member`
--
ALTER TABLE `non_member`
  ADD CONSTRAINT `nonMemClientRefKey` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `spaceBookingRef` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spaceClientRef` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`Client_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spaceIDRef` FOREIGN KEY (`Space_ID`) REFERENCES `bookablelocation` (`Space_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
