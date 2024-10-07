-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fw
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `tb_carrito`
--

DROP TABLE IF EXISTS `tb_carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_carrito` (
  `id_ca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(40) DEFAULT NULL,
  `cantidad_pro` int(11) NOT NULL,
  `precio_pro` float NOT NULL,
  `fecha_agre` timestamp NULL DEFAULT current_timestamp(),
  `documento_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_ca`),
  KEY `documento_usuario` (`documento_usuario`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tb_carrito_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`) ON DELETE CASCADE,
  CONSTRAINT `tb_carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_carrito`
--

LOCK TABLES `tb_carrito` WRITE;
/*!40000 ALTER TABLE `tb_carrito` DISABLE KEYS */;
INSERT INTO `tb_carrito` VALUES (23,'camiseta',2,30,'2024-10-03 15:52:34',912,2),(26,'camiseta',1,30,'2024-10-04 12:50:06',911,2);
/*!40000 ALTER TABLE `tb_carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
INSERT INTO `tb_categoria` VALUES (1,'Ropa para Damas y caballeross'),(3,'ropa infantil'),(4,'calzado para todos'),(5,'accesorios para todos');
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_comentarios`
--

DROP TABLE IF EXISTS `tb_comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `documento_usuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_publicacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_comentario`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_comentarios_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_comentarios`
--

LOCK TABLES `tb_comentarios` WRITE;
/*!40000 ALTER TABLE `tb_comentarios` DISABLE KEYS */;
INSERT INTO `tb_comentarios` VALUES (20,911,'garfi es un loco','2024-10-01 05:08:09'),(23,912,'hola\n','2024-10-03 13:18:06');
/*!40000 ALTER TABLE `tb_comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_pro_actu`
--

DROP TABLE IF EXISTS `tb_conteo_pro_actu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_pro_actu` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_pro_actu`
--

LOCK TABLES `tb_conteo_pro_actu` WRITE;
/*!40000 ALTER TABLE `tb_conteo_pro_actu` DISABLE KEYS */;
INSERT INTO `tb_conteo_pro_actu` VALUES (1,'Se ha actualizado el producto: hoola con el ID: 1',1,'2024-09-26 13:13:47'),(2,'Se ha actualizado el producto: hooloo con el ID: 1',1,'2024-10-04 12:02:08');
/*!40000 ALTER TABLE `tb_conteo_pro_actu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_pro_eli`
--

DROP TABLE IF EXISTS `tb_conteo_pro_eli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_pro_eli` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_eli` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_pro_eli`
--

LOCK TABLES `tb_conteo_pro_eli` WRITE;
/*!40000 ALTER TABLE `tb_conteo_pro_eli` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_conteo_pro_eli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_pro_reg`
--

DROP TABLE IF EXISTS `tb_conteo_pro_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_pro_reg` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_pro_reg`
--

LOCK TABLES `tb_conteo_pro_reg` WRITE;
/*!40000 ALTER TABLE `tb_conteo_pro_reg` DISABLE KEYS */;
INSERT INTO `tb_conteo_pro_reg` VALUES (1,'Se ha creado el producto: hoola con el ID: 1',1,'2024-09-26 13:13:21'),(2,'Se ha creado el producto: camiseta con el ID: 2',1,'2024-10-03 05:39:32'),(3,'Se ha creado el producto: pantalon con el ID: 3',1,'2024-10-03 05:50:25');
/*!40000 ALTER TABLE `tb_conteo_pro_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_user_actu`
--

DROP TABLE IF EXISTS `tb_conteo_user_actu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_user_actu` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_user_actu`
--

LOCK TABLES `tb_conteo_user_actu` WRITE;
/*!40000 ALTER TABLE `tb_conteo_user_actu` DISABLE KEYS */;
INSERT INTO `tb_conteo_user_actu` VALUES (1,'Se ha actualizado el usuario: claudia con el ID: 911',1,'2024-09-26 18:10:28'),(2,'Se ha actualizado el usuario: claudia con el ID: 911',1,'2024-09-26 13:14:34'),(3,'Se ha actualizado el usuario: claudiaaa con el ID: 911',1,'2024-09-26 13:15:02'),(4,'Se ha actualizado el usuario: garfi con el ID: 123',1,'2024-09-28 23:43:53'),(5,'Se ha actualizado el usuario: garfi con el ID: 123',1,'2024-09-28 23:44:33'),(6,'Se ha actualizado el usuario: claudiaaa con el ID: 911',1,'2024-10-01 05:06:35'),(7,'Se ha actualizado el usuario: claudiaaa con el ID: 911',1,'2024-10-01 00:07:16'),(8,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 00:59:22'),(9,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 00:59:46'),(10,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 12:05:36'),(11,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 12:05:43'),(12,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 21:48:34'),(13,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 23:46:30'),(14,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-01 23:46:34'),(15,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-02 04:48:33'),(16,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-02 05:12:15'),(17,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-02 00:13:08'),(18,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-02 05:26:32'),(19,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-03 05:32:53'),(20,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-03 08:41:11'),(21,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-03 11:15:23'),(22,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-03 12:23:07'),(23,'Se ha actualizado el usuario: martica con el ID: 913',1,'2024-10-03 15:53:48'),(24,'Se ha actualizado el usuario: may con el ID: 1120',1,'2024-10-03 16:17:58'),(25,'Se ha actualizado el usuario: may con el ID: 1120',1,'2024-10-03 16:22:13'),(26,'Se ha actualizado el usuario: claudiaa con el ID: 911',1,'2024-10-04 11:24:04');
/*!40000 ALTER TABLE `tb_conteo_user_actu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_user_eli`
--

DROP TABLE IF EXISTS `tb_conteo_user_eli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_user_eli` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_eli` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_user_eli`
--

LOCK TABLES `tb_conteo_user_eli` WRITE;
/*!40000 ALTER TABLE `tb_conteo_user_eli` DISABLE KEYS */;
INSERT INTO `tb_conteo_user_eli` VALUES (1,'El ususario: martica con el ID: 913 ha eliminado su cuenta.',1,'2024-10-03 15:57:19');
/*!40000 ALTER TABLE `tb_conteo_user_eli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_conteo_user_reg`
--

DROP TABLE IF EXISTS `tb_conteo_user_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_conteo_user_reg` (
  `id_conteo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `conteo` int(11) NOT NULL,
  `fec_reg` datetime NOT NULL,
  PRIMARY KEY (`id_conteo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_conteo_user_reg`
--

LOCK TABLES `tb_conteo_user_reg` WRITE;
/*!40000 ALTER TABLE `tb_conteo_user_reg` DISABLE KEYS */;
INSERT INTO `tb_conteo_user_reg` VALUES (1,'Se ha registrado el usuario: claudia con el ID: 911',1,'2024-09-26 13:08:54'),(2,'Se ha registrado el usuario: garfi con el ID: 123',1,'2024-09-26 18:30:22'),(3,'Se ha registrado el usuario: pedro con el ID: 912',1,'2024-10-03 06:03:45'),(4,'Se ha registrado el usuario: martica con el ID: 913',1,'2024-10-03 15:53:27'),(5,'Se ha registrado el usuario: may con el ID: 1120',1,'2024-10-03 16:16:23');
/*!40000 ALTER TABLE `tb_conteo_user_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detalle_factura`
--

DROP TABLE IF EXISTS `tb_detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` float NOT NULL,
  `subtotal` float NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_factura` (`id_factura`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `tb_detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `tb_facturas` (`id_factura`),
  CONSTRAINT `tb_detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detalle_factura`
--

LOCK TABLES `tb_detalle_factura` WRITE;
/*!40000 ALTER TABLE `tb_detalle_factura` DISABLE KEYS */;
INSERT INTO `tb_detalle_factura` VALUES (1,1,1,1,20,20),(2,2,1,1,20,20),(3,3,2,1,30,30);
/*!40000 ALTER TABLE `tb_detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_facturas`
--

DROP TABLE IF EXISTS `tb_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `documento_usuario` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_factura` timestamp NULL DEFAULT current_timestamp(),
  `direccion` varchar(255) DEFAULT NULL,
  `numero_tarjeta` varchar(16) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_facturas_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_facturas`
--

LOCK TABLES `tb_facturas` WRITE;
/*!40000 ALTER TABLE `tb_facturas` DISABLE KEYS */;
INSERT INTO `tb_facturas` VALUES (1,911,'tarjeta','2024-10-02 20:26:11','barrio villa andrea','31353253','3132254763',20),(2,911,'tarjeta','2024-10-02 21:09:32','barrio villa andrea','31353253','3132254763',20),(3,1120,'tarjeta','2024-10-03 21:16:55','barrio villa andrea','7777478','3132254763',30);
/*!40000 ALTER TABLE `tb_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_favoritos`
--

DROP TABLE IF EXISTS `tb_favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_favoritos` (
  `id_favo` int(11) NOT NULL AUTO_INCREMENT,
  `documento_usuario` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `nombre_produc` varchar(50) NOT NULL,
  `fecga_agreg` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_favo`),
  KEY `id_pro` (`id_pro`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_favoritos_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `tb_favoritos_ibfk_2` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_favoritos`
--

LOCK TABLES `tb_favoritos` WRITE;
/*!40000 ALTER TABLE `tb_favoritos` DISABLE KEYS */;
INSERT INTO `tb_favoritos` VALUES (23,911,1,'hoola','2024-10-03 04:28:21'),(36,911,3,'pantalon','2024-10-04 12:50:03');
/*!40000 ALTER TABLE `tb_favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fecha_especial`
--

DROP TABLE IF EXISTS `tb_fecha_especial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_fecha_especial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `color_evento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fecha_especial`
--

LOCK TABLES `tb_fecha_especial` WRITE;
/*!40000 ALTER TABLE `tb_fecha_especial` DISABLE KEYS */;
INSERT INTO `tb_fecha_especial` VALUES (5,'primavera','2024-03-02','2024-12-10','#e1da0e');
/*!40000 ALTER TABLE `tb_fecha_especial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_likes`
--

DROP TABLE IF EXISTS `tb_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `valor` varchar(20) NOT NULL,
  PRIMARY KEY (`id_like`),
  KEY `producto_id` (`producto_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tb_likes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `tb_productos` (`id_producto`) ON DELETE CASCADE,
  CONSTRAINT `tb_likes_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_likes`
--

LOCK TABLES `tb_likes` WRITE;
/*!40000 ALTER TABLE `tb_likes` DISABLE KEYS */;
INSERT INTO `tb_likes` VALUES (109,2,911,'like');
/*!40000 ALTER TABLE `tb_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lista_deseos`
--

DROP TABLE IF EXISTS `tb_lista_deseos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lista_deseos` (
  `id_deseo` int(11) NOT NULL AUTO_INCREMENT,
  `documento_usuario` int(11) NOT NULL,
  `nombre_producto` varchar(150) NOT NULL,
  `foto_referencia` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_deseo`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_lista_deseos_ibfk_1` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lista_deseos`
--

LOCK TABLES `tb_lista_deseos` WRITE;
/*!40000 ALTER TABLE `tb_lista_deseos` DISABLE KEYS */;
INSERT INTO `tb_lista_deseos` VALUES (19,911,'pantalon holgado ','0f0e2f4610e7eeec221ecdafa99403ee.jpg,3BASICAS-V2-LIGHT.webp,6e6a48600ac28f39d22ff3ff145a0982.jpg,9f6133e03af1790928a785838c043009.webp','2024-10-01 21:31:17'),(20,911,'camisa','6e6a48600ac28f39d22ff3ff145a0982.jpg,9f6133e03af1790928a785838c043009.webp','2024-10-01 21:47:58');
/*!40000 ALTER TABLE `tb_lista_deseos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productos`
--

DROP TABLE IF EXISTS `tb_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(150) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `detalles` varchar(150) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `tallas` varchar(50) DEFAULT NULL,
  `ruta_img` varchar(250) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_producto`),
  KEY `fk_categoria` (`id_categoria`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productos`
--

LOCK TABLES `tb_productos` WRITE;
/*!40000 ALTER TABLE `tb_productos` DISABLE KEYS */;
INSERT INTO `tb_productos` VALUES (1,'hooloo',20,100,'bonitaaaa','#ee1111','tallas m','../img/6e6a48600ac28f39d22ff3ff145a0982.jpg',1),(2,'camiseta',30,8,'es rosada muy bonita','#d91286','xs','../img/3BASICAS-V2-LIGHT.webp',1),(3,'pantalon',30.59,7,'a calor','#100448','xl','../img/9f6133e03af1790928a785838c043009.webp',1);
/*!40000 ALTER TABLE `tb_productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_pro_reg
after insert on
tb_productos
for each row begin 
insert into tb_conteo_pro_reg()
values(null,concat('Se ha creado el producto: ', new.nombre_producto,' con el ID: ',new.id_producto),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_pro_actu
after update on
tb_productos
for each row begin 
insert into tb_conteo_pro_actu()
values(null,concat('Se ha actualizado el producto: ', new.nombre_producto,' con el ID: ',new.id_producto),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_pro_eli
after delete on
tb_productos
for each row begin 
insert into tb_conteo_pro_eli()
values(null,concat('Se ha eliminado el producto: ', old.nombre_producto,' con el ID: ',old.id_producto),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tb_respuestas`
--

DROP TABLE IF EXISTS `tb_respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_respuestas` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_comentario` int(11) NOT NULL,
  `documento_usuario` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_publicacion` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_respuesta`),
  KEY `id_comentario` (`id_comentario`),
  KEY `documento_usuario` (`documento_usuario`),
  CONSTRAINT `tb_respuestas_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `tb_comentarios` (`id_comentario`) ON DELETE CASCADE,
  CONSTRAINT `tb_respuestas_ibfk_2` FOREIGN KEY (`documento_usuario`) REFERENCES `tb_usuarios` (`documento`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_respuestas`
--

LOCK TABLES `tb_respuestas` WRITE;
/*!40000 ALTER TABLE `tb_respuestas` DISABLE KEYS */;
INSERT INTO `tb_respuestas` VALUES (31,23,911,'hola feo','2024-10-03 13:42:55'),(32,20,911,'hhh','2024-10-03 13:47:29'),(33,20,912,'holii','2024-10-03 13:56:47');
/*!40000 ALTER TABLE `tb_respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_usuarios` (
  `documento` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `fecha` varchar(30) NOT NULL,
  `foto` varchar(2000) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (123,'garfi','cardona','cardonaclaudia0910@gmail.com','$2y$12$tnwH7ELOxsfUpjb3icjlVu5vMnAtPxt/0B427BblBISAqoua4fQFm','2000-08-09','66f8db3113a7c.jpg',2),(911,'claudiaa','cardonaaa','cardonaclaudia0910@gmail.com','$2y$12$SJPbxLfMsQ4.a4S5eRnvuOLQgVFOaYqvGttHjMZyPfVzjqt5Yw5NW','2006-05-09','66fcd66435263.webp',1),(912,'pedro','lopez','cardonaclaudia0910@gmail.com','$2y$12$w.GPm.QEvVYsDoteC4H0fuTXKyYVyrw.s2aQwrUATPAqjQwyq2Sfa','2000-04-07',NULL,2),(1120,'may','sim','mayrahs760@gmail.com','$2y$12$c7hSvGlUPOf8o35fvuZ2dO9l3I6B7VeCiHzu88Dj73TeJno3xwlNu','2005-03-14',NULL,2);
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_user_reg
after insert on
tb_usuarios
for each row begin 
insert into tb_conteo_user_reg()
values(null,concat('Se ha registrado el usuario: ', new.nombre,' con el ID: ',new.documento),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_user_actu
after update on
tb_usuarios
for each row begin 
insert into tb_conteo_user_actu()
values(null,concat('Se ha actualizado el usuario: ', new.nombre,' con el ID: ',new.documento),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger contando_user_eli
after delete on
tb_usuarios
for each row begin 
insert into tb_conteo_user_eli()
values(null,concat('El ususario: ', old.nombre,' con el ID: ',old.documento,' ha eliminado su cuenta.'),1, now() );
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping events for database 'fw'
--

--
-- Dumping routines for database 'fw'
--
/*!50003 DROP FUNCTION IF EXISTS `contar_usuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `contar_usuarios`() RETURNS int(11)
    READS SQL DATA
    DETERMINISTIC
BEGIN
    DECLARE total_usuarios INT;

    SELECT COUNT(*) INTO total_usuarios FROM tb_usuarios;

    RETURN total_usuarios;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `contar_productos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `contar_productos`()
BEGIN
    DECLARE total_productos INT;

    SELECT COUNT(*) INTO total_productos FROM tb_productos;

    SELECT total_productos AS total_registrados;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-05  2:15:48
