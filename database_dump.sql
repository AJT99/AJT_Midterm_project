-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: quotesdb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Jim Rohn'),(2,'George Washington'),(3,'Katharine Hepburn'),(4,'Bruce Lee'),(5,'Abraham Lincoln'),(6,'Dan Kennedy'),(7,'Leonardo da Vinci');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Discipline'),(2,'Love'),(3,'Inspiration'),(4,'Friendship'),(5,'Family'),(6,'Success');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,'Discipline is the bridge between goals and accomplishment.',1,1),(2,'Discipline is the soul of an army. It makes small numbers formidable; procures success to the weak, and esteem to all.',2,1),(3,'Without discipline, there&#039;s no life at all.',3,1),(4,'The successful warrior is the average man, with laser-like focus.',4,1),(5,'Discipline is choosing between what you want now and what you want most.',5,1),(6,'Self-discipline is the magic power that makes you virtually unstoppable.',6,1),(7,'Learning never exhausts the mind.',7,1),(8,'The greatest gift you can give to somebody is your own personal development. I used to say, &#039;If you will take care of me, I will take care of you.&#039; Now I say, &#039;I will take care of me for you, if you will take care of you for me.&#039;',1,2),(9,'There is nothing which can better deserve our patronage than the promotion of science and literature. Knowledge is in every country the surest basis of public happiness.',2,2),(10,'Love has nothing to do with what you are expecting to getΓÇöonly with what you are expecting to giveΓÇöwhich is everything.',3,2),(11,'Love is like a friendship caught on fire. In the beginning, a flame, very pretty, often hot and fierce, but still only light and flickering. As love grows older, our hearts mature and our love becomes as coals, deep-burning and unquenchable.',4,2),(12,'Whatever you are, be a good one.',5,2),(13,'Be decisive. Right or wrong, make a decision. The road of life is paved with flat squirrels who couldn&#039;t make a decision.',6,2),(14,'Life is pretty simple: You do some stuff. Most fails. Some works. You do more of what works. If it works big, others quickly copy it. Then you do something else. The trick is the doing something else.',7,2),(15,'Don&#039;t let your learning lead to knowledge. Let your learning lead to action.',1,3),(16,'Perseverance and spirit have done wonders in all ages.',2,3),(17,'If you obey all the rules, you miss all the fun.',3,3),(18,'A wise man can learn more from a foolish question than a fool can learn from a wise answer.',4,3),(19,'I&#039;m a success today because I had a friend who believed in me and I didn&#039;t have the heart to let him down.',5,3),(20,'The more informative your advertising, the more persuasive it will be.',6,3),(21,'I have been impressed with the urgency of doing. Knowing is not enough; we must apply. Being willing is not enough; we must do.',7,3),(22,'You are the average of the five people you spend the most time with.',1,4),(23,'Be courteous to all, but intimate with few, and let those few be well tried before you give them your confidence.',2,4),(24,'The greatest gift of life is friendship, and I have received it.',3,4),(25,'I am not in this world to live up to your expectations, and you are not in this world to live up to mine.',4,4),(26,'My best friend is a person who will give me a book I have not read.',5,4),(27,'If you want to build a successful business, make sure you have three things: a big market, a product or service that satisfies a need, and a way to reach your customers.',6,4),(28,'Life is pretty simple: You do some stuff. Most fails. Some works. You do more of what works. If it works big, others quickly copy it. Then you do something else. The trick is the doing something else.',7,4),(29,'Family is the foundation of society and the seedbed of virtue. It is where we learn the social graces of loyalty, cooperation, and trust.',1,5),(30,'The happiness of society is the end of government.',2,5),(31,'Being a family means you are part of something very wonderful. It means you will love and be loved for the rest of your life, no matter what.',3,5),(32,'A family is a place where minds come in contact with one another. If these minds love one another, the home will be as beautiful as a flower garden. But if these minds get out of harmony with one another, it is like a storm that plays havoc with the garde',4,5),(33,'I remember my mother&#039;s prayers and they have always followed me. They have clung to me all my life.',5,5),(34,'Family is not an important thing. It&#039;s everything.',6,5),(35,'The family is the test of freedom; because the family is the only thing that the free man makes for himself and by himself.',7,5),(36,'Success is not to be pursued; it is to be attracted by the person you become.',1,6),(37,'Perseverance and spirit have done wonders in all ages.',2,6),(38,'Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful.',3,6),(39,'The successful warrior is the average man, with laser-like focus.',4,6),(40,'Always bear in mind that your own resolution to succeed is more important than any other.',5,6),(41,'Success is not measured by what you accomplish, but by the opposition you have encountered, and the courage with which you have maintained the struggle against overwhelming odds.',6,6),(42,'It had long since come to my attention that people of accomplishment rarely sat back and let things happen to them. They went out and happened to things.',7,6);
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-20 15:20:43
