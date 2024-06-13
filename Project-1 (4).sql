-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2024 at 08:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(9, 'Table'),
(10, 'Chair'),
(11, 'Bed');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `orderdate` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `order_date` date NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT '0',
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `phone_number`, `address`, `order_date`, `payment_method`, `total_price`) VALUES
(43, 'Nguyễn Thái Bình', '0123456789', 'Trảng Bom', '0000-00-00', 'cash', 2700.00),
(44, 'Huy Johnson', '0976154487', 'Long An', '0000-00-00', 'cash', 2700.00),
(45, 'Loi Oc Cho', '0336066639', 'Long Khanh City', '2024-06-13', 'cash', 15300000.00),
(46, 'Truong Gia Huy', '0976154487', 'Long An', '2024-03-13', 'mastercard', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `date`) VALUES
(44, 43, 10, 5, 1500.00, '2024-06-12 06:39:15'),
(45, 43, 11, 6, 1200.00, '2024-06-12 06:39:15'),
(46, 44, 10, 5, 1500.00, '2024-06-12 06:41:41'),
(47, 44, 11, 6, 1200.00, '2024-06-12 06:41:41'),
(48, 45, 10, 1000, 300000.00, '2024-06-13 04:26:19'),
(49, 45, 13, 60000, 15000000.00, '2024-06-13 04:26:19'),
(50, 46, 10, 1, 300.00, '2024-06-13 04:27:27'),
(51, 46, 9, 1, 100.00, '2024-06-13 04:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `price` int(100) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `price`, `img`, `description`, `c_id`) VALUES
(9, 'Wood Table', 100, 'f4.png', 'Oak Wood Table', 9),
(10, 'Table with make up mirror', 300, 'f6.png', 'table mirror', 9),
(11, 'Brown Wool Sofa', 200, 'f1.png', 'Comfortable Sofa', 10),
(12, 'Wood Dining Set', 500, 'diningtable.jpeg', 'Dining Set', 9),
(13, 'White Double Bed', 250, 'whitedoublebed.png', 'Comfortable', 11),
(14, 'Single Baby Bed', 150, 'f2.png', 'Kawaii!!!', 11),
(15, 'Green Rotating Chair', 55, 'f3.png', 'Flexible', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE `users_account` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`id`, `fullname`, `email`, `password`, `create_at`, `update_at`, `role`) VALUES
(1, '', 'huyarkadata@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', '2024-05-30 00:33:33', '2024-05-30 00:34:06', 'user'),
(2, '', 'huygiatruong@gmail.com', '2773187d13944406356f7d6730823dfa', '2024-05-30 00:33:33', '2024-05-30 00:34:06', 'user'),
(3, '', 'tranhungthinh025@gmail.com', 'hungthinh2011', '2024-05-30 00:33:33', '2024-05-30 00:34:06', 'user'),
(8, 'Zhang Jia Hui', 'giahuy19052005@icloud.com', '44c627f5c0497eeb2a49e6e7a8d40040', '2024-05-30 07:42:24', '2024-05-30 07:42:24', 'user'),
(9, 'Truong Gia Huy', 'huygiatruong2005@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-06-06 06:36:37', '2024-06-06 06:36:37', 'admin'),
(10, 'Nguyen Thai Binh', 'binhoccho@gmail.com', '289dff07669d7a23de0ef88d2f7129e7', '2024-06-11 07:47:27', '2024-06-11 07:47:27', 'user'),
(11, 'Huymindhack', 'dailoivo@gmail.com', '2c0d86fdba22ab42959deee03ee7697b', '2024-06-13 04:24:58', '2024-06-13 04:24:58', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_account` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`p_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
