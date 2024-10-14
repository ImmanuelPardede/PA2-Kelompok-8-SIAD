-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2024 pada 11.08
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `latar_belakang` varchar(3000) DEFAULT NULL,
  `img_yayasan` varchar(255) DEFAULT NULL,
  `visi` varchar(3000) DEFAULT NULL,
  `misi` varchar(3000) DEFAULT NULL,
  `wilayah1` varchar(2000) DEFAULT NULL,
  `wilayah2` varchar(2000) DEFAULT NULL,
  `img_wilayah1` varchar(255) DEFAULT NULL,
  `img_wilayah2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `user_id`, `latar_belakang`, `img_yayasan`, `visi`, `misi`, `wilayah1`, `wilayah2`, `img_wilayah1`, `img_wilayah2`, `created_at`, `updated_at`) VALUES
(1, 1, 'Yayasan Pendidikan Anak Rumah Damai atau yang sering dikenal masyarakat adalah Rumah Damai berdiri pada tanggal 25 Januari 2022 yang dahulu bernama Komunitas Rumah Dame. Komunitas ini dimulai dari sebuah desa di pinggiran Danau Toba yaitu Desa Lumban Silintong dengan mengajak anak-anak di desa tersebut. Pada 11 Maret 2023, komunitas Rumah Dame resmi terdaftar di Kemenkuham dengan SK Pendirian nomor AHU-004325.AH.01.04.Tahun 2023 dan berubah nama menjadi Yayasan Pendidikan Anak Rumah Damai.', 'uploads/visitor/about/dummy2.jpg', 'Mewujudnyatakan kedamaian bagi setiap anak', '<ol>\n            <li>Memberikan pendidikan kreatif dan kontekstual kepada anak</li>\n            <li>Memberikan ruang kepada setiap anak untuk mengespresikan dirinya melalui kemampuan yang dimiliki.</li>\n            <li>Memberikan ruang bagi setiap anak untuk sharing setiap aspek-aspek kehidupan yang terjadi dalam kehidupannya</li>\n        </ol>\n        ', 'Desa Lumban Silintong, Kecamatan Balige, Kabupaten Toba.', 'Desa Sawah Lamo, Kecamatan Andam Dewi, Tapanuli Tengah.', 'uploads/visitor/about/dummy3.jpg', 'uploads/visitor/about/dummy1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `id` int(10) UNSIGNED NOT NULL,
  `agama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`id`, `agama`, `created_at`, `updated_at`) VALUES
