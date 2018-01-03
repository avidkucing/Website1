-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql109.epizy.com
-- Generation Time: Jan 03, 2018 at 08:44 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_21315537_hisamitsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Tipe_Pegawai` varchar(100) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`Username`, `Password`, `Nama`, `Email`, `Tipe_Pegawai`) VALUES
('admin', '6036902a177b5ecb6e41472be922257a', 'Admin', 'mhabibullah14@yahoo.com', 'Administrator'),
('mr_gudang', '6036902a177b5ecb6e41472be922257a', 'Mr. Gudang', 'haha@gmail.com', 'Gudang'),
('mr_head_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. Head of QC', 'mizan@gmail.com', 'Kepala Bagian Quality Control'),
('mr_produksi', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi', 'rifda@rifda.com', 'Produksi'),
('mr_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. QC', 'avidkucing@gmail.com', 'Quality Control');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_sampel`
--

CREATE TABLE IF NOT EXISTS `analisa_sampel` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Tanggal_Pemeriksaan` date NOT NULL,
  `Sisa_Sampel` float NOT NULL,
  UNIQUE KEY `Nomor_Analisa` (`Nomor_Analisa`),
  KEY `Nomor_Batch` (`Nomor_Batch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisa_sampel`
--

INSERT INTO `analisa_sampel` (`Nomor_Batch`, `Nomor_Analisa`, `Tanggal_Pemeriksaan`, `Sisa_Sampel`) VALUES
('Anggur-01', '0000002', '2018-01-03', 1),
('Anggur-02', '0000002-2', '2018-01-03', 1),
('Apel-03', '0000003-1', '2018-01-03', 1),
('A333', '1', '2018-01-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_minta`
--

