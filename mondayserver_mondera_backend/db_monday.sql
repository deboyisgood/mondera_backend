-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: monday
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issueid` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `comment` text,
  `timer1` varchar(100) DEFAULT NULL,
  `timer2` varchar(100) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `comment_approve` int(3) DEFAULT NULL,
  `teamid` varchar(200) DEFAULT NULL,
  `files` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,36,'text','We are working on it','1606657345','Sunday, November 29, 2020, 9:42 am',17,'0','Ann Ball','good1606657151.png',0,'acef462e7337d02dce4ba8263c0dc604',NULL),(2,41,'text','we are working on it','1606663953','Sunday, November 29, 2020, 11:32 am',16,'0','Esedo Fredrick','good1606640638.png',0,'acef462e7337d02dce4ba8263c0dc604',NULL),(3,39,'text','we are working on it','1606664345','Sunday, November 29, 2020, 11:39 am',16,'0','Esedo Fredrick','good1606640638.png',0,'acef462e7337d02dce4ba8263c0dc604',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issue_like_unlike`
--

DROP TABLE IF EXISTS `issue_like_unlike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issue_like_unlike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `type` int(10) NOT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `timer2` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issue_like_unlike`
--

LOCK TABLES `issue_like_unlike` WRITE;
/*!40000 ALTER TABLE `issue_like_unlike` DISABLE KEYS */;
INSERT INTO `issue_like_unlike` VALUES (1,17,36,1,'1606657351','Sunday, November 29, 2020, 9:42 am','$username','Ann Ball','good1606657151.png','0'),(2,19,43,1,'1606663602','Sunday, November 29, 2020, 11:26 am','$username','Venus Johnson','good1606662386.png','0'),(3,16,41,1,'1606663935','Sunday, November 29, 2020, 11:32 am','$username','Esedo Fredrick','good1606640638.png','0'),(4,16,40,1,'1606664323','Sunday, November 29, 2020, 11:38 am','$username','Esedo Fredrick','good1606640638.png','0'),(5,17,37,1,'1606664453','Sunday, November 29, 2020, 11:40 am','$username','Ann Ball','good1606657151.png','0'),(6,16,44,1,'1606666318','Sunday, November 29, 2020, 12:11 pm','$username','Esedo Fredrick','good1606640638.png','0');
/*!40000 ALTER TABLE `issue_like_unlike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `details` text CHARACTER SET utf8 NOT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `timer2` varchar(100) DEFAULT NULL,
  `creator_name` varchar(100) DEFAULT NULL,
  `creator_photo` varchar(100) DEFAULT NULL,
  `creator_userid` varchar(100) DEFAULT NULL,
  `team_id` varchar(200) DEFAULT NULL,
  `token1` varchar(200) DEFAULT NULL,
  `token2` varchar(200) DEFAULT NULL,
  `files` varchar(200) DEFAULT NULL,
  `post_type` varchar(20) DEFAULT NULL,
  `post_approve` int(3) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `status_color` varchar(30) DEFAULT NULL,
  `status_symbol` varchar(30) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `priority_color` varchar(30) DEFAULT NULL,
  `priority_symbol` varchar(30) DEFAULT NULL,
  `total_like` varchar(100) DEFAULT NULL,
  `total_unlike` varchar(100) DEFAULT NULL,
  `total_comment` varchar(100) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  `start_date` varchar(30) DEFAULT NULL,
  `end_date` varchar(30) DEFAULT NULL,
  `filename` varchar(130) DEFAULT NULL,
  `issue_month` varchar(10) DEFAULT NULL,
  `file_status` varchar(4) DEFAULT NULL,
  `project_id` varchar(40) DEFAULT NULL,
  `project_name` varchar(150) DEFAULT NULL,
  `view_time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (35,'Installation Cables','Hi Teams, Am having an issue installing CCTV camera cables at our Civic Centers. We have tried out all the installation Requirements as prescribed in the documentations but could not get it to work. Please help us','1606642512','Sunday, November 29, 2020, 5:35 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Open','#3b5998','O','High','red','H','0','0','0',NULL,'2020-11-29','0',NULL,'11',NULL,'11','My First Project','1606657010'),(36,'Software Not Installing','Hi Teams, Am having an issue installing CCTV camera cables at our Civic Centers. We have tried out all the installation Requirements as prescribed in the documentations but could not get it to work. Please help us','1606657287','Sunday, November 29, 2020, 9:41 am','Ann Ball','good1606657151.png','17','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','171606657287.png','issue',1,'Open','#3b5998','O','Medium','#800000','M','1','0','1',NULL,'2020-11-23','0','people.png','11','1','11','My First Project','1606664479'),(37,'Java Application not Running','Our Java Application Software has a bug and its not running. can you please help us with the installations','1606657670','Sunday, November 29, 2020, 9:47 am','Ann Ball','good1606657151.png','17','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','171606657670.png','issue',1,'Done','green','D','Low','purple','L','1','0','0',NULL,'2020-11-29','0','head2.png','11','1','12','Our Project 2','1606664447'),(38,'Cisco Router IDM Mismatched','It seems that Cisco Cable supplied to us for networking is currently not matched the port number. Please we needs new one asap.','1606657866','Sunday, November 29, 2020, 9:51 am','Ann Ball','good1606657151.png','17','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Open','#3b5998','O','High','red','H','0','0','0',NULL,'2020-11-21','0',NULL,'11',NULL,'12','Our Project 2',NULL),(39,'Bugs in My Laravel Applications','I jhave followed all the necessary steps needed to install my applications but cannot get it to work. it seems that laravel app has an issue. can you help us with the installations','1606658006','Sunday, November 29, 2020, 9:53 am','Ann Ball','good1606657151.png','17','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Open','#3b5998','O','Low','purple','L','0','0','1',NULL,'2020-11-16','0',NULL,'11',NULL,'11','My First Project',NULL),(40,'Game Installation Issues','After I have Installed the Games and run the softwares as Scheduled. I was still unable to get it to work. it crashes each time I tried to run it','1606660632','Sunday, November 29, 2020, 10:37 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','161606660632.png','issue',1,'Done','green','D','High','red','H','1','0','0',NULL,'2020-11-15','0','lab2.png','11','1','12','Our Project 2',NULL),(41,'Keyboard not working','Keyboard with Serial number 35690 not working after being installed. Please I needs help asap','1606660897','Sunday, November 29, 2020, 10:41 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Done','green','D','Medium','#800000','M','1','0','1',NULL,'2020-11-17','2020-11-29',NULL,'11',NULL,'11','My First Project','1606664399'),(42,'Laptop Board Shuggling','Hi team, am having issues going about with my laptop board. I have tried everything but could not get it to work. Any help please','1606662746','Sunday, November 29, 2020, 11:12 am','Venus Johnson','good1606662386.png','19','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Open','#3b5998','O','Low','purple','L','0','0','0',NULL,'2020-11-02','0',NULL,'10',NULL,'11','My First Project',NULL),(43,'Xammp Install triggers Error 405','Am trying to install Xampp Server for PHP but encountered error 405 please help me','1606662816','Sunday, November 29, 2020, 11:13 am','Venus Johnson','good1606662386.png','19','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','0','issue',1,'Open','#3b5998','O','Low','purple','L','1','0','0',NULL,'2020-12-01','0',NULL,'12',NULL,'11','My First Project','1606666098'),(44,'I ssue with Code','I am having issues please help with codes','1606664571','Sunday, November 29, 2020, 11:42 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','161606664571.png','issue',1,'Open','#3b5998','O','High','red','H','1','0','0',NULL,'2020-11-29','0','fred.png','11','1','11','My First Project',NULL);
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(30) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `user_rank` varchar(100) DEFAULT NULL,
  `reciever_id` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `timing` varchar(100) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `teamid` varchar(300) DEFAULT NULL,
  `stat` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (2,'36','17','Ann Ball','good1606657151.png','Member','16','unread','comment','1606657345','Software Not Installing','acef462e7337d02dce4ba8263c0dc604',NULL),(3,'36','17','Ann Ball','good1606657151.png','Member','16','read','like','1606657351','Software Not Installing','acef462e7337d02dce4ba8263c0dc604',NULL),(4,'37','17','Ann Ball','good1606657151.png','Member','16','unread','post','1606657670','Java Application not Running','acef462e7337d02dce4ba8263c0dc604',NULL),(5,'38','17','Ann Ball','good1606657151.png','Member','16','unread','post','1606657866','Cisco Router IDM Mismatched','acef462e7337d02dce4ba8263c0dc604',NULL),(6,'39','17','Ann Ball','good1606657151.png','Member','16','unread','post','1606658006','Bugs in My Laravel Applications','acef462e7337d02dce4ba8263c0dc604',NULL),(7,'40','16','Esedo Fredrick','good1606640638.png','Member','17','unread','post','1606660632','Game Installation Issues','acef462e7337d02dce4ba8263c0dc604',NULL),(8,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','post','1606660897','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(9,'42','19','Venus Johnson','good1606662386.png','Member','16','unread','post','1606662746','Laptop Board Shuggling','acef462e7337d02dce4ba8263c0dc604',NULL),(10,'42','19','Venus Johnson','good1606662386.png','Member','17','unread','post','1606662746','Laptop Board Shuggling','acef462e7337d02dce4ba8263c0dc604',NULL),(11,'43','19','Venus Johnson','good1606662386.png','Member','16','unread','post','1606662816','Xammp Install triggers Error 405','acef462e7337d02dce4ba8263c0dc604',NULL),(12,'43','19','Venus Johnson','good1606662386.png','Member','17','unread','post','1606662816','Xammp Install triggers Error 405','acef462e7337d02dce4ba8263c0dc604',NULL),(13,'43','19','Venus Johnson','good1606662386.png','Member','16','unread','like','1606663602','Xammp Install triggers Error 405','acef462e7337d02dce4ba8263c0dc604',NULL),(14,'43','19','Venus Johnson','good1606662386.png','Member','17','unread','like','1606663602','Xammp Install triggers Error 405','acef462e7337d02dce4ba8263c0dc604',NULL),(15,'41','16','Esedo Fredrick','good1606640638.png','Member','17','read','status','1606663909','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Open'),(16,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','status','1606663909','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Open'),(17,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','status','1606663909','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Open'),(18,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(19,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(20,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(21,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(22,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(23,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','priority','1606663923','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(24,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','like','1606663935','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(25,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','like','1606663935','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(26,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','like','1606663935','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(27,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','comment','1606663953','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(28,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','comment','1606663953','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(29,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','comment','1606663953','Keyboard not working','acef462e7337d02dce4ba8263c0dc604',NULL),(30,'40','16','Esedo Fredrick','good1606640638.png','Member','17','unread','like','1606664323','Game Installation Issues','acef462e7337d02dce4ba8263c0dc604',NULL),(31,'40','16','Esedo Fredrick','good1606640638.png','Member','19','unread','like','1606664323','Game Installation Issues','acef462e7337d02dce4ba8263c0dc604',NULL),(32,'40','16','Esedo Fredrick','good1606640638.png','Member','20','unread','like','1606664323','Game Installation Issues','acef462e7337d02dce4ba8263c0dc604',NULL),(33,'39','16','Esedo Fredrick','good1606640638.png','Member','17','unread','comment','1606664345','Bugs in My Laravel Applications','acef462e7337d02dce4ba8263c0dc604',NULL),(34,'39','16','Esedo Fredrick','good1606640638.png','Member','19','unread','comment','1606664345','Bugs in My Laravel Applications','acef462e7337d02dce4ba8263c0dc604',NULL),(35,'39','16','Esedo Fredrick','good1606640638.png','Member','20','unread','comment','1606664345','Bugs in My Laravel Applications','acef462e7337d02dce4ba8263c0dc604',NULL),(36,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','status','1606664408','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Done'),(37,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','status','1606664408','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Done'),(38,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','status','1606664408','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Done'),(39,'41','16','Esedo Fredrick','good1606640638.png','Member','17','unread','priority','1606664418','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(40,'41','16','Esedo Fredrick','good1606640638.png','Member','19','unread','priority','1606664418','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(41,'41','16','Esedo Fredrick','good1606640638.png','Member','20','unread','priority','1606664418','Keyboard not working','acef462e7337d02dce4ba8263c0dc604','Medium'),(42,'37','17','Ann Ball','good1606657151.png','Member','16','unread','like','1606664453','Java Application not Running','acef462e7337d02dce4ba8263c0dc604',NULL),(43,'37','17','Ann Ball','good1606657151.png','Member','19','unread','like','1606664453','Java Application not Running','acef462e7337d02dce4ba8263c0dc604',NULL),(44,'37','17','Ann Ball','good1606657151.png','Member','20','unread','like','1606664453','Java Application not Running','acef462e7337d02dce4ba8263c0dc604',NULL),(45,'44','16','Esedo Fredrick','good1606640638.png','Member','17','unread','post','1606664571','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL),(46,'44','16','Esedo Fredrick','good1606640638.png','Member','19','unread','post','1606664571','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL),(47,'44','16','Esedo Fredrick','good1606640638.png','Member','20','unread','post','1606664571','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL),(48,'44','16','Esedo Fredrick','good1606640638.png','Member','17','unread','like','1606666318','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL),(49,'44','16','Esedo Fredrick','good1606640638.png','Member','19','unread','like','1606666318','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL),(50,'44','16','Esedo Fredrick','good1606640638.png','Member','20','unread','like','1606666318','I ssue with Code','acef462e7337d02dce4ba8263c0dc604',NULL);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `details` text CHARACTER SET utf8 NOT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `timer2` varchar(100) DEFAULT NULL,
  `creator_name` varchar(100) DEFAULT NULL,
  `creator_photo` varchar(100) DEFAULT NULL,
  `creator_userid` varchar(100) DEFAULT NULL,
  `team_id` varchar(200) DEFAULT NULL,
  `token1` varchar(200) DEFAULT NULL,
  `token2` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (11,'My First Project','This is my First Project','1606642372','Sunday, November 29, 2020, 5:32 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5'),(12,'Our Project 2','This is our Project 2','1606657498','Sunday, November 29, 2020, 9:44 am','Ann Ball','good1606657151.png','17','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5'),(13,'my 3rd Project','This is my third Project','1606664508','Sunday, November 29, 2020, 11:41 am','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5'),(14,'My New Projects','This is my Projects 1','1606666413','Sunday, November 29, 2020, 12:13 pm','Esedo Fredrick','good1606640638.png','16','acef462e7337d02dce4ba8263c0dc604','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(200) DEFAULT NULL,
  `team_identity` varchar(200) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  `createdby_name` varchar(100) DEFAULT NULL,
  `createdby_email` varchar(100) DEFAULT NULL,
  `timing` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (13,'My First Team','acef462e7337d02dce4ba8263c0dc604','Software-Team','Esedo Fredrick','esedofredrick@gmail.com','1606640638'),(14,'Jalingo Team','a1b7e196d2a38c3fb5ccd28b73f7804d','Jalingo-Team','Esedo Chijioke','esedofredrick@gmail.com','1606660393');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(130) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `user_rank` varchar(50) DEFAULT NULL,
  `user_verified` varchar(50) DEFAULT NULL,
  `user_banned` varchar(50) DEFAULT NULL,
  `created_time` varchar(50) DEFAULT NULL,
  `timer1` varchar(200) DEFAULT NULL,
  `token1` varchar(200) DEFAULT NULL,
  `token2` varchar(20) DEFAULT NULL,
  `team_identity` varchar(200) DEFAULT NULL,
  `team_name` varchar(130) DEFAULT NULL,
  `team_timing` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (16,NULL,'$2y$04$lEIgqMw4gAUvR2iJlq72qe.eBuWbU41w2EP8OuuxnUIcOavl75Z22','Esedo Fredrick','esedofredrick@gmail.com','good1606640638.png','admin','1','0','Sunday, November 29, 2020, 5:03 am','1606640638','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','acef462e7337d02dce4ba8263c0dc604','Software Team','1606640638'),(17,NULL,'$2y$04$kjaUbyySikGo9j9NzXid0ONi6I/g3stdoLRdm.AvJ1dfDLT9BhZoW','Ann Ball','annball@gmail.com','good1606657151.png','member','1','0','Sunday, November 29, 2020, 9:39 am','1606657151','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','acef462e7337d02dce4ba8263c0dc604','Software Team','1606640638'),(18,NULL,'$2y$04$VJSY51Z5w2Fg4VaxaAfQ0eNuuuUTGYNXxJk516/XQP0uXLRvEe90y','Esedo Chijioke','esedofredrick@gmail.com','good1606660393.png','admin','1','0','Sunday, November 29, 2020, 10:33 am','1606660393','a0d8d77bb36a79a240692040a067c586','a0d8d77bb36a79a24069','a1b7e196d2a38c3fb5ccd28b73f7804d','Jalingo Team','1606660393'),(19,NULL,'$2y$04$mIkw.YsBNsCraWPPItoRS.thEJ8OE4yYUrCe/YlPT0gzuo/cb4aWG','Venus Johnson','venusjohnson@gmail.com','good1606662386.png','member','1','0','Sunday, November 29, 2020, 11:06 am','1606662386','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','acef462e7337d02dce4ba8263c0dc604','Software Team','1606640638'),(20,NULL,'$2y$04$wYzkX6TF0rG0fxDwt7CHGu4ofEe3krEtzCgPRqDJ.bF28zlsky4K.','Tony More','tonymore@gmail.com','good1606663736.png','member','1','0','Sunday, November 29, 2020, 11:28 am','1606663736','78be0054da33f45340d5d799e4e35d28','78be0054da33f45340d5','acef462e7337d02dce4ba8263c0dc604','Software Team','1606640638');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'monday'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-29  8:15:49
