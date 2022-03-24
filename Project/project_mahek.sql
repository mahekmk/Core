-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 12:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

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
(194, 271, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', 'Ind', 1, 0, 0),
(195, 271, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', 'Ind', 0, 1, 0),
(196, 272, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', '', 1, 0, 0),
(197, 272, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', '', 0, 1, 0),
(198, 273, 'p', 0, 'p', 'p', 'p', 1, 0, 0),
(199, 273, 'p', 0, 'p', 'p', 'p', 0, 1, 0),
(200, 274, 'a', 0, 'a', 'a', 'a', 1, 0, 0),
(201, 274, 'aa', 0, 'a', 'a', 'aa', 0, 1, 0),
(202, 275, 'w', 0, 'w', 'w', 'w', 1, 0, 0),
(203, 275, 'w', 0, 'w', 'w', 'w', 0, 1, 0);

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
(84, 'Mahek', 'Kalola', 'mahekkalola@gmail.com', 'a8890cbdca5c45baf5bb37d5530963d3', 1, '2022-03-11 10:34:19', NULL),
(85, 'abc', 'bcd', 'abcbcd@gmail.com', 'ec0405c5aef93e771cd80e0db180b88b', 1, '2022-03-11 11:03:21', '2022-03-15 10:34:37'),
(86, 'abcd', 'abcdefgi', 'abcd@gmail.com', '1fdda3f0c5555b8b3057369ba3c58215', 1, '2022-03-12 01:13:21', '2022-03-15 10:35:15'),
(87, 'abcde', 'bcde', 'abcde@gmail.com', 'ab56b4d92b40713acc5af89985d4b786', 1, '2022-03-12 01:15:38', NULL),
(88, 'Mahek1', 'Kalola1', 'mahekkalola1@gmail.com', '274d2bb1bc2be6e8208bcaa44b000167', 1, '2022-03-12 19:18:48', NULL),
(93, 'T', 't', 't@gmial.com', '0cd1aaae2fd9b84918ff731d313c6e4c', 1, '2022-03-13 15:06:20', '2022-03-15 10:31:39'),
(94, 'msd', 'm', 'm', '3cfd436919bc3107d68b912ee647f341', 1, '2022-03-13 23:29:42', '2022-03-14 09:34:04'),
(95, 'p', 'p', 'p@gmail.com', '83878c91171338902e0fe0fb97a8c47a', 2, '2022-03-14 12:19:17', NULL),
(96, 'qwe', 'qwe', 'qwe@gmail.com', '76d80224611fc919a5d54f0ff9fba446', 1, '2022-03-15 10:30:25', NULL),
(97, 'Mahek', 'Kalola', 'mahekkalola4@gmail.com', '274d2bb1bc2be6e8208bcaa44b000167', 1, '2022-03-15 10:31:01', NULL);

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
(156, 0, '156', 'Bedroom1', 2, '2022-03-08 15:32:35', '2022-03-13 15:42:30'),
(164, 162, '162/164', 'Book', 1, '2022-03-08 15:35:41', '0000-00-00 00:00:00'),
(173, 156, '156/173', 'bcde', 1, '2022-03-13 00:01:51', '0000-00-00 00:00:00'),
(182, NULL, '182', 'P', 1, '2022-03-14 11:23:06', NULL),
(183, 182, '182/183', 'abcde', 1, '2022-03-14 11:59:38', '2022-03-14 12:00:29'),
(184, 183, '182/183/184', 'efgh', 1, '2022-03-14 11:59:54', '2022-03-14 12:00:19'),
(188, 0, '188', 'A', 1, '2022-03-16 16:56:24', '0000-00-00 00:00:00'),
(189, 188, '188/189', 'CD', 1, '2022-03-16 16:56:36', '0000-00-00 00:00:00');

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
(36, 156, '03122022110931-dummy1.jpg', 1, 0, 0, 1, 1),
(38, 156, '03122022115534-dummy.jpg', 0, 0, 1, 0, 0),
(42, 173, '03132022045910-dummy.jpg', 1, 0, 0, 0, 0);

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
(140, 164, 128),
(94, 173, 116);

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
(16, 'menu', '365', 'menu365', 1, '2022-02-26 23:16:36'),
(18, 'logout', '412', 'logout412', 1, '2022-03-01 09:48:36'),
(30, 'menu1', 'value1', 'code1', 1, '2022-03-12 10:37:09'),
(32, 'login1', 'value01', 'code01', 2, '2022-03-12 17:09:12'),
(35, 'm', 'm', 'm', 1, '2022-03-13 15:09:02'),
(36, '', '', '', 1, '2022-03-13 15:57:27'),
(38, 'm', 'ksm', 'sjdmak', 1, '2022-03-13 16:37:43'),
(39, 'y', 'jk', 'jkknjskdhiu', 1, '2022-03-13 16:37:59'),
(41, 'e', 'e', 'esfeae', 1, '0000-00-00 00:00:00'),
(42, 'w', 'w', 'w', 1, '0000-00-00 00:00:00'),
(43, 'y', 'yksasLD:', 'yyyy', 1, '0000-00-00 00:00:00'),
(44, 't', 't', 'tlkl', 1, '0000-00-00 00:00:00'),
(45, 'p', 'pp', 'ppppppppppp', 1, '2022-03-14 09:52:45'),
(47, 'p', 'ppppppppppp', 'ppppppppppppppppppppp', 1, '2022-03-14 23:41:25'),
(48, 'p', 'sCda', 'ASFDSD', 1, '2022-03-14 23:59:45'),
(52, 'p', 'pp', 'pppppppp', 1, '2022-03-15 00:01:36'),
(53, 'paoecpdakDdz', 'sfvzsehdrh', 'svgxdtnhfrxjdr', 1, '2022-03-15 00:02:17'),
(54, 'jkcdn<Ks', 'jknknhkliojiol', 'nlkjnljmilojiol', 1, '2022-03-15 00:03:45'),
(55, 'o', 'o', 'oo', 1, '2022-03-15 00:04:29'),
(56, 'jkjk', 'ubhjbhjb', 'hjbbbbbbbbbbb', 2, '2022-03-15 00:06:25'),
(57, 'm', 'WFCAGszfvsz', 'AFWHeasjysr', 1, '2022-03-15 00:09:40'),
(58, 'liksmkM', 'kjnjknkn', 'klsMFCklaE', 1, '2022-03-15 00:11:10'),
(60, 'p', 'p', 'p', 1, '2022-03-16 16:00:50');

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
(271, 8, 'Mahek', 'Kalola', '', '', 1, '2022-03-16 12:12:02', '2022-03-16 12:20:19'),
(272, NULL, 'Mahek', 'Kalola', '', '', 1, '2022-03-16 16:23:28', NULL),
(273, NULL, 'p', '', 'p@gmail.com', '', 1, '2022-03-16 16:42:22', NULL),
(274, NULL, 'a', 'a', 'a@gmail.com', '', 1, '2022-03-16 16:42:40', NULL),
(275, NULL, 'w', 'w', 'w@gmail.com', '', 1, '2022-03-16 16:43:13', NULL);

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
(130, 102, 271, 190),
(131, 104, 271, 190.03),
(132, 116, 271, 0),
(133, 124, 271, 0),
(134, 126, 271, 52),
(135, 128, 271, 113),
(136, 129, 271, 195),
(137, 130, 271, 0),
(138, 131, 271, 0);

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
(10, 'name10', ' code10', 'content10', 2, '0000-00-00 00:00:00', '2022-03-12 16:44:59'),
(11, 'name11', ' code11', 'content11', 1, '0000-00-00 00:00:00', '2022-03-12 17:03:19'),
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
(206, 'login', 'login101', '', 1, '2022-03-12 18:09:02', '0000-00-00 00:00:00'),
(207, 'logout', '0011', '', 1, '2022-03-12 18:11:14', '0000-00-00 00:00:00'),
(208, 'login', 'code2066', '', 1, '2022-03-12 18:17:21', '0000-00-00 00:00:00'),
(209, '', '2077', '', 1, '2022-03-12 19:12:50', '0000-00-00 00:00:00'),
(211, 'login022', 'code022', 'content022', 2, '2022-03-12 23:25:27', '0000-00-00 00:00:00'),
(212, 'Name210', 'Code210', 'Content210', 2, '2022-03-12 23:26:41', '0000-00-00 00:00:00'),
(214, 'Name211', 'Code211', 'Content211', 1, '2022-03-13 14:49:31', '0000-00-00 00:00:00'),
(216, 'M', 'm', 'm', 1, '2022-03-13 14:51:15', '0000-00-00 00:00:00'),
(217, 'Kk', 'k', 'k', 1, '2022-03-13 14:51:40', '0000-00-00 00:00:00'),
(218, 'p', 'P', 'P', 1, '2022-03-13 14:52:32', '0000-00-00 00:00:00'),
(219, 'O', 'o', 'o', 1, '2022-03-13 14:53:20', '0000-00-00 00:00:00'),
(220, 'u', 'u', 'u', 1, '2022-03-13 14:53:49', '0000-00-00 00:00:00'),
(221, 'welcome', 'w', 'ww', 1, '2022-03-13 14:59:31', '2022-03-14 23:58:17'),
(231, 'SRGWrfzdbhszda', 'rgsteht64ywse', 'hsrjrsfjsr', 1, '2022-03-15 00:08:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sku` varchar(16) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `price`, `quantity`, `sku`, `status`, `createdAt`, `updatedAt`) VALUES
(102, 'Doms Brush Pen', 200, 63, 'kjkjk,k', 1, '2022-03-08 23:37:03', '2022-03-15 10:09:40'),
(104, 'pencil', 200, 66, 'bp100543135', 1, '2022-03-09 00:00:57', '2022-03-15 10:12:14'),
(116, 'brushpen', 0, 0, '', 1, '2022-03-14 09:27:45', NULL),
(124, 'p', 0, 0, 'psdjk', 1, '2022-03-14 11:56:16', NULL),
(126, 'u', 56, 0, 'u531313', 1, '2022-03-14 11:57:33', '2022-03-14 11:58:01'),
(128, 'abc', 125, 3, 'abc120', 2, '2022-03-15 09:47:31', '2022-03-15 09:47:57'),
(129, 'p', 200, 0, 'pppp', 2, '2022-03-15 09:48:24', NULL),
(130, 'w', 0, 0, 'w', 1, '2022-03-15 10:02:57', NULL),
(131, 'r', 0, 0, 'r', 1, '2022-03-15 10:04:33', NULL);

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
(2, 102, '03132022124909-artsupplies2.jpg', 0, 1, 0, 0, 0),
(3, 104, '03132022031456-artsupplies1.jpg', 1, 1, 1, 0, 0),
(4, 104, '03132022031506-artsupplies2.jpg', 0, 0, 0, 1, 0),
(5, 102, '03132022050627-dummy.jpg', 1, 0, 0, 0, 0),
(6, 129, '03152022094848-dummy.jpg', 0, 1, 0, 0, 0),
(7, 129, '03152022094944-dummy2.jpg', 1, 0, 0, 0, 0),
(8, 116, '03152022095111-dummy1.jpg', 1, 1, 0, 0, 0),
(9, 130, '03152022100448-dummy.jpg', 1, 0, 0, 0, 0);

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
(8, 'Mahek', 'Kalola', '6556313', 'rk@gmail.com', 10, 2, '2022-03-05 14:36:08', '2022-03-10 11:59:27'),
(9, 'Rushil', 'Kalola', '9874568210', 'rk@gmail.com', 5, 1, '2022-03-08 17:44:14', '0000-00-00 00:00:00'),
(10, 'Hiloni', 'Parekh', '789658430', 'hp@gmail.com', 6, 1, '2022-03-08 17:44:50', '0000-00-00 00:00:00'),
(17, 'Akshay', 'Kalola', '9874563110', 'ak@gmail.com', 8, 2, '2022-03-10 18:10:02', '2022-03-10 18:10:55'),
(21, 'Mahek', 'Kalola', '65413123', 'mahek@gmail.com', 0, 1, '2022-03-14 10:00:07', '0000-00-00 00:00:00'),
(22, 'Mahek', 'Kalola', '32', '4545468', 456, 1, '2022-03-14 10:00:18', '2022-03-14 10:05:12'),
(23, 'Mahek', 'Kalola', '4689869896', 'mahek@gmail.com', 10, 1, '2022-03-15 00:23:22', '2022-03-15 00:23:36');

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
(9, 'Mahek', 'Kalola', '5865656', 'a@b.com', 2, '2022-03-01 09:59:03', '2022-03-04 11:34:08'),
(14, 'Mahek', 'Kalola', '', '', 1, '2022-03-05 14:38:23', '2022-03-15 11:32:13'),
(15, 'Mahek', 'Kalola', '3', 'a@b.com', 1, '2022-03-05 14:38:23', '2022-03-15 19:10:29'),
(22, 'Mahek', 'Kalola', '', '', 1, '2022-03-13 22:59:56', '2022-03-13 23:00:11'),
(23, 'Mahek', 'Kalola', '', '', 1, '2022-03-14 09:51:15', '2022-03-14 09:51:38'),
(26, 'Mahek', 'Kalola', '46813136', 'a@b.com', 1, '2022-03-14 12:04:11', '2022-03-14 12:04:26'),
(27, 'Mahek', 'Kalola', '', 'a@b.com', 1, '2022-03-15 00:31:12', '2022-03-15 00:39:03'),
(29, 'Rushil', 'Kalola', '', '', 1, '2022-03-15 00:39:44', '0000-00-00 00:00:00'),
(30, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:44:03', '0000-00-00 00:00:00'),
(31, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:45:38', '0000-00-00 00:00:00'),
(32, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:47:26', '0000-00-00 00:00:00'),
(33, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:47:59', '0000-00-00 00:00:00'),
(34, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:48:18', '0000-00-00 00:00:00'),
(35, 'Mahek', 'Kalola', '', 'a@b.com', 1, '2022-03-15 00:48:45', '2022-03-15 11:43:19'),
(36, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:48:57', '0000-00-00 00:00:00'),
(37, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:49:07', '0000-00-00 00:00:00'),
(38, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:50:01', '0000-00-00 00:00:00'),
(39, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 00:50:18', '0000-00-00 00:00:00'),
(41, 'Mahek', 'Kalola', '', '', 1, '2022-03-15 12:28:29', '2022-03-15 12:28:57'),
(42, 'a', 'A', '', 'A@B.COM', 1, '2022-03-15 12:33:08', '0000-00-00 00:00:00'),
(43, 'pjiklm,xslA', 'jjkjoi', '563415', 'P@GMAIL.COMM', 1, '2022-03-15 12:41:52', '2022-03-15 13:16:44'),
(44, 'oq', 'q', '', 'q@gmail', 1, '2022-03-15 19:10:59', '2022-03-15 19:12:12');

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
(3, 9, 'tal', 3620013, 'junagadh', 'gujarat', 'india'),
(8, 15, 'talav gate', 362001, 'junagadh', 'gujarat', ''),
(9, 14, 'talav gate', 362001, 'junagadh', 'gujarat', 'India'),
(16, 22, 'talav gate', 362001, 'junagadh', 'gujarat', 'india'),
(17, 23, 'talav gate', 362001, 'junagadh', 'gujarat', 'India'),
(22, 26, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', 'India'),
(23, 27, '303,  apt.', 362001, 'junagadh', 'gujarat', 'india'),
(25, 29, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(26, 30, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(27, 31, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(28, 32, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(29, 33, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(30, 34, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(31, 35, 'P', 0, 'P', 'P', 'P'),
(32, 36, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(33, 37, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(34, 38, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(35, 39, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(37, 41, '303, neel kamal delux apt.', 362001, 'junagadh', 'gujarat', ''),
(38, 42, 'A', 0, 'A', 'A', 'A'),
(39, 43, 'Pjksdk', 545343, 'kmklmlk', 'mlnjhuh', 'kokl'),
(40, 44, 'q', 0, 'q', 'q', 'q');

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
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `code` (`code`);

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
