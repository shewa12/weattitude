-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2019 at 11:36 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weattitude`
--

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) UNSIGNED DEFAULT NULL,
  `type` varchar(555) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `changeover` varchar(255) NOT NULL,
  `contract` tinytext NOT NULL,
  `debit` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_serviceId` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

DROP TABLE IF EXISTS `funds`;
CREATE TABLE IF NOT EXISTS `funds` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fund_type` varchar(255) NOT NULL,
  `description` mediumtext,
  `created_at` varchar(255) DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fund_type`, `description`, `created_at`, `amount`) VALUES
(1, 'Inflow', 'Ads Revenue', 'July 2018', '13000.00'),
(2, 'Inflow', 'Donation', 'July 2018', '9000.00'),
(3, 'Inflow', 'Paid Services', 'July 2018', '8500.00'),
(4, 'Inflow', 'Ads Revenue', 'August 2018', '15000.00'),
(5, 'Inflow', 'Donations', 'August 2018', '10000.00'),
(6, 'Inflow', 'Paid Services', 'August 2018', '7500.00'),
(7, 'Inflow', 'Ads Revenue', 'September 2018', '13000.00'),
(8, 'Inflow', 'Donations', 'September 2018', '9000.00'),
(9, 'Inflow', 'Paid Services', 'September 2018', '8500.00'),
(10, 'Inflow', 'Ads Revenue', 'October 2018', '15000.00'),
(11, 'Inflow', 'Donations', 'October 2018', '10000.00'),
(12, 'Inflow', 'Paid Services', 'October 2018', '7500.00'),
(13, 'Inflow', 'Ads Revenue', 'November 2018', '50000.00'),
(14, 'Inflow', 'Donations', 'November 2018', '25000.00'),
(15, 'Inflow', 'Paid Services', 'November 2018', '35500.00'),
(16, 'Inflow', 'Data Subscriptions', 'November 2018', '16000.00'),
(17, 'Outflow', 'Contributions to Charities', 'July 2018', '8000.00'),
(18, 'Outflow', 'Scholarships', 'July 2018', '10000.00'),
(19, 'Outflow', 'Admin Expenses', 'July 2018', '3000.00'),
(20, 'Outflow', 'Contributions to Charities', 'August 2018', '2500.00'),
(21, 'Outflow', 'Scholarships', 'August 2018', '9000.00'),
(22, 'Outflow', 'Admin Expenses', 'August 2018', '9500.00'),
(23, 'Outflow', 'Contributions to Charities', 'September 2018', '14000.00'),
(24, 'Outflow', 'Scholarships', 'September 2018', '10000.00'),
(25, 'Outflow', 'Admin Expenses', 'September 2018', '3000.00'),
(26, 'Outflow', 'Contributions to Charities', 'October 2018', '2500.00'),
(27, 'Outflow', 'Scholarships', 'October 2018', '9000.00'),
(28, 'Outflow', 'Admin Expenses', 'October 2018', '9500.00'),
(29, 'Outflow', 'Health Center Construction', 'October 2018', '75000.00'),
(30, 'Outflow', 'Contributions to Charities', 'November 2018', '14000.00'),
(31, 'Outflow', 'Scholarships', 'November 2018', '9000.00'),
(32, 'Outflow', 'Admin Expenses', 'November 2018', '9500.00');

-- --------------------------------------------------------

--
-- Table structure for table `initiatives`
--

