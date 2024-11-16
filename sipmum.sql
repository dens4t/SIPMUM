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

-- Dumping structure for table sipmum.bagian
CREATE TABLE IF NOT EXISTS `bagian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('bagian','seksi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.bagian: ~1 rows (approximately)
INSERT INTO `bagian` (`id`, `nama`, `jenis`, `created_at`, `updated_at`) VALUES
	(1, 'ADMINSITRASI', 'bagian', '2024-10-23 10:37:20', '2024-10-23 10:37:20');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.data_unit_pembangkit: ~0 rows (approximately)

-- Dumping structure for table sipmum.dossier_pegawai
CREATE TABLE IF NOT EXISTS `dossier_pegawai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `sk_pengangkatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_talenta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_pembinaan_grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sk_mutasi_rotasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_sertifikasi_kompetensi_dan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_pendidikan_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dossier_pegawai_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `dossier_pegawai_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.dossier_pegawai: ~0 rows (approximately)

-- Dumping structure for table sipmum.driver
CREATE TABLE IF NOT EXISTS `driver` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.driver: ~0 rows (approximately)

-- Dumping structure for table sipmum.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sipmum.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.jabatan: ~1 rows (approximately)
INSERT INTO `jabatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'SEKBIN', '2024-10-23 10:37:30', '2024-10-23 10:37:30');

-- Dumping structure for table sipmum.kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_awal_kegiatan` date NOT NULL,
  `tanggal_akhir_kegiatan` date NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumentasi_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.kegiatan: ~0 rows (approximately)

-- Dumping structure for table sipmum.kendaraan
CREATE TABLE IF NOT EXISTS `kendaraan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_polisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.kendaraan: ~0 rows (approximately)

-- Dumping structure for table sipmum.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(2, '2019_08_19_000000_create_failed_jobs_table', 1),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2024_10_18_031514_create_jabatans_table', 1),
	(5, '2024_10_18_031824_create_units_table', 1),
	(6, '2024_10_18_032714_create_bagians_table', 1),
	(7, '2024_10_18_032754_create_pendidikan_terakhir_table', 1),
	(8, '2024_10_18_032755_create_pegawais_table', 1),
	(9, '2024_10_18_033139_create_nomor_surats_table', 1),
	(10, '2024_10_18_182146_create_drivers_table', 1),
	(11, '2024_10_18_182146_create_kendaraan_table', 1),
	(12, '2024_10_18_183059_create_pengajuan_kendaraan_dinas_table', 1),
	(13, '2024_10_19_055457_create_pengajuan_rapat_konsumsis_table', 1),
	(14, '2024_10_19_061923_create_pengajuan_s_p_p_d_s_table', 1),
	(15, '2024_10_19_085443_create_dossier_pegawais_table', 1),
	(16, '2024_10_19_091057_create_data_unit_pembangkits_table', 1),
	(17, '2024_10_19_09157_create_users_table', 1),
	(18, '2024_10_23_042909_create_kegiatan_table', 1);

-- Dumping structure for table sipmum.nomor_surat
CREATE TABLE IF NOT EXISTS `nomor_surat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_klasifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `perihal` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nomor_surat_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `nomor_surat_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.nomor_surat: ~0 rows (approximately)

-- Dumping structure for table sipmum.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table sipmum.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `NIP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenjang_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_grade` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `id_pendidikan_terakhir` bigint unsigned DEFAULT NULL,
  `id_jabatan` bigint unsigned DEFAULT NULL,
  `id_bagian` bigint unsigned DEFAULT NULL,
  `id_unit` bigint unsigned DEFAULT NULL,
  `jabatan_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_calon_pegawai` date DEFAULT NULL,
  `tanggal_pegawai` date DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tanggal_berakhir_kerja` date DEFAULT NULL,
  `tanggal_pensiun_normal` date DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pegawai_id_pendidikan_terakhir_foreign` (`id_pendidikan_terakhir`),
  KEY `pegawai_id_jabatan_foreign` (`id_jabatan`),
  KEY `pegawai_id_bagian_foreign` (`id_bagian`),
  KEY `pegawai_id_unit_foreign` (`id_unit`),
  CONSTRAINT `pegawai_id_bagian_foreign` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pegawai_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pegawai_id_pendidikan_terakhir_foreign` FOREIGN KEY (`id_pendidikan_terakhir`) REFERENCES `pendidikan_terakhir` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pegawai_id_unit_foreign` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pegawai: ~1 rows (approximately)
INSERT INTO `pegawai` (`id`, `NIP`, `nama`, `jenis_kelamin`, `no_ktp`, `no_npwp`, `email`, `alamat_lengkap`, `kota`, `tempat_lahir`, `keterangan_pegawai`, `person_grade`, `position_grade`, `jenjang_jabatan`, `tanggal_grade`, `tanggal_mulai`, `id_pendidikan_terakhir`, `id_jabatan`, `id_bagian`, `id_unit`, `jabatan_lengkap`, `tanggal_masuk`, `tanggal_calon_pegawai`, `tanggal_pegawai`, `tanggal_lahir`, `tanggal_berakhir_kerja`, `tanggal_pensiun_normal`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, '123', 'Deden', 'L', '92349234932', '923492349', 'densat98@gmail.com', 'jasdad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '089693459345q', '2024-10-23 10:38:07', '2024-10-23 10:38:07');

-- Dumping structure for table sipmum.pendidikan_terakhir
CREATE TABLE IF NOT EXISTS `pendidikan_terakhir` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `urutan` int NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pendidikan_terakhir: ~2 rows (approximately)
INSERT INTO `pendidikan_terakhir` (`id`, `urutan`, `jenjang`, `created_at`, `updated_at`) VALUES
	(1, 1, 'S1', '2024-10-23 10:36:51', '2024-10-23 10:36:51'),
	(2, 2, 'D3', '2024-10-23 10:36:58', '2024-10-23 10:36:58');

-- Dumping structure for table sipmum.pengajuan_kendaraan_dinas
CREATE TABLE IF NOT EXISTS `pengajuan_kendaraan_dinas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_driver` bigint unsigned DEFAULT NULL,
  `id_kendaraan` bigint unsigned DEFAULT NULL,
  `stand_km_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_kendaraan_dinas_id_pegawai_foreign` (`id_pegawai`),
  KEY `pengajuan_kendaraan_dinas_id_driver_foreign` (`id_driver`),
  KEY `pengajuan_kendaraan_dinas_id_kendaraan_foreign` (`id_kendaraan`),
  CONSTRAINT `pengajuan_kendaraan_dinas_id_driver_foreign` FOREIGN KEY (`id_driver`) REFERENCES `driver` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_kendaraan_dinas_id_kendaraan_foreign` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pengajuan_kendaraan_dinas_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pengajuan_kendaraan_dinas: ~0 rows (approximately)

