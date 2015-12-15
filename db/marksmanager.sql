-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2015 at 09:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marksmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_group`
--

CREATE TABLE IF NOT EXISTS `academic_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `academic_profile_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_academic_year_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_84weevcr1qq2yrxgt1awaac0o` (`academic_profile_id`),
  KEY `FK_s3gqtc2vg7u4okpsunj0sqljg` (`start_academic_year_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `academic_profile`
--

CREATE TABLE IF NOT EXISTS `academic_profile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_j988mg87d59joc7l1sxi4mxjw` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `academic_profile_subject`
--

CREATE TABLE IF NOT EXISTS `academic_profile_subject` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `academic_profile_id` bigint(20) NOT NULL,
  `presences_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_86f10wgvsdi8ql4dmjwey3v7p` (`academic_profile_id`),
  KEY `FK_6oefepo9dhwj4eltox8ns00jg` (`presences_id`),
  KEY `FK_4uw1vnuq9bdho5ksx43ia87t7` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE IF NOT EXISTS `academic_year` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `start_year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acl_class`
--

CREATE TABLE IF NOT EXISTS `acl_class` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_iy7ua5fso3il3u3ymoc4uf35w` (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acl_entry`
--

CREATE TABLE IF NOT EXISTS `acl_entry` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ace_order` int(11) NOT NULL,
  `acl_object_identity` bigint(20) NOT NULL,
  `audit_failure` bit(1) NOT NULL,
  `audit_success` bit(1) NOT NULL,
  `granting` bit(1) NOT NULL,
  `mask` int(11) NOT NULL,
  `sid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_ace_order` (`acl_object_identity`,`ace_order`),
  KEY `FK_i6xyfccd4y3wlwhgwpo4a9rm1` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acl_object_identity`
--

CREATE TABLE IF NOT EXISTS `acl_object_identity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `object_id_class` bigint(20) NOT NULL,
  `entries_inheriting` bit(1) NOT NULL,
  `object_id_identity` bigint(20) NOT NULL,
  `owner_sid` bigint(20) DEFAULT NULL,
  `parent_object` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_object_id_identity` (`object_id_class`,`object_id_identity`),
  KEY `FK_nxv5we2ion9fwedbkge7syoc3` (`owner_sid`),
  KEY `FK_6oap2k8q5bl33yq3yffrwedhf` (`parent_object`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acl_sid`
--

CREATE TABLE IF NOT EXISTS `acl_sid` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `principal` bit(1) NOT NULL,
  `sid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_principal` (`sid`,`principal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `university_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_4fse4d9lr9xm4d1wnx083xgq7` (`university_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `academic_profile_subject_id` bigint(20) NOT NULL,
  `first_professor_id` bigint(20) NOT NULL,
  `head_professor_id` bigint(20) NOT NULL,
  `season_id` bigint(20) NOT NULL,
  `second_professor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_4utavv4egxulq8hhxxnnrud3o` (`academic_profile_subject_id`),
  KEY `FK_f8cum8f43epf28qeo0gnnykk0` (`first_professor_id`),
  KEY `FK_9viqkogknj94glhm5ysqo58t3` (`head_professor_id`),
  KEY `FK_885p6n2q4usr2hsh5rjklk009` (`season_id`),
  KEY `FK_9me0tpytj6a8bv77tfeqf51ra` (`second_professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_season`
--

CREATE TABLE IF NOT EXISTS `exam_season` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `scientific_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_role`
--

CREATE TABLE IF NOT EXISTS `sec_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `authority` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_oah023x2ltqw09mdue7w0mcxb` (`authority`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sec_role`
--

INSERT INTO `sec_role` (`id`, `version`, `authority`) VALUES
(1, 0, 'ROLE_SUPER_ADMIN'),
(2, 0, 'ROLE_ADMIN'),
(3, 0, 'ROLE_PROFESSOR'),
(4, 0, 'ROLE_STUDENT');

-- --------------------------------------------------------

--
-- Table structure for table `sec_user`
--

CREATE TABLE IF NOT EXISTS `sec_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `account_expired` bit(1) NOT NULL,
  `account_locked` bit(1) NOT NULL,
  `enabled` bit(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_expired` bit(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_5ctbdrlf3eismye20vsdtk8w8` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sec_user`
--

INSERT INTO `sec_user` (`id`, `version`, `account_expired`, `account_locked`, `enabled`, `password`, `password_expired`, `username`) VALUES
(1, 0, b'0', b'0', b'1', '$2a$10$ix3iowKglzrm.wOsVw.ZS.RLOIAyEvWXJx94B/9.Nbj4H7TlsKM1q', b'0', 'super-admin');

-- --------------------------------------------------------

--
-- Table structure for table `sec_user_sec_role`
--

CREATE TABLE IF NOT EXISTS `sec_user_sec_role` (
  `sec_role_id` bigint(20) NOT NULL,
  `sec_user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`sec_role_id`,`sec_user_id`),
  KEY `FK_f1eew3u65ajs3e50xvacwgron` (`sec_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sec_user_sec_role`
--

INSERT INTO `sec_user_sec_role` (`sec_role_id`, `sec_user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `group_id` bigint(20) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_20su8ubuwt33je1a3ygal7wd6` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_result`
--

CREATE TABLE IF NOT EXISTS `student_exam_result` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `exam_date` datetime NOT NULL,
  `mark` int(11) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ipk4onr61il08jsd7um6b0v8w` (`exam_id`),
  KEY `FK_ltbbvcf9eogs7xa84o59n5vjo` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_presence`
--

CREATE TABLE IF NOT EXISTS `student_subject_presence` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `attended_laboratories` bit(1) NOT NULL,
  `attended_seminaries` bit(1) NOT NULL,
  `profile_subject_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `submitted_course_assignment` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_3mmfnyt8sqw6qvtqmas4qvjdn` (`profile_subject_id`),
  KEY `FK_5hmg6ofkgthmsm8ke8ea47rao` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `version` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_group`
--
ALTER TABLE `academic_group`
  ADD CONSTRAINT `FK_84weevcr1qq2yrxgt1awaac0o` FOREIGN KEY (`academic_profile_id`) REFERENCES `academic_profile` (`id`),
  ADD CONSTRAINT `FK_s3gqtc2vg7u4okpsunj0sqljg` FOREIGN KEY (`start_academic_year_id`) REFERENCES `academic_year` (`id`);

--
-- Constraints for table `academic_profile`
--
ALTER TABLE `academic_profile`
  ADD CONSTRAINT `FK_j988mg87d59joc7l1sxi4mxjw` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `academic_profile_subject`
--
ALTER TABLE `academic_profile_subject`
  ADD CONSTRAINT `FK_4uw1vnuq9bdho5ksx43ia87t7` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `FK_6oefepo9dhwj4eltox8ns00jg` FOREIGN KEY (`presences_id`) REFERENCES `student_subject_presence` (`id`),
  ADD CONSTRAINT `FK_86f10wgvsdi8ql4dmjwey3v7p` FOREIGN KEY (`academic_profile_id`) REFERENCES `academic_profile` (`id`);

--
-- Constraints for table `acl_entry`
--
ALTER TABLE `acl_entry`
  ADD CONSTRAINT `FK_fhuoesmjef3mrv0gpja4shvcr` FOREIGN KEY (`acl_object_identity`) REFERENCES `acl_object_identity` (`id`),
  ADD CONSTRAINT `FK_i6xyfccd4y3wlwhgwpo4a9rm1` FOREIGN KEY (`sid`) REFERENCES `acl_sid` (`id`);

--
-- Constraints for table `acl_object_identity`
--
ALTER TABLE `acl_object_identity`
  ADD CONSTRAINT `FK_6c3ugmk053uy27bk2sred31lf` FOREIGN KEY (`object_id_class`) REFERENCES `acl_class` (`id`),
  ADD CONSTRAINT `FK_6oap2k8q5bl33yq3yffrwedhf` FOREIGN KEY (`parent_object`) REFERENCES `acl_object_identity` (`id`),
  ADD CONSTRAINT `FK_nxv5we2ion9fwedbkge7syoc3` FOREIGN KEY (`owner_sid`) REFERENCES `acl_sid` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `FK_4fse4d9lr9xm4d1wnx083xgq7` FOREIGN KEY (`university_id`) REFERENCES `university` (`id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `FK_4utavv4egxulq8hhxxnnrud3o` FOREIGN KEY (`academic_profile_subject_id`) REFERENCES `academic_profile_subject` (`id`),
  ADD CONSTRAINT `FK_885p6n2q4usr2hsh5rjklk009` FOREIGN KEY (`season_id`) REFERENCES `exam_season` (`id`),
  ADD CONSTRAINT `FK_9me0tpytj6a8bv77tfeqf51ra` FOREIGN KEY (`second_professor_id`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `FK_9viqkogknj94glhm5ysqo58t3` FOREIGN KEY (`head_professor_id`) REFERENCES `professor` (`id`),
  ADD CONSTRAINT `FK_f8cum8f43epf28qeo0gnnykk0` FOREIGN KEY (`first_professor_id`) REFERENCES `professor` (`id`);

--
-- Constraints for table `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `FK_mw7fqu259ujbc08jyrlecjrm4` FOREIGN KEY (`id`) REFERENCES `sec_user` (`id`);

--
-- Constraints for table `sec_user_sec_role`
--
ALTER TABLE `sec_user_sec_role`
  ADD CONSTRAINT `FK_bshvqhdx8h9mb4rrbo1ahnp7q` FOREIGN KEY (`sec_role_id`) REFERENCES `sec_role` (`id`),
  ADD CONSTRAINT `FK_f1eew3u65ajs3e50xvacwgron` FOREIGN KEY (`sec_user_id`) REFERENCES `sec_user` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_20su8ubuwt33je1a3ygal7wd6` FOREIGN KEY (`group_id`) REFERENCES `academic_group` (`id`),
  ADD CONSTRAINT `FK_m4oyvjystgi94h8yo4v8oijrr` FOREIGN KEY (`id`) REFERENCES `sec_user` (`id`);

--
-- Constraints for table `student_exam_result`
--
ALTER TABLE `student_exam_result`
  ADD CONSTRAINT `FK_ipk4onr61il08jsd7um6b0v8w` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `FK_ltbbvcf9eogs7xa84o59n5vjo` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Constraints for table `student_subject_presence`
--
ALTER TABLE `student_subject_presence`
  ADD CONSTRAINT `FK_3mmfnyt8sqw6qvtqmas4qvjdn` FOREIGN KEY (`profile_subject_id`) REFERENCES `academic_profile_subject` (`id`),
  ADD CONSTRAINT `FK_5hmg6ofkgthmsm8ke8ea47rao` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
