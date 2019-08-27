-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: btech2017
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `AS_ARG_TABLE`
--

DROP TABLE IF EXISTS `AS_ARG_TABLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AS_ARG_TABLE` (
  `name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `yoj` int(11) DEFAULT NULL,
  `course` varchar(12) DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `pswd` varchar(255) DEFAULT NULL,
  `profile` varchar(255) NOT NULL,
  `state` varchar(40) DEFAULT NULL,
  `district` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`profile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AS_ARG_TABLE`
--

LOCK TABLES `AS_ARG_TABLE` WRITE;
/*!40000 ALTER TABLE `AS_ARG_TABLE` DISABLE KEYS */;
INSERT INTO `AS_ARG_TABLE` VALUES ('Aditya Raj Gupta','1999-05-07',2017,'B.TECH.','B+','Male','Shree Sai Niwas,Chotta Tengra, Near kali mandir, Behind SBI atm','c362978aa4f25b54a297375a019409b8698794eb','uploads/IMG_aditya_raj_gupta_1999-05-07.jpg','West Bengal','Paschim Medinipur'),('Arijit Saha','2000-01-08',2017,'B.TECH.','B+','Male','Flat 2G, Block 2, Sabitri Appartments, 27 K.B. Sarani, Mall Rd., Dum Dum, Kolkata, India - 700080','a0a15dd85a3c432fae167fbdf2fc0b1d2b23d108','uploads/IMG_arijit_saha_2000-01-08.jpg','West Bengal','North 24 Parganas'),('Divyansh Shrivastava','1999-01-16',2017,'B.TECH.','AB+','Male','Kuch Ek','b9a72812c02c60f5184e09d8ab167046fc15f29e','uploads/IMG_divyansh_shrivastava_1999-01-16.jpg','Rajasthan','Chittorgarh'),('Indranil Bit','1998-09-19',2017,'B.TECH.','B+','Male','Highstreet,R.N.Tagore Road','93ec71b22793a81569c94ca17e4d9c293d8e201f','uploads/IMG_indranil_bit_1998-09-19.jpg','West Bengal','Nadia'),('SAYAN DEY','1997-11-07',2017,'B.TECH.','B+','Male','FIRM SIDE ROAD 1ST LANE CHUCHURA R.S. HOOGHLY-712102','93224fbd9a495f5012905ef6996e5eb548fe8104','uploads/IMG_sayan_dey_1997-11-07.jpg','West Bengal','Hooghly');
/*!40000 ALTER TABLE `AS_ARG_TABLE` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-23  1:11:04
