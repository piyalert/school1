ALTER TABLE `user`
	ADD COLUMN `name_father` VARCHAR(255) NULL DEFAULT NULL COMMENT 'ชื่อบิดา' AFTER `status`,
	ADD COLUMN `data_father` TEXT NULL DEFAULT NULL COMMENT 'ข้อมูลบิดา' AFTER `name_father`,
	ADD COLUMN `name_mother` VARCHAR(255) NULL DEFAULT NULL COMMENT 'ชื่อมารดา' AFTER `data_father`,
	ADD COLUMN `data_mother` TEXT NULL DEFAULT NULL COMMENT 'ข้อมูลมารดา' AFTER `name_mother`,
	ADD COLUMN `date_admission` DATE NULL DEFAULT NULL COMMENT 'วันที่เข้าเรียน' AFTER `data_mother`,
	ADD COLUMN `report_grade` TEXT NULL DEFAULT NULL COMMENT 'รายงานผลการเรียนเดิม' AFTER `date_admission`,
	ADD COLUMN `date_issue` DATE NULL DEFAULT NULL COMMENT 'วันที่จำหน่าย' AFTER `report_grade`,
	ADD COLUMN `note_issue` TEXT NULL DEFAULT NULL COMMENT 'เหตุที่จำหน่าย' AFTER `date_issue`,
	ADD COLUMN `detail_report` TEXT NULL DEFAULT NULL COMMENT 'ความรู้และความประพฤติ' AFTER `note_issue`,
	ADD COLUMN `address_birth` TEXT NULL DEFAULT NULL COMMENT 'สถานที่เกิด' AFTER `detail_report`,
	ADD COLUMN `old_school` TEXT NULL DEFAULT NULL COMMENT 'สถานศึกษาเดิม' AFTER `address_birth`,
	ADD COLUMN `note_change_school` TEXT NULL DEFAULT NULL COMMENT 'เหตุที่ย้าย' AFTER `old_school`,
	ADD COLUMN `home_birth` TEXT NULL DEFAULT NULL COMMENT 'บ้านเกิด' AFTER `note_change_school`;
