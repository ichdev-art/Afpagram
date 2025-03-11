-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: afpa-gram
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `76_comments`
--

DROP TABLE IF EXISTS `76_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_comments` (
  `com_id` int NOT NULL,
  `com_text` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `76_comments_ibfk_1` (`post_id`),
  KEY `76_comments_ibfk_2` (`user_id`),
  CONSTRAINT `76_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `76_posts` (`post_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `76_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `76_users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_comments`
--

LOCK TABLES `76_comments` WRITE;
/*!40000 ALTER TABLE `76_comments` DISABLE KEYS */;
INSERT INTO `76_comments` VALUES (1,'Trop beau décors bisous mamie !',1,2),(2,'Tu fais trop le randonneur',2,2),(3,'Maroc Maroc vive l`algerie',3,2),(4,'Le chameaux il a mal au dos',4,3),(5,'Trop belle forêt, les abres acajou on adore !',5,3),(6,'On dirais miami on adore',6,1),(7,'Trop bonne partie on se remet ça bientot mon pote !',7,1);
/*!40000 ALTER TABLE `76_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_favorites`
--

DROP TABLE IF EXISTS `76_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_favorites` (
  `user_id` int NOT NULL,
  `fav_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`fav_id`),
  KEY `fav_id` (`fav_id`),
  CONSTRAINT `76_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `76_users` (`user_id`),
  CONSTRAINT `76_favorites_ibfk_2` FOREIGN KEY (`fav_id`) REFERENCES `76_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_favorites`
--

LOCK TABLES `76_favorites` WRITE;
/*!40000 ALTER TABLE `76_favorites` DISABLE KEYS */;
INSERT INTO `76_favorites` VALUES (2,1),(1,2),(1,3);
/*!40000 ALTER TABLE `76_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_likes`
--

DROP TABLE IF EXISTS `76_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_likes` (
  `like_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `76_likes_ibfk_1` (`user_id`),
  KEY `76_likes_ibfk_2` (`post_id`),
  CONSTRAINT `76_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `76_users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `76_likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `76_posts` (`post_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_likes`
--

LOCK TABLES `76_likes` WRITE;
/*!40000 ALTER TABLE `76_likes` DISABLE KEYS */;
INSERT INTO `76_likes` VALUES (1,1,1),(2,2,1),(3,3,3),(4,1,3),(5,2,7),(6,3,7),(7,1,6);
/*!40000 ALTER TABLE `76_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_pictures`
--

DROP TABLE IF EXISTS `76_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_pictures` (
  `pic_id` int NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `76_pictures_ibfk_1` (`post_id`),
  CONSTRAINT `76_pictures_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `76_posts` (`post_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_pictures`
--

LOCK TABLES `76_pictures` WRITE;
/*!40000 ALTER TABLE `76_pictures` DISABLE KEYS */;
INSERT INTO `76_pictures` VALUES (1,'vacances.png',1),(2,'montage.png',2),(3,'maroc.png',3),(4,'chameaux.png',4),(5,'foret.png',5),(6,'plage.png',6),(7,'lasergame.png',7);
/*!40000 ALTER TABLE `76_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_posts`
--

DROP TABLE IF EXISTS `76_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_timestamp` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_private` tinyint NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `76_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `76_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_posts`
--

LOCK TABLES `76_posts` WRITE;
/*!40000 ALTER TABLE `76_posts` DISABLE KEYS */;
INSERT INTO `76_posts` VALUES (1,'1740739695','Vacances 2025',0,1),(2,'1740826095','Week end a la montagne',0,1),(3,'1740912495','Petit thé au maroc',0,1),(4,'1740998895','Voyage a dos de chameaux',0,1),(5,'1741085295','Sorti en forêt',0,1),(6,'1741171695','Plage',0,2),(7,'1741258095','Laser game',0,2);
/*!40000 ALTER TABLE `76_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_users`
--

DROP TABLE IF EXISTS `76_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_gender` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_lastname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_firstname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_pseudo` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_avatar` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'avatar.png' COMMENT 'Photo de profil',
  `user_birthdate` date NOT NULL,
  `user_mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_activated` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_pseudo` (`user_pseudo`),
  UNIQUE KEY `user_mail` (`user_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_users`
--

LOCK TABLES `76_users` WRITE;
/*!40000 ALTER TABLE `76_users` DISABLE KEYS */;
INSERT INTO `76_users` VALUES (1,'homme','jourdain','ichem','Mattong',NULL,'1995-09-27','ichem76610@hotmail.com','$2y$10$KtFSWk.O3VHFUpckJCKhU.x.Kom.cHL3dhtKygmKABmz6vQgLgJ.O',1),(2,'homme','Fadli','Saïd','Dark_sasuke',NULL,'2002-07-04','said@fadli.com','$2y$10$lcqg6.ubJtboFR3sjVAI5uRZGNbbYBBEvQiRisIfReN2tlntb/Uqy',1),(3,'homme','PHP','Ridha','MonsieurSQL',NULL,'1990-02-15','ridha@afpa.fr','$2y$10$gzsH8pp/TKtttT4txb0cTeBMMt2keVHwAcyDmK0JzV14JF8uQbmmG',1);
/*!40000 ALTER TABLE `76_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-10 21:02:22
