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
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (8,NULL,1,6,'Household Appliance','Household Appliance','2017-11-17 08:59:22','2017-11-17 08:59:38'),(9,8,2,3,'Vacuum Cleaner','Vacuum Cleaner','2017-11-17 09:00:45','2017-11-17 09:00:45'),(10,8,4,5,'Heating & Cooling','Heating & Cooling1','2017-11-17 09:01:22','2017-11-20 12:28:09'),(11,NULL,7,8,'Computers & Tablets','Computers & Tablets','2017-11-17 09:02:18','2017-11-17 09:02:18'),(12,NULL,9,18,'Phone & GPS','Phone & GPS','2017-11-17 13:33:24','2017-11-17 13:33:24'),(13,12,10,15,'Mobile Phones','Mobile phones','2017-11-18 04:03:53','2017-11-18 04:03:53'),(16,12,16,17,'GPS','GPS','2017-11-18 04:13:44','2017-11-18 04:13:44'),(20,13,11,12,'Iphone','Iphone','2017-11-18 07:51:02','2017-11-18 07:51:02'),(21,13,13,14,'Android','Android','2017-11-18 07:51:28','2017-11-18 07:51:28');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `document` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (4,1,'','afdaf','uploads/documents/xinhu.txt','','','1111111111111111',1,'2017-11-29 23:19:00','2017-11-30 11:29:52'),(6,2,'','afdafd','uploads/documents/sql.txt','','','adfafadfa',1,'2017-11-29 23:37:55','2017-11-29 23:37:55'),(7,1,'','afdf','uploads/documents/sql.txt','','','adff',1,'2017-11-29 23:41:29','2017-11-29 23:41:29'),(8,2,'','afadf','uploads/documents/sql.txt','','','adfaf',1,'2017-11-29 23:44:03','2017-11-29 23:44:03'),(11,1,'','afdaf','uploads/documents/sql.txt','','','adfaf',1,'2017-11-29 23:55:36','2017-11-29 23:55:36'),(12,1,'','adfaf','uploads/documents/xinhu.txt','','','adfafds',1,'2017-11-29 23:56:14','2017-11-29 23:56:14'),(13,4,'','adfaf','uploads/documents/xinhu.txt','','','afadfad',1,'2017-11-29 23:57:16','2017-11-29 23:57:16'),(14,2,'','dafd','uploads/documents/sql.txt','','','adfad',1,'2017-11-30 00:08:16','2017-11-30 00:08:16'),(15,1,'','afdafdaf','uploads/documents/sql.txt','','','aadfafd',1,'2017-11-30 00:10:20','2017-11-30 00:10:20'),(16,3,'','afdafdaf','uploads/documents/sql.txt','','','adfafafa',1,'2017-11-30 00:12:23','2017-11-30 00:12:23'),(17,1,'','qrqr','uploads/documents/sql.txt','','','qerqreqreqr',1,'2017-11-30 00:15:03','2017-11-30 00:15:03'),(18,2,'Administration','adfdfafd','uploads/documents/xinhu.txt','','','adfaf',1,'2017-11-30 00:15:45','2017-11-30 00:15:45'),(21,1,'Sales','12',NULL,NULL,NULL,'adfa',1,'2017-11-30 00:57:05','2017-11-30 00:57:05'),(24,2,'Administration','123','uploads/documents/sql.txt','uploads/images/1.png','uploads/videos/xinhu.txt','adfafdafafdafd',1,'2017-11-30 10:51:34','2017-11-30 10:51:34'),(23,1,'Sales','adfas',NULL,NULL,NULL,'adf',1,'2017-11-30 01:03:12','2017-11-30 01:03:12');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'Iphone8','64G',1,'0','1','2017-11-18 13:34:24','2017-11-19 02:19:17'),(2,1,'iphone8 sale order','sell iphone8 1 set',1,'0','1','2017-11-18 22:12:05','2017-11-19 03:51:44'),(3,1,'Iphone8 order2','Purchasing order from Apple.',100,'1','1','2017-11-19 00:19:54','2017-11-19 03:55:14'),(4,2,'S8 purchasing order','S8 purchasing order',100,'1','1','2017-11-19 00:25:39','2017-11-19 00:25:39'),(5,2,'sales order','S8 sales order',1,'0','1','2017-11-19 00:37:46','2017-11-26 03:43:44'),(6,2,'S8','S8 order',100,'0','1','2017-11-19 03:56:10','2017-11-19 04:05:32'),(7,2,'S8-1','S8 128G',1,'1','1','2017-11-19 04:07:06','2017-11-19 04:07:14'),(8,2,'S8 blue','S8 blue',1000,'0','1','2017-11-19 04:12:33','2017-11-19 04:12:50'),(9,2,'s8 blue','s8 blue sale',500,'1','1','2017-11-19 04:13:34','2017-11-19 04:13:39'),(31,21,'Blue ballon','The colour is bule.',56789,'1','0','2017-11-28 04:59:33','2017-11-28 04:59:33'),(23,14,'Vacuum','Electrolux portable vacuum cleaner',100,'0','1','2017-11-27 23:14:42','2017-11-27 23:14:54'),(29,21,'Blue ballon','The colour is bule.',2147483647,'1','1','2017-11-28 04:55:48','2017-11-28 04:57:37'),(30,21,'Blue ballon','The colour is bule.',5678,'0','0','2017-11-28 04:59:00','2017-11-28 04:59:00'),(17,11,'GPS','afdafd',100,'0','1','2017-11-20 13:02:17','2017-11-20 13:02:36'),(20,11,'GPS','adadfa',100,'0','1','2017-11-26 03:38:51','2017-11-26 03:39:17'),(25,14,'Vacuum','Electrolux portable vacuum cleaner',5,'1','1','2017-11-28 00:29:20','2017-11-28 00:29:31'),(22,13,'microwave','Sharp microwave #B-01',10,'0','1','2017-11-27 23:09:41','2017-11-27 23:10:43'),(24,16,'Radiator','Pansonic radiator',100,'0','1','2017-11-27 23:15:34','2017-11-27 23:15:49'),(26,14,'Vacuum','Electrolux portable vacuum cleaner',10,'1','1','2017-11-28 00:31:18','2017-11-28 00:31:31'),(28,21,'Blue ballon','The colour is bule.',2147483647,'0','1','2017-11-28 04:53:36','2017-11-28 04:54:55'),(32,21,'Blue ballon','The colour is bule.',56789,'1','1','2017-11-28 04:59:54','2017-11-28 05:01:14'),(33,21,'Blue ballon','The colour is bule.',56789,'0','1','2017-11-28 05:00:23','2017-11-28 05:01:28'),(34,21,'Blue ballon','The colour is bule.',12345,'0','1','2017-11-28 05:00:39','2017-11-28 05:04:20'),(35,21,'Blue ballon','The colour is bule.',12345,'1','1','2017-11-28 05:00:56','2017-11-28 05:04:27'),(36,21,'Blue ballon','The colour is bule.',10,'1','0','2017-11-30 01:50:01','2017-11-30 01:50:01');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER updatestock 
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
DECLARE sql_count int(10);
IF new.status != old.status and new.status ='1' then
	SET sql_count = (select count(*) from stocks where product_id=new.product_id);

	IF new.type='0'THEN
		IF sql_count = 0 then
			INSERT INTO stocks select null,product_id,name,description,quantity,now(),now() from orders where id=new.id;
		elseif sql_count != 0 then
			update stocks set quantity=quantity+new.quantity where product_id=new.product_id;
		END IF;
	ELSEIF new.type='1' then
		IF sql_count = 0 then
			INSERT INTO stocks select null,product_id,name,description,-quantity,now(),now() from orders where id=new.id;
		elseif sql_count != 0 then
			update stocks set quantity=quantity-new.quantity where product_id=new.product_id;
		END IF;
		Insert into sales select null,orders.product_id,products.category_id,orders.name,orders.description,orders.quantity,products.price,orders.quantity*products.price,now() from orders, products where orders.product_id = products.id and orders.id =new.id;
	END IF;
