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
-- Table structure for table `t_account`
--

DROP TABLE IF EXISTS `t_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_account` (
  `Fuser_id` varchar(32) NOT NULL,
  `Famount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '资金',
  `Fcoupon` int(11) DEFAULT '0' COMMENT '优惠券',
  `Fintegral` int(11) DEFAULT '0' COMMENT '积分',
  `Fremark` varchar(255) DEFAULT NULL,
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fupdate_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`Fuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_account`
--

LOCK TABLES `t_account` WRITE;
/*!40000 ALTER TABLE `t_account` DISABLE KEYS */;
INSERT INTO `t_account` VALUES ('user001',100.00,0,0,NULL,NULL,NULL),('user002',200.00,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `t_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin`
--

DROP TABLE IF EXISTS `t_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin` (
  `Fid` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `Fuser_id` varchar(32) NOT NULL COMMENT '用户登录名',
  `Fpasswd` varchar(60) NOT NULL COMMENT '密码',
  `Fsalt` varchar(8) NOT NULL COMMENT '加密盐',
  `Fuser_type` tinyint(1) DEFAULT NULL COMMENT '运营管理用户1， 企业管理用户2',
  `Fpid` bigint(11) NOT NULL COMMENT '父账号ID',
  `Frole_id` int(11) DEFAULT NULL,
  `Flevel` tinyint(1) NOT NULL,
  `Fstatus` tinyint(1) unsigned DEFAULT '1' COMMENT '0：无效 1：有效 ',
  `Fremember_token` varchar(20) DEFAULT '' COMMENT '记录登陆',
  `Fcreate_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `Fupdate_time` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  `Fremark` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`Fid`,`Fuser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='后台管理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin`
--

LOCK TABLES `t_admin` WRITE;
/*!40000 ALTER TABLE `t_admin` DISABLE KEYS */;
INSERT INTO `t_admin` VALUES (13,'admin','619cf3d2691c11af59f5d3b811440302','XrBvf41',1,0,41,1,1,'',1480430167,1481551133,NULL),(14,'admin1','f9e4c28a3c6d481b5402777259408777','iAigi',2,0,41,1,1,'',1480430167,1480430927,NULL),(15,'Test1234','fe9c94bda01a4e38fd7730a2793d7958','8r9It',1,0,41,1,1,'',1486485052,1486485052,NULL),(16,'Test12','d0ee42cf871c9433d27c369f8f9c14d4','fc1R8vX',1,0,41,1,1,'',1486485070,1486485070,NULL),(17,'Test','aa3207eb3d871b15b2c15fc33dc50222','eGKLV',1,0,40,1,1,'',1486485184,1486485184,NULL);
/*!40000 ALTER TABLE `t_admin` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_action`
--

LOCK TABLES `t_admin_action` WRITE;
/*!40000 ALTER TABLE `t_admin_action` DISABLE KEYS */;
INSERT INTO `t_admin_action` VALUES (1,'user/member','会员列表',1,'用户管理'),(2,'user/admin','管理员列表',1,'用户管理'),(3,'user/medium','媒体会员列表',1,'用户管理'),(4,'user/merchant','商户列表',1,'用户管理'),(5,'user/blacklist','黑名单列表',1,'用户管理'),(6,'user/power','权限管理',1,'用户管理'),(7,'user/role','角色管理',1,'用户管理'),(8,'product/index','商品列表',2,'商品管理'),(9,'product/add','添加商品',2,'商品管理'),(10,'product/cate','商品分类',2,'商品管理'),(11,'product/verify','商品审核',2,'商品管理'),(12,'product/recycle','商品回收站',2,'商品管理'),(13,'product/collect','收藏 列表',2,'商品管理'),(14,'order/index','支付列表',3,'订单管理'),(15,'order/tixian','提现列表',3,'订单管理'),(16,'order/claims','理赔列表',3,'订单管理'),(17,'posts/index','资讯列表',4,'资讯管理'),(18,'posts/add','资讯发布',4,'资讯管理'),(19,'posts/cate','资讯分类',4,'资讯管理'),(20,'posts/theme','专题',4,'资讯管理'),(21,'posts/comment','评论审核',4,'资讯管理'),(22,'posts/events','行业动态',4,'资讯管理'),(23,'posts/praise','关注列表',4,'资讯管理'),(24,'finance/account','账户列表',5,'财务管理'),(25,'finance/orderstat','订单统计',5,'财务管理'),(26,'finance/salestat','销售排行',5,'财务管理'),(27,'finance/paytype','支付渠道',5,'财务管理'),(28,'promo/index','广告列表',6,'广告推广管理'),(29,'promo/cateList','广告类型列表',6,'广告推广管理'),(30,'promo/set','推荐设置',6,'广告推广管理');
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
  `Flogo_path` varchar(60) DEFAULT NULL COMMENT '头像/logo图片路径',
  `Femail` varchar(30) DEFAULT NULL COMMENT 'e-mail邮箱地址',
  `Fphone` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `Fcountry` varchar(20) DEFAULT NULL COMMENT '国家',
  `Fprovice` varchar(10) DEFAULT NULL COMMENT '省',
  `Fcity` varchar(10) DEFAULT NULL COMMENT '市',
  `Faddress` varchar(128) DEFAULT NULL COMMENT '个人或者企业地址',
  `Fannex_path` varchar(128) DEFAULT NULL COMMENT '附件， 认证上传图片的路径',
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
INSERT INTO `t_admin_detail` VALUES (13,'互助之家','新闻媒体',1,'1111','/files/img/201612/b5b7e9d208c1145cbc027767b6216503.jpg','64941111@qq.com','1242141234','1234',NULL,NULL,'654321','/files/img/201612/9900948d4234f4e61690a7d4c16b9ee0.jpg',0,1481902780,1481644755,'654321');
/*!40000 ALTER TABLE `t_admin_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_permission`
--

DROP TABLE IF EXISTS `t_admin_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_permission` (
  `Fperm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Fperm_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'url址址',
  `Fperm_name` varchar(50) NOT NULL DEFAULT '' COMMENT '权限名称',
  `Fis_menu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单:1是，0否',
  `Fis_manage` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否是管理中心：1是，0否',
  `Fcontroller` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器',
  `Faction` varchar(50) NOT NULL DEFAULT '' COMMENT '操作',
  `Fparent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级权限id',
  `Ficon` varchar(50) DEFAULT '' COMMENT '菜单图标',
  `Forder` int(11) unsigned DEFAULT '0' COMMENT '权限排序',
  `Fstatus` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1:启用 0:停用',
  `Fcreate_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `Fremark` varchar(255) DEFAULT '' COMMENT '权限说明',
  PRIMARY KEY (`Fperm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COMMENT='权限表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_permission`
--

LOCK TABLES `t_admin_permission` WRITE;
/*!40000 ALTER TABLE `t_admin_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_permission` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_role`
--

LOCK TABLES `t_admin_role` WRITE;
/*!40000 ALTER TABLE `t_admin_role` DISABLE KEYS */;
INSERT INTO `t_admin_role` VALUES (40,'chaoji','chaoji',1,'1,2'),(41,'超级管理员','超级管理员',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30'),(42,'Test','Test',1,'1,2,3'),(43,'会员','会员',1,'2'),(44,'Ttest','Ttest',1,'1,2,12'),(45,'管理员','普通管理员',1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30');
/*!40000 ALTER TABLE `t_admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_user_role_del`
--

DROP TABLE IF EXISTS `t_admin_user_role_del`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_user_role_del` (
  `Fuser_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `Frole_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `Fis_manger` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '管理：1管理中心，0商户中心',
  KEY `user_id` (`Fuser_id`,`Fis_manger`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_user_role_del`
--

LOCK TABLES `t_admin_user_role_del` WRITE;
/*!40000 ALTER TABLE `t_admin_user_role_del` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_user_role_del` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_blackuser_list`
--

DROP TABLE IF EXISTS `t_blackuser_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_blackuser_list` (
  `Fid` int(11) NOT NULL,
  `Fuser_type` tinyint(1) NOT NULL COMMENT '用户类型 1、内部管理用户 2、合作商户 3、媒体用户 4、普通用户',
  `Freason` varchar(200) NOT NULL COMMENT '原因',
  `Fcreate_time` int(11) NOT NULL,
  `Fremark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_blackuser_list`
--

LOCK TABLES `t_blackuser_list` WRITE;
/*!40000 ALTER TABLE `t_blackuser_list` DISABLE KEYS */;
INSERT INTO `t_blackuser_list` VALUES (17,2,'',1481948440,NULL),(21,2,'',1481947438,NULL),(25,3,'',1481948482,NULL),(26,4,'',1482641919,NULL);
/*!40000 ALTER TABLE `t_blackuser_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `Fid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Fuser_id` varchar(32) NOT NULL COMMENT '登陆用户ID',
  `Fpasswd` varchar(60) DEFAULT NULL COMMENT '密码',
  `Fsalt` varchar(8) DEFAULT NULL COMMENT '加密盐',
  `Fuser_type` varchar(45) DEFAULT NULL COMMENT '用户类型 1、内部管理用户 2、合作商户 3、媒体用户 4、普通用户',
  `Flog_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '登录类型0：普通，1：微信，2：QQ, 3：手机登录',
  `Fsubscribe` tinyint(1) DEFAULT '0',
  `Fis_blackuser` tinyint(1) DEFAULT '0',
  `Fstatus` tinyint(1) DEFAULT '1' COMMENT '状态 0: 禁用，1：使用',
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fupdate_time` int(11) DEFAULT NULL,
  `Fremark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Fid`,`Fuser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (3,'admin11','16574940c94d24f01bebd4e3823e5997','fcCX3','4',0,0,0,1,1480337570,1480345782,NULL),(4,'a1dmin','d00e90d41cb7d3b4270dae81aecd7591','bX6m','3',0,0,0,0,1480340532,1480340532,NULL),(5,'user','842281865174bd3ee41856a0edab708a','6pmzMxE4','4',0,0,0,1,1480340789,1480340789,NULL),(6,'user001','deb55934feb040159d91fd5cc8b6dec7','svjN2','3',0,0,0,1,1481721922,1484138768,NULL),(7,'user002','7db0cbe6faaece41ebb31172443321ad','vXXvwSIP','2',0,0,0,1,1481722031,1481722031,NULL),(8,'user652','5d551660f3a987b08a8823367787e94f','yY3Pv08','4',0,0,0,1,1481722031,1481722031,NULL),(9,'user183','a1e42fc29d32959dc976a27b2cd3ddb5','V6a1NLkK','4',0,0,0,1,1481722031,1481722031,NULL),(10,'user704','bc6d3ad36cff34d40547175628a75042','OdVO8XAA','4',0,0,0,0,1481722031,1481722031,NULL),(11,'user693','f859fb6b84242214c1ef38459c2f4900','2jJ4YF','4',0,0,0,1,1481722031,1481722031,NULL),(12,'user812','3cb27167ae9515ba9848ba6d23e824ee','wKsY','4',0,0,0,NULL,1481722031,1481722031,NULL),(13,'user301','30932111f60cb163095659614c765dd6','GQKQgulh','4',0,0,0,NULL,1481722031,1481722031,NULL),(14,'user127','0714c0c971eeb65b226d1952ecae97c3','jA6NT','4',0,0,0,NULL,1481722031,1481722031,NULL),(15,'user159','2a5179d7ba375dbb7b8dc27cafa890fd','48zqHqGr','4',0,0,0,NULL,1481722031,1481722031,NULL),(16,'user641','61731b9240dd8a0b019b8f8b72088230','jqFF','4',0,0,0,1,1481722031,1481722031,NULL),(17,'user424','de401e6d1651171f4e7da1cf7a115543','o2tsW3','2',0,0,1,0,1481722060,1481722060,NULL),(18,'user732','97995e925df363f8640f9b03e8a64d36','dafAq6','3',0,0,0,1,1481722060,1481722060,NULL),(19,'user210','fbcbc1112d7303c6edc124344957ff0a','rU5WnP','1',0,0,0,1,1481722060,1481722060,NULL),(20,'user264','af065dd8cf3104439e3271a100a1e653','y1aaYvT','1',0,0,0,1,1481722060,1481722060,NULL),(21,'user272','f85158cafdd2f43f4d8953e6a50051f0','FX43S','2',0,0,1,1,1481722060,1481722060,NULL),(22,'user538','f33c4281c32df52362ad28aca55d8ba5','XwlYFaB','1',0,0,0,1,1481722060,1481722060,NULL),(23,'user192','ac320927dcefe1273fae88482be42aff','PXc5q','4',0,0,0,1,1481722060,1481722060,NULL),(24,'user524','b553a2f96cd83691b16e034706813953','Wg4t','3',0,0,0,0,1481722060,1481722060,NULL),(25,'user967','f0eba8ebd71b0a00f782fdf57005b313','kJ3o4O9','3',0,0,1,0,1481722060,1481722060,NULL),(26,'user585','086005e94250b5df021c24ed1f36c102','TYsHC9Xw','4',0,0,1,NULL,1481722060,1481722060,NULL),(27,'user100','e20e5b3271f02a2f31878ee31e27aa01','K1T3','4',0,0,0,1,1484142425,1484142425,NULL),(28,'user12','8b0c91f1eeec7f3481bf9b6a8be02c38','e3cnw','4',0,0,0,1,1484142490,1484142490,NULL),(29,'user123','4b44193f434848831349ca3daea12e59','FIem','4',0,0,0,1,1484142516,1484142516,NULL),(30,'user1232','5c16a1e8d9caf06ccbe747785c185ebd','Ha3I','4',0,0,0,1,1484142536,1484142536,NULL),(31,'user111','968da0c3bede357da3f4a25a268bab6c','6kbR3','4',0,0,0,1,1484142590,1484142590,NULL),(32,'user1234','36879b49dc4f0a3db4327979d1b6fe2d','vXgvUXjY','4',0,0,0,1,1484142730,1484142730,NULL),(33,'user12343','3626eec106eeb32f9e21e28710efffb1','0beaob4','4',0,0,0,1,1484142788,1484142788,NULL),(34,'user123431','fb92e353986044770751c12212088308','F8jk','4',0,0,0,1,1484142829,1484142829,NULL),(35,'aaaa','5d8f1312986aec5755d39d845226b9d3','5VIrAiFj','4',0,0,0,1,1484147692,1484147692,NULL),(36,'012hwRm8pIZDTkB_AUBFEsnmSW4',NULL,NULL,'4',1,0,0,1,1484402513,1484402513,NULL),(37,'o012hwRm8pIZDTkB_AUBFEsnmSW4',NULL,NULL,'4',1,0,0,1,1484402606,1484402606,NULL),(39,'qqqqqq','183a599ba3b04b0d68025cf21f6ca2ac','Pr0ssYaU','4',0,0,0,1,1484492445,1484492445,NULL),(40,'user0011','7c861122c88c3fb89570c42c282799dc','SDuvxMTa','4',0,0,0,1,1484492562,1484492562,NULL),(41,'user00111','7c22c718e20d2839596e860d308e451e','wIg0y','4',0,0,0,1,1484492586,1484492586,NULL),(42,'admin1','f11c623259afba5acfc055d591c01bdb','87ZWzP','4',0,0,0,1,1484492600,1484492600,NULL),(43,'13631255371',NULL,NULL,'3',3,0,0,1,1485179581,1485179581,NULL);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user_detail`
--

DROP TABLE IF EXISTS `t_user_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user_detail` (
  `Fuser_id` int(11) NOT NULL COMMENT '用户ID,与t_user中的id对应不是useri_id',
  `Fnick_name` varchar(40) DEFAULT NULL COMMENT '用户昵称',
  `Freal_name` varchar(10) DEFAULT NULL COMMENT '真实名称',
  `Fcert_type` tinyint(2) DEFAULT NULL COMMENT '证件类型 1：身份证，2：驾驶证 3：护照 4：港澳证',
  `Fcert_no` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `Fsex` tinyint(1) DEFAULT NULL,
  `Femail` varchar(60) DEFAULT NULL COMMENT 'email地址',
  `Fphone` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `Fcountry` varchar(4) DEFAULT NULL COMMENT '国家',
  `Fprovince` varchar(4) DEFAULT NULL COMMENT '省份',
  `Fcity` varchar(4) DEFAULT NULL COMMENT '城市',
  `Faddress` varchar(120) DEFAULT NULL COMMENT '地址',
  `Fatte_status` tinyint(1) NOT NULL COMMENT '实名认证状态 0：未认证，1已认证',
  `Fimage_path` varchar(255) DEFAULT NULL COMMENT '头像路径',
  `Fannex_path` varchar(255) DEFAULT NULL COMMENT '证件照片',
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fupdate_time` int(11) DEFAULT '0',
  `Fremark` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`Fuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user_detail`
--

LOCK TABLES `t_user_detail` WRITE;
/*!40000 ALTER TABLE `t_user_detail` DISABLE KEYS */;
INSERT INTO `t_user_detail` VALUES (3,'nick1','Cren',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,1480342136,1480342819,NULL),(6,'654321','654321',3,'65432',1,'649460214@qq.com','65432543',NULL,'5432',NULL,'6543265432',1,'http://www.dev.huzhu.com/files/img/201701/907150162927f97c3adb0592e20863ee.jpg','http://www.dev.huzhu.com/files/img/201701/76a958fcdb51cec270885e625d32efae.jpg',NULL,1484913488,NULL),(10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,1481943323,1481943323,NULL),(12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,1481943320,1481943320,NULL),(14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,1481943281,1481943281,NULL),(15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,1481943313,1481943313,NULL),(16,'1234321','432123',1,'432123432',1,'','','','','','',1,'',NULL,1481939326,1481939326,''),(17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,1481944405,1481944405,NULL),(21,',,','12345',0,'',1,'','','','','','',0,'','',1482064480,1482064480,''),(25,'12345','123',0,'',1,'','','','','','',1,'','',1481944490,1482064466,''),(26,'q4123','12132312',2,'1234567890-34567890',1,'','','','','','',0,'/files/img/201612/7dcb71a5791f90c591a145d3867785ab.jpeg','/files/img/201612/b7c7d77ace905edfb498e611a463c3d1.jpg',NULL,1481945445,'65432543265432'),(35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,1484150469,1484150469,NULL),(36,'Cren',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'http://wx.qlogo.cn/mmopen/vMUEcG7d3MkloaLWAe6x6MfV89OkCjENAK5qicsqjDuxtsXdJ4rXYnXTFylYjrB50OxYdibaL1SIGftqyy7b5IYibwMMJicjibx6Y/0',NULL,NULL,0,NULL),(37,'Cren',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'http://wx.qlogo.cn/mmopen/vMUEcG7d3MkloaLWAe6x6MfV89OkCjENAK5qicsqjDuxtsXdJ4rXYnXTFylYjrB50OxYdibaL1SIGftqyy7b5IYibwMMJicjibx6Y/0',NULL,NULL,0,NULL),(38,'{',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'{',NULL,NULL,0,NULL),(42,'',NULL,0,'',1,'','','','','','',0,'','',1484838300,1484841131,''),(43,'','',0,'',1,'','',NULL,'',NULL,'',1,'http://www.dev.huzhu.com/files/img/201701/c333cc937cbbe9ffe2b040e8014b2179.jpg','',1485187547,1486126854,NULL);
/*!40000 ALTER TABLE `t_user_detail` ENABLE KEYS */;
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

-- Dump completed on 2017-02-10 19:52:37