(1, 'Islam', NULL, NULL),
(2, 'Kristen Protestan', NULL, NULL),
(3, 'Kristen Katolik', NULL, NULL),
(4, 'Buddha', NULL, NULL),
(5, 'Hindu', NULL, NULL),
(6, 'Konghucu', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anak`
--

CREATE TABLE `anak` (
  `id` int(10) UNSIGNED NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `agama_id` int(10) UNSIGNED DEFAULT NULL,
  `nia` varchar(255) DEFAULT NULL,
  `jenis_kelamin_id` int(10) UNSIGNED DEFAULT NULL,
  `golongan_darah_id` int(10) UNSIGNED DEFAULT NULL,
  `kebutuhan_disabilitas_id` int(10) UNSIGNED DEFAULT NULL,
  `lokasi_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `disukai` text DEFAULT NULL,
  `tidak_disukai` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kelebihan` text DEFAULT NULL,
  `kekurangan` text DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `tipe_anak` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `img_berita` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carousel_items`
--

CREATE TABLE `carousel_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `subcaption` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carousel_items`
--

INSERT INTO `carousel_items` (`id`, `user_id`, `image_url`, `caption`, `subcaption`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/visitor/carousel/dummy1.jpg', 'Selamat Datang', 'Sistem Informasi Yayasan Pendidikan Anak Rumah Damai', NULL, NULL),
(2, 1, 'uploads/visitor/carousel/dummy2.jpg', 'Yosua 1:9', 'Tetaplah kuat dan berani.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deskripsi_latar_belakang`
--

CREATE TABLE `deskripsi_latar_belakang` (
  `id` int(10) UNSIGNED NOT NULL,
  `latar_belakang_id` int(10) UNSIGNED NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailraports`
--

CREATE TABLE `detailraports` (
  `id` int(10) UNSIGNED NOT NULL,
  `raport_id` int(10) UNSIGNED NOT NULL,
  `mata_pelajaran_id` int(10) UNSIGNED NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `keterangan` varchar(10000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_fasilitas`
--

CREATE TABLE `detail_fasilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fasilitas_id` int(10) UNSIGNED NOT NULL,
  `img_fasilitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_galeri`
--

CREATE TABLE `detail_galeri` (
  `id` int(10) UNSIGNED NOT NULL,
  `galeri_id` int(10) UNSIGNED NOT NULL,
  `img_galeri` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ppi_a`
--

CREATE TABLE `detail_ppi_a` (
  `id` int(10) UNSIGNED NOT NULL,
  `ppiA_id` int(10) UNSIGNED NOT NULL,
  `level_komunikasi` text NOT NULL,
  `gambaran_sensorik` text NOT NULL,
  `informasi_penting` text NOT NULL,
  `kondisi_lain` text DEFAULT NULL,
  `layanan_lain` text DEFAULT NULL,
  `tujuan_jangka_panjang` text NOT NULL,
  `tujuan_jangka_pendek` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_ppi_b`
--

CREATE TABLE `detail_ppi_b` (
  `id` int(10) UNSIGNED NOT NULL,
  `ppiB_id` int(10) UNSIGNED NOT NULL,
  `file_ppi_b` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_program`
--

CREATE TABLE `detail_program` (
  `id` int(10) UNSIGNED NOT NULL,
  `program_id` int(10) UNSIGNED NOT NULL,
  `jenis_program` varchar(2000) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_program`
--

INSERT INTO `detail_program` (`id`, `program_id`, `jenis_program`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelestarian Lingkungan', 'Dalam melestarikan lingkungan, anak-anak belajar membuat setiap karya yang ramah lingkungan dengan mendaur ulang sampah, serta turut dalam penanaman tumbuhan muda.', NULL, NULL),
(2, 1, 'Kesehatan Jasmani dan Rohani', 'Dalam mendukung kesehatan Rohani, Kami melakukan Ibadah sekali seminggu. Didalam YPA Rumah Damai menjunjung tinggi nilai-nilai pluralisme. Setiap anak yang beragama Muslim diajari oleh Guru yang beragama Muslim sedangkan anak yang beragama Kristen diajari oleh guru yang beragama Kristen. Dalam mendukung kesehatan Jasmani, kami melakukan berbagi gizi dan Olahraga. diselenggarakan melalui kelas futsal dan berenang.', NULL, NULL),
(3, 1, 'Kelestarian Budaya Lokal', 'Dalam menunjang kelestarian budaya kontekstual, kami mengajarkan Bahasa suku, tarian, filosofi rumah adat dan tulisan-tulisan budaya kontekstual dan wisata kebudayaan.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `disabilitas`
--

CREATE TABLE `disabilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_disabilitas` varchar(255) NOT NULL,
  `jenis_disabilitas` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disabilitas`
--

INSERT INTO `disabilitas` (`id`, `kategori_disabilitas`, `jenis_disabilitas`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Disabilitas Fisik', 'Amputasi', 'Kondisi kehilangan anggota tubuh seperti lengan atau kaki.', NULL, NULL),
(2, 'Disabilitas Fisik', 'Lumpuh layu', 'Hilangnya kemampuan untuk bergerak atau berjalan karena kerusakan pada sistem saraf.', NULL, NULL),
(3, 'Disabilitas Fisik', 'Paraplegi', 'Hilangnya fungsi motorik atau sensorik pada bagian bawah tubuh.', NULL, NULL),
(4, 'Disabilitas Fisik', 'Cerebral palsy', 'Gangguan gerakan dan koordinasi otot yang disebabkan oleh kerusakan otak sejak bayi.', NULL, NULL),
(5, 'Disabilitas Fisik', 'Stroke', 'Kerusakan otak akibat penghentian aliran darah ke otak.', NULL, NULL),
(6, 'Disabilitas Fisik', 'Kusta', 'Penyakit menular yang dapat menyebabkan kerusakan jaringan, saraf, dan kulit.', NULL, NULL),
(7, 'Disabilitas Fisik', 'Dwarfism (seckel syndrome)', 'Kondisi pertumbuhan yang menghasilkan tinggi badan yang sangat pendek.', NULL, NULL),
(8, 'Disabilitas Intelektual', 'Lambat belajar', 'Keterbatasan dalam memahami dan memproses informasi dibandingkan dengan rata-rata usia sebaya.', NULL, NULL),
(9, 'Disabilitas Intelektual', 'Grahita', 'Keterbatasan mental yang menyebabkan kesulitan belajar dan menghadapi tugas-tugas sehari-hari.', NULL, NULL),
(10, 'Disabilitas Intelektual', 'Down syndrome', 'Kelainan genetik yang menyebabkan perkembangan fisik dan intelektual yang terhambat.', NULL, NULL),
(11, 'Disabilitas Mental', 'Skizofrenia', 'Gangguan mental serius yang memengaruhi cara berpikir, merasakan, dan berperilaku.', NULL, NULL),
(12, 'Disabilitas Mental', 'Bipolar', 'Gangguan mood yang menyebabkan perubahan drastis antara episode mania dan depresi.', NULL, NULL),
(13, 'Disabilitas Mental', 'Depresi', 'Gangguan suasana hati yang ditandai dengan perasaan sedih, kehilangan minat, dan energi yang rendah.', NULL, NULL),
(14, 'Disabilitas Sensorik', 'Tunanetra', 'Kehilangan penglihatan secara total.', NULL, NULL),
(15, 'Disabilitas Sensorik', 'Tuli', 'Kehilangan pendengaran secara total.', NULL, NULL),
(16, 'Disabilitas Sensorik', 'Tunawicara', 'Kesulitan dalam berbicara atau menggunakan bahasa secara verbal.', NULL, NULL),
(17, 'Disabilitas Ganda atau Multi', 'Fisik dan Mental', 'Kombinasi antara disabilitas fisik dan gangguan mental.', NULL, NULL),
(18, 'Disabilitas Ganda atau Multi', 'Fisik dan Intelektual', 'Kombinasi antara disabilitas fisik dan keterbatasan intelektual.', NULL, NULL),
(19, 'Disabilitas Ganda atau Multi', 'Fisik dan Sensorik', 'Kombinasi antara disabilitas fisik dan gangguan sensorik.', NULL, NULL),
(20, 'Disabilitas Ganda atau Multi', 'Sensorik dan Mental', 'Kombinasi antara disabilitas sensorik dan gangguan mental.', NULL, NULL),
(21, 'Disabilitas Ganda atau Multi', 'Intelektual dan Sensorik', 'Kombinasi antara keterbatasan intelektual dan gangguan sensorik.', NULL, NULL),
(22, 'Disabilitas Ganda atau Multi', 'Mental dan Intelektual', 'Kombinasi antara gangguan mental dan keterbatasan intelektual.', NULL, NULL),
(23, 'Disabilitas Neurologis', 'Gangguan pergerakan', 'deskripsi\' => \'Gangguan pada kontrol gerakan tubuh, seperti Parkinson\'s disease, Huntington\'s disease, atau dystonia.', NULL, NULL),
(24, 'Disabilitas Neurologis', 'Gangguan epilepsi', 'Gangguan neurologis yang ditandai dengan serangan epilepsi.', NULL, NULL),
(25, 'Disabilitas Neurologis', 'Gangguan neurodegeneratif', 'Penurunan fungsi saraf yang progresif, seperti ALS (Amyotrophic Lateral Sclerosis) atau multiple sclerosis (MS).', NULL, NULL),
(26, 'Disabilitas Lingkungan atau Aksesibilitas', 'Keterbatasan mobilitas atau akses', 'Kesulitan dalam mengakses lingkungan atau fasilitas karena keterbatasan fisik, aksesibilitas yang buruk, atau fasilitas yang tidak ramah disabilitas.', NULL, NULL),
(27, 'Disabilitas Lingkungan atau Aksesibilitas', 'Keterbatasan teknologi atau akses digital', 'Kesulitan dalam menggunakan teknologi atau mengakses informasi digital karena keterbatasan aksesibilitas atau perangkat yang tidak mendukung.', NULL, NULL),
(28, 'Disabilitas Medis atau Kesehatan Kronis', 'Penyakit kronis', 'Penyakit atau kondisi medis yang memerlukan perawatan jangka panjang, seperti diabetes, asma, atau penyakit jantung.', NULL, NULL),
(29, 'Disabilitas Medis atau Kesehatan Kronis', 'Kondisi medis kompleks', 'Kondisi medis yang kompleks dan memengaruhi fungsi organ atau sistem tubuh, seperti kanker, lupus, atau HIV/AIDS.', NULL, NULL),
(30, 'Disabilitas Pembelajaran atau Pendidikan', 'Gangguan pembelajaran', 'Kesulitan dalam memahami atau memproses informasi, seperti dyslexia, dyscalculia, atau ADHD.', NULL, NULL),
(31, 'Disabilitas Pembelajaran atau Pendidikan', 'Gangguan bahasa atau komunikasi', 'Kesulitan dalam berbicara, memahami, atau mengungkapkan bahasa, seperti disfasia atau gangguan berbicara.', NULL, NULL),
(32, 'Disabilitas Lingkungan atau Sosial', 'Diskriminasi atau stigma', 'Dampak negatif dari diskriminasi atau stigmatisasi terhadap individu dengan disabilitas, seperti perlakuan tidak adil atau keterbatasan akses sosial.', NULL, NULL),
(33, 'Disabilitas Lingkungan atau Sosial', 'Keterbatasan akses', 'Kesulitan dalam mengakses layanan, fasilitas, atau informasi yang dapat membatasi partisipasi penuh dalam masyarakat.', NULL, NULL),
(34, 'Disabilitas Psikososial atau Lingkungan', 'Trauma atau kejadian traumatis', 'Dampak dari kejadian traumatis, seperti PTSD (Post-Traumatic Stress Disorder) atau trauma akibat pelecehan.', NULL, NULL),
(35, 'Disabilitas Psikososial atau Lingkungan', 'Stres kronis atau kondisi lingkungan yang tidak mendukung', 'Gangguan akibat tekanan atau stres kronis yang berasal dari lingkungan atau kondisi sosial tertentu.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_donasi` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `donasi`
--

INSERT INTO `donasi` (`id`, `jenis_donasi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Donasi Keuangan', 'Memberikan sumbangan uang tunai atau transfer bank kepada organisasi atau keluarga yang memiliki anak-anak disabilitas untuk memenuhi kebutuhan dasar, seperti perawatan medis, pendidikan khusus, dan peralatan medis.', NULL, NULL),
(2, 'Donasi Peralatan Medis', 'Menyumbangkan peralatan medis khusus seperti alat bantu dengar, atau alat bantu lainnya yang dibutuhkan oleh anak-anak disabilitas.', NULL, NULL),
(3, 'Donasi Pendidikan', 'Memberikan sumbangan untuk biaya pendidikan anak-anak disabilitas, termasuk biaya sekolah, buku, alat-alat pembelajaran khusus, atau dukungan untuk program pendidikan khusus.', NULL, NULL),
(4, 'Donasi Pengembangan Keterampilan', 'Mendukung program-program yang membantu anak-anak disabilitas untuk mengembangkan keterampilan mereka, seperti kursus terapi fisik, terapi wicara, atau pelatihan keterampilan hidup mandiri.', NULL, NULL),
(5, 'Donasi Transportasi', 'Memberikan bantuan untuk transportasi, baik itu biaya perjalanan atau bahkan menyumbangkan kendaraan khusus yang dapat membantu mobilitas anak-anak disabilitas.', NULL, NULL),
(6, 'Donasi Alat Bantu Mobilitas', 'Seperti kursi roda, tongkat, atau walker yang dapat membantu anak-anak disabilitas untuk bergerak lebih mandiri.', NULL, NULL),
(7, 'Donasi Alat Bantu Komunikasi', 'Seperti komunikator berbasis gambar atau perangkat lunak komunikasi alternatif yang membantu anak-anak disabilitas dalam berkomunikasi.', NULL, NULL),
(8, 'Donasi Biaya Medis', 'Mencakup biaya pemeriksaan kesehatan rutin, perawatan medis, atau intervensi medis khusus yang diperlukan oleh anak-anak disabilitas.', NULL, NULL),
(9, 'Donasi Pendidikan Inklusif', 'Mendukung sekolah inklusif atau program pendidikan khusus yang memfasilitasi anak-anak disabilitas untuk belajar bersama dengan teman sebaya mereka.', NULL, NULL),
(10, 'Donasi Terapi dan Intervensi', 'Seperti terapi fisik, terapi wicara, terapi okupasi, atau terapi lainnya yang membantu dalam pengembangan keterampilan dan kemampuan anak-anak disabilitas.', NULL, NULL),
(11, 'Donasi Peralatan Edukasi', 'Seperti komputer atau perangkat lunak edukatif yang dirancang khusus untuk anak-anak disabilitas agar dapat belajar dengan lebih efektif.', NULL, NULL),
(12, 'Donasi Sarana Olahraga', 'Mendukung pembangunan atau peningkatan fasilitas olahraga yang dapat diakses oleh anak-anak disabilitas untuk berpartisipasi dalam kegiatan fisik.', NULL, NULL),
(13, 'Donasi Ketersediaan Makanan Khusus', 'Membantu biaya makanan khusus atau diet yang diperlukan oleh anak-anak disabilitas karena kondisi medis tertentu.', NULL, NULL),
(14, 'Donasi Alat Bantu Sensorik', 'Seperti kacamata khusus, alat bantu dengar, atau alat bantu penglihatan yang membantu meningkatkan persepsi sensorik anak-anak disabilitas.', NULL, NULL),
(15, 'Donasi Terapi Hewan', 'Menyumbangkan dana untuk terapi dengan hewan seperti terapi dengan anjing atau kuda, yang telah terbukti membantu anak-anak disabilitas dalam pengembangan sosial, emosional, dan fisik mereka.', NULL, NULL),
(16, 'Donasi Perawatan Medis Rumah', 'Mendukung biaya perawatan medis yang diberikan di rumah bagi anak-anak disabilitas yang memerlukan perawatan jangka panjang atau kompleks.', NULL, NULL),
(17, 'Donasi Pemeliharaan dan Perbaikan Peralatan Medis', 'Mengalokasikan dana untuk perawatan, pemeliharaan, atau perbaikan alat-alat medis yang sudah dimiliki oleh keluarga anak-anak disabilitas.', NULL, NULL),
(18, 'Donasi Bantuan Psikologis', 'Memberikan dukungan finansial untuk layanan konseling atau terapi psikologis bagi anak-anak disabilitas dan keluarga mereka dalam mengatasi tantangan mental dan emosional.', NULL, NULL),
(19, 'Donasi Peralatan Terapi', 'Mendukung penyediaan peralatan terapi yang diperlukan, seperti bola terapi, terapi mainan, atau matras terapi, untuk membantu dalam pengembangan motorik dan sensorik anak-anak disabilitas.', NULL, NULL),
(20, 'Donasi Layanan Pendampingan', 'Menyumbangkan dana untuk layanan pendampingan yang membantu anak-anak disabilitas dalam kegiatan sehari-hari, seperti belajar di sekolah, bermain di taman, atau berpartisipasi dalam kegiatan sosial.', NULL, NULL),
(21, 'Donasi Kegiatan Rekreasi dan Liburan', 'Menyediakan dana untuk kegiatan rekreasi atau liburan yang dirancang khusus untuk anak-anak disabilitas, sehingga mereka dapat mengalami pengalaman yang menyenangkan dan mendidik.', NULL, NULL),
(22, 'Donasi Teknologi Assistif', 'Memberikan dana untuk pembelian atau penyediaan teknologi assistif seperti perangkat lunak khusus, aplikasi, atau perangkat keras yang membantu anak-anak disabilitas dalam belajar, berkomunikasi, atau melakukan aktivitas sehari-hari.', NULL, NULL),
(23, 'Donasi Program Inklusi Sekolah', 'Mendukung program-program yang mempromosikan inklusi sekolah, termasuk pelatihan bagi guru dan fasilitator untuk mendukung anak-anak disabilitas dalam lingkungan pendidikan mainstream.', NULL, NULL),
(24, 'Donasi Program Pemantauan Kesehatan', 'Memberikan dana untuk program pemantauan kesehatan jangka panjang bagi anak-anak disabilitas yang membutuhkan perawatan dan perhatian khusus untuk kondisi kesehatan mereka.', NULL, NULL),
(25, 'Donasi Dukungan Psikososial', 'Mendukung penyediaan layanan dukungan psikososial seperti konseling, terapi kelompok, atau program dukungan emosional bagi anak-anak disabilitas dan keluarga mereka.', NULL, NULL),
(26, 'Donasi Program Kemandirian', 'Menyumbangkan dana untuk program-program yang bertujuan meningkatkan kemandirian anak-anak disabilitas, termasuk pelatihan keterampilan hidup mandiri, pelatihan kemampuan sosial, dan dukungan untuk integrasi sosial.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur`
--

CREATE TABLE `donatur` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_donatur` varchar(255) NOT NULL,
  `lainnya` varchar(255) DEFAULT NULL,
  `email_donatur` varchar(255) NOT NULL,
  `tanggal_donatur` date NOT NULL,
  `no_hp_donatur` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jumlah_donasi` bigint(20) DEFAULT NULL,
  `foto_donatur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `donatur_donasi`
--

CREATE TABLE `donatur_donasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `donasi_id` int(10) UNSIGNED NOT NULL,
  `donatur_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fasilitas` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `format_laporan`
--

CREATE TABLE `format_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kode_laporan_id` int(10) UNSIGNED NOT NULL,
  `format_laporan` varchar(255) NOT NULL,
  `nama_laporan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foundation_histories`
--

CREATE TABLE `foundation_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `sejarah_singkat` varchar(2000) NOT NULL,
  `tujuan_utama` varchar(2000) NOT NULL,
  `dibangun` date NOT NULL,
  `jumlah_anak` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `foundation_histories`
--

INSERT INTO `foundation_histories` (`id`, `user_id`, `gambar`, `sejarah_singkat`, `tujuan_utama`, `dibangun`, `jumlah_anak`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/visitor/history/dummy2.jpg', 'YPARD didirikan di Balige pada Januari 2022 dengan misi memberikan pendidikan kepada anak-anak dengan hambatan. Terinspirasi dari pengalaman pribadi dan studi di HKBP Laguboti, YPARD fokus pada memberikan pendidikan inklusif melalui Rumah Damai di Lumban Silintong dan YPA Rumah Damai di Andam Dewi untuk anak disabilitas.', 'Berdirinya YPARD didasarkan pada keinginan Pendiri sejak duduk di Sekolah Menengah Pertama.', '2022-01-25', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_latar_belakang`
--

CREATE TABLE `gambar_latar_belakang` (
  `id` int(10) UNSIGNED NOT NULL,
  `latar_belakang_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan_darah`
--

CREATE TABLE `golongan_darah` (
  `id` int(10) UNSIGNED NOT NULL,
  `golongan_darah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `golongan_darah`
--

INSERT INTO `golongan_darah` (`id`, `golongan_darah`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, NULL),
(2, 'B', NULL, NULL),
(3, 'AB', NULL, NULL),
(4, 'O', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_pembelajaran`
--

CREATE TABLE `jadwal_pembelajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `minggu_pembelajaran_id` int(10) UNSIGNED NOT NULL,
  `modul_materi_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `lokasi_penugasan_id` int(10) UNSIGNED NOT NULL,
  `tanggal_pembelajaran` date DEFAULT NULL,
  `hari_pembelajaran` varchar(255) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_pembelajaran`
--

INSERT INTO `jadwal_pembelajaran` (`id`, `kelas_id`, `minggu_pembelajaran_id`, `modul_materi_id`, `user_id`, `lokasi_penugasan_id`, `tanggal_pembelajaran`, `hari_pembelajaran`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(12, 2, 16, 12, 2, 1, NULL, NULL, NULL, NULL, '2024-10-07 08:18:57', '2024-10-07 08:18:57'),
(13, 1, 16, 13, 2, 1, '2024-10-09', 'Wednesday', '06:00:00', '07:00:00', '2024-10-07 15:44:36', '2024-10-09 05:25:48'),
(15, 2, 16, 15, 2, 1, NULL, NULL, NULL, NULL, '2024-10-08 10:16:29', '2024-10-08 10:16:29'),
(16, 2, 16, 16, 2, 1, '2024-10-11', 'Friday', '07:00:00', '08:00:00', '2024-10-08 10:58:20', '2024-10-08 11:03:28'),
(17, 4, 15, 17, 2, 1, '2024-07-10', 'Wednesday', '19:04:00', '20:04:00', '2024-10-08 10:58:37', '2024-10-08 11:05:27'),
(18, 5, 16, 18, 2, 1, '2024-10-10', 'Thursday', '11:02:00', '12:02:00', '2024-10-09 05:02:33', '2024-10-10 03:47:03'),
(19, 6, 16, 19, 2, 1, '2024-10-08', 'Tuesday', '13:20:00', '15:20:00', '2024-10-09 05:19:38', '2024-10-09 05:20:25'),
(20, 5, 16, 20, 2, 1, NULL, NULL, NULL, NULL, '2024-10-09 05:19:55', '2024-10-09 05:19:55'),
(21, 2, 16, 21, 2, 1, '2024-10-09', 'Wednesday', '14:21:00', '15:21:00', '2024-10-09 05:21:01', '2024-10-09 05:21:19'),
(22, 4, 16, 22, 2, 1, '2024-10-09', 'Wednesday', '16:50:00', '18:09:00', '2024-10-09 09:09:02', '2024-10-09 09:18:13'),
(23, 2, 16, 23, 2, 1, '2024-10-07', 'Monday', '16:28:00', '16:54:00', '2024-10-09 09:28:32', '2024-10-09 09:53:09'),
(24, 6, 16, 24, 2, 1, '2024-10-09', 'Wednesday', '16:00:00', '16:54:00', '2024-10-09 09:30:44', '2024-10-09 09:53:34'),
(25, 3, 16, 25, 2, 1, '2024-10-10', 'Thursday', '13:47:00', '14:47:00', '2024-10-10 03:47:38', '2024-10-10 03:48:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
(1, 'Laki-laki', NULL, NULL),
(2, 'Perempuan', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_berita`
--

INSERT INTO `kategori_berita` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pengumuman Akademis', NULL, NULL),
(2, 'Penghargaan dan Prestasi', NULL, NULL),
(3, 'Kegiatan Ekstrakurikuler', NULL, NULL),
(4, 'Kemitraan dan Kolaborasi', NULL, NULL),
(5, 'Inovasi Teknologi Pendidikan', NULL, NULL),
(6, 'Kesehatan dan Kesejahteraan', NULL, NULL),
(7, 'Pembangunan Fasilitas', NULL, NULL),
(8, 'Penggalangan Dana dan Donasi', NULL, NULL),
(9, 'Pendidikan Inklusif', NULL, NULL),
(10, 'Kemitraan Industri', NULL, NULL),
(11, 'Donasi', NULL, NULL),
(12, 'Sponsor', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan_disabilitas`
--

CREATE TABLE `kebutuhan_disabilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_kebutuhan_disabilitas` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kebutuhan_disabilitas`
--

INSERT INTO `kebutuhan_disabilitas` (`id`, `jenis_kebutuhan_disabilitas`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Kacamata atau Lensa Kontak Khusus', 'Kacamata atau lensa kontak khusus adalah alat bantu visual yang dirancang khusus untuk anak-anak dengan gangguan penglihatan. Kacamata dapat disesuaikan dengan resep yang tepat sesuai dengan kebutuhan mata anak, baik untuk koreksi penglihatan jarak dekat maupun jarak jauh. Lensa kontak juga dapat digunakan untuk koreksi penglihatan, terutama jika anak memiliki ketidaknyamanan atau kesulitan menggunakan kacamata.', NULL, NULL),
(2, 'Alat Bantu Dengar (Hearing Aids)', 'Alat bantu dengar adalah perangkat elektronik yang membantu meningkatkan kemampuan pendengaran anak dengan gangguan pendengaran. Alat ini biasanya dikenakan di belakang atau di dalam telinga, dan berfungsi untuk memperkuat suara sehingga anak dapat mendengar dengan lebih jelas. Alat bantu dengar tersedia dalam berbagai ukuran dan model, termasuk yang dirancang khusus untuk anak-anak dengan gaya hidup aktif.', NULL, NULL),
(3, 'Implan Koklea', 'Implan koklea adalah perangkat medis yang ditanamkan secara bedah untuk membantu anak dengan gangguan pendengaran yang parah atau tuli sensorineural. Implan ini bekerja dengan merangsang saraf pendengaran langsung, mengubah sinyal suara menjadi impuls listrik yang diteruskan ke otak. Implan koklea biasanya cocok untuk anak-anak yang tidak mendapatkan manfaat optimal dari alat bantu dengar konvensional.', NULL, NULL),
(4, 'Kursi Roda Manual atau Listrik', 'Kursi roda manual atau listrik adalah perangkat mobilitas yang membantu anak dengan gangguan mobilitas untuk bergerak secara mandiri. Kursi roda manual biasanya dioperasikan dengan mendorong atau ditarik oleh pengguna atau orang lain, sementara kursi roda listrik memiliki motor yang digerakkan oleh baterai untuk membantu anak bergerak dengan lebih mudah.', NULL, NULL),
(5, 'Penyangga atau Walker', 'Penyangga atau walker adalah perangkat mobilitas yang membantu anak dengan kelemahan kaki atau ketidakseimbangan untuk berjalan dengan lebih stabil. Penyangga ini biasanya terdiri dari kerangka logam dengan roda dan pegangan, yang dapat digunakan sebagai penyangga saat berjalan.', NULL, NULL),
(6, 'Tongkat atau Kruk', 'Tongkat atau kruk adalah perangkat mobilitas yang digunakan oleh anak dengan gangguan keseimbangan atau kelemahan pada salah satu atau kedua kaki. Tongkat atau kruk memberikan dukungan tambahan saat berjalan, membantu anak untuk menjaga keseimbangan dan mengurangi risiko jatuh.', NULL, NULL),
(7, 'Peralatan Terapi Fisik', 'Peralatan terapi fisik, seperti bola terapi, balok paralel, atau treadmill khusus, digunakan dalam program rehabilitasi untuk membantu anak meningkatkan kekuatan, keseimbangan, dan koordinasi tubuh mereka. Peralatan ini membantu anak untuk mengembangkan keterampilan motorik dan memperbaiki fungsi fisik mereka.', NULL, NULL),
(8, 'Alat Bantu Komunikasi', 'Alat bantu komunikasi, seperti komunikator atau aplikasi AAC (Augmentative and Alternative Communication), digunakan oleh anak dengan gangguan komunikasi untuk berkomunikasi dengan orang lain. Alat ini mencakup berbagai jenis perangkat, mulai dari buku komunikasi sederhana hingga aplikasi digital yang canggih, yang memungkinkan anak untuk mengekspresikan kebutuhan, pikiran, dan emosi mereka.', NULL, NULL),
(9, 'Komputer atau Perangkat Lunak Khusus', 'Komputer atau perangkat lunak khusus digunakan untuk membantu anak dalam belajar atau komunikasi. Perangkat lunak ini mencakup keyboard besar atau mouse yang mudah dijangkau, program pembelajaran interaktif, dan aplikasi khusus yang dirancang untuk memfasilitasi pembelajaran dan komunikasi anak dengan disabilitas.', NULL, NULL),
(10, 'Peralatan Terapi Okupasi', 'Peralatan terapi okupasi, seperti putty, perangkat untuk latihan koordinasi mata-tangan, atau alat pengukur tekanan, digunakan dalam terapi okupasi untuk membantu anak dalam mengembangkan keterampilan motorik halus, kemandirian, dan kemampuan fungsional sehari-hari.', NULL, NULL),
(11, 'Buku-Buku atau Sumber Daya Pendidikan Khusus', 'Buku-buku atau sumber daya pendidikan khusus, seperti buku teks braille atau audio, digunakan untuk menyediakan materi pembelajaran yang disesuaikan dengan kebutuhan belajar anak dengan disabilitas. Sumber daya ini membantu anak untuk mengakses informasi dan belajar sesuai dengan gaya belajar mereka.', NULL, NULL),
(12, 'Layanan Pendidikan Khusus', 'Layanan pendidikan khusus, seperti guru pendamping atau spesialis pendidikan khusus, disediakan untuk membantu anak dengan disabilitas dalam memperoleh pendidikan yang sesuai dengan kebutuhan mereka. Layanan ini mencakup pembimbingan individual, pengajaran yang disesuaikan, dan dukungan tambahan di dalam kelas.', NULL, NULL),
(13, 'Terapi Wicara atau Terapi Bicara', 'Terapi wicara atau terapi bicara digunakan untuk membantu anak dalam mengembangkan keterampilan komunikasi, termasuk pemahaman bahasa, pengucapan, dan ekspresi verbal. Terapi ini mencakup berbagai teknik dan strategi untuk membantu anak dalam berkomunikasi secara efektif.', NULL, NULL),
(14, 'Peralatan Khusus untuk Terapi Motorik', 'Peralatan khusus untuk terapi motorik, seperti mainan berbasis sensorik atau peralatan terapi berat, digunakan dalam terapi untuk membantu anak dalam meningkatkan keterampilan motorik halus atau motorik kasar mereka. Peralatan ini membantu anak untuk mengembangkan koordinasi tubuh, kekuatan otot, dan keterampilan fungsional lainnya.', NULL, NULL),
(15, 'Peralatan Keamanan', 'Peralatan keamanan, seperti pelindung atau pengaman kursi roda, kursi mobil khusus, atau helm pelindung, digunakan untuk melindungi anak dari cedera atau risiko lainnya. Peralatan ini dirancang khusus untuk memenuhi kebutuhan keamanan anak dengan disabilitas.', NULL, NULL),
(16, 'Konseling atau Terapi Emosional', 'Konseling atau terapi emosional disediakan untuk membantu anak dalam mengatasi tantangan sosial atau emosional yang terkait dengan disabilitas mereka. Terapi ini mencakup dukungan emosional, pemecahan masalah, dan pengembangan keterampilan koping.', NULL, NULL),
(17, 'Peralatan Medis', 'Peralatan medis, seperti nebulizer, alat pengukur gula darah, atau alat pemberi insulin, digunakan untuk mengelola kondisi medis yang mungkin dimiliki anak dengan disabilitas. Peralatan ini membantu anak dalam memantau kesehatan mereka dan mengelola kondisi medis secara efektif.', NULL, NULL),
(18, 'Diet Khusus atau Suplemen Nutrisi', 'Diet khusus atau suplemen nutrisi disesuaikan dengan kebutuhan medis anak, seperti diet rendah gluten atau diet tinggi protein, digunakan untuk mengelola kondisi medis yang mungkin dimiliki anak. Diet ini direkomendasikan oleh profesional kesehatan untuk mendukung kesehatan dan kesejahteraan anak.', NULL, NULL),
(19, 'Peralatan Kebersihan Pribadi', 'Peralatan kebersihan pribadi, seperti kursi mandi atau pegangan tambahan, shower chair, atau kursi toilet khusus, digunakan untuk membantu anak dalam menjaga kebersihan pribadi mereka dengan aman dan nyaman. Peralatan ini dirancang khusus untuk memenuhi kebutuhan kebersihan anak dengan disabilitas.', NULL, NULL),
(20, 'Fasilitas Aksesibilitas', 'Fasilitas aksesibilitas, seperti ram yang sesuai atau lift, digunakan untuk memastikan anak dapat mengakses fasilitas publik atau lingkungan rumah dengan mudah. Fasilitas ini dirancang untuk memenuhi kebutuhan aksesibilitas anak dengan disabilitas, sehingga mereka dapat berpartisipasi secara penuh dalam kehidupan sehari-hari.', NULL, NULL),
(21, 'Terapi Musik atau Seni', 'Terapi musik atau seni adalah jenis terapi yang menggunakan musik atau seni sebagai alat untuk membantu anak dalam mengembangkan keterampilan sosial, emosional, dan kognitif mereka. Terapi ini dapat mencakup berbagai kegiatan musik dan seni yang disesuaikan dengan kebutuhan anak.', NULL, NULL),
(22, 'Peralatan Keselamatan Tambahan', 'Peralatan keselamatan tambahan, seperti sistem peringatan kebakaran yang sesuai dengan kebutuhan anak atau alat pemantauan kesehatan otomatis, digunakan untuk meningkatkan keamanan anak dengan disabilitas. Peralatan ini dirancang khusus untuk mendeteksi atau mencegah risiko cedera atau keadaan darurat lainnya.', NULL, NULL),
(23, 'Perangkat Lunak atau Aplikasi Khusus', 'Perangkat lunak atau aplikasi khusus digunakan untuk membantu dalam pelacakan jadwal atau pengaturan tugas anak dengan disabilitas. Perangkat lunak ini mencakup aplikasi kalender, pengingat obat, atau program manajemen waktu lainnya yang dapat disesuaikan dengan kebutuhan anak.', NULL, NULL),
(24, 'Peralatan Penunjang Aktivitas Sehari-hari', 'Peralatan penunjang aktivitas sehari-hari, seperti botol minum khusus, alat makan yang disesuaikan, atau alat bantu pakaian, digunakan untuk membantu anak dalam menjalani kegiatan sehari-hari dengan lebih mandiri. Peralatan ini dirancang khusus untuk memenuhi kebutuhan anak dengan disabilitas dalam menjalani kehidupan sehari-hari.', NULL, NULL),
(25, 'Peralatan Rekreasi atau Olahraga', 'Peralatan rekreasi atau olahraga yang disesuaikan, seperti kursi roda olahraga, sepeda tiga roda, atau alat renang yang dapat diakses, digunakan untuk memfasilitasi partisipasi anak dengan disabilitas dalam kegiatan olahraga atau rekreasi. Peralatan ini dirancang untuk memenuhi kebutuhan aksesibilitas dan keselamatan anak saat berpartisipasi dalam kegiatan fisik.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tahun_kurikulum_id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran_id` int(10) UNSIGNED NOT NULL,
  `semester_tahun_ajaran_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `user_id`, `tahun_kurikulum_id`, `tahun_ajaran_id`, `semester_tahun_ajaran_id`, `created_at`, `updated_at`) VALUES
(1, 'Spritualitas', 1, 1, 1, 1, NULL, NULL),
(2, 'Karya Seni dan Budaya', 1, 2, 2, 2, NULL, NULL),
(3, 'Bahasa Inggris', 1, 1, 3, 1, NULL, NULL),
(4, 'Musik Tradisional', 1, 2, 4, 2, NULL, NULL),
(5, 'Futsal', 1, 1, 5, 1, NULL, NULL),
(6, 'Pendampingan Anak Berkebutuhan Khusus', 1, 2, 6, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_laporan`
--

CREATE TABLE `kode_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kode_laporan`
--

INSERT INTO `kode_laporan` (`id`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'PPIB', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `latar_belakang`
--

CREATE TABLE `latar_belakang` (
  `id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `usia` int(11) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_penugasan`
--

CREATE TABLE `lokasi_penugasan` (
  `id` int(10) UNSIGNED NOT NULL,
  `wilayah` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasi_penugasan`
--

INSERT INTO `lokasi_penugasan` (`id`, `wilayah`, `lokasi`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'wilayah 1', 'Lumban Silintong', 'Desa Lumban Silintong, Kecamatan Balige, Kabupaten Toba.', NULL, NULL),
(2, 'wilayah 2', 'Sawah Lamo', 'Desa Sawah Lamo, Kecamatan Andam Dewi Kabupaten Tapanuli Tengah.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_02_121047_create_lokasi_penugasan_table', 1),
(6, '2024_02_03_064120_create_minggu_pembelajaran_table', 1),
(7, '2024_02_03_064120_create_semester_tahun_ajaran_table', 1),
(8, '2024_02_03_064120_create_tahun_ajaran_table', 1),
(9, '2024_02_03_064120_create_tahun_kurikulum_table', 1),
(10, '2024_02_05_040027_create_pekerjaan_table', 1),
(11, '2024_02_05_040050_create_pendidikan_table', 1),
(12, '2024_02_05_040107_create_penyakit_table', 1),
(13, '2024_02_05_040154_create_sponsorship_table', 1),
(14, '2024_02_05_040218_create_donasi_table', 1),
(15, '2024_03_03_060520_create_agama_table', 1),
(16, '2024_03_03_064117_create_golongan_darah_table', 1),
(17, '2024_03_03_064535_create_jenis_kelamin_table', 1),
(18, '2024_03_03_065034_create_kebutuhan_disabilitas_table', 1),
(19, '2024_03_03_074730_create_users_table', 1),
(20, '2024_03_03_074731_create_anak_table', 1),
(21, '2024_03_05_040243_create_donatur_table', 1),
(22, '2024_03_05_040243_create_sponsor_table', 1),
(23, '2024_03_05_041348_create_riwayat_medis_table', 1),
(24, '2024_03_22_260520_create_kelas_table', 1),
(25, '2024_03_23_001309_create_raport_table', 1),
(26, '2024_03_23_042930_create_detailraports_table', 1),
(27, '2024_03_23_150558_create_orang_tua_wali_table', 1),
(28, '2024_03_24_050414_create_donatur_donasi_table', 1),
(29, '2024_03_24_050414_create_kode_laporan_table', 1),
(30, '2024_03_24_050414_create_modul_materi_table', 1),
(31, '2024_03_24_050414_create_sponsor_sponsorship_table', 1),
(32, '2024_03_24_050415_create_jadwal_pembelajaran_table', 1),
(33, '2024_03_25_142652_create_disabilitas_table', 1),
(34, '2024_03_25_142652_create_non_disabilitas_table ', 1),
(35, '2024_03_28_015809_create_pengumuman_table', 1),
(36, '2024_04_01_123827_create_todo_lists_table', 1),
(37, '2024_04_02_033719_create_notifications_table', 1),
(38, '2024_04_15_163916_create_silabus_table', 1),
(39, '2024_04_16_013808_create_tujuan', 1),
(40, '2024_04_20_082202_create_carousel_items_table', 1),
(41, '2024_04_20_132802_create_foundation_histories_table', 1),
(42, '2024_04_21_055713_create_about_table', 1),
(43, '2024_04_21_082516_create_program_table', 1),
(44, '2024_04_21_082557_create_detail_program_table', 1),
(45, '2024_04_21_123347_create_kategori_berita_table', 1),
(46, '2024_04_21_130352_create_berita_table', 1),
(47, '2024_04_24_050414_create_format_laporan_table', 1),
(48, '2024_04_24_134229_create_fasilitas_table', 1),
(49, '2024_04_24_141053_create_detail_fasilitas_table', 1),
(50, '2024_04_28_121615_create_galeri_table', 1),
(51, '2024_04_28_121818_create_detail_galeri_table', 1),
(52, '2024_05_13_014212_create_latar_belakang_table', 1),
(53, '2024_05_13_014244_create_gambar_latar_belakang_table', 1),
(54, '2024_05_18_105814_create_deskripsi_latar_belakang_table', 1),
(55, '2024_05_22_135154_create_ppi_model_a_table', 1),
(56, '2024_05_22_135730_create_detail_ppi_a_table', 1),
(57, '2024_05_24_050414_create_ppi_model_b_table', 1),
(58, '2024_05_25_065730_create_detail_ppi_b_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `minggu_pembelajaran`
--

CREATE TABLE `minggu_pembelajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `minggu_pembelajaran` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `lokasi_penugasan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `minggu_pembelajaran`
--

INSERT INTO `minggu_pembelajaran` (`id`, `minggu_pembelajaran`, `tanggal_mulai`, `tanggal_berakhir`, `lokasi_penugasan_id`, `created_at`, `updated_at`) VALUES
(1, 'Minggu 1', '2024-04-01', '2024-04-07', 1, NULL, NULL),
(2, 'Minggu 2', '2024-04-08', '2024-04-14', 1, NULL, NULL),
(3, 'Minggu 3', '2024-04-15', '2024-04-21', 1, NULL, NULL),
(4, 'Minggu 4', '2024-04-22', '2024-04-28', 1, NULL, NULL),
(5, 'Minggu 5', '2024-04-29', '2024-05-05', 1, NULL, NULL),
(6, 'Minggu 6', '2024-05-06', '2024-05-12', 1, NULL, NULL),
(7, 'Minggu 7', '2024-05-13', '2024-05-19', 1, NULL, NULL),
(8, 'Minggu 8', '2024-05-20', '2024-05-26', 1, NULL, NULL),
(9, 'Minggu 9', '2024-05-27', '2024-06-02', 1, NULL, NULL),
(10, 'Minggu 10', '2024-06-03', '2024-06-09', 1, NULL, NULL),
(11, 'Minggu 11', '2024-06-10', '2024-06-16', 1, NULL, NULL),
(12, 'Minggu 12', '2024-06-17', '2024-06-23', 1, NULL, NULL),
(13, 'Minggu 13', '2024-06-24', '2024-06-30', 1, NULL, NULL),
(14, 'Minggu 14', '2024-07-01', '2024-07-07', 1, NULL, NULL),
(15, 'Minggu 15', '2024-07-08', '2024-07-14', 1, NULL, NULL),
(16, 'Minggu 16', '2024-10-07', '2024-10-13', 1, NULL, NULL),
(17, 'Minggu 1', '2024-04-01', '2024-04-07', 2, NULL, NULL),
(18, 'Minggu 2', '2024-04-08', '2024-04-14', 2, NULL, NULL),
(19, 'Minggu 3', '2024-04-15', '2024-04-21', 2, NULL, NULL),
(20, 'Minggu 4', '2024-04-22', '2024-04-28', 2, NULL, NULL),
(21, 'Minggu 5', '2024-04-29', '2024-05-05', 2, NULL, NULL),
(22, 'Minggu 6', '2024-05-06', '2024-05-12', 2, NULL, NULL),
(23, 'Minggu 7', '2024-05-13', '2024-05-19', 2, NULL, NULL),
(24, 'Minggu 8', '2024-05-20', '2024-05-26', 2, NULL, NULL),
(25, 'Minggu 9', '2024-05-27', '2024-06-02', 2, NULL, NULL),
(26, 'Minggu 10', '2024-06-03', '2024-06-09', 2, NULL, NULL),
(27, 'Minggu 11', '2024-06-10', '2024-06-16', 2, NULL, NULL),
(28, 'Minggu 12', '2024-06-17', '2024-06-23', 2, NULL, NULL),
(29, 'Minggu 13', '2024-06-24', '2024-06-30', 2, NULL, NULL),
(30, 'Minggu 14', '2024-07-01', '2024-07-07', 2, NULL, NULL),
(31, 'Minggu 15', '2024-07-08', '2024-07-14', 2, NULL, NULL),
(32, 'Minggu 16', '2024-07-15', '2024-07-21', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul_materi`
--

CREATE TABLE `modul_materi` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `minggu_pembelajaran_id` int(10) UNSIGNED NOT NULL,
  `tahun_kurikulum_id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `file_modul` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `modul_materi`
--

INSERT INTO `modul_materi` (`id`, `kelas_id`, `nama_materi`, `minggu_pembelajaran_id`, `tahun_kurikulum_id`, `tahun_ajaran_id`, `user_id`, `file_modul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(12, 2, 'Pengenalan Musik Tradisional', 16, 2, 5, 2, 'template.docx', NULL, '2024-10-07 08:18:57', '2024-10-07 08:18:57'),
(13, 1, 'Pengenalan Spiritual', 16, 1, 6, 2, 'template.docx', NULL, '2024-10-07 15:44:36', '2024-10-07 15:44:36'),
(15, 2, 'Pengenalan Musik Tradisional', 16, 2, 5, 2, 'Template Laporan Praktikum JARKOM.docx', NULL, '2024-10-08 10:16:29', '2024-10-08 10:16:29'),
(16, 2, 'Pengenalan Musik Tradisional', 16, 2, 6, 2, 'Week10_Prak01_11322024.docx', NULL, '2024-10-08 10:58:20', '2024-10-08 10:58:20'),
(17, 4, 'Pengenalan Musik Tradisional', 15, 2, 6, 2, 'Week10_Prak01_11322024.docx', NULL, '2024-10-08 10:58:37', '2024-10-08 10:58:37'),
(18, 5, 'Pengenalan Futsal', 16, 1, 6, 2, 'Week10_Prak01_11322024.docx', NULL, '2024-10-09 05:02:33', '2024-10-09 05:02:33'),
(19, 6, 'Pengenalan Bahasa Inggris', 16, 2, 6, 2, 'templete RPL.docx', NULL, '2024-10-09 05:19:38', '2024-10-09 05:19:38'),
(20, 5, 'Pengenalan Futsal', 16, 1, 7, 2, 'Templete_Laporan_Praktikum_AOK.docx', NULL, '2024-10-09 05:19:55', '2024-10-09 05:19:55'),
(21, 2, 'Pengenalan Musik Tradisional', 16, 2, 6, 2, 'template.docx', NULL, '2024-10-09 05:21:01', '2024-10-09 05:21:01'),
(22, 4, 'Pengenalan Musik Tradisional', 16, 2, 6, 2, 'templete RPL.docx', NULL, '2024-10-09 09:09:02', '2024-10-09 09:09:02'),
(23, 2, 'Pengenalan Bahasa Inggris', 16, 2, 6, 2, 'templete.docx', NULL, '2024-10-09 09:28:32', '2024-10-09 09:28:32'),
(24, 6, 'Pengenalan Spirituallll', 16, 2, 6, 2, 'Template Laporan Praktikum JARKOM.docx', NULL, '2024-10-09 09:30:44', '2024-10-09 09:30:44'),
(25, 3, 'Pengenalan Bahasa Inggris', 16, 1, 6, 2, 'Template Laporan PPI B Tahun Ajaran 2024.docx', NULL, '2024-10-10 03:47:38', '2024-10-10 03:47:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `non_disabilitas`
--

CREATE TABLE `non_disabilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori_non_disabilitas` varchar(255) NOT NULL,
  `jenis_non_disabilitas` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orang_tua_wali`
--

CREATE TABLE `orang_tua_wali` (
  `id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `agama_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nik_ayah` bigint(20) DEFAULT NULL,
  `nik_ibu` bigint(20) DEFAULT NULL,
  `tanggal_lahir_ayah` date DEFAULT NULL,
  `tanggal_lahir_ibu` date DEFAULT NULL,
  `alamat_orangtua` varchar(255) DEFAULT NULL,
  `pendidikan_ayah_id` varchar(255) DEFAULT NULL,
  `pekerjaan_ayah_id` int(10) UNSIGNED DEFAULT NULL,
  `no_hp_ayah` bigint(20) DEFAULT NULL,
  `pendidikan_ibu_id` varchar(255) DEFAULT NULL,
  `pekerjaan_ibu_id` int(10) UNSIGNED DEFAULT NULL,
  `no_hp_ibu` bigint(20) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `alamat_wali` varchar(255) DEFAULT NULL,
  `pekerjaan_wali_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_lahir_wali` date DEFAULT NULL,
  `no_hp_wali` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_pekerjaan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `jenis_pekerjaan`, `created_at`, `updated_at`) VALUES
(1, 'Dokter', NULL, NULL),
(2, 'Guru', NULL, NULL),
(3, 'Insinyur', NULL, NULL),
(4, 'Perawat', NULL, NULL),
(5, 'Polisi', NULL, NULL),
(6, 'Akuntan', NULL, NULL),
(7, 'Programmer', NULL, NULL),
(8, 'Arsitek', NULL, NULL),
(9, 'Penulis', NULL, NULL),
(10, 'Seniman', NULL, NULL),
(11, 'Pengacara', NULL, NULL),
(12, 'Koki', NULL, NULL),
(13, 'Ahli keuangan', NULL, NULL),
(14, 'Ilmuwan', NULL, NULL),
(15, 'Pekerja sosial', NULL, NULL),
(16, 'Peneliti', NULL, NULL),
(17, 'Teknisi', NULL, NULL),
(18, 'Pemadam kebakaran', NULL, NULL),
(19, 'Manajer proyek', NULL, NULL),
(20, 'Penjual retail', NULL, NULL),
(21, 'Pelatih olahraga', NULL, NULL),
(22, 'Manajer sumber daya manusia (SDM)', NULL, NULL),
(23, 'Analis data', NULL, NULL),
(24, 'Desainer grafis', NULL, NULL),
(25, 'Fotografer', NULL, NULL),
(26, 'Teknisi jaringan komputer', NULL, NULL),
(27, 'Konsultan manajemen', NULL, NULL),
(28, 'Pengembang web', NULL, NULL),
(29, 'Penyiar radio/televisi', NULL, NULL),
(30, 'Montir mobil/motor', NULL, NULL),
(31, 'Petani', NULL, NULL),
(32, 'Pustakawan', NULL, NULL),
(33, 'Desainer interior', NULL, NULL),
(34, 'Operator mesin', NULL, NULL),
(35, 'Jurnalis', NULL, NULL),
(36, 'Perancang mode', NULL, NULL),
(37, 'Ahli terapi fisik', NULL, NULL),
(38, 'Pengusaha', NULL, NULL),
(39, 'Asisten rumah tangga', NULL, NULL),
(40, 'Pilot', NULL, NULL),
(41, 'Pramugari/pramugara', NULL, NULL),
(42, 'Karyawan administrasi', NULL, NULL),
(43, 'Sales/marketing', NULL, NULL),
(44, 'Ahli biologi', NULL, NULL),
(45, 'Astronom', NULL, NULL),
(46, 'Ahli kimia', NULL, NULL),
(47, 'Juru teknik', NULL, NULL),
(48, 'Psikolog', NULL, NULL),
(49, 'Penyiar radio/televisi', NULL, NULL),
(50, 'Translator/interpreter', NULL, NULL),
(51, 'Pilot drone', NULL, NULL),
(52, 'Manajer restoran', NULL, NULL),
(53, 'Ahli nutrisi/dietisien', NULL, NULL),
(54, 'Perancang permainan video', NULL, NULL),
(55, 'Pengajar musik', NULL, NULL),
(56, 'Ahli forensik', NULL, NULL),
(57, 'Konsultan keuangan', NULL, NULL),
(58, 'Pengelola acara', NULL, NULL),
(59, 'Petugas layanan pelanggan', NULL, NULL),
(60, 'Konsultan kecantikan', NULL, NULL),
(61, 'Ahli hukum lingkungan', NULL, NULL),
(62, 'Ahli farmasi', NULL, NULL),
(63, 'Ahli bedah', NULL, NULL),
(64, 'Petugas penegakan hukum', NULL, NULL),
(65, 'Spesialis pengembangan masyarakat', NULL, NULL),
(66, 'Arsitek lanskap', NULL, NULL),
(67, 'Ahli patologi', NULL, NULL),
(68, 'Animator', NULL, NULL),
(69, 'Ahli bioteknologi', NULL, NULL),
(70, 'Ahli meteorologi', NULL, NULL),
(71, 'Peneliti pasar', NULL, NULL),
(72, 'Ahli genetika', NULL, NULL),
(73, 'Ahli ekonomi', NULL, NULL),
(74, 'Fotografer pernikahan', NULL, NULL),
(75, 'Ahli zoologi', NULL, NULL),
(76, 'Ahli kesehatan masyarakat', NULL, NULL),
(77, 'Ahli psikiatri', NULL, NULL),
(78, 'Konsultan teknologi informasi', NULL, NULL),
(79, 'Ahli antropologi', NULL, NULL),
(80, 'Ahli pariwisata', NULL, NULL),
(81, 'Ahli astronomi', NULL, NULL),
(82, 'Analis risiko', NULL, NULL),
(83, 'Ahli etnografi', NULL, NULL),
(84, 'Ilustrator', NULL, NULL),
(85, 'Pengacara properti', NULL, NULL),
(86, 'Ahli demografi', NULL, NULL),
(87, 'Penulis teknis', NULL, NULL),
(88, 'Spesialis kepatuhan', NULL, NULL),
(89, 'Ahli bioinformatika', NULL, NULL),
(90, 'Ahli robotika', NULL, NULL),
(91, 'Geolog', NULL, NULL),
(92, 'Ahli pertanian', NULL, NULL),
(93, 'Ahli pengembangan produk', NULL, NULL),
(94, 'Ahli kebijakan publik', NULL, NULL),
(95, 'Penulis konten digital', NULL, NULL),
(96, 'Ahli paleontologi', NULL, NULL),
(97, 'Ahli radiologi', NULL, NULL),
(98, 'Ahli proteomics', NULL, NULL),
(99, 'Ahli tokoh masyarakat', NULL, NULL),
(100, 'Perencana keuangan', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tingkat_pendidikan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `tingkat_pendidikan`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan Anak Usia Dini (PAUD)', NULL, NULL),
(2, 'Sekolah Dasar (SD)', NULL, NULL),
(3, 'Sekolah Menengah Pertama (SMP)', NULL, NULL),
(4, 'Sekolah Menengah Atas (SMA) atau Sekolah Menengah Kejuruan (SMK)', NULL, NULL),
(5, 'Pendidikan Menengah Kejuruan (SMK)', NULL, NULL),
(6, 'Diploma I (D1)', NULL, NULL),
(7, 'Diploma II (D2)', NULL, NULL),
(8, 'Diploma III (D3)', NULL, NULL),
(9, 'Diploma IV (D4)', NULL, NULL),
(10, 'Sarjana (S1)', NULL, NULL),
(11, 'Magister (S2)', NULL, NULL),
(12, 'Doktor (S3)', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_penyakit` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id`, `jenis_penyakit`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Hipertensi (Tekanan Darah Tinggi)', 'Kondisi di mana tekanan darah dalam arteri meningkat secara persisten. Hipertensi dapat meningkatkan risiko stroke, serangan jantung, gagal ginjal, dan masalah kesehatan lainnya.', NULL, NULL),
(2, 'Diabetes Melitus', 'Gangguan metabolisme yang ditandai oleh kadar glukosa darah tinggi akibat kekurangan insulin, resistensi insulin, atau keduanya. Komplikasi diabetes meliputi penyakit jantung, gagal ginjal, kerusakan saraf, dan masalah kesehatan lainnya.', NULL, NULL),
(3, 'Asma', 'Penyakit saluran napas kronis yang ditandai oleh peradangan dan penyempitan saluran napas, menyebabkan gejala seperti sesak napas, batuk, dan mengi.', NULL, NULL),
(4, 'Kanker', 'Penyakit yang ditandai oleh pertumbuhan sel-sel yang tidak normal dan dapat menyerang bagian tubuh mana pun. Ada banyak jenis kanker, termasuk kanker payudara, kanker paru-paru, kanker prostat, dan lain-lain.', NULL, NULL),
(5, 'Stroke', 'Kondisi yang terjadi ketika pasokan darah ke otak terganggu, menyebabkan kerusakan pada jaringan otak dan gejala seperti kelemahan otot, kesulitan berbicara, dan kehilangan koordinasi.', NULL, NULL),
(6, 'HIV/AIDS', 'Infeksi virus HIV (Human Immunodeficiency Virus) yang menyerang sistem kekebalan tubuh manusia. AIDS (Acquired Immunodeficiency Syndrome) adalah tahap lanjut dari infeksi HIV di mana sistem kekebalan tubuh sudah sangat lemah.', NULL, NULL),
(7, 'Osteoporosis', 'Penyakit tulang yang ditandai oleh penurunan massa tulang, menyebabkan tulang menjadi rapuh dan rentan patah.', NULL, NULL),
(8, 'Artritis', 'Kondisi peradangan pada sendi yang dapat menyebabkan rasa sakit, kemerahan, dan pembengkakan. Beberapa jenis artritis termasuk osteoartritis, artritis reumatoid, dan rematik.', NULL, NULL),
(9, 'Demensia', 'Kumpulan gejala yang memengaruhi fungsi kognitif seseorang, termasuk kehilangan memori, kesulitan berpikir, dan perubahan perilaku. Alzheimer adalah bentuk paling umum dari demensia.', NULL, NULL),
(10, 'Penyakit Jantung Koroner', 'Penyakit arteri koroner yang disebabkan oleh penumpukan plak di dalam arteri yang memasok darah ke jantung. Ini dapat menyebabkan angina, serangan jantung, atau gagal jantung.', NULL, NULL),
(11, 'Autisme', 'Gangguan perkembangan neurologis yang memengaruhi perilaku, interaksi sosial, dan kemampuan berkomunikasi individu.', NULL, NULL),
(12, 'Penyakit Parkinson', 'Gangguan neurodegeneratif yang memengaruhi gerakan tubuh, menyebabkan tremor, kekakuan otot, dan kesulitan bergerak.', NULL, NULL),
(13, 'Epilepsi', 'Gangguan neurologis yang ditandai oleh kejang yang berulang, disebabkan oleh aktivitas listrik yang abnormal di dalam otak.', NULL, NULL),
(14, 'Gagal Ginjal Kronis', 'Kerusakan ginjal yang terjadi secara bertahap dan irreversible, menyebabkan penurunan fungsi ginjal dan akumulasi zat-zat beracun dalam tubuh.', NULL, NULL),
(15, 'Obesitas', 'Kondisi kelebihan berat badan yang menyebabkan penumpukan lemak tubuh yang berlebihan, meningkatkan risiko penyakit jantung, diabetes, dan masalah kesehatan lainnya.', NULL, NULL),
(16, 'Demam Berdarah Dengue (DBD)', 'Penyakit yang disebabkan oleh virus dengue yang ditularkan oleh nyamuk Aedes. Gejala utamanya meliputi demam tinggi, nyeri otot dan sendi, ruam, dan pendarahan.', NULL, NULL),
(17, 'Kanker Payudara', 'Kanker yang berkembang dalam jaringan payudara. Gejalanya bisa berupa benjolan pada payudara, perubahan bentuk atau ukuran payudara, perubahan pada kulit payudara, atau keluarnya cairan dari puting susu.', NULL, NULL),
(18, 'Alzheimer', 'Penyakit neurodegeneratif progresif yang menyebabkan penurunan fungsi kognitif, seperti ingatan, pikiran, dan perilaku. Gejalanya termasuk gangguan memori, kesulitan berbicara, dan kesulitan melakukan tugas sehari-hari.', NULL, NULL),
(19, 'Diabetes Tipe 2', 'Penyakit yang ditandai dengan kadar gula darah tinggi karena tubuh tidak dapat menggunakan insulin dengan efektif. Gejalanya termasuk sering merasa haus, sering buang air kecil, kelelahan, dan penurunan berat badan.', NULL, NULL),
(20, 'Artritis Rheumatoid', 'Penyakit autoimun yang menyebabkan peradangan pada sendi, yang dapat menyebabkan nyeri, pembengkakan, dan kekakuan sendi.', NULL, NULL),
(21, 'Gagal Ginjal', 'Kondisi di mana ginjal kehilangan kemampuan untuk menyaring limbah dan cairan dari darah dengan efektif. Gejalanya termasuk kelelahan, pembengkakan, dan penurunan fungsi ginjal.', NULL, NULL),
(22, 'Penyakit Crohn', 'Salah satu jenis penyakit inflamasi usus yang dapat memengaruhi seluruh saluran pencernaan, menyebabkan gejala seperti diare, nyeri perut, dan penurunan berat badan.', NULL, NULL),
(23, 'Autisme', 'Gangguan perkembangan neurologis yang ditandai dengan kesulitan dalam interaksi sosial, komunikasi, dan perilaku yang terbatas dan repetitif.', NULL, NULL),
(24, 'Kanker Prostat', 'Kanker yang berkembang dalam kelenjar prostat pada pria. Gejala awalnya mungkin tidak terlihat, tetapi bisa termasuk kesulitan buang air kecil, nyeri saat buang air kecil, atau penurunan aliran urin.', NULL, NULL),
(25, 'Anemia', 'Kondisi di mana jumlah sel darah merah atau kadar hemoglobin dalam darah lebih rendah dari normal, yang dapat menyebabkan kelelahan, pucat, dan sesak napas.', NULL, NULL),
(26, 'Gangguan Kecemasan', 'Gangguan mental yang ditandai oleh rasa cemas yang berlebihan, ketegangan, dan ketakutan yang tidak proporsional terhadap stimulus tertentu.', NULL, NULL),
(27, 'Hipertiroidisme', 'Kondisi di mana kelenjar tiroid menghasilkan terlalu banyak hormon tiroid, menyebabkan gejala seperti peningkatan denyut jantung, penurunan berat badan, dan kelelahan.', NULL, NULL),
(28, 'Fibromyalgia', 'Kondisi kronis yang ditandai dengan nyeri otot dan sendi yang menyeluruh, kelelahan, dan gangguan tidur.', NULL, NULL),
(29, 'Penyakit Celiac', 'Penyakit autoimun di mana tubuh bereaksi terhadap gluten, protein yang ditemukan dalam gandum, barley, dan jelai, menyebabkan kerusakan pada usus dan gejala seperti diare, nyeri perut, dan penurunan berat badan.', NULL, NULL),
(30, 'Skizofrenia', 'Gangguan mental serius yang memengaruhi persepsi, pikiran, dan perilaku seseorang. Gejalanya meliputi halusinasi, delusi, dan gangguan pemikiran.', NULL, NULL),
(31, 'Endometriosis', 'Kondisi di mana jaringan yang biasanya melapisi rahim tumbuh di luar rahim, menyebabkan nyeri panggul, haid yang tidak teratur, dan kesulitan hamil.', NULL, NULL),
(32, 'Anoreksia Nervosa', 'Gangguan makan yang ditandai dengan ketakutan akan berat badan, penolakan untuk menjaga berat badan normal, dan pola makan yang tidak sehat.', NULL, NULL),
(33, 'Hipotiroidisme', 'Kondisi di mana kelenjar tiroid tidak menghasilkan cukup hormon tiroid, yang dapat menyebabkan kelelahan, penambahan berat badan, dan penurunan suhu tubuh.', NULL, NULL),
(34, 'Osteoarthritis', 'Merupakan jenis arthritis yang paling umum, dimana tulang rawan yang melapisi ujung tulang di sendi mengalami kerusakan dan penyusutan. Gejalanya meliputi nyeri sendi, pembengkakan, dan kekakuan.', NULL, NULL),
(35, 'Penyakit Lyme', 'Penyakit infeksi bakteri yang ditularkan oleh gigitan kutu yang terinfeksi. Gejala awalnya dapat mirip dengan flu, termasuk demam, nyeri otot, dan lelah, namun jika tidak diobati dapat berkembang menjadi gejala serius seperti masalah neurologis dan artritis.', NULL, NULL),
(36, 'Polio (Poliomielitis)', 'Infeksi virus yang menyerang sistem saraf dan dapat menyebabkan kelumpuhan permanen atau bahkan kematian. Meskipun telah ada vaksin yang efektif, masih terdapat kasus polio di beberapa wilayah.', NULL, NULL),
(37, 'Katarak', 'Kondisi di mana lensa mata menjadi keruh, menyebabkan penglihatan kabur atau buram. Ini merupakan penyebab umum kehilangan penglihatan terkait usia.', NULL, NULL),
(38, 'Penyakit Hepatitis', 'Merupakan peradangan pada hati yang dapat disebabkan oleh infeksi virus hepatitis (A, B, C, D, atau E), konsumsi alkohol berlebihan, atau penyakit autoimun. Gejalanya termasuk nyeri perut, kelelahan, mual, dan kulit dan mata yang kuning (jaundice).', NULL, NULL),
(39, 'Sindrom Obstruksi Apnea Tidur (Sleep Apnea)', 'Kondisi yang ditandai oleh henti napas berulang selama tidur. Hal ini dapat menyebabkan gangguan tidur, kelelahan, dan peningkatan risiko penyakit jantung dan stroke.', NULL, NULL),
(40, 'Gagal Jantung', 'Kondisi di mana jantung gagal memompa darah dengan efektif ke seluruh tubuh. Gejala termasuk sesak napas, kelelahan, pembengkakan kaki atau perut, dan detak jantung yang tidak teratur.', NULL, NULL),
(41, 'Penyakit Chikungunya', 'Penyakit virus yang ditularkan oleh nyamuk Aedes, menyebabkan demam, nyeri sendi yang parah, ruam, dan gejala flu.', NULL, NULL),
(42, 'Cystic Fibrosis', 'Merupakan penyakit genetik yang memengaruhi kelenjar yang menghasilkan lendir, keringat, dan cairan pencernaan, menyebabkan lendir yang kental dan lengket di saluran pernapasan dan pencernaan.', NULL, NULL),
(43, 'Gagal Hati', 'Kondisi di mana hati tidak berfungsi sebagaimana mestinya, menyebabkan penumpukan toksin dalam tubuh. Gejalanya termasuk kelelahan, peningkatan berat badan, nyeri perut, dan pembengkakan kaki.', NULL, NULL),
(44, 'Penyakit Huntington', 'Merupakan gangguan genetik yang menyebabkan kerusakan progresif pada sel-sel otak, menyebabkan perubahan perilaku, gangguan gerakan, dan penurunan fungsi kognitif.', NULL, NULL),
(45, 'Tumor Otak', 'Istilah yang mengacu pada pertumbuhan abnormal sel-sel di otak. Gejalanya dapat bervariasi tergantung pada lokasi dan ukuran tumor, termasuk sakit kepala, gangguan penglihatan, mual, atau kejang.', NULL, NULL),
(46, 'Fibroid Uterus', 'Tumor jinak yang tumbuh di rahim sebagian besar pada wanita usia subur. Mereka bisa menyebabkan gejala seperti nyeri panggul, menstruasi yang berat, atau kesulitan hamil.', NULL, NULL),
(47, 'Anakusis', 'Kehilangan pendengaran total atau sebagian yang bisa bersifat sementara atau permanen.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppi_model_a`
--

CREATE TABLE `ppi_model_a` (
  `id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppi_model_b`
--

CREATE TABLE `ppi_model_b` (
  `id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `img_program` varchar(255) DEFAULT NULL,
  `kelas` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id`, `user_id`, `img_program`, `kelas`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/visitor/program/dummy2.jpg', '<ol>\n            <li>Kelas Spritualitas</li>\n            <li>Kelas Karya Seni dan Budaya</li>\n            <li>Kelas Bahasa Inggris</li>\n            <li>Kelas Musik Tradisional</li>\n            <li>Kelas Futsal</li>\n            <li>Pendampingan Anak Berkebutuhan Khusus</li>\n        </ol>\n        ', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `raport`
--

CREATE TABLE `raport` (
  `id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran_id` int(10) UNSIGNED NOT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_medis`
--

CREATE TABLE `riwayat_medis` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `anak_id` int(10) UNSIGNED NOT NULL,
  `penyakit_id` int(10) UNSIGNED NOT NULL,
  `riwayat_perawatan` text DEFAULT NULL,
  `riwayat_perilaku` text DEFAULT NULL,
  `deskripsi_riwayat` text DEFAULT NULL,
  `kondisi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester_tahun_ajaran`
--

CREATE TABLE `semester_tahun_ajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `semester_tahun_ajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semester_tahun_ajaran`
--

INSERT INTO `semester_tahun_ajaran` (`id`, `semester_tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, 'Ganjil', NULL, NULL),
(2, 'Genap', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `silabus`
--

CREATE TABLE `silabus` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_kurikulum_id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran_id` int(10) UNSIGNED NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `hasil_kursus` text DEFAULT NULL,
  `tipe_pembelajaran` text DEFAULT NULL,
  `penilaian` text DEFAULT NULL,
  `konten_kursus` text DEFAULT NULL,
  `buku_pegangan_dan_referensi` text DEFAULT NULL,
  `alat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `silabus`
--

INSERT INTO `silabus` (`id`, `tahun_kurikulum_id`, `tahun_ajaran_id`, `kelas_id`, `user_id`, `deskripsi`, `hasil_kursus`, `tipe_pembelajaran`, `penilaian`, `konten_kursus`, `buku_pegangan_dan_referensi`, `alat`, `created_at`, `updated_at`) VALUES
(2, 1, 5, 5, 2, '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '<p>asd</p>', '2024-10-07 04:35:04', '2024-10-07 04:38:19'),
(3, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07 15:19:22', '2024-10-07 15:19:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_sponsor` varchar(255) NOT NULL,
  `lainnya` varchar(255) DEFAULT NULL,
  `email_sponsor` varchar(255) NOT NULL,
  `tanggal_sponsor` date NOT NULL,
  `no_telepon_sponsor` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jumlah_sponsor` bigint(20) DEFAULT NULL,
  `foto_sponsor` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sponsorship`
--

CREATE TABLE `sponsorship` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_sponsorship` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sponsorship`
--

INSERT INTO `sponsorship` (`id`, `jenis_sponsorship`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Sponsorship Pendidikan', 'Menyediakan dana untuk biaya pendidikan anak-anak disabilitas, termasuk biaya sekolah, les tambahan, atau program pendidikan khusus.', NULL, NULL),
(2, 'Sponsorship Olahraga atau Seni', 'Mendukung anak-anak disabilitas untuk berpartisipasi dalam kegiatan olahraga atau seni dengan menyediakan dana untuk biaya pendaftaran, peralatan, atau pelatihan.', NULL, NULL),
(3, 'Sponsorship Kesehatan', 'Menyediakan dana untuk biaya perawatan medis, terapi fisik, terapi wicara, atau peralatan medis yang dibutuhkan oleh anak-anak disabilitas.', NULL, NULL),
(4, 'Sponsorship Pekerjaan dan Pelatihan', 'Memberikan dukungan untuk program-program pelatihan keterampilan atau kesempatan kerja bagi anak-anak disabilitas yang sudah dewasa agar dapat mandiri secara finansial.', NULL, NULL),
(5, 'Sponsorship Acara Khusus', 'Mendukung acara-acara khusus atau program-program yang dirancang khusus untuk anak-anak disabilitas, seperti seminar, workshop, atau festival inklusi.', NULL, NULL),
(6, 'Sponsorship Pendidikan Khusus', 'Menyediakan dana untuk biaya sekolah di sekolah khusus atau lembaga pendidikan khusus bagi anak-anak disabilitas.', NULL, NULL),
(7, 'Sponsorship Program Rehabilitasi', 'Mendukung program-program rehabilitasi yang membantu anak-anak disabilitas untuk mengembangkan keterampilan fisik, kognitif, atau sosial mereka.', NULL, NULL),
(8, 'Sponsorship Aksesibilitas', 'Membiayai perbaikan atau penyesuaian rumah, sekolah, atau fasilitas umum lainnya agar dapat diakses dengan mudah oleh anak-anak disabilitas.', NULL, NULL),
(9, 'Sponsorship Kegiatan Sosial dan Rekreasi', 'Memberikan dana untuk kegiatan sosial, rekreasi, atau liburan yang diadakan khusus untuk anak-anak disabilitas.', NULL, NULL),
(10, 'Sponsorship Pelatihan Orang Tua', 'Mendukung program pelatihan atau dukungan bagi orang tua anak-anak disabilitas agar dapat memberikan perawatan dan dukungan yang terbaik bagi anak-anak mereka.', NULL, NULL),
(11, 'Sponsorship Peralatan Musik atau Seni', 'Menyediakan dana untuk pembelian alat musik atau bahan seni yang dapat membantu anak-anak disabilitas mengekspresikan diri melalui seni.', NULL, NULL),
(12, 'Sponsorship Transportasi Sekolah', 'Menyediakan dana untuk biaya transportasi ke dan dari sekolah bagi anak-anak disabilitas yang memerlukan bantuan khusus.', NULL, NULL),
(13, 'Sponsorship Kegiatan Ekstrakurikuler', 'Mendukung partisipasi anak-anak disabilitas dalam kegiatan ekstrakurikuler seperti klub buku, klub olahraga, atau klub kegiatan lainnya.', NULL, NULL),
(14, 'Sponsorship Program Penempatan Kerja', 'Memberikan dana untuk program penempatan kerja atau magang bagi anak-anak disabilitas yang mempersiapkan mereka untuk bekerja di tempat kerja yang inklusif.', NULL, NULL),
(15, 'Sponsorship Program Kesehatan Mental', 'Mendukung program-program kesehatan mental atau konseling yang dirancang khusus untuk membantu anak-anak disabilitas dalam mengatasi tantangan emosional atau psikologis.', NULL, NULL),
(16, 'Sponsorship Kelas Khusus atau Program Pendampingan', 'Mendukung biaya untuk kelas khusus atau program pendampingan yang dirancang khusus untuk memenuhi kebutuhan pendidikan anak-anak disabilitas.', NULL, NULL),
(17, 'Sponsorship Program Pelatihan Keterampilan', 'Memberikan dana untuk program pelatihan keterampilan khusus seperti pelatihan kerja atau pelatihan keterampilan hidup mandiri bagi anak-anak disabilitas yang sudah dewasa.', NULL, NULL),
(18, 'Sponsorship Program Kemitraan Komunitas', 'Menyediakan dana untuk program-program yang memfasilitasi integrasi sosial anak-anak disabilitas dalam komunitas lokal mereka melalui kolaborasi dengan organisasi atau perusahaan setempat.', NULL, NULL),
(19, 'Sponsorship Pelatihan Inklusi', 'Mendukung pelatihan bagi guru dan staf sekolah tentang pendekatan inklusif dalam pendidikan, untuk memastikan anak-anak disabilitas dapat sepenuhnya terlibat dalam lingkungan sekolah.', NULL, NULL),
(20, 'Sponsorship Program Kemandirian', 'Memberikan dana untuk program-program yang bertujuan untuk meningkatkan kemandirian anak-anak disabilitas dalam hal kegiatan sehari-hari, seperti mandi, berpakaian, atau makan sendiri.', NULL, NULL),
(21, 'Sponsorship Program Seni dan Ekspresi', 'Mendukung program seni dan ekspresi, seperti musik, seni lukis, atau drama, yang membantu anak-anak disabilitas untuk mengekspresikan diri dan mengembangkan bakat mereka.', NULL, NULL),
(22, 'Sponsorship Pengembangan Keterampilan Sosial', 'Memberikan dana untuk program-program yang membantu anak-anak disabilitas dalam mengembangkan keterampilan sosial, komunikasi, dan interaksi dengan orang lain.', NULL, NULL),
(23, 'Sponsorship Program Inklusi Masyarakat', 'Mendukung program-program yang mendorong inklusi anak-anak disabilitas dalam berbagai kegiatan masyarakat, seperti acara budaya, festival, atau kegiatan amal lokal.', NULL, NULL),
(24, 'Sponsorship Aksesibilitas Transportasi Umum', 'Mendukung proyek-proyek untuk meningkatkan aksesibilitas transportasi umum bagi anak-anak disabilitas, termasuk peningkatan fasilitas, pelatihan staf, atau pengadaan kendaraan khusus.', NULL, NULL),
(25, 'Sponsorship Program Pemberdayaan Komunitas', 'Memberikan dana untuk program-program yang memfasilitasi inklusi dan pemberdayaan komunitas anak-anak disabilitas melalui pelatihan keterampilan, pendampingan, atau pengembangan usaha kecil.', NULL, NULL),
(26, 'Sponsorship Program Keluarga', 'Mendukung program-program yang memberikan dukungan langsung kepada keluarga anak-anak disabilitas, termasuk layanan penasihat keluarga, pertemuan kelompok, atau dukungan keuangan darurat.', NULL, NULL),
(27, 'Sponsorship Peralatan Olahraga Adaptif', 'Menyediakan dana untuk pembelian atau penyediaan peralatan olahraga adaptif seperti kursi roda olahraga, sepeda khusus, atau alat-alat lain yang memungkinkan anak-anak disabilitas untuk berpartisipasi dalam aktivitas olahraga.', NULL, NULL),
(28, 'Sponsorship Program Pengembangan Bakat', 'Memberikan dukungan finansial untuk program-program yang memfasilitasi pengembangan bakat dan minat anak-anak disabilitas dalam berbagai bidang seperti seni, musik, atau olahraga.', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sponsor_sponsorship`
--

CREATE TABLE `sponsor_sponsorship` (
  `id` int(10) UNSIGNED NOT NULL,
  `sponsorship_id` int(10) UNSIGNED NOT NULL,
  `sponsor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, '2019', NULL, NULL),
(2, '2020', NULL, NULL),
(3, '2021', NULL, NULL),
(4, '2022', NULL, NULL),
(5, '2023', NULL, NULL),
(6, '2024', NULL, NULL),
(7, '2025', '2024-10-08 11:02:23', '2024-10-08 11:02:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_kurikulum`
--

CREATE TABLE `tahun_kurikulum` (
  `id` int(10) UNSIGNED NOT NULL,
  `tahun_kurikulum` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_kurikulum`
--

INSERT INTO `tahun_kurikulum` (`id`, `tahun_kurikulum`, `created_at`, `updated_at`) VALUES
(1, 2019, NULL, NULL),
(2, 2020, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `todo_lists`
--

CREATE TABLE `todo_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `tugas` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `detailppiA_id` int(10) UNSIGNED NOT NULL,
  `bina_diri` varchar(255) DEFAULT NULL,
  `jangka` varchar(255) DEFAULT NULL,
  `sosialisasi_dan_komunikasi` varchar(255) DEFAULT NULL,
  `bekerja` varchar(255) DEFAULT NULL,
  `akademik` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `nip` varchar(255) DEFAULT NULL,
  `golongan_darah_id` int(10) UNSIGNED DEFAULT NULL,
  `jenis_kelamin_id` int(10) UNSIGNED DEFAULT NULL,
  `agama_id` int(10) UNSIGNED DEFAULT NULL,
  `pendidikan_id` int(10) UNSIGNED DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(12) DEFAULT NULL,
  `lulusan` varchar(255) DEFAULT NULL,
  `pengalaman` text DEFAULT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_keluar` timestamp NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `lokasi_penugasan_id` int(10) UNSIGNED DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `email_verified_at`, `password`, `status`, `role`, `nip`, `golongan_darah_id`, `jenis_kelamin_id`, `agama_id`, `pendidikan_id`, `alamat`, `no_telepon`, `lulusan`, `pengalaman`, `tanggal_masuk`, `tanggal_keluar`, `tempat_lahir`, `tanggal_lahir`, `lokasi_penugasan_id`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$JYvgj29C933fAZNzPCx9B.LgVlIsCsxuBaG5oyWVQ8m9EQBwS9bDW', 'aktif', 0, '12422001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07 04:31:12', NULL, NULL, '2022-01-01', 1, NULL, NULL, NULL, NULL),
(2, 'Guru Simalakama', 'guru@gmail.com', NULL, '$2y$12$GEiwYGRCVTE7EnSOlwtxvewKQVEvl1mDuZBqUjsEq3a7cz8H.kXpi', 'aktif', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07 04:31:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2024-10-09 04:39:11'),
(3, 'Staff', 'staff@gmail.com', NULL, '$2y$12$6Ha9Z4UIVpvgDOGD801ShuERx/dwREUPTCE7v2l16Ax/zNxyhqPqe', 'aktif', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07 04:31:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(4, 'Direktur', 'direktur@gmail.com', NULL, '$2y$12$B/u1aT.MaXwdyHnQCKOfmu0lRY0vQZUh58gZjboM7FyxviVaTskdK', 'aktif', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-07 04:31:12', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(5, 'guru1', 'guru1@gmail.com', NULL, '$2y$12$6irns3GYbZSyMPfAvNyb6e/WB8gVMFHaKJYeD9NiFR2.oJ9oq6eMu', 'aktif', 1, '12470002', NULL, NULL, NULL, NULL, NULL, '12', NULL, '<ul><li>ss</li></ul>', '2024-10-07 05:57:46', NULL, NULL, NULL, 1, NULL, NULL, '2024-10-07 05:57:46', '2024-10-07 05:57:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `anak`
--
ALTER TABLE `anak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anak_user_id_foreign` (`user_id`),
  ADD KEY `anak_agama_id_foreign` (`agama_id`),
  ADD KEY `anak_lokasi_id_foreign` (`lokasi_id`),
  ADD KEY `anak_jenis_kelamin_id_foreign` (`jenis_kelamin_id`),
  ADD KEY `anak_kebutuhan_disabilitas_id_foreign` (`kebutuhan_disabilitas_id`),
  ADD KEY `anak_golongan_darah_id_foreign` (`golongan_darah_id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_user_id_foreign` (`user_id`),
  ADD KEY `berita_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `carousel_items`
--
ALTER TABLE `carousel_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carousel_items_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `deskripsi_latar_belakang`
--
ALTER TABLE `deskripsi_latar_belakang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deskripsi_latar_belakang_latar_belakang_id_foreign` (`latar_belakang_id`);

--
-- Indeks untuk tabel `detailraports`
--
ALTER TABLE `detailraports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detailraports_raport_id_foreign` (`raport_id`),
  ADD KEY `detailraports_mata_pelajaran_id_foreign` (`mata_pelajaran_id`);

--
-- Indeks untuk tabel `detail_fasilitas`
--
ALTER TABLE `detail_fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_fasilitas_fasilitas_id_foreign` (`fasilitas_id`);

--
-- Indeks untuk tabel `detail_galeri`
--
ALTER TABLE `detail_galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_galeri_galeri_id_foreign` (`galeri_id`);

--
-- Indeks untuk tabel `detail_ppi_a`
--
ALTER TABLE `detail_ppi_a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_ppi_a_ppia_id_foreign` (`ppiA_id`);

--
-- Indeks untuk tabel `detail_ppi_b`
--
ALTER TABLE `detail_ppi_b`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_ppi_b_ppib_id_foreign` (`ppiB_id`);

--
-- Indeks untuk tabel `detail_program`
--
ALTER TABLE `detail_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_program_program_id_foreign` (`program_id`);

--
-- Indeks untuk tabel `disabilitas`
--
ALTER TABLE `disabilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `donatur_email_donatur_unique` (`email_donatur`),
  ADD KEY `donatur_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `donatur_donasi`
--
ALTER TABLE `donatur_donasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donatur_donasi_donasi_id_foreign` (`donasi_id`),
  ADD KEY `donatur_donasi_donatur_id_foreign` (`donatur_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `format_laporan`
--
ALTER TABLE `format_laporan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `format_laporan_kode_laporan_id_unique` (`kode_laporan_id`),
  ADD KEY `format_laporan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `foundation_histories`
--
ALTER TABLE `foundation_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foundation_histories_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `gambar_latar_belakang`
--
ALTER TABLE `gambar_latar_belakang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gambar_latar_belakang_latar_belakang_id_foreign` (`latar_belakang_id`);

--
-- Indeks untuk tabel `golongan_darah`
--
ALTER TABLE `golongan_darah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_pembelajaran`
--
ALTER TABLE `jadwal_pembelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_pembelajaran_kelas_id_foreign` (`kelas_id`),
  ADD KEY `jadwal_pembelajaran_minggu_pembelajaran_id_foreign` (`minggu_pembelajaran_id`),
  ADD KEY `jadwal_pembelajaran_modul_materi_id_foreign` (`modul_materi_id`),
  ADD KEY `jadwal_pembelajaran_user_id_foreign` (`user_id`),
  ADD KEY `jadwal_pembelajaran_lokasi_penugasan_id_foreign` (`lokasi_penugasan_id`);

--
-- Indeks untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kebutuhan_disabilitas`
--
ALTER TABLE `kebutuhan_disabilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_user_id_foreign` (`user_id`),
  ADD KEY `kelas_tahun_kurikulum_id_foreign` (`tahun_kurikulum_id`),
  ADD KEY `kelas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `kelas_semester_tahun_ajaran_id_foreign` (`semester_tahun_ajaran_id`);

--
-- Indeks untuk tabel `kode_laporan`
--
ALTER TABLE `kode_laporan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_laporan_kode_unique` (`kode`);

--
-- Indeks untuk tabel `latar_belakang`
--
ALTER TABLE `latar_belakang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `latar_belakang_anak_id_foreign` (`anak_id`),
  ADD KEY `latar_belakang_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `lokasi_penugasan`
--
ALTER TABLE `lokasi_penugasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `minggu_pembelajaran`
--
ALTER TABLE `minggu_pembelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minggu_pembelajaran_lokasi_penugasan_id_foreign` (`lokasi_penugasan_id`);

--
-- Indeks untuk tabel `modul_materi`
--
ALTER TABLE `modul_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modul_materi_kelas_id_foreign` (`kelas_id`),
  ADD KEY `modul_materi_minggu_pembelajaran_id_foreign` (`minggu_pembelajaran_id`),
  ADD KEY `modul_materi_tahun_kurikulum_id_foreign` (`tahun_kurikulum_id`),
  ADD KEY `modul_materi_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `modul_materi_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `non_disabilitas`
--
ALTER TABLE `non_disabilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `orang_tua_wali`
--
ALTER TABLE `orang_tua_wali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orang_tua_wali_agama_id_foreign` (`agama_id`),
  ADD KEY `orang_tua_wali_pekerjaan_ayah_id_foreign` (`pekerjaan_ayah_id`),
  ADD KEY `orang_tua_wali_pekerjaan_ibu_id_foreign` (`pekerjaan_ibu_id`),
  ADD KEY `orang_tua_wali_pekerjaan_wali_id_foreign` (`pekerjaan_wali_id`),
  ADD KEY `orang_tua_wali_anak_id_foreign` (`anak_id`),
  ADD KEY `orang_tua_wali_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumuman_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `ppi_model_a`
--
ALTER TABLE `ppi_model_a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ppi_model_a_user_id_foreign` (`user_id`),
  ADD KEY `ppi_model_a_anak_id_foreign` (`anak_id`);

--
-- Indeks untuk tabel `ppi_model_b`
--
ALTER TABLE `ppi_model_b`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ppi_model_b_anak_id_foreign` (`anak_id`),
  ADD KEY `ppi_model_b_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `raport`
--
ALTER TABLE `raport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raport_anak_id_foreign` (`anak_id`),
  ADD KEY `raport_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `raport_semester_id_foreign` (`semester_id`),
  ADD KEY `raport_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `riwayat_medis`
--
ALTER TABLE `riwayat_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_medis_user_id_foreign` (`user_id`),
  ADD KEY `riwayat_medis_anak_id_foreign` (`anak_id`),
  ADD KEY `riwayat_medis_penyakit_id_foreign` (`penyakit_id`);

--
-- Indeks untuk tabel `semester_tahun_ajaran`
--
ALTER TABLE `semester_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `silabus`
--
ALTER TABLE `silabus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `silabus_tahun_kurikulum_id_foreign` (`tahun_kurikulum_id`),
  ADD KEY `silabus_kelas_id_foreign` (`kelas_id`),
  ADD KEY `silabus_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `silabus_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsor_email_sponsor_unique` (`email_sponsor`),
  ADD KEY `sponsor_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sponsorship`
--
ALTER TABLE `sponsorship`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sponsor_sponsorship`
--
ALTER TABLE `sponsor_sponsorship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsor_sponsorship_sponsorship_id_foreign` (`sponsorship_id`),
  ADD KEY `sponsor_sponsorship_sponsor_id_foreign` (`sponsor_id`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun_kurikulum`
--
ALTER TABLE `tahun_kurikulum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_lists_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_agama_id_foreign` (`agama_id`),
  ADD KEY `users_jenis_kelamin_id_foreign` (`jenis_kelamin_id`),
  ADD KEY `users_pendidikan_id_foreign` (`pendidikan_id`),
  ADD KEY `users_golongan_darah_id_foreign` (`golongan_darah_id`),
  ADD KEY `users_lokasi_penugasan_id_foreign` (`lokasi_penugasan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `anak`
--
ALTER TABLE `anak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `carousel_items`
--
ALTER TABLE `carousel_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `deskripsi_latar_belakang`
--
ALTER TABLE `deskripsi_latar_belakang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detailraports`
--
ALTER TABLE `detailraports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_fasilitas`
--
ALTER TABLE `detail_fasilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_galeri`
--
ALTER TABLE `detail_galeri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_ppi_a`
--
ALTER TABLE `detail_ppi_a`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_ppi_b`
--
ALTER TABLE `detail_ppi_b`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_program`
--
ALTER TABLE `detail_program`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `disabilitas`
--
ALTER TABLE `disabilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `donatur`
--
ALTER TABLE `donatur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `donatur_donasi`
--
ALTER TABLE `donatur_donasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `format_laporan`
--
ALTER TABLE `format_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `foundation_histories`
--
ALTER TABLE `foundation_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gambar_latar_belakang`
--
ALTER TABLE `gambar_latar_belakang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `golongan_darah`
--
ALTER TABLE `golongan_darah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_pembelajaran`
--
ALTER TABLE `jadwal_pembelajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan_disabilitas`
--
ALTER TABLE `kebutuhan_disabilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kode_laporan`
--
ALTER TABLE `kode_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `latar_belakang`
--
ALTER TABLE `latar_belakang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lokasi_penugasan`
--
ALTER TABLE `lokasi_penugasan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `minggu_pembelajaran`
--
ALTER TABLE `minggu_pembelajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `modul_materi`
--
ALTER TABLE `modul_materi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `non_disabilitas`
--
ALTER TABLE `non_disabilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orang_tua_wali`
--
ALTER TABLE `orang_tua_wali`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ppi_model_a`
--
ALTER TABLE `ppi_model_a`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ppi_model_b`
--
ALTER TABLE `ppi_model_b`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `raport`
--
ALTER TABLE `raport`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_medis`
--
ALTER TABLE `riwayat_medis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `semester_tahun_ajaran`
--
ALTER TABLE `semester_tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `silabus`
--
ALTER TABLE `silabus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sponsorship`
--
ALTER TABLE `sponsorship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `sponsor_sponsorship`
--
ALTER TABLE `sponsor_sponsorship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tahun_kurikulum`
--
ALTER TABLE `tahun_kurikulum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `anak`
--
ALTER TABLE `anak`
  ADD CONSTRAINT `anak_agama_id_foreign` FOREIGN KEY (`agama_id`) REFERENCES `agama` (`id`),
  ADD CONSTRAINT `anak_golongan_darah_id_foreign` FOREIGN KEY (`golongan_darah_id`) REFERENCES `golongan_darah` (`id`),
  ADD CONSTRAINT `anak_jenis_kelamin_id_foreign` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `jenis_kelamin` (`id`),
  ADD CONSTRAINT `anak_kebutuhan_disabilitas_id_foreign` FOREIGN KEY (`kebutuhan_disabilitas_id`) REFERENCES `kebutuhan_disabilitas` (`id`),
  ADD CONSTRAINT `anak_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi_penugasan` (`id`),
  ADD CONSTRAINT `anak_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_berita` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `berita_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `carousel_items`
--
ALTER TABLE `carousel_items`
  ADD CONSTRAINT `carousel_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `deskripsi_latar_belakang`
--
ALTER TABLE `deskripsi_latar_belakang`
  ADD CONSTRAINT `deskripsi_latar_belakang_latar_belakang_id_foreign` FOREIGN KEY (`latar_belakang_id`) REFERENCES `latar_belakang` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detailraports`
--
ALTER TABLE `detailraports`
  ADD CONSTRAINT `detailraports_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `detailraports_raport_id_foreign` FOREIGN KEY (`raport_id`) REFERENCES `raport` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_fasilitas`
--
ALTER TABLE `detail_fasilitas`
  ADD CONSTRAINT `detail_fasilitas_fasilitas_id_foreign` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_galeri`
--
ALTER TABLE `detail_galeri`
  ADD CONSTRAINT `detail_galeri_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeri` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_ppi_a`
--
ALTER TABLE `detail_ppi_a`
  ADD CONSTRAINT `detail_ppi_a_ppia_id_foreign` FOREIGN KEY (`ppiA_id`) REFERENCES `ppi_model_a` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_ppi_b`
--
ALTER TABLE `detail_ppi_b`
  ADD CONSTRAINT `detail_ppi_b_ppib_id_foreign` FOREIGN KEY (`ppiB_id`) REFERENCES `ppi_model_b` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_program`
--
ALTER TABLE `detail_program`
  ADD CONSTRAINT `detail_program_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`);

--
-- Ketidakleluasaan untuk tabel `donatur`
--
ALTER TABLE `donatur`
  ADD CONSTRAINT `donatur_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `donatur_donasi`
--
ALTER TABLE `donatur_donasi`
  ADD CONSTRAINT `donatur_donasi_donasi_id_foreign` FOREIGN KEY (`donasi_id`) REFERENCES `donasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donatur_donasi_donatur_id_foreign` FOREIGN KEY (`donatur_id`) REFERENCES `donatur` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `format_laporan`
--
ALTER TABLE `format_laporan`
  ADD CONSTRAINT `format_laporan_kode_laporan_id_foreign` FOREIGN KEY (`kode_laporan_id`) REFERENCES `kode_laporan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `format_laporan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foundation_histories`
--
ALTER TABLE `foundation_histories`
  ADD CONSTRAINT `foundation_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gambar_latar_belakang`
--
ALTER TABLE `gambar_latar_belakang`
  ADD CONSTRAINT `gambar_latar_belakang_latar_belakang_id_foreign` FOREIGN KEY (`latar_belakang_id`) REFERENCES `latar_belakang` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_pembelajaran`
--
ALTER TABLE `jadwal_pembelajaran`
  ADD CONSTRAINT `jadwal_pembelajaran_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pembelajaran_lokasi_penugasan_id_foreign` FOREIGN KEY (`lokasi_penugasan_id`) REFERENCES `lokasi_penugasan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pembelajaran_minggu_pembelajaran_id_foreign` FOREIGN KEY (`minggu_pembelajaran_id`) REFERENCES `minggu_pembelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pembelajaran_modul_materi_id_foreign` FOREIGN KEY (`modul_materi_id`) REFERENCES `modul_materi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_pembelajaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_semester_tahun_ajaran_id_foreign` FOREIGN KEY (`semester_tahun_ajaran_id`) REFERENCES `semester_tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_tahun_kurikulum_id_foreign` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `tahun_kurikulum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `latar_belakang`
--
ALTER TABLE `latar_belakang`
  ADD CONSTRAINT `latar_belakang_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `latar_belakang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `minggu_pembelajaran`
--
ALTER TABLE `minggu_pembelajaran`
  ADD CONSTRAINT `minggu_pembelajaran_lokasi_penugasan_id_foreign` FOREIGN KEY (`lokasi_penugasan_id`) REFERENCES `lokasi_penugasan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `modul_materi`
--
ALTER TABLE `modul_materi`
  ADD CONSTRAINT `modul_materi_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_materi_minggu_pembelajaran_id_foreign` FOREIGN KEY (`minggu_pembelajaran_id`) REFERENCES `minggu_pembelajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_materi_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_materi_tahun_kurikulum_id_foreign` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `tahun_kurikulum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modul_materi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orang_tua_wali`
--
ALTER TABLE `orang_tua_wali`
  ADD CONSTRAINT `orang_tua_wali_agama_id_foreign` FOREIGN KEY (`agama_id`) REFERENCES `agama` (`id`),
  ADD CONSTRAINT `orang_tua_wali_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`),
  ADD CONSTRAINT `orang_tua_wali_pekerjaan_ayah_id_foreign` FOREIGN KEY (`pekerjaan_ayah_id`) REFERENCES `pekerjaan` (`id`),
  ADD CONSTRAINT `orang_tua_wali_pekerjaan_ibu_id_foreign` FOREIGN KEY (`pekerjaan_ibu_id`) REFERENCES `pekerjaan` (`id`),
  ADD CONSTRAINT `orang_tua_wali_pekerjaan_wali_id_foreign` FOREIGN KEY (`pekerjaan_wali_id`) REFERENCES `pekerjaan` (`id`),
  ADD CONSTRAINT `orang_tua_wali_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ppi_model_a`
--
ALTER TABLE `ppi_model_a`
  ADD CONSTRAINT `ppi_model_a_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`),
  ADD CONSTRAINT `ppi_model_a_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ppi_model_b`
--
ALTER TABLE `ppi_model_b`
  ADD CONSTRAINT `ppi_model_b_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ppi_model_b_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `raport`
--
ALTER TABLE `raport`
  ADD CONSTRAINT `raport_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`),
  ADD CONSTRAINT `raport_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester_tahun_ajaran` (`id`),
  ADD CONSTRAINT `raport_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`),
  ADD CONSTRAINT `raport_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_medis`
--
ALTER TABLE `riwayat_medis`
  ADD CONSTRAINT `riwayat_medis_anak_id_foreign` FOREIGN KEY (`anak_id`) REFERENCES `anak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_medis_penyakit_id_foreign` FOREIGN KEY (`penyakit_id`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_medis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `silabus`
--
ALTER TABLE `silabus`
  ADD CONSTRAINT `silabus_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `silabus_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajaran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `silabus_tahun_kurikulum_id_foreign` FOREIGN KEY (`tahun_kurikulum_id`) REFERENCES `tahun_kurikulum` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `silabus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sponsor_sponsorship`
--
ALTER TABLE `sponsor_sponsorship`
  ADD CONSTRAINT `sponsor_sponsorship_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sponsor_sponsorship_sponsorship_id_foreign` FOREIGN KEY (`sponsorship_id`) REFERENCES `sponsorship` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `todo_lists`
--
ALTER TABLE `todo_lists`
  ADD CONSTRAINT `todo_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_agama_id_foreign` FOREIGN KEY (`agama_id`) REFERENCES `agama` (`id`),
  ADD CONSTRAINT `users_golongan_darah_id_foreign` FOREIGN KEY (`golongan_darah_id`) REFERENCES `golongan_darah` (`id`),
  ADD CONSTRAINT `users_jenis_kelamin_id_foreign` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `jenis_kelamin` (`id`),
  ADD CONSTRAINT `users_lokasi_penugasan_id_foreign` FOREIGN KEY (`lokasi_penugasan_id`) REFERENCES `lokasi_penugasan` (`id`),
  ADD CONSTRAINT `users_pendidikan_id_foreign` FOREIGN KEY (`pendidikan_id`) REFERENCES `pendidikan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
