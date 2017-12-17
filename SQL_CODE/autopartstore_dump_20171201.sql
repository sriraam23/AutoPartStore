-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2017 at 05:40 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autopartstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `carinfo`
--

CREATE TABLE `carinfo` (
  `Make` varchar(30) NOT NULL,
  `Model` varchar(30) NOT NULL,
  `MinYear` year(4) NOT NULL,
  `MaxYear` year(4) NOT NULL,
  `PartNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carinfo`
--

INSERT INTO `carinfo` (`Make`, `Model`, `MinYear`, `MaxYear`, `PartNo`) VALUES
('Audi', 'A8', 2005, 2010, '3397001394'),
('BMW', 'I320', 2010, 2017, '3397001394'),
('Honda', 'Civic', 2000, 2010, '3397001394'),
('Mercedes', 'Benz', 2002, 2015, '3397001394'),
('Toyota', 'Carolla', 2002, 2016, '3397001394'),
('Honda', 'Civic', 2000, 2010, '550022779'),
('Toyota', 'Carolla', 2002, 2016, '550022779'),
('Audi', 'A8', 2005, 2010, '550045127'),
('BMW', 'I320', 2010, 2017, '550045127'),
('Audi', 'A8', 2005, 2010, '65-AGM'),
('BMW', 'I320', 2010, 2017, '65-AGM'),
('Honda', 'Civic', 2000, 2010, '65-AGM'),
('Mercedes', 'Benz', 2002, 2015, '65-AGM'),
('Toyota', 'Carolla', 2002, 2016, '65-AGM'),
('Audi', 'A8', 2005, 2010, '78S-DL'),
('Mercedes', 'Benz', 2002, 2015, '78S-DL'),
('Mercedes', 'Benz', 2002, 2015, '813460'),
('Audi', 'A8', 2005, 2010, '97048'),
('BMW', 'I320', 2010, 2017, '97048'),
('Honda', 'Civic', 2000, 2010, '97048'),
('Mercedes', 'Benz', 2002, 2015, '97048'),
('Toyota', 'Carolla', 2002, 2016, '97048'),
('Audi', 'A8', 2005, 2010, 'A3095C'),
('BMW', 'I320', 2010, 2017, 'A3095C'),
('Honda', 'Civic', 2000, 2010, 'A3095C'),
('Mercedes', 'Benz', 2002, 2015, 'A3095C'),
('Toyota', 'Carolla', 2002, 2016, 'A3095C'),
('Audi', 'A8', 2005, 2010, 'DL-19'),
('BMW', 'I320', 2010, 2017, 'DL-19'),
('Honda', 'Civic', 2000, 2010, 'DL-19'),
('Mercedes', 'Benz', 2002, 2015, 'DL-19'),
('Toyota', 'Carolla', 2002, 2016, 'DL-19'),
('Audi', 'A8', 2005, 2010, 'E-1650'),
('Mercedes', 'Benz', 2002, 2015, 'E-1650'),
('Honda', 'Civic', 2000, 2010, 'HD-DLG'),
('Toyota', 'Carolla', 2002, 2016, 'HD-DLG'),
('Toyota', 'Carolla', 2002, 2016, 'SA10720');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatID`) VALUES
('Battery'),
('Filters'),
('Fluids & Chemicals'),
('Tools'),
('Wipers');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Username` varchar(30) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Zipcode` mediumint(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Username`, `Fname`, `Lname`, `Street`, `City`, `State`, `Zipcode`, `Phone`, `Email`) VALUES
('Test1234', 'Test1234', 'Test1234', 'Test1234', 'Test1234', 'Texas', 11111, '(111) 111-1111', 'Test1234@Test1234'),
('Test12345', 'Test12345', 'Test12345', 'Test12345', 'Test12345', 'Texas', 77777, '(777) 777-7777', 'Test12345@Test12345.com');

-- --------------------------------------------------------

--
-- Table structure for table `oinventory`
--

