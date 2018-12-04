-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2018 at 03:48 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meratrainer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `image` text NOT NULL,
  `pass_status` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `city_id`, `address`, `pincode`, `image`, `pass_status`, `date`) VALUES
(1, 'Aasif', 'Sayyad', 'admin@gmail.com', '9922031316', '518e6c76caf51eb410caab3c21def1b4b3c07401', 1, 'pune ', '411428', 'img.jpg', 0, '2018-02-22 10:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` bigint(20) NOT NULL,
  `blog_name` varchar(255) NOT NULL,
  `blog_code` varchar(255) NOT NULL,
  `blog_url_name` varchar(255) NOT NULL,
  `blog_img` text NOT NULL COMMENT 'Multiple Images Array',
  `description` text NOT NULL COMMENT 'array',
  `date` varchar(12) NOT NULL,
  `written_by` varchar(50) NOT NULL COMMENT 'admin / user',
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user_id => id in users table',
  `publish_status` int(1) NOT NULL COMMENT '1-publish,0-don''t publish',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL,
  `category_name` text NOT NULL,
  `cat_code` text NOT NULL,
  `cat_url` text NOT NULL,
  `category_img` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `cat_code`, `cat_url`, `category_img`, `createdAt`) VALUES
(20, 'Fruits', 'C451354', 'fruits', 'categoryimg_201802221519290398.jpg', '2018-02-22 09:06:39'),
(21, 'Vegetables', 'C270935', 'vegetables', 'categoryimg_201802221519290528.jpg', '2018-02-22 09:08:48'),
(22, 'Food Mart', 'C521423', 'food-mart', 'categoryimg_201802221519290590.jpg', '2018-02-22 09:09:50'),
(23, 'Home & Hygiene', 'C230682', 'home-&-hygiene', 'categoryimg_201802221519290616.jpg', '2018-02-22 09:10:16'),
(24, 'Beauty Products', 'C717376', 'beauty-products', 'categoryimg_201802221519290639.jpg', '2018-02-22 09:10:39'),
(25, 'Health Care', 'C792724', 'health-care', 'categoryimg_201802221519290657.jpg', '2018-02-22 09:10:58'),
(26, 'Dairy Product', 'C786743', 'dairy-product', 'categoryimg_201802221519290693.jpg', '2018-02-22 09:11:33'),
(27, 'Beverages', 'C148925', 'beverages', 'categoryimg_201802221519290720.jpg', '2018-02-22 09:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `conatct_id` bigint(20) NOT NULL,
  `name_contact` varchar(50) NOT NULL,
  `lastname_contact` varchar(50) NOT NULL,
  `email_contact` varchar(50) NOT NULL,
  `phone_contact` varchar(15) NOT NULL,
  `message_contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `delivery_details_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `partial_order_id` bigint(20) NOT NULL,
  `driver_name` varchar(30) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `vehicle_no` varchar(15) NOT NULL,
  `order_type` int(1) NOT NULL COMMENT '1-main_order,2-partial_order',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_details_id`, `order_id`, `partial_order_id`, `driver_name`, `mobile`, `vehicle_no`, `order_type`, `createdAt`) VALUES
(1, 2, 0, 'Abc', '9730202512', 'MH12LK1234', 1, '2018-01-18 11:04:17'),
(2, 2, 0, 'Abc', '9730202521', 'MH12LK1478', 1, '2018-01-18 11:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `comments` text NOT NULL,
  `status` int(1) NOT NULL COMMENT '1-display,0-hide',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `follow_id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` text NOT NULL,
  `follow` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`follow_id`, `product_id`, `user_id`, `follow`, `createdAt`) VALUES
(1, 17, 'd3040eacc1fa095593e6c29b7fffb9f8', '0', '2018-01-18 12:23:26'),
(2, 18, '8e01e03e0ffb00fe6aefadc6b03adc6c', '1', '2018-01-22 12:54:39'),
(3, 5, '8e01e03e0ffb00fe6aefadc6b03adc6c', '1', '2018-01-22 12:56:01'),
(4, 19, '8e01e03e0ffb00fe6aefadc6b03adc6c', '1', '2018-01-22 12:56:25'),
(5, 19, '3f71d6e9cfabc771c1bfa136d6ac4e7a', '1', '2018-01-22 12:56:51'),
(6, 17, '8e01e03e0ffb00fe6aefadc6b03adc6c', '1', '2018-01-22 13:07:20'),
(7, 58, '8e01e03e0ffb00fe6aefadc6b03adc6c', '1', '2018-01-22 13:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `language_name`, `createdAt`) VALUES
(1, 'ENGLISH', '2017-12-27 09:59:48'),
(2, 'HINDI', '2017-12-27 09:59:48'),
(3, 'GUJRATI', '2017-12-27 10:00:03'),
(4, 'MARATHI', '2017-12-27 10:00:03'),
(5, 'Urdu', '2018-01-15 04:54:54'),
(6, 'Maithali', '2018-01-15 04:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` text NOT NULL,
  `likes` int(1) NOT NULL COMMENT '1-like,0-dislike',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `product_id`, `user_id`, `likes`, `createdAt`) VALUES
