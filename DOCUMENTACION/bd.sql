-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_taller
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_clientes`
--

DROP TABLE IF EXISTS `tb_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_clientes` (
  `rut_cliente` int(11) NOT NULL,
  `dv` varchar(1) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `calle` text,
  `numero_calle` int(11) DEFAULT NULL,
  `comuna` text,
  `giro` varchar(50) DEFAULT NULL,
  `telefono` varchar(45) NOT NULL,
  PRIMARY KEY (`rut_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_clientes`
--

LOCK TABLES `tb_clientes` WRITE;
/*!40000 ALTER TABLE `tb_clientes` DISABLE KEYS */;
INSERT INTO `tb_clientes` VALUES (18319075,'k','johnny','cea','veracruz',707,'angol','giro1','888889999'),(18645267,'4','Marcela','Santander','veracruz',707,'angol','undostres','990595485');
/*!40000 ALTER TABLE `tb_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detalle_orden`
--

DROP TABLE IF EXISTS `tb_detalle_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_detalle_orden` (
  `id_detalle` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_unitario` int(11) NOT NULL,
  `valor_total` int(11) NOT NULL,
  `tipo_detalle` int(11) NOT NULL,
  `usuario_creador` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_tb_detalle_orden_tb_tipo_detalle1_idx` (`tipo_detalle`),
  KEY `fk_tb_detalle_orden_tb_orden_trabajo1_idx` (`id_orden`),
  KEY `fk_tb_detalle_orden_tb_usuario1_idx` (`usuario_creador`),
  CONSTRAINT `fk_tb_detalle_orden_tb_orden_trabajo1` FOREIGN KEY (`id_orden`) REFERENCES `tb_orden_trabajo` (`id_orden`),
  CONSTRAINT `fk_tb_detalle_orden_tb_tipo_detalle1` FOREIGN KEY (`tipo_detalle`) REFERENCES `tb_tipo_detalle` (`id_tipo_detalle`),
  CONSTRAINT `fk_tb_detalle_orden_tb_usuario1` FOREIGN KEY (`usuario_creador`) REFERENCES `tb_usuarios` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detalle_orden`
--

LOCK TABLES `tb_detalle_orden` WRITE;
/*!40000 ALTER TABLE `tb_detalle_orden` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_detalle_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_orden`
--

DROP TABLE IF EXISTS `tb_estado_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_estado_orden` (
  `id_estado_orden` int(11) NOT NULL,
  `descripcion_estado_orden` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado_orden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_orden`
--

LOCK TABLES `tb_estado_orden` WRITE;
/*!40000 ALTER TABLE `tb_estado_orden` DISABLE KEYS */;
INSERT INTO `tb_estado_orden` VALUES (1,'Vacia'),(2,'Pendiente'),(3,'Entregado'),(4,'Pagado');
/*!40000 ALTER TABLE `tb_estado_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_usuario`
--

DROP TABLE IF EXISTS `tb_estado_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_estado_usuario` (
  `id_estado` int(11) NOT NULL,
  `descripcion_estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_usuario`
--

LOCK TABLES `tb_estado_usuario` WRITE;
/*!40000 ALTER TABLE `tb_estado_usuario` DISABLE KEYS */;
INSERT INTO `tb_estado_usuario` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `tb_estado_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_orden_trabajo`
--

