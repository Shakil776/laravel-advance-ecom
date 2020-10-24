-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 09:24 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_advance_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shakil', 'admin', '01738620240', 'sakilahmad776@yahoo.com', NULL, '$2y$10$kA.N19kifvprSOJJe2ZH6OsPgqTIGqDQawk9lyiUAXWgcGepvsSFO', '436301601753258.jpg', 1, NULL, NULL, '2020-10-03 13:27:38'),
(2, 'Shakil Hossain', 'sub admin', '01815752377', 'admin@gmail.com', NULL, '$2y$10$Mx2xhltx8pm1wKvS64vQcuGeAbBvQS9esHKcCeZI4Gp2LogEGwdGi', '', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Daraz', 1, NULL, '2020-10-14 09:14:05'),
(2, 'Priyo Shop', 1, NULL, '2020-10-14 09:14:07'),
(3, 'Zara Fashion', 1, NULL, '2020-10-14 05:47:01'),
(4, 'Ajker Deal', 1, NULL, '2020-10-14 05:47:25'),
(5, 'E-valy', 1, NULL, '2020-10-14 05:47:04'),
(6, 'Polo', 1, '2020-10-13 10:16:33', '2020-10-14 05:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_discount` double(8,2) DEFAULT NULL,
  `category_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `category_description`, `category_url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T-Shirts', '', 10.00, 'Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - that is why our goods are so popular and we have a great number of faithful customers all over the country.', 't-shirts', 'Meta Title', 'Meta Description', 'Meta Keywords', 1, '2020-10-07 11:23:34', '2020-10-16 11:44:21'),
(2, 1, 1, 'Casual T-Shirts', '', 0.00, '', 'casual-t-shirts', '', '', '', 1, '2020-10-08 10:15:19', '2020-10-14 09:21:34'),
(3, 1, 1, 'Formal T-Shirts', '', 0.00, '', 'formal-t-shirts', '', '', '', 1, '2020-10-08 10:17:39', '2020-10-14 09:21:35'),
(7, 0, 1, 'Shirts', '', 0.00, '', 'shirts', '', '', '', 1, '2020-10-10 10:00:34', '2020-10-14 09:21:35'),
(8, 7, 1, 'Formal Shirts', '', 0.00, '', 'formal-shirts', '', '', '', 1, '2020-10-10 10:01:07', '2020-10-14 09:21:36'),
(9, 7, 1, 'Casual Shirts', '', 0.00, '', 'casual-shirts', '', '', '', 1, '2020-10-10 10:01:31', '2020-10-14 09:21:37'),
(10, 0, 2, 'Tops', NULL, NULL, NULL, 'tops', NULL, NULL, NULL, 1, '2020-10-14 04:36:53', '2020-10-14 09:21:38'),
(11, 10, 2, 'White Tops', NULL, NULL, NULL, 'white-tops', NULL, NULL, NULL, 1, '2020-10-14 04:37:24', '2020-10-14 09:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_11_123306_create_admins_table', 2),
(5, '2020_10_04_154028_create_sections_table', 3),
(6, '2020_10_06_154205_create_categories_table', 4),
(7, '2020_10_10_153837_create_products_table', 5),
(8, '2020_10_12_160952_create_product_attributes_table', 6),
(9, '2020_10_13_100921_create_product_images_table', 7),
(10, '2020_10_13_152654_create_brands_table', 8),
(11, '2020_10_13_173222_add_column_to_products', 9),
(12, '2020_10_15_152156_create_sliders_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_discount` double(8,2) DEFAULT NULL,
  `product_main_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_fabric` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_pattern` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sleeve` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_fit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `section_id`, `brand_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_main_image`, `product_video`, `product_description`, `product_fabric`, `product_pattern`, `product_sleeve`, `product_fit`, `product_meta_title`, `product_meta_description`, `product_meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 'Test Casual Product', 'G12250', 'Green', 550.00, 10.00, 'white_shirt-405291602525158.jpg', '', NULL, 'Cotton', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-10-14 12:05:14'),
(2, 8, 1, 2, 'Test Formal Product', 'R12858', 'Red', 950.00, 10.00, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, NULL, '2020-10-14 12:05:15'),
(3, 3, 1, 2, 'Formal Test T-Shirts', 'ES-320', 'Black', 2000.00, NULL, '', '', NULL, 'Cotton', NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2020-10-11 11:57:34', '2020-10-14 12:05:16'),
(4, 2, 1, 1, 'Casual Test Shirts', 'ES-5000', 'Blue', 2510.00, 10.00, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2020-10-11 11:59:53', '2020-10-14 12:05:17'),
(5, 8, 1, 3, 'White Formal Shirt', 'WT1002', 'White', 2510.00, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2020-10-11 12:55:16', '2020-10-14 11:11:57'),
(6, 9, 1, 1, 'Casual Test Shirts', 'ES-5001', 'White', 2505.00, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2020-10-11 13:02:02', '2020-10-14 11:44:36'),
(7, 8, 1, 1, 'White Formal Shirt', 'ES-5001', 'White', 2510.00, NULL, 'product_3-586681602695197.jpg', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2020-10-11 13:14:17', '2020-10-14 11:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 1000.00, 10, 'G12250-S', 1, '2020-10-12 13:48:19', '2020-10-14 09:30:14'),
(2, 1, 'Medium', 7000.00, 200, 'G12250-M', 1, '2020-10-12 13:48:19', '2020-10-13 02:09:49'),
(3, 1, 'Large', 8000.00, 300, 'G12250-L', 1, '2020-10-12 13:48:19', '2020-10-13 02:09:51'),
(5, 2, 'Small', 7000.00, 100, 'R12858-S', 1, '2020-10-13 01:42:54', '2020-10-13 01:43:32'),
(6, 2, 'Medium', 8000.00, 100, 'R12858-M', 1, '2020-10-13 01:42:54', '2020-10-13 01:43:32'),
(7, 2, 'Large', 9000.00, 100, 'R12858-L', 1, '2020-10-13 01:42:54', '2020-10-13 01:43:32'),
(8, 2, 'Extra Large', 10000.00, 100, 'R12858-XL', 1, '2020-10-13 01:42:54', '2020-10-13 01:43:32'),
(9, 1, 'Extra Large', 250.00, 5, 'G12250-XL', 1, '2020-10-13 02:09:40', '2020-10-13 02:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'product_2-643471602589864.jpg', 1, '2020-10-13 05:51:05', '2020-10-14 09:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mens', 1, NULL, '2020-10-14 09:13:56'),
(2, 'Womens', 1, NULL, '2020-10-14 09:13:58'),
(3, 'Kids', 1, NULL, '2020-10-14 09:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_image`, `title`, `alt_text`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, '1-817631602783909.png', '', 'Slider 1 Alter text', '', 1, '2020-10-15 11:45:09', '2020-10-15 12:08:38'),
(2, '2-953541602783926.png', 'Slider 2 Title', 'Slider 2 Alter text', 'https://esellers.techbcd.com', 1, '2020-10-15 11:45:26', '2020-10-15 12:08:58'),
(3, '3-514031602783943.png', 'Slider 3 Title', 'Slider 3 Alter text', 'https://esellers.techbcd.com', 1, '2020-10-15 11:45:43', '2020-10-15 11:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
