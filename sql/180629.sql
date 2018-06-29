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

-- Dumping structure for table db_school_ton.course
DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classroom` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classroom_subject_id_year` (`classroom`,`subject_id`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.date_check
DROP TABLE IF EXISTS `date_check`;
CREATE TABLE IF NOT EXISTS `date_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date_at` date NOT NULL COMMENT 'วันที่ครูตรวจ',
  `check_status` enum('missing','leave','late','come','blank') NOT NULL DEFAULT 'blank' COMMENT 'missing:ขาด,leave:ลา,late:มาสาย,blank:ยังไม่ตรวจ',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id_date_at` (`student_id`,`date_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.grade
DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `score` varchar(255) DEFAULT NULL,
  `final_exam` double DEFAULT NULL,
  `center_exam` double DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `course_id_student_id_year` (`course_id`,`student_id`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` text,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.saving
DROP TABLE IF EXISTS `saving`;
CREATE TABLE IF NOT EXISTS `saving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'ไอดีสมาชิก',
  `active_user` int(11) DEFAULT NULL COMMENT 'ไอดีคนที่คีย์ข้อมูล เช่น ครูคนไหน เป็นต้น',
  `event` enum('withdraw','deposit') NOT NULL DEFAULT 'deposit' COMMENT 'withdraw:ถอน ,  deposit:ฝาก',
  `balance` double DEFAULT NULL COMMENT 'จำนวนเงินที่ฝากหรือถอน',
  `year` int(11) DEFAULT NULL COMMENT 'ปีการศึกษาที่ฝาก',
  `date_at` date DEFAULT NULL COMMENT 'วันที่่สมาชิกทำการฝากเงิน',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.student
DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `class` int(11) DEFAULT NULL COMMENT 'ชั้น 1 2 3 4 5 6',
  `year` int(11) DEFAULT NULL COMMENT 'ปีการศึกษา ค.ศ.',
  `parent` varchar(255) DEFAULT NULL COMMENT 'ผู้ปกครอง',
  `status` enum('learn','resign','pass') NOT NULL DEFAULT 'learn' COMMENT 'learn:เรียนอยู่ , resign:ลาออก , pass:จบ ',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_class_year` (`user_id`,`class`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.subject
DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `remove_at` enum('Y','N') NOT NULL DEFAULT 'N',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_school_ton.teacher
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