DROP TABLE IF EXISTS `tb_orden_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_orden_trabajo` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_diagnostico` text,
  `kilometraje` int(11) NOT NULL DEFAULT '0',
  `patente` varchar(50) DEFAULT NULL,
  `rut_cliente` int(11) DEFAULT NULL,
  `fecha_recepcion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` datetime DEFAULT NULL,
  `id_estado` int(11) NOT NULL DEFAULT '1',
  `id_tipo_facturacion` int(11) NOT NULL DEFAULT '1',
  `iva_venta` int(11) DEFAULT NULL,
  `porcentaje_descuento` int(11) DEFAULT NULL,
  `usuario_creador` int(11) NOT NULL,
  `rut_trabajador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `fk_tb_orden_trabajo_tb_vehiculos_idx` (`patente`),
  KEY `fk_tb_orden_trabajo_tb_clientes1_idx` (`rut_cliente`),
  KEY `fk_tb_orden_trabajo_tb_estado_orden1_idx` (`id_estado`),
  KEY `fk_tb_orden_trabajo_tb_tipo_facturacion1_idx` (`id_tipo_facturacion`),
  KEY `fk_tb_orden_trabajo_tb_usuario1_idx` (`usuario_creador`),
  KEY `fk_tb_orden_trabajo_tb_usuarios_idx` (`rut_trabajador`),
  CONSTRAINT `fk_tb_orden_trabajo_tb_clientes1` FOREIGN KEY (`rut_cliente`) REFERENCES `tb_clientes` (`rut_cliente`),
  CONSTRAINT `fk_tb_orden_trabajo_tb_estado_orden1` FOREIGN KEY (`id_estado`) REFERENCES `tb_estado_orden` (`id_estado_orden`) ON UPDATE CASCADE,
  CONSTRAINT `fk_tb_orden_trabajo_tb_tipo_facturacion1` FOREIGN KEY (`id_tipo_facturacion`) REFERENCES `tb_tipo_facturacion` (`id_tipo_facturacion`),
  CONSTRAINT `fk_tb_orden_trabajo_tb_usuario1` FOREIGN KEY (`usuario_creador`) REFERENCES `tb_usuarios` (`rut`),
  CONSTRAINT `fk_tb_orden_trabajo_tb_vehiculos` FOREIGN KEY (`patente`) REFERENCES `tb_vehiculos` (`patente`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_orden_trabajo`
--

LOCK TABLES `tb_orden_trabajo` WRITE;
/*!40000 ALTER TABLE `tb_orden_trabajo` DISABLE KEYS */;
INSERT INTO `tb_orden_trabajo` VALUES (17,'h',50,NULL,NULL,'2019-07-13 01:00:25',NULL,1,1,NULL,NULL,18319075,18273352);
/*!40000 ALTER TABLE `tb_orden_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_detalle`
--

DROP TABLE IF EXISTS `tb_tipo_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_tipo_detalle` (
  `id_tipo_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_detalle` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_detalle`
--

LOCK TABLES `tb_tipo_detalle` WRITE;
/*!40000 ALTER TABLE `tb_tipo_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_tipo_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_facturacion`
--

DROP TABLE IF EXISTS `tb_tipo_facturacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_tipo_facturacion` (
  `id_tipo_facturacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_factura` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_facturacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_facturacion`
--

LOCK TABLES `tb_tipo_facturacion` WRITE;
/*!40000 ALTER TABLE `tb_tipo_facturacion` DISABLE KEYS */;
INSERT INTO `tb_tipo_facturacion` VALUES (1,'Boleta'),(2,'Factura');
/*!40000 ALTER TABLE `tb_tipo_facturacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_usuario`
--

DROP TABLE IF EXISTS `tb_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `descripcion_tipo_usuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_usuario`
--

LOCK TABLES `tb_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tb_tipo_usuario` DISABLE KEYS */;
INSERT INTO `tb_tipo_usuario` VALUES (1,'Administrador'),(2,'Encargado'),(3,'Trabajador');
/*!40000 ALTER TABLE `tb_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_trabajadores_orden`
--

DROP TABLE IF EXISTS `tb_trabajadores_orden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_trabajadores_orden` (
  `id_orden` int(11) NOT NULL,
  `rut_trabajador` int(11) NOT NULL,
  PRIMARY KEY (`id_orden`,`rut_trabajador`),
  KEY `fk_tb_orden_trabajo_has_tb_trabajadores_tb_orden_trabajo1_idx` (`id_orden`),
  KEY `fk_tb_trabajadores_orden_tb_usuario1_idx` (`rut_trabajador`),
  CONSTRAINT `fk_tb_orden_trabajo_has_tb_trabajadores_tb_orden_trabajo1` FOREIGN KEY (`id_orden`) REFERENCES `tb_orden_trabajo` (`id_orden`),
  CONSTRAINT `fk_tb_trabajadores_orden_tb_usuario1` FOREIGN KEY (`rut_trabajador`) REFERENCES `tb_usuarios` (`rut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_trabajadores_orden`
--

LOCK TABLES `tb_trabajadores_orden` WRITE;
/*!40000 ALTER TABLE `tb_trabajadores_orden` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_trabajadores_orden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_usuarios` (
  `rut` int(11) NOT NULL,
  `digito_verificador` varchar(1) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `clave` text NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `correo` text,
  PRIMARY KEY (`rut`),
  KEY `fk_tb_usuario_tb_tipo_usuario1_idx` (`tipo_usuario`),
  KEY `fk_tb_usuario_tb_estado_usuario1_idx` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (18273352,'0','Billy','$10$oppzdjeQDqu9hYfWII9CvutDAafJ8z3EL9FBgoUSCYURGBbUUhrre',1,3,'billy@hola.com'),(18319075,'k','Jonathan','$2y$10$oppzdjeQDqu9hYfWII9CvutDAafJ8z3EL9FBgoUSCYURGBbUUhrre',1,1,'ceaceajohnny@gmail.com');
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vehiculos`
--

DROP TABLE IF EXISTS `tb_vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_vehiculos` (
  `patente` varchar(50) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL,
  PRIMARY KEY (`patente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vehiculos`
--

LOCK TABLES `tb_vehiculos` WRITE;
/*!40000 ALTER TABLE `tb_vehiculos` DISABLE KEYS */;
INSERT INTO `tb_vehiculos` VALUES ('jonny','TOYOTA','CORONA',1991),('marcela','chevrolet','chv',1991);
/*!40000 ALTER TABLE `tb_vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_usuario`
--

DROP TABLE IF EXISTS `vista_usuario`;
/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vista_usuario` AS SELECT
 1 AS `rut`,
 1 AS `digito_verificador`,
 1 AS `nombre`,
 1 AS `clave`,
 1 AS `estado`,
 1 AS `descripcion_estado`,
 1 AS `tipo_usuario`,
 1 AS `descripcion_tipo_usuario`,
 1 AS `correo`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'bd_taller'
--
/*!50003 DROP PROCEDURE IF EXISTS `comprobar_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE PROCEDURE `comprobar_usuario`(rut_recibido int)
BEGIN

select * from tb_usuarios where rut = rut_recibido;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vista_usuario`
--

/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 SQL SECURITY DEFINER */
/*!50001 VIEW `vista_usuario` AS select `u`.`rut` AS `rut`,`u`.`digito_verificador` AS `digito_verificador`,`u`.`nombre` AS `nombre`,`u`.`clave` AS `clave`,`u`.`estado` AS `estado`,`eu`.`descripcion_estado` AS `descripcion_estado`,`u`.`tipo_usuario` AS `tipo_usuario`,`tu`.`descripcion_tipo_usuario` AS `descripcion_tipo_usuario`,`u`.`correo` AS `correo` from ((`tb_usuarios` `u` join `tb_estado_usuario` `eu` on((`u`.`estado` = `eu`.`id_estado`))) join `tb_tipo_usuario` `tu` on((`u`.`tipo_usuario` = `tu`.`id_tipo_usuario`))) */;
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

-- Dump completed on 2019-07-12 21:21:43
