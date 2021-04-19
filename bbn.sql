-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 08:11 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbn`
--

-- --------------------------------------------------------

--
-- Table structure for table `auths`
--

CREATE TABLE `auths` (
  `auth_id` int(11) NOT NULL,
  `order_no` varchar(3) NOT NULL,
  `customer` varchar(3) NOT NULL,
  `date_order` varchar(3) NOT NULL,
  `received_date` varchar(3) NOT NULL,
  `status` varchar(3) NOT NULL,
  `descr` varchar(3) NOT NULL,
  `img` varchar(3) NOT NULL,
  `title` varchar(3) NOT NULL,
  `upc` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `supplier` varchar(3) NOT NULL,
  `track_numb` varchar(3) NOT NULL,
  `asin_numb` varchar(3) NOT NULL,
  `quantity` varchar(3) NOT NULL,
  `size` varchar(3) NOT NULL,
  `service` varchar(3) NOT NULL,
  `cond` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auths`
--

INSERT INTO `auths` (`auth_id`, `order_no`, `customer`, `date_order`, `received_date`, `status`, `descr`, `img`, `title`, `upc`, `part_no`, `supplier`, `track_numb`, `asin_numb`, `quantity`, `size`, `service`, `cond`) VALUES
(1, 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_orders_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_orders_id`, `datetime`) VALUES
(1, 2, '2020-09-29 07:58:59'),
(2, 1, '2020-09-29 07:59:02'),
(3, 3, '2020-10-02 14:23:36'),
(4, 4, '2020-10-02 14:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `notification_for` enum('admin','customer') DEFAULT NULL,
  `subject` text,
  `message` text,
  `page_url` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_user_id`, `notification_for`, `subject`, `message`, `page_url`, `is_read`, `create_at`, `read_at`) VALUES
