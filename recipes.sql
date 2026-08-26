-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2026 at 12:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_status` varchar(255) NOT NULL DEFAULT 'off',
  `ad_type` varchar(255) DEFAULT NULL,
  `backup_ads` varchar(255) DEFAULT NULL,
  `interstitial_ad_interval` int(11) DEFAULT NULL,
  `native_ad_interval` int(11) DEFAULT NULL,
  `native_ad_index` int(11) NOT NULL DEFAULT 0,
  `primary_ad_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`primary_ad_config`)),
  `backup_ad_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`backup_ad_config`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `ad_status`, `ad_type`, `backup_ads`, `interstitial_ad_interval`, `native_ad_interval`, `native_ad_index`, `primary_ad_config`, `backup_ad_config`, `created_at`, `updated_at`) VALUES
(1, 'on', 'admob', 'google_ad_manager', 6, NULL, 7, '{\"admob\":{\"publisher_id\":\"12\",\"app_id\":\"12\",\"banner_unit_id\":\"1\",\"interstitial_unit_id\":\"2\",\"native_unit_id\":\"5\",\"app_open_ad_unit_id\":\"7\"}}', '{\"google_ad_manager\":{\"banner_unit_id\":\"4\",\"interstitial_unit_id\":\"3\",\"native_unit_id\":\"2\",\"app_open_ad_unit_id\":\"1\"}}', '2026-08-20 05:12:15', '2026-08-20 05:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `ads_placements`
--

CREATE TABLE `ads_placements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner_home` tinyint(1) NOT NULL DEFAULT 0,
  `banner_post_details` tinyint(1) NOT NULL DEFAULT 0,
  `banner_category_details` tinyint(1) NOT NULL DEFAULT 0,
  `banner_search` tinyint(1) NOT NULL DEFAULT 0,
  `interstitial_post_list` tinyint(1) NOT NULL DEFAULT 0,
  `interstitial_post_details` tinyint(1) NOT NULL DEFAULT 0,
  `native_ad_home` tinyint(1) NOT NULL DEFAULT 0,
  `native_ad_post_list` tinyint(1) NOT NULL DEFAULT 0,
  `native_ad_post_details` tinyint(1) NOT NULL DEFAULT 0,
  `native_ad_exit_dialog` tinyint(1) NOT NULL DEFAULT 0,
  `app_open_ad_on_start` tinyint(1) NOT NULL DEFAULT 0,
  `app_open_ad_on_resume` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads_placements`
--

