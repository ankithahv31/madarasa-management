/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.7.23-log : Database - madarasa_management_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`madarasa_management_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `madarasa_management_db`;

/*Table structure for table `admission_form` */

DROP TABLE IF EXISTS `admission_form`;

CREATE TABLE `admission_form` (
  `add_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `father_mother_name` varchar(50) NOT NULL,
  `home_name` varchar(200) NOT NULL,
  `pname_add_contact` text NOT NULL,
  `prnt_relation_w_stud` varchar(100) NOT NULL,
  `parent_job` varchar(100) NOT NULL,
  `stud_dob` varchar(30) NOT NULL,
  `stud_admn_class` varchar(10) NOT NULL,
  `body_mark` varchar(200) NOT NULL,
  `prev_madras_name` text NOT NULL,
  `acceptance_no_date` varchar(100) NOT NULL,
  `tc_date` varchar(100) NOT NULL,
  `image_name` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `student_class` int(11) NOT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `admission_form` */

insert  into `admission_form`(`add_id`,`fname`,`mname`,`lname`,`gender`,`email`,`contact`,`father_mother_name`,`home_name`,`pname_add_contact`,`prnt_relation_w_stud`,`parent_job`,`stud_dob`,`stud_admn_class`,`body_mark`,`prev_madras_name`,`acceptance_no_date`,`tc_date`,`image_name`,`status`,`student_class`) values (1,'firts','m','m','Male','arthikharshap@gmail.com\r\n',NULL,'ds','sss','ssqsw232','sss','wcdc','2023-06-28','1','wedee','wdwedwdw','wdwedwdwd','wdwedweewdwe','Admission-85752367detailed-travel-logo_23-2148616554_preview_rev_1.png',1,1),(2,'name','c','c','Other','karthikkumarh733@gmail.com',NULL,'wfefef','wefqwefqe','wqefqwefqwffasc2134124124','wefqwefq','wfwefqwefqwqw','2023-06-29','1','qwefwqsadcweqf','eqwfqwqfqwqeq','wfqwefqwefqwfeqwwq23232fdgeefw','ew4234523r23eegwf','Admission-17077089detailed-travel-logo_23-2148616554.jpg',1,1),(3,'refe','s','rer','Male','arthikharshap@gmail.com',NULL,'rfe','wefqwefqe','wfweer','sss','erfe','2023-06-25','3','erfevsd','dvdvevev','evevvevvsdvsx fver','erverevrerevv','Admission-25512262testimonial-3.jpg',1,6),(4,'name','m','c','Male','karthikkumarh733@gmail.com','1234567890','wfefef','wefqwefqe','des','sss','ss','2023-06-21','5','qwdwq','edwe','edwed','wdewd','Admission-64803807pexels-binyamin-mellish-186077.jpg',1,5),(5,'firts','m','c','Male','arthikharshap@gmail.com','1234567890','wfefef','wefqwefqe','wef','sss','wef','2023-06-24','9','ewf','wef','wef','we','Admission-8836552pexels-binyamin-mellish-186077.jpg',1,9),(6,'name','c','c','Female','karthigudigar@gmail.com','1234567890','wfefef','wefqwefqe','qwd','sss','wed','2023-06-30','8','ed','ewew','d','ed','Admission-21072847postoffice1.jpg',1,8);

/*Table structure for table `asign_class` */

DROP TABLE IF EXISTS `asign_class`;

