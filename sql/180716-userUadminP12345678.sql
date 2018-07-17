-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_school_ton.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT 'ชื่อเข้าสู่ระบบ',
  `password` varchar(255) DEFAULT NULL COMMENT 'รหัสผ่านเข้าระหัส mp5',
  `name` varchar(255) DEFAULT NULL COMMENT 'ชื่อจริง',
  `surname` varchar(255) DEFAULT NULL COMMENT 'นามสกุล',
  `id_card` varchar(255) NOT NULL COMMENT 'รหัสบัตรประจำตัวประชาชน',
  `birthday` date DEFAULT NULL COMMENT 'วันเกิด เก็บเป็น ค.ศ.',
  `address` text COMMENT 'ที่อยู่',
  `phone` varchar(255) DEFAULT NULL COMMENT 'เบอร์โทรที่ติดต่อได้',
  `img_path` varchar(255) DEFAULT NULL COMMENT 'พาทภาพ กรณีอัพภาพ',
  `gender` enum('m','f') DEFAULT 'f' COMMENT 'm:male , f:female',
  `status` enum('student','teacher') DEFAULT 'student',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_card` (`id_card`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `surname`, `id_card`, `birthday`, `address`, `phone`, `img_path`, `gender`, `status`, `create_at`) VALUES
	(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'b2i', '-', '2018-06-15', NULL, NULL, NULL, 'm', 'teacher', '2018-06-15 14:06:28'),
	(2, 'mana', '25d55ad283aa400af464c76d713c07ad', 'มานะ', 'ใจกล้า', '38475647383837', '2018-06-15', NULL, NULL, NULL, 'm', 'student', '2018-06-15 14:09:18'),
	(3, 'manop', '25d55ad283aa400af464c76d713c07ad', 'มานพ', 'ใจสุข', '544346784938', '2018-06-15', NULL, NULL, NULL, 'm', 'student', '2018-06-15 14:09:50'),
	(4, 'student2', '25d55ad283aa400af464c76d713c07ad', 'นักเรียน', 'คนที่1', '123456', '2018-06-29', '-', '-', '', 'm', 'student', '2018-06-29 11:27:07'),
	(5, 'malee', '25d55ad283aa400af464c76d713c07ad', 'มาลี', 'ใจสุข', '13232453547027', '2018-07-05', '', '-', '', 'm', 'student', '2018-07-05 10:44:24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
