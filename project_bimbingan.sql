-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 10:42 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_bimbingan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bimbing`
--

CREATE TABLE IF NOT EXISTS `bimbing` (
  `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT,
  `id_det_bimbingan` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `isi_bimbingan` text NOT NULL,
  `tgl_bimbingan` int(11) NOT NULL,
  PRIMARY KEY (`id_bimbingan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `bimbing`
--

INSERT INTO `bimbing` (`id_bimbingan`, `id_det_bimbingan`, `parent_id`, `username`, `nama`, `isi_bimbingan`, `tgl_bimbingan`) VALUES
(1, 1, 0, 'administrator', 'admin', 'Selamat datang! Silahkan isi kolom dibawah untuk memulai bimbingan!', 1548004815),
(2, 2, 0, 'administrator', 'admin', 'Selamat datang! Silahkan isi kolom dibawah untuk memulai bimbingan!', 1548004824),
(3, 4, 0, 'administrator', 'admin', 'Selamat datang! Silahkan isi kolom dibawah untuk memulai bimbingan!', 1548004833),
(4, 3, 0, 'administrator', 'admin', 'Selamat datang! Silahkan isi kolom dibawah untuk memulai bimbingan!', 1548004839),
(5, 1, 0, 'administrator', 'admin', 'hi', 1548034737),
(6, 1, 5, 'administrator', 'admin', 'iya', 1548034755),
(7, 1, 0, '3102', 'Alia Tri Utami', 'hi', 1548034879),
(8, 1, 7, 'administrator', 'admin', 'ada apa', 1548035079),
(9, 1, 7, 'administrator', 'admin', 'hello', 1548035174),
(10, 1, 8, 'administrator', 'admin', 'hello', 1548035186),
(11, 1, 0, 'odoycan', 'odoy cantik', 'bu saya bingung nih', 1548035421),
(12, 1, 11, 'administrator', 'admin', 'iya bingung kenapa', 1548035466),
(13, 1, 0, '3122', 'Challista Louise Angie Kusuma Asmara Astuti', '1', 1548175761);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bimbingan`
--

CREATE TABLE IF NOT EXISTS `detail_bimbingan` (
  `id_det_bimbingan` int(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_det_bimbingan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `detail_bimbingan`
--

INSERT INTO `detail_bimbingan` (`id_det_bimbingan`, `topik`, `deskripsi`) VALUES
(1, 'Karir\r\n', 'Untuk membantu individu dalam menghadapi dan menyelesaikan masalah yang menyangkut karier tertentu\r\n'),
(2, 'Personal', 'Membantu dalam menghadapi dan menyesuaikan diri dengan hal-hal dalam dirinya\r\n'),
(4, 'Sosial', 'Bertujuan membantu siswa mengatasi kesulitannya dalam bidang sosial.\r\n'),
(3, 'Belajar', 'Untuk mengatasi kesulitan siswa dalam bidang belajar\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `detail_sanksi`
--

CREATE TABLE IF NOT EXISTS `detail_sanksi` (
  `id_det_sanksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_sanksi` int(11) NOT NULL,
  `nis` varchar(7) NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_det_sanksi`),
  KEY `nis` (`nis`),
  KEY `id_sanksi` (`id_sanksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `detail_sanksi`
--

INSERT INTO `detail_sanksi` (`id_det_sanksi`, `id_sanksi`, `nis`, `keterangan`) VALUES
(32, 39, 'odoycan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(7) NOT NULL,
  `pelanggaran` varchar(50) NOT NULL,
  `tipe_pelanggaran` varchar(20) NOT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `poin_pelanggaran` varchar(4) NOT NULL DEFAULT '10',
  `deskripsi` text,
  PRIMARY KEY (`id_pelanggaran`),
  KEY `pelanggaran_ibfk_1` (`nis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `nis`, `pelanggaran`, `tipe_pelanggaran`, `tgl_pelanggaran`, `poin_pelanggaran`, `deskripsi`) VALUES
(20, 'odoycan', 'merusak kursi', 'merusak fasilitas', '2019-01-17', '10', 'y'),
(21, '3109', 'bolos', 'bolos', '2019-01-18', '30', 'bolos kelas '),
(22, '1234', 'bolos', 'bolos', '2019-01-23', '10', 'bolos di jam pelajaran'),
(23, '3122', 'coret-coret tembok', 'merusak fasilitas', '2019-01-10', '30', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `poin_reward`
--

CREATE TABLE IF NOT EXISTS `poin_reward` (
  `id_poin_reward` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(7) NOT NULL,
  `jml_poin_reward` varchar(4) NOT NULL DEFAULT '2',
  `tgl_poin_reward` date NOT NULL,
  `keterangan` text NOT NULL,
  `rank` varchar(10) NOT NULL,
  PRIMARY KEY (`id_poin_reward`),
  KEY `poin_reward_ibfk_1` (`nis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `poin_reward`
--

INSERT INTO `poin_reward` (`id_poin_reward`, `nis`, `jml_poin_reward`, `tgl_poin_reward`, `keterangan`, `rank`) VALUES
(1, 'odoycan', '15', '2019-01-23', '', ''),
(2, '3102', '2', '2019-01-24', '', ''),
(3, '3109', '2', '2019-01-24', '', ''),
(4, '3109', '2', '2019-01-24', '', ''),
(5, '3109', '2', '2019-01-24', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE IF NOT EXISTS `sanksi` (
  `id_sanksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggaran` int(11) NOT NULL,
  `nis` varchar(7) NOT NULL,
  `jenis_hukuman` varchar(30) NOT NULL,
  `tgl_hukuman` date DEFAULT NULL,
  PRIMARY KEY (`id_sanksi`),
  KEY `sanksi_ibfk_2` (`nis`),
  KEY `id_pelanggaran` (`id_pelanggaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`id_sanksi`, `id_pelanggaran`, `nis`, `jenis_hukuman`, `tgl_hukuman`) VALUES
(39, 0, 'odoycan', 'lari lapangan', '2019-01-20');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(7) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `kelas` varchar(8) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama_wali_murid` varchar(50) NOT NULL,
  `email_wali_murid` varchar(50) NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_lengkap`, `kelas`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `email`, `no_hp`, `nama_wali_murid`, `email_wali_murid`) VALUES
('123', 'Budi', '12 IPA 3', 'Jakarta', 'Jakarta', '2019-01-16', 'P', 'Islam', 'john@example.com', '081234567890', 'Adi', 'john@example.com'),
('3102', 'Alia Tri Utami', '12 IPA 1', 'Jl. Ks. Tubun III, No. 8c', 'Jakarta', '2001-05-31', 'P', 'Islam', 'aliatu@gmail.com', '083890907710', 'Sakiman', 'john@example.com'),
('3103', 'Alifia Nurindah Yasmin', '12 IPA 1', 'Jl. Jati Baru II, No. 22', 'Jakarta', '2001-12-12', 'P', 'Islam', '-', '083870271641', 'Andry Firdaus', '-'),
('3109', 'Andi Putri Sintia Dewi Misbahuddin', '12 IPA 1', 'Jl. Anggrek Cendrawasih 8A, No. 33', 'Jakarta', '2001-10-21', 'P', 'Islam', 'andiputrishintia2812@gmail.com', '08129751860', 'Andry Firdaus', 'john@example.com'),
('3122', 'Challista Louise Angie Kusuma Asmara Astuti', '12 IPA 1', 'Jl. Kemanggisan Pulo, No. 90', 'Jakarta', '2001-05-29', 'P', 'Islam', 'challista.angie@gmail.com', '087780887077', 'Iit Wicahyono', 'john@example.com'),
('3133', 'Dicky Ferrari', '12 IPA 1', 'Jl. Kp Pluis. Kec. Kebayoran Lama', 'Kendal', '2001-09-24', 'L', 'Islam', '-', '085813414133', 'Kuswandi', '-'),
('3134', 'Dimas Maulana', '12 IPA 1', 'Jl. H. Pekir I, No. 21', 'Jakarta', '2001-05-23', 'L', 'Islam', 'maulanadimas96@gmail.com', '085692681894', 'Masdi', 'john@example.com'),
('3135', 'Dinar Tsalsabila Febrianty', '12 IPA 1', 'Jl. Ks tubun III Dalam, No.32', 'Jakarta', '2001-02-08', 'P', 'Islam', 'dinar.febrianty@yahoo.com', '081283238094', 'Ahmad Samdani', 'john@example.com'),
('3140', 'Elsa Shafira', '12 IPA 1', 'Jl. Tali II, No. 37', 'Jakarta', '2001-07-15', 'P', 'Islam', 'elsashafira7@gmail.com', '081288297511', 'Erista Mulyadi', 'john@example.com'),
('3143', 'Fajar Mi''raz', '12 IPA 1', 'Jl. Bhakti VII, No. 16', 'Jakarta', '2001-10-23', 'L', 'Islam', 'arazmiraz@ymail.com', '081398704008', 'Amir', '-'),
('3145', 'Febriansyah', '12 IPA 1', 'Jl. Kemanggisan Pulo, No.8', 'Jakarta', '2001-02-26', 'L', 'Islam', '-', '082122686494', 'Tobroy', '-'),
('3148', 'Fira Rahma Dwi Aryani', '12 IPA 1', 'Jl. Ks. Tubun Raya Petamburan, No. 29', 'Jakarta', '2002-01-18', 'P', 'Islam', '-', '089696099158', 'Ridwan', '-'),
('3160', 'Irvani Rizki Tri Wulandari', '12 IPA 1', 'Jl. Olahraga 3, No.12', 'Jakarta', '2001-01-23', 'P', 'Islam', 'irvairizki23@yahoo.co.id', '087789300023', 'Joni Lumaksono', '-'),
('3164', 'Khallifah Mubarak Armando', '12 IPA 1', 'Jl. Kota Bambu Selatan, No. 8', 'Jakarta', '2001-08-12', 'L', 'Islam', '-', '02129401163', 'Rudy Armando', '-'),
('3169', 'Maureen Sabrina Zahira', '12 IPA 1', 'Jl. Ori III, No. 16', 'Jakarta', '2001-03-24', 'P', 'Islam', '-', '081748221994', 'Abdul Rahmat Illahi', '-'),
('3175', 'Moh Adinur Saputra', '12 IPA 1', 'Jl. Kemanggisan Pulo Gg. BB, No. 27', 'Jakarta', '2002-02-18', 'L', 'Islam', 'adinur295@gmail.com', '085882260462', 'Nastain', '-'),
('3179', 'Mohammad Rafli Ravanelli', '12 IPA 1', 'Jl. H, No. 26', 'Jakarta', '2001-01-16', 'L', 'Islam', 'xanarepas@rocketmail.com', '083807411412', 'Iksan', '-'),
('3182', 'Muhamad Supriyanto', '12 IPA 1', 'Jl. Kemanggisan Pulo', 'Jakarta', '2001-04-28', 'L', 'Islam', '-', '08129474273', 'Nardi', '-'),
('3183', 'Muhammad Afif Shiddiq', '12 IPA 1', 'Jl. Aipda Ks. Tubun III, No. 11c', 'Bojonegoro', '2001-03-31', 'L', 'Islam', 'afifshiddiq31@gmail.com', '081312280572', 'Pramono Shiddiq', '-'),
('3187', 'Muhammad Amir Hamzah', '12 IPA 1', 'Jl. Kebon Nanas IV, No. 54', 'Jakarta', '2001-07-26', 'L', 'Islam', '-', '0215348884', 'Sugiharto', '-'),
('3189', 'Muhammad Fadhil Rizkiansyah', '12 IPA 1', 'Jl. Anggrek Cendrawasih, No. 34', 'Jakarta', '2001-07-19', 'L', 'Islam', '-', '085888996661', 'Taufik Qurahman', '-'),
('3190', 'Muhammad Hafizh Al Fatah Imanov', '12 IPA 1', 'Jl. Anggrek Rosliana, No. H. 109', 'Purwokerto', '2001-10-04', 'L', 'Islam', '-', '081807081417', 'Nuzul Iman', '-'),
('3192', 'Muhammad Oksa Alridho', '12 IPA 1', 'Jl. Rawa Bahagia VIII, No. 6', 'Jakarta', '2001-10-07', 'L', 'Islam', '-', '081283714507', 'Zulhendri', '-'),
('3193', 'Muhammad Reynaldi', '12 IPA 1', 'Jl. Pondok Bandung, No.19', 'Jakarta', '2002-01-10', 'L', 'Islam', '-', '081310171222', 'Asrizal', '-'),
('3201', 'Nadiya Rahmadona Yolanda', '12 IPA 1', 'Jl. C1 No. 9', 'Jakarta', '2000-12-22', 'P', 'Islam', '-', '081283638679', 'Yulfison', '-'),
('3205', 'Nida Safira Hasanah', '12 IPA 1', 'Jl. Petamburan V, No.6', 'Jakarta', '2001-05-04', 'P', 'Islam', 'nidaquee40@gmail.com', '081574971825', 'Ahmad Kustaman', '-'),
('3214', 'Putri Amalia Sejati', '12 IPA 1', 'Jl. H. Sabeni, No. 12', 'Jakarta', '2001-02-24', 'P', 'Islam', '-', '08128621516', 'Sarjo', '-'),
('3216', 'Putri Wulandari', '12 IPA 1', 'Jl. Semangka III, No. 29A', 'Jakarta', '2001-11-09', 'P', 'Islam', 'pwulandari9@gmail.com', '083807618040', 'Didi', '-'),
('3218', 'Rachma Dini', '12 IPA 1', 'Jl. Ks. Tubun III 99 O, No. 17b', 'Jakarta', '2002-01-01', 'P', 'Islam', 'rachmadini.88@gmail.com', '089698324546', 'Sulaiman', '-'),
('3221', 'Rahma Dea Salsabilla', '12 IPA 1', 'Jl. Kota Bambu Utara IV, No. 11', 'Jakarta', '2001-06-05', 'P', 'Islam', '-', '081514044433', 'Sukoco', '-'),
('3228', 'Rifa Ammatur Rayhana', '12 IPA 1', 'Jl. H. Pekir I, No,1', 'Jakarta', '2000-11-11', 'P', 'Islam', '-', '-', 'Otay Tarwan', '-'),
('3229', 'Rifqah Nabiilah', '12 IPA 1', 'Jl. Kiwali K83, Komplek Hamkam Slipi', 'Jakarta', '2001-09-23', 'P', 'Islam', '-', '085716255605', 'Sutikno', '-'),
('3248', 'Teguh Gunawan', '12 IPA 1', 'Jl. Manggis II, No. 21', 'Nganjuk', '2001-01-15', 'L', 'Islam', 'kartiniajja88@gmail.com', '081219864980', 'Djoko Kusmanto', '-'),
('3250', 'Tiara Zahra Lisdya', '12 IPA 1', 'Jl. Ks. Tubun III Dalam, No. 39', 'Jakarta', '2001-04-15', 'P', 'Islam', 'tiaraazhr@gmail.com', '083872197262', 'Muhammad Abdillah', '-'),
('3255', 'Widi Humaira Adisti', '12 IPA 1', 'Jl. K, No.1', 'Jakarta', '2001-06-18', 'P', 'Islam', 'adi_indah76@yahoo.com', '085219799837', 'Adi Indah Cahyono', '-'),
('3257', 'Zahra Nafadilla', '12 IPA 1', 'Jl. Kota Bambu Utara, No. 8', 'Jakarta', '2001-05-18', 'P', 'Islam', '-', '081585119651', 'Suardi', '-'),
('3259', 'Zulfi Astri Andini', '12 IPA 1', 'Jl. Ks. Tubun III Asrama Brimob Petamburan, No. 13', 'Jakarta', '2001-07-14', 'P', 'Islam', '-', '087777336601', 'Mustambar', '-'),
('mocha', 'Mocha', '12 IPA 3', 'ciledug', 'new york', '2019-01-17', 'P', '-', 'john@example.com', '085945354254', '-', 'john@example.com'),
('odoycan', 'odoy cantik', '12 IPA 3', 'Tangerang', 'Tangerang', '2018-12-01', 'P', '-', 'odoycantik@gmail.com', '085945354254', '-', 'john@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `level` enum('bk','siswa') NOT NULL DEFAULT 'bk',
  `last_login` datetime NOT NULL,
  `avatar` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `status`, `level`, `last_login`, `avatar`) VALUES
(1, 'Guru BK', 'bk', '$2y$10$B2ztsNPm8JZyGR/E12rRU.itsFuvdnYCsDg/L4SZ.xCx7usFzvXUG', 1, 'bk', '2019-02-01 18:21:06', 0x61646d696e6973747261746f725f32303139303131323135323934302e706e67),
(2, 'odoy cantik', 'odoycan', '$2y$10$c14El4ivrRXfXAyspwbxQOaXu7cX1r3/odhQRIFQSuXg6yfQ6iya2', 1, 'siswa', '2019-01-24 23:01:24', 0x6f646f7963616e5f32303138313231303232343832372e6a7067),
(6, 'Alia Tri Utami ', '3102', '$2y$10$nR2ZlcRhwYmGuVGc4fPywuKU2R/UBdyQv60Uqz/MHlC2Dsjg2srmi', 0, 'siswa', '2019-01-24 19:41:36', 0x333130325f32303138313231303232353730342e6a7067),
(7, 'Alifia Nurindah Yasmin', '3103', '$2y$10$Q8c2VJZQjTU.wZg4Vy.SzOynbJvzu/3JPl.UYCdPD9ZA5uttLQeka', 0, 'siswa', '2019-01-14 13:11:07', 0x333130335f32303139303131343132353330362e706e67),
(8, 'Andi Putri Sintia Dewi Misbahuddin', '3109', '$2y$10$CQvOWZt2hj4ozV.6xdFSLeM2PYw.OBriIXaIAioP.Xs30pNgL3mKC', 0, 'siswa', '2019-01-24 22:25:01', 0x333130395f32303139303132343232323531372e706e67),
(9, 'Challista Louise Angie Kusuma Asmara Astuti', '3122', '$2y$10$5PncFf1wjWknMrUd30LSEecSFWyO4SBpyd7.ACsMlRj886c/rKeVG', 0, 'siswa', '2019-01-22 23:53:06', 0x333132325f32303139303132323233353134392e706e67),
(10, 'Dicky Ferrari', '3133', '$2y$10$cO9g51Tsu5ugoXwzGetRJu5jiJGNKtZDXDICKo9UmPZs6W2TcTOOy', 0, 'siswa', '2019-01-22 23:56:17', ''),
(11, 'Dimas Maulana', '3134', '$2y$10$CudeOrUx8lcO5VSjwMMUR.tA6E/hewpvtRYSVHfDMBuIrYGATuCG6', 0, 'siswa', '0000-00-00 00:00:00', ''),
(12, 'Dinar Tsalsabila Febrianty', '31315', '$2y$10$eCGqyUwnWD4bXa/d0NkNx.zoarVM8VPI29k3pjlnTS.IzuaGx9Lh6', 0, 'siswa', '0000-00-00 00:00:00', ''),
(13, 'Elsa Shafira', '3140', '$2y$10$xkC6.4Tjblx0dr.UNB9ifuUgxjJ22RWNdJEvEAVO.qX/CjdMq44vG', 0, 'siswa', '0000-00-00 00:00:00', ''),
(14, 'Fajar Mi''raz', '3143', '$2y$10$PbFENgdkF.YJzwiwKbLAH.FM.prHP96yP1TgBUQ3FyxSgQprdoIgm', 0, 'siswa', '0000-00-00 00:00:00', ''),
(15, 'Febriansyah', '3145', '$2y$10$obBX7TyE/ESVv.19rZgNEORoHyQqdBXjvX1c0n0l/TVWkyo3/sy.G', 0, 'siswa', '0000-00-00 00:00:00', ''),
(16, 'Fira Rahma Dwi Aryani', '3148', '$2y$10$/HmesNI9KiZ.fF6HrEF7ZOm4XGA5goR.WN/eWPjL8j80QXdjUkN4u', 0, 'siswa', '0000-00-00 00:00:00', ''),
(17, 'Irvani Rizki Tri Wulandari', '3160', '$2y$10$7nO0EDbVFWJmqHXc1FRS9urUJVi1g1DnlhBCG/WYuJevlH7nU5rva', 0, 'siswa', '0000-00-00 00:00:00', ''),
(18, 'Khallifah Mubarak Armando', '3164', '$2y$10$NW6LswfVn1L7DGo1XvZ28eiuYnWw6C9ki3WWNKhLmzFoTm7gsFcfS', 0, 'siswa', '0000-00-00 00:00:00', ''),
(19, 'Maureen Sabrina Zahira', '3169', '$2y$10$clb6wYsTXRKgA66bfY91m.9HYEsBTMipS62QcKnBNytiLtHqQRZWq', 0, 'siswa', '0000-00-00 00:00:00', ''),
(20, 'Moh Adinur Saputra', '3175', '$2y$10$aZ0DRtq76w6wfJH8fBNnqulMFlwXxz3BBFnNFRL2OikBrVyoR/R32', 0, 'siswa', '0000-00-00 00:00:00', ''),
(21, 'Mohammad Rafli Ravanelli', '3179', '$2y$10$k.vuxiRG/aHQisq5.483F.hU.1fUlmVdOMT.CF0YoP8Ydre6rfqxO', 0, 'siswa', '0000-00-00 00:00:00', ''),
(22, 'Muhamad Supriyanto', '3182', '$2y$10$zP01Dszw/3Vw170RbJYIKeYN/JjbQ337h2E1Varqm9CIeEO9MUxCG', 0, 'siswa', '0000-00-00 00:00:00', ''),
(23, 'Muhammad Afif Shiddiq', '3183', '$2y$10$8NVhTS/aADGmCQB2aIPgiuIjSuchca0kzoX9kUCte9CCXtgFJlV.S', 0, 'siswa', '0000-00-00 00:00:00', ''),
(24, 'Muhammad Amir Hamzah', '3187', '$2y$10$LHtTTpuHna5jJpRtvC3m6OL4.Gc.IDegrN1sogUbOVV.RbrTfauD2', 0, 'siswa', '0000-00-00 00:00:00', ''),
(25, 'Muhammad Fadhil Rizkiansyah', '3189', '$2y$10$giz86HHvb2tfXJshcvx7YuUIvEXmajw3QGM3PA93osQ9BtdAKc8wO', 0, 'siswa', '0000-00-00 00:00:00', ''),
(26, 'Muhammad Hafizh Al Fatah Imanov', '3190', '$2y$10$LOufrc5WA9UcF4oKWwvQ0OOpccm1gW1QoURy.6HIQVfSLc1D.aLTa', 0, 'siswa', '0000-00-00 00:00:00', ''),
(27, 'Muhammad Oksa Alridho', '3192', '$2y$10$5LFkaD5rVWE8OFy55rixeewHIxFhzkkSH0JX/nhDj8W9A.hKqoUam', 0, 'siswa', '0000-00-00 00:00:00', ''),
(28, 'Muhammad Reynaldi', '3193', '$2y$10$7g0YpmOFJeaT780djX5AXuIk/uNAF0nBDx0PHNKPN4zm7HZCNatWi', 0, 'siswa', '0000-00-00 00:00:00', ''),
(29, 'Nadiya Rahmadona Yolanda', '3201', '$2y$10$uvUu4C41hNFJSW113To84uWWyWBjIzRQgh.qV5Ze3LEEqsiiqXWQa', 0, 'siswa', '0000-00-00 00:00:00', ''),
(30, 'Nida Safira Hasanah', '3205', '$2y$10$OO1w4Uiyz5ne1DxVRu7qeeU0ZjNEdp7cjiJL0Oj31eDbC1UHV6kXq', 0, 'siswa', '0000-00-00 00:00:00', ''),
(31, 'Putri Amalia Sejati', '3214', '$2y$10$D6HsPKL/oZtygb4PnopGFehE/UybVd.hw./UoKGZ.JyuZhSq8o9Nq', 0, 'siswa', '0000-00-00 00:00:00', ''),
(32, 'Putri Wulandari', '3216', '$2y$10$nEBtNKBL.gKrAmjMyuh8KOJo9OC2R7TmZ5y6JBBL41k2/9jd4297S', 0, 'siswa', '0000-00-00 00:00:00', ''),
(33, 'Rachma Dini', '3218', '$2y$10$xBvdCGpuwY96duD3RuJkauCu7QgXYo1SMBNKNqMQc8uoxrWQ3cOAu', 0, 'siswa', '0000-00-00 00:00:00', ''),
(34, 'Rahma Dea Salsabilla', '3221', '$2y$10$wZpBRgJ4Mg/6/CXvLb0UcO5PMqhh8olUK/tODuRsTUH7RA4eEU2Jy', 0, 'siswa', '0000-00-00 00:00:00', ''),
(35, 'Rifa Ammatur Rayhana', '3228', '$2y$10$RseHDtHxFBPXSxyXDEENLuMjFuchzsUE5vJlU3hYGHXM/fetbU9DC', 0, 'siswa', '0000-00-00 00:00:00', ''),
(36, 'Rifqah Nabiilah', '3229', '$2y$10$2AOAbWL2O0CgczU4ebEQA.E4AlTQCKGlt5IruGg8DYIf1OxMkPL5e', 0, 'siswa', '0000-00-00 00:00:00', ''),
(37, 'Teguh Gunawan', '3248', '$2y$10$zqMSUAdEMocdYo5Ia67ozuJ3oxichAqG4O7CQEepnFuFqWREhvoOG', 0, 'siswa', '0000-00-00 00:00:00', ''),
(38, 'Tiara Zahra Lisdya', '3250', '$2y$10$T5TjZDcUnz7PYEFzYrKl3.LoyEHptH0a7nlfr2uGbg4cMFaJhAskS', 0, 'siswa', '0000-00-00 00:00:00', ''),
(39, 'Widi Humaira Adisti', '3255', '$2y$10$Pfq9NOlQcnKsGsLpU3IO3epZv1eLGYxkAqZ6B49pe3CjHczjOAiwG', 0, 'siswa', '0000-00-00 00:00:00', ''),
(40, 'Zahra Nafadilla', '3257', '$2y$10$D1W9pzZLlvVTXaq0tiZwwelCJwC5v8zVv7Ssv0ZR265JlC3RurOk.', 0, 'siswa', '0000-00-00 00:00:00', ''),
(41, 'Zulfi Astri Andini', '3259', '$2y$10$V/ZyTNm3zfDH17pu1Dr2Q.gxaTAQzwRB2OiGFtnyPQaWHSlczRUJm', 0, 'siswa', '0000-00-00 00:00:00', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_sanksi`
--
ALTER TABLE `detail_sanksi`
  ADD CONSTRAINT `detail_sanksi_ibfk_1` FOREIGN KEY (`id_sanksi`) REFERENCES `sanksi` (`id_sanksi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
