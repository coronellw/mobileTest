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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_brand`),
  UNIQUE KEY `id_brands_UNIQUE` (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'ALCATEL',NULL),(2,'APPLE',NULL),(3,'AVVIO',NULL),(4,'AZUMI',NULL),(5,'BLACKBERRY',NULL),(6,'DELL',NULL),(7,'HTC',NULL),(8,'HUAWEI',NULL),(9,'LANIX',NULL),(10,'LG',NULL),(11,'M4TEL',NULL),(12,'MOTOROLA',NULL),(13,'NEC',NULL),(14,'NOKIA',NULL),(15,'NYX MOBILE',NULL),(16,'POLAROID',NULL),(17,'SAMSUNG',NULL),(18,'SONY',NULL),(19,'SONY ERICSSON',NULL),(20,'ZTE',NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `device_evaluation` VALUES (1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(1,1),(2,1),(2,1),(2,1),(2,1),(2,3),(2,2),(1,1),(2,1),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,3),(2,3),(2,3),(2,2),(2,2),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(2,1),(42,1),(42,1),(2,1),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(69,2),(69,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(2,2),(70,1),(70,3),(70,3),(70,3),(70,2),(70,2),(76,1),(70,2),(76,1),(76,2),(76,2),(2,2),(2,1),(42,1),(2,1),(2,1),(42,1),(87,1),(1,1),(42,2),(90,2),(90,3),(42,2),(91,2),(91,2),(92,2),(93,1),(1,1),(95,2),(95,2),(1,1),(1,1),(95,2),(95,2);
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
  `id_model` int(11) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `last_use` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_device`),
  UNIQUE KEY `iddevices_UNIQUE` (`id_device`),
  UNIQUE KEY `imei_UNIQUE` (`imei`),
  KEY `fk_devices_1_idx` (`id_brand`),
  KEY `fk_devices_2_idx` (`id_model`),
  CONSTRAINT `fk_devices_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id_brand`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_devices_2` FOREIGN KEY (`id_model`) REFERENCES `models` (`id_model`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'mine','123',172,17,'2014-06-18 22:35:39'),(2,NULL,'1234',40,1,'2014-06-13 21:12:44'),(42,NULL,'55302',224,12,'2014-06-16 23:08:29'),(69,NULL,'12834',224,NULL,'2014-06-12 19:38:30'),(70,NULL,'09876',NULL,NULL,'2014-06-13 18:18:00'),(76,NULL,'12734',NULL,NULL,'2014-06-13 18:23:24'),(87,NULL,'56473',NULL,NULL,'2014-06-13 22:47:35'),(90,NULL,'999',NULL,NULL,'2014-06-16 21:25:21'),(91,NULL,'12345678',NULL,NULL,'2014-06-17 21:43:11'),(92,NULL,'6951',NULL,NULL,'2014-06-18 17:02:49'),(93,NULL,'852',NULL,NULL,'2014-06-18 18:13:16'),(95,NULL,'1234567890',NULL,NULL,'2014-06-18 23:08:42');
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
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id_model` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_model`),
  UNIQUE KEY `id_models_UNIQUE` (`id_model`),
  KEY `fk_models_1_idx` (`id_brand`),
  CONSTRAINT `fk_models_1` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id_brand`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=518 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'OT-132A','OT-132A',1),(2,'NOA','NOA',15),(3,'NOA+','NOA+',15),(4,'G2800S','G2800S',8),(5,'G6005','G6005',8),(6,'G6006','G6006',8),(7,'W31','W31',9),(8,'XYN305','XYN305',15),(9,'S218','S218',20),(10,'S516','S516',20),(11,'OT-316A','OT-316A',1),(12,'KEYSTONE 2','GT-E1205',17),(13,'A100','A100',10),(14,'100','RM-130',14),(15,'106','RM-962',14),(16,'W30','W30',9),(17,'OT-306A','OT-306A',1),(18,'Q10','Q10',4),(19,'A270','A270',10),(20,'A270 701','A270 701',10),(21,'OT355A','OT355A',1),(22,'R221','R221',20),(23,'KIWI TV','KIWI TV',15),(24,'OT-310A','OT-310A',1),(25,'LX7','LX7',9),(26,'OT-803A','OT-803A',1),(27,'X1-00','RM-732',14),(28,'MIO','MIO',15),(29,'COCONUT','GT-E1195L',17),(30,'N295','N295',20),(31,'A210','A210',10),(32,'R290','R290',20),(33,'OT303A','OT303A',1),(34,'CHIK WF','CHIK WF',4),(35,'Q15','Q15',4),(36,'LX5','LX5',9),(37,'KYT TV','KYT TV',15),(38,'OT-639','OT-639',1),(39,'ASHA 205','RM-862',14),(40,'OT383A TITANIUM','OT383A TITANIUM',1),(41,'VIBER','SS220',11),(42,'U8185-5','U8185-5',8),(43,'A35','A35',4),(44,'R236','R236',20),(45,'OT-665','OT-665',1),(46,'OT-665A','OT-665A',1),(47,'Z20','Z20',9),(48,'C1-01','RM-608',14),(50,'U8655-51','U8655-51',8),(51,'U8350','U8350',8),(52,'U9120','U9120',8),(53,'LX14','LX14',9),(54,'V793','V793',20),(55,'OT606A','OT606A',1),(56,'210 ASHA','RM-926',14),(57,'C2-05','RM-724',14),(58,'V795','V795',20),(59,'OT-901A','OT-901A',1),(60,'Asha 201','RM-799',14),(61,'X2-01','RM-709',14),(62,'GT-E2530','GT-E2530',17),(63,'R352','R352',20),(64,'OT-4010A','OT-4010A',1),(65,'S105','S105',9),(66,'S120 ILIUM','S120 ILIUM',9),(67,'OT-810A','OT-810A',1),(68,'A200  TITANIUM','A200  TITANIUM',10),(69,'A200','A200',10),(70,'EX108','EX108',12),(71,'R260','R260',20),(72,'EX116','EX116',12),(74,'Y210-0151','Y210-0151',8),(75,'OT-710A','OT-710A',1),(76,'C193','C193',10),(77,'ASHA 306','RM-767',14),(78,'LX11','LX11',9),(79,'GT-C3310','GT-C3310',17),(80,'T99','T99',9),(81,'OT-807A','OT-807A',1),(82,'ASHA 501','RM-899',14),(83,'ASHA 501','RM-902',14),(84,'SANSUNG CHAT','GT-E2220',17),(85,'NEO POCKET HELLO KITTY','GT-S5310 G',17),(86,'V809','V809',20),(87,'U8180','U8180',8),(88,'CK13 TXT','CK13 TXT',19),(89,'SS990 E-MOTION','SS990',11),(90,'W150','W150',19),(91,'S115','S115',9),(92,'C2-02','RM-692',14),(93,'E410G','E410G',10),(97,'COOKIE LITE','T300',10),(98,'SS660 SPACE','SS660',11),(99,'ASHA 503','RM-920',14),(100,'COOKIE L','T395',10),(101,'C3','RM-776',14),(102,'OT890A','OT890A',1),(103,'F930','F930',20),(104,'101T MEDIAS','101T MEDIAS',13),(105,'POCKET NEO','GT-S5310 G',17),(106,'NOBA','NOBA',15),(107,'V829','V829',20),(108,'EX112','EX112',12),(109,'C305','C305',10),(110,'SS880 MIRAGE','SS880',11),(111,'OT-918A','OT-918A',1),(112,'LX20','LX20',9),(113,'ASHA 302','RM-813',14),(114,'OT-5020A','OT-5020A',1),(115,'GALAXY NOTE III','SS1060',11),(116,'EX118','EX118',12),(117,'103T','103T',13),(118,'ASHA 311','RM-714',14),(119,'S100','S100',9),(120,'9220','9220',5),(121,'V3 PTT','V3 PTT',12),(122,'U8850','U8850',8),(123,'N505 LUMIA','RM-923',14),(124,'CK15 TXT PRO','CK15 TXT PRO',19),(125,'EX225','EX225',12),(126,'EX132','EX132',12),(127,'XPERIA TIPO','ST21i / ST21a',19),(128,'XPERIA TIPO','ST21i / ST21a',18),(129,'OPTIMUS ME','P350',10),(131,'LUMIA N303','RM-763',14),(132,'XPERIA E','C1504',19),(133,'Wink Style','T310',10),(134,'S210','S210',9),(135,'E425F','E425F',10),(137,'GM360I','GM360I',10),(138,'OT-991A','OT-991A',1),(139,'S200','S200',9),(140,'S410 ILIUM','S410 ILIUM',9),(141,'PMID70K TABLET','PMID70K TABLET',16),(142,'V9A TABLET','V9A TABLET',20),(143,'GALAXY Y','GT-S5360',17),(144,'E440G','E440G',10),(145,'520 LUMIA','RM-923',14),(146,'V880','V880',20),(147,'OT-5035A','OT-5035A',1),(148,'MINI 3IX','MINI 3IX',6),(150,'E400F','E400F',10),(151,'SS550 GENIUS','SS550',11),(152,'GALAXY Y HELLO KITTY','GT-S5360',17),(153,'IDOL MINI','OT-6012A',1),(154,'XPERIA MINI','ST15',19),(155,'PAD TABLET','PAD TABLET',3),(156,'MotoSmart','XT303',12),(157,'S400','S400',9),(158,'A45','A45',12),(159,'XPERIA MIRO','ST23A',19),(160,'XPERIA MIRO','ST23A',18),(161,'OT-990','OT-990',1),(162,'Galaxy MINI','S5570',17),(163,'S500','S500',9),(164,'RAZR D1','XT914',12),(165,'C5-03','RM-697',14),(168,'Defy Mini','XT320',12),(169,'Galaxy FIT','S5670',17),(170,'SCRIBE EASY','OT-8000A',1),(171,'N500','RM-750',14),(172,'GALAXY FAME','GT-S6810M',17),(173,'OPTIMUS PRO','C660',10),(174,'GALAXY MINI 2','S6500',17),(175,'FLY','FLY',15),(176,'XPERIA J','ST26',19),(177,'XPERIA J','ST26',18),(178,'OT-995A','OT-995A',1),(180,'GEMINI SKY','8520',5),(181,'L5X','E450F',10),(184,'SPICE','XT300',12),(185,'FIRE XT','XT531',12),(186,'PJ03120 EXPLORER','PJ03120 EXPLORER',7),(187,'OT-6030A','OT-6030A',1),(188,'510 LUMIA','RM-889',14),(189,'AUDIFONOS','WT19',19),(190,'LIVE WITH WALKMAN','WT19',19),(191,'610 LUMIA','RM-835',14),(192,'GALAXY DISCOVER','SGHE736',17),(193,'XPERIA M','C1904',18),(194,'MOTO','XT316',12),(195,'XPERIA GO','ST27',19),(196,'XPERIA GO','ST27',18),(197,'E5','RM-634',14),(198,'FLIP OUT','MB511',12),(199,'OPTIMUS L5','E612F',10),(200,'9320','9320',5),(201,'S600 ILIUM','S600 ILIUM',9),(203,'GALAXY ACE','S5830',17),(204,'XPERIA U','ST25A',19),(205,'XPERIA U','ST25A',18),(206,'5140','RM-140',14),(207,'620','RM-846',14),(208,'9100','9100',5),(209,'XPERIA MINI PRO','SK17',19),(210,'OPTIMUS HUB','E510',10),(214,'PH06130 STATUS','PH06130 STATUS',7),(216,'XPERIA X10 MINI','X10 MINI',19),(217,'GALAXY ACE 3','S-7275',17),(218,'Q5','Q5',5),(219,'625 LUMIA','RM-941',14),(220,'W710','W710',19),(221,'X10 MINI PRO','X10 MINI PRO',19),(222,'V9 LIGHT TABLET   3-G','V9 LIGHT TABLET   3-G',20),(223,'S700 ILIUM','S700 ILIUM',9),(224,'MOTO G','XT1032',12),(225,'OPTIMUS L7','P714',10),(226,'CURVE','9300',5),(227,'GALAXY ACE 2','S7500',17),(228,'XPERIA L','C2104',18),(229,'SS1090','SS1090',11),(230,'XPERIA NEO V','MT11',19),(231,' XPERIA RAY','ST18',19),(233,'RAZR D3','XT919',12),(234,'9360','9360',5),(235,'9360 CURVE','9360',5),(238,'OPTIMUS SOL','E730F',10),(239,'XT615','XT615',12),(240,'XPERIA PRO','MK16A',19),(241,'Z30','Z30',5),(242,'ONE V','ONE V',7),(243,'603','RM-225',14),(244,'C6-01','RM-601',14),(245,'L7','P708',10),(246,'L7 DVD AVENGERS','P708',10),(248,'DEFY+','MB526',12),(249,'XPERIA P','LT22I',19),(250,'XPERIA P','LT22I',18),(251,'710 LUMIA','RM-809',14),(253,'IPHONE 4 xGB','IPHONE 4',2),(254,'9380 CURVE','9380',5),(255,'IDOL X','OT-6040',1),(257,'720 LUMIA','RM-885',14),(258,'XPERIA SP','C5306',18),(259,'OPTIMUS L9','P768',10),(260,'OPTIMUS L9','P760',5),(261,'PRO+','MB632',12),(262,'XPERIA ARC S','LT18',19),(263,'PRO LITE','D680',10),(264,'E900 WINDOWS PHONE','E900',10),(265,'DEFY','MB525',12),(266,'E6','RM-449',14),(267,'XPERIA NEO','MT15',19),(268,'ESCAPE','P870',10),(269,'GALAXY S III MINI','GT-I8190L',17),(270,'XPERIA S','LT26',18),(271,'XPERIA S','LT26',19),(272,'XPERIA S TELCEL RED','LT26',19),(273,'GALAXY ADVANCED','GT-I9070',17),(274,'9000 BOLD','9000',5),(275,'DROID PRO','XT610',12),(276,'XPERIA T','LT30P',18),(277,'X10','X10',19),(278,'OPTIMUS BLACK','P970',10),(279,'GALAXY S','GT-I9000',17),(280,'R800','R800',19),(281,'ASCEND P6','ASCEND P6',8),(282,'925 LUMIA','RM-893',14),(283,'IPHONE xGB','IPHONE 5',2),(284,'ONE S','ONE S',7),(285,'XPERIA ION  LTE','LT28i',18),(286,'A953','A953',12),(287,'LUMIA 800','RM-819',14),(288,'BOLD','9700',5),(290,'9780','9780',5),(291,'GALAXY S4 MINI','GT-I9195',17),(292,'820','RM-825',14),(293,'N8','RM-596',14),(294,'XPERIA ZL','C6506',19),(295,'NEXUS 5','D820',10),(296,'INSPIRE HD  MARRON','INSPIRE HD  MARRON',7),(297,'9860 TORCH','9860',5),(298,'9860 TORCH','9860',5),(299,'SM-C105 GLX S4 ZOOM','SM-C105',17),(301,'IPHONE 5C xGB','IPHONE 5C',2),(302,'NEXUS 4','E960',10),(304,'OPTIMUS 2X','P990',10),(307,'9810 TORCH','9810',5),(308,'RAZR I','XT890',12),(309,'900 LUMIA','RM-823',14),(310,'N9','RM-696',14),(311,'GALAXY S II','GT-I9100',17),(312,'9900','9900',5),(313,'GALAXY II','SGH I727',17),(317,'GALAXY III','SGH-I747M',17),(318,'ONE X','ONE X',7),(319,'U9202L-3 ASEND','U9202L-3 ASEND',8),(320,'9800 TORCH','9800',5),(321,'Z10','Z10',5),(322,'Q10','Q10',5),(325,'OPTIMUS 4X','P880',10),(326,'OPTIMUS 3D','P920',10),(327,'NEXUS','GT-I9250 ',17),(328,'MOTO X','XT1058',12),(329,'E7-00','RM-626',14),(330,'808 PURE VIEW','RM-808',14),(331,' OPTIMUS','E976',10),(332,'920 LUMIA','RM-821',14),(335,'OPTIMUS VU','P895 ',10),(336,'INSPIRE 3D','INSPIRE 3D',7),(337,'ONE','ONE',7),(338,' GALAXY S III','GT-I9300',17),(339,'GALAXY NOTE 2','SGH-I317',17),(340,'PRO','E980G',10),(341,' ATRIX','MB860',12),(343,'RAZR','XT910',12),(344,'RAZR MAXX','XT910',12),(345,'RAZR HD','XT925',12),(347,'IPHONE 5S xGB','IPHONE 5S',2),(348,'G2','D805',10),(349,'1020 LUMIA','RM-875',14),(350,'XPERIA Z ULTRA','C6806',19),(351,'GALAXY NOTE III','N900',17),(352,'GALAXY S IV','GT-I337M ',17),(353,'GALAXY NOTE 2','N7100',17),(354,'XPERIA Z1','C6906',18),(355,'GALAXY NOTE','N7000',17),(360,'IPHONE 4S xGB ','IPHONE 4S',2),(363,'PORSCHE DESIGN','9981',5),(512,'ASHA 201','RM-800',14),(513,'ASHA 501','RM-900',14),(514,'625 LUMIA','RM-942',14),(515,'C510','C510',19),(516,'C702','C702',4),(517,'C901','C901',4);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,'2014-06-13 20:15:33',2,1,1,2,2),(2,'2014-06-13 20:15:33',2,1,2,2,2),(3,'2014-06-13 20:15:33',2,1,3,2,2),(4,'2014-06-13 20:15:33',2,1,4,2,2),(5,'2014-06-13 20:15:33',2,1,5,2,2),(6,'2014-06-13 20:15:33',2,1,6,2,2),(7,'2014-06-13 20:15:33',2,2,7,2,2),(8,'2014-06-13 20:15:33',2,2,8,2,2),(9,'2014-06-13 20:21:57',2,1,1,2,1),(10,'2014-06-13 20:21:57',2,1,2,2,1),(11,'2014-06-13 20:21:57',2,1,3,2,1),(12,'2014-06-13 20:21:57',2,2,4,2,1),(13,'2014-06-13 20:21:57',2,1,5,2,1),(14,'2014-06-13 20:21:57',2,1,6,2,1),(15,'2014-06-13 20:21:57',2,2,7,2,1),(16,'2014-06-13 20:21:57',2,2,8,2,1),(17,'2014-06-13 20:21:57',2,2,9,2,1),(18,'2014-06-13 20:21:57',2,2,10,2,1),(19,'2014-06-13 20:21:57',2,2,11,2,1),(20,'2014-06-13 20:21:57',2,2,12,2,1),(21,'2014-06-13 20:21:57',2,2,13,2,1),(22,'2014-06-13 20:21:57',2,2,14,2,1),(23,'2014-06-13 20:57:06',42,1,1,2,1),(24,'2014-06-13 20:57:06',42,2,2,2,1),(25,'2014-06-13 20:57:06',42,1,3,2,1),(26,'2014-06-13 20:57:06',42,2,4,2,1),(27,'2014-06-13 20:57:06',42,1,5,2,1),(28,'2014-06-13 20:57:06',42,2,6,2,1),(29,'2014-06-13 20:57:06',42,1,7,2,1),(30,'2014-06-13 20:57:06',42,2,8,2,1),(31,'2014-06-13 20:57:06',42,2,9,2,1),(32,'2014-06-13 20:57:06',42,2,10,2,1),(33,'2014-06-13 20:57:06',42,2,11,2,1),(34,'2014-06-13 20:57:06',42,2,12,2,1),(35,'2014-06-13 20:57:06',42,2,13,2,1),(36,'2014-06-13 20:57:06',42,2,14,2,1),(37,'2014-06-13 21:09:52',2,2,1,3,1),(38,'2014-06-13 21:09:52',2,2,2,3,1),(39,'2014-06-13 21:09:52',2,2,3,3,1),(40,'2014-06-13 21:09:52',2,2,4,3,1),(41,'2014-06-13 21:09:52',2,2,5,3,1),(42,'2014-06-13 21:09:52',2,2,6,3,1),(43,'2014-06-13 21:09:52',2,2,7,3,1),(44,'2014-06-13 21:09:52',2,2,8,3,1),(45,'2014-06-13 21:09:52',2,2,9,3,1),(46,'2014-06-13 21:09:52',2,2,10,3,1),(47,'2014-06-13 21:09:52',2,2,11,3,1),(48,'2014-06-13 21:09:52',2,2,12,3,1),(49,'2014-06-13 21:09:52',2,2,13,3,1),(50,'2014-06-13 21:09:52',2,2,14,3,1),(51,'2014-06-13 21:13:36',42,1,1,2,1),(52,'2014-06-13 21:13:36',42,1,2,2,1),(53,'2014-06-13 21:13:36',42,2,3,2,1),(54,'2014-06-13 21:13:36',42,2,4,2,1),(55,'2014-06-13 21:13:36',42,1,5,2,1),(56,'2014-06-13 21:13:36',42,1,6,2,1),(57,'2014-06-13 21:13:36',42,1,7,2,1),(58,'2014-06-13 21:13:36',42,1,8,2,1),(59,'2014-06-13 21:13:36',42,2,9,2,1),(60,'2014-06-13 21:13:36',42,2,10,2,1),(61,'2014-06-13 21:13:36',42,2,11,2,1),(62,'2014-06-13 21:13:36',42,2,12,2,1),(63,'2014-06-13 21:13:36',42,2,13,2,1),(64,'2014-06-13 21:13:36',42,2,14,2,1),(65,'2014-06-13 21:13:41',2,2,1,3,1),(66,'2014-06-13 21:13:41',2,2,2,3,1),(67,'2014-06-13 21:13:41',2,2,3,3,1),(68,'2014-06-13 21:13:41',2,2,4,3,1),(69,'2014-06-13 21:13:41',2,2,5,3,1),(70,'2014-06-13 21:13:41',2,2,6,3,1),(71,'2014-06-13 21:13:41',2,2,7,3,1),(72,'2014-06-13 21:13:41',2,2,8,3,1),(73,'2014-06-13 21:13:41',2,2,9,3,1),(74,'2014-06-13 21:13:41',2,2,10,3,1),(75,'2014-06-13 21:13:41',2,2,11,3,1),(76,'2014-06-13 21:13:41',2,2,12,3,1),(77,'2014-06-13 21:13:41',2,2,13,3,1),(78,'2014-06-13 21:13:41',2,2,14,3,1),(79,'2014-06-13 22:48:01',87,1,1,2,1),(80,'2014-06-13 22:48:01',87,1,2,2,1),(81,'2014-06-13 22:48:01',87,1,3,2,1),(82,'2014-06-13 22:48:01',87,1,4,2,1),(83,'2014-06-13 22:48:01',87,1,5,2,1),(84,'2014-06-13 22:48:01',87,2,6,2,1),(85,'2014-06-13 22:48:01',87,2,7,2,1),(86,'2014-06-13 22:48:01',87,2,8,2,1),(87,'2014-06-13 22:48:01',87,2,9,2,1),(88,'2014-06-13 22:48:01',87,2,10,2,1),(89,'2014-06-13 22:48:01',87,2,11,2,1),(90,'2014-06-13 22:48:01',87,2,12,2,1),(91,'2014-06-13 22:48:01',87,2,13,2,1),(92,'2014-06-13 22:48:01',87,2,14,2,1),(93,'2014-06-16 15:51:58',1,2,1,3,1),(94,'2014-06-16 15:51:58',1,2,2,3,1),(95,'2014-06-16 15:51:58',1,2,3,3,1),(96,'2014-06-16 15:51:58',1,2,4,3,1),(97,'2014-06-16 15:51:58',1,2,5,3,1),(98,'2014-06-16 15:51:58',1,2,6,3,1),(99,'2014-06-16 15:51:58',1,2,7,3,1),(100,'2014-06-16 15:51:58',1,2,8,3,1),(101,'2014-06-16 15:51:58',1,2,9,3,1),(102,'2014-06-16 15:51:58',1,2,10,3,1),(103,'2014-06-16 15:51:58',1,2,11,3,1),(104,'2014-06-16 15:51:58',1,2,12,3,1),(105,'2014-06-16 15:51:58',1,2,13,3,1),(106,'2014-06-16 15:51:58',1,2,14,3,1),(107,'2014-06-16 16:13:48',42,1,1,2,2),(108,'2014-06-16 16:13:48',42,1,2,2,2),(109,'2014-06-16 16:13:48',42,1,3,2,2),(110,'2014-06-16 16:13:48',42,1,4,2,2),(111,'2014-06-16 16:13:48',42,1,5,2,2),(112,'2014-06-16 16:13:48',42,2,6,2,2),(113,'2014-06-16 16:13:48',42,2,7,2,2),(114,'2014-06-16 16:13:48',42,2,8,2,2),(115,'2014-06-16 21:24:57',90,1,1,1,2),(116,'2014-06-16 21:24:57',90,1,2,1,2),(117,'2014-06-16 21:24:57',90,1,3,1,2),(118,'2014-06-16 21:24:57',90,1,4,1,2),(119,'2014-06-16 21:24:57',90,1,5,1,2),(120,'2014-06-16 21:24:57',90,1,6,1,2),(121,'2014-06-16 21:24:57',90,1,7,1,2),(122,'2014-06-16 21:24:57',90,1,8,1,2),(123,'2014-06-16 21:25:35',90,2,9,3,3),(124,'2014-06-16 21:25:35',90,2,10,3,3),(125,'2014-06-16 21:25:35',90,2,11,3,3),(126,'2014-06-16 21:25:35',90,2,12,3,3),(127,'2014-06-16 21:25:35',90,2,13,3,3),(128,'2014-06-16 21:25:35',90,2,14,3,3),(129,'2014-06-16 23:08:07',90,2,9,3,3),(130,'2014-06-16 23:08:07',90,2,10,3,3),(131,'2014-06-16 23:08:07',90,2,11,3,3),(132,'2014-06-16 23:08:07',90,2,12,3,3),(133,'2014-06-16 23:08:07',90,2,13,3,3),(134,'2014-06-16 23:08:07',90,2,14,3,3),(135,'2014-06-16 23:08:59',42,1,1,1,2),(136,'2014-06-16 23:08:59',42,1,2,1,2),(137,'2014-06-16 23:08:59',42,1,3,1,2),(138,'2014-06-16 23:08:59',42,1,4,1,2),(139,'2014-06-16 23:08:59',42,1,5,1,2),(140,'2014-06-16 23:08:59',42,1,6,1,2),(141,'2014-06-16 23:08:59',42,1,7,1,2),(142,'2014-06-16 23:08:59',42,1,8,1,2),(143,'2014-06-17 21:40:10',91,1,1,2,2),(144,'2014-06-17 21:40:10',91,1,2,2,2),(145,'2014-06-17 21:40:10',91,2,3,2,2),(146,'2014-06-17 21:40:10',91,1,4,2,2),(147,'2014-06-17 21:40:10',91,1,5,2,2),(148,'2014-06-17 21:40:10',91,2,6,2,2),(149,'2014-06-17 21:40:10',91,2,7,2,2),(150,'2014-06-17 21:40:10',91,2,8,2,2),(151,'2014-06-17 21:43:39',91,2,1,3,2),(152,'2014-06-17 21:43:39',91,2,2,3,2),(153,'2014-06-17 21:43:39',91,2,3,3,2),(154,'2014-06-17 21:43:39',91,2,4,3,2),(155,'2014-06-17 21:43:39',91,2,5,3,2),(156,'2014-06-17 21:43:39',91,2,6,3,2),(157,'2014-06-17 21:43:39',91,2,7,3,2),(158,'2014-06-17 21:43:39',91,2,8,3,2),(159,'2014-06-17 21:46:07',91,1,1,1,2),(160,'2014-06-17 21:46:07',91,1,2,1,2),(161,'2014-06-17 21:46:07',91,1,3,1,2),(162,'2014-06-17 21:46:07',91,1,4,1,2),(163,'2014-06-17 21:46:07',91,1,5,1,2),(164,'2014-06-17 21:46:07',91,1,6,1,2),(165,'2014-06-17 21:46:07',91,1,7,1,2),(166,'2014-06-17 21:46:07',91,1,8,1,2),(167,'2014-06-17 21:46:51',91,1,1,2,2),(168,'2014-06-17 21:46:51',91,1,2,2,2),(169,'2014-06-17 21:46:51',91,2,3,2,2),(170,'2014-06-17 21:46:51',91,2,4,2,2),(171,'2014-06-17 21:46:51',91,1,5,2,2),(172,'2014-06-17 21:46:51',91,2,6,2,2),(173,'2014-06-17 21:46:51',91,2,7,2,2),(174,'2014-06-17 21:46:51',91,2,8,2,2),(175,'2014-06-18 17:03:06',92,2,1,3,2),(176,'2014-06-18 17:03:06',92,2,2,3,2),(177,'2014-06-18 17:03:06',92,2,3,3,2),(178,'2014-06-18 17:03:06',92,2,4,3,2),(179,'2014-06-18 17:03:06',92,2,5,3,2),(180,'2014-06-18 17:03:06',92,2,6,3,2),(181,'2014-06-18 17:03:06',92,2,7,3,2),(182,'2014-06-18 17:03:06',92,2,8,3,2),(183,'2014-06-18 18:13:45',93,2,1,3,1),(184,'2014-06-18 18:13:45',93,2,2,3,1),(185,'2014-06-18 18:13:45',93,2,3,3,1),(186,'2014-06-18 18:13:45',93,2,4,3,1),(187,'2014-06-18 18:13:45',93,2,5,3,1),(188,'2014-06-18 18:13:45',93,2,6,3,1),(189,'2014-06-18 18:13:45',93,2,7,3,1),(190,'2014-06-18 18:13:45',93,2,8,3,1),(191,'2014-06-18 18:13:45',93,2,9,3,1),(192,'2014-06-18 18:13:45',93,2,10,3,1),(193,'2014-06-18 18:13:45',93,2,11,3,1),(194,'2014-06-18 18:13:45',93,2,12,3,1),(195,'2014-06-18 18:13:45',93,2,13,3,1),(196,'2014-06-18 18:13:45',93,2,14,3,1),(197,'2014-06-18 21:54:37',95,1,1,2,2),(198,'2014-06-18 21:54:37',95,2,2,2,2),(199,'2014-06-18 21:54:37',95,2,3,2,2),(200,'2014-06-18 21:54:37',95,2,4,2,2),(201,'2014-06-18 21:54:37',95,2,5,2,2),(202,'2014-06-18 21:54:37',95,2,6,2,2),(203,'2014-06-18 21:54:37',95,2,7,2,2),(204,'2014-06-18 21:54:37',95,2,8,2,2);
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

-- Dump completed on 2014-06-19 10:52:02
