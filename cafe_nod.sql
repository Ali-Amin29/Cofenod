-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2022 at 07:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafe_nod`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID_ORDER` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_USER` bigint NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Process'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID_ORDER`, `created_at`, `ID_USER`, `status`) VALUES
(44756134107, '2022-11-01 20:27:23', 63, 'Process'),
(90971911422, '2022-11-02 08:44:43', 62, 'Process'),
(136691125625, '2022-11-01 19:54:54', 63, 'Process'),
(241847079123, '2022-11-01 19:51:54', 52, 'Process'),
(255631956175, '2022-11-01 22:15:29', 71, 'Process'),
(272126492482, '2022-11-01 20:07:42', 62, 'Process'),
(390322808788, '2022-11-01 20:29:57', 63, 'Process'),
(408805246054, '2022-11-01 20:10:11', 52, 'Process'),
(458422788173, '2022-11-01 21:18:16', 70, 'Process'),
(462680918151, '2022-11-01 20:09:03', 52, 'Process'),
(544332755092, '2022-11-01 22:01:59', 70, 'Process'),
(564535844060, '2022-11-01 21:38:12', 62, 'Process'),
(618019205426, '2022-10-30 13:52:05', 63, 'Process'),
(710190226346, '2022-11-01 20:07:29', 62, 'Process'),
(785708481973, '2022-11-01 19:55:07', 63, 'Process'),
(810597751577, '2022-10-30 13:46:29', 63, 'Process'),
(827260157311, '2022-11-01 20:04:49', 62, 'Process');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_ID` bigint NOT NULL,
  `product_ID` bigint NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_ID`, `product_ID`, `amount`) VALUES
(44756134107, 18, 1),
(90971911422, 16, 3),
(90971911422, 17, 3),
(90971911422, 35, 6),
(136691125625, 18, 1),
(136691125625, 26, 4),
(136691125625, 35, 3),
(255631956175, 18, 1),
(255631956175, 25, 3),
(255631956175, 28, 1),
(272126492482, 18, 1),
(408805246054, 16, 1),
(458422788173, 17, 4),
(458422788173, 18, 3),
(458422788173, 36, 1),
(462680918151, 18, 1),
(544332755092, 16, 1),
(544332755092, 17, 1),
(544332755092, 18, 1),
(544332755092, 30, 1),
(564535844060, 17, 1),
(618019205426, 16, 1),
(618019205426, 17, 1),
(618019205426, 18, 1),
(710190226346, 18, 1),
(785708481973, 17, 1),
(785708481973, 35, 1),
(810597751577, 17, 1),
(810597751577, 29, 4),
(827260157311, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` bigint NOT NULL,
  `name_prod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `name_prod`, `price`, `image`, `action`, `type`) VALUES
(16, 'mango ', 90, 'mango.jpg', 1, 'drinks'),
(17, 'orange', 50, 'orange.jpg', 1, 'drinks'),
(18, 'tea', 10, 'tea.png', 1, 'drinks'),
(21, 'green tea', 15, 'green-tea.jpg', 1, 'drinks'),
(23, 'Tomato chips', 8, 'tomato.png', 1, 'snacks'),
(24, 'Ruffles chips', 15, 'ruffles.png', 1, 'snacks'),
(25, 'Pringles chips', 50, 'pringles.png', 1, 'snacks'),
(26, 'Munchos chips', 30, 'munchos.jpg', 1, 'snacks'),
(27, 'Basbosa', 55, 'basbosa.png', 1, 'dessert'),
(28, 'Cheese Cake', 70, 'cheese.png', 1, 'dessert'),
(29, 'Oreo Cake', 120, 'oreo.png', 1, 'dessert'),
(30, 'Ice Cream', 25, 'ice.png', 1, 'dessert'),
(31, 'Fruits salads', 45, 'fruits.png', 1, 'dessert'),
(32, 'Nutella crepe ', 80, 'crep.png', 1, 'dessert'),
(33, 'chocolate cake', 55, 'cake.png', 1, 'dessert'),
(34, 'Brawnies', 30, 'brawnies.png', 1, 'dessert'),
(35, 'cappuccino', 25, 'cappuccino.jpg', 1, 'drinks'),
(36, 'Coffee', 50, 'coffee.png', 1, 'drinks');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` int DEFAULT NULL,
  `floor` int DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `room`, `floor`, `password`, `image`, `role`, `create_at`, `adress`) VALUES
(52, 'abdelrahman', 'abdelrahman@yahoo.com', 15, 1, 'e10adc3949ba59abbe56e057f20f883e', 'our-team-4.jpg', 'admin', '2022-10-29 14:26:46', NULL),
(62, 'aliamin', 'aliamin@cafenod.net', 4, 1, '25d55ad283aa400af464c76d713c07ad', '278469327_1143840869489732_8047474992485565821_n.jpg', 'admin', '2022-10-30 10:50:58', NULL),
(63, 'sayed', 'sayed@gmail.com', 15, 15, 'e10adc3949ba59abbe56e057f20f883e', '1667130340our-team-5.jpg', 'user', '2022-10-30 11:45:40', NULL),
(64, 'ahmed', 'ahmed@cafenod.net', 15, 2, '25f9e794323b453885f5181f1b624d0b', '1666818436our-team-2.jpg', 'user', '2022-10-30 11:49:55', NULL),
(67, 'hussin', 'hussin@yahoo.com', 15, 1, '25f9e794323b453885f5181f1b624d0b', 'our-team-4.jpg', 'user', '2022-11-01 18:50:14', NULL),
(70, 'sanaa ', 'sanaa@yahoo.com', 15, 11, '25d55ad283aa400af464c76d713c07ad', 'userName.png', 'admin', '2022-11-01 19:09:02', NULL),
(71, 'galal', 'galal@cafenod.net', 15, 1, '25d55ad283aa400af464c76d713c07ad', 'our-team-6.jpg', 'admin', '2022-11-01 20:12:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `user_ID` (`ID_USER`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_ID`,`product_ID`),
  ADD KEY `order_ID` (`order_ID`,`product_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID_ORDER` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=847477278473;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`order_ID`) REFERENCES `orders` (`ID_ORDER`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