(1, NULL, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-13 10:27:13', NULL),
(2, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-13 10:28:09', NULL),
(3, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 10:57:47', NULL),
(4, 7, 'customer', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 11:16:09', NULL),
(5, 7, 'customer', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 11:17:13', NULL),
(6, 6, 'admin', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 11:17:41', NULL),
(7, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 11:18:42', NULL),
(8, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #756815', 'admin/tickets', 1, '2020-09-13 11:19:20', NULL),
(9, 6, 'customer', 'Ticket resolved', 'Ticket 756815 has been resolved', 'admin/tickets', 1, '2020-09-13 11:24:21', NULL),
(10, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-13 11:30:27', NULL),
(11, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #564759', 'admin/tickets', 1, '2020-09-13 11:30:57', NULL),
(12, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #564759', 'admin/tickets', 1, '2020-09-13 11:31:18', NULL),
(13, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #564759', 'admin/tickets', 1, '2020-09-13 11:31:37', NULL),
(14, 7, 'customer', 'Ticket resolved', 'Ticket 564759 has been resolved', 'admin/tickets', 1, '2020-09-13 11:31:50', NULL),
(15, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-13 07:17:42', NULL),
(16, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-15 11:06:27', NULL),
(17, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #641083', 'admin/tickets', 1, '2020-09-15 11:06:49', NULL),
(18, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #641083', 'admin/tickets', 1, '2020-09-15 11:08:33', NULL),
(19, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #641083', 'admin/tickets', 1, '2020-09-15 11:09:11', NULL),
(20, 7, 'admin', 'Ticket resolved', 'Ticket 641083 has been resolved', 'admin/tickets', 1, '2020-09-15 11:09:20', NULL),
(21, 6, 'admin', 'Ticket resolved', 'Ticket 641083 has been resolved', 'admin/tickets', 1, '2020-09-15 11:09:25', NULL),
(22, 15, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-15 11:33:28', NULL),
(23, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #192756', 'admin/tickets', 1, '2020-09-15 11:35:26', NULL),
(24, 15, 'admin', 'Ticket resolved', 'Ticket 192756 has been resolved', 'admin/tickets', 1, '2020-09-15 11:48:03', NULL),
(25, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 1, '2020-09-18 04:30:33', NULL),
(26, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #116840', 'admin/tickets', 1, '2020-09-18 04:31:47', NULL),
(27, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #116840', 'admin/tickets', 1, '2020-09-18 04:32:25', NULL),
(28, 6, 'admin', 'Ticket resolved', 'Ticket 116840 has been resolved', 'admin/tickets', 1, '2020-09-18 04:32:41', NULL),
(29, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 0, '2021-04-03 07:58:01', NULL),
(30, 7, 'admin', 'New Ticket', 'You have a new support ticket', 'admin/tickets', 0, '2021-04-03 07:58:12', NULL),
(31, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #255619', 'admin/tickets', 0, '2021-04-03 07:59:16', NULL),
(32, 7, 'admin', 'Ticket Replay', 'You have a reply on Ticket #255619', 'admin/tickets', 1, '2021-04-03 07:59:18', NULL),
(33, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #255619', 'admin/tickets', 0, '2021-04-03 07:59:35', NULL),
(34, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #255619', 'admin/tickets', 0, '2021-04-03 07:59:39', NULL),
(35, 6, 'customer', 'Ticket Replay', 'You have a reply on Ticket #255619', 'admin/tickets', 0, '2021-04-03 07:59:42', NULL),
(36, 6, 'admin', 'Ticket resolved', 'Ticket 255619 has been resolved', 'admin/tickets', 0, '2021-04-03 08:00:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checked_in_user_id` int(11) NOT NULL,
  `date_ordered` date NOT NULL,
  `description` text NOT NULL,
  `status` enum('incoming','picked','received','prepared','packed','shipped','ordered') NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `received_date` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_archive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `checked_in_user_id`, `date_ordered`, `description`, `status`, `date_added`, `received_date`, `is_deleted`, `is_archive`) VALUES
(1, '', 7, 0, '2020-09-29', 'asdfasdfad', 'incoming', '2020-09-28 13:07:11', NULL, 0, 0),
(2, '', 6, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:27:27', NULL, 0, 0),
(3, '', 0, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:28:40', NULL, 0, 0),
(4, '', 6, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:29:15', NULL, 0, 0),
(5, '', 6, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:31:22', NULL, 0, 0),
(6, '', 6, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:31:43', NULL, 0, 0),
(7, '', 6, 0, '0000-00-00', 'Description', 'incoming', '2020-09-29 07:32:11', NULL, 0, 0),
(8, '', 10, 0, '2020-09-30', 'Description', 'incoming', '2020-09-29 07:32:23', NULL, 0, 0),
(9, '', 6, 6, '0000-00-00', 'Description', 'received', '2020-09-29 07:33:57', '2020-10-16 19:00:00', 0, 0),
(10, '', 7, 0, '2020-09-15', 'ASDF', 'received', '2020-09-29 07:45:48', '2020-09-28 19:00:00', 0, 0),
(11, '', 7, 0, '2020-09-15', 'ASDFsasasasasasa', 'ordered', '2020-09-29 07:52:10', NULL, 0, 0),
(12, '', 7, 0, '2020-09-15', 'ASDFsasasasasasa', 'ordered', '2020-09-29 07:54:02', NULL, 0, 0),
(13, '', 7, 0, '2020-09-15', 'ASDFsasasasasasa', 'ordered', '2020-10-02 14:23:22', NULL, 0, 0),
(14, '', 7, 0, '2020-09-15', 'ASDFsasasasasasa', 'ordered', '2020-10-02 14:24:16', NULL, 0, 0),
(15, '', 7, 0, '2020-09-15', 'ASDFsasasasasasa', 'ordered', '2021-04-03 17:59:00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_more`
--

CREATE TABLE `orders_more` (
  `order_more_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `upc` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `asin_number` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `services` text NOT NULL,
  `notes` text NOT NULL,
  `quality` varchar(5) DEFAULT NULL,
  `good_qty` int(11) NOT NULL,
  `bad_qty` int(11) NOT NULL,
  `location` varchar(225) NOT NULL,
  `recieved_notes` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_more`
--

INSERT INTO `orders_more` (`order_more_id`, `order_id`, `upc`, `part_no`, `image`, `supplier`, `tracking_number`, `asin_number`, `qty`, `length`, `services`, `notes`, `quality`, `good_qty`, `bad_qty`, `location`, `recieved_notes`, `width`, `height`) VALUES
(1, 1, '1234', '1234', '1972963922pecan label-box.jpg', '1234', '1234', '1234', 124, 1234, 'box contents', '1234', NULL, 0, 0, '', '', 123, 1234),
(2, 6, 'UPC', 'Part no', '76262.png2wbmp(pngname, wbmpname, dest_height, dest_width, threshold)', 'supplier', 'track number', 'asin number', 0, 0, 'service', 'notes', 'qty', 0, 0, '', '', 0, 0),
(3, 7, 'UPC', 'Part no', '', 'supplier', 'track number', 'asin number', 0, 0, 'service', 'notes', 'qty', 0, 0, '', '', 0, 0),
(4, 8, 'UPC', 'Part no', '1045399873icon.png', 'supplier', 'track number', 'asin number', 0, 0, 'box', 'notes', 'qty', 0, 0, '', '', 0, 0),
(5, 9, 'UPC', 'Part no', 'default.png', 'supplier', 'track number', 'asin number', 0, 0, 'service', 'notes', 'qty', 1, 1, 'asdf', '', 0, 0),
(6, 10, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 1106, 1, 'box contents', '1234', NULL, 1106, 0, '1234', '', 2341, 231234),
(7, 11, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 123, 1, 'box contents', '1234', NULL, 123, 0, '1234', '', 2341, 231234),
(8, 12, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 2, 1, 'box contents', '1234', NULL, 2, 0, '1234', '', 2341, 231234),
(9, 13, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 1, 1, 'box contents', '1234', NULL, 1, 0, '1234', '', 2341, 231234),
(10, 14, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 1, 1, 'box contents', '1234', NULL, 1, 0, '1234', '', 2341, 231234),
(11, 15, '1234', '1234', '1460084456Offiial Logo.png', '123', '234', '1234', 1, 1, 'box contents', '1234', NULL, 1, 0, '1234', '', 2341, 231234);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `office_phone` varchar(255) DEFAULT NULL,
  `office_fax` varchar(255) DEFAULT NULL,
  `account_manager` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `issue` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('new','active','resolved') NOT NULL DEFAULT 'new',
  `resolved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `issue`, `user_id`, `ticket_number`, `datetime`, `status`, `resolved_by`) VALUES
(1, '8aksdfjlasjdf lskjf lasdj flaskjd flj', 'slakjdflasj dflasjd lfkjas dfljas ldfjasl dfjlas dflas df\r\nasdf\r\nasdfasd\r\nf\r\nasdfasdflkjasdlfjasld f\r\nsldfkjasdf', 7, '395893', '2021-04-03 17:58:01', 'new', 0),
(2, 'asdfas asdf asdfas df', 'dfasd fasdf asdf asdf', 7, '255619', '2021-04-03 17:58:12', 'resolved', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tickets_msgs`
--

CREATE TABLE `tickets_msgs` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_customer` tinyint(1) NOT NULL,
  `msg` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_msgs`
--

INSERT INTO `tickets_msgs` (`id`, `ticket_id`, `user_id`, `is_customer`, `msg`, `datetime`) VALUES
(1, 2, 7, 1, 'dsfasdfasd', '2021-04-03 17:59:16'),
(2, 2, 7, 1, 'asdfasdfasdf', '2021-04-03 17:59:18'),
(3, 2, 6, 0, '7777777777777777777777777777777777777777777777', '2021-04-03 17:59:35'),
(4, 2, 6, 0, '77777asdf', '2021-04-03 17:59:39'),
(5, 2, 6, 0, 'asdfasdf', '2021-04-03 17:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `amazon_acc_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `user_status` enum('active','inactive','blocked') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `password`, `created_on`, `phone`, `customer_name`, `store_name`, `amazon_acc_name`, `address`, `is_deleted`, `user_status`) VALUES
(6, 'admin', 'admin', 'admin@admin.com', 'fb8b6dc0c671624dfd238000488cada50077cec8606c8d8e819603434976181fd581a23ec21711c0d775a754a07bff5af2b65467636013271a54a857d54d1cf4HARZ9uwriDLijfzqYX1iEWnBeVF+B4PaxdMBLhRQmw8=', '2020-07-16 18:06:47', '', '', '', NULL, '', 0, 'active'),
(7, 'test', 'customer', 'test@email.com', 'fb8b6dc0c671624dfd238000488cada50077cec8606c8d8e819603434976181fd581a23ec21711c0d775a754a07bff5af2b65467636013271a54a857d54d1cf4HARZ9uwriDLijfzqYX1iEWnBeVF+B4PaxdMBLhRQmw8=', '2021-04-03 17:55:57', '12341234', 'test', 'test', NULL, 'test', 0, 'active'),
(9, '123', 'customer', '123@email.com', '73b4b9ab37f51310db553396470d21460eff74e88566aaaec8b63fed39b8eb7a16925eb5fc3123c461a0312e149411d9e6ecd05333d4a3a1c28357ac9867f693wF0exsd+AY1XycSqGTqws1+aqrWkcWYfY6MtIbev6Sw=', '2020-12-14 14:36:57', 'asdf', '', '', NULL, '', 0, 'blocked'),
(10, 'new', 'customer', 'new@gmail.com', '7f8a6560956ba61648a9291b6923633650d6b66abefd21a89b403a5aa443f33d21bf37fa7f0e60ae65ec2b4211765b0281a43820ddda02c25c779f593d08d62ctvD3yDfTMCZwH1yGcnpzyucbLUtWzJWBLMC2MHfXiJM=', '2020-12-14 14:37:01', '555555', '', '', NULL, '', 0, 'blocked'),
(11, 'asf', 'admin', 'asfas@gmail.com', 'ac705511589e5520b8641a04135f137f4341e08e4f562937d6e5173c195f7657e92e7254c9c25000e23bee56dfbefb5dae26ba56dec51213c08036dfb6adf91fMAHz7DRJD58DBMFiLDV6IQAo3tAZE8LOCf05xcAQe8E=', '2020-07-16 18:06:47', 'safsa', 'asfas', 'safas', 'fsfsa', 'afsa', 0, 'active'),
(12, 'shj', 'admin', 'dsg#gmail.com', 'e446f70c94e76acb77177bf54e8c819afcd383efed511653ee4e4c9cf742f8d43dfb939815bfbe0be21d6c7dad7072fed358559824587702a48ca171924ba22duuTgDVuNtpqURBlus966wmnyJ4CgbskKOOGmRgREKdY=', '2020-07-16 18:10:37', '03073500573', 'ameer', 'asfasf', 'safasf', 'qasmabad', 0, 'active'),
(13, 'Dani', 'customer', 'test@test.com', 'ab86a175355c2b99f08041cd602bd1f3e393ec1b61e77f57f0b21dd4c9413a76551db13da5d2617dba660d3b48e45278a85f115215ec3a4141ba1b90436ebee9XwgjVBsd53JsuYiwOggolDrxNyNR2f1t/bLUZx/hMK0=', '2020-08-10 23:49:21', '8451651', 'test Yes', 'My store', NULL, 'USA', 0, 'active'),
(14, 'dfbvfdb', 'customer', 'fbfd@rgreg.com', 'c9b8da3639cdf667cd43fceaea6f5093a32cd3164c455084d7e56d3d1e4189bbdc5149be6d6447a483664c5e5dac2ec70fcb98dfcfadceb4ae0ec5cbaf540d306hXuyDBAb1KGRB80BuneMvGP9MnbIOBzobfAOmcwE7c=', '2020-08-08 00:23:08', '32435435435', 'sefgserrgseg', 'segsegseges', NULL, 'gesgesges', 0, 'active'),
(15, 'Weby', 'customer', 'N/A', '705a0f2cd4387eae6071fb3dfd7cb38443af039fa3d9da046b5431a8e5cba832a45f02cdeb31dd849e66a448984354cbfeafea977c5cc001c8258f1303becbc2iw0YyVGMwS9Re58tJfkfG1L0HSfvAIY0DRzUcA7/f8U=', '2020-08-12 04:03:46', 'N/A', 'Weby Corp', 'Weby Corp', NULL, 'N/A', 0, 'active'),
(17, 'ameer', 'customer', 'ameerali1811@gmail.com', '029cc9a05e056122b1d0cef010b3e5d397d8580251bac0dafc1f48ca73290fa7c104f19564ef5f97b03724a63c9f94bc426f4688106262fcd1281b43242a9814Z8ouJsLJCND+oRrxUOEOYloGqSWfx28mQPeR4JcwaEU=', '2020-09-12 02:36:04', '03073500573', 'Talha', 'Ideas', NULL, 'qasmabad', 0, 'active'),
(24, 'abc', 'customer', 'ameerali1811@gmail.com', '8c10d84029af192f4797f537df5f2a6eb3651f70d5d7fd926f55b333745bbeec5237432ecd12ce93af296d702bbdd313a4407b770b462c382d9983d64ce4a34cFGc/BUUprLtPhya65yYLTopvLT9+v0Th3QMNTOthcEQ=', '2020-09-12 19:33:09', '03073500573', 'Talha', 'Ideas', NULL, 'qasmabad', 0, 'active'),
(25, 'uythytr', 'customer', 'ytrrtytr@yahoo.com', '15407f75fc768c048ba7f32d5042b13de6a5f75207c6a51d5ac7bfdc613870d63326c129918ba2c56eef9cbc80bde45af9e761323bb8f5bf54b11cd00a2c511bQuVHnmBen9hO3mSmmkrqHpDvWDvEo52Dj3ho6DQAlYI=', '2020-09-13 23:13:45', '5412547896', 'drgdgrd', 'grdgrd', NULL, 'grd', 0, 'active'),
(26, 'laiba', 'customer', 'laiba@gmail.com', '2d779faf8a8babe3da335c92d933717fdc3e704d2ead09f11694ba9dafbb6c85fbce4d6c47c77ddddf291a62ca081aaf982358df4051798c8ca4d99bdbab1999kc6sHkw47QUkySQBEKjbHepfqrr2/K4cNNuMXhUE+bQ=', '2020-09-21 17:35:07', '12', 'laiba', 'daraz', NULL, 'a12', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_orderdetails`
--

CREATE TABLE `user_orderdetails` (
  `orderdetail_id` int(11) NOT NULL,
  `user_orderid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `bundle_quantity` int(11) NOT NULL,
  `orderdetail_notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orderdetails`
--

INSERT INTO `user_orderdetails` (`orderdetail_id`, `user_orderid`, `order_id`, `bundle_quantity`, `orderdetail_notes`) VALUES
(1, 1, 11, 0, ' '),
(2, 2, 12, 1, 'THIS IS ORDER NOTE'),
(3, 3, 13, 0, ' '),
(4, 4, 14, 0, ' '),
(5, 5, 15, 1, 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('new','completed') NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_archive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `order_no`, `notes`, `datetime`, `status`, `user_id`, `is_archive`) VALUES
(1, 'asdf', 'asdf', '2020-09-28 19:00:00', 'completed', 7, 0),
(2, '12341234', 'THIS IS ORDER NOTE1', '2020-09-28 19:00:00', 'completed', 7, 0),
(3, 'ff', 'asfd', '2020-10-01 19:00:00', 'completed', 7, 0),
(4, 'ffd', 'ddf', '2020-10-01 19:00:00', 'completed', 7, 0),
(5, 'asdfasdf', 'asdfasdf', '2021-04-02 19:00:00', 'new', 7, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auths`
--
ALTER TABLE `auths`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_more`
--
ALTER TABLE `orders_more`
  ADD PRIMARY KEY (`order_more_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_msgs`
--
ALTER TABLE `tickets_msgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orderdetails`
--
ALTER TABLE `user_orderdetails`
  ADD PRIMARY KEY (`orderdetail_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auths`
--
ALTER TABLE `auths`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_more`
--
ALTER TABLE `orders_more`
  MODIFY `order_more_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets_msgs`
--
ALTER TABLE `tickets_msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_orderdetails`
--
ALTER TABLE `user_orderdetails`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
