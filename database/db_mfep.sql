-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_mfep
CREATE DATABASE IF NOT EXISTS `db_mfep` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_mfep`;

-- Dumping structure for table db_mfep.ta_alternatif
CREATE TABLE IF NOT EXISTS `ta_alternatif` (
  `alternatif_id` int(11) NOT NULL AUTO_INCREMENT,
  `alternatif_kode` varchar(5) NOT NULL,
  `alternatif_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`alternatif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_mfep.ta_alternatif: ~4 rows (approximately)
/*!40000 ALTER TABLE `ta_alternatif` DISABLE KEYS */;
INSERT INTO `ta_alternatif` (`alternatif_id`, `alternatif_kode`, `alternatif_nama`) VALUES
	(1, 'A1', 'Legato Art Center'),
	(2, 'A2', 'C dan C Music Education'),
	(3, 'A3', 'Era Musik Siantar'),
	(4, 'A4', 'Sanggar Musik Grace');
/*!40000 ALTER TABLE `ta_alternatif` ENABLE KEYS */;

-- Dumping structure for table db_mfep.ta_kriteria
CREATE TABLE IF NOT EXISTS `ta_kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_kode` varchar(5) NOT NULL,
  `kriteria_nama` varchar(100) NOT NULL,
  `kriteria_bobot` float NOT NULL,
  PRIMARY KEY (`kriteria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_mfep.ta_kriteria: ~4 rows (approximately)
/*!40000 ALTER TABLE `ta_kriteria` DISABLE KEYS */;
INSERT INTO `ta_kriteria` (`kriteria_id`, `kriteria_kode`, `kriteria_nama`, `kriteria_bobot`) VALUES
	(1, 'C1', 'Kenyamanan Tempat', 0.3),
	(2, 'C2', 'Fasilitas Musik', 0.2),
	(3, 'C3', 'Harga', 0.2),
	(4, 'C4', 'Jadwal/waktu Bimbingan', 0.2),
	(5, 'C5', 'Pelayanan  karyawan/petugas', 0.1);
/*!40000 ALTER TABLE `ta_kriteria` ENABLE KEYS */;

-- Dumping structure for table db_mfep.tb_nilai
CREATE TABLE IF NOT EXISTS `tb_nilai` (
  `nilai_id` int(11) NOT NULL AUTO_INCREMENT,
  `alternatif_kode` varchar(5) NOT NULL,
  `kriteria_kode` varchar(5) NOT NULL,
  `nilai_faktor` double NOT NULL,
  PRIMARY KEY (`nilai_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_mfep.tb_nilai: ~20 rows (approximately)
/*!40000 ALTER TABLE `tb_nilai` DISABLE KEYS */;
INSERT INTO `tb_nilai` (`nilai_id`, `alternatif_kode`, `kriteria_kode`, `nilai_faktor`) VALUES
	(1, 'A1', 'C1', 2.93),
	(2, 'A1', 'C2', 2.92),
	(3, 'A1', 'C3', 2.93),
	(4, 'A1', 'C4', 2.8),
	(5, 'A1', 'C5', 3.05),
	(6, 'A2', 'C1', 2.95),
	(7, 'A2', 'C2', 2.62),
	(8, 'A2', 'C3', 2.38),
	(9, 'A2', 'C4', 2.4),
	(10, 'A2', 'C5', 2.95),
	(11, 'A3', 'C1', 3),
	(12, 'A3', 'C2', 2.62),
	(13, 'A3', 'C3', 2.53),
	(14, 'A3', 'C4', 3.07),
	(15, 'A3', 'C5', 2.6),
	(16, 'A4', 'C1', 2.37),
	(17, 'A4', 'C2', 2.63),
	(18, 'A4', 'C3', 2.25),
	(19, 'A4', 'C4', 3),
	(20, 'A4', 'C5', 2.77);
/*!40000 ALTER TABLE `tb_nilai` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
