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
  `Fret_msg` text COMMENT '返回的错误信息',
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_sms_send`
--

LOCK TABLES `t_sms_send` WRITE;
/*!40000 ALTER TABLE `t_sms_send` DISABLE KEYS */;
INSERT INTO `t_sms_send` VALUES (1,1,'2isqdrw0269m','尊敬的用户，您的验证码为：509167，请及时登录，5分钟后失效。','13631255371',1485101595,1,'发送成功'),(2,1,'eq6t5yfqzlc2','尊敬的用户，您的验证码为：525518，请及时登录，5分钟后失效。','13631255371',1485101642,1,'发送成功'),(3,1,'ziolw3wlsso2','尊敬的用户，您的验证码为：710593，请及时登录，5分钟后失效。','13631255371',1485101729,1,'发送成功'),(4,1,'3b4e2aufhq9y','尊敬的用户，您的验证码为：454921，请及时登录，5分钟后失效。','13631255371',1485101816,0,'发送成功'),(5,1,'10wjli57sfj5p','尊敬的用户，您的验证码为：454921，请及时登录，5分钟后失效。','13631255371',1485101816,0,'发送成功'),(6,1,'12l8umbrwotoj','尊敬的用户，您的验证码为：454921，请及时登录，5分钟后失效。','13631255371',1485101817,0,'发送成功'),(7,1,'zqb2pq3x50uc','尊敬的用户，您的验证码为：805991，请及时登录，5分钟后失效。','13631255371',1485168127,0,'短信签名不合法'),(8,1,'zqbrnp2bmu8r','尊敬的用户，您的验证码为：805991，请及时登录，5分钟后失效。','13631255371',1485168129,0,'短信签名不合法'),(9,1,'12lp4tienq9yw','尊敬的用户，您的验证码为：805991，请及时登录，5分钟后失效。','13631255371',1485168129,0,'短信签名不合法'),(10,1,'qm3ug34l9wo0','尊敬的用户，您的验证码为：992642，请及时登录，5分钟后失效。','13631255371',1485169862,0,'短信签名不合法'),(11,1,'3b4ayxzhp7er','尊敬的用户，您的验证码为：992642，请及时登录，5分钟后失效。','13631255371',1485169862,0,'短信签名不合法'),(12,1,'rxw6dr0nd0uj','尊敬的用户，您的验证码为：992642，请及时登录，5分钟后失效。','13631255371',1485169862,0,'短信签名不合法'),(13,1,'z2615pfqljba','尊敬的用户，您的验证码为：648026，请及时登录，5分钟后失效。','13631255371',1485173189,0,'短信签名不合法'),(14,1,'z28ptcdxouhx','尊敬的用户，您的验证码为：648026，请及时登录，5分钟后失效。','13631255371',1485173190,0,'短信签名不合法'),(15,1,'qm3euwcgumbq','尊敬的用户，您的验证码为：648026，请及时登录，5分钟后失效。','13631255371',1485173190,0,'短信签名不合法'),(16,1,'epv15dvnpj7z','尊敬的用户，您的验证码为：292665，请及时登录，5分钟后失效。','13631255371',1485173224,0,'短信签名不合法'),(17,1,'ryol2lqv9uwn','尊敬的用户，您的验证码为：292665，请及时登录，5分钟后失效。','13631255371',1485173224,0,'短信签名不合法'),(18,1,'11igfv0udoahx','尊敬的用户，您的验证码为：292665，请及时登录，5分钟后失效。','13631255371',1485173224,0,'短信签名不合法'),(19,1,'uu8qo84722p','尊敬的用户，您的验证码为：361748，请及时登录，5分钟后失效。','13631255371',1485174437,1,'发送成功'),(20,1,'rsrnbrbqni0','尊敬的用户，您的验证码为：248737，请及时登录，5分钟后失效。','13631255371',1485179521,1,'发送成功'),(21,1,'10f32j9y3uyqg','尊敬的用户，您的验证码为：497016，请及时登录，5分钟后失效。','13631255371',1485181747,1,'发送成功'),(22,1,'10fjsawh796mk','尊敬的用户，您的验证码为：676531，请及时登录，5分钟后失效。','13631255371',1485187584,1,'发送成功'),(23,1,'11if2bhhp901r','尊敬的用户，您的验证码为：926368，请及时登录，5分钟后失效。','13631255371',1486122500,1,'发送成功'),(24,1,'3jvu372d2jy1','尊敬的用户，您的验证码为：189179，请及时登录，5分钟后失效。','13631255371',1486296600,1,'发送成功'),(25,1,'1476lsp37bcyn','尊敬的用户，您的验证码为：531479，请及时登录，5分钟后失效。','13631255371',1486729382,1,'发送成功'),(26,1,'3g3ccpreekjn','尊敬的用户，您的验证码为：376330，请及时登录，5分钟后失效。','13631255371',1486740439,0,'触发业务流控'),(27,1,'12lp29v6cig7w','尊敬的用户，您的验证码为：839821，请及时登录，5分钟后失效。','13631255371',1486744677,0,'触发业务流控'),(28,1,'qm2qhgngc2ip','尊敬的用户，您的验证码为：839821，请及时登录，5分钟后失效。','13631255371',1486744682,0,'触发业务流控'),(29,1,'2el9occ6j0nc','尊敬的用户，您的验证码为：839821，请及时登录，5分钟后失效。','13631255371',1486744687,0,'触发业务流控'),(30,1,'iv17dwaa7ize','尊敬的用户，您的验证码为：522881，请及时登录，5分钟后失效。','13631255371',1486744708,0,'触发业务流控'),(31,1,'uh6hzn3gfx5','尊敬的用户，您的验证码为：522881，请及时登录，5分钟后失效。','13631255371',1486744713,0,'触发业务流控'),(32,1,'2el3fum4i7vf','尊敬的用户，您的验证码为：522881，请及时登录，5分钟后失效。','13631255371',1486744719,0,'触发业务流控'),(33,1,'ztb6q7g4t7e0','尊敬的用户，您的验证码为：624184，请及时登录，5分钟后失效。','13631255371',1487388257,1,'发送成功'),(34,1,'12cktkfebd4ye','尊敬的用户，您的验证码为：569015，请及时登录，5分钟后失效。','13631255371',1487686510,1,'发送成功'),(35,1,'el0vy6gjggy5','尊敬的用户，您的验证码为：998563，请及时登录，5分钟后失效。','13631255731',1487947010,1,'发送成功'),(36,1,'12jrschep4w8e','尊敬的用户，您的验证码为：687614，请及时登录，5分钟后失效。','15820701272',1487947246,1,'发送成功'),(37,1,'2lv3vk2mvqxw','尊敬的用户，您的验证码为：646492，请及时登录，5分钟后失效。','13631255371',1488461649,0,'余额不足'),(38,1,'2mh3u4w23fyv','尊敬的用户，您的验证码为：646492，请及时登录，5分钟后失效。','13631255371',1488461654,0,'余额不足'),(39,1,'12lruo6p2rlgx','尊敬的用户，您的验证码为：646492，请及时登录，5分钟后失效。','13631255371',1488461660,0,'余额不足'),(40,1,'12l7uf9vnln23','尊敬的用户，您的验证码为：160041，请及时登录，5分钟后失效。','13631255371',1488461665,0,'余额不足'),(41,1,'10wc6kuzoj6h1','尊敬的用户，您的验证码为：160041，请及时登录，5分钟后失效。','13631255371',1488461670,0,'余额不足'),(42,1,'s751vkgjtadk','尊敬的用户，您的验证码为：160041，请及时登录，5分钟后失效。','13631255371',1488461676,0,'余额不足'),(43,1,'1476g6u988mnv','尊敬的用户，您的验证码为：566748，请及时登录，5分钟后失效。','13631255371',1488461681,0,'余额不足'),(44,1,'epv8kukmcnrf','尊敬的用户，您的验证码为：566748，请及时登录，5分钟后失效。','13631255371',1488461686,0,'余额不足'),(45,1,'ze1kkriq4d0k','尊敬的用户，您的验证码为：566748，请及时登录，5分钟后失效。','13631255371',1488461691,0,'余额不足'),(46,1,'zddxdi9k13go','尊敬的用户，您的验证码为：228744，请及时登录，5分钟后失效。','13631255371',1488461857,0,'余额不足'),(47,1,'iuzx8n0ym9w8','尊敬的用户，您的验证码为：228744，请及时登录，5分钟后失效。','13631255371',1488461862,0,'余额不足'),(48,1,'42coamrwj9ne','尊敬的用户，您的验证码为：228744，请及时登录，5分钟后失效。','13631255371',1488461867,0,'余额不足'),(49,1,'xnfpe4qfusx','尊敬的用户，您的验证码为：593873，请及时登录，5分钟后失效。','13631255371',1488461945,0,'余额不足'),(50,1,'3glzc6i2u8vo','尊敬的用户，您的验证码为：593873，请及时登录，5分钟后失效。','13631255371',1488461950,1,'发送成功'),(51,1,'z25z8fpcjcv3','尊敬的用户，您的验证码为：159558，请及时登录，5分钟后失效。','13631255371',1488462037,1,'发送成功');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_verify_code`
--

LOCK TABLES `t_verify_code` WRITE;
/*!40000 ALTER TABLE `t_verify_code` DISABLE KEYS */;
INSERT INTO `t_verify_code` VALUES (1,'875635',1485101712,1485102012,1),(2,'710593',1485101729,1485102029,1),(3,'361748',1485174437,1485174737,1),(4,'248737',1485179521,1485679821,1),(5,'497016',1485181747,1485182047,0),(6,'611687',1485187481,1485187781,0),(7,'676531',1485187584,1485987884,1),(8,'926368',1486122500,1486124300,0),(9,'189179',1486296600,1486298400,0),(10,'531479',1486729382,1486731182,0),(11,'624184',1487388257,1487390057,0),(12,'569015',1487686510,1487688310,0),(13,'998563',1487947010,1487948810,0),(14,'687614',1487947246,1487949046,0),(15,'593873',1488461950,1488463750,0),(16,'159558',1488462037,1488563837,0);
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

-- Dump completed on 2017-03-04 11:16:48
