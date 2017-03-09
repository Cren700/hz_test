-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: ORDER_DB
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
-- Table structure for table `t_order`
--

DROP TABLE IF EXISTS `t_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_order` (
  `Forder_no` varchar(32) NOT NULL,
  `Fuser_id` varchar(32) NOT NULL,
  `Fproduct_id` varchar(20) NOT NULL,
  `Fproduct_name` varchar(20) NOT NULL,
  `Fproduct_price` decimal(10,2) NOT NULL COMMENT '单价',
  `Fproduct_tol_amt` decimal(10,2) NOT NULL COMMENT '产品总金额(单位：元)',
  `Fstore_id` int(11) NOT NULL COMMENT '店家用户ID',
  `Fstore_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商户类型0：后台，1：商家用户',
  `Fpay_channel` tinyint(1) DEFAULT NULL COMMENT '付款渠道 1：余额支付 2：支付宝支付 3：微信支付',
  `Forder_type` tinyint(1) NOT NULL COMMENT '订单类型 1：购买 2：',
  `Forder_status` tinyint(1) NOT NULL COMMENT '订单状态 1:初始订单 2:取消订单 3:支付成功 4:内部处理 5:渠道支付失败\r',
  `Fclaims_status` tinyint(1) NOT NULL COMMENT '理赔状态 0：未发起，1：理赔中，2：处理失败，3：理赔成功',
  `Fcreate_time` int(11) DEFAULT NULL,
  `Fupdate_time` int(11) DEFAULT NULL,
  `Fcomment_flag` tinyint(1) DEFAULT '0' COMMENT '评论标志1：可评论',
  PRIMARY KEY (`Forder_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_order`
--

LOCK TABLES `t_order` WRITE;
/*!40000 ALTER TABLE `t_order` DISABLE KEYS */;
INSERT INTO `t_order` VALUES ('20161227102000610031','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482848400,1482848400,0),('20161227102020340036','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482848420,1482848420,0),('20161227102157360052','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,3,1,1482848517,1482848517,0),('20161227102517010022','user002','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482848717,1482848717,0),('20161227102519680076','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482848719,1482848719,0),('20161227104415674888','user002','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,3,1,1482849855,1482849855,0),('20161227224601607296','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482849961,1482849961,0),('20161227235955368875','user002','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,3,0,1481854395,1482854395,0),('20161227235955600758','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482654395,1482854395,0),('20161227235955819123','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482854395,1482854395,0),('20161227235955924584','user002','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,2,0,1482854395,1482854395,0),('20161227235956052580','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482854396,1482854396,0),('20161227235956188844','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482854396,1482854396,0),('20161227235956315839','user002','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,2,0,1482954396,1482854396,0),('20161227235956501735','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1482854396,1482854396,0),('20161227235956629569','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,3,1,1482254396,1482854396,0),('20161229210949007160','user001','48','轻轻互助-中青年抗癌互助计划',900.00,7200.00,14,0,NULL,1,1,0,1483016989,1483016989,0),('20161229211009853385','user001','48','轻轻互助-中青年抗癌互助计划',900.00,7200.00,14,0,NULL,1,1,0,1483017009,1483017009,0),('20161229211200897215','user001','48','轻轻互助-中青年抗癌互助计划',900.00,7200.00,14,0,NULL,1,2,0,1483017120,1483017120,0),('20161229213052958991','user001','48','轻轻互助-中青年抗癌互助计划',900.00,2700.00,14,0,NULL,1,3,1,1483018252,1483018252,0),('20161229213724124862','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483018644,1483018644,0),('20161229215127922850','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,4,0,1483019487,1483019487,0),('20161229215137757457','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483019497,1483019497,0),('20161229220436844039','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,1,0,1483020276,1483020276,0),('20161229222010307376','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,1,0,1483021210,1483021210,0),('20161229222028143077','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,1,0,1483021228,1483021228,0),('20161229222029020153','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,3,0,1483021229,1483021229,0),('20161229222731041222','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,1,0,1483021651,1483021651,0),('20161229223245282099','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483021965,1483021965,0),('20161229223330939914','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483022010,1483022010,0),('20170101134217486187','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,4,0,1483249337,1483249337,0),('20170102140533818798','user001','47','轻轻互助-中青年抗癌互助计划',900.00,900.00,13,0,NULL,1,2,0,1483337133,1483337133,0),('20170102171103884553','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483348263,1483348263,0),('20170102182623322263','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483352783,1483352783,0),('20170103201321347166','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,1,0,1483445601,1483445601,0),('20170103202043018866','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1483446043,1483446043,0),('20170105202340803131','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,3,0,1483529020,1483619020,0),('20170105202441458885','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,3,0,1483619081,1483619081,0),('20170105202456647685','user002','43','1234',1234.00,3702.00,7,1,NULL,1,3,1,1483619096,1483619096,0),('20170105222709224920','user001','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,7,1,NULL,1,3,0,1483626429,1483626429,0),('20170108233551003858','user001','49','壁虎互助全民互助计划',10.00,10.00,7,1,NULL,1,1,0,1483889751,1483889751,0),('20170112000112910661','aaaa','48','轻轻互助-中青年抗癌互助计划',900.00,900.00,14,0,NULL,1,3,3,1484150472,1484150472,0),('20170112002819245688','aaaa','47','轻轻互助-中青年抗癌互助计划',900.00,900.00,7,1,NULL,1,2,2,1484152099,1484152099,0),('20170112002845720862','aaaa','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,1,1484152125,1484152125,0),('20170115101846003113','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1484446726,1484446726,0),('20170115101946463691','user001','49','壁虎互助全民互助计划',10.00,10.00,7,1,NULL,1,1,0,1484446786,1484446786,0),('20170115102007371024','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1484446807,1484446807,0),('20170115102020706878','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1484446820,1484446820,0),('20170115102031855133','user001','49','壁虎互助全民互助计划',10.00,10.00,13,0,NULL,1,1,0,1484446831,1484446831,0),('20170115163425419424','user001','40','众托帮女性健康互助',100.00,100.00,13,0,NULL,1,3,1,1484469265,1484469265,0),('20170118232953737917','user001','49','夸克联盟-大病互助基金（老年版）',10.00,10.00,7,1,NULL,1,1,0,1484753393,1484753393,0),('20170205163710930589','user001','54','5432112345',999.00,999.00,7,1,NULL,1,2,0,1486283830,1486283856,0),('20170215193316131750','user002','54','5432112345',999.00,999.00,7,1,NULL,1,2,0,1487158396,1488552883,0),('20170218010002975055','user001','49','夸克联盟-大病互助基金（老年版）',10.00,200.00,13,0,NULL,1,1,0,1487350802,1487350802,0),('20170221001323720099','aaa111','57','新互助产品，Test',10.00,10.00,13,0,NULL,1,1,0,1487607203,1488383211,0),('20170221230915650562','aaa111','54','5432112345',999.00,999.00,7,1,NULL,1,3,0,1487689755,1488383822,0),('20170310000539888790','user001','57','新互助产品，Test',10.00,10.00,13,0,NULL,1,2,0,1489075539,1489075539,0),('20170310003712031755','user001','57','新互助产品，Test',10.00,10.00,13,0,NULL,1,2,0,1489077432,1489077432,0),('20170310010711307214','user001','54','5432112345',999.00,999.00,7,1,NULL,1,2,0,1489079231,1489079231,0),('20170310011259091638','user001','54','5432112345',999.00,999.00,7,1,NULL,1,1,0,1489079579,1489079579,0),('20170310011625317710','user001','57','新互助产品，Test',10.00,10.00,13,0,NULL,1,2,0,1489079785,1489079785,0),('2017031001174877136322','user001','57','新互助产品，Test',10.00,10.00,13,0,NULL,1,1,0,1489079868,1489079868,0);
/*!40000 ALTER TABLE `t_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ORDER_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-10  1:19:22