CREATE TABLE `oinventory` (
  `OrQuantity` int(11) NOT NULL,
  `OrderID` varchar(50) NOT NULL,
  `PartNo` varchar(10) NOT NULL,
  `TPPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oinventory`
--

INSERT INTO `oinventory` (`OrQuantity`, `OrderID`, `PartNo`, `TPPrice`) VALUES
(1, 'Test12345_1512027549_48621078', '04159', 23.99),
(1, 'Test12345_1512027549_48621078', '242-5530', 118.99),
(4, 'Test1234_1511995405_17890417', '04159', 95.96),
(3, 'Test1234_1511999707_50660798', '04159', 71.97),
(3, 'Test1234_1511999707_50660798', '242-5530', 356.97),
(1, 'Test1234_1511999780_16529272', '04159', 23.99),
(2, 'Test1234_1512002671_19833722', '01320', 15.98),
(1, 'Test1234_1512002671_19833722', '04159', 23.99),
(1, 'Test1234_1512087154_81294963', '10418', 7.99);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(50) NOT NULL,
  `OrderTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `EDDate` datetime DEFAULT NULL,
  `SDate` datetime DEFAULT NULL,
  `DDate` datetime DEFAULT NULL,
  `Shipped` tinyint(1) NOT NULL DEFAULT '0',
  `Delivered` tinyint(1) NOT NULL DEFAULT '0',
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Zipcode` mediumint(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `Username` varchar(30) NOT NULL,
  `StoreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderTime`, `Cost`, `EDDate`, `SDate`, `DDate`, `Shipped`, `Delivered`, `Street`, `City`, `State`, `Zipcode`, `Username`, `StoreID`) VALUES
('Test12345_1512027549_48621078', '2017-11-30 01:39:09', 142.98, NULL, NULL, NULL, 0, 0, 'Test12345', 'Test12345', 'Texas', 77777, 'Test12345', 1),
('Test1234_1511995405_17890417', '2017-11-29 16:43:25', 95.96, '2017-11-29 00:00:00', '2017-11-29 00:00:00', '2017-11-29 00:00:00', 1, 1, 'Test1234', 'Test1234', 'Texas', 11111, 'Test1234', 1),
('Test1234_1511999707_50660798', '2017-11-29 17:55:07', 428.94, '2017-11-29 00:00:00', '2017-11-29 00:00:00', '2017-11-29 00:00:00', 1, 1, 'Test1234', 'Test1234', 'Texas', 11111, 'Test1234', 1),
('Test1234_1511999780_16529272', '2017-11-29 17:56:20', 23.99, '2017-11-29 00:00:00', '2017-11-29 00:00:00', NULL, 1, 0, 'Test1234', 'Test1234', 'Texas', 11111, 'Test1234', 1),
('Test1234_1512002671_19833722', '2017-11-29 18:44:31', 39.97, '2017-11-29 00:00:00', NULL, NULL, 0, 0, 'Test1234', 'Test1234', 'Texas', 11111, 'Test1234', 1),
('Test1234_1512087154_81294963', '2017-11-30 18:12:34', 7.99, NULL, NULL, NULL, 0, 0, 'Test1234', 'Test1234', 'Texas', 11111, 'Test1234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `PartNo` varchar(10) NOT NULL,
  `Pname` varchar(50) NOT NULL,
  `PCompany` varchar(50) NOT NULL,
  `PImage` varchar(100) DEFAULT 'default.jpg',
  `Price` decimal(10,2) NOT NULL,
  `SubCatID` varchar(50) NOT NULL,
  `WarrantyID` int(11) NOT NULL,
  `Deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`PartNo`, `Pname`, `PCompany`, `PImage`, `Price`, `SubCatID`, `WarrantyID`, `Deleted`) VALUES
('01320', 'Max ATF', 'Royal Purple', '01320.jpg', 9.99, 'Transmission Fluid', 1, 1),
('04159', 'Battery Cable', 'Lynx O.E', '04159.jpg', 23.99, 'Battery Cable', 3, 0),
('06822', 'Transmax DEXRON-VI', 'Castrol', '06822.jpg', 8.39, 'Transmission Fluid', 7, 0),
('10418', 'Multi-Vehicle Automatic Transmission Fluid', 'Lucas', '10418.jpg', 7.99, 'Transmission Fluid', 7, 0),
('242-5530', 'Battery Cable', 'Dorman', '242-5530.jpg', 118.99, 'Battery Cable', 1, 0),
('24454', 'Personal Battery Charger', 'OEM', '24454.jpg', 89.99, 'Battery Booster', 1, 0),
('258-504', 'Air Filter Box', 'Dorman', '258-504.jpg', 165.99, 'Air Filter Box', 4, 0),
('258-521', 'Air Filter Box', 'Dorman', '258-521.jpg', 142.99, 'Air Filter Box', 4, 0),
('258-522', 'Air Filter Box', 'Dorman', '258-522.jpg', 259.99, 'Air Filter Box', 4, 0),
('25886', 'Coiled Cord Circuit Tester', 'OEM', '25886.jpg', 9.99, 'Circuit Tester', 1, 0),
('3397001394', 'Wiper Blade', 'Bosch', '3397001394.jpg', 64.99, 'Wiper Blade', 3, 0),
('42754', 'Wiper Arm', 'Dorman', '42754.jpg', 29.99, 'Wiper Arm', 1, 0),
('550022779', 'Mortor Oil', 'Pennzoil', '550022779.jpg', 6.29, 'Engine Oil', 7, 0),
('550045127', 'Rotella T Triple', 'Shell', '550045127.jpg', 43.99, 'Engine Oil', 7, 0),
('65-AGM', 'Platinum Battery', 'Duralast', '65-agm.jpg', 183.99, 'Battery', 3, 0),
('74-209', 'Wiper Arm', 'Trico HD', '74-209.jpg', 79.99, 'Wiper Arm', 6, 0),
('78S-DL', 'Battery', 'Duralast', '78s-dl.jpg', 122.99, 'Battery', 2, 0),
('813460', 'SynPower Full Synthetic Motor Oil', 'Valvoline', '813460.jpg', 36.99, 'Engine Oil', 7, 0),
('85484', '4 Way Flat Trailer Wiring Circuit Tester', 'Reese Towpower', '85484.jpg', 3.99, 'Circuit Tester', 1, 0),
('86273', 'Conduct-Tite Electrical Multi Tester', 'Dorman', '86273.jpg', 19.99, 'Circuit Tester', 1, 0),
('903-0136', 'Wiper Arm', 'Auto7', '903-0136.jpg', 45.99, 'Wiper Arm', 1, 0),
('97048', 'Wiper Blade', 'PIAA', '97048.jpg', 25.99, 'Wiper Blade', 1, 0),
('A3095C', 'Air Filter', 'ACDelco', 'a3095c.jpg', 39.99, 'Air Filter', 1, 0),
('DL-19', 'Wiper Blade', 'Duralast', 'dl-19.jpg', 9.99, 'Wiper Blade', 1, 0),
('E-1650', 'Air Filter', 'K&N', 'e-1650.jpg', 62.99, 'Air Filter', 1, 0),
('GS235B', 'Gold Battery Cable', 'Duralast', 'gs235b.jpg', 13.99, 'Battery Cable', 1, 0),
('HD-DLG', 'Gold Battery', 'Duralast', 'hd-dlg.jpg', 179.99, 'Battery', 5, 0),
('PBJS32000', 'Emergency 24V Jump Starter', 'POWERALL', 'pbjs32000.jpg', 239.99, 'Battery Booster', 1, 0),
('PSJ-1812', 'ProSeries Portable Battery', 'Schumacher', 'psj-1812.jpg', 149.99, 'Battery Booster', 1, 0),
('SA10720', 'Air Filter', 'STP', 'sa10720.jpg', 24.99, 'Air Filter', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `ServerID` int(11) NOT NULL,
  `SvLocation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`ServerID`, `SvLocation`) VALUES
(1, 'Texas');

-- --------------------------------------------------------

--
-- Table structure for table `sinventory`
--

CREATE TABLE `sinventory` (
  `StQuantity` int(11) NOT NULL,
  `StoreID` int(11) NOT NULL,
  `PartNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sinventory`
--

INSERT INTO `sinventory` (`StQuantity`, `StoreID`, `PartNo`) VALUES
(9, 1, '01320'),
(50, 1, '04159'),
(0, 1, '06822'),
(9, 1, '10418'),
(3, 1, '242-5530'),
(15, 1, '24454'),
(10, 1, '258-504'),
(10, 1, '258-521'),
(10, 1, '258-522'),
(10, 1, '25886'),
(10, 1, '3397001394'),
(10, 1, '42754'),
(10, 1, '550022779'),
(10, 1, '550045127'),
(10, 1, '65-AGM'),
(10, 1, '74-209'),
(10, 1, '78S-DL'),
(10, 1, '813460'),
(10, 1, '85484'),
(10, 1, '86273'),
(10, 1, '903-0136'),
(10, 1, '97048'),
(10, 1, 'A3095C'),
(10, 1, 'DL-19'),
(10, 1, 'E-1650'),
(10, 1, 'GS235B'),
(10, 1, 'HD-DLG'),
(10, 1, 'PBJS32000'),
(10, 1, 'PSJ-1812'),
(10, 1, 'SA10720');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `URL` varchar(50) NOT NULL,
  `StoreID` int(11) NOT NULL,
  `WHouseID` int(11) NOT NULL,
  `ServerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`URL`, `StoreID`, `WHouseID`, `ServerID`) VALUES
('http://autopartstore.heliohost.org/wp', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `SubCatID` varchar(50) NOT NULL,
  `CatID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`SubCatID`, `CatID`) VALUES
('Battery', 'Battery'),
('Battery Cable', 'Battery'),
('Air Filter', 'Filters'),
('Air Filter Box', 'Filters'),
('Engine Oil', 'Fluids & Chemicals'),
('Transmission Fluid', 'Fluids & Chemicals'),
('Battery Booster', 'Tools'),
('Circuit Tester', 'Tools'),
('Wiper Arm', 'Wipers'),
('Wiper Blade', 'Wipers');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SName` varchar(20) NOT NULL,
  `SInfo` varchar(20) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Zipcode` mediumint(5) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SName`, `SInfo`, `Street`, `City`, `State`, `Zipcode`) VALUES
(1, 'Katz', 'Accounting', '361 Burrows Park', 'Richmond', 'Virginia', 23225),
(2, 'Linktype', 'Business Development', '48 Vidon Center', 'El Paso', 'Texas', 88514),
(3, 'Fivebridge', 'Legal', '58 Forest Lane', 'Jamaica', 'New York', 11431),
(4, 'Innotype', 'Product Management', '4 Bowman Alley', 'Young America', 'Minnesota', 55551),
(5, 'Twinder', 'Research and Develop', '01 Texas Junction', 'Des Moines', 'Iowa', 50393),
(6, 'Divape', 'Research and Develop', '63 Sheridan Road', 'Hialeah', 'Florida', 33013),
(7, 'Twiyo', 'Training', '16 Cottonwood Avenue', 'Fullerton', 'California', 92835),
(8, 'Dabjam', 'Accounting', '7 Elka Trail', 'Las Vegas', 'Nevada', 89166),
(9, 'Tagpad', 'Research and Develop', '0 Hagan Parkway', 'Palo Alto', 'California', 94302),
(10, 'Skidoo', 'Training', '5401 Comanche Street', 'Miami', 'Florida', 33175),
(11, 'Thoughtworks', 'Marketing', '83366 Onsgard Pass', 'White Plains', 'New York', 10633),
(12, 'Thoughtbridge', 'Support', '883 Sauthoff Lane', 'Lake Charles', 'Louisiana', 70616),
(13, 'Quatz', 'Legal', '7 Macpherson Park', 'Greensboro', 'North Carolina', 27415),
(14, 'Feedfire', 'Legal', '870 Harper Avenue', 'El Paso', 'Texas', 88553),
(15, 'Voonte', 'Engineering', '4 Randy Junction', 'Oklahoma City', 'Oklahoma', 73104);

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `SupplyDate` datetime NOT NULL,
  `SpQuantity` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `PartNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`SupplyDate`, `SpQuantity`, `SupplierID`, `PartNo`) VALUES
