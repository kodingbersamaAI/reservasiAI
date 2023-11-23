-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table reservasiai.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table reservasiai.pengguna: ~2 rows (approximately)
INSERT INTO `pengguna` (`id`, `username`, `password`, `role`) VALUES
	(1, 'admin', '$2y$10$UcDOcTy4lBVdlag/dHZjdOnVDNtg6FrByeotFROJtnfpqKGumxbi.', 'admin'),
	(3, 'bayu', '$2y$10$s7W9dzx45akmiMxITLF9Wu.9mLdZNN8Z7PZjcT7FeNXrBhSx63l0y', 'user'),
	(4, 'puroguramu', '$2y$10$2NVUHSZfPKMEL7/g8D7y5OvEZBs157nEWwbzOBuFgw.tjc6yyJUfW', 'user');

-- Dumping structure for table reservasiai.reservasi
CREATE TABLE IF NOT EXISTS `reservasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idReservasi` varchar(50) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `kodeRuangan` varchar(250) DEFAULT NULL,
  `tanggalPeminjaman` date DEFAULT NULL,
  `tanggalPengembalian` date DEFAULT NULL,
  `jamReservasi` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `totalBayar` varchar(250) DEFAULT NULL,
  `statusReservasi` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 ;

-- Dumping data for table reservasiai.reservasi: ~4 rows (approximately)
INSERT INTO `reservasi` (`id`, `idReservasi`, `username`, `kodeRuangan`, `tanggalPeminjaman`, `tanggalPengembalian`, `jamReservasi`, `totalBayar`, `statusReservasi`) VALUES
	(7, 'iKMY2a', 'admin', 'X101', '2023-11-22', '2023-11-22', '10.00 - 12.00', '100000', 'Terbayar'),
	(8, 'VUak5c', 'puroguramu', 'X101', '2023-11-23', '2023-12-01', '10.00 - 12.00', '1000000', 'Terbayar'),
	(9, 'bjDF89', 'puroguramu', 'X102', '2023-11-23', '2023-11-24', '10.00 - 12.00', '900000', 'Terbayar'),
	(10, 'VPxtwy', 'puroguramu', 'X101', '2023-11-23', '2023-11-23', '10.00 - 12.00', '9000000', 'Terbayar');

-- Dumping structure for table reservasiai.ruangan
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kodeRuangan` varchar(250) DEFAULT NULL,
  `galeriRuangan` varchar(250) DEFAULT NULL,
  `namaRuangan` varchar(250) DEFAULT NULL,
  `tipeRuangan` varchar(250) DEFAULT NULL,
  `ukuranRuangan` varchar(250) DEFAULT NULL,
  `kapasitasRuangan` varchar(250) DEFAULT NULL,
  `fasilitasRuangan` varchar(250) DEFAULT NULL,
  `hargaRuangan` varchar(250) DEFAULT NULL,
  `statusRuangan` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ;

-- Dumping data for table reservasiai.ruangan: ~3 rows (approximately)
INSERT INTO `ruangan` (`id`, `kodeRuangan`, `galeriRuangan`, `namaRuangan`, `tipeRuangan`, `ukuranRuangan`, `kapasitasRuangan`, `fasilitasRuangan`, `hargaRuangan`, `statusRuangan`) VALUES
	(3, 'X101', '../../adminlte/img/1.png; ../../adminlte/img/icon.png', 'Exclusive 101', 'Exclusive', '4x5', '5', 'All in', '500000', 'Tersedia'),
	(6, 'X102', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEuNSHtnlMMo4pVycgwCyvcE3tYzvaaQY-Kg', 'Exclusive 102', 'Exclusive', '10x10', '15', 'All in', '12000000', 'Tersedia');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
