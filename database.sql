-- MariaDB dump 10.19  Distrib 10.7.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestionelection
-- ------------------------------------------------------
-- Server version	10.7.8-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES
(1,'ADMIN','01','admin01@gmail.com','admin01');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bureau`
--

DROP TABLE IF EXISTS `bureau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bureau` (
  `nomBureau` varchar(256) DEFAULT NULL,
  `codeBv` bigint(11) NOT NULL,
  `idListe` int(11) DEFAULT NULL,
  `idCentre` int(11) DEFAULT NULL,
  PRIMARY KEY (`codeBv`),
  KEY `idListe` (`idListe`),
  KEY `idCentre` (`idCentre`),
  CONSTRAINT `bureau_ibfk_1` FOREIGN KEY (`idListe`) REFERENCES `listeelecteur` (`idListe`),
  CONSTRAINT `bureau_ibfk_3` FOREIGN KEY (`idCentre`) REFERENCES `centrevote` (`idCentre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bureau`
--

LOCK TABLES `bureau` WRITE;
/*!40000 ALTER TABLE `bureau` DISABLE KEYS */;
INSERT INTO `bureau` VALUES
('CEG Andoharanofotsy salle 1',10020008000,NULL,5),
('CEG AMBATOBE 1',110103060103,1,1),
('EPP AMBANIMASO S.1',110103060104,2,2),
('Lycée Andoharanofotsy 21',110290300900,NULL,7),
('EPP ANDOHARANOFOTSY SALLE 1',110511010101,NULL,4),
('EPP ANDOHARANOFOTSY SALLE 2',110511010102,NULL,4),
('EPP ANDOHARANOFOTSY SALLE 3',110511010103,NULL,4),
('EPP ANDOHARANOFOTSY SALLE 4',110511010104,NULL,4),
('EPP ANDOHARANOFOTSY SALLE 5',110511010105,NULL,4),
('ecole Fjkm SALLE 1',110511030101,3,3),
('ECOLE FJKM SALLE 2',110511030102,3,3),
('ECOLE FJKM SALLE 3',110511030103,3,3),
('ECOLE FJKM SALLE 4',110511030104,3,3),
('ECOLE FJKM SALLE 5',110511030105,NULL,3);
/*!40000 ALTER TABLE `bureau` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `delete_bureau` AFTER DELETE ON `bureau`
 FOR EACH ROW BEGIN
	DELETE FROM listeselecteur WHERE listeselecteur.codeBv = OLD.codeBv;
    DELETE FROM resultats WHERE resultats.codeBv = OLD.codeBv; 
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidat` (
  `nomCandidat` varchar(256) DEFAULT NULL,
  `prenomCandidat` varchar(256) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) NOT NULL,
  `partiePolitique` varchar(256) DEFAULT NULL,
  `imageCandidat` varchar(256) DEFAULT NULL,
  `idResultat` int(11) DEFAULT NULL,
  `idResultatCentre` int(11) DEFAULT NULL,
  `idResultatCom` int(11) DEFAULT NULL,
  `idResultatFkt` int(11) DEFAULT NULL,
  `idResultatDistrict` int(11) DEFAULT NULL,
  `idResultatProvince` int(11) DEFAULT NULL,
  `idResultatRegion` int(11) DEFAULT NULL,
  PRIMARY KEY (`numeroCandidat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidat`
--

LOCK TABLES `candidat` WRITE;
/*!40000 ALTER TABLE `candidat` DISABLE KEYS */;
INSERT INTO `candidat` VALUES
(NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('MICHEL','Henry',NULL,1,'FTT','image/aesthetic-super-mario-colorful-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('JEAN','Luc',NULL,2,'MMM','image/aesthetic-lavender-fields-clouds-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('JEANNE','Martine',NULL,3,'TGV','image/landscape-sunflowers-field-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('DUPONT','Louis',NULL,4,'MTS','image/last-of-us-ellie-abandoned-houses-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('ALEXANDRE','Leroy',NULL,5,'TIM','image/rdr2-serious-arthur-with-hat-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('AUGUSTE','Richard',NULL,6,'TT','image/candidats.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('LAMBERT','Lucas',NULL,7,'ARB','image/aesthetic-snowy-mountain-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('ROUSSEAU','Camille',NULL,8,'APM','image/4470310.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('DUBOIS','Pierre',NULL,10,'HVM','image/beautiful-pink-forest-desktop-wallpaper-cover.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `candidat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centrevote`
--

DROP TABLE IF EXISTS `centrevote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrevote` (
  `idCentre` int(11) NOT NULL AUTO_INCREMENT,
  `nomCentre` varchar(256) DEFAULT NULL,
  `idFokontany` int(11) DEFAULT NULL,
  `idResultatCentre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCentre`),
  KEY `idFokontany` (`idFokontany`),
  KEY `idResultatCentre` (`idResultatCentre`),
  CONSTRAINT `centrevote_ibfk_1` FOREIGN KEY (`idFokontany`) REFERENCES `fokontany` (`idFokontany`),
  CONSTRAINT `idResultatCentre` FOREIGN KEY (`idResultatCentre`) REFERENCES `resultatcentre` (`idResultatCentre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrevote`
--

LOCK TABLES `centrevote` WRITE;
/*!40000 ALTER TABLE `centrevote` DISABLE KEYS */;
INSERT INTO `centrevote` VALUES
(1,'CEG AMBATO',1,NULL),
(2,'Epp Ambanimaso',2,NULL),
(3,'FJKM Mahalavolona',3,NULL),
(4,'EPP ANDOHARANOFOTSY',4,NULL),
(5,'CEG Andoharanofotsy',4,NULL),
(7,'Lycée Andoharanofotsy',4,NULL),
(8,'OSTIE Malavolona',3,NULL);
/*!40000 ALTER TABLE `centrevote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commune`
--

DROP TABLE IF EXISTS `commune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commune` (
  `idCommune` int(11) NOT NULL AUTO_INCREMENT,
  `nomCommune` varchar(256) DEFAULT NULL,
  `idDistrict` int(11) DEFAULT NULL,
  `idResultatCom` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommune`),
  KEY `idDistrict` (`idDistrict`),
  KEY `idResultatCom` (`idResultatCom`),
  CONSTRAINT `commune_ibfk_1` FOREIGN KEY (`idDistrict`) REFERENCES `district` (`idDistrict`),
  CONSTRAINT `idResultatCom` FOREIGN KEY (`idResultatCom`) REFERENCES `resultatcommune` (`idResultatCom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commune`
--

LOCK TABLES `commune` WRITE;
/*!40000 ALTER TABLE `commune` DISABLE KEYS */;
INSERT INTO `commune` VALUES
(1,'Ambato',1,NULL),
(2,'Andoharanofotsy',2,NULL),
(3,'Ambatolampy Tsimahafotsy',1,NULL),
(4,'Ambohitrimanjaka',1,NULL),
(5,'Alakamisy Fenoarivo',2,NULL),
(6,'Ambalavao',2,NULL),
(7,'Andranonahoatra',2,NULL),
(8,'Ampitatafika',2,NULL);
/*!40000 ALTER TABLE `commune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `demandes` (
  `idDemande` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `matricule` varchar(100) DEFAULT NULL,
  `idNotif` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDemande`),
  KEY `idNotif` (`idNotif`),
  CONSTRAINT `demandes_ibfk_1` FOREIGN KEY (`idNotif`) REFERENCES `notifications` (`idNotif`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demandes`
--

LOCK TABLES `demandes` WRITE;
/*!40000 ALTER TABLE `demandes` DISABLE KEYS */;
INSERT INTO `demandes` VALUES
(2,'RAKOTO','Tendry','tendry@gmail.com','tendry67','300000000',8),
(3,'RAKOTO','Tendry','tendry@gmail.com','tendry67','ABCA123456',9),
(4,'RAKOTO','Tendry','tony@gmail.com','tony67','ABCA123456',10),
(5,'RASAMY','Tony','tony@gmail.com','tony67','TENDRY7866',11),
(6,'RAKOTO','Tony','tony@gmail.com','tony67','TENDRY7866',12),
(8,'RASATA','Ezra','ezra@gmail.com','ezra67','300000000',14),
(10,'RATOVO','Eric','eric@gmail.com','eric67','12367K90',16),
(11,'RASOA','Gene','gene@gmail.com','gene67','ABCA123456',17),
(12,'RINDRA','Nahary','rindra@gmail.com','rindra67','300000000',18);
/*!40000 ALTER TABLE `demandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `idDistrict` int(11) NOT NULL AUTO_INCREMENT,
  `nomDistrict` varchar(256) DEFAULT NULL,
  `idRegion` int(11) DEFAULT NULL,
  `idResultatDistrict` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDistrict`),
  KEY `idRegion` (`idRegion`),
  KEY `idResultatDistrict` (`idResultatDistrict`),
  CONSTRAINT `district_ibfk_1` FOREIGN KEY (`idRegion`) REFERENCES `region` (`idRegion`),
  CONSTRAINT `idResultatDistrict` FOREIGN KEY (`idResultatDistrict`) REFERENCES `resultatdistrict` (`idResultatDistrict`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES
(1,'Ambohidatrimo',1,NULL),
(2,'Antananarivo-Atsimondrano',1,NULL),
(3,'Anjozorobe',1,NULL),
(4,'Ankazobe',1,NULL),
(5,'Andramasina',1,NULL),
(6,'Fenoarivobe',2,NULL),
(7,'Tsiroanomandidy',2,NULL);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fokontany`
--

DROP TABLE IF EXISTS `fokontany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fokontany` (
  `idFokontany` int(11) NOT NULL AUTO_INCREMENT,
  `nomFokontany` varchar(256) DEFAULT NULL,
  `idcommune` int(11) DEFAULT NULL,
  `idResultatFkt` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFokontany`),
  KEY `idcommune` (`idcommune`),
  KEY `idResultatFkt` (`idResultatFkt`),
  CONSTRAINT `fokontany_ibfk_1` FOREIGN KEY (`idcommune`) REFERENCES `commune` (`idCommune`),
  CONSTRAINT `idResultatFkt` FOREIGN KEY (`idResultatFkt`) REFERENCES `resultatfokontany` (`idResultatFkt`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fokontany`
--

LOCK TABLES `fokontany` WRITE;
/*!40000 ALTER TABLE `fokontany` DISABLE KEYS */;
INSERT INTO `fokontany` VALUES
(1,'Ambato',1,NULL),
(2,'Ambanimaso',1,NULL),
(3,'Mahalavolona',2,NULL),
(4,'Andoharanofotsy',2,NULL);
/*!40000 ALTER TABLE `fokontany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listeelecteur`
--

DROP TABLE IF EXISTS `listeelecteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listeelecteur` (
  `idListe` int(11) NOT NULL AUTO_INCREMENT,
  `nombreElecteur` int(11) DEFAULT NULL,
  `nombreVotant` int(11) DEFAULT NULL,
  `voteNul` int(11) DEFAULT NULL,
  `voteBlanc` int(11) DEFAULT NULL,
  `voteExprime` int(11) DEFAULT NULL,
  `codeBv` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idListe`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listeelecteur`
--

LOCK TABLES `listeelecteur` WRITE;
/*!40000 ALTER TABLE `listeelecteur` DISABLE KEYS */;
INSERT INTO `listeelecteur` VALUES
(1,620,260,15,5,240,NULL),
(2,345,300,0,10,290,NULL),
(3,277,150,1,5,145,0),
(4,14,10,1,1,8,110103060103),
(5,15,14,2,3,9,110103060104),
(6,20,100,20,20,100,110511010101),
(7,19,15,2,3,10,110511010102),
(8,23,10,3,1,6,110511010103),
(9,21,15,3,0,12,110511010104),
(10,16,12,0,0,12,110511010105),
(11,26,19,3,2,14,110511030101);
/*!40000 ALTER TABLE `listeelecteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listeselecteur`
--

DROP TABLE IF EXISTS `listeselecteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listeselecteur` (
  `idListe` int(11) NOT NULL AUTO_INCREMENT,
  `nombreElecteurs` bigint(11) DEFAULT NULL,
  `voteNull` int(11) DEFAULT NULL,
  `voteBlanche` int(11) DEFAULT NULL,
  `voteExprime` int(11) DEFAULT NULL,
  `codeBv` bigint(20) DEFAULT NULL,
  `nombresVotants` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idListe`),
  KEY `codeBv` (`codeBv`),
  CONSTRAINT `listeselecteur_ibfk_1` FOREIGN KEY (`codeBv`) REFERENCES `bureau` (`codeBv`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listeselecteur`
--

LOCK TABLES `listeselecteur` WRITE;
/*!40000 ALTER TABLE `listeselecteur` DISABLE KEYS */;
INSERT INTO `listeselecteur` VALUES
(1,4052,0,0,9,10020008000,9),
(2,9852,12,52,9524,110103060103,9524),
(3,1011,NULL,NULL,NULL,110103060104,NULL),
(4,5201,35,23,3256,110290300900,3256),
(5,5022,NULL,NULL,NULL,110511010101,NULL),
(6,6708,NULL,NULL,NULL,110511010102,NULL),
(7,9088,NULL,NULL,NULL,110511010103,NULL),
(8,6201,NULL,NULL,NULL,110511010104,NULL),
(9,3449,26,15,2998,110511010105,2998),
(10,1290,0,19,1289,110511030101,1289),
(11,7809,NULL,NULL,NULL,110511030102,NULL),
(12,5820,NULL,NULL,NULL,110511030103,NULL),
(13,7908,NULL,NULL,NULL,110511030104,NULL),
(14,4752,NULL,NULL,NULL,110511030105,NULL);
/*!40000 ALTER TABLE `listeselecteur` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_result` AFTER DELETE ON `listeselecteur`
 FOR EACH ROW BEGIN
	DELETE FROM resultats WHERE resultats.codeBv = OLD.codeBv;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `matricules`
--

DROP TABLE IF EXISTS `matricules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricules` (
  `idMatricule` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idMatricule`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricules`
--

LOCK TABLES `matricules` WRITE;
/*!40000 ALTER TABLE `matricules` DISABLE KEYS */;
INSERT INTO `matricules` VALUES
(1,'ABCA123456'),
(2,'TENDRY7866'),
(3,'12367K90');
/*!40000 ALTER TABLE `matricules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `idNotif` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(250) DEFAULT NULL,
  `isRead` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`idNotif`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES
(5,'Un nouvel utilisateur RAKOTO Tendry demande une inscription avec le N° matricule 300000000',1),
(8,'Un nouvel utilisateur RAKOTO Tendry demande une inscription avec le N° matricule 300000000',1),
(9,'Un nouvel utilisateur RAKOTO Tendry demande une inscription avec le N° matricule ABCA123456',1),
(10,'Un nouvel utilisateur RAKOTO Tendry demande une inscription avec le N° matricule ABCA123456',1),
(11,'Un nouvel utilisateur RASAMY Tony demande une inscription avec le N° matricule TENDRY7866',1),
(12,'Un nouvel utilisateur RAKOTO Tony demande une inscription avec le N° matricule TENDRY7866',1),
(14,'Un nouvel utilisateur RASATA Ezra demande une inscription avec le N° matricule 300000000',1),
(16,'Un nouvel utilisateur RATOVO Eric demande une inscription avec le N° matricule 12367K90',1),
(17,'Un nouvel utilisateur RASOA Gene demande une inscription avec le N° matricule ABCA123456',1),
(18,'Un nouvel utilisateur RINDRA Nahary demande une inscription avec le N° matricule 300000000',1);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `delete_notif` AFTER DELETE ON `notifications`
 FOR EACH ROW BEGIN
	DELETE FROM demandes WHERE idNotif = OLD.idNotif;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `idProvince` int(11) NOT NULL AUTO_INCREMENT,
  `nomProvince` varchar(256) DEFAULT NULL,
  `idResultatProvince` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProvince`),
  KEY `idResultatProvince` (`idResultatProvince`),
  CONSTRAINT `idResultatProvince` FOREIGN KEY (`idResultatProvince`) REFERENCES `resultatprovince` (`idResultatProvince`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES
(1,'Antananarivo',NULL),
(2,'Mahajanga',NULL);
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `idRegion` int(11) NOT NULL AUTO_INCREMENT,
  `nomRegion` varchar(256) DEFAULT NULL,
  `idProvince` int(11) DEFAULT NULL,
  `idResultatRegion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRegion`),
  KEY `idProvince` (`idProvince`),
  KEY `idResultatRegion` (`idResultatRegion`),
  CONSTRAINT `idResultatRegion` FOREIGN KEY (`idResultatRegion`) REFERENCES `resultatregion` (`idResultatRegion`),
  CONSTRAINT `region_ibfk_1` FOREIGN KEY (`idProvince`) REFERENCES `province` (`idProvince`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES
(1,'Analamanga',1,NULL),
(2,'Bongolava',1,NULL);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `result1`
--

DROP TABLE IF EXISTS `result1`;
/*!50001 DROP VIEW IF EXISTS `result1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `result1` AS SELECT
 1 AS `nomcandidat`,
  1 AS `prenomCandidat`,
  1 AS `numeroCandidat`,
  1 AS `partiepolitique`,
  1 AS `imageCandidat`,
  1 AS `resultat`,
  1 AS `nombureau`,
  1 AS `nomcentre`,
  1 AS `nomfokontany`,
  1 AS `nomCommune`,
  1 AS `nomdistrict`,
  1 AS `nomRegion`,
  1 AS `nomProvince`,
  1 AS `nombreElecteur`,
  1 AS `nombreVotant`,
  1 AS `VoteNul`,
  1 AS `voteBlanc`,
  1 AS `voteExprime` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `resultatcentre`
--

DROP TABLE IF EXISTS `resultatcentre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatcentre` (
  `idResultatCentre` int(11) NOT NULL,
  `resultatCentre` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  `idCentre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatCentre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatcentre`
--

LOCK TABLES `resultatcentre` WRITE;
/*!40000 ALTER TABLE `resultatcentre` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatcentre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatcommune`
--

DROP TABLE IF EXISTS `resultatcommune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatcommune` (
  `idResultatCom` int(11) NOT NULL DEFAULT 0,
  `resultatCom` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatCom`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatcommune`
--

LOCK TABLES `resultatcommune` WRITE;
/*!40000 ALTER TABLE `resultatcommune` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatcommune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatdistrict`
--

DROP TABLE IF EXISTS `resultatdistrict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatdistrict` (
  `idResultatDistrict` int(11) NOT NULL DEFAULT 0,
  `resultatDistrict` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatDistrict`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatdistrict`
--

LOCK TABLES `resultatdistrict` WRITE;
/*!40000 ALTER TABLE `resultatdistrict` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatdistrict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatfokontany`
--

DROP TABLE IF EXISTS `resultatfokontany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatfokontany` (
  `idResultatFkt` int(11) NOT NULL DEFAULT 0,
  `resultatFkt` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  `idFokontany` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatFkt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatfokontany`
--

LOCK TABLES `resultatfokontany` WRITE;
/*!40000 ALTER TABLE `resultatfokontany` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatfokontany` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatprovince`
--

DROP TABLE IF EXISTS `resultatprovince`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatprovince` (
  `idResultatProvince` int(11) NOT NULL DEFAULT 0,
  `resultatProvince` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatProvince`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatprovince`
--

LOCK TABLES `resultatprovince` WRITE;
/*!40000 ALTER TABLE `resultatprovince` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatprovince` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatregion`
--

DROP TABLE IF EXISTS `resultatregion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatregion` (
  `idResultatRegion` int(11) NOT NULL DEFAULT 0,
  `resultatRegion` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  PRIMARY KEY (`idResultatRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatregion`
--

LOCK TABLES `resultatregion` WRITE;
/*!40000 ALTER TABLE `resultatregion` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatregion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultats`
--

DROP TABLE IF EXISTS `resultats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultats` (
  `idResultat` int(11) NOT NULL AUTO_INCREMENT,
  `resultat` int(11) DEFAULT NULL,
  `numeroCandidat` int(11) DEFAULT NULL,
  `codeBv` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idResultat`),
  KEY `numeroCandidat` (`numeroCandidat`),
  KEY `codeBv` (`codeBv`),
  CONSTRAINT `resultats_ibfk_1` FOREIGN KEY (`numeroCandidat`) REFERENCES `candidat` (`numeroCandidat`) ON UPDATE CASCADE,
  CONSTRAINT `resultats_ibfk_2` FOREIGN KEY (`codeBv`) REFERENCES `bureau` (`codeBv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultats`
--

LOCK TABLES `resultats` WRITE;
/*!40000 ALTER TABLE `resultats` DISABLE KEYS */;
INSERT INTO `resultats` VALUES
(175,1,1,10020008000),
(176,1,2,10020008000),
(177,1,3,10020008000),
(178,1,4,10020008000),
(179,1,5,10020008000),
(180,1,6,10020008000),
(181,1,7,10020008000),
(182,1,8,10020008000),
(183,1,10,10020008000),
(184,1020,1,110103060103),
(185,52,2,110103060103),
(186,1855,3,110103060103),
(187,10,4,110103060103),
(188,4526,5,110103060103),
(189,7,6,110103060103),
(190,45,7,110103060103),
(191,134,8,110103060103),
(192,1811,10,110103060103),
(193,1058,1,110290300900),
(194,25,2,110290300900),
(195,102,3,110290300900),
(196,2,4,110290300900),
(197,1071,5,110290300900),
(198,0,6,110290300900),
(199,140,7,110290300900),
(200,24,8,110290300900),
(201,776,10,110290300900),
(202,1015,1,110511010105),
(203,23,2,110511010105),
(204,536,3,110511010105),
(205,12,4,110511010105),
(206,989,5,110511010105),
(207,2,6,110511010105),
(208,9,7,110511010105),
(209,2,8,110511010105),
(210,369,10,110511010105),
(211,204,1,110511030101),
(212,12,2,110511030101),
(213,56,3,110511030101),
(214,0,4,110511030101),
(215,448,5,110511030101),
(216,2,6,110511030101),
(217,12,7,110511030101),
(218,2,8,110511030101),
(219,534,10,110511030101);
/*!40000 ALTER TABLE `resultats` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `delete_results` AFTER DELETE ON `resultats`
 FOR EACH ROW BEGIN
	UPDATE listeselecteur SET voteNull = NULL, voteBlanche = NULL, voteExprime = NULL, nombresVotants = NULL WHERE listeselecteur.codeBv = OLD.codeBv;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `idMatricule` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  KEY `matricule_id` (`idMatricule`),
  CONSTRAINT `matricule_id` FOREIGN KEY (`idMatricule`) REFERENCES `matricules` (`idMatricule`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(22,'ADMIN','01','admin01@gmail.com','admin01',1),
(23,'USER','01','user01@gmail.com','user01',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `result1`
--

/*!50001 DROP VIEW IF EXISTS `result1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb3 */;
/*!50001 SET character_set_results     = utf8mb3 */;
/*!50001 SET collation_connection      = utf8mb3_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `result1` AS select `candidat`.`nomCandidat` AS `nomcandidat`,`candidat`.`prenomCandidat` AS `prenomCandidat`,`candidat`.`numeroCandidat` AS `numeroCandidat`,`candidat`.`partiePolitique` AS `partiepolitique`,`candidat`.`imageCandidat` AS `imageCandidat`,`resultats`.`resultat` AS `resultat`,`bureau`.`nomBureau` AS `nombureau`,`centrevote`.`nomCentre` AS `nomcentre`,`fokontany`.`nomFokontany` AS `nomfokontany`,`commune`.`nomCommune` AS `nomCommune`,`district`.`nomDistrict` AS `nomdistrict`,`region`.`nomRegion` AS `nomRegion`,`province`.`nomProvince` AS `nomProvince`,`listeelecteur`.`nombreElecteur` AS `nombreElecteur`,`listeelecteur`.`nombreVotant` AS `nombreVotant`,`listeelecteur`.`voteNul` AS `VoteNul`,`listeelecteur`.`voteBlanc` AS `voteBlanc`,`listeelecteur`.`voteExprime` AS `voteExprime` from (((((((((`resultats` join `candidat` on(`resultats`.`numeroCandidat` = `candidat`.`numeroCandidat`)) join `bureau` on(`resultats`.`codeBv` = `bureau`.`codeBv`)) join `centrevote` on(`bureau`.`idCentre` = `centrevote`.`idCentre`)) join `listeelecteur` on(`listeelecteur`.`codeBv` = `bureau`.`codeBv`)) join `fokontany` on(`centrevote`.`idFokontany` = `fokontany`.`idFokontany`)) join `commune` on(`fokontany`.`idcommune` = `commune`.`idCommune`)) join `district` on(`commune`.`idDistrict` = `district`.`idDistrict`)) join `region` on(`district`.`idRegion` = `region`.`idRegion`)) join `province` on(`region`.`idProvince` = `province`.`idProvince`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-10 19:28:03
