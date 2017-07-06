-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: real_estate
-- ------------------------------------------------------
-- Server version	5.6.31-log

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
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(500) NOT NULL,
  `LocationType` tinyint(1) NOT NULL COMMENT '1 - Tỉnh/Thành phố\n2 - Quận/Huyện',
  `IsParent` bit(1) NOT NULL,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `Pos` smallint(4) NOT NULL COMMENT 'Vị trí của địa điểm trong combobox',
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lưu trữ thông tin tên quận-huyện/ tỉnh - thành phố';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `NewsTypeID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `IllustrationURL` varchar(500) NOT NULL,
  `Details` longtext NOT NULL,
  `LastUpdated` datetime(6) NOT NULL,
  `ViewNumber` smallint(6) NOT NULL DEFAULT '0',
  `Price` bigint(11) NOT NULL DEFAULT '0',
  `Contact` mediumtext NOT NULL,
  PRIMARY KEY (`NewsID`),
  KEY `FK_LOCATION_idx` (`LocationID`),
  KEY `FK_NEWS_TYPE_idx` (`NewsTypeID`),
  CONSTRAINT `FK_LOCATION` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`) ON UPDATE CASCADE,
  CONSTRAINT `FK_NEWS_TYPE` FOREIGN KEY (`NewsTypeID`) REFERENCES `news_type` (`TypeID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lưu trữ thông tin của một bản tin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_log`
--

DROP TABLE IF EXISTS `news_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_log` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `NewsID` int(11) NOT NULL,
  `LogType` int(11) NOT NULL COMMENT '1 - Tạo mới\n2 - Cập nhật nội dung\n3 - Thay đổi trạng thái',
  `LogTime` datetime(6) NOT NULL,
  PRIMARY KEY (`LogID`),
  KEY `FK_NEWS_idx` (`NewsID`),
  KEY `FK_USER` (`UserID`),
  CONSTRAINT `FK_NEWS` FOREIGN KEY (`NewsID`) REFERENCES `news` (`NewsID`) ON UPDATE CASCADE,
  CONSTRAINT `FK_USER` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lưu trữ nhật ký thay đổi của các bản tin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_log`
--

