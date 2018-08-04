-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2018 at 05:41 AM
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
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`catalogID`, `date`) VALUES
(11001, 'January 2018'),
(11002, 'August 2018');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `custType` int(11) NOT NULL,
  `custName` varchar(40) COLLATE utf8_bin NOT NULL,
  `custEmail` varchar(30) COLLATE utf8_bin NOT NULL,
  `creditLimit` double NOT NULL,
  `creditBalance` double NOT NULL,
  `creditStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `password`, `custType`, `custName`, `custEmail`, `creditLimit`, `creditBalance`, `creditStatus`) VALUES
(1001, 'abc123', 1, 'Alex', 'alex@gmail.com', 0, 0, 1),
(1002, 'def123', 2, 'Steve', 'steve@hotmail.com', 2000, 1500, 1),
(1003, '123456', 2, 'Jake', 'jake@gmail.com', 500, 0, 0);

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

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderID`, `productID`, `name`, `description`, `price`, `quantity`, `totalAmount`) VALUES
(1001, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 5, 15),
(1001, 10003, 'Bellflower', '1 unit, Monthly Sales', 3, 99, 297),
(1001, 10007, 'Aconitum', 'Bounquet - 10', 40, 81, 3240),
(1001, 10010, 'Sweeter Bloom', 'Mother Day', 40, 5, 200),
(1002, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 99, 297),
(1002, 10008, 'Bergenia', 'Bounquet - 10', 40, 81, 3240),
(1002, 10010, 'Sweeter Bloom', 'Mother Day', 40, 820, 32800),
(1003, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 287, 861),
(1004, 10003, 'Bellflower', '1 unit, Monthly Sales', 3, 55, 165),
(1005, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 50, 150),
(1005, 10010, 'Sweeter Bloom', 'Mother Day', 40, 5, 200),
(1006, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 1, 3),
(1006, 10010, 'Sweeter Bloom', 'Mother Day', 40, 1, 40),
(1007, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 50, 150),
(1008, 10003, 'Bellflower', '1 unit, Monthly Sales', 3, 20, 60),
(1009, 10002, 'Anemone', '1 unit, Monthly Sales', 3, 2, 6),
(1009, 10003, 'Bellflower', '1 unit, Monthly Sales', 3, 55, 165),
(1010, 10004, 'Bergenia', '1 unit, Monthly Sales', 3, 55, 165);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `custID` int(11) NOT NULL,
  `shipMethod` int(11) NOT NULL,
  `shipAddress` varchar(50) COLLATE utf8_bin NOT NULL,
  `shipDate` date NOT NULL,
  `shipTime` time NOT NULL,
  `grandTotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `custID`, `shipMethod`, `shipAddress`, `shipDate`, `shipTime`, `grandTotal`) VALUES
(1001, '2018-08-01', 1001, 2, '123, Jalan Abc, Taman DEF, 52100 Kepong', '2018-08-05', '12:30:00', 3752),
(1002, '2018-08-01', 1001, 2, '1230943, Jalan GGGGG, Taman ZZZZZ', '2018-08-05', '08:00:00', 36337),
(1003, '2018-08-01', 1001, 1, '-', '2018-08-05', '08:00:00', 861),
(1004, '2018-08-01', 1001, 1, '-', '2018-08-06', '08:00:00', 165),
(1005, '2018-08-02', 1001, 1, '-', '2018-08-05', '12:00:00', 350),
(1006, '2018-08-02', 1001, 2, '12, Jalan DDD', '2018-08-06', '08:00:00', 43),
(1007, '2018-08-02', 1002, 1, '-', '2018-08-08', '08:00:00', 150),
(1008, '2018-08-02', 1001, 1, '-', '2018-08-05', '08:00:00', 60),
(1009, '2018-08-02', 1001, 1, '-', '2018-08-05', '08:00:00', 171),
(1010, '2018-08-03', 1001, 2, '123, Jalan Abc, Taman DEF, 52100 Kepong', '2018-08-06', '08:00:00', 165);

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
(11001, 10006, 'Monthly'),
(11001, 10009, 'Promotion'),
(11001, 10011, 'Promotion'),
(11002, 10002, 'Monthly'),
(11002, 10003, 'Monthly'),
(11002, 10004, 'Monthly'),
(11002, 10005, 'Monthly'),
(11002, 10007, 'Bouquet'),
(11002, 10008, 'Bouquet'),
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
