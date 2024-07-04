-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 07:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project_vaccine`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`level_id`, `level_name`) VALUES
(1, 'เจ้าหน้าที่ทั่วไป'),
(2, 'ผู้อำนวยการ'),
(3, 'ผู้ดูแลระบบ (ADMIN)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `room_id` int(11) NOT NULL COMMENT 'รหัสห้อง ',
  `room_name` varchar(100) NOT NULL COMMENT 'ชื่อห้อง',
  `room_detail` text NOT NULL COMMENT 'รายละเอียด',
  `room_status` int(11) NOT NULL COMMENT 'สถานะห้อง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`room_id`, `room_name`, `room_detail`, `room_status`) VALUES
(1, 'ห้อง 1001', 'ห้องสำหรับเด็ก อายุ 1-2ขวบ', 1),
(2, 'ห้อง 1002', 'ห้องสำหรับเด็ก อายุ 2-3ขวบ', 1),
(4, 'ห้อง 1003', 'ห้องสำหรับเด็ก อายุ 3-4ขวบ', 1),
(6, 'ห้อง 1004', 'ห้อง 1004ห้อง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `level_id` int(11) NOT NULL COMMENT 'ระดับผู้ใช้งาน',
  `staff_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `staff_lastname` varchar(100) NOT NULL COMMENT 'สกุล',
  `staff_username` varchar(100) NOT NULL COMMENT 'Username',
  `staff_password` varchar(100) NOT NULL COMMENT 'Password',
  `staff_status` int(11) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `level_id`, `staff_name`, `staff_lastname`, `staff_username`, `staff_password`, `staff_status`) VALUES