-- Dumping structure for table sipmum.pengajuan_rapat_konsumsi
CREATE TABLE IF NOT EXISTS `pengajuan_rapat_konsumsi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `judul_rapat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_waktu_mulai` datetime NOT NULL,
  `tanggal_waktu_selesai` datetime NOT NULL,
  `jumlah_peserta_rapat` int NOT NULL,
  `metode` enum('offline','online') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang` enum('upks','baca') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_konsumsi` enum('snack_minum','snack_minum_makan','makan_minum') COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_undangan_rapat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_rapat_konsumsi_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `pengajuan_rapat_konsumsi_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pengajuan_rapat_konsumsi: ~0 rows (approximately)

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
  `kota_asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_undangan_penugasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_sppd_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `pengajuan_sppd_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.pengajuan_sppd: ~0 rows (approximately)

-- Dumping structure for table sipmum.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table sipmum.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis` enum('ulpltd','up','ulpltg/d') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.unit: ~1 rows (approximately)
INSERT INTO `unit` (`id`, `jenis`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'upltg', 'SIANTAN', '2024-10-23 10:37:11', '2024-10-23 10:37:11');

-- Dumping structure for table sipmum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `id_pegawai` bigint unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_pegawai_foreign` (`id_pegawai`),
  CONSTRAINT `users_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipmum.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `is_admin`, `id_pegawai`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'deni', 'admin', 'admin@gmail.com', '$2y$10$OcfwKQGeoF7ViVYHXZrDJOQI0G2bc.o8wh.PfBMk3zT3FAjsL2W7S', 1, NULL, NULL, NULL, NULL, NULL),
	(2, 'Deden', '123', 'deden@gmail.com', '$2y$10$oCzryHzcnKp2iHG20/WfPek2HS4/eKq6WBMnoHn.qZOVhKW/8j0di', 0, 1, NULL, NULL, '2024-10-23 10:38:22', '2024-10-23 10:38:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
