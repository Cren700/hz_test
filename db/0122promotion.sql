-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: PROMOTION_DB
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
-- Table structure for table `t_adv_prom`
--

DROP TABLE IF EXISTS `t_adv_prom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_adv_prom` (
  `Factive_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '活动编号',
  `Factive_name` varchar(50) NOT NULL COMMENT '活动名称',
  `Fcategory_id` varchar(50) NOT NULL DEFAULT '1',
  `Fimage_path` varchar(100) NOT NULL COMMENT '图片路径',
  `Factive_url` varchar(100) NOT NULL COMMENT 'url地址',
  `Fvendor` varchar(50) NOT NULL COMMENT '投放厂商',
  `Flevel` tinyint(1) NOT NULL COMMENT '广告优先级 1,2,3,数字越大优先级越低',
  `Fstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '处理状态 1：使用，0：禁用',
  `Fcreate_time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`Factive_id`),
  UNIQUE KEY `Factive_id` (`Factive_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_adv_prom`
--

LOCK TABLES `t_adv_prom` WRITE;
/*!40000 ALTER TABLE `t_adv_prom` DISABLE KEYS */;
INSERT INTO `t_adv_prom` VALUES (2,'1234','5','http://www.dev.huzhu.com/files/img/201701/0a4f6c26f63e232b5db8ca40c20006b5.jpg','www.baidu.com','1',3,0,1483710230),(4,'广告名称1','2','http://www.dev.huzhu.com/files/img/201701/17d49f6f671a64cbd8f4ea0ed2b65685.jpg','www.hao123.com','qqqq',1,0,1483710187),(5,'保险广告','1','http://www.dev.huzhu.com/files/img/201701/3eb7c0c752307809a44194d96e712b11.jpg','www.sohu.com','sohu',1,0,1483712117);
/*!40000 ALTER TABLE `t_adv_prom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_category` (
  `Fcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fcategory_name` varchar(30) NOT NULL COMMENT '类型名称',
  `Fremark` varchar(200) DEFAULT NULL COMMENT '类型描述',
  PRIMARY KEY (`Fcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_category`
--

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;
INSERT INTO `t_category` VALUES (1,'广告1','广告1'),(2,'分类2','分类2222'),(3,'1234','123'),(4,'1234','1234'),(5,'1234','1234'),(6,'1234','1234');
/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_expand`
--

DROP TABLE IF EXISTS `t_expand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_expand` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Fid` varchar(50) NOT NULL COMMENT '流水编号',
  `Fuser_id` varchar(32) NOT NULL COMMENT '用户ID',
  `Famount` decimal(10,2) DEFAULT '0.00' COMMENT '返利金额（分）',
  `Fmember` varchar(30) NOT NULL COMMENT '注册会员',
  `Fmember_time` varchar(20) NOT NULL COMMENT '会员名称',
  `Freg_time` varchar(30) DEFAULT NULL COMMENT '注册时间',
  `Fphone` char(11) NOT NULL COMMENT '电话',
  `Fcreate_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `Fid` (`Fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_expand`
--

LOCK TABLES `t_expand` WRITE;
/*!40000 ALTER TABLE `t_expand` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_expand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_promo_rule`
--

DROP TABLE IF EXISTS `t_promo_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_promo_rule` (
  `Frule_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Fshare_type` tinyint(4) NOT NULL DEFAULT '2' COMMENT '分享类型',
  `Famount` int(11) DEFAULT '0' COMMENT '返利金额（分）',
  `Fintegral` int(11) DEFAULT '0' COMMENT '积分',
  `Fcreate_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`Frule_id`),
  UNIQUE KEY `Frule_id` (`Frule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_promo_rule`
--

LOCK TABLES `t_promo_rule` WRITE;
/*!40000 ALTER TABLE `t_promo_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_promo_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'PROMOTION_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-22 18:52:24
