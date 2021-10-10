-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2021 at 01:45 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nayanika`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Riyan Satria', 'riyan@gmail.com', '$2y$10$1m9ooN1snV0trTJxQm6XyO/FqBhLvXoiv.IxidMXholkzg5NPZMpG', NULL, '2021-10-10 15:57:33'),
(3, 'Naya Nika', 'nayanika@gmail.com', '$2y$10$E9YxeOLagkQ8OKKQTKAa9.pYs84hwNX/cytHXFgkzbYANN/ry51eK', '2021-10-09 15:04:56', '2021-10-09 15:04:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `count`, `created_at`, `updated_at`) VALUES
(2, 'Branding', 14, '2021-10-09 05:39:32', '2021-10-10 03:55:10'),
(3, 'Social Media', 14, '2021-10-09 05:39:36', '2021-10-10 03:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `copywritings`
--

CREATE TABLE `copywritings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copywritings`
--

INSERT INTO `copywritings` (`id`, `item_code`, `body`, `created_at`, `updated_at`) VALUES
(1, 'tagline', 'TURNING YOUR IDEAS INTO MAGNIFICENT VISUALS', NULL, NULL),
(2, 'value', 'We do our best to create mutual trust with our clients through our accountability. Reaching the goal through collaboration that benefits both sides. We also believe that with determination, effectiveness and transparency, we could reach a healthy long-term relationship with our trusted partners. Those are the main points that we hold to make magnificent creations', NULL, '2021-10-09 14:03:49'),
(3, 'service', 'Our focus is mainly on the branding and content side. Whether you are running an existing business or starting from scratch, we can work together and turn your ideas into magnificent visuals', NULL, '2021-10-09 14:05:29'),
(4, 'about', 'Our focus mainly on the branding and content side. Whether you are running an existing business or starting from scratch, we can work together and turn your ideas into magnificent visuals', NULL, NULL),
(5, 'footer 1', 'A FULL SERVICE\r\nDIGITAL AGENCY\r\n\r\nJl. Bunga Raflesia, Lowokwaru\r\nKota Malang, Indonesia 65141', NULL, NULL),
(6, 'footer 2', '<a href=\"tel:6285156304105\">+62 851 5630 4105</a>\r\n<a href=\"https://fb.me/zuck\">Facebook</a>\r\n<a href=\"mailto:connectnayanika@gmail.com\">connectnayanika@gmail.com</a>\r\n\r\n<a href=\"#\">Instagram</a>\r\n<a href=\"#\">Twitter</a>', NULL, '2021-10-09 22:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_10_09_063620_create_admins_table', 2),
(4, '2021_10_09_120208_create_categories_table', 3),
(5, '2021_10_09_120217_create_services_table', 3),
(6, '2021_10_09_120232_create_portfolios_table', 3),
(7, '2021_10_09_194423_create_portfolio_images_table', 4),
(9, '2021_10_09_204014_create_copywritings_table', 8),
(10, '2021_10_10_060425_update_services_table', 9),
(11, '2021_10_10_150927_update_portfolios_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `categories`, `title`, `description`, `task`, `featured_image`, `created_at`, `updated_at`) VALUES
(2, 'Social Media', 'Warung Cerdas', 'Mendukung penuh gerakan UMKM Go Digital, Warung Cerdas memfasilitasi toko kelontong dan warung kecil agar dapat bersaing dengan indomaret sama alfamart dari sisi kesiapan teknologi dan infrastruktur', 'Membuat sebuah rancangan design website mulai dari pemilihan warna, ukuran, tata letak, hingga ke sistem yang mampu memproses ribuan akses dalam satu detik', 'evergreen-2025158.png', '2021-10-09 12:42:10', '2021-10-10 08:12:47'),
(3, 'Branding,Social Media', 'Belajar Ngeweb ID', 'Tempat belajar membuat website keren', '', 'hospital-2817071_1920.jpg', '2021-10-09 13:30:50', '2021-10-09 22:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `portfolio_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `filename`, `created_at`, `updated_at`) VALUES
(13, 3, 'aeroplane-air-travel-aircraft-33281.jpg', '2021-10-09 21:10:38', '2021-10-09 21:10:38'),
(14, 3, 'chernobyl-3510114_1920.jpg', '2021-10-09 21:10:46', '2021-10-09 21:10:46'),
(15, 2, 'chernobyl-3510114_1920.jpg', '2021-10-10 04:34:12', '2021-10-10 04:34:12'),
(16, 2, 'forest-438432_1920.jpg', '2021-10-10 04:34:17', '2021-10-10 04:34:17'),
(17, 2, 'natural_posers_by_mjbeng.jpg', '2021-10-10 04:34:25', '2021-10-10 04:34:25'),
(18, 2, 'chernobyl-3501732_1920.jpg', '2021-10-10 04:34:30', '2021-10-10 04:34:30'),
(19, 2, 'beautiful-beautiful-girl-beauty-1084546.jpg', '2021-10-10 04:37:51', '2021-10-10 04:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(3, 3, 'Instagram Strategy', '2021-10-10 03:32:11', '2021-10-10 03:35:05'),
(4, 3, 'Copywriting', '2021-10-10 03:32:27', '2021-10-10 03:32:27'),
(5, 3, 'KOL Management', '2021-10-10 03:32:37', '2021-10-10 03:32:37'),
(6, 2, 'Photography', '2021-10-10 03:32:45', '2021-10-10 03:32:45'),
(7, 2, 'Videography', '2021-10-10 03:32:53', '2021-10-10 03:32:53'),
(8, 2, 'Corporate Identity', '2021-10-10 03:32:59', '2021-10-10 03:32:59'),
(9, 2, 'Logo & Design', '2021-10-10 03:54:11', '2021-10-10 03:54:11'),
(10, 2, 'Color Scheme', '2021-10-10 03:54:21', '2021-10-10 03:54:21'),
(11, 2, 'Typography', '2021-10-10 03:54:30', '2021-10-10 03:54:30'),
(12, 2, 'Branding Guidelines', '2021-10-10 03:54:43', '2021-10-10 03:54:43'),
(13, 2, 'Promotional Design', '2021-10-10 03:54:50', '2021-10-10 03:54:50'),
(14, 2, 'Packaging', '2021-10-10 03:54:57', '2021-10-10 03:54:57'),
(15, 2, 'Marketing Material Design', '2021-10-10 03:55:04', '2021-10-10 03:55:04'),
(16, 2, 'Motion Graphic', '2021-10-10 03:55:10', '2021-10-10 03:55:10'),
(17, 3, 'Creating, Posting & Scheduling Content', '2021-10-10 03:55:36', '2021-10-10 03:55:36'),
(18, 3, 'Instagram Profile Management', '2021-10-10 03:55:47', '2021-10-10 03:55:47'),
(19, 3, 'Content Design (Feed & Story)', '2021-10-10 03:55:59', '2021-10-10 03:55:59'),
(20, 3, 'Social Media Personal Branding', '2021-10-10 03:56:09', '2021-10-10 03:56:09'),
(21, 3, 'Instagram & Facebook Ads', '2021-10-10 03:56:18', '2021-10-10 03:56:18'),
(22, 3, 'Content Writer', '2021-10-10 03:56:22', '2021-10-10 03:56:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copywritings`
--
ALTER TABLE `copywritings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_images_portfolio_id_index` (`portfolio_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_category_id_index` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `copywritings`
--
ALTER TABLE `copywritings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