INSERT INTO `ads_placements` (`id`, `created_at`, `updated_at`, `banner_home`, `banner_post_details`, `banner_category_details`, `banner_search`, `interstitial_post_list`, `interstitial_post_details`, `native_ad_home`, `native_ad_post_list`, `native_ad_post_details`, `native_ad_exit_dialog`, `app_open_ad_on_start`, `app_open_ad_on_resume`) VALUES
(1, '2026-08-20 05:12:15', '2026-08-20 05:17:53', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`id`, `package_name`, `status`, `redirect_url`, `created_at`, `updated_at`) VALUES
(1, 'popy', '1', NULL, '2026-08-20 05:28:56', '2026-08-20 05:28:56'),
(2, 'vhjv', '1', NULL, '2026-08-20 05:29:43', '2026-08-20 05:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `category_name`, `category_image`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'food', 'categories/JkLv1s144O7wiWG78oku4MkluptCO5Fo0VUjpk6U.png', 1, '2026-08-21 22:07:15', '2026-08-21 22:07:15'),
(2, 'first food', 'categories/yMQNyGZtIvJRrmz4Zq9XfO0lgar8eRMh24sTI701.png', 1, '2026-08-21 22:07:34', '2026-08-21 22:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fcm_tokens`
--

CREATE TABLE `fcm_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `license_type` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_18_112917_create_categories_table', 1),
(5, '2026_08_18_112927_create_recipes_table', 1),
(6, '2026_08_18_112936_create_recipe_galleries_table', 1),
(7, '2026_08_18_112959_create_settings_table', 1),
(8, '2026_08_18_113005_create_app_configs_table', 1),
(9, '2026_08_18_113014_create_notification_templates_table', 1),
(10, '2026_08_18_113021_create_fcm_tokens_table', 1),
(11, '2026_08_18_113029_create_ads_table', 1),
(12, '2026_08_18_113036_create_ads_placements_table', 1),
(13, '2026_08_18_113619_add_custom_fields_to_users_table', 1),
(14, '2026_08_20_060450_create_licenses_table', 1),
(15, '2026_08_20_071842_update_ads_and_placements_tables', 1),
(16, '2026_08_20_103527_change_ad_status_to_string_in_ads_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `title`, `message`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, 'fgdxdvx', 'dfhfghxcbvxvbx', 'notifications/nNiZ73JyKP3Xt1N7yHMemKQy0Il17cjUiAItoaNF.png', 'https://protty.edufinems.com/sendsmsmail/sms', '2026-08-20 06:07:33', '2026-08-20 06:08:01');

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
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `recipe_title` varchar(255) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `recipe_image` varchar(255) DEFAULT NULL,
  `recipe_time` varchar(255) DEFAULT NULL,
  `recipe_description` longtext DEFAULT NULL,
  `content_type` enum('Post','youtube','Url','Upload') NOT NULL DEFAULT 'Post',
  `size` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `tags` varchar(255) DEFAULT NULL,
  `total_views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `last_update` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `cat_id`, `recipe_title`, `video_url`, `video_id`, `recipe_image`, `recipe_time`, `recipe_description`, `content_type`, `size`, `featured`, `tags`, `total_views`, `last_update`, `created_at`, `updated_at`) VALUES
(1, 2, 'ghc', 'https://www.youtube.com/results?search_query=movie', 'cda11up', 'recipes/PFzhR0QcVyV5fCk2Frt6iaCjBRfOXsO425x5tURM.png', '10', 'sdsfsdf', 'Url', NULL, 0, NULL, 0, NULL, '2026-08-21 22:12:17', '2026-08-21 22:12:17'),
(2, 2, 'fgxgb', 'https://www.youtube.com/results?search_query=movie', 'cda11up', NULL, '20', 'dfgdfg', 'youtube', NULL, 0, NULL, 0, NULL, '2026-08-21 22:12:43', '2026-08-21 22:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_galleries`
--

CREATE TABLE `recipe_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recipe_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3BUjEMBJ4tNRGuG6b2C37wAsW88c7Nqz1i5zTM0f', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJtOVk1Y0tUdEREOG81NWV5RnlZYXBxQ0V4VEVoVGNoT2VNVEtxUEpoIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9mZWF0dXJlZCIsInJvdXRlIjoiZmVhdHVyZWQuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1787393116),
('JnPmVoSPCPJbJdUAPYjoy8M7lIsfzUIrq4YwIvgH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJaZ1U3UVFyanpjSEU0Rnh4OGtsUDlWbXpkbmlVUHJKZ3BaeG5wMXIzIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1787379273),
('mDq5WR27NeyDkN38r6uyQprY5ni2xGyOOsxzeOZT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.134.0 Chrome/148.0.7778.280 Electron/42.8.1 Safari/537.36', 'eyJfdG9rZW4iOiJET0xLbmVMQ0QxM3lJZTYzeVVkV2l3b1BwZ0xjUlRzSk1QY0hyY2M2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1787374965);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_fcm_key` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `onesignal_app_id` varchar(255) DEFAULT NULL,
  `onesignal_rest_api_key` varchar(255) DEFAULT NULL,
  `providers` varchar(255) DEFAULT NULL,
  `fcm_notification_topic` varchar(255) DEFAULT NULL,
  `privacy_policy` longtext DEFAULT NULL,
  `youtube_api_key` varchar(255) DEFAULT NULL,
  `more_apps_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_fcm_key`, `api_key`, `package_name`, `onesignal_app_id`, `onesignal_rest_api_key`, `providers`, `fcm_notification_topic`, `privacy_policy`, `youtube_api_key`, `more_apps_url`, `created_at`, `updated_at`) VALUES
(1, 'fghd', 'cda118O26p0qGvb1aou9AL7CZUdy3iH4VgQDktnwlxNFcmjSIT', NULL, 'dfgh', 'dfghd', 'onesignal', 'dfghdf', 'dfghd', NULL, 'ghff', '2026-08-20 06:13:26', '2026-08-20 06:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `image`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin2@example.com', 'admin', NULL, 1, NULL, '$2y$12$HkRRUDmPlnm9.EblsbbrOupSaMgC9BZUihP1EaUQ0XHIlGDJYOcku', NULL, '2026-08-20 05:10:59', '2026-08-20 05:10:59'),
(2, 'popy mistry', 'popy', 'popymistry6@gmail.com', 'admin', NULL, 1, NULL, '$2y$12$xSL/WdLJlMd9YYSY1Qrtbes3DHh1XQAZQWQ97GVvvxhTaA0ntE2YW', NULL, '2026-08-20 05:49:20', '2026-08-20 05:49:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads_placements`
--
ALTER TABLE `ads_placements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `fcm_tokens`
--
ALTER TABLE `fcm_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `recipes_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `recipe_galleries`
--
ALTER TABLE `recipe_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_galleries_recipe_id_foreign` (`recipe_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_placements`
--
ALTER TABLE `ads_placements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fcm_tokens`
--
ALTER TABLE `fcm_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipe_galleries`
--
ALTER TABLE `recipe_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_galleries`
--
ALTER TABLE `recipe_galleries`
  ADD CONSTRAINT `recipe_galleries_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
