-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2025 at 06:44 AM
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

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `user_id`, `payment_method_id`, `reference`, `amount`, `date`, `image`, `note`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '133', 2.00, '1973-02-04 00:00:00', '1734605702.png', 'Quia enim vitae sunt', 1, '2024-12-19 04:55:02', '2024-12-19 04:55:02'),
(2, 2, 2, '192', 97.00, '2010-07-16 00:00:00', '1734606584.jpg', 'Eum perferendis Nam', 2, '2024-12-19 05:09:44', '2024-12-19 05:09:44'),
(3, 2, 1, '674', 59.00, '1987-11-29 00:00:00', NULL, 'Numquam amet explic', 1, '2024-12-19 05:24:05', '2024-12-19 05:24:05');

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

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Manager', '2024-12-12 05:19:39', '2024-12-12 05:19:39'),
(2, 2, 'Gateman', '2024-12-12 05:19:47', '2024-12-12 05:19:47');

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

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `designation_id`, `name`, `email`, `phone`, `image`, `salary`, `join_date`, `join_month`, `join_year`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'AB Rohim', 'rohim@gmail.com', '01580431245', '1734002478.jpg', 15500.00, '2010-12-25 00:00:00', 12, 2010, NULL, '2024-12-12 05:21:18', '2024-12-12 05:23:42'),
(2, 2, 2, 'kuddus', 'kuddus@gmail.com', '01231891069', '1734002540.jpg', 10200.00, '2016-12-24 00:00:00', 12, 2016, NULL, '2024-12-12 05:22:20', '2024-12-12 05:23:51');

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
(1, 2, 1, 'Ground Floor', NULL, 1, '2024-12-12 03:45:14', '2024-12-12 03:45:14'),
(2, 2, 1, '1st Floor', NULL, 1, '2024-12-12 03:45:38', '2024-12-12 03:45:38'),
(3, 2, 1, '2nd Floor', 'This is master bari second floor.', 1, '2024-12-12 03:49:22', '2024-12-12 03:49:22'),
(4, 2, 2, 'only floor', 'There are have only one floor', 1, '2024-12-12 04:21:17', '2024-12-12 04:21:17');

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
(1, 2, 'Master_bari', 'Md Asif Hossain', '01758040074', '496', 'Teashia, Belkuchi Sirajgonj. house no. 496.', 'Bangladesh', 5000, NULL, 1, '2024-12-12 03:41:27', '2024-12-12 03:41:27'),
(2, 2, 'Fokir\'s house', 'Md Anamul Hasan', '01812925072', '495', 'Belkuchi Sirajganj.', 'Bangladesh', 14000, NULL, 1, '2024-12-12 03:44:26', '2024-12-12 03:44:26');

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

--
-- Dumping data for table `income_expences`
--

INSERT INTO `income_expences` (`id`, `user_id`, `income_expence_category_id`, `payment_method_id`, `house_id`, `date`, `reference`, `income_amount`, `expence_amount`, `note`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, NULL, '2024-12-12 00:00:00', 'Arnob gosh', 4000.00, NULL, 'thik somoy moto pawa jacce na tk', 1, '2024-12-12 05:18:38', '2024-12-12 05:18:38'),
(2, 2, 1, 1, NULL, '2024-12-12 00:00:00', 'Arnob gosh', NULL, 500.00, 'Bathroom er gizer', 2, '2024-12-12 05:19:26', '2024-12-12 05:19:26');

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
(1, 2, 'Repair', 1, '2024-12-12 05:15:02', '2024-12-12 05:15:02'),
(2, 2, 'Rent', 1, '2024-12-12 05:15:11', '2024-12-12 05:15:11');

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
(37, '2024_12_21_042241_create_user_statements_table', 20);

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
(1, 2, 1, 11, 2024, 8000.00, 0.00, 4000.00, NULL, '2024-12-12 00:00:00', 1, '2024-12-12 05:05:15', '2024-12-12 05:10:33'),
(2, 2, 2, 12, 2024, 5000.00, 0.00, 2000.00, NULL, '2024-12-12 00:00:00', 1, '2024-12-12 05:05:30', '2024-12-12 05:13:40'),
(3, 2, 1, 12, 2024, 8000.00, 0.00, 0.00, NULL, '2024-12-21 00:00:00', 0, '2024-12-21 00:01:23', '2024-12-21 00:01:23'),
(4, 2, 3, 12, 2024, 13000.00, 0.00, 10050.00, NULL, '2024-12-21 00:00:00', 1, '2024-12-21 00:01:23', '2025-01-01 05:35:45'),
(5, 2, 4, 12, 2024, 12500.00, 0.00, 2500.00, NULL, '2024-12-21 00:00:00', 1, '2024-12-21 00:01:23', '2024-12-24 07:06:24');

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
(1, 2, 'Bkash', NULL, '01758040074', 1250.00, '2024-12-12 00:00:00', '2024-12-12 04:42:23', '2024-12-12 04:42:23'),
(2, 2, 'Nagad', NULL, '01758040074', 2000.00, '2024-12-12 00:00:00', '2024-12-12 04:56:51', '2024-12-12 04:56:51');

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

