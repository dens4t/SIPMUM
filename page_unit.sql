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

-- Dumping structure for table sipmum.page_unit
CREATE TABLE IF NOT EXISTS `page_unit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `url_google_map` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_unit` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_unit_id_unit_foreign` (`id_unit`),
  CONSTRAINT `page_unit_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.page_unit: ~0 rows (approximately)
INSERT INTO `page_unit` (`id`, `thumbnail`, `content`, `url_google_map`, `id_unit`, `created_at`, `updated_at`) VALUES
	(1, '{"49cbcaf2-1564-46a0-983b-1952841f95c8":"thumbnail\\/01JBSMQ37W4NRGNDS4BQQJ0A5B.jpg"}', 'Unit Pelaksana Layanan Transmisi dan Gardu Induk (UPLTG) Siantan adalah salah satu unit yang berperan penting dalam menjaga keandalan pasokan listrik di wilayah Kalimantan Barat, khususnya Kota Pontianak dan sekitarnya. UPLTG Siantan bertugas mengoperasikan dan memelihara infrastruktur transmisi listrik serta gardu induk yang mendistribusikan listrik ke pelanggan akhir. Dalam upaya memenuhi kebutuhan listrik yang terus meningkat, UPLTG Siantan memainkan peran krusial dalam mengalirkan energi listrik secara stabil dan efisien. Lokasi yang strategis serta kemampuan operasional yang mumpuni menjadikan UPLTG Siantan sebagai salah satu unit andalan PLN di Kalimantan Barat dalam memastikan ketersediaan listrik di wilayah tersebut.\n\nSebagai unit yang mengelola transmisi dan gardu induk, UPLTG Siantan memiliki tugas penting dalam mencegah terjadinya pemadaman listrik dengan memastikan jalur transmisi dan peralatan di gardu induk berfungsi dengan baik. Melalui pemeliharaan rutin dan pengawasan ketat, UPLTG Siantan mampu mengatasi berbagai tantangan operasional, termasuk gangguan teknis atau kerusakan peralatan. Dengan dukungan teknologi modern dan tenaga kerja yang terlatih, UPLTG Siantan berupaya meminimalisir gangguan listrik yang dapat mempengaruhi aktivitas masyarakat dan kegiatan ekonomi di daerah Pontianak. Keberadaan UPLTG Siantan ini membantu meningkatkan kualitas layanan listrik dan mendukung pertumbuhan ekonomi di wilayah Kalimantan Barat.', 'sdfsdfsdf', 1, '2024-11-03 18:08:17', '2024-11-03 18:49:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
