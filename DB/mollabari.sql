-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 03:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office_phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `amount` decimal(40,2) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 means deposite and 2 means withdraw',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `join_date` datetime NOT NULL,
  `join_month` int(11) NOT NULL,
  `join_year` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `user_id`, `house_id`, `name`, `info`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Floor 02', 'সর্বমোট ১২টা রুম আছে , এর মধ্যে এটাস্টবাথ বিশিষ্ট রুম-০৪টা, কমন বাথরুম আছে-০৩টা।', 1, '2025-01-13 01:12:52', '2025-01-13 01:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `contract_number` varchar(255) DEFAULT NULL,
  `holding_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `land_info` varchar(255) DEFAULT NULL,
  `opening_balance` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `user_id`, `house_name`, `owner_name`, `contract_number`, `holding_number`, `address`, `land_info`, `opening_balance`, `document`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'হাজী-মার্কেট কর্মজীবী ও ছাত্র নিবাস ব্যাচেলর মেছ', NULL, '01721066352', '03', 'প্রেম বাগান,হাজী-মার্কেট,শহীদ লতিফ রোড,দক্ষিণখান,ঢাকা-১২৩০।', 'দাগ-১৭৮।', 0, NULL, 1, '2025-01-13 01:11:22', '2025-01-13 01:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `income_expences`
--

CREATE TABLE `income_expences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `income_expence_category_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `income_amount` decimal(40,2) DEFAULT NULL,
  `expence_amount` decimal(40,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1: INcome 2:Expense',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `income_expence_categories`
--

CREATE TABLE `income_expence_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income_expence_categories`
--

INSERT INTO `income_expence_categories` (`id`, `user_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'GES BILL HAZI-MARKET MESS', 1, '2025-01-13 03:30:43', '2025-01-13 03:30:43');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_05_21_100000_create_teams_table', 1),
(7, '2020_05_21_200000_create_team_user_table', 1),
(8, '2020_05_21_300000_create_team_invitations_table', 1),
(9, '2023_09_20_095749_create_sessions_table', 1),
(10, '2024_12_02_064638_create_categories_table', 2),
(12, '2024_12_03_061516_create_phonebooks_table', 3),
(13, '2024_12_03_104006_create_houses_table', 4),
(14, '2024_12_04_054438_create_floors_table', 5),
(15, '2024_12_04_061732_create_units_table', 6),
(16, '2024_12_04_102554_create_renters_table', 7),
(17, '2024_12_05_050531_create_rents_table', 8),
(18, '2024_12_07_063756_create_payment_methods_table', 9),
(19, '2024_12_07_063909_create_transactions_table', 9),
(20, '2024_12_07_065419_create_income_expence_categories_table', 10),
(21, '2024_12_07_070251_create_income_expences_table', 11),
(22, '2024_12_08_053909_create_monthly_rents_table', 12),
(23, '2024_12_08_092955_create_settings_table', 13),
(24, '2024_12_08_102903_create_photo_galleries_table', 14),
(25, '2024_12_08_111449_create_video_galleries_table', 15),
(31, '2024_12_11_104240_create_designations_table', 16),
(32, '2024_12_11_104757_create_employees_table', 16),
(34, '2024_11_26_040228_create_salary_records_table', 17),
(35, '2024_12_18_092934_create_remainders_table', 18),
(36, '2024_12_19_065019_create_bank_transactions_table', 19),
(37, '2024_12_21_042241_create_user_statements_table', 20),
(38, '2025_01_02_113712_create_rent_adjustments_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 992),
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 992),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 992),
(5, 'App\\Models\\User', 992),
(7, 'App\\Models\\User', 992),
(8, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 992),
(9, 'App\\Models\\User', 1),
(9, 'App\\Models\\User', 992),
(10, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 1),
(11, 'App\\Models\\User', 992),
(12, 'App\\Models\\User', 1),
(12, 'App\\Models\\User', 992),
(13, 'App\\Models\\User', 1),
(13, 'App\\Models\\User', 992),
(14, 'App\\Models\\User', 1),
(14, 'App\\Models\\User', 3),
(15, 'App\\Models\\User', 1),
(15, 'App\\Models\\User', 3),
(15, 'App\\Models\\User', 992),
(16, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 3),
(16, 'App\\Models\\User', 992),
(17, 'App\\Models\\User', 992),
(19, 'App\\Models\\User', 992),
(20, 'App\\Models\\User', 992),
(21, 'App\\Models\\User', 992),
(23, 'App\\Models\\User', 992),
(24, 'App\\Models\\User', 992),
(25, 'App\\Models\\User', 992),
(27, 'App\\Models\\User', 992),
(28, 'App\\Models\\User', 992),
(29, 'App\\Models\\User', 992),
(31, 'App\\Models\\User', 992),
(32, 'App\\Models\\User', 992),
(33, 'App\\Models\\User', 992),
(35, 'App\\Models\\User', 992),
(36, 'App\\Models\\User', 992),
(37, 'App\\Models\\User', 992),
(39, 'App\\Models\\User', 992),
(40, 'App\\Models\\User', 992),
(41, 'App\\Models\\User', 992),
(43, 'App\\Models\\User', 992),
(44, 'App\\Models\\User', 992),
(45, 'App\\Models\\User', 992),
(47, 'App\\Models\\User', 992),
(48, 'App\\Models\\User', 992),
(49, 'App\\Models\\User', 992),
(51, 'App\\Models\\User', 992),
(52, 'App\\Models\\User', 992),
(53, 'App\\Models\\User', 992),
(55, 'App\\Models\\User', 992),
(56, 'App\\Models\\User', 992),
(57, 'App\\Models\\User', 992),
(59, 'App\\Models\\User', 992),
(60, 'App\\Models\\User', 992),
(61, 'App\\Models\\User', 992),
(63, 'App\\Models\\User', 992),
(64, 'App\\Models\\User', 992),
(65, 'App\\Models\\User', 992),
(67, 'App\\Models\\User', 992),
(68, 'App\\Models\\User', 992),
(69, 'App\\Models\\User', 992),
(71, 'App\\Models\\User', 992),
(72, 'App\\Models\\User', 992),
(73, 'App\\Models\\User', 992),
(75, 'App\\Models\\User', 992),
(76, 'App\\Models\\User', 992),
(77, 'App\\Models\\User', 992),
(79, 'App\\Models\\User', 992),
(80, 'App\\Models\\User', 992),
(81, 'App\\Models\\User', 992),
(83, 'App\\Models\\User', 992),
(84, 'App\\Models\\User', 992),
(85, 'App\\Models\\User', 992),
(87, 'App\\Models\\User', 992),
(88, 'App\\Models\\User', 992),
(89, 'App\\Models\\User', 992),
(91, 'App\\Models\\User', 992),
(92, 'App\\Models\\User', 992),
(93, 'App\\Models\\User', 992),
(94, 'App\\Models\\User', 992),
(95, 'App\\Models\\User', 992),
(96, 'App\\Models\\User', 992),
(97, 'App\\Models\\User', 992),
(98, 'App\\Models\\User', 992),
(99, 'App\\Models\\User', 992),
(100, 'App\\Models\\User', 992),
(101, 'App\\Models\\User', 992),
(102, 'App\\Models\\User', 992),
(103, 'App\\Models\\User', 992),
(104, 'App\\Models\\User', 992),
(105, 'App\\Models\\User', 992),
(106, 'App\\Models\\User', 992),
(107, 'App\\Models\\User', 992),
(108, 'App\\Models\\User', 992),
(109, 'App\\Models\\User', 992),
(110, 'App\\Models\\User', 992),
(111, 'App\\Models\\User', 992),
(112, 'App\\Models\\User', 992),
(113, 'App\\Models\\User', 992),
(114, 'App\\Models\\User', 992),
(115, 'App\\Models\\User', 992),
(116, 'App\\Models\\User', 992),
(117, 'App\\Models\\User', 992),
(118, 'App\\Models\\User', 992),
(119, 'App\\Models\\User', 992),
(123, 'App\\Models\\User', 992),
(124, 'App\\Models\\User', 992),
(125, 'App\\Models\\User', 992),
(126, 'App\\Models\\User', 992),
(127, 'App\\Models\\User', 992),
(128, 'App\\Models\\User', 992),
(129, 'App\\Models\\User', 992),
(130, 'App\\Models\\User', 992),
(131, 'App\\Models\\User', 992),
(132, 'App\\Models\\User', 992),
(133, 'App\\Models\\User', 992),
(134, 'App\\Models\\User', 992),
(135, 'App\\Models\\User', 992),
(136, 'App\\Models\\User', 992),
(137, 'App\\Models\\User', 992),
(138, 'App\\Models\\User', 992),
(139, 'App\\Models\\User', 992),
(140, 'App\\Models\\User', 992),
(141, 'App\\Models\\User', 992),
(142, 'App\\Models\\User', 992),
(143, 'App\\Models\\User', 992),
(144, 'App\\Models\\User', 992),
(145, 'App\\Models\\User', 992),
(146, 'App\\Models\\User', 992),
(147, 'App\\Models\\User', 992),
(148, 'App\\Models\\User', 992),
(149, 'App\\Models\\User', 992),
(150, 'App\\Models\\User', 992),
(151, 'App\\Models\\User', 992),
(152, 'App\\Models\\User', 992),
(153, 'App\\Models\\User', 992),
(154, 'App\\Models\\User', 992),
(155, 'App\\Models\\User', 992),
(156, 'App\\Models\\User', 992),
(157, 'App\\Models\\User', 992),
(158, 'App\\Models\\User', 992),
(159, 'App\\Models\\User', 992),
(160, 'App\\Models\\User', 992),
(161, 'App\\Models\\User', 992),
(162, 'App\\Models\\User', 992),
(163, 'App\\Models\\User', 992),
(164, 'App\\Models\\User', 992),
(165, 'App\\Models\\User', 992),
(166, 'App\\Models\\User', 992),
(167, 'App\\Models\\User', 992),
(168, 'App\\Models\\User', 992),
(169, 'App\\Models\\User', 992),
(170, 'App\\Models\\User', 992),
(171, 'App\\Models\\User', 992),
(172, 'App\\Models\\User', 992),
(173, 'App\\Models\\User', 992),
(174, 'App\\Models\\User', 992),
(175, 'App\\Models\\User', 992),
(176, 'App\\Models\\User', 992),
(177, 'App\\Models\\User', 992),
(178, 'App\\Models\\User', 992),
(179, 'App\\Models\\User', 992),
(180, 'App\\Models\\User', 992),
(181, 'App\\Models\\User', 992),
(182, 'App\\Models\\User', 992),
(183, 'App\\Models\\User', 992),
(184, 'App\\Models\\User', 992),
(185, 'App\\Models\\User', 992),
(186, 'App\\Models\\User', 992),
(187, 'App\\Models\\User', 992),
(188, 'App\\Models\\User', 992),
(189, 'App\\Models\\User', 992),
(190, 'App\\Models\\User', 992),
(191, 'App\\Models\\User', 992),
(192, 'App\\Models\\User', 992),
(193, 'App\\Models\\User', 992),
(194, 'App\\Models\\User', 992),
(195, 'App\\Models\\User', 992),
(196, 'App\\Models\\User', 992),
(197, 'App\\Models\\User', 992),
(198, 'App\\Models\\User', 992),
(199, 'App\\Models\\User', 992),
(200, 'App\\Models\\User', 992),
(201, 'App\\Models\\User', 992),
(202, 'App\\Models\\User', 992),
(203, 'App\\Models\\User', 992),
(213, 'App\\Models\\User', 992),
(214, 'App\\Models\\User', 992),
(215, 'App\\Models\\User', 992),
(216, 'App\\Models\\User', 992),
(217, 'App\\Models\\User', 992),
(218, 'App\\Models\\User', 992),
(222, 'App\\Models\\User', 992),
(223, 'App\\Models\\User', 992),
(224, 'App\\Models\\User', 992),
(231, 'App\\Models\\User', 992),
(232, 'App\\Models\\User', 992),
(233, 'App\\Models\\User', 992),
(234, 'App\\Models\\User', 992),
(235, 'App\\Models\\User', 992),
(236, 'App\\Models\\User', 992),
(237, 'App\\Models\\User', 992),
(238, 'App\\Models\\User', 992),
(239, 'App\\Models\\User', 992),
(240, 'App\\Models\\User', 992),
(241, 'App\\Models\\User', 992),
(242, 'App\\Models\\User', 992),
(243, 'App\\Models\\User', 992),
(244, 'App\\Models\\User', 992),
(245, 'App\\Models\\User', 992),
(246, 'App\\Models\\User', 992),
(247, 'App\\Models\\User', 992),
(248, 'App\\Models\\User', 992),
(252, 'App\\Models\\User', 992),
(253, 'App\\Models\\User', 992),
(254, 'App\\Models\\User', 992);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 23);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_rents`
--

CREATE TABLE `monthly_rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rent_id` bigint(20) UNSIGNED NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `total_amount` decimal(40,2) NOT NULL,
  `advance_amount` decimal(40,2) NOT NULL,
  `collection_amount` decimal(40,2) DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '2 for fully paid, 1 for partially paid 0 for pending\r\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_rents`
