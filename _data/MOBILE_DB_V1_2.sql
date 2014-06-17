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
  CONSTRAINT `fk_device_evaluation_1` FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`) ON DELETE CASCADE,
  CONSTRAINT `fk_device_evaluation_2` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_evaluation`
--

LOCK TABLES `device_evaluation` WRITE;
/*!40000 ALTER TABLE `device_evaluation` DISABLE KEYS */;
INSERT INTO `device_evaluation` VALUES (1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(2,1),(2,1),(2,1),(2,1),(2,3),(2,2),(1,1),(2,1),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(20,1),(2,2),(2,2),(2,3),(20,1),(2,3),(2,3),(2,2),(2,2),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(42,1),(42,1),(2,1),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(69,2),(69,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(70,1),(70,3),(70,3),(70,3),(70,2),(70,2),(76,1),(70,2),(76,1),(76,2),(76,2),(2,2),(2,1),(42,1),(2,1),(2,1),(42,1),(87,1),(1,1),(42,2),(90,2),(90,3),(42,2);
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
  `modelo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `marca` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `last_use` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `iddevices_UNIQUE` (`id_device`),
  UNIQUE KEY `imei_UNIQUE` (`imei`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'mine','123',NULL,NULL,'2014-06-16 15:51:32'),(2,NULL,'1234',NULL,NULL,'2014-06-13 21:12:44'),(20,NULL,'9182',NULL,NULL,'2014-06-11 21:03:49'),(42,NULL,'55302',NULL,NULL,'2014-06-16 23:08:29'),(69,NULL,'12834',NULL,NULL,'2014-06-12 19:38:30'),(70,NULL,'09876',NULL,NULL,'2014-06-13 18:18:00'),(76,NULL,'12734',NULL,NULL,'2014-06-13 18:23:24'),(87,NULL,'56473',NULL,NULL,'2014-06-13 22:47:35'),(90,NULL,'999',NULL,NULL,'2014-06-16 21:25:21');
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
INSERT INTO `evaluation_test` VALUES (1,1),(2,1),(1,2),(2,2),(1,3),(2,3),(1,4),(2,4),(1,5),(2,5),(1,6),(2,6),(1,7),(2,7),(1,8),(2,8),(1,9),(3,9),(1,10),(3,10),(1,11),(3,11),(1,12),(3,12),(1,13),(3,13),(1,14),(3,14);
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
  `time` int(3) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id_evaluation`),
  UNIQUE KEY `id_evaluation_UNIQUE` (`id_evaluation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
INSERT INTO `evaluations` VALUES (1,'Standard','Test all basic features, including some sensors.',20),(2,'Touch events','Checks for tap, double tap, pinch in and pinch out',15),(3,'Accelerometers','Checks for the resposniveness of the accelerometer in its 3 axis \"x,y and z\"',10);
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
  CONSTRAINT `fk_results_1` FOREIGN KEY (`id_device`) REFERENCES `devices` (`id_device`) ON DELETE CASCADE,
  CONSTRAINT `fk_results_2` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_3` FOREIGN KEY (`id_test`) REFERENCES `tests` (`id_test`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_4` FOREIGN KEY (`id_status_test`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION,
  CONSTRAINT `fk_results_5` FOREIGN KEY (`id_status_evaluation`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,'2014-06-13 20:15:33',2,1,1,2,2),(2,'2014-06-13 20:15:33',2,1,2,2,2),(3,'2014-06-13 20:15:33',2,1,3,2,2),(4,'2014-06-13 20:15:33',2,1,4,2,2),(5,'2014-06-13 20:15:33',2,1,5,2,2),(6,'2014-06-13 20:15:33',2,1,6,2,2),(7,'2014-06-13 20:15:33',2,2,7,2,2),(8,'2014-06-13 20:15:33',2,2,8,2,2),(9,'2014-06-13 20:21:57',2,1,1,2,1),(10,'2014-06-13 20:21:57',2,1,2,2,1),(11,'2014-06-13 20:21:57',2,1,3,2,1),(12,'2014-06-13 20:21:57',2,2,4,2,1),(13,'2014-06-13 20:21:57',2,1,5,2,1),(14,'2014-06-13 20:21:57',2,1,6,2,1),(15,'2014-06-13 20:21:57',2,2,7,2,1),(16,'2014-06-13 20:21:57',2,2,8,2,1),(17,'2014-06-13 20:21:57',2,2,9,2,1),(18,'2014-06-13 20:21:57',2,2,10,2,1),(19,'2014-06-13 20:21:57',2,2,11,2,1),(20,'2014-06-13 20:21:57',2,2,12,2,1),(21,'2014-06-13 20:21:57',2,2,13,2,1),(22,'2014-06-13 20:21:57',2,2,14,2,1),(23,'2014-06-13 20:57:06',42,1,1,2,1),(24,'2014-06-13 20:57:06',42,2,2,2,1),(25,'2014-06-13 20:57:06',42,1,3,2,1),(26,'2014-06-13 20:57:06',42,2,4,2,1),(27,'2014-06-13 20:57:06',42,1,5,2,1),(28,'2014-06-13 20:57:06',42,2,6,2,1),(29,'2014-06-13 20:57:06',42,1,7,2,1),(30,'2014-06-13 20:57:06',42,2,8,2,1),(31,'2014-06-13 20:57:06',42,2,9,2,1),(32,'2014-06-13 20:57:06',42,2,10,2,1),(33,'2014-06-13 20:57:06',42,2,11,2,1),(34,'2014-06-13 20:57:06',42,2,12,2,1),(35,'2014-06-13 20:57:06',42,2,13,2,1),(36,'2014-06-13 20:57:06',42,2,14,2,1),(37,'2014-06-13 21:09:52',2,2,1,3,1),(38,'2014-06-13 21:09:52',2,2,2,3,1),(39,'2014-06-13 21:09:52',2,2,3,3,1),(40,'2014-06-13 21:09:52',2,2,4,3,1),(41,'2014-06-13 21:09:52',2,2,5,3,1),(42,'2014-06-13 21:09:52',2,2,6,3,1),(43,'2014-06-13 21:09:52',2,2,7,3,1),(44,'2014-06-13 21:09:52',2,2,8,3,1),(45,'2014-06-13 21:09:52',2,2,9,3,1),(46,'2014-06-13 21:09:52',2,2,10,3,1),(47,'2014-06-13 21:09:52',2,2,11,3,1),(48,'2014-06-13 21:09:52',2,2,12,3,1),(49,'2014-06-13 21:09:52',2,2,13,3,1),(50,'2014-06-13 21:09:52',2,2,14,3,1),(51,'2014-06-13 21:13:36',42,1,1,2,1),(52,'2014-06-13 21:13:36',42,1,2,2,1),(53,'2014-06-13 21:13:36',42,2,3,2,1),(54,'2014-06-13 21:13:36',42,2,4,2,1),(55,'2014-06-13 21:13:36',42,1,5,2,1),(56,'2014-06-13 21:13:36',42,1,6,2,1),(57,'2014-06-13 21:13:36',42,1,7,2,1),(58,'2014-06-13 21:13:36',42,1,8,2,1),(59,'2014-06-13 21:13:36',42,2,9,2,1),(60,'2014-06-13 21:13:36',42,2,10,2,1),(61,'2014-06-13 21:13:36',42,2,11,2,1),(62,'2014-06-13 21:13:36',42,2,12,2,1),(63,'2014-06-13 21:13:36',42,2,13,2,1),(64,'2014-06-13 21:13:36',42,2,14,2,1),(65,'2014-06-13 21:13:41',2,2,1,3,1),(66,'2014-06-13 21:13:41',2,2,2,3,1),(67,'2014-06-13 21:13:41',2,2,3,3,1),(68,'2014-06-13 21:13:41',2,2,4,3,1),(69,'2014-06-13 21:13:41',2,2,5,3,1),(70,'2014-06-13 21:13:41',2,2,6,3,1),(71,'2014-06-13 21:13:41',2,2,7,3,1),(72,'2014-06-13 21:13:41',2,2,8,3,1),(73,'2014-06-13 21:13:41',2,2,9,3,1),(74,'2014-06-13 21:13:41',2,2,10,3,1),(75,'2014-06-13 21:13:41',2,2,11,3,1),(76,'2014-06-13 21:13:41',2,2,12,3,1),(77,'2014-06-13 21:13:41',2,2,13,3,1),(78,'2014-06-13 21:13:41',2,2,14,3,1),(79,'2014-06-13 22:48:01',87,1,1,2,1),(80,'2014-06-13 22:48:01',87,1,2,2,1),(81,'2014-06-13 22:48:01',87,1,3,2,1),(82,'2014-06-13 22:48:01',87,1,4,2,1),(83,'2014-06-13 22:48:01',87,1,5,2,1),(84,'2014-06-13 22:48:01',87,2,6,2,1),(85,'2014-06-13 22:48:01',87,2,7,2,1),(86,'2014-06-13 22:48:01',87,2,8,2,1),(87,'2014-06-13 22:48:01',87,2,9,2,1),(88,'2014-06-13 22:48:01',87,2,10,2,1),(89,'2014-06-13 22:48:01',87,2,11,2,1),(90,'2014-06-13 22:48:01',87,2,12,2,1),(91,'2014-06-13 22:48:01',87,2,13,2,1),(92,'2014-06-13 22:48:01',87,2,14,2,1),(93,'2014-06-16 15:51:58',1,2,1,3,1),(94,'2014-06-16 15:51:58',1,2,2,3,1),(95,'2014-06-16 15:51:58',1,2,3,3,1),(96,'2014-06-16 15:51:58',1,2,4,3,1),(97,'2014-06-16 15:51:58',1,2,5,3,1),(98,'2014-06-16 15:51:58',1,2,6,3,1),(99,'2014-06-16 15:51:58',1,2,7,3,1),(100,'2014-06-16 15:51:58',1,2,8,3,1),(101,'2014-06-16 15:51:58',1,2,9,3,1),(102,'2014-06-16 15:51:58',1,2,10,3,1),(103,'2014-06-16 15:51:58',1,2,11,3,1),(104,'2014-06-16 15:51:58',1,2,12,3,1),(105,'2014-06-16 15:51:58',1,2,13,3,1),(106,'2014-06-16 15:51:58',1,2,14,3,1),(107,'2014-06-16 16:13:48',42,1,1,2,2),(108,'2014-06-16 16:13:48',42,1,2,2,2),(109,'2014-06-16 16:13:48',42,1,3,2,2),(110,'2014-06-16 16:13:48',42,1,4,2,2),(111,'2014-06-16 16:13:48',42,1,5,2,2),(112,'2014-06-16 16:13:48',42,2,6,2,2),(113,'2014-06-16 16:13:48',42,2,7,2,2),(114,'2014-06-16 16:13:48',42,2,8,2,2),(115,'2014-06-16 21:24:57',90,1,1,1,2),(116,'2014-06-16 21:24:57',90,1,2,1,2),(117,'2014-06-16 21:24:57',90,1,3,1,2),(118,'2014-06-16 21:24:57',90,1,4,1,2),(119,'2014-06-16 21:24:57',90,1,5,1,2),(120,'2014-06-16 21:24:57',90,1,6,1,2),(121,'2014-06-16 21:24:57',90,1,7,1,2),(122,'2014-06-16 21:24:57',90,1,8,1,2),(123,'2014-06-16 21:25:35',90,2,9,3,3),(124,'2014-06-16 21:25:35',90,2,10,3,3),(125,'2014-06-16 21:25:35',90,2,11,3,3),(126,'2014-06-16 21:25:35',90,2,12,3,3),(127,'2014-06-16 21:25:35',90,2,13,3,3),(128,'2014-06-16 21:25:35',90,2,14,3,3),(129,'2014-06-16 23:08:07',90,2,9,3,3),(130,'2014-06-16 23:08:07',90,2,10,3,3),(131,'2014-06-16 23:08:07',90,2,11,3,3),(132,'2014-06-16 23:08:07',90,2,12,3,3),(133,'2014-06-16 23:08:07',90,2,13,3,3),(134,'2014-06-16 23:08:07',90,2,14,3,3),(135,'2014-06-16 23:08:59',42,1,1,1,2),(136,'2014-06-16 23:08:59',42,1,2,1,2),(137,'2014-06-16 23:08:59',42,1,3,1,2),(138,'2014-06-16 23:08:59',42,1,4,1,2),(139,'2014-06-16 23:08:59',42,1,5,1,2),(140,'2014-06-16 23:08:59',42,1,6,1,2),(141,'2014-06-16 23:08:59',42,1,7,1,2),(142,'2014-06-16 23:08:59',42,1,8,1,2);
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
-- Table structure for table `supported_events`
--

DROP TABLE IF EXISTS `supported_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supported_events` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_event`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supported_events`
--

LOCK TABLES `supported_events` WRITE;
/*!40000 ALTER TABLE `supported_events` DISABLE KEYS */;
INSERT INTO `supported_events` VALUES (1,'hold','Hold touch event'),(2,'tap','Tap event'),(3,'doubletap','Double tap event'),(4,'drag','Drag event'),(5,'dragstart','Drag start event'),(6,'dragend','Drag end event'),(7,'dragup','Drag up event'),(8,'dragdown','Drag down event'),(9,'dragleft','Drag left event'),(10,'dragright','Drag right event'),(11,'swipe','Swipe event'),(12,'swipeup','Swipe up event'),(13,'swipedown','Swipe down event'),(14,'swipeleft','Swipe left event'),(15,'swiperight','Swipe right event'),(16,'transform','Transform event'),(17,'transformstart','Transform start event'),(18,'transformend','Transform end event'),(19,'rotate','Rotate event'),(20,'pinch','Pinch event'),(21,'pinchin','Pinch out event'),(22,'pinchout','Pinch in event'),(23,'touch','Touch event'),(24,'release','Release event'),(25,'gesture','Gesture event'),(26,'default','Default event');
/*!40000 ALTER TABLE `supported_events` ENABLE KEYS */;
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
  `action` int(11) NOT NULL DEFAULT '26' COMMENT 'contains the different tests that can be performed, i.e. tap, double tap, swipes, pinches and more.',
  `description` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_test`),
  KEY `fk_tests_1_idx` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'Tap',2,'Single tap on screen detection','tap'),(2,'Double tap',3,'Double tap on screen detection','dtap'),(3,'Swipe left',14,'Swipe left for at least 75px','sleft'),(4,'Swipe right',15,'Swipe right for at least 75px','sright'),(5,'Swipe up',12,'Swipe up for at least 75px','sup'),(6,'Swipe down',13,'Swipe down for at least 75px','sdown'),(7,'Pinch in',21,'Pinch in for at least 75px','pin'),(8,'Pinch out',22,'Pinch out for at least 75px','pout'),(9,'Accelerometer +X',26,'Accelerometer reach value 7 or more in x axis','xpos'),(10,'Accelerometer -X',26,'Accelerometer reach value -7 or more in x axi','xneg'),(11,'Accelerometer +Y',26,'Accelerometer reach value 7 or more in y axis','ypos'),(12,'Accelerometer -Y',26,'Accelerometer reach value -7 or more in y axi','yneg'),(13,'Accelerometer +Z',26,'Accelerometer reach value 7 or more in z axis','zpos'),(14,'Accelerometer -Z',26,'Accelerometer reach value -7 or more in z axi','zneg');
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

-- Dump completed on 2014-06-17 16:12:27
