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

-- Dumping structure for table db_school_ton.about
DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `detail` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.about: ~4 rows (approximately)
DELETE FROM `about`;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` (`id`, `year`, `type`, `detail`, `create_at`) VALUES
	(1, 2017, 'school', '<p>game</p>', '2018-07-16 17:37:32'),
	(2, 2018, 'school', '<p><img src="/school/froala/upload/froala_1531737882.jpg" style="width: 225px;" class="fr-fic fr-dib"></p><h2 style="text-align: center;"><u>ประวัติความเป็นมา</u></h2><p>&nbsp; &nbsp; &nbsp;โรงเรียนบ้านธาตุ ตั้งขึ้นเมื่อวันที่ 8 มกราคม 2476 โดยมีขุนศรีนวราสรักษ์ นายอำเภอวารินชำราบ และนายเหลื่อม ศิริมา ผู้ใหญ่บ้านหมู่ 5 ร่วมกันจัดตั้งโดยอาศัยศาลาวัด บ้านธาตุ เป็นที่ทำการสอนมีชื่อว่า โรงเรียนประชาบาลสหธาตุ ( วิชาชาติ ) มีนักเรียนจากหมู่ 4, 5, 6 และ 14โดยมี นายเสวย ไชยศรี เป็นครูใหญ่ พ.ศ. 2542 ได้รับคัดเลือกแบบเป็นโรเรียนต้นแบบคอมพิวเตอร์ และโรงเรียนต้นแบบปฏิรูป การเรียนรู้ พ.ศ. 2545 ได้รับการคัดเลือกเป็นโรงเรียนเครือข่ายสร้างหลักสูตรสถานศึกษาพ.ศ. 2550 ได้รับคัดเลือกเป็นโรงเรียนพัฒนาครู และบุคลากรทางการ ศึกษาเพื่อยกระดับคุณภาพการเรียนวิทยาศาสตร์ คณิตศาสตร์และเทคโนโลยีของสพฐ.-สกอ.-สวท. 2550-2554พ.ศ. 2553 ได้รับคัดเลือกเป็นโรงเรียนรักการอ่าน ของสำนักงานเขตพื้นที่การศึกษาอุบลราชธานี เขต 4และ นายวิเศษศักดิ์ จรรยาเพศ เป็นผู้อำนวยการโรงเรียน พ.ศ. 2553 - ปัจจุบัน</p>', '2018-07-16 17:39:14'),
	(3, 2018, 'teacher', '<div class="container"><div class="row text-center"><div class="col"><img src="./pictures/head.jpg" width="100" height="100" border="1" class="fr-fic fr-dii"><p><strong><span style="color: rgb(41, 105, 176);">นายวิเศษศักดิ์ จรรยาเพศ</span></strong></p><p>ผู้อำนวยการ</p></div></div><div class="row text-center"><div class="col"><img src="./pictures/1.jpg" width="100" height="100" border="1" class="fr-fic fr-dii"><p><strong><span style="color: rgb(41, 105, 176);">นางเกษมณี คชมิตร</span></strong></p><p>ครู ชำนาญการพิเศษ</p></div><div class="col"><img src="./pictures/2.jpg" width="100" height="100" border="1" class="fr-fic fr-dii"><p><strong><span style="color: rgb(41, 105, 176);">นางเกษร กาละปัตย์</span></strong></p><p>ครู ชำนาญการพิเศษ</p></div><div class="col"><img src="./pictures/3.jpg" width="100" height="100" border="1" class="fr-fic fr-dii"><p><strong><span style="color: rgb(41, 105, 176);">นางดารุณี พุ่มจันทน์</span></strong></p><p>ครู ชำนาญการพิเศษ</p></div></div></div>', '2018-07-17 09:57:10'),
	(4, 2018, 'item', '<p>ปลากระป๋อง</p>', '2018-07-17 11:04:20');
/*!40000 ALTER TABLE `about` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.course: ~6 rows (approximately)
DELETE FROM `course`;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` (`id`, `classroom`, `subject_id`, `year`, `teacher_id`, `update_at`) VALUES
	(1, 1, 1, 2018, 1, '2018-06-15 10:06:37'),
	(3, 1, 2, 2018, 1, '2018-06-15 10:04:20'),
	(8, 1, 1, 2017, NULL, '2018-06-29 17:50:33'),
	(9, 1, 2, 2017, NULL, '2018-06-29 17:50:33'),
	(10, 1, 3, 2017, NULL, '2018-06-29 17:50:33'),
	(11, 1, 4, 2017, NULL, '2018-06-29 17:50:33'),
	(12, 1, 5, 2018, NULL, '2018-07-05 12:14:38');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;

