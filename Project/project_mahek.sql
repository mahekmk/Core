-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 02:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_mahek`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0,
  `same` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`, `same`) VALUES
(286, 333, 'y', 0, 'y', 'y', 'y', 1, 0, 1),
(287, 333, 'y', 0, 'y', 'y', 'y', 0, 1, 1),
(414, 426, 'o', 413546, 'o', 'o', 'o', 1, 0, 1),
(415, 426, 'o', 413546, 'o', 'o', 'o', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(84, 'M', 'K', 'mk@ccc', 'a8890cbdca5c45baf5bb37d5530963d3', 1, '2022-03-11 10:34:19', NULL),
(111, 'abc', 'cde', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 2, '2022-04-05 12:56:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingAmount` float DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `total`, `shippingMethodId`, `paymentMethodId`, `shippingAmount`, `createdAt`, `updatedAt`) VALUES
(23, 333, 100, 6, 24, 50, '2022-03-23 16:44:24', NULL),
(36, 426, 830, 1, 25, 150, '2022-04-05 13:14:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `billing` tinyint(2) NOT NULL,
  `shipping` tinyint(2) NOT NULL,
  `same` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`cartAddressId`, `cartId`, `firstName`, `lastName`, `mobile`, `email`, `address`, `city`, `state`, `country`, `postalCode`, `billing`, `shipping`, `same`) VALUES
(33, 23, 'y', 'y', '', 'y', 'y', 'y', 'y', 'y', 0, 1, 0, 1),
(34, 23, 'y', 'y', '', 'y', 'y', 'y', 'y', 'y', 0, 0, 1, 1),
(55, 36, 'ao', 'o', '', 'o', 'o', 'o', 'o', 'o', 413546, 1, 0, 1),
(56, 36, 'ao', 'o', '', 'o', 'o', 'o', 'o', 'o', 413546, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `price` float NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `quantity`, `cost`, `price`, `tax`, `taxAmount`, `discount`) VALUES
(114, 36, 132, 4, 0, 20, '20', 16, 8),
(115, 36, 134, 3, 0, 250, '30', 225, 15),
(116, 23, 160, 1, 90, 100, '10', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `path` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentId`, `path`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(235, NULL, '235', 'B', 1, '2022-04-04 13:21:16', '2022-04-06 00:45:31'),
(238, 235, '235/238', 'E', 1, '2022-04-04 13:22:52', '2022-04-04 13:23:17'),
(241, 238, '235/238/241', 'F', 1, '2022-04-05 17:24:24', NULL),
(243, 238, '235/238/243', 'D', 1, '2022-04-05 17:27:13', '2022-04-06 00:27:14'),
(244, 235, '235/244', 'Z', 1, '2022-04-05 17:46:44', NULL),
(247, NULL, '247', 'stationary', 2, '2022-04-05 21:44:58', NULL),
(248, 247, '247/248', 'electronics', 1, '2022-04-05 21:48:11', NULL),
(249, NULL, '249', 'rrrr', 1, '2022-04-05 21:56:34', NULL),
(250, 235, '235/250', 'www', 1, '2022-04-05 22:11:08', NULL),
(251, 235, '235/251', 'qqqqqq', 1, '2022-04-05 22:12:02', NULL),
(252, 235, '235/252', 'qqqqqq', 1, '2022-04-05 22:12:02', NULL),
(253, NULL, '253', 'jisakdj', 1, '2022-04-05 22:17:20', NULL),
(254, NULL, '254', '', 1, '2022-04-06 00:38:31', NULL),
(255, NULL, '255', '', 1, '2022-04-06 00:40:26', NULL),
(256, NULL, '256', '', 1, '2022-04-06 00:41:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `thumb` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_media`
--

INSERT INTO `category_media` (`imageId`, `categoryId`, `image`, `base`, `thumb`, `small`, `status`, `gallery`) VALUES
(60, 238, '0452022125811-brushPen.jpg', 1, 0, 1, 0, 0),
(61, 238, '0452022125820-dummy2.jpg', 0, 1, 0, 0, 0),
(62, 238, '0452022125829-artsupplies1.jpg', 0, 0, 0, 0, 0),
(63, 241, '0452022052436-brushPen.jpg', 0, 1, 0, 0, 0),
(64, 250, '0452022101118-dummy.jpg', 1, 1, 0, 0, 0),
(65, 252, '0452022101211-brushPen.jpg', 1, 1, 1, 0, 0),
(66, 241, '0452022101433-dummy.jpg', 1, 0, 0, 0, 0),
(67, 253, '0452022101731-brushPen.jpg', 1, 0, 0, 0, 0),
(68, 253, '0452022103649-artsupplies2.jpg', 0, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `categoryId`, `productId`) VALUES
(289, 235, 132),
(237, 235, 160),
(290, 248, 132);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `value`, `code`, `status`, `createdAt`) VALUES
(6, 'login', '123', 'login123', 1, '2022-02-25 13:34:34'),
(30, 'menu1', 'value1', 'code1', 1, '2022-03-12 10:37:09'),
(67, 'a', 'a', 'a', 2, '2022-04-05 12:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `salesmanId` int(11) DEFAULT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(333, 8, 'y', 'y', 'y', '3598623232', 1, '2022-03-18 10:33:22', '2022-04-05 13:00:38'),
(426, 36, 'a', 'a', 'a@b.com', 'a', 1, '2022-04-05 13:00:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customerPrice` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `productId`, `customerId`, `customerPrice`) VALUES
(167, 132, 333, 19.5),
(168, 133, 333, 10),
(169, 134, 333, 240.01),
(196, 132, 426, 19),
(197, 133, 426, 9.5),
(198, 134, 426, 250),
(200, 160, 426, 95);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `taxAmount` float NOT NULL,
  `grandTotal` float NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` float NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `taxAmount`, `grandTotal`, `shippingMethodId`, `shippingAmount`, `paymentMethodId`, `createdAt`) VALUES
(23, 333, 'y', 'y', 'y', '', 10, 150, 6, 50, 24, '2022-04-05 13:17:04'),
(37, 426, 'ao', 'o', 'o', '', 241, 1144, 1, 150, 25, '2022-04-05 13:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `address` varchar(64) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `city`, `state`, `country`, `postalCode`, `address`, `type`, `createdAt`, `updatedAt`) VALUES
(33, 23, 'y', 'y', 'y', '', 'y', 'y', 'y', 0, 'y', 1, '2022-04-05 13:17:04', '0000-00-00 00:00:00'),
(34, 23, 'y', 'y', 'y', '', 'y', 'y', 'y', 0, 'y', 2, '2022-04-05 13:17:04', '0000-00-00 00:00:00'),
(55, 37, 'ao', 'o', 'o', '', 'o', 'o', 'o', 413546, 'o', 1, '2022-04-05 13:15:30', '0000-00-00 00:00:00'),
(56, 37, 'ao', 'o', 'o', '', 'o', 'o', 'o', 413546, 'o', 2, '2022-04-05 13:15:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_comment`
--

CREATE TABLE `order_comment` (
  `commentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `note` text NOT NULL,
  `customerNotified` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_comment`
--

INSERT INTO `order_comment` (`commentId`, `orderId`, `status`, `note`, `customerNotified`, `createdAt`) VALUES
(12, 23, 0, '', 0, '2022-04-05 11:13:47'),
(13, 23, 1, '', 0, '2022-04-05 11:14:14'),
(16, 23, 1, 'opended', 1, '2022-04-05 13:02:09'),
(17, 23, 1, 'opended', 1, '2022-04-05 13:02:15'),
(18, 23, 0, '', 0, '2022-04-05 13:14:37'),
(19, 37, 0, '', 0, '2022-04-05 13:15:30'),
(20, 23, 1, 'opended', 1, '2022-04-05 13:16:09'),
(21, 23, 0, '', 0, '2022-04-05 13:17:04'),
(22, 23, 1, 'will dispach soon', 1, '2022-04-05 13:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `sku` varchar(16) NOT NULL,
  `cost` float DEFAULT NULL,
  `price` float NOT NULL,
  `tax` float NOT NULL,
  `taxAmount` float NOT NULL,
  `discount` float DEFAULT NULL,
  `quantity` int(8) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `tax`, `taxAmount`, `discount`, `quantity`, `createdAt`, `updatedAt`) VALUES
(269, 37, 132, 'Brushpen', 'b250', 0, 20, 20, 16, 8, 4, '2022-04-05 13:15:30', '0000-00-00 00:00:00'),
(270, 37, 134, 'Pencil', 'p25', 0, 250, 30, 225, 15, 3, '2022-04-05 13:15:30', '0000-00-00 00:00:00'),
(271, 23, 160, 'Paper', 'P100', 90, 100, 10, 10, 10, 1, '2022-04-05 13:17:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'name1', 'code1', 'content1', 1, '2022-03-11 07:47:58', '2022-03-11 07:47:58'),
(2, 'name2', ' code2', 'content2', 1, '0000-00-00 00:00:00', '2022-03-11 21:46:56'),
(3, 'name03', ' code3', 'content3', 1, '0000-00-00 00:00:00', '2022-03-12 16:54:45'),
(4, 'name4', ' code4', 'content4', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'name5', ' code5', 'content5', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'name6', ' code6', 'content6', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'name7', ' code7', 'content7', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'name8', ' code8', 'content8', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'name9', ' code9', 'content9', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'name12', ' code12', 'content12', 1, '0000-00-00 00:00:00', '2022-03-12 16:59:43'),
(13, 'name13', ' code13', 'content13', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'name14', ' code14', 'content14', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'name15', ' code15', 'content15', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'name16', ' code16', 'content16', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'name17', ' code17', 'content17', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'name18', ' code18', 'content18', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'name19', ' code19', 'content19', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'name20', ' code20', 'content20', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'name21', ' code21', 'content21', 1, '0000-00-00 00:00:00', '2022-03-12 16:58:33'),
(22, 'name22', ' code22', 'content22', 1, '0000-00-00 00:00:00', '2022-03-11 22:05:19'),
(23, 'name23', ' code23', 'content23', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'name24', ' code24', 'content24', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'name25', ' code25', 'content25', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'name26', ' code26', 'content26', 1, '0000-00-00 00:00:00', '2022-03-12 16:45:13'),
(27, 'name27', ' code27', 'content27', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'name28', ' code28', 'content28', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'name29', ' code29', 'content29', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'name30', ' code30', 'content30', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'name31', ' code31', 'content31', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'name32', ' code32', 'content32', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'name33', ' code33', 'content33', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'name34', ' code34', 'content34', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'name35', ' code35', 'content35', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'name36', ' code36', 'content36', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'name37', ' code37', 'content37', 1, '0000-00-00 00:00:00', '2022-03-11 21:43:55'),
(38, 'name38', ' code38', 'content38', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'name39', ' code39', 'content39', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'name40', ' code40', 'content40', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'name41', ' code41', 'content41', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'name42', ' code42', 'content42', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'name43', ' code43', 'content43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'name44', ' code44', 'content44', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'name45', ' code45', 'content45', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'name46', ' code46', 'content46', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'name47', ' code47', 'content47', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'name48', ' code48', 'content48', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'name49', ' code49', 'content49', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'name51', ' code51', 'content51', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'name52', ' code52', 'content52', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'name53', ' code53', 'content53', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'name54', ' code54', 'content54', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'name55', ' code55', 'content55', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'name56', ' code56', 'content56', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'name57', ' code57', 'content57', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'name58', ' code58', 'content58', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'name59', ' code59', 'content59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'name60', ' code60', 'content60', 2, '0000-00-00 00:00:00', '2022-03-11 19:22:26'),
(61, 'name61', ' code61', 'content61', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'name62', ' code62', 'content62', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'name63', ' code63', 'content63', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'name64', ' code64', 'content64', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'name65', ' code65', 'content65', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'name66', ' code66', 'content66', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'name67', ' code67', 'content67', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'name68', ' code68', 'content68', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'name69', ' code69', 'content69', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'name70', ' code70', 'content70', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'name71', ' code71', 'content71', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'name72', ' code72', 'content72', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'name73', ' code73', 'content73', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'name74', ' code74', 'content74', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'name75', ' code75', 'content75', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'name76', ' code76', 'content76', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'name77', ' code77', 'content77', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'name78', ' code78', 'content78', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'name79', ' code79', 'content79', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'name80', ' code80', 'content80', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'name81', ' code81', 'content81', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'name82', ' code82', 'content82', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'name83', ' code83', 'content83', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'name84', ' code84', 'content84', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'name85', ' code85', 'content85', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'name86', ' code86', 'content86', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'name87', ' code87', 'content87', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'name88', ' code88', 'content88', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'name89', ' code89', 'content89', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'name90', ' code90', 'content90', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'name91', ' code91', 'content91', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'name92', ' code92', 'content92', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'name93', ' code93', 'content93', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'name94', ' code94', 'content94', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'name95', ' code95', 'content95', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'name96', ' code96', 'content96', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'name97', ' code97', 'content97', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'name98', ' code98', 'content98', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'name99', ' code99', 'content99', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'name101', ' code101', 'content101', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'name102', ' code102', 'content102', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'name103', ' code103', 'content103', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'name104', ' code104', 'content104', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'name105', ' code105', 'content105', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'name106', ' code106', 'content106', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'name107', ' code107', 'content107', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'name108', ' code108', 'content108', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'name109', ' code109', 'content109', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'name110', ' code110', 'content110', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'name111', ' code111', 'content111', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'name112', ' code112', 'content112', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'name113', ' code113', 'content113', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'name114', ' code114', 'content114', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'name115', ' code115', 'content115', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'name116', ' code116', 'content116', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'name117', ' code117', 'content117', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'name118', ' code118', 'content118', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'name119', ' code119', 'content119', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'name120', ' code120', 'content120', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'name121', ' code121', 'content121', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'name122', ' code122', 'content122', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'name123', ' code123', 'content123', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'name124', ' code124', 'content124', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'name125', ' code125', 'content125', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'name126', ' code126', 'content126', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'name127', ' code127', 'content127', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'name128', ' code128', 'content128', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'name129', ' code129', 'content129', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'name130', ' code130', 'content130', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'name131', ' code131', 'content131', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'name132', ' code132', 'content132', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'name133', ' code133', 'content133', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'name134', ' code134', 'content134', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'name135', ' code135', 'content135', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'name136', ' code136', 'content136', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'name137', ' code137', 'content137', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'name138', ' code138', 'content138', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'name139', ' code139', 'content139', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'name140', ' code140', 'content140', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'name141', ' code141', 'content141', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'name142', ' code142', 'content142', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'name143', ' code143', 'content143', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'name144', ' code144', 'content144', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'name145', ' code145', 'content145', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'name146', ' code146', 'content146', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'name147', ' code147', 'content147', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'name148', ' code148', 'content148', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'name149', ' code149', 'content149', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'name150', ' code150', 'content150', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'name151', ' code151', 'content151', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'name152', ' code152', 'content152', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'name153', ' code153', 'content153', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'name154', ' code154', 'content154', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'name155', ' code155', 'content155', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'name156', ' code156', 'content156', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'name157', ' code157', 'content157', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'name158', ' code158', 'content158', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'name159', ' code159', 'content159', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'name160', ' code160', 'content160', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'name161', ' code161', 'content161', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'name162', ' code162', 'content162', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'name163', ' code163', 'content163', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'name164', ' code164', 'content164', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'name165', ' code165', 'content165', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'name166', ' code166', 'content166', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'name167', ' code167', 'content167', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'name168', ' code168', 'content168', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'name169', ' code169', 'content169', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'name170', ' code170', 'content170', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'name171', ' code171', 'content171', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'name172', ' code172', 'content172', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'name173', ' code173', 'content173', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'name174', ' code174', 'content174', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'name175', ' code175', 'content175', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'name176', ' code176', 'content176', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'name177', ' code177', 'content177', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'name178', ' code178', 'content178', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'name179', ' code179', 'content179', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'name180', ' code180', 'content180', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'name181', ' code181', 'content181', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'name182', ' code182', 'content182', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'name183', ' code183', 'content183', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'name184', ' code184', 'content184', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'name185', ' code185', 'content185', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'name186', ' code186', 'content186', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'name187', ' code187', 'content187', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'name188', ' code188', 'content188', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'name189', ' code189', 'content189', 1, '0000-00-00 00:00:00', '2022-03-11 19:19:28'),
(190, 'name190', ' code190', 'content190', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'name191', ' code191', 'content191', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'name192', ' code192', 'content192', 1, '0000-00-00 00:00:00', '2022-03-12 17:02:38'),
(193, 'name193', ' code193', 'content193', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'name194', ' code194', 'content194', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'name203', 'code203', 'content203', 1, '2022-03-12 17:07:58', '0000-00-00 00:00:00'),
(212, 'Name210', 'Code210', 'Content210', 2, '2022-03-12 23:26:41', '0000-00-00 00:00:00'),
(234, 'name500', 'code500', 'content500', 2, '2022-04-05 13:02:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `methodId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`methodId`, `name`, `note`, `status`, `createdAt`, `updatedAt`) VALUES
(3, 'a', 'a', 1, '2022-03-18 11:07:26', '0000-00-00 00:00:00'),
(24, 'Debit', 'debit se karo payment ;)', 2, '2022-04-01 23:20:06', '2022-04-01 23:20:34'),
(25, 'Cod', 'njhhkj', 1, '2022-04-01 23:21:38', '0000-00-00 00:00:00'),
(27, 'Credit Card', 'abcdef', 1, '2022-04-05 13:03:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `price` int(11) NOT NULL,
  `discount` float NOT NULL,
  `discountMode` tinyint(1) NOT NULL,
  `tax` decimal(10,0) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `sku` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `cost`, `price`, `discount`, `discountMode`, `tax`, `quantity`, `sku`, `status`, `createdAt`, `updatedAt`) VALUES
(132, 'Brushpen', 0, 20, 10, 1, '20', 20, 'b250', 1, '2022-03-20 17:35:11', '2022-04-06 00:44:42'),
(133, 'Sketch Pen', 0, 10, 10, 2, '10', 120, 'sp60', 2, '2022-03-20 17:35:43', '2022-04-04 12:51:16'),
(134, 'Pencil', 0, 250, 5, 2, '30', 300, 'p25', 1, '2022-03-20 17:37:00', '2022-03-23 16:06:03'),
(160, 'Paper', 90, 100, 10, 1, '10', 20, 'P100', 1, '2022-04-05 11:31:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `thumb` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `gallery` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `image`, `base`, `thumb`, `small`, `gallery`, `status`) VALUES
(13, 132, '03202022054650-karinBrushMarkerPro.jpg', 0, 0, 0, 0, 1),
(34, 134, '0442022125023-dummy1.jpg', 0, 0, 0, 0, 0),
(36, 160, '0452022113200-pencil2.jpg', 1, 1, 0, 1, 0),
(37, 132, '0452022113413-pencil.png', 1, 1, 0, 1, 0),
(38, 132, '0452022113439-pencil2.jpg', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(32) NOT NULL,
  `percentage` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `mobile`, `email`, `percentage`, `status`, `createdAt`, `updatedAt`) VALUES
(8, 'M', 'K', '6556313', 'rk@gmail.com', 11, 2, '2022-03-05 14:36:08', '2022-04-05 11:47:32'),
(36, 'y', 'y', '1359569598', 'y', 10, 1, '2022-04-05 13:09:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shippingmethod`
--

CREATE TABLE `shippingmethod` (
  `methodId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `price` int(32) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippingmethod`
--

INSERT INTO `shippingmethod` (`methodId`, `name`, `note`, `status`, `price`, `createdAt`, `updatedAt`) VALUES
(1, 'Express', 'Takes 1 day to deliver your happiness', 1, 150, '2022-03-18 16:36:23', '2022-03-18 16:47:59'),
(6, 'a', 'a', 1, 50, '2022-04-05 13:09:52', '0000-00-00 00:00:00'),
(7, 'b', 'b', 1, 60, '2022-04-05 13:10:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `mobile`, `email`, `status`, `createdAt`, `updatedAt`) VALUES
(76, 'abcd', 'efgh', '963841', 'h', 1, '2022-04-01 22:00:51', '2022-04-01 22:00:51'),
(80, 'w', 'w', 'w', 'w', 1, '2022-04-05 13:12:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(10) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(56, 76, 'o', 1313, 'o', 'o', 'o'),
(60, 80, 'w', 0, 'w', 'w', 'w');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`),
  ADD UNIQUE KEY `categoryId` (`categoryId`,`productId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `salesmanId` (`salesmanId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`),
  ADD UNIQUE KEY `productId` (`productId`,`customerId`),
  ADD KEY `customer_price_ibfk_3` (`customerId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`shippingMethodId`) REFERENCES `shippingmethod` (`methodId`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentmethod` (`methodId`);

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `category_media`
--
ALTER TABLE `category_media`
  ADD CONSTRAINT `category_media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`salesmanId`) REFERENCES `salesman` (`salesmanId`) ON DELETE SET NULL;

--
-- Constraints for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD CONSTRAINT `customer_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_price_ibfk_3` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentmethod` (`methodId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shippingmethod` (`methodId`);

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_comment`
--
ALTER TABLE `order_comment`
  ADD CONSTRAINT `order_comment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
