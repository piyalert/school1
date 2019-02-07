ALTER TABLE `user`
	ADD COLUMN `old_grade` TEXT NULL COMMENT 'รายงานการเรียนเดิม' AFTER `home_birth`,
	ADD COLUMN `old_subject` TEXT NULL COMMENT 'คุณวิชา' AFTER `old_grade`;