-- Dumping structure for table db_school_ton.date_check
DROP TABLE IF EXISTS `date_check`;
CREATE TABLE IF NOT EXISTS `date_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date_at` date NOT NULL COMMENT 'วันที่ครูตรวจ',
  `year` int(11) DEFAULT NULL,
  `check_status` enum('missing','leave','late','come','blank','holiday') NOT NULL DEFAULT 'blank' COMMENT 'missing:ขาด,leave:ลา,late:มาสาย,blank:ยังไม่ตรวจ,holiday:วันหยุด',
  `note` varchar(255) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id_date_at` (`student_id`,`date_at`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.date_check: ~29 rows (approximately)
DELETE FROM `date_check`;
/*!40000 ALTER TABLE `date_check` DISABLE KEYS */;
INSERT INTO `date_check` (`id`, `student_id`, `date_at`, `year`, `check_status`, `note`, `update_at`) VALUES
	(1, 14, '2018-08-09', 2018, 'late', '-', '2018-08-15 15:46:05'),
	(2, 14, '2018-08-10', 2018, 'come', '-', '2018-08-10 17:39:29'),
	(3, 15, '2018-08-10', 2018, 'come', '-', '2018-08-10 17:39:29'),
	(4, 16, '2018-08-10', 2018, 'missing', '-', '2018-08-15 16:41:07'),
	(5, 15, '2018-08-09', 2018, 'leave', '-', '2018-08-15 15:46:05'),
	(6, 16, '2018-08-09', 2018, 'come', '-', '2018-08-10 15:40:06'),
	(7, 14, '2018-08-15', 2018, 'leave', '-', '2018-08-15 13:02:13'),
	(8, 15, '2018-08-15', 2018, 'come', '-', '2018-08-15 13:02:13'),
	(9, 16, '2018-08-15', 2018, 'come', '-', '2018-08-15 13:02:13'),
	(10, 14, '2018-08-01', 2018, 'come', '-', '2018-08-15 15:44:45'),
	(11, 15, '2018-08-01', 2018, 'come', '-', '2018-08-15 15:44:45'),
	(12, 16, '2018-08-01', 2018, 'come', '-', '2018-08-15 15:44:45'),
	(13, 14, '2018-08-02', 2018, 'come', '-', '2018-08-15 15:44:57'),
	(14, 15, '2018-08-02', 2018, 'late', '-', '2018-08-15 15:44:57'),
	(15, 16, '2018-08-02', 2018, 'missing', '-', '2018-08-15 15:44:57'),
	(16, 14, '2018-08-03', 2018, 'come', '-', '2018-08-15 15:45:11'),
	(17, 15, '2018-08-03', 2018, 'come', '-', '2018-08-15 15:45:11'),
	(18, 16, '2018-08-03', 2018, 'come', '-', '2018-08-15 15:45:12'),
	(19, 14, '2018-08-06', 2018, 'come', '-', '2018-08-15 15:45:25'),
	(20, 15, '2018-08-06', 2018, 'come', '-', '2018-08-15 15:45:25'),
	(21, 16, '2018-08-06', 2018, 'come', '-', '2018-08-15 15:45:25'),
	(22, 14, '2018-08-07', 2018, 'come', '-', '2018-08-15 15:45:38'),
	(23, 15, '2018-08-07', 2018, 'come', '-', '2018-08-15 15:45:38'),
	(24, 16, '2018-08-07', 2018, 'come', '-', '2018-08-15 15:45:38'),
	(25, 14, '2018-08-08', 2018, 'come', '-', '2018-08-15 15:45:50'),
	(26, 15, '2018-08-08', 2018, 'come', '-', '2018-08-15 15:45:50'),
	(27, 16, '2018-08-08', 2018, 'come', '-', '2018-08-15 15:45:50'),
	(28, 14, '2018-08-14', 2018, 'come', '-', '2018-08-15 15:46:47'),
	(29, 15, '2018-08-14', 2018, 'come', '-', '2018-08-15 15:46:47'),
	(30, 16, '2018-08-14', 2018, 'come', '-', '2018-08-15 15:46:48');
/*!40000 ALTER TABLE `date_check` ENABLE KEYS */;

-- Dumping structure for table db_school_ton.date_holiday
DROP TABLE IF EXISTS `date_holiday`;
CREATE TABLE IF NOT EXISTS `date_holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ymd` date DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ymd_detail` (`ymd`,`detail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='วันหยุด';

-- Dumping data for table db_school_ton.date_holiday: ~2 rows (approximately)
DELETE FROM `date_holiday`;
/*!40000 ALTER TABLE `date_holiday` DISABLE KEYS */;
INSERT INTO `date_holiday` (`id`, `ymd`, `detail`, `create_at`) VALUES
	(3, '2018-08-13', 'ชดเชยวันแม่', '2018-08-15 15:20:11');
/*!40000 ALTER TABLE `date_holiday` ENABLE KEYS */;

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

-- Dumping data for table db_school_ton.grade: ~0 rows (approximately)
DELETE FROM `grade`;
/*!40000 ALTER TABLE `grade` DISABLE KEYS */;
/*!40000 ALTER TABLE `grade` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.news: ~4 rows (approximately)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `detail`, `title`, `img`, `year`, `create_at`) VALUES
	(2, '<p><img src="/school/froala/upload/froala_1531717290.jpg" style="width: 300px;" class="fr-fic fr-dib"></p>', 'MeDuSa', '/school/upload/file_upload/news_1531803779.jpg', 2018, '2018-06-28 15:21:07'),
	(3, '<p><img src="/school/froala/upload/froala_1531803851.jpg" style="width: 300px;" class="fr-fic fr-dib"></p>', 'EruKa', '/school/upload/file_upload/news_1531803824.jpg', 2018, '2018-06-28 15:24:58'),
	(4, '<p>แม่มดกิ่งก่า</p>', 'Angala', '/school/upload/file_upload/news_1531716795.jpg', 2018, '2018-07-16 11:54:11'),
	(5, '<p><img src="/school/froala/upload/froala_1531803980.png" style="width: 300px;" class="fr-fic fr-dib"></p>', 'ARachNe', '/school/upload/file_upload/news_1531803920.jpg', 2018, '2018-07-17 12:06:24');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.saving: ~7 rows (approximately)
DELETE FROM `saving`;
/*!40000 ALTER TABLE `saving` DISABLE KEYS */;
INSERT INTO `saving` (`id`, `user_id`, `active_user`, `event`, `balance`, `year`, `date_at`, `create_at`) VALUES
	(1, 2, 1, 'deposit', 35, 2018, '2018-07-18', '2018-07-18 11:57:16'),
	(2, 3, 1, 'deposit', 30, 2018, '2018-07-18', '2018-07-18 11:57:16'),
	(3, 4, 1, 'deposit', 30, 2018, '2018-07-18', '2018-07-18 11:57:16'),
	(4, 2, 1, 'deposit', 20, 2018, '2018-07-17', '2018-07-18 11:57:45'),
	(5, 3, 1, 'deposit', 20, 2018, '2018-07-17', '2018-07-18 11:57:45'),
	(6, 4, 1, 'deposit', 15, 2018, '2018-07-17', '2018-07-18 11:57:46'),
	(7, 2, 1, 'withdraw', 30, 2018, '2018-07-18', '2018-07-18 16:34:12'),
	(11, 2, 1, 'withdraw', 25, 2018, '2018-08-09', '2018-08-09 14:04:29');
/*!40000 ALTER TABLE `saving` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.student: ~3 rows (approximately)
DELETE FROM `student`;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` (`id`, `user_id`, `class`, `year`, `parent`, `status`, `create_at`) VALUES
	(1, 2, 1, 2015, NULL, 'learn', '2018-06-14 15:44:00'),
	(14, 2, 1, 2018, 'มีนา ใจกล้า', 'learn', '2018-06-29 15:31:39'),
	(15, 3, 1, 2018, 'ภพ ใจสุข', 'learn', '2018-06-29 15:31:39'),
	(16, 4, 1, 2018, '', 'learn', '2018-06-29 15:31:39'),
	(17, 2, 10, 2018, '', 'learn', '2018-07-17 11:31:38');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Dumping structure for table db_school_ton.subject
DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `remove_at` enum('Y','N') NOT NULL DEFAULT 'N',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.subject: ~4 rows (approximately)
DELETE FROM `subject`;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` (`id`, `name`, `detail`, `remove_at`, `update_at`) VALUES
	(1, 'ภาษาไทย', 'ภาษาไทย', 'N', '2018-06-29 16:46:15'),
	(2, 'สปช.', 'สร้างเสริมประสบการชีวิต', 'N', '2018-06-14 17:07:16'),
	(3, 'สลน.', NULL, 'N', '2018-06-29 16:46:06'),
	(4, 'กพอ.', NULL, 'N', '2018-06-29 16:49:43'),
	(5, 'ภาษาอังกฤษ', NULL, 'N', '2018-07-05 12:05:09'),
	(6, 'ผลประเมินอนุบาล 1', 'อนุมัติผ่านชั้น', 'N', '2018-07-17 13:00:39');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;

-- Dumping structure for table db_school_ton.teacher
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.teacher: ~0 rows (approximately)
DELETE FROM `teacher`;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table db_school_ton.user: ~5 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `surname`, `id_card`, `birthday`, `address`, `phone`, `img_path`, `gender`, `status`, `create_at`) VALUES
	(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'admin', 'b2i', '-', '2018-06-15', NULL, NULL, NULL, 'm', 'teacher', '2018-06-15 14:06:28'),
	(2, 'mana', '25d55ad283aa400af464c76d713c07ad', 'มานะ', 'ใจกล้า', '38475647383837', '2018-06-15', NULL, NULL, NULL, 'm', 'student', '2018-06-15 14:09:18'),
	(3, 'manop', '25d55ad283aa400af464c76d713c07ad', 'มานพ', 'ใจสุข', '544346784938', '2018-06-15', NULL, NULL, NULL, 'm', 'student', '2018-06-15 14:09:50'),
	(4, 'student2', '25d55ad283aa400af464c76d713c07ad', 'นักเรียน', 'คนที่1', '123456', '2018-06-29', '-', '-', '', 'm', 'student', '2018-06-29 11:27:07'),
	(5, 'malee', '25d55ad283aa400af464c76d713c07ad', 'มาลี', 'ใจสุข', '13232453547027', '2018-07-05', '', '-', '', 'm', 'student', '2018-07-05 10:44:24'),
	(6, 'game', '12345678', 'สุขใจ', 'ใจหาญ', '123', '2018-09-13', '107', '0869715693', '', 'm', 'student', '2018-09-13 16:31:07');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
