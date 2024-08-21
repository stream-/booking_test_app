/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.39-0ubuntu0.20.04.1 : Database - booking
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`booking` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `booking`;

/*Table structure for table `booking_data` */

DROP TABLE IF EXISTS `booking_data`;

CREATE TABLE `booking_data` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hall_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `booking_begin` datetime DEFAULT NULL,
  `booking_end` datetime DEFAULT NULL,
  `is_booked` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `hall_id` (`hall_id`),
  CONSTRAINT `booking_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_data_ibfk_2` FOREIGN KEY (`hall_id`) REFERENCES `halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `booking_data` */

insert  into `booking_data`(`id`,`hall_id`,`user_id`,`booking_begin`,`booking_end`,`is_booked`) values 
(1,1,1,'2024-08-21 00:00:00','2024-08-22 00:00:00',NULL),
(6,2,1,'2024-08-22 00:00:00','2024-08-23 00:00:00',NULL);

/*Table structure for table `halls` */

DROP TABLE IF EXISTS `halls`;

CREATE TABLE `halls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `hall_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hall_description` text COLLATE utf8mb4_unicode_ci,
  `capacity` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `halls` */

insert  into `halls`(`id`,`hall_name`,`hall_description`,`capacity`) values 
(1,'hall','descr',5000),
(2,'hall2','best',5000);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `auth_key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`middlename`,`lastname`,`email`,`password`,`user_type`,`auth_key`,`created_at`,`updated_at`) values 
(1,'Eugene','','Furtat','eugenestream@gmail.com','$2y$13$fOlHESdwxttqlTLBE5mFZemIVHKO.gvmIpmie610INO.k8mnbyp4G','user',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
