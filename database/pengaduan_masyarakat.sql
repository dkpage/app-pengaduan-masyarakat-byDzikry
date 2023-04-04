-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2023 pada 17.42
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk-ahya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(11) NOT NULL,
  `nama_app` varchar(255) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `versi` varchar(100) NOT NULL,
  `developer` varchar(255) NOT NULL,
  `logo` enum('0','1') NOT NULL,
  `logo_custom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_app`, `singkatan`, `versi`, `developer`, `logo`, `logo_custom`) VALUES
(1, 'Sistem Informasi Pengaduan Layanan Kependudukan dan Catatan Sipil', 'SIMPEN-DUKCAPIL', '1.0', '', '', 'SIMPEN-DUKCAPIL1678794410.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `nama_instansi` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo_instansi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`nama_instansi`, `alamat`, `no_telp`, `email`, `website`, `logo_instansi`) VALUES
('Dinas Kependudukan dan Catatan Sipil Kabupaten Cianjur', 'Jl. Raya Bandung No.KM 4.5, Bojong, Kec. Karangtengah, Kabupaten Cianjur, Jawa Barat 43281', '085794984921', 'pengaduan@disdukcapil.cianjurkab.go.id', 'https://disdukcapil.cianjurkab.go.id', 'Dinas Kependudukan dan Catatan Sipil Kabupaten Cianjur1678799421.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(20, 'Pembuatan Dokumen Baru'),
(21, 'NIK Belum Online'),
(22, 'NIK/Nama Berbeda pada KTP dan KK atau AKTE'),
(23, 'NIK Teridentifikasi a.n. Orang lain'),
(24, 'Permohonan Informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('aktif','nonaktif','pending','ditolak') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id`, `nik`, `nama`, `username`, `password`, `telp`, `foto`, `status`, `timestamp`) VALUES
(8, '3203080402010001', 'Kirana Alfaini', 'kirana', '658dfb2e6ee50764cb656837f180e5c4', '085832459234', '', 'aktif', '2023-03-14 14:19:53'),
(9, '320301230000002', 'Asep Maulana', 'Asep', '081e127fe622361157d47abcf49ffce5', '085832459234', '', 'aktif', '2023-03-14 14:41:24'),
(10, '3203030405450002', 'suparman', 'suparman', 'b83b5b75eaa28e0100a66ebee52e1812', '085911354795', '', 'aktif', '2023-03-14 14:43:07'),
(11, '3203040506070004', 'Dela', 'Dela', 'a09b2efdc8ce2e9b6c450a7d386b9d24', '08591468797', '', 'aktif', '2023-03-14 14:54:48'),
(12, '3203067809760006', 'salsabila', 'salsabila', 'fe1e33bb1f71656d0d06d68e0dd2f8f0', '087766543389', '', 'aktif', '2023-03-14 14:56:14'),
(13, '32030678956200', 'salawalia', 'salawalia', '8d41e199d57b9bd6d6c8abe72a64e04e', '08591157098', '', 'aktif', '2023-03-14 14:57:12'),
(14, '320876543098007', 'leni ', 'leni ', '7c0445d1f01957a22437774c720f2662', '085768934679', '', 'aktif', '2023-03-14 14:58:04'),
(15, '3203056785439080', 'juliani', 'juliani', '9528920573c2ed9a4c45e574ebe71e3a', '08679865334', '', 'aktif', '2023-03-14 14:58:58'),
(16, '3203014567900', 'lastri', 'lastri', '707bedd98d8abd4346de94fffa35b5c5', '087642629631', '', 'aktif', '2023-03-14 14:59:49'),
(17, '320849687008765', 'Nurhayati', 'Nurhayati', 'b968336ce52c92506419fb6218b8a8c9', '08575432189', '', 'aktif', '2023-03-14 15:00:57'),
(18, '3203044556678900', 'Cahyani', 'Cahyani', '8f07e2d5246833dd333b3652e50c3d55', '08887654354', '', 'aktif', '2023-03-14 15:02:04'),
(19, '3203067891234560', 'seni', 'seni', '7906899a18b96a3f8142fa93a0da4e74', '08654321985', '', 'aktif', '2023-03-14 15:03:02'),
(20, '3203056745600056', 'Ratna', 'Ratna', '833f4fe6eb92c73aa10c902632371eb4', '086543212435', '', 'aktif', '2023-03-14 15:03:57'),
(21, '3203078965412300', 'Sari', 'Sari', '1e23d65ea6ed92625db3162f615b2ca8', '087765432987', '', 'aktif', '2023-03-14 15:04:47'),
(22, '3203065467889008', 'Lukman', 'Lukman', 'd1d1c2cc2c441f956cf54b201a536425', '087756432167', '', 'aktif', '2023-03-14 15:05:45'),
(23, '3203034167890006', 'Sardi', 'Sardi', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'aktif', '2023-03-14 15:06:29'),
(24, '320307654800670', 'sardi', 'sardi', '04fa8fa4a83332800fec174cc0928521', '0877654321234', '', 'aktif', '2023-03-14 15:07:12'),
(25, '3203066785643898', 'Wijayanto', 'Wijayanto', 'a8a1f6df2fa895319925ae9f780a9174', '087667543212', '', 'aktif', '2023-03-14 15:08:05'),
(26, '320300567890008', 'Yadi', 'Yadi', 'fbbdada0edf58cff0569961dd8686f83', '087776541234', '', 'aktif', '2023-03-14 15:09:27'),
(27, '3203067865430076', 'Hadiman', 'Hadiman', 'e828fdef8d0491992b33b90bb1149568', '085714537589', '', 'aktif', '2023-03-14 15:11:19'),
(28, '3203076543987654', 'Deky', 'Deky', '412a04392373a4902bca927e0ac8c55b', '05754326789', '', 'aktif', '2023-03-14 15:12:08'),
(29, '3203009876540003', 'Taufik', 'Taufik', '1484d6b47b5990d7c5b75a122cc44022', '086965423467', '', 'aktif', '2023-03-14 15:13:00'),
(30, '3203056754299009', 'Agus', 'Agus', 'b42935f6ae1e4c4190b6457f11496645', '087665432210', '', 'aktif', '2023-03-14 15:13:56'),
(31, '3203087654300167', 'fiki', 'fiki', 'c25c073370ab7ccb2cc1b665193c06a0', '08765423897', '', 'aktif', '2023-03-14 16:01:48'),
(32, '32030749586909', 'maulana', 'maulana', 'aff4b352312d5569903d88e0e68d3fbb', '087654321908', '', 'aktif', '2023-03-14 16:02:48'),
(33, '3203004859008', 'Risman', 'Risman', 'dc613986143c7bcf7601ca854180e3b0', '087657888990', '', 'aktif', '2023-03-14 16:03:37'),
(34, '320304455678909', 'jaun', 'jaun', '42d6174fddbf1ff96b645cd7a8f6d270', '085765432798', '', 'aktif', '2023-03-14 16:04:19'),
(35, '3203099887760001', 'mamad', 'mamad', 'adbbc2fab9fc98641cdc502e091c15c7', '085832459234', '', 'aktif', '2023-03-14 16:05:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `nik` char(16) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('0','proses','selesai','') NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`, `judul`, `kategori`, `timestamp`) VALUES
(42, '2023-03-14', '3203080402010001', 'Saat saya mendaftar di ereg.pajak.go.id, NIK yang saya masukkan tidak dapat digunakan, berikut datanya :\r\nNIK : 3203087312990002\r\nNama : Kirana Alfaini\r\nAlamat : Kp. Cibalagung RT 02 RW 02 Desa Kademangan Kec. Mande', 'LAP1678804546.png', 'selesai', 'NIK tidak terbaca saat mendaftar NPWP', 'NIK Belum Online', '2023-03-14 14:52:55'),
(43, '2023-03-14', '3203030405450002', 'nama ktp tidak sesuai dengan AKTE', 'LAP1678805388.jpg', 'selesai', 'nama di ktp beda', 'NIK/Nama Berbeda pada KTP dan KK atau AKTE', '2023-03-14 14:52:33'),
(44, '2023-03-19', '320301230000002', 'tanggal lahir beda dengan KK ', 'LAP1678805504.jpg', 'selesai', 'tangal lahir tudak sesuai', 'NIK/Nama Berbeda pada KTP dan KK atau AKTE', '2023-03-14 14:53:15'),
(45, '2023-02-19', '3203030405450002', 'ktp hilang ', 'LAP1678806931.jpg', 'selesai', 'ktp hilang', 'Permohonan Informasi', '2023-03-14 15:57:00'),
(46, '2023-03-15', '3203040506070004', 'ktp belum bisa digunakan', 'LAP1678807271.jpg', 'selesai', 'ktp sayanbelum bisa digunakan', 'NIK Belum Online', '2023-03-14 15:57:20'),
(47, '2023-03-15', '3203067809760006', 'ktp saya yang disalah gunakan', 'LAP1678807427.jpg', 'selesai', 'penyalah gunaan ktp', 'NIK Teridentifikasi a.n. Orang lain', '2023-03-14 15:57:54'),
(48, '2023-03-15', '3203014567900', 'pembuatan kartu keluarga baru', 'LAP1678807881.jpeg', 'selesai', 'saya mau bikin kartu keluarga baru', 'Pembuatan Dokumen Baru', '2023-03-14 15:58:04'),
(49, '2023-03-16', '3203056785439080', 'PEMBUATAN AKTE LAHIR', 'LAP1678807998.jpg', 'selesai', 'pembuatan AKTE', 'Pembuatan Dokumen Baru', '2023-03-14 15:58:14'),
(50, '2023-03-16', '320849687008765', 'pembuatan ktp online', 'LAP1678808217.jpg', 'selesai', 'pembutan ktp ', 'Pembuatan Dokumen Baru', '2023-03-14 15:58:28'),
(51, '2023-03-01', '3203044556678900', 'ktp yang ruksak karna terlintas kereta api', 'LAP1678808320.jpg', 'selesai', 'keruksakan ktp', 'Permohonan Informasi', '2023-03-14 15:58:38'),
(52, '2023-03-01', '3203067891234560', 'penmabahan jumlah anak dalam Kk', 'LAP1678808442.jpg', 'selesai', 'penambahn jumlah anak di KK', 'Pembuatan Dokumen Baru', '2023-03-14 15:58:54'),
(53, '2023-03-02', '3203056745600056', 'pembuatan kartu keluarga baru', 'LAP1678808508.jpg', '0', 'pembuatan KK baru', 'Pembuatan Dokumen Baru', '2023-03-14 15:41:47'),
(54, '2023-03-02', '3203078965412300', 'tanggal lahir tidak sesuai', 'LAP1678808596.jpg', '0', 'tanggal lahir salah ', 'NIK/Nama Berbeda pada KTP dan KK atau AKTE', '2023-03-14 15:43:15'),
(55, '2023-03-03', '3203065467889008', 'no nik yang belum online dan vbelum bisa digunakan', 'LAP1678808702.jpg', 'selesai', 'kk belum bisa diakses', 'NIK Belum Online', '2023-03-14 16:00:07'),
(56, '2023-03-03', '320307654800670', 'tanggal lahir tidak sesuai dengan KK dan AKTE', 'LAP1678808801.jpg', 'selesai', 'tanggal lahir di akte tidak sesuai ', 'NIK/Nama Berbeda pada KTP dan KK atau AKTE', '2023-03-14 16:00:21'),
(57, '2023-03-04', '3203066785643898', 'merubah alamat domisili', 'LAP1678808879.jpg', 'selesai', 'perubahan data', 'Pembuatan Dokumen Baru', '2023-03-14 15:59:56'),
(58, '2023-03-04', '320300567890008', 'nama tidak sesuai dengan ijazah/lapor', 'LAP1678808963.jpg', 'selesai', 'perubahan data', 'Pembuatan Dokumen Baru', '2023-03-14 15:59:47'),
(59, '2023-03-05', '3203067865430076', 'penambahan angggota keluarga baru', 'LAP1678809039.jpg', 'selesai', 'penambahn anggota keluarga', 'Pembuatan Dokumen Baru', '2023-03-14 15:59:33'),
(60, '2023-03-05', '3203076543987654', 'pindahan', 'LAP1678809215.jpg', 'selesai', 'pindah', 'Pembuatan Dokumen Baru', '2023-03-14 15:59:18'),
(61, '2023-03-06', '3203009876540003', 'pembuatan kartu indonesia sehat', 'LAP1678809299.jpg', 'selesai', 'pembuatan kartu indonesia sehat', 'Pembuatan Dokumen Baru', '2023-03-14 15:59:06'),
(62, '2023-03-08', '3203056754299009', 'nik tidak muncul', 'LAP1678809371.jpg', 'selesai', 'NIK tidak terbaca saat mendaftar NPWP', 'Pembuatan Dokumen Baru', '2023-03-14 16:00:47'),
(63, '2023-03-14', '320301230000002', 'data tidak ditemukan', '', '0', 'Data tidak dapat ditemukan', 'Permohonan Informasi', '2023-03-14 16:24:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `level` enum('admin','petugas','','') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`, `foto`) VALUES
(1, 'Ahya Awal', 'admin', '21232f297a57a5a743894a0e4a801fc3', '0858773239892', 'admin', 'PTGS-SIPELAPMAS-1678810369.jpeg'),
(10, 'Rangga Fahlevi', 'rangga', '863c2a4b6bff5e22294081e376fc1f51', '087892350123', 'petugas', ''),
(11, 'Dandy Kusnadi', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', '087876654433', 'admin', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `tgl_tanggapan` datetime NOT NULL,
  `tanggapan` text NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(12, 43, '2023-03-14 21:52:33', 'baik', 1),
(13, 42, '2023-03-14 21:52:55', 'baik kami proses ya kak', 1),
(14, 44, '2023-03-14 21:53:15', 'baik kami proses pengajuannya', 1),
(15, 45, '2023-03-14 22:57:00', 'baik', 1),
(16, 46, '2023-03-14 22:57:20', 'segera kami tanngani', 1),
(17, 47, '2023-03-14 22:57:54', 'segera kami tangani secepatnya', 1),
(18, 48, '2023-03-14 22:58:04', 'segera kami tangani secepatnya', 1),
(19, 49, '2023-03-14 22:58:14', 'segera kami tangani secepatnya', 1),
(20, 50, '2023-03-14 22:58:28', 'segera kami tangani secepatnya', 1),
(21, 51, '2023-03-14 22:58:38', 'segera kami tangani secepatnya', 1),
(22, 52, '2023-03-14 22:58:54', 'segera kami tangani secepatnya', 1),
(23, 61, '2023-03-14 22:59:06', 'segera kami tangani secepatnya', 1),
(24, 60, '2023-03-14 22:59:18', 'segera kami tangani secepatnya', 1),
(25, 60, '2023-03-14 22:59:20', 'segera kami tangani secepatnya', 1),
(26, 60, '2023-03-14 22:59:24', 'segera kami tangani secepatnya', 1),
(27, 59, '2023-03-14 22:59:33', 'segera kami tangani secepatnya', 1),
(28, 58, '2023-03-14 22:59:47', 'segera kami tangani secepatnya', 1),
(29, 57, '2023-03-14 22:59:56', 'segera kami tangani secepatnya', 1),
(30, 55, '2023-03-14 23:00:07', 'segera kami tangani secepatnya', 1),
(31, 56, '2023-03-14 23:00:21', 'segera kami tangani secepatnya', 1),
(32, 62, '2023-03-14 23:00:47', 'segera kami tangani secepatnya', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `masyarakat` (`nik`);

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
