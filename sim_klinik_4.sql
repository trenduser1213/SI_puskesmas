-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: sim_klinik_4
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `jadwal_dokter`
--

DROP TABLE IF EXISTS `jadwal_dokter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_dokter` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dokter_id` int unsigned NOT NULL,
  `hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `ruangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nomor_antrian` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jadwal_dokter_dokter_id_foreign` (`dokter_id`),
  CONSTRAINT `jadwal_dokter_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_dokter`
--

LOCK TABLES `jadwal_dokter` WRITE;
/*!40000 ALTER TABLE `jadwal_dokter` DISABLE KEYS */;
INSERT INTO `jadwal_dokter` VALUES (1,3,'senin','09:00:00','11:00:00','Poli Umum','2022-08-20 02:52:06','2022-09-06 06:24:16',21),(2,3,'selasa','11:00:00','13:00:00','Poli Mata','2022-08-20 02:52:56','2022-10-30 06:18:37',7),(3,3,'rabu','09:00:00','11:00:00','Poli Mata','2022-08-20 02:53:34','2022-08-20 02:53:34',0),(4,3,'kamis','09:00:00','11:00:00','Poli Mata','2022-08-20 02:53:54','2022-10-30 06:20:34',3),(5,3,'senin','09:00:00','10:00:00','Poli Mata','2022-08-20 02:54:09','2022-09-03 01:09:43',3),(6,3,'jumat','09:00:00','11:00:00','Poli Mata','2022-08-20 02:54:38','2022-10-30 06:07:44',1),(7,3,'sabtu','09:00:00','11:00:00','Poli Mata','2022-08-20 02:54:53','2022-09-06 06:33:50',1),(8,3,'minggu','09:00:00','11:00:00','Poli Mata','2022-08-20 02:55:07','2022-08-20 02:55:07',0);
/*!40000 ALTER TABLE `jadwal_dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_obat`
--

DROP TABLE IF EXISTS `kategori_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_obat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_obat`
--

LOCK TABLES `kategori_obat` WRITE;
/*!40000 ALTER TABLE `kategori_obat` DISABLE KEYS */;
INSERT INTO `kategori_obat` VALUES (1,'0012','Antibiotik','2022-08-20 02:58:01','2022-08-20 02:58:01');
/*!40000 ALTER TABLE `kategori_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_06_11_064151_create_spesialis_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_05_20_223354_create_tempat_rujukan_table',1),(7,'2022_06_18_064152_create_roles_table',1),(8,'2022_06_18_064153_create_user_roles_table',1),(9,'2022_06_18_064737_create_kategori_obat_table',1),(10,'2022_06_18_064811_create_resep_table',1),(11,'2022_06_18_064908_create_obat_table',1),(12,'2022_06_18_072140_create_rekamedis_table',1),(13,'2022_06_18_072322_create_rujukan_lab_table',1),(14,'2022_06_18_072458_create_transaksi_table',1),(15,'2022_06_18_103834_create_transaksi_detail_table',1),(16,'2022_06_18_105334_create_user_spesialis_table',1),(17,'2022_07_02_121012_add_email_in_user_table',1),(18,'2022_08_10_112044_create_jadwal_dokter_table',1),(19,'2022_08_10_125921_create_nomor_antrian_table',1),(21,'2022_08_10_131447_add_nomor_antrian_jadwal_dokter_table',1),(24,'2022_08_10_130013_create_pendaftaran_pasien_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nomor_antrian`
--

DROP TABLE IF EXISTS `nomor_antrian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nomor_antrian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `antrian_poli_umum` int NOT NULL,
  `antrian_spesialis` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nomor_antrian`
--

LOCK TABLES `nomor_antrian` WRITE;
/*!40000 ALTER TABLE `nomor_antrian` DISABLE KEYS */;
/*!40000 ALTER TABLE `nomor_antrian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_obat_id` int unsigned NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` bigint NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `obat_kategori_obat_id_foreign` (`kategori_obat_id`),
  CONSTRAINT `obat_kategori_obat_id_foreign` FOREIGN KEY (`kategori_obat_id`) REFERENCES `kategori_obat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obat`
--

