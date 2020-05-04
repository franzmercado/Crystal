-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 08:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crystaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `lname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `lname`, `fname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Doe', 'John', 'admin@admin.com', NULL, '$2y$10$4QWn9zGr/OGSti1YoZdlkeggvtS8UD6HgShGvgedID2TBpNcrKrnm', '4vgJsPAtUQ0PPuQvWZ4jUbbXLjqQ0AbEMWi2DaIgd3lk8KI6Skbxd1PywDKw', '2019-08-26 23:19:12', '2020-04-29 13:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `userID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Whiskey', '2019-09-30 04:34:38', '2019-09-30 05:06:35', NULL),
(2, 'Rum', '2019-09-30 04:34:47', '2020-04-19 05:03:06', NULL),
(3, 'Vodka', '2019-09-30 04:34:55', '2020-04-19 09:14:18', NULL),
(4, 'Solera Brandy', '2019-09-30 05:08:57', '2019-09-30 05:08:57', NULL),
(5, 'Tequila', '2019-09-30 05:20:47', '2019-09-30 05:20:47', NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_26_053429_create_products_table', 2),
(4, '2019_08_03_022609_create_admins_table', 3),
(5, '2019_08_28_174136_add_fields_users_table', 4),
(11, '2019_09_12_182321_create_info_table', 7),
(20, '2019_09_13_065506_create_categories_table', 14),
(23, '2019_09_13_092648_create_transactions_table', 17),
(28, '2019_09_13_161035_add_time_table', 19),
(29, '2019_09_14_121658_alter_category', 20),
(30, '2019_09_15_055843_add_soft_del', 21),
(31, '2019_09_15_125148_add_timestamp', 22),
(33, '2019_09_16_101614_add_birthday', 23),
(35, '2019_09_06_191812_create_products_table', 24),
(36, '2019_09_13_012012_create_cart_table', 25),
(37, '2019_09_13_124309_create_orders_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `transactionID` bigint(20) NOT NULL,
  `prodID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `isExcluded` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `transactionID`, `prodID`, `quantity`, `isExcluded`) VALUES
