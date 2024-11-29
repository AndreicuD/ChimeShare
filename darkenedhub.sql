-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2024 at 10:00 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darkenedhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('superadmin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `rule_name` (`rule_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator, some minor restrictions', NULL, NULL, NULL, NULL),
('member', 1, 'Registered users, members of this site', NULL, NULL, NULL, NULL),
('superadmin', 1, 'Unlimited powa!!!', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('superadmin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chime`
--

DROP TABLE IF EXISTS `chime`;
CREATE TABLE IF NOT EXISTS `chime` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `public_id` varchar(36) NOT NULL DEFAULT uuid(),
  `user_id` int(11) UNSIGNED NOT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `public` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `likes_count` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(254) NOT NULL,
  `instrument` varchar(254) NOT NULL,
  `bpm` varchar(254) NOT NULL,
  `content` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `public_id` (`public_id`),
  KEY `user_id_active_public` (`user_id`,`active`,`public`),
  KEY `instrument` (`instrument`),
  KEY `bpm` (`bpm`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chime`
--

INSERT INTO `chime` (`id`, `public_id`, `user_id`, `active`, `public`, `likes_count`, `title`, `instrument`, `bpm`, `content`, `created_at`, `updated_at`) VALUES
(1, '4616ace1-193c-11ef-b1cc-309c233d53c1', 2, 1, 1, 0, 'tete', 'piano', '120', '[]', '2024-05-23 22:40:06', '2024-07-26 13:58:10'),
(2, '62b9f979-193c-11ef-b1cc-309c233d53c1', 2, 1, 1, 0, 'tewes', 'piano', '120', '[[{\"id\":\"c2r12\",\"duration\":\"1\"}],[{\"id\":\"c3r6\",\"duration\":\"1\"},{\"id\":\"c3r7\",\"duration\":\"1\"},{\"id\":\"c3r9\",\"duration\":\"1\"},{\"id\":\"c3r17\",\"duration\":\"1\"}],[{\"id\":\"c4r11\",\"duration\":\"2\"},{\"id\":\"c4r12\",\"duration\":\"3\"}],[{\"id\":\"c6r7\",\"duration\":\"2\"}],[{\"id\":\"c7r8\",\"duration\":\"2\"}],[{\"id\":\"c8r11\",\"duration\":\"1\"}],[{\"id\":\"c11r10\",\"duration\":\"1\"}],[{\"id\":\"c15r5\",\"duration\":\"1\"}]]', '2024-05-23 22:40:55', '2024-07-01 09:13:41'),
(3, 'ec5e912a-1940-11ef-b1cc-309c233d53c1', 2, 1, 0, 0, 'teste2', 'piano', '120', '[[{\"id\":\"c12r9\",\"duration\":\"1\"}],[{\"id\":\"c13r13\",\"duration\":\"1\"}],[{\"id\":\"c18r14\",\"duration\":\"1\"}],[{\"id\":\"c20r20\",\"duration\":\"1\"}]]', '2024-05-23 23:13:24', '2024-07-01 09:13:42'),
(4, '51fc29a7-1942-11ef-b1cc-309c233d53c1', 2, 1, 1, 0, 'TestPublic', 'piano', '120', '[[{\"id\":\"c14r15\",\"duration\":\"1\"}]]', '2024-05-23 23:23:24', '2024-07-01 09:13:43'),
(5, 'ebba7352-1943-11ef-b1cc-309c233d53c1', 3, 1, 0, 0, 'Non Public', 'piano', '120', '[[{\"id\":\"c9r12\",\"duration\":\"1\"}],[{\"id\":\"c13r10\",\"duration\":\"1\"}],[{\"id\":\"c16r14\",\"duration\":\"1\"}],[{\"id\":\"c21r13\",\"duration\":\"1\"}],[{\"id\":\"c23r17\",\"duration\":\"1\"}]]', '2024-05-23 23:34:52', '2024-07-01 09:13:44'),
(7, '548fd187-1945-11ef-b1cc-309c233d53c1', 2, 1, 1, 2, 'Melodie Draguta', 'piano', '120', '[[{\"id\":\"c1r9\",\"duration\":\"1\"}],[{\"id\":\"c2r11\",\"duration\":\"1\"}],[{\"id\":\"c3r18\",\"duration\":\"1\"}],[{\"id\":\"c5r2\",\"duration\":\"1\"},{\"id\":\"c5r14\",\"duration\":\"1\"}],[{\"id\":\"c7r2\",\"duration\":\"1\"},{\"id\":\"c7r14\",\"duration\":\"1\"}],[{\"id\":\"c9r9\",\"duration\":\"1\"}],[{\"id\":\"c10r11\",\"duration\":\"1\"}],[{\"id\":\"c11r18\",\"duration\":\"1\"}],[{\"id\":\"c13r2\",\"duration\":\"1\"},{\"id\":\"c13r14\",\"duration\":\"1\"}],[{\"id\":\"c15r2\",\"duration\":\"1\"},{\"id\":\"c15r14\",\"duration\":\"1\"}],[{\"id\":\"c17r9\",\"duration\":\"1\"}],[{\"id\":\"c18r11\",\"duration\":\"1\"}],[{\"id\":\"c19r18\",\"duration\":\"1\"}],[{\"id\":\"c21r2\",\"duration\":\"1\"},{\"id\":\"c21r14\",\"duration\":\"1\"}],[{\"id\":\"c23r21\",\"duration\":\"1\"}],[{\"id\":\"c25r2\",\"duration\":\"1\"},{\"id\":\"c25r14\",\"duration\":\"1\"}],[{\"id\":\"c27r23\",\"duration\":\"1\"}],[{\"id\":\"c29r7\",\"duration\":\"1\"},{\"id\":\"c29r13\",\"duration\":\"1\"}],[{\"id\":\"c31r7\",\"duration\":\"1\"},{\"id\":\"c31r13\",\"duration\":\"1\"}]]', '2024-05-23 23:44:57', '2024-07-26 14:07:30'),
(8, '270296ed-3786-11ef-8a85-309c233d53c1', 2, 1, 1, 2, 'Instrument Save Test', 'piano', '120', '[[{\"id\":\"c1r24\",\"duration\":\"1\"}],[{\"id\":\"c2r23\",\"duration\":\"1\"}],[{\"id\":\"c3r22\",\"duration\":\"1\"}],[{\"id\":\"c4r21\",\"duration\":\"1\"}],[{\"id\":\"c5r20\",\"duration\":\"1\"}],[{\"id\":\"c6r19\",\"duration\":\"1\"}],[{\"id\":\"c7r18\",\"duration\":\"1\"}],[{\"id\":\"c8r17\",\"duration\":\"1\"}],[{\"id\":\"c9r16\",\"duration\":\"4\"}]]', '2024-07-01 11:44:35', '2024-07-07 15:45:27'),
(9, '47fb563e-3786-11ef-8a85-309c233d53c1', 2, 1, 1, 0, 'Instrument Save Test #2', 'am_synth', '120', '[[{\"id\":\"c6r18\",\"duration\":\"1\"}],[{\"id\":\"c8r18\",\"duration\":\"1\"}],[{\"id\":\"c17r17\",\"duration\":\"1\"},{\"id\":\"c17r21\",\"duration\":\"1\"}]]', '2024-07-01 11:45:30', '2024-07-01 09:13:48'),
(10, '6e6dc594-3786-11ef-8a85-309c233d53c1', 2, 1, 0, 0, 'test #3', 'piano', '120', '[[{\"id\":\"c20r18\",\"duration\":\"1\"}]]', '2024-07-01 11:46:35', '2024-07-01 09:13:49'),
(11, '1f827b8b-3787-11ef-8a85-309c233d53c1', 2, 1, 1, 0, 'cdfbgydcnfrhf', 'fm_synth', '120', '[[{\"id\":\"c4r11\",\"duration\":\"1\"}],[{\"id\":\"c6r5\",\"duration\":\"3\"}],[{\"id\":\"c8r7\",\"duration\":\"1\"}],[{\"id\":\"c10r8\",\"duration\":\"1\"}],[{\"id\":\"c15r16\",\"duration\":\"1\"}],[{\"id\":\"c21r10\",\"duration\":\"1\"}],[{\"id\":\"c23r10\",\"duration\":\"1\"}],[{\"id\":\"c26r11\",\"duration\":\"1\"}]]', '2024-07-01 11:51:32', '2024-07-01 09:13:50'),
(13, '6d717ac6-3787-11ef-8a85-309c233d53c1', 2, 1, 1, 1, 'xzdggfb', 'piano', '120', '[[{\"id\":\"c7r17\",\"duration\":\"1\"}],[{\"id\":\"c11r18\",\"duration\":\"1\"}],[{\"id\":\"c12r19\",\"duration\":\"1\"}],[{\"id\":\"c23r23\",\"duration\":\"1\"}]]', '2024-07-01 11:53:43', '2024-07-07 17:32:04'),
(14, '8540aa99-3789-11ef-8a85-309c233d53c1', 2, 1, 0, 0, 'Test Bau Bau', 'fm_synth', '120', '[[{\"id\":\"c4r24\",\"duration\":\"1\"}],[{\"id\":\"c6r20\",\"duration\":\"1\"}],[{\"id\":\"c10r19\",\"duration\":\"1\"}],[{\"id\":\"c12r21\",\"duration\":\"1\"}],[{\"id\":\"c16r19\",\"duration\":\"1\"}],[{\"id\":\"c17r21\",\"duration\":\"1\"}],[{\"id\":\"c21r21\",\"duration\":\"1\"}]]', '2024-07-01 12:08:42', '2024-07-01 09:13:53'),
(15, '02ec1c17-378b-11ef-8a85-309c233d53c1', 2, 1, 1, 0, 'test#bau', 'fm_synth', '122', '[[{\"id\":\"c9r7\",\"duration\":\"1\"}],[{\"id\":\"c12r12\",\"duration\":\"1\"}],[{\"id\":\"c19r12\",\"duration\":\"1\"}],[{\"id\":\"c20r17\",\"duration\":\"1\"}]]', '2024-07-01 12:19:22', '2024-07-10 18:23:38'),
(16, '7f62f8dd-378b-11ef-8a85-309c233d53c1', 2, 1, 1, 1, 'Test Instrument + Bpm', 'fat_osc', '300', '[[{\"id\":\"c9r23\",\"duration\":\"1\"}],[{\"id\":\"c12r17\",\"duration\":\"1\"}],[{\"id\":\"c18r16\",\"duration\":\"1\"}],[{\"id\":\"c19r23\",\"duration\":\"1\"}]]', '2024-07-01 12:22:51', '2024-11-28 15:04:34'),
(17, '9821acfd-39f9-11ef-bc2d-309c233d53c1', 2, 1, 1, 0, '4`4``23` tresrt', 'piano', '120', '[[{\"id\":\"c18r8\",\"duration\":\"1\"}],[{\"id\":\"c20r8\",\"duration\":\"1\"}],[{\"id\":\"c21r10\",\"duration\":\"1\"}],[{\"id\":\"c23r9\",\"duration\":\"1\"},{\"id\":\"c23r11\",\"duration\":\"1\"}],[{\"id\":\"c27r9\",\"duration\":\"1\"}]]', '2024-07-04 14:36:03', '2024-07-07 16:21:44'),
(18, '10fc6f0e-3ec8-11ef-b1d0-309c233d53c1', 2, 1, 1, 0, 'Chime pt test. intstrumente', 'piano', '120', '[[{\"id\":\"c1r17\",\"duration\":\"1\"},{\"id\":\"c1r21\",\"duration\":\"1\"},{\"id\":\"c1r24\",\"duration\":\"1\"}],[{\"id\":\"c5r21\",\"duration\":\"1\"},{\"id\":\"c5r24\",\"duration\":\"1\"}],[{\"id\":\"c9r24\",\"duration\":\"1\"}]]', '2024-07-10 17:24:07', '2024-07-11 08:11:53'),
(19, '07848d77-3edf-11ef-b1d0-309c233d53c1', 2, 1, 1, 0, 'Test polifonie', 'fm_synth', '120', '[[{\"id\":\"c1r4\",\"duration\":\"1\"},{\"id\":\"c1r6\",\"duration\":\"1\"},{\"id\":\"c1r7\",\"duration\":\"1\"},{\"id\":\"c1r11\",\"duration\":\"1\"},{\"id\":\"c1r13\",\"duration\":\"1\"}]]', '2024-07-10 20:08:29', '2024-07-10 18:23:32'),
(20, '5d466555-3eef-11ef-b1d0-309c233d53c1', 2, 1, 1, 0, 'wowow', 'piano', '120', '[[{\"id\":\"c1r10\",\"duration\":\"1\"},{\"id\":\"c1r16\",\"duration\":\"4\"}],[{\"id\":\"c2r8\",\"duration\":\"1\"}],[{\"id\":\"c3r10\",\"duration\":\"1\"}],[{\"id\":\"c4r12\",\"duration\":\"1\"}],[{\"id\":\"c5r11\",\"duration\":\"1\"}],[{\"id\":\"c6r9\",\"duration\":\"1\"}],[{\"id\":\"c7r8\",\"duration\":\"1\"}],[{\"id\":\"c8r6\",\"duration\":\"1\"}],[{\"id\":\"c9r6\",\"duration\":\"1\"},{\"id\":\"c9r17\",\"duration\":\"4\"}],[{\"id\":\"c10r8\",\"duration\":\"1\"}],[{\"id\":\"c11r9\",\"duration\":\"1\"}],[{\"id\":\"c12r7\",\"duration\":\"1\"}],[{\"id\":\"c13r6\",\"duration\":\"1\"}],[{\"id\":\"c14r8\",\"duration\":\"1\"}],[{\"id\":\"c15r5\",\"duration\":\"1\"}],[{\"id\":\"c17r7\",\"duration\":\"2\"},{\"id\":\"c17r12\",\"duration\":\"4\"}],[{\"id\":\"c19r5\",\"duration\":\"2\"}],[{\"id\":\"c20r8\",\"duration\":\"2\"}],[{\"id\":\"c22r8\",\"duration\":\"1\"},{\"id\":\"c22r9\",\"duration\":\"1\"}],[{\"id\":\"c24r10\",\"duration\":\"1\"}],[{\"id\":\"c25r8\",\"duration\":\"1\"},{\"id\":\"c25r20\",\"duration\":\"4\"}],[{\"id\":\"c26r7\",\"duration\":\"1\"}],[{\"id\":\"c27r9\",\"duration\":\"1\"}],[{\"id\":\"c28r7\",\"duration\":\"1\"}],[{\"id\":\"c29r10\",\"duration\":\"1\"}],[{\"id\":\"c30r8\",\"duration\":\"1\"}],[{\"id\":\"c31r9\",\"duration\":\"1\"}],[{\"id\":\"c32r7\",\"duration\":\"1\"}]]', '2024-07-10 22:05:25', '2024-07-26 14:10:17'),
(24, 'a8d78865-3f84-11ef-b1d0-309c233d53c1', 2, 1, 1, 0, 'Test Edit', 'piano', '120', '[[{\"id\":\"c3r9\",\"duration\":\"1\"}],[{\"id\":\"c8r8\",\"duration\":\"1\"}],[{\"id\":\"c10r12\",\"duration\":\"1\"}],[{\"id\":\"c19r12\",\"duration\":\"1\"}]]', '2024-07-11 15:54:05', '2024-07-26 13:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `chime_like`
--

DROP TABLE IF EXISTS `chime_like`;
CREATE TABLE IF NOT EXISTS `chime_like` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chime_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `chime_user` (`chime_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chime_like`
--

INSERT INTO `chime_like` (`id`, `chime_id`, `user_id`, `created_at`) VALUES
(42, 8, 3, '2024-07-04 07:07:03'),
(43, 7, 3, '2024-07-04 07:07:03'),
(49, 8, 2, '2024-07-07 03:07:27'),
(53, 13, 2, '2024-07-07 05:07:04'),
(80, 7, 2, '2024-07-26 02:07:30'),
(83, 16, 2, '2024-11-28 03:11:34');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1716324039),
('m130524_201442_init', 1716324043),
('m190124_110200_add_verification_token_column_to_user_table', 1716324043),
('m240518_142815_base_structure', 1716324044),
('m240519_150049_initial_datas', 1716324044),
('m240701_074339_update_chimes', 1719820041),
('m240701_091010_update_chimes_bpm', 1719825209);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
CREATE TABLE IF NOT EXISTS `song` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setlist_spot` int(3) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `first_guitar` varchar(254) NOT NULL,
  `second_guitar` varchar(254) NOT NULL,
  `bass` varchar(254) NOT NULL,
  `drums` varchar(254) NOT NULL,
  `piano` varchar(254) NOT NULL,
  `first_voice` varchar(254) NOT NULL,
  `second_voice` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `setlist_spot`, `title`, `artist`, `first_guitar`, `second_guitar`, `bass`, `drums`, `piano`, `first_voice`, `second_voice`, `created_at`, `updated_at`) VALUES
(1, 1, 'Happy Xmas', 'John Lennon', 'test1', 'test2', 'bas', 'tobe', 'pian', 'test3', 'test4', '2024-11-28 15:49:25', '2024-11-28 15:50:48'),
(2, 1, 'Test#2', 'Altceva', 'chitara 1', 'chitara 2', 'Bas ', 'Tobe', 'Pian', 'Voce 1', 'Voce 2', '2024-11-28 15:49:25', '2024-11-28 15:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sex` enum('F','M') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password_hash` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `verification_token` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `auth_key` (`auth_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `firstname`, `lastname`, `sex`, `phone`, `birth_date`, `status`, `auth_key`, `password_hash`, `password_reset_token`, `verification_token`, `created_at`, `updated_at`) VALUES
(1, 'andrei', 'urecheatu007@gmail.com', 'Leo', 'Hutanu', 'M', '', NULL, 10, '62XosHOiCccwkrTCij676SF_rXyUQLl2', '$2y$13$M8mo4D3ct94rBqDMcqr2uuq8Yz3CTujfxeEg7a13yHETP3NS/apRi', NULL, NULL, '2024-05-21 08:05:44', '2024-07-11 11:53:51'),
(2, NULL, 'andreileontinhutanu@gmail.com', 'Andrei', 'Hutanu', 'M', NULL, '2007-07-30', 10, 'hMmtbqHbunydWqwEGLnU0DMCRqFgnIbo', '$2y$13$BA5OsniwY.GW.B7D3n.4SurN8GTcOKyw9KI1VhLRD9UQ28gNcogW6', 'BECjvL5xg0xgnTCvECHShVWLTwxV6jdE_1720727147', NULL, '2024-05-22 00:12:27', '2024-07-11 19:45:47'),
(3, NULL, 'littlegamerdeiu@gmail.com', 'Hutanu', 'Deiu', NULL, NULL, NULL, 10, 'GlSQdASMDtccXTF67Owwti_Fb8PT8fZV', '$2y$13$plSTsq1fcyMhiUVogIvZ8.Y8qEdQVSFOEIRHQ3eS/A1ANlPomMacC', NULL, NULL, '2024-05-23 23:34:23', '2024-05-23 20:34:23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
