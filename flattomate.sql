-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2016 at 04:14 PM
-- Server version: 5.7.15
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flattomate`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` int(10) UNSIGNED NOT NULL,
  `n_people` int(11) NOT NULL,
  `n_beds` int(11) NOT NULL,
  `n_bathrooms` int(11) NOT NULL,
  `n_rooms` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `id_announcement` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `n_people`, `n_beds`, `n_bathrooms`, `n_rooms`, `location`, `id_announcement`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 2, 3, 'calle salamanca 42, sevilla', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accommodations_services`
--

CREATE TABLE `accommodations_services` (
  `id_accommodation` int(10) UNSIGNED NOT NULL,
  `id_service` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accommodations_services`
--

INSERT INTO `accommodations_services` (`id_accommodation`, `id_service`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `availability` date NOT NULL,
  `min_stay` int(11) NOT NULL,
  `max_stay` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  `is_shared_room` tinyint(1) NOT NULL,
  `id_accommodation` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `availability`, `min_stay`, `max_stay`, `price`, `is_visible`, `is_shared_room`, `id_accommodation`, `id_user`, `created_at`, `updated_at`) VALUES
(3, 'Apartamento en el centro', 'Apartamento bien situado, al lado de las paradas de metro uno y dos y pegado a las tiendas y el centro. La habitación tiene un escritorio y cuenta con Wifi incluido. Agua y luz se abonará la parte correspondiente', '2016-11-01', 7, 365, 500.00, 1, 0, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `id_announcement` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `is_main`, `id_announcement`, `created_at`, `updated_at`) VALUES
(1, 'image1', 1, 3, NULL, NULL),
(2, 'image2', 0, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Español', NULL, NULL),
(2, 'Inglés', NULL, NULL),
(3, 'Alemán', NULL, NULL),
(4, 'Italiano', NULL, NULL),
(5, 'Francés', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_05_01_185015_user_migration', 1),
('2016_05_02_184933_language_migration', 1),
('2016_05_03_190053_announcement_migration', 1),
('2016_05_04_184839_accommodation_migration', 1),
('2016_05_10_184918_image_migration', 1),
('2016_05_10_184944_review_migration', 1),
('2016_05_10_184955_service_migration', 1),
('2016_05_13_171129_users_languages_migration', 1),
('2016_05_13_172108_users_answer_users_migration', 1),
('2016_05_13_172601_accommodations_services_migration', 1),
('2016_05_13_174522_users_accommodations_migration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_user_wrote` int(10) UNSIGNED NOT NULL,
  `id_announcement` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `description`, `id_user_wrote`, `id_announcement`, `created_at`, `updated_at`) VALUES
(1, 'el usuario es muy limpio y ordenado', 24, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TV', NULL, NULL),
(2, 'WiFi', NULL, NULL),
(3, 'Aire acondicionado', NULL, NULL),
(4, 'Calefacción', NULL, NULL),
(5, 'Horno', NULL, NULL),
(6, 'Microondas', NULL, NULL),
(7, 'Cocina', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `smoke` tinyint(4) DEFAULT '0',
  `sociable` int(11) DEFAULT '0',
  `tidy` int(11) DEFAULT '0',
  `bio` longtext,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `birthdate`, `city`, `country`, `activity`, `sex`, `smoke`, `sociable`, `tidy`, `bio`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kike', 'kigm89@gmail.com', 'kike', '1980-07-04', 'sevilla', 'España', 'work', 'man', 1, 4, 6, 'Lorem ipsum dolor sit amet, consecteturį adipisicing elit, sed do eiusmod tempormml incididunt.d jdndk', NULL, '2016-08-04 09:15:00', '2016-10-20 17:29:55'),
(24, 'jane', 'joe@doe.com', '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-27 09:13:45', '2016-08-27 09:29:37'),
(25, 'Juan', 'juan@juan.com', 'juan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-15 16:22:25', '2016-10-15 16:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `users_answer_users`
--

CREATE TABLE `users_answer_users` (
  `id_user_sender` int(10) NOT NULL,
  `id_user_receiver` int(10) NOT NULL,
  `id_announcement` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_answer_users`
--

INSERT INTO `users_answer_users` (`id_user_sender`, `id_user_receiver`, `id_announcement`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_languages`
--

CREATE TABLE `users_languages` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_language` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accommodations_services`
--
ALTER TABLE `accommodations_services`
  ADD PRIMARY KEY (`id_accommodation`,`id_service`),
  ADD KEY `accommodations_services_id_accommodation_index` (`id_accommodation`),
  ADD KEY `accommodations_services_id_service_index` (`id_service`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_id_user_foreign` (`id_user`),
  ADD KEY `announcements_id_accommodation_foreign` (`id_accommodation`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_id_announcement_index` (`id_announcement`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_id_user_wrote_index` (`id_user_wrote`),
  ADD KEY `reviews_id_user_received_index` (`id_announcement`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_answer_users`
--
ALTER TABLE `users_answer_users`
  ADD PRIMARY KEY (`id_user_sender`,`id_user_receiver`,`id_announcement`),
  ADD KEY `users_answer_users_id_announcement_foreign` (`id_announcement`),
  ADD KEY `users_answer_users_id_user_sender_index` (`id_user_sender`),
  ADD KEY `users_answer_users_id_user_receiver_index` (`id_user_receiver`);

--
-- Indexes for table `users_languages`
--
ALTER TABLE `users_languages`
  ADD PRIMARY KEY (`id_user`,`id_language`),
  ADD KEY `users_languages_id_user_index` (`id_user`),
  ADD KEY `users_languages_id_language_index` (`id_language`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accommodations_services`
--
ALTER TABLE `accommodations_services`
  ADD CONSTRAINT `accommodations_services_id_accommodation_foreign` FOREIGN KEY (`id_accommodation`) REFERENCES `accommodations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accommodations_services_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_id_accommodation_foreign` FOREIGN KEY (`id_accommodation`) REFERENCES `accommodations` (`id`),
  ADD CONSTRAINT `announcements_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_id_announcement_foreign` FOREIGN KEY (`id_announcement`) REFERENCES `announcements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_id_user_received_foreign` FOREIGN KEY (`id_announcement`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_user_wrote_foreign` FOREIGN KEY (`id_user_wrote`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_languages`
--
ALTER TABLE `users_languages`
  ADD CONSTRAINT `users_languages_id_language_foreign` FOREIGN KEY (`id_language`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_languages_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
