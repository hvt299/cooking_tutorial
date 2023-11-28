-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 04:58 PM
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
-- Table structure for table `hocvien`
--

CREATE TABLE `hocvien` (
  `IDHV` int(11) NOT NULL,
  `TenHV` varchar(255) NOT NULL,
  `GioiTinh` varchar(255) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `QueQuan` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `SDT` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocvien`
--

INSERT INTO `hocvien` (`IDHV`, `TenHV`, `GioiTinh`, `NgaySinh`, `QueQuan`, `Email`, `SDT`) VALUES
(1, 'Nguyễn Văn A', NULL, NULL, NULL, 'nguyenvana@gmail.com', NULL);

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
(2, 'Học nấu ăn gia đình', '#'),
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
  `VaiTro` varchar(255) NOT NULL DEFAULT 'Học viên',
  `MatKhauUngDung` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`Email`, `Name`, `Password`, `VaiTro`, `MatKhauUngDung`) VALUES
('nguyenvana@gmail.com', 'Nguyễn Văn A', '123', 'Học viên', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hocvien`
--
ALTER TABLE `hocvien`
  ADD PRIMARY KEY (`IDHV`),
  ADD KEY `FK_taikhoan_hocvien_email` (`Email`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hocvien`
--
ALTER TABLE `hocvien`
  MODIFY `IDHV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `IDMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hocvien`
--
ALTER TABLE `hocvien`
  ADD CONSTRAINT `FK_taikhoan_hocvien_email` FOREIGN KEY (`Email`) REFERENCES `taikhoan` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