('2017-04-19 15:47:43', 110, 1, '01320'),
('2017-04-19 15:47:43', 110, 1, '06822'),
('2017-04-19 15:47:43', 110, 2, '10418'),
('2017-04-19 15:47:44', 110, 2, '550022779'),
('2017-04-19 15:47:44', 110, 3, '550045127'),
('2017-04-19 15:47:44', 110, 3, '813460'),
('2017-04-19 15:47:45', 110, 4, '04159'),
('2017-04-19 15:47:45', 110, 4, '242-5530'),
('2017-04-19 15:47:46', 110, 5, '24454'),
('2017-04-19 15:47:46', 110, 5, '25886'),
('2017-04-19 15:47:47', 110, 6, '42754'),
('2017-04-19 15:47:47', 110, 6, '85484'),
('2017-04-19 15:47:47', 110, 7, '86273'),
('2017-04-19 15:47:48', 110, 7, '903-0136'),
('2017-04-19 15:47:48', 110, 8, '97048'),
('2017-04-19 15:47:48', 110, 8, 'A3095C'),
('2017-04-19 15:47:48', 110, 9, 'DL-19'),
('2017-04-19 15:47:49', 110, 9, 'E-1650'),
('2017-04-19 15:47:49', 110, 10, 'GS235B'),
('2017-04-19 15:47:49', 110, 10, 'PBJS32000'),
('2017-04-19 15:47:49', 110, 11, 'PSJ-1812'),
('2017-04-19 15:47:50', 110, 11, 'SA10720'),
('2017-04-19 15:47:50', 110, 12, '78S-DL'),
('2017-04-19 15:47:51', 110, 12, '3397001394'),
('2017-04-19 15:47:51', 110, 13, '65-AGM'),
('2017-04-19 15:47:52', 110, 13, '258-504'),
('2017-04-19 15:47:52', 110, 14, '258-521'),
('2017-04-19 15:47:52', 110, 14, '258-522'),
('2017-04-19 15:47:52', 110, 15, '74-209'),
('2017-04-19 15:47:52', 110, 15, 'HD-DLG');

