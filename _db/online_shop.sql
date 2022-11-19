-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2022 pada 06.28
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `createdAt`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-09-23 23:08:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_cart`
--

INSERT INTO `tb_cart` (`id_cart`, `id_produk`, `id_user`, `quantity`, `total_price`) VALUES
(1, 203900101, 102309001, 2, '7000'),
(2, 203900120, 102309001, 3, '15000'),
(3, 203900119, 102309001, 1, '120000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `categoryName`, `createAt`) VALUES
(1001, 'Food / Drink', '2022-09-23 22:52:19'),
(1002, 'Electronics', '2022-09-24 17:29:48'),
(1003, 'Clothing', '2022-09-24 17:29:56'),
(1006, 'Furniture', '2022-09-24 18:44:00'),
(1008, 'Gaming', '2022-09-27 23:08:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_orders`
--

CREATE TABLE `tb_orders` (
  `id_orders` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `noTelp` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `items` varchar(1000) NOT NULL,
  `total_produk` varchar(100) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_orders`
--

INSERT INTO `tb_orders` (`id_orders`, `id_seller`, `id_user`, `username`, `noTelp`, `address`, `items`, `total_produk`, `total_price`, `order_date`, `payment_status`) VALUES
(5, 202309003, 102309001, 'Dayat', '158015', 'Jl. Antang raya, Asindo Blok G2/2', 'Television (5000000 x 1)/', '2', '5000000', '2022-10-08 07:01:49', 'completed'),
(6, 202309008, 102309001, 'Robert', '123456', 'Jl. Perumnas Antang Blok 2', 'Head Charger (30000 x 1)/Kemeja Flannel (125000 x 1)/', '3', '155000', '2022-10-08 07:21:30', 'completed'),
(7, 202309001, 102309001, 'Diah', '0821895750000', 'Jl. Perumnas Antang Blok 2', 'Milku (3500 x 6)/', '2', '21000', '2022-10-08 07:27:48', 'completed'),
(8, 202309001, 102309001, 'Diah', '0821895750000', 'Jl. Perumnas Antang Blok 2', 'Kemeja Flannel (125000 x 1)/Celana Cargos (90000 x 2)/Hoodie (80000 x 1)/', '4', '385000', '2022-10-08 07:57:37', 'completed'),
(15, 202309001, 102309002, 'Hidayat', '0821895750002', '95th El-Corona street', 'Television (5000000 x 1)/Sofa (80000 x 1)/Kursi Gaming (1200000 x 1)/Laptop Asus  (15000000 x 1)/', '5', '21280000', '2022-10-09 14:50:48', 'completed'),
(16, 202309001, 102309001, 'Johan', '0812345678910', 'Antang Street, Complex Asindo G2/2', 'Milku (3500 x 2)/Head Charger (30000 x 1)/', '3', '37000', '2022-10-21 14:13:31', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_seller`, `id_category`, `name`, `description`, `price`, `image`, `status`, `createAt`) VALUES
(203900101, 202309001, 1001, 'Milku', '<ol>\r\n	<li><s>Milku Coklat</s><br />\r\n	Ndak enak biasaaa jhi rasana</li>\r\n	<li><strong>Milku STROWBERRY</strong><br />\r\n	Lebih enak dan enak dan enak</li>\r\n</ol>\r\n', '3500', 'product1664089379.jpg', 1, '2022-09-23 22:49:30'),
(203900107, 202309001, 1003, 'Hoodie', 'Barang rusak', '80000', 'product1664016634.jpg', 1, '2022-09-24 18:50:34'),
(203900108, 202309001, 1003, 'Celana Cargos', 'Mantap', '90000', 'product1664016816.png', 1, '2022-09-24 18:53:36'),
(203900110, 202309001, 1003, 'Kemeja Flannel', 'Bagus', '125000', 'product1664065707.png', 1, '2022-09-25 08:28:27'),
(203900114, 202309008, 1002, 'Head Charger', '<p>Bagus</p>\r\n', '30000', 'product1664291431.jpg', 1, '2022-09-27 23:10:31'),
(203900115, 202309008, 1008, 'Laptop Asus ', '<p>Bagus</p>\r\n', '15000000', 'product1664291478.png', 1, '2022-09-27 23:11:18'),
(203900117, 202309001, 1002, 'Television', '<p>KKkKk</p>\r\n', '5000000', 'product1664454456.png', 1, '2022-09-29 19:18:27'),
(203900118, 202309001, 1006, 'Sofa', '<p><em><strong>Sofa bagus</strong></em></p>\r\n\r\n<p>&nbsp;</p>\r\n', '80000', 'product1665234335.png', 1, '2022-10-08 21:05:35'),
(203900119, 202309001, 1006, 'Lemari', '<h1>Fitur</h1>\r\n\r\n<ul>\r\n	<li>Lemari</li>\r\n	<li>Bagus</li>\r\n	<li>Mantap</li>\r\n</ul>\r\n', '120000', 'product1665234493.png', 1, '2022-10-08 21:06:52'),
(203900120, 202309001, 1001, 'Cheetos Crunchy', '<p>ENAK</p>\r\n', '5000', 'product1665234790.png', 1, '2022-10-08 21:13:10'),
(203900121, 202309008, 1008, 'Kursi Gaming', '<p>Buat vtuber c</p>\r\n', '1200000', 'product1665234864.png', 1, '2022-10-08 21:14:24'),
(203900122, 202309008, 1002, 'Kipas Angin', '<p>3watt</p>\r\n', '150000', 'product1665235001.png', 1, '2022-10-08 21:16:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rating`
--

CREATE TABLE `tb_rating` (
  `id_rating` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` float NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rating`
--

INSERT INTO `tb_rating` (`id_rating`, `id_produk`, `id_user`, `rating`, `comment`) VALUES
(8, 203900121, 102309001, 5, 'Nyaman betul'),
(14, 203900120, 102309001, 2.5, 'test'),
(15, 203900122, 102309001, 5, 'Bagus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_seller`
--

CREATE TABLE `tb_seller` (
  `id_seller` int(11) NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `noTelp` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_seller`
--

INSERT INTO `tb_seller` (`id_seller`, `companyName`, `username`, `password`, `noTelp`, `status`, `createdAt`) VALUES
(202309001, 'FirstSeller', 'seller', '64c9ac2bb5fe46c3ac32844bb97be6bc', '62895803273374', 1, '2022-09-23 22:46:55'),
(202309008, 'SpaceX', 'elon', '20f0c1df4b5003502b57619fee44b169', '123456', 1, '2022-09-27 20:13:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `noTelp` varchar(50) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email`, `username`, `password`, `address`, `noTelp`, `createdAt`) VALUES
(102309001, 'user@gmail.com', 'Johan', 'ee11cbb19052e40b07aac0ca060c23ee', 'Antang Street, Complex Asindo G2/2', '0812345678910', '2022-09-23 22:46:14'),
(102309002, 'dyt@gmail.com', 'Hidayat', '202cb962ac59075b964b07152d234b70', '95th El-Corona street', '0821895750002', '2022-10-09 14:32:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `id_seller` (`id_seller`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_seller` (`id_seller`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeks untuk tabel `tb_rating`
--
ALTER TABLE `tb_rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_seller`
--
ALTER TABLE `tb_seller`
  ADD PRIMARY KEY (`id_seller`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203900123;

--
-- AUTO_INCREMENT untuk tabel `tb_rating`
--
ALTER TABLE `tb_rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_seller`
--
ALTER TABLE `tb_seller`
  MODIFY `id_seller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202309009;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102309010;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD CONSTRAINT `tb_cart_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`),
  ADD CONSTRAINT `tb_cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD CONSTRAINT `tb_orders_ibfk_1` FOREIGN KEY (`id_seller`) REFERENCES `tb_seller` (`id_seller`),
  ADD CONSTRAINT `tb_orders_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_seller`) REFERENCES `tb_seller` (`id_seller`),
  ADD CONSTRAINT `tb_produk_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `tb_category` (`id_category`);

--
-- Ketidakleluasaan untuk tabel `tb_rating`
--
ALTER TABLE `tb_rating`
  ADD CONSTRAINT `tb_rating_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`),
  ADD CONSTRAINT `tb_rating_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
