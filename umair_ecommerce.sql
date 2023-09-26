-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 07:33 AM
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
-- Database: `umair_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'apple', 1, '2023-09-16 06:13:17', '2023-09-16 06:13:17'),
(2, 'Xiome', 'xiome', 1, '2023-09-16 06:13:30', '2023-09-16 06:13:30'),
(3, 'black horse', 'black-horse', 1, '2023-09-16 06:13:44', '2023-09-16 06:13:44'),
(4, 'speed horse', 'speed-horse', 1, '2023-09-16 06:13:53', '2023-09-16 06:13:53'),
(5, 'j.', 'j', 1, '2023-09-16 06:14:02', '2023-09-16 06:14:02'),
(6, 'ahsan clothe', 'ahsan-clothe', 1, '2023-09-16 06:14:16', '2023-09-16 06:14:16'),
(7, 'gulab', 'gulab', 1, '2023-09-16 06:14:31', '2023-09-16 06:14:31'),
(8, 'chambali', 'chambali', 1, '2023-09-16 06:14:44', '2023-09-16 06:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'Machines', 'machines', '1694862591.jpg', 1, 'Yes', '2023-09-16 06:09:51', '2023-09-16 06:09:51'),
(2, 'Clothes', 'clothes', '1694862603.jpg', 1, 'Yes', '2023-09-16 06:10:03', '2023-09-16 06:10:03'),
(3, 'Flowers', 'flowers', '1694862624.jpg', 1, 'Yes', '2023-09-16 06:10:24', '2023-09-16 06:10:24'),
(4, 'Horses', 'horses', '1694862633.jpg', 1, 'Yes', '2023-09-16 06:10:33', '2023-09-16 06:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_14_044413_alter_user_table', 2),
(6, '2023_08_15_132702_create_categories_table', 3),
(7, '2023_09_01_062700_create_sub_categories_table', 4),
(8, '2023_09_01_123426_create_brands_table', 5),
(11, '2023_09_01_162749_create_products_table', 6),
(12, '2023_09_01_163533_create_product_images_table', 6),
(13, '2023_09_13_025906_alter_categories_table', 7),
(14, '2023_09_13_031003_alter_sub_categories_table', 8),
(15, '2023_09_17_112559_alter_products_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Nukra', 'nukra', '<p>This is horse</p>', NULL, NULL, NULL, 3000.00, 3200.00, 4, 14, 4, 'Yes', 'DD', '123132', 'Yes', 5, 1, '2023-09-16 06:16:18', '2023-09-16 06:16:18'),
(13, 'rusain speedy', 'rusain-speedy', '<p>This is a russian speedy horse</p>', NULL, NULL, NULL, 1200.00, 1700.00, 4, 15, 3, 'Yes', 'DD', '2141243', 'No', NULL, 1, '2023-09-16 06:17:28', '2023-09-16 06:17:28'),
(14, 'watch screen', 'watch-screen', '<p>This led watch</p>', NULL, NULL, NULL, 200.00, 230.00, 1, 9, 2, 'Yes', 'FF', '324233', 'Yes', 12, 1, '2023-09-16 06:18:23', '2023-09-16 07:25:14'),
(15, 'laptop', 'laptop', '<p>this is a laptop</p>', NULL, NULL, NULL, 1200.00, 2133.00, 1, 8, NULL, 'No', 'DD', '311223', 'Yes', 21, 1, '2023-09-16 06:19:53', '2023-09-16 07:24:43'),
(16, 'gulab flower', 'gulab-flower', '<p>this&nbsp; a floweers</p>', NULL, NULL, NULL, 112.00, 222.00, 3, 13, 7, 'No', 'DD', '3221321', 'Yes', 123, 1, '2023-09-16 06:21:20', '2023-09-16 06:21:20'),
(17, 'chambali forest', 'chambali-forest', '<p>this a flwoers</p>', NULL, NULL, NULL, 12.00, 23.00, 3, 12, 8, 'No', 'DD', '32121', 'Yes', 123, 1, '2023-09-16 06:23:01', '2023-09-16 07:23:44'),
(18, 'Shits', 'shits', '<p>mens shirts heer</p>', '<p>This is shpwt description</p>', '<p>shiping retirsn</p>', NULL, 123.00, 233.00, 2, NULL, 5, 'No', 'DD', '213312', 'Yes', 17, 1, '2023-09-16 06:24:03', '2023-09-17 06:44:54'),
(19, 'women clothe', 'women-clothe', '<p>THis a women clothe</p>', NULL, NULL, NULL, 300.00, 400.00, 2, 11, 6, 'No', 'FF', '132213', 'Yes', 123, 1, '2023-09-16 06:25:01', '2023-09-16 07:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(29, 12, '12_1694862978_65058e82d2e4d.jpg', NULL, '2023-09-16 06:16:18', '2023-09-16 06:16:18'),
(30, 12, '12_1694862978_65058e82d4529.jpg', NULL, '2023-09-16 06:16:18', '2023-09-16 06:16:18'),
(31, 13, '13_1694863048_65058ec82b510.jpg', NULL, '2023-09-16 06:17:28', '2023-09-16 06:17:28'),
(32, 14, '14_1694863145_65058f29de119.JPG', NULL, '2023-09-16 06:19:05', '2023-09-16 06:19:05'),
(33, 15, '15_1694863222_65058f7646d0e.JPG', NULL, '2023-09-16 06:20:22', '2023-09-16 06:20:22'),
(34, 16, '16_1694863280_65058fb09bdd3.jpg', NULL, '2023-09-16 06:21:20', '2023-09-16 06:21:20'),
(35, 17, '17_1694863396_650590242f913.jpg', NULL, '2023-09-16 06:23:16', '2023-09-16 06:23:16'),
(36, 18, '18_1694863443_6505905318622.png', NULL, '2023-09-16 06:24:03', '2023-09-16 06:24:03'),
(37, 19, '19_1694863529_650590a9bb8b9.jpg', NULL, '2023-09-16 06:25:29', '2023-09-16 06:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'Laptops', 'laptops', 1, 'Yes', 1, '2023-09-16 06:11:15', '2023-09-16 06:11:15'),
(9, 'LED', 'led', 1, 'Yes', 1, '2023-09-16 06:11:29', '2023-09-16 06:11:29'),
(10, 'Mens', 'mens', 1, 'Yes', 2, '2023-09-16 06:11:37', '2023-09-16 06:11:37'),
(11, 'Wo mens', 'wo-mens', 1, 'Yes', 2, '2023-09-16 06:11:45', '2023-09-16 06:11:45'),
(12, 'Forest', 'forest', 1, 'Yes', 3, '2023-09-16 06:11:55', '2023-09-16 06:11:55'),
(13, 'Homes', 'homes', 1, 'Yes', 3, '2023-09-16 06:12:03', '2023-09-16 06:12:03'),
(14, 'Pakistani', 'pakistani', 1, 'Yes', 4, '2023-09-16 06:12:12', '2023-09-16 06:12:12'),
(15, 'Russian', 'russian', 1, 'Yes', 4, '2023-09-16 06:12:22', '2023-09-16 06:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'umair', 'umair@gmail.com', 1, NULL, '$2y$10$O6Nc/HhGA9uzPkQ1WuBtO.e5MTQxVoZLLCLyoG3tXeLE6IQb4ztVG', NULL, '2023-08-13 23:50:43', '2023-08-13 23:50:43'),
(2, 'muzamil', 'admin@gmail.com', 2, NULL, '$2y$10$dJDjf8tFV4ZhKG0lR0sAkuYfFLiSRiyP8oDfd4yapRTSDu.coAbFm', NULL, '2023-08-13 23:51:45', '2023-08-13 23:51:45');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
