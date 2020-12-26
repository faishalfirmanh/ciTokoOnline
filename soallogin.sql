-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 10:05 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soallogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.employee: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`employee`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `fuu`
--

CREATE TABLE `fuu` (
  `idOr` int(11) NOT NULL,
  `idKeranjang` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggalPesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuu`
--

INSERT INTO `fuu` (`idOr`, `idKeranjang`, `status`, `tanggalPesan`) VALUES
(18, 124, 'ditrima fuuu', '2020-12-25'),
(19, 125, 'ditrima fuuu', '2020-12-25'),
(20, 126, 'ditrima fuuu', '2020-12-25'),
(21, 127, 'ditrima fuuu', '2020-12-25'),
(22, 128, 'ditrima fuuu', '2020-12-25'),
(23, 129, 'ditrima fuuu', '2020-12-25'),
(24, 130, 'ditrima fuuu', '2020-12-25'),
(25, 131, 'ditrima fuuu', '2020-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang1`
--

CREATE TABLE `keranjang1` (
  `id` int(11) NOT NULL,
  `idPel` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `buktiTransver` varchar(255) DEFAULT NULL,
  `keberhasilanJual` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.keranjang1: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`keranjang1`' at line 1

--
-- Triggers `keranjang1`
--
DELIMITER $$
CREATE TRIGGER `fuu` AFTER INSERT ON `keranjang1` FOR EACH ROW BEGIN
    IF NEW.buktiTransver IS NOT NULL  THEN
        INSERT INTO fuu(idKeranjang, status, tanggalPesan)
        VALUES(new.id,'ditrima fuuu',now());
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertOrder` AFTER INSERT ON `keranjang1` FOR EACH ROW BEGIN
    IF NEW.buktiTransver IS NOT NULL  THEN
        INSERT INTO order1(idKeranjang, status, tanggalPesan)
        VALUES(new.id,'ditrima',now());
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangiStokProduk` AFTER INSERT ON `keranjang1` FOR EACH ROW BEGIN
IF NEW.buktiTransver IS NOT NULL THEN
UPDATE produk1 SET stok = stok-NEW.jumlah
WHERE id = NEW.idProd;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keuntungan1`
--

CREATE TABLE `keuntungan1` (
  `idlaba` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.keuntungan1: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`keuntungan1`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.members: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`members`' at line 1

--
-- Triggers `members`
--
DELIMITER $$
CREATE TRIGGER `after_members_insert` AFTER INSERT ON `members` FOR EACH ROW BEGIN
    IF NEW.birthDate IS NULL && NEW.age >=18 THEN
        INSERT INTO reminders(memberId, message, pesan)
        VALUES(new.id,CONCAT('Hi ', NEW.name, ', please update your date of birth.'),'gk boleh mbf');
      ELSE
      	INSERT INTO reminders(memberId,pesan)
        VALUES(new.id,' Anak Baik Cok ');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order1`
--

CREATE TABLE `order1` (
  `idOr` int(11) NOT NULL,
  `idKeranjang` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tanggalPesan` date NOT NULL DEFAULT current_timestamp(),
  `dikirimDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order1`
--

INSERT INTO `order1` (`idOr`, `idKeranjang`, `status`, `tanggalPesan`, `dikirimDate`) VALUES
(36, 124, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(37, 125, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(38, 126, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(39, 127, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(40, 128, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(41, 129, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(42, 130, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25'),
(43, 131, 'pesanan_sudah_sampe_pelanggan', '2020-12-25', '2020-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna1`
--

CREATE TABLE `pengguna1` (
  `id` int(11) NOT NULL,
  `namaUser` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna1`
--

INSERT INTO `pengguna1` (`id`, `namaUser`, `alamat`, `password`, `created`) VALUES
(1, 'aw', 'lllll', 'aw', '2020-08-12'),
(2, 'kadal', 'kadal', 'kadal', '2020-12-21'),
(3, 'cok', 'COK', 'COK', '2020-12-01'),
(4, 'coba', 'malang', 'coba', '2020-12-01'),
(5, 'dino', 'dino', 'dino', '2020-12-01'),
(6, 'kiki', 'surabaya', 'kiki', '2020-12-02'),
(7, 'luluk', 'malang', 'luluk', '2020-12-02'),
(8, 'dewa', 'lowokwaru', 'dewa', '2020-12-02'),
(9, 'kamis', 'tangerang', 'kamis', '2020-12-03'),
(10, 'nanok', 'mojokerto', 'nanok', '2020-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `produk1`
--

CREATE TABLE `produk1` (
  `id` int(11) NOT NULL,
  `idPengguna` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.produk1: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`produk1`' at line 1

--
-- Triggers `produk1`
--
DELIMITER $$
CREATE TRIGGER `recordHapus` AFTER DELETE ON `produk1` FOR EACH ROW INSERT INTO recordprod1(idrec, idUser, idProd,tanggal)
 VALUES(idrec,old.idPengguna,old.id,now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recordprod1`
--

CREATE TABLE `recordprod1` (
  `idrec` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Error reading data for table soallogin.recordprod1: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `soallogin`.`recordprod1`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `pesan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `memberId`, `message`, `pesan`) VALUES
(6, 13, 'Hi MBER, please update your date of birth.', ''),
(7, 14, 'Hi indah, please update your date of birth.', 'gk boleh mbf'),
(8, 0, '', ' Anak Baik Cok '),
(9, 16, 'Hi lj, please update your date of birth.', 'gk boleh mbf'),
(10, 17, '', ' Anak Baik Cok ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuu`
--
ALTER TABLE `fuu`
  ADD PRIMARY KEY (`idOr`);

--
-- Indexes for table `keranjang1`
--
ALTER TABLE `keranjang1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuntungan1`
--
ALTER TABLE `keuntungan1`
  ADD PRIMARY KEY (`idlaba`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order1`
--
ALTER TABLE `order1`
  ADD PRIMARY KEY (`idOr`);

--
-- Indexes for table `pengguna1`
--
ALTER TABLE `pengguna1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk1`
--
ALTER TABLE `produk1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recordprod1`
--
ALTER TABLE `recordprod1`
  ADD PRIMARY KEY (`idrec`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`,`memberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuu`
--
ALTER TABLE `fuu`
  MODIFY `idOr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `keranjang1`
--
ALTER TABLE `keranjang1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `keuntungan1`
--
ALTER TABLE `keuntungan1`
  MODIFY `idlaba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order1`
--
ALTER TABLE `order1`
  MODIFY `idOr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pengguna1`
--
ALTER TABLE `pengguna1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk1`
--
ALTER TABLE `produk1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `recordprod1`
--
ALTER TABLE `recordprod1`
  MODIFY `idrec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
