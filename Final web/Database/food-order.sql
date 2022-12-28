-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 01:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(56, 'Rudro', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(48, 'Fast Food', 'Food_Catagory_449.jpg', 'Yes', 'Yes'),
(49, 'Lunch/Dinner', 'Food_Catagory_165.jpg', 'Yes', 'Yes'),
(50, 'Desert', 'Food_Catagory_53.jpg', 'Yes', 'Yes'),
(51, 'Beverage', 'Food_Catagory_179.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(81, 'Burgar', 'A hamburger (or burger for short) is a food, typically considered a sandwich, consisting of one or more cooked patties—usually ground meat, typically beef—placed inside a sliced bread roll or bun.', '399.00', 'Food_Name_5573.jpg', 48, 'Yes', 'Yes'),
(82, 'Baked Cheese Pizza', 'A baked dish originating in Italy, which consists of a flat, round, crispy leavened dough covered with a layer of sauce and a layer of one or more toppings.', '449.00', 'Food_Name_9823.jpg', 48, 'Yes', 'Yes'),
(83, 'Sandwich', 'Sandwich, in its basic form, slices of meat, cheese, or other food placed between two slices of bread. ... Any type of roll or bread and any type of food that can be conveniently so eaten', '139.00', 'Food_Name_5013.jpg', 48, 'Yes', 'Yes'),
(84, 'Sub Sandwich', 'Sub-sandwich, in its basic form, slices of meat, cheese, or other food placed between two slices of bread. ... Any type of roll or bread and any type of food that can be conveniently so eaten', '299.00', 'Food_Name_1315.jpg', 48, 'No', 'Yes'),
(85, 'Chicken Fry', 'Chicken fry stock images in HD and millions of other royalty-free stock photos, illustrations and vectors in the Shutterstock collection.', '199.00', 'Food_Name_2289.jpg', 48, 'Yes', 'Yes'),
(86, 'Naga Korai', 'A food From BD Bytes', '140.00', 'Food_Name_5379.jpg', 49, 'Yes', 'Yes'),
(87, 'Fried Rice', 'Chinese Style Egg Fried Rice with Vegetables and Cilantro', '240.00', 'Food_Name_8402.jpg', 49, 'Yes', 'Yes'),
(88, 'Chicken Polau', 'A chicken polau from Biriyani House', '120.00', 'Food_Name_2249.jpg', 49, 'Yes', 'Yes'),
(89, 'Kacchi', 'Kacchi', '240.00', 'Food_Name_6279.jpg', 49, 'Yes', 'Yes'),
(90, 'Cake', 'Cake', '460.00', 'Food_Name_6858.jpg', 50, 'Yes', 'Yes'),
(91, 'Ice-Cream', 'Ice-Cream', '80.00', 'Food_Name_1969.jpg', 50, 'Yes', 'Yes'),
(92, 'Cup-Cake', 'Cup-Cake', '50.00', 'Food_Name_4693.jpg', 50, 'Yes', 'Yes'),
(93, 'Coca Cola', 'Coca Cola', '40.00', 'Food_Name_6002.jpg', 51, 'Yes', 'Yes'),
(94, 'Fanta', 'Fanta', '50.00', 'Food_Name_2672.jpg', 51, 'Yes', 'Yes'),
(95, 'Sprite', 'Sprite', '40.00', 'Food_Name_4486.jpg', 51, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(9, 'Burgar', '399.00', 3, '1197.00', '2022-01-06 10:45:24', 'Ordered', 'Shadman Taqi', '01762536478', 'taqi@gmail.com', 'Bashundhara, D block');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
