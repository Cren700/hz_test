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
-- Table structure for table `t_application_process`
--

DROP TABLE IF EXISTS `t_application_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_application_process` (
  `Fapp_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fproduct_id` int(11) NOT NULL COMMENT '产品ID',
  `Ftitle` varchar(50) DEFAULT NULL COMMENT '标题',
  `Fcontent` text COMMENT '条件内容',
  `Fcreate_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`Fapp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_application_process`
--

LOCK TABLES `t_application_process` WRITE;
/*!40000 ALTER TABLE `t_application_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_application_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_category` (
  `Fcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `Fcategory_name` varchar(30) NOT NULL COMMENT '分类名称',
  `Fremark` varchar(200) DEFAULT NULL COMMENT '分类说明',
  PRIMARY KEY (`Fcategory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_category`
--

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;
INSERT INTO `t_category` VALUES (1,'疾病互助类吧','疾病互助类疾病互助类疾病互助类'),(2,'2222','意外互助类'),(3,'研究','研究新闻类型'),(4,'其他','其他'),(5,'意外保险','意外不保险'),(6,'疾病类','疾病互助类疾病互助类'),(7,'国际','国际新闻');
/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_favourite_article`
--

DROP TABLE IF EXISTS `t_favourite_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_favourite_article` (
  `Fid` int(11) NOT NULL AUTO_INCREMENT,
  `Fuser_id` varchar(32) NOT NULL,
  `Fproduct_id` int(11) NOT NULL COMMENT '产品ID',
  `Fcreate_time` int(11) NOT NULL,
  PRIMARY KEY (`Fid`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_favourite_article`
--

LOCK TABLES `t_favourite_article` WRITE;
/*!40000 ALTER TABLE `t_favourite_article` DISABLE KEYS */;
INSERT INTO `t_favourite_article` VALUES (35,'aaaa',44,1483253799),(41,'user001',38,1483253827),(50,'user001',34,1484975865),(51,'user001',35,1484975869),(52,'user001',43,1484975882);
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
  `Fcategory_id` tinyint(2) NOT NULL COMMENT 'Category表中的fid',
  `Fstore_id` int(11) unsigned NOT NULL COMMENT '商户ID\n',
  `Fstore_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户类型0：后台，1：商家用户',
  `Fproduct_name` varchar(255) NOT NULL COMMENT '商品名称',
  `Fproduct_num` int(11) NOT NULL COMMENT '产品数量',
  `Fturnover` int(11) NOT NULL DEFAULT '0' COMMENT '成交量（加入计划数量）',
  `Fclaims_num` int(11) NOT NULL DEFAULT '0' COMMENT '理赔数量',
  `Fproduct_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `Fcoverimage` varchar(200) DEFAULT NULL COMMENT '封面',
  `Fproduct_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1：待审核 2：已上架 3：下架 4：已完成 5: 审核不通过',
  `Fcreate_time` int(11) unsigned NOT NULL COMMENT '商品所属企业id',
  `Fupdate_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `Fdescription` text COMMENT '产品描述\n',
  `Fis_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`Fproduct_id`,`Fstore_id`),
  KEY `store_id` (`Fcreate_time`,`Fupdate_time`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_product`
--

LOCK TABLES `t_product` WRITE;
/*!40000 ALTER TABLE `t_product` DISABLE KEYS */;
INSERT INTO `t_product` VALUES (34,2,13,0,'1234',1243,0,0,2143.00,NULL,2,1482501798,1484145645,'89',0),(35,2,13,0,'1234',1243,0,0,2143.00,NULL,2,1482501847,1484145642,'89',0),(36,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502325,1484145076,'女性特定癌症、原位癌、手术',0),(37,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502340,1484145073,'女性特定癌症、原位癌、手术',0),(38,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502385,1484145071,'女性特定癌症、原位癌、手术',0),(39,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502468,1484145068,'女性特定癌症、原位癌、手术',0),(40,1,13,0,'众托帮女性健康互助',999,0,0,100.00,NULL,2,1482502593,1482638175,'女性特定癌症、原位癌、手术',0),(41,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502657,1484145638,'女性特定癌症、原位癌、手术',0),(42,1,13,0,'众托帮女性健康互助',1000,0,0,100.00,NULL,2,1482502699,1482638159,'女性特定癌症、原位癌、手术',0),(43,1,14,0,'1234',1231,0,0,1234.00,NULL,2,1482503029,1482678965,'1234',0),(44,1,14,0,'1234',1234,0,0,1234.00,NULL,1,1482503070,1484463728,'1234',0),(45,1,13,0,'轻轻互助-中青年抗癌互助计划',11000,0,0,900.00,NULL,2,1482593147,1482678962,'平台限时免费加入',0),(46,1,13,0,'轻轻互助-中青年抗癌互助计划',11000,0,0,900.00,NULL,2,1482593170,1484145062,'平台限时免费加入',0),(47,1,13,0,'轻轻互助-中青年抗癌互助计划',10998,0,0,900.00,NULL,2,1482593170,1482678959,'平台限时免费加入',0),(48,1,14,0,'轻轻互助-中青年抗癌互助计划',10988,0,0,900.00,'http://www.dev.huzhu.com/files/img/201612/37d98878057e2f79f38b3c13912abff3.jpg',2,1482593220,1482680118,'平台限时免费加入',0),(49,5,13,0,'夸克联盟-大病互助基金（老年版）',982,0,0,10.00,'http://www.dev.huzhu.com/files/img/201701/bc893641230b531d5b35a507c5e24bfc.jpg',2,1482593660,1484753335,'重疾互助金上限30万元，意外互助金上限50万元',0),(50,1,6,1,'5432112345',1000,0,0,999.00,NULL,1,1486264653,1486264653,'uiouiouiouio',0),(51,2,13,0,'5432',2134,0,0,11.00,NULL,2,1486264728,1486264728,'1234',0),(52,4,13,0,'54321234',11,0,0,234.00,'http://www.dev.huzhu.com/files/img/201702/b4e14b89d6e5f010052a8aa723de4d87.jpg',3,1486264879,1486266466,'1234',0),(53,1,6,1,'啊啊啊',999,0,0,99.00,'http://www.dev.huzhu.com/files/img/201702/8171ca33ffcfb4a936b0999d145f1e17.jpg',4,1486265375,1486265375,'9090',0),(54,1,6,1,'5432112345',999,0,0,999.00,'http://www.dev.huzhu.com/files/img/201702/531cf3c980820a5299c720b299300ae3.jpg',4,1486270582,1486282681,'uiouiouiouio',0),(55,1,6,1,'5432112345',1000,0,0,999.00,'http://www.dev.huzhu.com/files/img/201702/531cf3c980820a5299c720b299300ae3.jpg',3,1486270595,1486281704,'uiouiouiouio',0),(56,1,6,1,'互助计划12412345678',1000,0,0,999.00,'http://www.dev.huzhu.com/files/img/201702/531cf3c980820a5299c720b299300ae3.jpg',1,1486270908,1486281682,'uiouiouiouio',0);
/*!40000 ALTER TABLE `t_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_product_detail`
--

DROP TABLE IF EXISTS `t_product_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_product_detail` (
  `Fproduct_id` int(11) NOT NULL COMMENT '产品ID',
  `Fheight_amount` varchar(200) NOT NULL COMMENT '最高额度',
  `Fscope_insurance` varchar(200) NOT NULL COMMENT '保障范围',
  `Fscope_age` varchar(200) NOT NULL COMMENT '年龄范围',
  `Fobservation_period` varchar(200) NOT NULL COMMENT '观察期',
  `Fcontent` text COMMENT '运营保障',
  `Fplan_rule` text COMMENT '计划规则，(json保存)',
  `Fapplication_process` text COMMENT '申请流程（json数据）',
  `Fq_a` text COMMENT 'QA（json数据）',
  `Fjoint_pledge` text COMMENT '公约（json数据）',
  PRIMARY KEY (`Fproduct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_product_detail`
--

LOCK TABLES `t_product_detail` WRITE;
/*!40000 ALTER TABLE `t_product_detail` DISABLE KEYS */;
INSERT INTO `t_product_detail` VALUES (34,'89','89','8','898','<p>98&nbsp;&nbsp;&nbsp;&nbsp;989&nbsp;&nbsp;&nbsp;&nbsp;88&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;&nbsp;89</p>','[{\"title\":\"12123\",\"desc\":\"123123123\"},{\"title\":\"34543242\",\"desc\":\"2314\"}]','[{\"title\":\"1234\",\"desc\":\"1234\"},{\"title\":\"2134\",\"desc\":\"2134\"},{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"2314\",\"desc\":\"<p>1234<\\/p>\"},{\"title\":\"1234\",\"desc\":\"<p>1234<\\/p>\"}]','[{\"title\":\"4213\",\"desc\":\"<p>4231<\\/p>\"}]'),(35,'89','89','8','898','<p>98&nbsp;&nbsp;&nbsp;&nbsp;989&nbsp;&nbsp;&nbsp;&nbsp;88&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;&nbsp;89</p>','[{\"title\":\"12123\",\"desc\":\"123123123\"},{\"title\":\"34543242\",\"desc\":\"2314\"}]','[{\"title\":\"1234\",\"desc\":\"1234\"},{\"title\":\"2134\",\"desc\":\"2134\"},{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"2314\",\"desc\":\"<p>1234<\\/p>\"},{\"title\":\"1234\",\"desc\":\"<p>1234<\\/p>\"}]','[{\"title\":\"4213\",\"desc\":\"<p>4231<\\/p>\"}]'),(41,'最高10万','6种女性特定癌症、原位癌、手术','18-50周岁女性','90天','','[{\"title\":\"\\u52a0\\u5165\\u6761\\u4ef6\",\"desc\":\"\\u4ec5\\u9650\\u4f1a\\u5458\\uff0c\\u9996\\u6b21\\u6700\\u6b21\\u5145\\u503c10\\u5143\"},{\"title\":\"\\u5206\\u644a\\u89c4\\u5219\",\"desc\":\"\\u5355\\u7b14\\u4e92\\u52a9\\u6700\\u9ad8\\u91d1\\u989d 3\\u5143\\/\\u4eba\"},{\"title\":\"\\u5065\\u5eb7\\u627f\\u8bfa\",\"desc\":\"\\u52a0\\u5165\\u4f17\\u62583\\u53f7\\u5173\\u7231\\u5973\\u6027\\u4e92\\u52a9\\u8ba1\\u5212\\u201c\\u5065\\u5eb7\\u627f\\u8bfa\\u201d\"},{\"title\":\"\\u5b58\\u7eed\\u8d44\\u683c\",\"desc\":\"\\u8d26\\u6237\\u4f59\\u989d\\u5927\\u4e8e0\\u5143\\uff0c\\u957f\\u671f\\u6709\\u6548\"}]','[{\"title\":\"\\u4e92\\u52a9\\u7533\\u8bf7\",\"desc\":\"\\u4e92\\u52a9\\u7533\\u8bf7\"},{\"title\":\"\\u4e8b\\u4ef6\\u8c03\\u67e5\",\"desc\":\"\\u4e8b\\u4ef6\\u8c03\\u67e5\"},{\"title\":\"\\u8d44\\u91d1\\u5212\\u6b3e\",\"desc\":\"\\u8d44\\u91d1\\u5212\\u6b3e\"}]','[{\"title\":\"\\u6211\\u5df2\\u7ecf\\u6709\\u5927\\u75c5\\u4fdd\\u9669\\u4e86\\uff0c\\u8fd8\\u9700\\u8981\\u53c2\\u52a0\\u672c\\u8ba1\\u5212\\u5417\\uff1f\",\"desc\":\"<p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; line-height: 24.8229px; white-space: normal; background-color: rgb(255, 255, 255);\\\\\\\">\\u5173\\u7231\\u5973\\u6027\\u4e92\\u52a9\\u8ba1\\u5212\\u548c\\u533b\\u4fdd\\u4e0d\\u4e92\\u65a5\\uff0c\\u53ef\\u540c\\u65f6\\u4eab\\u6709\\uff0c\\uff08\\u5982\\u60a3\\u75c5\\uff0c\\u53ef\\u540c\\u65f6\\u83b7\\u5f97\\u533b\\u4fdd\\u62a5\\u9500\\u548c\\u4f17\\u6258\\u5e2e\\u4e92\\u52a9\\u91d1\\uff09,\\u662f\\u533b\\u4fdd\\u7684\\u6709\\u529b\\u8865\\u5145\\u3002\\u4e24\\u8005\\u533a\\u522b\\u5982\\u4e0b\\uff1a<\\/p><table class=\\\\\\\"table\\\\\\\" width=\\\\\\\"508\\\\\\\"><tbody style=\\\\\\\"box-sizing: border-box;\\\\\\\"><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\" class=\\\\\\\"firstRow\\\\\\\"><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\"><br\\/><\\/th><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u533b\\u4fdd<\\/th><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u5173\\u7231\\u5973\\u6027<\\/th><\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u6700\\u9ad8\\u989d\\u5ea6<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u6709\\u4e00\\u5b9a\\u81ea\\u8d39\\u9879\\u76ee<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u6700\\u9ad810\\u4e07\\uff0c\\u4e0e\\u533b\\u4fdd\\u53ef\\u53e0\\u52a0<\\/td><\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u7528\\u836f\\u8303\\u56f4<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u533b\\u4fdd\\u89c4\\u5b9a\\u8303\\u56f4\\uff0c\\u8fdb\\u53e3\\u7279\\u6548\\u6297\\u764c\\u836f\\u65e0\\u6cd5\\u62a5\\u9500<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u65e0\\u9650\\u5236<\\/td><\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u62a5\\u9500\\u65b9\\u5f0f<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">\\u5148\\u57ab\\u4ed8\\u540e\\u62a5\\u9500<\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204); word-break: break-all;\\\\\\\">\\u786e\\u8ba4\\u60a3\\u75c5\\uff0c\\u7acb\\u5373\\u6253\\u94b1<\\/td><\\/tr><\\/tbody><\\/table><p><br\\/><\\/p>\"},{\"title\":\"\\u611f\\u89c9\\u764c\\u75c7\\u79bb\\u6211\\u5f88\\u8fdc\\uff0c\\u6709\\u5fc5\\u8981\\u52a0\\u5165\\u6b64\\u8ba1\\u5212\\u5417\\uff1f\",\"desc\":\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; font-size: 17.376px; line-height: 24.8229px; background-color: rgb(255, 255, 255);\\\\\\\">\\u6839\\u636e\\u5168\\u56fd\\u80bf\\u7624\\u767b\\u8bb0\\u4e2d\\u5fc3\\u6570\\u636e\\u663e\\u793a\\uff0c2012\\u5e74\\u6211\\u56fd\\u5973\\u6027\\u7279\\u5b9a\\u75be\\u75c5\\u53d1\\u75c5\\u7387\\u5206\\u522b\\u4e3a\\u4e73\\u817a\\u764c27.3\\/\\u4e07\\u4f8b\\uff0c\\u5bab\\u9888\\u764c9.9\\/\\u4e07\\u4f8b\\uff0c\\u5b50\\u5bab\\u764c6.2\\/\\u4e07\\u4f8b\\uff0c\\u5375\\u5de2\\u764c4.9\\/\\u4e07\\u4f8b\\u3002\\u764c\\u75c7\\u5e76\\u4e0d\\u53ef\\u6015\\uff0c\\u53ef\\u6015\\u7684\\u662f\\u6ca1\\u6709\\u8db3\\u591f\\u7684\\u6cbb\\u7597\\u91d1\\u3002<\\/span><\\/p>\"},{\"title\":\"\\u5173\\u7231\\u5973\\u6027\\u4e92\\u52a9\\u8ba1\\u5212\\u7684\\u4e92\\u52a9\\u8303\\u56f4\\u6709\\u54ea\\u4e9b\\uff1f\",\"desc\":\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; font-size: 17.376px; line-height: 24.8229px; background-color: rgb(255, 255, 255);\\\\\\\">\\u672c\\u4e92\\u52a9\\u8ba1\\u5212\\u5305\\u542b\\u4e866\\u79cd\\u5973\\u6027\\u7279\\u5b9a\\u75be\\u75c5\\uff0c6\\u79cd\\u5973\\u6027\\u7279\\u5b9a\\u539f\\u4f4d\\u764c\\u548c3\\u79cd\\u7279\\u5b9a\\u624b\\u672f\\u30026\\u79cd\\u5973\\u6027\\u7279\\u5b9a\\u75be\\u75c5\\u5305\\u62ec\\u4e73\\u817a\\u764c\\u3001\\u5b50\\u5bab\\u764c\\u3001\\u5bab\\u9888\\u764c\\u3001\\u5375\\u5de2\\u764c\\u3001\\u8f93\\u5375\\u7ba1\\u764c\\u3001\\u9634\\u9053\\u764c\\u30026\\u79cd\\u5973\\u6027\\u7279\\u5b9a\\u539f\\u4f4d\\u764c\\u6307\\u5973\\u6027\\u4e73\\u817a\\u3001\\u5b50\\u5bab\\u3001\\u5b50\\u5bab\\u9888\\u3001\\u5375\\u5de2\\u3001\\u8f93\\u5375\\u7ba1\\u548c\\u9634\\u9053\\u7684\\u539f\\u4f4d\\u764c\\u30023\\u79cd\\u5973\\u6027\\u7279\\u5b9a\\u624b\\u672f\\u662f\\u610f\\u5916\\u9762\\u90e8\\u6574\\u5f62\\u624b\\u672f\\u3001\\u5b50\\u5bab\\u5207\\u9664\\u624b\\u672f\\u548c\\u5168\\u4e73\\u623f\\u5207\\u9664\\u624b\\u672f\\u3002\\uff08\\u5177\\u4f53\\u91ca\\u4e49\\u53ef\\u4ee5\\u53c2\\u8003\\u8ba1\\u5212\\u7ae0\\u7a0b\\uff09<\\/span><\\/p>\"},{\"title\":\"\\u9996\\u6b21\\u5145\\u503c10\\u5143\\u8fd8\\u6709\\u5176\\u4ed6\\u82b1\\u8d39\\u5417\\uff1f\",\"desc\":\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; font-size: 17.376px; line-height: 24.8229px; background-color: rgb(255, 255, 255);\\\\\\\">\\u9996\\u6b21\\u5145\\u503c\\u768410\\u5143\\u662f\\u52a0\\u5165\\u5e73\\u53f0\\u9884\\u5b58\\u8d39\\u7528\\uff0c\\u5982\\u679c\\u5e73\\u53f0\\u4e2d\\u5176\\u4ed6\\u4f1a\\u5458\\u60a3\\u75c5\\u5219\\u9700\\u8981\\u5927\\u5bb6\\u5206\\u644a\\u8d39\\u7528\\uff08\\u6bcf\\u6b21\\u5206\\u644a\\u4e0d\\u8d85\\u8fc73\\u5143\\uff09\\u3002\\u53ea\\u9700\\u8981\\u8d26\\u53f7\\u4e0a\\u7684\\u4f59\\u989d\\u5927\\u4e8e0\\u5143\\u5c31\\u80fd\\u6301\\u7eed\\u6709\\u6548\\u3002\\u53c2\\u4e0e\\u8ba1\\u5212\\u7684\\u4eba\\u6570\\u8d8a\\u591a\\uff0c\\u540c\\u6837\\u7684\\u4e92\\u52a9\\u91d1\\u603b\\u989d\\uff0c\\u6bcf\\u6b21\\u6bcf\\u4f4d\\u4f1a\\u5458\\u5206\\u644a\\u7684\\u91d1\\u989d\\u5c31\\u8d8a\\u4f4e\\u3002<\\/span><\\/p>\"}]','[{\"title\":\"\\u8ba1\\u5212\\u5b97\\u65e8\",\"desc\":\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; font-size: 17.376px; line-height: 24.8229px; background-color: rgb(255, 255, 255);\\\\\\\">\\u4f17\\u62583\\u53f7\\u5173\\u7231\\u5973\\u6027\\u4e92\\u52a9\\u8ba1\\u5212\\u5728\\u81ea\\u613f\\u52a0\\u5165\\u7684\\u524d\\u63d0\\u4e0b\\uff0c\\u672c\\u7740\\u201c\\u4e92\\u52a9\\u4e92\\u7231\\u201d\\u7684\\u5b97\\u65e8\\uff0c\\u5728\\u4e92\\u52a9\\u4f1a\\u5458\\u4e0d\\u5e78\\u7f79\\u60a3\\u672c\\u8ba1\\u5212\\u7ea6\\u5b9a\\u7684\\u75be\\u75c5\\u6216\\u8fdb\\u884c\\u7279\\u5b9a\\u624b\\u672f\\u65f6\\uff0c\\u5176\\u4ed6\\u4e92\\u52a9\\u4f1a\\u5458\\u4e3a\\u5176\\u8fdb\\u884c\\u4e92\\u52a9\\u3002<\\/span><\\/p>\"}]'),(42,'最高10万','6种女性特定癌症、原位癌、手术','18-50周岁女性','90天','<p>98&nbsp;&nbsp;&nbsp;&nbsp;989&nbsp;&nbsp;&nbsp;&nbsp;88&nbsp;&nbsp;&nbsp;&nbsp;9&nbsp;&nbsp;&nbsp;&nbsp;89<span style=\\\"color: rgb(153, 153, 153); font-family: STHeiti, &quot;Microsoft YaHei&quot;, Helvetica, Arial, sans-serif; font-size: 20.272px; line-height: 28.96px; text-align: justify; background-color: rgb(255, 255, 255);\\\">.事件调查</span></p>','[{\\\"title\\\":\\\"加入条件\\\",\\\"desc\\\":\\\"仅限会员，首次最次充值10元\\\"},{\\\"title\\\":\\\"分摊规则\\\",\\\"desc\\\":\\\"单笔互助最高金额 3元\\\\/人\\\"},{\\\"title\\\":\\\"健康承诺\\\",\\\"desc\\\":\\\"加入众托3号关爱女性互助计划“健康承诺”\\\"},{\\\"title\\\":\\\"存续资格\\\",\\\"desc\\\":\\\"账户余额大于0元，长期有效\\\"}]','[{\\\"title\\\":\\\"互助申请\\\",\\\"desc\\\":\\\"互助申请\\\"},{\\\"title\\\":\\\"事件调查\\\",\\\"desc\\\":\\\"事件调查\\\"},{\\\"title\\\":\\\"资金划款\\\",\\\"desc\\\":\\\"资金划款\\\"}]','[{\\\"title\\\":\\\"我已经有大病保险了，还需要参加本计划吗？\\\",\\\"desc\\\":\\\"<p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">关爱女性互助计划和医保不互斥，可同时享有，（如患病，可同时获得医保报销和众托帮互助金）,是医保的有力补充。两者区别如下：<\\\\/p><table class=\\\\\\\"table\\\\\\\" width=\\\\\\\"508\\\\\\\"><tbody style=\\\\\\\"box-sizing: border-box;\\\\\\\"><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\" class=\\\\\\\"firstRow\\\\\\\"><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\"><br\\\\/><\\\\/th><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">医保<\\\\/th><th style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">关爱女性<\\\\/th><\\\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">最高额度<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">有一定自费项目<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">最高10万，与医保可叠加<\\\\/td><\\\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">用药范围<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">医保规定范围，进口特效抗癌药无法报销<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">无限制<\\\\/td><\\\\/tr><tr style=\\\\\\\"box-sizing: border-box;\\\\\\\"><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">报销方式<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204);\\\\\\\">先垫付后报销<\\\\/td><td style=\\\\\\\"box-sizing: border-box; padding: 8px; line-height: 1.42857; vertical-align: top; border-color: rgb(204, 204, 204); word-break: break-all;\\\\\\\">确认患病，立即打钱<\\\\/td><\\\\/tr><\\\\/tbody><\\\\/table><p><br\\\\/><\\\\/p>\\\"},{\\\"title\\\":\\\"感觉癌症离我很远，有必要加入此计划吗？\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">众托3号关爱女性互助计划在自愿加入的前提下，本着“互助互爱”的宗旨，在互助会员不幸罹患本计划约定的疾病或进行特定手术时，其他互助会员为其进行互助。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"关爱女性互助计划的互助范围有哪些？\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">众托3号关爱女性互助计划在自愿加入的前提下，本着“互助互爱”的宗旨，在互助会员不幸罹患本计划约定的疾病或进行特定手术时，其他互助会员为其进行互助。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"首次充值10元还有其他花费吗？\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">众托3号关爱女性互助计划在自愿加入的前提下，本着“互助互爱”的宗旨，在互助会员不幸罹患本计划约定的疾病或进行特定手术时，其他互助会员为其进行互助。<\\\\/span><\\\\/p>\\\"}]','[{\\\"title\\\":\\\"计划宗旨\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">本计划为互助金预缴型计划，预缴的互助金不能与众托帮平台上其他计划共享使用。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"加入与退出\\\",\\\"desc\\\":\\\"<p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">互助会员可自愿加入、自愿退出本计划。<\\\\/p><p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">3.1加入条件<br\\\\/>（1） 互助会员本人申请。<br\\\\/>（2） 本计划接受的加入时年龄范围为出生满18周岁至50周岁(含)。<br\\\\/>（3） 加入本计划之时身体健康，一年内无重大疾病及相关症状就诊或治疗史。<br\\\\/>（4） 认同并承诺遵守《众托帮互助平台会员公约》以及本章程的规定。<\\\\/p><p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">3.2退出机制<br\\\\/>（1） 互助会员身故、已给付互助金或年满56周岁，自动退出。<br\\\\/>（2） 互助金账户余额低于￥1元，且在规定期限内未缴足，自动退出。<br\\\\/>（3） 有一次未能履行互助义务，自动退出。<br\\\\/>（4） 《众托帮互助平台会员公约》和本章程规定的其他情况。<\\\\/p><p><br\\\\/><\\\\/p>\\\"}]'),(43,'2134','2134','1234','2134','','[{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"1234\",\"desc\":\"<p>1234<\\/p>\"}]','[{\"title\":\"12341234\",\"desc\":\"<p>12341234<\\/p>\"}]'),(44,'2134','2134','1234','2134','<p>2314</p>','[{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"1234\",\"desc\":\"1234\"}]','[{\"title\":\"1234\",\"desc\":\"<p>1234<\\/p>\"}]','[{\"title\":\"12341234\",\"desc\":\"<p>12341234<\\/p>\"}]'),(45,'最高30万','胃癌、肝癌等各种癌症','8-50周岁，身体健康','180天（为防止带病加入）','<p><img src=\\\"/files/img/201612/1482593144535872.png\\\" title=\\\"1482593144535872.png\\\" alt=\\\"blob.png\\\"/></p>','[]','[]','[]','[]'),(46,'最高30万','胃癌、肝癌等各种癌症','8-50周岁，身体健康','180天（为防止带病加入）','<p><img src=\\\"/files/img/201612/1482593144535872.png\\\" title=\\\"1482593144535872.png\\\" alt=\\\"blob.png\\\"/></p>','[]','[]','[]','[]'),(47,'最高30万','胃癌、肝癌等各种癌症','8-50周岁，身体健康','180天（为防止带病加入）','<p><img src=\\\"/files/img/201612/1482593144535872.png\\\" title=\\\"1482593144535872.png\\\" alt=\\\"blob.png\\\"/></p>','[]','[]','[]','[]'),(48,'最高30万','胃癌、肝癌等各种癌症','8-50周岁，身体健康','180天（为防止带病加入）','<p><img src=\\\"/files/img/201612/1482593144535872.png\\\" title=\\\"1482593144535872.png\\\" alt=\\\"blob.png\\\"/></p>','[]','[]','[]','[]'),(49,'最高50万','重疾+意外伤害','0-60周岁，18-65周岁','180天后生效','<p><img src=\\\"/files/img/201612/1482593478931646.png\\\" title=\\\"1482593478931646.png\\\" alt=\\\"blob.png\\\"/></p>','[{\\\"title\\\":\\\"加入条件\\\",\\\"desc\\\":\\\"互助对象仅限会员，9元加入\\\"},{\\\"title\\\":\\\"分摊规则\\\",\\\"desc\\\":\\\"发生互助时，全体分摊，单次上限3元\\\"},{\\\"title\\\":\\\"健康规则\\\",\\\"desc\\\":\\\"加入本计划时，需无重大疾病史及相关症状就诊记录，无慢性病史。\\\"},{\\\"title\\\":\\\"资格存续\\\",\\\"desc\\\":\\\"如社员有一次因为任何原因未能履行互助义务，将自动丧失互助资格。\\\"}]','[{\\\"title\\\":\\\"申请互助\\\",\\\"desc\\\":\\\"申请互助1234\\\"},{\\\"title\\\":\\\"准备材料\\\",\\\"desc\\\":\\\"准备材料\\\"},{\\\"title\\\":\\\"事件调查\\\",\\\"desc\\\":\\\"事件调查\\\"},{\\\"title\\\":\\\"事件公示\\\",\\\"desc\\\":\\\"事件公示\\\"},{\\\"title\\\":\\\"资金划款\\\",\\\"desc\\\":\\\"资金划款\\\"}]','[{\\\"title\\\":\\\"关于壁虎互助？\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">壁虎互助平台于2015年3月正式上线运营，是独立运营的网络互助平台。互助会员采用全员摊销的方式，体现的是风雨共担的互助精神；长期保障依赖会员的许飞，体现保障权益于互助义务的对等。平台由北京必互科技有限公司发起并运营管理。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"如何保证互助事件的真实性和公平性\\\",\\\"desc\\\":\\\"<p style=\\\\\\\"box-sizing: border-box; margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0.4rem; font-size: 17.376px; color: rgb(79, 166, 60);\\\\\\\"><span style=\\\\\\\"font-size: 16px;\\\\\\\">互助事件是由上海商保通健康科技有限公司作为第三方专业机构进行审核，平台会将审核结果向所有会员公示，公示无异议后方发起扣费转账。对互助事件的审核结果有异议时，申请人可以进行申诉，由会员组成的评审团进行仲裁。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"<p>12341234<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"壁虎互助平台简介\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">壁虎互助平台（以下简称“平台”）是由“北京必互科技有限公司”组织和运营的互助组织。平台上的所有互助计划本着“我为人人，人人为我”的精神，强调互助权利和义务的对等，以公正透明为基本准则。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"计划类型\\\",\\\"desc\\\":\\\"<p><span style=\\\\\\\"color: rgb(79, 166, 60); font-family: STHeiti, \\\\\\\">平台上的各项计划根据互助金缴纳方式，分为两种类型：预缴型及非预缴型。<\\\\/span><\\\\/p>\\\"},{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"<p>12341234<\\\\/p>\\\"}]'),(50,'99999','90-100','10-20','30','<p>trewqtrewq</p>','[{\\\"title\\\":\\\"54321\\\",\\\"desc\\\":\\\"trewq\\\"},{\\\"title\\\":\\\"321\\\",\\\"desc\\\":\\\"ewq\\\"}]','[{\\\"title\\\":\\\"654321654321\\\",\\\"desc\\\":\\\"654321\\\"}]','[{\\\"title\\\":\\\"4321\\\",\\\"desc\\\":\\\"<p>43214321<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"43214321\\\",\\\"desc\\\":\\\"<p>432432432432<\\\\/p>\\\"}]'),(51,'111','10-20','90-100','30','<p>3214</p>','[{\\\"title\\\":\\\"1\\\",\\\"desc\\\":\\\"2\\\"}]','[{\\\"title\\\":\\\"1\\\",\\\"desc\\\":\\\"1\\\"}]','[{\\\"title\\\":\\\"3\\\",\\\"desc\\\":\\\"<p>1<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"3\\\",\\\"desc\\\":\\\"<p>1<\\\\/p>\\\"}]'),(52,'123','11','10-20','20','<p>1234</p>','[{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"1243\\\"}]','[{\\\"title\\\":\\\"234\\\",\\\"desc\\\":\\\"345\\\"}]','[{\\\"title\\\":\\\"123\\\",\\\"desc\\\":\\\"<p>234<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"<p>234<\\\\/p>\\\"}]'),(53,'9999','909090','91-100','90','<p>1212</p>','[{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"1234\\\"}]','[{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"1234\\\"}]','[{\\\"title\\\":\\\"123\\\",\\\"desc\\\":\\\"<p>1234<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"1234\\\",\\\"desc\\\":\\\"<p>1234<\\\\/p>\\\"}]'),(54,'99999','90-100','10-20','30','<p>trewqtrewq</p>','[{\\\"title\\\":\\\"54321\\\",\\\"desc\\\":\\\"trewq\\\"},{\\\"title\\\":\\\"321\\\",\\\"desc\\\":\\\"ewq\\\"}]','[{\\\"title\\\":\\\"654321654321\\\",\\\"desc\\\":\\\"654321\\\"}]','[{\\\"title\\\":\\\"4321\\\",\\\"desc\\\":\\\"<p>43214321<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"43214321\\\",\\\"desc\\\":\\\"<p>432432432432<\\\\/p>\\\"}]'),(55,'99999','90-100','10-20','30','<p>trewqtrewq</p>','[{\\\"title\\\":\\\"54321\\\",\\\"desc\\\":\\\"trewq\\\"},{\\\"title\\\":\\\"321\\\",\\\"desc\\\":\\\"ewq\\\"}]','[{\\\"title\\\":\\\"654321654321\\\",\\\"desc\\\":\\\"654321\\\"}]','[{\\\"title\\\":\\\"4321\\\",\\\"desc\\\":\\\"<p>43214321<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"43214321\\\",\\\"desc\\\":\\\"<p>432432432432<\\\\/p>\\\"}]'),(56,'99999','90-100','10-20','30','<p>trewqtrewq</p>','[{\\\"title\\\":\\\"54321\\\",\\\"desc\\\":\\\"trewq\\\"},{\\\"title\\\":\\\"321\\\",\\\"desc\\\":\\\"ewq\\\"}]','[{\\\"title\\\":\\\"654321654321\\\",\\\"desc\\\":\\\"654321\\\"}]','[{\\\"title\\\":\\\"4321\\\",\\\"desc\\\":\\\"<p>43214321<\\\\/p>\\\"}]','[{\\\"title\\\":\\\"43214321\\\",\\\"desc\\\":\\\"<p>432432432432<\\\\/p>\\\"}]');
/*!40000 ALTER TABLE `t_product_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_product_realdata`
--

DROP TABLE IF EXISTS `t_product_realdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_product_realdata` (
  `Fproduct_id` int(11) NOT NULL,
  `Fjoin_num` int(11) NOT NULL DEFAULT '0',
  `Fjoin_amt` decimal(10,2) NOT NULL COMMENT '加入计划总金额',
  `Fclaim_num` int(11) NOT NULL DEFAULT '0',
  `Fclaim_amt` decimal(10,2) NOT NULL COMMENT '理赔总金额',
  `Fremark` text,
  `Fupdate_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`Fproduct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_product_realdata`
--

LOCK TABLES `t_product_realdata` WRITE;
/*!40000 ALTER TABLE `t_product_realdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_product_realdata` ENABLE KEYS */;
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

-- Dump completed on 2017-02-05 19:49:17
