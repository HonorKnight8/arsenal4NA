-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: a4NA
-- ------------------------------------------------------
-- Server version	5.5.64-MariaDB

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
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `departmentID` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `departmentName` varchar(40) NOT NULL COMMENT '部门名称',
  `parentID` tinyint(4) NOT NULL COMMENT '上级部门id',
  `rank` varchar(4) NOT NULL DEFAULT '' COMMENT '部门层级',
  `seq` tinyint(4) NOT NULL DEFAULT '0' COMMENT '部门在当前层级的顺序，由小到大',
  PRIMARY KEY (`departmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部门表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `post` varchar(80) NOT NULL COMMENT '岗位',
  `staffID` varchar(20) NOT NULL COMMENT '工号，用户名',
  `departmentID` tinyint(4) NOT NULL COMMENT '部门ID',
  `workcontent` text COMMENT '职责、工作内容',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='岗位表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PHPSESSID` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `update_time` int(10) NOT NULL,
  `client_ip` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES (72,'4ff37bafa0ff3adbe45b9b6a5abb4f0e',1581675108,'192.168.56.1','loginStatus|i:1;permission|s:1:\"1\";staffID|s:5:\"10002\";staffName|s:6:\"陈二\";'),(73,'7a26d925c231304acf7ad9d07181fd70',1581675251,'192.168.56.1','loginStatus|i:0;'),(75,'6ultk5d7lkb29bj1npneldq68p',1581675383,'::1','loginStatus|i:0;');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staffs` (
  `personID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '人员ID',
  `staffID` varchar(20) NOT NULL COMMENT '工号，用户名',
  `staffName` varchar(40) NOT NULL COMMENT '姓名',
  `sex` set('f','m') NOT NULL COMMENT '性别',
  `extensionNum` varchar(8) NOT NULL DEFAULT '7654321' COMMENT '分机号',
  `eMail` varchar(80) NOT NULL COMMENT '电子邮箱',
  `entryTime` date DEFAULT NULL COMMENT '加入时间',
  `onceIn` tinyint(1) NOT NULL COMMENT '曾经入职',
  `isIn` tinyint(1) NOT NULL COMMENT '目前在职',
  `headPhoto` varchar(1024) DEFAULT NULL COMMENT '头像',
  `cellPhoneNum` varchar(16) DEFAULT NULL COMMENT '手机号',
  `dateOfBirth` date DEFAULT NULL COMMENT '出生年月',
  `comeFrom` varchar(24) DEFAULT NULL COMMENT '来自',
  `selfIntroduction` text COMMENT '自我介绍',
  `qq` varchar(16) DEFAULT NULL COMMENT 'QQ号',
  `wechat` varchar(40) DEFAULT NULL COMMENT '微信号',
  `dingtalk` varchar(40) DEFAULT NULL COMMENT '钉钉号',
  PRIMARY KEY (`personID`),
  UNIQUE KEY `staffID` (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=1000011 DEFAULT CHARSET=utf8 COMMENT='员工基础信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffs`
--

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` VALUES (1000001,'10001','刘一','f','12345678','liuyi@a4na.fake','0000-00-00',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000002,'10002','陈二','m','12345677','chener@a4na.fake','2001-01-01',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000003,'10003','张三','f','12345676','zhangsan@a4na.fake','2002-02-02',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000004,'10004','李四','m','12345675','lisi@a4na.fake','2009-09-09',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000005,'10005','王五','f','12345674','wangwu@a4na.fake','2009-09-09',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000006,'10006','赵六','m','12345673','zhaoliu@a4na.fake','2009-09-09',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000007,'10007','孙七','f','12345672','sunqi@a4na.fake','2009-09-09',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000008,'10008','周八','m','12345671','zhouba@a4na.fake','2010-10-10',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000009,'10009','吴九','f','12345670','wujiu@a4na.fake','2011-11-11',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1000010,'10010','郑十','m','12345669','zhengshi@a4na.fake','2012-12-12',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userpwd`
--

DROP TABLE IF EXISTS `userpwd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userpwd` (
  `staffID` varchar(20) NOT NULL COMMENT '工号，用户名',
  `password` varchar(40) NOT NULL COMMENT '密码',
  `permission` tinyint(3) unsigned NOT NULL COMMENT '用户权限',
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账号表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userpwd`
--

LOCK TABLES `userpwd` WRITE;
/*!40000 ALTER TABLE `userpwd` DISABLE KEYS */;
INSERT INTO `userpwd` VALUES ('10001','1af08ae4ea26cd5055ebff287e5ba3b8dca39c41',0),('10002','7fc713c4a1eff9ba4da80b55f63a9b1e556e28dd',1),('10003','b07b1ba3f5ddf0788a32b3caa5ab943c6230af6a',2),('10004','b5f0ec943452284b5e84df64de93ff870c0be3e7',2),('10005','09d3bbedb0dd3876c776d3afcbdf02a17ffe938d',2),('10006','cf66d47f97fa34af419acfc51afb0fad1f9609c8',2),('10007','76387d4022ce9e9a2607da68c06c9db111f70232',2),('10008','7eee6d61ab0a74c1d9b766bba0431db9136ac7fe',2),('10009','81269c1c9b81c7567257db61992cf259e7ecf144',15),('10010','c254f416396f7fcc6f23c541f84ce7c262319044',99);
/*!40000 ALTER TABLE `userpwd` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-14 18:19:03
