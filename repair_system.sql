-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 07:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `per_id` int(5) NOT NULL COMMENT 'รหัสข้อมูลส่วนตัว',
  `user_id` int(5) NOT NULL COMMENT 'เลขรหัส user',
  `t_id` int(5) NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
  `f_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อจริง',
  `l_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'นามสกุล',
  `status_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `tel_num` varchar(15) NOT NULL COMMENT 'เบอร์โทรศัพท์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`per_id`, `user_id`, `t_id`, `f_name`, `l_name`, `status_id`, `tel_num`) VALUES
(1, 1, 2, 'ธนัท', 'sad', 2, '123456'),
(2, 2, 1, 'user', 'user', 2, '1234'),
(3, 3, 1, 'admin', '1234', 2, '095');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL COMMENT 'รหัสอุปกรณ์',
  `pt_id` int(5) NOT NULL COMMENT 'รหัสไอดีจากตาราง pt',
  `product_img` varchar(100) NOT NULL COMMENT 'รูปอุปกรณ์',
  `product_qty` varchar(10) NOT NULL COMMENT 'จำนวนอุปกรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `pt_id`, `product_img`, `product_qty`) VALUES
(1, 1, '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `pt_id` int(5) NOT NULL COMMENT 'เลขรหัส pt',
  `p_name` varchar(20) NOT NULL COMMENT 'ชื่ออุปกรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`pt_id`, `p_name`) VALUES
(1, 'โทรศัพท์');

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `repair_id` int(5) NOT NULL COMMENT 'รหัสการแจ้งซ่อม',
  `user_id` int(5) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `user` varchar(50) NOT NULL COMMENT 'ชื่อ user',
  `product_id` int(5) NOT NULL COMMENT 'รหัสอุปกรณ์',
  `pt_id` int(5) NOT NULL COMMENT 'รหัสไอดีจากตาราง pt',
  `repair_status_id` int(5) NOT NULL DEFAULT 1 COMMENT 'id จากตาราง status',
  `repair_detail` varchar(100) NOT NULL COMMENT 'อาการชำรุด',
  `repair_img` varchar(100) NOT NULL COMMENT 'รูปของเสีย',
  `repair_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่รับซ่อม',
  `review_grade` varchar(20) NOT NULL COMMENT 'คะแนนรีวิว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair`
--

INSERT INTO `repair` (`repair_id`, `user_id`, `user`, `product_id`, `pt_id`, `repair_status_id`, `repair_detail`, `repair_img`, `repair_date`, `review_grade`) VALUES
(1, 0, 'admin', 1, 1, 1, '', '', '2024-05-12 14:26:07', ''),
(2, 0, 'user', 1, 1, 1, '0\r\n\r\n', '', '2024-05-12 14:26:17', ''),
(3, 2, 'user', 1, 1, 1, 'พังอะดิ', 'pb_5.png', '2024-05-12 15:43:40', ''),
(4, 2, 'donut', 1, 1, 1, '00', '', '2024-05-12 15:44:39', ''),
(5, 2, 'user', 1, 1, 1, 'พัง จอแตก', 'pb_6.png', '2024-05-12 15:51:05', ''),
(6, 2, 'user', 1, 1, 1, 'พัง', 'pb_7.png', '2024-05-12 16:29:56', ''),
(7, 2, 'donut', 1, 1, 1, 'dasdasd', 'pb_8.png', '2024-05-13 05:02:33', ''),
(8, 2, 'donut', 1, 1, 1, 'dasda', 'pb_9.png', '2024-05-13 05:05:25', ''),
(9, 2, 'donut', 1, 1, 1, 'dsadasd', '', '2024-05-13 05:08:04', ''),
(10, 0, 'admin', 1, 1, 2, 'kkkkkkkkkkkkkk', 'pb_10.png', '2024-10-21 16:07:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `repair_status`
--

CREATE TABLE `repair_status` (
  `repair_status_id` int(5) NOT NULL,
  `repair_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'สถานะการซ่อม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_status`
--

INSERT INTO `repair_status` (`repair_status_id`, `repair_status`) VALUES
(1, 'กำลังดำเนินการ'),
(2, 'ส่งซ่อม'),
(3, 'ดำเนินการเสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `status_id` int(5) NOT NULL COMMENT 'รหัสสถานะ',
  `s_name` varchar(20) NOT NULL COMMENT 'นร หรือ อ.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`status_id`, `s_name`) VALUES
(1, 'นักศึกษา'),
(2, 'อาจารย์');

-- --------------------------------------------------------

--
-- Table structure for table `title_name`
--

CREATE TABLE `title_name` (
  `t_id` int(5) NOT NULL COMMENT 'รหัสคำนำหน้าชื่อ',
  `t_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'คำนำหน้าชื่อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title_name`
--

INSERT INTO `title_name` (`t_id`, `t_name`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'นางสาว'),
(4, 'ศาสตราจารย์'),
(5, 'รองศาสตราจารย์');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL COMMENT 'เลขรหัส user',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'username',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'password',
  `role` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user' COMMENT 'สิทธิ์การใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'user', '$2y$10$qpQ2aolJ4lLF7TTtp0ciLeTZJneiaANBjQEkJH1v0i4OnBFFXoCHe', 'admin'),
(2, 'donut', '$2y$10$.VdWMMGCxpkgd8LthM6z3.64CnYD18nNf/96vJDRVTaFBT1yo7hau', 'user'),
(3, 'admin', '$2y$10$69stJU3GXvc2J.h/ksvVpOADDXO3LgWayeef6/xSM78BWHctoV/3O', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `repair_status`
--
ALTER TABLE `repair_status`
  ADD PRIMARY KEY (`repair_status_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `title_name`
--
ALTER TABLE `title_name`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `per_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข้อมูลส่วนตัว', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสอุปกรณ์', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `pt_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'เลขรหัส pt', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `repair_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการแจ้งซ่อม', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `repair_status`
--
ALTER TABLE `repair_status`
  MODIFY `repair_status_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `status_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสถานะ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `title_name`
--
ALTER TABLE `title_name`
  MODIFY `t_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคำนำหน้าชื่อ', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'เลขรหัส user', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
