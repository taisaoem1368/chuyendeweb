-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 06:59 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facefly`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `airline_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airlines_country_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `airline_name`, `airline_code`, `airlines_country_id`) VALUES
(1, 'Vietnam Airlines', 'VN', 1),
(2, 'VietJet Air', 'VJ', 1),
(3, 'Jetstar', 'BL', 1),
(4, 'Japan Airline', 'JAL', 2),
(5, 'Alaska Airlines', 'ASA', 6);

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_id` int(11) NOT NULL,
  `airport_city_id` int(11) NOT NULL,
  `airport_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_id`, `airport_city_id`, `airport_name`) VALUES
(1, 1, 'Sân bay quốc tế Nội Bài'),
(2, 4, 'Sân bay Cà Mau'),
(3, 3, '	\nSân bay Ban Mê Thuộc'),
(4, 2, 'Sân bay quốc tế Hồ Chí Minh'),
(8, 6, 'Kagoshima Airport'),
(9, 5, 'Tokyo Narita International Airport\nNarita'),
(10, 1, 'Hà Đông'),
(11, 1, 'Hà Tây');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cities_country_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_code`, `cities_country_id`) VALUES
(1, 'Hà Nội', 'HAN', 1),
(2, 'Hồ Chí Minh', 'SGN', 1),
(3, 'Ban Mê Thuộc', 'BMV', 1),
(4, 'Cà Mau', 'CAH', 1),
(5, 'Tokyo(Narita)', 'TYO', 2),
(6, 'Kagoshima', 'KOJ', 2),
(7, 'Anchorage, AK, US', 'ANC', 6),
(8, 'Athens, GR', 'ATH', 6);

-- --------------------------------------------------------

--
-- Table structure for table `connect_flight`
--

