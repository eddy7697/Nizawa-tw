-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2019 年 03 月 27 日 17:24
-- 伺服器版本: 10.2.19-MariaDB
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
