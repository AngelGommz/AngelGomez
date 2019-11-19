# Host: localhost  (Version 5.5.5-10.4.8-MariaDB)
# Date: 2019-11-19 01:29:28
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "cotizaciones"
#

DROP TABLE IF EXISTS `cotizaciones`;
CREATE TABLE `cotizaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Folio` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cli_Nom` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Cli_Email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Cli_Direccion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Aut_Marca` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Aut_Modelo` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Aut_Azo` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Precio` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "cotizaciones"
#

INSERT INTO `cotizaciones` VALUES (1,'0054678','Angel Gomez','begota89@hotmail.com','Bahia de acapulco','NISAN','Tiida','2010','32000','2019-11-19'),(2,'546876465','Beto','angel.gomez.t89@gmail.com','Rio hondo','Volkswagen','Jetta','2007','1563','2019-11-19'),(3,'588126','Edicion','begota89@hotmail.com','asd','asd','asd','1995','1563','2019-11-19');

#
# Structure for table "depositos"
#

DROP TABLE IF EXISTS `depositos`;
CREATE TABLE `depositos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Total` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fecha_Creacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "depositos"
#

INSERT INTO `depositos` VALUES (1,'Test Dep01','500','2019-11-18'),(3,'Test Dep03','1500','2019-11-18'),(5,'Test Dep05','500','2019-11-19'),(6,'Test Dep06','500','2019-11-19'),(8,'Test Dep08','1000','2019-11-10'),(9,'Test Dep09','24234','2019-11-13');

#
# Structure for table "migrations"
#

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "migrations"
#

INSERT INTO `migrations` VALUES (6,'2014_10_12_000000_create_users_table',1),(7,'2014_10_12_100000_create_password_resets_table',1),(8,'2019_11_17_045137_create_depositos_table',1),(9,'2019_11_17_045841_create_cotizaciones_table',1),(10,'2019_11_17_050146_create_rel_cot_deps_table',1);

#
# Structure for table "rel_cot_deps"
#

DROP TABLE IF EXISTS `rel_cot_deps`;
CREATE TABLE `rel_cot_deps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_Dep` int(11) DEFAULT NULL,
  `id_Cot` int(11) DEFAULT NULL,
  `Cantidad` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "rel_cot_deps"
#

INSERT INTO `rel_cot_deps` VALUES (1,1,1,'200'),(2,3,1,'300'),(3,5,1,'499'),(4,5,2,'1'),(5,9,2,'1562'),(6,1,3,'100'),(7,1,3,'100');
