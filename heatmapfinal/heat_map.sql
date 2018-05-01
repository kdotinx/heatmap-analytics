# MySQL-Front 3.2  (Build 8.0)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

# Host: localhost    Database: heat_map
# ------------------------------------------------------
# Server version 5.7.14

DROP DATABASE IF EXISTS `heat_map`;
CREATE DATABASE `heat_map` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `heat_map`;

#
# Table structure for table heat_analysis
#

CREATE TABLE `heat_analysis` (
  `domain_name` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `traffic_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`traffic_id`),
  KEY `domain_name` (`domain_name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

#
# Dumping data for table heat_analysis
#

INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:08',1);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:10',2);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:10',3);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:11',4);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:22',5);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:23',6);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:23',7);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:24',8);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:25',9);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:25',10);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:26',11);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:26',12);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:27',13);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:39',14);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:40',15);
INSERT INTO `heat_analysis` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21 12:58:40',16);


#
# Table structure for table heat_map
#

CREATE TABLE `heat_map` (
  `cordinate_id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(245) NOT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`cordinate_id`),
  KEY `domain_name` (`domain_name`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

#
# Dumping data for table heat_map
#

INSERT INTO `heat_map` VALUES (26,'http://localhost/heatmap/heatmap.php',361,147,'2017-04-21 12:58:08');
INSERT INTO `heat_map` VALUES (27,'http://localhost/heatmap/heatmap.php',473,32,'2017-04-21 12:58:10');
INSERT INTO `heat_map` VALUES (28,'http://localhost/heatmap/heatmap.php',365,381,'2017-04-21 12:58:10');
INSERT INTO `heat_map` VALUES (29,'http://localhost/heatmap/heatmap.php',949,517,'2017-04-21 12:58:11');
INSERT INTO `heat_map` VALUES (30,'http://localhost/heatmap/heatmap.php',938,277,'2017-04-21 12:58:22');
INSERT INTO `heat_map` VALUES (31,'http://localhost/heatmap/heatmap.php',931,105,'2017-04-21 12:58:23');
INSERT INTO `heat_map` VALUES (32,'http://localhost/heatmap/heatmap.php',624,69,'2017-04-21 12:58:23');
INSERT INTO `heat_map` VALUES (33,'http://localhost/heatmap/heatmap.php',377,45,'2017-04-21 12:58:24');
INSERT INTO `heat_map` VALUES (34,'http://localhost/heatmap/heatmap.php',272,365,'2017-04-21 12:58:25');
INSERT INTO `heat_map` VALUES (35,'http://localhost/heatmap/heatmap.php',646,489,'2017-04-21 12:58:25');
INSERT INTO `heat_map` VALUES (36,'http://localhost/heatmap/heatmap.php',938,333,'2017-04-21 12:58:26');
INSERT INTO `heat_map` VALUES (37,'http://localhost/heatmap/heatmap.php',966,158,'2017-04-21 12:58:26');
INSERT INTO `heat_map` VALUES (38,'http://localhost/heatmap/heatmap.php',1054,122,'2017-04-21 12:58:27');
INSERT INTO `heat_map` VALUES (39,'http://localhost/heatmap/heatmap.php',839,472,'2017-04-21 12:58:39');
INSERT INTO `heat_map` VALUES (40,'http://localhost/heatmap/heatmap.php',524,449,'2017-04-21 12:58:40');
INSERT INTO `heat_map` VALUES (41,'http://localhost/heatmap/heatmap.php',464,292,'2017-04-21 12:58:40');


#
# Table structure for table heat_support
#

CREATE TABLE `heat_support` (
  `fb_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(10) NOT NULL,
  `feedback` text NOT NULL,
  PRIMARY KEY (`fb_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table heat_support
#



#
# Table structure for table heat_user_info
#

CREATE TABLE `heat_user_info` (
  `email` varchar(150) NOT NULL,
  `password` varchar(120) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `user_type` varchar(10) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table heat_user_info
#

INSERT INTO `heat_user_info` VALUES ('harris.bastin@gmail.com','harris','harris','client');
INSERT INTO `heat_user_info` VALUES ('hethj@gg.mm','ewhr','e','client');
INSERT INTO `heat_user_info` VALUES ('jude@gmail.com','jude','jude','client');
INSERT INTO `heat_user_info` VALUES ('krishnamoorthy96@gmail.com','coastguar9','Krishna','client');
INSERT INTO `heat_user_info` VALUES ('sujithvs.think@gmail.com','sujithv','sujithvs','client');


#
# Table structure for table heat_website
#

CREATE TABLE `heat_website` (
  `domain_name` varchar(200) NOT NULL,
  `create_date` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `heat_image` text,
  PRIMARY KEY (`domain_name`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table heat_website
#

INSERT INTO `heat_website` VALUES ('http://gmail.com','2017-04-07','harris.bastin@gmail.com','/1704091414Apr17banner.jpg');
INSERT INTO `heat_website` VALUES ('http://localhost/heatmap/heatmap.php','2017-04-21','krishnamoorthy96@gmail.com','/4104072121Apr17Capture.jpg');
INSERT INTO `heat_website` VALUES ('http://www.ab.com','2017-04-20','krishnamoorthy96@gmail.com','/3004072121Apr17Capture.jpg');
INSERT INTO `heat_website` VALUES ('http://www.abcd.abc','2017-04-20','krishnamoorthy96@gmail.com','/1804062121Apr17Capture.JPG');
INSERT INTO `heat_website` VALUES ('http://www.facebook.com','2016-04-12','harris.bastin@gmail.com','/banner.jpg');
INSERT INTO `heat_website` VALUES ('http://www.facebook.in','2017-03-27','jude@gmail.com','/3204061414Apr17banner.jpg');
INSERT INTO `heat_website` VALUES ('http://www.google.com','2017-04-12','jude@gmail.com','/5704081111Apr17oil-website-screenshot.jpg');


#
#  Foreign keys for table heat_analysis
#

ALTER TABLE `heat_analysis`
  ADD FOREIGN KEY (`domain_name`) REFERENCES `heat_website` (`domain_name`) ON DELETE CASCADE;

#
#  Foreign keys for table heat_map
#

ALTER TABLE `heat_map`
  ADD FOREIGN KEY (`domain_name`) REFERENCES `heat_website` (`domain_name`) ON DELETE CASCADE ON UPDATE CASCADE;

#
#  Foreign keys for table heat_support
#

ALTER TABLE `heat_support`
  ADD FOREIGN KEY (`email`) REFERENCES `heat_user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

#
#  Foreign keys for table heat_website
#

ALTER TABLE `heat_website`
  ADD FOREIGN KEY (`email`) REFERENCES `heat_user_info` (`email`) ON DELETE CASCADE;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