END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Iphone8','Apple Iphone8 ',20,1200,'2017-11-18 08:29:05','2017-11-20 12:26:27'),(2,'S8','Samsung S8',21,1200,'2017-11-18 12:35:06','2017-11-18 12:35:06'),(21,'Blue ballon','The colour is bule.',117,4,'2017-11-28 04:39:00','2017-11-28 04:39:00'),(4,'ad','adafd',33,3,'2017-11-20 10:51:36','2017-11-20 10:51:36'),(6,'456','',22,NULL,'2017-11-20 10:59:05','2017-11-20 10:59:05'),(7,'testing','',41,NULL,'2017-11-20 11:00:08','2017-11-20 11:00:08'),(8,'adaf','adfadadf',43,NULL,'2017-11-20 12:30:01','2017-11-20 12:30:01'),(9,'aadfd','afd',42,3,'2017-11-20 12:41:16','2017-11-20 12:41:16'),(10,'adff','adasfdfafdadf',44,5,'2017-11-20 12:51:41','2017-11-20 12:51:41'),(11,'GPS','adadfa',16,100,'2017-11-20 13:01:48','2017-11-20 13:01:48'),(13,'microwave','Sharp microwave #B-01',8,200,'2017-11-27 22:50:40','2017-11-27 22:50:40'),(14,'Vacuum','Electrolux portable vacuum cleaner',9,300,'2017-11-27 22:52:02','2017-11-27 22:52:02'),(15,'laptop','Lenovo laptop',11,1500,'2017-11-27 22:52:47','2017-11-27 22:52:47'),(16,'Radiator','Pansonic radiator',10,200,'2017-11-27 22:53:20','2017-11-27 22:53:20'),(22,'Pink ballon','wu liao',117,1.11111e35,'2017-11-28 04:43:13','2017-11-28 05:08:35'),(24,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(25,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(26,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(27,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(28,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(29,'Pink ballon','',117,1.11111e35,'2017-11-28 04:43:14','2017-11-28 04:43:14'),(30,'Pink ballon','The colour is pink.',117,-4,'2017-11-28 04:44:42','2017-11-28 04:44:42');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,1,20,'Iphone8','Apple Iphone8 ',1,1200,1200,'2017-11-19 02:19:17'),(2,1,20,'Iphone8','Apple Iphone8 ',1,1200,1200,'2017-11-19 03:51:44'),(3,2,21,'S8','Samsung S8',100,1200,120000,'2017-11-19 04:05:32'),(4,2,21,'S8','Samsung S8',1000,1200,1200000,'2017-11-19 04:12:50'),(6,1,20,'Iphone8','Apple Iphone8 ',7,1200,8400,'2017-11-20 12:42:23'),(8,11,16,'GPS','adadfa',100,100,10000,'2017-11-20 13:02:36'),(12,21,117,'Blue ballon','The colour is bule.',56789,4,227156,'2017-11-28 05:01:14'),(9,14,9,'Vacuum','Electrolux portable vacuum cleaner',10,300,3000,'2017-11-28 00:31:31'),(11,21,117,'Blue ballon','The colour is bule.',2147483647,4,8589930000,'2017-11-28 04:57:37'),(13,21,117,'Blue ballon','The colour is bule.',12345,4,49380,'2017-11-28 05:04:27');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,1,'iphone8','',101,'2017-11-18 13:43:15','2017-11-18 13:43:15'),(4,2,'S8 blue','S8 blue',501,'2017-11-19 04:12:50','2017-11-19 04:12:50'),(8,11,'GPS','afdafd',150,'2017-11-20 13:02:36','2017-11-20 13:02:36'),(9,13,'microwave','Sharp microwave #B-01',10,'2017-11-27 23:10:43','2017-11-27 23:10:43'),(10,14,'Vacuum','Electrolux portable vacuum cleaner',85,'2017-11-27 23:14:54','2017-11-27 23:14:54'),(11,16,'Radiator','Pansonic radiator',100,'2017-11-27 23:15:49','2017-11-27 23:15:49'),(13,21,'Blue ballon','The colour is bule.',0,'2017-11-28 04:54:55','2017-11-28 04:54:55');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cake_erp'
--

--
-- Dumping routines for database 'cake_erp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-01  0:56:14
