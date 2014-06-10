CREATE DATABASE  IF NOT EXISTS `mobile` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `mobile`;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: mobile
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `device_evaluation`
--

DROP TABLE IF EXISTS `device_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_evaluation` (
  `id_device` int(11) NOT NULL,
  `id_evaluation` int(11) NOT NULL COMMENT 'connects devices with a custom evaluation',
  KEY `fk_device_evaluation_1_idx` (`id_device`),
  KEY `fk_device_evaluation_2_idx` (`id_evaluation`),
  CONSTRAINT `fk_device_evaluation_1` FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`) ON DELETE NO ACTION,
  CONSTRAINT `fk_device_evaluation_2` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_evaluation`
--

LOCK TABLES `device_evaluation` WRITE;
/*!40000 ALTER TABLE `device_evaluation` DISABLE KEYS */;
INSERT INTO `device_evaluation` VALUES (3,1);
/*!40000 ALTER TABLE `device_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id_device` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imei` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `iddevices_UNIQUE` (`id_device`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'035000985123',NULL),(2,NULL,'035000985123'),(3,NULL,'035000985124');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation_test`
--

DROP TABLE IF EXISTS `evaluation_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluation_test` (
  `id_evaluation` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  PRIMARY KEY (`id_evaluation`,`id_test`),
  KEY `fk_evaluation_test_2_idx` (`id_test`),
  CONSTRAINT `fk_evaluation_test_1` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluation_test_2` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id_test`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation_test`
--

LOCK TABLES `evaluation_test` WRITE;
/*!40000 ALTER TABLE `evaluation_test` DISABLE KEYS */;
INSERT INTO `evaluation_test` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14);
/*!40000 ALTER TABLE `evaluation_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluations` (
  `id_evaluation` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'consist of multiple tests, this structure is implemented so that you can set special set of tests for some specific devices.',
  PRIMARY KEY (`id_evaluation`),
  UNIQUE KEY `id_evaluation_UNIQUE` (`id_evaluation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` VALUES (1,'Standar','Test all basic features, including some sensors.'),(2,'Touch events','Checks for tap, double tap, pinch in and pinch out'),(3,'Accelerometers','Checks for the resposniveness of the accelerometer in its 3 axis \"x,y and z\"');
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id_result` int(11) NOT NULL AUTO_INCREMENT,
  `test_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_device` int(11) NOT NULL,
  `id_status_test` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_status_evaluation` int(11) NOT NULL,
  `id_evaluation` int(11) NOT NULL,
  PRIMARY KEY (`id_result`),
  KEY `fk_results_1_idx` (`id_device`),
  KEY `fk_results_2_idx` (`id_evaluation`),
  KEY `fk_results_3_idx` (`id_test`),
  KEY `fk_results_4_idx` (`id_status_test`),
  KEY `fk_results_5_idx` (`id_status_evaluation`),
  CONSTRAINT `fk_results_1` FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_2` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_3` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id_test`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_4` FOREIGN KEY (`id_status_test`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_5` FOREIGN KEY (`id_status_evaluation`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'passed'),(2,'failed'),(3,'not performed');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `action` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'contains the different tests that can be performed, i.e. tap, double tap, swipes, pinches and more.',
  `description` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'Tap',NULL,'Single tap on screen detection'),(2,'Double tap',NULL,'Double tap on screen detection'),(3,'Swipe left',NULL,'Swipe left for at least 75px'),(4,'Swipe right',NULL,'Swipe right for at least 75px'),(5,'Swipe up',NULL,'Swipe up for at least 75px'),(6,'Swipe down',NULL,'Swipe down for at least 75px'),(7,'Pinch in',NULL,'Pinch in for at least 75px'),(8,'Pinch out',NULL,'Pinch out for at least 75px'),(9,'Accelerometer +X',NULL,'Accelerometer reach value 7 or more in x axis'),(10,'Accelerometer -X',NULL,'Accelerometer reach value -7 or more in x axi'),(11,'Accelerometer +Y',NULL,'Accelerometer reach value 7 or more in y axis'),(12,'Accelerometer -Y',NULL,'Accelerometer reach value -7 or more in y axi'),(13,'Accelerometer +Z',NULL,'Accelerometer reach value 7 or more in z axis'),(14,'Accelerometer -Z',NULL,'Accelerometer reach value -7 or more in z axi');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-02 16:39:04