-- --------------------------------------------------------

--
-- Table structure for table `usercart`
--

CREATE TABLE `usercart` (
  `PartNo` varchar(10) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `PartQuantity` int(11) NOT NULL DEFAULT '1',
  `PPrice` decimal(10,2) NOT NULL,
  `TPPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usercart`
--

INSERT INTO `usercart` (`PartNo`, `Username`, `PartQuantity`, `PPrice`, `TPPrice`) VALUES
('10418', 'Test1234', 1, 7.99, 7.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `Admin`) VALUES
('Test1234', '$2y$10$9t8PtVKo7EOGQCDJG7G/m.AddfYiAqARnySgXUfJm/4EN5.VzMc3S', 1),
('Test12345', '$2y$10$mCAh4qLtRckhV1XRTx8XVu07eXaA33HH72QWmzkDTMn8emo.vJatq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

CREATE TABLE `warranty` (
  `WarrantyID` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`WarrantyID`, `Type`) VALUES
(1, '1 Year'),
(2, '2 Year'),
(3, '3 Year'),
(4, '4 Year'),
(5, '5 Year'),
(6, 'Limited Liftime'),
(7, 'No Warranty');

-- --------------------------------------------------------

--
-- Table structure for table `whouse`
--

CREATE TABLE `whouse` (
  `WHouseID` int(11) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Zipcode` mediumint(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `whouse`
--

INSERT INTO `whouse` (`WHouseID`, `Street`, `City`, `State`, `Zipcode`) VALUES
(1, '11 Westerfield Point', 'Los Angeles', 'California', 90094);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carinfo`
--
ALTER TABLE `carinfo`
  ADD PRIMARY KEY (`Make`,`Model`,`MinYear`,`MaxYear`,`PartNo`),
  ADD KEY `carinfo_ibfk_1` (`PartNo`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `oinventory`
--
ALTER TABLE `oinventory`
  ADD PRIMARY KEY (`OrderID`,`PartNo`),
  ADD KEY `oinventory_ibfk_2` (`PartNo`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `orders_ibfk_1` (`Username`),
  ADD KEY `orders_ibfk_2` (`StoreID`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`PartNo`),
  ADD KEY `SubCatID` (`SubCatID`),
  ADD KEY `WarrantyID` (`WarrantyID`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`ServerID`);

--
-- Indexes for table `sinventory`
--
ALTER TABLE `sinventory`
  ADD PRIMARY KEY (`StoreID`,`PartNo`),
  ADD KEY `PartNo` (`PartNo`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreID`),
  ADD KEY `WHouseID` (`WHouseID`),
  ADD KEY `ServerID` (`ServerID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`SubCatID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`SupplyDate`,`SupplierID`,`PartNo`),
  ADD KEY `SupplierID` (`SupplierID`),
  ADD KEY `PartNo` (`PartNo`);

--
-- Indexes for table `usercart`
--
ALTER TABLE `usercart`
  ADD PRIMARY KEY (`PartNo`,`Username`),
  ADD KEY `usercart_ibfk_2` (`Username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`WarrantyID`);

--
-- Indexes for table `whouse`
--
ALTER TABLE `whouse`
  ADD PRIMARY KEY (`WHouseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `ServerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `WarrantyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `whouse`
--
ALTER TABLE `whouse`
  MODIFY `WHouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carinfo`
--
ALTER TABLE `carinfo`
  ADD CONSTRAINT `carinfo_ibfk_1` FOREIGN KEY (`PartNo`) REFERENCES `part` (`PartNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oinventory`
--
ALTER TABLE `oinventory`
  ADD CONSTRAINT `oinventory_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oinventory_ibfk_2` FOREIGN KEY (`PartNo`) REFERENCES `part` (`PartNo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `customer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`SubCatID`) REFERENCES `subcategory` (`SubCatID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `part_ibfk_2` FOREIGN KEY (`WarrantyID`) REFERENCES `warranty` (`WarrantyID`) ON UPDATE CASCADE;

--
-- Constraints for table `sinventory`
--
ALTER TABLE `sinventory`
  ADD CONSTRAINT `sinventory_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sinventory_ibfk_2` FOREIGN KEY (`PartNo`) REFERENCES `part` (`PartNo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`WHouseID`) REFERENCES `whouse` (`WHouseID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `store_ibfk_2` FOREIGN KEY (`ServerID`) REFERENCES `server` (`ServerID`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `category` (`CatID`) ON UPDATE CASCADE;

--
-- Constraints for table `supplies`
--
ALTER TABLE `supplies`
  ADD CONSTRAINT `supplies_ibfk_1` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`) ON UPDATE CASCADE;

--
-- Constraints for table `usercart`
--
ALTER TABLE `usercart`
  ADD CONSTRAINT `usercart_ibfk_1` FOREIGN KEY (`PartNo`) REFERENCES `part` (`PartNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercart_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `customer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `customer` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
