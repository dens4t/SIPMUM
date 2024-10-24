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

-- Dumping structure for table sipmum.pengajuan_sppd
CREATE TABLE IF NOT EXISTS `pengajuan_sppd` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `jenis_sppd` enum('diklat','non_diklat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_awal_kegiatan` date NOT NULL,
  `tanggal_akhir_kegiatan` date NOT NULL,
  `nomor_prk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_pembebanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_angkutan` enum('pesawat','kereta_api','kapal','kendaraan_dinas','kendaraan_umum') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kota_asal` bigint unsigned DEFAULT NULL,
  `id_kota_tujuan` bigint unsigned DEFAULT NULL,
  `surat_undangan_penugasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_sppd_id_pegawai_foreign` (`id_pegawai`),
  KEY `pengajuan_sppd_id_kota_asal_foreign` (`id_kota_asal`),
  KEY `pengajuan_sppd_id_kota_tujuan_foreign` (`id_kota_tujuan`),
  CONSTRAINT `pengajuan_sppd_id_kota_asal_foreign` FOREIGN KEY (`id_kota_asal`) REFERENCES `kota` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_sppd_id_kota_tujuan_foreign` FOREIGN KEY (`id_kota_tujuan`) REFERENCES `kota` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_sppd_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pengajuan_sppd: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