(1, 5, '8e01e03e0ffb00fe6aefadc6b03adc6c', 1, '2018-01-22 12:37:16'),
(2, 5, '3f71d6e9cfabc771c1bfa136d6ac4e7a', 0, '2018-01-22 12:35:34'),
(3, 17, '3f71d6e9cfabc771c1bfa136d6ac4e7a', 1, '2018-01-22 12:36:43'),
(4, 18, '3f71d6e9cfabc771c1bfa136d6ac4e7a', 1, '2018-01-22 12:36:46'),
(5, 19, '3f71d6e9cfabc771c1bfa136d6ac4e7a', 1, '2018-01-22 12:36:50'),
(6, 17, '8e01e03e0ffb00fe6aefadc6b03adc6c', 0, '2018-01-22 12:37:23'),
(7, 18, '8e01e03e0ffb00fe6aefadc6b03adc6c', 1, '2018-01-22 12:37:27'),
(8, 19, '8e01e03e0ffb00fe6aefadc6b03adc6c', 1, '2018-01-22 12:37:30'),
(9, 61, '8e01e03e0ffb00fe6aefadc6b03adc6c', 1, '2018-01-22 12:58:56'),
(10, 63, '8e01e03e0ffb00fe6aefadc6b03adc6c', 1, '2018-01-22 12:59:26'),
(11, 5, '7fa7eca943526a5b6a97d3015033ff01', 1, '2018-02-10 13:04:10'),
(12, 17, '7fa7eca943526a5b6a97d3015033ff01', 0, '2018-02-10 13:04:13'),
(13, 18, '7fa7eca943526a5b6a97d3015033ff01', 0, '2018-02-10 13:04:15'),
(14, 19, '7fa7eca943526a5b6a97d3015033ff01', 1, '2018-02-10 13:02:03'),
(15, 18, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 06:15:31'),
(16, 17, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 09:24:30'),
(17, 19, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 06:15:37'),
(18, 58, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 06:15:46'),
(19, 67, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 06:40:29'),
(20, 73, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 06:42:55'),
(21, 83, '7fa7eca943526a5b6a97d3015033ff01', 1, '2018-02-12 10:50:40'),
(22, 67, '7fa7eca943526a5b6a97d3015033ff01', 1, '2018-02-12 10:52:21'),
(23, 59, '5217e445002c80ff2c47b635528fdbb0', 1, '2018-02-12 10:56:38'),
(24, 18, '1283136841cbe2f5fbbedbe12d9f189d', 1, '2018-02-20 09:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `date` varchar(12) NOT NULL,
  `shipping_address` text NOT NULL COMMENT 'if changed @checkout else take user_id',
  `city` varchar(50) NOT NULL COMMENT 'if changed @checkout else take user_id',
  `pincode` varchar(7) NOT NULL COMMENT 'if changed @checkout else take user_id',
  `subtotal` float NOT NULL,
  `shipping_charges` float NOT NULL,
  `discount` float NOT NULL,
  `final_total` float NOT NULL,
  `payment_mode` int(1) NOT NULL COMMENT '1-COD,2-online',
  `payment_status` int(1) NOT NULL COMMENT '0-pending,1-received, 2-refunded',
  `order_status` int(1) NOT NULL COMMENT '1-order placed,2-processing,3-delivery assigned, 4-out for delivery,5-delivered,6-cancelled,7-returned',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `partially_del_status` int(1) NOT NULL,
  `status` int(11) NOT NULL,
  `txnid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` float NOT NULL,
  `qty` float NOT NULL,
  `amount` float NOT NULL COMMENT 'product_rate * qty',
  `trainer_id` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_range`
--

CREATE TABLE `price_range` (
  `price_range_id` int(11) NOT NULL,
  `price_range` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_range`
--

INSERT INTO `price_range` (`price_range_id`, `price_range`, `createdAt`) VALUES
(1, '0-100', '2017-12-27 10:00:47'),
(2, '101-200', '2017-12-27 10:01:00'),
(3, '201-300', '2017-12-27 10:01:12'),
(4, '301-400', '2017-12-27 10:01:12'),
(5, '401-500', '2017-12-27 10:01:23'),
(7, '1001-1500', '2017-12-27 10:01:37'),
(8, '1501-2000', '2017-12-27 10:01:37'),
(9, '2001-2500', '2017-12-27 10:01:53'),
(10, '2501-3000', '2017-12-27 10:01:53'),
(11, '3001-3500', '2017-12-27 10:02:11'),
(12, '3501-4000', '2017-12-27 10:02:11'),
(13, '4001-4500', '2017-12-27 10:02:26'),
(14, '4501-5000', '2017-12-27 10:02:26'),
(15, '5001-Above', '2017-12-27 10:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `trainer_id` varchar(255) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `product_title` varchar(255) NOT NULL COMMENT 'name',
  `punchline` text NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_url` text NOT NULL,
  `suitable_for` int(11) NOT NULL COMMENT '1-industry,2-person',
  `language_id` int(11) NOT NULL,
  `price_range_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `product_img` text NOT NULL,
  `video_path` text NOT NULL,
  `audio_path` text NOT NULL,
  `youtube_link` text NOT NULL,
  `video_type` int(1) NOT NULL COMMENT '1-paid,0-free',
  `sample` text NOT NULL COMMENT 'in case of book / e-book / poster etc',
  `description` text NOT NULL,
  `delivery_time` varchar(100) NOT NULL,
  `duration` text NOT NULL COMMENT 'minutes/hours/pages',
  `special_offer` int(1) NOT NULL COMMENT '1-yes,0-no',
  `likes` varchar(15) NOT NULL,
  `view_count` varchar(15) NOT NULL,
  `product_type` int(1) NOT NULL COMMENT '1-product,2-video,3-audio,4-other',
  `status` int(1) NOT NULL COMMENT '0-out of stock,1-available,2-pre-launch',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `like_count` text NOT NULL,
  `follow_count` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `trainer_id`, `category_id`, `product_title`, `punchline`, `product_code`, `product_url`, `suitable_for`, `language_id`, `price_range_id`, `price`, `product_img`, `video_path`, `audio_path`, `youtube_link`, `video_type`, `sample`, `description`, `delivery_time`, `duration`, `special_offer`, `likes`, `view_count`, `product_type`, `status`, `createdAt`, `like_count`, `follow_count`) VALUES
(88, '1', 20, 'Apple- Kinnaur Delicious', '', 'PR819244', 'apple--kinnaur-delicious', 0, 0, 2, 152, 'productsimg_201802221519291473.jpg', '', '', '', 0, '', '', '5', '', 0, '', '', 0, 1, '2018-02-22 09:24:33', '', ''),
(89, '1', 20, 'Coconut-brown', '', 'PR141082', 'coconut-brown', 0, 0, 1, 28, 'productsimg_201802221519292136.jpg', '', '', '', 0, '', 'Coconut-Brown', '2', '', 0, '', '', 0, 1, '2018-02-22 09:35:36', '', ''),
(90, '1', 20, 'Dessert Banana', '', 'PR895385', 'dessert-banana', 0, 0, 1, 40, 'productsimg_201802221519292173.jpg', '', '', '', 0, '', 'Dessert Banana', '1', '', 0, '', '', 0, 1, '2018-02-22 09:36:13', '', ''),
(91, '1', 20, 'Lemon', '', 'PR36285', 'lemon', 0, 0, 1, 19, 'productsimg_201802221519292261.jpg', '', '', '', 0, '', 'Lemon', '1', '', 0, '', '', 0, 1, '2018-02-22 09:37:41', '', ''),
(92, '1', 20, 'Papaya', '', 'PR878723', 'papaya', 0, 0, 1, 40, 'productsimg_201802221519292300.jpg', '', '', '', 0, '', 'Papaya', '1', '', 0, '', '', 0, 1, '2018-02-22 09:38:20', '', ''),
(93, '1', 20, 'Pineapple', '', 'PR501312', 'pineapple', 0, 0, 1, 38, 'productsimg_201802221519292346.jpg', '', '', '', 0, '', '', '1', '', 0, '', '', 0, 1, '2018-02-22 09:39:06', '', ''),
(94, '1', 20, 'Pomegranate', '', 'PR222900', 'pomegranate', 0, 0, 1, 90, 'productsimg_201802221519292397.jpg', '', '', '', 0, '', 'Pomegranate', '2', '', 0, '', '', 0, 1, '2018-02-22 09:39:57', '', ''),
(95, '1', 20, 'Sweet Lime', '', 'PR903625', 'sweet-lime', 0, 0, 1, 50, 'productsimg_201802221519292438.jpg', '', '', '', 0, '', 'Sweet Lime', '1', '', 0, '', '', 0, 1, '2018-02-22 09:40:38', '', ''),
(96, '1', 20, 'Watermelon', '', 'PR465667', 'watermelon', 0, 0, 1, 80, 'productsimg_201802221519292506.jpg', '', '', '', 0, '', 'Watermelon', '1', '', 0, '', '', 0, 1, '2018-02-22 09:41:46', '', ''),
(97, '1', 20, 'Almond (badam)', '', 'PR908721', 'almond-(badam)', 0, 0, 3, 290, 'productsimg_201802221519292550.jpg', '', '', '', 0, '', 'Almond (Badam)', '2', '', 0, '', '', 0, 1, '2018-02-22 09:42:30', '', ''),
(98, '1', 20, 'Hypercity Walnut', '', 'PR587646', 'hypercity-walnut', 0, 0, 3, 125, 'productsimg_201802221519292708.jpg', '', '', '', 0, '', '100 GM', '2', '', 0, '', '', 0, 1, '2018-02-22 09:45:08', '', ''),
(99, '1', 20, 'Kaju Tukda', '', 'PR786804', 'kaju-tukda', 0, 0, 2, 190, 'productsimg_201802221519292739.jpg', '', '', '', 0, '', '250 GM', '2', '', 0, '', '', 0, 1, '2018-02-22 09:45:39', '', ''),
(100, '1', 21, 'Big Brinjal', '', 'PR555206', 'big-brinjal', 0, 0, 1, 20, 'productsimg_201802221519292848.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:47:28', '', ''),
(101, '1', 21, 'Bitter Gourd', '', 'PR939910', 'bitter-gourd', 0, 0, 1, 35, 'productsimg_201802221519292887.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:48:07', '', ''),
(102, '1', 21, 'Bottle Gourd', '', 'PR967651', 'bottle-gourd', 0, 0, 1, 20, 'productsimg_201802221519292946.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:49:06', '', ''),
(103, '1', 21, 'Cabbage', '', 'PR547882', 'cabbage', 0, 0, 1, 30, 'productsimg_201802221519292986.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:49:46', '', ''),
(104, '1', 21, 'Capsicum-green', '', 'PR253601', 'capsicum-green', 0, 0, 1, 30, 'productsimg_201802221519293026.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:50:26', '', ''),
(105, '1', 21, 'Carrot-orange', '', 'PR993133', 'carrot-orange', 0, 0, 1, 50, 'productsimg_201802221519293065.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:51:05', '', ''),
(106, '1', 21, 'Cauliflower', '', 'PR359649', 'cauliflower', 0, 0, 1, 30, 'productsimg_201802221519293105.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:51:45', '', ''),
(107, '1', 21, 'Colocassia', '', 'PR518920', 'colocassia', 0, 0, 1, 20, 'productsimg_201802221519293158.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:52:38', '', ''),
(108, '1', 21, 'Coriander Leaves/cilantro', '', 'PR913238', 'coriander-leaves/cilantro', 0, 0, 1, 15, 'productsimg_201802221519293206.jpg', '', '', '', 0, '', '100 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:53:26', '', ''),
(109, '1', 21, 'French Beans', '', 'PR205261', 'french-beans', 0, 0, 1, 20, 'productsimg_201802221519293241.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:54:01', '', ''),
(110, '1', 21, 'Fresh Ginger', '', 'PR44647', 'fresh-ginger', 0, 0, 1, 10, 'productsimg_201802221519293297.jpg', '', '', '', 0, '', '100 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:54:57', '', ''),
(111, '1', 21, 'Garlic', '', 'PR758911', 'garlic', 0, 0, 1, 50, 'productsimg_201802221519293355.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:55:55', '', ''),
(112, '1', 21, 'Green Chilli', '', 'PR751617', 'green-chilli', 0, 0, 1, 20, 'productsimg_201802221519293397.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:56:37', '', ''),
(113, '1', 21, 'Lady Finger/bhendi', '', 'PR35552', 'lady-finger/bhendi', 0, 0, 1, 15, 'productsimg_201802221519293430.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:57:10', '', ''),
(114, '1', 21, 'Onion-red', '', 'PR62927', 'onion-red', 0, 0, 1, 20, 'productsimg_201802221519293468.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:57:48', '', ''),
(115, '1', 21, 'Potato', '', 'PR599914', 'potato', 0, 0, 1, 20, 'productsimg_201802221519293515.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:58:35', '', ''),
(116, '1', 21, 'Salad Cucumber', '', 'PR173889', 'salad-cucumber', 0, 0, 1, 15, 'productsimg_201802221519293550.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:59:10', '', ''),
(117, '1', 21, 'Tomato', '', 'PR925506', 'tomato', 0, 0, 1, 20, 'productsimg_201802221519293584.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 09:59:44', '', ''),
(118, '1', 22, 'Alpenliebe 2 Choco Eclairs', '', 'PR861175', 'alpenliebe-2-choco-eclairs', 0, 0, 1, 50, 'productsimg_201802221519293736.jpg', '', '', '', 0, '', '250 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:02:16', '', ''),
(119, '1', 22, 'Alpenliebe Jelly Toffee', '', 'PR549407', 'alpenliebe-jelly-toffee', 0, 0, 1, 20, 'productsimg_201802221519293778.jpg', '', '', '', 0, '', '62.9 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:02:58', '', ''),
(120, '1', 22, 'Amul Shrikand Elaichi', '', 'PR406463', 'amul-shrikand-elaichi', 0, 0, 1, 85, 'productsimg_201802221519293818.jpg', '', '', '', 0, '', '500 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:03:38', '', ''),
(121, '1', 22, 'Bounty Bagged Minis Chocolate', '', 'PR466613', 'bounty-bagged-minis-chocolate', 0, 0, 2, 190, 'productsimg_201802221519293868.jpg', '', '', '', 0, '', '227 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:04:28', '', ''),
(122, '1', 22, 'Britannia 50-50 Maska Chaska Biscuits', '', 'PR581390', 'britannia-50-50-maska-chaska-biscuits', 0, 0, 1, 10, 'productsimg_201802221519293907.jpg', '', '', '', 0, '', '55 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:05:07', '', ''),
(123, '1', 22, 'Britannia Marie Gold Biscuits', '', 'PR772583', 'britannia-marie-gold-biscuits', 0, 0, 1, 10, 'productsimg_201802221519293939.jpg', '', '', '', 0, '', '27 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:05:39', '', ''),
(124, '1', 22, 'Britannia Nutrichoice 5 Grain Biscuits', '', 'PR197998', 'britannia-nutrichoice-5-grain-biscuits', 0, 0, 1, 50, 'productsimg_201802221519293972.jpg', '', '', '', 0, '', '200 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:06:12', '', ''),
(125, '1', 22, 'Cadbury 5 Star Chocolate', '', 'PR946899', 'cadbury-5-star-chocolate', 0, 0, 1, 5, 'productsimg_201802221519294010.jpg', '', '', '', 0, '', '11 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:06:50', '', ''),
(126, '1', 22, 'Sugna Shakti Eggs Box', '', 'PR276275', 'sugna-shakti-eggs-box', 0, 0, 1, 40, 'productsimg_201802221519294102.jpg', '', '', '', 0, '', '12 PC', '1', '', 0, '', '', 0, 1, '2018-02-22 10:08:22', '', ''),
(127, '1', 22, 'Aashirvaad Pav Bhaji Mix', '', 'PR840332', 'aashirvaad-pav-bhaji-mix', 0, 0, 1, 75, 'productsimg_201802221519294134.jpg', '', '', '', 0, '', '285 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:08:54', '', ''),
(128, '1', 22, 'Dal Makhani', '', 'PR767059', 'dal-makhani', 0, 0, 1, 80, 'productsimg_201802221519294193.jpg', '', '', '', 0, '', '285 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:09:53', '', ''),
(129, '1', 22, 'Brown & Polson Custard Powder', '', 'PR951416', 'brown-&-polson-custard-powder', 0, 0, 1, 35, 'productsimg_201802221519294229.jpg', '', '', '', 0, '', '100 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:10:29', '', ''),
(130, '1', 22, 'Instant Manchow Soup', '', 'PR722930', 'instant-manchow-soup', 0, 0, 1, 25, 'productsimg_201802221519294263.jpg', '', '', '', 0, '', '35 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:11:03', '', ''),
(131, '1', 22, 'Amul Butter', '', 'PR626831', 'amul-butter', 0, 0, 1, 38, 'productsimg_201802221519294298.jpg', '', '', '', 0, '', '100 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:11:38', '', ''),
(132, '1', 22, 'Bingo Yumitos Chilli Sprinkled Chips', '', 'PR263824', 'bingo-yumitos-chilli-sprinkled-chips', 0, 0, 1, 10, 'productsimg_201802221519294332.jpg', '', '', '', 0, '', '35 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:12:12', '', ''),
(133, '1', 22, 'Bingo Premium Salted Potato Chips', '', 'PR180480', 'bingo-premium-salted-potato-chips', 0, 0, 1, 20, 'productsimg_201802221519294363.jpg', '', '', '', 0, '', '55 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:12:43', '', ''),
(134, '1', 22, 'Kurkure Masala Munch', '', 'PR583526', 'kurkure-masala-munch', 0, 0, 1, 30, 'productsimg_201802221519294406.jpg', '', '', '', 0, '', '170 GM', '1', '', 0, '', '', 0, 1, '2018-02-22 10:13:26', '', ''),
(135, '1', 24, 'Cinthol Cool Soap', '', 'PR956085', 'cinthol-cool-soap', 0, 0, 1, 88, 'productsimg_201802221519294508.jpg', '', '', '', 0, '', '3 PC', '1', '', 0, '', '', 0, 1, '2018-02-22 10:15:08', '', ''),
(136, '1', 24, 'Adidas Dynamic Spray - Men', '', 'PR525787', 'adidas-dynamic-spray---men', 0, 0, 1, 199, 'productsimg_201802221519294572.jpg', '', '', '', 0, '', '150 ML', '1', '', 0, '', '', 0, 1, '2018-02-22 10:16:12', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `product_img` text NOT NULL,
  `trainer_id` text NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `rating` text NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `share_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `share_status` int(1) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suitable_for`
--

CREATE TABLE `suitable_for` (
  `suitable_id` bigint(20) NOT NULL,
  `suitable_name` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suitable_for`
--

INSERT INTO `suitable_for` (`suitable_id`, `suitable_name`, `createdAt`) VALUES
(1, 'Industry', '2018-01-13 12:07:47'),
(2, 'Person', '2018-01-13 12:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `system_settings_id` bigint(20) NOT NULL,
  `system_mail` varchar(100) NOT NULL,
  `contact_one` varchar(15) NOT NULL,
  `contact_two` varchar(15) NOT NULL,
  `landline_one` varchar(15) NOT NULL,
  `landline_two` varchar(15) NOT NULL,
  `system_title` varchar(50) NOT NULL,
  `slogan` varchar(100) NOT NULL,
  `logo_image` text NOT NULL,
  `slider_images` text NOT NULL COMMENT 'multiple images',
  `banner_images` text NOT NULL COMMENT 'multiple images',
  `currency` varchar(10) NOT NULL,
  `smtp_mail` varchar(50) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `smtp_port` varchar(15) NOT NULL,
  `paypal_mail` varchar(50) NOT NULL,
  `mail_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trackorder`
--

CREATE TABLE `trackorder` (
  `trackorder_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_status` int(1) NOT NULL COMMENT '1-order placed,2-processing,3-delivery assigned, 4-out for delivery,5-delivered,6-cancelled,7-returned',
  `description` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(10) NOT NULL,
  `trainer_name` varchar(100) NOT NULL,
  `trainer_contact` varchar(50) NOT NULL,
  `trainer_email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `category_id` int(10) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `languages` varchar(20) NOT NULL,
  `awards` varchar(100) NOT NULL,
  `topics` varchar(100) NOT NULL,
  `industries` varchar(100) NOT NULL,
  `profile_pic` varchar(1024) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `Like` varchar(100) NOT NULL,
  `is_active` int(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `trainer_name`, `trainer_contact`, `trainer_email`, `address`, `description`, `category_id`, `qualification`, `experience`, `languages`, `awards`, `topics`, `industries`, `profile_pic`, `rating`, `Like`, `is_active`, `createdAt`) VALUES
(1, 'Anjum', '9511612191', 'anjoom.techrnl@gmail.com', 'pune', 'You may be interested in a career as a corporate trainer. Corporate trainers work in offices to teach skills and knowledge to employees. They might work full time for the company or be hired as from a corporate training company for a short period of time.', 19, 'B.E(computer sci)', '10 year', '1,2,4', '', '', '', '', '', '150', 1, '2018-01-07 09:09:30'),
(2, 'harshada', '9730202521', 'harshada.techrnl@gmail.com', 'pune', 'You may be interested in a career as a corporate trainer. Corporate trainers work in offices to teach skills and knowledge to employees. They might work full time for the company or be hired as from a corporate training company for a short period of time.', 13, 'BCS', '10years', '1,2,3,4', '', '', '', '', '', '250', 1, '2018-01-07 09:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` bigint(20) NOT NULL,
  `type_name` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`, `createdAt`) VALUES
(1, 'Product', '2018-01-13 10:57:51'),
(2, 'Other1', '2018-01-13 11:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `id` text NOT NULL,
  `deviceToken` text NOT NULL,
  `userType` int(5) NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` text NOT NULL,
  `picture` text NOT NULL,
  `locale` varchar(10) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  `google_picture_link` text NOT NULL,
  `profile_url` text NOT NULL,
  `fb_picture_url` text NOT NULL,
  `ln_picture_url` text NOT NULL,
  `area_location` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `shipping_address` text NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `active_status` int(1) NOT NULL,
  `pass_status` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `id`, `deviceToken`, `userType`, `oauth_provider`, `oauth_uid`, `google_id`, `fname`, `lname`, `username`, `email`, `contact`, `password`, `gender`, `picture`, `locale`, `google_link`, `google_picture_link`, `profile_url`, `fb_picture_url`, `ln_picture_url`, `area_location`, `city`, `shipping_address`, `pincode`, `active_status`, `pass_status`, `created`, `updated_at`, `modified`) VALUES
(38, '40be5f581d7038a4388d59f46426a84b', '947f5b5e77ba8865cadb696aa8ff0c33', 1, '', '', '', 'Aasif', 'Sayyad', '', 'aasif@gmail.com', '9225732186', '', '', '', '', '', '', '', '', '', '', 'pune', '', '411028', 0, 0, '0000-00-00 00:00:00', '2018-02-22 10:56:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `view_count`
--

CREATE TABLE `view_count` (
  `view_count_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `view_count` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`conatct_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`delivery_details_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `partial_order_id` (`partial_order_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `price_range`
--
ALTER TABLE `price_range`
  ADD PRIMARY KEY (`price_range_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `trainer_id` (`trainer_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `price_range_id` (`price_range_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`share_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `suitable_for`
--
ALTER TABLE `suitable_for`
  ADD PRIMARY KEY (`suitable_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`system_settings_id`);

--
-- Indexes for table `trackorder`
--
ALTER TABLE `trackorder`
  ADD PRIMARY KEY (`trackorder_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `view_count`
--
ALTER TABLE `view_count`
  ADD PRIMARY KEY (`view_count_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `conatct_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_details_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_range`
--
ALTER TABLE `price_range`
  MODIFY `price_range_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `share_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suitable_for`
--
ALTER TABLE `suitable_for`
  MODIFY `suitable_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `system_settings_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trackorder`
--
ALTER TABLE `trackorder`
  MODIFY `trackorder_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `view_count`
--
ALTER TABLE `view_count`
  MODIFY `view_count_id` bigint(20) NOT NULL AUTO_INCREMENT;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `record_cancel` ON SCHEDULE EVERY 5 MINUTE STARTS '2016-07-20 17:19:53' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE  `tbl_booking_order` SET  `status` = 1 WHERE  `created_on` > ( NOW( ) - INTERVAL 60 MINUTE ) AND  `created_on` < ( NOW( ) - INTERVAL 30 MINUTE ) AND DATE( created_on ) = CURDATE( )  
AND `status` = 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
