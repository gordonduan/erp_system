-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cake_erp
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (8,NULL,1,6,'Household Appliance','Household Appliance','2017-11-17 08:59:22','2017-11-17 08:59:38'),(9,8,2,3,'Vacuum Cleaner','Vacuum Cleaner','2017-11-17 09:00:45','2017-11-17 09:00:45'),(10,8,4,5,'Heating & Cooling','Heating & Cooling','2017-11-17 09:01:22','2017-11-18 10:43:18'),(11,NULL,7,8,'Computers & Tablets','Computers & Tablets','2017-11-17 09:02:18','2017-11-17 09:02:18'),(12,NULL,9,18,'Phone & GPS','Phone & GPS','2017-11-17 13:33:24','2017-11-17 13:33:24'),(13,12,10,15,'Mobile Phones','Mobile phones','2017-11-18 04:03:53','2017-11-18 04:03:53'),(16,12,16,17,'GPS','GPS','2017-11-18 04:13:44','2017-11-18 04:13:44'),(20,13,11,12,'Iphone','Iphone','2017-11-18 07:51:02','2017-11-18 07:51:02'),(21,13,13,14,'Android','Android','2017-11-18 07:51:28','2017-11-18 07:51:28');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `type` char(4) DEFAULT NULL,
  `status` char(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'Iphone8','64G',1,'0','1','2017-11-18 13:34:24','2017-11-19 02:19:17'),(2,1,'iphone8 sale order','sell iphone8 1 set',1,'0','1','2017-11-18 22:12:05','2017-11-19 03:51:44'),(3,1,'Iphone8 order2','Purchasing order from Apple.',100,'1','1','2017-11-19 00:19:54','2017-11-19 03:55:14'),(4,2,'S8 purchasing order','S8 purchasing order',100,'1','1','2017-11-19 00:25:39','2017-11-19 00:25:39'),(5,2,'sales order','S8 sales order',1,'0','0','2017-11-19 00:37:46','2017-11-19 00:37:46'),(6,2,'S8','S8 order',100,'0','1','2017-11-19 03:56:10','2017-11-19 04:05:32'),(7,2,'S8-1','S8 128G',1,'1','1','2017-11-19 04:07:06','2017-11-19 04:07:14'),(8,2,'S8 blue','S8 blue',1000,'0','1','2017-11-19 04:12:33','2017-11-19 04:12:50'),(9,2,'s8 blue','s8 blue sale',500,'1','1','2017-11-19 04:13:34','2017-11-19 04:13:39');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Iphone8','Apple Iphone8',20,1200,'2017-11-18 08:29:05','2017-11-18 12:40:07'),(2,'S8','Samsung S8',21,1200,'2017-11-18 12:35:06','2017-11-18 12:35:06');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,1,'','',101,'2017-11-18 13:43:15','2017-11-18 13:43:15'),(4,2,'S8 blue','S8 blue',500,'2017-11-19 04:12:50','2017-11-19 04:12:50');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-19 21:17:32
