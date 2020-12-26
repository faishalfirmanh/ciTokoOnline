-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 02:06 AM
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

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang1`
--

CREATE TABLE `keranjang1` (
  `id` int(11) NOT NULL,
  `idPel` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `buktiTransver` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang1`
--

INSERT INTO `keranjang1` (`id`, `idPel`, `idProd`, `jumlah`, `buktiTransver`) VALUES
(64, 9, 16, 2, '25.png'),
(65, 9, 17, 2, '26.png'),
(68, 9, 15, 2, '29.png'),
(79, 9, 16, 3, NULL),
(97, 9, 18, 1, 'speaker23.jpg');

--
-- Triggers `keranjang1`
--
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `birthDate`, `age`) VALUES
(10, 'cok', 'cok', '2020-11-11', 23),
(11, 'gagal', 'gagal', NULL, 16),
(12, 'ppkkkkk', 'kkkkkkkk', NULL, 11),
(13, 'MBER', 'MBER', NULL, 19),
(14, 'indah', 'indah', NULL, 30),
(15, 'HHHH', 'HHHHH', '2020-11-03', 11),
(16, 'lj', 'lj', NULL, 19),
(17, 'roy', 'roy', '2020-11-04', 12);

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
  `id` int(11) NOT NULL,
  `idKeranjang` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tanggalPesan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order1`
--

INSERT INTO `order1` (`id`, `idKeranjang`, `status`, `tanggalPesan`) VALUES
(7, 64, 'ditrima', '2020-12-07'),
(8, 65, 'ditrima', '2020-12-07'),
(9, 68, 'ditrima', '2020-12-07'),
(10, 97, 'ditrima', '2020-12-07');

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
(1, 'aw', 'lllll', 'aw', '2020-12-12'),
(2, 'kadal', 'kadal', 'kadal', '2020-12-12'),
(3, 'cok', 'COK', 'COK', '2020-12-01'),
(4, 'coba', 'malang', 'coba', '2020-12-01'),
(5, 'dino', 'dino', 'dino', '2020-12-01'),
(6, 'kiki', 'surabaya', 'kiki', '2020-12-02'),
(7, 'luluk', 'malang', 'luluk', '2020-12-02'),
(8, 'dewa', 'lowokwaru', 'dewa', '2020-12-02'),
(9, 'kamis', 'tangerang', 'kamis', '2020-12-03');

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

--
-- Dumping data for table `produk1`
--

INSERT INTO `produk1` (`id`, `idPengguna`, `nama`, `foto`, `kategori`, `harga`, `stok`) VALUES
(15, 2, 'kacang mente r 50', '2.png', 'makanan', 11500, 198),
(16, 4, 'kipas', 'kipas.jpg', 'elektronik', 120000, 16),
(17, 4, 'sabun lifeboy', 'life.jpg', 'alat mandi', 12, 196),
(18, 4, 'ninja 250', 'ninja.jpg', 'sepeda motor', 75000000, 49),
(19, 4, 'sikat', 'sikat.jpg', 'alat mandi', 12000, 50),
(20, 9, 'hp sony az', 'hp.jpg', 'elektronik', 1500000, 20),
(21, 2, 'kosong', '', 'kosong', 20000, 21),
(22, 2, 'kacamata google', '', 'optik', 120000, 20),
(23, 9, 'dukati veron', 'dukati.jpg', 'mobil', 1000000000, 9);

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
-- Indexes for table `keranjang1`
--
ALTER TABLE `keranjang1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order1`
--
ALTER TABLE `order1`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`,`memberId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang1`
--
ALTER TABLE `keranjang1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order1`
--
ALTER TABLE `order1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengguna1`
--
ALTER TABLE `pengguna1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk1`
--
ALTER TABLE `produk1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
