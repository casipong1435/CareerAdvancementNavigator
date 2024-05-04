/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : professionaldevelopmentdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-04-23 18:45:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `logged_in` datetime NOT NULL,
  `date_attended` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attendances
-- ----------------------------
INSERT INTO `attendances` VALUES ('11', '537264', '300014', '2024-01-11 13:37:46', '2024-01-11', '2024-01-11 05:37:46', '2024-01-11 05:37:46');
INSERT INTO `attendances` VALUES ('12', '105291', '159240', '2024-01-12 09:20:11', '2024-01-12', '2024-01-12 01:20:11', '2024-01-12 01:20:11');
INSERT INTO `attendances` VALUES ('16', '105291', '159240', '2024-01-13 13:56:28', '2024-01-13', '2024-01-13 05:56:28', '2024-01-13 05:56:28');

-- ----------------------------
-- Table structure for attended_trainings
-- ----------------------------
DROP TABLE IF EXISTS `attended_trainings`;
CREATE TABLE `attended_trainings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `training_id` varchar(255) DEFAULT NULL,
  `cop` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attended_trainings
-- ----------------------------
INSERT INTO `attended_trainings` VALUES ('21', '200875', '628604', null, null, null);
INSERT INTO `attended_trainings` VALUES ('22', '12345', '628604', null, null, null);
INSERT INTO `attended_trainings` VALUES ('24', '200875', '076756', '1705124273.png', '2024-01-13 05:53:40', '2024-01-13 05:53:40');
INSERT INTO `attended_trainings` VALUES ('27', '105291', '076756', '1705636382.jpg', '2024-01-20 08:03:51', '2024-01-20 08:03:51');

-- ----------------------------
-- Table structure for career_services
-- ----------------------------
DROP TABLE IF EXISTS `career_services`;
CREATE TABLE `career_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of career_services
-- ----------------------------
INSERT INTO `career_services` VALUES ('7', '123690', 'sample', '2024-01-21', '2024-01-21', '2024-01-21 02:32:38', '2024-01-21 02:32:38');

-- ----------------------------
-- Table structure for criterias
-- ----------------------------
DROP TABLE IF EXISTS `criterias`;
CREATE TABLE `criterias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `training_id` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `subject_area` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `level` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of criterias
-- ----------------------------
INSERT INTO `criterias` VALUES ('8', '210729', null, null, null, null, '2024-01-04 02:02:26', '2024-01-04 02:02:31', null, null);
INSERT INTO `criterias` VALUES ('9', '816016', null, null, null, null, '2024-01-05 03:19:11', '2024-01-06 11:29:52', null, null);
INSERT INTO `criterias` VALUES ('11', '300014', null, null, null, '', '2024-01-17 02:40:03', '2024-01-30 04:56:13', null, null);
INSERT INTO `criterias` VALUES ('12', '694545', '17-65', '[\"Filipino\",\"English\",\"Mathematics\",\"Science\",\"MAPEH\",\"Ar-Pan\",\"TLE\",\"ESP\"]', '[\"T2\",\"ADAS-1\",\"EPS\"]', '', '2024-01-21 02:20:26', '2024-01-21 02:20:26', '[\"Teaching\",\"Non-Teaching\",\"Teaching Related\"]', '');
INSERT INTO `criterias` VALUES ('13', '815712', '17-65', '[\"Filipino\"]', '[\"T1\"]', '', '2024-01-21 02:38:17', '2024-01-21 02:38:17', '[\"Teaching\"]', '');
INSERT INTO `criterias` VALUES ('14', '525845', '17-65', '[\"Filipino\"]', '[\"T1\",\"ADAS-1\",\"HR\"]', 'female', '2024-01-21 02:47:54', '2024-01-21 02:50:00', '[\"Teaching\"]', '');
INSERT INTO `criterias` VALUES ('15', '484255', null, '[\"Filipino\"]', null, '', '2024-02-09 06:50:31', '2024-02-09 06:51:16', '[\"Teaching\"]', null);

-- ----------------------------
-- Table structure for educational_attainments
-- ----------------------------
DROP TABLE IF EXISTS `educational_attainments`;
CREATE TABLE `educational_attainments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of educational_attainments
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for gad_assessment_answers
-- ----------------------------
DROP TABLE IF EXISTS `gad_assessment_answers`;
CREATE TABLE `gad_assessment_answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `date_answered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gad_assessment_answers
-- ----------------------------
INSERT INTO `gad_assessment_answers` VALUES ('1', '2024-02-09 05:56:54', '2024-02-09 05:56:54', '209112', '[\"1\",\"2\",\"3\"]', '2024-02-09');