(1, 202005019547268103, '5eaa983e29b9d', 1, 0),
(2, 202005019547268103, '5eaa9658d5f2f', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$G902U0nYliUVqBBigDwJA.HioL/190j6rhduGDRFUD8vNfY3kAcZ6', '2019-08-27 07:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prodID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suppimg1` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brandName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` enum('325ml','500ml','750ml','1L','1.5L','1.75L','2L') COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryID` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prodID`, `thumbnail`, `suppimg1`, `brandName`, `size`, `categoryID`, `description`, `quantity`, `price`, `sold`, `created_at`, `updated_at`, `deleted_at`) VALUES
('5d918ebdb7a5b', '1046659928.jpg', NULL, 'Fundador I', '1L', 4, 'The standard Spanish brandy, its smoothness, distinct aroma and rich, full-bodied flavor is proof of its prestigious heritage as the best-selling premium spirit & one of the most iconic imported brands in the Philippines for more than a century since 1902.', 4, 600.00, 0, '2019-09-30 05:12:29', '2020-04-29 08:20:46', NULL),
('5d9191abcf40d', '1830098124.jpg', NULL, 'Patron Silver', '750ml', 4, 'Patron Silver Tequila is the perfect ultra-premium white spirit. Using only the finest 100 percent Weber blue agave, it is handmade in small batches to be smooth, soft and easily mixable. This light, crystal clear tequila with fresh agave aromas and hints of citrus is a favorite of tequila connoisseurs worldwide, and mixes flawlessly into most any cocktail.', 8, 2400.00, 0, '2019-09-30 05:24:59', '2020-04-24 07:14:48', NULL),
('5e96b7b8da145', '1022989883.jpg', NULL, 'Smirnoff No. 21', '750ml', 3, 'Smirnoff No. 21 Vodka is the World\'s No. 1 Vodka. Our award-winning vodka has robust flavor with a dry finish for ultimate smoothness and clarity. Triple distilled and 10 times filtered, our vodka is perfect on the rocks or in your favorite cocktail. Smirnoff No. 21 is Kosher Certified and gluten free.', 40, 790.00, 0, '2020-04-15 07:28:56', '2020-04-30 09:15:36', NULL),
('5e96b7c5184bd', '1598760325.jpg', NULL, 'Jose Cuervo Especial Silver', '750ml', 5, 'The epitome of smoothness, Jose Cuervo Especial Silver Tequila is a treat for the discriminating customer. An authentic silver tequila, Especial Silver is masterfully balanced to bring out its caramel, agave and herbal tones.', 50, 999.00, 0, '2020-04-15 07:29:09', '2020-04-30 09:04:22', NULL),
('5e9c20d4ee60b', '2059758703.PNG', NULL, 'Sasa', '325ml', 4, '12', 12, 12.00, 0, '2020-04-19 09:58:44', '2020-04-19 12:57:51', '2020-04-19 12:57:51'),
('5eaa9658d5f2f', '603004596.jpg', NULL, 'Smirnoff No. 21', '1L', 3, 'Smirnoff No. 21 Vodka is the World\'s No. 1 Vodka. Our award-winning vodka has robust flavor with a dry finish for ultimate smoothness and clarity. Triple distilled and 10 times filtered, our vodka is perfect on the rocks or in your favorite cocktail. Smirnoff No. 21 is Kosher Certified and gluten free.', 198, 1500.00, 1, '2020-04-30 09:11:52', '2020-05-01 06:49:49', NULL),
('5eaa983e29b9d', '1767905029.jpg', NULL, 'Jack Daniel’s, Old No. 7', '750ml', 1, 'The original all-conquering cola-friendly colossus, Jack Daniel\'s No. 7 commands a legion of fans worldwide, thanks to the sweet smoothness imparted by the Lincoln County Process of charcoal-mellowing the spirit before maturation.\r\nJack Daniel\'s Old No.7 Whiskey is mellowed drop by drop through 10-feet of sugar maple charcoal, then matured in handcrafted barrels.', 18, 1490.00, 1, '2020-04-30 09:19:58', '2020-05-01 06:49:49', NULL),
('5eaaa45a97a6a', '1764198347.jpg', NULL, 'Fundador I', '2L', 4, 'The standard Spanish brandy, its smoothness, distinct aroma and rich, full-bodied flavor is proof of its prestigious heritage as the best-selling premium spirit & one of the most iconic imported brands in the Philippines for more than a century since 1902.', 50, 1499.00, 0, '2020-04-30 10:11:38', '2020-04-30 10:11:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` bigint(20) NOT NULL,
  `userID` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `total` double(8,2) NOT NULL,
  `dateFinished` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionID`, `userID`, `status`, `total`, `dateFinished`, `created_at`, `updated_at`) VALUES
(202005019547268103, 'CTL-1', 4, 2990.00, '2020-05-01', '2020-05-01 06:36:32', '2020-05-01 06:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `userID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `mobileNum` bigint(11) NOT NULL,
  `birthDay` date NOT NULL,
  `buldingNum` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brgy` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `userID`, `gender`, `mobileNum`, `birthDay`, `buldingNum`, `brgy`, `city`, `province`, `zip`, `created_at`, `updated_at`) VALUES
(7, 'CTL-1', 1, 9981231121, '1997-08-29', '#12 Juan Luna st', 'Baliwag', 'Caloocan', 'Metro Manila', 1212, '2020-05-01 06:35:11', '2020-05-01 06:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `midName` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `midName`, `lastName`, `email`, `email_verified_at`, `password`, `isActive`, `remember_token`, `created_at`, `updated_at`) VALUES
('CTL-1', 'Juan', NULL, 'Dela Cruz', 'juandelacruz@gmail.com', NULL, '$2y$10$bB3GmcUgEQsq1bUOeaOSf.ooprgjcOZKmnGlVPbD12NSO5hNFW84O', 1, 'sSNqifC19O8n5ZBYm74OrDCoAxoljvhHBgZDjoBf1FskgokaRdTRhLnohoFp', '2020-05-01 06:35:11', '2020-05-01 06:50:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_prodid_foreign` (`prodID`),
  ADD KEY `carts_userid_foreign` (`userID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `orders_prodid_foreign` (`prodID`),
  ADD KEY `orders_transactionid_foreign` (`transactionID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prodID`),
  ADD KEY `products_categoryid_foreign` (`categoryID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `transactions_userid_foreign` (`userID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userinfo_userid_foreign` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_prodid_foreign` FOREIGN KEY (`prodID`) REFERENCES `products` (`prodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_prodid_foreign` FOREIGN KEY (`prodID`) REFERENCES `products` (`prodID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_transactionid_foreign` FOREIGN KEY (`transactionID`) REFERENCES `transactions` (`transactionID`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categoryid_foreign` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