CREATE TABLE `connect_flight` (
  `cf_id` int(11) NOT NULL,
  `cf_country_id1` int(11) NOT NULL COMMENT 'quốc gia 1',
  `cf_country_id2` int(11) NOT NULL COMMENT 'quốc gia 2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connect_flight`
--

INSERT INTO `connect_flight` (`cf_id`, `cf_country_id1`, `cf_country_id2`) VALUES
(1, 6, 2),
(2, 1, 2),
(6, 3, 1),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Vietnam'),
(2, 'Japans'),
(3, 'Thailand'),
(4, 'China'),
(5, 'South Korea'),
(6, 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `fb_fl_exchange`
--

CREATE TABLE `fb_fl_exchange` (
  `id` int(11) NOT NULL,
  `ffe_bk_id` int(11) NOT NULL,
  `ffe_fl_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fb_fl_exchange`
--

INSERT INTO `fb_fl_exchange` (`id`, `ffe_bk_id`, `ffe_fl_id`) VALUES
(124, 78, 3),
(123, 78, 2),
(122, 77, 3),
(121, 77, 2),
(120, 76, 8),
(119, 76, 7),
(118, 76, 6),
(117, 75, 8),
(116, 75, 7),
(115, 75, 6),
(114, 74, 3),
(113, 74, 2);

-- --------------------------------------------------------

--
-- Table structure for table `flight_booking`
--

CREATE TABLE `flight_booking` (
  `fb_id` int(11) NOT NULL,
  `fb_city_id_from` int(11) NOT NULL,
  `fb_city_id_to` int(11) NOT NULL,
  `fb_departure_date` int(11) NOT NULL,
  `fb_type` tinyint(4) NOT NULL,
  `fb_return_date` int(11) DEFAULT NULL,
  `fb_users_id` int(11) NOT NULL,
  `fb_bfe_fl_id` int(11) DEFAULT NULL,
  `fb_transfer` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_paypal` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_credit_card` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_credit_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_ccv_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_action` int(11) DEFAULT NULL COMMENT '0: chưa bay 1: đã bay 2: đã hủy'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_booking`
--

INSERT INTO `flight_booking` (`fb_id`, `fb_city_id_from`, `fb_city_id_to`, `fb_departure_date`, `fb_type`, `fb_return_date`, `fb_users_id`, `fb_bfe_fl_id`, `fb_transfer`, `fb_paypal`, `fb_credit_card`, `fb_credit_name`, `fb_ccv_code`, `fb_action`) VALUES
(75, 2, 1, 1551769200, 1, NULL, 22, NULL, 'YES', NULL, NULL, NULL, NULL, 1),
(74, 1, 2, 1551762000, 1, NULL, 22, NULL, 'YES', NULL, NULL, NULL, NULL, 1),
(76, 2, 1, 1551769200, 1, NULL, 22, NULL, 'YES', NULL, NULL, NULL, NULL, 0),
(77, 1, 2, 1551762000, 1, NULL, 22, NULL, NULL, 'YES', NULL, NULL, NULL, 1),
(78, 1, 2, 1551762000, 1, NULL, 22, NULL, 'YES', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `flight_class`
--

CREATE TABLE `flight_class` (
  `fc_id` int(11) NOT NULL,
  `fc_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_class`
--

INSERT INTO `flight_class` (`fc_id`, `fc_name`) VALUES
(1, 'Economy Standard'),
(2, 'Economy Flex'),
(3, 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `flight_list`
--

CREATE TABLE `flight_list` (
  `fl_id` int(11) NOT NULL,
  `fl_airline_id` int(11) NOT NULL,
  `fl_departure_date` int(11) NOT NULL,
  `fl_landing_date` int(11) NOT NULL,
  `fl_city_id_from` int(11) NOT NULL,
  `fl_city_id_to` int(11) NOT NULL,
  `fl_id_parent` int(11) DEFAULT NULL,
  `fl_cost` float NOT NULL,
  `fl_fc_id` int(11) DEFAULT NULL,
  `fl_seat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flight_list`
--

INSERT INTO `flight_list` (`fl_id`, `fl_airline_id`, `fl_departure_date`, `fl_landing_date`, `fl_city_id_from`, `fl_city_id_to`, `fl_id_parent`, `fl_cost`, `fl_fc_id`, `fl_seat`) VALUES
(1, 1, 1551762000, 1551765600, 1, 2, 0, 500000, 1, 100),
(2, 1, 1551762000, 1551763500, 1, 3, 1, 500000, 1, 100),
(3, 1, 1551767400, 1551769200, 3, 2, 1, 200000, 1, 11),
(4, 1, 1551767400, 1551769200, 4, 2, 0, 300000, 1, 11),
(5, 1, 1551769200, 1551769200, 2, 1, 0, 600000, 1, 100),
(6, 2, 1551769200, 1551769200, 2, 3, 5, 600000, 1, 100),
(7, 1, 1551769200, 1551769200, 3, 4, 5, 600000, 1, 100),
(8, 3, 1551769200, 1551769200, 4, 1, 5, 600000, 1, 100),
(9, 2, 1551769200, 1551769200, 2, 1, 0, 600000, 1, 100),
(10, 3, 1554183000, 1554189600, 1, 4, NULL, 600000, NULL, 100),
(11, 1, 1554189600, 1554191400, 2, 3, NULL, 250000, NULL, 50),
(12, 2, 1554191400, 1554195000, 4, 3, NULL, 200000, NULL, 80),
(13, 4, 1554195000, 1554223800, 5, 1, NULL, 2000000, NULL, 300);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `passenger_id` int(11) NOT NULL,
  `passenger_title` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_first_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_last_name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passenger_user_id` int(11) NOT NULL,
  `passenger_bk_id` int(11) NOT NULL,
  `passenger_action` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `passenger_title`, `passenger_first_name`, `passenger_last_name`, `passenger_user_id`, `passenger_bk_id`, `passenger_action`) VALUES
(72, 'mr', 'QUYEN', 'QUYEN5', 22, 77, 0),
(71, 'mr', 'QUYEN', 'QUYEN4', 22, 77, 0),
(66, 'mr', 'QUYEN4', 'QUYEN4', 22, 76, 0),
(70, 'mr', 'QUYEN', 'QUYEN3', 22, 77, 0),
(69, 'mr', 'QUYEN', 'QUYEN2', 22, 77, 1),
(68, 'mr', 'QUYEN', 'QUYEN1', 22, 77, 1),
(62, 'mr', 'BBB Editaab', 'BBB Edit', 22, 74, 0),
(61, 'mr', 'BBB', 'BBB', 22, 75, 0),
(59, 'mr', 'AAA', 'AAA', 22, 75, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fail_login` int(11) NOT NULL,
  `last_access` timestamp(6) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `remember_token`, `fail_login`, `last_access`, `created_at`, `updated_at`) VALUES
(13, 'Củ chuối', 'hhh@gmail.com', '123123', '$2y$10$nSpPNqxpnKAOquSYnD0ShOxeV8SMbZkYfzSptMj5r.e1D2wDp7Ba6', 'o3m0DS74ZaQ4OrBWnilM226WQtGOsSsvFCyYui743ruv2G8RN8PbeW84vjxW', 1, '2019-03-06 01:54:33.000000', '2019-02-26 06:10:57', '2019-03-05 18:24:33'),
(21, 'Tran Thi Hoa', 'tranthihoa111@gmail.com', '123123123123', '$2y$10$JFvrZJRAyJXG9oKO3PtuT.5tHR.5brSVupbXMah8VytPSpfaQaO9C', 'OHsjubm8fc3YQ6OyeDEiBYELCsxKS8RHShzHdQfRYuCmadUlDOAxlann5EbN', 0, '2019-03-05 16:26:30.000000', '2019-03-05 08:51:56', '2019-03-05 09:13:24'),
(22, 'HO VAN QUYEN', 'quyenho1368@gmail.com', '0962953150', '$2y$10$vUClvWFO.c4ltCBUMeRpV.2Lggi.mTuJ76pDBN.szIReYsvsncpxy', 'KBkdUt093Q0szKSDilqclXch2eO0rMMKGc05lKpuektk4cgRAQjOBjsZfvek', 0, '2019-03-25 18:35:12.000000', '2019-03-06 08:46:28', '2019-04-01 23:03:26'),
(23, 'quyenho13681@gmail.com', 'quyenho13681@gmail.com', '0338869536', '$2y$10$FuPEX.uhbGvbgkKZgksEI.yxd88sg4ldp0K8/c8ujzZBAkvVmEDmC', NULL, 0, NULL, '2019-03-13 05:43:11', '2019-03-13 05:43:11'),
(24, 'Khoi Hoi DS', 'khoihoids1368@gmail.com', '0962953155', '$2y$10$RRRLhkG2q9wtW8xsyv2DouUt/FxOEkv8joxsqLnqxsz/r6hC5WSta', 'tT4bbIpW67gcJukeJnr1nmTekYbGRDOic55zqPI6KHmLCHcE5OjnqXFXLHZQ', 0, '2019-03-16 13:47:59.000000', '2019-03-16 04:53:36', '2019-03-16 06:18:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `connect_flight`
--
ALTER TABLE `connect_flight`
  ADD PRIMARY KEY (`cf_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `fb_fl_exchange`
--
ALTER TABLE `fb_fl_exchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flight_booking`
--
ALTER TABLE `flight_booking`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `flight_class`
--
ALTER TABLE `flight_class`
  ADD PRIMARY KEY (`fc_id`);

--
-- Indexes for table `flight_list`
--
ALTER TABLE `flight_list`
  ADD PRIMARY KEY (`fl_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `airport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `connect_flight`
--
ALTER TABLE `connect_flight`
  MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fb_fl_exchange`
--
ALTER TABLE `fb_fl_exchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `flight_booking`
--
ALTER TABLE `flight_booking`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `flight_class`
--
ALTER TABLE `flight_class`
  MODIFY `fc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `flight_list`
--
ALTER TABLE `flight_list`
  MODIFY `fl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
