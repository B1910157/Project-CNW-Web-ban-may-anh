-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 07, 2022 lúc 09:35 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ct275_update`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Máy ảnh Leica'),
(2, 'Máy ảnh fujifilm'),
(3, 'Flycam'),
(4, 'Camera hành trình GoPro'),
(5, 'Máy Ảnh Hasselblad');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `total_price` int(255) NOT NULL,
  `status` int(1) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`order_id`, `user_id`, `cart_id`, `total_price`, `status`, `created_day`) VALUES
(2, 10, 21, 191300000, 1, '2022-11-05 12:56:07'),
(3, 10, 22, 7100000, 0, '2022-11-05 13:06:42');

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
(20, 8, '2022-11-05 12:53:24', '2022-11-05 12:53:24');

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
  `diachi` varchar(255) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `admin`, `fullname`, `username`, `password`, `diachi`, `created_day`, `updated_day`) VALUES
(2, 0, 'Nguyen Thi B', '12345678', '12345678', '', '2022-10-25 19:04:14', '2022-10-25 19:04:14'),
(3, 0, 'Tran Van B', 'B1910146', '12345678', '', '2022-10-26 00:17:47', '2022-10-26 00:17:47'),
(4, 0, 'Nguyen Van C', 'b1910146', '12345678', '', '2022-10-26 00:19:18', '2022-10-26 00:19:18'),
(5, 1, 'Trần Văn Thiệt', 'THIETB1910146', 'Fr0g19o3', '', '2022-10-26 04:55:11', '2022-10-26 04:55:11'),
(6, 0, 'Tran Van B', 'B1910146', '12345678', '', '2022-10-26 06:08:30', '2022-10-26 06:08:30'),
(7, 0, 'Trần Văn Thiệt', 'B1910146', 'Fr0g19o3', '', '2022-10-27 07:46:17', '2022-10-27 07:46:17'),
(8, 1, 'tintin', 'tin', '123456', '', '2022-11-03 18:08:43', '2022-11-03 18:08:43'),
(9, 0, 'ádasdas', 'ádasdsad', '123456', 'long hồ dồng nai bắn cạn', '2022-11-04 13:12:57', '2022-11-04 13:12:57'),
(10, 0, 'Nguyễn Thị Kim Chi', 'chi chi', '123456', 'Cần thơ', '2022-11-04 13:13:18', '2022-11-04 13:13:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_day` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_day` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `description`, `category_id`, `image`, `created_day`, `updated_day`) VALUES
(1, 'Leica Summicron 50mm f/2 Edition Safari', 200000, 'TecHLand chuyên cung cấp các sản phẩm ống kính máy ảnh Leica Leica Summicron 50mm f/2 Edition Safari chính hãng giá rẻ tại Cần thơ', 1, 'leica1.PNG', '2022-10-25 15:23:51', '2022-11-05 11:59:14'),
(3, 'Leica M10-P Safari Edition Mới', 180000000, 'TecHLand chuyên cung cấp các sản phẩm Máy ảnh leica M10-P Safari edition chính hãng giá rẻ tại Cần thơ', 1, 'leica.PNG', '2022-10-25 15:41:31', '2022-11-05 12:52:59'),
(11, 'Fujifilm Instax Mini 8 Phiên Bản Minion', 2100000, 'TecHland nhà phân phối các sản phẩm Máy Ảnh Chụp Lấy Ngay Fujifilm Instax Mini 8 Phiên Bản Minion chính hãng giá rẻ tại Cần thơ', 2, 'fuji1.PNG', '2022-11-04 03:56:02', '2022-11-05 12:02:29'),
(15, 'Máy Ảnh Fujifilm X-A5 Kit 15-45 mm', 13800000, 'TecHland – nhà phân phối chính thức các sản phẩm Máy Ảnh Fujifilm X-A5 chính hãng giá rẻ tại Cần thơ', 2, 'fuji2.PNG', '2022-11-04 05:18:23', '2022-11-05 12:03:45'),
(16, 'Flycam DJI Mavic Air Chất lượng cao', 15500000, 'TecHland chuyên cung cấp các sản phẩm máy bay điều khiển Flycam DJI Mavic Air chính hãng giá rẻ tại Cần thơ', 3, 'flycam1.PNG', '2022-11-04 12:36:59', '2022-11-05 12:51:11'),
(17, 'Máy Ảnh Hasselblad X1D-50c Body', 29000000, 'TecHland chuyên cung cấp sản phẩm Máy Ảnh Hasselblad X1D-50c Body chính hãng với giá rẻ tại Cần thơ', 5, 'has1.PNG', '2022-11-05 12:07:55', '2022-11-05 12:08:22'),
(18, 'Máy Quay Camera Hành Trình GoPro Hero 8', 7100000, 'Quay video 4K UHD & slow motion\r\n•  Ổn định videoHyperSmooth 2.0\r\n•  Ổn định cho video time-lapse TimeWarp 2.0\r\n•  Chụp ảnh SuperPhoto 12MP hỗ trợ HDR', 4, 'cam1.PNG', '2022-11-05 12:10:26', '2022-11-05 12:10:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
