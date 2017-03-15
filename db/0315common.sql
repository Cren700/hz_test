-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: COMMON_DB
-- ------------------------------------------------------
-- Server version	5.7.13

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
-- Table structure for table `t_image_info`
--

DROP TABLE IF EXISTS `t_image_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_image_info` (
  `Fid` int(11) NOT NULL AUTO_INCREMENT,
  `Fimage_url` varchar(200) DEFAULT NULL,
  `Furl` varchar(200) DEFAULT NULL,
  `Fvalid_time` int(11) DEFAULT NULL COMMENT '有效时间',
  `Flevel` tinyint(1) DEFAULT NULL COMMENT '越小越先',
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fstatus` varchar(45) DEFAULT '0' COMMENT '0：禁止，1：启用',
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_image_info`
--

LOCK TABLES `t_image_info` WRITE;
/*!40000 ALTER TABLE `t_image_info` DISABLE KEYS */;
INSERT INTO `t_image_info` VALUES (2,'http://www.dev.huzhu.com/files/img/201703/c815bff3df003ed1718d2ee8380e0ebb.jpg','www.baidu.com',NULL,1,1489590145,'0'),(3,'http://www.dev.huzhu.com/files/img/201703/487ac2e84bebad76ffbaab1e32c7a1cf.jpg','http://cren700wx.sinaapp.com/',NULL,2,1489590158,'1');
/*!40000 ALTER TABLE `t_image_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'COMMON_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-15 23:54:34
