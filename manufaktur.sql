-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Jan 2018 pada 02.59
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manufaktur`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`Username`, `Password`, `Nama`, `Email`, `Tipe_Pegawai`) VALUES
('admin', '6036902a177b5ecb6e41472be922257a', 'Admin', 'mhabibullah14@yahoo.com', 'Administrator'),
('mr_gudang', '6036902a177b5ecb6e41472be922257a', 'Mr. Gudang', 'haha@gmail.com', 'Gudang'),
('mr_head_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. Head of QC', 'mizan@gmail.com', 'Kepala Bagian Quality Control'),
('mr_produksi', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi', 'rifda@rifda.com', 'Produksi'),
('mr_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. QC', 'avidkucing@gmail.com', 'Quality Control'),
('mr_head_gudang', '6036902a177b5ecb6e41472be922257a', 'Mr. Head of Gudang', 'gudang@hisamitsu.com', 'Kepala Gudang'),
('mr_produksi_2', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi 2', 'produksi2@hisamitsu.com', 'Produksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_sampel`
--

CREATE TABLE `analisa_sampel` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Tanggal_Pemeriksaan` date NOT NULL,
  `Sisa_Sampel` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_sampel`
--

INSERT INTO `analisa_sampel` (`Nomor_Batch`, `Nomor_Analisa`, `Tanggal_Pemeriksaan`, `Sisa_Sampel`) VALUES
('2323', '010_BA_18', '2018-01-29', 100),
('1211', '005_BA_18', '2018-01-22', 100),
('1', '003_BB_18', '2018-01-06', 50),
('3434', '019_BA_18', '2018-01-29', 100),
('5454', '120_BA_18', '2018-01-28', 100),
('1111', '122_BA_19', '2018-01-19', 100);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_minta`
--

INSERT INTO `bahan_minta` (`Nomor_Instruksi`, `Kode_Bahan`, `Nomor_Analisa`, `Jumlah`, `Keterangan`) VALUES
('01_B2_BB_I_2018', 'CAM', '019_BA_18', 500, '-'),
('001_S100_18', 'CAM', '003_BB_18', 500, '-'),
('02_B2_BB_I_2018', 'CAM', '120_BA_18', 1000, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_terima`
--

