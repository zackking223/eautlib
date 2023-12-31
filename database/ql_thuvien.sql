-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 11:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_thuvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `MAADMIN` int(11) NOT NULL,
  `MATKHAU` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `ROLE` varchar(30) COLLATE utf32_unicode_ci NOT NULL COMMENT 'QUAN_TRI || THU_THU',
  `USERNAME` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bandoc`
--

CREATE TABLE `bandoc` (
  `MABANDOC` int(11) NOT NULL,
  `HOTEN` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYSINH` date NOT NULL,
  `DIACHI` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `SDT` int(10) NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `MASACH` int(11) NOT NULL,
  `MATHELOAI` int(11) NOT NULL,
  `MATACGIA` int(11) NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `VITRI` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `TOMTAT` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `ANHSACH` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp(),
  `NGAYCAPNHAT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach_themuontra`
--

CREATE TABLE `sach_themuontra` (
  `MASACH` int(11) NOT NULL,
  `MATHEMUON` int(11) NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `MATACGIA` int(11) NOT NULL,
  `BUTDANH` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `MATHELOAI` int(11) NOT NULL,
  `TEN` varchar(50) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themuontra`
--

CREATE TABLE `themuontra` (
  `MATHEMUON` int(11) NOT NULL,
  `MABANDOC` int(11) NOT NULL,
  `MAADMIN` int(11) NOT NULL,
  `NGAYMUON` date NOT NULL DEFAULT current_timestamp(),
  `NGAYTRA` date NOT NULL DEFAULT current_timestamp(),
  `TINHTRANG` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYCAPNHAT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vipham`
--

CREATE TABLE `vipham` (
  `MAVIPHAM` int(11) NOT NULL,
  `MABANDOC` int(11) NOT NULL,
  `MAADMIN` int(11) NOT NULL,
  `NOIDUNG` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MAADMIN`);

--
-- Indexes for table `bandoc`
--
ALTER TABLE `bandoc`
  ADD PRIMARY KEY (`MABANDOC`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`MASACH`),
  ADD KEY `SACH_THELOAI` (`MATHELOAI`),
  ADD KEY `SACH_TACGIA` (`MATACGIA`);

--
-- Indexes for table `sach_themuontra`
--
ALTER TABLE `sach_themuontra`
  ADD KEY `SACH_THEMUONTRA` (`MASACH`,`MATHEMUON`),
  ADD KEY `MATHEMUONTRA` (`MATHEMUON`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`MATACGIA`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`MATHELOAI`);

--
-- Indexes for table `themuontra`
--
ALTER TABLE `themuontra`
  ADD PRIMARY KEY (`MATHEMUON`),
  ADD KEY `THEMUONTRA_BANDOC` (`MABANDOC`),
  ADD KEY `THEMUONTRA_ADMIN` (`MAADMIN`);

--
-- Indexes for table `vipham`
--
ALTER TABLE `vipham`
  ADD PRIMARY KEY (`MAVIPHAM`),
  ADD KEY `VIPHAM_ADMIN` (`MAADMIN`),
  ADD KEY `VIPHAM_BANDOC` (`MABANDOC`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `MAADMIN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bandoc`
--
ALTER TABLE `bandoc`
  MODIFY `MABANDOC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `MASACH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `MATACGIA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `MATHELOAI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themuontra`
--
ALTER TABLE `themuontra`
  MODIFY `MATHEMUON` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vipham`
--
ALTER TABLE `vipham`
  MODIFY `MAVIPHAM` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MATHELOAI`) REFERENCES `theloai` (`MATHELOAI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sach_ibfk_2` FOREIGN KEY (`MATACGIA`) REFERENCES `tacgia` (`MATACGIA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sach_themuontra`
--
ALTER TABLE `sach_themuontra`
  ADD CONSTRAINT `sach_themuontra_ibfk_1` FOREIGN KEY (`MASACH`) REFERENCES `sach` (`MASACH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sach_themuontra_ibfk_2` FOREIGN KEY (`MATHEMUON`) REFERENCES `themuontra` (`MATHEMUON`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `themuontra`
--
ALTER TABLE `themuontra`
  ADD CONSTRAINT `themuontra_ibfk_1` FOREIGN KEY (`MAADMIN`) REFERENCES `admin` (`MAADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `themuontra_ibfk_2` FOREIGN KEY (`MABANDOC`) REFERENCES `bandoc` (`MABANDOC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vipham`
--
ALTER TABLE `vipham`
  ADD CONSTRAINT `vipham_ibfk_1` FOREIGN KEY (`MAADMIN`) REFERENCES `admin` (`MAADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vipham_ibfk_2` FOREIGN KEY (`MABANDOC`) REFERENCES `bandoc` (`MABANDOC`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