-- ----------------------------
-- Table structure for gad_assessment_questions
-- ----------------------------
DROP TABLE IF EXISTS `gad_assessment_questions`;
CREATE TABLE `gad_assessment_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gad_assessment_questions
-- ----------------------------
INSERT INTO `gad_assessment_questions` VALUES ('1', null, '2024-02-09 06:56:46', 'Gender Sensitivity Orientation', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('2', null, '2024-02-09 06:56:46', 'Seminar on Gender and Sexuality/Gender Awareness Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('3', null, '2024-02-09 06:56:46', 'GAD Concepts Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('4', null, '2024-02-09 06:56:46', 'Gender-Fair Education Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('5', null, '2024-02-09 06:56:46', 'Seminar on Teenage Pregnancy', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('6', null, '2024-02-09 06:56:46', 'Reproductive Health Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('7', null, '2024-02-09 06:56:46', 'HIV Awareness Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('8', null, '2024-02-09 06:56:46', 'HIV, Tubercilosis and Hepatitis Awareness and Prevention Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('9', null, '2024-02-09 06:56:46', 'Young Adolescence Fertility and Sexuality Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('10', null, '2024-02-09 06:56:46', 'Breast Cancer Awareness Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('11', null, '2024-02-09 06:56:46', 'Human Rights Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('12', null, '2024-02-09 06:56:46', 'Pressure and Stress Management Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('13', null, '2024-02-09 06:56:46', 'Mental Health Awareness Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('14', null, '2024-02-09 06:56:46', 'Child Sexual Abuse Prevention Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('15', null, '2024-02-09 06:56:46', 'Work Ethics and Anti-Sexual Harrassment Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('16', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: R.A. 9710 - Magna Carta of Women', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('17', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: R.A. 7877 - Anti-Sexual Harassment Act of 1995', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('18', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: R.A. 9262 - Anti-Violence Against Women and their Children Act of 2004', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('19', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: R.A. 9208 - Anti-Trafficking in Persons Act', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('20', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: R.A. 11313 - Safe Spaces Act (Bawal Bastos Law)', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('21', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: Gender-Responsive Extension and Research Seminar', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('22', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: Gender and Responsive Planning and Budgeting', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('23', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: Gender Concepts and Gender Analysis (GA) Tools Gender Sensitivity Training', '2024', '1');
INSERT INTO `gad_assessment_questions` VALUES ('24', null, '2024-02-09 06:56:46', 'GAD Laws and Mandates: Use of GAD Tools (e.g. HGDG) for Gender Analysis', '2024', '1');

-- ----------------------------
-- Table structure for grade_levels
-- ----------------------------
DROP TABLE IF EXISTS `grade_levels`;
CREATE TABLE `grade_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grade_level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of grade_levels
-- ----------------------------
INSERT INTO `grade_levels` VALUES ('1', 'K1', null, null);
INSERT INTO `grade_levels` VALUES ('2', 'K2', null, null);
INSERT INTO `grade_levels` VALUES ('3', 'G1', null, null);
INSERT INTO `grade_levels` VALUES ('4', 'G2', null, null);
INSERT INTO `grade_levels` VALUES ('5', 'G3', null, null);
INSERT INTO `grade_levels` VALUES ('6', 'G4', null, null);
INSERT INTO `grade_levels` VALUES ('7', 'G5', null, null);
INSERT INTO `grade_levels` VALUES ('8', 'G6', null, null);
INSERT INTO `grade_levels` VALUES ('9', 'G6', null, null);
INSERT INTO `grade_levels` VALUES ('10', 'ALS', null, null);
INSERT INTO `grade_levels` VALUES ('11', 'G7', null, null);
INSERT INTO `grade_levels` VALUES ('12', 'G8', null, null);
INSERT INTO `grade_levels` VALUES ('13', 'G9', null, null);
INSERT INTO `grade_levels` VALUES ('14', 'G10', null, null);
INSERT INTO `grade_levels` VALUES ('15', 'G11', null, null);
INSERT INTO `grade_levels` VALUES ('16', 'G12', null, null);

-- ----------------------------
-- Table structure for grade_level_taughts
-- ----------------------------
DROP TABLE IF EXISTS `grade_level_taughts`;
CREATE TABLE `grade_level_taughts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of grade_level_taughts
-- ----------------------------
INSERT INTO `grade_level_taughts` VALUES ('4', '512421', 'G1', '2023-12-18', '2023-12-18', '2023-12-18 06:03:17', '2023-12-18 06:03:17');
INSERT INTO `grade_level_taughts` VALUES ('5', '12345', 'G9', '2023-12-07', '2023-12-08', '2023-12-19 05:31:09', '2023-12-19 05:31:09');
INSERT INTO `grade_level_taughts` VALUES ('6', '123690', 'G5', '2024-01-21', '2024-01-21', '2024-01-21 02:33:03', '2024-01-21 02:33:03');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('9', '2023_09_05_123914_create_attended_trainings_table', '1');
INSERT INTO `migrations` VALUES ('47', '2014_10_12_000000_create_users_table', '2');
INSERT INTO `migrations` VALUES ('48', '2014_10_12_100000_create_password_reset_tokens_table', '2');
INSERT INTO `migrations` VALUES ('49', '2014_10_12_100000_create_password_resets_table', '2');
INSERT INTO `migrations` VALUES ('50', '2019_08_19_000000_create_failed_jobs_table', '2');
INSERT INTO `migrations` VALUES ('51', '2019_12_14_000001_create_personal_access_tokens_table', '2');
INSERT INTO `migrations` VALUES ('52', '2023_09_05_123704_create_profiles_table', '2');
INSERT INTO `migrations` VALUES ('53', '2023_09_05_123833_create_otps_table', '2');
INSERT INTO `migrations` VALUES ('54', '2023_09_05_123857_create_official_trainings_table', '2');
INSERT INTO `migrations` VALUES ('55', '2023_09_19_064056_create_educational_attainments_table', '2');
INSERT INTO `migrations` VALUES ('56', '2023_09_19_064119_create_career_services_table', '2');
INSERT INTO `migrations` VALUES ('57', '2023_09_19_064131_create_subject_areas_table', '2');
INSERT INTO `migrations` VALUES ('58', '2023_09_26_104958_create_pending_trainings_table', '2');
INSERT INTO `migrations` VALUES ('59', '2023_10_22_235012_create_schools_table', '2');
INSERT INTO `migrations` VALUES ('60', '2023_10_22_235023_create_attendances_table', '2');
INSERT INTO `migrations` VALUES ('61', '2023_10_28_071028_create_criterias_table', '2');
INSERT INTO `migrations` VALUES ('62', '2023_11_01_004128_create_attended_trainings_table', '2');
INSERT INTO `migrations` VALUES ('63', '2023_11_04_112002_create_recommended_participants_table', '2');
INSERT INTO `migrations` VALUES ('64', '2023_11_05_045459_create_selected_participants_table', '2');
INSERT INTO `migrations` VALUES ('65', '2023_12_10_064239_create_position_categories_table', '2');
INSERT INTO `migrations` VALUES ('66', '2023_12_10_065257_create_salary_grades_table', '2');
INSERT INTO `migrations` VALUES ('67', '2023_12_11_130134_create_subjects_table', '3');
INSERT INTO `migrations` VALUES ('68', '2023_12_11_142612_create_grade_levels_table', '4');
INSERT INTO `migrations` VALUES ('69', '2023_12_11_142317_create_grade_level_taugths_table', '5');
INSERT INTO `migrations` VALUES ('70', '2023_12_12_123814_create_certificates_table', '6');
INSERT INTO `migrations` VALUES ('71', '2023_12_13_092009_create_gad_details_table', '7');
INSERT INTO `migrations` VALUES ('75', '2024_01_27_092621_create_gad_assessment_answers_table', '11');
INSERT INTO `migrations` VALUES ('76', '2024_01_27_092603_create_gad_assessment_questions_table', '12');
INSERT INTO `migrations` VALUES ('77', '2024_02_09_015528_create_calendar_years_table', '13');

-- ----------------------------
-- Table structure for official_trainings
-- ----------------------------
DROP TABLE IF EXISTS `official_trainings`;
CREATE TABLE `official_trainings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `training_id` varchar(255) DEFAULT NULL,
  `training_title` varchar(255) NOT NULL,
  `start_of_conduct` date NOT NULL,
  `end_of_conduct` date NOT NULL,
  `number_of_hours` varchar(255) NOT NULL,
  `type_of_ld` varchar(255) DEFAULT NULL,
  `source_of_budget` varchar(255) DEFAULT NULL,
  `conducted_by` varchar(255) DEFAULT NULL,
  `service_provider` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `responsible_unit` varchar(255) DEFAULT NULL,
  `number_of_participants` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `training_type` varchar(255) DEFAULT NULL,
  `reference` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of official_trainings
