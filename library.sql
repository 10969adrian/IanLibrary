-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 10:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `bukuID` int(11) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `judul` varchar(70) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `penerbit` varchar(50) DEFAULT NULL,
  `tahunTerbit` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `kategoriID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`bukuID`, `cover`, `judul`, `penulis`, `penerbit`, `tahunTerbit`, `status`, `kategoriID`) VALUES
(7, '1777215800.jpg', 'A Midsummer\'s Equation', 'Keigo Higashino', 'Gramedia', 2024, 'Tersedia', 1),
(8, '1777217376.jpg', 'Teka Teki Rumah Aneh', 'Uketsu', 'Gramedia', 2023, 'Tersedia', 1),
(9, '1777220185.jpg', 'Neon Genesis Evangelion Collector\'s Edition Vol. 01', 'Yoshiyuki Sadamoto', 'm&c!', 2023, 'Tersedia', 2),
(10, '1777225679.png', 'Perjamuan Khong Guan', 'Joko Pinurbo', 'Gramedia', 2020, 'Tersedia', 8),
(11, '1777226034.png', 'National Geographic Indonesia Edisi Oktober 2024', 'National Geographic', 'Gramedia', 2024, 'Tersedia', 5),
(12, '1777256552.png', 'The Devotion of Suspect X', 'Keigo Higashino', 'Gramedia', 2021, 'Tersedia', 1),
(13, '1777256633.png', 'Salvation of a Saint', 'Keigo Higashino', 'Gramedia', 2021, 'Tersedia', 1),
(14, '1777256781.png', 'The Tokyo Zodiac Murders', 'Soji Shimada', 'Gramedia', 2020, 'Tersedia', 1),
(15, '1777257034.png', 'Sejarah Dunia Zaman Renaisans', 'Susan Wise Bauer', 'Elex Media', 2020, 'Tersedia', 10),
(16, '1777259683.jpg', 'Absolute Batman Vol. 1: The Zoo', 'Scott Synder', 'DC Comics', 2025, 'Tersedia', 2),
(17, '1777259924.png', 'Fang Si Chi\'s First Love Paradise', 'Li Yi-Han', 'Shira Media', 2025, 'Tersedia', 1),
(18, '1777264849.png', '1984', 'George Orwell', 'Gramedia', 2022, 'Tersedia', 1),
(19, '1777264971.png', 'Babel', 'R. F. Kuang', 'Shira Media', 2024, 'Tersedia', 1),
(20, '1777265133.jpg', 'Pangeran Cilik: Le Petit Prince', 'Antoine De Saint E.', 'Gramedia', 2015, 'Tersedia', 1),
(21, '1777266109.png', 'Tentang Suatu Tempat di Wilayah Kinki', 'Sesuji', 'Gramedia', 2025, 'Tersedia', 1),
(22, '1777266198.jpg', 'Lelaki Harimau', 'Eka Kurniawan', 'Gramedia', 2024, 'Dipinjam', 1),
(23, '1777266418.jpg', 'Jatuhnya Konstantinopel', 'Dwi Adi Wicaksono', 'Gramedia', 2025, 'Tersedia', 10),
(24, '1777340091.png', 'Munir', 'Tempo', 'Gramedia', 2026, 'Tersedia', 3),
(25, '1777340267.png', '60+ Dongeng Fabel Sepanjang Masa', 'Husna Widyani', 'Gramedia', 2020, 'Tersedia', 17),
(26, '1777340426.png', 'Bukan Salahmu Menjadi Perempuan', 'Fajar Sulaiman', 'Bukune', 2026, 'Tersedia', 14),
(27, '1777340757.png', 'Nabi-Nabi Sumeria', 'Dr. Khazal al-Majidi', 'Alvabet', 2023, 'Tersedia', 13),
(28, '1777458867.png', 'Lucunya Prabowo: Tegas, Santuy, Ikhlas, dan Senyumin Aja', 'Ahmad Subagya, Sunano', 'Kompas', 2024, 'Tersedia', 3),
(29, '1777464866.png', 'Dilan 1983: Wo Ai Ni', 'Pidi Baiq', 'Pastel Books', 2024, 'Tersedia', 1),
(30, '1777468066.png', 'No Longer Human', 'Osamu Dazai', 'Sigma', 2026, 'Tersedia', 1),
(31, '1777468339.png', 'Goodbye, Eri', 'Tatsuki Fujimoto', 'm&c!', 2024, 'Tersedia', 2),
(32, '1777468834.png', 'Sang Alkemis', 'Paulo Coelho', 'Gramedia', 2021, 'Tersedia', 1),
(33, '1777469481.png', 'Teka Teki Gambar Aneh', 'Uketsu', 'Gramedia', 2026, 'Tersedia', 1),
(34, '1777469594.png', 'Misteri Perpustakaan Yang Hilang', 'Rebecca Steed dan Wendy Mass', 'Gramedia', 2024, 'Tersedia', 1),
(35, '1777469675.png', 'Petaka Keluarga Inugami', 'Seishi Yokomizo', 'Gramedia', 2024, 'Tersedia', 1),
(36, '1777469894.png', 'Sejarah Moralitas', 'Hanno Sauer', 'Alvabet', 2025, 'Tersedia', 18),
(37, '1777726857.png', 'Aku Yang Telah Lama Hilang', 'Nago Tajena', 'Gramedia', 2024, 'Tersedia', 14),
(38, '1777727073.png', 'Futo Detective 01', 'Ishinomori Shotarou', 'm&c!', 2022, 'Tersedia', 2),
(39, '1777727227.png', 'Futo Detective 02', 'Ishinomori Shotarou', 'm&c!', 2022, 'Tersedia', 2),
(40, '1777729076.png', 'Bahasa Inggris Sistem 52M Vol.1', 'Herpinus Simanjutak', 'Kesaint Blanc', 2010, 'Tersedia', 19),
(41, '1777729309.png', 'Atlas Dunia', 'National Geographic', 'Gramedia', 2023, 'Tersedia', 20),
(42, '1777729890.png', 'Why? Dinosaurus', 'Elex Media', 'Elex Media', 2017, 'Tersedia', 20),
(43, '1777730229.png', 'Kerajaan Inggris: Sebuah Catatan Kelam', 'Dian Natali', 'Sociality', 2018, 'Tersedia', 10),
(44, '1777730663.png', 'Harry Potter Dan Batu Bertuah', 'J.K. Rowling', 'Gramedia', 2017, 'Tersedia', 1),
(45, '1780551876.png', 'Death Note - New edition 01', 'TSUGUMI OHBA/TAKESHI OBATA', 'm&c!', 2023, 'Dipinjam', 2),
(46, '1780551963.png', 'Death Note - New edition 02', 'TSUGUMI OHBA/TAKESHI OBATA', 'm&c!', 2023, 'Tersedia', 2),
(47, '1780552077.png', 'Tokyo Ghoul : Re 13', 'Sui Ishida', 'm&c!', 2021, 'Tersedia', 2),
(48, '1780552425.png', 'Crime and Punishment', 'Fyodor Dostoevsky', 'Norris Book', 2024, 'Tersedia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` int(11) NOT NULL,
  `namaKategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `namaKategori`) VALUES
(1, 'Novel'),
(2, 'Komik'),
(3, 'Biografi'),
(5, 'Majalah'),
(8, 'Puisi'),
(10, 'Sejarah'),
(13, 'Agama'),
(14, 'Self Improvement'),
(17, 'Fabel'),
(18, 'Filosofis'),
(19, 'Pendidikan'),
(20, 'Sains'),
(21, 'Teknologi');

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `koleksiID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bukuID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`koleksiID`, `userID`, `bukuID`) VALUES
(1, 7, 18),
(2, 7, 26),
(3, 7, 12),
(5, 20, 38),
(6, 20, 39),
(7, 20, 8),
(8, 20, 7),
(9, 20, 32),
(10, 18, 42),
(13, 20, 43),
(14, 20, 18);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjamanID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bukuID` int(11) DEFAULT NULL,
  `tanggalPeminjaman` date DEFAULT NULL,
  `tanggalPengembalian` date DEFAULT NULL,
  `statusPeminjaman` varchar(50) DEFAULT NULL,
  `tanggalJatuhTempo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`peminjamanID`, `userID`, `bukuID`, `tanggalPeminjaman`, `tanggalPengembalian`, `statusPeminjaman`, `tanggalJatuhTempo`) VALUES