CREATE TABLE `bahan_terima` (
  `Nomor_LPB` varchar(100) NOT NULL,
  `ID_Bahan` int(11) NOT NULL,
  `Nama_Manufacturer` varchar(100) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL,
  `Tanggal_Terima` date NOT NULL,
  `Nomor_Surat` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_terima`
--

INSERT INTO `bahan_terima` (`Nomor_LPB`, `ID_Bahan`, `Nama_Manufacturer`, `Nama_Supplier`, `Tanggal_Terima`, `Nomor_Surat`, `Status`) VALUES
('002_BB_I_18', 20, 'Mermaid Textile', 'Sandratex', '2018-01-05', '002', 'QUARANTINE'),
('003_BB_I_18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-05', '01', 'ACCEPTED'),
('004_BB_I_18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-05', '001_PS_I_2018', 'ACCEPTED'),
('005_BB_I_18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-06', '001_PS_I_2018', 'ACCEPTED'),
('006_BB_I_18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-07', '001_PS_I_2018', 'ACCEPTED'),
('007_BB_I_18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-09', '001_PS_I_2018', 'QUARANTINE'),
('008_BB_I_18', 27, 'Anhui Great Nation Essential Oils Co., Ltd.', 'PT. Jutarasa Abadi', '2018-01-24', '002_PS_I_2018', 'ACCEPTED');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_analisa_sampel`
--

CREATE TABLE `hasil_analisa_sampel` (
  `Nomor_Analisa` varchar(100) NOT NULL,
  `No` int(11) NOT NULL,
  `Hasil` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_analisa_sampel`
--

INSERT INTO `hasil_analisa_sampel` (`Nomor_Analisa`, `No`, `Hasil`) VALUES
('120_BA_18', 1, '100'),
('019_BA_18', 1, '100'),
('010_BA_18', 1, '100'),
('005_BA_18', 1, '100'),
('003_BB_18', 1, 'Sesuai'),
('122_BA_19', 1, 'Bagus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_bahan`
--

CREATE TABLE `jenis_bahan` (
  `ID_Bahan` int(11) NOT NULL,
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nama_Bahan` varchar(100) NOT NULL,
  `Satuan` varchar(20) NOT NULL,
  `Jenis` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_bahan`
--

INSERT INTO `jenis_bahan` (`ID_Bahan`, `Kode_Bahan`, `Nama_Bahan`, `Satuan`, `Jenis`) VALUES
(20, 'CLOTH S610', 'Kain', 'Meter', 'Baku'),
(21, 'CAM', 'Camphor', 'Kg', 'Baku'),
(27, 'MEN', 'l-Menthol', 'Kg', 'Kemas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manufaktur_bahan`
--

CREATE TABLE `manufaktur_bahan` (
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nama_Manufacturer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `manufaktur_bahan`
--

INSERT INTO `manufaktur_bahan` (`Kode_Bahan`, `Nama_Manufacturer`) VALUES
('MEN', 'Anhui Great Nation Essential Oils Co., Ltd.'),
('CLOTH S610', 'Mermaid Textile'),
('CLOTH S610', 'Sandratex'),
('CAM', 'Suzhou');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_batch_bahan`
--

CREATE TABLE `nomor_batch_bahan` (
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_LPB` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_batch_bahan`
--

INSERT INTO `nomor_batch_bahan` (`Nomor_Batch`, `Nomor_LPB`, `Jumlah`, `Status`) VALUES
('3434', '006_BB_I_18', 0, 'RELEASE'),
('2323', '005_BB_I_18', 2000, 'REJECT'),
('1211', '004_BB_I_18', 1000, 'REJECT'),
('1', '003_BB_I_18', 500, 'RELEASE'),
('001', '002_BB_I_18', 1000, 'QUARANTINE'),
('1111', '007_BB_I_18', 1000, 'QUARANTINE'),
('3456', '008_BB_I_18', 100, 'QUARANTINE'),
('2345', '008_BB_I_18', 100, 'QUARANTINE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `ID_Notif` int(11) NOT NULL,
  `Teks_Notifikasi` text NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif_kepada`
--

CREATE TABLE `notif_kepada` (
  `ID_Notif` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Status_Terbaca` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `parameter_bahan`
--

CREATE TABLE `parameter_bahan` (
  `Kode_Bahan` varchar(100) NOT NULL,
  `No` smallint(6) NOT NULL,
  `Parameter` text NOT NULL,
  `Spesifikasi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parameter_bahan`
--

INSERT INTO `parameter_bahan` (`Kode_Bahan`, `No`, `Parameter`, `Spesifikasi`) VALUES
('MEN', 9, 'Penetapan kadar', 'tidak kurang dari 98.0%'),
('MEN', 8, 'Nitromethane atau Nitroethane', 'Tidak segera terjadi warna merah - keunguan'),
('MEN', 7, 'Thymol', 'Tidak segera terjadi warna hijau sampai biru kehijauan'),
('MEN', 6, 'Residu tidak menguap', 'Bobot residu tidak lebih dari 1.0 mg'),
('MEN', 5, 'Titik Lebur', '42 ~ 44 oC'),
('MEN', 4, 'Rotasi optik (a) 20/D', '-45.0 ~ -51.0 o (2.5g, ethanol 96%, 25 mL, 100 mm'),
('MEN', 3, 'Identifikasi (2)', 'Campuran menjadi keruh dengan warna kuning kemerahan'),
('MEN', 2, 'Identifikasi (1)', 'Campuran akan menjadi cair'),
('CLOTH S610', 1, 'Jenis ', 'Rayon'),
('CLOTH S610', 1, 'Jenis', 'Rayon'),
('CAM', 1, 'Kadar', '100'),
('MEN', 1, 'Pemerian', 'Krital tidak berwarna atau putih dan bau segar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_bahan`
--

CREATE TABLE `permintaan_bahan` (
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Site_Produksi` varchar(100) NOT NULL,
  `Tanggal_Permintaan` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan_bahan`
--

INSERT INTO `permintaan_bahan` (`Nomor_Instruksi`, `Site_Produksi`, `Tanggal_Permintaan`) VALUES
('001_S100_18', 'Building-1', '2018-01-05'),
('01_B2_BB_I_2018', 'BUILDING 2', '2018-01-09'),
('02_B2_BB_I_2018', 'BUILDING 2', '2018-01-09');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sampel_bahan_terima`
--

INSERT INTO `sampel_bahan_terima` (`Nomor_Batch`, `Nomor_Instruksi`, `Tanggal_Instruksi`, `EXP_Date`, `Doc_COA`, `Pola_Sampling`, `Jumlah_Wadah`, `Jumlah_Sampel`, `Petugas_Sampling`, `Rencana_Sampling`, `Catatan`) VALUES
('1211', '004_ISP-BA_2018', '2018-01-08', '2020-01-27', 1, 'POLA n(1+(N)^-1/2)', 5, '10', 'RISAL', 'FULL TEST', ''),
('1', '003_ISP BA_18', '2018-01-05', '2018-01-31', 1, 'POLA n(1+(N)^-1/2)', 5, '100 gram', 'Risal', 'FULL TEST', ''),
('2323', '005_ISP-BA_2018', '2018-01-08', '2019-01-21', 1, 'POLA n(1+(N)^-1/2)', 10, '10', 'RISAL', 'FULL TEST', ''),
('3434', '006_ISP-BA_2018', '2018-01-15', '2020-12-01', 1, 'POLA n(1+(N)^-1/2)', 10, '10', 'RISAL', 'FULL TEST', ''),
('5454', '007_ISP-BA_18', '2018-01-08', '2020-01-22', 1, 'POLA n(1+(N)^-1/2)', 10, '10', 'RISAL', 'FULL TEST', ''),
('1111', '1', '2018-01-09', '2018-01-31', 1, 'POLA n(1+(N)^-1/2)', 1, '1.5 meter', 'Risal', 'FULL TEST', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier_bahan`
--

CREATE TABLE `supplier_bahan` (
  `Kode_Bahan` varchar(100) NOT NULL,
  `Nama_Supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier_bahan`
--

INSERT INTO `supplier_bahan` (`Kode_Bahan`, `Nama_Supplier`) VALUES
('CLOTH S610', 'Mermaid Textile'),
('CLOTH S610', 'Sandratex'),
('CAM', 'PT. Jutarasa Abadi'),
('MEN', 'PT. Jutarasa Abadi');

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
  ADD PRIMARY KEY (`ID_Bahan`),
  ADD UNIQUE KEY `Kode_Bahan` (`Kode_Bahan`);

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
  MODIFY `ID_Bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
