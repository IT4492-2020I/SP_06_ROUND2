-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: my_mysql
-- Thời gian đã tạo: Th12 29, 2020 lúc 09:21 AM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ltct`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorys`
--

CREATE TABLE `categorys` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `status`, `created_at`) VALUES
(11, 'áo khoác', 1, '2020-12-01 07:05:29'),
(12, 'áo ba lỗ', 1, '2020-12-01 07:05:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2019_12_09_015401_create_jobs_table', 1),
(14, '2019_11_26_064059_create_users_table', 2),
(15, '2019_11_26_104714_create_categorys_table', 2),
(16, '2019_11_26_104753_create_products_table', 2),
(17, '2019_11_28_201046_create_orders_table', 2),
(18, '2019_11_28_201110_create_order_details_table', 2),
(19, '2020_11_30_144711_create_sizes_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `status`, `created_at`) VALUES
(7, 12, 20000, 3, '2020-12-01 10:05:41'),
(8, 14, 300000, 0, '2020-12-19 16:00:01'),
(9, 12, 20000, 0, '2020-12-19 16:38:54'),
(10, 12, 100000, 0, '2020-12-20 14:30:55'),
(11, 12, 100000, 1, '2020-12-20 14:45:42'),
(12, 12, 100000, 1, '2020-12-20 15:07:50'),
(13, 12, 100000, 1, '2020-12-20 15:09:36'),
(14, 12, 20000, 1, '2020-12-20 16:08:16'),
(15, 12, 100000, 0, '2020-12-20 16:22:27'),
(16, 12, 800000, 0, '2020-12-20 16:33:32'),
(17, 12, 400000, 0, '2020-12-21 02:04:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `quantity` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `size`, `quantity`) VALUES
(7, 7, 20, 0, 1),
(8, 8, 12, 0, 2),
(9, 8, 16, 0, 1),
(10, 9, 20, 0, 1),
(11, 10, 12, 0, 1),
(14, 11, 12, 0, 1),
(15, 12, 15, 0, 1),
(17, 13, 16, 0, 1),
(18, 14, 21, 0, 1),
(19, 15, 16, 0, 1),
(20, 16, 15, 0, 8),
(21, 17, 12, 0, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `category_id`, `status`, `description`, `created_at`) VALUES
(12, 'Áo khoác mùa đông', '/upload/product/khoac2.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(13, 'Áo khoác mùa đông', '/upload/product/khoac3.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(14, 'Áo khoác mùa đông', '/upload/product/khoac4.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(15, 'Áo khoác mùa đông', '/upload/product/khoac5.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(16, 'Áo khoác mùa đông', '/upload/product/khoac6.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(17, 'Áo khoác mùa đông', '/upload/product/khoac7.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(18, 'Áo khoác mùa đông', '/upload/product/khoac8.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(19, 'Áo khoác mùa đông', '/upload/product/khoac8.jpeg', 100000, 11, 1, 'Áo khoác thiết kế theo form dáng sơ mi body, tay dài, cổ và tay áo viền trắng cho chàng trai vẻ thanh lịch và đầy nam tính. Chất liệu vải trơn cao cấp, mềm mịn, thoáng mát, thấm hút mồ hôi, không nhăn. Gam màu xanh ngọc đậm trẻ trung', '2020-12-01 07:10:10'),
(20, 'Áo ba lỗ độ mixi', 'upload/product/balo1.jpg', 20000, 12, 1, 'Áo Ba Lỗ Nam thiết kế thể thao-trẻ trung-phù hợp nhiều đối tượng', '2020-12-01 15:21:20'),
(21, 'Áo ba lỗ độ mixi', 'upload/product/balo2.jpg', 20000, 12, 1, 'Áo Ba Lỗ Nam thiết kế thể thao-trẻ trung-phù hợp nhiều đối tượng', '2020-12-01 15:22:20'),
(22, 'Áo ba lỗ độ mixi', 'upload/product/balo3.jpg', 20000, 12, 1, 'Áo Ba Lỗ Nam thiết kế thể thao-trẻ trung-phù hợp nhiều đối tượng', '2020-12-01 15:23:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avata_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `avata_url`, `password`, `address`, `phone`, `role`, `remember_token`, `status`, `created_at`) VALUES
(1, 'che.huong@example.com', 'Âu Hưng Phụng', 'https://lorempixel.com/640/480/?16058', '$2y$10$nuRRccW9yMo9arYKkw2YSO.6S4EMsdVTPjqpTCdUBXeX.zj0smGO.', '12 Phố Kha Giác Ái, Phường Khương Hạnh Phương, Huyện Vĩ\nCần Thơ', '05167193054', 2, NULL, 1, '2020-11-30 17:11:40'),
(2, 'kieu.bong@example.net', 'Vi Vy Chi', 'https://lorempixel.com/640/480/?50357', '$2y$10$abeeRbFSkRp91NRCQjAU.OiwxFtkZvcIp0ZHs0RKB6hQZ3Bn7Dtqy', '71 Phố Ân, Phường Cầm, Quận Thịnh Thành\nHà Tĩnh', '00519486770', 1, NULL, 0, '2020-11-30 17:11:40'),
(3, 'gtieu@example.net', 'Bác. Trà Mộc Lộc', 'https://lorempixel.com/640/480/?27423', '$2y$10$x32usX/QFYq8iV8ulHHJV.WcIYmZkZORpnvA3lWjI6YMBWhFP3PQK', '0443 Phố Trác Hân Nghiêm, Xã Lộc, Huyện 3\nLâm Đồng', '06799541340', 1, NULL, 1, '2020-11-30 17:11:41'),
(4, 'tbao@example.com', 'Anh. Tạ Khương Duệ', 'https://lorempixel.com/640/480/?35767', '$2y$10$PCiOJu6BSjpJT9FUBMqDveYwSO9j/4jwYTOjDOQEbwhKXkzDAgzpS', '7316 Phố Độ, Phường Thường, Huyện Cái Nhã\nĐà Nẵng', '09724079398', 2, NULL, 0, '2020-11-30 17:11:41'),
(5, 'inhiem@example.net', 'Nghị Dạ Nhã', 'https://lorempixel.com/640/480/?63120', '$2y$10$Dq0XFnPXb./2giLNF.vahOqhVQ.DDb.tAD5M/4J8ma0Rug6mEcGA.', '1, Thôn Vĩnh, Phường Khu, Huyện 84\nTuyên Quang', '00908043759', 2, NULL, 0, '2020-11-30 17:11:41'),
(6, 'thac.ong@example.com', 'Thi Đông Lan', 'https://lorempixel.com/640/480/?37166', '$2y$10$xu5uPsjguIhm/l1A5c6cHeG26iqDIdAJKocYzyD98w5QUAgOEDMwy', '116 Phố Tiêu Nhàn Hỷ, Xã Phước, Huyện 8\nHải Phòng', '04328327028', 2, NULL, 1, '2020-11-30 17:11:41'),
(7, 'doan.trieu@example.com', 'Tiêu Đào', 'https://lorempixel.com/640/480/?93699', '$2y$10$AmNY7UpwyHz99ooD1E6/A.aHlg71q8kh6TN8JDA5sIku/Q7MwUg6G', '86 Phố Chử, Phường Nghiêm, Huyện Lương Trung\nHà Giang', '06645455462', 1, NULL, 0, '2020-11-30 17:11:41'),
(8, 'htrinh@example.org', 'Anh. Kim Tài', 'https://lorempixel.com/640/480/?11898', '$2y$10$lFR0WlQVnY0YQlAdSVR46elRHlZncI2Q9tm9bSmvgu0lc/sHJrI8q', '504 Phố Nguyễn, Thôn Viên Quế, Quận Minh Ân\nHải Phòng', '02788763854', 2, NULL, 0, '2020-11-30 17:11:41'),
(9, 'ugiap@example.com', 'Chu Sương', 'https://lorempixel.com/640/480/?32984', '$2y$10$guCVf6KtasjB9M6py9RE9eR7VbHDaElgUyIcKjEcd7oF7OXPW5rby', '0 Phố Viên Thông Uyên, Phường Trung Hòa, Huyện Nguyệt Uyên\nĐà Nẵng', '08137669028', 1, 'FtCVL0sj5iWfVjfIQdg0XaXhfHR1at7Tk224XlFtRGCMRWEN4zSiQ8hkXqRE', 1, '2020-11-30 17:11:41'),
(10, 'rhan@example.com', 'Em. Điền Kim', 'https://lorempixel.com/640/480/?85343', '$2y$10$fhjxSlISCgM7IktefBG4xejK9jSRGsnEN2GLYNk8Cz1jnWWPW/UF2', '82, Ấp Vũ, Phường Nghiêm, Quận Miên Ân\nQuảng Bình', '01515308700', 1, NULL, 0, '2020-11-30 17:11:42'),
(12, 'dung.nv.soict@gmail.com', 'Yen Bong', 'images/users/Screenshot from 2020-12-18 21-21-43.png', '$2y$10$SLVT8ey1jXZKDfpDdWFzXOOUM9At32BLHLQfkqnAqGuYNeeCKP6Ku', 'so 1', '983567927', 2, 'JbKpWym9Gug5xo7NUoAS95EC9pMSQ0dRyifmXjud1EAmCtiTAP3EsahVI8Qq', 1, '2020-11-30 17:12:57'),
(13, 'nani@gmail.com', 'Nguyen Van Dung', 'upload/admin/Screenshot from 2020-11-30 08-38-14.png', '$2y$10$.FopQA2ieGlFnUCU2eLMje71flxIhuzU05Lfi.GRWpwZ6/FNS577a', 'so 1', '983567927', 1, NULL, 1, '2020-12-01 06:35:18'),
(14, 'dung.nv.soict1@gmail.com', 'LE VAN LINH', '/image/users/anonimus.png', '$2y$10$kvSI1Ykbg6NhkY0906s8k.89NJw7iN7.rgCJrQLnAZHnYLC0B0QFa', 'Hà Nội, Thanh Hóa', '983567927', 2, NULL, 1, '2020-12-19 15:59:48'),
(15, 'dung.nv.soict2@gmail.com', 'LE VAN LINH', 'upload/admin/Screenshot from 2020-12-16 19-26-42.png', '$2y$10$RdXA4RsbORiWRqrtVGCcBO3Zc.gBtc6P7FjM4e7KXPdeqayd5psny', 'Hà Nội', '983567927', 1, NULL, 1, '2020-12-20 03:02:57');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