DROP TABLE IF EXISTS `initiatives`;
CREATE TABLE IF NOT EXISTS `initiatives` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `issue_id` int(11) UNSIGNED NOT NULL,
  `recomm_id` int(11) UNSIGNED NOT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userIdForIni` (`user_id`),
  KEY `issueIdForIni` (`issue_id`),
  KEY `recommIdForIni` (`recomm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `interest_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userIdForInterest` (`user_id`),
  KEY `interestId` (`interest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `user_id`, `interest_id`, `created_at`, `updated_at`) VALUES
(7, 14, 19, '2018-09-30 17:34:53', '2018-09-30 17:34:53'),
(8, 16, 6, '2018-10-09 06:30:05', '2018-10-09 06:30:05'),
(9, 16, 16, '2018-10-09 06:30:29', '2018-10-09 06:30:29'),
(10, 16, 3, '2018-10-09 06:30:47', '2018-10-09 06:30:47'),
(11, 16, 1, '2018-10-15 11:05:10', '2018-10-15 11:05:10'),
(12, 17, NULL, '2018-11-03 16:10:16', '2018-11-03 16:10:16'),
(13, 17, 7, '2018-11-03 16:10:46', '2018-11-03 16:10:46'),
(14, 17, 16, '2018-11-03 16:11:17', '2018-11-03 16:11:17'),
(15, 14, 3, '2019-08-19 07:11:02', '2019-08-19 07:11:02'),
(16, 14, 6, '2019-08-19 07:11:02', '2019-08-19 07:11:02'),
(17, 14, 9, '2019-08-19 07:11:02', '2019-08-19 07:11:02'),
(18, 14, 20, '2019-08-19 07:11:02', '2019-08-19 07:11:02'),
(19, 14, 23, '2019-08-19 07:17:31', '2019-08-19 07:17:31'),
(20, 14, 7, '2019-08-19 07:19:47', '2019-08-19 07:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `interesttext`
--

DROP TABLE IF EXISTS `interesttext`;
CREATE TABLE IF NOT EXISTS `interesttext` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `interest` varchar(255) DEFAULT NULL,
  `interest_non_unique` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interesttext`
--

INSERT INTO `interesttext` (`id`, `interest`, `interest_non_unique`, `type`) VALUES
(1, 'Web Developer (Job Role)', 'Web Developer', 'Job Role'),
(2, 'interest', 'interest_non_unique', 'type'),
(3, 'Marketing Specialist (Job Role)', 'Marketing Specialist', 'Job Role'),
(4, 'Marketing Manager (Job Role)', 'Marketing Manager', 'Job Role'),
(5, 'Project Manager (Job Role)', 'Project Manager', 'Job Role'),
(6, 'Teaching (Job Role)', 'Teaching', 'Job Role'),
(7, 'Administration (Skill)', 'Administration', 'Skill'),
(8, 'Project Management (Skill)', 'Project Management', 'Skill'),
(9, 'Marketing (Hobby)', 'Marketing', 'Hobby'),
(10, 'Marketing (Job Role)', 'Marketing', 'Job Role'),
(11, 'Proof Reading (Skill)', 'Proof Reading', 'Skill'),
(12, 'AutoCAD (Software)', 'AutoCAD', 'Software'),
(13, 'Primavera (Software)', 'Primavera', 'Software'),
(14, 'Python (Software)', 'Python', 'Software'),
(15, 'R (Software)', 'R', 'Software'),
(16, 'Baking (Hobby)', 'Baking', 'Hobby'),
(17, 'Innovating (Hobby)', 'Innovating', 'Hobby'),
(18, 'Hunting (Hobby)', 'Hunting', 'Hobby'),
(19, 'Singing (Skill)', 'Singing', 'Skill'),
(20, 'Singing (Hobby)', 'Singing', 'Hobby'),
(21, 'Teaching (Hobby)', 'Teaching', 'Hobby'),
(22, 'Mentoring Children (Hobby)', 'Mentoring Children', 'Hobby'),
(23, 'Fishing (Hobby)', 'Fishing', 'Hobby');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(11) NOT NULL,
  `region_id` int(11) UNSIGNED DEFAULT NULL,
  `content` longtext,
  `severity` varchar(255) DEFAULT NULL,
  `issue_severity_score` varchar(255) DEFAULT NULL,
  `issue_ranking_within_region` varchar(255) DEFAULT NULL,
  `issue_popularity_count` varchar(255) DEFAULT NULL,
  `issue_popularity_score` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `regionsIdForissue` (`region_id`),
  KEY `UserIdForIssue` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `user_id`, `location_id`, `region_id`, `content`, `severity`, `issue_severity_score`, `issue_ranking_within_region`, `issue_popularity_count`, `issue_popularity_score`, `created_at`, `updated_at`) VALUES
