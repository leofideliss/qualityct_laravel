-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: den1.mysql4.gear.host    Database: qualityct
-- ------------------------------------------------------
-- Server version	5.7.26-log

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `complements` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CEP` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighborhoods` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_state` int(10) unsigned NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_id_state_foreign` (`id_state`),
  KEY `addresses_id_city_foreign` (`id_city`),
  CONSTRAINT `addresses_id_city_foreign` FOREIGN KEY (`id_city`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `addresses_id_state_foreign` FOREIGN KEY (`id_state`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,'Rua Maria Sebastiana',416,'Casa','19027185','Jd. São Paulo','2021-03-14 19:26:05','2021-03-14 19:26:05',1,1);
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_state` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_id_state_foreign` (`id_state`),
  CONSTRAINT `cities_id_state_foreign` FOREIGN KEY (`id_state`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Pres Prudente',1),(2,'Pres Epitacio',1),(3,'Pres Venceslau',1);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CNPJ` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_address` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_id_address_foreign` (`id_address`),
  CONSTRAINT `clients_id_address_foreign` FOREIGN KEY (`id_address`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Curtume Touro','46.432.019/0001-08','Leonardo','leofipp@hotmail.com','99709-4034',NULL,'2021-03-14 19:26:06',1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiments`
--

DROP TABLE IF EXISTS `experiments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_leather_type` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiments_id_leather_type_foreign` (`id_leather_type`),
  CONSTRAINT `experiments_id_leather_type_foreign` FOREIGN KEY (`id_leather_type`) REFERENCES `leather_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiments`
--

LOCK TABLES `experiments` WRITE;
/*!40000 ALTER TABLE `experiments` DISABLE KEYS */;
INSERT INTO `experiments` VALUES (1,'Tração',1,'2021-03-14 19:26:10','2021-03-14 19:26:10'),(2,'Alongamento',1,'2021-03-14 19:26:11','2021-03-14 19:26:11'),(3,'Abrasão',1,'2021-03-14 19:26:11','2021-03-14 19:26:11'),(4,'Pirrolidona',1,'2021-03-14 19:26:11','2021-03-14 19:26:11');
/*!40000 ALTER TABLE `experiments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leather_types`
--

DROP TABLE IF EXISTS `leather_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leather_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leather_types`
--

LOCK TABLES `leather_types` WRITE;
/*!40000 ALTER TABLE `leather_types` DISABLE KEYS */;
INSERT INTO `leather_types` VALUES (1,'Acabado'),(2,'Semi-acabado');
/*!40000 ALTER TABLE `leather_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2021_02_01_230658_create_states_table',1),(5,'2021_02_02_004916_create_cities_table',1),(6,'2021_02_02_005956_create_addresses_table',1),(7,'2021_02_02_010235_create_clients_table',1),(8,'2021_02_02_125425_create_leather_types_table',1),(9,'2021_02_02_125440_create_segments_table',1),(10,'2021_02_02_180403_create_products_table',1),(11,'2021_02_06_204007_create_type_users_table',1),(12,'2021_02_06_210118_id_type_users_table_users',1),(13,'2021_03_05_125511_create_specifications_table',1),(14,'2021_03_05_183142_create_samples_table',1),(15,'2021_03_08_114239_create_experiments_table',1),(16,'2021_03_08_190328_create_tests_table',1),(17,'2021_03_11_111701_create_norms_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `norms`
--

DROP TABLE IF EXISTS `norms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `norms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_value` double(8,2) NOT NULL,
  `id_segment` int(10) unsigned NOT NULL,
  `id_leather_type` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `norms_id_segment_foreign` (`id_segment`),
  KEY `norms_id_leather_type_foreign` (`id_leather_type`),
  CONSTRAINT `norms_id_leather_type_foreign` FOREIGN KEY (`id_leather_type`) REFERENCES `leather_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `norms_id_segment_foreign` FOREIGN KEY (`id_segment`) REFERENCES `segments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `norms`
--

LOCK TABLES `norms` WRITE;
/*!40000 ALTER TABLE `norms` DISABLE KEYS */;
/*!40000 ALTER TABLE `norms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thickness` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_client` int(10) unsigned NOT NULL,
  `id_segment` int(10) unsigned NOT NULL,
  `id_leather_type` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id_client_foreign` (`id_client`),
  KEY `products_id_segment_foreign` (`id_segment`),
  KEY `products_id_leather_type_foreign` (`id_leather_type`),
  CONSTRAINT `products_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_id_leather_type_foreign` FOREIGN KEY (`id_leather_type`) REFERENCES `leather_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_id_segment_foreign` FOREIGN KEY (`id_segment`) REFERENCES `segments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Latego chocolate','Chocolate','Latego','11/11 MM','TR-4',1,1,1,'2021-01-01 06:59:59','2021-01-01 06:59:59');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `samples`
--

DROP TABLE IF EXISTS `samples`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `samples` (
  `op_number` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `measure` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_col` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `obs` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_client` int(10) unsigned NOT NULL,
  `id_product` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`op_number`),
  KEY `samples_id_client_foreign` (`id_client`),
  KEY `samples_id_product_foreign` (`id_product`),
  CONSTRAINT `samples_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `samples_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=186085 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `samples`
--

LOCK TABLES `samples` WRITE;
/*!40000 ALTER TABLE `samples` DISABLE KEYS */;
INSERT INTO `samples` VALUES (101213,'26 x 26 cm','2021-03-14 13:33:25','teste',1,1,1,'2021-03-14 19:27:41','2021-03-14 19:33:23'),(186084,'29,7 x 21 cm (A4)','2021-03-14 13:26:58','Couro reparado',1,1,1,NULL,'2021-03-14 19:26:56');
/*!40000 ALTER TABLE `samples` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `segments`
--

DROP TABLE IF EXISTS `segments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `segments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segments`
--

LOCK TABLES `segments` WRITE;
/*!40000 ALTER TABLE `segments` DISABLE KEYS */;
INSERT INTO `segments` VALUES (1,'Moveleiro'),(2,'Cabedal Esportivo'),(3,'Automotivo');
/*!40000 ALTER TABLE `segments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specifications`
--

DROP TABLE IF EXISTS `specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specifications`
--

LOCK TABLES `specifications` WRITE;
/*!40000 ALTER TABLE `specifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Acre'),(2,'Alagoas'),(3,'Amapá'),(4,'Amazonas'),(5,'Bahia'),(6,'Ceará'),(7,'Distrito Federal'),(8,'Espirito Santo'),(9,'Goiás'),(10,'Mato Grosso'),(11,'Minas Gerais'),(12,'Pará'),(13,'Paraiba'),(14,'Parana'),(15,'São Paulo');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `op_number` bigint(20) unsigned NOT NULL,
  `id_experiment` bigint(20) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `tests_op_number_foreign` (`op_number`),
  KEY `tests_id_experiment_foreign` (`id_experiment`),
  CONSTRAINT `tests_id_experiment_foreign` FOREIGN KEY (`id_experiment`) REFERENCES `experiments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tests_op_number_foreign` FOREIGN KEY (`op_number`) REFERENCES `samples` (`op_number`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (186084,1,0,'2021-03-14 19:26:55','2021-03-14 19:26:55'),(186084,2,0,'2021-03-14 19:26:55','2021-03-14 19:26:55'),(186084,3,0,'2021-03-14 19:26:55','2021-03-14 19:26:55'),(186084,4,0,'2021-03-14 19:26:56','2021-03-14 19:26:56'),(101213,4,0,'2021-03-14 19:28:01','2021-03-14 19:33:22');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_users`
--

DROP TABLE IF EXISTS `type_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_users`
--

LOCK TABLES `type_users` WRITE;
/*!40000 ALTER TABLE `type_users` DISABLE KEYS */;
INSERT INTO `type_users` VALUES (1,'Admin'),(2,'Diretor'),(3,'Químico');
/*!40000 ALTER TABLE `type_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_type_user` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_type_user_foreign` (`id_type_user`),
  CONSTRAINT `users_id_type_user_foreign` FOREIGN KEY (`id_type_user`) REFERENCES `type_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'teste','teste','$2y$10$eGbt8I7CGOirdfHuhNZa3euElaygOxV2T1/mlMmqif.rwrk0ZD16i','2021-01-01 06:59:59','2021-01-01 06:59:59',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'qualityct'
--

--
-- Dumping routines for database 'qualityct'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-14 17:51:03
