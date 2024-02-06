-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2016 at 08:21 PM
-- Server version: 5.6.24
-- PHP Version: 5.4.41

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii2-invoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE IF NOT EXISTS `card_type` (
  `id` int(11) NOT NULL,
  `card_type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`id`, `card_type`) VALUES
(1, 'American Express'),
(2, 'Discover'),
(3, 'MasterCard'),
(4, 'Visa'),
(5, 'Diners Club'),
(6, 'JCB'),
(7, 'Laser'),
(8, 'Maestro'),
(9, 'UnionPay'),
(10, 'Visa Electron'),
(11, 'Dankort');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_no` int(11) NOT NULL,
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
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_no`, `first_name`, `last_name`, `address1`, `address2`, `city`, `state`, `zip`, `phone1`, `phone2`, `email1`, `email2`, `notes`) VALUES
(1, 'Yasin', 'Mohammed', '28654654 some street', 'some address line two', 'Fremont', 'CA', '94555', '55555555555', '66666666666', 'yasin_mohammed@yahoo.com', 'yasin_mohammed@yahoo.com', 'This is  a test customer'),
(2, 'Yamina', 'Faridi', '564564 some street', '', 'Fremont', 'CA', '665465', '', '', 'asdfasfdsd@someemail.com', '', ''),
(3, 'chandra', 'valluri', '12-586-67/45', 'some address line 2', 'Hyderabad', 'In', '500025', '(568) 956-5686', '9045678789', 'purnachandra.valluri@gmail.com', '', 'hi bnhfhn'),
(4, 'Pravinya', 'Valluri', 'Professors Colony', 'Malakpet', 'Htderabad', '', '', '(903) 213-0433', '8331832700', 'pravinya.valluri@gmail.com', '', ''),
(5, 'Kishore', 'Rathe', '25-42', 'Ganesh Nagar, Ramanthapur', 'hyderabad', 'TG', '50020', '(258) 758-5587', '', 'kishore.rathe@mymail.com', '', ''),
(6, 'honey', 'nithila', 'finland', 'helsinki', 'helsiki', '', '', '9032130433', '', 'honey1@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_cards`
--

CREATE TABLE IF NOT EXISTS `customer_cards` (
  `id` int(11) NOT NULL,
  `customer_no` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `card_number` varchar(30) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_expiry_mn` varchar(2) NOT NULL,
  `card_expiry_yr` varchar(2) NOT NULL,
  `card_csc` varchar(6) NOT NULL,
  `street_number` varchar(225) NOT NULL,
  `route` varchar(100) NOT NULL,
  `locality` varchar(100) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `country` varchar(50) NOT NULL,
  `administrative_area_level_1` varchar(50) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_cards`
--

INSERT INTO `customer_cards` (`id`, `customer_no`, `card_type`, `card_number`, `card_name`, `card_expiry_mn`, `card_expiry_yr`, `card_csc`, `street_number`, `route`, `locality`, `postal_code`, `country`, `administrative_area_level_1`, `status`) VALUES
(3, 1, 2, '56456456', 'chandra', '07', '17', '253', 'prof colony', '', 'malakpet', '500036', 'India', 'hyderabad', '1'),
(14, 1, 2, '1234 1234 1234 1234', 'chandra2', '03', '23', '253', 'prof colony2', '', 'malakpet Extension-2', '500036', 'India', 'hyderabad', '1'),
(15, 2, 8, '12355 54212 5244 8552', 'fbhsdfhhndfh fcversgf', '02', '17', '254', '11/12/4/A/101-47', '', 'Madhapur', '500002', 'India', 'Hyderabad', '1'),
(16, 2, 9, '4152 1245 524 4125', 'chandra', '09', '23', '524', 'dfhbfgchnfgc', 'yhbdhbde', 'Hyderabad', '500036', 'India', 'hyderabad', '2'),
(17, 2, 9, '123 46446756 123 3456', 'fgrff', '03', '20', '890', '5657', 'tyhgfnfg', 'Madhapur', '500002', 'India', 'Hyderabad', '1'),
(18, 5, 4, '25242 5235 254125 85425', 'Kishore', '09', '20', '125', '56-6346/5ret5', 'Ramanthapur', 'Hyderabad', '52.02541', 'India', 'Telengana', '1'),
(19, 5, 7, '45824512 78542 89652 23658', 'Harishwar', '04', '20', '745', 'fgregdfg', 'yuhjfjn', 'Hendersonville', '28791', 'USA', 'NC', '1'),
(20, 3, 8, '4564 2365 7655 3453', 'Hareesh', '02', '21', '454', '45-45', 'rtrtere', 'hyderabad', '50020', 'Australia', 'tel', '1'),
(21, 3, 10, '3453 1254 7876 4576', 'hrtfhgfh', '04', '21', '455', '', '', '', '', '', '', '1'),
(22, 4, 2, '3456 6456 6456 5464', 'Pravinya', '05', '18', '765', '4546-54', 'road side', 'Mascot', '500001', 'India', 'Telangana', '1');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `emp_type_id` smallint(5) unsigned NOT NULL COMMENT 'PK: Unique employee type ID',
  `designation` varchar(32) NOT NULL COMMENT 'Employee designation(driver delivery boy, office asst.)',
  `design_abbr` varchar(8) DEFAULT NULL COMMENT 'Optional abbreviation for contact type'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`emp_type_id`, `designation`, `design_abbr`) VALUES
(1, 'OTHER', NULL),
(17, 'driver', 'DRV'),
(18, 'delivery', 'DLV');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` smallint(5) unsigned NOT NULL COMMENT 'PK: Unique contact ID',
  `emp_type_id` smallint(5) unsigned DEFAULT NULL COMMENT 'FK: contact_type table (donor, business, etc.)',
  `title` varchar(8) DEFAULT NULL COMMENT 'Primary contact title (Mr., Dr., etc.)',
  `first_name` varchar(32) DEFAULT NULL COMMENT 'employee first name',
  `last_name` varchar(32) DEFAULT NULL,
  `address1` varchar(64) DEFAULT NULL COMMENT 'First line of address, usually required',
  `address2` varchar(32) DEFAULT NULL COMMENT 'Second line of address, usually optional',
  `city` varchar(32) DEFAULT NULL COMMENT 'city or town',
  `state` varchar(32) DEFAULT NULL COMMENT 'FK: state table, state or provence',
  `postal_code` varchar(16) DEFAULT NULL COMMENT 'Postal code like US zip code',
  `country` varchar(32) DEFAULT NULL COMMENT 'Country name, use US for United states',
  `phone1` varchar(32) DEFAULT NULL COMMENT 'Contact choice for primary phone',
  `phone2` varchar(32) DEFAULT NULL COMMENT 'Contact choice for secondary phone',
  `email` varchar(64) DEFAULT NULL COMMENT 'Primary email address',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date record created. Insert NULL for current timestamp',
  `notes` text COMMENT 'Freeform text field'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='Employee information';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_type_id`, `title`, `first_name`, `last_name`, `address1`, `address2`, `city`, `state`, `postal_code`, `country`, `phone1`, `phone2`, `email`, `date_created`, `notes`) VALUES
