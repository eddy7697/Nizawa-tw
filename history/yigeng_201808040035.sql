-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 06, 2018 at 10:38 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `egithnet_yigeng`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
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
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `defaultPoint` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `maxUsage` int(11) DEFAULT NULL,
  `minUsage` int(11) DEFAULT NULL,
  `bonusUseLimitSetup` tinyint(1) NOT NULL DEFAULT '0',
  `recommendUserSharePoint` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentId` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryDescription` longtext COLLATE utf8mb4_unicode_ci,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sortKey` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryGuid`, `categoryTitle`, `type`, `parentId`, `categoryDescription`, `featureImage`, `created_at`, `updated_at`, `sortKey`) VALUES
(1, 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', '藝術用品', 'product', NULL, NULL, NULL, '2018-07-24 14:09:16', '2018-08-06 10:36:45', 1),
(2, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', '蠟磚', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 14:09:31', '2018-08-06 10:36:45', 3),
(3, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', '蠟筆', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:01:47', '2018-08-06 10:36:45', 5),
(4, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', '彩色鉛筆(粗)', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:02:02', '2018-08-06 10:36:45', 4),
(5, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', '彩色鉛筆(細)', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:02:47', '2018-08-06 10:36:45', 2),
(6, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', '蜜蠟土', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:02:55', '2018-08-06 10:36:45', 6),
(7, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', '水彩', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:03:05', '2018-08-06 10:36:45', 8),
(8, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', '水彩鉛筆', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:04:05', '2018-08-06 10:36:45', 7),
(9, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', '水彩~筆&配件', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:04:14', '2018-08-06 10:36:45', 9),
(10, 'ePVyU81vAMD0EzGJoypNcATNEPaSXS5l4Uqh6l5lUj', '繪圖用筆', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:04:22', '2018-08-06 10:36:45', 10),
(11, 'hdiwqP7q8Tmfy4nSiRc6dq3DlUo2n19EK6zxYAfssQ', 'MeiArt 粉彩組', 'product', NULL, NULL, NULL, '2018-07-24 16:04:33', '2018-08-06 10:36:45', 12),
(12, 'UkARFTlk3ufPqqMHPNM18xVveduQgE9IbMKvbn0AYH', '裝飾蠟', 'product', 'mmmytPSgS81h0ScLWJkfabqE3eSHN1vxH3jxWz0fjk', NULL, NULL, '2018-07-24 16:04:41', '2018-08-06 10:36:45', 11);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
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
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serialNumber` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isPublish` tinyint(1) NOT NULL DEFAULT '0',
  `schedulePost` datetime DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `discountType` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `couponAmount` int(11) NOT NULL,
  `freeShipping` tinyint(1) NOT NULL DEFAULT '0',
  `minimumAmount` int(11) DEFAULT NULL,
  `maximumAmount` int(11) DEFAULT NULL,
  `individualUse` tinyint(1) DEFAULT NULL,
  `usageLimit` int(11) DEFAULT '0',
  `usageLimitPerUser` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2017_08_16_061056_create_social_providers_table', 1),
(34, '2017_08_16_102124_create_post_table', 1),
(35, '2017_08_16_102301_create_category_table', 1),
(36, '2017_08_19_062123_create_coupon_table', 1),
(37, '2017_08_25_035147_create_product_table', 1),
(38, '2017_09_19_232604_create_bonus_table', 1),
(39, '2017_09_23_164343_create_site_meta_table', 1),
(40, '2017_12_13_025541_create_comments_table', 1),
(41, '2017_12_17_190612_create_shoppingcart_table', 1),
(42, '2017_12_21_105836_create_orders_table', 1),
(43, '2017_12_26_024641_create_addresses_table', 1),
(44, '2018_02_07_023550_create_shippings_table', 1),
(45, '2018_02_09_134018_create_gifts_table', 1),
(46, '2018_07_31_202505_rename_product_column', 2),
(47, '2018_07_31_204406_rename_category_column', 2),
(48, '2018_07_31_205021_rename_post_column', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
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
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `orderFlag` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expireTime` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
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
  `seoKeyword` longtext COLLATE utf8mb4_unicode_ci,
  `socialImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDescription` longtext COLLATE utf8mb4_unicode_ci,
  `isPublish` tinyint(1) NOT NULL DEFAULT '0',
  `schedulePost` datetime DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `productGuid` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productTitle` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serialNumber` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customPath` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorName` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `Temperature` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountedPrice` int(11) DEFAULT NULL,
  `productCategory` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featureImage` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `album` longtext COLLATE utf8mb4_unicode_ci,
  `productDescription` longtext COLLATE utf8mb4_unicode_ci,
  `shortDescription` longtext COLLATE utf8mb4_unicode_ci,
  `productStatus` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SALE',
  `reserveStatus` tinyint(1) NOT NULL DEFAULT '0',
  `isPublish` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `rule` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `command` longtext COLLATE utf8mb4_unicode_ci,
  `seoKeyword` longtext COLLATE utf8mb4_unicode_ci,
  `seoTitle` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productInformation` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoDescription` longtext COLLATE utf8mb4_unicode_ci,
  `socialImage` longtext COLLATE utf8mb4_unicode_ci,
  `schedulePost` datetime DEFAULT NULL,
  `scheduleDelete` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productGuid`, `productTitle`, `serialNumber`, `customPath`, `author`, `authorName`, `price`, `Temperature`, `discountedPrice`, `productCategory`, `featureImage`, `album`, `productDescription`, `shortDescription`, `productStatus`, `reserveStatus`, `isPublish`, `quantity`, `rule`, `rate`, `command`, `seoKeyword`, `seoTitle`, `productInformation`, `seoDescription`, `socialImage`, `schedulePost`, `scheduleDelete`, `created_at`, `updated_at`) VALUES
(1, 'bOSueW3brJZpQ6j4PFMPTUflLDe1A2je3kJRWVl7d2', 'STOCKMAR 8色蠟磚+8色蠟筆', NULL, 'STOCKMAR 8色蠟磚+8色蠟筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85035061.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85035061.jpg\"}]', '<p>規格：8色蠟磚+8色蠟筆~鐵盒裝</p>', '<p>貨號：85035061</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:08:28', '2018-07-26 15:32:11'),
(2, 'iMkGo2Q6fbZTPPk14CTmtwFlW26lbxUtofW3Ym8slo', 'STOCKMAR 12色蠟磚~華德福精選', NULL, 'STOCKMAR 12色蠟磚華德福精選', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/20180403150529.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/20180403150529.jpg\"}]', '<p>規格：華德福精選12色~紙盒裝</p>\n\n<p>組合色~華德福教師推薦</p>', '<p>貨號：Y0001</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:13:33', '2018-07-24 15:52:11'),
(3, 'f0vOU1HGK0O43HNGGKIN1gqQO0s8RYsA4VCOj5HDtd', 'STOCKMAR 24色蠟磚', NULL, 'STOCKMAR 24色蠟磚', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1380, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85035600.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85035600.jpg\"}]', '<p>規格：24色~木盒裝</p>', '<p>貨號：85035600</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:14:43', '2018-07-24 15:53:40'),
(4, 'y6k1cc1QZZSjEziBloPba2KvFeD2mSikraKRXGXIpX', 'STOCKMAR 16色蠟磚(木盒)', NULL, 'STOCKMAR 16色蠟磚(木盒)', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1180, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85035500.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85035500.jpg\"}]', '<p>規格：16色~木盒裝</p>', '<p>貨號：85035500</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:17:28', '2018-07-24 15:54:10'),
(5, '4QPCmC3mlB1Qrz8QP0eZIkGco02wJlNtGdF15Xd9lB', 'STOCKMAR 16色蠟磚(鐵盒)', NULL, 'STOCKMAR 16色蠟磚鐵盒', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, NULL, 'http://yigeng.egith.net/photos/1/蠟磚/85035000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85035000.jpg\"}]', '<p>規格：16色~鐵盒裝</p>', '<p>貨號：85035000</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:19:29', '2018-07-24 15:54:59'),
(6, '7ef3WBShfaCaFd4ovSCIZVpebhIiatBpGz5PCazWrO', 'STOCKMAR 12色蠟磚', NULL, 'STOCKMAR 12色蠟磚', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85034200.jpg', '[]', '<p>規格： 12色~紙盒裝</p>', '<p>貨號：85034200</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 14:21:58', '2018-07-24 15:55:58'),
(7, '3VYZA241TPOtFPPHm5l8Pc4Iltmx8gvh9I9ho7Sra3', 'STOCKMAR 8色蠟磚~華德福精選', NULL, 'STOCKMAR 8色蠟磚華德福精選', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85034001.jpg', '[]', '<p>規格：華德福精選~鐵盒</p>', '<p>貨號：85034001</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 15:12:02', '2018-07-24 15:56:21'),
(8, 'oki7j5SmzfgsubFwzM8AmM98JMKtXTWPzMn76NgbOy', 'STOCKMAR 8色蠟磚~補充色I', NULL, 'STOCKMAR 8色蠟磚補充色I', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85035100.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85035100.jpg\"}]', '<p>規格：補充色I~鐵盒</p>', '<p>貨號：85035100</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 15:12:57', '2018-07-24 15:56:48'),
(9, 'NMZ1RmmVFL2zJKJKc5Gb0EhOvMAHa0MGGobH6h9yK8', 'STOCKMAR 8色蠟磚~主色', NULL, 'STOCKMAR 8色蠟磚主色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/85034000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟磚/85034000.jpg\"}]', '<p>規格：正色~鐵盒</p>', '<p>貨號：85034000</p>', 'instock', 0, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 15:34:33', '2018-07-24 15:57:11'),
(10, 'A12SuFsJYnZRcqG4taXUvBNVVpM2ey54a4USMy7LAC', 'STOCKMAR 單色蠟磚', NULL, 'STOCKMAR 單色蠟磚', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'xYki59bITrEpRSt9bG8rCFTjgNtmAR41Te9k5OmEiM', 'http://yigeng.egith.net/photos/1/蠟磚/850360--.jpg', '[]', '<p>規格： 單色*12 有32色可供選擇</p>\n\n<p>&nbsp;~~訂購請註明編號及顏色~~</p>\n\n<p><img alt=\"\" src=\"http://yigeng.egith.nethttp://yigeng.egith.net/photos/1/下載.jpg\" style=\"width: 709px; height: 370px;\" /></p>', '<p>單色*12&nbsp; 有32色可供選擇~~紙盒裝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n\n<p>~~訂購請註明編號及顏色~~</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-24 15:59:01', '2018-07-24 15:59:01'),
(11, 'bIujBwuZhmtuYc2lewKU1ywBoR0rU0Mys22JYEx1yT', 'STOCKMAR 8色~蠟筆補充色II', NULL, 'STOCKMAR 8色蠟筆補充色II', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032101.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85032101.jpg\"}]', '<p>商品詳細說明：補充色II~新色彩~含金、銀色~鐵盒</p>', '<p>貨號：85032101</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 14:48:10', '2018-07-25 14:48:52'),
(12, 'lYdRMbgL0TjUNT2Q5bYZbPMYhCbKuJomiocJOUJkCK', 'STOCKMAR 12色蠟筆~華德福精選', NULL, 'STOCKMAR 12色蠟筆華德福精選', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/20180403150617.jpg', '[]', '<p>商品詳細說明：華德福精選12色~紙盒裝</p>\n\n<p>組合色~華德福教師推薦</p>', '<p>貨號：Y0002</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 14:50:25', '2018-07-25 14:50:25'),
(13, 'plgHh5GqKNEwoV2YlxryuZ5g3eM46ocONkVk0G8xtG', '8色蠟磚+8色蠟筆~木盒裝', NULL, '8色蠟磚+8色蠟筆~木盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1180, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032549.jpg', '[]', '<p>商品詳細說明：8色蠟磚+8色蠟筆~木盒裝</p>', '<p>貨號：85032549</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 14:51:50', '2018-07-25 14:52:54'),
(14, 'dfdytL4PF220trojvwx4r1pfYHnd98rKFwZ6F419be', 'STOCKMAR 24色蠟筆', NULL, 'STOCKMAR 24色蠟筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1380, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032600.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85032600.jpg\"}]', '<p>商品詳細說明：24色~木盒裝</p>', '<p>貨號：85032600</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 14:54:31', '2018-07-25 14:54:31'),
(15, 'nHHNeGRBJLAq2BGygxOXAuL1lPNHRw6rarhP2HJBGC', 'STOCKMAR 16色蠟筆 - 木盒裝', NULL, 'STOCKMAR 16色蠟筆 - 木盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1180, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032500.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85032500.jpg\"}]', '<p>商品詳細說明：16色~木盒裝</p>', '<p>貨號：85032500</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 14:56:03', '2018-07-25 14:58:37'),
(16, 'HC4k4kATzD5LfmxyvKCamM0JMbhzEKpCVBbEQu52U1', 'STOCKMAR 16色蠟筆 - 鐵盒裝', NULL, 'STOCKMAR 16色蠟筆 - 鐵盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85032000.jpg\"}]', '<p>商品詳細說明：16色~鐵盒裝</p>', '<p>貨號：85032000</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:00:36', '2018-07-25 15:00:36'),
(17, 'abddBYZxKBeXiH2Y25Nj4CTqNtXoYZOwHMeWt2myBM', 'STOCKMAR 12色蠟筆 - 紙盒裝', NULL, 'STOCKMAR 12色蠟筆 - 紙盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85031200.jpg', '[]', '<p>商品詳細說明：12色~紙盒裝</p>', '<p>貨號：85031200</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:02:11', '2018-07-25 15:02:11'),
(18, 'NnV1ijXHGDYPSHRld1fPRuHZx64eVJq9YPu6uqKzPt', 'STOCKMAR 8色蠟筆~補充色I - 鐵盒裝', NULL, 'STOCKMAR 8色蠟筆補充色I - 鐵盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85032100.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85032100.jpg\"}]', '<p>商品詳細說明：副色~鐵盒裝</p>', '<p>貨號：85032100</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:03:46', '2018-07-25 15:03:46'),
(19, 'QpOiNXOQvsoskOMnDBPh5R9R1KJhTnRMeWQERHFAaj', 'STOCKMAR 8色蠟筆~華德福精選 - 鐵盒裝', NULL, 'STOCKMAR 8色蠟筆華德福精選 - 鐵盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85031001.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85031001.jpg\"}]', '<p>商品詳細說明：華德福精選~鐵盒裝</p>', '<p>貨號：85031001</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:05:28', '2018-07-25 15:05:28'),
(20, 'skHLCpRHQOC4O9sGwipfpXw15t5QidF4G38q3szn3L', 'STOCKMAR 8色蠟筆~主色 - 鐵盒裝', NULL, 'STOCKMAR 8色蠟筆主色 - 鐵盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/85031000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/85031000.jpg\"}]', '<p>STOCKMAR 8色蠟筆~主色 -&nbsp;鐵盒裝</p>', '<p>貨號：85031000</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:07:03', '2018-07-25 15:07:03'),
(21, 'uA76rBcwcFmWrUhI5vpI3G1um35QYODgQVa4LB90Xc', 'STOCKMAR 單色蠟筆 - 紙盒裝', NULL, 'STOCKMAR 單色蠟筆 - 紙盒裝', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'Se3b3I9FQ4VlDdU92EYAmvAzX6cyaiF1iwuAPj88zj', 'http://yigeng.egith.net/photos/1/蠟筆/850330--.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蠟筆/850330--.jpg\"}]', '<p>商品詳細說明：<br />\n&nbsp;</p>\n\n<p>單色*12 有32色可供選擇~~紙盒裝<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>~訂購請註明編號及顏色~~</p>\n\n<p>&nbsp;</p>\n\n<p><img alt=\"\" src=\"http://yigeng.egith.nethttp://yigeng.egith.net/photos/1/下載.jpg\" style=\"width: 709px; height: 370px;\" /></p>', '<p>貨號：850330xx</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:08:41', '2018-07-25 15:11:16'),
(22, 'mrWEUAmzMINHeV0oAaIfsoh045Cs7t5LvjNXWuO0Ai', 'Stockmar三角色鉛筆-華德福精選12色+1鉛筆', NULL, 'Stockmar三角色鉛筆-華德福精選12色+1鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 780, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428150318.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428150318.jpg\"}]', '<p>Stockmar三角色鉛筆-華德福精選<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，三角-12+1(鉛筆)/支 鐵盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆德國Stockmar廠完成或提供。</p>\n\n<p>華德福精選(色號) 01| 02| 03| 04| 05| 06| 07| 09| 10| 11| 12| 13| B(鉛筆)</p>', '<p>貨號：85097110</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:13:48', '2018-07-25 15:13:48'),
(23, '5RAosXnT7sHwuFjpaz7GkzOGdvOhCRkAdjKSIkkpOA', 'Stockmar六角色鉛筆-華德福精選12色+1鉛筆', NULL, 'Stockmar六角色鉛筆-華德福精選12色+1鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 780, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428200627.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428200627.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：85097111<br />\nStockmar六角色鉛筆-華德福精選<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，12+1(鉛筆)/支 鐵盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆德國Stockmar廠完成或提供。</p>\n\n<p>華德福精選(色號) 01| 02| 03| 04| 05| 06| 07| 09| 10| 11| 12| 13| B(鉛筆)</p>', '<p>貨號：85097111</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:16:45', '2018-07-25 15:16:45'),
(24, 'hFlRf2IldjIwVuqOhw16aKs5cBqnCOkS5AAQndYrPS', 'Stockmar三角色鉛筆-副色組', NULL, 'Stockmar三角色鉛筆-副色組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 800, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428201317.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428201317.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：85097098<br />\nStockmar三角色鉛筆-副色組<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，13色/支 鐵盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆德國Stockmar廠完成或提供。</p>\n\n<p>副色組(色號) 08| 14| 15| 18| 22| 24| 25| 26| 42| 44| 45| 47| 49</p>', '<p>貨號：85097098</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:18:01', '2018-07-25 15:18:01'),
(25, 'TIBcXWjmIPmJvnqg1dCTrP2T4dlRPfbLD1RJjDH6UN', 'Stockmar六角色鉛筆-副色組', NULL, 'Stockmar六角色鉛筆-副色組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 800, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424164742.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424164742.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：85097099<br />\nStockmar六角色鉛筆-副色組<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，13色/支 鐵盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆德國Stockmar廠完成或提供。</p>\n\n<p>副色組(色號) 08| 14| 15| 18| 22| 24| 25| 26| 42| 44| 45| 47| 49</p>', '<p>貨號：85097099</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:19:11', '2018-07-25 15:19:11'),
(26, 'wh0xmMw6QkGlorVAlT9LYF5fVS2kSFXxxze8wGGhpv', 'Stockmar三角色鉛筆-華德福精選12色', NULL, 'Stockmar三角色鉛筆-華德福精選12色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428174741.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170428174741.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：85095300<br />\nStockmar三角12色鉛筆-華德福精選<br />\n- Made in Taiwan</p>\n\n<p>如需簡易型不織布筆袋(此為贈品，庫存有限贈完為止)，訂購時請於備註內索取。</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，12色/支 紙盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆由德國Stockmar廠完成或提供。</p>\n\n<p>華德福精選(色號) 01| 02| 03| 04| 05| 06| 07| 09| 10| 11| 12| 13</p>', '<p>貨號：85095300</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:20:19', '2018-07-25 15:20:19'),
(27, 'R4ROFDmHPL5p2KXkLHqqpCNcU36xdefBL6syQ0k1kC', 'Stockmar六角色鉛筆-華德福精選12色', NULL, 'Stockmar六角色鉛筆-華德福精選12色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424163317.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424163317.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：85096300<br />\nStockmar六角12色鉛筆-華德福精選<br />\n- Made in Taiwan</p>\n\n<p>如需簡易型不織布筆袋(此為贈品，庫存有限贈完為止)，訂購時請於備註內索取。</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，12色/支 紙盒裝。</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆由德國Stockmar廠完成或提供。</p>\n\n<p>華德福精選(色號) 01| 02| 03| 04| 05| 06| 07| 09| 10| 11| 12| 13</p>', '<p>貨號：85096300</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:21:57', '2018-07-25 15:21:57'),
(28, 'fuAEwMaMFi465S6U9bEzsKCj6baEaCpxXVn5qIJ1G7', 'Stockmar三角色鉛筆~單色', NULL, 'Stockmar三角色鉛筆單色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424012709.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424012709.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：850953--<br />\nStockmar三角色鉛筆~單色<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，單色-12支紙盒裝<br />\n共25色可選(85095325金色~26銀色)除外</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆在德國Stockmar廠完成。</p>\n\n<p>色卡</p>', '<p>貨號：850953XX</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:23:32', '2018-07-25 15:23:32'),
(29, 'zFulmDwurflx1BP8hkooWzQzA32nsk3lO9H5cCsY81', 'Stockmar六角色鉛筆~單色', NULL, 'Stockmar六角色鉛筆單色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424011121.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424011121.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>產品編號：850963--<br />\nStockmar六角色鉛筆~單色<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，單色-12支紙盒裝<br />\n共25色可選(85096325金色~26銀色)除外</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆在德國Stockmar廠完成。</p>', '<p>貨號：850963XX</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:25:20', '2018-07-25 15:25:20'),
(30, '9alk69F9uxvHDyNt2Btby5LDKLdzNbXiyBeAoE1JV5', 'Yorik 12色鉛筆~六角', NULL, 'Yorik 12色鉛筆六角', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 450, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20130710213906.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20130710213906.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>長度：175mm，直徑。10mm，筆芯6,25mm</p>\n\n<p>Made in Deutschland</p>\n\n<p>色號：04 &nbsp;05 &nbsp;07 &nbsp;08 &nbsp;10 &nbsp;11 &nbsp;13 &nbsp;18 &nbsp;19 &nbsp;22 &nbsp;26 &nbsp;32</p>\n\n<p><a href=\"https://www.mercurius-international.com/en-gb/\">色卡&larr;請點我</a></p>', '<p>貨號：20532912</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:28:04', '2018-07-25 15:28:04'),
(31, 'SdSKUNpjEg6JD5x0YX0ZzEup8nwIs30MJQKLoYJKYU', 'LYRA 12色鉛筆', NULL, 'LYRA 12色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20561912.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20561912.jpg\"}]', '<p>商品詳細說明：華德福精選12色~紙盒裝</p>\n\n<p>※堅持品質</p>\n\n<p>※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20561912</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:29:18', '2018-07-25 15:29:18'),
(32, '26cw6ieM5X3Uh995B1C5B2u7EEqfheLMBrWCx71jkn', 'LYRA 單色色鉛筆', NULL, 'LYRA 單色色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20561---.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20561---.jpg\"}]', '<p>商品詳細說明： 單色*12 有25色可供選擇~~紙盒裝 ~~</p>\n\n<p><a href=\"https://www.mercurius-international.com/en-gb/\">色卡 ~~</a></p>\n\n<p>訂購請註明編號及顏色~~ ※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20561XXX</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:30:59', '2018-07-25 15:30:59'),
(33, '5MPrbiewQ9UKKPhX3xfTDxtiFY0deqKKQbgkDQbps1', 'STOCKMAR 單色色鉛筆(停售)', NULL, 'STOCKMAR 單色色鉛筆停售', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/850900--.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/850900--.jpg\"}]', '<p>商品詳細說明：<br />\n&nbsp;</p>\n\n<p>*已改版*</p>', '<p>貨號：850900xx</p>', 'outofstock', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:32:22', '2018-07-25 15:32:22'),
(34, 'NzqeQJbXqRMHHG9wa2JticGJ9U3UORN3EG7yRTsp85', 'LYRA 12色鉛筆-副色組', NULL, 'LYRA 12色鉛筆-副色組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20180115130559.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20180115130559.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>副色組合~紙盒裝</p>\n\n<p>※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>\n\n<p>如需簡易型不織布筆袋(此為贈品，庫存有限贈完為止)，訂購時請於備註內索取。</p>', '<p>貨號：20561XX1</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:33:44', '2018-07-25 15:33:44'),
(35, 'eJHKVMS56f22pctJsgfiq3M2w6ZslW7FuE0A3YeDIB', 'STOCKMAR 24色鉛筆+1特別色', NULL, 'STOCKMAR 24色鉛筆+1特別色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1480, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/85090924.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/85090924.jpg\"}]', '<p>商品詳細說明： 24色鉛筆+1特別色~鐵盒</p>', '<p>貨號：85090924</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:34:53', '2018-07-25 15:34:53'),
(36, '7JeGsFq9r8RI7bDrHHHzlSrtpOuOBoCjEdC8JMicIr', 'STOCKMAR 12色鉛筆+1特別色', NULL, 'STOCKMAR 12色鉛筆+1特別色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 780, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/85090912.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/85090912.jpg\"}]', '<p>商品詳細說明： 12色鉛筆+1特別色~鐵盒</p>', '<p>貨號：85090912</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:36:02', '2018-07-25 15:36:02'),
(37, 'pxkXm63fnHcPeFPScNyVLAGXXvPaXGCwcWKpCbtZZq', 'LYRA 18色鉛筆', NULL, 'LYRA 18色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 980, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20180412163803.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20180412163803.jpg\"}]', '<p>商品詳細說明：18色~鐵盒裝※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20561918</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:37:24', '2018-07-25 15:37:24'),
(38, 'qCe0wa8XL5DJ91xuLb0dFKt19O5jtkEbpayfQkjdxW', 'Stockmar三角色鉛筆~金色&銀色', NULL, 'Stockmar三角色鉛筆金色銀色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 850, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424012709.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424012709.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>此為85095325金色~26銀色訂購專區(價格不同)</p>\n\n<p>產品編號：85095325-26<br />\nStockmar六角色鉛筆~金色&amp;銀色<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，單色-12支紙盒裝<br />\n共25色可選</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆在德國Stockmar廠完成。</p>\n\n<p>色卡</p>', '<p>貨號：85095325-26</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:38:43', '2018-07-25 15:38:43'),
(39, 'Ddl0I58ZDoiqnUJ0FeN8TeqTIETFcSmRIGstP9Rrkf', 'Stockmar六角色鉛筆~金色&銀色', NULL, 'Stockmar六角色鉛筆金色銀色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 850, 'room', NULL, 'd2pyRHYFS4OLHwMSbYLNqF7myAOtoqp356lGvHQDms', 'http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424011121.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(粗)/20170424011121.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>此為85096325金色~26銀色訂購專區(價格不同)</p>\n\n<p>產品編號：85096325-26<br />\nStockmar六角色鉛筆~金色&amp;銀色<br />\n- Made in Taiwan</p>\n\n<p>長度175mm，直徑10mm，筆芯直徑6.25mm，原木色未上漆，單色-12支紙盒裝<br />\n共25色可選</p>\n\n<p>全新版Stockmar彩色鉛筆有25種特別的顏色。這些顏色具有自然的效果並相互協調。<br />\n這些獨特的Stockmar和諧色彩是基於歌德擴展色圈的配色系統。<br />\n為了創造更好的效果，這些顏色可以混色使用。<br />\n#此產品為台灣代工生產，其中色彩/調技術.配色理論.配方.品管及包裝，皆在德國Stockmar廠完成。</p>\n\n<p>色卡</p>', '<p>貨號：85096325-26</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:40:31', '2018-07-25 15:40:31'),
(40, 'kcqKFy6OZkzAQy5s55b6GCJMr1VUriAL5tn2sJiytF', 'Progresso無木12色鉛筆', NULL, 'Progresso無木12色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20170119191255.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20170119191255.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Progresso無木12色鉛筆</p>\n\n<p>長度：155mm，直徑 : 7.5mm，特殊表面漆，12種顏色<br />\n適用允許多個分層和混合顏色。<br />\n也可用於粉彩畫之技法。</p>', '<p>貨號：20572512</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:49:38', '2018-07-25 15:49:38'),
(41, '1zMDImbuZ4CqkgQnG2K4bv615AybzP4qjHvV7wYs6e', 'Progresso無木24色鉛筆', NULL, 'Progresso無木24色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 840, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20170119190422.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20170119190422.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Progresso無木24色鉛筆</p>\n\n<p>長度：155mm ，直徑: 7.5mm ，特殊表面漆，24種顏色<br />\n適用允許多個分層和混合顏色。<br />\n也可用於粉彩畫之技法。</p>', '<p>貨號：20572524</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:50:59', '2018-07-25 15:50:59'),
(42, 'Xhy6ODvY62xQZysl7YKugp7IoP39UwtVNc6e0zrir7', 'LYRA 色鉛筆12色(細)', NULL, 'LYRA 色鉛筆12色細', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536012.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536012.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>長度：175mm，直徑：7,5mm，12色~鐵盒</p>\n\n<p>※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20536012</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:52:02', '2018-07-25 15:52:02'),
(43, 'XhEjqjVkoNYnEWy8Ch3iHRhEDt7Zkyd6ZhDJprweov', 'LYRA 色鉛筆24色(細)', NULL, 'LYRA 色鉛筆24色細', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1180, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536024.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536024.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>長度：175mm，直徑：7,5mm，24色~鐵盒</p>\n\n<p>※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20536024</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:53:27', '2018-07-25 15:53:27'),
(44, 'l4LW5BRS4jDleNHYSH98W1lQBycMcHNjJSrmk3UKLw', 'LYRA 色鉛筆36色(細)', NULL, 'LYRA 色鉛筆36色細', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1580, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536036.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20536036.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>長度：175mm，直徑：7,5mm，36色~鐵盒+1 Splender</p>\n\n<p>※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20536036</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 15:56:32', '2018-07-25 15:56:32'),
(45, '6s83m9juqnFfjDffnvRCzC6h5leP1d4k0ViKsMjw0W', 'LYRA 色鉛筆72色(細)', NULL, 'LYRA 色鉛筆72色細', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 2880, 'room', NULL, '8WwNB7rMIkKhj2V1wG4kySn6lsNKeIUXqINgmhPLk0', 'http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20160513192647.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/彩色鉛筆(細)/20160513192647.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>長度：175mm，直徑：7,5mm，72色~鐵盒+2 Splender</p>\n\n<p>※堅持品質※本公司只銷售LYRA德國廠生產的產品。</p>', '<p>貨號：20536072</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:00:15', '2018-07-25 16:00:15'),
(46, '2aqvvhaXpp7YLlrQtGVliScZVaa9JPVfKMyxvP56dc', 'STOCKMAR 蜜蠟土15色', NULL, 'STOCKMAR 蜜蠟土15色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 900, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/85051600.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/85051600.jpg\"}]', '<p>商品詳細說明：全色系15色~紙盒裝</p>', '<p>貨號：85051600</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:02:13', '2018-07-25 16:02:13'),
(47, '6GliR3owxBsXCIJVF0ac8djuA66UnyKUV5waM1cVDQ', 'STOCKMAR 蜜蠟土單色', NULL, 'STOCKMAR 蜜蠟土單色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 900, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/850517--.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/850517--.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>單色*15 有15色可供選擇~~紙盒裝</p>\n\n<p>~~訂購請註明編號及顏色~~</p>\n\n<p><img alt=\"\" src=\"http://yigeng.egith.nethttp://yigeng.egith.net/photos/1/下載2.jpg\" style=\"width: 945px; height: 507px;\" /></p>', '<p>貨號：850517xx</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:04:59', '2018-07-25 16:04:59'),
(48, 'uIc9UUt4BIrGXJRiwcFCJi0QcEe8YhRkOOS1oTVtac', 'STOCKMAR 蜜蠟土12色', NULL, 'STOCKMAR 蜜蠟土12色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 700, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/85051200.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/85051200.jpg\"}]', '<p>商品詳細說明：12色~紙盒裝</p>', '<p>貨號：85051200</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:06:19', '2018-07-25 16:06:19'),
(49, 'exqStTFCKeAkpvR3TWpRPXWTnSwfFwxlF9kTfBtvrV', 'STOCKMAR 蜜蠟土6色', NULL, 'STOCKMAR 蜜蠟土6色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 420, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/85051000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/85051000.jpg\"}]', '<p>商品詳細說明：6色~紙盒裝</p>', '<p>貨號：85051000</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:09:36', '2018-07-25 16:09:36'),
(50, 'kQ9sx1Pe4iZoTrV3yTezGgfUnrrcxjhGIEOu7IH2Lk', 'STOCKMAR 蜜蠟土8色', NULL, 'STOCKMAR 蜜蠟土8色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 550, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/DSCF1521.JPG', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/DSCF1521.JPG\"}]', '<p>商品詳細說明：</p>\n\n<p>華德福8色組合~袋裝</p>\n\n<p>彩虹色+粉紅色</p>\n\n<p>華德福教師推薦</p>\n\n<p>每片尺寸：10*4*0.25cm<br />\n每片重量：約23g</p>', '<p>貨號：Y0003</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:11:19', '2018-07-25 16:11:19'),
(51, '8gd1twTZF7qinZ0TbXOCoFrqaM2NpH0z2S2Og0vd7v', 'STOCKMAR 蜜蠟土77片', NULL, 'STOCKMAR 蜜蠟土77片', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 4580, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/85051900.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/85051900.jpg\"}]', '<p>商品詳細說明：12色~77片禮盒裝</p>', '<p>貨號：85051900</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:12:26', '2018-07-25 16:12:26'),
(52, 'uBJbFxjspzHoESVRb9RMsSFbJ2ip2gLIMHpvsLCaQ6', 'Artemis 8色蜜蠟土', NULL, 'Artemis 8色蜜蠟土', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'TR2UhEvWDW5keIwjwByQCq6m3bN5Zqp8HbYQJpIolk', 'http://yigeng.egith.net/photos/1/蜜蠟土/20131008214135.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/蜜蠟土/20131008214135.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>天然的植物與蜂蠟結合，創造出透明的自然色彩。</p>\n\n<p>Made in Germany</p>', '<p>貨號：35205016</p>', 'outofstock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:13:43', '2018-07-25 16:13:43'),
(53, '3P0HTrIC4kA9Bhnqe7ycDXjksK6Tor74HopUC5Un61', 'Stockmar 非透明水彩~12色鐵盒', NULL, 'Stockmar 非透明水彩12色鐵盒', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 650, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/85046000.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/85046000.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Stockmar不透明的顏色，適合各種不同的繪畫技法。</p>\n\n<p>顏料的濃度是特別厚的。可使顏色更加豐富，即使大量稀釋，亦可保持其特性。</p>\n\n<p>made in Italy</p>', '<p>貨號：85046000</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:15:19', '2018-07-25 16:15:19'),
(54, 'di4voJyM2cmi4YqHHTqv3vLtUqiV6gKhA5LgwJwz6U', 'STOCKMAR水彩20ml', NULL, 'STOCKMAR水彩20ml', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 250, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/850430--.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/850430--.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>20ml~22色可供選擇</p>\n\n<p>19 Colours~~色卡</p>\n\n<p>Colour Circle~~色卡</p>\n\n<p>~~訂購請註明編號及顏色~~</p>\n\n<p>@@色號#19 cobalt blue為特定色號，因原料及製程較特別，故未必有現貨，價格也非同此品項，如需訂購請來電或MAIL洽詢@@</p>', '<p>貨號：850430xx</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:17:49', '2018-07-25 16:17:49'),
(55, 'HRugnrWjFihK0gEZPc5ZGl1GOZ0Hngt10MNsvkU6Bw', 'STOCKMAR水彩12色木盒組', NULL, 'STOCKMAR水彩12色木盒組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 2980, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/85043046.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/85043046.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>20ml*12色~木盒&amp;配件組</p>\n\n<p>色號</p>', '<p>貨號：85043046</p>', 'outofstock', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:19:45', '2018-07-25 16:19:45'),
(56, 'XaXonK1NHOwCxOYSnP0CXf91wX6cqraxMzbN1M1Zxv', 'STOCKMAR水彩20ml 副6色組', NULL, 'STOCKMAR水彩20ml 副6色組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 980, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/20130614212433.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/20130614212433.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>20ml *6色~紙盒</p>', '<p>貨號：85043042</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:20:58', '2018-07-25 16:20:58'),
(57, 'VY1EgpPWK8LOCJ47g3xa07fy3ygeW2r7swWeg53fri', 'STOCKMAR水彩50ml', NULL, 'STOCKMAR水彩50ml', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 480, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/20130614212405.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/20130614212405.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>&nbsp;50ml~22色可供選擇</p>\n\n<p>19 Colours~~色卡</p>\n\n<p>Colour Circle~~色卡</p>\n\n<p>&nbsp;</p>\n\n<p>~~訂購請註明編號及顏色~~</p>\n\n<p>@@色號#19 cobalt blue為特定色號，因原料及製程較特別，故未必有現貨，價格也非同此品項，如需訂購請來電或MAIL洽詢@@</p>', '<p>貨號：850420xx</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:22:41', '2018-07-25 16:22:41'),
(58, 'hYAtwEZhtw4TU3niypJr0bwhlRt1ZSyc89VyLd5tT9', 'STOCKMAR水彩20ml 正6色組', NULL, 'STOCKMAR水彩20ml 正6色組', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 980, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/20130614212327.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/20130614212327.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>20ml *6色~紙盒</p>', '<p>貨號：85043041</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:23:51', '2018-07-25 16:23:51'),
(59, 'jjf10gHQmQbB2OY9jWADyx5DI19Zl6qjJotApwlr2H', 'STOCKMAR 水彩250ml', NULL, 'STOCKMAR 水彩250ml', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1980, 'room', NULL, 'OSVpUqGvlPQH73KCNlFVUNELf5xIX9sL8W9raHq17D', 'http://yigeng.egith.net/photos/1/水彩/20130614212304.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩/20130614212304.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>250ml~22色可供選擇</p>\n\n<p>19 Colours~~色卡</p>\n\n<p>Colour Circle~~色卡</p>\n\n<p>~~訂購請註明編號及顏色~~</p>\n\n<p>@@色號#19 cobalt blue為特定色號，因原料及製程較特別，故未必有現貨，價格也非同此品項，如需訂購請來電或MAIL洽詢@@</p>\n\n<p>缺貨：01.05</p>', '<p>貨號：850410xx</p>', 'outofstock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:25:04', '2018-07-25 16:25:04'),
(60, 'NtBPA96a2UPoTzgvNaA7jS3gq8RsNrmgFN4VpyQhDd', 'LYRA 水彩色鉛筆12色', NULL, 'LYRA 水彩色鉛筆12色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 620, 'room', NULL, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', 'http://yigeng.egith.net/photos/1/水彩鉛筆/20539012.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩鉛筆/20539012.jpg\"}]', '<p>商品詳細說明：書寫、著色與水彩畫</p>', '<p>貨號：20539012</p>', 'outofstock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:27:21', '2018-07-25 16:27:21'),
(61, '00Ij3inuQ9u9QkNJTdfSnVJbWUgHWgsAstQ4lPgVp7', 'LYRA 水彩色鉛筆24色', NULL, 'LYRA 水彩色鉛筆24色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1200, 'room', NULL, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', 'http://yigeng.egith.net/photos/1/水彩鉛筆/20539024.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩鉛筆/20539024.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>書寫、著色與水彩畫</p>', '<p>貨號：20539024</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:28:27', '2018-07-25 16:28:27'),
(62, 'p8ffp9OK2Pth0FkuctabvdftiBLXxmmBXlbd3NoR04', 'LYRA 水彩色鉛筆36色', NULL, 'LYRA 水彩色鉛筆36色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 1680, 'room', NULL, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', 'http://yigeng.egith.net/photos/1/水彩鉛筆/20539036.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩鉛筆/20539036.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>書寫、著色與水彩畫&nbsp;36色鐵盒</p>', '<p>貨號：20539036</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:30:38', '2018-07-25 16:30:38'),
(63, 'Rbnn0dsxrZOnMYQ7D4hYTnuwj0zx8QzmX1ccsn57gu', 'LYRA 水彩色鉛筆72色', NULL, 'LYRA 水彩色鉛筆72色', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 2980, 'room', NULL, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', 'http://yigeng.egith.net/photos/1/水彩鉛筆/20539072.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩鉛筆/20539072.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>書寫、著色與水彩畫&nbsp;72色鐵盒</p>', '<p>貨號：20539072</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:31:43', '2018-07-25 16:31:43'),
(64, 'ZGBCJ0yrFtwh2LEYdTmo5cLgPPQbZqOTqyR8OA97C8', 'Mercurius水彩色鉛筆', NULL, 'Mercurius水彩色鉛筆', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 680, 'room', NULL, 'rojZu5EcLv8VJHs6yvaXv3oM41EcmGRpkhaXvOeNut', 'http://yigeng.egith.net/photos/1/水彩鉛筆/85092912.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩鉛筆/85092912.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>書寫、著色與水彩畫</p>', '<p>貨號：85092912</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:32:51', '2018-07-25 16:32:51'),
(65, '4ACqV4mimM6OQdYYKYFoKqQTpUfzAY4ulhR0YnMKRI', '濕水彩水瓶木座~3孔', NULL, '濕水彩水瓶木座3孔', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 360, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20140617220309.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20140617220309.jpg\"}]', '<p>櫸木~18x6x3 cm 有50ML &amp; 100ML兩種</p>\n\n<p>商品詳細說明：</p>\n\n<p>櫸木~18x6x3 cm（不含水瓶）</p>\n\n<p>有50ML &amp; 100ML兩種</p>\n\n<p>訂購請註明</p>\n\n<p>可搭配</p>\n\n<p>濕水彩水瓶 100cc 貨號：30165343</p>\n\n<p>濕水彩水瓶 &nbsp;50cc 貨號：30165043</p>', '<p>貨號：25915011</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:50:45', '2018-07-25 16:50:45'),
(66, 'n9wM2zoHpnTdPNrMVv245F0vXoJM508S7G64bhFTC7', '濕水彩水盤~無蓋', NULL, '濕水彩水盤無蓋', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 280, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20130619165433.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20130619165433.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>一組6個~無蓋</p>\n\n<p>可搭配</p>\n\n<p>濕水彩水盤木座 &nbsp;貨號：25915020</p>', '<p>貨號：25910006</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:52:15', '2018-07-25 16:52:15'),
(67, '90oDYur1hISAHyaHCC0pWBhJqvS7c4FqzURqfyQQpe', '濕水彩水盤木座', NULL, '濕水彩水盤木座', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 480, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20130619164857.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20130619164857.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>櫸木~40x7x2.5 cm（不含水盤）</p>\n\n<p>可搭配</p>\n\n<p>濕水彩水盤 &nbsp;貨號：25910006</p>', '<p>貨號：25915020</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:53:23', '2018-07-25 16:53:23'),
(68, 'pqor0LCoYMcGgm4FJ6uK3pQTVTXholMImGzDb6yE9c', '濕水彩水瓶木座~6孔', NULL, '濕水彩水瓶木座6孔', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 480, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20130619163757.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20130619163757.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>櫸木~35x6x3 cm（不含水瓶）</p>\n\n<p>可搭配</p>\n\n<p>濕水彩水瓶 100cc 貨號：30165343</p>\n\n<p>濕水彩水瓶 &nbsp;50cc 貨號：30165043</p>', '<p>貨號：29515001</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 16:54:39', '2018-07-25 16:54:39'),
(69, 'TqQU5xswvukhoQv6J69OFuLl8D6b7pH8CD0O4kmQaI', '濕水彩水瓶~50cc', NULL, '濕水彩水瓶50cc', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 300, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20130619162531.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20130619162531.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>規格：一組6瓶~50cc</p>\n\n<p>可搭配</p>\n\n<p>濕水彩水瓶木座 &nbsp;貨號：29515001</p>', '<p>貨號：30165043</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:01:04', '2018-07-25 17:01:04');
INSERT INTO `products` (`id`, `productGuid`, `productTitle`, `serialNumber`, `customPath`, `author`, `authorName`, `price`, `Temperature`, `discountedPrice`, `productCategory`, `featureImage`, `album`, `productDescription`, `shortDescription`, `productStatus`, `reserveStatus`, `isPublish`, `quantity`, `rule`, `rate`, `command`, `seoKeyword`, `seoTitle`, `productInformation`, `seoDescription`, `socialImage`, `schedulePost`, `scheduleDelete`, `created_at`, `updated_at`) VALUES
(70, 'KSAjZjMdSOsEchFT1or9p3W95v913kDoDdStKq76s5', '濕水彩水瓶~100cc', NULL, '濕水彩水瓶100cc', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 360, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/20130619161529.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/20130619161529.jpg\"}]', '<p>商品詳細說明： 可搭配 濕水彩水瓶木座 一組6瓶~100cc</p>', '<p>貨號：30165343</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:02:28', '2018-07-25 17:08:05'),
(71, '9UEKqjUYnG7tRbHSRBbktmdoCpGL2ZCtlnPBpp9IiL', 'Mercurius 水彩筆（白）~18號平頭', NULL, 'Mercurius 水彩筆白18號平頭', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 340, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/25528018.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/25528018.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Paint brush cows hair kindergarten</p>\n\n<p>Special brush of the same construction as the cows hair brush but with a<br />\nshort shite handle. Well balanced for younger children.</p>\n\n<p>Manufacturer: Mercurius - made in the EU</p>\n\n<p>18號平頭~適合較小兒童..</p>', '<p>貨號：25528018</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:03:43', '2018-07-25 17:03:43'),
(72, 'JWmLN1MQbFAzNe8dOVkjXCBZvnkKZpWcZR8M3ioCyH', 'Mercurius 水彩筆（白）~20號平頭', NULL, 'Mercurius 水彩筆白20號平頭', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 360, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/25528020.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/25528020.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Paint brush cows hair kindergarten</p>\n\n<p>Special brush of the same construction as the cows hair brush but with a<br />\nshort shite handle. Well balanced for younger children.</p>\n\n<p>Manufacturer: Mercurius - made in the EU</p>\n\n<p>20號平頭~適合較小兒童..</p>', '<table border=\"0\" width=\"186\">\n	<tbody>\n		<tr>\n			<td height=\"15\" valign=\"top\">\n			<p>貨號：25528020</p>\n			</td>\n		</tr>\n	</tbody>\n</table>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:04:47', '2018-07-25 17:04:47'),
(73, 'WgqG1ls8EOUGl9xSpAgpTQztxgXxDROsqN1LWDiT7t', 'Mercurius 水彩筆（白）~22號平頭', NULL, 'Mercurius 水彩筆白22號平頭', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 380, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/25528022.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/25528022.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Paint brush cows hair kindergarten</p>\n\n<p>Special brush of the same construction as the cows hair brush but with a<br />\nshort shite handle. Well balanced for younger children.</p>\n\n<p>Manufacturer: Mercurius - made in the EU</p>\n\n<p>22號平頭~適合較小兒童..</p>', '<p>貨號：25528022</p>', 'instock', 1, 0, 100, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:05:47', '2018-07-25 17:05:47'),
(74, 'qhJCqI0EVsljaqFdPrFTnIo43IFJL6RQqxX8wO9Pbf', 'Mercurius 水彩筆（棕）~20號平頭', NULL, 'Mercurius 水彩筆棕20號平頭', '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 320, 'room', NULL, 'vRa6VFxWuI0Yb7f2zQvJAs1b7ydTPcCHUk6cX2ypY2', 'http://yigeng.egith.net/photos/1/水彩筆配件/25525020.jpg', '[{\"imageUrl\":\"http://yigeng.egith.net/photos/1/水彩筆配件/25525020.jpg\"}]', '<p>商品詳細說明：</p>\n\n<p>Flat Cow Hair Brushes</p>\n\n<p>The classic Waldorf school brush with a red painted handle and soft cows hair. With proper care these brushes will last for a long time. For the lower classes, we recommend strengths 16, 18, or 20 and for kindergarten, strengths 20 or 22.<br />\nWith proper care the brushes will last for many years.<br />\n&nbsp;<br />\nManufacturer: Mercurius - made in the EU</p>\n\n<p>Mercurius 水彩筆（棕）~20號平頭</p>\n\n<p>如需其他號碼，請來電洽詢。</p>', '<p>貨號：25525020</p>', 'outofstock', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, '{\"weight\":null,\"size\":{\"productLength\":null,\"productWidth\":null,\"productHeight\":null}}', NULL, NULL, NULL, NULL, '2018-07-25 17:06:41', '2018-07-25 17:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
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
-- Table structure for table `shoppingcart`
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
-- Table structure for table `site_meta`
--

CREATE TABLE `site_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `shortcut` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pageTopContent` longtext COLLATE utf8mb4_unicode_ci,
  `pageTopLink` longtext COLLATE utf8mb4_unicode_ci,
  `pageTopButton` longtext COLLATE utf8mb4_unicode_ci,
  `index_album` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_meta`
--

INSERT INTO `site_meta` (`id`, `title`, `keyword`, `description`, `shortcut`, `pageTopContent`, `pageTopLink`, `pageTopButton`, `index_album`, `created_at`, `updated_at`) VALUES
(1, '易耕事業有限公司', '文具、粉彩、圖書、藝術用品、美術用品', '易耕事業有限公司成立於2006年，至今耕耘長達12年，專營各種文具、樂器、美術用品、書籍等的線上購物同時易耕也是Stockmar、Mercurius、LYRA...各大國際知名品牌的台灣總代理。經營多年以來，易耕了解台灣人文藝術涵養相當豐富，因此將持續用最實惠的價格，提供最專業的用具。', 'http://yigeng.egith.net/photos/1/ivan-bandura-657883-unsplash.jpg', NULL, NULL, NULL, '[{\"title\":\"BG1\",\"url\":\"http://yigeng.egith.net/photos/1/BG2.jpg\",\"link\":null}]', '2018-07-24 13:07:07', '2018-07-25 14:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `guid` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL,
  `socialUser` tinyint(1) NOT NULL DEFAULT '0',
  `subscriptable` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(181) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(181) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `point` int(11) NOT NULL DEFAULT '25',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `guid`, `name`, `email`, `password`, `socialUser`, `subscriptable`, `role`, `level`, `status`, `point`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '82dc824b-de0a-ac43-ceab-aaab1d942afc', 'Admin', 'admin@admin.com', '$2y$10$pj/plAu5f9XNwhB3QBKGU.hCZ7TReLXKUunJzQvNeydPbIdbEQ.7C', 0, 0, 'ADMIN', 'VIP', 'ACTIVE', 9999, NULL, '2018-07-11 18:19:11', '2018-07-11 18:19:11'),
(2, 'sEWTYC73ozxXAOUGIQwtUZZ3FVyMOeSr86cTiLF1hX', '碩果測試', 'mkchang@bigdigtal.com.tw', '$2y$10$hBJlfl2/8SLd1NvouJXxyerOgfuyy.zNyntdOTlotRUeHWd6BiUiC', 0, 0, 'ADMIN', 'NORMAL', 'ACTIVE', 25, 'dwOPK0U37yIJEA5tx3sAXcfetxmOMU4PTK3tFix33AJXF6npf2mHnPeAmvKQ', '2018-07-24 16:07:27', '2018-07-24 16:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `site_meta`
--
ALTER TABLE `site_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_meta`
--
ALTER TABLE `site_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
