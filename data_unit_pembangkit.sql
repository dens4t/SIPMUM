-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.33 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sipmum.data_unit_pembangkit
CREATE TABLE IF NOT EXISTS `data_unit_pembangkit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomor_urut` int NOT NULL,
  `mesin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_seri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daya_terpasang` int NOT NULL,
  `daya_mampu` int NOT NULL,
  `lokasi_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_unit` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_unit_pembangkit_id_unit_foreign` (`id_unit`),
  CONSTRAINT `data_unit_pembangkit_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.data_unit_pembangkit: ~1 rows (approximately)
INSERT INTO `data_unit_pembangkit` (`id`, `nomor_urut`, `mesin`, `tipe`, `nomor_seri`, `daya_terpasang`, `daya_mampu`, `lokasi_unit`, `id_unit`, `created_at`, `updated_at`) VALUES
	(1, 123, 'adasidnm', 'asd,oasd,o', 'kokasidojasid', 123, 123, 'asdiasjdias', 1, '2024-10-23 22:04:57', '2024-10-23 22:04:57');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
