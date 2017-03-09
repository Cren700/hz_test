-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: USER_DB
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
-- Table structure for table `t_admin_action`
--

DROP TABLE IF EXISTS `t_admin_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_action` (
  `Fid` int(11) NOT NULL AUTO_INCREMENT,
  `Faction_url` varchar(200) NOT NULL COMMENT '操作路径',
  `Faction_name` varchar(45) NOT NULL COMMENT '操作名称',
  `Faction_type` tinyint(2) DEFAULT NULL,
  `Ftype_name` varchar(20) DEFAULT NULL COMMENT '类型\n',
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_action`
--

LOCK TABLES `t_admin_action` WRITE;
/*!40000 ALTER TABLE `t_admin_action` DISABLE KEYS */;
INSERT INTO `t_admin_action` VALUES (1,'user/member','会员列表',1,'用户管理'),(2,'user/admin','管理员列表',1,'用户管理'),(3,'user/medium','媒体会员列表',1,'用户管理'),(4,'user/merchant','商户列表',1,'用户管理'),(5,'user/blacklist','黑名单列表',1,'用户管理'),(6,'user/power','权限管理',1,'用户管理'),(7,'user/role','角色管理',1,'用户管理'),(8,'product/index','商品列表',2,'商品管理'),(9,'product/add','添加商品',2,'商品管理'),(10,'product/cate','商品分类',2,'商品管理'),(11,'product/verify','商品审核',2,'商品管理'),(12,'product/recycle','商品回收站',2,'商品管理'),(13,'product/collect','收藏 列表',2,'商品管理'),(14,'order/index','支付列表',3,'订单管理'),(15,'order/tixian','提现列表',3,'订单管理'),(16,'order/claims','理赔列表',3,'订单管理'),(17,'posts/index','资讯列表',4,'资讯管理'),(18,'posts/add','资讯发布',4,'资讯管理'),(19,'posts/cate','资讯分类',4,'资讯管理'),(20,'posts/theme','专题',4,'资讯管理'),(21,'posts/comment','评论审核',4,'资讯管理'),(22,'posts/events','行业动态',4,'资讯管理'),(23,'posts/praise','关注列表',4,'资讯管理'),(24,'finance/account','账户列表',5,'财务管理'),(25,'finance/orderstat','订单统计',5,'财务管理'),(26,'finance/salestat','销售排行',5,'财务管理'),(27,'finance/paytype','支付渠道',5,'财务管理'),(28,'promo/index','广告列表',6,'广告推广管理'),(29,'promo/cateList','广告类型列表',6,'广告推广管理'),(30,'promo/set','推荐设置',6,'广告推广管理'),(31,'product/comment','商品评论',2,'商品管理'),(32,'user/freeback','用户反馈',1,'用户管理');
/*!40000 ALTER TABLE `t_admin_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_detail`
--

DROP TABLE IF EXISTS `t_admin_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_detail` (
  `Fuser_id` int(11) NOT NULL COMMENT '用户号ID， 与t_admin中的id对应不是useri_id',
  `Freal_name` varchar(30) DEFAULT NULL COMMENT '门店名或者企业名',
  `Findustry` varchar(20) DEFAULT NULL COMMENT '企业所处行业',
  `Fcert_type` tinyint(1) DEFAULT NULL COMMENT '证件类型',
  `Fcert_no` varchar(20) DEFAULT NULL COMMENT '证件号码',
  `Femail` varchar(30) DEFAULT NULL COMMENT 'e-mail邮箱地址',
  `Fphone` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `Fcountry` varchar(20) DEFAULT NULL COMMENT '国家',
  `Fprovice` varchar(10) DEFAULT NULL COMMENT '省',
  `Fcity` varchar(10) DEFAULT NULL COMMENT '市',
  `Faddress` varchar(128) DEFAULT NULL COMMENT '个人或者企业地址',
  `Fannex_path` varchar(128) DEFAULT NULL COMMENT '附件， 认证上传图片的路径',
  `Fimage_path` varchar(128) DEFAULT NULL COMMENT '头像/logo图片路径',
  `Fatte_status` tinyint(1) DEFAULT NULL COMMENT '实名认证状态0：未认证1：待审核2：已认证',
  `Fupdate_time` int(11) DEFAULT NULL,
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fremark` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`Fuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_detail`
--

LOCK TABLES `t_admin_detail` WRITE;
/*!40000 ALTER TABLE `t_admin_detail` DISABLE KEYS */;
INSERT INTO `t_admin_detail` VALUES (13,'互助之家','新闻媒体',1,'1111','64941111@qq.com','1242141234','1234',NULL,NULL,'654321','http://www.dev.huzhu.com/files/img/201702/03da31f955b0aac7c0306e53b77ab26f.jpeg','http://www.dev.huzhu.com/files/img/201702/d07e3283f7ca6789e5658abed3548bfb.jpg',0,1488294275,1481644755,'654321');
/*!40000 ALTER TABLE `t_admin_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_role`
--

DROP TABLE IF EXISTS `t_admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_role` (
  `Frole_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `Frole_name` varchar(20) NOT NULL COMMENT '角色名称',
  `Fdesc` varchar(100) DEFAULT '' COMMENT '角色说明',
  `Fstatus` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 1:启用 2:停用',
  `Faction_ids` varchar(300) DEFAULT NULL COMMENT '操作ids,以‘，’分割',
  PRIMARY KEY (`Frole_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_role`
--

LOCK TABLES `t_admin_role` WRITE;
/*!40000 ALTER TABLE `t_admin_role` DISABLE KEYS */;
INSERT INTO `t_admin_role` VALUES (40,'chaoji','chaoji',1,'1,2'),(41,'超级管理员','超级管理员',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30'),(42,'Test','Test',1,'1,2,3'),(43,'会员','会员',1,'2'),(50,'TEST','TETST',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32'),(44,'Ttest','Ttest',1,'1,2,12'),(45,'管理员','普通管理员',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30');
/*!40000 ALTER TABLE `t_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'USER_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-10  0:44:30
