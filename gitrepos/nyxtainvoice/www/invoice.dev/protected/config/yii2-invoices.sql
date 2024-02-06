-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 05:11 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2-invoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTOMER_NO` int(11) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `address1` varchar(30) DEFAULT NULL,
  `address2` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `phone1` varchar(15) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email1` varchar(45) DEFAULT NULL,
  `email2` varchar(45) DEFAULT NULL,
  `NOTES` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTOMER_NO`, `first_name`, `last_name`, `address1`, `address2`, `city`, `state`, `zip`, `phone1`, `phone2`, `email1`, `email2`, `NOTES`) VALUES
(1, 'Yasin', 'Mohammed', '28654654 some street', 'some address line two', 'Fremont', 'CA', '94555', '55555555555', '66666666666', 'yasin_mohammed@yahoo.com', 'yasin_mohammed@yahoo.com', 'This is  a test customer'),
(2, 'Yamina', 'Faridi', '564564 some street', '', 'Fremont', 'CA', '665465', '', '', 'asdfasfdsd@someemail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `st_id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `st_type` int(11) DEFAULT NULL,
  `invoice_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `MODE_ID` int(11) NOT NULL,
  `MODE_DESCRIPTION` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`MODE_ID`, `MODE_DESCRIPTION`) VALUES
(1, 'Check'),
(2, 'Cash'),
(3, 'Credit Card'),
(4, 'Direct Deposit');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `MODE_ID` int(11) NOT NULL,
  `AMOUNT` decimal(10,2) DEFAULT NULL,
  `balance` float(10,2) NOT NULL,
  `PAY_DATE` varchar(20) NOT NULL,
  `DETAILS` varchar(100) DEFAULT NULL,
  `DEPOSITED_BY` varchar(25) DEFAULT NULL,
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `uuser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `st_id` int(11) NOT NULL,
  `st_type` int(11) NOT NULL,
  `quotation_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE `statement` (
  `id` int(11) NOT NULL,
  `st_type` tinyint(4) NOT NULL DEFAULT 0,
  `CUSTOMER_NO` int(11) NOT NULL,
  `VENUE_ID` int(11) NOT NULL,
  `SHIP_DATE` int(11) NOT NULL,
  `CREATE_DATE` varchar(20) NOT NULL,
  `paid` varchar(1) NOT NULL DEFAULT '0',
  `CLOSED` char(1) NOT NULL,
  `NOTES` varchar(255) DEFAULT NULL,
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `uuser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statement_items`
--

CREATE TABLE `statement_items` (
  `ID` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `st_type` int(11) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `QUANTITY` decimal(8,2) DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `profile` text DEFAULT NULL,
  `livel` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `status`, `profile`, `livel`) VALUES
(1, 'admin', 'cc03e747a6afbbcbf8be7668acfebee5', 'asdsd@asdasd.com', 1, 'This is admin user', 10),
(53, 'vara', '8454105ea97bc906cf98a74704cc271d', 'vara.valluri@gmail.com', 0, '', 0),
(54, 'pravinya', 'c47231c0292501d3471d0bb5b1f9ef27', 'pravinya.valluri@gmail.com', 0, 'i love flowers', 0),
(55, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@example.com', 0, 'test user', 6);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `VENUE_ID` int(11) NOT NULL,
  `ship_name` varchar(30) DEFAULT NULL,
  `ship_add1` varchar(30) DEFAULT NULL,
  `ship_add2` varchar(30) DEFAULT NULL,
  `SHIP_city` varchar(30) DEFAULT NULL,
  `SHIP_state` char(2) DEFAULT NULL,
  `SHIP_zip` varchar(6) DEFAULT NULL,
  `SHIP_phone1` varchar(15) DEFAULT NULL,
  `SHIP_phone2` varchar(15) DEFAULT NULL,
  `SHIP_email1` varchar(45) DEFAULT NULL,
  `SHIP_DETAILS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`VENUE_ID`, `ship_name`, `ship_add1`, `ship_add2`, `SHIP_city`, `SHIP_state`, `SHIP_zip`, `SHIP_phone1`, `SHIP_phone2`, `SHIP_email1`, `SHIP_DETAILS`) VALUES
(0, 'same as customer', '', '', '', NULL, '', '', '', '', ''),
(188, 'white house', 'kothapet', 'L.B nagar', 'hyderabad', 'TG', '500036', '9032130433', '9032130433', 'pravinya.valluri@gmail.com', 'birthday of world'),
(198, 'Gokul Palace', 'Rock Ville Phase X', 'Golkonda X-Roads', 'Hyderabad', 'TG', '500001', '3333333333', '4444444444', 'public@privatemail.com', 'public gardens'),
(199, 'Shilpi restaurent', 'Dilsukhnagar', 'Moosarambagh  ', 'Hyderabad', 'TG', '500036', '9032130433', '8332830433', 'purnachandra.valluri@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMER_NO`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`MODE_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `INVOICE_ID` (`INVOICE_ID`),
  ADD KEY `MODE_ID` (`MODE_ID`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `statement`
--
ALTER TABLE `statement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CUSTOMER_NO` (`CUSTOMER_NO`);

--
-- Indexes for table `statement_items`
--
ALTER TABLE `statement_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`VENUE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMER_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `MODE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statement_items`
--
ALTER TABLE `statement_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `VENUE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
