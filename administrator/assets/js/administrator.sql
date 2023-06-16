-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 10:33 AM
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
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stocks` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `customer_id`, `product_name`, `quantity`, `price`, `stocks`, `image`) VALUES
(13, 29, 'Star water color', 3, 30, 0, './assets/img39681.png'),
(14, 29, 'Faber castel ballpen  ', 1, 17, 0, './assets/imgFaber_Castell_Ballpen-removebg-preview.png'),
(15, 29, 'Periodic table', 1, 13, 0, './assets/imgPeriodic_Table-removebg-preview.png'),
(16, 30, 'Star water color', 1, 30, 0, './assets/img39681.png'),
(17, 30, 'Faber castel ballpen  ', 1, 17, 0, './assets/imgFaber_Castell_Ballpen-removebg-preview.png'),
(18, 30, 'Periodic table', 1, 13, 0, './assets/imgPeriodic_Table-removebg-preview.png'),
(71, 24, 'Compass', 6, 20, 0, './assets/img668439.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `date_created`, `status`) VALUES
(4, 'Cartolina', '0000-00-00 00:00:00', ''),
(5, 'Cartolina', '0000-00-00 00:00:00', ''),
(7, 'Cartolina', '0000-00-00 00:00:00', ''),
(9, 'Cartolina', '0000-00-00 00:00:00', ''),
(10, 'Cartolina', '0000-00-00 00:00:00', ''),
(22, 'Cartolina', '0000-00-00 00:00:00', ''),
(23, 'Cartolina', '0000-00-00 00:00:00', ''),
(24, 'Cartolina', '0000-00-00 00:00:00', ''),
(25, 'Cartolina', '0000-00-00 00:00:00', ''),
(32, 'Cartolina', '0000-00-00 00:00:00', ''),
(33, 'Cartolina', '0000-00-00 00:00:00', ''),
(36, 'Cartolina', '0000-00-00 00:00:00', ''),
(37, 'Cartolina', '0000-00-00 00:00:00', ''),
(38, 'Paper', '2023-01-22 17:18:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `confirm_pass` varchar(150) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(11) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `name`, `email`, `pass`, `confirm_pass`, `date`, `user_type`) VALUES
(24, 'a', 'ab@gmail.com', '934b535800b1cba8f96a5d72f72f1611', '', '2023-01-11 01:29:37', 'user'),
(25, 'f', 'g@gmail.com', '934b535800b1cba8f96a5d72f72f1611', '934b535800b1cba8f96a5d72f72f1611', '2023-01-11 12:11:56', 'Admin'),
(27, 'c', 'c@gmail.com', '099b3b060154898840f0ebdfb46ec78f', '', '2023-01-11 15:34:17', 'user'),
(28, 'josephine', 'jgflogoso@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', '2023-01-12 14:17:51', 'admin'),
(29, 'josephine', 'jgflogoso@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '', '2023-01-12 19:42:35', 'user'),
(30, 'juan dela cruz', 'cruz@gmail.com', 'fbade9e36a3f36d3d676c1b808451dd7', '', '2023-01-12 23:40:43', 'user'),
(31, 'josephine flogoso', 'jgflogoso@gmail.com', 'b59c67bf196a4758191e42f76670ceba', '', '2023-01-13 13:24:40', 'user'),
(32, 'donna garcenila', 'donna@gmail.com', '202cb962ac59075b964b07152d234b70', '', '2023-01-13 15:04:21', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `services_name` varchar(100) NOT NULL,
  `services_image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `inventory_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `number` int(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `total_products` int(30) NOT NULL,
  `total_price` int(20) NOT NULL,
  `method` varchar(50) NOT NULL,
  `order_status` int(11) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` varchar(50) NOT NULL DEFAULT 'Available',
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_desc`, `stocks`, `product_image`, `price`, `category_id`, `status`, `uploaded_date`) VALUES
(65, 'Star water color', 'Produced with high purity pigments, rich luster and easier to mix with water, it is smooth and easy to apply.', 20, './assets/imgstar_water_color-removebg-preview.png', 30, 10, 'Available', '2023-01-19 19:00:49'),
(66, 'Compass', 'A navigational instrument, it consist of magnetized pointers.', 20, './assets/img668439.png', 20, 33, 'null', '2023-01-19 19:00:49'),
(67, 'Correction tape(master)', 'Clean correction tape, made of high quality, smooth and accurate, and easy to fill.', 20, './assets/img526753.png', 22, 33, 'Available', '2023-01-19 19:00:49'),
(68, 'Simcard(globe)', 'Level up your mobile internet experience with your globe prepaid 5G SIM.', 20, './assets/img144505.png', 40, 37, 'Available', '2023-01-19 19:00:49'),
(69, 'Faber castel ballpen(black) ', 'Smooth and smudge free writing behavior. combination with ergonomics shapes and specially designed grips-zones, provide timeless and writing effortles', 20, './assets/img700976.png', 17, 7, 'Available', '2023-01-19 19:00:49'),
(70, 'Cactus BondPaper(A4)', 'Standardized copy paper size, dimensions are 210x297mm it is close to equivalent to U.S letter size.', 20, './assets/img416522.png', 230, 22, 'Available', '2023-01-19 19:00:49'),
(71, 'Portfolio(skyblue)', 'Use to carry papers and other materials.', 20, './assets/img193141.png', 18, 25, 'Available', '2023-01-19 19:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `reports_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sales_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL
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
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`services_id`, `services_name`, `services_desc`, `image`, `uploaded_date`, `status`) VALUES
(1, 'Web hosting', 'Online Service that allows you to to publish your website files unto internet.', './assets/img818047.jpg', '2023-01-21 21:51:08', 'Available'),
(2, 'Web development', 'The guiding and maintenance of website, make your website look great, work fast, and perform well.', './assets/img84777.jpg', '2023-01-21 21:51:08', 'Available'),
(3, 'CCTV installation', 'A television system which signals are not publicly distributed but that are monitored, primarily for surveillance and security purposes.', './assets/imgcctv.jpg', '2023-01-21 21:51:08', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping_fees`
--

CREATE TABLE `tbl_shipping_fees` (
  `shipping_id` int(11) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `shipping_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shipping_fees`
--

INSERT INTO `tbl_shipping_fees` (`shipping_id`, `barangay`, `municipality`, `shipping_cost`) VALUES
(1, 'Sinundolan', 'San Remigio', 20),
(2, 'District 1', 'Sibalom', 7),
(3, 'Bariri', 'San Jose', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sales_id` (`sales_id`);

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
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`reports_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `services_id` (`services_id`);

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
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `reports_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shipping_fees`
--
ALTER TABLE `tbl_shipping_fees`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_inventory_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`),
  ADD CONSTRAINT `tbl_inventory_ibfk_3` FOREIGN KEY (`sales_id`) REFERENCES `tbl_sales` (`sales_id`);

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
-- Constraints for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD CONSTRAINT `tbl_reports_ibfk_1` FOREIGN KEY (`sales_id`) REFERENCES `tbl_sales` (`sales_id`),
  ADD CONSTRAINT `tbl_reports_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_reports_ibfk_3` FOREIGN KEY (`inventory_id`) REFERENCES `tbl_inventory` (`inventory_id`);

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `tbl_sales_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_sales_ibfk_2` FOREIGN KEY (`services_id`) REFERENCES `tbl_services` (`services_id`);

--
-- Constraints for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