-- ----------------------------
INSERT INTO `official_trainings` VALUES ('20', '628604', 'samples', '2024-01-03', '2024-01-04', '16', 'Managerial', 'School - MOOE', 'SGOD', 'Internal', '1', '2024-01-05 01:20:45', '2024-01-05 03:11:15', 'samples.net', '2', 'TBA', 'GAD', '');
INSERT INTO `official_trainings` VALUES ('22', '300014', 'ILT', '2024-01-18', '2024-01-19', '16', 'Supervisory', 'Division - MOOE', 'SGOD', 'External', '0', '2024-01-09 01:01:35', '2024-01-25 02:07:10', 'HRD', '100', 'Be Palace', 'GAD', '12356789');
INSERT INTO `official_trainings` VALUES ('23', '076756', 'Youtube Turorial', '2024-01-11', '2024-01-11', '8', 'Supervisory', 'Division - MOOE', 'CID', 'Internal', '1', '2024-01-10 02:03:11', '2024-01-13 02:17:19', 'sample', '50', 'TBA', 'Others', '');
INSERT INTO `official_trainings` VALUES ('25', '159240', 'hrd bootcamp sample', '2024-01-12', '2024-01-13', '16', 'Supervisory', 'HRD Fund', 'SGOD', 'Internal', '1', '2024-01-12 01:13:39', '2024-01-14 05:59:37', 'sample responible', '10', 'Be palace hotel', '', '');
INSERT INTO `official_trainings` VALUES ('27', '194727', 'Sample new training today', '2024-01-19', '2024-01-19', '8', 'Managerial', 'School - MOOE', 'SGOD', 'Internal', '1', '2024-01-18 02:45:13', '2024-01-20 07:26:43', 'sample responsible', '10', 'TBA', 'GAD', '');
INSERT INTO `official_trainings` VALUES ('38', '484255', 'Technological Specialization', '2024-02-12', '2024-02-14', '24', 'Supervisory', 'School - MOOE', 'CID', 'External', '0', '2024-02-09 06:39:36', '2024-02-09 06:39:36', 'sample', '100', 'TBA', 'GAD', '12312512');

-- ----------------------------
-- Table structure for otps
-- ----------------------------
DROP TABLE IF EXISTS `otps`;
CREATE TABLE `otps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `training_id` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of otps
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for pending_trainings
-- ----------------------------
DROP TABLE IF EXISTS `pending_trainings`;
CREATE TABLE `pending_trainings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `training_id` varchar(255) DEFAULT NULL,
  `training_title` varchar(255) NOT NULL,
  `start_of_conduct` date NOT NULL,
  `end_of_conduct` date NOT NULL,
  `number_of_hours` varchar(255) NOT NULL,
  `type_of_ld` varchar(255) DEFAULT NULL,
  `source_of_budget` varchar(255) DEFAULT NULL,
  `conducted_by` varchar(255) DEFAULT NULL,
  `service_provider` varchar(255) DEFAULT NULL,
  `cop` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `responsible_unit` varchar(255) DEFAULT NULL,
  `number_of_participants` varchar(255) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `training_type` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pending_trainings