(3, 13, 7, '2026-04-28', NULL, 'Dibatalkan', NULL),
(6, 7, 8, '2026-04-28', '2026-04-29', 'Dikembalikan', NULL),
(7, 13, 26, '2026-04-29', NULL, 'Ditolak', NULL),
(9, 13, 26, '2026-04-29', NULL, 'Dibatalkan', NULL),
(10, 13, 9, '2026-04-29', '2026-05-18', 'Dikembalikan', NULL),
(11, 18, 22, '2026-04-29', NULL, 'Pengembalian Diajukan', NULL),
(12, 7, 16, '2026-04-29', '2026-04-29', 'Dikembalikan', NULL),
(13, 20, 13, '2026-04-29', '2026-05-02', 'Dikembalikan', NULL),
(14, 13, 37, '2026-05-13', '2026-05-18', 'Dikembalikan', NULL),
(15, 20, 38, '2026-05-10', '2026-05-18', 'Dikembalikan', NULL),
(16, 20, 30, '2026-05-10', '2026-05-19', 'Dikembalikan', '2026-05-17'),
(17, 20, 43, '2026-05-14', '2026-06-09', 'Dikembalikan', '2026-05-21'),
(18, 20, 40, '2026-06-09', '2026-06-09', 'Dikembalikan', '2026-06-16'),
(19, 20, 46, '2026-06-09', NULL, 'Dibatalkan', '2026-06-16'),
(20, 20, 31, '2026-06-01', '2026-06-09', 'Dikembalikan', '2026-06-08'),
(21, 20, 45, '2026-06-10', NULL, 'Dipinjam', '2026-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `ulasanID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bukuID` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`ulasanID`, `userID`, `bukuID`, `ulasan`, `rating`) VALUES
(2, 7, 8, 'alur nya ga ketebak, dan pas terbongkar tuh mind blowing banget', 5),
(3, 13, 9, 'absolute cinema cik', 5),
(4, 13, 28, 'BUKU APA INI...', 2),
(5, 18, 20, 'novel ini kek ngegambarin dunia dari pov anak kecil', 4),
(6, 7, 16, 'batman nya jauh lebih brutal, keren bgt', 4),
(7, 13, 29, 'buku overrated, anak sd mana yg gini', 2),
(8, 18, 11, 'pembahasannya menarik bgt, memberi wawasan tentang kondisi alam di hutan amazon', 4),
(9, 20, 13, 'mindblowing bgt kasus nya', 4),
(10, 20, 38, 'ini lanjutan dari seri kamen rider double, bikin nostalgia bgt', 4),
(13, 18, 22, 'harimaw harimaw,\r\nharimau melaya', 3),
(15, 7, 18, 'situasi di novelnya mirip\" kaya di konoha', 4),
(16, 20, 8, 'ceritanya disturbing bgt, sampe merinding', 4),
(17, 18, 9, 'shinji ngeselin bgt...', 4),
(18, 18, 8, 'egiluy', 4),
(20, 20, 28, 'kisah si gemoy', 1),
(21, 20, 40, 'a bo\'oh o\' wotah', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `role` enum('Admin','Petugas','Peminjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `foto`, `username`, `password`, `email`, `no_hp`, `nama`, `alamat`, `role`) VALUES
(4, '1777392138.png', 'ianstar', '12345678', 'ianianian@gmail.com', '0821 5064 5466', 'Ian', 'Jalan Jalan', 'Admin'),
(7, '1777224350.png', 'miawmiaw', 'adriannor', 'miawmiaw@gmail.com', '0811 2026 6767', 'Vava', 'Jl. Kicaw', 'Peminjam'),
(13, '1777438806.png', 'fufufafa', 'fafafufu', 'fufufafa@gmail.com', '0892 9230 0234', 'Rakagooning Raka', 'Jl. Tikus', 'Peminjam'),
(18, '1778030239.png', 'nanonano', 'sixseven', 'BapaRamore@gmail.com', '0820 0820 0820', 'Pak Ramore', 'Jalan Raya', 'Peminjam'),
(19, '1778029624.jpg', 'MusangKing', 'wantutri', 'hitammanis@gmail.com', '0812 5522 2242', 'Tok D. Alang', 'Kampung Durian Runtuh', 'Petugas'),
(20, '1777464513.jpg', '10969adrian', 'acumalaka', 'buahahaha@gmail.com', '0821 5064 5466', 'Adrian', 'Jl. Raya', 'Peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`bukuID`),
  ADD KEY `fk_kategori` (`kategoriID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`koleksiID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjamanID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`ulasanID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `bukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `koleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `ulasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`);

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
