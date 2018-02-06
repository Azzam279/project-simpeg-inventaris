-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2016 at 11:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_peg_invt`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
`id_absen` int(5) NOT NULL,
  `no_pegawai` int(5) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `tgl` date NOT NULL,
  `hadir` int(1) NOT NULL,
  `izin` int(1) NOT NULL,
  `sakit` int(1) NOT NULL,
  `cuti` int(1) NOT NULL,
  `tl` int(1) NOT NULL,
  `tanpa_kabar` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `no_pegawai`, `hari`, `tgl`, `hadir`, `izin`, `sakit`, `cuti`, `tl`, `tanpa_kabar`) VALUES
(1, 2, 'Selasa', '2016-10-25', 0, 0, 0, 1, 0, 0),
(2, 2, 'Rabu', '2016-10-26', 1, 0, 0, 0, 0, 0),
(3, 4, 'Rabu', '2016-10-26', 0, 1, 0, 0, 0, 0),
(4, 5, 'Rabu', '2016-10-26', 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `level`) VALUES
(1, 'azzam', '$2y$12$QBPbw/25a5LaRXEP5cgbBuC5Y6TufiDesAabJJaNNwjhnoHb2AR8.', 999),
(3, 'root', '$2y$12$pUUcqCozS7aNoSODnCw.BeBdZdvD7AvEjAuPqKxMaqzAqEk/8SJu.', 4),
(4, 'BiroUmum', '$2y$12$WiyMR3jnEI.HQXuOuLNLUuc5KOfiHy58FgrtdkYZR9vzd/1G3k/p6', 7);

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE IF NOT EXISTS `agama` (
`id_agama` int(2) NOT NULL,
  `agama` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Katolik'),
(3, 'Protestan'),
(4, 'Hindu'),
(5, 'Budha'),
(6, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id_barang` int(5) NOT NULL,
  `satuan_kerja` int(5) NOT NULL,
  `ruangan` varchar(25) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `model` varchar(35) NOT NULL,
  `sn_pabrik` varchar(20) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `bahan` varchar(30) NOT NULL,
  `thn_buat_beli` year(4) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jumlah_barang` int(3) NOT NULL,
  `ket` text NOT NULL,
  `baik` int(4) NOT NULL,
  `kurangbaik` int(4) NOT NULL,
  `rusakberat` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `satuan_kerja`, `ruangan`, `nm_barang`, `model`, `sn_pabrik`, `ukuran`, `bahan`, `thn_buat_beli`, `kode_barang`, `jumlah_barang`, `ket`, `baik`, `kurangbaik`, `rusakberat`) VALUES
(1, 7, 'Staf Sekretaris Daerah', 'Meja', '-', '-', '-', '-', 0000, '-', 7, 'no ket', 7, 0, 0),
(2, 4, 'TU Biro Organisasi', 'Laptop Asus', '-', '-', '-', '-', 2013, '-', 3, '', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE IF NOT EXISTS `cuti` (
`id_cuti` int(5) NOT NULL,
  `no_pegawai` int(5) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `hari` tinyint(2) NOT NULL,
  `jenis_surat` varchar(20) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `tgl_surat` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `no_pegawai`, `tgl_mulai`, `tgl_selesai`, `hari`, `jenis_surat`, `alamat`, `tipe`, `tgl_surat`) VALUES
(7, 2, '2016-11-05', '2016-11-09', 5, 'Cuti Tahunan', 'Jl. Kemuning Ujung No.17', 'Pejabat', '2016-11-04'),
(8, 2, '2016-11-05', '2016-11-07', 3, 'Cuti Tahunan', 'awrgwbwnbdngdntene', 'Non-Pejabat', '2016-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `eselon`
--

CREATE TABLE IF NOT EXISTS `eselon` (
`id_eselon` int(5) NOT NULL,
  `eselon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eselon`
--

INSERT INTO `eselon` (`id_eselon`, `eselon`) VALUES
(1, 'I.B'),
(2, 'II.A'),
(3, 'II.B'),
(4, 'III.A'),
(5, 'III.B'),
(6, 'IV.A'),
(7, '-');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE IF NOT EXISTS `golongan` (
`id_golongan` int(5) NOT NULL,
  `golongan` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `golongan`) VALUES
(1, 'IV/e'),
(2, 'IV/d'),
(3, 'IV/c'),
(4, 'IV/b'),
(5, 'IV/a'),
(6, 'III/d'),
(7, 'III/c'),
(8, 'III/b');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
`id_jabatan` int(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(4, 'Sekretaris Daerah'),
(5, 'Asisten Pemerintahan'),
(6, 'Asisten Pembangunan'),
(7, 'Asisten Administrasi Umum'),
(8, 'Staf Ahli Bidang Kemasyarakatan dan SDM'),
(9, 'Staf Ahli Bidang Pemerintahan'),
(10, 'Staf Ahli Bidang Ekonomi dan Keuangan'),
(11, 'Staf Ahli Bidang Hukum dan Politik'),
(12, 'Staf Ahli Bidang Pembangunan'),
(13, 'Kepala Biro Organisasi'),
(14, 'Kepala Bagian Pemberdayaan Aparatur'),
(15, 'Kepala Bagian Kelembagaan'),
(18, 'Kepala Bagian Anforjab'),
(19, 'Kepala Bagian Tata Laksana'),
(20, 'Kepala Sub Bagian Fasilitasi dan Evaluasi Kelembag'),
(21, 'Kepala Sub Bagian Formasi Jabatan'),
(22, 'PULAHTA PEMBAKUAN & PENGATURAN');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
`id_kendaraan` int(11) NOT NULL,
  `sub_unit` varchar(35) NOT NULL,
  `upb` varchar(35) NOT NULL,
  `kode_kendaraan` varchar(15) NOT NULL,
  `cara_perolehan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `tahun` year(4) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `keadaan` varchar(15) NOT NULL,
  `no_rangka` varchar(20) NOT NULL,
  `no_polisi` varchar(18) NOT NULL,
  `no_bpkb` varchar(15) NOT NULL,
  `ket` varchar(150) NOT NULL,
  `tgl_pajak` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `sub_unit`, `upb`, `kode_kendaraan`, `cara_perolehan`, `nama`, `merk`, `tahun`, `harga`, `keadaan`, `no_rangka`, `no_polisi`, `no_bpkb`, `ket`, `tgl_pajak`) VALUES
