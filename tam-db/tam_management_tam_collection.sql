-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: tam_management
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `tam_collection`
--

DROP TABLE IF EXISTS `tam_collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tam_collection` (
  `tam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tam_out` int(11) NOT NULL,
  `tam_in` int(11) DEFAULT NULL,
  `date_out` varchar(40) NOT NULL,
  `date_in` varchar(40) DEFAULT NULL,
  `tam_price` int(11) DEFAULT NULL,
  `remark` varchar(45) DEFAULT NULL,
  `worker_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`tam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tam_collection`
--

LOCK TABLES `tam_collection` WRITE;
/*!40000 ALTER TABLE `tam_collection` DISABLE KEYS */;
INSERT INTO `tam_collection` VALUES (1,10,15,'2018-02-02','2018-06-30 07:04:08pm',120,'good',1,1),(2,20,15,'2018-02-03','2018-06-30 07:04:08pm',120,'good',2,1),(3,15,15,'2018-06-17 05:16:24pm','2018-06-30 07:04:08pm',120,'good',3,2),(4,15,15,'2018-06-17 05:17:29pm','2018-06-30 07:04:08pm',120,'good',3,2),(5,20,15,'2018-06-17 05:19:01pm','2018-06-30 07:04:08pm',120,'good',4,2),(6,22,15,'2018-06-17 05:25:36pm','2018-06-30 07:04:08pm',120,'good',5,2),(7,10,15,'2018-06-17 06:24:00pm','2018-06-30 07:04:08pm',120,'good',4,2),(8,10,15,'2018-06-29 06:11:55pm','2018-06-30 07:04:08pm',120,'good',4,1);
/*!40000 ALTER TABLE `tam_collection` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-30 22:40:32
