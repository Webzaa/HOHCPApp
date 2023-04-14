-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 12:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hohdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel_partner`
--

CREATE TABLE `channel_partner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cp_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departments` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projects` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel_partner`
--

INSERT INTO `channel_partner` (`id`, `cp_name`, `email_id`, `mobile`, `address`, `departments`, `projects`, `created_at`, `updated_at`) VALUES
(1, 'Rashmi S', 'webzaamcc@gmail.com', 9324302137, 'test', 'ssad', '2,3', '2022-08-07 06:51:46', '2022-08-07 09:11:19'),
(2, 'Faisal', 'webzaa.dev@gmail.com', 9324302134, '407 - 4th Floor, 1 Aerocity , Safed Phul', 'dasdasda', '1,2', '2022-08-07 09:11:05', '2022-08-07 09:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'mumbai', '2022-08-06 02:30:23', '2022-08-06 02:30:23'),
(2, 'Chennai', '2022-08-06 02:30:48', '2022-08-06 02:30:48'),
(3, 'Delhi', '2022-08-06 02:30:54', '2022-08-06 02:30:54'),
(4, 'Kolkatta', '2022-08-06 02:30:59', '2022-08-06 04:16:21'),
(5, 'Banglore', '2022-08-06 07:05:12', '2022-08-06 07:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `collateral_types`
--

CREATE TABLE `collateral_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collateral_types`
--

INSERT INTO `collateral_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Project Details', '2022-08-09 10:45:04', '2022-08-09 10:45:04'),
(2, 'Plans', '2022-08-09 10:45:04', '2022-08-09 10:45:04'),
(3, 'Latest Offers', '2022-08-09 10:46:01', '2022-08-09 10:46:01'),
(4, 'Construction Status', '2022-08-09 10:46:01', '2022-08-09 10:46:01');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map_collateral_image`
--

CREATE TABLE `map_collateral_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_collateral_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_collateral_image`
--

INSERT INTO `map_collateral_image` (`id`, `project_collateral_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, 'ProjectCollateralImages/1/1/1660116290_download (1).jpeg', '2022-08-10 01:54:50', '2022-08-10 01:54:50'),
(7, 1, 'ProjectCollateralImages/1/1/1660138559_download (2).jpeg', '2022-08-10 08:05:59', '2022-08-10 08:05:59'),
(8, 1, 'ProjectCollateralImages/1/1/1660138559_download.jpeg', '2022-08-10 08:05:59', '2022-08-10 08:05:59');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_06_070605_create_city_table', 2),
(6, '2022_08_06_094711_create_project_table', 3),
(7, '2022_08_07_072331_create_channel_partner_table', 4),
(8, '2022_08_07_144556_create_sales_manager_table', 5),
(9, '2022_08_07_155610_create_project_collateral_table', 6),
(10, '2022_08_09_052914_create_collateral_type_table', 7),
(11, '2022_08_09_103551_create_collateral_types_table', 8),
(12, '2022_08_10_060328_create_map_collateral_image_table', 9),
(13, '2022_08_12_053910_create_role_type_table', 10),
(14, '2022_08_12_110424_add_role_id_users_table', 11);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `configuration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `configuration`, `price`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Hiranandani Kandivali', '3BHK', 15000000, 3, '2022-08-06 07:07:27', '2022-08-06 08:19:49'),
(2, 'Hiranandani banglore', '2 BHK', 25000000, 5, '2022-08-07 05:20:02', '2022-08-07 05:20:02'),
(3, 'Hiranandani Delhi', '1 BHK', 65000000, 3, '2022-08-07 05:20:19', '2022-08-07 05:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `project_collateral`
--

CREATE TABLE `project_collateral` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `collateral_type` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_collateral`
--

INSERT INTO `project_collateral` (`id`, `project_id`, `collateral_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-08-10 01:54:50', '2022-08-10 01:54:50'),
(2, 2, 3, '2022-08-10 01:55:28', '2022-08-10 01:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_type`
--

CREATE TABLE `role_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_type`
--

INSERT INTO `role_type` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2022-08-12 05:41:42', '2022-08-12 05:41:42'),
(2, 'Channel Partner', '2022-08-12 05:42:36', '2022-08-12 05:42:49'),
(3, 'Sales Manager', '2022-08-12 05:42:44', '2022-08-12 05:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `sales_manager`
--

CREATE TABLE `sales_manager` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sm_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_manager`
--

INSERT INTO `sales_manager` (`id`, `sm_name`, `email_id`, `mobile`, `address`, `vendor_id`, `company_name`, `gst_no`, `acc_no`, `ifsc`, `created_at`, `updated_at`) VALUES
(1, 'Amit', 'webzaamcc@gmail.com', '9324302136', 'test', '12344545345', 'Webzaa', '43254324324234', '37785435351234', 'UBF1234555A', '2022-08-07 10:01:08', '2022-08-07 10:09:43'),
(3, 'Sidhhant', 'lalu.webzaa@gmail.com', '9324302137', '407 - 4th Floor, 1 Aerocity , Safed Phul', '12344545345', 'Webzaa', '43254324324234', '37785435351234', 'vcxb', '2022-08-12 07:53:12', '2022-08-12 07:53:12');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Tanmay', 'webzaa.dev@gmail.com', NULL, '$2y$10$jcBoChi1BLHhrj89b./O4.JGvE1lpeu5J.Yn/Z.f4ZDbKTmSBWsPG', NULL, '2022-08-06 00:51:44', '2022-08-06 00:51:44', 1),
(3, 'Swapnil', 'webzaacreative@gmail.com', NULL, '$2y$10$Imy4EQMW537vT4KC6m.eg.I.eSLM9Ty5gQs5QFuhcqe3ySr.lpPZe', NULL, '2022-08-12 06:56:17', '2022-08-12 06:56:17', 2),
(4, 'Sidhhant', 'lalu.webzaa@gmail.com', NULL, '$2y$10$pn7ZXg1GCO5SQr46bVvCkeWAJRHrin15fu.cWQT/6V701cBzlwO4O', '6lXCttxivG2U73IE1KMul4S9omO8I7hMybrkxDWZAJKh1JZ9JxvDbEKktlmH', '2022-08-12 07:51:10', '2022-08-12 23:55:45', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel_partner`
--
ALTER TABLE `channel_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collateral_types`
--
ALTER TABLE `collateral_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `map_collateral_image`
--
ALTER TABLE `map_collateral_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `map_collateral_image_project_collateral_id_foreign` (`project_collateral_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_city_id_foreign` (`city_id`);

--
-- Indexes for table `project_collateral`
--
ALTER TABLE `project_collateral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_collateral_project_id_foreign` (`project_id`);

--
-- Indexes for table `role_type`
--
ALTER TABLE `role_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_manager`
--
ALTER TABLE `sales_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel_partner`
--
ALTER TABLE `channel_partner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `collateral_types`
--
ALTER TABLE `collateral_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_collateral_image`
--
ALTER TABLE `map_collateral_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_collateral`
--
ALTER TABLE `project_collateral`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_type`
--
ALTER TABLE `role_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_manager`
--
ALTER TABLE `sales_manager`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `map_collateral_image`
--
ALTER TABLE `map_collateral_image`
  ADD CONSTRAINT `map_collateral_image_project_collateral_id_foreign` FOREIGN KEY (`project_collateral_id`) REFERENCES `project_collateral` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_collateral`
--
ALTER TABLE `project_collateral`
  ADD CONSTRAINT `project_collateral_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role_type` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
