-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Jan 2018 pada 05.30
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hisamitsu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Tipe_Pegawai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`Username`, `Password`, `Nama`, `Email`, `Tipe_Pegawai`) VALUES
('admin', '6036902a177b5ecb6e41472be922257a', 'Admin', 'mhabibullah14@yahoo.com', 'Administrator'),
('mr_gudang', '6036902a177b5ecb6e41472be922257a', 'Mr. Gudang', 'haha@gmail.com', 'Gudang'),
('mr_head_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. Head of QC', 'mizan@gmail.com', 'Kepala Bagian Quality Control'),
('mr_produksi', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi', 'rifda@rifda.com', 'Produksi'),
('mr_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. QC', 'avidkucing@gmail.com', 'Quality Control');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_sampel`
--

CREATE TABLE `analisa_sampel` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Tanggal_Pemeriksaan` date NOT NULL,
  `Sisa_Sampel` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_sampel`
--

INSERT INTO `analisa_sampel` (`Nomor_Batch`, `Nomor_Analisa`, `Tanggal_Pemeriksaan`, `Sisa_Sampel`) VALUES
('Anggur-01', '0000002', '2018-01-03', 1),
('Anggur-02', '0000002-2', '2018-01-03', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_minta`
--

CREATE TABLE `bahan_minta` (
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_minta`
--

INSERT INTO `bahan_minta` (`Nomor_Instruksi`, `Kode_Bahan`, `Nomor_Analisa`, `Jumlah`, `Keterangan`) VALUES
('0000001', '0000002', '0000002', 5, 'untuk produksi jus anggur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_terima`
--

CREATE TABLE `bahan_terima` (
  `Nomor_LPB` varchar(100) NOT NULL,
  `ID_Bahan` int(11) NOT NULL,
  `Tanggal_Terima` date NOT NULL,
  `Nomor_Surat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_terima`
--

INSERT INTO `bahan_terima` (`Nomor_LPB`, `ID_Bahan`, `Tanggal_Terima`, `Nomor_Surat`) VALUES
('0000001', 14, '2018-01-03', 'JAN-01'),
('0000002', 15, '2018-01-03', 'JAN-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_analisa_sampel`
--

CREATE TABLE `hasil_analisa_sampel` (
  `Nomor_Analisa` varchar(100) NOT NULL,
  `No` int(11) NOT NULL,
  `Hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_analisa_sampel`
--

INSERT INTO `hasil_analisa_sampel` (`Nomor_Analisa`, `No`, `Hasil`) VALUES
('0000002', 1, 'good'),
('0000002', 2, 'Not Good'),
('0000002-2', 1, 'Good'),
('0000002-2', 2, 'Not Good');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_bahan`
--

CREATE TABLE `jenis_bahan` (
  `ID_Bahan` int(11) NOT NULL,
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nama_Bahan` varchar(100) NOT NULL,
  `Nama_Manufacturer` varchar(100) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Merk` varchar(100) NOT NULL,
  `Satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_bahan`
--

INSERT INTO `jenis_bahan` (`ID_Bahan`, `Kode_Bahan`, `Nama_Bahan`, `Nama_Manufacturer`, `Nama_Supplier`, `Merk`, `Satuan`) VALUES
(14, '0000001', 'Apel', 'PT BATU', 'PT PASAR ORO-ORO DOWO', 'Malang', 'Kilogram'),
(15, '0000002', 'Anggur', 'PT BATU', 'PT JAYA', 'Hijau', 'Kilogram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_batch_bahan`
--

CREATE TABLE `nomor_batch_bahan` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_LPB` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_batch_bahan`
--

INSERT INTO `nomor_batch_bahan` (`Nomor_Batch`, `Nomor_LPB`, `Jumlah`, `Status`) VALUES
('Anggur-01', '0000002', 5, 'RELEASE'),
('Anggur-02', '0000002', 30, 'QUARANTINE'),
('Apel-01', '0000001', 10, 'QUARANTINE'),
('Apel-02', '0000001', 20, 'QUARANTINE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `ID_Notif` int(11) NOT NULL,
  `Teks_Notifikasi` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif_kepada`
--

CREATE TABLE `notif_kepada` (
  `ID_Notif` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Status_Terbaca` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `parameter_bahan`
--

CREATE TABLE `parameter_bahan` (
  `Kode_Bahan` varchar(100) NOT NULL,
  `No` smallint(6) NOT NULL,
  `Parameter` text NOT NULL,
  `Spesifikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parameter_bahan`
--

INSERT INTO `parameter_bahan` (`Kode_Bahan`, `No`, `Parameter`, `Spesifikasi`) VALUES
('0000001', 1, 'Segar', 'Dingin'),
('0000001', 2, 'Awet', '3 hari'),
('0000002', 1, 'Segar', 'Dingin'),
('0000002', 2, 'Awet', '5 hari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_bahan`
--

CREATE TABLE `permintaan_bahan` (
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Site_Produksi` varchar(100) NOT NULL,
  `Tanggal_Permintaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan_bahan`
--

INSERT INTO `permintaan_bahan` (`Nomor_Instruksi`, `Site_Produksi`, `Tanggal_Permintaan`) VALUES
('0000001', '0000001', '2018-01-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampel_bahan_terima`
--

CREATE TABLE `sampel_bahan_terima` (
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
  `Catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sampel_bahan_terima`
--

INSERT INTO `sampel_bahan_terima` (`Nomor_Batch`, `Nomor_Instruksi`, `Tanggal_Instruksi`, `EXP_Date`, `Doc_COA`, `Pola_Sampling`, `Jumlah_Wadah`, `Jumlah_Sampel`, `Petugas_Sampling`, `Rencana_Sampling`, `Catatan`) VALUES
('Anggur-01', '0000001', '2018-01-03', '2023-01-03', 1, 'POLA n(1+(N)^-1/2)', 1, '1', 'Mr. QC', 'SKIP TEST', 'OK'),
('Anggur-02', '0000002', '2018-01-03', '2023-01-03', 0, 'POLA p (bahan baku homogen, semua wadah)', 1, '1', 'Mr. QC', 'FULL TEST', ''),
('Apel-01', '0000003', '2018-01-03', '2022-01-03', 1, 'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)', 1, '1', 'Mr. QC', 'LAIN_LAIN', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `analisa_sampel`
--
ALTER TABLE `analisa_sampel`
  ADD UNIQUE KEY `Nomor_Analisa` (`Nomor_Analisa`),
  ADD KEY `Nomor_Batch` (`Nomor_Batch`);

--
-- Indexes for table `bahan_minta`
--
ALTER TABLE `bahan_minta`
  ADD KEY `Nomor_Analisa` (`Nomor_Analisa`),
  ADD KEY `Nomor_Instruksi` (`Nomor_Instruksi`);

--
-- Indexes for table `bahan_terima`
--
ALTER TABLE `bahan_terima`
  ADD PRIMARY KEY (`Nomor_LPB`),
  ADD KEY `ID_Bahan` (`ID_Bahan`);

--
-- Indexes for table `hasil_analisa_sampel`
--
ALTER TABLE `hasil_analisa_sampel`
  ADD KEY `Nomor_Analisa` (`Nomor_Analisa`);

--
-- Indexes for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  ADD PRIMARY KEY (`ID_Bahan`);

--
-- Indexes for table `nomor_batch_bahan`
--
ALTER TABLE `nomor_batch_bahan`
  ADD PRIMARY KEY (`Nomor_Batch`),
  ADD KEY `Nomor_LPB` (`Nomor_LPB`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`ID_Notif`);

--
-- Indexes for table `notif_kepada`
--
ALTER TABLE `notif_kepada`
  ADD KEY `ID_Notif` (`ID_Notif`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `parameter_bahan`
--
ALTER TABLE `parameter_bahan`
  ADD KEY `ID_Bahan` (`Kode_Bahan`);

--
-- Indexes for table `permintaan_bahan`
--
ALTER TABLE `permintaan_bahan`
  ADD PRIMARY KEY (`Nomor_Instruksi`);

--
-- Indexes for table `sampel_bahan_terima`
--
ALTER TABLE `sampel_bahan_terima`
  ADD PRIMARY KEY (`Nomor_Batch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  MODIFY `ID_Bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `analisa_sampel`
--
ALTER TABLE `analisa_sampel`
  ADD CONSTRAINT `analisa_sampel_ibfk_1` FOREIGN KEY (`Nomor_Batch`) REFERENCES `sampel_bahan_terima` (`Nomor_Batch`);

--
-- Ketidakleluasaan untuk tabel `bahan_minta`
--
ALTER TABLE `bahan_minta`
  ADD CONSTRAINT `bahan_minta_ibfk_1` FOREIGN KEY (`Nomor_Instruksi`) REFERENCES `permintaan_bahan` (`Nomor_Instruksi`);

--
-- Ketidakleluasaan untuk tabel `bahan_terima`
--
ALTER TABLE `bahan_terima`
  ADD CONSTRAINT `bahan_terima_ibfk_1` FOREIGN KEY (`ID_Bahan`) REFERENCES `jenis_bahan` (`ID_Bahan`);

--
-- Ketidakleluasaan untuk tabel `hasil_analisa_sampel`
--
ALTER TABLE `hasil_analisa_sampel`
  ADD CONSTRAINT `hasil_analisa_sampel_ibfk_1` FOREIGN KEY (`Nomor_Analisa`) REFERENCES `analisa_sampel` (`Nomor_Analisa`);

--
-- Ketidakleluasaan untuk tabel `nomor_batch_bahan`
--
ALTER TABLE `nomor_batch_bahan`
  ADD CONSTRAINT `nomor_batch_bahan_ibfk_1` FOREIGN KEY (`Nomor_LPB`) REFERENCES `bahan_terima` (`Nomor_LPB`);

--
-- Ketidakleluasaan untuk tabel `notif_kepada`
--
ALTER TABLE `notif_kepada`
  ADD CONSTRAINT `ID_Notif` FOREIGN KEY (`ID_Notif`) REFERENCES `notifikasi` (`ID_Notif`),
  ADD CONSTRAINT `Username` FOREIGN KEY (`Username`) REFERENCES `akun` (`Username`);

--
-- Ketidakleluasaan untuk tabel `sampel_bahan_terima`
--
ALTER TABLE `sampel_bahan_terima`
  ADD CONSTRAINT `sampel_bahan_terima_ibfk_1` FOREIGN KEY (`Nomor_Batch`) REFERENCES `nomor_batch_bahan` (`Nomor_Batch`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
