-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 04:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview_buzztro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pw_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `pw_hash`) VALUES
(1, 'admin123', 'admin@mail.com', '99c5e07b4d5de9d18c350cdf64c5aa3d'),
(2, 'leomessi', 'leo@mail.com', '2dafaffcd2f1f8e813834473e380080e');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `cust_id`, `product_name`, `price`, `order_date`) VALUES
(1, 1, 3, 'NBA Lakers Jersey #23', 100, '2021-05-15'),
(2, 2, 3, 'UCL 2020 Final Istanbul Ball', 120, '2021-05-15'),
(3, 1, 3, 'NBA Lakers Jersey #23', 100, '2021-05-15'),
(4, 1, 1, 'NBA Lakers Jersey #23', 100, '2021-05-15'),
(5, 2, 1, 'UCL 2020 Final Istanbul Ball', 120, '2021-05-15'),
(6, 4, 2, 'Nike KD Trey 5 - Black', 115, '2021-05-16'),
(7, 3, 2, 'PS5 DualSense controller', 90, '2021-05-16'),
(8, 1, 2, 'NBA Lakers Jersey #23', 100, '2021-05-16'),
(9, 10, 2, 'NBA GSW Warriors \"Oakland\" Jersey #30', 100, '2021-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_description` varchar(50) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_1` text NOT NULL,
  `img_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `p_name`, `p_description`, `category`, `price`, `stock`, `img_1`, `img_2`) VALUES
(1, 'NBA Lakers Jersey #23', 'NBA Lakers Lebron James Jersey #23', 'Sports', 100, 10, 'NBA Lakers jersey Lebron James.jpg', 'NBA Lakers jersey Lebron James 2.jpg'),
(2, 'UCL 2020 Final Istanbul Ball', 'UEFA UCL 2020 Istanbul Official Final Ball', 'Sports', 120, 15, 'UEFA UCL 2020 Final Istanbul Official Football.jpg', 'UEFA UCL 2020 Final Istanbul Official Football 2.jpg'),
(3, 'PS5 DualSense controller', 'PS5 DualSense Wireless Controller', 'Gaming', 90, 20, 'PS5 DualSense controller.jpg', 'PS5 DualSense controller 2.jpg'),
(4, 'Nike KD Trey 5 - Black', 'Nike KD Trey 5 Basketball shoes- Black', 'Sneakers', 115, 8, 'Nike KD Trey 5 - Black.jpg', 'Nike KD Trey 5 - Black 2.jpg'),
(5, 'NBA 2K21: Mamba Edition PS4', 'NBA 2K21: Mamba Edition PS4', 'Gaming', 80, 10, 'NBA 2K21 Mamba Edition PS4.jpg', 'NBA 2K21 Mamba Edition PS4 2.jpg'),
(6, 'Nike Air Jordan 4 Cactus Jack - Blue', 'Nike AJ4 Travis Scott Cactus Jack - Blue', 'Sneakers', 200, 5, 'Nike Air Jordan 4 Cactus Jack - Blue .jpeg', 'Nike Air Jordan 4 Cactus Jack - Blue.jpg'),
(7, 'Nike Air Jordan 1 Low ', 'Nike Air Jordan 1 \"Low\"', 'Sneakers', 180, 5, 'Nike Air Jordan 1 Low 2.jpg', 'Nike Air Jordan 1 Low.jpg'),
(8, 'Wilson NCAA Basketball ', 'Wilson NCAA Basketball - Offical Replica Size 7', 'Sports', 40, 20, 'Wilson Basketball 2.jpg', 'Wilson Basketball.jpg'),
(9, 'FIFA 21 - PS4', 'FIFA 21 PS4 Standard Edition', 'Gaming', 35, 20, 'FIFA 21 PS4.png', 'FIFA 21 PS4 2.png'),
(10, 'NBA GSW Warriors \"Oakland\" Jersey #30', 'NBA GSW Warriors Stephen Curry \"Oakland\" Jersey #3', 'Sports', 100, 10, 'NBA GSW Warriors jersey Stephen Curry.png', 'NBA GSW Warriors jersey Stephen Curry 2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pw_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `pw_hash`) VALUES
(1, 'LeBron', 'James', 'kingjames@123.com', '202cb962ac59075b964b07152d234b70'),
(2, 'dwayne', 'wade', 'wade@123.com', 'd81f9c1be2e08964bf9f24b15f0e4900'),
(3, 'tony', 'montana', 'montana@mail.com', 'cc20f43c8c24dbc0b2539489b113277a'),
(4, 'tony', 'stark', 'tony@345.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
