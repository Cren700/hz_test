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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_action`
--

LOCK TABLES `t_admin_action` WRITE;
/*!40000 ALTER TABLE `t_admin_action` DISABLE KEYS */;
INSERT INTO `t_admin_action` VALUES (1,'user/member','会员列表',1,'用户管理'),(2,'user/admin','管理员列表',1,'用户管理'),(3,'user/medium','媒体会员列表',1,'用户管理'),(4,'user/merchant','商户列表',1,'用户管理'),(5,'user/blacklist','黑名单列表',1,'用户管理'),(6,'user/power','权限管理',1,'用户管理'),(7,'user/role','角色管理',1,'用户管理'),(8,'product/index','商品列表',2,'商品管理'),(9,'product/add','添加商品',2,'商品管理'),(10,'product/cate','商品分类',2,'商品管理'),(11,'product/verify','商品审核',2,'商品管理'),(12,'product/recycle','商品回收站',2,'商品管理'),(13,'product/collect','收藏 列表',2,'商品管理'),(14,'order/index','支付列表',3,'订单管理'),(15,'order/tixian','提现列表',3,'订单管理'),(16,'order/claims','理赔列表',3,'订单管理'),(17,'posts/index','资讯列表',4,'资讯管理'),(18,'posts/add','资讯发布',4,'资讯管理'),(19,'posts/cate','资讯分类',4,'资讯管理'),(20,'posts/theme','专题',4,'资讯管理'),(21,'posts/comment','评论审核',4,'资讯管理'),(22,'posts/events','行业动态',4,'资讯管理'),(23,'posts/praise','关注列表',4,'资讯管理'),(24,'finance/account','账户列表',5,'财务管理'),(25,'finance/orderstat','订单统计',5,'财务管理'),(26,'finance/salestat','销售排行',5,'财务管理'),(27,'finance/paytype','支付渠道',5,'财务管理'),(28,'promo/index','广告列表',6,'广告推广管理'),(29,'promo/cateList','广告类型列表',6,'广告推广管理'),(30,'promo/set','推荐设置',6,'广告推广管理'),(31,'product/comment','商品评论',2,'商品管理'),(32,'user/freeback','用户反馈',1,'用户管理'),(34,'user/info','查看用户信息',1,'用户管理'),(35,'user/changestatus','用户状态',1,'用户管理'),(36,'user/addadmin','添加管理员',1,'用户管理'),(38,'user/updateadminrole','修改管理员',1,'用户管理'),(39,'user/changeadminstatus','管理员状态',1,'用户管理'),(40,'user/addrole','添加角色',1,'用户管理'),(41,'user/getrole','修改角色',1,'用户管理'),(43,'user/freebackstatus','反馈操作',1,'用户管理'),(44,'product/status','产品状态',2,'商品管理'),(45,'product/addcate','添加产品分类',2,'商品管理'),(46,'product/getcate','编辑产品分类',2,'商品管理'),(47,'product/statuscomment','产品评论状态',2,'商品管理'),(48,'order/orderstatus','订单操作',3,'订单管理'),(49,'order/txorderstatus','提现操作',3,'订单管理'),(50,'order/claimorderstatus','理赔操作',3,'订单管理'),(51,'order/claimsdetail','编辑理赔',3,'订单管理'),(52,'posts/status','资讯操作',4,'资讯管理'),(53,'posts/addcate','添加资讯分类',4,'资讯管理'),(54,'posts/getcate','编辑资讯分类',4,'资讯管理'),(55,'posts/catestatus','资讯分类操作',4,'资讯管理'),(56,'posts/addtheme','添加专题',4,'资讯管理'),(57,'posts/detail','编辑资讯',4,'资讯管理'),(58,'posts/statustheme','专题操作',4,'资讯管理'),(59,'posts/statuscomment','资讯评论操作',4,'资讯管理'),(60,'posts/addevent','添加行业动态',4,'资讯管理'),(61,'posts/delevent','行业动态操作',4,'资讯管理'),(62,'promo/add','添加广告',6,'广告推广管理'),(63,'promo/status','广告操作',6,'广告推广管理'),(64,'promo/cateadd','添加广告分类',6,'广告推广管理'),(65,'promo/categet','编辑广告分类',6,'广告推广管理'),(66,'promo/addpromorule','添加推广规则',6,'广告推广管理'),(67,'promo/ruledetail','编辑推广规则',6,'广告推广管理'),(68,'promo/rulestatus','推广规则操作',6,'广告推广管理'),(69,'product/detail','编辑产品',2,'商品管理'),(70,'promo/detail','编辑广告',6,'广告推广管理'),(71,'promo/image','侧栏图片',6,'广告推广管理'),(72,'promo/imageadd','添加则栏图片',6,'广告推广管理'),(73,'promo/imagestatus','侧栏操作',6,'广告推广管理'),(74,'promo/imagedetail','编辑侧栏',6,'广告推广管理'),(75,'product/delcate','删除产品分类',2,'商品管理'),(76,'posts/catedel','删除资讯分类',4,'资讯管理'),(77,'promo/catedel','删除广告分类',6,'广告推广管理'),(78,'user/delrole','删除角色',1,'用户管理'),(79,'conf/index','公司配置',7,'配置管理'),(80,'conf/add','添加公司配置',7,'配置管理'),(81,'conf/edit','编辑公司配置',7,'配置管理'),(82,'conf/del','删除公司配置',7,'配置管理');
/*!40000 ALTER TABLE `t_admin_action` ENABLE KEYS */;
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

-- Dump completed on 2017-03-26 20:59:52
