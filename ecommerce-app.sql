-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 08:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `is_checkout` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `period` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `member_id`, `id_product`, `is_checkout`, `created_at`, `updated_at`, `quantity`, `total`, `period`) VALUES
(18, 64, 1, 0, '2023-08-09 15:52:37', '2023-08-09 15:52:55', 1, 10, 'januari'),
(19, 64, 19, 0, '2023-08-09 15:52:48', '2023-08-09 15:52:55', 1, 5, 'desember'),
(21, 63, 1, 0, '2023-08-24 07:30:23', '2023-08-28 22:29:02', 1, 10, 'januari'),
(22, 63, 12, 0, '2023-08-28 22:26:34', '2023-08-28 22:29:02', 1, 10, 'desember');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Digital Content', 'Individual or Group (MAX 3 Person)', '16887187077.jpg', '2023-05-10 09:45:18', '2023-07-07 01:31:47'),
(2, 'Create Facilities', 'Individual or Group (MAX 3 Person)', '16887181461.jpg', '2023-05-10 09:45:48', '2023-07-07 02:22:05'),
(3, 'Seeding', 'Individual or Group (MAX 3 Person)', '16838784245.jpg', '2023-05-10 09:46:38', '2023-07-07 01:35:06'),
(4, 'Scientific Papers', 'Individual or Group (MAX 3 Person)', '16887190093.jpg', '2023-06-12 15:36:52', '2023-07-07 01:36:49');

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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_binusian` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `pts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_name`, `address`, `phone_number`, `email`, `password`, `created_at`, `updated_at`, `id_binusian`, `major`, `pts`) VALUES
(63, 'verdianto', 'Jl. Kendeng', '082138976988', 'verdiantoalgonz@gmail.com', '$2y$10$AT9z4x0pcnKRLHNbZORvN.bI9TDX5aNkbkQK3qpabgKJZUyH8.jCC', '2023-07-17 06:15:19', '2023-07-17 06:15:19', '2301886374', 'Computer Science', 0),
(64, 'member test', 'Jl. Kokosan', '081234567980', 'usertest@gmail.com', '$2y$10$C4MwRIWKnVLkxOdxUbA/S.fo4XBQ8RHLnRVnwa51KVYkpuiMxQirW', '2023-08-09 15:52:04', '2023-08-09 15:52:04', '2301888899', 'Creativepreneurship', 0);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_10_151719_create_categories_table', 2),
(6, '2023_05_11_100744_create_subcategories_table', 3),
(7, '2023_05_12_061441_create_sliders_table', 4),
(8, '2023_05_12_073615_create_products_table', 5),
(9, '2023_05_17_171959_create_members_table', 6),
(10, '2023_05_17_175029_create_testimonis_table', 7),
(11, '2023_05_17_180258_create_reviews_table', 8),
(12, '2023_05_24_070455_create_orders_table', 9),
(13, '2023_05_24_080806_add_status_to_orders_table', 10),
(14, '2023_05_29_095220_remove_member_column', 11),
(15, '2023_05_29_095747_rename_members_column', 12),
(16, '2023_05_29_101512_add_column_to_table', 12),
(17, '2023_05_29_101922_add_major_to_members_table', 13),
(18, '2023_05_29_102149_remove_province_from_members_table', 14),
(19, '2023_05_29_103711_remove_product_column', 15),
(20, '2023_05_29_104603_add_purpose_to_products_table', 16),
(21, '2023_05_29_110516_add_requirements_to_products_table', 17),
(22, '2023_05_29_111954_remove_quantity_from_order_details_table', 18),
(23, '2023_06_11_155903_add_comserv_hour_to_members_table', 18),
(24, '2023_06_11_160314_remove_qty_size_color_to_orders_table', 19),
(25, '2023_06_11_161939_add_req_to_orders_details_table', 20),
(26, '2023_06_11_162504_remove_obt_to_orders_details_table', 21),
(27, '2023_06_11_164001_remove_obt_from_products_table', 22),
(28, '2023_06_11_164215_remove_obt_from_products_table', 23),
(29, '2023_06_11_164235_add_obt_from_products_table', 24),
(30, '2023_06_11_171929_add_quantity_to_orders_details_table', 25),
(31, '2023_06_14_133452_remove_purpose_from_product_table', 26),
(33, '2023_06_27_051905_create_payments_table', 27),
(34, '2023_06_27_070005_remove_quantity_from_payments_table', 28),
(35, '2023_06_27_070139_add_total_to_payments_table', 29),
(36, '2023_06_27_070519_add_total_to_payments_table', 30),
(37, '2023_06_27_070716_add_ttl_to_payments_table', 31),
(38, '2023_06_27_070818_add_ttl_to_payments_table', 32),
(40, '2023_07_17_140856_create_carts_table', 33),
(41, '2023_07_17_154733_remove_purpose_from_orders_details_table', 34),
(42, '2023_07_17_154826_remove_purpose_from_carts_table', 35),
(43, '2023_07_17_170852_remove_location_from_carts_table', 36),
(44, '2023_07_17_171345_remove_location_from_orders_details_table', 37),
(46, '2023_07_18_105400_remove_qty_from_carts_table', 38),
(47, '2023_07_26_225010_remove_total_major_address_from_payments_table', 39),
(48, '2023_07_26_233408_add_member_id_to_payments_table', 40);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `period` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_order` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `period` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `obtained` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `id_subcategory`, `product_name`, `image`, `description`, `created_at`, `updated_at`, `period`, `location`, `requirements`, `obtained`) VALUES
(1, 1, 1, 'ComServ A', '16853583942.jpg', 'this activities ....', '2023-05-29 04:06:34', '2023-05-29 04:06:34', 'januari , maret', 'bandung', 'none', 10),
(2, 1, 2, 'ComServ B', '16862122394.jpg', 'no description', '2023-06-08 01:17:19', '2023-06-08 01:17:19', 'januari , maret', 'jogja', 'none', 10),
(12, 4, 16, 'ComServ D', '16889335577.jpg', 'no desc', '2023-07-09 13:12:37', '2023-07-09 13:12:37', 'oktober , desember', 'bali', 'none', 10),
(14, 2, 12, 'ComServ E', '16889373717.jpg', 'no desc', '2023-07-09 13:13:48', '2023-07-09 14:16:11', 'januari , maret', 'medan', 'none', 10),
(16, 4, 16, 'ComServ G', '16889337066.jpg', 'no desc', '2023-07-09 13:15:06', '2023-07-09 13:15:06', 'april , june', 'cilacap', 'none', 10),
(17, 1, 3, 'ComServ H', '16889342816.jpg', 'no desc', '2023-07-09 13:24:41', '2023-07-09 13:24:41', 'april , june', 'tegal', 'none', 10),
(18, 3, 14, 'ComServ C', '16896766676.jpg', 'no desc', '2023-07-18 03:37:47', '2023-07-18 03:37:47', 'april, june', 'jakarta', 'none', 5),
(19, 3, 14, 'ComServ F', '16896767179.jpg', 'no desc', '2023-07-18 03:38:37', '2023-07-18 03:38:37', 'oktober, desember', 'bandung', 'none', 5),
(20, 2, 11, 'ComserveTest', '16896767572.jpg', 'no desc', '2023-07-18 03:39:17', '2023-07-18 03:39:17', 'april, june', 'jakarta', 'none', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `member_id`, `product_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 54, 1, 'this is my review for the activity', 5, '2023-05-17 11:19:37', '2023-05-17 11:19:37'),
(2, 55, 2, 'this is also my review for the activity', 4, '2023-05-17 11:20:26', '2023-05-17 11:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'BINUS COMSERV', 'Guidelines for Community Services Compliance', '16887180334.jpg', '2023-05-11 23:57:17', '2023-07-07 01:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `id_category`, `subcategory_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Education', 'ewqeqw', '16838024067.jpg', '2023-05-11 03:53:26', '2023-07-07 02:18:38'),
(2, 1, 'Health', 'sdsds', '16838025352.jpg', '2023-05-11 03:55:35', '2023-07-07 02:18:51'),
(3, 1, 'Environment', 'qweqwe', '16838025628.jpg', '2023-05-11 03:56:02', '2023-07-07 02:19:14'),
(11, 2, 'Fac 1', 'no description', '16838824702.jpg', '2023-05-12 02:07:50', '2023-07-07 02:22:35'),
(12, 2, 'Fac 2', 'no description', '16838825025.jpg', '2023-05-12 02:08:22', '2023-07-07 02:22:43'),
(13, 2, 'Fac 3', 'no description', '16838826441.jpg', '2023-05-12 02:10:44', '2023-07-07 02:22:52'),
(14, 3, 'Seed sub 1', 'no desc', '16887245419.jpg', '2023-07-07 03:09:01', '2023-07-07 03:09:01'),
(16, 4, 'Science sub 1', 'description', '16867425063.jpg', '2023-06-14 04:35:06', '2023-07-07 02:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `testimonis`
--

CREATE TABLE `testimonis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimoni_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonis`
--

INSERT INTO `testimonis` (`id`, `testimoni_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'testimoni A', 'pengalaman yg menarik', '16867544425.jpg', '2023-05-17 10:59:47', '2023-07-07 01:52:22'),
(3, 'testimoni B', 'trims atas pengalamannya', '16867544243.jpg', '2023-06-14 07:53:44', '2023-07-07 01:52:30'),
(4, 'testimoni C', 'pengalamannya sangat membantu', '16887202464.jpg', '2023-07-07 01:57:26', '2023-07-07 01:57:26');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'verdi', 'verdi@email.com', NULL, '$2y$10$Jypl.sO4896iBinyYztQ3uK38j33oeg.3ez1tD.ac1ajoZZRz1E96', NULL, '2023-05-11 03:47:15', '2023-05-11 03:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
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
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonis`
--
ALTER TABLE `testimonis`
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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `testimonis`
--
ALTER TABLE `testimonis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