CREATE TABLE `asign_class` (
  `assClass_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classid` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`assClass_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `asign_class` */

insert  into `asign_class`(`assClass_id`,`classid`,`staff_id`,`year`) values (1,1,1,4),(2,6,1,4),(3,11,1,4),(4,12,1,4),(5,1,1,2023),(6,6,1,2023),(7,8,1,2023),(8,11,1,2023),(9,12,1,2023);

/*Table structure for table `attendance` */

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `att_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `studentclass` int(11) NOT NULL,
  `attendance` int(11) NOT NULL DEFAULT '0',
  `attendnce_time` varchar(20) NOT NULL DEFAULT 'null',
  `date` varchar(20) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `temp` int(11) DEFAULT '0',
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `attendance` */

insert  into `attendance`(`att_id`,`student_id`,`studentclass`,`attendance`,`attendnce_time`,`date`,`staff_id`,`temp`) values (1,1,1,1,'15:35:58','2023-06-05',1,1),(2,2,1,0,'15:35:58','2023-06-05',1,1),(3,1,1,1,'16:26:00','2023-06-04',1,1),(4,2,1,1,'16:26:00','2023-06-04',1,1),(5,1,1,1,'16:26:30','2023-06-01',1,1),(6,2,1,1,'16:26:30','2023-06-01',1,1),(7,3,6,1,'16:38:02','2023-06-01',1,1),(8,1,1,0,'16:45:25','2023-06-06',1,1),(9,2,1,1,'16:45:25','2023-06-06',1,1),(10,3,6,0,'16:45:32','2023-06-06',1,1),(11,1,1,1,'10:56:48','2023-06-23',1,1),(12,2,1,1,'10:56:48','2023-06-23',1,1),(13,3,6,1,'10:57:16','2023-06-23',1,1);

/*Table structure for table `classes` */

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `classes` */

insert  into `classes`(`class_id`,`class`) values (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12);

/*Table structure for table `days` */

DROP TABLE IF EXISTS `days`;

CREATE TABLE `days` (
  `day_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `days` */

insert  into `days`(`day_id`,`day`) values (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),(5,'Friday'),(6,'Saturday');

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `evt_title` varchar(100) NOT NULL,
  `evt_date` varchar(30) NOT NULL,
  `evt_time` varchar(30) NOT NULL,
  `evt_venue` varchar(100) NOT NULL,
  `evt_discription` text NOT NULL,
  `evt_image` text NOT NULL,
  `evt_enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `event` */

insert  into `event`(`event_id`,`evt_title`,`evt_date`,`evt_time`,`evt_venue`,`evt_discription`,`evt_image`,`evt_enabled`) values (1,'sambram','2023-06-15','10:55','College Ground','des','Event-76044704pexels-lukas-349610.jpg',1),(2,'Sports meet','2023-06-21','21:24','College Ground','college sports meet on ground in mornig','Event-412812348.jpg',1),(3,'Events','2023-06-27','22:55','College Ground Near Stage','college function','Event-465886404.jpg',1),(4,'new Event','2023-06-17','17:15','College Ground','des','Event-79697111pexels-binyamin-mellish-186077.jpg',1),(5,'Sambram','2023-06-15','17:16','College Ground Near Stage','des','Event-5059148pexels-binyamin-mellish-186077.jpg',1),(6,'event','2023-06-14','17:19','College Ground Near Stage','des','Event-52815764mick-haupt-wVj8-0kVaaI-unsplash.jpg',1),(7,'event','2023-06-14','22:20','College Ground','werw','Event-1320905pexels-binyamin-mellish-186077.jpg',1),(8,'wer','2023-06-14','17:30','College Ground','fre','Event-37262016pexels-pixabay-259588.jpg',1),(9,'event','2023-06-26','17:32','College Ground','des','Event-73268152pexels-binyamin-mellish-1396122.jpg',1),(10,'rwe','2023-06-14','10:22','rr','rrrrt','Event-36981923postoffice1.jpg',1);

/*Table structure for table `leave_manage` */

DROP TABLE IF EXISTS `leave_manage`;

CREATE TABLE `leave_manage` (
  `leave_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `total_EL` int(11) DEFAULT NULL,
  `total_CL` int(11) DEFAULT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `leave_manage` */

insert  into `leave_manage`(`leave_id`,`staff_id`,`year`,`total_EL`,`total_CL`) values (1,1,2023,1,0);

/*Table structure for table `leave_types` */

DROP TABLE IF EXISTS `leave_types`;

CREATE TABLE `leave_types` (
  `T_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `T_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`T_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `leave_types` */

insert  into `leave_types`(`T_id`,`T_name`) values (1,'Earned Leave'),(2,'Casual Leave'),(3,'Loss Of Pay');

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `result_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `filename` text,
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `result` */

insert  into `result`(`result_id`,`class`,`year`,`filename`) values (1,2,'4','Result-42111561Synopsis-HomeProducts.docx'),(2,1,'4','Result-11567424expert_times (9).pdf'),(3,9,'4','Result-85805681synopsis-CarAccessaries.docx'),(4,6,'2','Result-61373756synopsis-CarAccessaries.docx');

/*Table structure for table `sloats` */

DROP TABLE IF EXISTS `sloats`;

CREATE TABLE `sloats` (
  `slot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Slot` varchar(20) NOT NULL,
  PRIMARY KEY (`slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `sloats` */

insert  into `sloats`(`slot_id`,`Slot`) values (1,'09:00-10:00'),(2,'10:05-11:00'),(3,'11:05-12:30'),(4,'01:30-02:30'),(5,'02:35-03:30'),(6,'03:30-04:30');

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `flag` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`id`,`name`,`contact`,`email`,`password`,`address`,`image`,`flag`) values (1,'Karthik','7338357925','karthigudigar@gmail.com','12','Address','Staff-66528795team-1.jpg',1),(2,'Harsha','9535063437','karthikkumarh733@gmail.com','12','Address','Staff-51525450team-4.jpg',1),(3,'Kiran','7338357529','karthikkumarhd733@gmail.com','12','Address','Staff-37442686testimonial-2.jpg',1),(4,'Preetham','9535013232','karthigudigddar@gmail.com','12','Address','Staff-59964660team-3.jpg',1),(5,'Karthik','7338357923','karthigssudigar@gmail.com','134','dfe','Staff-454161377.jpg',1),(6,'Smitha','9535013455','karthikgudigar733@gmail.com','1234','Address','Staff-38310672testimonial-1.jpg',1);

/*Table structure for table `staff_leave` */

DROP TABLE IF EXISTS `staff_leave`;

CREATE TABLE `staff_leave` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `from_date` varchar(20) DEFAULT NULL,
  `to_date` varchar(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `staff_leave` */

insert  into `staff_leave`(`l_id`,`staff_id`,`from_date`,`to_date`,`type`,`days`,`description`,`status`) values (1,1,'2023-06-24','2023-06-26',1,3,'des',1),(2,1,'2023-08-01','2023-08-05',2,5,'Have a function in my home',2),(3,1,'2023-06-30','2023-07-04',3,10,'days',1),(4,1,'2023-06-24','2023-06-30',1,1,'d',2),(5,1,'2023-06-25','2023-06-26',1,10,'des',2),(6,1,'2023-06-24','2023-06-28',1,10,'des',0),(7,1,'2023-06-24','2023-06-26',3,32,'des',2),(8,1,'2023-06-24','2023-06-26',3,32,'des',1),(9,1,'2023-06-29','2023-07-06',3,34,'des',0);

/*Table structure for table `subject` */

DROP TABLE IF EXISTS `subject`;

CREATE TABLE `subject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(100) NOT NULL,
  `class` varchar(10) NOT NULL,
  `is_enbled` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `subject` */

insert  into `subject`(`id`,`sub_name`,`class`,`is_enbled`) values (1,'sub1','1',1),(2,'sub2','2',1),(3,'sub3','3',1),(4,'sub4','4',1),(5,'sub5','5',1),(6,'sub6','1',1),(7,'sub7','1',1),(8,'sub8','2',1),(9,'sub9','1',1),(10,'sub10','3',1);

/*Table structure for table `time_table` */

DROP TABLE IF EXISTS `time_table`;

CREATE TABLE `time_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `satff_id` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `sloat_id` varchar(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `class` varchar(20) DEFAULT NULL,
  `is_enabled` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `time_table` */

insert  into `time_table`(`id`,`satff_id`,`subject_id`,`sloat_id`,`day`,`class`,`is_enabled`) values (1,'1','4','3','1','4',1),(2,'1','4','4','2','4',1),(3,'1','4','5','4','4',1),(4,'1','5','2','1','5',1),(5,'1','5','3','1','5',1),(6,'1','5','3','2','5',1);

/*Table structure for table `year` */

DROP TABLE IF EXISTS `year`;

CREATE TABLE `year` (
  `year_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `year` */

insert  into `year`(`year_id`,`year`) values (1,'2020'),(2,'2021'),(3,'2022'),(4,'2023'),(5,'2024'),(6,'2025');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