(3, 14, 0, 6, 'some information', '', NULL, NULL, '1', NULL, '2018-09-29 17:17:48', '2018-09-29 17:17:48'),
(4, 14, 0, 2, 'Bangladesh is development country', '', NULL, NULL, '2', NULL, '2018-10-02 16:21:09', '2018-10-02 16:21:09'),
(5, 16, 0, 7, 'Low access to renewable energy', '', NULL, NULL, '1', NULL, '2018-10-09 06:31:58', '2018-10-09 06:31:58'),
(8, 16, 0, 8, 'Ability to attract foreign workers', '', NULL, NULL, '3', NULL, '2018-10-09 06:33:42', '2018-10-09 06:33:42'),
(9, 16, 0, 9, 'Insufficient Tech jobs', '', NULL, NULL, '2', NULL, '2018-10-09 06:45:46', '2018-10-09 06:45:46'),
(11, 14, 0, 4, 'there was heavy clash', 'High', NULL, NULL, '1', NULL, '2018-10-10 18:47:02', '2018-10-10 18:47:02'),
(13, 16, 0, 10, 'Low access to quality education', 'High', NULL, NULL, '1', NULL, '2018-10-11 06:52:57', '2018-10-11 06:52:57'),
(14, 17, 0, 13, 'Malaria', 'Low', NULL, NULL, '3', NULL, '2018-11-03 16:12:06', '2018-11-03 16:12:06'),
(15, 14, 2, NULL, 'New test issue ', NULL, NULL, NULL, NULL, NULL, '2019-08-20 05:50:37', '2019-08-20 05:50:37'),
(16, 14, 4, NULL, 'New test issue ', NULL, NULL, NULL, NULL, NULL, '2019-08-20 05:50:37', '2019-08-20 05:50:37'),
(17, 14, 1, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, NULL, NULL, NULL, '2019-08-20 05:51:46', '2019-08-20 05:51:46'),
(18, 14, 8, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, NULL, NULL, NULL, '2019-08-20 05:51:46', '2019-08-20 05:51:46'),
(19, 14, 1, NULL, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL, NULL, '2019-08-20 06:00:41', '2019-08-20 06:00:41'),
(20, 14, 7, NULL, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL, NULL, '2019-08-20 06:00:41', '2019-08-20 06:00:41'),
(21, 14, 1, NULL, 'test issue', NULL, NULL, NULL, NULL, NULL, '2019-08-20 06:02:29', '2019-08-20 06:02:29'),
(22, 14, 7, NULL, 'test issue', NULL, NULL, NULL, NULL, NULL, '2019-08-20 06:02:29', '2019-08-20 06:02:29'),
(23, 14, 6, NULL, 'issue added for bangladesh', NULL, NULL, NULL, NULL, NULL, '2019-08-22 10:38:53', '2019-08-22 10:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent-name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `location_level`, `parent_id`, `parent-name`, `parent_level`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 'World', 'World', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Dhaka City', 'City', '4', 'Dhaka Division', 'Division', '23.728783', '90.393791', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Chittagong City', 'City', '5', 'Chittagong Division', 'Division', '22.3419', '91.815536', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Dhaka Division', 'Division', '6', 'Bangladesh', 'Country', '24.5239682', '90.2995785', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Chittagong Division', 'Division', '6', 'Bangladesh', 'Country', '22.7982242', '91.9881527', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Bangladesh', 'Country', '8', 'South Asia', 'Region Area', '23.777176', '90.399452', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'India', 'Country', '8', 'South Asia', 'Region Area', '20.5937', '78.9629', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'South Asia', 'Region Area', '10', 'Asia', 'Region', '25.0376', '76.4563', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'East Asia', 'Region Area', '10', 'Asia', 'Region', '38.7946', '106.5348', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Asia', 'Region', '1', 'World', 'World', '34.0479', '100.6197', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Africa', 'Region', '1', 'World', 'World', '8.7832', '34.5085', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mark_delete`
--

DROP TABLE IF EXISTS `mark_delete`;
CREATE TABLE IF NOT EXISTS `mark_delete` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `initIdForMarkDelte` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark_delete`
--

INSERT INTO `mark_delete` (`id`, `user_id`, `type_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 14, 23, 'issue', '2019-08-22 11:30:30', '2019-08-22 11:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 2),
(5, '2018_04_15_042243_create_admin_table', 2),
(6, '2018_07_29_044952_age', 2),
(7, '2018_07_29_070803_services', 3),
(8, '2018_07_29_072758_add_detail_columnsTo_usersTable', 4),
(9, '2018_07_29_074137_add_col_to_usersTable', 5),
(10, '2018_07_31_074526_locations', 6),
(11, '2018_09_13_040857_paymentstable', 7);

-- --------------------------------------------------------

--
-- Table structure for table `ongoing_project`
--

DROP TABLE IF EXISTS `ongoing_project`;
CREATE TABLE IF NOT EXISTS `ongoing_project` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `detail` longtext NOT NULL,
  `lat` decimal(11,6) NOT NULL,
  `lng` decimal(11,6) NOT NULL,
  `timeframe` varchar(255) DEFAULT NULL,
  `timeframe_icon` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongoing_project`
--

INSERT INTO `ongoing_project` (`id`, `location_name`, `detail`, `lat`, `lng`, `timeframe`, `timeframe_icon`, `created_at`, `updated_at`) VALUES
(1, 'Southeast Cambodia', 'As a result of the Weattitude Project initiative in Southeast Cambodia, amongst other things, there will be an estimated 15% decrease in college drop out rate.\n\nWe estimate this would take average income level up by 10% in the next 4 years, resulting in a decrease in crime rate and corruption of 18% and 10% respectively. Let\'s keep up the WE attitude!', '12.565700', '0.000000', '104.991', '<i class=\"far fa-clock\"></i>', NULL, NULL),
(2, 'Northeast Yemen', 'As a result of the WEattitude Project initiative, amongst other things, terrorism enrolment in Northeast Yemen is estimated to decrease by 25%\n\nWe estimate this would take average income level up by 16% in the next 4 years, resulting in improved access to proper healthcare, education and self sufficiency.\n\nWe estimate that the indices for access to healthcare, education and self-sufficiency will increase by 10%, 12% and 16% respectiverly, over the next 4 years. Let\'s keep up the WE attitude!', '15.552700', '48.516400', '4 Years', '<i class=\"far fa-clock\"></i>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shewa@gmail.com', '18ffb240b7a78fb80b262ae86affddae67a0e18391dbc125fae80beb16748f56', '2018-08-06 22:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customerId` int(11) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accountName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bsb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accountNum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userIDForPayments` (`customerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_indicator`
--

DROP TABLE IF EXISTS `project_indicator`;
CREATE TABLE IF NOT EXISTS `project_indicator` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(11) UNSIGNED NOT NULL,
  `indicator_value` mediumtext,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projectIdForIndi` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_indicator`
--

INSERT INTO `project_indicator` (`id`, `project_id`, `indicator_value`, `title`, `type`, `icon`, `direction`, `created_at`, `updated_at`) VALUES
(1, 1, '15% (700 less people)', 'College Drop Out Rate', 'indicator', 'fas fa-users', 'fas fa-arrow-down', NULL, NULL),
(2, 1, '10% (average +205k riel)', 'Income Level', 'indicator', 'fas fa-money-bill-alt', 'fas fa-long-arrow-alt-up', NULL, NULL),
(3, 1, '18%', 'Corruption Index', 'indicator', 'fas fa-users', 'fas fa-long-arrow-alt-up', NULL, NULL),
(4, 1, 'Down by 18% (900 less robberies)', 'Crime Rate', 'outcome', 'fas fa-user-ninja', 'fas fa-arrow-down', NULL, NULL),
(5, 2, '25% (800 less people)', 'Enrolment in Terrorism', 'indicator', 'fas fa-link', 'fas fa-arrow-down', NULL, NULL),
(6, 2, '12% (120k more people)', 'Access to Education Index', 'indicator', 'fas fa-graduation-cap', 'fas fa-long-arrow-alt-up', NULL, NULL),
(7, 2, '10% (150k more people)', 'Access to Healthcare Index', 'indicator', 'fas fa-hospital', 'fas fa-long-arrow-alt-up', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userIdForRating` (`user_id`),
  KEY `initIdForRating` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `type_id`, `type`, `rating`, `created_at`, `updated_at`) VALUES
(12, 14, 23, 'issue', 5, '2019-08-22 10:39:06', '2019-08-22 10:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `recomm`
--

DROP TABLE IF EXISTS `recomm`;
CREATE TABLE IF NOT EXISTS `recomm` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `issue_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `recommendation` longtext,
  `initiatives` longtext,
  `ongoing_initiatives_detail` longtext,
  `recommendation_detail` longtext,
  `umbrella_recomm_id` varchar(255) DEFAULT NULL,
  `recomm_impact_score` varchar(255) DEFAULT NULL,
  `recomm_impact_category` varchar(255) DEFAULT NULL,
  `recomm_ranking_within_region` varchar(255) DEFAULT NULL,
  `recomm_popularity_count` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IssueIdForRecomm` (`issue_id`),
  KEY `UserIdForRecomm` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recomm`
--

INSERT INTO `recomm` (`id`, `issue_id`, `user_id`, `location_id`, `recommendation`, `initiatives`, `ongoing_initiatives_detail`, `recommendation_detail`, `umbrella_recomm_id`, `recomm_impact_score`, `recomm_impact_category`, `recomm_ranking_within_region`, `recomm_popularity_count`, `created_at`, `updated_at`) VALUES
(2, 4, 14, NULL, 'should become developed ', 'nothing', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '12', 'High', NULL, '14/234', '2018-10-02 16:30:24', '2018-10-02 16:30:24'),
(3, 8, 16, NULL, 'More tourism advertisements', 'Red Cross', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '10', 'Medium', NULL, '144/334', '2018-10-09 06:34:30', '2018-10-09 06:34:30'),
(4, 5, 16, NULL, 'Invite renewable energy companies', 'United Nations', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '100', 'Low', NULL, '24/134', '2018-10-09 06:47:15', '2018-10-09 06:47:15'),
(5, 9, 16, NULL, 'Create more awareness for Fiverr', 'Fiverr', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '5', 'High', NULL, '140/234', '2018-10-12 14:01:42', '2018-10-12 14:01:42'),
(6, 11, 14, NULL, 'no recommendation there are awesome', 'nothing', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '7', 'Low', NULL, '204/444', '2018-10-12 14:07:06', '2018-10-12 14:07:06'),
(7, 14, 17, NULL, 'Vaccination', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, '111', 'Medium', NULL, '204/444', '2018-11-03 16:12:18', '2018-11-03 16:12:18'),
(8, 4, 14, NULL, 'test recommendation', 'test initiatives', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-30 12:11:31', '2018-12-30 12:11:31'),
(9, 11, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', 'itself.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:10:56', '2018-12-31 09:10:56'),
(10, 11, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', 'tableau server', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:11:07', '2018-12-31 09:11:07'),
(11, 4, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', 'wanting to do', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:11:16', '2018-12-31 09:11:16'),
(12, 4, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:11:26', '2018-12-31 09:11:26'),
(13, 3, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:11:38', '2018-12-31 09:11:38'),
(14, 3, 14, NULL, 'You should look into Trusted Tickets. It does what you are wanting to do, but it requires some backend API call processing.\r\n\r\nYou also need access to set some settings on the tableau server itself.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-31 09:11:49', '2018-12-31 09:11:49'),
(15, 11, 14, 0, 'test recomm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 11:45:02', '2019-08-20 11:45:02'),
(16, 16, 14, 4, 'test recomm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 11:45:02', '2019-08-20 11:45:02'),
(17, 4, 14, 0, 'Australia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after suffering concussion, Cricket Australia announced Tuesday.\r\n\r\nThe 30-year-old -- who has scored two centuries and 92 in his three innings in the first two Tests -- was felled by a Jofra Archer bouncer on Saturday in the first innings of the second Test at Lord’s.\r\n\r\n“Steve Smith has been ruled out of the third Ashes Test at Headingley, with coach Justin Langer confirming the news after the batsman sat out Australia’s training session on Tuesday,” Cricket Australia announced on their website.\r\n\r\nThe team doctor Richard Saw had the final say on whether Smith played or not and he was seen speaking with him during team training on Tuesday. According to the website vice-captain Pat Cummins patted Smith on the shoulder and coach Justin Langer wrapped his arm round the former captain as the rest of the squad trained without him.\r\n\r\nSmith, whose two centuries in the first Test were pivotal in Australia taking a 1-0 lead, returned t so bat on Saturday despite the blow to the side of the head that felled him. He added 12 runs before being out.\r\nAustralia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after sufferin sfjkfh hjkfhkf fhsdjk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 07:21:24', '2019-08-21 07:21:24'),
(18, 16, 14, 4, 'Australia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after suffering concussion, Cricket Australia announced Tuesday.\r\n\r\nThe 30-year-old -- who has scored two centuries and 92 in his three innings in the first two Tests -- was felled by a Jofra Archer bouncer on Saturday in the first innings of the second Test at Lord’s.\r\n\r\n“Steve Smith has been ruled out of the third Ashes Test at Headingley, with coach Justin Langer confirming the news after the batsman sat out Australia’s training session on Tuesday,” Cricket Australia announced on their website.\r\n\r\nThe team doctor Richard Saw had the final say on whether Smith played or not and he was seen speaking with him during team training on Tuesday. According to the website vice-captain Pat Cummins patted Smith on the shoulder and coach Justin Langer wrapped his arm round the former captain as the rest of the squad trained without him.\r\n\r\nSmith, whose two centuries in the first Test were pivotal in Australia taking a 1-0 lead, returned t so bat on Saturday despite the blow to the side of the head that felled him. He added 12 runs before being out.\r\nAustralia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after sufferin sfjkfh hjkfhkf fhsdjk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 07:21:24', '2019-08-21 07:21:24'),
(19, 18, 14, 8, 'Australia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after suffering concussion, Cricket Australia announced Tuesday.\r\n\r\nThe 30-year-old -- who has scored two centuries and 92 in his three innings in the first two Tests -- was felled by a Jofra Archer bouncer on Saturday in the first innings of the second Test at Lord’s.\r\n\r\n“Steve Smith has been ruled out of the third Ashes Test at Headingley, with coach Justin Langer confirming the news after the batsman sat out Australia’s training session on Tuesday,” Cricket Australia announced on their website.\r\n\r\nThe team doctor Richard Saw had the final say on whether Smith played or not and he was seen speaking with him during team training on Tuesday. According to the website vice-captain Pat Cummins patted Smith on the shoulder and coach Justin Langer wrapped his arm round the former captain as the rest of the squad trained without him.\r\n\r\nSmith, whose two centuries in the first Test were pivotal in Australia taking a 1-0 lead, returned t so bat on Saturday despite the blow to the side of the head that felled him. He added 12 runs before being out.\r\nAustralia’s star batsman Steve Smith has been ruled out of the third Ashes Test beginning on Thursday after sufferin sfjkfh hjkfhkf fhsdjk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 07:21:24', '2019-08-21 07:21:24'),
(20, 17, 14, 1, 'test recomm added', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 09:56:48', '2019-08-21 09:56:48'),
(21, 17, 14, 5, 'test recomm added', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 09:56:48', '2019-08-21 09:56:48'),
(22, 17, 14, 8, 'test recomm added', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-21 09:56:48', '2019-08-21 09:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `inform` tinytext,
  `criteria` varchar(255) DEFAULT NULL,
  `specific_location` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `locationId` (`location_id`),
  KEY `userIdForregion` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `location_id`, `user_id`, `inform`, `criteria`, `specific_location`, `created_at`, `updated_at`) VALUES
(2, 6, 14, '', NULL, 0, '2018-09-29 08:07:00', '2018-09-29 08:07:00'),
(3, 3, 14, '', NULL, 0, '2018-09-29 08:07:50', '2018-09-29 08:07:50'),
(4, 9, 14, 'yes', NULL, 0, '2018-09-29 17:14:47', '2018-09-29 17:14:47'),
(5, 4, 14, 'yes', NULL, 0, '2018-09-29 17:15:27', '2018-09-29 17:15:27'),
(6, 8, 14, NULL, NULL, 0, '2018-09-29 17:17:48', '2018-09-29 17:17:48'),
(7, 2, 16, 'yes', NULL, 0, '2018-10-09 06:31:58', '2018-10-09 06:31:58'),
(8, 7, 16, 'yes', NULL, 0, '2018-10-09 06:32:49', '2018-10-09 06:32:49'),
(9, 8, 16, 'yes', NULL, 0, '2018-10-09 06:45:46', '2018-10-09 06:45:46'),
(10, 11, 16, 'yes', NULL, 0, '2018-10-09 07:24:10', '2018-10-09 07:24:10'),
(11, 9, 16, 'yes', NULL, 0, '2018-10-09 07:25:30', '2018-10-09 07:25:30'),
(12, 9, 17, NULL, NULL, 0, '2018-11-03 16:11:33', '2018-11-03 16:11:33'),
(13, 6, 17, NULL, NULL, 0, '2018-11-03 16:11:48', '2018-11-03 16:11:48'),
(14, 2, 14, NULL, 'on', 0, '2019-08-19 08:16:11', '2019-08-19 08:16:11'),
(15, 7, 14, NULL, 'on', 0, '2019-08-19 08:16:11', '2019-08-19 08:16:11'),
(16, 2, 14, NULL, 'Issues', 0, '2019-08-19 08:19:31', '2019-08-19 08:19:31'),
(17, 6, 14, NULL, 'Issues', 0, '2019-08-19 08:19:31', '2019-08-19 08:19:31'),
(18, 8, 14, NULL, NULL, 1, '2019-08-19 08:44:48', '2019-08-19 08:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featuers` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solarFriendly` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pertnership` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `availableIn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills_resources_required`
--

DROP TABLE IF EXISTS `skills_resources_required`;
CREATE TABLE IF NOT EXISTS `skills_resources_required` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `umbrell_id` int(11) UNSIGNED NOT NULL,
  `recomm_id` int(11) UNSIGNED NOT NULL,
  `skills_required` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills_resources_required`
--

INSERT INTO `skills_resources_required` (`id`, `umbrell_id`, `recomm_id`, `skills_required`) VALUES
(1, 6, 6, 'Administrator'),
(2, 0, 6, 'skills_required'),
(3, 6, 6, 'Blogging'),
(4, 2, 5, 'Administrator'),
(5, 2, 5, 'Social Media'),
(6, 2, 5, 'Blogging'),
(7, 2, 2, 'Administrator'),
(8, 2, 2, 'Social Media'),
(9, 2, 2, 'Health Professional'),
(10, 2, 2, 'Social Media'),
(11, 2, 2, 'Health Professional'),
(12, 2, 3, 'Administrator'),
(13, 3, 3, 'Social Media'),
(14, 3, 3, 'Blogging'),
(15, 3, 3, 'Financial Contribution'),
(16, 3, 3, 'Social Media'),
(17, 5, 3, 'Blogging'),
(18, 5, 3, 'Financial Contribution'),
(19, 5, 4, 'Social Media'),
(20, 5, 4, 'Blogging'),
(21, 5, 4, 'Financial Contribution'),
(22, 5, 4, 'Administrator'),
(23, 5, 4, 'Video Creation');

-- --------------------------------------------------------

--
-- Table structure for table `umbrella_recomm`
--

DROP TABLE IF EXISTS `umbrella_recomm`;
CREATE TABLE IF NOT EXISTS `umbrella_recomm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recommendation` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `umbrella_recomm`
--

INSERT INTO `umbrella_recomm` (`id`, `recommendation`) VALUES
(1, 'The noun people has both a PLURAL sense and a SINGULAR sense. In the PLURAL sense, people is used as the plural of person very frequently. It is a plural count noun and takes a plural verb. It never has an -s ending; it is already plural.'),
(2, 'The noun people has both a PLURAL sense and a SINGULAR sense. In the PLURAL sense, people is used as the plural of person very frequently. It is a plural count noun and takes a plural verb. It never has an -s ending; it is already plural.'),
(3, 'The noun people has both a PLURAL sense and a SINGULAR sense. In the PLURAL sense, people is used as the plural of person very frequently. It is a plural count noun and takes a plural verb. It never has an -s ending; it is already plural.'),
(4, 'The noun people has both a PLURAL sense and a SINGULAR sense. In the PLURAL sense, people is used as the plural of person very frequently. It is a plural count noun and takes a plural verb. It never has an -s ending; it is already plural.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_path` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8_unicode_ci,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(2) NOT NULL DEFAULT '1',
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recognitionSign` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `lname`, `email`, `image`, `image_path`, `about`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `age`, `address`, `region`, `accountNumber`, `phoneNumber`, `recognitionSign`) VALUES
(14, 'shewa', 'shaikh', 'ahmed', 'shewa@gmail.com', 'corporate-client-service.jpg', 'C:\\xampp\\tmp\\phpB898.tmp', NULL, '$2y$10$er2i921HzoP6shP9yEKkgOXN7qIG37MdRktgKGRFIeBTVSjMYYxQS', 'I7UDjVebYTlyL6uPdAZgS3KD9XgQAvTutmXwn6nGlKW4uYUBCQBuQIl4nUgG', '2018-09-26 11:30:16', '2019-08-22 04:21:47', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'ninad', NULL, NULL, 'ninad@gmail.com', NULL, NULL, NULL, '$2y$10$sVd3Q9YJVlkfKVN/Ai5UpOiItNkZEu8zwBLuRIbxin5QphxD/XfVm', 'wZAwY1Z8JnmRZNfF4TYyIek0n6tVQ1Cu4zgBa3VqPiaiADQZ56HLGiWjyWEU', '2018-10-09 11:28:00', '2018-10-09 11:28:21', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'test', 'TestFirstName', 'TestLastName', 'test@test.com', 'cropped_i acknowledge you_g.png', '/tmp/phpDMNfCC', NULL, '$2y$10$ohHXpuWiOwSZhq.KmsstcuQFEE86Cvr6QzR5nezodmtW30yZkUn.C', 'qshHjxOAXwisxd3UQu99jQGCf8678b27YUOStGnAeL60zIjPyrez8QyadgVB', '2018-10-09 12:28:49', '2018-12-31 18:29:29', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'gtest', '', '', 'gtest@test.mail', 'i_acknowledge_u_g.jpg', '/tmp/phpa9SDdu', NULL, '$2y$10$v8SoVVTJeb6hgFitr5g9FeqaXHmKIFknlw.lYjry.q5cpeXybVHfS', NULL, '2018-11-03 22:09:57', '2018-11-03 22:12:59', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `title` mediumtext NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `videoPath` varchar(255) DEFAULT NULL,
  `essay` longtext,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `UserIdForVideo` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `video`, `videoPath`, `essay`, `tags`, `created_at`, `updated_at`) VALUES
(6, 14, 'Angular 6 Tutorial', 'Angular 6 Tutorial - 2 - Getting Started.mp4', 'C:\\xampp\\tmp\\phpDFF9.tmp', 'The Perfect SEO Specialist Job Description. A Search Engine Optimization Specialist is responsible for analyzing, reviewing and implementing websites that are optimized to be picked up by search engines. An SEO specialist will develop content to include keywords or phrases in order to increase traffic to website', 'angular,SEO, Getting Started', '2018-10-05 16:41:29', '2018-10-05 16:41:29'),
(7, 14, 'Hello World App', 'Angular 6 Tutorial - 3 - Hello World App.mp4', 'C:\\xampp\\tmp\\phpD42D.tmp', ' 13\r\ndown vote\r\n\r\njQuery.load() is probably the easiest way to load data asynchronously using a selector, but you can also use any of the jquery ajax methods (get, post, getJSON, ajax, etc.)\r\n\r\nNote that load allows you to use a selector to specify what piece of the loaded script you want to load, as in', 'Hello World, Tutorial, jQuery', '2018-10-05 16:42:32', '2018-10-05 16:42:32'),
(8, 16, 'Perfect SEO Specialist', 'VID-20181008-WA0002.mp4', '/tmp/phpGV1ZHO', 'The Perfect SEO Specialist Job Description. A Search Engine Optimization Specialist is responsible for analyzing, reviewing and implementing websites that are optimized to be picked up by search engines. An SEO specialist will develop content to include keywords or phrases in order to increase traffic to website', 'SEO, Specialist Job', '2018-10-09 06:48:40', '2018-10-09 06:48:40'),
(9, 14, 'Angular 6 Tutorial', 'Angular 6 Tutorial - 2 - Getting Started.mp4', '/tmp/phpmEwWO2', 'The Perfect SEO Specialist Job Description. A Search Engine Optimization Specialist is responsible for analyzing, reviewing and implementing websites that are optimized to be picked up by search engines. An SEO specialist will develop content to include keywords or phrases in order to increase traffic to website', 'Getting Started', '2018-10-09 08:21:21', '2018-10-09 08:21:21'),
(10, 16, 'Test post on escaping poverty', NULL, NULL, 'Test essay on escaping poverty.', 'Escaping poverty, Hope', '2018-12-31 11:26:46', '2018-12-31 11:26:46'),
(11, 16, 'Fighting Terrorism', NULL, NULL, 'Test essay on fighting terrorism', 'Fighting Terrorism', '2018-12-31 11:29:10', '2018-12-31 11:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `worklog`
--

DROP TABLE IF EXISTS `worklog`;
CREATE TABLE IF NOT EXISTS `worklog` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `hour` varchar(55) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created_at` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `fk_serviceId` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `interestId` FOREIGN KEY (`interest_id`) REFERENCES `interesttext` (`id`),
  ADD CONSTRAINT `userIdForInterest` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `UserIdForIssue` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `regionsIdForissue` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `userIDForPayments` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_indicator`
--
ALTER TABLE `project_indicator`
  ADD CONSTRAINT `projectIdForIndi` FOREIGN KEY (`project_id`) REFERENCES `ongoing_project` (`id`);

--
-- Constraints for table `recomm`
--
ALTER TABLE `recomm`
  ADD CONSTRAINT `IssueIdForRecomm` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`),
  ADD CONSTRAINT `UserIdForRecomm` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `locationId` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `userIdForregion` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `UserIdForVideo` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `worklog`
--
ALTER TABLE `worklog`
  ADD CONSTRAINT `FK_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
