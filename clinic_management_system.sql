-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2025 at 09:13 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `reset_password_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `zip_code`, `country`, `about_me`, `photo`, `birthday`, `email_verified_at`, `reset_password_token`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01773443625', 'Dhaka Mirpur', 'Dhaka', 'Mirpur', '22434', 'Bangladesh', 'I am admin', 'uploads/admin/1754756037.jpeg', '2007-09-06', NULL, NULL, '$2y$12$UiVzGiP17qbh5u1hRP/I2ecG94jk0bYahiRaFz8liyST6XtYOqcDy', NULL, '2025-08-08 07:41:30', '2025-08-15 11:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 'active', '2025-08-08 09:43:50', '2025-08-08 09:43:50'),
(2, 'India', 'active', '2025-08-08 09:43:58', '2025-08-08 09:43:58'),
(3, 'Pakistan', 'active', '2025-08-08 09:44:06', '2025-08-08 09:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
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
  `clinic_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completion_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `awards` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `award_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memberships` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `registrations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_profiles`
--

INSERT INTO `doctor_profiles` (`id`, `user_id`, `clinic_id`, `free`, `custom_price`, `services`, `about_me`, `specialization`, `degree`, `collage`, `completion_year`, `hospital_name`, `experience_from`, `experience_to`, `designation`, `awards`, `award_year`, `memberships`, `registrations`, `registration_date`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"1\",\"2\"]', NULL, '20', '[{\"value\":\"Tooth cleaning\"},{\"value\":\"Root Canal Therapy\"},{\"value\":\"Implants\"},{\"value\":\"Composite Bonding\"}]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[{\"value\":\"Children Care\"},{\"value\":\"Dental Care\"},{\"value\":\"Oral and Maxillofacial Surgery\"},{\"value\":\"Orthodontist\"},{\"value\":\"Periodontist\"},{\"value\":\"Prosthodontics\"}]', '[\"BDS\",\"MDS\"]', '[\"American Dental Medical University\",\"American Dental Medical University\"]', '[\"1998 - 2003\",\"2003 - 2005\"]', '[\"Glowing Smiles Family Dental Clinic\",\"Comfort Care Dental Clinic\",\"Dream Smile Dental Practice\"]', '[\"2016-08-05\",\"2020-08-05\",\"2022-08-02\"]', '[\"2022-08-04\",\"2022-08-01\",null]', '[\"Dental Doctor\",\"Dental Doctor\",\"Dental Doctor\"]', '[\"Humanitarian Award\",\"Certificate for International Volunteer Service\",\"The Dental Professional of The Year Award\"]', '[\"July 2019\",\"March 2011\",\"May 2008\"]', '[\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\",\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\"]', '[\"Mbsd\",\"Csd\"]', '[\"2024\",\"2025\"]', '2025-08-11 11:40:58', '2025-08-17 11:46:50'),
(4, 4, '[\"1\",\"2\"]', NULL, NULL, '[]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '[]', '2025-08-17 12:57:21', '2025-08-17 12:57:21'),
(5, 2, '[\"1\",\"2\"]', NULL, '35', '[{\"value\":\"Jaw Surgery\"},{\"value\":\"Facial Trauma Management\"},{\"value\":\"Cleft Lip and Palate Surgery\"}]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '[{\"value\":\"Oral & Maxillofacial Surgery\"},{\"value\":\"Prosthodontics\"},{\"value\":\"Periodontology\"}]', '[\"BDS (Bachelor of Dental Surgery)\"]', '[\"King George\\u2019s Medical University, Lucknow\"]', '[\"2018\"]', '[\"Manipal College of Dental Sciences, Manipal\"]', '[\"2019-07-18\"]', '[null]', '[\"Consultant \\/ Specialist\"]', '[\"Hospital Excellence Awards\"]', '[\"2022\"]', '[\"Prestigious global award recognizing groundbreaking discoveries in medical science that improve human health.\"]', '[null]', '[null]', '2025-08-17 12:57:21', '2025-08-19 07:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(12, '2025_08_08_130234_create_appointments_table', 1),
(13, '2025_08_08_130845_create_prescriptions_table', 1),
(14, '2025_08_08_131309_create_feedback_table', 1),
(16, '2025_08_08_133200_add_department_id_to_users_table', 1),
(17, '2025_08_08_141816_add_doctor_id_to_appointments_table', 1),
(18, '2025_08_08_145705_add_status_to_users_table', 1),
(19, '2025_08_08_175335_add_blood_group_to_users_table', 1),
(20, '2025_08_11_143345_create_clinics_table', 2),
(27, '2025_08_11_151913_create_doctor_profiles_table', 3),
(30, '2025_08_12_163638_create_schedule_timings_table', 4),
(31, '2025_08_15_135228_create_social_media_table', 5),
(33, '2025_08_16_175732_add_column_to_doctor_profiles_table', 6),
(34, '2025_08_19_180822_add_clinic_id_to_schedule_timings_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `appointment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medicines` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advice` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_timings`
--

CREATE TABLE `schedule_timings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `clinic_id` int DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 1, 1, 'Saturday', '[\"08:00\"]', '[\"11:00\"]', 1, '2025-08-16 10:39:31', '2025-08-16 10:39:31'),
(10, 2, NULL, 'Saturday', '[\"08:00\"]', '[\"11:00\"]', 1, '2025-08-16 10:39:31', '2025-08-16 10:39:31'),
(11, 2, NULL, 'Tuesday', '[null]', '[null]', 0, '2025-08-14 11:10:04', '2025-08-14 11:10:04'),
(12, 4, NULL, 'Sunday', '[\"08:00\", \"16:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-17 11:59:33', '2025-08-17 11:59:45'),
(13, 4, NULL, 'Monday', '[null]', '[null]', 0, '2025-08-17 11:59:54', '2025-08-17 11:59:54'),
(14, 4, NULL, 'Tuesday', '[\"16:00\"]', '[\"20:00\"]', 1, '2025-08-17 12:00:06', '2025-08-17 12:00:06'),
(15, 4, NULL, 'Wednesday', '[\"08:00\", \"17:00\"]', '[\"11:00\", \"20:00\"]', 1, '2025-08-17 12:00:24', '2025-08-17 12:00:24'),
(16, 4, NULL, 'Friday', '[null]', '[null]', 0, '2025-08-17 12:00:31', '2025-08-17 12:00:31'),
(17, 4, NULL, 'Saturday', '[\"08:00\"]', '[\"12:00\"]', 1, '2025-08-17 12:00:40', '2025-08-17 12:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FTC3hBcjCYPYqbICdxm7Dr0pn661g23RKf9e4mQC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidkMya0huM2l4TTBMaGpOSk5xWHVwVTlIUFdqRjdtbmpyUEZFelZmZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9jbGluaWMtbWFuYWdlbWVudC1zeXN0ZW0udGVzdC91c2VyL2RvY3Rvci8xL3Byb29maWxlL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755629779),
('PcRzR5KkcuIAB9935HnZivsWKyNL13rIy1IQ96Pu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1ZxWEM4WklTRTlQamJoRlBOYktFa0lzWFBaVTg5RWxiUGFSMmtOTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2RvY3Rvci8xL3Byb29maWxlL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755627883),
('QBX12sYzPGn47s7xYAFHmQmjCbU8nj71KbC1SNuQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRXZ4R0J5dTdUaDlDdFBLWHFWN2dzSkF2clR4Q1JwbkJSNUZMT2d4WSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MDoiaHR0cDovL2NsaW5pYy1tYW5hZ2VtZW50LXN5c3RlbS50ZXN0L2FkbWluL2RvY3RvcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MDoiaHR0cDovL2NsaW5pYy1tYW5hZ2VtZW50LXN5c3RlbS50ZXN0L2FkbWluL2RvY3RvcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1755629564),
('RnVXlRiliw0DFGgVSkK2xPPvLguFrohqH8c1jtNx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVZMQzRSNU5hWkNMQkhEOWM4ZUpDWEFvYnRlYlNsb05vbmhFR0dCQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjQ6Imh0dHA6Ly9jbGluaWMtbWFuYWdlbWVudC1zeXN0ZW0udGVzdC91c2VyL2RvY3Rvci82L3Byb29maWxlL3ZpZXciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755629506);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `state_id` bigint UNSIGNED DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `biography` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `phone`, `gender`, `blood_group`, `photo`, `address_line_one`, `city_id`, `state_id`, `country_id`, `postal_code`, `birthday`, `role`, `status`, `biography`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `department_id`) VALUES
(1, 'Dr. Darren Elder', NULL, 'doctor@gmail.com', '8005478', 'male', 'b+', 'uploads/doctors/1754660575.jpg', 'Mirpur', 1, 1, 1, '2525', '2025-08-08', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$sXPYG5shHXncKmGU3sUfJOirkwT09Z/gdttd58bdwST5xanA9aAG.', NULL, '2025-08-08 07:42:55', '2025-08-15 13:07:21', 2),
(2, 'Dr. Deborah Angel', NULL, 'angel@gmail.com', NULL, 'female', 'b+', 'uploads/doctors/1754660633.jpg', 'Dhaka Mirpur', 1, 1, 1, '2525', '2025-08-07', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$j49bf41d0qo/0gD9xlNeVOBphdwWeINqkzuhefmOOgYwqBExd2ClS', NULL, '2025-08-08 07:43:53', '2025-08-19 07:34:15', 1),
(3, 'Charlene Reed', NULL, 'charlene@gmail.com', '01773443625', 'male', 'b-', 'uploads/users/1754660696.jpg', 'Dhaka Mirpur', NULL, NULL, NULL, NULL, '1997-08-04', 'user', 'active', NULL, NULL, '$2y$12$XMn9uCd/BR1eg.aWbMjG5uJhYnnT6eBjBF3nsDbQ1PzFFF27itVl2', NULL, '2025-08-08 07:44:56', '2025-08-08 08:54:07', NULL),
(4, 'Dr. John Gibbs', NULL, 'gibbs@gmail.com', '80034751', 'male', 'b+', 'uploads/doctors/1755275296.jpg', 'Dhaka', 1, 2, 1, '87898', '1999-09-01', 'doctor', 'active', 'BDS, MDS - Oral & Maxillofacial Surgery', NULL, '$2y$12$7CIkPjV1eGrFLkc00m1Beu6jL6Fkp0jk/.8r02XdUlQsBw2CCeqga', NULL, '2025-08-09 01:07:00', '2025-08-17 12:10:50', 4),
(5, 'Charlene Reed', NULL, 'user@gmail.com', '018451855', 'male', 'b+', 'uploads/users/1755284417.jpg', 'Dhaka', 1, 1, 1, '87898', '1998-09-01', 'user', 'active', NULL, NULL, '$2y$12$T7n7byFju5Aahhb9LonIju4cxxRmpyZxNNh3BMEf0r1hWiqfKH9sK', NULL, '2025-08-09 09:03:44', '2025-08-15 13:07:56', NULL),
(7, 'Shaniya Stanton', NULL, 'shayan@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355177.jpg', '2871 Morissette Passage', NULL, NULL, NULL, NULL, '2025-08-15', 'doctor', 'active', NULL, NULL, '$2y$12$bGZMoazivWydMJjoAFGX6uTpz1yRkQ.LhqL4JIPQuafThtGwo0X0C', NULL, '2025-08-16 08:39:37', '2025-08-16 08:39:37', 5),
(8, 'Mikel Batz', NULL, 'fakedata24324@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355234.jpg', '54467 Maximilian Streets', NULL, NULL, NULL, NULL, '2024-10-17', 'doctor', 'active', NULL, NULL, '$2y$12$DrEyRTaJHiFDjzZqF/YTouXCYac/T/9N5Sb.F9GGosvUv/LB7W3e2', NULL, '2025-08-16 08:40:34', '2025-08-16 08:40:34', 1),
(9, 'Rebecca Becker', NULL, 'sdfakedata60990@gmail.com', NULL, NULL, NULL, 'uploads/doctors/1755355295.jpg', '4570 Hobart Avenue', NULL, NULL, NULL, NULL, '2025-10-30', 'doctor', 'active', NULL, NULL, '$2y$12$v5b/tORODjrUbsw3GA8MhuoPqcf4kJ8Jc1qWVnxdobBm6nhMP45yS', NULL, '2025-08-16 08:41:35', '2025-08-16 08:41:35', 1),
(10, 'Winston Russel', NULL, 'paul@gmail.com', NULL, 'male', 'a+', 'uploads/doctors/1755355355.jpg', '785 Verdie Pass', 1, 2, 1, '2525', '2025-08-21', 'doctor', 'active', 'Oral & Maxillofacial Surgery', NULL, '$2y$12$KEFQ4eRIzHM5FrC9oahgiOmGcgWZF.tVfif9/I4UGWMW7kwUvBw8W', NULL, '2025-08-16 08:42:35', '2025-08-18 12:40:25', 5),
(11, 'Carl Kelly', 'O\'Reilly-Toy', 'kelly@gmail.com', '966-969-1958', 'male', 'ab+', 'uploads/users/1755355454.jpg', '37940 Mckenna Prairie', NULL, NULL, NULL, NULL, '2025-05-22', 'user', 'active', NULL, NULL, '$2y$12$CYicfMwwZ1/0V2pyFzeGw.5GA.bUu/UyOf/FgrLiR2jA2GYUehKz6', NULL, '2025-08-16 08:44:14', '2025-08-16 08:44:14', NULL);

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
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_appointment_id_foreign` (`appointment_id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_timings`
--
ALTER TABLE `schedule_timings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
