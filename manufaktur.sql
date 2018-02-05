-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 Feb 2018 pada 06.30
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
('mr_produksi', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi', '', 'Produksi'),
('mr_qc', '6036902a177b5ecb6e41472be922257a', 'Mr. QC', 'avidkucing@gmail.com', 'Quality Control'),
('mr_head_gudang', '6036902a177b5ecb6e41472be922257a', 'Mr. Head of Gudang', 'gudang@hisamitsu.com', 'Kepala Bagian Gudang'),
('mr_produksi_2', '6036902a177b5ecb6e41472be922257a', 'Mr. Produksi 2', 'produksi2@hisamitsu.com', 'Produksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisa_sampel`
--

CREATE TABLE `analisa_sampel` (
  `ID_Batch` varchar(100) NOT NULL,
  `Nomor_Analisa` varchar(100) NOT NULL,
  `Tanggal_Pemeriksaan` date NOT NULL,
  `Sisa_Sampel` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `analisa_sampel`
--

INSERT INTO `analisa_sampel` (`ID_Batch`, `Nomor_Analisa`, `Tanggal_Pemeriksaan`, `Sisa_Sampel`) VALUES
('2', '010_BA_18', '2018-01-29', 100),
('3', '005_BA_18', '2018-01-22', 100),
('4', '003_BB_18', '2018-01-06', 50),
('1', '019_BA_18', '2018-01-29', 100),
('6', '122_BA_19', '2018-01-19', 100),
('10', '004/BB/18', '2018-02-05', 0.1),
('8', '005/BB/18', '2018-02-05', 0.01);

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
  `Status` varchar(100) NOT NULL,
  `Jenis_Permintaan` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan_terima`
--

INSERT INTO `bahan_terima` (`Nomor_LPB`, `ID_Bahan`, `Nama_Manufacturer`, `Nama_Supplier`, `Tanggal_Terima`, `Nomor_Surat`, `Status`, `Jenis_Permintaan`) VALUES
('002/BP/I/18', 20, 'Mermaid Textile', 'Sandratex', '2018-01-05', '001/PS/I/2018', 'ACCEPTED', 'Normal'),
('003/BB/I/18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-05', '001/PS/I/2018', 'ACCEPTED', 'Normal'),
('004/BB/I/18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-05', '001/PS/I/2018', 'ACCEPTED', 'Urgent'),
('005/BB/I/18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-06', '001/PS/I/2018', 'ACCEPTED', 'Very Urgent'),
('006/BB/I/18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-07', '001/PS/I/2018', 'ACCEPTED', 'Urgent'),
('007/BB/I/18', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-01-09', '001/PS/I/2018', 'ACCEPTED', 'Normal'),
('008/BK/I/18', 27, 'Anhui Great Nation Essential Oils Co., Ltd.', 'PT. Jutarasa Abadi', '2018-01-24', '002/PS/I/2018', 'ACCEPTED', 'Urgent'),
('009/BK/I/18', 27, 'Anhui Great Nation Essential Oils Co., Ltd.', 'PT. Jutarasa Abadi', '2018-01-25', '003/PS/I/2018', 'ACCEPTED', 'Urgent'),
('010/BB/II/2018', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-02-03', '001/PS/II/2018', 'ACCEPTED', 'Urgent'),
('011/BK/II/2018', 28, 'Mermaid Textile', 'PT. Jutarasa Abadi', '2018-02-04', '002/PS/II/2018', 'QUARANTINE', 'Urgent'),
('012/BB/II/2018', 21, 'Suzhou', 'PT. Jutarasa Abadi', '2018-02-04', '004/PS/II/2018', 'QUARANTINE', 'Normal');

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
('122_BA_19', 1, 'Bagus'),
('004/BB/18', 1, 'sip'),
('004/BB/18', 2, 'sip'),
('004/BB/18', 3, 'not sip'),
('004/BB/18', 4, 'sip'),
('004/BB/18', 5, 'sip'),
('004/BB/18', 6, 'sip'),
('004/BB/18', 7, 'sip'),
('004/BB/18', 8, 'sip'),
('004/BB/18', 9, 'sip'),
('005/BB/18', 1, 'oke'),
('005/BB/18', 2, 'oke'),
('005/BB/18', 3, 'oke'),
('005/BB/18', 4, 'not oke'),
('005/BB/18', 5, 'oke'),
('005/BB/18', 6, 'oke'),
('005/BB/18', 7, 'oke'),
('005/BB/18', 8, 'oke'),
('005/BB/18', 9, 'oke');

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
(20, 'CLOTH S610', 'Kain', 'Meter', 'Pembantu'),
(21, 'CAM', 'Camphor', 'Kg', 'Baku'),
(27, 'MEN', 'l-Menthol', 'Kg', 'Kemas'),
(28, 'CLOTH S611', 'Kain', 'Meter', 'Kemas');

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
('CAM', 'Suzhou'),
('CLOTH S611', 'Anhui Great Nation Essential Oils Co., Ltd.'),
('CLOTH S611', 'Mermaid Textile');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_batch_bahan`
--

CREATE TABLE `nomor_batch_bahan` (
  `ID_Batch` int(11) NOT NULL,
  `Nomor_Batch` varchar(100) NOT NULL,
  `Nomor_LPB` varchar(100) NOT NULL,
  `Jumlah` float NOT NULL,
  `EXP_Date` date NOT NULL,
  `Keterangan` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Alasan_Status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomor_batch_bahan`
--

INSERT INTO `nomor_batch_bahan` (`ID_Batch`, `Nomor_Batch`, `Nomor_LPB`, `Jumlah`, `EXP_Date`, `Keterangan`, `Status`, `Alasan_Status`) VALUES
(1, '3434', '006/BB/I/18', 0, '2018-11-24', '', 'RELEASE', ''),
(2, '2323', '005/BB/I/18', 2000, '2019-01-21', '', 'REJECT', ''),
(3, '1211', '004/BB/I/18', 1000, '2020-01-27', '', 'REJECT', ''),
(4, '1', '003/BB/I/18', 500, '2018-01-31', '10 pcs * 50', 'RELEASE', ''),
(5, '001', '002/BP/I/18', 1000, '2018-07-27', '', 'RELEASE', ''),
(6, '1111', '007/BB/I/18', 1000, '2018-11-16', '', 'REJECT', 'sip2'),
(7, '3456', '008/BK/I/18', 100, '2019-03-14', '', 'QUARANTINE', ''),
(8, '2345', '008/BK/I/18', 100, '2019-10-10', '', 'RELEASE', ''),
(9, '8769', '009/BK/I/18', 200, '2020-02-05', '8 pcs * 25', 'QUARANTINE', ''),
(10, '2388', '009/BK/I/18', 250, '2019-01-30', '10 pcs * 25', 'RELEASE', 'sip'),
(11, '1111A', '010/BB/II/2018', 1000, '2020-02-03', '10 * 100 kg', 'QUARANTINE', ''),
(12, '1111B', '010/BB/II/2018', 1000, '2020-02-03', '10 * 100 kg', 'QUARANTINE', ''),
(13, '1356', '011/BK/II/2018', 500, '2044-02-24', '10 * 50 meter', 'QUARANTINE', ''),
(14, '1111B', '012/BB/II/2018', 100, '2031-02-04', '10 * 10 kg', 'QUARANTINE', '');

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
('CLOTH S611', 1, 'Jenis', 'Rayon'),
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
  `ID_Batch` int(11) NOT NULL,
  `Nomor_Instruksi` varchar(100) NOT NULL,
  `Jumlah_Sampel` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sampel_bahan_terima`
--

INSERT INTO `sampel_bahan_terima` (`ID_Batch`, `Nomor_Instruksi`, `Jumlah_Sampel`) VALUES
(3, '004/ISP-BA/2018', '10'),
(4, '003/ISP-BA/2018', '100 gram'),
(2, '005/ISP-BA/2018', '10'),
(1, '006/ISP-BA/2018', '10'),
(6, '001/ISP-BA/2018', '1.5 meter'),
(8, '005/ISP-BA/2018', '1 gram'),
(7, '009/ISP-BA/2018', '1 gram'),
(10, '010/ISP-BA/2018', '1 gram');

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
('MEN', 'PT. Jutarasa Abadi'),
('CLOTH S611', 'Sandratex'),
('CLOTH S611', 'PT. Jutarasa Abadi'),
('CLOTH S611', 'Mermaid Textile');

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
  ADD UNIQUE KEY `ID_Batch` (`ID_Batch`);

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
  ADD PRIMARY KEY (`ID_Batch`),
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
  ADD PRIMARY KEY (`ID_Batch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  MODIFY `ID_Bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `nomor_batch_bahan`
--
ALTER TABLE `nomor_batch_bahan`
  MODIFY `ID_Batch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sampel_bahan_terima`
--
ALTER TABLE `sampel_bahan_terima`
  MODIFY `ID_Batch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