(1, 'Bidang Pemerintahan', 'Biro Organisasi', 'KEND0001', 'Pembelian', 'Mobil Toyota', 'TOYOTA NEW AVANZA 1.3 G M/T', 2013, 'Rp 164.958.900,00', 'Baik', 'MHKM1BA3JCK073405', 'DA 709 AG-5-2013', 'DL 33173', 'no ket', 1493589600),
(2, 'Bidang Pembangunan', 'Biro Perekonomian', 'KEND0002', 'Peminjaman', 'Motor', 'SHOGUN AXELO S', 2012, 'Rp 14.918.000,00', 'Kurang Baik', 'MH8BF55SACJ-165134', 'DA 4323 IZ-4-2012', 'F496-ID-435954', '', 1490997600),
(3, 'Bidang Administrasi Umum', 'Biro Keuangan', 'KEND0004', 'Pembelian', 'Motor Yamaha', 'Yamaha Jupiter MX', 2008, 'Rp 13.500.000,00', 'Baik', 'gqwrg353h', 'DA 725 LP-4-2007', 'qeqjfij2fhohnbv', 'empty', 1522533600);

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE IF NOT EXISTS `pangkat` (
`id_pangkat` int(5) NOT NULL,
  `pangkat` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`id_pangkat`, `pangkat`) VALUES
(3, 'Pembina Utama'),
(4, 'Pembina Utama Madya'),
(5, 'Pembina Utama Muda'),
(6, 'Pembina Tk.I'),
(7, 'Pembina'),
(8, 'Penata Tk. I'),
(9, 'Penata'),
(10, 'Penata Muda Tk I'),
(11, '-');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
`id_pegawai` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(22) NOT NULL,
  `tmpt_lahir` varchar(35) NOT NULL,
  `tgl_lahir` char(10) NOT NULL,
  `no_golongan` int(5) NOT NULL,
  `tmt_golongan` char(10) NOT NULL,
  `no_jabatan` int(5) NOT NULL,
  `tmt_jabatan` char(10) NOT NULL,
  `no_eselon` int(5) NOT NULL,
  `no_pangkat` int(5) NOT NULL,
  `pendidikan` varchar(40) NOT NULL,
  `thn_lulus` char(4) NOT NULL,
  `diklat_jabatan` varchar(30) NOT NULL,
  `masa_kerja_thn` int(2) NOT NULL,
  `masa_kerja_bln` int(2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `jkl` varchar(10) NOT NULL,
  `no_agama` int(5) NOT NULL,
  `unit_kerja` int(5) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `nip`, `tmpt_lahir`, `tgl_lahir`, `no_golongan`, `tmt_golongan`, `no_jabatan`, `tmt_jabatan`, `no_eselon`, `no_pangkat`, `pendidikan`, `thn_lulus`, `diklat_jabatan`, `masa_kerja_thn`, `masa_kerja_bln`, `status`, `jkl`, `no_agama`, `unit_kerja`, `ket`, `foto`, `password`) VALUES