(1, 1, 'Ms', 'Siripravinya', '', '45-45', 'hyderabad', 'hyderabad', 'te', '50020', NULL, '8331852700', '', '', '2015-12-19 06:32:59', ''),
(2, 17, NULL, 'MIsidieik', 'Gtyhjy', '345-5343', 'hyderabad', 'hyderabad', 'tg', '50020', NULL, '', '', '', '2015-12-19 06:38:11', ''),
(5, 1, NULL, 'Helooguru', 'Dvfgbg', '5yrtfy', 'tyr', '', '', '', NULL, '', '', '', '2015-12-19 06:52:56', ''),
(9, 1, 'Mr', 'Mallareddy', '', '', '', '', '', '', NULL, '9133310241', '', '', '2015-12-19 10:17:00', ''),
(10, 17, 'Mrs', 'Hello', 'Miss', 'yttygh-78iutrjr', 'hkmnhfsrhsr', 'grdsgsdh', 'AA', 'rgrfhb', NULL, '90iu65tw', 'e8o890', 'hello@miss.com', '2015-12-19 10:33:18', 'hello miss'),
(11, 17, 'Mr', 'Andreus', 'Gonzalez', '90-342/C/D', 'Profesors Colony, Malakpet', 'Hyderabad', 'TG', '500036', NULL, '9032130433', '', '', '2015-12-20 03:19:20', ''),
(12, 18, 'Mr', 'badri', '', '', '', '', '', '', NULL, '', '', '', '2015-12-28 15:02:48', ''),
(13, 1, 'Ms', 'Unnathi', 'Gupta', 'professors colony', 'hyderabad', '', '', '', NULL, '9133310241', '', '', '2015-12-28 15:11:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `st_id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `st_type` int(11) DEFAULT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `delv_from` datetime NOT NULL,
  `delv_to` datetime NOT NULL,
  `pick_from` datetime NOT NULL,
  `pick_to` datetime NOT NULL,
  `delv_act` datetime NOT NULL,
  `pick_act` datetime NOT NULL,
  `pack_instr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`st_id`, `ref_id`, `st_type`, `invoice_id`, `delv_from`, `delv_to`, `pick_from`, `pick_to`, `delv_act`, `pick_act`, `pack_instr`) VALUES
(1, NULL, 2, '1258258', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, NULL, 2, 'IN2345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, NULL, 2, 'IN2003', '2015-12-24 14:40:00', '2015-12-25 02:10:00', '2015-12-26 23:59:00', '2015-12-26 06:20:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, NULL, 2, 'inv6710345', '2015-12-30 20:30:00', '2016-01-05 18:00:00', '2016-01-19 23:59:00', '2016-01-20 17:40:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(7, NULL, 2, 'IN2005', '2015-12-16 12:00:00', '2015-12-18 13:30:00', '2015-12-19 10:05:00', '2015-12-25 12:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(8, NULL, 2, 'IN2006', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(9, NULL, 2, 'IN2007', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(10, NULL, 2, 'IN2008', '2015-11-18 22:30:00', '2015-11-28 22:30:00', '2015-11-17 23:00:00', '2015-11-28 23:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(11, NULL, 2, 'in004', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(12, NULL, 2, 'in678', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(13, NULL, 2, 'IN2010', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(14, NULL, 2, 'IN2011', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-11-11 10:00:00', '2015-11-20 10:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(15, NULL, 2, 'in005', '2016-01-12 03:00:00', '2016-01-12 10:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Packing instructions:\n1. Lift the chairs\n2. Place them in order'),
(17, NULL, 2, 'IN1210', '2016-05-09 10:15:00', '2016-05-09 20:55:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(18, NULL, 2, 'IN6456', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(19, NULL, 2, 'IN1279', '2016-02-16 07:00:00', '2016-02-16 10:30:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(20, NULL, 2, 'IN4251', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(21, NULL, 2, 'IN4121', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(23, NULL, 2, 'IN4455', '2015-12-29 00:00:00', '2015-12-29 13:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(27, NULL, 2, 'INV345104', '2016-01-07 12:00:00', '2016-01-07 16:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-01-07 01:15:00', '0000-00-00 00:00:00', ''),
(36, NULL, 2, 'IVQ1023', '2016-08-13 08:25:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Packing Instructions:\n1. Pack carefully.\n2. Lift the goods.\n3. Handle with care.\n4. Reach safely.\n5.Delivery done.'),
(39, NULL, 2, 'in345', '2016-01-09 13:10:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Please note that EditableSaver performs only update of existing records!\nTo create new record you should use another action, see example in EditableDetailView.');

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE IF NOT EXISTS `mode` (
  `MODE_ID` int(11) NOT NULL,
  `MODE_DESCRIPTION` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
-- Table structure for table `movement`
--

CREATE TABLE IF NOT EXISTS `movement` (
  `id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL COMMENT 'Fk:invoice id',
  `mov_date` date NOT NULL,
  `mov_type` tinyint(1) NOT NULL COMMENT '1-delivery, 2-pickup',
  `mov_time_start` varchar(20) NOT NULL COMMENT 'Start Time of delivery or pickup',
  `mov_time_end` varchar(20) NOT NULL COMMENT 'End time of delivery/pickup',
  `truck_number` varchar(100) NOT NULL COMMENT 'vehicle identification',
  `instructions` text NOT NULL COMMENT 'additional notes for delivery/pickup',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uuser_id` smallint(5) NOT NULL,
  `cuser_id` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movement`
--

INSERT INTO `movement` (`id`, `st_id`, `mov_date`, `mov_type`, `mov_time_start`, `mov_time_end`, `truck_number`, `instructions`, `create_time`, `update_time`, `uuser_id`, `cuser_id`) VALUES
(2, 6, '2015-12-25', 1, '02:10 AM', '', '', 'Delivery instructions for in2004 to be started immediately by mallareddy', '2015-12-22 05:38:23', '2015-12-25 08:40:09', 1, 1),
(3, 6, '2015-12-25', 2, '02:45 PM', '', '', 'kcr garu', '2015-12-25 08:49:53', '2015-12-25 08:54:44', 1, 1),
(4, 15, '2015-12-29', 1, '2016-01-05 12:00', '', '', 'Delivery instructions:\r\n1. Pickup charirs\r\n2.lift ladders.\r\n3.Deliver on time.', '2015-12-25 18:04:14', '2015-12-29 11:38:59', 1, 1),
(5, 23, '2015-12-29', 1, '2015-12-29 16:00', '', '', 'lkukjjklghkhjkgkyf', '2015-12-29 13:35:47', '2015-12-29 13:36:40', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mov_employee`
--

CREATE TABLE IF NOT EXISTS `mov_employee` (
  `mov_id` int(11) NOT NULL,
  `emp_id` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mov_employee`
--

INSERT INTO `mov_employee` (`mov_id`, `emp_id`) VALUES
(2, 1),
(2, 2),
(2, 5),
(2, 10),
(4, 1),
(4, 5),
(4, 10),
(4, 9),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`ID`, `INVOICE_ID`, `MODE_ID`, `AMOUNT`, `balance`, `PAY_DATE`, `DETAILS`, `DEPOSITED_BY`, `created`, `modified`, `cuser_id`, `uuser_id`) VALUES
(1, 1, 2, '7000.00', 0.00, '09-14-2015', 'deposited by me cash 7000', 'me', 1442230897, 1442230897, 1, 1),
(2, 5, 3, '40000.00', 0.00, '11-25-2015', '', '', 1448449086, 1448449086, 1, 1),
(3, 5, 1, '25000.00', 0.00, '11-25-2015', '', '', 1448449166, 1448449166, 1, 1),
(4, 5, 2, '15500.00', 0.00, '11-25-2015', '', '', 1448450181, 1448450181, 1, 1),
(5, 5, 1, '2100.00', 0.00, '11-25-2015', '', '', 1448450228, 1448450228, 1, 1),
(6, 5, 3, '5050.00', 0.00, '11-25-2015', '', '', 1448450425, 1448450425, 1, 1),
(7, 6, 2, '1100.00', 0.00, '11-25-2015', '', '', 1448451009, 1448451009, 1, 1),
(8, 6, 4, '780.00', 0.00, '11-25-2015', '', '', 1448451034, 1448451034, 1, 1),
(9, 6, 2, '500.00', 0.00, '11-25-2015', '', '', 1448451089, 1448451089, 1, 1),
(10, 5, 1, '10000.00', 0.00, '11-25-2015', '', '', 1448451161, 1448451161, 1, 1),
(11, 5, 2, '15.00', 0.00, '11-25-2015', '', '', 1448451185, 1448451185, 1, 1),
(12, 6, 1, '20000.00', 0.00, '11-25-2015', '', '', 1448452303, 1448452303, 1, 1),
(13, 7, 1, '50000.00', 0.00, '11-25-2015', '', '', 1448452561, 1448452561, 1, 1),
(14, 7, 3, '25000.00', 0.00, '11-25-2015', '', '', 1448452588, 1448452588, 1, 1),
(15, 7, 1, '20000.00', 0.00, '11-25-2015', '', '', 1448452612, 1448452612, 1, 1),
(16, 7, 1, '5000.00', 0.00, '11-25-2015', '', '', 1448452639, 1448452639, 1, 1),
(17, 7, 4, '10000.00', 0.00, '11-25-2015', '', '', 1448452663, 1448452663, 1, 1),
(18, 7, 2, '10000.00', 0.00, '11-25-2015', '', '', 1448452686, 1448452686, 1, 1),
(19, 7, 2, '50.00', 0.00, '11-25-2015', '', '', 1448452713, 1448452713, 1, 1),
(20, 14, 2, '3000.00', 0.00, '11-28-2015', '', '', 1448760652, 1448760652, 1, 1),
(21, 15, 3, '3000.00', 0.00, '12-26-2015', 'by credit card', 'yasin', 1451124858, 1451124858, 1, 1),
(22, 6, 1, '18.00', 0.00, '12-26-2015', 'complete the payment', '', 1451137638, 1451137638, 1, 1),
(23, 6, 1, '18628.25', 0.00, '12-26-2015', 'gsdgsdgsdfvws', '', 1451137697, 1451137697, 1, 1),
(24, 18, 4, '25000.00', 0.00, '12-28-2015', '', '', 1451306186, 1451306186, 1, 1),
(25, 18, 2, '15000.00', 0.00, '12-28-2015', '', '', 1451306222, 1451306222, 1, 1),
(26, 18, 4, '50000.00', 0.00, '12-28-2015', '', '', 1451306281, 1451306281, 1, 1),
(27, 19, 3, '500.00', 0.00, '12-28-2015', '', '', 1451307951, 1451307951, 1, 1),
(28, 19, 1, '1234.00', 0.00, '12-28-2015', '', '', 1451307985, 1451307985, 1, 1),
(29, 19, 2, '900.00', 0.00, '12-28-2015', '', '', 1451308037, 1451308037, 1, 1),
(30, 19, 4, '30.00', 0.00, '12-28-2015', '', '', 1451308060, 1451308060, 1, 1),
(31, 20, 1, '25600.00', 0.00, '12-28-2015', '', '', 1451316529, 1451316529, 1, 1),
(32, 20, 3, '6000.00', 0.00, '12-28-2015', '', '', 1451316552, 1451316552, 1, 1),
(33, 18, 3, '15000.00', 0.00, '12-29-2015', '', '', 1451394019, 1451394019, 1, 1),
(34, 18, 1, '100.00', 0.00, '12-29-2015', '', '', 1451394070, 1451394070, 1, 1),
(35, 27, 2, '12000.00', 0.00, '01-04-2016', 'cash by hand', 'chandra', 1451919853, 1451919853, 1, 1),
(36, 27, 2, '12000.00', 0.00, '01-04-2016', 'cash by hand', 'chandra', 1451919854, 1451919854, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE IF NOT EXISTS `quotation` (
  `st_id` int(11) NOT NULL,
  `st_type` int(11) NOT NULL,
  `quotation_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`st_id`, `st_type`, `quotation_id`) VALUES
(3, 1, 'QT2001'),
(4, 1, 'QT2002'),
(5, 1, 'QT2003'),
(6, 1, 'QT2004'),
(7, 1, 'QT2005'),
(12, 1, 'qt564'),
(13, 1, 'QT2010'),
(14, 1, 'QT2011'),
(16, 1, 'QT1234'),
(17, 1, 'QT1010'),
(18, 1, 'QT6456'),
(19, 1, 'QT1279'),
(20, 1, 'QT4251'),
(22, 1, 'QT3344'),
(24, 1, 'qt1089'),
(25, 1, 'Qt111'),
(26, 1, 'qt9090'),
(27, 1, 'qt90900'),
(28, 1, 'qttest1'),
(29, 1, 'qt5678'),
(30, 1, 'qt1321'),
(31, 1, 'qt1515'),
(32, 1, 'qw345'),
(33, 1, 'qa123'),
(34, 1, 'qt3412'),
(35, 1, 'QS12AZ'),
(36, 1, 'QL9012'),
(37, 1, 'Qt0987'),
(38, 1, 'Qt09871'),
(39, 1, 'Qr345'),
(40, 1, 'QZ3412');

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE IF NOT EXISTS `statement` (
  `id` int(11) NOT NULL,
  `st_type` tinyint(4) NOT NULL DEFAULT '0',
  `customer_no` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `ship_date` date NOT NULL,
  `CREATE_DATE` varchar(20) NOT NULL,
  `paid` varchar(1) NOT NULL DEFAULT '0',
  `closed` char(1) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  `cuser_id` int(11) NOT NULL,
  `uuser_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statement`
--

INSERT INTO `statement` (`id`, `st_type`, `customer_no`, `venue_id`, `ship_date`, `CREATE_DATE`, `paid`, `closed`, `notes`, `created`, `modified`, `cuser_id`, `uuser_id`) VALUES
(1, 2, 3, 188, '2015-11-13', '11-27-2015', '0', '', NULL, 1442230489, 1448625596, 1, 1),
(2, 2, 1, 188, '2015-11-27', '11-25-2015', '0', '', NULL, 1448254100, 1448447796, 1, 1),
(3, 1, 2, 188, '2015-12-24', '12-19-2015', '0', '', NULL, 1448446635, 1450587721, 1, 1),
(4, 1, 1, 199, '2015-12-10', '11-28-2015', '0', '', NULL, 1448447571, 1448766622, 1, 1),
(5, 2, 1, 188, '2015-12-25', '12-26-2015', '1', '', NULL, 1448448291, 1451125016, 1, 1),
(6, 2, 2, 188, '2016-01-05', '01-04-2016', '1', '', NULL, 1448450519, 1451931911, 1, 1),
(7, 2, 3, 0, '2015-12-15', '12-16-2015', '1', '', NULL, 1448451995, 1450327002, 1, 1),
(8, 2, 1, 188, '0000-00-00', '11-25-2015', '0', '', NULL, 1448455799, 1448456295, 1, 1),
(9, 2, 1, 199, '0000-00-00', '11-25-2015', '0', '', NULL, 1448456353, 1448456354, 1, 1),
(10, 2, 1, 188, '2015-11-30', '01-04-2016', '0', '', NULL, 1448456893, 1451917268, 1, 1),
(11, 2, 2, 188, '2015-12-16', '11-28-2015', '0', '', NULL, 1448621621, 1448760839, 1, 1),
(12, 2, 1, 188, '2015-11-27', '11-27-2015', '0', '', NULL, 1448622050, 1448622392, 1, 1),
(13, 2, 3, 188, '0000-00-00', '11-28-2015', '0', '', NULL, 1448729570, 1448731391, 1, 1),
(14, 2, 3, 188, '2015-11-30', '11-28-2015', '0', '', NULL, 1448731452, 1448764384, 1, 1),
(15, 2, 3, 188, '2016-01-12', '01-04-2016', '0', '', NULL, 1451066490, 1451934567, 1, 1),
(16, 1, 1, 198, '2016-01-11', '01-04-2016', '0', '', NULL, 1451125047, 1451931808, 1, 1),
(17, 2, 1, 188, '2016-01-05', '01-03-2016', '0', '', NULL, 1451197369, 1451885134, 1, 1),
(18, 2, 2, 199, '2015-12-30', '12-29-2015', '0', '', NULL, 1451304923, 1451448105, 1, 1),
(19, 2, 3, 188, '2016-02-17', '01-04-2016', '0', '', NULL, 1451307692, 1451897579, 1, 1),
(20, 2, 2, 198, '2016-02-25', '01-03-2016', '0', '', NULL, 1451316040, 1451884000, 1, 1),
(21, 2, 1, 199, '2016-01-26', '12-28-2015', '0', '', NULL, 1451361260, 1451368689, 1, 1),
(22, 1, 6, 188, '2016-01-02', '12-29-2015', '0', '', NULL, 1451394370, 1451394783, 1, 1),
(23, 2, 3, 198, '2015-12-30', '12-30-2015', '0', '', NULL, 1451394843, 1451496769, 1, 1),
(24, 1, 3, 200, '2016-01-14', '12-29-2015', '0', '', NULL, 1451417587, 1451418333, 1, 1),
(25, 1, 4, 198, '2016-01-12', '12-29-2015', '0', '', NULL, 1451417921, 1451417924, 1, 1),
(26, 1, 3, 188, '2016-01-13', '12-29-2015', '0', '', NULL, 1451418357, 1451418497, 1, 1),
(27, 2, 4, 198, '2016-02-12', '01-04-2016', '0', '', NULL, 1451418523, 1451933004, 1, 1),
(28, 1, 2, 199, '2016-01-12', '12-29-2015', '0', '', NULL, 1451445876, 1451445876, 1, 1),
(29, 1, 1, 198, '0000-00-00', '01-02-2016', '0', '', NULL, 1451721898, 1451721898, 1, 1),
(30, 1, 1, 198, '0000-00-00', '01-02-2016', '0', '', NULL, 1451721952, 1451721952, 1, 1),
(31, 1, 1, 188, '0000-00-00', '01-02-2016', '0', '', NULL, 1451722118, 1451722118, 1, 1),
(32, 1, 1, 198, '0000-00-00', '01-02-2016', '0', '', NULL, 1451722257, 1451722257, 1, 1),
(33, 1, 1, 188, '2016-01-22', '01-02-2016', '0', '', NULL, 1451722550, 1451722550, 1, 1),
(34, 1, 2, 0, '2016-02-17', '01-02-2016', '0', '', NULL, 1451759424, 1451759424, 1, 1),
(35, 1, 1, 198, '2016-01-14', '01-02-2016', '0', '', NULL, 1451760241, 1451760241, 1, 1),
(36, 2, 3, 198, '2016-01-29', '01-04-2016', '0', '', NULL, 1451794961, 1451938831, 1, 1),
(37, 1, 1, 199, '2016-01-29', '01-04-2016', '0', '', NULL, 1451890613, 1451932065, 1, 1),
(38, 1, 1, 199, '2016-01-21', '01-03-2016', '0', '', NULL, 1451890623, 1451890623, 1, 1),
(39, 2, 3, 198, '2016-01-22', '01-04-2016', '0', '', NULL, 1451897682, 1451927130, 1, 1),
(40, 1, 1, 199, '2016-03-10', '01-04-2016', '0', '', NULL, 1451931290, 1451931583, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statement_items`
--

CREATE TABLE IF NOT EXISTS `statement_items` (
  `ID` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `st_type` tinyint(4) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `QUANTITY` decimal(8,2) DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statement_items`
--

INSERT INTO `statement_items` (`ID`, `st_id`, `st_type`, `DESCRIPTION`, `QUANTITY`, `PRICE`, `status`, `sequence`) VALUES
(1, 1, 2, 'New pencils for item one review and update', '25.00', '12.58', 1, 1),
(2, 1, 2, 'new latest invoice iem', '36.00', '213.25', 1, 2),
(3, 2, 2, 'HOuse', '1.00', '2345.00', 1, 1),
(4, 3, 1, 'Chairs', '125.00', '250.00', 1, 1),
(5, 3, 1, 'gift covers', '125.00', '3.00', 1, 2),
(6, 3, 1, 'balloons', '200.00', '5.00', 1, 3),
(7, 3, 1, 'return gifts', '100.00', '125.00', 1, 4),
(8, 3, 1, 'tables', '155.00', '155.00', 1, 5),
(9, 4, 2, 'ipods', '10.00', '1000.00', 1, 1),
(10, 4, 2, 'ipads', '20.00', '1500.00', 1, 2),
(11, 4, 2, 'monitors', '10.00', '2000.00', 1, 3),
(12, 4, 2, 'keyboards', '29.00', '200.00', 1, 4),
(13, 5, 2, 'mouses micky', '200.00', '2127.30', 1, 1),
(14, 5, 2, 'mousepads', '200.00', '33.00', 1, 2),
(15, 5, 2, 'keyboards', '215.00', '247.00', 1, 3),
(16, 5, 2, 'VGA cables', '125.00', '100.00', 1, 4),
(17, 6, 2, 'pencils', '200.00', '5.00', 1, 1),
(18, 6, 2, 'Apsara Erasers', '500.00', '10.50', 1, 3),
(19, 6, 2, 'sharpeners old', '223.00', '1.75', 1, 4),
(20, 6, 2, 'acrylic paints', '189.00', '14.00', 1, 6),
(21, 7, 2, 'school bags', '234.00', '430.00', 1, 1),
(22, 7, 2, 'long notebooks', '500.00', '25.00', 1, 3),
(23, 7, 2, 'short notebooks', '315.00', '22.00', 1, 2),
(24, 10, 2, 'Item for invoice party', '25.00', '48.00', 1, 1),
(25, 10, 2, 'invoice for party two', '45.00', '84.00', 1, 2),
(26, 11, 2, 'fghdfgsdgfsdgf', '45.00', '14.50', 1, 1),
(27, 11, 2, 'fvghdfgsdgsdgsda', '67.00', '12.78', 1, 2),
(28, 11, 2, 'gfjdfhbd rgf edf', '23.00', '12.00', 1, 3),
(29, 12, 2, 'hrdfbfhxdhxdnh', '45.00', '56.00', 1, 1),
(30, 13, 2, 'flowers', '121.00', '19.00', 1, 1),
(31, 13, 2, 'bouquets', '111.00', '12.35', 1, 2),
(32, 13, 2, 'decorative items', '233.00', '22.12', 1, 3),
(33, 14, 2, 'books', '112.00', '23.00', 1, 1),
(34, 14, 2, 'bags', '221.00', '12.00', 1, 2),
(36, 16, 1, 'Bulk chair cusion', '300.00', '20.00', 1, 1),
(37, 16, 1, 'Round tables', '345.00', '5.40', 1, 2),
(38, 16, 1, 'Carpet 59 meter', '4.00', '12.00', 1, 3),
(41, 6, 2, 'New for testing', '234.00', '12.00', 1, 2),
(42, 6, 2, 'another new item', '345.00', '98.00', 1, 5),
(45, 17, 2, 'First Item in this quote', '45.00', '23.30', 1, 3),
(46, 17, 2, 'Second Item this quote', '333.00', '11.00', 1, 4),
(48, 18, 2, 'knitting crochets loom', '120.00', '430.00', 0, 1),
(50, 18, 2, 'rubber bands set', '115.00', '20.00', 0, 3),
(51, 18, 2, 'jumpling pins', '200.00', '12.00', 0, 4),
(54, 19, 2, 'lighting lamps india made 2016', '25.00', '38.00', 1, 5),
(55, 20, 2, 'frocks new style not', '114.00', '199.00', 1, 1),
(56, 20, 2, 'shirts old style more', '123.00', '111.00', 1, 2),
(57, 20, 2, 'pinafores', '320.00', '139.00', 1, 3),
(58, 21, 2, 'Customer time zone issue is pending', '45.00', '12.44', 1, 1),
(59, 21, 2, 'Pdf conversion is not working', '32.00', '145.20', 1, 2),
(60, 22, 2, 'rainbow looms', '25.00', '500.00', 1, 1),
(61, 22, 2, 'Yarn', '20.00', '39.00', 1, 2),
(62, 22, 2, 'glitter', '46.00', '64.00', 1, 3),
(63, 22, 2, 'chocolate moulds', '29.00', '92.00', 1, 4),
(64, 22, 2, 'candle wax', '31.00', '13.00', 1, 5),
(65, 23, 2, 'rubber bands', '23.00', '32.00', 1, 1),
(66, 23, 2, 'thermocol sheets', '48.00', '85.00', 1, 2),
(67, 19, 2, 'Balloons India make', '218.00', '112.00', 1, 4),
(74, 19, 2, 'powerlooms', '7.80', '56.00', 1, 3),
(79, 19, 2, 'light loom', '1.00', '11.00', 1, 2),
(82, 19, 2, 'new allow ween empty', '11.00', '21.00', 1, 1),
(84, 19, 2, 'hello good party', '55.00', '56.00', 1, 0),
(86, 19, 2, 'seq testing', '14.50', '12.00', 1, 6),
(89, 19, 2, 'monthly mess', '25.00', '11.00', 1, 7),
(94, 19, 2, 'yearly mess', '12.00', '365.00', 1, 9),
(95, 19, 2, 'minute mess', '12.00', '60.00', 1, 10),
(96, 20, 2, 'fanfare new arrival', '12.00', '200.00', 1, 0),
(97, 20, 2, 'malli vasta', '102.00', '100.00', 1, 1),
(98, 20, 2, 'agarbatti agar', '20.00', '142.00', 1, 2),
(99, 20, 2, 'murali rava', '10.50', '201.00', 1, 0),
(100, 20, 2, 'hello new items to come', '20.00', '14.00', 1, 0),
(101, 36, 2, 'lick stip for rent done', '102.34', '21.00', 1, 1),
(103, 36, 2, 'gorgeous attempt', '102.34', '17.00', 1, 5),
(108, 17, 2, 'chair covers', '43.00', '0.45', 1, 1),
(109, 17, 2, 'chair covers gh', '14.00', '15.00', 1, 2),
(110, 36, 2, 'why ajax', '14.00', '24.00', 1, 4),
(111, 36, 2, 'why post', '102.00', '2.50', 1, 3),
(112, 36, 2, 'why guruji', '24.00', '10.00', 1, 2),
(117, 36, 2, 'heloo owern', '1.20', '21.00', 1, 12),
(122, 6, 2, 'dsffdgergh vcbd', '67.60', '23.00', 1, 0),
(123, 17, 2, 'hello fine tune invoice', '15.00', '12.47', 1, 5),
(124, 17, 2, 'New row for testing', '110.00', '45.47', 1, 6),
(125, 36, 2, 'android line app for install', '10.00', '14.00', 1, 13),
(126, 27, 2, 'Now come to my home for party all the night', '120.00', '104.43', 1, 1),
(127, 27, 2, 'Chougun abreyeengan', '1.20', '11.00', 1, 2),
(128, 40, 2, 'fgrgdg', '23.00', '34.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `profile` text
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `status`, `profile`) VALUES
(1, 'admin', 'cc03e747a6afbbcbf8be7668acfebee5', 'asdsd@asdasd.com', 1, 'This is admin user'),
(53, 'vara', '8454105ea97bc906cf98a74704cc271d', 'vara.valluri@gmail.com', 0, ''),
(54, 'pravinya', 'c47231c0292501d3471d0bb5b1f9ef27', 'pravinya.valluri@gmail.com', 0, 'i love flowers'),
(55, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@example.com', 0, 'test user'),
(57, 'Nithila', 'a983462a4fd58f5a5c605978d10a2d9a', 'nithila@gmail.com', 0, 'nithila12');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `ship_name`, `ship_add1`, `ship_add2`, `SHIP_city`, `SHIP_state`, `SHIP_zip`, `SHIP_phone1`, `SHIP_phone2`, `SHIP_email1`, `SHIP_DETAILS`) VALUES
(0, 'same as customer', '', '', '', NULL, '', '', '', '', ''),
(188, 'white house', 'kothapet', 'L.B nagar', 'hyderabad', 'TG', '500036', '9032130433', '9032130433', 'pravinya.valluri@gmail.com', 'birthday of world'),
(198, 'Gokul Palace', 'Rock Ville Phase X', 'Golkonda X-Roads', 'Hyderabad', 'TG', '500001', '3333333333', '4444444444', 'public@privatemail.com', 'public gardens'),
(199, 'Shilpi restaurent', 'Dilsukhnagar', 'Moosarambagh  ', 'Hyderabad', 'TG', '500036', '9032130433', '8332830433', 'purnachandra.valluri@gmail.com', ''),
(200, 'Hotel Swagath Grand', 'LB Nagar', 'Hyderabad', 'Hyderabad', 'TG', '500060', '903213043', '', 'swagath@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_type`
--
ALTER TABLE `card_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_no`);

--
-- Indexes for table `customer_cards`
--
ALTER TABLE `customer_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_customer_no` (`customer_no`) USING BTREE,
  ADD KEY `idx_card_type` (`card_type`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`emp_type_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_emp-desg` (`emp_type_id`);

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
-- Indexes for table `movement`
--
ALTER TABLE `movement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_statement` (`st_id`);

--
-- Indexes for table `mov_employee`
--
ALTER TABLE `mov_employee`
  ADD KEY `idx_movement` (`mov_id`),
  ADD KEY `idx_employee` (`emp_id`) USING BTREE;

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
  ADD KEY `customer_no` (`customer_no`),
  ADD KEY `sttype` (`st_type`),
  ADD KEY `idx_sttyp` (`st_type`);

--
-- Indexes for table `statement_items`
--
ALTER TABLE `statement_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `stid` (`st_id`),
  ADD KEY `idxtype` (`st_type`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_type`
--
ALTER TABLE `card_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer_cards`
--
ALTER TABLE `customer_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `emp_type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK: Unique employee type ID',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK: Unique contact ID',AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `MODE_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movement`
--
ALTER TABLE `movement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `statement`
--
ALTER TABLE `statement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `statement_items`
--
ALTER TABLE `statement_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_cards`
--
ALTER TABLE `customer_cards`
  ADD CONSTRAINT `fk_customer_no` FOREIGN KEY (`customer_no`) REFERENCES `customer` (`customer_no`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk-emp-desg` FOREIGN KEY (`emp_type_id`) REFERENCES `designation` (`emp_type_id`);

--
-- Constraints for table `movement`
--
ALTER TABLE `movement`
  ADD CONSTRAINT `fk_ts_id` FOREIGN KEY (`st_id`) REFERENCES `statement` (`id`);

--
-- Constraints for table `mov_employee`
--
ALTER TABLE `mov_employee`
  ADD CONSTRAINT `fk_emp_id` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `fk_mov_id` FOREIGN KEY (`mov_id`) REFERENCES `movement` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
