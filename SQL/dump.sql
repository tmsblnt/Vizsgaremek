/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: umszkikresz_db
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `felhasznalok`
--

DROP TABLE IF EXISTS `felhasznalok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `felhasznalonev` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `regisztracio_datuma` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `felhasznalonev` (`felhasznalonev`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalok`
--

LOCK TABLES `felhasznalok` WRITE;
/*!40000 ALTER TABLE `felhasznalok` DISABLE KEYS */;
INSERT INTO `felhasznalok` VALUES
(1,'Aladasgyerek','$2y$10$4AXY5Rph9WqXdjUv9wQUNe9W1Yr8Vcx5er4fYllNcomPf7c6G3X9O','2025-03-06 08:02:23'),
(2,'Admin','$2y$10$NWZGfWX6ZD81DLH12I9Y9uv0H.I60.OgVn7uksL9IWcMucDGaMHmq','2025-03-06 08:04:23'),
(5,'umszkikresz','$2y$10$13AnZ/9Nne3EgiYflReMZufcBdIXEeHFRweYbh6gM0wM5mA9Q0fMu','2025-03-13 08:28:39'),
(6,'CSOTI','$2y$10$zlFCopWywOIMt5iAMYH9FOQW.xzD14qjhpXVqjThdaEeWxdm41uRC','2025-03-13 08:54:34'),
(7,'proba','$2y$10$CixwaT6Bmobh/0pCBpuYBuGNCyPxL5wz.HxiwhNe0xwD4VDGvSb3W','2025-03-14 06:27:04');
/*!40000 ALTER TABLE `felhasznalok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `license` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_hungarian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES
(1,'Dubi Subi','subi.dubi@subidubi.asd','b'),
(2,'Füty Imre','futy.imre@futyimre.hu','e'),
(3,'Kovács Péter','kovacs.peter@example.com','a'),
(4,'Szabó Gábor','szabo.gabor@example.com','b'),
(5,'Nagy Zoltán','nagy.zoltan@example.com','c'),
(6,'Tóth László','toth.laszlo@example.com','d'),
(7,'Horváth István','horvath.istvan@example.com','e'),
(8,'Varga Tamás','varga.tamas@example.com','a'),
(9,'Kiss József','kiss.jozsef@example.com','b'),
(10,'Józsa András','jozsa.andras@example.com','c'),
(11,'Papp Attila','papp.attila@example.com','d'),
(12,'Mészáros Miklós','meszaros.miklos@example.com','e'),
(13,'Fá Zoltán','fa.zoltan@fazoltan.com','b'),
(14,'Nagy István','nagy.istvan@mail.com','c'),
(15,'Péter Farkas','peter.farkas@peterfarkas.com','b'),
(16,'Kovács Béla','kovacs.bela@mail.hu','b'),
(17,'Tóth József','toth.jozsef@toth.hu','d'),
(18,'Fekete András','fekete.andras@mail.com','b'),
(19,'Böröcz Gábor','borocz.gabor@borocz.hu','b'),
(20,'Kis Dávid','kis.david@kis.hu','c'),
(21,'Bodó Ádám','bodo.adam@bodo.hu','b'),
(22,'Varga László','varga.laszlo@varga.com','b'),
(23,'Füleki Viktor','fuleki.viktor@mail.hu','e'),
(24,'Tóth Miklós','toth.miklos@toth.hu','b'),
(25,'Móricz Károly','moricz.karoly@moricz.com','d'),
(26,'Kocsis Zoltán','kocsis.zoltan@kocsis.hu','b'),
(27,'Nagy Tamás','nagy.tamas@tamas.hu','b'),
(28,'Szentmiklósi Gergő','szentmiklosi.gergo@mail.hu','b'),
(29,'Varga Tamás','varga.tamas@varga.hu','b'),
(30,'Kiss Mózes','kiss.mozes@mail.hu','c'),
(31,'Bánfi Zsolt','banfi.zsolt@banfi.hu','e'),
(32,'Keresztes Miklós','keresztes.miklos@keresztes.hu','b'),
(33,'Szűcs Balázs','szucs.balazs@mail.com','b'),
(34,'Lukács Zoltán','lukacs.zoltan@mail.hu','b'),
(35,'Bárdos Áron','bardos.aron@bardos.hu','b'),
(36,'Szilágyi Bálint','szilagyi.balint@szilagyi.hu','c'),
(37,'Cseh Tamás','cseh.tamas@cseh.hu','b'),
(38,'Fazekas Zsolt','fazekas.zsolt@fazekas.hu','b'),
(39,'Pap Péter','pap.peter@mail.com','b'),
(40,'Sárközi Gábor','sarkozi.gabor@sarkozi.hu','d'),
(41,'Szekeres Tamás','szekeres.tamas@szekeres.hu','b'),
(42,'Rózsa Zoltán','rozsa.zoltan@rozsa.hu','c'),
(43,'Fodor Levente','fodor.levente@fodor.hu','b'),
(44,'Benedek Miklós','benedek.miklos@benedek.hu','e'),
(45,'Szentpáli András','szentpali.andras@mail.hu','b'),
(46,'Hajdú Zoltán','hajdu.zoltan@hajdu.hu','b'),
(47,'Pásztor József','pasztor.jozsef@pasztor.hu','b'),
(48,'Török Gábor','toro.gabor@toro.hu','c'),
(49,'Pintér Dávid','pinter.david@pinter.hu','b'),
(50,'Varga Gergely','varga.gergely@varga.hu','b'),
(51,'Barna János','barna.janos@barna.hu','b'),
(79,'hdsaigsdig','sadsadsa@asdads.hu','b'),
(80,'Kutyagyerek','kutyagyerek@gmail.com','a');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-28  8:16:48
