-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 06:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `administrator`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `user_type` varchar(11) NOT NULL DEFAULT 'Admin',
  `password` varchar(50) NOT NULL,
  `c_password` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `name`, `email`, `number`, `user_type`, `password`, `c_password`, `date`) VALUES
(7, 'Donna Mae Garcenila', 'garcenila@gmail.com', 2147483647, 'Admin', 'garcenila', 'garcenila', '2023-06-12'),
(8, 'Arianne Faith Cepeda', 'cepeda@gmail.com', 0, 'Admin', 'cepeda', 'cepeda', '2023-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_availed`
--

CREATE TABLE `tbl_availed` (
  `avail_id` int(11) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `services_name` varchar(100) NOT NULL,
  `purok` int(20) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(50) NOT NULL DEFAULT 'Antique',
  `status` smallint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_availed`
--

INSERT INTO `tbl_availed` (`avail_id`, `customer_id`, `services_name`, `purok`, `barangay`, `municipality`, `province`, `status`, `date`) VALUES
(1, 62, '<br />\r\n<b>Notice</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsA&Rcu', 1, 'Sinundolan', 'San remigio', 'Antique', 0, '2023-06-08'),
(2, 63, '<br />\r\n<b>Notice</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsA&Rcu', 1, 'Sinundolan', 'San Remigio', 'Antique', 0, '2023-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `stocks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `customer_id`, `product_name`, `quantity`, `price`, `status`, `image`, `stocks`) VALUES
(268, 62, 'Compass', 1, 20, 1, './assets/img668439.png', 86),
(269, 62, 'Star water color', 1, 30, 1, './assets/imgstar_water_color-removebg-preview.png', 192),
(270, 62, 'Compass', 1, 20, 1, './assets/img668439.png', 85),
(271, 62, 'Star water color', 3, 30, 1, './assets/imgstar_water_color-removebg-preview.png', 190),
(272, 62, 'Compass', 2, 20, 1, './assets/img668439.png', 83),
(273, 62, 'Simcard(globe)', 2, 40, 1, './assets/img144505.png', 500),
(274, 62, 'Faber castel ballpen(black) ', 3, 17, 1, './assets/img700976.png', 992),
(275, 63, 'Star water color', 9, 30, 1, './assets/imgstar_water_color-removebg-preview.png', 186),
(276, 63, 'Correction tape(master)', 4, 22, 1, './assets/img526753.png', 375),
(277, 63, 'Simcard(globe)', 4, 40, 1, './assets/img144505.png', 498),
(278, 63, 'Faber castel ballpen(black) ', 5, 17, 1, './assets/img700976.png', 989),
(279, 64, 'Compass', 5, 20, 0, './assets/img668439.png', 79),
(281, 63, 'Compass', 1, 20, 1, './assets/img668439.png', 64),
(282, 63, 'Simcard(globe)', 1, 40, 1, './assets/img144505.png', 494),
(283, 63, 'Star water color', 1, 30, 0, './assets/imgstar_water_color-removebg-preview.png', 105);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `status`, `date_created`) VALUES
(7, 'Envelop', '', '2023-01-26 13:43:15'),
(9, 'Folder', '', '2023-01-26 13:43:15'),
(10, 'Ballpen', '', '2023-01-26 13:43:15'),
(22, 'Crayons', '', '2023-01-26 13:43:15'),
(23, 'Water Color', '', '2023-01-26 13:43:15'),
(24, 'Bond Paper', '', '2023-01-26 13:43:15'),
(25, 'Cartolina', '', '2023-01-26 13:43:15'),
(32, 'Chart', '', '2023-01-26 13:43:15'),
(33, 'Pencil', '', '2023-01-26 13:43:15'),
(36, 'Portfolio', '', '2023-01-26 13:43:15'),
(37, 'Tools', '', '2023-01-26 13:43:15'),
(38, 'Paper', '', '2023-01-26 13:43:15'),
(39, 'Accessories', '', '2023-01-26 13:43:15'),
(40, 'SIM card', '', '2023-01-26 13:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` bigint(12) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `confirm_pass` varchar(150) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(11) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `name`, `email`, `number`, `pass`, `confirm_pass`, `date`, `user_type`) VALUES
(63, 'Josephine Flogoso', 'flogoso@gmail.com', 9971728290, 'flogoso', '', '2023-06-10 19:33:41', 'Customer'),
(64, 'Wella Mae Japay', 'wmjapay29@gmail.com', 9151763291, 'japay032999', '', '2023-06-12 11:07:23', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `services_name` varchar(100) NOT NULL,
  `services_image` varchar(255) NOT NULL,
  `status` smallint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inquiry`
--

INSERT INTO `tbl_inquiry` (`id`, `customer_id`, `services_name`, `services_image`, `status`, `date`) VALUES
(65, 63, ' Web hosting', ' ./assets/img818047.jpg', 0, '2023-06-10 19:34:33'),
(66, 63, ' CCTV installation', ' ./assets/imgcctv.jpg', 0, '2023-06-10 19:34:41'),
(67, 64, ' CCTV installation', ' ./assets/imgcctv.jpg', 0, '2023-06-12 11:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `purok` int(11) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL DEFAULT 'Antique',
  `total_price` int(20) NOT NULL,
  `method` varchar(50) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `time` time DEFAULT current_timestamp(),
  `date` date DEFAULT current_timestamp(),
  `30%` decimal(10,0) NOT NULL,
  `remaining` decimal(10,0) NOT NULL,
  `total_amount` decimal(50,0) NOT NULL,
  `product_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `purok`, `barangay`, `municipality`, `province`, `total_price`, `method`, `order_status`, `time`, `date`, `30%`, `remaining`, `total_amount`, `product_name`) VALUES
(103, 63, 1, 'Sinundolan', 'San Remigio', 'Antique', 603, 'cash on delivery', '1', '19:42:29', '2023-06-10', '36', '84', '120', 'Star water color (9) , Correction tape(master) (4) , Simcard(globe) (4) , Faber castel ballpen(black)  (5) ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_desc` varchar(150) NOT NULL,
  `stocks` int(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_desc`, `stocks`, `product_image`, `price`, `category_id`, `uploaded_date`) VALUES
(65, 'Star water color', 'Produced with high purity pigments, rich luster and easier to mix with water, it is smooth and easy to apply.', 85, './assets/imgstar_water_color-removebg-preview.png', 30, 23, '2023-01-19 19:00:49'),
(66, 'Compass', 'A navigational instrument, it consist of magnetized pointers.', 54, './assets/img668439.png', 20, 37, '2023-01-19 19:00:49'),
(67, 'Correction tape(master)', 'Clean correction tape, made of high quality, smooth and accurate, and easy to fill.', 331, './assets/img526753.png', 22, 37, '2023-01-19 19:00:49'),
(68, 'Simcard(globe)', 'Level up your mobile internet experience with your globe prepaid 5G SIM.', 444, './assets/img144505.png', 40, 40, '2023-01-19 19:00:49'),
(69, 'Faber castel ballpen(black) ', 'Smooth and smudge free writing behavior. combination with ergonomics shapes and specially designed grips-zones, provide timeless and writing effortles', 934, './assets/img700976.png', 17, 10, '2023-01-19 19:00:49'),
(70, 'Cactus BondPaper(A4)', 'Standardized copy paper size, dimensions are 210x297mm it is close to equivalent to U.S letter size.', 148, './assets/img416522.png', 230, 24, '2023-01-19 19:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `services_id` int(11) NOT NULL,
  `services_name` varchar(100) NOT NULL,
  `services_desc` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Available',
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`services_id`, `services_name`, `services_desc`, `image`, `status`, `uploaded_date`) VALUES
(1, 'Web hosting', 'Online Service that allows you to to publish your website files unto internet.', './assets/img818047.jpg', 'Available', '2023-01-26 13:42:30'),
(2, 'Web development', 'The guiding and maintenance of website, make your website look great, work fast, and perform well.', './assets/img84777.jpg', 'Available', '2023-01-26 13:42:30'),
(3, 'CCTV installation', 'A television system which signals are not publicly distributed but that are monitored, primarily for surveillance and security purposes.', './assets/imgcctv.jpg', 'Available', '2023-01-26 13:42:30'),
(37, 'Network Installation', 'description', './assets/img616849.jpg', 'Available', '2023-05-15 19:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_fees`
--

CREATE TABLE `tbl_shipping_fees` (
  `shipping_id` int(11) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `shipping_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shipping_fees`
--

INSERT INTO `tbl_shipping_fees` (`shipping_id`, `barangay`, `municipality`, `shipping_cost`, `shipping_date`) VALUES
(1, 'Agricula', 'San Remigio', 30, '2023-01-25 00:38:40'),
(2, 'Alegria', 'San Remigio', 35, '2023-01-25 00:38:40'),
(3, 'Aningalan', 'San Remigio', 50, '2023-01-25 00:38:40'),
(4, 'Atabay', 'San Remigio', 45, '2023-01-26 14:23:26'),
(5, 'Bagumbayan', 'San Remigio', 20, '2023-01-26 14:23:57'),
(6, 'Baladjay', 'San Remigio', 9, '2023-01-26 14:24:23'),
(7, 'Cabunga-an', 'San Remigio', 30, '2023-01-26 14:25:30'),
(8, 'Banbanan', 'San Remigio', 8, '2023-01-26 14:26:30'),
(9, 'Barangbang', 'San Remigio', 0, '2023-01-26 14:26:40'),
(10, 'Bawang', 'San Remigio', 50, '2023-01-26 14:26:49'),
(11, 'Bugo', 'San Remigio', 25, '2023-01-26 14:26:58'),
(12, 'Bulan-bulan', 'San Remigio', 50, '2023-01-26 14:27:07'),
(13, 'Cabiawan', 'San Remigio', 9, '2023-01-26 14:27:17'),
(14, 'Cadolon', 'San Remigio', 0, '2023-01-26 14:27:25'),
(15, 'Carawisan 1', 'San Remigio', 14, '2023-01-26 14:27:35'),
(16, 'Carawisan 2', 'San Remigio', 14, '2023-01-26 14:27:44'),
(17, 'Carmelo 1', 'San Remigio', 16, '2023-01-26 14:27:53'),
(18, 'Carmelo 2', 'San Remigio', 16, '2023-01-26 14:28:03'),
(19, 'General Fullon', 'San Remigio', 60, '2023-01-26 14:28:13'),
(20, 'General Luna', 'San Remigio', 50, '2023-01-26 14:28:23'),
(21, 'Iguirindon', 'San Remigio', 0, '2023-01-26 14:28:32'),
(22, 'Insubuan', 'San Remigio', 50, '2023-01-26 14:28:42'),
(23, 'Lapak', 'San Remigio', 50, '2023-01-26 14:28:50'),
(24, 'Lumpatan', 'San Remigio', 40, '2023-01-26 14:29:00'),
(25, 'La Union', 'San Remigio', 50, '2023-01-26 14:29:10'),
(26, 'Magdalena', 'San Remigio', 20, '2023-01-26 14:29:19'),
(27, 'Maragubdub', 'San Remigio', 5, '2023-01-26 14:28:23'),
(28, 'Nagbangi 1', 'San Remigio', 25, '2023-01-26 14:28:32'),
(29, 'Nagbangi 2', 'San Remigio', 25, '2023-01-26 14:28:42'),
(30, 'Nasuli', 'San Remigio', 0, '2023-01-26 14:28:50'),
(31, 'Orquia', 'San Remigio', 40, '2023-01-26 14:29:00'),
(32, 'Osorio 1', 'San Remigio', 50, '2023-01-26 14:29:10'),
(33, 'Osorio 2', 'San Remigio', 50, '2023-06-03 12:25:04'),
(34, 'Panpanan 1', 'San Remigio', 50, '2023-06-03 12:25:20'),
(35, 'Panpanan 2', 'San Remigio', 50, '2023-06-03 12:25:31'),
(36, 'Poblacion', 'San Remigio', 0, '2023-06-03 12:25:41'),
(37, 'Ramon magsaysay', 'San Remigio', 5, '2023-06-03 12:25:51'),
(38, 'Rizal', 'San Remigio', 50, '2023-06-03 12:26:00'),
(39, 'San Rafael', 'San Remigio', 22, '2023-06-03 12:26:13'),
(40, 'Sinundolan', 'San Remigio', 35, '2023-06-03 12:51:19'),
(41, 'Sumaray', 'San Remigio', 50, '2023-06-03 12:51:40'),
(42, 'Trinidad', 'San Remigio', 15, '2023-06-03 12:51:56'),
(43, 'Tubudan', 'San Remigio', 50, '2023-06-03 12:52:30'),
(44, 'Vilvar', 'San Remigio', 9, '2023-06-03 12:52:51'),
(45, 'Walker', 'San Remigio', 60, '2023-06-03 12:53:05'),
(46, 'Alangan', 'Sibalom', 20, '2023-06-03 12:54:23'),
(47, 'Bari\r\n\r\n', 'Sibalom', 17, '2023-06-03 12:54:44'),
(48, 'Biga-a', 'Sibalom', 18, '2023-06-03 12:55:07'),
(49, 'Bongbongan 1', 'Sibalom', 15, '2023-06-03 12:55:38'),
(50, 'Bongbongan 2', 'Sibalom', 15, '2023-06-03 12:55:53'),
(51, 'Bongsod', 'Sibalom', 17, '2023-06-03 12:56:31'),
(52, 'Bontol', 'Sibalom', 20, '2023-06-03 12:56:49'),
(53, 'Bugnay', 'Sibalom', 20, '2023-06-03 12:57:04'),
(54, 'Bulalacao', 'Sibalom', 20, '2023-06-03 12:57:24'),
(55, 'Cabanbanan', 'Sibalom', 25, '2023-06-03 12:57:59'),
(56, 'Cabariuan', 'Sibalom', 25, '2023-06-03 12:58:29'),
(57, 'Cabladan', 'Sibalom', 30, '2023-06-03 12:58:57'),
(58, 'Cadoldolan', 'Sibalom', 20, '2023-06-03 12:59:17'),
(59, 'Calog', 'Sibalom', 20, '2023-06-03 12:59:41'),
(60, 'Calo-oy', 'Sibalom', 20, '2023-06-03 12:59:59'),
(61, 'Catmon', 'Sibalom', 15, '2023-06-03 13:00:12'),
(62, 'Catungan 1', 'Sibalom', 25, '2023-06-03 13:00:37'),
(63, 'Catungdan 2', 'Sibalom', 25, '2023-06-03 13:00:53'),
(64, 'District 1', 'Sibalom', 15, '2023-06-03 13:02:19'),
(65, 'District 2', 'Sibalom', 15, '2023-06-03 13:02:34'),
(66, 'District 3', 'Sibalom', 15, '2023-06-03 13:02:46'),
(67, 'Distict 4', 'Sibalom', 15, '2023-06-03 13:03:20'),
(68, '', 'San Jose', 20, '2023-06-03 13:03:47'),
(69, '', 'Hamtic', 25, '2023-06-03 13:09:26'),
(70, '', 'Anini-y', 30, '2023-06-03 13:10:02'),
(71, '', 'Barbaza', 35, '2023-06-03 13:10:24'),
(72, '', 'Belison\r\n', 25, '2023-06-03 13:10:51'),
(73, '', 'Bugasong\r\n', 30, '2023-06-03 13:11:14'),
(74, '', 'Caluya', 50, '2023-06-03 13:11:25'),
(75, '', 'Culasi', 50, '2023-06-03 13:12:01'),
(76, '', 'Laua-an\r\n', 40, '2023-06-03 13:12:24'),
(77, '', 'Libertad\r\n', 50, '2023-06-03 13:12:41'),
(78, '', 'Pandan\r\n', 45, '2023-06-03 13:12:56'),
(79, '', 'Patnongon', 30, '2023-06-03 13:13:12'),
(80, '', 'Sebaste\r\n\r\n', 45, '2023-06-03 13:13:43'),
(81, '', 'Tibiao\r\n', 40, '2023-06-03 13:13:56'),
(82, '', 'Tobias Fornier\r\n', 25, '2023-06-03 13:14:10'),
(83, '', 'Valderrama', 30, '2023-06-03 13:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `transaction_id` int(11) NOT NULL,
  `stocks` int(50) NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `stocks`, `price`, `date`) VALUES
(1, 250, '30', '2023-06-02'),
(2, 40, '50', '2023-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stocks` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `customer_id`, `product_name`, `price`, `image`, `stocks`, `date`) VALUES
(70, 55, 'Star water color', 30, './assets/imgstar_water_color-removebg-preview.png', 200, '2023-06-03 20:35:44'),
(71, 55, 'Compass', 20, './assets/img668439.png', 100, '2023-06-03 20:36:08'),
(72, 55, 'Correction tape(master)', 22, './assets/img526753.png', 392, '2023-06-03 20:36:34'),
(73, 64, 'Faber castel ballpen(black) ', 17, './assets/img700976.png', 984, '2023-06-12 11:09:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_availed`
--
ALTER TABLE `tbl_availed`
  ADD PRIMARY KEY (`avail_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`id`),
  ADD KEY `tbl_cart_ibfk_1` (`product_name`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `tbl_product_ibfk_1` (`category_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `tbl_shipping_fees`
--
ALTER TABLE `tbl_shipping_fees`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_availed`
--
ALTER TABLE `tbl_availed`
  MODIFY `avail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_shipping_fees`
--
ALTER TABLE `tbl_shipping_fees`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_availed`
--
ALTER TABLE `tbl_availed`
  ADD CONSTRAINT `tbl_availed_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD CONSTRAINT `tbl_inquiry_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `tbl_sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`);

--
-- Constraints for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