-- ----------------------------
INSERT INTO `pending_trainings` VALUES ('46', '200875', '', 'Outside', '2024-01-02', '2024-01-03', '16', 'sample ld', 'sample SOB', 'sample CB', 'sample SP', '1704522778.png', '1', '2024-01-06 06:32:58', '2024-01-06 06:39:57', '', '', '', null, null);
INSERT INTO `pending_trainings` VALUES ('49', '200875', '', 'Ps logo', '2024-01-11', '2024-01-05', '56', 'Supervisory', 'Division - MOOE', 'CID', 'External', '1704955656.jpg', '0', '2024-01-11 06:47:36', '2024-01-11 06:48:19', '', '', '', null, null);
INSERT INTO `pending_trainings` VALUES ('50', '105291', '', 'Bootcamp USA', '2021-01-12', '2021-01-13', '16', 'Supervisory', 'HRD Fund', 'CID', 'External', '1704955656.jpg', '0', '2024-01-12 01:07:34', '2024-01-12 01:07:56', '', '', '', null, null);
INSERT INTO `pending_trainings` VALUES ('56', '105292', '628604', 'samples', '2024-01-03', '2024-01-04', '16', 'Managerial', 'School - MOOE', 'SGOD', 'Internal', '1704955656.jpg', '0', '2024-02-11 05:20:27', '2024-02-11 05:20:27', 'samples.net', '2', 'TBA', 'GAD', '');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for position_categories
-- ----------------------------
DROP TABLE IF EXISTS `position_categories`;
CREATE TABLE `position_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of position_categories
-- ----------------------------
INSERT INTO `position_categories` VALUES ('1', 'Teaching', 'T1', null, null);
INSERT INTO `position_categories` VALUES ('2', 'Non-Teaching', 'ADAS-1', null, null);
INSERT INTO `position_categories` VALUES ('3', 'Teaching Related', 'OSDS', null, null);
INSERT INTO `position_categories` VALUES ('4', 'Teaching', 'T2', null, null);
INSERT INTO `position_categories` VALUES ('5', 'Teaching', 'MT1', null, null);
INSERT INTO `position_categories` VALUES ('6', 'Non-Teaching', 'ADAS-2', null, null);
INSERT INTO `position_categories` VALUES ('7', 'Teaching Related', 'EPS', null, null);
INSERT INTO `position_categories` VALUES ('8', 'Teaching Related', 'EPS-II', null, null);
INSERT INTO `position_categories` VALUES ('9', 'Teaching Related', 'HR', null, null);
INSERT INTO `position_categories` VALUES ('10', 'Teaching Related', 'PSDS', null, null);
INSERT INTO `position_categories` VALUES ('14', 'Teaching Related', 'SEPS', '2024-01-09 02:16:31', '2024-01-09 02:16:31');

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `date_started_in_deped` varchar(255) DEFAULT NULL,
  `years_in_service` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('3', '209112', 'john shander', '', 'casipong', '1950-02-12', null, 'male', '0951552312', '1702294441.jpg', '8', '2017-03-10', '6', 'Dimaluna Elementary School', null, '2024-01-07 15:12:06', null);
INSERT INTO `profiles` VALUES ('4', '381223', 'jeffrey', null, 'ombina', '1973-11-01', '50', 'male', '09515126367', '1705472937.jpg', '5', '1990-02-12', '34', 'Domingo A. Barloa Elementary School', null, '2024-02-24 23:53:55', '');
INSERT INTO `profiles` VALUES ('7', '201923', 'James', '', 'Yap', '1999-02-12', '24', 'female', '09514231251', '1706592468.png', '6', '2017-01-08', '7', 'Dalapang Elementary School', '2023-12-10 15:25:22', '2024-02-09 06:35:14', null);
INSERT INTO `profiles` VALUES ('8', '105124', 'michael', '', 'tagal', '1985-02-01', '38', 'male', '09412512512', null, '5', '2005-02-12', '18', 'Domingo A. Barloa Elementary School', '2023-12-12 02:08:50', '2023-12-12 05:36:57', null);
INSERT INTO `profiles` VALUES ('9', '514121', 'Joey', '', 'George', '1999-02-12', '24', 'male', '09512469875', null, '10', '2019-01-30', '5', 'Diego Tuastomban Elementary School', '2023-12-12 03:07:16', '2024-01-30 05:08:25', null);
INSERT INTO `profiles` VALUES ('10', '512421', 'Geneliza', '', 'Ason', '1999-01-22', '24', 'female', '09123567891', '657fde09394b7.jpeg', '5', '2022-04-01', '1', 'Domingo A. Barloa Elementary School', '2023-12-18 05:52:09', '2024-01-07 11:59:58', null);
INSERT INTO `profiles` VALUES ('11', '125124', 'Angelina', '', 'Jolly', '1996-01-11', '27', 'female', '09512531251', '65805acca7b11.jpeg', '3', '2019-02-08', '4', 'Baybay Central School', '2023-12-18 14:44:28', '2023-12-18 14:53:15', null);
INSERT INTO `profiles` VALUES ('12', '412164', 'christopher', '', 'casipong', '2023-10-30', '0', 'male', '09512523534', '65810d653db6e.jpeg', null, null, null, null, '2023-12-19 03:26:29', '2023-12-19 03:26:29', null);
INSERT INTO `profiles` VALUES ('13', '254362', 'Meann', '', 'Abiabi', '1996-12-19', '27', 'female', '09432563727', '65810f0de272f.jpeg', '5', '1999-12-15', '24', 'Domingo A. Barloa Elementary School', '2023-12-19 03:33:34', '2024-01-07 16:30:12', null);
INSERT INTO `profiles` VALUES ('15', '275193', 'Chi', '', 'Mans', '1968-12-19', '55', 'female', '09276491633', '6581151d3d9aa.jpeg', null, null, null, null, '2023-12-19 03:59:25', '2023-12-19 03:59:25', null);
INSERT INTO `profiles` VALUES ('16', '537264', 'Cj', '', 'Lenogon', '2001-04-04', '22', 'male', '09325626421', '6581274223a57.jpeg', '3', '2023-07-05', '0', 'Baybay Central School', '2023-12-19 05:16:50', '2024-01-05 03:33:26', null);
INSERT INTO `profiles` VALUES ('17', '12345', 'jay', '', 'ras', '1984-07-19', '43', 'male', '095122233', '6581287000592.jpeg', '5', '2023-12-19', '0', 'Baybay Central School', '2023-12-19 05:21:52', '2023-12-19 05:45:24', null);
INSERT INTO `profiles` VALUES ('18', '875577', 'Janziel', 'Gabrinez', 'Belano', '1991-12-19', '32', 'female', '098665', '65812b80cf67a.jpeg', null, null, null, null, '2023-12-19 05:34:56', '2023-12-19 05:34:56', null);
INSERT INTO `profiles` VALUES ('19', '200875', 'ronel', '', 'gago', '2001-04-11', '22', 'male', '09865436278', '1706592824.png', '4', '2022-01-25', '2', 'Doña Consuelo Elementary School', '2023-12-19 06:08:18', '2024-01-31 09:58:40', null);
INSERT INTO `profiles` VALUES ('20', '205559', 'Okong', '', 'Casipong', '2001-04-12', '22', 'male', '09512412451', '65967175c1e8d.jpeg', '6', null, '0', 'Dalapang Elementary School', '2024-01-04 08:51:01', '2024-01-17 06:28:08', null);
INSERT INTO `profiles` VALUES ('21', '1234', 'wiwiw', '', 'lalal', '2000-02-02', '23', 'male', '09821512411', '6597ecc9aa1c1.jpeg', null, null, null, null, '2024-01-05 11:49:29', '2024-01-05 11:49:29', null);
INSERT INTO `profiles` VALUES ('22', '102942', 'Danica', '', 'Laluan', '2001-01-11', '23', 'female', '09128642122', '659f8f02583b7.jpeg', '3', '2020-01-01', '4', 'Sta. Cruz Elementary School', '2024-01-11 06:47:30', '2024-01-11 06:50:24', null);
INSERT INTO `profiles` VALUES ('23', '200912', 'Xander', '', 'Ford', '2005-01-12', '19', 'male', '09124532916', '65a08e5184bab.jpeg', '6', '2020-01-12', '4', 'Hilarion A. Ramiro Elementary School', '2024-01-12 00:56:49', '2024-01-12 00:59:11', null);
INSERT INTO `profiles` VALUES ('24', '105291', 'Marjun', '', 'Pucot', '2006-01-12', '18', 'male', '09472916272', '65a08f95cd90b.jpeg', '3', '2018-01-12', '6', 'Sta. Cruz Elementary School', '2024-01-12 01:02:13', '2024-01-17 08:41:26', null);
INSERT INTO `profiles` VALUES ('25', '105292', 'Eric', '', 'Tecson', '1998-01-18', '26', 'female', '09764293745', '65a88ed518be1.jpeg', '4', '2022-01-02', '2', 'Ozamiz City School of Arts and Trade', '2024-01-18 02:37:09', '2024-01-18 02:38:23', null);
INSERT INTO `profiles` VALUES ('26', '105294', 'Genevieve', '', 'Hilot', '2000-01-22', '23', 'male', '09542872823', '65a9ef1700e1c.jpeg', null, null, null, null, '2024-01-19 03:40:07', '2024-01-19 03:40:07', null);
INSERT INTO `profiles` VALUES ('27', '123690', 'Chou', 'PA', 'Kou', '2003-02-21', '20', 'female', '09997854213', '65ac8120f3ce1.jpeg', '5', '2024-01-21', '0', 'Gotocan Elementary School', '2024-01-21 02:27:45', '2024-01-21 02:33:43', null);

-- ----------------------------
-- Table structure for recommended_participants
-- ----------------------------
DROP TABLE IF EXISTS `recommended_participants`;
CREATE TABLE `recommended_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `recommended_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of recommended_participants
-- ----------------------------
INSERT INTO `recommended_participants` VALUES ('1', '105124', '229742', 'PSDS', '2023-12-14 14:20:47', '2023-12-14 14:20:47');
INSERT INTO `recommended_participants` VALUES ('12', '512421', '484255', 'PSDS', '2024-02-09 06:52:34', '2024-02-09 06:52:34');
INSERT INTO `recommended_participants` VALUES ('13', '123690', '484255', 'PSDS', '2024-02-09 06:52:35', '2024-02-09 06:52:35');

-- ----------------------------
-- Table structure for salary_grades
-- ----------------------------
DROP TABLE IF EXISTS `salary_grades`;
CREATE TABLE `salary_grades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `salaryID` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_grades
-- ----------------------------
INSERT INTO `salary_grades` VALUES ('1', 'T1', 'SG11', '27000', null, null);
INSERT INTO `salary_grades` VALUES ('2', 'T2', 'SG12', '29165', null, null);
INSERT INTO `salary_grades` VALUES ('3', 'T3', 'SG13', '31320', null, null);
INSERT INTO `salary_grades` VALUES ('4', 'MT1', 'SG18', '46725', null, null);
INSERT INTO `salary_grades` VALUES ('5', 'MT2', 'SG19', '51357', null, null);
INSERT INTO `salary_grades` VALUES ('6', 'HR', 'SG99', '100000', null, null);
INSERT INTO `salary_grades` VALUES ('7', 'ADAS-1', 'SG55', '50000', null, null);
INSERT INTO `salary_grades` VALUES ('8', 'PSDS', 'SG34', '46000', null, null);
INSERT INTO `salary_grades` VALUES ('10', 'MT2', 'SG22', '25000', '2023-12-16 09:02:40', '2023-12-16 09:02:40');
INSERT INTO `salary_grades` VALUES ('11', 'ADAS-2', 'SG52', '30000', null, null);
INSERT INTO `salary_grades` VALUES ('12', 'OSDS', 'SG41', '40000', null, null);
INSERT INTO `salary_grades` VALUES ('13', 'EPS', 'SG56', '40000', null, null);
INSERT INTO `salary_grades` VALUES ('14', 'EPS-II', 'SG57', '50000', null, null);
INSERT INTO `salary_grades` VALUES ('15', 'SEPS', 'SG92', '50000', '2024-01-09 02:16:31', '2024-01-09 02:16:31');

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `district` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of schools
-- ----------------------------
INSERT INTO `schools` VALUES ('1', '1', 'Felipe Carreon Central School', null, null);
INSERT INTO `schools` VALUES ('2', '1', 'Andrea Costonera Elementary School', null, null);
INSERT INTO `schools` VALUES ('3', '1', 'Sancho Capa Elementary School', null, null);
INSERT INTO `schools` VALUES ('4', '1', 'Ozamiz City National High School', null, null);
INSERT INTO `schools` VALUES ('5', '2', 'Ozamiz City Central School', null, null);
INSERT INTO `schools` VALUES ('6', '3', 'Baybay Central School', null, null);
INSERT INTO `schools` VALUES ('7', '3', 'Catadman Elementary School', null, null);
INSERT INTO `schools` VALUES ('8', '3', 'Sta. Cruz Elementary School', null, null);
INSERT INTO `schools` VALUES ('9', '3', 'Misamis Annex Integrated School', null, null);
INSERT INTO `schools` VALUES ('10', '4', 'Maningcol Central School', null, null);
INSERT INTO `schools` VALUES ('11', '4', 'Doña Consuelo Elementary School', null, null);
INSERT INTO `schools` VALUES ('12', '4', 'Gango Elementary School', null, null);
INSERT INTO `schools` VALUES ('13', '4', 'Ozamiz City School of Arts and Trade', null, null);
INSERT INTO `schools` VALUES ('14', '4', 'San Antonio National High School', null, null);
INSERT INTO `schools` VALUES ('15', '5', 'Labo Central School', null, null);
INSERT INTO `schools` VALUES ('16', '5', 'Embargo Elementary School', null, null);
INSERT INTO `schools` VALUES ('17', '5', 'Domingo A. Barloa Elementary School', null, null);
INSERT INTO `schools` VALUES ('18', '5', 'Gotocan Elementary School', null, null);
INSERT INTO `schools` VALUES ('19', '5', 'Sangay Elementary School', null, null);
INSERT INTO `schools` VALUES ('20', '5', 'Mintalar Elementary School', null, null);
INSERT INTO `schools` VALUES ('21', '5', 'Labo National High School', null, null);
INSERT INTO `schools` VALUES ('22', '6', 'Maximino S. Laurente, Sr. Elementary School', null, null);
INSERT INTO `schools` VALUES ('23', '6', 'Anteno D. Hinagdanan Elementary School', null, null);
INSERT INTO `schools` VALUES ('24', '6', 'Dalapang Elementary School', null, null);
INSERT INTO `schools` VALUES ('25', '6', 'Faustino C. Decena Elementary School', null, null);
INSERT INTO `schools` VALUES ('26', '6', 'Hilarion A. Ramiro Elementary School', null, null);
INSERT INTO `schools` VALUES ('27', '6', 'Roman A. Mabanag, Sr. Elementary School', null, null);
INSERT INTO `schools` VALUES ('28', '6', 'Jose Lim Ho National High School', null, null);
INSERT INTO `schools` VALUES ('29', '7', 'Antero U. Roa Central School', null, null);
INSERT INTO `schools` VALUES ('30', '7', 'Capucao C Elementary School', null, null);
INSERT INTO `schools` VALUES ('31', '7', 'Capucao Elementary School', null, null);
INSERT INTO `schools` VALUES ('32', '7', 'Guingona Elementary School', null, null);
INSERT INTO `schools` VALUES ('33', '7', 'Pershing Tan Queto, Sr. Elementary School', null, null);
INSERT INTO `schools` VALUES ('34', '7', 'Tipan Elementary School', null, null);
INSERT INTO `schools` VALUES ('35', '7', 'Montol National High School', null, null);
INSERT INTO `schools` VALUES ('36', '8', 'Juan A. Acapulco Elementary School', null, null);
INSERT INTO `schools` VALUES ('37', '8', 'Gala Elementary School', null, null);
INSERT INTO `schools` VALUES ('38', '8', 'Guimad Elementary School', null, null);
INSERT INTO `schools` VALUES ('39', '8', 'Marcilino C. Regis Integrated School', null, null);
INSERT INTO `schools` VALUES ('40', '8', 'Cogon Integrated School', null, null);
INSERT INTO `schools` VALUES ('41', '8', 'Gala National High School', null, null);
INSERT INTO `schools` VALUES ('42', '9', 'Balintawak Elementary School', null, null);
INSERT INTO `schools` VALUES ('43', '9', 'Cruz Lanzano Saligan Elementary School', null, null);
INSERT INTO `schools` VALUES ('44', '9', 'Dimaluna Elementary School', null, null);
INSERT INTO `schools` VALUES ('45', '9', 'Pulot Elementary School', null, null);
INSERT INTO `schools` VALUES ('46', '9', 'Malaubang Integrated School', null, null);
INSERT INTO `schools` VALUES ('47', '10', 'Narciso B. Ledesma Central School', null, null);
INSERT INTO `schools` VALUES ('48', '10', 'Gregorio A Saquin Elementary School', null, null);
INSERT INTO `schools` VALUES ('49', '10', 'Diego Tuastomban Elementary School', null, null);
INSERT INTO `schools` VALUES ('50', '10', 'Sinusa Elementary School', null, null);
INSERT INTO `schools` VALUES ('51', '10', 'Labinay Elementary School', null, null);
INSERT INTO `schools` VALUES ('52', '10', 'Jacinto Nemeño Integrated School', null, null);
INSERT INTO `schools` VALUES ('53', '10', 'Labinay National High School', null, null);
INSERT INTO `schools` VALUES ('54', '10', 'Tabid National High School', null, null);
INSERT INTO `schools` VALUES ('58', 'Division', 'CID', '2024-01-25 02:18:36', '2024-01-25 02:18:36');
INSERT INTO `schools` VALUES ('59', 'Division', 'SGOD', '2024-01-25 02:18:49', '2024-01-25 02:18:49');
INSERT INTO `schools` VALUES ('60', 'Division', 'OSDS', '2024-01-25 02:18:58', '2024-01-25 02:18:58');

