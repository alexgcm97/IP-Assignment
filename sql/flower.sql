-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2018 at 06:47 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flower`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `catalogID` int(11) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`catalogID`, `date`) VALUES
(11001, 'July 2018'),
(11002, 'June 2018');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `custType` int(11) NOT NULL,
  `custName` varchar(40) COLLATE utf8_bin NOT NULL,
  `custEmail` varchar(30) COLLATE utf8_bin NOT NULL,
  `creditLimit` double NOT NULL,
  `creditStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` varchar(40) COLLATE utf8_bin NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalAmount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `custID` int(11) NOT NULL,
  `orderType` int(11) NOT NULL,
  `shipAddress` varchar(50) COLLATE utf8_bin NOT NULL,
  `shipDate` date NOT NULL,
  `shipTime` time NOT NULL,
  `grandTotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pdt_catalog`
--

CREATE TABLE `pdt_catalog` (
  `catalogID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdt_catalog`
--

INSERT INTO `pdt_catalog` (`catalogID`, `productID`, `type`) VALUES
(11001, 10001, 'Monthly'),
(11001, 10004, 'Monthly'),
(11001, 10005, 'Monthly'),
(11001, 10006, 'Monthly'),
(11001, 10007, 'Bouquet'),
(11001, 10008, 'Bouquet'),
(11001, 10009, 'Promotion'),
(11001, 10011, 'Promotion'),
(11002, 10002, 'Monthly'),
(11002, 10003, 'Monthly'),
(11002, 10010, 'Promotion');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `name`, `description`, `price`, `stock`, `status`) VALUES
(10001, 'Aconitum', '1 unit, Monthly Sales', 3, 0, 0),
(10002, 'Anemone', '1 unit, Monthly Sales', 3, 50, 1),
(10003, 'Bellflower', '1 unit, Monthly Sales', 3, 50, 1),
(10004, 'Bergenia', '1 unit, Monthly Sales', 3, 50, 1),
(10005, 'Bluebell', '1 unit, Monthly Sales', 3, 0, 0),
(10006, 'Buddleja', '1 unit, Monthly Sales', 3, 50, 1),
(10007, 'Aconitum', 'Bounquet - 10', 40, 50, 1),
(10008, 'Bergenia', 'Bounquet - 10', 40, 50, 1),
(10009, 'Sunset Roses', 'Mother Day', 40, 50, 1),
(10010, 'Sweeter Bloom', 'Mother Day', 40, 50, 1),
(10011, 'Windflower', 'Mother Day', 40, 50, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`catalogID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderID`,`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `custID` (`custID`);

--
-- Indexes for table `pdt_catalog`
--
ALTER TABLE `pdt_catalog`
  ADD PRIMARY KEY (`catalogID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `custID` FOREIGN KEY (`custID`) REFERENCES `customer` (`custID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