LOCK TABLES `news_log` WRITE;
/*!40000 ALTER TABLE `news_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_type`
--

DROP TABLE IF EXISTS `news_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_type` (
  `TypeID` int(11) NOT NULL AUTO_INCREMENT,
  `TypeName` varchar(100) NOT NULL,
  PRIMARY KEY (`TypeID`),
  UNIQUE KEY `TypeID_UNIQUE` (`TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Lưu trữ các loại tin của 1 bản tin';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_type`
--

LOCK TABLES `news_type` WRITE;
/*!40000 ALTER TABLE `news_type` DISABLE KEYS */;
INSERT INTO `news_type` VALUES (1,'Dự án mới'),(2,'Đất nền'),(3,'Căn hộ'),(4,'Chung cư');
/*!40000 ALTER TABLE `news_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_function`
--

DROP TABLE IF EXISTS `sys_function`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_function` (
  `FunctionID` int(11) NOT NULL COMMENT 'ID định danh chức năng của hệ thống.',
  `FunctionName` varchar(50) NOT NULL COMMENT 'Tên các chức năng.',
  PRIMARY KEY (`FunctionID`),
  UNIQUE KEY `FunctionID_UNIQUE` (`FunctionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng lưu trữ định danh các chức năng của hệ thống cần quản lý để cấp quyền.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_function`
--

LOCK TABLES `sys_function` WRITE;
/*!40000 ALTER TABLE `sys_function` DISABLE KEYS */;
INSERT INTO `sys_function` VALUES (1,'Tạo mới bản tin'),(2,'Cập nhật nội dung bản tin'),(3,'Thay đổi trạng thái bản tin'),(4,'Xem nhật ký bản tin'),(5,'Phân quyền tài khoản quản lý'),(6,'Tạo mới tài khoản quản lý'),(7,'Sửa đổi thông tin tài khoản quản lý'),(8,'Thay đổi trạng thái tài khoản quản lý'),(9,'Hỗ trợ khách hành trực tuyến'),(10,'Thay đổi mật khẩu tài khoản quản lý'),(11,'Quản lý quảng cáo');
/*!40000 ALTER TABLE `sys_function` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserLevelID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(15) NOT NULL,
  `MiddleName` varchar(45) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `ProfileImageURL` varchar(500) NOT NULL,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Enable` bit(1) NOT NULL DEFAULT b'1',
  `Online` bit(1) NOT NULL DEFAULT b'0',
  `LastLogin` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`),
  KEY `FK_USER_LEVEL_idx` (`UserLevelID`),
  CONSTRAINT `FK_LEVEL` FOREIGN KEY (`UserLevelID`) REFERENCES `user_level` (`UserLevelID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='Lưu trữ thông tin các tài khoản quản lý.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/RealEstate/admin/img/user/67897bde-ad8d-4a62-90f2-4611986de44c.jpg','tokon994@gmail.com','','\0','2017-07-05 21:36:04'),(2,2,'admin1','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','nguyenquangtung.cn2@gmail.com','','','2017-07-05 21:36:44'),(3,1,'admin2','f931ea1c3f39f11f4fa715d589a2f369b4643f2b','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','tokon994@gmail.com','\0','\0','2017-07-04 14:30:00'),(4,4,'admin3','a8edffda2e9ae57145de20d526120178c86f51da','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(5,4,'admin4','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(6,4,'admin5','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','','\0','2017-07-04 14:30:00'),(7,5,'admin6','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(8,4,'tokon994','da39a3ee5e6b4b0d3255bfef95601890afd80709','Tungss9x123','Tungss9x123','Tungss9x123','2017-07-01','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(9,4,'phucnwsds','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Tùng','Nguyễn','','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/98127943-242c-4dba-afce-bf499b9b3541.jpg','','\0','\0','2017-07-04 14:30:00'),(10,4,'admin10','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(11,1,'admin12','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','','\0','2017-07-04 14:30:00'),(12,4,'admin13','da39a3ee5e6b4b0d3255bfef95601890afd80709','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(13,5,'admin14','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(14,5,'admin15','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','','\0','2017-07-04 14:30:00'),(15,3,'admin16','91ead0d2c574d33767b096a1e74690e6e2889328','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','','\0','2017-07-05 21:27:35'),(16,5,'admin17','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(17,5,'admin18','d033e22ae348aeb5660fc2140aec35850c4da997','Tùng','Nguyễn','Quang','1994-09-18','http://192.168.1.220:8080/BDS/admin/img/user/9c8a2ee7-c71d-4aea-84ab-335a700a129f.jpg','','\0','\0','2017-07-04 14:30:00'),(18,1,'tungnqITT','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Túng','Nguyễn','Qunag','2017-07-03','http://192.168.1.220:8080/BDS/admin/img/user/9d4908f1-4810-4d95-b752-76bc9fdee92c.jpg','','','\0','2017-07-04 14:30:00'),(19,1,'tokon94','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Hương','Đào','Thị Thu','1993-10-11','http://192.168.1.220:8080/BDS/admin/img/user/39b3998e-0262-41e1-a7e8-e253f6a3ed1c.jpg','','','\0','2017-07-04 14:30:00'),(20,4,'Tung9x1232','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Tung9x123','Tung9x123','Tung9x123','2017-07-03','http://192.168.1.220:8080/BDS/admin/img/noimage.png','','','\0','2017-07-04 14:30:00'),(21,4,'minhnv','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Tung9x123','Tung9x123','','1994-10-01','http://192.168.1.220:8080/BDS/admin/img/user/b4a77653-81ec-4f1b-a5b0-b2f905067348.jpg','','\0','\0','2017-07-04 14:30:00'),(22,5,'admin23','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Tung9x123','Tung9x123','Tung9x123','2017-07-03','http://192.168.1.220:8080/BDS/admin/img/user/468172f8-42e0-4759-9724-0586ba728a46.jpg','','\0','\0','2017-07-04 14:30:00'),(23,5,'admin32','da39a3ee5e6b4b0d3255bfef95601890afd80709','Thao','Nguyen','Thu','1994-08-21','http://192.168.1.220:8080/BDS/admin/img/user/468172f8-42e0-4759-9724-0586ba728a46.jpg','','','\0','2017-07-04 14:30:00'),(24,5,'admin22','dbfb6bf99dcd294ee663e677a0b330983e18a6c0','Tung9x123','Tung9x123','Tung9x123','2017-06-28','http://192.168.1.220:8080/RealEstate/admin/img/noimage.png','','','\0','0000-00-00 00:00:00'),(25,5,'aaa1322','2b12e1a2252d642c09f640b63ed35dcc5690464a','Trang','Nguyễn','Thu','1999-10-20','http://192.168.1.220:8080/RealEstate/admin/img/noimage.png','trangnt@gmail.com','','\0','0000-00-00 00:00:00'),(26,3,'admin111','032e0e3d467b0c39e5306cebb85cef655bdf4518','Tùng','Nguyễn','Tùng','2017-07-05','http://192.168.1.220:8080/RealEstate/admin/img/user/d9cf5016-5437-440f-b349-2d1c59913f4d.jpg','tokon994@gmail.com','','\0','2017-07-05 18:15:13');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `UserLevelID` int(11) NOT NULL COMMENT 'ID định danh cấp độ của quyền',
  `UserLevelName` varchar(50) NOT NULL COMMENT 'Tên của cấp độ quyền.',
  PRIMARY KEY (`UserLevelID`),
  UNIQUE KEY `UserLevel_UNIQUE` (`UserLevelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='- Bản lưu trữ cấp độ các quyền trong hệ thống - mỗi cấp độ sẽ có 1 số quyền định sẵn.\n- Super Admin là cấp độ cao nhất có khả năng cấp quyền cho các user còn lại.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,'Super Admin'),(2,'Quản trị viên hệ thống'),(3,'Nhân viên giám sát'),(4,'Nhân viên đăng tin'),(5,'Nhân viên hỗ trợ');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `UserLevelID` int(11) NOT NULL COMMENT 'Mã cấp độ',
  `FunctionID` int(11) NOT NULL COMMENT 'Mã chức năng',
  PRIMARY KEY (`UserLevelID`,`FunctionID`),
  KEY `FK_SYS_FUNTION_idx` (`FunctionID`),
  CONSTRAINT `FK_SYS_FUNTION` FOREIGN KEY (`FunctionID`) REFERENCES `sys_function` (`FunctionID`) ON UPDATE CASCADE,
  CONSTRAINT `FK_USER_LEVEL` FOREIGN KEY (`UserLevelID`) REFERENCES `user_level` (`UserLevelID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng lưu trữ quyền ứng với cấp độ của tài khoản quản lý.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,1),(2,1),(3,1),(4,1),(1,2),(2,2),(3,2),(4,2),(1,3),(2,3),(3,3),(1,4),(2,4),(3,4),(4,4),(1,5),(1,6),(2,6),(1,7),(2,7),(1,8),(2,8),(5,9),(1,10),(2,10),(1,11);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-05 21:38:14
