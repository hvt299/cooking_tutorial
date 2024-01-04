-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 10:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookingtutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `IDDG` int(11) NOT NULL,
  `IDKhach` int(11) NOT NULL,
  `IDKH` int(11) NOT NULL,
  `NoiDungDG` text NOT NULL,
  `SaoDG` tinyint(5) NOT NULL DEFAULT 1,
  `NgayDG` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`IDDG`, `IDKhach`, `IDKH`, `NoiDungDG`, `SaoDG`, `NgayDG`) VALUES
(1, 2, 2, 'OK', 1, '2024-01-05 00:59:00'),
(2, 2, 4, '!OK', 2, '2024-01-05 01:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `IDHD` int(11) NOT NULL,
  `IDKhach` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `TinhTrang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `IDKhach` int(11) NOT NULL,
  `TenKhach` varchar(255) NOT NULL,
  `GioiTinh` varchar(255) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `QueQuan` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `SDT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`IDKhach`, `TenKhach`, `GioiTinh`, `NgaySinh`, `QueQuan`, `Email`, `SDT`) VALUES
(1, 'Abc', 'Nam', NULL, NULL, 'abc@gmail.com', NULL),
(2, 'Hứa Thái', '', '0000-00-00', '', 'huavietthai299@gmail.com', 0),
(3, 'Phong', '', '0000-00-00', '', 'phongnguyen@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `khoahoc`
--

CREATE TABLE `khoahoc` (
  `IDKH` int(11) NOT NULL,
  `TenKH` varchar(255) NOT NULL,
  `TacGiaKH` varchar(255) NOT NULL,
  `MoTaKH` text NOT NULL,
  `GiaGocKH` int(11) NOT NULL,
  `GiaHienTaiKH` int(11) NOT NULL,
  `HinhAnhKH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoahoc`
--

INSERT INTO `khoahoc` (`IDKH`, `TenKH`, `TacGiaKH`, `MoTaKH`, `GiaGocKH`, `GiaHienTaiKH`, `HinhAnhKH`) VALUES
(1, 'Bữa Sáng Thông Minh', 'Abc', 'Khóa học cung cấp công thức chế biến món ăn sáng ngon, phương pháp nấu tiết kiệm thời gian nhưng đảm bảo dinh dưỡng.', 1200000, 999000, 'https://daubepgiadinh.vn/wp-content/uploads/2020/12/dien-tam-hong-kong-khoa-hoc-nau-an-gia-dinh.jpg'),
(2, 'Hôm Nay Ăn Gì', 'Abc', 'Khóa học giúp bạn có thể biến nguyên liệu quen thuộc thành món ăn thơm ngon, lạ miệng, làm phong phú thực đơn.', 1800000, 1350000, 'https://daubepgiadinh.vn/wp-content/uploads/2020/12/khoa-hoc-hom-nay-an-gi-khoa-hoc-nau-an-gia-dinh-online.jpg'),
(3, 'Món Ngon Cuối Tuần', 'Abc', 'Học phương pháp, bí quyết chế biến món ngon để tự thưởng cho bản thân hoặc chiêu đãi bạn bè, người thân dịp cuối tuần.', 1200000, 999000, 'https://daubepgiadinh.vn/wp-content/uploads/2020/12/khoa-hoc-mon-ngon-cuoi-tuan-hoc-nau-an-gia-dinh-tphcm.jpg'),
(4, 'Món Ngon 3 Miền', 'Abc', 'Tham gia lớp học, bạn sẽ tích lũy được kiến thức, kỹ năng nấu nhiều món ăn hấp dẫn từ Chuyên gia.', 2000000, 1800000, 'https://daubepgiadinh.vn/wp-content/uploads/2020/12/khoa-hoc-nau-an-gia-dinh-don-gian-gia-re.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `IDMenu` int(11) NOT NULL,
  `TenMenu` varchar(255) NOT NULL,
  `URLMenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`IDMenu`, `TenMenu`, `URLMenu`) VALUES
(1, 'Trang chủ', 'index.php'),
(2, 'Học nấu ăn gia đình', 'course_list.php'),
(3, 'Món ngon mỗi ngày', '#'),
(4, 'Giới thiệu', 'about.php'),
(5, 'Liên hệ', 'contact.php');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `VaiTro` varchar(255) NOT NULL DEFAULT 'Khách',
  `MatKhauUngDung` varchar(20) DEFAULT NULL,
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`Email`, `Name`, `Password`, `VaiTro`, `MatKhauUngDung`, `NgayTao`) VALUES
('abc@gmail.com', 'Abc', '123', 'Khách hàng', NULL, '2023-12-29 21:37:54'),
('admin@ct.com', 'Admin', 'admin', 'Quản lý', '', '2023-12-29 23:29:27'),
('huavietthai299@gmail.com', 'Hứa Thái', '123321', 'Khách hàng', '', '2023-12-29 23:20:11'),
('phongnguyen@gmail.com', 'Phong', 'phong', 'Khách hàng', '', '2023-12-29 23:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `tiendo`
--

CREATE TABLE `tiendo` (
  `IDTD` int(11) NOT NULL,
  `IDKhach` int(11) NOT NULL,
  `IDKH` int(11) NOT NULL,
  `NgayBatDau` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`IDDG`),
  ADD KEY `FK_danhgia_khoahoc_IDKH` (`IDKH`),
  ADD KEY `FK_danhgia_khachhang_IDKhach` (`IDKhach`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`IDHD`),
  ADD KEY `FK_hoadon_khachhang_IDKhach` (`IDKhach`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`IDKhach`),
  ADD KEY `FK_taikhoan_khachhang_email` (`Email`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`IDKH`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IDMenu`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `tiendo`
--
ALTER TABLE `tiendo`
  ADD PRIMARY KEY (`IDTD`),
  ADD KEY `FK_tiendo_khoahoc_IDKH` (`IDKH`),
  ADD KEY `FK_tiendo_khachhang_IDKhach` (`IDKhach`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `IDDG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `IDHD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `IDKhach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `khoahoc`
--
ALTER TABLE `khoahoc`
  MODIFY `IDKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `IDMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tiendo`
--
ALTER TABLE `tiendo`
  MODIFY `IDTD` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `FK_danhgia_khachhang_IDKhach` FOREIGN KEY (`IDKhach`) REFERENCES `khachhang` (`IDKhach`),
  ADD CONSTRAINT `FK_danhgia_khoahoc_IDKH` FOREIGN KEY (`IDKH`) REFERENCES `khoahoc` (`IDKH`);

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `FK_hoadon_khachhang_IDKhach` FOREIGN KEY (`IDKhach`) REFERENCES `khachhang` (`IDKhach`);

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `FK_taikhoan_khachhang_email` FOREIGN KEY (`Email`) REFERENCES `taikhoan` (`Email`);

--
-- Constraints for table `tiendo`
--
ALTER TABLE `tiendo`
  ADD CONSTRAINT `FK_tiendo_khachhang_IDKhach` FOREIGN KEY (`IDKhach`) REFERENCES `khachhang` (`IDKhach`),
  ADD CONSTRAINT `FK_tiendo_khoahoc_IDKH` FOREIGN KEY (`IDKH`) REFERENCES `khoahoc` (`IDKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
