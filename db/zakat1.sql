-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: zakat1
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `amil`
--

DROP TABLE IF EXISTS `amil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amil` (
  `id_amil` int(2) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `img` varchar(30) NOT NULL,
  PRIMARY KEY (`id_amil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amil`
--

LOCK TABLES `amil` WRITE;
/*!40000 ALTER TABLE `amil` DISABLE KEYS */;
INSERT INTO `amil` VALUES (3,'wawan','amilwawan','amil.png');
/*!40000 ALTER TABLE `amil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bayarzakat`
--

DROP TABLE IF EXISTS `bayarzakat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bayarzakat` (
  `id_zakat` int(4) NOT NULL AUTO_INCREMENT,
  `nama_kk` varchar(50) NOT NULL,
  `besar_bayar` int(10) NOT NULL,
  `beras` tinyint(1) DEFAULT NULL,
  `uang` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_zakat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bayarzakat`
--

LOCK TABLES `bayarzakat` WRITE;
/*!40000 ALTER TABLE `bayarzakat` DISABLE KEYS */;
INSERT INTO `bayarzakat` VALUES (1,'Wawan WanwanWan',7,1,0),(2,'Tri TritriTri',5,1,0),(3,'For ForforFor',112500,0,1),(5,'awikwok',37500,0,1);
/*!40000 ALTER TABLE `bayarzakat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribusi`
--

DROP TABLE IF EXISTS `distribusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribusi` (
  `id_penerimaan` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `jml_tanggungan` int(2) NOT NULL,
  `besar` float NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id_penerimaan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribusi`
--

LOCK TABLES `distribusi` WRITE;
/*!40000 ALTER TABLE `distribusi` DISABLE KEYS */;
INSERT INTO `distribusi` VALUES (2,'Tu tutuTu','Fakir',2,5,'2023-04-16 18:24:16'),(4,'Sik SiksikSik','Muallaf',4,10,'2023-04-16 18:24:24');
/*!40000 ALTER TABLE `distribusi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mustahik`
--

DROP TABLE IF EXISTS `mustahik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mustahik` (
  `id_mustahik` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `jml_tanggungan` int(2) NOT NULL,
  PRIMARY KEY (`id_mustahik`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mustahik`
--

LOCK TABLES `mustahik` WRITE;
/*!40000 ALTER TABLE `mustahik` DISABLE KEYS */;
INSERT INTO `mustahik` VALUES (1,'Tu tutuTu','Fakir',2),(5,'Ateng','Gharim',6),(6,'Sik SiksikSik','Miskin',7);
/*!40000 ALTER TABLE `mustahik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muzakki`
--

DROP TABLE IF EXISTS `muzakki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `muzakki` (
  `id_muzakki` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `jml_tanggungan` int(2) NOT NULL,
  `beras` int(10) NOT NULL,
  `uang` int(10) NOT NULL,
  PRIMARY KEY (`id_muzakki`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muzakki`
--

LOCK TABLES `muzakki` WRITE;
/*!40000 ALTER TABLE `muzakki` DISABLE KEYS */;
INSERT INTO `muzakki` VALUES (1,'Wawan WanwanWan',2,5,75000),(2,'Faiv FaivfaivFaiv',5,13,187500);
/*!40000 ALTER TABLE `muzakki` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-18 10:11:01
