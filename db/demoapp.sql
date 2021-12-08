/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.14-MariaDB : Database - demoapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`demoapp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

/*Table structure for table `aplikasis` */

DROP TABLE IF EXISTS `aplikasis`;

CREATE TABLE `aplikasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `aplikasis` */

insert  into `aplikasis`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Demo App',NULL,NULL);

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `companies` */

insert  into `companies`(`id`,`name`,`kota`,`alamat`,`telp`,`email`,`created_at`,`updated_at`) values 
(1,'PT. DEMO APP','bandung','Jalan Bandung raya ','087837873287','demo@gmail.com',NULL,NULL);

/*Table structure for table `divisis` */

DROP TABLE IF EXISTS `divisis`;

CREATE TABLE `divisis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `divisis` */

insert  into `divisis`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'BUSSINES',NULL,NULL);

/*Table structure for table `group_menus` */

DROP TABLE IF EXISTS `group_menus`;

CREATE TABLE `group_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `group_menus` */

insert  into `group_menus`(`id`,`order`,`name`,`created_at`,`updated_at`) values 
(1,2,'Pengaturan',NULL,NULL),
(2,1,'Master','2020-10-15 13:34:35','2020-10-15 13:34:35'),
(3,NULL,'Transaksi','2020-10-17 23:45:42','2020-10-17 23:45:42');

/*Table structure for table `jabatans` */

DROP TABLE IF EXISTS `jabatans`;

CREATE TABLE `jabatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jabatans` */

insert  into `jabatans`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'ADMINISTRATOR',NULL,NULL),
(2,'MARKETING','2020-10-16 14:00:30','2020-10-16 14:00:30'),
(3,'PIMPINAN CABANG','2020-10-16 14:00:54','2020-10-16 14:00:54'),
(4,'ADMIN','2020-10-16 15:27:28','2020-10-16 15:27:28');

/*Table structure for table `kantors` */

DROP TABLE IF EXISTS `kantors`;

CREATE TABLE `kantors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kantors` */

insert  into `kantors`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'KANTOR PUSAT',NULL,NULL);

/*Table structure for table `menu_users` */

DROP TABLE IF EXISTS `menu_users`;

CREATE TABLE `menu_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_group_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu_users` */

insert  into `menu_users`(`id`,`user_id`,`id_jabatan`,`id_group_menu`,`id_menu`,`created_at`,`updated_at`) values 
(1,1,1,'1,2,3','2,7,1,3,4,5,8,9,11',NULL,'2020-10-17 23:55:00'),
(3,3,2,'3','11',NULL,'2020-10-19 14:37:33'),
(8,4,3,'3','11','2020-10-17 15:11:13','2020-10-19 14:37:20');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_group_menu` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`id_group_menu`,`name`,`route`,`created_at`,`updated_at`) values 
(1,1,'Group Menu','groupmenu.index',NULL,NULL),
(2,1,'User','user.index',NULL,NULL),
(3,2,'Jabatan','jabatan.index','2020-10-15 14:19:36','2020-10-15 14:19:36'),
(4,2,'Divisi','divisi.index','2020-10-15 14:21:25','2020-10-15 14:21:25'),
(5,2,'Rank','rank.index','2020-10-15 14:23:32','2020-10-15 14:23:32'),
(7,1,'Menu','menu.index',NULL,NULL),
(8,2,'Unit','unit.index','2020-10-16 08:59:29','2020-10-16 08:59:29'),
(9,2,'Kantor','kantor.index','2020-10-16 08:59:58','2020-10-16 08:59:58'),
(11,3,'Ticketing','tiket.index','2020-10-17 23:46:25','2020-10-17 23:46:25');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2020_10_05_091107_create_divisis_table',1),
(4,'2020_10_05_091121_create_jabatans_table',1),
(5,'2020_10_05_091135_create_units_table',1),
(6,'2020_10_05_091147_create_ranks_table',1),
(7,'2020_10_05_091200_create_kantors_table',1),
(8,'2020_10_05_101036_create_menus_table',1),
(9,'2020_10_05_101053_create_group_menus_table',1),
(10,'2020_10_05_101456_create_menu_users_table',1),
(11,'2020_10_17_152513_create_companies_table',2),
(12,'2020_10_17_154037_create_aplikasis_table',3);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('pamuji.eko@act.id','$2y$10$UTm3m2ZHVVAu0x7KRuT.Z.n22NrSglQ7tJHAg3uM2780wOuPvAN2a','2020-10-17 15:36:02');

/*Table structure for table `ranks` */

DROP TABLE IF EXISTS `ranks`;

CREATE TABLE `ranks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ranks` */

insert  into `ranks`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'DIREKTUR',NULL,NULL),
(2,'MANAGER',NULL,NULL),
(3,'STAFF',NULL,NULL);

/*Table structure for table `ticket_replies` */

DROP TABLE IF EXISTS `ticket_replies`;

CREATE TABLE `ticket_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` longtext COLLATE utf8_unicode_ci NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `ticket_replies` */

insert  into `ticket_replies`(`id`,`ticket_id`,`user_id`,`reply`,`files`,`created_at`,`updated_at`) values 
(25,23,1,'tesssssssss',NULL,'2020-10-19 14:27:17','2020-10-19 14:27:17'),
(26,23,4,'ya saya ingin',NULL,'2020-10-19 14:34:32','2020-10-19 14:34:32'),
(27,23,4,'tesssss',NULL,'2020-10-19 14:35:10','2020-10-19 14:35:10'),
(28,23,1,'baik',NULL,'2020-10-19 14:35:59','2020-10-19 14:35:59'),
(29,25,1,'hayyyyyyy',NULL,'2020-10-19 14:39:35','2020-10-19 14:39:35'),
(30,25,1,'dfsdfsdf',NULL,'2020-10-19 14:39:44','2020-10-19 14:39:44'),
(31,25,1,'dsfsfasf',NULL,'2020-10-19 14:39:58','2020-10-19 14:39:58'),
(32,25,3,'ewrwerwerwer',NULL,'2020-10-19 14:40:28','2020-10-19 14:40:28'),
(33,25,3,'xcvxv',NULL,'2020-10-19 14:42:59','2020-10-19 14:42:59'),
(34,25,3,'xvdfx dhsfkshfkshdf sdkfhdsjkcnzkcjnk dzjclfksfewsf we',NULL,'2020-10-19 14:43:09','2020-10-19 14:43:09'),
(35,24,1,'tessdsdsd',NULL,'2020-10-24 16:49:19','2020-10-24 16:49:19'),
(36,24,4,'tesdsdsdsd',NULL,'2020-10-24 16:50:50','2020-10-24 16:50:50'),
(37,24,1,'dfgdfghdfh',NULL,'2020-10-24 17:07:33','2020-10-24 17:07:33');

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `viewed` int(1) NOT NULL DEFAULT 0,
  `client_viewed` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tickets` */

