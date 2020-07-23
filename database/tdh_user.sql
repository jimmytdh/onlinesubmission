-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2020 at 12:43 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdh_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `description`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nursing Attendant II', NULL, NULL, NULL),
(2, 'Nurse I', NULL, NULL, NULL),
(3, 'Nursing Attendant I', NULL, NULL, NULL),
(4, 'Administrative Assistant I', NULL, NULL, NULL),
(5, 'Nurse III', NULL, NULL, NULL),
(6, 'Medical Technologist I', NULL, NULL, NULL),
(7, 'Medical Officer III', NULL, NULL, NULL),
(8, 'Medical Officer IV', NULL, NULL, NULL),
(9, 'Nurse VII', NULL, NULL, NULL),
(10, 'Administrative Officer II', NULL, NULL, NULL),
(11, 'Medical Center Chief II', NULL, NULL, NULL),
(12, 'Laboratory Aide II', NULL, NULL, NULL),
(13, 'Midwife I', NULL, NULL, NULL),
(14, 'Administrative Officer I', NULL, NULL, NULL),
(15, 'Dentist II', NULL, NULL, NULL),
(16, 'Administrative Aide VI', NULL, NULL, NULL),
(17, 'Medical Laboratory Technician III', NULL, NULL, NULL),
(18, 'Nurse II', NULL, NULL, NULL),
(19, 'Nutritionist-Dietitian II', NULL, NULL, NULL),
(20, 'Cook II', NULL, NULL, NULL),
(21, 'PARTIMER-Medical Specialist II', NULL, NULL, NULL),
(22, 'Administrative Assistant III', NULL, NULL, NULL),
(23, 'Chief Administrative Officer', NULL, NULL, NULL),
(24, 'Administrative Assistant II', NULL, NULL, NULL),
(25, 'Medical Technologist III', NULL, NULL, NULL),
(26, 'Administrative Officer III', NULL, NULL, NULL),
(27, 'Administrative Aide III', NULL, NULL, NULL),
(28, 'Pharmacist II', NULL, NULL, NULL),
(29, 'Medical Specialist IV', NULL, NULL, NULL),
(30, 'Medical Equipment Technician I', NULL, NULL, NULL),
(31, 'Administrative Officer IV', NULL, NULL, NULL),
(32, 'Medical Technologist II', NULL, NULL, NULL),
(33, 'Medical Specialist III', NULL, NULL, NULL),
(34, 'Radiologic Technologist II', NULL, NULL, NULL),
(35, 'Social Welfare Assistant', NULL, NULL, NULL),
(36, 'Dental Aide', NULL, NULL, NULL),
(37, 'Respiratory Therapist II', NULL, NULL, NULL),
(38, 'Attorney IV', NULL, NULL, NULL),
(39, 'Social Welfare Officer I', NULL, NULL, NULL),
(40, 'Respitatory Therapist I', NULL, NULL, NULL),
(41, 'CTI-Administrative Aide III', NULL, NULL, NULL),
(42, 'Radiologic Technologist I', NULL, NULL, NULL),
(43, 'CTI-Administrative Aide IV', NULL, NULL, NULL),
(44, 'Supervising Administrative Officer', NULL, NULL, NULL),
(45, 'Accountant III', NULL, NULL, NULL),
(46, 'Nutritionist-Dietitian IV', NULL, NULL, NULL),
(47, 'Financial & Management Officer II', NULL, NULL, NULL),
(48, 'Engineer IV', NULL, NULL, NULL),
(49, 'Social Welfare Officer II', NULL, NULL, NULL),
(50, 'Medical Technologist I ', NULL, NULL, NULL),
(51, 'Midwife II', NULL, NULL, NULL),
(52, 'Computer Maintenance Technologist II', NULL, NULL, NULL),
(53, 'Administrative Officer V', NULL, NULL, NULL),
(54, 'Medical Specialist II', NULL, NULL, NULL),
(55, 'Laundry Worker II', NULL, NULL, NULL),
(56, 'Chief of Medical Professional Services II', NULL, NULL, NULL),
(57, 'Administrative Aide IV', NULL, NULL, NULL),
(58, 'Engineering III', NULL, NULL, NULL),
(59, 'CTI-Medical Technician I', NULL, NULL, NULL),
(60, 'Engineer III', NULL, NULL, NULL),
(61, 'HEPO III', NULL, NULL, NULL),
(62, 'Medical Equipment Technician III', NULL, NULL, NULL),
(63, 'Hospital Housekeeper', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE IF NOT EXISTS `division` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `head` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `description` (`description`,`head`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `description`, `head`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Medical Center Chief', 1, NULL, NULL, '2020-03-30 08:45:52'),
(2, 'Hospital Operations and Patient Support Services', 1, NULL, '2019-12-23 02:39:28', '2020-03-30 08:45:40'),
(3, 'Medical Professional Services', 1, NULL, '2020-03-30 08:43:50', '2020-03-30 08:43:50'),
(4, 'Nursing Services', 1, NULL, '2020-03-30 08:44:16', '2020-03-30 08:44:16'),
(5, 'Financial Services', 1, NULL, '2020-03-30 08:44:39', '2020-03-30 08:44:39'),
(6, 'Legal and Quality Management Services', 1, NULL, '2020-03-30 08:45:14', '2020-03-30 08:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `division` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `head` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `division` (`division`,`description`,`head`,`code`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `division`, `description`, `head`, `code`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ambulatory and Emergency Services', 1, 'AMBU', NULL, NULL, NULL),
(2, 3, 'General Surgery', 1, 'SURG', NULL, NULL, NULL),
(3, 3, 'Obstetrics and Gynecology', 1, 'OBGYN', NULL, NULL, NULL),
(4, 3, 'Anesthesia', 1, 'ANES', NULL, NULL, NULL),
(5, 3, 'Internal Medicine', 1, 'IM', NULL, NULL, NULL),
(6, 3, 'Pediatrics', 1, 'PEDIA', NULL, NULL, NULL),
(7, 3, 'Health Information Management Office', 1, 'INFO', NULL, NULL, NULL),
(8, 3, 'Medical Social Services', 1, 'MSW', NULL, NULL, NULL),
(9, 3, 'Pharmacy', 1, 'PHARMA', NULL, NULL, NULL),
(10, 3, 'Nutrition and Dietetics', 1, 'DIET', NULL, NULL, NULL),
(11, 3, 'Laboratory', 1, 'LAB', NULL, NULL, NULL),
(12, 3, 'Radiology and Imaging', 1, 'RADIO', NULL, NULL, NULL),
(13, 3, 'Dental Services', 1, 'DENTAL', NULL, NULL, NULL),
(14, 4, 'Training and Research', 1, 'TRAIN', NULL, NULL, NULL),
(15, 2, 'Human Resource Management', 1, 'HR', NULL, NULL, NULL),
(16, 2, 'Supply', 1, 'SUPPLY', NULL, NULL, NULL),
(17, 2, 'Maintenance', 1, 'MAIN', NULL, NULL, NULL),
(18, 2, 'Bio Med', 1, 'BIO', NULL, NULL, NULL),
(19, 2, 'EFM', 1, 'EFM', NULL, NULL, NULL),
(20, 1, 'MCC Office', 1, 'MCCO', NULL, NULL, NULL),
(21, 1, 'iHOMP', 1, 'IT', NULL, NULL, NULL),
(22, 1, 'HEMB', 1, 'HEMB', NULL, NULL, NULL),
(23, 1, 'CMPS', 1, 'CMPS', NULL, NULL, NULL),
(24, 1, 'PETRO', 1, 'PETRO', NULL, NULL, NULL),
(25, 1, 'IPCC', 1, 'IPCC', NULL, NULL, NULL),
(26, 5, 'Cash', 1, 'CASH', NULL, NULL, NULL),
(27, 5, 'Budget', 1, 'BUDGET', NULL, NULL, NULL),
(28, 5, 'Accounting', 1, 'ACCOUNT', NULL, NULL, NULL),
(29, 5, 'Billing', 1, 'BILLING', NULL, NULL, NULL),
(30, 6, 'Qualit Management Service', 1, 'QMS', NULL, NULL, NULL),
(31, 6, 'Legal Affairs', 1, 'LEGAL', NULL, NULL, NULL),
(32, 6, 'Procurement', 1, 'PU', NULL, NULL, NULL),
(33, 6, 'BAC', 1, 'BAC', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `designation` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_priv` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `fname` (`fname`,`mname`,`lname`,`division`,`section`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `username`, `designation`, `division`, `section`, `password`, `user_priv`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jimmy', 'B.', 'Parker', 'admin', 1, 1, 1, '$2y$10$aNv9fao1TPhU.EU4mbo4/.rRu6gffn6K5fRaCngBQznODIxOrH9Om', 1, 1, 'wePGSzfXlU46IRVk6Zljimozf7vWy6atZ0kO2AAJW1XhbogK6lgjauKjajd2', NULL, '2020-06-29 05:00:09'),
(2, 'JOHN', 'X', 'DOE', 'john', 1, 2, 2, '$2y$10$n7j1mXLq3grodoVX.UbAhecozV3IDckyDP9LI8CETgaFI.89bNd.6', 0, 1, 'pRrKsRukTfrxzDf5lbJdMEBWai6cjx4M27qDQ31MdI1TSPTTlargv6YVWzVy', '2020-03-30 12:36:32', '2020-03-30 13:32:39'),
(3, 'JIMMY', 'X.', 'PARKER', 'jparker', 52, 1, 21, '$2y$10$yAP7V/XCLD90TMzyK1zlF.RaCxPlJy2ZRdr2E/VBDFFfBGh1eyy06', 0, 0, NULL, '2020-06-29 04:56:22', '2020-06-29 04:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_priv`
--

DROP TABLE IF EXISTS `user_priv`;
CREATE TABLE IF NOT EXISTS `user_priv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `syscode` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_priv`
--

INSERT INTO `user_priv` (`id`, `user_id`, `syscode`, `level`) VALUES
(1, 1, 'csr', 'admin'),
(2, 1, 'bidding', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
