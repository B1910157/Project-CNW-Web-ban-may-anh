-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 31, 2022 lúc 05:35 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ct275_duannhom`
--
CREATE DATABASE ct275_update;
USE ct275_update;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`cart_id`, `product_id`, `quantity`) VALUES
(1, 1, 1),
(1, 3, 7),
(1, 4, 13),
(18, 1, 2),
(18, 3, 1),
(18, 4, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_day` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`cart_id`, `user_id`, `added_day`, `updated_day`) VALUES
(1, 5, '2022-10-27 03:05:12', '2022-10-27 03:05:12'),
(2, 7, '2022-10-28 17:45:10', '2022-10-28 17:45:10'),
(18, 7, '2022-10-28 18:14:29', '2022-10-28 18:14:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `admin`, `fullname`, `username`, `password`, `created_day`, `updated_day`) VALUES
(2, 0, 'Nguyen Thi B', '12345678', '12345678', '2022-10-25 19:04:14', '2022-10-25 19:04:14'),
(3, 0, 'Tran Van B', 'B1910146', '12345678', '2022-10-26 00:17:47', '2022-10-26 00:17:47'),
(4, 0, 'Nguyen Van C', 'b1910146', '12345678', '2022-10-26 00:19:18', '2022-10-26 00:19:18'),
(5, 1, 'Trần Văn Thiệt', 'THIETB1910146', 'Fr0g19o3', '2022-10-26 04:55:11', '2022-10-26 04:55:11'),
(6, 0, 'Tran Van B', 'B1910146', '12345678', '2022-10-26 06:08:30', '2022-10-26 06:08:30'),
(7, 0, 'Trần Văn Thiệt', 'B1910146', 'Fr0g19o3', '2022-10-27 07:46:17', '2022-10-27 07:46:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `description`, `category_name`, `image`, `created_day`, `updated_day`) VALUES
(1, 'Sản Phẩm A', 5000000, 'Hello', '1', 'banks.png', '2022-10-25 15:23:51', '2022-10-31 03:35:49'),
(3, '134', 5000000, 'abc', '1', 'logo1.png', '2022-10-25 15:41:31', '2022-10-25 15:41:31'),
(4, 'ds', 5000000, 'ds', '0', 'logo1.png', '2022-10-25 15:42:16', '2022-10-25 15:42:16');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `sanpham` (`id`),
  ADD CONSTRAINT `chitietgiohang_ibfk_3` FOREIGN KEY (`cart_id`) REFERENCES `giohang` (`cart_id`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `nguoidung` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
