-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 03:13 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter_cloudnausor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cn_admin_tbl`
--

CREATE TABLE `cn_admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(32) NOT NULL,
  `admin_status` tinyint(4) NOT NULL COMMENT 'active:1,inactive:2',
  `otp` int(11) NOT NULL,
  `admin_last_login_date` datetime NOT NULL,
  `admin_last_login_ip` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cn_admin_tbl`
--

INSERT INTO `cn_admin_tbl` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_status`, `otp`, `admin_last_login_date`, `admin_last_login_ip`) VALUES
(2, 'admin', 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 1, 0, '2020-08-09 14:01:06', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `va_address_tbl`
--

CREATE TABLE `va_address_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `va_address_tbl`
--

INSERT INTO `va_address_tbl` (`id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `pincode`, `created_on`) VALUES
(1, 1, 'haramohan mahalik', 'haramohn111@gmail.com', '9556213317', 'test', 'hydrabad', 500082, '2020-01-17 11:01:47'),
(2, 1, 'haramohan mahalik', 'haramohan111@gmail.com', '9556213315', 'hydrabad', 'hydrabad', 500082, '2020-01-17 11:03:19'),
(3, 1, 'sangam', 'san@gmail.com', '9938464667', 'hyd', 'ggg', 50052, '2020-01-17 19:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `va_cart_tbl`
--

CREATE TABLE `va_cart_tbl` (
  `rowid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `subtotal` double NOT NULL,
  `name` varchar(60) NOT NULL,
  `cart_session_id` varchar(100) NOT NULL,
  `cart_status` tinyint(4) NOT NULL DEFAULT '0',
  `order_id` varchar(60) NOT NULL,
  `rand_order_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `va_cart_tbl`
--

INSERT INTO `va_cart_tbl` (`rowid`, `product_id`, `qty`, `price`, `subtotal`, `name`, `cart_session_id`, `cart_status`, `order_id`, `rand_order_id`, `user_id`, `created_on`) VALUES
(1, 1, 4, 100, 480, 'roti', '', 1, '', '', 1, '2020-08-07 22:30:20'),
(2, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-07 22:30:24'),
(3, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-07 22:40:02'),
(4, 1, 4, 100, 480, 'roti', '', 1, '', '', 1, '2020-08-07 22:40:08'),
(5, 1, 4, 100, 480, 'roti', '', 1, '', '', 1, '2020-08-07 22:40:37'),
(6, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-07 22:41:01'),
(7, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-07 22:41:40'),
(14, 4, 2, 100, 200, 'rice', '', 1, '', '', 1, '2020-08-08 08:30:38'),
(15, 1, 4, 120, 480, 'roti', '', 1, '', '', 1, '2020-08-08 08:30:44'),
(16, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-08 08:30:48'),
(17, 3, 4, 150, 600, 'biriyani', '', 1, '', '', 1, '2020-08-08 08:30:51'),
(18, 2, 5, 56, 280, 'cake', '', 1, '', '', 1, '2020-08-08 08:35:42'),
(19, 4, 2, 100, 200, 'rice', '', 1, '', '', 1, '2020-08-08 08:35:47'),
(21, 1, 4, 120, 480, 'roti', '', 1, '', '', 1, '2020-08-08 08:37:33'),
(22, 3, 4, 150, 600, 'biriyani', '', 1, '', '', 1, '2020-08-08 08:38:11'),
(23, 1, 4, 120, 480, 'roti', '', 1, '', '', 1, '2020-08-08 08:38:19'),
(27, 1, 4, 120, 480, 'roti', '', 1, '', '', 1, '2020-08-08 08:57:57'),
(34, 1, 1, 120, 120, 'roti', '', 1, '', '', 1, '2020-08-09 14:00:27'),
(35, 2, 1, 56, 56, 'cake', '', 1, '', '', 1, '2020-08-09 14:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `va_customers_tbl`
--

CREATE TABLE `va_customers_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pincode` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `va_customers_tbl`
--

INSERT INTO `va_customers_tbl` (`id`, `name`, `email`, `phone`, `address`, `city`, `pincode`, `created`, `modified`, `status`) VALUES
(1, 'Inga Huffman', 'mawocifox@mailinator.com', '9555621331', 'Ratione enim tenetur', '', 0, '2020-08-07 22:30:35', '2020-08-07 22:30:35', '1'),
(2, 'Gisela Alston', 'zaqon@mailinator.com', '9555621331', 'Proident distinctio', '', 0, '2020-08-07 22:32:54', '2020-08-07 22:32:54', '1'),
(3, 'Kelly Durham', 'jativu@mailinator.com', '9555621331', 'Hic tempore eu aspe', '', 0, '2020-08-07 22:40:19', '2020-08-07 22:40:19', '1'),
(4, 'Victoria Phelps', 'pivupyfo@mailinator.net', '9555621331', 'Aut ut id ipsum lab', '', 0, '2020-08-07 22:40:44', '2020-08-07 22:40:44', '1'),
(5, 'Gareth Wolf', 'pubab@mailinator.com', '9555621331', 'Vitae laudantium re', '', 0, '2020-08-07 22:41:17', '2020-08-07 22:41:17', '1'),
(6, 'Odessa Christensen', 'fybi@mailinator.com', '9555621331', 'Ullamco quae perspic', '', 0, '2020-08-07 22:41:59', '2020-08-07 22:41:59', '1'),
(7, 'Georgia Gomez', 'dyloh@mailinator.com', '9555621331', 'Ad est assumenda non', '', 0, '2020-08-08 08:31:41', '2020-08-08 08:31:41', '1'),
(8, 'Abra Phillips', 'vevewov@mailinator.com', '9555621331', 'Quae ab magna conseq', '', 0, '2020-08-08 08:36:30', '2020-08-08 08:36:30', '1'),
(9, 'Arthur Nolan', 'lysuqajepu@mailinator.net', '9555621331', 'Velit facere illo su', '', 0, '2020-08-08 08:38:02', '2020-08-08 08:38:02', '1'),
(10, 'Asher Hayden', 'wyba@mailinator.com', '9555621331', 'Possimus consequunt', '', 0, '2020-08-08 08:39:05', '2020-08-08 08:39:05', '1'),
(11, 'Emma Kidd', 'wuroxixeq@mailinator.net', '9555621331', 'Aut aut aut rerum mo', '', 0, '2020-08-08 08:58:29', '2020-08-08 08:58:29', '1'),
(12, 'Norman Cooper', 'jajuhup@mailinator.com', '9555621331', 'Consequatur Rerum l', '', 0, '2020-08-09 14:00:47', '2020-08-09 14:00:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `va_menu_tbl`
--

CREATE TABLE `va_menu_tbl` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `image` varchar(100) NOT NULL,
  `priority` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `va_orders_tbl`
--

CREATE TABLE `va_orders_tbl` (
  `id` int(11) NOT NULL,
  `rand_order_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` tinyint(4) NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT '1',
  `cancelled_by` tinyint(4) NOT NULL COMMENT '1-admin',
  `cancelled_by_boy` tinyint(4) NOT NULL,
  `delivery_boy` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `boy_id` int(11) NOT NULL,
  `boy_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-not assign,2-assign',
  `cancel_reson` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `va_orders_tbl`
--

INSERT INTO `va_orders_tbl` (`id`, `rand_order_id`, `customer_id`, `grand_total`, `user_id`, `payment_type`, `order_status`, `cancelled_by`, `cancelled_by_boy`, `delivery_boy`, `boy_id`, `boy_status`, `cancel_reson`, `created`, `modified`, `status`) VALUES
(1, '', 1, 212.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:27:42', '2020-08-07 22:27:42', '1'),
(2, '', 1, 156.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:30:36', '2020-08-07 22:30:36', '1'),
(3, '', 2, 256.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:32:54', '2020-08-07 22:32:54', '1'),
(4, '', 3, 156.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:40:20', '2020-08-07 22:40:20', '1'),
(5, '', 4, 100.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:40:45', '2020-08-07 22:40:45', '1'),
(6, '', 5, 56.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:41:17', '2020-08-07 22:41:17', '1'),
(7, '', 6, 56.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-07 22:42:01', '2020-08-07 22:42:01', '1'),
(8, '', 7, 1532.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-08 08:31:42', '2020-08-08 08:31:42', '1'),
(9, '', 8, 156.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-08 08:36:30', '2020-08-08 08:36:30', '1'),
(10, '', 9, 120.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-08 08:38:02', '2020-08-08 08:38:02', '1'),
(11, '', 10, 270.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-08 08:39:05', '2020-08-08 08:39:05', '1'),
(12, '', 11, 360.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-08 08:58:29', '2020-08-08 08:58:29', '1'),
(13, '', 12, 176.00, 1, 0, 1, 0, 0, '', 0, 1, '', '2020-08-09 14:00:47', '2020-08-09 14:00:47', '1');

-- --------------------------------------------------------

--
-- Table structure for table `va_order_items_tbl`
--

CREATE TABLE `va_order_items_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `va_order_items_tbl`
--

INSERT INTO `va_order_items_tbl` (`id`, `order_id`, `product_id`, `quantity`, `sub_total`, `user_id`, `created_on`) VALUES
(1, 1, 1, 1, 100.00, 1, '2020-08-07 22:27:39'),
(2, 1, 2, 2, 112.00, 1, '2020-08-07 22:27:39'),
(3, 2, 2, 1, 56.00, 1, '2020-08-07 22:30:35'),
(4, 2, 1, 1, 100.00, 1, '2020-08-07 22:30:35'),
(5, 3, 2, 1, 56.00, 1, '2020-08-07 22:32:53'),
(6, 3, 1, 2, 200.00, 1, '2020-08-07 22:32:53'),
(7, 4, 1, 1, 100.00, 1, '2020-08-07 22:40:19'),
(8, 4, 2, 1, 56.00, 1, '2020-08-07 22:40:19'),
(9, 5, 1, 1, 100.00, 1, '2020-08-07 22:40:44'),
(10, 6, 2, 1, 56.00, 1, '2020-08-07 22:41:17'),
(11, 7, 2, 1, 56.00, 1, '2020-08-07 22:41:59'),
(12, 8, 3, 4, 600.00, 1, '2020-08-08 08:31:41'),
(13, 8, 2, 2, 112.00, 1, '2020-08-08 08:31:41'),
(14, 8, 1, 1, 120.00, 1, '2020-08-08 08:31:41'),
(15, 8, 4, 7, 700.00, 1, '2020-08-08 08:31:41'),
(16, 9, 4, 1, 100.00, 1, '2020-08-08 08:36:29'),
(17, 9, 2, 1, 56.00, 1, '2020-08-08 08:36:29'),
(18, 10, 1, 1, 120.00, 1, '2020-08-08 08:38:02'),
(19, 11, 1, 1, 120.00, 1, '2020-08-08 08:39:05'),
(20, 11, 3, 1, 150.00, 1, '2020-08-08 08:39:05'),
(21, 12, 1, 3, 360.00, 1, '2020-08-08 08:58:28'),
(22, 13, 2, 1, 56.00, 1, '2020-08-09 14:00:47'),
(23, 13, 1, 1, 120.00, 1, '2020-08-09 14:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `va_product_tbl`
--

CREATE TABLE `va_product_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` varchar(100) NOT NULL,
  `sku` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `va_product_tbl`
--

INSERT INTO `va_product_tbl` (`id`, `name`, `image`, `sku`, `stock`, `price`, `status`, `created_on`, `updated_on`) VALUES
(1, 'roti', 'ce3034382771c16e96ad9975e570f2bb.jpg', 556659, 55, 120, 1, '2020-08-06 20:25:07', '2020-08-08 08:27:26'),
(2, 'cake', '115b7c0a76fada79aa3cfb6e336dc953.jpg', 4343, 5, 56, 1, '2020-08-06 20:25:29', '0000-00-00 00:00:00'),
(3, 'biriyani', 'cadc00e0931aa2bfc10e8b79a18c7846.jpg', 543534534, 5, 150, 1, '2020-08-08 08:22:28', '0000-00-00 00:00:00'),
(4, 'rice', '2aeea288919bc8c8874380e089cc9815.jpg', 4343, 20, 100, 1, '2020-08-08 08:28:45', '2020-08-08 08:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `va_submenu_tbl`
--

CREATE TABLE `va_submenu_tbl` (
  `id` int(11) NOT NULL,
  `submenu` varchar(60) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `priority` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `va_users_tbl`
--

CREATE TABLE `va_users_tbl` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `profile_pic` varchar(60) NOT NULL DEFAULT '1',
  `address` varchar(60) NOT NULL DEFAULT 'No address',
  `signup_verification` varchar(100) NOT NULL,
  `verified_email` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'vefify:1,not verify:2',
  `forgot_pass` int(11) NOT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'active:1,inactive:2',
  `registered_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `last_login_date` datetime NOT NULL,
  `user_last_login_ip` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `va_users_tbl`
--

INSERT INTO `va_users_tbl` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_password`, `profile_pic`, `address`, `signup_verification`, `verified_email`, `forgot_pass`, `user_status`, `registered_on`, `updated_on`, `last_login_date`, `user_last_login_ip`) VALUES
(1, 'Hara', 'hara111@gmail.com', '9556213317', '4297f44b13955235245b2497399d7a93', '1', 'No address', '64ubmnd09a1icnu7hc27vh95i20vavng', 1, 0, 1, '2020-08-07', '0000-00-00', '2020-08-09 14:00:24', '::1'),
(2, 'San', 'san@gmail.com', '9556213312', '4297f44b13955235245b2497399d7a93', '1', 'No address', '64ubmnd09a1icnu7hc27vh95i20vavng', 1, 0, 1, '2020-08-07', '0000-00-00', '2020-08-09 14:00:24', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cn_admin_tbl`
--
ALTER TABLE `cn_admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `va_address_tbl`
--
ALTER TABLE `va_address_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va_cart_tbl`
--
ALTER TABLE `va_cart_tbl`
  ADD PRIMARY KEY (`rowid`);

--
-- Indexes for table `va_customers_tbl`
--
ALTER TABLE `va_customers_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va_menu_tbl`
--
ALTER TABLE `va_menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va_orders_tbl`
--
ALTER TABLE `va_orders_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `va_order_items_tbl`
--
ALTER TABLE `va_order_items_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `va_product_tbl`
--
ALTER TABLE `va_product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `va_submenu_tbl`
--
ALTER TABLE `va_submenu_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`menu_id`);

--
-- Indexes for table `va_users_tbl`
--
ALTER TABLE `va_users_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cn_admin_tbl`
--
ALTER TABLE `cn_admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `va_address_tbl`
--
ALTER TABLE `va_address_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `va_cart_tbl`
--
ALTER TABLE `va_cart_tbl`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `va_customers_tbl`
--
ALTER TABLE `va_customers_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `va_menu_tbl`
--
ALTER TABLE `va_menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `va_orders_tbl`
--
ALTER TABLE `va_orders_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `va_order_items_tbl`
--
ALTER TABLE `va_order_items_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `va_product_tbl`
--
ALTER TABLE `va_product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `va_submenu_tbl`
--
ALTER TABLE `va_submenu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `va_users_tbl`
--
ALTER TABLE `va_users_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
