-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2023 at 05:15 PM
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
  `ROLE` varchar(30) COLLATE utf32_unicode_ci NOT NULL DEFAULT 'THU_THU',
  `USERNAME` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`MAADMIN`, `MATKHAU`, `ROLE`, `USERNAME`, `NGAYTHEM`) VALUES
(1, '$argon2id$v=19$m=65536,t=4,p=1$Ri5OWTRTdzdSRXR5d3VSZg$y+Yyc9VrKKA2cMccr3x6ByS7BGQ/axB7q3FAXoHDGZY', 'QUAN_TRI', 'Admin123', '2023-12-28'),
(2, '$argon2id$v=19$m=65536,t=4,p=1$Ri5OWTRTdzdSRXR5d3VSZg$y+Yyc9VrKKA2cMccr3x6ByS7BGQ/axB7q3FAXoHDGZY', 'THU_THU', 'TuanMinh', '2023-12-29'),
(3, '$argon2id$v=19$m=65536,t=4,p=1$Ri5OWTRTdzdSRXR5d3VSZg$y+Yyc9VrKKA2cMccr3x6ByS7BGQ/axB7q3FAXoHDGZY', 'THU_THU', 'VanThi', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `bandoc`
--

CREATE TABLE `bandoc` (
  `MABANDOC` int(11) NOT NULL,
  `HOTEN` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYSINH` date NOT NULL,
  `DIACHI` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `SDT` varchar(10) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `bandoc`
--

INSERT INTO `bandoc` (`MABANDOC`, `HOTEN`, `NGAYSINH`, `DIACHI`, `SDT`, `NGAYTHEM`) VALUES
(1, 'Nguyễn Văn Bộ', '2003-05-23', 'Việt Nam, Vĩnh Phúc', '0915711868', '2023-12-29'),
(2, 'Vương Minh Quân', '2003-06-12', 'Đống Đa, Hà Nội', '0813344815', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `MASACH` int(11) NOT NULL,
  `MATHELOAI` int(11) NOT NULL,
  `MATACGIA` int(11) NOT NULL,
  `TENSACH` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `VITRI` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `TOMTAT` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `ANHSACH` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp(),
  `NGAYCAPNHAT` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`MASACH`, `MATHELOAI`, `MATACGIA`, `TENSACH`, `SOLUONG`, `VITRI`, `TOMTAT`, `ANHSACH`, `NGAYTHEM`, `NGAYCAPNHAT`) VALUES
(1, 1, 2, 'Anh chàng hiệp sĩ gỗ', 98, 'Dãy truyện cổ tích', 'Ở thị trấn Bến Cam, mỗi năm cứ đến ngày gần Tết người ta lại thấy ông lão già ấy. Không ai biết quê quán ông lão ở đâu, họ tên ông lão là gì. Nhưng mỗi năm vào dịp Tết người ta lại thấy ông lão đẩy cái xe bánh gỗ lọc khọc đến, ăn mấy phiên chợ Tết...', '/public/uploads/GIwtQ5pP/anh-chang-hiep-si-go.jpg', '2023-12-28', '2023-12-29'),
(2, 1, 2, 'Làng', 99, 'Dãy A', 'Truyện kể về ông Hai rất yêu làng, yêu nước. Ông Hai phải đi tản cư nên ông rất nhớ làng và yêu làng, ông thường tự hào và khoe về làng Chợ Dầu giàu đẹp của mình, nhất là tinh thần kháng chiến và chính ông là một công dân tích cực.', '/public/uploads/4PkBtOFp/lang.jpg', '2023-12-28', '2023-12-29'),
(3, 3, 1, 'Chí Phèo', 10, 'Dãy A', 'Chí Phèo là cuốn sách của tác giả Nam Cao, mô tả hình ảnh thực tế đời sống nông thôn Việt Nam trước năm 1945, với sự thiếu vắng chất đầu tư, sự nghèo đói và tàn tệ trên con đường phá sản, bần cùng...', '/public/uploads/4PJQdChi/chipheo.jpg', '2023-12-29', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `sach_themuontra`
--

CREATE TABLE `sach_themuontra` (
  `MASACH` int(11) NOT NULL,
  `MATHEMUON` int(11) NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `sach_themuontra`
--

INSERT INTO `sach_themuontra` (`MASACH`, `MATHEMUON`, `NGAYTHEM`) VALUES
(1, 1, '2023-12-29'),
(2, 1, '2023-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `MATACGIA` int(11) NOT NULL,
  `BUTDANH` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`MATACGIA`, `BUTDANH`, `NGAYTHEM`) VALUES
(1, 'Tô Hoài', '2023-12-28'),
(2, 'Kim Lân', '2023-12-28'),
(4, 'Nguyễn Đình Thi', '2023-12-29'),
(5, 'Hàn Mạc Tử', '2023-12-29'),
(6, 'Nguyễn Đăng Khoa', '2023-12-29'),
(7, 'Nam Cao', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `MATHELOAI` int(11) NOT NULL,
  `TEN` varchar(50) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`MATHELOAI`, `TEN`) VALUES
(4, 'Cổ tích'),
(5, 'Dân gian'),
(1, 'Kinh dị'),
(8, 'Tiểu thuyết'),
(2, 'Tình cảm'),
(3, 'Truyện ngắn'),
(6, 'Truyện thơ');

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
  `NGAYCAPNHAT` date NOT NULL DEFAULT current_timestamp(),
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `themuontra`
--

INSERT INTO `themuontra` (`MATHEMUON`, `MABANDOC`, `MAADMIN`, `NGAYMUON`, `NGAYTRA`, `TINHTRANG`, `NGAYCAPNHAT`, `NGAYTHEM`) VALUES
(1, 1, 3, '2023-12-29', '2023-12-29', 'Chưa trả', '2023-12-31', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `vipham`
--

CREATE TABLE `vipham` (
  `MAVIPHAM` int(11) NOT NULL,
  `MABANDOC` int(11) NOT NULL,
  `MAADMIN` int(11) NOT NULL,
  `NOIDUNG` text COLLATE utf32_unicode_ci NOT NULL,
  `NGAYTHEM` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `vipham`
--

INSERT INTO `vipham` (`MAVIPHAM`, `MABANDOC`, `MAADMIN`, `NOIDUNG`, `NGAYTHEM`) VALUES
(1, 1, 2, 'Làm hỏng sách (mã 01)', '2023-12-29'),
(2, 1, 3, 'Làm mất sách (mã 01)', '2023-12-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MAADMIN`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

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
  ADD PRIMARY KEY (`MATHELOAI`),
  ADD UNIQUE KEY `TEN` (`TEN`);

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
  MODIFY `MAADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bandoc`
--
ALTER TABLE `bandoc`
  MODIFY `MABANDOC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `MASACH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `MATACGIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `theloai`
--
ALTER TABLE `theloai`
  MODIFY `MATHELOAI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `themuontra`
--
ALTER TABLE `themuontra`
  MODIFY `MATHEMUON` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vipham`
--
ALTER TABLE `vipham`
  MODIFY `MAVIPHAM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