CREATE TABLE IF NOT EXISTS `bahan_minta` (
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `Keterangan` text NOT NULL,
  KEY `Nomor_Analisa` (`Nomor_Analisa`),
  KEY `Nomor_Instruksi` (`Nomor_Instruksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_minta`
--

INSERT INTO `bahan_minta` (`Nomor_Instruksi`, `Kode_Bahan`, `Nomor_Analisa`, `Jumlah`, `Keterangan`) VALUES
('0000001', '0000002', '0000002', 5, 'untuk produksi jus anggur'),
('0000004', '0000002', '0000002', 5, '-');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_terima`
--

CREATE TABLE IF NOT EXISTS `bahan_terima` (
  `Nomor_LPB` varchar(100) NOT NULL,
  `ID_Bahan` int(11) NOT NULL,
  `Tanggal_Terima` date NOT NULL,
  `Nomor_Surat` varchar(100) NOT NULL,
  PRIMARY KEY (`Nomor_LPB`),
  KEY `ID_Bahan` (`ID_Bahan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_terima`
--

INSERT INTO `bahan_terima` (`Nomor_LPB`, `ID_Bahan`, `Tanggal_Terima`, `Nomor_Surat`) VALUES
('0000001', 14, '2018-01-03', 'JAN-01'),
('0000002', 15, '2018-01-03', 'JAN-02'),
('0000003', 14, '2018-01-03', '0000003'),
('001/BB/23', 14, '2018-03-01', 'PS0002'),
('0000004', 14, '2018-01-03', 'JAN-04');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_analisa_sampel`
--

CREATE TABLE IF NOT EXISTS `hasil_analisa_sampel` (
  `Nomor_Analisa` varchar(100) NOT NULL,
  `No` int(11) NOT NULL,
  `Hasil` text NOT NULL,
  KEY `Nomor_Analisa` (`Nomor_Analisa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_analisa_sampel`
--

INSERT INTO `hasil_analisa_sampel` (`Nomor_Analisa`, `No`, `Hasil`) VALUES
('0000002', 1, 'good'),
('0000002', 2, 'Not Good'),
('0000002-2', 1, 'Good'),
('0000002-2', 2, 'Not Good'),
('0000003-1', 1, 'good'),
('0000003-1', 2, 'not good'),
('1', 1, 'dingin'),
('1', 2, '3 hari');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bahan`
--

CREATE TABLE IF NOT EXISTS `jenis_bahan` (
  `ID_Bahan` int(11) NOT NULL AUTO_INCREMENT,
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nama_Bahan` varchar(100) NOT NULL,
  `Nama_Manufacturer` varchar(100) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Merk` varchar(100) NOT NULL,
  `Satuan` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_Bahan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `jenis_bahan`
--

INSERT INTO `jenis_bahan` (`ID_Bahan`, `Kode_Bahan`, `Nama_Bahan`, `Nama_Manufacturer`, `Nama_Supplier`, `Merk`, `Satuan`) VALUES
(14, '0000001', 'Apel', 'PT BATU', 'PT PASAR ORO-ORO DOWO', 'Malang', 'Kilogram'),
(15, '0000002', 'Anggur', 'PT BATU', 'PT JAYA', 'Hijau', 'Kilogram'),
(16, 'CLOTH S610', 'Kain', 'Kasrie', 'Kasrie', 'Kain Putih', 'Meter');

-- --------------------------------------------------------

--
-- Table structure for table `nomor_batch_bahan`
--

CREATE TABLE IF NOT EXISTS `nomor_batch_bahan` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_LPB` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`Nomor_Batch`),
  KEY `Nomor_LPB` (`Nomor_LPB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomor_batch_bahan`
--

INSERT INTO `nomor_batch_bahan` (`Nomor_Batch`, `Nomor_LPB`, `Jumlah`, `Status`) VALUES
('Anggur-01', '0000002', 0, 'RELEASE'),
('Anggur-02', '0000002', 30, 'RELEASE'),
('Apel-01', '0000001', 10, 'QUARANTINE'),
('Apel-02', '0000001', 20, 'QUARANTINE'),
('Apel-03', '0000003', 10, 'REJECT'),
('Apel-04', '0000003', 15, 'QUARANTINE'),
('A333', '001/BB/23', 16, 'RELEASE'),
('Apel-05', '0000004', 50, 'QUARANTINE');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `ID_Notif` int(11) NOT NULL,
  `Teks_Notifikasi` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Url` text NOT NULL,
  PRIMARY KEY (`ID_Notif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_kepada`
--

CREATE TABLE IF NOT EXISTS `notif_kepada` (
  `ID_Notif` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Status_Terbaca` tinyint(1) NOT NULL,
  KEY `ID_Notif` (`ID_Notif`),
  KEY `Username` (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parameter_bahan`
--

CREATE TABLE IF NOT EXISTS `parameter_bahan` (
  `Kode_Bahan` varchar(100) NOT NULL,
  `No` smallint(6) NOT NULL,
  `Parameter` text NOT NULL,
  `Spesifikasi` text NOT NULL,
  KEY `ID_Bahan` (`Kode_Bahan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parameter_bahan`
--

INSERT INTO `parameter_bahan` (`Kode_Bahan`, `No`, `Parameter`, `Spesifikasi`) VALUES
('0000001', 1, 'Segar', 'Dingin'),
('0000001', 2, 'Awet', '3 hari'),
('0000002', 1, 'Segar', 'Dingin'),
('0000002', 2, 'Awet', '5 hari');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_bahan`
--

CREATE TABLE IF NOT EXISTS `permintaan_bahan` (
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Site_Produksi` varchar(100) NOT NULL,
  `Tanggal_Permintaan` date NOT NULL,
  PRIMARY KEY (`Nomor_Instruksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_bahan`
--

INSERT INTO `permintaan_bahan` (`Nomor_Instruksi`, `Site_Produksi`, `Tanggal_Permintaan`) VALUES
('0000001', '0000001', '2018-01-04'),
('0000004', '0000004', '2018-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `sampel_bahan_terima`
--

CREATE TABLE IF NOT EXISTS `sampel_bahan_terima` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Tanggal_Instruksi` date NOT NULL,
  `EXP_Date` date NOT NULL,
  `Doc_COA` tinyint(1) NOT NULL,
  `Pola_Sampling` varchar(100) NOT NULL,
  `Jumlah_Wadah` float NOT NULL,
  `Jumlah_Sampel` varchar(10) NOT NULL,
  `Petugas_Sampling` varchar(100) NOT NULL,
  `Rencana_Sampling` varchar(100) NOT NULL,
  `Catatan` text NOT NULL,
  PRIMARY KEY (`Nomor_Batch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampel_bahan_terima`
--

INSERT INTO `sampel_bahan_terima` (`Nomor_Batch`, `Nomor_Instruksi`, `Tanggal_Instruksi`, `EXP_Date`, `Doc_COA`, `Pola_Sampling`, `Jumlah_Wadah`, `Jumlah_Sampel`, `Petugas_Sampling`, `Rencana_Sampling`, `Catatan`) VALUES
('Anggur-01', '0000001', '2018-01-03', '2023-01-03', 1, 'POLA n(1+(N)^-1/2)', 1, '1', 'Mr. QC', 'SKIP TEST', 'OK'),
('Anggur-02', '0000002', '2018-01-03', '2023-01-03', 0, 'POLA p (bahan baku homogen, semua wadah)', 1, '1', 'Mr. QC', 'FULL TEST', ''),
('Apel-01', '0000003', '2018-01-03', '2022-01-03', 1, 'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)', 1, '1', 'Mr. QC', 'LAIN_LAIN', ''),
('Apel-03', '0000005', '2018-01-03', '2023-01-03', 1, 'POLA p (bahan baku homogen, semua wadah)', 1, '1', 'Mr. QC', 'SKIP TEST', ''),
('A333', 'fsfsdf', '2018-01-03', '2018-01-04', 1, 'POLA n(1+(N)^-1/2)', 1, '2', 'asdasad', 'FULL TEST', 'ada');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