LOCK TABLES `obat` WRITE;
/*!40000 ALTER TABLE `obat` DISABLE KEYS */;
/*!40000 ALTER TABLE `obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `pelayanan_obat`
--

DROP TABLE IF EXISTS `pelayanan_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelayanan_obat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_resep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelayanan_obat`
--

LOCK TABLES `pelayanan_obat` WRITE;
/*!40000 ALTER TABLE `pelayanan_obat` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelayanan_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftaran_pasien`
--

DROP TABLE IF EXISTS `pendaftaran_pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftaran_pasien` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `nomor_antrian` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftaran_pasien_user_id_foreign` (`user_id`),
  CONSTRAINT `pendaftaran_pasien_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftaran_pasien`
--

LOCK TABLES `pendaftaran_pasien` WRITE;
/*!40000 ALTER TABLE `pendaftaran_pasien` DISABLE KEYS */;
INSERT INTO `pendaftaran_pasien` VALUES (1,2,5,'antri','2022-09-03 00:33:14','2022-09-03 00:33:14'),(2,2,6,'antri','2022-09-03 00:33:26','2022-09-03 00:33:26'),(3,2,7,'antri','2022-09-03 00:47:08','2022-09-03 00:47:08'),(4,2,8,'antri','2022-09-03 00:50:44','2022-09-03 00:50:44'),(5,2,9,'antri','2022-09-03 00:50:54','2022-09-03 00:50:54'),(6,2,4,'antri','2022-09-03 00:51:50','2022-09-03 00:51:50'),(7,2,10,'antri','2022-09-03 00:53:14','2022-09-03 00:53:14'),(8,2,11,'antri','2022-09-03 00:55:30','2022-09-03 00:55:30'),(9,2,1,'antri','2022-09-03 01:02:32','2022-09-03 01:02:32'),(10,2,12,'antri','2022-09-03 01:02:51','2022-09-03 01:02:51'),(11,2,2,'antri','2022-09-03 01:04:24','2022-09-03 01:04:24'),(12,2,13,'sudah dilayani','2022-09-03 01:07:39','2022-09-03 02:10:11'),(13,2,3,'antri','2022-09-03 01:09:43','2022-09-03 01:09:43'),(14,2,14,'antri','2022-09-03 01:52:58','2022-09-03 01:52:58'),(15,2,15,'antri','2022-09-03 01:53:28','2022-09-03 01:53:28'),(16,2,5,'sudah dilayani','2022-09-03 01:53:41','2022-09-03 02:06:40'),(17,2,16,'antri','2022-09-03 03:10:04','2022-09-03 03:10:04'),(18,2,17,'antri','2022-09-03 03:10:53','2022-09-03 03:10:53'),(19,2,18,'antri','2022-09-03 03:12:15','2022-09-03 03:12:15'),(20,2,6,'antri','2022-09-03 03:12:22','2022-09-03 03:12:22'),(21,2,19,'antri','2022-09-03 05:49:14','2022-09-03 05:49:14'),(22,2,20,'antri','2022-09-03 05:49:48','2022-09-03 05:49:48'),(23,4,21,'antri','2022-09-06 06:24:16','2022-09-06 06:24:16'),(24,4,1,'antri','2022-09-06 06:30:25','2022-09-06 06:30:25'),(25,2,1,'antri','2022-09-06 06:33:50','2022-09-06 06:33:50'),(26,5,2,'antri','2022-10-30 06:07:35','2022-10-30 06:07:35'),(27,5,1,'antri','2022-10-30 06:07:44','2022-10-30 06:07:44'),(28,5,7,'antri','2022-10-30 06:18:37','2022-10-30 06:18:37'),(29,5,3,'antri','2022-10-30 06:20:34','2022-10-30 06:20:34');
/*!40000 ALTER TABLE `pendaftaran_pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rekamedis`
--

DROP TABLE IF EXISTS `rekamedis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rekamedis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tanggal_pendaftaran` date NOT NULL,
  `diagnosa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` int unsigned NOT NULL,
  `dokter_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekamedis_pasien_id_foreign` (`pasien_id`),
  KEY `rekamedis_dokter_id_foreign` (`dokter_id`),
  CONSTRAINT `rekamedis_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekamedis_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rekamedis`
--

LOCK TABLES `rekamedis` WRITE;
/*!40000 ALTER TABLE `rekamedis` DISABLE KEYS */;
/*!40000 ALTER TABLE `rekamedis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2022-08-10 08:17:04','2022-08-10 08:17:04'),(2,'dokter','2022-08-10 08:17:04','2022-08-10 08:17:04'),(3,'pasien','2022-08-10 08:17:04','2022-08-10 08:17:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rujukan`
--

DROP TABLE IF EXISTS `rujukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rujukan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pemeriksaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` int unsigned NOT NULL,
  `tempat_rujukan_id` int unsigned NOT NULL,
  `dokter_id` int unsigned NOT NULL,
  `rekamedis_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rujukan_rekamedis_id_foreign` (`rekamedis_id`),
  KEY `rujukan_tempat_rujukan_id_foreign` (`tempat_rujukan_id`),
  KEY `rujukan_pasien_id_foreign` (`pasien_id`),
  KEY `rujukan_dokter_id_foreign` (`dokter_id`),
  CONSTRAINT `rujukan_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rujukan_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rujukan_rekamedis_id_foreign` FOREIGN KEY (`rekamedis_id`) REFERENCES `rekamedis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rujukan_tempat_rujukan_id_foreign` FOREIGN KEY (`tempat_rujukan_id`) REFERENCES `tempat_rujukan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rujukan`
--

LOCK TABLES `rujukan` WRITE;
/*!40000 ALTER TABLE `rujukan` DISABLE KEYS */;
/*!40000 ALTER TABLE `rujukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spesialis`
--

DROP TABLE IF EXISTS `spesialis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `spesialis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spesialis`
--

LOCK TABLES `spesialis` WRITE;
/*!40000 ALTER TABLE `spesialis` DISABLE KEYS */;
INSERT INTO `spesialis` VALUES (1,'M4T4','Mata','2022-08-20 02:50:20','2022-08-20 02:50:20');
/*!40000 ALTER TABLE `spesialis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tempat_rujukan`
--

DROP TABLE IF EXISTS `tempat_rujukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tempat_rujukan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tempat_rujukan`
--

LOCK TABLES `tempat_rujukan` WRITE;
/*!40000 ALTER TABLE `tempat_rujukan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tempat_rujukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_regis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resep_id` int unsigned NOT NULL,
  `pasien_id` int unsigned NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `total` int NOT NULL,
  `nomor_antrian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_resep_id_foreign` (`resep_id`),
  KEY `transaksi_pasien_id_foreign` (`pasien_id`),
  CONSTRAINT `transaksi_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_resep_id_foreign` FOREIGN KEY (`resep_id`) REFERENCES `pelayanan_obat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksi_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` int unsigned NOT NULL,
  `obat_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_detail_transaksi_id_foreign` (`transaksi_id`),
  KEY `transaksi_detail_obat_id_foreign` (`obat_id`),
  CONSTRAINT `transaksi_detail_obat_id_foreign` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaksi_detail_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_detail`
--

LOCK TABLES `transaksi_detail` WRITE;
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_user_id_foreign` (`user_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1,1,'2022-08-10 08:17:33','2022-08-10 08:17:33'),(2,2,3,'2022-08-20 02:49:57','2022-08-20 02:49:57'),(3,3,2,'2022-08-20 02:51:22','2022-08-20 02:51:22'),(4,4,3,'2022-09-06 06:23:30','2022-09-06 06:23:30'),(5,5,3,'2022-10-30 06:07:06','2022-10-30 06:07:06');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_spesialis`
--

DROP TABLE IF EXISTS `user_spesialis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_spesialis` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `spesialis_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_spesialis_user_id_foreign` (`user_id`),
  KEY `user_spesialis_spesialis_id_foreign` (`spesialis_id`),
  CONSTRAINT `user_spesialis_spesialis_id_foreign` FOREIGN KEY (`spesialis_id`) REFERENCES `spesialis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_spesialis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_spesialis`
--

LOCK TABLES `user_spesialis` WRITE;
/*!40000 ALTER TABLE `user_spesialis` DISABLE KEYS */;
INSERT INTO `user_spesialis` VALUES (1,3,1,'2022-08-20 02:51:22','2022-08-20 02:51:22');
/*!40000 ALTER TABLE `user_spesialis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_rumah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin123','admin',NULL,NULL,'Pria',NULL,NULL,NULL,NULL,NULL,'2022-08-10 08:17:33','2022-08-10 08:17:33','admin@gmail.com'),(2,'pasien','$2y$10$hGmLUO6RqZ5hptUFNjXzIuK4JiJB6qz7EQHm0NQuJlMr70gKWXeHG','pasien','Sidoarjo','1994-02-02','L','Jakarta Selatan','08989898388','PNS','13123123',NULL,'2022-08-20 02:49:57','2022-08-20 02:49:57','pasien@gmail.com'),(3,'dokter','$2y$10$5/4g31R9iIcOsZAEvwvMvu5c0TX.rBF2GXVL85DJSC4j.0E0PBDzq','dokter','Surabaya','1994-03-03','L','Jakarta Utara','0874736846848',NULL,NULL,NULL,'2022-08-20 02:51:22','2022-08-20 02:51:22','dokter@gmail.com'),(4,'nisa','$2y$10$mow9J4G2eqiJh.4ATq//OOr0Td5B43UyTqpWFUmklG3AV5gP7wBiy','nisa',NULL,NULL,'Wanita',NULL,NULL,NULL,NULL,NULL,'2022-09-06 06:23:30','2022-09-06 06:23:30','destiana082@gmail.com'),(5,'kiki','$2y$10$YErHVEFJUtDFjtGhXaFnWu2VlELqbf.xA8KYQFXsbCdp4YL9AghSO','kiki','Surabaya','2022-10-03','P','sby','085130408600','karyawan','0000',NULL,'2022-10-30 06:07:06','2022-10-30 06:07:06','coba@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-30 21:21:32