(1, 1, 'สมศรี', 'อำนวยสุข', 'staff01', 'staff01', 1),
(2, 1, 'สมชาย', 'ร่าเริง', 'staff02', 'staff02', 1),
(3, 2, 'มั่นคง', 'ชาญฉลาด', 'Supper01', 'Supper01', 1),
(4, 3, 'admin0001', 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL COMMENT 'รหัสเด็ก',
  `room_id` int(11) NOT NULL COMMENT 'รหัสห้อง',
  `student_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `student_last` varchar(100) NOT NULL COMMENT 'สกุล',
  `student_nickname` varchar(100) NOT NULL COMMENT 'ชื่อเล่น',
  `student_bd` date NOT NULL COMMENT 'วันเดือนปีเกิด',
  `student_img` varchar(100) NOT NULL COMMENT 'รูปเด็ก',
  `student_status` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `room_id`, `student_name`, `student_last`, `student_nickname`, `student_bd`, `student_img`, `student_status`) VALUES
(1, 3, '999', '999', '9999', '2024-06-18', 'student_img_20240627114003.WebP', 1),
(7, 3, '5', '5', '5', '2024-06-25', 'student_img_20240627114318.WebP', 1),
(8, 3, 'สุชาติชาติชาติ', 'แซ่เฮ้ง', 'ชาติชาติชาติ', '2024-06-27', 'student_img_20240627114306.WebP', 1),
(9, 3, 'สุชาติชาติชาติ', 'แซ่เฮ้ง', 'ชาติชาติชาติ', '2024-06-27', 'student_img_20240627111211.WebP', 1),
(10, 3, 'ddd', 'ff', 'sfsdf', '2024-06-25', 'student_img_20240627111409.WebP', 1),
(11, 3, 'dsfsdf', 'sdfdsf', 'dsfdsf', '2024-06-15', 'student_img_20240627111425.WebP', 1),
(13, 2, 'สมใจ', 'สุขสุด', 'โบ', '2022-06-25', 'student_img_20240704113748.WebP', 1),
(15, 2, 'อำนวย', 'รักสะอาด', 'เอ', '2024-06-01', 'student_img_20240704113732.WebP', 1),
(16, 4, 'สุชาติชาติชาติ', 'แซ่เฮ้ง', 'ชาติ', '2023-07-03', 'student_img_20240704113723.WebP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccine`
--

CREATE TABLE `tbl_vaccine` (
  `vaccine_id` int(11) NOT NULL COMMENT 'รหัสวัคซีน',
  `vaccine_no` varchar(100) NOT NULL COMMENT 'หมายเลขวัคซีน',
  `vaccine_name` varchar(100) NOT NULL COMMENT 'ชื่อวัคซีน',
  `vaccine_detail` text NOT NULL COMMENT 'รายละเอียด',
  `vaccine_age_start` double(64,1) NOT NULL COMMENT 'ช่วงอายุเริ่มต้น',
  `vaccine_age_end` double(64,1) NOT NULL COMMENT 'ช่วงอายุสิ้นสุด',
  `vaccine_status` int(11) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccine`
--

INSERT INTO `tbl_vaccine` (`vaccine_id`, `vaccine_no`, `vaccine_name`, `vaccine_detail`, `vaccine_age_start`, `vaccine_age_end`, `vaccine_status`) VALUES
(1, 'TR000011SDS112220', 'ป้องกันไข้เลือดออก', 'ไข้เลือดออกไข้เลือดออกไข้เลือดออก', 1.0, 2.0, 1),
(2, 'TR00099999SD2220', 'ป้องกันไข้เลือดออก 2', 'ไข้เลือดออกไข้เลือดออกไข้เลือดออก', 2.0, 3.0, 1),
(3, 'BCG0001', ' บีซีจี (BCG), ตับอักเสบบี (HB1)', ' แรกเกิด	', 0.1, 0.1, 1),
(4, 'HB2', ' ตับอักเสบบี (HB2) เฉพาะรายที่เกิดจากมารดาที่เป็นพาหะของไวรัสตับอักเสบบี', ' 1 เดือน	', 0.1, 0.1, 1),
(5, 'DTP-HB1 + OPV1', ' คอตีบ-บาดทะยัก-ไอกรน-ตับอักเสบบี (DTP-HB1)*, โปลิโอชนิดหยอด (OPV1)', ' 2 เดือน	', 0.2, 0.2, 1),
(6, 'DTP4 + OPV4', ' คอตีบ-บาดทะยัก-ไอกรน (DTP4), โปลิโอชนิดหยอด (OPV4)', ' 1 ปี 6 เดือน	', 1.6, 1.6, 1),
(7, 'MMR1', 'หัด-คางทูม-หัดเยอรมัน (MMR1)', ' 9-12 เดือน	', 0.9, 1.0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccine_data`
--

CREATE TABLE `tbl_vaccine_data` (
  `vaccine_data_id` int(11) NOT NULL COMMENT 'รหัสข้อมูลการฉีด',
  `student_id` int(11) NOT NULL COMMENT 'รหัสเด็ก',
  `staff_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้ง﻿าน',
  `vaccine_id` int(11) NOT NULL COMMENT 'รหัสวัคซีน',
  `vaccine_data_quantity` int(11) NOT NULL COMMENT 'จำนวนเข็ม',
  `vaccine_data_date` date NOT NULL COMMENT 'วันที่ฉีด',
  `vaccine_data_date_next` date NOT NULL COMMENT 'วันที่ฉีดวัคซีนครั้งต่อไป',
  `vaccine_data_note` text NOT NULL COMMENT 'หมายเหตุ',
  `vaccine_data_status` int(11) NOT NULL COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vaccine_data`
--

INSERT INTO `tbl_vaccine_data` (`vaccine_data_id`, `student_id`, `staff_id`, `vaccine_id`, `vaccine_data_quantity`, `vaccine_data_date`, `vaccine_data_date_next`, `vaccine_data_note`, `vaccine_data_status`) VALUES
(1, 1, 1, 1, 2, '2024-07-01', '2024-07-31', 'Test', 1),
(5, 15, 1, 1, 2, '2024-07-03', '2024-07-06', 'dfdfdf', 1),
(6, 15, 1, 2, 5, '2024-07-03', '2024-07-18', '', 1),
(7, 16, 1, 6, 1, '2024-07-03', '2024-07-09', '', 1),
(8, 16, 1, 3, 1, '2024-07-03', '2024-07-12', '', 1),
(9, 15, 1, 7, 1, '2024-07-03', '2024-07-06', '10', 1),
(10, 16, 1, 7, 2, '2024-07-04', '2024-07-05', 'dfdfdf', 1),
(11, 16, 1, 6, 1, '2024-07-04', '2024-07-31', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_vaccine`
--
ALTER TABLE `tbl_vaccine`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- Indexes for table `tbl_vaccine_data`
--
ALTER TABLE `tbl_vaccine_data`
  ADD PRIMARY KEY (`vaccine_data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสห้อง ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งาน', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเด็ก', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_vaccine`
--
ALTER TABLE `tbl_vaccine`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสวัคซีน', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_vaccine_data`
--
ALTER TABLE `tbl_vaccine_data`
  MODIFY `vaccine_data_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข้อมูลการฉีด', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
