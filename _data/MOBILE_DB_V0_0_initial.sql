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
  CONSTRAINT `fk_device_evaluation_2` FOREIGN KEY (`id_evaluation`) REFERENCES `evaluations` (`id_evaluation`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `iddevices_UNIQUE` (`id_device`),
  UNIQUE KEY `imei_UNIQUE` (`imei`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-10 11:46:19
