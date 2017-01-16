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
-- Table structure for table `t_blackuser_list`
--

DROP TABLE IF EXISTS `t_blackuser_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_blackuser_list` (
  `Fuser_id` varchar(20) NOT NULL,
  `Fuser_type` tinyint(1) NOT NULL COMMENT '用户类型 1、个人普通用户 2、个人微信用户 3、企业总商户\r',
  `Freason` varchar(200) NOT NULL COMMENT '原因',
  `Fcreate_time` int(11) NOT NULL,
  `Fremark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Fuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_blackuser_list`
--

LOCK TABLES `t_blackuser_list` WRITE;
/*!40000 ALTER TABLE `t_blackuser_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_blackuser_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_email_send`
--

DROP TABLE IF EXISTS `t_email_send`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_email_send` (
  `Fid` int(11) NOT NULL,
  `Fbuss_type` tinyint(1) NOT NULL COMMENT '业务类型 1:注册短信验证 2:支付短信验证',
  `Femail_id` varchar(50) NOT NULL COMMENT 'email编号',
  `Femail_content` varchar(300) DEFAULT NULL COMMENT '内容',
  `Femail_addr` varchar(20) NOT NULL COMMENT 'email地址',
  `Fcreate_time` int(11) NOT NULL COMMENT '发送时间',
  `Fstatus` tinyint(1) NOT NULL COMMENT '发送状态 0:不成功 1：成功',
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_email_send`
--

LOCK TABLES `t_email_send` WRITE;
/*!40000 ALTER TABLE `t_email_send` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_email_send` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_post_comments`
--

DROP TABLE IF EXISTS `t_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_post_comments` (
  `Fcomment_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fcomment_post_id` int(11) DEFAULT NULL,
  `Fcomment_parent_id` int(11) DEFAULT NULL COMMENT '父评论编号',
  `Fcomment_author_id` int(11) DEFAULT NULL COMMENT '评论者id',
  `Fcomment_author_name` varchar(20) DEFAULT NULL COMMENT '评论者名称',
  `Fcomment_author_ip` varchar(45) DEFAULT NULL COMMENT 'ip',
  `Fcomment_date` int(11) DEFAULT NULL,
  `Fcomment_content` text,
  `Fcomment_approved` tinyint(1) DEFAULT '0' COMMENT '审核状态0：未审核，1:审核通过，2：审核不通过',
  PRIMARY KEY (`Fcomment_id`),
  KEY `index` (`Fcomment_post_id`),
  KEY `index2` (`Fcomment_parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_post_comments`
--

LOCK TABLES `t_post_comments` WRITE;
/*!40000 ALTER TABLE `t_post_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_sms_send`
--

DROP TABLE IF EXISTS `t_sms_send`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_sms_send` (
  `Fid` int(11) NOT NULL AUTO_INCREMENT,
  `Fbuss_type` tinyint(1) NOT NULL COMMENT '业务类型 1:注册短信验证 2:支付短信验证',
  `Fsms_id` varchar(50) NOT NULL COMMENT '短信编号',
  `Fsms_content` varchar(300) DEFAULT NULL COMMENT '短信内容',
  `Fmobile_no` varchar(20) NOT NULL COMMENT '手机号码',
  `Fcreate_time` int(11) NOT NULL COMMENT '发送时间',
  `Fstatus` tinyint(1) NOT NULL COMMENT '发送状态 0:不成功 1：成功',
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_sms_send`
--

LOCK TABLES `t_sms_send` WRITE;
/*!40000 ALTER TABLE `t_sms_send` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_sms_send` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_verify_code`
--

DROP TABLE IF EXISTS `t_verify_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_verify_code` (
  `Fverifycode_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fverifycode` varchar(6) NOT NULL COMMENT '校验码',
  `Fbegin_time` int(11) NOT NULL COMMENT '开始时间',
  `Fend_time` int(11) NOT NULL COMMENT '结束时间',
  `Fstatus` tinyint(1) NOT NULL COMMENT '有效状态 0：无效 1：有效',
  PRIMARY KEY (`Fverifycode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_verify_code`
--

LOCK TABLES `t_verify_code` WRITE;
/*!40000 ALTER TABLE `t_verify_code` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_verify_code` ENABLE KEYS */;
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

-- Dump completed on 2017-01-16 22:57:02