-- ----------------------------
-- Table structure for selected_participants
-- ----------------------------
DROP TABLE IF EXISTS `selected_participants`;
CREATE TABLE `selected_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `training_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of selected_participants
-- ----------------------------
INSERT INTO `selected_participants` VALUES ('119', '123690', '484255', '2024-02-09 06:53:33', '2024-02-09 06:53:33');
INSERT INTO `selected_participants` VALUES ('120', '512421', '484255', '2024-02-09 06:53:35', '2024-02-09 06:53:35');

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES ('1', 'Filipino', null, null);
INSERT INTO `subjects` VALUES ('2', 'English', null, null);
INSERT INTO `subjects` VALUES ('3', 'Science', null, null);
INSERT INTO `subjects` VALUES ('4', 'Mathematics', null, null);
INSERT INTO `subjects` VALUES ('5', 'MAPEH', null, null);
INSERT INTO `subjects` VALUES ('6', 'Ar-Pan', null, null);
INSERT INTO `subjects` VALUES ('7', 'TLE', null, null);
INSERT INTO `subjects` VALUES ('8', 'ESP', null, null);

-- ----------------------------
-- Table structure for subject_areas
-- ----------------------------
DROP TABLE IF EXISTS `subject_areas`;
CREATE TABLE `subject_areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of subject_areas
-- ----------------------------
INSERT INTO `subject_areas` VALUES ('17', '101001', 'Science', '2022-02-12', null, '2023-12-12 01:07:16', '2023-12-12 01:07:16');
INSERT INTO `subject_areas` VALUES ('18', '105124', 'Science', '2023-12-07', null, '2023-12-12 05:36:21', '2023-12-12 05:36:21');
INSERT INTO `subject_areas` VALUES ('19', '381223', 'Mathematics', '1999-02-12', null, '2023-12-12 14:07:37', '2023-12-12 14:07:37');
INSERT INTO `subject_areas` VALUES ('21', '125124', 'Mathematics', '2021-02-18', null, '2023-12-18 14:51:40', '2023-12-18 14:51:40');
INSERT INTO `subject_areas` VALUES ('22', '1234', 'Mathematics', '2021-12-31', null, '2023-12-19 03:41:09', '2023-12-19 03:41:09');
INSERT INTO `subject_areas` VALUES ('23', '254362', 'Filipino', '2023-12-03', null, '2023-12-19 03:46:45', '2023-12-19 03:46:45');
INSERT INTO `subject_areas` VALUES ('24', '12345', 'Filipino', '2023-12-15', null, '2023-12-19 05:34:40', '2023-12-19 05:34:40');
INSERT INTO `subject_areas` VALUES ('28', '537264', 'Filipino', '2023-07-01', null, '2024-01-05 03:33:24', '2024-01-05 03:33:24');
INSERT INTO `subject_areas` VALUES ('30', '512421', 'Filipino', '2024-01-02', null, '2024-01-07 05:46:13', '2024-01-07 05:46:13');
INSERT INTO `subject_areas` VALUES ('33', '200875', 'English', '2024-01-07', null, '2024-01-07 08:44:23', '2024-01-07 08:44:23');
INSERT INTO `subject_areas` VALUES ('34', '102942', 'MAPEH', '2020-01-01', null, '2024-01-11 06:50:21', '2024-01-11 06:50:21');
INSERT INTO `subject_areas` VALUES ('36', '105291', 'Mathematics', '2023-01-17', null, '2024-01-17 09:58:05', '2024-01-17 09:58:05');
INSERT INTO `subject_areas` VALUES ('37', '105292', 'English', '2022-01-02', null, '2024-01-18 02:38:52', '2024-01-18 02:38:52');
INSERT INTO `subject_areas` VALUES ('38', '123690', 'Filipino', '2024-01-21', null, '2024-01-21 02:32:17', '2024-01-21 02:32:17');
INSERT INTO `subject_areas` VALUES ('39', '514121', 'Science', '2023-01-30', null, '2024-01-30 05:08:21', '2024-01-30 05:08:21');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `position` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `plain_pass` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', '209112', '1', 'HR', 'Teaching Related', 'jamesyap@gmail.com', '1', '$2y$10$6OifGQ1QZQmR9lXY/Z7Xk.dB/8XwETIsV/8jXUf.2HoVHBStxwm2O', '123456789', null, null, '2024-02-09 06:35:14', '1');
INSERT INTO `users` VALUES ('4', '381223', '0', 'PSDS', 'Teaching Related', 'jeffrey@gmail.com', '1', '$2y$10$ORQVqcALCmpVwaL/swVjZe1MRWK0HFWVM1cY.YJHvdqbD1OdiEe6W', '123456789', null, null, '2024-02-24 23:53:55', '1');
INSERT INTO `users` VALUES ('7', '201923', '1', 'HR', 'Teaching Related', 'jamesyap@gmail.com', '1', '$2y$10$MDUqzD4zyN2J/GYOKGqO9uokv5JMlxpghJA9skWeKbFbCbPa.AmNm', '123456789', null, '2023-12-10 15:25:22', '2024-01-08 02:18:26', '1');
INSERT INTO `users` VALUES ('9', '105124', '0', 'T1', 'Teaching', 'christopher.casipong2001@gmail.com', '1', '$2y$10$cXZR3qTDWRRWs4cotffvseseMGXz0oYykm7Fq.zvZ3E55MPnVX0na', '123456789', null, '2023-12-12 02:08:50', '2023-12-14 13:38:21', '1');
INSERT INTO `users` VALUES ('10', '514121', '0', 'EPS-II', 'Teaching Related', 'joey.george@gmail.com', '1', '$2y$10$fCaybOoxLDklW4wOrJtpYO.Q7XjQXpT/PESv53IGSRzuTcyeq0rce', '123456789', null, '2023-12-12 03:07:16', '2024-01-30 05:08:25', '1');
INSERT INTO `users` VALUES ('11', '512421', '0', 'T1', 'Teaching', 'asongeneliza@gmail.com', '1', '$2y$10$RxhBWUXD.IXfxKFT8ReSnueCnOfE.PAi0RZAV152HImPrqZs2ireG', '123456789', null, '2023-12-18 05:52:09', '2024-01-27 07:23:17', '1');
INSERT INTO `users` VALUES ('12', '125124', '0', 'T2', 'Teaching', 'jolly@gmail.com', '1', '$2y$10$RU/McpJQZU5kXzdNpsDYg.bSf5YQIjTy55v3SuLi.SE02mRUvqagu', '123456789', null, '2023-12-18 14:44:28', '2023-12-18 14:53:15', '2');
INSERT INTO `users` VALUES ('13', '412164', '0', 'ADAS-1', 'Non-Teaching', 'sample@gmail.com', '0', '$2y$10$1GgPurqn5UnIzqzyOcngKOoP4BEGbjkMkylUl2j/JP5MxRVU5c0gW', '123456789', null, '2023-12-19 03:26:29', '2023-12-19 03:26:29', '0');
INSERT INTO `users` VALUES ('14', '254362', '0', 'T1', 'Teaching', 'abiabi@gmail.com', '1', '$2y$10$tzMz65jsZLwSf63OqL4skukEjhdLDQtRIAT0Gem5.r5uPMf64ya4u', '123456789', null, '2023-12-19 03:33:34', '2024-02-24 23:14:36', '4');
INSERT INTO `users` VALUES ('16', '275193', '0', 'ADAS-1', 'Non-Teaching', 'youtube@gmail.com', '0', '$2y$10$16kY7QvrTEgZxyLJGouuHuNZRLkrD0kGgXMzaceuSHPGXbeJkBn/a', '123456789', null, '2023-12-19 03:59:25', '2023-12-19 03:59:25', '0');
INSERT INTO `users` VALUES ('17', '537264', '0', 'T2', 'Teaching', 'sample1@gmail.com', '1', '$2y$10$q/.gpQ9u5SIgYquzgrIwjuQZRhuoS3npTECHeXtvhLlxsODlQBL5e', '123456789', null, '2023-12-19 05:16:50', '2024-01-27 07:14:06', '1');
INSERT INTO `users` VALUES ('19', '875577', '0', 'T1', 'Teaching', 'Belanojanziel0@gmail.com', '0', '$2y$10$vZYOVDCcsHFqyyH2dmu86Oq5jdrX3xszkbRdvN/kypGuuNNYBDDQG', '88888888', null, '2023-12-19 05:34:56', '2023-12-19 05:34:56', '0');
INSERT INTO `users` VALUES ('20', '200875', '0', 'ADAS-1', 'Non-Teaching', 'gagoronel@gmail.com', '1', '$2y$10$tMtPXBlJebZoufFY1TZhJu6UUduW7qZ3iC9F8S.KVWFe/0l4/qO0S', '123456789', null, '2023-12-19 06:08:18', '2024-01-31 09:58:40', '1');
INSERT INTO `users` VALUES ('22', '12345', '0', 'T1', 'Teaching', null, '1', '$2y$10$xjQ7w2XZ/SZ0OdzZxQKLKO4.0fD.AG6.VZ10gj0YxhZ9b46jpOLo6', '123456789', null, null, '2024-01-27 07:27:06', '2');
INSERT INTO `users` VALUES ('23', '205559', '0', 'ADAS-1', 'Non-Teaching', 'okongcute@gmail.com', '1', '$2y$10$5rjmQAKAB2oUweoi7h7s.eTfqaJmNCDeZ2fbn1bvdeLYYOJ3iCTLe', '123456789', null, '2024-01-04 08:51:01', '2024-01-05 11:55:13', '1');
INSERT INTO `users` VALUES ('24', '1234', '0', 'T1', 'Teaching', 'smaplegmail@gmail.com', '0', '$2y$10$2mH1xRLpkZeNbDWjcZkaAeqTqGhSaQwQoGY5YaGDaO7TXtdW1.ZHi', '123456789', null, '2024-01-05 11:49:29', '2024-01-05 11:49:29', '0');
INSERT INTO `users` VALUES ('25', '102942', '0', 'T2', 'Teaching', 'danical@gmail.com', '1', '$2y$10$E2NvDqR.4gnt44KsCNa7CuXahCs0NvR/nLZjhl46q6lV3Pg9.xCLm', '123456789', null, '2024-01-11 06:47:30', '2024-01-11 06:50:24', '1');
INSERT INTO `users` VALUES ('26', '200912', '0', 'ADAS-1', 'Non-Teaching', 'xanderford@gmail.com', '1', '$2y$10$3PKu4UIxx7Mfwjdaj2HjnO5dxwDNccJIv/GWxDQHbuA4ObD5YSlhC', '123456789', null, '2024-01-12 00:56:49', '2024-01-27 07:21:29', '1');
INSERT INTO `users` VALUES ('27', '105291', '0', 'T2', 'Teaching', 'marjunpucot@gmail.com', '1', '$2y$10$HzZY/dIOMnkrqZycs.OT9OBgsVkt4iPzXw9uRF1.HRW/u33y7jpMW', '123456789', null, '2024-01-12 01:02:13', '2024-01-17 08:41:26', '1');
INSERT INTO `users` VALUES ('28', '105292', '0', 'MT1', 'Teaching', 'erictecson@gmail.com', '1', '$2y$10$gVbr18ACELA5n7E8038oIerXeSFaN6HlXjpoimfisYQqOy/fXgp.a', '123456789', null, '2024-01-18 02:37:09', '2024-01-18 02:38:23', '1');
INSERT INTO `users` VALUES ('29', '105294', '0', 'T2', 'Teaching', 'dhenzbanico@gmail.com', '2', '$2y$10$S3tUKUm37xx/UKplhI6FIu9CXrzyNXhZPLsQUvWjeyRTRc77qLypm', '123456789', null, '2024-01-19 03:40:07', '2024-01-19 03:40:30', '1');
INSERT INTO `users` VALUES ('30', '123690', '0', 'T1', 'Teaching', 'ChoupaKou@gmail.com', '1', '$2y$10$vbvfPReLrNosE.rzR.79HePzAP5lT0tg06D6HxzyNDWz5Kf8j8Ru.', '123456789', null, '2024-01-21 02:27:45', '2024-01-21 02:33:43', '1');