(2, 'Drs. PERKASA ALAM', '19590615 198602 1 008', 'PELAIHARI', '15/06/1959', 3, '01-04-2014', 13, '27-12-2010', 3, 5, 'S.1 Fisip Unlam Banjarmasin', '1986', 'P I M  II', 29, 9, 'Aktif', 'Laki-laki', 1, 4, '', '2-1480239794.jpg', '$2y$12$AzbW7HkADQvdYvbSjGC8UeOkq52v7VOPC9jp/1NH4aiYzRxAbuWei'),
(4, 'HASAN DAMIRI, S.Sos, MM', '19650808 199002 1 005', 'GUNTUNG LUA', '08/08/1965', 7, '01-10-2013', 21, '18-07-2012', 6, 9, 'S.2', '', 'PIM  IV', 21, 5, 'Aktif', 'Laki-laki', 1, 4, '', '4-1476078765.jpg', '$2y$12$dG9I1pJ4RMdGQGqz9f8RlOueZTD6NgLj7r9wNpFUzpwn8T.w9L6R.'),
(5, 'MILTHON', '19640405 198602 1 020', 'BANJARMASIN', '05/04/1964', 8, '01-04-2006', 22, '20-11-2014', 7, 11, 'SMA.A3 / IPS', '1984', '-', 24, 1, 'Aktif', 'Laki-laki', 2, 7, '', '5-1476034963.jpg', '$2y$12$dG9I1pJ4RMdGQGqz9f8RlOueZTD6NgLj7r9wNpFUzpwn8T.w9L6R.');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE IF NOT EXISTS `unit_kerja` (
`id_unit` int(5) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit`, `unit_kerja`) VALUES
(1, 'SEKRETARIAT DAERAH'),
(2, 'ASISTEN SETDA'),
(3, 'STAF AHLI SETDA'),
(4, 'BIRO ORGANISASI'),
(5, 'BIRO HUBUNGAN MASYARAKAT'),
(6, 'BIRO KESEJAHTERAAN RAKYAT'),
(7, 'BIRO UMUM'),
(8, 'BIRO PERLENGKAPAN'),
(9, 'BIRO KEUANGAN'),
(10, 'BIRO PEREKONOMIAN'),
(11, 'BIRO PEMERINTAHAN'),
(12, 'BIRO HUKUM'),
(13, 'KORPRI'),
(14, 'SATPOL PP'),
(999, '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
 ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`), ADD KEY `level` (`level`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
 ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_barang`), ADD KEY `satuan_kerja` (`satuan_kerja`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
 ADD PRIMARY KEY (`id_cuti`), ADD KEY `no_pegawai` (`no_pegawai`);

--
-- Indexes for table `eselon`
--
ALTER TABLE `eselon`
 ADD PRIMARY KEY (`id_eselon`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
 ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
 ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
 ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
 ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`id_pegawai`), ADD KEY `no_golongan` (`no_golongan`), ADD KEY `no_jabatan` (`no_jabatan`), ADD KEY `no_eselon` (`no_eselon`), ADD KEY `no_pangkat` (`no_pangkat`), ADD KEY `unit_kerja` (`unit_kerja`), ADD KEY `no_agama` (`no_agama`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
 ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
MODIFY `id_absen` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
MODIFY `id_agama` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
MODIFY `id_cuti` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eselon`
--
ALTER TABLE `eselon`
MODIFY `id_eselon` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
MODIFY `id_golongan` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
MODIFY `id_pangkat` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
MODIFY `id_unit` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`level`) REFERENCES `unit_kerja` (`id_unit`) ON UPDATE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_kerja`) REFERENCES `unit_kerja` (`id_unit`) ON UPDATE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`no_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`no_agama`) REFERENCES `agama` (`id_agama`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`no_pangkat`) REFERENCES `pangkat` (`id_pangkat`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`unit_kerja`) REFERENCES `unit_kerja` (`id_unit`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_4` FOREIGN KEY (`no_eselon`) REFERENCES `eselon` (`id_eselon`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_5` FOREIGN KEY (`no_golongan`) REFERENCES `golongan` (`id_golongan`) ON UPDATE CASCADE,
ADD CONSTRAINT `pegawai_ibfk_6` FOREIGN KEY (`no_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