--
-- Dumping data for table `remainders`
--

INSERT INTO `remainders` (`id`, `user_id`, `renter_id`, `note`, `date`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 'Non eveniet quos au', '2025-12-19 00:00:00', 1, '2024-12-18 04:39:50', '2024-12-18 04:39:50'),
(3, 2, 1, 'Et unde lorem dolore', '2011-04-28 00:00:00', 2, '2024-12-18 04:44:28', '2024-12-18 04:44:40'),
(5, 2, NULL, 'newly worked in here', '2024-12-23 00:00:00', 1, '2024-12-23 09:49:54', '2024-12-23 09:49:54'),
(6, 2, 5, 'Dicta aut necessitat', '2001-02-06 00:00:00', 1, '2024-12-23 09:50:20', '2024-12-23 09:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `renters`
--

CREATE TABLE `renters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nid` varchar(255) NOT NULL,
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
(1, 2, 'Arnob Vai', 'arnob@gmail.com', '6464600151', '015804312445', 'male', '1997-06-19', '1990881154109650', 'Developer', 'It Plan BD', NULL, NULL, 'Kalibar sirajgonj sadar', 1, NULL, '2024-12-12 05:01:35', '2024-12-12 05:01:35'),
(2, 2, 'Abdullah shake', NULL, '6368875464', '01717404302', 'male', '1970-01-01', NULL, 'Laravel Developer', NULL, NULL, NULL, 'Arongail tarash', 1, NULL, '2024-12-12 05:02:44', '2024-12-12 05:02:44'),
(3, 2, 'Beverly Bush', 'dizelap@mailinator.com', '19', '+1 (732) 766-9662', 'male', '1999-04-17', '857', 'Omnis mollitia cupid', 'Serina Pruitt', 'Pariatur Aliquip an', NULL, 'Voluptatibus id eve', 1, NULL, '2024-12-23 05:45:30', '2024-12-23 05:45:30'),
(4, 2, 'Britanni Greene', 'jowurixune@mailinator.com', '97', '+1 (248) 173-3918', 'female', '1991-08-22', '272', 'Magna molestias inci', 'Rooney Hines', 'Quae exercitationem', NULL, 'Quas quod quia cumqu', 1, 'Consequat Est deser', '2024-12-23 05:46:15', '2024-12-23 05:46:15'),
(5, 2, 'Meghan Jackson', 'xujimyw@mailinator.com', '52', '+1 (278) 166-3856', 'other', '1973-04-05', '940', 'Qui commodi labore q', 'Shellie Mccall', 'Doloribus quo est qu', '1734937004.pdf', 'Non eligendi omnis q', 1, 'Aliquam veniam eaqu', '2024-12-23 06:10:52', '2024-12-23 06:59:25');

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
(1, 2, 1, '2024-12-12', 1, 2, 2, 8000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-12 05:03:37', '2024-12-12 05:03:37'),
(2, 2, 2, '2024-12-01', 2, 4, 5, 5000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-12-12 05:04:49', '2024-12-21 11:46:41'),
(3, 2, 2, '2024-12-19', 1, 2, 3, 12500.00, 200.00, 300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-18 23:20:19', '2024-12-18 23:28:49'),
(4, 2, 1, '2024-12-01', 1, 2, 3, 12500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-18 23:22:17', '2024-12-18 23:27:03'),
(5, 2, 4, '1975-09-26', 1, 2, 3, 1.00, 64.00, 52.00, 84.00, 94.00, 26.00, '47', 347, 79.00, 7.00, 86.00, NULL, 0, '2024-12-23 05:47:11', '2024-12-23 07:18:38'),
(6, 2, 1, '2019-06-16', 1, 2, 3, 9.00, 97.00, 80.00, 97.00, 89.00, 42.00, '15', 51, 65.00, 42.00, 65.00, 3.00, 1, '2024-12-23 07:19:10', '2024-12-23 07:23:15'),
(7, 2, 4, '1991-12-30', 1, 3, 4, 10.00, 26.00, 87.00, 63.00, 31.00, 30.00, '9', 505, 98.00, 14.00, 11.00, 44.00, 1, '2024-12-25 05:11:14', '2024-12-25 05:11:14'),
(8, 2, 5, '1980-02-25', 1, 3, 6, 12.00, 8.00, 55.00, 29.00, 24.00, 57.00, '84', 882, 39.00, 23.00, 51.00, 12.00, 0, '2025-01-01 04:42:06', '2025-01-01 04:42:28');

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
  `invoice` int(20) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:partial payment \r\n2:full payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rent_collection_histories`
--

INSERT INTO `rent_collection_histories` (`id`, `monthly_rent_id`, `rent_id`, `amount_paid`, `payment_date`, `month`, `year`, `payment_method`, `invoice`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4000.00, '2024-12-12', 1, 2025, 'Bkash', 1734001833, 'half paid', 1, '2024-12-12 05:10:33', '2024-12-12 05:10:33'),
(2, 2, 1, 2000.00, '2024-12-12', 3, 2024, 'Nagad', 1734002020, 'Beton pay e nai', 1, '2024-12-12 05:13:40', '2024-12-12 05:13:40'),
(3, 4, 3, 10000.00, '2024-12-21', 2, 2024, 'Bkash', 1734775006, 'onk deri hoiya gelo', 1, '2024-12-21 03:56:46', '2024-12-21 03:56:46'),
(4, 5, 4, 500.00, '2024-12-24', 4, 2024, 'Bkash', 1735019476, 'Labore modi et lorem', 1, '2024-12-24 05:51:16', '2024-12-24 05:51:16'),
(5, 5, 4, 2000.00, '2024-12-24', 5, 2025, 'Bkash', 1735023983, 'onk note e ache bole gelam na', 1, '2024-12-24 07:06:23', '2024-12-24 07:06:23'),
(6, 4, 3, 50.00, '2009-06-03', 4, 2029, 'Bkash', 1735709745, 'Magna consequat Vel', 1, '2025-01-01 05:35:45', '2025-01-01 05:35:45');

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

--
-- Dumping data for table `salary_records`
--

INSERT INTO `salary_records` (`id`, `user_id`, `employee_id`, `payment_method_id`, `payment_month`, `payment_year`, `salary_amount`, `status`, `payment_date`, `note`, `bonous`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 12, 2024, 2000.00, 1, '2024-12-12 00:00:00', NULL, NULL, '2024-12-12 05:24:26', '2024-12-12 05:24:26'),
(2, 2, 2, 2, 12, 2024, 10000.00, 1, '2024-12-12 00:00:00', NULL, NULL, '2024-12-12 05:24:48', '2024-12-12 05:24:48');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('I5IHyDM2h6psFA4rH1bth71WbCV5DjwysLNWentO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGMxYTE3ZnR1elk0eFdIMnBhRXByT2JDUGdpOVZZSnlJbDdsRzNTVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1698552730);

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

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 1, 'Avijit\'s Team', 1, '2023-09-21 02:34:04', '2023-09-21 02:34:04'),
(2, 2, 'Admin\'s Team', 1, '2023-09-23 00:08:01', '2023-09-23 00:08:01');

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

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `payment_method_id`, `transactionable_id`, `transactionable_type`, `type`, `sent_amount`, `receive_amount`, `reference`, `note`, `transaction_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'App\\Models\\PaymentMethod', 0, NULL, 1250, NULL, NULL, '2024-12-12 10:42:23', '2024-12-12 04:42:23', '2024-12-12 04:42:23'),
(2, 2, 2, 2, 'App\\Models\\PaymentMethod', 0, NULL, 2000, NULL, NULL, '2024-12-12 10:56:51', '2024-12-12 04:56:51', '2024-12-12 04:56:51'),
(3, 2, 1, 1, 'App\\Models\\RentCollectionHistory', 0, NULL, 4000, NULL, 'half paid', '2024-12-12 11:10:33', '2024-12-12 05:10:33', '2024-12-12 05:10:33'),
(4, 2, 2, 2, 'App\\Models\\RentCollectionHistory', 0, NULL, 2000, NULL, 'Beton pay e nai', '2024-12-12 11:13:40', '2024-12-12 05:13:40', '2024-12-12 05:13:40'),
(5, 2, 2, 1, 'App\\Models\\IncomeExpence', 0, NULL, 4000, 'Arnob gosh', 'thik somoy moto pawa jacce na tk', '2024-12-12 11:18:38', '2024-12-12 05:18:38', '2024-12-12 05:18:38'),
(6, 2, 1, 2, 'App\\Models\\IncomeExpence', 1, 500, NULL, 'Arnob gosh', 'Bathroom er gizer', '2024-12-12 11:19:26', '2024-12-12 05:19:26', '2024-12-12 05:19:26'),
(7, 2, 1, 1, 'App\\Models\\SalaryRecord', 1, 2000, NULL, NULL, NULL, '2024-12-12 11:24:26', '2024-12-12 05:24:26', '2024-12-12 05:24:26'),
(8, 2, 2, 2, 'App\\Models\\SalaryRecord', 1, 10000, NULL, NULL, NULL, '2024-12-12 11:24:48', '2024-12-12 05:24:48', '2024-12-12 05:24:48'),
(9, 2, 1, 3, 'App\\Models\\BankTransaction', 1, 59, NULL, '674', 'Numquam amet explic', '2024-12-19 11:24:05', '2024-12-19 05:24:05', '2024-12-19 05:24:05'),
(11, 2, 1, 3, 'App\\Models\\RentCollectionHistory', 0, NULL, 10000, NULL, 'onk deri hoiya gelo', '2024-12-21 09:56:47', '2024-12-21 03:56:47', '2024-12-21 03:56:47'),
(12, 2, 1, 4, 'App\\Models\\RentCollectionHistory', 0, NULL, 500, NULL, 'Labore modi et lorem', '2024-12-24 11:51:16', '2024-12-24 05:51:16', '2024-12-24 05:51:16'),
(13, 2, 1, 5, 'App\\Models\\RentCollectionHistory', 0, NULL, 2000, NULL, 'onk note e ache bole gelam na', '2024-12-24 13:06:23', '2024-12-24 07:06:24', '2024-12-24 07:06:24'),
(14, 2, 1, 6, 'App\\Models\\RentCollectionHistory', 0, NULL, 50, NULL, 'Magna consequat Vel', '2025-01-01 11:35:45', '2025-01-01 05:35:45', '2025-01-01 05:35:45');

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
  `rent_status` tinyint(9) NOT NULL DEFAULT 0 COMMENT '0:Avilable 1:Rented',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_id`, `house_id`, `floor_id`, `name`, `info`, `status`, `rent_status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'Garage', 'Left side garage', 1, 1, '2024-12-12 04:29:57', '2024-12-12 04:29:57'),
(2, 2, 1, 2, '1A', 'THis is An-nur room', 1, 1, '2024-12-12 04:32:48', '2024-12-12 04:32:48'),
(3, 2, 1, 2, '1B', 'THis is Nafiz room', 1, 1, '2024-12-12 04:33:14', '2024-12-23 07:19:10'),
(4, 2, 1, 3, 'Belkuni', NULL, 1, 1, '2024-12-12 04:33:35', '2024-12-25 05:11:14'),
(5, 2, 2, 4, 'Full Unit', NULL, 1, 1, '2024-12-12 04:33:54', '2024-12-21 11:46:41'),
(6, 2, 1, 3, 'Alden Marsh', 'Quia autem id duis e', 1, 0, '2025-01-01 04:41:49', '2025-01-01 04:42:28');

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
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$xAKfG4nGD0u5D8T2dRP5Iu6PHzw.t8sxjY9CBF3vYbGQuXO1L/Ioq', 'admin', NULL, NULL, NULL, 'Scinn3ybWpqoPSNok82iAlOF06L8ynxrOawaX6GD7tYzSCbmoeBf5mme0oxr', NULL, '2023-09-23 00:08:01', '2024-01-20 09:31:20', NULL);

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
  `monthly_rent_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_statements`
--

INSERT INTO `user_statements` (`id`, `user_id`, `rent_id`, `monthly_rent_id`, `payment_method_id`, `amount_paid`, `balance`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 4, 1, 10000.00, 3000.00, '2024-12-21', '2024-12-21 03:56:47', '2024-12-21 03:56:47'),
(2, 2, 4, 5, 1, 500.00, 12000.00, '2024-12-24', '2024-12-24 05:51:16', '2024-12-24 05:51:16'),
(3, 2, 4, 5, 1, 2000.00, 10000.00, '2024-12-24', '2024-12-24 07:06:24', '2024-12-24 07:06:24'),
(4, 2, 3, 4, 1, 50.00, 2950.00, '2009-06-03', '2025-01-01 05:35:45', '2025-01-01 05:35:45');

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
  ADD KEY `monthly_rents_user_id_foreign` (`user_id`),
  ADD KEY `monthly_rents_rent_id_foreign` (`rent_id`);

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
  ADD KEY `rents_user_id_foreign` (`user_id`),
  ADD KEY `rents_renter_id_foreign` (`renter_id`),
  ADD KEY `rents_house_id_foreign` (`house_id`),
  ADD KEY `rents_floor_id_foreign` (`floor_id`),
  ADD KEY `rents_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_id` (`rent_id`);

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
  ADD KEY `user_statements_user_id_foreign` (`user_id`),
  ADD KEY `user_statements_rent_id_foreign` (`rent_id`),
  ADD KEY `user_statements_monthly_rent_id_foreign` (`monthly_rent_id`),
  ADD KEY `user_statements_payment_method_id_foreign` (`payment_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `monthly_rents`
--
ALTER TABLE `monthly_rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salary_records`
--
ALTER TABLE `salary_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_statements`
--
ALTER TABLE `user_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bank_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `floors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `income_expences`
--
ALTER TABLE `income_expences`
  ADD CONSTRAINT `income_expences_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_expences_income_expence_category_id_foreign` FOREIGN KEY (`income_expence_category_id`) REFERENCES `income_expence_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_expences_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `income_expences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `income_expence_categories`
--
ALTER TABLE `income_expence_categories`
  ADD CONSTRAINT `income_expence_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monthly_rents`
--
ALTER TABLE `monthly_rents`
  ADD CONSTRAINT `monthly_rents_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `monthly_rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `remainders_renter_id_foreign` FOREIGN KEY (`renter_id`) REFERENCES `renters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `remainders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `renters`
--
ALTER TABLE `renters`
  ADD CONSTRAINT `renters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_renter_id_foreign` FOREIGN KEY (`renter_id`) REFERENCES `renters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rent_collection_histories`
--
ALTER TABLE `rent_collection_histories`
  ADD CONSTRAINT `rent_id` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_records`
--
ALTER TABLE `salary_records`
  ADD CONSTRAINT `salary_records_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_records_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salary_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `units_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_statements`
--
ALTER TABLE `user_statements`
  ADD CONSTRAINT `user_statements_monthly_rent_id_foreign` FOREIGN KEY (`monthly_rent_id`) REFERENCES `monthly_rents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_statements_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_statements_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_statements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
