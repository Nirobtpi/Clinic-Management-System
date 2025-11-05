-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2025 at 05:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `reset_password_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `super_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `zip_code`, `country`, `about_me`, `photo`, `birthday`, `email_verified_at`, `reset_password_token`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `super_admin`) VALUES
(1, 'Admin', 'admin@gmail.com', '01773443625', 'Dhaka Mirpur', 'Dhaka', 'Mirpur', '22434', 'Bangladesh', 'I am admin', 'uploads/admin//1760291488_68ebeaa0a9273.jpg', '2007-09-06', NULL, NULL, '$2y$12$UiVzGiP17qbh5u1hRP/I2ecG94jk0bYahiRaFz8liyST6XtYOqcDy', NULL, '2025-08-08 07:41:30', '2025-10-12 17:51:28', 0, 1),
(2, 'Admin 2', 'admin2@gmail.com', NULL, 'Mirpur Dhaka', 'Dhaka', 'Mirpur', '22434', 'Bangladesh', NULL, 'uploads/admin/admin-image-1757520809.jpeg', '2003-08-01', NULL, NULL, '$2y$12$g9WLAF4F4DkaWp2prL..De94pGiFGjNCxeKtZE6cTD1VIQGCSGgG6', NULL, '2025-09-10 16:13:29', '2025-09-10 16:19:34', 0, 0),
(3, 'Admin 3', 'admin3@gmail.com', NULL, 'Dhaka Mirpur', NULL, NULL, NULL, NULL, NULL, 'uploads/admin/admin-image-1757691379.jpeg', '2004-09-01', NULL, NULL, '$2y$12$vDi.ZwxyPUw6SazPyS.5mOCuNZCtcsjGp2aAdDPeWtJN82p8fD2kG', NULL, '2025-09-12 15:36:19', '2025-09-12 15:36:19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `clinic_id` int DEFAULT NULL,
  `fee` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint NOT NULL,
  `appointment_status` tinyint NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_number` int DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_ammount` decimal(5,2) DEFAULT NULL,
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `app_id`, `user_id`, `appointment_date`, `appointment_time`, `status`, `created_at`, `updated_at`, `doctor_id`, `clinic_id`, `fee`, `payment_method`, `payment_status`, `appointment_status`, `transaction_id`, `patient_number`, `phone_number`, `total_ammount`, `charge_id`) VALUES
(22, '#APTGOY3', 5, '2025-09-13', '17:00:00', 'cancelled', '2025-09-02 18:21:31', '2025-09-05 14:39:56', 1, 1, 40.00, 'stripe', 2, 1, 'txn_3S2ypj8IzKHLKgAR0piMGvnY', 2, '018451855', 40.00, 'ch_3S2ypj8IzKHLKgAR0wtHijJA'),
(23, '#APT8878', 5, '2025-09-05', '08:00:00', 'pending', '2025-09-04 16:43:26', '2025-09-04 16:43:26', 1, 2, 40.00, 'mollie', 1, 1, 'tr_8cDgxRnpFedBk2hSUEkDJ', 2, '018451855', 40.00, 'tr_8cDgxRnpFedBk2hSUEkDJ'),
(24, '#APT6040', 5, '2025-09-06', '08:00:00', 'pending', '2025-09-05 14:21:08', '2025-09-05 14:21:08', 2, 1, 70.00, 'mollie', 1, 1, 'tr_AgAqjCRgAKpVtAqAAZnDJ', 2, '018451855', 70.00, 'tr_AgAqjCRgAKpVtAqAAZnDJ'),
(25, '#APT1490', 5, '2025-09-12', '17:00:00', 'cancelled', '2025-09-05 14:37:05', '2025-09-05 14:37:34', 1, 2, 60.00, 'mollie', 2, 1, 'tr_GHzD9PumPDgoUDTSxbnDJ', 3, '018451855', 60.00, 'tr_GHzD9PumPDgoUDTSxbnDJ'),
(26, '#APT4890', 5, '2025-09-19', '10:30:00', 'cancelled', '2025-09-05 14:46:33', '2025-09-05 14:48:06', 1, 2, 51.00, 'mollie', 2, 1, 'tr_CkqD5AwSQr4xMdvWtcnDJ', 3, '018451855', 51.00, 'tr_CkqD5AwSQr4xMdvWtcnDJ'),
(27, '#APT3104', 5, '2025-09-26', '18:30:00', 'cancelled', '2025-09-05 14:51:50', '2025-09-05 14:52:10', 1, 2, 68.00, 'mollie', 2, 1, 'tr_9HwQJv7RkFfWF2ysUdnDJ', 4, '018451855', 68.00, 'tr_9HwQJv7RkFfWF2ysUdnDJ'),
(28, '#APTDwFM', 5, '2025-10-18', '10:30:00', 'pending', '2025-10-17 15:42:25', '2025-10-17 15:42:25', 1, 1, 40.00, 'stripe', 1, 1, 'txn_3SJFnM8IzKHLKgAR0IOj1yMT', 2, '018451855', 40.00, 'ch_3SJFnM8IzKHLKgAR0PEekSes'),
(29, '#APT2598', 5, '2025-10-22', '17:00:00', 'pending', '2025-10-17 17:50:34', '2025-10-17 17:50:34', 1, 1, 20.00, 'mollie', 1, 1, 'tr_D2pbP4z47HmV85fKMhhFJ', 1, '018451855', 20.00, 'tr_D2pbP4z47HmV85fKMhhFJ'),
(30, '#APT7teq', 5, '2025-10-23', '08:00:00', 'pending', '2025-10-17 17:51:46', '2025-10-17 17:51:46', 1, 2, 40.00, 'stripe', 1, 1, 'txn_3SJHoc8IzKHLKgAR03nJRNPJ', 2, '018451855', 40.00, 'ch_3SJHoc8IzKHLKgAR0hmHy38B'),
(31, '#APT4426', 5, '2025-10-25', '08:00:00', 'pending', '2025-10-24 14:26:59', '2025-10-24 14:26:59', 1, 1, 40.00, 'mollie', 1, 1, 'tr_cCDCjQc7NNMo3z3VYT2GJ', 2, '018451855', 40.00, 'tr_cCDCjQc7NNMo3z3VYT2GJ'),
(32, '#APT6545', 5, '2025-10-26', '08:30:00', 'pending', '2025-10-24 14:38:09', '2025-10-24 14:38:09', 1, 1, 60.00, 'mollie', 1, 1, 'tr_HVBbrVDctV4qw7gZhU2GJ', 3, '018451855', 60.00, 'tr_HVBbrVDctV4qw7gZhU2GJ'),
(33, '#APT4ivC', 5, '2025-11-05', '17:00:00', 'pending', '2025-11-03 16:42:46', '2025-11-03 16:42:46', 1, 1, 40.00, 'stripe', 1, 1, 'txn_3SPQq48IzKHLKgAR07cO9McC', 2, '018451855', 40.00, 'ch_3SPQq48IzKHLKgAR0bXN8gdA');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 1, '2025-08-08 09:44:21', '2025-08-08 09:44:21'),
(2, 'Rajshahi', 1, '2025-08-08 09:44:29', '2025-08-08 09:44:29'),
(3, 'Rangpur', 1, '2025-08-08 09:44:38', '2025-08-08 09:44:38'),
(4, 'Agra', 2, '2025-08-08 09:44:49', '2025-08-08 09:44:49'),
(5, 'Rawalpindi', 3, '2025-08-10 09:12:48', '2025-08-10 09:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `address`, `phone`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Smile Cute Dental Care Center', '2286 Sundown Lane, Austin, Texas 78749, USA', '018451855', '[\"uploads\\/clinic\\/1754928341805.jpg\",\"uploads\\/clinic\\/1754928341566.jpg\",\"uploads\\/clinic\\/1754928341459.jpg\",\"uploads\\/clinic\\/1754928341927.jpg\"]', '2025-08-11 09:29:10', '2025-08-19 08:36:42'),
(2, 'The Family Dentistry Clinic', '2883 University Street, Seattle, Texas Washington, 98155', '8877458241', '[\"uploads\\/clinic\\/1754926492265.jpg\",\"uploads\\/clinic\\/1754926492253.jpg\"]', '2025-08-11 09:34:52', '2025-08-19 08:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 'active', '2025-08-08 09:43:50', '2025-08-08 09:43:50'),
(2, 'India', 'active', '2025-08-08 09:43:58', '2025-08-08 09:43:58'),
(3, 'Pakistan', 'active', '2025-08-08 09:44:06', '2025-08-08 09:44:06'),
(4, 'Japan', 'active', '2025-09-12 18:18:22', '2025-09-12 18:18:22'),
(5, 'Hong Kong', 'active', '2025-09-12 18:18:22', '2025-09-12 18:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Urology', 'this is a department', 'uploads/departments/1754660521.png', 'on', '2025-08-08 07:42:01', '2025-08-08 07:42:06'),
(2, 'Neurology', 'this is a department', 'uploads/departments/1754660544.png', 'on', '2025-08-08 07:42:24', '2025-08-08 07:42:24'),
(3, 'Dentist', 'this is a department', 'uploads/departments/1754660716.png', 'on', '2025-08-08 07:45:16', '2025-08-08 07:45:16'),
(4, 'Cardiologist', 'this is a department', 'uploads/departments/1754660731.png', 'on', '2025-08-08 07:45:31', '2025-08-08 07:45:31'),
(5, 'Orthopedic', 'this is a department', 'uploads/departments/1754660749.png', 'on', '2025-08-08 07:45:49', '2025-08-08 07:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_profiles`
--

CREATE TABLE `doctor_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awards` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memberships` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `registrations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_profiles`
--

INSERT INTO `doctor_profiles` (`id`, `user_id`, `clinic_id`, `free`, `custom_price`, `services`, `about_me`, `specialization`, `degree`, `collage`, `completion_year`, `hospital_name`, `experience_from`, `experience_to`, `designation`, `awards`, `award_year`, `memberships`, `registrations`, `registration_date`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"1\",\"2\"]', NULL, '20', '[{\"value\":\"Tooth cleaning\"},{\"value\":\"Root Canal Therapy\"},{\"value\":\"Implants\"},{\"value\":\"Composite Bonding\"}]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[{\"value\":\"Children Care\"},{\"value\":\"Dental Care\"},{\"value\":\"Oral and Maxillofacial Surgery\"},{\"value\":\"Orthodontist\"},{\"value\":\"Periodontist\"},{\"value\":\"Prosthodontics\"}]', '[\"BDS\",\"MDS\"]', '[\"American Dental Medical University\",\"American Dental Medical University\"]', '[\"1998 - 2003\",\"2003 - 2005\"]', '[\"Glowing Smiles Family Dental Clinic\",\"Comfort Care Dental Clinic\",\"Dream Smile Dental Practice\"]', '[\"2016-08-05\",\"2020-08-05\",\"2022-08-02\"]', '[\"2022-08-04\",\"2022-08-01\",null]', '[\"Dental Doctor\",\"Dental Doctor\",\"Dental Doctor\"]', '[\"Humanitarian Award\",\"Certificate for International Volunteer Service\",\"The Dental Professional of The Year Award\"]', '[\"July 2019\",\"March 2011\",\"May 2008\"]', '[\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\"]', '[\"Mbsd\",\"Csd\"]', '[\"2024\",\"2025\"]', '2025-08-11 11:40:58', '2025-08-17 11:46:50'),
(4, 4, '[\"1\",\"2\"]', NULL, NULL, '[]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '2025-08-17 12:57:21', '2025-08-17 12:57:21'),
(5, 2, '[\"1\",\"2\"]', NULL, '35', '[{\"value\":\"Jaw Surgery\"},{\"value\":\"Facial Trauma Management\"},{\"value\":\"Cleft Lip and Palate Surgery\"}]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[{\"value\":\"Oral & Maxillofacial Surgery\"},{\"value\":\"Prosthodontics\"},{\"value\":\"Periodontology\"}]', '[\"BDS (Bachelor of Dental Surgery)\"]', '[\"King George\\u2019s Medical University, Lucknow\"]', '[\"2018\"]', '[\"Manipal College of Dental Sciences, Manipal\"]', '[\"2019-07-18\"]', '[null]', '[\"Consultant \\/ Specialist\"]', '[\"Hospital Excellence Awards\"]', '[\"2022\"]', '[\"Prestigious global award recognizing groundbreaking discoveries in medical science that improve human health.\"]', '[null]', '[null]', '2025-08-17 12:57:21', '2025-08-19 07:33:32'),
(9, 10, '[\"1\"]', NULL, '40', '[{\"value\":\"medicin\"}]', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '[{\"value\":\"baby care\"}]', '[\"MBBS\"]', '[\"Dhaka\"]', '[\"2014\"]', '[\"Dhaka Medical\"]', '[\"2024-06-01\"]', '[null]', '[\"Medicin\"]', '[\"Best Doctor\"]', '[\"2024\"]', '[\"Best Doctor\"]', '[null]', '[null]', '2025-09-01 16:57:54', '2025-09-01 17:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `sender_name`, `mail_host`, `email`, `smtp_user_name`, `smtp_password`, `smtp_port`, `mail_encryption`, `created_at`, `updated_at`) VALUES
(1, 'Doccure', 'smtp.gmail.com', 'info@gmail.com', 'saifasabanirob@gmail.com', 'zzmk ihtr qtuq qefa', '587', 'tls', '2025-09-16 16:34:00', '2025-10-14 17:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Reset Password', 'Reset Password', '<h4>Dear <strong>{{user_name}}</strong>,</h4><p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p><p>{{verification_link}}</p><p>&nbsp;</p><p>Thank You</p><p>Nirob</p>', NULL, '2025-09-18 15:32:40'),
(2, 'Offer Messages', 'Offer Messages', '<h4>Hello {{user_name}},</h4><h4><br></h4><h6 class=\"\">We have a special treat just for you! For a limited time, enjoy **20% OFF** on all our products.</h6><h4><br></h4><p class=\"\">Don\'t miss out—grab your favorites before the offer ends!</p><h4><br></h4><h6 class=\"\">Click here to claim your offer: {{offer_link}}</h6><p><b>File </b>: {{image}}</p><p><br></p><h6 class=\"\">Happy Shopping,&nbsp;&nbsp;</h6><p class=\"\">Nirob</p>', NULL, '2025-10-13 19:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(306, 'default', '{\"uuid\":\"f5980108-9526-47ca-af6e-f33700fb0db9\",\"displayName\":\"App\\\\Jobs\\\\SendEmailJob\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailJob\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendEmailJob\\\":2:{s:28:\\\"\\u0000App\\\\Jobs\\\\SendEmailJob\\u0000email\\\";s:18:\\\"nurutpi1@gmail.com\\\";s:29:\\\"\\u0000App\\\\Jobs\\\\SendEmailJob\\u0000userId\\\";i:11;}\"},\"createdAt\":1760465357,\"delay\":null}', 0, NULL, 1760465357, 1760465357);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `default` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `language_direction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'left_to_right',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `status`, `default`, `language_direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'active', '1', 'left_to_right', '2025-09-06 08:47:43', '2025-09-09 15:02:39'),
(14, 'Bangla', 'bn', 'active', '0', 'left_to_right', '2025-09-07 18:23:41', '2025-09-09 15:02:39'),
(17, 'Franch', 'fr', 'active', '0', 'left_to_right', '2025-09-08 15:06:55', '2025-09-08 15:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` int NOT NULL DEFAULT '0',
  `receiver_id` int NOT NULL DEFAULT '0',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'hello', 0, '2025-11-03 16:33:35', '2025-11-03 16:33:35'),
(9, 1, 5, 'hello', 0, '2025-11-03 16:33:35', '2025-11-03 16:33:35'),
(11, 5, 1, 'hi', 0, '2025-11-04 14:09:55', '2025-11-04 14:09:55'),
(12, 5, 1, 'hello', 0, '2025-11-04 14:12:45', '2025-11-04 14:12:45'),
(13, 5, 1, 'how are you', 0, '2025-11-04 14:14:02', '2025-11-04 14:14:02'),
(14, 5, 1, 'gy', 0, '2025-11-04 14:16:29', '2025-11-04 14:16:29'),
(15, 5, 1, 'hi', 0, '2025-11-04 14:17:49', '2025-11-04 14:17:49'),
(16, 5, 1, 'hi', 0, '2025-11-04 14:17:58', '2025-11-04 14:17:58'),
(17, 5, 1, 'hey', 0, '2025-11-04 14:19:11', '2025-11-04 14:19:11'),
(18, 5, 1, 'hi', 0, '2025-11-04 14:19:50', '2025-11-04 14:19:50'),
(19, 5, 1, 'hy', 0, '2025-11-04 14:20:14', '2025-11-04 14:20:14'),
(20, 5, 2, 'hi', 0, '2025-11-04 14:25:41', '2025-11-04 14:25:41'),
(21, 5, 2, 'hello', 0, '2025-11-04 14:28:17', '2025-11-04 14:28:17'),
(22, 5, 2, 'hi', 0, '2025-11-04 14:28:58', '2025-11-04 14:28:58'),
(23, 5, 2, 'hello', 0, '2025-11-04 14:29:19', '2025-11-04 14:29:19'),
(24, 1, 5, 'how are you', 0, '2025-11-04 14:36:15', '2025-11-04 14:36:15'),
(25, 1, 5, 'are you fine', 0, '2025-11-04 14:37:13', '2025-11-04 14:37:13'),
(26, 1, 5, 'hello', 0, '2025-11-04 14:37:42', '2025-11-04 14:37:42'),
(27, 5, 1, 'hy', 0, '2025-11-04 15:38:15', '2025-11-04 15:38:15'),
(28, 5, 1, 'hi', 0, '2025-11-04 15:39:16', '2025-11-04 15:39:16'),
(29, 1, 5, 'hello', 0, '2025-11-04 15:40:13', '2025-11-04 15:40:13'),
(30, 1, 5, 'hi', 0, '2025-11-04 15:40:33', '2025-11-04 15:40:33'),
(31, 1, 5, 'hi', 0, '2025-11-04 15:42:05', '2025-11-04 15:42:05'),
(32, 5, 1, 'how are you', 0, '2025-11-04 15:42:48', '2025-11-04 15:42:48'),
(33, 1, 5, 'ki', 0, '2025-11-04 15:49:57', '2025-11-04 15:49:57'),
(34, 1, 5, 'what', 0, '2025-11-04 15:54:24', '2025-11-04 15:54:24'),
(35, 5, 1, 'ki koro', 0, '2025-11-04 15:55:05', '2025-11-04 15:55:05'),
(36, 1, 5, 'kichu na', 0, '2025-11-04 15:55:25', '2025-11-04 15:55:25'),
(37, 5, 1, 'hi', 0, '2025-11-04 16:04:05', '2025-11-04 16:04:05'),
(38, 1, 5, 'httt', 0, '2025-11-04 16:04:29', '2025-11-04 16:04:29'),
(39, 1, 5, 'noo', 0, '2025-11-04 16:07:46', '2025-11-04 16:07:46'),
(40, 5, 1, 'yesss', 0, '2025-11-04 16:08:17', '2025-11-04 16:08:17'),
(41, 1, 5, 'ree', 0, '2025-11-04 16:08:39', '2025-11-04 16:08:39'),
(42, 1, 5, 'rr', 0, '2025-11-04 16:09:03', '2025-11-04 16:09:03'),
(43, 5, 1, 'ha', 0, '2025-11-04 16:10:00', '2025-11-04 16:10:00'),
(44, 5, 1, 'pp', 0, '2025-11-04 16:11:31', '2025-11-04 16:11:31'),
(45, 5, 1, 'hello', 0, '2025-11-04 16:12:53', '2025-11-04 16:12:53'),
(46, 5, 1, 'hhh', 0, '2025-11-04 16:13:30', '2025-11-04 16:13:30'),
(47, 5, 1, 'fgfd', 0, '2025-11-04 16:15:10', '2025-11-04 16:15:10'),
(48, 5, 1, 'hello', 0, '2025-11-04 16:16:01', '2025-11-04 16:16:01'),
(49, 5, 1, 'hgdh', 0, '2025-11-04 16:17:15', '2025-11-04 16:17:15'),
(50, 1, 5, 'ha bolo', 0, '2025-11-04 19:08:48', '2025-11-04 19:08:48'),
(51, 1, 5, 'this is me', 0, '2025-11-04 19:15:57', '2025-11-04 19:15:57'),
(52, 5, 1, 'Okkk', 0, '2025-11-04 19:19:59', '2025-11-04 19:19:59'),
(53, 1, 5, 'iiii', 0, '2025-11-05 13:57:42', '2025-11-05 13:57:42'),
(54, 5, 1, 'hello boy', 0, '2025-11-05 13:59:39', '2025-11-05 13:59:39'),
(55, 1, 5, 'dffdf', 0, '2025-11-05 14:50:11', '2025-11-05 14:50:11'),
(56, 5, 1, 'fghj', 0, '2025-11-05 15:01:46', '2025-11-05 15:01:46'),
(57, 1, 5, 'fhjjtjkt', 0, '2025-11-05 15:01:58', '2025-11-05 15:01:58'),
(58, 1, 5, 'ergtergy', 0, '2025-11-05 15:10:49', '2025-11-05 15:10:49'),
(59, 1, 5, 'tata', 0, '2025-11-05 15:11:08', '2025-11-05 15:11:08'),
(60, 1, 5, 'tata', 0, '2025-11-05 15:11:23', '2025-11-05 15:11:23'),
(61, 5, 1, 'hello sir', 0, '2025-11-05 15:12:25', '2025-11-05 15:12:25'),
(62, 1, 5, 'gtrt', 0, '2025-11-05 15:13:20', '2025-11-05 15:13:20'),
(63, 1, 5, 'oh', 0, '2025-11-05 15:42:56', '2025-11-05 15:42:56'),
(64, 5, 1, 'kemon acho', 0, '2025-11-05 15:43:16', '2025-11-05 15:43:16'),
(65, 1, 5, 'valo tume', 0, '2025-11-05 15:43:37', '2025-11-05 15:43:37'),
(66, 5, 1, 'ame o valo ache', 0, '2025-11-05 15:43:49', '2025-11-05 15:43:49'),
(67, 1, 5, 'hello', 0, '2025-11-05 16:17:19', '2025-11-05 16:17:19'),
(68, 5, 1, 'hello', 0, '2025-11-05 16:17:37', '2025-11-05 16:17:37'),
(69, 5, 1, 'tume kemon acho', 0, '2025-11-05 16:17:50', '2025-11-05 16:17:50'),
(70, 1, 5, 'valo tume bolo tume kemon acho', 0, '2025-11-05 16:18:10', '2025-11-05 16:18:10'),
(71, 5, 1, 'ame to valo ache, ki koro', 0, '2025-11-05 16:18:26', '2025-11-05 16:18:26'),
(72, 1, 5, 'ame to kichu kore na, tume ki klk collage a jaba', 0, '2025-11-05 16:18:55', '2025-11-05 16:18:55'),
(73, 5, 1, 'ha jabo to, tume jaba na', 0, '2025-11-05 16:19:16', '2025-11-05 16:19:16'),
(74, 1, 5, 'oo ame o jabo', 0, '2025-11-05 16:30:07', '2025-11-05 16:30:07'),
(75, 5, 1, 'thik ache tahole dekha hobe', 0, '2025-11-05 16:30:24', '2025-11-05 16:30:24'),
(76, 5, 1, 'valo theko', 0, '2025-11-05 16:30:44', '2025-11-05 16:30:44'),
(77, 1, 5, 'ha tumeo valo theko', 0, '2025-11-05 16:31:23', '2025-11-05 16:31:23'),
(78, 5, 1, 'ok byby', 0, '2025-11-05 16:32:05', '2025-11-05 16:32:05'),
(79, 5, 1, 'ok by', 0, '2025-11-05 16:33:09', '2025-11-05 16:33:09'),
(80, 5, 1, 'hi', 0, '2025-11-05 16:38:10', '2025-11-05 16:38:10'),
(81, 1, 5, 'hello', 0, '2025-11-05 16:41:08', '2025-11-05 16:41:08'),
(82, 1, 5, 'how are you', 0, '2025-11-05 16:41:23', '2025-11-05 16:41:23'),
(83, 1, 5, 'uu', 0, '2025-11-05 16:46:50', '2025-11-05 16:46:50'),
(84, 1, 5, 'ttt', 0, '2025-11-05 16:47:36', '2025-11-05 16:47:36'),
(85, 5, 1, 'hhh', 0, '2025-11-05 16:47:59', '2025-11-05 16:47:59'),
(86, 5, 1, 'ttt', 0, '2025-11-05 16:48:10', '2025-11-05 16:48:10'),
(87, 1, 5, 'tttttttt', 0, '2025-11-05 16:48:22', '2025-11-05 16:48:22'),
(88, 1, 5, 'tttt', 0, '2025-11-05 16:48:57', '2025-11-05 16:48:57'),
(89, 5, 1, 'tttt', 0, '2025-11-05 16:49:06', '2025-11-05 16:49:06'),
(90, 5, 1, 'me', 0, '2025-11-05 16:49:13', '2025-11-05 16:49:13'),
(91, 5, 1, 'its me', 0, '2025-11-05 16:50:02', '2025-11-05 16:50:02'),
(92, 1, 5, 'you', 0, '2025-11-05 16:50:23', '2025-11-05 16:50:23'),
(93, 1, 5, 'hii', 0, '2025-11-05 16:51:02', '2025-11-05 16:51:02'),
(94, 5, 1, 'hello', 0, '2025-11-05 16:51:15', '2025-11-05 16:51:15'),
(95, 5, 1, 'hello', 0, '2025-11-05 16:51:22', '2025-11-05 16:51:22'),
(96, 5, 1, 'its me for test', 0, '2025-11-05 16:51:38', '2025-11-05 16:51:38'),
(97, 1, 5, 'its you for test', 0, '2025-11-05 16:52:02', '2025-11-05 16:52:02'),
(98, 5, 1, 'tata', 0, '2025-11-05 16:53:27', '2025-11-05 16:53:27'),
(99, 1, 5, 'hu', 0, '2025-11-05 17:09:48', '2025-11-05 17:09:48'),
(100, 1, 5, 'tr', 0, '2025-11-05 17:09:56', '2025-11-05 17:09:56'),
(101, 5, 1, 'nice', 0, '2025-11-05 17:10:47', '2025-11-05 17:10:47'),
(102, 1, 5, 'khub valo', 0, '2025-11-05 17:10:58', '2025-11-05 17:10:58'),
(103, 5, 1, 'hi', 0, '2025-11-05 17:47:25', '2025-11-05 17:47:25'),
(104, 1, 5, 'hello', 0, '2025-11-05 17:47:37', '2025-11-05 17:47:37'),
(105, 5, 1, 'how are you', 0, '2025-11-05 17:47:51', '2025-11-05 17:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_08_05_121123_create_admins_table', 1),
(4, '2025_08_05_125112_create_departments_table', 1),
(5, '2025_08_05_145708_add_reset_password_token_to_admins_table', 1),
(6, '2025_08_05_165442_add_admin_column_to_admins_table', 1),
(7, '2025_08_06_144257_add_logo_to_departments_table', 1),
(8, '2025_08_08_085136_create_countries_table', 1),
(9, '2025_08_08_100104_create_cities_table', 1),
(10, '2025_08_08_101253_create_states_table', 1),
(11, '2025_08_08_111253_create_users_table', 1),
(13, '2025_08_08_130845_create_prescriptions_table', 1),
(14, '2025_08_08_131309_create_feedback_table', 1),
(16, '2025_08_08_133200_add_department_id_to_users_table', 1),
(18, '2025_08_08_145705_add_status_to_users_table', 1),
(19, '2025_08_08_175335_add_blood_group_to_users_table', 1),
(20, '2025_08_11_143345_create_clinics_table', 2),
(27, '2025_08_11_151913_create_doctor_profiles_table', 3),
(30, '2025_08_12_163638_create_schedule_timings_table', 4),
(31, '2025_08_15_135228_create_social_media_table', 5),
(33, '2025_08_16_175732_add_column_to_doctor_profiles_table', 6),
(34, '2025_08_19_180822_add_clinic_id_to_schedule_timings_table', 7),
(36, '2025_08_23_225400_create_reviews_table', 8),
(41, '2025_08_26_002310_create_payments_table', 9),
(42, '2025_08_08_130234_create_appointments_table', 10),
(43, '2025_08_08_141816_add_doctor_id_to_appointments_table', 11),
(44, '2025_08_26_004322_add_clinic_id_to_appointments_table', 11),
(45, '2025_07_23_154025_create_stripe_payments_table', 12),
(48, '2025_08_28_232750_add_patient_number_to_appointments_table', 13),
(49, '2025_08_29_222459_create_refunds_table', 14),
(50, '2025_08_29_230351_add_charge_id_to_appointments_table', 15),
(52, '2025_08_30_230531_add_app_id_to_appointments_table', 16),
(57, '2025_09_03_210453_add_icon_coloumn_to_stripe_payments_table', 17),
(58, '2025_09_06_142106_create_languages_table', 18),
(59, '2025_09_10_144043_create_permission_tables', 19),
(62, '2025_09_10_211022_add_status_column_to_admins_table', 20),
(63, '2025_09_16_221032_create_emails_table', 20),
(64, '2025_09_17_222249_create_email_templates_table', 21),
(65, '2025_09_18_003538_add_forget_password_token_to_users_table', 22),
(66, '2025_10_17_195847_create_notifications_table', 23),
(67, '2025_11_03_221151_create_messages_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(18, 'App\\Models\\Admin\\Admin', 1),
(16, 'App\\Models\\Admin\\Admin', 2),
(16, 'App\\Models\\Admin\\Admin', 3),
(17, 'App\\Models\\Admin\\Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('063be298-8e06-4da6-93b6-a02c9fc3f95d', 'App\\Notifications\\AppointmentAdminNotification', 'App\\Models\\Admin\\Admin', 1, '{\"appointment_id\":28,\"user_name\":\"Charlene Reed\",\"user_email\":\"user@gmail.com\",\"service\":\"\",\"message\":\"\\u098f\\u0995\\u099f\\u09bf \\u09a8\\u09a4\\u09c1\\u09a8 Appointment \\u09ac\\u09c1\\u0995 \\u0995\\u09b0\\u09be \\u09b9\\u09df\\u09c7\\u099b\\u09c7!\"}', '2025-10-17 16:58:05', '2025-10-17 15:42:26', '2025-10-17 16:58:05'),
('7ec5d507-f79d-449d-bbbf-f744e8f84a7d', 'App\\Notifications\\AppointmentAdminNotification', 'App\\Models\\Admin\\Admin', 1, '{\"appointment_id\":33,\"user_name\":\"Charlene Reed\",\"user_email\":\"user@gmail.com\",\"service\":\"\",\"message\":\"\\u098f\\u09b0 \\u098f\\u0995\\u099f\\u09bf \\u09a8\\u09a4\\u09c1\\u09a8 Appointment \\u09ac\\u09c1\\u0995 \\u0995\\u09b0\\u09be \\u09b9\\u09df\\u09c7\\u099b\\u09c7!\"}', NULL, '2025-11-03 16:42:46', '2025-11-03 16:42:46'),
('dbabf4c1-7ec9-4d93-ba42-0ed25ad3c807', 'App\\Notifications\\AppointmentAdminNotification', 'App\\Models\\Admin\\Admin', 1, '{\"appointment_id\":32,\"user_name\":\"Charlene Reed\",\"user_email\":\"user@gmail.com\",\"service\":\"\",\"message\":\"\\u098f\\u09b0 \\u098f\\u0995\\u099f\\u09bf \\u09a8\\u09a4\\u09c1\\u09a8 Appointment \\u09ac\\u09c1\\u0995 \\u0995\\u09b0\\u09be \\u09b9\\u09df\\u09c7\\u099b\\u09c7!\"}', '2025-10-24 15:04:09', '2025-10-24 14:38:09', '2025-10-24 15:04:09'),
('efce1f77-dd5e-4e30-90cf-04ed69aeab01', 'App\\Notifications\\AppointmentAdminNotification', 'App\\Models\\Admin\\Admin', 1, '{\"appointment_id\":30,\"user_name\":\"Charlene Reed\",\"user_email\":\"user@gmail.com\",\"service\":\"\",\"message\":\"\\u098f\\u09b0 \\u098f\\u0995\\u099f\\u09bf \\u09a8\\u09a4\\u09c1\\u09a8 Appointment \\u09ac\\u09c1\\u0995 \\u0995\\u09b0\\u09be \\u09b9\\u09df\\u09c7\\u099b\\u09c7!\"}', '2025-10-17 17:51:53', '2025-10-17 17:51:46', '2025-10-17 17:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(11, 'doctor-edit', 'admin', '2025-09-11 17:43:23', '2025-09-11 17:43:23'),
(12, 'doctor-delete', 'admin', '2025-09-11 17:43:35', '2025-09-11 17:43:35'),
(13, 'doctor-update', 'admin', '2025-09-11 17:44:20', '2025-09-11 17:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `appointment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `diagnosis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medicines` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advice` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint UNSIGNED NOT NULL,
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `doctor_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`id`, `charge_id`, `appointment_id`, `status`, `doctor_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ch_3S1VpU8IzKHLKgAR1zng1fkt', 13, 'refunded', 1, 5, '2025-08-29 17:27:11', '2025-08-29 17:27:11'),
(2, 'ch_3S1WFw8IzKHLKgAR14kg0Vls', 15, 'refunded', 1, 5, '2025-08-29 17:38:43', '2025-08-29 17:38:43'),
(3, 'ch_3S1WkF8IzKHLKgAR1vLXFWEP', 16, 'refunded', 1, 5, '2025-08-29 18:12:36', '2025-08-29 18:12:36'),
(4, 'ch_3S2x008IzKHLKgAR03x6Jm6V', 19, 'refunded', 1, 5, '2025-09-02 16:25:36', '2025-09-02 16:25:36'),
(5, 'ch_3S2ygv8IzKHLKgAR11IObwjj', 20, 'refunded', 1, 5, '2025-09-02 18:20:33', '2025-09-02 18:20:33'),
(6, 'ch_3S2ypj8IzKHLKgAR0wtHijJA', 22, 'refunded', 1, 5, '2025-09-05 14:39:56', '2025-09-05 14:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `doctor_id`, `rating`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. Curabitur non nulla si', 1, '2025-08-23 18:09:09', '2025-08-23 18:51:19'),
(2, 11, 1, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. Curabitur non nulla si', 1, '2025-08-23 18:09:22', '2025-08-23 18:51:30'),
(3, 11, 8, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. Curabitur non nulla si', 1, '2025-08-23 18:09:22', '2025-08-24 14:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(16, 'editor', 'admin', '2025-09-11 18:02:56', '2025-09-11 18:02:56'),
(17, 'deletor', 'admin', '2025-09-11 18:16:55', '2025-09-11 18:16:55'),
(18, 'super-admin', 'admin', '2025-09-12 08:25:39', '2025-09-12 08:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(11, 16),
(12, 17);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_timings`
--

CREATE TABLE `schedule_timings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` int DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` json DEFAULT NULL,
  `end_time` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_timings`
--

INSERT INTO `schedule_timings` (`id`, `user_id`, `clinic_id`, `day_of_week`, `start_time`, `end_time`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Sunday', '[\"08:00\"]', '[\"11:00\"]', 1, '2025-08-13 08:48:20', '2025-08-16 10:17:34'),
(2, 1, 2, 'Thursday', '[\"08:00\"]', '[\"11:00\"]', 1, '2025-08-13 09:31:26', '2025-08-16 10:15:59'),
(4, 1, 1, 'Monday', '[\"08:00\", \"16:00\"]', '[\"12:00\", \"20:00\"]', 1, '2025-08-14 10:38:25', '2025-08-16 10:14:41'),
(5, 1, 2, 'Tuesday', '[\"08:00\", \"16:00\"]', '[\"11:00\", \"20:00\"]', 0, '2025-08-14 11:10:04', '2025-08-19 10:27:28'),
(6, 1, 1, 'Wednesday', '[\"17:00\"]', '[\"20:00\"]', 1, '2025-08-14 11:10:33', '2025-08-16 10:15:45'),
(7, 1, 2, 'Friday', '[\"08:00\", \"17:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-15 07:44:20', '2025-08-16 10:16:21'),
(9, 1, 1, 'Saturday', '[\"08:00\", \"17:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-16 10:39:31', '2025-08-31 15:07:49'),
(10, 2, 1, 'Saturday', '[\"08:00\"]', '[\"11:00\"]', 1, '2025-08-16 10:39:31', '2025-08-16 10:39:31'),
(11, 2, 2, 'Tuesday', '[null]', '[null]', 0, '2025-08-14 11:10:04', '2025-08-14 11:10:04'),
(12, 4, 1, 'Sunday', '[\"08:00\", \"16:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-17 11:59:33', '2025-08-17 11:59:45'),
(13, 4, 2, 'Monday', '[null]', '[null]', 0, '2025-08-17 11:59:54', '2025-08-17 11:59:54'),
(14, 4, 2, 'Tuesday', '[\"16:00\"]', '[\"20:00\"]', 1, '2025-08-17 12:00:06', '2025-08-17 12:00:06'),
(15, 4, 1, 'Wednesday', '[\"08:00\", \"17:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-17 12:00:24', '2025-08-17 12:00:24'),
(16, 4, 1, 'Friday', '[null]', '[null]', 0, '2025-08-17 12:00:31', '2025-08-17 12:00:31'),
(17, 4, 1, 'Saturday', '[\"08:00\"]', '[\"12:00\"]', 1, '2025-08-17 12:00:40', '2025-08-17 12:00:40'),
(18, 2, 2, 'Friday', '[\"08:00\", \"16:00\"]', '[\"12:00\", \"20:00\"]', 1, '2025-08-28 17:40:00', '2025-08-28 17:40:00'),
(19, 10, 1, 'Monday', '[\"08:00\"]', '[\"10:00\"]', 1, '2025-09-01 16:37:06', '2025-09-01 16:37:06'),
(20, 10, 2, 'Tuesday', '[\"16:00\"]', '[\"20:00\"]', 1, '2025-09-01 16:37:28', '2025-09-01 16:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8KLrUJzbkH4bnyRjOLBryQC5dRUeWGnFyITf3ph0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo2OntzOjEwOiJhZG1pbl9sYW5nIjtzOjI6ImVuIjtzOjY6Il90b2tlbiI7czo0MDoiVUFwcTFOcGZKdW1PN3FLdkZvZFFaTU9nMjR2Q3ZzZzZma1czcmtBbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9jbGluaWMtbWFuYWdlbWVudC1zeXN0ZW0udGVzdC9jaGF0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1762364858),
('do0d5nkgh9eRFw1TYFyjcx0aLIwmIA0Wcr0fSlzI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo2OntzOjEwOiJhZG1pbl9sYW5nIjtzOjI6ImVuIjtzOjY6Il90b2tlbiI7czo0MDoiemkzRWdsZUVoVVlpSWo4aVRqbHc2eHBoVHVsRmVPM09RNUF4SGdKTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZXNzYWdlcy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1762359777),
('fFy4fZTlRX41T9gO1mWHzvYbvbAk8hDc9lishH7R', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjEwOiJhZG1pbl9sYW5nIjtzOjI6ImVuIjtzOjY6Il90b2tlbiI7czo0MDoiazJ4VWF1cHA2a1RVdkp4VW8wak43V2lia1VXRGlKQ3F0MHBaM0I2RiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9jbGluaWMtbWFuYWdlbWVudC1zeXN0ZW0udGVzdC9jaGF0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1762364872),
('hHq9OYLkMFrOuvRgJxv2hITeDLVk4feT11D9Dbam', NULL, '192.168.1.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjEwOiJhZG1pbl9sYW5nIjtzOjI6ImVuIjtzOjY6Il90b2tlbiI7czo0MDoiTFJuRWl0NjAzOFZIaHlXaUM0ZWcxTFhIcFRUTWNueFVERWZLbVljRyI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xOTIuMTY4LjEuOC9jbGluaWMtbWFuYWdlbWVudC1zeXN0ZW0vcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1762357233),
('nHJnMVDkHc0Ok5YLOPl6zj7rdMJWf41xDZbFwuZg', NULL, '192.168.1.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo1OntzOjEwOiJhZG1pbl9sYW5nIjtzOjI6ImVuIjtzOjY6Il90b2tlbiI7czo0MDoiWVdJdHRlYkZGSmZFcEE5S0VHYThuMlZFaFlKQlNSaEdJZExrN0NCNSI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xOTIuMTY4LjEuOC9DbGluaWMtTWFuYWdlbWVudC1TeXN0ZW0vcHVibGljIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1762357638);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `user_id`, `facebook`, `twitter`, `instagram`, `linkedin`, `pinterest`, `youtube`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://www.facebook.com', 'http://www.twitter.com', 'http://www.instagram.com', 'http://www.linkedin.com', NULL, NULL, '2025-08-15 08:18:54', '2025-08-15 08:19:30'),
(2, 4, 'https://www.facebook.com', NULL, NULL, NULL, NULL, NULL, '2025-08-17 12:59:15', '2025-08-17 12:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `city_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mirpur 10', '2025-08-08 09:45:04', '2025-08-08 09:45:04'),
(2, 1, 1, 'Dhanmondi 32', '2025-08-08 09:45:19', '2025-08-08 09:45:19'),
(3, 1, 3, 'Thakurgaon', '2025-08-08 09:45:33', '2025-08-08 09:45:33'),
(4, 2, 4, 'Uttar Pradesh', '2025-08-10 09:12:29', '2025-08-10 09:12:29'),
(5, 3, 5, 'Punjab province', '2025-08-10 09:13:17', '2025-08-10 09:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payments`
--

CREATE TABLE `stripe_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `stripe_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stripe_payments`
--

INSERT INTO `stripe_payments` (`id`, `stripe_key`, `stripe_secret_key`, `created_at`, `updated_at`, `icon`, `status`) VALUES
(4, '', '', '2025-08-27 17:42:58', '2025-09-03 15:52:06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `state_id` bigint UNSIGNED DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `biography` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `forget_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `phone`, `gender`, `blood_group`, `photo`, `address_line_one`, `city_id`, `state_id`, `country_id`, `postal_code`, `birthday`, `role`, `status`, `biography`, `email_verified_at`, `password`, `forget_password_token`, `remember_token`, `created_at`, `updated_at`, `department_id`) VALUES
(1, 'Dr. Darren Elder', NULL, 'doctor@gmail.com', '8005478', 'male', 'b+', 'uploads/doctors/1754660575.jpg', 'Mirpur', 1, 1, 1, '2525', '2025-08-08', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$sXPYG5shHXncKmGU3sUfJOirkwT09Z/gdttd58bdwST5xanA9aAG.', NULL, NULL, '2025-08-08 07:42:55', '2025-08-15 13:07:21', 2),
(2, 'Dr. Deborah Angel', NULL, 'angel@gmail.com', NULL, 'female', 'b+', 'uploads/doctors/1754660633.jpg', 'Dhaka Mirpur', 1, 1, 1, '2525', '2025-08-07', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$j49bf41d0qo/0gD9xlNeVOBphdwWeINqkzuhefmOOgYwqBExd2ClS', NULL, NULL, '2025-08-08 07:43:53', '2025-08-19 07:34:15', 1),
(3, 'Charlene Reed', NULL, 'charlene@gmail.com', '01773443625', 'male', 'b-', 'uploads/users/1754660696.jpg', 'Dhaka Mirpur', NULL, NULL, NULL, NULL, '1997-08-04', 'user', 'active', NULL, NULL, '$2y$12$XMn9uCd/BR1eg.aWbMjG5uJhYnnT6eBjBF3nsDbQ1PzFFF27itVl2', NULL, NULL, '2025-08-08 07:44:56', '2025-08-08 08:54:07', NULL),
(4, 'Dr. John Gibbs', NULL, 'gibbs@gmail.com', '80034751', 'male', 'b+', 'uploads/doctors/1755275296.jpg', 'Dhaka', 1, 2, 1, '87898', '1999-09-01', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$7CIkPjV1eGrFLkc00m1Beu6jL6Fkp0jk/.8r02XdUlQsBw2CCeqga', NULL, NULL, '2025-08-09 01:07:00', '2025-08-17 12:10:50', 4),
(5, 'Charlene Reed', NULL, 'user@gmail.com', '018451855', 'male', 'b+', 'uploads/users/1755284417.jpg', 'Dhaka', 1, 1, 1, '87898', '1998-09-01', 'user', 'active', NULL, NULL, '$2y$12$bDylg5daYd73MrwFUChf6evJ.QbtzKDALTaz9ktVJH2.laenGZMce', NULL, NULL, '2025-08-09 09:03:44', '2025-10-13 16:07:44', NULL),
(7, 'Shaniya Stanton', NULL, 'shayan@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355177.jpg', '2871 Morissette Passage', NULL, NULL, NULL, NULL, '2025-08-15', 'doctor', 'active', NULL, NULL, '$2y$12$bGZMoazivWydMJjoAFGX6uTpz1yRkQ.LhqL4JIPQuafThtGwo0X0C', NULL, NULL, '2025-08-16 08:39:37', '2025-08-16 08:39:37', 5),
(8, 'Mikel Batz', NULL, 'fakedata24324@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355234.jpg', '54467 Maximilian Streets', NULL, NULL, NULL, NULL, '2024-10-17', 'doctor', 'active', NULL, NULL, '$2y$12$DrEyRTaJHiFDjzZqF/YTouXCYac/T/9N5Sb.F9GGosvUv/LB7W3e2', NULL, NULL, '2025-08-16 08:40:34', '2025-08-16 08:40:34', 1),
(9, 'Rebecca Becker', NULL, 'sdfakedata60990@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355295.jpg', '4570 Hobart Avenue', NULL, NULL, NULL, NULL, '2025-10-30', 'doctor', 'active', NULL, NULL, '$2y$12$v5b/tORODjrUbsw3GA8MhuoPqcf4kJ8Jc1qWVnxdobBm6nhMP45yS', NULL, NULL, '2025-08-16 08:41:35', '2025-08-16 08:41:35', 1),
(10, 'Winston Russel', NULL, 'paul@gmail.com', NULL, 'male', 'a+', 'uploads/doctors/1755355355.jpg', '785 Verdie Pass', 1, 2, 1, '2525', '2025-08-21', 'doctor', 'active', 'Oral & Maxillofacial Surgery', NULL, '$2y$12$KEFQ4eRIzHM5FrC9oahgiOmGcgWZF.tVfif9/I4UGWMW7kwUvBw8W', NULL, NULL, '2025-08-16 08:42:35', '2025-08-18 12:40:25', 5),
(11, 'Carl Kelly', 'O\'Reilly-Toy', 'nurutpi1@gmail.com', '966-969-1958', 'male', 'ab+', 'uploads/users/1755355454.jpg', '37940 Mckenna Prairie', NULL, NULL, NULL, NULL, '1998-05-22', 'user', 'active', NULL, NULL, '$2y$12$CYicfMwwZ1/0V2pyFzeGw.5GA.bUu/UyOf/FgrLiR2jA2GYUehKz6', 'OK5iefysyRWaPFWawWtbNfX8QjaWvjgYUpJZyulEbN3JUFpcXmzN1jFtqfUKwPmAXA2HsSP5jNxJpZl0ZxcukWtP1SFiCwNMJabY', NULL, '2025-08-16 08:44:14', '2025-10-14 18:09:17', NULL),
(12, 'Nirob', NULL, 'test@gmail.com', '01773443625', 'male', 'a+', NULL, 'Dhaka', NULL, NULL, NULL, NULL, '2025-10-08', 'user', 'inactive', NULL, NULL, '$2y$12$6PfxYDfi5ig94gAcPMMVC.grvJC0iSTmsE1XJZD2YkiDVYEbL33Rm', NULL, NULL, '2025-10-14 16:09:46', '2025-10-14 16:09:46', NULL),
(13, 'res', NULL, 'sfdd@dsgf.sg', '132134', 'male', 'b-', NULL, 'sd', NULL, NULL, NULL, NULL, '2025-10-08', 'user', 'inactive', NULL, NULL, '$2y$12$ELrNmP8E.D7ewmCjokelLu.uhLsr8WwXVx4g/o6mZwm./57hZ/RKO', NULL, NULL, '2025-10-14 16:11:57', '2025-10-14 16:11:57', NULL),
(14, 'mail test', NULL, 'mail@gmail.com', '1243245', 'male', 'a+', NULL, 'dhaka', NULL, NULL, NULL, NULL, '2025-10-08', 'user', 'inactive', NULL, NULL, '$2y$12$koMUMcOHV.LG2wb4Oh53xO5klh8dgF7sgHZ1xzeLGh4rT0qyjUzDC', NULL, NULL, '2025-10-14 16:19:36', '2025-10-14 16:19:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_app_id_unique` (`app_id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`);

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
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_appointment_id_foreign` (`appointment_id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refunds_appointment_id_foreign` (`appointment_id`),
  ADD KEY `refunds_doctor_id_foreign` (`doctor_id`),
  ADD KEY `refunds_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedule_timings`
--
ALTER TABLE `schedule_timings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_timings_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_media_user_id_foreign` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`),
  ADD KEY `states_city_id_foreign` (`city_id`);

--
-- Indexes for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_state_id_foreign` (`state_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedule_timings`
--
ALTER TABLE `schedule_timings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stripe_payments`
--
ALTER TABLE `stripe_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD CONSTRAINT `doctor_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refunds_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refunds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule_timings`
--
ALTER TABLE `schedule_timings`
  ADD CONSTRAINT `schedule_timings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_media`
--
ALTER TABLE `social_media`
  ADD CONSTRAINT `social_media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
