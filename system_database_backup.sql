-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: system_database
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bikes`
--

DROP TABLE IF EXISTS `bikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bikes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `bike_type` varchar(100) NOT NULL,
  `is_electric` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_taken` tinyint(1) NOT NULL DEFAULT 0,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bikes`
--

LOCK TABLES `bikes` WRITE;
/*!40000 ALTER TABLE `bikes` DISABLE KEYS */;
INSERT INTO `bikes` VALUES (1,'Canyon','Torque','Enduro','no',150.00,0,'{\n    \"frame_size\": \"L\",\n    \"wheel_size\": \"27.5\",\n    \"color\": \"Zielony\"\n}','2025-01-07 23:21:53'),(2,'Dartmoor','Primal Intro','Trail','no',150.00,0,'{\n    \"frame_size\": \"M\",\n    \"wheel_size\": \"27.5\",\n    \"color\": \"Czarny\\/Zielony\"\n}','2025-01-07 23:24:52'),(3,'Canyon','Grand Canyon ON 9','Górski','yes',200.00,0,'{\n    \"frame_size\": \"M\",\n    \"wheel_size\": \"29\",\n    \"color\": \"Szary\"\n}','2025-01-07 23:44:40');
/*!40000 ALTER TABLE `bikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vin` varchar(255) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `year_of_production` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_taken` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vin` (`vin`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'1HGCM82633A123456','Honda','Civic',2004,200.00,'{\n    \"body_type\": \"Hatchback\",\n    \"seats\": \"5\"\n}','2025-01-03 16:58:31',0),(2,'1HGCM82633A423456','Audi','A4',2014,350.00,'{\n    \"body_type\": \"Sedan\",\n    \"seats\": \"5\"\n}','2025-01-03 16:59:51',0),(3,'JTDKB20U987654321','Lamborghini','Huracan',2016,2000.00,'{\n    \"body_type\": \"Coupe\",\n    \"seats\": \"2\"\n}','2025-01-03 18:26:57',0),(4,'JTDKC10U987654321','Toyota','Supra',1992,500.00,'{\n    \"body_type\": \"Coupe\",\n    \"seats\": \"4\"\n}','2025-01-03 18:31:16',0),(5,'1HGCM896AAA113456','Honda','CRX',1990,300.00,'{\n    \"body_type\": \"Hatchback\",\n    \"seats\": \"4\"\n}','2025-01-03 18:42:23',0),(6,'9HGCGG2633A123456','Honda','Legend',1990,500.00,'{\n    \"body_type\": \"Sedan\",\n    \"seats\": \"5\"\n}','2025-01-03 18:53:03',0),(7,'214D1HBAT11PP1112','Nissan','Skyline',1999,3000.00,'{\n    \"body_type\": \"Coupe\",\n    \"seats\": \"4\"\n}','2025-01-03 19:01:44',0),(8,'WVWZZZ1KZ3W001234','Mercedes-Benz','CLA200',2016,700.00,'{\n    \"body_type\": \"Sedan\",\n    \"seats\": \"5\"\n}','2025-01-03 19:03:26',0),(9,'1FA6P8TH5J5183725','Audi','A6',2017,350.00,'{\n    \"body_type\": \"Kombi\",\n    \"seats\": \"5\"\n}','2025-01-03 19:04:11',0),(10,'JTDKB11U987654321','Toyota','Yaris',1999,80.00,'{\n    \"body_type\": \"Hatchback\",\n    \"seats\": \"5\"\n}','2025-01-04 13:03:32',0),(11,'2A4GP44R84R179999','BMW','330d',2015,400.00,'{\n    \"body_type\": \"Sedan\",\n    \"seats\": \"5\"\n}','2025-01-04 15:46:19',0),(12,'3GNABMWV0JL217689','BMW','M3',2020,1200.00,'{\n    \"body_type\": \"Sedan\",\n    \"seats\": \"5\"\n}','2025-01-04 15:50:17',0),(13,'MN1354DDEFSENG09L','Mini','Cooper S',2006,400.00,'{\n    \"body_type\": \"Hatchback\",\n    \"seats\": \"4\"\n}','2025-01-07 23:37:57',0);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorcycles`
--

DROP TABLE IF EXISTS `motorcycles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motorcycles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vin` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year_of_production` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `is_taken` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vin` (`vin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorcycles`
--

LOCK TABLES `motorcycles` WRITE;
/*!40000 ALTER TABLE `motorcycles` DISABLE KEYS */;
INSERT INTO `motorcycles` VALUES (1,'HNDAAFR4321GDEFHG','Honda','Africa Twin',2020,400.00,'{\n    \"moto_type\": \"Adventure\",\n    \"engine\": \"1100\"\n}',0,'2025-01-05 21:57:52'),(2,'JS1GR7FA1P7101234','Suzuki','GSX-R 750',2006,500.00,'{\n    \"moto_type\": \"\\u015acigacz\",\n    \"engine\": \"750\"\n}',0,'2025-01-05 22:04:26'),(3,'JS1EJ11A5N6101234','Suzuki','Hayabusa',2000,500.00,'{\n    \"moto_type\": \"\\u015acigacz\",\n    \"engine\": \"1300\"\n}',0,'2025-01-07 23:40:55');
/*!40000 ALTER TABLE `motorcycles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_type` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'janusz.wasilewicz1@gmail.com','$2y$12$nZdu87jH7HLb6TMpZikd1OHwACgxiFleIcuto98TkPkcKlN8stijK','Janusz','Wasilewicz',1,'2024-12-14 16:09:06',0),(2,'kuba.marszalek0@gmail.com','$2y$12$YLBd2nloI2epxAaWyKu2V.AD9QeHYIl7Ii83dop3pxs0NCGZ9QvNm','Kuba','Marszalek',1,'2024-12-14 16:13:50',0),(3,'kuba.marszalek999@gmail.com','$2y$12$5I9nqsamyXEu4ZhE.5PIwu.MuBudI8ZuafYc.NXccVWWf.po92L7y','Jakub','Marszalek',0,'2024-12-15 16:19:47',0),(4,'kuba.marszalek05@gmail.com','$2y$12$EP4txhF1E7cnA3.gsx4YG.94n4du2tmj/xesSSSq9IWEdCdcMQeZa','Kuba','Marszalek',1,'2024-12-15 23:33:21',0),(5,'andrzej@gmail.com','$2y$12$FsycFiRfRMX.EjLylydLWOTfBjtudEnUa5Ts2Vbwznvp43CvRtX8a','Andrzej','Andrzejowski',1,'2024-12-16 14:46:38',0),(6,'Mariusz@gmail.com','$2y$12$1Zd73JbPr.JkqxBo8EDp4OjfUXCLG4RJql0auw0Rsm6LiMwCa7oCe','Mariusz','Mariuszewski',0,'2024-12-16 14:48:17',0),(7,'50cent@gmail.com','$2y$12$jh.idNu/q3U2DETASdlXTeFuE4MD8EKThjVeWnjUDRSzGB7d7k4Qq','Fifty','Cent',1,'2024-12-17 10:08:39',0),(8,'test@gmail.com','$2y$12$HGXyIblT8tTgTA3bAXby/Ol1lLqMaolCCOJ/6Whj/mhxJNPvv/7yS','totalny','szef',0,'2024-12-17 19:06:38',0),(9,'dawdaw','$2y$12$uSqhppsLpgcxkMmpmXYFFew8CNutYiOSmqhXF2NDJ2reM9F7FrDUy','wadwa','dwadw',0,'2024-12-21 18:55:55',0),(10,'www','$2y$12$GK5VpEcrq01wFvkgApXexu9xltpXd6YoKZ15pR6X/0BfzINa4dT66','wwww','wwww',1,'2024-12-22 11:41:24',0),(11,'janusz.kowalski@gmail.com','$2y$12$zmQVpQR2.EaERUelxNAO3.AcXtQGU5ueo1cHsGPTaQ2Xf5TrVr74m','Janusz','Kowalski',1,'2024-12-23 10:54:29',0),(12,'testowyemail@gmail.com','$2y$12$H.Kz8pAMF0AkVqJcr4156upB1dqkrwed7l8sxYcj5MgzaG3fpj0T.','test','test',1,'2024-12-23 10:56:47',0),(13,'kaktus.jacek@wp.pl','$2y$12$jah1AZn5UlrTkwRS1RPBzeKyysbs0KU8oMcuYCyO62jYzsXPLrEZ2','Jacek','Kaktus',0,'2024-12-23 11:04:18',0),(14,'tobiasz.joint@gmail.com','$2y$12$dfd/7KtYv8RrlWMtcwVXs.7teGpN0Yj5SyycMOFXfKUnsiUdz/pze','Tobiasz','Skrecik',0,'2024-12-23 11:16:47',0),(15,'testowyemail1@gmail.com','$2y$12$g68EEREXhgSvYNYKJ0OcI.4qbla.QmATiHBJTssfMgpp2mzLnav7C','Janusz','Nowak',0,'2024-12-28 10:50:05',0),(16,'admin@gmail.com','$2y$12$Ect0CT9YFPOu4VT7deMvBe9sCGU6q0PQoE/zvxBH9XvOa76vEilN6','Admin','Admin',1,'2024-12-28 12:09:15',1),(17,'dawiddawid1@gmail.com','$2y$12$izBffFaaNSvdOfPvvI.36e5JKCjK122KdO594UqFubxCtAMqwHGia','Dawid','Sliwka',0,'2024-12-28 12:15:13',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-23 18:12:42