--

INSERT INTO `monthly_rents` (`id`, `user_id`, `rent_id`, `month`, `year`, `total_amount`, `advance_amount`, `collection_amount`, `note`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 2025, 4800.00, 0.00, 0.00, NULL, '2025-01-01 00:00:00', 2, '2025-01-13 03:07:57', '2025-01-17 13:50:29'),
(2, 2, 2, 1, 2025, 4000.00, 0.00, 0.00, NULL, '2025-01-01 00:00:00', 2, '2025-01-13 03:07:57', '2025-01-17 13:50:23'),
(11, 2, 3, 1, 2025, 4800.00, 0.00, 0.00, NULL, '2025-01-01 00:00:00', 2, '2025-01-13 07:06:38', '2025-01-17 13:50:14'),
(12, 2, 4, 1, 2025, 2250.00, 0.00, 0.00, NULL, '2025-01-01 00:00:00', 2, '2025-01-13 07:06:38', '2025-01-17 13:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `opening_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `user_id`, `name`, `branch_name`, `account_number`, `balance`, `opening_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'CASH', NULL, '0', 0.00, '2025-01-01 00:00:00', '2025-01-13 03:11:48', '2025-01-13 03:11:48'),
(2, 2, 'BKASH', NULL, '0', 0.00, '2025-01-01 00:00:00', '2025-01-13 03:13:02', '2025-01-13 03:13:02'),
(3, 2, 'NAGAD', NULL, '0', 0.00, '2025-01-01 00:00:00', '2025-01-13 03:13:18', '2025-01-13 03:13:18'),
(4, 2, 'ROCKET', NULL, '0', 0.00, '2025-01-01 00:00:00', '2025-01-13 03:13:29', '2025-01-13 03:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit articles', 'web', '2023-09-22 21:38:03', '2023-09-22 21:38:03'),
(2, 'view user_management', 'web', '2023-09-22 22:18:33', '2023-09-22 22:18:33'),
(3, 'edit user_management', 'web', '2023-09-22 22:18:33', '2023-09-22 22:18:33'),
(4, 'delete user_management', 'web', '2023-09-22 22:18:33', '2023-09-22 22:18:33'),
(5, 'view category', 'web', '2023-09-23 02:14:32', '2023-09-23 02:14:32'),
(6, 'edit category', 'web', '2023-09-23 02:14:32', '2023-09-23 02:14:32'),
(7, 'delete category', 'web', '2023-09-23 02:14:32', '2023-09-23 02:14:32'),
(8, 'view sub_category', 'web', '2023-09-23 02:14:37', '2023-09-23 02:14:37'),
(9, 'edit sub_category', 'web', '2023-09-23 02:14:37', '2023-09-23 02:14:37'),
(10, 'delete sub_category', 'web', '2023-09-23 02:14:37', '2023-09-23 02:14:37'),
(11, 'view brand', 'web', '2023-09-23 02:14:41', '2023-09-23 02:14:41'),
(12, 'edit brand', 'web', '2023-09-23 02:14:41', '2023-09-23 02:14:41'),
(13, 'delete brand', 'web', '2023-09-23 02:14:41', '2023-09-23 02:14:41'),
(14, 'view service_name', 'web', '2023-11-28 23:23:25', '2023-11-28 23:23:25'),
(15, 'edit service_name', 'web', '2023-11-28 23:23:26', '2023-11-28 23:23:26'),
(16, 'delete service_name', 'web', '2023-11-28 23:23:26', '2023-11-28 23:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `permission_categories`
--

CREATE TABLE `permission_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `local` timestamp NULL DEFAULT NULL,
  `online` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_categories`
--

INSERT INTO `permission_categories` (`id`, `title`, `name`, `type`, `status`, `local`, `online`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'User Management', 'user_management', 'setting', 'Active', NULL, NULL, NULL, '2023-09-22 22:18:33', '2023-09-22 22:18:33'),
(2, 'Category', 'category', 'products', 'Active', NULL, NULL, NULL, '2023-09-23 02:14:31', '2023-09-23 02:14:31'),
(3, 'Sub Category', 'sub_category', 'products', 'Active', NULL, NULL, NULL, '2023-09-23 02:14:37', '2023-09-23 02:14:37'),
(4, 'Brand', 'brand', 'products', 'Active', NULL, NULL, NULL, '2023-09-23 02:14:41', '2023-09-23 02:14:41'),
(5, 'Service Name', 'service_name', 'products', 'Active', NULL, NULL, NULL, '2023-11-28 23:23:25', '2023-11-28 23:23:25');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonebooks`
--

CREATE TABLE `phonebooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remainders`
--

CREATE TABLE `remainders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `renter_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0:cancle 1:inprocess 2:complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renters`
--

CREATE TABLE `renters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `regnumber` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) NOT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `other_info` text DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `renters`
--

INSERT INTO `renters` (`id`, `user_id`, `name`, `email`, `nid`, `phone`, `gender`, `birth_date`, `regnumber`, `occupation`, `institute`, `other_info`, `pdf_file`, `address`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 'PROKASH CHANDRA SARKER', NULL, '3753175797', '01947686036', 'male', '1997-01-08', NULL, 'চাকুরী।', 'ব্রাক ব্যাংক,দক্ষিণ খান ঢাকা।', 'বড় ভাই মোবাইল:01942874068', '1736753026.pdf', 'বাসা:৫০৯,গ্রাম:দুর্গাপুর মধ্যপাড়া,ডাকঘর:সাকাশ্বর-১৭৫০,থানা:কালিয়াকৈর,গাজীপুর।', 1, 'Mamber-02\r\nName: Sohanur Rahman. Phone:01811865715. NID:8216741267. Date of Birth:16-MAR-1995. \r\nOccupation & Institute Name:চাকুরী ব্রাক ব্যাংক দক্ষিণখান শাখা। Permanent Address: বাসা:৫১/০৪.গ্রাম:হাজী-সলিমুল্লাহ,শ্যামপুর(অংশ),ডাকঘর:ফরিদাবাদ-১২০৪,থানা:কদমতলী,ঢাকা। Emergency Contact:বাবা মোবাইল:01717076256', '2025-01-13 01:23:46', '2025-01-17 14:08:48'),
(2, 2, 'MD. ASHIEK AHAMED.', NULL, '2691650146968', '01834050935', 'male', '1988-05-31', NULL, 'চাকুরী ATS ফেশন গারমেন্স।', 'ATS ফেশন গারমেন্স।', 'স্ত্রী মোবাইল:01734421027', '1736754569.pdf', 'গ্রাম:শাহপুর আমলাসদর, ডাকঘর:মন্ডলপাড়া, থানা:মিরপুর, কুষ্টিয়া।', 1, 'Mamber-02\r\nName: Md. Naim Uddin. Phone:01610763021. NID:3314902085. Date of Birth:09-JUN-2001. \r\nOccupation & Institute Name:চাকুরী কল সেন্টার উত্তরা সেক্টর-০৪ রোড-০১, বাসা-১০।, Permanent Address: গ্রাম:রানী শিমুল,দক্ষণপাড়া, ডাকঘর:শ্রীবর্দী, থানা:শ্রীবর্দী,শেরপুর। Emergency Contact:বাবা মোবাইল:01931844366.', '2025-01-13 01:49:29', '2025-01-13 01:52:46'),
(3, 2, 'MD. JAHIDUL ISLAM', NULL, '0', '01737699194', 'male', '1984-01-01', '19844421604145925', 'চাকুরী', 'UCB BANK GUN MANE দক্ষিনখান ঢাকা ১২৩০।', 'বাবা মোবাইল:01747243737', '1736756488.pdf', 'গ্রাম:বেপারীপাড়া,ডাকঘর:ঝিনাইদহ-৭৩০০,থানা:ঝিনাইদহ সদর,খুলনা।', 1, 'Mamber-02\r\nName: Akram. Phone:01706351562. NID:7357184642. Date of Birth:17-JUL-1983. \r\nOccupation & Institute Name:রাইড শেয়ার।, Permanent Address: গ্রাম:পশ্চিমপাড়া, ডাকঘর:কুমিরাদহ-৭৩২০,থানা:শেলকুপা,ঝিনাইদহ। Emergency Contact:বাবা মোবাইল:01732611525', '2025-01-13 02:21:28', '2025-01-13 02:21:28'),
(4, 2, 'MD. EMDADUL HAQUE', NULL, '19876116516000088', '01916573988', 'male', '1987-03-02', NULL, 'চাকুরী', 'ATS Jeans wear Pvt: মোল্লারটেক।', 'মা মোবাইল:01734815793.', '1736758235.pdf', 'কোনা গাঁও, থানা:মুক্তাগাছা, জেলা:ময়মনসিংহ।', 1, NULL, '2025-01-13 02:50:35', '2025-01-17 13:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `renter_id` bigint(20) UNSIGNED NOT NULL,
  `rent_date` date NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `electracity_bill` decimal(10,2) DEFAULT NULL,
  `water_bill` decimal(10,2) DEFAULT NULL,
  `gas_bill` decimal(10,2) DEFAULT NULL,
  `gatmanbill` decimal(10,2) DEFAULT NULL,
  `lift_bill` decimal(10,2) DEFAULT NULL,
  `car_reg_no` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `garage_bill` decimal(10,2) DEFAULT NULL,
  `service_charge` decimal(10,2) DEFAULT NULL,
  `advance` decimal(10,2) DEFAULT NULL,
  `member` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `user_id`, `renter_id`, `rent_date`, `house_id`, `floor_id`, `unit_id`, `monthly_rent`, `electracity_bill`, `water_bill`, `gas_bill`, `gatmanbill`, `lift_bill`, `car_reg_no`, `quantity`, `garage_bill`, `service_charge`, `advance`, `member`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2024-11-01', 1, 1, 1, 4800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, 0, '2025-01-13 01:26:47', '2025-01-18 01:20:55'),
(2, 2, 2, '2024-07-01', 1, 1, 2, 4000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, 1, '2025-01-13 02:29:23', '2025-01-13 02:38:56'),
(3, 2, 3, '2024-10-01', 1, 1, 3, 4800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, 1, '2025-01-13 02:40:13', '2025-01-13 02:40:13'),
(4, 2, 4, '2024-11-01', 1, 1, 4, 2250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, 0, '2025-01-13 03:03:08', '2025-01-14 00:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `rent_adjustments`
--

CREATE TABLE `rent_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rent_id` bigint(20) UNSIGNED NOT NULL,
  `renter_id` bigint(20) UNSIGNED NOT NULL,
  `adjustment_date` date NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `electracity_bill` decimal(10,2) DEFAULT NULL,
  `water_bill` decimal(10,2) DEFAULT NULL,
  `gas_bill` decimal(10,2) DEFAULT NULL,
  `gatmanbill` decimal(10,2) DEFAULT NULL,
  `lift_bill` decimal(10,2) DEFAULT NULL,
  `garage_bill` decimal(10,2) DEFAULT NULL,
  `service_charge` decimal(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rent_adjustments`
--

INSERT INTO `rent_adjustments` (`id`, `user_id`, `rent_id`, `renter_id`, `adjustment_date`, `month`, `year`, `monthly_rent`, `electracity_bill`, `water_bill`, `gas_bill`, `gatmanbill`, `lift_bill`, `garage_bill`, `service_charge`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2025-01-13', 11, 2024, 4800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 01:26:47', '2025-01-13 02:30:51'),
(2, 2, 2, 2, '2025-01-13', 7, 2024, 4000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 02:29:23', '2025-01-13 02:41:52'),
(3, 2, 3, 3, '2025-01-13', 10, 2024, 4800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 02:40:13', '2025-01-13 02:40:13'),
(4, 2, 4, 4, '2025-01-14', 11, 2024, 2250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 03:03:08', '2025-01-14 00:23:38'),
(6, 2, 1, 1, '2025-02-01', 2, 2025, 4500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 06:56:53', '2025-01-13 06:56:53'),
(7, 2, 1, 1, '2025-02-01', 2, 2025, 4500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 07:25:25', '2025-01-13 07:25:25'),
(8, 2, 1, 1, '2025-02-01', 2, 2025, 4800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13 07:27:31', '2025-01-13 07:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `rent_collection_histories`
--

CREATE TABLE `rent_collection_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monthly_rent_id` bigint(20) UNSIGNED NOT NULL,
  `rent_id` bigint(20) UNSIGNED NOT NULL,
  `amount_paid` decimal(40,2) NOT NULL,
  `payment_date` date NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `invoice` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:partial payment \r\n2:full payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(2, 'admin', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(3, 'user', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(4, 'agent', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(5, 'support', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(6, 'member', 'web', '2020-03-12 14:19:59', '2020-03-12 14:19:59'),
(7, 'Employee', 'web', '2023-09-09 11:52:30', '2023-09-09 11:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(4, 2),
(4, 3),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 2),
(11, 3),
(12, 2),
(12, 3),
(13, 2),
(13, 3),
(14, 2),
(14, 3),
(15, 2),
(15, 3),
(16, 2),
(16, 3);

-- --------------------------------------------------------

--
-- Table structure for table `salary_records`
--

CREATE TABLE `salary_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `payment_month` int(11) NOT NULL,
  `payment_year` int(11) NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `bonous` decimal(10,2) DEFAULT NULL,
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
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `fav_icon` varchar(255) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `short_description` mediumtext NOT NULL,
  `helpline_number` varchar(255) DEFAULT NULL,
  `contract_number` varchar(255) NOT NULL,
  `institute_email` varchar(255) NOT NULL,
  `principle_email` varchar(255) DEFAULT NULL,
  `messenger_link` varchar(255) NOT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `address` mediumtext NOT NULL,
  `map` mediumtext DEFAULT NULL,
  `copyright_text` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `meta_url` varchar(255) DEFAULT NULL,
  `meta_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `logo`, `fav_icon`, `site_title`, `short_description`, `helpline_number`, `contract_number`, `institute_email`, `principle_email`, `messenger_link`, `fb_link`, `instagram_link`, `youtube_link`, `linkedin`, `address`, `map`, `copyright_text`, `meta_title`, `meta_description`, `keywords`, `meta_url`, `meta_img`, `created_at`, `updated_at`) VALUES
(1, 2, '1733653397_logo.jpg', '1733653170_favicon.webp', 'asifdafd', 'asif hossain', '01758040074', '01758040074', 'institute@gmail.com', 'asif@gmail.com', 'messenger.com', 'https://www.facebook.com/', 'http://localhost/Fabrilife/setting', 'Anim reprehenderit b', 'http://localhost/Fabrilife/setting', 'muktarpara sirajgong', NULL, 'asif@gmail.com', NULL, NULL, NULL, NULL, '1733653383_meta.jpg', NULL, '2024-12-08 04:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transactionable_id` int(11) DEFAULT NULL,
  `transactionable_type` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `sent_amount` int(11) DEFAULT NULL,
  `receive_amount` int(11) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `rent_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Avilable 1:Rented',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_id`, `house_id`, `floor_id`, `name`, `info`, `status`, `rent_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'ROOM NO :01', 'রুমের বৈশিষ্টঃ- রুমটি এটাস্ট বাথরুম লো-কমোড+বেসিং, রুমের পশ্চিম পাশে জানালা রয়েছে।', 1, 1, '2025-01-13 01:14:15', '2025-01-13 01:55:43'),
(2, 2, 1, 1, 'ROOM NO: 02', 'রুমের বৈশিষ্টঃ- সিঙ্গেল রুম, কমোন-বাথরুম, রুমের জানালা রুমের পশ্চিম দিকে।', 1, 1, '2025-01-13 01:54:36', '2025-01-13 02:29:23'),
(3, 2, 1, 1, 'ROOM NO: 03', 'রুমের বৈশিষ্টঃ- রুমটি এটাস্ট বাথরুম লো-কমোড+বেসিং, রুমের পূর্ব পাশে জানালা রয়েছে।', 1, 1, '2025-01-13 01:55:19', '2025-01-13 02:40:13'),
(4, 2, 1, 1, 'ROOM NO: 04', 'রুমের বৈশিষ্টঃ- সিঙ্গেল বড় রুম, কমোন-বাথরুম, রুমের পূর্ব ও দক্ষিণ দিকে ২টি জানালা রয়েছে ।', 1, 1, '2025-01-13 01:56:47', '2025-01-13 03:03:08'),
(5, 2, 1, 1, 'ROOM NO: 05', 'রুমের বৈশিষ্টঃ- সিঙ্গেল রুম, কমোন-বাথরুম, রুমের দক্ষিণ দিকে ১টি জানালা রয়েছে।', 1, 0, '2025-01-13 01:57:29', '2025-01-13 01:57:29'),
(6, 2, 1, 1, 'ROOM NO: 06', 'রুমের বৈশিষ্টঃ- রুমটি এটাস্ট বাথরুম লো-কমোড+বেসিং, রুমের পূর্ব পাশে ১টি জানালা রয়েছে।', 1, 0, '2025-01-13 02:07:12', '2025-01-13 02:07:12'),
(7, 2, 1, 1, 'ROOM NO: 07', 'রুমের বৈশিষ্টঃ- রুমটি এটাস্ট বাথরুম লো-কমোড+বেসিং, রুমের দক্ষিণ পাশে ১টি জানালা রয়েছে।', 1, 0, '2025-01-13 02:08:17', '2025-01-13 02:08:17'),
(8, 2, 1, 1, 'ROOM NO: 08', 'রুমের বৈশিষ্টঃ- সিঙ্গেল রুম, কমোন-বাথরুম, রুমের দক্ষিণ দিকে  ১টি বড় জানালা রয়েছে।', 1, 0, '2025-01-13 02:08:58', '2025-01-13 02:08:58'),
(9, 2, 1, 1, 'ROOM NO: 09', 'রুমের বৈশিষ্টঃ- সিঙ্গেল বড় রুম, কমোন-বাথরুম, রুমের পশ্চিম দিকে ১টি জানালা রয়েছে ।', 1, 0, '2025-01-13 02:09:48', '2025-01-13 02:09:48'),
(10, 2, 1, 1, 'ROOM NO: 40', 'রুমের বৈশিষ্টঃ- সিঙ্গেল বড় রুম, কমোন-বাথরুম, রুমের পশ্চিম দিকে ১টি জানালা রয়েছে ।', 1, 0, '2025-01-13 02:11:21', '2025-01-13 02:11:21'),
(11, 2, 1, 1, 'ROOM NO: 41', 'রুমের বৈশিষ্টঃ- সিঙ্গেল রুম, কমোন-বাথরুম, রুমের পূর্ব দিকে ১টি জানালা রয়েছে।', 1, 0, '2025-01-13 02:12:05', '2025-01-13 02:12:05'),
(12, 2, 1, 1, 'ROOM NO: 42', 'রুমের বৈশিষ্টঃ- সিঙ্গেল রুম, কমোন-বাথরুম, রুমের পূর্ব  দিকে ১টি জানালা রয়েছে ।', 1, 0, '2025-01-13 02:12:30', '2025-01-13 02:12:30'),
(13, 2, 1, 1, 'ROOM NO: 04', 'রুমের বৈশিষ্টঃ- সিঙ্গেল বড় রুম, কমোন-বাথরুম, রুমের পূর্ব ও দক্ষিণ দিকে ২টি জানালা রয়েছে ।', 1, 0, '2025-01-13 03:05:19', '2025-01-17 13:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$xAKfG4nGD0u5D8T2dRP5Iu6PHzw.t8sxjY9CBF3vYbGQuXO1L/Ioq', 'admin', NULL, NULL, NULL, 'QsdpsDIcIw68JoL5cL491QCr58k8s4b7rAsKVY9YDEaXmsQJOzFN2iLYLTxc', NULL, '2023-09-23 00:08:01', '2024-01-20 09:31:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_permissions`
--

CREATE TABLE `user_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_permissions`
--

INSERT INTO `user_has_permissions` (`permission_id`, `model_type`, `user_id`) VALUES
(2, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_statements`
--

CREATE TABLE `user_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rent_id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED DEFAULT NULL,
  `monthly_rent_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payable_amount` decimal(40,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_statements`
--

INSERT INTO `user_statements` (`id`, `user_id`, `rent_id`, `collection_id`, `monthly_rent_id`, `payment_method_id`, `payable_amount`, `amount_paid`, `balance`, `payment_date`, `created_at`, `updated_at`) VALUES
(6, 2, 1, NULL, 1, 1, NULL, 4800.00, 0.00, '2025-01-05', '2025-01-13 03:14:20', '2025-01-13 03:14:20'),
(13, 2, 2, NULL, 2, 1, NULL, 2500.00, 4000.00, '2025-01-13', '2025-01-13 06:26:43', '2025-01-13 06:26:43'),
(27, 2, 3, NULL, 11, 1, NULL, 300.00, 10600.00, '2025-01-21', '2025-01-13 07:42:54', '2025-01-13 07:42:54'),
(28, 2, 4, NULL, 12, 1, NULL, 2250.00, 0.00, '2025-01-20', '2025-01-14 00:23:09', '2025-01-14 00:23:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transactions_user_id_foreign` (`user_id`),
  ADD KEY `bank_transactions_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_user_id_foreign` (`user_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `floors_user_id_foreign` (`user_id`),
  ADD KEY `floors_house_id_foreign` (`house_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `houses_user_id_foreign` (`user_id`);

--
-- Indexes for table `income_expences`
--
ALTER TABLE `income_expences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_expences_user_id_foreign` (`user_id`),
  ADD KEY `income_expences_income_expence_category_id_foreign` (`income_expence_category_id`),
  ADD KEY `income_expences_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `income_expences_house_id_foreign` (`house_id`);

--
-- Indexes for table `income_expence_categories`
--
ALTER TABLE `income_expence_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `income_expence_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `monthly_rents`
--
ALTER TABLE `monthly_rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthly_rents_rent_id_foreign` (`rent_id`),
  ADD KEY `monthly_rents_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_methods_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_categories`
--
ALTER TABLE `permission_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phonebooks`
--
ALTER TABLE `phonebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phonebooks_user_id_foreign` (`user_id`),
  ADD KEY `phonebooks_category_id_foreign` (`category_id`);

--
-- Indexes for table `remainders`
--
ALTER TABLE `remainders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remainders_user_id_foreign` (`user_id`),
  ADD KEY `remainders_renter_id_foreign` (`renter_id`);

--
-- Indexes for table `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `renters_user_id_foreign` (`user_id`);

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rents_floor_id_foreign` (`floor_id`),
  ADD KEY `rents_house_id_foreign` (`house_id`),
  ADD KEY `rents_renter_id_foreign` (`renter_id`),
  ADD KEY `rents_unit_id_foreign` (`unit_id`),
  ADD KEY `rents_user_id_foreign` (`user_id`);

--
-- Indexes for table `rent_adjustments`
--
ALTER TABLE `rent_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_adjustments_rent_id_foreign` (`rent_id`),
  ADD KEY `rent_adjustments_renter_id_foreign` (`renter_id`),
  ADD KEY `rent_adjustments_user_id_foreign` (`user_id`);

--
-- Indexes for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_id` (`rent_id`),
  ADD KEY `monthly_rents_foreign` (`monthly_rent_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salary_records`
--
ALTER TABLE `salary_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_records_user_id_foreign` (`user_id`),
  ADD KEY `salary_records_employee_id_foreign` (`employee_id`),
  ADD KEY `salary_records_payment_method_id_foreign` (`payment_method_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_user_id_foreign` (`user_id`),
  ADD KEY `units_house_id_foreign` (`house_id`),
  ADD KEY `units_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_has_permissions`
--
ALTER TABLE `user_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`user_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`user_id`,`model_type`);

--
-- Indexes for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`role_id`,`user_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`user_id`,`model_type`);

--
-- Indexes for table `user_statements`
--
ALTER TABLE `user_statements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_statements_monthly_rent_id_foreign` (`monthly_rent_id`),
  ADD KEY `user_statements_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `user_statements_rent_id_foreign` (`rent_id`),
  ADD KEY `user_statements_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_expences`
--
ALTER TABLE `income_expences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_expence_categories`
--
ALTER TABLE `income_expence_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `monthly_rents`
--
ALTER TABLE `monthly_rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permission_categories`
--
ALTER TABLE `permission_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phonebooks`
--
ALTER TABLE `phonebooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remainders`
--
ALTER TABLE `remainders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rent_adjustments`
--
ALTER TABLE `rent_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salary_records`
--
ALTER TABLE `salary_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_statements`
--
ALTER TABLE `user_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `floors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `income_expences`
--
ALTER TABLE `income_expences`
  ADD CONSTRAINT `income_expences_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `income_expences_income_expence_category_id_foreign` FOREIGN KEY (`income_expence_category_id`) REFERENCES `income_expence_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `income_expences_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `income_expences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `income_expence_categories`
--
ALTER TABLE `income_expence_categories`
  ADD CONSTRAINT `income_expence_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `monthly_rents`
--
ALTER TABLE `monthly_rents`
  ADD CONSTRAINT `monthly_rents_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `monthly_rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `phonebooks`
--
ALTER TABLE `phonebooks`
  ADD CONSTRAINT `phonebooks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phonebooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `remainders`
--
ALTER TABLE `remainders`
  ADD CONSTRAINT `remainders_renter_id_foreign` FOREIGN KEY (`renter_id`) REFERENCES `renters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `remainders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `renters`
--
ALTER TABLE `renters`
  ADD CONSTRAINT `renters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rents_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rents_renter_id_foreign` FOREIGN KEY (`renter_id`) REFERENCES `renters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rents_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rent_adjustments`
--
ALTER TABLE `rent_adjustments`
  ADD CONSTRAINT `rent_adjustments_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_adjustments_renter_id_foreign` FOREIGN KEY (`renter_id`) REFERENCES `renters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_adjustments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  ADD CONSTRAINT `monthly_rents_foreign` FOREIGN KEY (`monthly_rent_id`) REFERENCES `monthly_rents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_id` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `salary_records`
--
ALTER TABLE `salary_records`
  ADD CONSTRAINT `salary_records_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_records_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `units_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_statements`
--
ALTER TABLE `user_statements`
  ADD CONSTRAINT `user_statements_monthly_rent_id_foreign` FOREIGN KEY (`monthly_rent_id`) REFERENCES `monthly_rents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_statements_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_statements_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_statements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