insert  into `tickets`(`id`,`code`,`user_id`,`subject`,`details`,`files`,`status`,`viewed`,`client_viewed`,`created_at`,`updated_at`) values 
(23,10000019,4,'dsdfsf','fsfsaf','[{\"name\":\"demo.jpg\",\"path\":\"uploads\\/support_tickets\\/589NWN4hpsPJHZrqcsm9FMFcXe2FmRcMIgDPi5WP.jpeg\"}]','solved',1,0,'2020-10-19 21:35:59','2020-10-19 14:35:59'),
(24,1000002009,4,'sdfsd','dsfsdfsd','[{\"name\":\"dias.jpeg\",\"path\":\"uploads\\/support_tickets\\/x9BaORkbl5NfXu8v4F1U5tSiI6iQmrB8Z09v4k1K.jpeg\"}]','solved',1,1,'2020-10-25 00:08:48','2020-10-24 17:08:48'),
(25,1000002015,3,'dsfsdfsd','fdfdfsdfdsf',NULL,'pending',1,1,'2020-10-24 23:47:05','2020-10-24 16:47:05');

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kantor` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `units` */

insert  into `units`(`id`,`id_kantor`,`name`,`created_at`,`updated_at`) values 
(1,1,'JAKARTA PUSAT',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kantor` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_rank` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_induk` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_nik_unique` (`nik`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`nik`,`name`,`email`,`email_verified_at`,`password`,`id_kantor`,`id_unit`,`id_divisi`,`id_jabatan`,`id_rank`,`remember_token`,`user_id_induk`,`status`,`created_at`,`updated_at`) values 
(1,'admin','321312','RAMELAN EKO PAMUJI','pamuji.eko@act.id',NULL,'$2y$10$tJkECV31uDXqMCfRXWHRquLUJwPPRrKOxfQDhJLKYaAS4IowfLNZy',1,1,1,1,1,NULL,0,0,'2020-10-15 13:25:47','2020-10-17 05:05:28'),
(3,'marketing','53272432','MEME','marketing@gmail.com',NULL,'$2y$10$FwmB.IZiKwFD5HxOcWYFE.ZiNanJXJWcGRqdOVWrZXCcbSKb1JOvW',1,1,1,2,3,NULL,1,0,'2020-10-16 14:40:10','2020-10-16 15:03:39'),
(4,'pc','32424124','PIMPINAN CABANG','pc@gmail.com',NULL,'$2y$10$48SJkHQrGPlNpLJdK1m9T.5I8irX7y2TpDQLqIEd2YU6wcjh4Uipu',1,1,1,3,3,NULL,NULL,0,'2020-10-16 15:36:05','2020-10-17 15:20:28');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
