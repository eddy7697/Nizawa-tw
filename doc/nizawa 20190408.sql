-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019 年 04 月 07 日 19:31
-- 伺服器版本: 10.2.21-MariaDB
-- PHP 版本： 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `nizawa`
--

-- --------------------------------------------------------

--
-- 資料表結構 `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullName` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellPhone` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `bonus`
--

CREATE TABLE `bonus` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defaultPoint` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `maxUsage` int(11) DEFAULT NULL,
  `minUsage` int(11) DEFAULT NULL,
  `bonusUseLimitSetup` tinyint(1) NOT NULL DEFAULT 0,
  `recommendUserSharePoint` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentId` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortKey` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `categories`
--

INSERT INTO `categories` (`id`, `categoryGuid`, `categoryTitle`, `type`, `parentId`, `categoryDescription`, `featureImage`, `sortKey`, `created_at`, `updated_at`) VALUES
(1, 'prKXeD', '新聞訊息', 'post', NULL, NULL, NULL, NULL, '2019-03-28 09:49:18', '2019-04-07 17:08:34'),
(2, 'GveYbv', '產品動態', 'post', NULL, NULL, NULL, NULL, '2019-03-28 09:49:27', '2019-04-07 17:08:34'),
(3, 'VyalNk', '展覽活動', 'post', NULL, NULL, NULL, NULL, '2019-03-28 09:49:38', '2019-04-07 17:08:34'),
(4, 'QV9Blm', '水質檢測', 'product', NULL, NULL, NULL, NULL, '2019-04-05 17:32:31', '2019-04-07 17:08:34'),
(5, 'iyiTLD', '食品安全', 'product', NULL, NULL, NULL, NULL, '2019-04-05 17:32:45', '2019-04-07 17:08:34'),
(6, 'aULG8x', '製程品管', 'product', NULL, NULL, NULL, NULL, '2019-04-05 17:33:17', '2019-04-07 17:08:34'),
(7, '1J2JAK', '手持型儀器', 'product', 'QV9Blm', NULL, NULL, NULL, '2019-04-06 17:12:16', '2019-04-07 17:08:34'),
(8, '5huouG', '桌上型儀器', 'product', 'QV9Blm', NULL, NULL, NULL, '2019-04-06 17:12:24', '2019-04-07 17:08:34'),
(9, '2H0Na5', '在線監控儀器', 'product', 'QV9Blm', NULL, NULL, NULL, '2019-04-06 17:12:31', '2019-04-07 17:08:34'),
(10, 'A8OeDP', '實驗室基礎設備', 'product', 'QV9Blm', NULL, NULL, NULL, '2019-04-06 17:12:37', '2019-04-07 17:08:34'),
(11, 'Q3eQKr', '檢測儀器', 'product', 'iyiTLD', NULL, NULL, NULL, '2019-04-06 17:12:46', '2019-04-07 17:08:34'),
(12, '9LxyGl', '實驗室基礎設備', 'product', 'iyiTLD', NULL, NULL, NULL, '2019-04-06 17:12:52', '2019-04-07 17:08:34'),
(13, 'tuJVES', '檢測試紙/測試片', 'product', 'iyiTLD', NULL, NULL, NULL, '2019-04-06 17:13:00', '2019-04-07 17:08:34'),
(14, 'jJJq8N', '手持型儀器', 'product', 'aULG8x', NULL, NULL, NULL, '2019-04-06 17:14:21', '2019-04-07 17:08:34'),
(15, 'PzKLHl', '桌上型儀器', 'product', 'aULG8x', NULL, NULL, NULL, '2019-04-06 17:14:28', '2019-04-07 17:08:34'),
(16, 'pPAXpp', '在線監控儀器', 'product', 'aULG8x', NULL, NULL, NULL, '2019-04-06 17:14:33', '2019-04-07 17:08:34'),
(17, 'gABxU1', '酸鹼度計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:37:10', '2019-04-07 17:08:34'),
(18, 'RaZY5C', '溶氧計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:37:28', '2019-04-07 17:08:34'),
(19, 'QZAjoD', '電導度計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:37:38', '2019-04-07 17:08:34'),
(20, 'oHej3X', '多項目水質分析儀', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:37:45', '2019-04-07 17:08:34'),
(21, 'nUeqel', '氯離子計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:37:55', '2019-04-07 17:08:34'),
(22, 'b2r8Ee', '氟離子計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:38:12', '2019-04-07 17:08:34'),
(23, 'CjuaiB', '懸浮固體濁度計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:38:24', '2019-04-07 17:08:34'),
(24, 'pTQcvs', '污泥濃度計', 'product', '1J2JAK', NULL, NULL, NULL, '2019-04-06 17:38:30', '2019-04-07 17:08:34'),
(25, '7RiqdG', '濁度計', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:38:48', '2019-04-07 17:08:34'),
(26, 'Ox4ZMK', '溶氧計', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:39:00', '2019-04-07 17:08:34'),
(27, 'jeL39q', '水質分析儀', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:39:07', '2019-04-07 17:08:34'),
(28, '335Ps7', '測定儀器', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:39:18', '2019-04-07 17:08:34'),
(29, '53mZeN', '分析儀器', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:39:26', '2019-04-07 17:08:34'),
(30, 'kHddeK', '加熱反應器', 'product', '5huouG', NULL, NULL, NULL, '2019-04-06 17:39:37', '2019-04-07 17:08:34'),
(31, '1WKqS8', '酸鹼度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:45:45', '2019-04-07 17:08:34'),
(32, 'vT7A1c', '溶氧', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:45:57', '2019-04-07 17:08:34'),
(34, 'tpJmbW', '氧氣', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:46:11', '2019-04-07 17:08:34'),
(35, 'J0UZby', '懸浮固體/濁度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:46:21', '2019-04-07 17:08:34'),
(36, 'Cla7HE', '污泥濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:46:28', '2019-04-07 17:08:34'),
(37, 'yWHQzY', '氟離子', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:46:35', '2019-04-07 17:08:34'),
(38, 'ZJz92B', '水中臭氧濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:50:14', '2019-04-07 17:08:34'),
(39, 'NwCytH', '紫外線吸光光度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:53:28', '2019-04-07 17:08:34'),
(40, '8VK9z7', '高感度濁度(色度)', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:54:17', '2019-04-07 17:08:34'),
(41, 'C4Ii3G', '液體濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:54:26', '2019-04-07 17:08:34'),
(42, 'Cz04J8', '硫酸/草酸濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:54:33', '2019-04-07 17:08:34'),
(43, 'jQ4qMj', '銅/鎳濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:54:41', '2019-04-07 17:08:34'),
(45, 'BDNnuK', '電磁誘導濃度', 'product', '2H0Na5', NULL, NULL, NULL, '2019-04-06 17:55:25', '2019-04-07 17:08:34'),
(46, 'et8cY1', '恆溫培養箱', 'product', 'A8OeDP', NULL, NULL, NULL, '2019-04-06 17:55:36', '2019-04-07 17:08:34'),
(47, 'eJRn8a', '凝集試驗器', 'product', 'A8OeDP', NULL, NULL, NULL, '2019-04-06 17:55:44', '2019-04-07 17:08:34'),
(48, 'X5rQH9', '微量氧氣檢測', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:08', '2019-04-07 17:08:34'),
(49, 'NIIftC', '生物快速冷光儀', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:15', '2019-04-07 17:08:34'),
(50, 'ReA4ev', '分析套組', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:26', '2019-04-07 17:08:34'),
(51, 'Hu5nvG', '檢測套組', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:32', '2019-04-07 17:08:34'),
(52, 'YGYLfO', '數位式糖度計', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:38', '2019-04-07 17:08:34'),
(53, 'FWvJHl', '數位式鹽度計', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:47', '2019-04-07 17:08:34'),
(54, 'vHWDMv', '豆漿濃度計', 'product', 'Q3eQKr', NULL, NULL, NULL, '2019-04-06 17:56:57', '2019-04-07 17:08:34'),
(55, 'Yl7I7u', '均質鐵胃機', 'product', '9LxyGl', NULL, NULL, NULL, '2019-04-06 17:57:12', '2019-04-07 17:08:34'),
(56, 'rIORie', '無菌採樣袋', 'product', '9LxyGl', NULL, NULL, NULL, '2019-04-06 17:57:21', '2019-04-07 17:08:34'),
(57, 'qVHWel', '稀釋裝置', 'product', '9LxyGl', NULL, NULL, NULL, '2019-04-06 17:57:28', '2019-04-07 17:08:34'),
(58, 'EMLb2z', '顯影計算儀', 'product', '9LxyGl', NULL, NULL, NULL, '2019-04-06 17:57:35', '2019-04-07 17:08:34'),
(59, '8q5N9c', '自動接種裝置', 'product', '9LxyGl', NULL, NULL, NULL, '2019-04-06 17:57:43', '2019-04-07 17:08:34'),
(60, 'HM5k6k', '快速檢測試紙', 'product', 'tuJVES', NULL, NULL, NULL, '2019-04-06 17:57:51', '2019-04-07 17:08:34'),
(61, 'KwMf9r', '測試片', 'product', 'tuJVES', NULL, NULL, NULL, '2019-04-06 18:02:07', '2019-04-07 17:08:34'),
(62, 'mkFPVw', '快篩試紙', 'product', 'tuJVES', NULL, NULL, NULL, '2019-04-06 18:02:13', '2019-04-07 17:08:34'),
(63, 'svL1zR', '酸鹼度計', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:02:34', '2019-04-07 17:08:34'),
(64, 'MnH1eP', '測定計', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:02:39', '2019-04-07 17:08:34'),
(65, 'aiIQ3S', '溶氧計', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:02:47', '2019-04-07 17:08:34'),
(66, 'in23Vt', '電導度計', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:02:59', '2019-04-07 17:08:34'),
(67, 'YbLOLU', '水質分析儀', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:08', '2019-04-07 17:08:34'),
(68, 'xHa3Xh', '濃度測定儀', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:17', '2019-04-07 17:08:34'),
(69, 'ABV2ws', '濃度計', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:27', '2019-04-07 17:08:34'),
(70, 'OWVz1g', '冷光儀', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:37', '2019-04-07 17:08:34'),
(71, 'a1GX8I', '探測儀', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:44', '2019-04-07 17:08:34'),
(72, 'Oe8HSF', '氣體探測儀', 'product', 'jJJq8N', NULL, NULL, NULL, '2019-04-06 18:03:51', '2019-04-07 17:08:34'),
(73, 'jgjv6Q', '溶氧計', 'product', 'PzKLHl', NULL, NULL, NULL, '2019-04-06 18:04:03', '2019-04-07 17:08:34'),
(74, 'emevaN', '分析計', 'product', 'PzKLHl', NULL, NULL, NULL, '2019-04-06 18:04:19', '2019-04-07 17:08:34'),
(75, 'NCdGiY', '水質分析儀', 'product', 'PzKLHl', NULL, NULL, NULL, '2019-04-06 18:04:26', '2019-04-07 17:08:34'),
(76, 'xHqI60', '濃度測定計', 'product', 'PzKLHl', NULL, NULL, NULL, '2019-04-06 18:04:32', '2019-04-07 17:08:34'),
(77, '5Ax5jR', '氧氣檢測', 'product', 'PzKLHl', NULL, NULL, NULL, '2019-04-06 18:04:49', '2019-04-07 17:08:34'),
(78, 'RikxII', '酸鹼度在線監控儀', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:05', '2019-04-07 17:08:34'),
(79, 'iGCmJF', '溶氧在線監控儀', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:12', '2019-04-07 17:08:34'),
(80, 'ew9IEe', '濃度監控儀', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:24', '2019-04-07 17:08:34'),
(81, '8RtAEv', '臭氧濃度在線監控儀', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:30', '2019-04-07 17:08:34'),
(82, 'R5WmEz', '銅/鎳濃度', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:44', '2019-04-07 17:08:34'),
(83, '2EvIxD', '硫酸/草酸濃度', 'product', 'pPAXpp', NULL, NULL, NULL, '2019-04-06 18:05:49', '2019-04-07 17:08:34');

-- --------------------------------------------------------

--
-- 資料表結構 `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentFrom` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField1` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField2` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField3` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField4` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField5` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serialNumber` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPublish` tinyint(1) NOT NULL DEFAULT 0,
  `schedulePost` datetime DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `discountType` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `couponAmount` int(11) NOT NULL,
  `freeShipping` tinyint(1) NOT NULL DEFAULT 0,
  `minimumAmount` int(11) DEFAULT NULL,
  `maximumAmount` int(11) DEFAULT NULL,
  `individualUse` tinyint(1) DEFAULT NULL,
  `usageLimit` int(11) DEFAULT 0,
  `usageLimitPerUser` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField1` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField2` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField3` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField4` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField5` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField6` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField7` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField8` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField9` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField10` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `gifts`
--

CREATE TABLE `gifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortDescription` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduleUp` datetime DEFAULT NULL,
  `scheduleDown` datetime DEFAULT NULL,
  `customField1` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField2` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customField3` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_16_061056_create_social_providers_table', 1),
(4, '2017_08_16_102124_create_post_table', 1),
(5, '2017_08_16_102301_create_category_table', 1),
(6, '2017_08_19_062123_create_coupon_table', 1),
(7, '2017_08_25_035147_create_product_table', 1),
(8, '2017_09_19_232604_create_bonus_table', 1),
(9, '2017_09_23_164343_create_site_meta_table', 1),
(10, '2017_12_13_025541_create_comments_table', 1),
(11, '2017_12_17_190612_create_shoppingcart_table', 1),
(12, '2017_12_21_105836_create_orders_table', 1),
(13, '2017_12_26_024641_create_addresses_table', 1),
(14, '2018_02_07_023550_create_shippings_table', 1),
(15, '2018_02_09_134018_create_gifts_table', 1),
(16, '2018_08_19_021307_create_admins_table', 1),
(17, '2018_08_20_013350_create_contents_table', 1),
(18, '2018_08_20_113945_create_custom_fields_table', 1),
(19, '2018_08_20_143430_create_pages_table', 1),
(20, '2018_09_21_234542_create_sub_products_table', 1),
(21, '2019_03_27_144846_create_partners_table', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `merchantID` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pointUsage` int(11) NOT NULL,
  `orderStatus` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'undisposed',
  `status` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `paymentStatus` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `paymentMethod` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shippingMethod` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usedCoupon` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Temperature` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'room',
  `ExpireDate` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BankCode` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PaymentType` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vAccount` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxId` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isSimulate` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shippingTarget` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderFlag` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `partners`
--

CREATE TABLE `partners` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addressString` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partnerType` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partnerLocation` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expireTime` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `postGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorName` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customPath` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postCategory` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoTitle` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKeyword` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPublish` tinyint(1) NOT NULL DEFAULT 0,
  `sortKey` int(11) DEFAULT NULL,
  `schedulePost` datetime DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `posts`
--

INSERT INTO `posts` (`id`, `postGuid`, `author`, `authorName`, `customPath`, `postTitle`, `postCategory`, `content`, `featureImage`, `seoTitle`, `seoKeyword`, `socialImage`, `seoDescription`, `isPublish`, `sortKey`, `schedulePost`, `scheduleDelete`, `created_at`, `updated_at`) VALUES
(1, 'UIdqGjk4N8ARKTJvpqjSUH9gI2nNX0GhODDbYrSryH', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'iW7dNI', '10/3(四)-10/6(日) 本公司參加第十二屆台北國際儀器展', 'ksOUZDwTlGU8Qa54w6IrruDVV8v9eXe7UD0bN8nebx', '<p><strong>本公司將於10月3日(四) ~ 10月6日(日)參與第十二屆台北國際儀器展，將展出各項優質產品，並安排專員為您服務，現場另致贈精美禮品，歡迎蒞臨指教!</strong></p>\n\n<p>&nbsp;</p>\n\n<p><strong>日期：10月3日(四) ~ 10月6日(日)</strong></p>\n\n<p><strong>時間：09:00-17:00</strong></p>\n\n<p><strong>地點：台北世貿中心展覽大樓(TWTC)</strong></p>\n\n<p><strong>地址：台北市信義區信義路五段五號</strong></p>\n\n<p><strong>攤位：C區 706~710 攤位</strong></p>', 'https://picsum.photos/800/600/?image=62', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:51:32', '2019-03-28 10:12:06'),
(2, 'CWFQUY8CEXkGfhuM7I8zm1LQCZR9XGgXbHAz1LvzfW', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'kCVbkp', '9月9日(五) ~ 9月12日(一)本公司參加第十三屆台北國際儀器展', 'ksOUZDwTlGU8Qa54w6IrruDVV8v9eXe7UD0bN8nebx', '<p><strong>本公司將於9月9日(五) ~ 9月12日(一)參與第十三屆台北國際儀器展，將展出各項優質產品，並安排專員為您服務，現場另致贈精美禮品，歡迎蒞臨指教!</strong></p>\n\n<p>&nbsp;</p>\n\n<p><strong>日期：9月9日(五) ~ 9月12日(一)</strong></p>\n\n<p><strong>時間：09:00-17:00</strong></p>\n\n<p><strong>地點：台北世貿中心展覽大樓(TWTC)</strong></p>\n\n<p><strong>地址：台北市信義區信義路五段五號</strong></p>\n\n<p><strong>攤位：B區 1024.1026.1123.1125&nbsp;攤位</strong></p>', 'https://picsum.photos/800/600/?image=330', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:52:16', '2019-03-28 10:12:06'),
(3, 'WvvSdV6EUsxPTbQPdKH3ANULiKAzHg8iV20CA9uF4C', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'GneUuV', '敬邀參加9月9日(五) ~ 9月12日(一)第十三屆台北國際儀器展', 'ksOUZDwTlGU8Qa54w6IrruDVV8v9eXe7UD0bN8nebx', '<p><img alt=\"\" src=\"http://www.nizawa-int.com.tw/images/news/01e512187eb171208c37aebeda547ea9.PNG\" /></p>\n\n<p><strong>本公司將於9月9日(五) ~ 9月12日(一)參與第十三屆台北國際儀器展，將展出各項優質產品，並安排專員為您服務，現場另致贈精美禮品，歡迎蒞臨指教!</strong></p>\n\n<p><strong>日期：9月9日(五) ~ 9月12日(一)</strong></p>\n\n<p><strong>時間：09:00-17:00</strong></p>\n\n<p><strong>地點：台北世貿中心展覽大樓(TWTC)</strong></p>\n\n<p><strong>地址：台北市信義區信義路五段五號</strong></p>\n\n<p><strong>攤位：B區 1024.1026.1123.1125&nbsp;攤位</strong></p>', 'https://picsum.photos/800/600/?image=197', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:52:41', '2019-03-28 10:12:06'),
(4, '13wdT5pxTVrZm8l7oc015o0blUjN961rk5IIlPOKUA', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'J7TwqB', '德國Lovibond新產品發佈及部分項目新增通知', 'K0LWw1M5o4fcEmDH6HJLkwOBCHbTqFKH3oFm3uM6OE', '<p>德國Lovibond新產品：</p>\n\n<p>1. &nbsp;<a href=\"http://www.nizawa-int.com.tw/product_view.php?id=21\" target=\"_blank\">BOD直讀式測定儀 型式：Tintometer-BD600</a></p>\n\n<p>2. &nbsp;<a href=\"http://www.nizawa-int.com.tw/product_view.php?id=16\" target=\"_blank\">多項目水質分析儀 型式：MD-610</a></p>\n\n<p>&nbsp;</p>\n\n<p>多項目水質分析儀 新增<a href=\"http://www.nizawa-int.com.tw/product_view.php?id=16\" target=\"_blank\">測定項目</a>：</p>\n\n<p>1. 鹼度 Alkalinity HR, total &nbsp;(5 ~ 500 mg/l CaCO3)</p>\n\n<p>2. 溴 Bromine&nbsp; (0.05 ~ 4.5 mg/l Br2)</p>\n\n<p>3. 殘餘氯 Chlorine HR&nbsp; (0.1 ~ 10 mg/l ClO)</p>\n\n<p>4. 殘餘氯 Chlorine L &nbsp;(0.02 ~ 4 mg/l ClO)</p>\n\n<p>5. 二氧化氯 Chlorine dioxide&nbsp; (0.04 ~ 3.8 mg/l ClO2)</p>\n\n<p>6. 過氧化氫 H2O2 LR&nbsp; (1 ~ 50 mg/l H2O2)</p>\n\n<p>7. 鐵 Iron (Fe in Mo)&nbsp; (0.01 ~ 1.8 mg/l Fe)</p>\n\n<p>8. 鉬酸鹽 Molybdate&nbsp; LR&nbsp; (0.05 ~ 5 mg/l MoO4)</p>\n\n<p>&nbsp;</p>\n\n<p><a href=\"http://www.nizawa-int.com.tw/product_view.php?id=77\" target=\"_blank\">濁度計Turbidity Meter</a>產品型號變更：</p>\n\n<ol>\n	<li>原TurbiCheck --&gt; TB210 IR</li>\n	<li>原TurbiCheck WL --&gt;TB250 WL</li>\n</ol>\n\n<p>以上詳細規格請參考本公司網頁，如有需求歡迎洽詢，謝謝!</p>', 'https://picsum.photos/800/600/?image=337', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:53:07', '2019-03-28 10:12:06'),
(5, 'Dr7mtt1RlFvJvd0vVZjxuggKRhIuPkCrEn9bjkUZOG', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'KhJhUr', '2016 員工旅行 & 12/30 年終盤點公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司訂於2016/12/23、2016/12/24舉辦年度員工旅行，</p>\n\n<p>2016/12/30 年終盤點</p>\n\n<p>2016/12/31~2017/01/02 元旦假期</p>\n\n<p>以上期間暫停出貨，若有不便尚祈諒解。</p>', 'https://picsum.photos/800/600/?image=444', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:53:44', '2019-03-28 10:12:06'),
(6, 'qIvMTWmgmTKAdzbTNrgjbMXwi90hpQ7RTCyxk31Las', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'WxUfLo', '2017 春節年假日期公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司春節年假訂於2017/01/26(四)~2017/02/05(日)，期間暫停出貨，不便之處尚請見諒!</p>', 'https://picsum.photos/800/600/?image=241', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:54:01', '2019-03-28 10:12:06'),
(7, 'suL2u1Eb6THITSGYVTbeOrYP6Tl8MSN9mJNR83cltP', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'yiB9yW', '2017/02/18(六) 放假日公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司訂於2017/02/18(六) 放假 ，當天暫停出貨，不便之處尚請見諒!</p>', 'https://picsum.photos/800/600/?image=168', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:54:17', '2019-03-28 10:12:06'),
(8, 'aqv4fQdHtzGDEHR0pUsaZkenhSkNs9GvTKdkJAwxnZ', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'nW9SZF', '2017/06/03(六) 放假日公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司訂於2017/06/03(六) 放假 ，當天暫停出貨，不便之處尚請見諒!</p>', 'https://picsum.photos/800/600/?image=264', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:54:37', '2019-03-28 10:12:06'),
(9, 'VcwtwGWWhNYtvTeLeMTjKh60colEEqQID46Lz61IkT', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'utyLMI', 'JNC微生物菌測試片「SANITA-Kun」品牌變更通知', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>2017年5月8日</p>\n\n<p>敬致 各位客戶</p>\n\n<p>JNC株式會社</p>\n\n<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n	<tbody>\n		<tr>\n			<td>\n			<p>JNC微生物菌測試片「SANITA-Kun」品牌變更通知</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p>JNC株式會社(總公司:東京都千代田區大手町，社長：後藤泰行)為強化微生物菌測試片的海外業務並擴大事業版圖，決定更改品牌名稱，特此敬告。</p>\n\n<p>&nbsp;</p>\n\n<p>近年來，食品產業界的原物料、中間體加工品、最終完成品&hellip;等的國際間交易日漸活絡，食品的安心與安全更加受到注目。 JNC微生物菌測試片即是用於檢測食品中的微生物菌數。在日本國內即將要求「HACCP」強制化執行，捨棄傳統平板瓊脂培養法而替代採用已配製完好培養基的簡易檢測法 譬如本公司微生物菌測試片的產品需求趨勢日益普及。</p>\n\n<p>&nbsp;</p>\n\n<p>在此市場背景下，本公司決定統一品牌名稱為「MC-Media Pad」，意思為「M (Microorganism微生物菌) C (Count檢測計數) - &nbsp;Media (培養基) Pad (測試片)」。 此一產品不單僅限適用於日本國內，同時考量對應食品產業的國際化，必須提昇產品的可信度，構築為全球信賴品牌。故MC-Media Pad預計將取得符合ISO法規的MicroVal替代性方法認證，再陸續擴充現有產品的種類，為食品的安心安全作出更大的貢獻。</p>\n\n<p>&nbsp;</p>\n\n<p>＜其他變更事項＞</p>\n\n<ul>\n	<li>「MC-Media Pad」品牌預定於8/8後開始上市，但配合現有「SANITA-Kun」庫存調整因素，各型號更新上市的時間或有差異。</li>\n	<li>「SANITA-Kun」黴菌測試片，將於變更「MC-Media Pad」的同時更名型號為「YM」。</li>\n	<li>「SANITA-Kun」ACplus、總生菌測試片，將於變更「MC-Media Pad」的同時加印二維條碼，以便搭配使用於正在研發中的「MC-Media Pad」專用菌落計數儀管理系統內。</li>\n	<li>「SANITA-Kun」水系細菌用測試片，將於變更為「MC-Media Pad」之後依序整合為ACplus。</li>\n</ul>\n\n<p><img alt=\"\" src=\"http://www.nizawa-int.com.tw/images/news/5a7432ebc651c424386dfd2d248ded44.png\" /></p>\n\n<p>【微生物菌測試片「MC-Media Pad」的新型外包裝】</p>\n\n<p>以上</p>', 'https://picsum.photos/800/600/?image=134', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:54:56', '2019-03-28 10:12:06'),
(10, 'rxRDtYMs273yZOBalYYuabZXHvxJXuShMGXe4OwiMa', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'xTK3LT', '祝福您聖誕快樂 & 新年快樂', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>親愛的朋友：</p>\n\n<p>感謝一路有您的支持和信任，</p>\n\n<p>祝願您在新的一年充滿了歡樂和成功! 聖誕快樂 &amp; 新年快樂!</p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;日澤國際股份有限公司 敬賀</p>\n\n<p>&nbsp;</p>\n\n<p>Wish your life is filled with joy, success and&nbsp;prosperity on this New Year and always.</p>\n\n<p>Merry X&#39;mas &amp; Happy New Year !</p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;NIZAWA INTERNATIONAL HI-TECH CORP.</p>\n\n<p><img alt=\"\" src=\"http://www.nizawa-int.com.tw/images/news/b8e65c36c6901fac12d391810616cfa2.jpg\" /></p>', 'https://picsum.photos/800/600/?image=125', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:55:19', '2019-03-28 10:12:06'),
(11, 'kYKhbE6baDbenobyQeGLHOn5qFyEkhZuGXiH34OjgX', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'nSBpVT', '2018/1/26 (五) ~ 2018/1/28(日) 員工旅行', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司訂於2018/1/26 (五) ~ 2018/1/28(日) 舉辦106年度員工旅行，</p>\n\n<p>以上期間暫停出貨，若有不便尚祈諒解。</p>', 'https://picsum.photos/800/600/?image=156', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:55:36', '2019-03-28 10:12:06'),
(12, 'sM3wiEsHeMbI6XFd1lXLAMb4e1NW9DjXGHTIFdP65M', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'YQIZ90', '2018 春節年假日期公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司春節年假訂於2018/02/14(三)~2018/02/21(三)，期間暫停出貨，不便之處尚請見諒!</p>', 'https://picsum.photos/800/600/?image=320', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:55:53', '2019-03-28 10:12:06'),
(13, 'pfgfUen81LI12DOmhz7TLqzwrGJI1AsnjjAngnLLTx', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', '8EjV86', '2019/1/18 (五) ~ 2019/1/20(日) 員工旅行', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司訂於2019/1/18 (五) ~ 2019/1/20(日) 舉辦107年度員工旅行，</p>\n\n<p>以上期間暫停出貨，若有不便尚祈諒解。</p>', 'https://picsum.photos/800/600/?image=109', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:56:09', '2019-03-28 10:12:06'),
(14, 'qpcTAqn4pXiXW99MXD3q2fHGCWkVvJg4ixbzwW40cO', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'DgnaZo', '2019 春節年假日期公告', 'QjvEXhAwrAjDj1NHhRGLRvpQKPViZHAHSDVhgD0unm', '<p>本公司春節年假訂於2019/02/01(五)~2019/02/10(日)，期間暫停出貨，不便之處尚請見諒!</p>', 'https://picsum.photos/800/600/?image=120', NULL, NULL, NULL, NULL, 1, NULL, '1900-01-01 00:00:01', '3000-12-31 23:59:59', '2019-03-28 09:56:23', '2019-03-28 10:12:06');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `productGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serialNumber` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customPath` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorName` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `Temperature` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountedPrice` int(11) DEFAULT NULL,
  `productCategory` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productStatus` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SALE',
  `reserveStatus` tinyint(1) NOT NULL DEFAULT 0,
  `isPublish` tinyint(1) NOT NULL DEFAULT 0,
  `productType` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'simple',
  `quantity` int(11) DEFAULT NULL,
  `rule` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `command` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoKeyword` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoTitle` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productInformation` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialImage` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedulePost` datetime DEFAULT NULL,
  `sortKey` int(11) DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`id`, `productGuid`, `productTitle`, `serialNumber`, `customPath`, `author`, `authorName`, `price`, `Temperature`, `discountedPrice`, `productCategory`, `featureImage`, `album`, `productDescription`, `shortDescription`, `productStatus`, `reserveStatus`, `isPublish`, `productType`, `quantity`, `rule`, `rate`, `command`, `seoKeyword`, `seoTitle`, `productInformation`, `seoDescription`, `socialImage`, `schedulePost`, `sortKey`, `scheduleDelete`, `created_at`, `updated_at`) VALUES
(1, 'mbP4JN', '污泥濃度MLSS監控儀', 'MC-700', 'rrvo0d', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 1, 'room', NULL, 'pTQcvs', '/photos/shares/product-image.jpg', '[]', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>\n\n<p>測定範圍： 0~20000 mg/l</p>', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>', 'instock', 1, 1, 'simple', NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, NULL, '2019-04-07 19:02:01', '2019-04-07 19:02:01'),
(2, 'mbsadv4JN', '污泥濃度MLSS監控儀', 'MC-700', 'rrvo0d', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 1, 'room', NULL, 'pTQcvs', '/photos/shares/product-image.jpg', '[]', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>\r\n\r\n<p>測定範圍： 0~20000 mg/l</p>', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>', 'instock', 1, 1, 'simple', NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, NULL, '2019-04-07 19:02:01', '2019-04-07 19:02:01'),
(3, 'mretbwre', '污泥濃度MLSS監控儀', 'MC-700', 'rrvo0d', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 1, 'room', NULL, 'pTQcvs', '/photos/shares/product-image.jpg', '[]', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>\r\n\r\n<p>測定範圍： 0~20000 mg/l</p>', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>', 'instock', 1, 1, 'simple', NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, NULL, '2019-04-07 19:02:01', '2019-04-07 19:02:01'),
(4, 'dfghnt', '污泥濃度MLSS監控儀', 'MC-700', 'rrvo0d', 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 1, 'room', NULL, 'pTQcvs', '/photos/shares/product-image.jpg', '[]', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>\r\n\r\n<p>測定範圍： 0~20000 mg/l</p>', '<p>＊ 近紅外線變頻調光式，不受外部光線變化影響。<br />\r\n＊ 特殊耐污防水檢測元件，確保長期使用穩定性。<br />\r\n＊ 4~20mA輸出訊號，上下限警報各a/b接點。</p>', 'instock', 1, 1, 'simple', NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, NULL, '2019-04-07 19:02:01', '2019-04-07 19:02:01');

-- --------------------------------------------------------

--
-- 資料表結構 `shippings`
--

CREATE TABLE `shippings` (
  `id` int(10) UNSIGNED NOT NULL,
  `shippingTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shippingType` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shippingTemperature` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'room',
  `shippingPrice` int(11) NOT NULL,
  `freeShipping` tinyint(1) NOT NULL,
  `freeShippingMininum` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `site_meta`
--

CREATE TABLE `site_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcut` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageTopContent` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageTopLink` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageTopButton` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index_album` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `site_meta`
--

INSERT INTO `site_meta` (`id`, `title`, `keyword`, `description`, `shortcut`, `pageTopContent`, `pageTopLink`, `pageTopButton`, `index_album`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '[{\"title\":\"优秀的产品与专业的销售和技术团队\",\"content\":\"科尔客旗下主要有三个战略平台，分别为水质检测、食品安全及生技药妆，与全球众多的合作伙伴，一同为大中华区的环喂食安把关。公司主要管理及技术团队来自日本东京及中国台湾，掌握简易水质测定、在线监控仪、食品安全测定仪，洁净度管理的核心技术。\",\"url\":\"/photos/shares/banner-1-1.jpg\",\"link\":\"#\",\"button\":\"认识科尔客\"},{\"title\":\"优秀的产品与专业的销售和技术团队\",\"content\":\"科尔客旗下主要有三个战略平台，分别为水质检测、食品安全及生技药妆，与全球众多的合作伙伴，一同为大中华区的环喂食安把关。公司主要管理及技术团队来自日本东京及中国台湾，掌握简易水质测定、在线监控仪、食品安全测定仪，洁净度管理的核心技术。\",\"url\":\"/photos/shares/banner-1-1.jpg\",\"link\":\"#\",\"button\":\"认识科尔客\"},{\"title\":\"优秀的产品与专业的销售和技术团队\",\"content\":\"科尔客旗下主要有三个战略平台，分别为水质检测、食品安全及生技药妆，与全球众多的合作伙伴，一同为大中华区的环喂食安把关。公司主要管理及技术团队来自日本东京及中国台湾，掌握简易水质测定、在线监控仪、食品安全测定仪，洁净度管理的核心技术。\",\"url\":\"/photos/shares/banner-1-1.jpg\",\"link\":\"#\",\"button\":\"认识科尔客\"}]', '2019-03-27 10:03:12', '2019-03-27 10:04:20');

-- --------------------------------------------------------

--
-- 資料表結構 `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider_id` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `sub_products`
--

CREATE TABLE `sub_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `productParent` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subSerialNumber` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subProductGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subQuantity` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subPrice` int(11) NOT NULL,
  `subDiscountPrice` int(11) DEFAULT NULL,
  `subDescription` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialUser` tinyint(1) NOT NULL DEFAULT 0,
  `subscriptable` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `point` int(11) NOT NULL DEFAULT 25,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `guid`, `name`, `email`, `password`, `socialUser`, `subscriptable`, `role`, `level`, `remark`, `status`, `point`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'e3fb89dd-0dde-81fc-f7a7-dea3f1b9f9ad', '最高管理者', 'admin@admin.com', '$2y$10$VPRpuUaPtxA84r4QvqNu4uEj9OwXUvJvIG8SVFInGDA99qO8pYH2W', 0, 0, 'ADMIN', 'VIP', NULL, 'ACTIVE', 9999, NULL, '2019-03-27 09:51:57', '2019-03-27 09:51:57');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- 資料表索引 `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 資料表索引 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- 資料表索引 `site_meta`
--
ALTER TABLE `site_meta`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sub_products`
--
ALTER TABLE `sub_products`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- 使用資料表 AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用資料表 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表 AUTO_INCREMENT `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `site_meta`
--
ALTER TABLE `site_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `sub_products`
--
ALTER TABLE `sub_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
