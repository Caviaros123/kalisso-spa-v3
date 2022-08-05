-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 03:48 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalisso`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `address_line1` varchar(100) NOT NULL,
  `address_line2` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `default_address` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`address_id`, `user_id`, `title`, `recipient_name`, `phone_number`, `address_line1`, `address_line2`, `state`, `postal_code`, `default_address`) VALUES
(1, 1, 'Home Address', 'Robert Steven', '0811888999', '6019 Madison St', 'West New York, NJ', 'USA', '07093', 1),
(2, 1, 'Apartment Address', 'Robert Steven', '0811888999', 'Meridia Park Avenue Apartments', '6035 Park Ave, West New York, NJ', 'USA', '07093', 0),
(3, 1, 'Office Address', 'Robert Steven', '0811888999', '6015 Van Buren Pl', 'West New York, NJ', 'USA', '07093', 0),
(4, 1, 'Mom Address', 'Stephanie', '0811564855', '7503 2nd Ave', 'North Bergen, NJ', 'USA', '07047', 0),
(5, 1, 'Anthony Address', 'Anthony Daniel', '0811118997', '223-201 62nd St', 'West New York, NJ', 'USA', '07093', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `category_order` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_image`, `category_order`) VALUES
(1, 'Fashion', 'https://ijshop.ijteknologi.com/assets/images/category/fashion.png', 1),
(2, 'Smartphone & Tablets', 'https://ijshop.ijteknologi.com/assets/images/category/smartphone.png', 2),
(3, 'Electronic', 'https://ijshop.ijteknologi.com/assets/images/category/electronic.png', 3),
(4, 'Otomotif', 'https://ijshop.ijteknologi.com/assets/images/category/otomotif.png', 4),
(5, 'Sport', 'https://ijshop.ijteknologi.com/assets/images/category/sport.png', 5),
(6, 'Food', 'https://ijshop.ijteknologi.com/assets/images/category/food.png', 6),
(7, 'Voucher\r\nGame', 'https://ijshop.ijteknologi.com/assets/images/category/voucher_game.png', 7),
(8, 'Health & Care', 'https://ijshop.ijteknologi.com/assets/images/category/health.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_banner`
--

CREATE TABLE `tbl_category_banner` (
  `category_banner_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_banner_name` varchar(50) NOT NULL,
  `category_banner_image` varchar(255) NOT NULL,
  `category_banner_start_date` datetime NOT NULL,
  `category_banner_end_date` datetime NOT NULL,
  `category_banner_active_status` int(1) NOT NULL,
  `category_banner_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_banner`
--

INSERT INTO `tbl_category_banner` (`category_banner_id`, `category_id`, `category_banner_name`, `category_banner_image`, `category_banner_start_date`, `category_banner_end_date`, `category_banner_active_status`, `category_banner_create_date`) VALUES
(1, 1, 'banner 1', 'https://ijshop.ijteknologi.com/assets/images/category_banner/1.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(2, 1, 'banner 2', 'https://ijshop.ijteknologi.com/assets/images/category_banner/2.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(3, 1, 'banner 3', 'https://ijshop.ijteknologi.com/assets/images/category_banner/3.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_for_you`
--

CREATE TABLE `tbl_category_for_you` (
  `category_for_you_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_for_you_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_for_you`
--

INSERT INTO `tbl_category_for_you` (`category_for_you_id`, `category_id`, `category_for_you_image`) VALUES
(1, 7, 'https://ijshop.ijteknologi.com/assets/images/category_for_you/1.jpg'),
(2, 3, 'https://ijshop.ijteknologi.com/assets/images/category_for_you/2.jpg'),
(3, 5, 'https://ijshop.ijteknologi.com/assets/images/category_for_you/3.jpg'),
(4, 2, 'https://ijshop.ijteknologi.com/assets/images/category_for_you/4.jpg'),
(5, 8, 'https://ijshop.ijteknologi.com/assets/images/category_for_you/5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(20) NOT NULL,
  `day` int(3) NOT NULL,
  `term` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_coupon`
--

INSERT INTO `tbl_coupon` (`coupon_id`, `coupon_name`, `day`, `term`) VALUES
(1, 'FASHION50', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(2, 'EVERY20', 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(3, 'COC40', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(4, 'PUBG70', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(5, 'HEADSET10', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(6, 'ENDOFMONTH', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(7, 'LUCKYPRIZED', 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(8, 'RANDOMSALE', 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(9, 'HEALTH15', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.'),
(10, 'RIDER35', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tortor tortor, ultrices id scelerisque a, elementum id elit. Maecenas feugiat tellus sed augue malesuada, id tempus ex sodales. Nulla at cursus eros. Integer porttitor ac ipsum quis sollicitudin. Sed mollis sapien massa, et dignissim turpis vulputate et. Ut ac odio porta, blandit velit in, pharetra lacus. Integer aliquam dolor nec augue porttitor hendrerit. Vestibulum aliquam urna finibus, luctus felis nec, hendrerit augue. Fusce eget lacinia leo. Vivamus porttitor, lacus eget rutrum tempus, odio magna tincidunt elit, ut vulputate nibh velit eu lectus. Morbi felis mi, efficitur sed diam in, elementum ullamcorper leo. Ut bibendum lorem consectetur pellentesque gravida. Sed est orci, consectetur id nunc quis, volutpat consectetur nisi.\n\nDonec est neque, accumsan sit amet imperdiet porta, suscipit eu ex. Phasellus lobortis mollis pharetra. Donec maximus rhoncus elit, sed pellentesque justo pretium vel. Integer vitae facilisis lectus. Suspendisse potenti. Mauris iaculis placerat feugiat. Integer commodo dui sit amet finibus congue. Nulla egestas lacus vel elit aliquet, at pulvinar ex venenatis. Vivamus eget maximus libero, quis vulputate diam. Pellentesque vel justo vel lectus viverra aliquet ut eget metus.\n\nVivamus malesuada velit pretium laoreet pulvinar. Duis non dignissim sapien, vitae viverra purus. Curabitur a gravida mauris. Nullam turpis odio, ultricies sed ultricies non, sodales eget purus. Donec pulvinar bibendum metus vitae ornare. Phasellus eleifend orci eget blandit sollicitudin. Sed sed urna in magna dignissim eleifend.\n\nVestibulum vitae erat maximus, laoreet ex quis, laoreet nunc. Sed porttitor massa eget cursus rhoncus. Suspendisse et tellus et enim ullamcorper semper eget in nisl. Nam metus mauris, sollicitudin in venenatis at, pretium at nulla. Sed a accumsan dui. Quisque fermentum mollis erat, ac fringilla eros auctor eu. Donec placerat mi ut sem ullamcorper tempor. Pellentesque ut nulla sollicitudin, tempus arcu quis, vulputate dolor. Sed ultrices cursus nisl, nec tempor neque tempus at. Pellentesque nec dolor faucibus, porttitor quam sed, vehicula est. Vestibulum placerat placerat neque eu posuere. Pellentesque id mauris hendrerit, placerat lacus id, auctor eros. Praesent vestibulum mattis est, non facilisis urna accumsan et. Vestibulum scelerisque ornare sapien, nec blandit purus rhoncus mollis. Sed faucibus, augue consequat rhoncus rutrum, sapien mauris dictum quam, nec tempus orci urna vitae lorem. Curabitur sit amet nisl et lacus fringilla pulvinar.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flashsale`
--

CREATE TABLE `tbl_flashsale` (
  `flashsale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` int(3) NOT NULL,
  `count_item` int(3) NOT NULL,
  `sale` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_flashsale`
--

INSERT INTO `tbl_flashsale` (`flashsale_id`, `product_id`, `discount`, `count_item`, `sale`) VALUES
(1, 1, 35, 20, 17),
(2, 2, 20, 20, 19),
(3, 3, 30, 60, 13),
(4, 4, 20, 130, 70),
(5, 5, 15, 20, 10),
(6, 6, 40, 130, 99),
(7, 7, 20, 40, 30),
(8, 8, 30, 20, 15),
(9, 9, 10, 41, 2),
(10, 10, 46, 20, 18),
(11, 11, 10, 20, 20),
(12, 12, 15, 20, 19),
(13, 13, 10, 20, 7),
(14, 14, 40, 14, 10),
(15, 15, 40, 140, 96),
(16, 16, 40, 20, 4),
(17, 17, 20, 60, 50),
(18, 18, 20, 20, 17),
(19, 19, 20, 20, 6),
(20, 20, 20, 20, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_banner`
--

CREATE TABLE `tbl_home_banner` (
  `home_banner_id` int(11) NOT NULL,
  `home_banner_name` varchar(50) NOT NULL,
  `home_banner_image` varchar(255) NOT NULL,
  `home_banner_start_date` datetime NOT NULL,
  `home_banner_end_date` datetime NOT NULL,
  `home_banner_active_status` int(1) NOT NULL,
  `home_banner_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_home_banner`
--

INSERT INTO `tbl_home_banner` (`home_banner_id`, `home_banner_name`, `home_banner_image`, `home_banner_start_date`, `home_banner_end_date`, `home_banner_active_status`, `home_banner_create_date`) VALUES
(1, 'banner 1', 'https://ijshop.ijteknologi.com/assets/images/home_banner/1.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(2, 'banner 2', 'https://ijshop.ijteknologi.com/assets/images/home_banner/2.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(3, 'banner 3', 'https://ijshop.ijteknologi.com/assets/images/home_banner/3.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(4, 'banner 4', 'https://ijshop.ijteknologi.com/assets/images/home_banner/4.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00'),
(5, 'banner 5', 'https://ijshop.ijteknologi.com/assets/images/home_banner/5.jpg', '2020-01-01 00:00:00', '2025-01-01 00:00:00', 1, '2020-09-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_trending`
--

CREATE TABLE `tbl_home_trending` (
  `home_trending_id` int(11) NOT NULL,
  `home_trending_name` varchar(100) NOT NULL,
  `home_trending_image` varchar(255) NOT NULL,
  `home_trending_sale` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_home_trending`
--

INSERT INTO `tbl_home_trending` (`home_trending_id`, `home_trending_name`, `home_trending_image`, `home_trending_sale`) VALUES
(1, 'Adidas Shirt', 'https://ijshop.ijteknologi.com/assets/images/home_trending/1.jpg', '12.7k'),
(2, 'iPhone SE 2020', 'https://ijshop.ijteknologi.com/assets/images/home_trending/2.jpg', '8k'),
(3, 'Macbook Air 2020', 'https://ijshop.ijteknologi.com/assets/images/home_trending/3.jpg', '31.4k'),
(4, 'Gaming Chair', 'https://ijshop.ijteknologi.com/assets/images/home_trending/4.jpg', '11.9k');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_search`
--

CREATE TABLE `tbl_last_search` (
  `last_search_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `last_search_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_last_search`
--

INSERT INTO `tbl_last_search` (`last_search_id`, `user_id`, `product_id`, `last_search_create_date`) VALUES
(1, 1, 45, '2020-10-27 10:26:18'),
(2, 1, 44, '2020-10-27 10:26:18'),
(3, 1, 43, '2020-10-27 10:26:18'),
(4, 1, 42, '2020-10-27 10:26:18'),
(5, 1, 41, '2020-10-27 10:26:18'),
(6, 1, 40, '2020-10-27 10:26:18'),
(7, 1, 39, '2020-10-27 10:26:18'),
(8, 1, 38, '2020-10-27 10:26:18'),
(9, 1, 37, '2020-10-27 10:26:18'),
(10, 1, 36, '2020-10-27 10:26:18'),
(11, 1, 35, '2020-10-27 10:26:18'),
(12, 1, 34, '2020-10-27 10:26:18'),
(13, 1, 33, '2020-10-27 10:26:18'),
(14, 1, 32, '2020-10-27 10:26:18'),
(15, 1, 31, '2020-10-27 10:26:18'),
(16, 1, 30, '2020-10-27 10:26:18'),
(17, 1, 29, '2020-10-27 10:26:18'),
(19, 1, 27, '2020-10-27 10:26:18'),
(20, 1, 26, '2020-10-27 10:26:18'),
(21, 1, 25, '2020-10-27 10:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_seen`
--

CREATE TABLE `tbl_last_seen` (
  `last_seen_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `last_seen_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_last_seen`
--

INSERT INTO `tbl_last_seen` (`last_seen_id`, `user_id`, `product_id`, `last_seen_create_date`) VALUES
(1, 1, 52, '2020-10-27 10:26:18'),
(2, 1, 48, '2020-10-27 10:26:18'),
(3, 1, 46, '2020-10-27 10:26:18'),
(4, 1, 68, '2020-10-27 10:26:18'),
(5, 1, 67, '2020-10-27 10:26:18'),
(6, 1, 66, '2020-10-27 10:26:18'),
(7, 1, 65, '2020-10-27 10:26:18'),
(8, 1, 64, '2020-10-27 10:26:18'),
(9, 1, 63, '2020-10-27 10:26:18'),
(10, 1, 62, '2020-10-27 10:26:18'),
(11, 1, 42, '2020-10-27 10:26:18'),
(12, 1, 35, '2020-10-27 10:26:18'),
(13, 1, 61, '2020-10-27 10:26:18'),
(14, 1, 60, '2020-10-27 10:26:18'),
(15, 1, 15, '2020-10-27 10:26:18'),
(16, 1, 14, '2020-10-27 10:26:18'),
(17, 1, 2, '2020-10-27 10:26:18'),
(18, 1, 12, '2020-10-27 10:26:18'),
(19, 1, 28, '2020-10-27 10:26:18'),
(20, 1, 1, '2020-10-27 10:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `invoice_number`, `order_status`, `total_price`, `order_date`) VALUES
(1, 1, 'INV385739475', 'on process', 80, '2020-08-12 09:00:00'),
(2, 1, 'INV385714262', 'completed', 36, '2020-09-03 09:00:00'),
(3, 1, 'INV385776588', 'on delivery', 10, '2020-09-09 09:00:00'),
(4, 1, 'INV385798021', 'waiting for payment', 38, '2020-09-13 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`order_detail_id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 4, 1),
(2, 2, 25, 1),
(3, 3, 34, 1),
(4, 4, 42, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `product_rating` int(11) NOT NULL,
  `product_review` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_sale` int(11) NOT NULL,
  `product_location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `product_image`, `product_price`, `product_rating`, `product_review`, `product_stock`, `product_sale`, `product_location`) VALUES
(1, 1, 'BARDI Smart IP Camera CCTV Wifi IoT HomeAutomation Support iOS Android', 'https://ijshop.ijteknologi.com/assets/images/product/1.jpg', 32.3, 2, 26, 100, 66, 'Brooklyn'),
(2, 1, 'TEROPONG MINI 30 X 60 BINOCULARS HD NIGHT VERSION 30 X 60', 'https://ijshop.ijteknologi.com/assets/images/product/2.jpg', 9, 2, 12, 100, 75, 'Brooklyn'),
(3, 1, 'CAFELE Premium Light Glass Case - iPhone 11 Pro iPhone 11 Pro Max - iP 11 Pro Max', 'https://ijshop.ijteknologi.com/assets/images/product/3.jpg', 12.85, 2, 91, 100, 57, 'Brooklyn'),
(4, 1, 'Logitech G502 Hero / Mouse Logitech G 502 Hero Original Garansi Resmi', 'https://ijshop.ijteknologi.com/assets/images/product/4.jpg', 68.25, 1, 95, 100, 57, 'Brooklyn'),
(5, 1, 'Pioneer SE-C5TW TWS Bluetooth Truly Wireless Earphones - Hitam', 'https://ijshop.ijteknologi.com/assets/images/product/5.jpg', 56.85, 2, 46, 100, 71, 'Brooklyn'),
(6, 1, 'Anker SoundCore Life Note Wireless Earbuds Bluetooth Earphones A3908 - Hitam', 'https://ijshop.ijteknologi.com/assets/images/product/6.jpg', 76.6, 2, 30, 100, 86, 'Brooklyn'),
(7, 1, 'Audio Technica AT-LP60X Fully Automatic Belt-Drive Stereo Turntable', 'https://ijshop.ijteknologi.com/assets/images/product/7.jpg', 215.58, 4, 56, 100, 98, 'Brooklyn'),
(8, 1, 'Xiaomi Deerma CM800 UV Anti Mite Vacuum Cleaner Dust Bed Sofa', 'https://ijshop.ijteknologi.com/assets/images/product/8.jpg', 44.28, 1, 85, 100, 33, 'Brooklyn'),
(9, 1, 'Sony SRS- XB12 / XB 12 Extra Bass Portable Bluetooth Speaker - Black', 'https://ijshop.ijteknologi.com/assets/images/product/9.jpg', 53.33, 2, 74, 100, 31, 'Brooklyn'),
(10, 1, 'Changhong Google certified Android Smart TV 32 inch 32H4 LED TV-L32H4', 'https://ijshop.ijteknologi.com/assets/images/product/10.jpg', 240.61, 2, 78, 100, 71, 'Brooklyn'),
(11, 1, 'READY DJI Mavic Air Fly More Combo', 'https://ijshop.ijteknologi.com/assets/images/product/11.jpg', 776.67, 4, 53, 100, 93, 'Brooklyn'),
(12, 1, 'gopro hero 8 black garansi resmi TAM / go pro hero8 black / 8black', 'https://ijshop.ijteknologi.com/assets/images/product/12.jpg', 391.76, 3, 24, 100, 11, 'Brooklyn'),
(13, 1, 'QZSD Q-202F - Flat Lay Tripod - Transverse Center Column FREE Holder U', 'https://ijshop.ijteknologi.com/assets/images/product/13.jpg', 40.74, 1, 75, 100, 60, 'Brooklyn'),
(14, 1, 'WD My Passport 2TB Hardisk Eksternal 2.5\" USB 3.0 HDD External Baru - 1TB, Merah', 'https://ijshop.ijteknologi.com/assets/images/product/14.jpg', 63.3, 4, 59, 100, 5, 'Brooklyn'),
(15, 1, 'SanDisk 128GB Kartu Memori 100MB/S Ultra Microsd SD With Adapter Card', 'https://ijshop.ijteknologi.com/assets/images/product/15.jpg', 12, 5, 71, 100, 86, 'Brooklyn'),
(16, 1, 'SanDisk Extreme Pro USB 3.1 Solid State Flash Drive 256GB', 'https://ijshop.ijteknologi.com/assets/images/product/16.png', 120, 3, 93, 100, 64, 'Brooklyn'),
(17, 1, 'Harley Davidson Skull & Flames Nylon Bomber Jacket', 'https://ijshop.ijteknologi.com/assets/images/product/17.jpg', 104.16, 2, 75, 100, 47, 'Brooklyn'),
(18, 1, 'video intercom doorbell Wireless wifi HD Res - Cloud Storage ESCAM V6', 'https://ijshop.ijteknologi.com/assets/images/product/18.jpg', 55.825, 3, 43, 100, 97, 'Brooklyn'),
(19, 1, 'DEADBOLT DOOR LOCK SMART DOOR LOCK / SMART LOCK DOOR MEREK SEYVEN - EZ-TTLOCK', 'https://ijshop.ijteknologi.com/assets/images/product/19.jpg', 150, 3, 18, 100, 23, 'Brooklyn'),
(20, 1, 'BT-RIDER GPS NAVIGATION ANDROID 6.0, 5 in WATERPROOF', 'https://ijshop.ijteknologi.com/assets/images/product/20.jpg', 191.66, 3, 16, 100, 77, 'Brooklyn'),
(21, 1, 'Adidas Shirt', 'https://ijshop.ijteknologi.com/assets/images/product/21.jpg', 22, 5, 156, 400, 388, 'Brooklyn'),
(22, 1, 'iPhone SE 2020 - White', 'https://ijshop.ijteknologi.com/assets/images/product/22.jpg', 399, 5, 598, 1000, 785, 'Brooklyn'),
(23, 1, 'MacBook Air 2020 New', 'https://ijshop.ijteknologi.com/assets/images/product/23.jpg', 1699, 5, 45, 100, 89, 'Brooklyn'),
(24, 1, 'Gaming Chair', 'https://ijshop.ijteknologi.com/assets/images/product/24.jpg', 23, 5, 84, 200, 132, 'Brooklyn'),
(25, 1, 'Delta Boots Import 8 Inch', 'https://ijshop.ijteknologi.com/assets/images/product/25.jpg', 18.3, 5, 212, 988, 735, 'Brooklyn'),
(26, 1, 'Fimi X8 SE Black', 'https://ijshop.ijteknologi.com/assets/images/product/26.jpg', 567, 5, 63, 0, 115, 'Brooklyn'),
(27, 1, 'Guess Collection Watch Ceramic Type GC 6004 ', 'https://ijshop.ijteknologi.com/assets/images/product/27.jpg', 52, 5, 7, 250, 7, 'Brooklyn'),
(28, 1, 'iphone 7 Plus / 7+ 128GB', 'https://ijshop.ijteknologi.com/assets/images/product/28.jpg', 433, 5, 129, 400, 310, 'Brooklyn'),
(29, 1, 'NEW Original Apple TV 4K 64GB 5th Generation', 'https://ijshop.ijteknologi.com/assets/images/product/29.jpg', 261, 5, 98, 250, 263, 'Brooklyn'),
(30, 1, 'SAMSUNG GALAXY S20 PLUS RAM 8/128GB', 'https://ijshop.ijteknologi.com/assets/images/product/30.jpg', 751, 5, 14, 250, 17, 'Brooklyn'),
(31, 1, 'Xiaomi Smart LED TV Mi 4', 'https://ijshop.ijteknologi.com/assets/images/product/31.jpg', 224.14, 5, 701, 2500, 1558, 'Brooklyn'),
(32, 1, 'Adidas EQT Adv Premium Original', 'https://ijshop.ijteknologi.com/assets/images/product/32.jpg', 28.67, 5, 146, 588, 398, 'Brooklyn'),
(33, 1, 'Xiaomi Air Purifier 3 Mijia OLED Touch Sterilization Air Ionizer - 3', 'https://ijshop.ijteknologi.com/assets/images/product/33.jpg', 139, 5, 275, 2000, 1055, 'Brooklyn'),
(34, 1, 'Spatula Set Stainless Kitchen Tools', 'https://ijshop.ijteknologi.com/assets/images/product/34.jpg', 2.5, 5, 302, 900, 752, 'Brooklyn'),
(35, 1, 'DATA CABLE TYPE-C TO TYPE-C BASEUS HALO DATA CABLE PD 2.0 60W - 0.5 M', 'https://ijshop.ijteknologi.com/assets/images/product/35.jpg', 3, 5, 636, 4000, 2087, 'Brooklyn'),
(36, 1, 'BASEUS QUICK CHARGER HEAD QC3.0/4.0 TYPE-C+USB 30W PD 5A - USB TC', 'https://ijshop.ijteknologi.com/assets/images/product/36.jpg', 10.6, 5, 2802, 15000, 7052, 'Brooklyn'),
(37, 1, 'Xiaomi Powerbank MI2C 20000mAh Mi Power Bank 20000 mAh PLM06ZM', 'https://ijshop.ijteknologi.com/assets/images/product/37.jpg', 19.9, 5, 105, 250, 227, 'Brooklyn'),
(38, 1, '3D FASHION MASK WITH BREATHING VALVE / MASKER PM 2.5 KARBON / WASHABLE - BLACK NEW MODEL', 'https://ijshop.ijteknologi.com/assets/images/product/38.jpg', 2.33, 5, 503, 4000, 3645, 'Brooklyn'),
(39, 1, 'Robot RT-US04 Table Phone Holder Stand Aluminium Alloy Universal - Pink', 'https://ijshop.ijteknologi.com/assets/images/product/39.jpg', 5.3, 5, 1095, 4000, 3400, 'Brooklyn'),
(40, 1, 'Tactical Pants Blackhawk Helikon ', 'https://ijshop.ijteknologi.com/assets/images/product/40.jpg', 10, 5, 63, 250, 131, 'Brooklyn'),
(41, 1, 'Sony SRS- XB12 / XB 12 Extra Bass Portable Bluetooth Speaker - Black', 'https://ijshop.ijteknologi.com/assets/images/product/41.jpg', 48, 5, 182, 500, 427, 'Brooklyn'),
(42, 1, 'Original 100% 60W Magsafe 1 Power Adapter Charger Macbook Pro - Air', 'https://ijshop.ijteknologi.com/assets/images/product/42.jpg', 22.66, 5, 131, 500, 466, 'Brooklyn'),
(43, 1, 'Macbook Pro 2019 TouchBar MV912 15\" 16GB 512GB 2.3GHz 8-core i9 Gray', 'https://ijshop.ijteknologi.com/assets/images/product/43.jpg', 2212, 5, 16, 250, 37, 'Brooklyn'),
(44, 1, 'New imac 2017 MNEA2 5K retina /3,5GHZ/i5/8GB/1TB/RP575', 'https://ijshop.ijteknologi.com/assets/images/product/44.jpg', 1643, 5, 2, 250, 3, 'Brooklyn'),
(45, 1, 'Adidas Football Predator 19.3 FG F35594 Original', 'https://ijshop.ijteknologi.com/assets/images/product/45.jpg', 9, 5, 30, 250, 70, 'Brooklyn'),
(46, 1, 'IWO 8 Smart Watch Apple iWatch Mirror For Android iPhone', 'https://ijshop.ijteknologi.com/assets/images/product/46.jpg', 62, 5, 42, 250, 69, 'Brooklyn'),
(47, 1, 'Garmin Instinct Tactical - Black', 'https://ijshop.ijteknologi.com/assets/images/product/47.jpg', 290, 5, 13, 250, 23, 'Brooklyn'),
(48, 1, 'Asus Rog Phone 3 Rogphone III Ram 12Gb 512Gb Snapdragon 865+ Plus', 'https://ijshop.ijteknologi.com/assets/images/product/48.jpg', 1152, 5, 1, 250, 2, 'Brooklyn'),
(49, 1, 'ipad Pro 2020 11-inch 128GB Wi-Fi Only - Silver', 'https://ijshop.ijteknologi.com/assets/images/product/49.jpg', 866, 5, 22, 500, 468, 'Brooklyn'),
(50, 1, 'Folding Bike 20 GENIO BY United Bike', 'https://ijshop.ijteknologi.com/assets/images/product/50.jpg', 173, 5, 9, 250, 23, 'Brooklyn'),
(51, 1, 'XBOX 360 SLIM 500 GB RGH FULL GAME & KINECT', 'https://ijshop.ijteknologi.com/assets/images/product/51.jpg', 183, 4, 3, 250, 9, 'Brooklyn'),
(52, 1, 'Nitendo Switch Console New HAC-001(-01) Neon Blue - Neon Red', 'https://ijshop.ijteknologi.com/assets/images/product/52.jpg', 349, 5, 30, 250, 86, 'Brooklyn'),
(53, 1, 'TP-Link TL-WR840N (V4.0) : 300Mbps TPLink WiFi Wireless N Router', 'https://ijshop.ijteknologi.com/assets/images/product/53.jpg', 11, 5, 1075, 4200, 3247, 'Brooklyn'),
(54, 1, 'Google Chromecast 3 Chrome Cast 3rd HDMI Streaming', 'https://ijshop.ijteknologi.com/assets/images/product/54.jpg', 38, 5, 160, 600, 574, 'Brooklyn'),
(55, 1, 'PRINTER CANON PIXMA MG2570S / PRINTER ALL IN ONE MG 2570 S', 'https://ijshop.ijteknologi.com/assets/images/product/55.jpg', 35, 5, 126, 290, 285, 'Brooklyn'),
(56, 1, 'Air Jordan 1 Mid Chicago Black Toe 554724-069 100% Authentic - 43', 'https://ijshop.ijteknologi.com/assets/images/product/56.jpg', 220, 5, 15, 250, 24, 'Brooklyn'),
(57, 1, 'ADIDAS ICE DIVE PARFUM ORIGINAL 100ML', 'https://ijshop.ijteknologi.com/assets/images/product/57.jpg', 4.9, 5, 251, 800, 751, 'Brooklyn'),
(58, 1, 'BARDI Smart Light Bulb Lamp Bohlam LED WIFI RGBWW 12W 12 watt Home IoT', 'https://ijshop.ijteknologi.com/assets/images/product/58.jpg', 8.6, 5, 354, 700, 540, 'Brooklyn'),
(59, 1, 'Xiaomi Yi Dash Camera Nightscape 1080P 60FPS ADAS Night Vision Dashcam', 'https://ijshop.ijteknologi.com/assets/images/product/59.jpg', 46.6, 5, 47, 250, 146, 'Brooklyn'),
(60, 1, 'BARDI Smart UNIVERSAL IR REMOTE Wifi Wireless IoT For Home Automation', 'https://ijshop.ijteknologi.com/assets/images/product/60.jpg', 11.5, 5, 1438, 5000, 4956, 'Brooklyn'),
(61, 1, 'APPLE AIRPODS PRO WITH WIRELESS CHARGING ORIGINAL - AIRPOD - Free Silicone', 'https://ijshop.ijteknologi.com/assets/images/product/61.jpg', 219, 5, 934, 2000, 1881, 'Brooklyn'),
(62, 1, 'iPhone XS Max / XS / X / XR Case Spigen Clear Anti Shock Ultra Hybrid - Matte Black, XS Max', 'https://ijshop.ijteknologi.com/assets/images/product/62.jpg', 16.6, 5, 2201, 5300, 5154, 'Brooklyn'),
(63, 1, 'TORCH WAIST BAG VALLEJO TOSCA', 'https://ijshop.ijteknologi.com/assets/images/product/63.jpg', 4.1, 5, 130, 400, 302, 'Brooklyn'),
(64, 1, 'Bushnell Speed Gun Velocity 101911', 'https://ijshop.ijteknologi.com/assets/images/product/64.jpg', 180, 5, 4, 250, 14, 'Brooklyn'),
(65, 1, 'Iphone XR - COPPER Tempered Glass Full Glue PREMIUM Glossy', 'https://ijshop.ijteknologi.com/assets/images/product/65.jpg', 3.1, 5, 130, 500, 460, 'Brooklyn'),
(66, 1, 'Digital Thermometer infrared Termometer Gun', 'https://ijshop.ijteknologi.com/assets/images/product/66.jpg', 9.9, 5, 270, 1300, 1287, 'Brooklyn'),
(67, 1, 'L\'Oreal Paris Fall Resist Hair Mask', 'https://ijshop.ijteknologi.com/assets/images/product/67.jpg', 9, 5, 947, 4000, 3750, 'Brooklyn'),
(68, 1, 'Samyang Noodle Wholesaler 1 Box (40 Pcs) Hot Spicy Chicken - Original Jan 21', 'https://ijshop.ijteknologi.com/assets/images/product/68.jpg', 26, 5, 4, 500, 22, 'Brooklyn'),
(69, 1, 'BARDI Smart PLUG WiFi Wireless Colokan - IoT Smart Home', 'https://ijshop.ijteknologi.com/assets/images/product/69.jpg', 11.46, 4, 1062, 0, 4797, 'Brooklyn'),
(70, 1, 'Apple Pencil 1 - Original Apple Garansi Resmi Inter', 'https://ijshop.ijteknologi.com/assets/images/product/70.jpg', 99, 5, 8, 500, 13, 'Brooklyn'),
(71, 1, 'Converter APPLE USB-C To 3.5 mm Headphone Jack Adapter New Ipad Pro', 'https://ijshop.ijteknologi.com/assets/images/product/71.jpg', 10, 5, 54, 500, 157, 'Brooklyn'),
(72, 1, 'Charger adapter New Macbook Pro Retina 13 inch Apple 2017 2018 61w ori', 'https://ijshop.ijteknologi.com/assets/images/product/72.jpg', 46, 5, 4, 200, 86, 'Brooklyn'),
(73, 1, 'NEW Apple Magic Trackpad 2 Space Grey MRMF2 Gray', 'https://ijshop.ijteknologi.com/assets/images/product/73.jpg', 189, 5, 24, 300, 64, 'Brooklyn'),
(74, 1, 'Apple iMac 2020 4K 21.5\" inch i3 3.6GHz /8GB/256GB MHK23', 'https://ijshop.ijteknologi.com/assets/images/product/74.jpg', 1369, 0, 0, 200, 194, 'Brooklyn'),
(75, 1, 'Leather Sleeve for 13-inch MacBook Air and MacBook Pro - Black', 'https://ijshop.ijteknologi.com/assets/images/product/75.jpg', 179, 5, 120, 60, 13, 'Brooklyn'),
(76, 1, 'Magic Mouse 2 - Space Gray', 'https://ijshop.ijteknologi.com/assets/images/product/76.jpg', 99, 5, 174, 500, 141, 'Brooklyn'),
(77, 1, 'Mac Mini 3.0GHz 6-Core Processor with Turbo Boost up to 4.1GHz 512GB Storage', 'https://ijshop.ijteknologi.com/assets/images/product/77.jpg', 1099, 5, 78, 500, 146, 'Brooklyn'),
(78, 1, 'iPhone SE 2020 - Black', 'https://ijshop.ijteknologi.com/assets/images/product/78.png', 399, 5, 219, 500, 135, 'Brooklyn'),
(79, 1, 'iPod Touch 2019 7th Generation - 32GB SpaceGrey MVHW2', 'https://ijshop.ijteknologi.com/assets/images/product/79.jpg', 242, 5, 11, 60, 17, 'Brooklyn'),
(80, 1, 'SAMSUNG LED TV 32 Inch HD Digital - 32N4003', 'https://ijshop.ijteknologi.com/assets/images/product/80.jpg', 116, 5, 380, 1000, 866, 'Brooklyn');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_name` varchar(50) NOT NULL,
  `review_rating` int(1) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_name`, `review_rating`, `review`, `review_date`) VALUES
(1, 'A*******i', 5, 'Everything came in time. Very well packed. Quality is excellent. Thank you!', '2020-09-11'),
(2, 'L***a', 5, 'The goods came very quickly, in perfect condition, everything is packed, nothing is damaged! Excellent, visibility super, I recommend the seller, the store, the goods!!!', '2020-09-10'),
(3, 'R******i', 5, 'Before Moscow 3 weeks, asked the seller that there would be no pictogram, made without them. The packaging is definitely good', '2020-09-08'),
(4, 'D***s', 4, 'The goods arrived 21 days before perm. Packing on the photo. the box inside is crumpled. Thank you seller', '2020-09-07'),
(5, 'S*******a', 5, 'An excellent device, its money costs. Packed perfectly, no damage. To the seller 5 +++.', '2020-09-07'),
(6, 'B*******g', 5, 'The goods are satisfied', '2020-09-06'),
(7, 'H*********a', 3, 'Good product, seller recommend', '2020-09-04'),
(8, 'P***u', 3, 'Not as good as they write but still worth', '2020-09-04'),
(9, 'O**********a', 4, 'Perfect. Immediately turned up in flight. I can\'t give you 5 stars for the parcel. And arrived very deteriorated, but fortunately the drone works', '2020-09-03'),
(10, 'D********l', 5, 'All OK. Although well packed, the box crushed', '2020-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_search`
--

CREATE TABLE `tbl_search` (
  `search_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `search_word` varchar(100) NOT NULL,
  `search_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_search`
--

INSERT INTO `tbl_search` (`search_id`, `user_id`, `search_word`, `search_date`) VALUES
(1, 1, 'asus', '2020-09-01 10:00:00'),
(2, 1, 'apple', '2020-09-01 10:10:00'),
(3, 1, 'ar', '2020-09-01 10:30:00'),
(4, 1, 'led tv', '2020-09-01 11:00:00'),
(5, 1, 'adidas', '2020-09-01 11:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE `tbl_session` (
  `session_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`session_id`, `user_id`, `login_date`) VALUES
('5f0e6bfbafe255.00218389', 1, '2020-08-31 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shopping_cart`
--

CREATE TABLE `tbl_shopping_cart` (
  `shopping_cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shopping_cart`
--

INSERT INTO `tbl_shopping_cart` (`shopping_cart_id`, `user_id`, `product_id`, `qty`) VALUES
(1, 1, 58, 2),
(2, 1, 60, 1),
(3, 1, 69, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `email`, `name`, `phone_number`) VALUES
(1, 'robert.steven@ijteknologi.com', 'Robert Steven', '0811888999');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `wishlist_create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlist_id`, `user_id`, `product_id`, `wishlist_create_date`) VALUES
(1, 1, 25, '2020-10-27 10:26:18'),
(2, 1, 33, '2020-10-27 10:26:18'),
(3, 1, 26, '2020-10-27 10:26:18'),
(4, 1, 49, '2020-10-27 10:26:18'),
(5, 1, 69, '2020-10-27 10:26:18'),
(6, 1, 48, '2020-10-27 10:26:18'),
(7, 1, 46, '2020-10-27 10:26:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_category_banner`
--
ALTER TABLE `tbl_category_banner`
  ADD PRIMARY KEY (`category_banner_id`);

--
-- Indexes for table `tbl_category_for_you`
--
ALTER TABLE `tbl_category_for_you`
  ADD PRIMARY KEY (`category_for_you_id`);

--
-- Indexes for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_flashsale`
--
ALTER TABLE `tbl_flashsale`
  ADD PRIMARY KEY (`flashsale_id`);

--
-- Indexes for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  ADD PRIMARY KEY (`home_banner_id`);

--
-- Indexes for table `tbl_home_trending`
--
ALTER TABLE `tbl_home_trending`
  ADD PRIMARY KEY (`home_trending_id`);

--
-- Indexes for table `tbl_last_search`
--
ALTER TABLE `tbl_last_search`
  ADD PRIMARY KEY (`last_search_id`);

--
-- Indexes for table `tbl_last_seen`
--
ALTER TABLE `tbl_last_seen`
  ADD PRIMARY KEY (`last_seen_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_search`
--
ALTER TABLE `tbl_search`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `tbl_session`
--
ALTER TABLE `tbl_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `tbl_shopping_cart`
--
ALTER TABLE `tbl_shopping_cart`
  ADD PRIMARY KEY (`shopping_cart_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_category_banner`
--
ALTER TABLE `tbl_category_banner`
  MODIFY `category_banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_category_for_you`
--
ALTER TABLE `tbl_category_for_you`
  MODIFY `category_for_you_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_flashsale`
--
ALTER TABLE `tbl_flashsale`
  MODIFY `flashsale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  MODIFY `home_banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_home_trending`
--
ALTER TABLE `tbl_home_trending`
  MODIFY `home_trending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_last_search`
--
ALTER TABLE `tbl_last_search`
  MODIFY `last_search_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_last_seen`
--
ALTER TABLE `tbl_last_seen`
  MODIFY `last_seen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_search`
--
ALTER TABLE `tbl_search`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shopping_cart`
--
ALTER TABLE `tbl_shopping_cart`
  MODIFY `shopping_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
