-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: PRODUCT_DB
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
-- Table structure for table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_category` (
  `Fcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fcategory_name` varchar(30) NOT NULL COMMENT '分类名称',
  `Fremark` varchar(200) NOT NULL COMMENT '分类说明',
  PRIMARY KEY (`Fcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_category`
--

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;
INSERT INTO `t_category` VALUES (1,'疾病互助类吧','疾病互助类疾病互助类疾病互助类'),(2,'2222','意外互助类'),(3,'汽车互助类','汽车互助类'),(4,'其他','其他'),(5,'意外保险','意外不保险'),(6,'疾病类','疾病互助类疾病互助类');
/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_favourite_article`
--

DROP TABLE IF EXISTS `t_favourite_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_favourite_article` (
  `Fid` varchar(20) NOT NULL,
  `Fuser_id` varchar(20) NOT NULL,
  `Fproduct_id` varchar(20) NOT NULL COMMENT '产品ID',
  `Fcreate_time` int(11) NOT NULL,
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_favourite_article`
--

LOCK TABLES `t_favourite_article` WRITE;
/*!40000 ALTER TABLE `t_favourite_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_favourite_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_product`
--

DROP TABLE IF EXISTS `t_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_product` (
  `Fproduct_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fcategory_id` int(11) NOT NULL COMMENT 'Category表中的fid',
  `Fstore_id` int(11) unsigned NOT NULL COMMENT '商户ID\n',
  `Fproduct_name` varchar(255) NOT NULL COMMENT '商品名称',
  `Fproduct_num` bigint(11) NOT NULL COMMENT '产品数量',
  `Fproduct_price` float(7,2) NOT NULL COMMENT '商品价格',
  `Fproduct_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1：待审核 2：已上架 3：下架 4：已完成',
  `Fcreate_time` int(11) unsigned NOT NULL COMMENT '商品所属企业id',
  `Fupdate_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `Fremark` text,
  `Fis_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`Fproduct_id`,`Fstore_id`),
  KEY `store_id` (`Fcreate_time`,`Fupdate_time`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_product`
--

LOCK TABLES `t_product` WRITE;
/*!40000 ALTER TABLE `t_product` DISABLE KEYS */;
INSERT INTO `t_product` VALUES (1,1,13,'壁虎互助',100,100.03,1,1480516636,1480516636,NULL,0),(2,3,13,'抗癌公社',10000,10000.00,1,1480516812,1480518492,NULL,0),(3,2,13,'抗癌公社1',10000,10000.00,2,1480516812,1480518492,NULL,0),(4,3,13,'抗癌公社2',10000,10000.00,1,1480516812,1480518492,NULL,0),(5,3,13,'抗癌公社3',10000,10000.00,2,1480516812,1481212524,NULL,0),(6,3,13,'抗癌公社',10000,10000.00,4,1480516812,1480518492,NULL,0),(7,2,13,'抗癌公社1',10000,10000.00,1,1480516812,1480518492,NULL,0),(8,3,13,'抗癌公社2',10000,10000.00,2,1480516812,1481212527,NULL,0),(9,3,13,'抗癌公社3',10000,10000.00,3,1480516812,1480518492,NULL,0),(10,3,13,'抗癌公社',10000,10000.00,1,1480516812,1480518492,NULL,0),(11,2,13,'抗癌公社1',10000,10000.00,1,1480516812,1481208884,NULL,0),(12,3,13,'抗癌公社2',10000,10000.00,1,1480516812,1480518492,NULL,0),(13,3,13,'抗癌公社3',10000,10000.00,1,1480516812,1481208309,NULL,0),(14,3,14,'抗癌公社',10000,10000.00,1,1480516812,1480518492,NULL,0),(15,2,13,'抗癌公社1',10000,10000.00,1,1480516812,1480518492,NULL,0),(16,3,15,'抗癌公社2',10000,10000.00,1,1480516812,1480518492,NULL,0),(17,3,14,'抗癌公社3',10000,10000.00,1,1480516812,1480518492,NULL,0),(18,1,13,'测试产品',100,90.30,1,1481040789,1481208875,NULL,1),(19,3,13,'ceshi',10,100.30,1,1481040913,1481210076,NULL,1),(20,1,13,'ceshi',123,123.00,2,1481040995,1481121997,NULL,1),(21,3,13,'啊哈哈111',200,100.30,1,1481109739,1481124186,'',0),(22,3,13,'1234',123,11.00,2,1481110101,1481283263,NULL,0),(23,3,13,'1234',12,123.00,4,1481110137,1481209005,NULL,0),(24,2,13,'123',123,123.00,4,1481115416,1481208887,NULL,0),(25,1,13,'壁虎互助',100,100.03,2,1480516636,1481209142,NULL,0),(26,3,13,'抗癌公社',10000,10000.00,1,1480516812,1481212642,NULL,0),(27,4,13,'1121212',111,111.00,2,1481283537,1481283547,'',0);
/*!40000 ALTER TABLE `t_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'PRODUCT_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-10 10:18:34
