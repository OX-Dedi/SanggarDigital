-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2025 at 03:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csanggardigital`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `nama_course` varchar(255) NOT NULL,
  `jenjang` varchar(100) DEFAULT NULL,
  `ringkasan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('dibuka','belum dibuka') DEFAULT 'belum dibuka',
  `periode` varchar(100) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `nama_course`, `jenjang`, `ringkasan`, `foto`, `status`, `periode`, `harga`, `created_at`) VALUES
(3, 'Microsoft Word', 'SMA', 'Belajar Operasional Microsoft Word \r\n1. Pengenalan Microsoft Word \r\n+) Fungsi, antarmuka, ribbon, menyimpan dokumen \r\n2. Pengetikan & Format Teks \r\n+) Bold, Italic, Underline, warna, font, alignment \r\n3. Paragraf dan Spasi Indentasi, spacing, bullets & numbering, borders \r\n+) Pengaturan Halaman Margin, orientasi, page break, header/footer, page number \r\n4. Menyisipkan Objek Gambar, shapes, SmartArt, text box, posisi objek Tabel di Word \r\n+) Membuat dan mengedit tabel, merge/split, desain tabel Penyuntingan & Review Find & Replace, spelling check, word count, track changes \r\n5. Heading & Daftar Isi Heading style\r\n+) multilevel list, membuat Table of Contents Mail Merge Menghubungkan dengan Excel, membuat surat masal \r\n6. Desain & Layout Dokumen Cover\r\n+)  themes, border halaman, kolom, watermark \r\n7. Pembuatan Dokumen Profesional \r\n+) Contoh CV, surat, makalah, simulasi tugas Proyek Akhir Pembuatan laporan lengkap, evaluasi\r\n', 'microsoft-word-now-and-then-260729887-16x9_0.webp', 'dibuka', '01 Juni s/d 1Agustus 2025', 50000.00, '2025-05-16 18:44:18'),
(5, 'Microsoft Excel', 'SMP', '1. Mengenal Antarmuka Excel\r\n•	Memahami Ribbon, Tab (Home, Insert, Page Layout, dsb.)\r\n•	Fungsi Cell, Sheet, Workbook\r\n________________________________________\r\n2. Penggunaan Dasar Cell\r\n•	Mengetik data, mengedit, menyalin, memindahkan\r\n•	Menggunakan Fill Handle untuk mengisi otomatis\r\n________________________________________\r\n3. Format Data\r\n•	Mengatur jenis data: angka, tanggal, teks\r\n•	Format cell: warna, border, align, currency, dll\r\n________________________________________\r\n4. Fungsi dan Rumus Dasar\r\n•	Penjumlahan (SUM), Rata-rata (AVERAGE), Maksimum (MAX), Minimum (MIN)\r\n•	Penggabungan teks (CONCATENATE / TEXTJOIN)\r\n________________________________________\r\n5. Fungsi Logika\r\n•	IF, AND, OR, IFERROR\r\n•	Contoh: =IF(A1>70, \"Lulus\", \"Tidak Lulus\")\r\n________________________________________\r\n6. Pengurutan dan Penyaringan Data\r\n•	Sortir data (A-Z, Z-A, berdasarkan nilai tertentu)\r\n•	Filter data untuk menampilkan hanya yang relevan\r\n________________________________________\r\n7. Tabel dan Format Tabel\r\n•	Mengubah data menjadi tabel (Insert > Table)\r\n•	Fitur auto-filter, pemformatan dinamis\r\n________________________________________\r\n8. Visualisasi Data\r\n•	Membuat grafik (bar, pie, line, dsb.)\r\n•	Menyesuaikan elemen grafik (judul, label, warna)\r\n________________________________________\r\n9. Penggunaan Fungsi Lookup\r\n•	VLOOKUP, HLOOKUP, XLOOKUP (untuk versi terbaru)\r\n•	INDEX dan MATCH untuk pencarian lanjutan\r\n________________________________________\r\n10. Pembuatan Pivot Table\r\n•	Meringkas dan menganalisis data besar\r\n•	Drag & drop field untuk membuat laporan dinamis\r\n\r\n', 'Microsoft-Excel-Emblem.png', 'dibuka', '01 Juni s/d 1Agustus 2025', 100000.00, '2025-05-17 11:26:23'),
(6, 'Microsoft PowerPoint', 'Kuliah', '🧠 Dasar-Dasar PowerPoint\r\n1.	Memahami Antarmuka PowerPoint\r\no	Ribbon (Home, Insert, Design, dll.)\r\no	Slide pane & thumbnail\r\no	Notes area (catatan pembicara)\r\n________________________________________\r\n🎨 Desain Slide yang Menarik\r\n2.	Menggunakan Template dan Tema\r\no	Pilih tema yang konsisten\r\no	Sesuaikan warna, font, dan background\r\n3.	Mengatur Tata Letak Slide (Layout)\r\no	Gunakan layout bawaan: Title Slide, Title and Content, dll.\r\no	Manfaatkan fitur \"Slide Master\" untuk konsistensi\r\n4.	Pemilihan Warna dan Font\r\no	Gunakan kombinasi warna yang kontras\r\no	Gunakan font profesional dan mudah dibaca\r\n________________________________________\r\n📊 Konten Visual\r\n5.	Menambahkan dan Mengatur Gambar, Ikon, dan Video\r\no	Insert → Pictures, Icons, Video\r\no	Gunakan crop, transparency, dan align tools\r\n6.	Membuat dan Mengedit Grafik & Diagram\r\no	Insert → Chart / SmartArt\r\no	Cocok untuk menjelaskan proses atau data statistik\r\n7.	Menerapkan Transisi dan Animasi\r\no	Transitions untuk berpindah slide\r\no	Animations untuk menghidupkan konten\r\n________________________________________\r\n🧩 Efisiensi dan Interaktivitas\r\n8.	Menambahkan Hyperlink dan Tombol Navigasi\r\no	Untuk membuat presentasi interaktif (non-linear)\r\no	Cocok untuk quiz, menu, atau peta presentasi\r\n9.	Gunakan Shortcut dan Tools Efisien\r\no	Ctrl + M (slide baru), Ctrl + D (duplikat), F5 (presentasi penuh)\r\no	Gunakan fitur “Designer” (PowerPoint 365) untuk saran desain otomatis\r\n________________________________________\r\n🎤 Presentasi dan Output\r\n10.	Mode Presentasi dan Export File\r\n•	Gunakan Presenter View (dengan catatan)\r\n•	Export sebagai PDF, video, atau handout\r\n\r\n', 'powerpoint.jpg', 'dibuka', '01 Juni s/d 1Agustus 2025', 80000.00, '2025-05-17 11:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`id`, `kelas_id`, `user_id`, `isi`, `waktu`, `parent_id`) VALUES
(1, 1, 2, 'Hallo', '2025-05-20 01:22:54', NULL),
(2, 1, 2, 'jadi kali ini kita akan belajar ms word ya\r\n', '2025-05-20 01:26:04', NULL),
(3, 1, 2, 'jadi', '2025-05-20 01:27:49', NULL),
(4, 1, 2, 'kali ini', '2025-05-20 01:27:56', NULL),
(5, 1, 2, 'hallo silahkan tonton', '2025-05-20 17:18:13', NULL),
(6, 1, 2, 'Hallo apa kabar hari ini?', '2025-06-15 19:15:42', NULL),
(7, 1, 3, 'Hallo bu', '2025-06-16 22:35:53', NULL),
(8, 1, 3, 'malam semua', '2025-06-16 22:50:13', NULL),
(9, 1, 3, 'malam semua guys', '2025-06-16 22:50:23', NULL),
(10, 1, 3, 'hello hello\r\n', '2025-06-16 22:54:20', NULL),
(11, 1, 3, 'malam semuanya\r\n', '2025-06-16 23:01:35', NULL),
(12, 1, 3, 'hello selamat pagi semua', '2025-06-17 09:37:55', NULL),
(13, 1, 3, 'Hallo\r\n', '2025-06-17 09:39:38', NULL),
(14, 1, 3, 'tes tes', '2025-06-17 09:41:43', NULL),
(15, 1, 3, 'ada yang tau soal nomor 8?', '2025-06-17 09:41:55', NULL),
(16, 1, 3, 'soal nomor 8 itu salah kayaknya', '2025-06-17 09:49:02', 15),
(17, 1, 3, '', '2025-06-17 09:49:56', NULL),
(18, 1, 3, 'cek lagi coba', '2025-06-17 09:59:46', 17),
(19, 1, 3, 'harusnya sih bisa', '2025-06-17 09:59:58', 15),
(20, 1, 3, 'ini latihan microsoft word gimana ya?', '2025-06-17 10:01:34', 0),
(21, 1, 3, 'gimana bisa?', '2025-06-17 10:01:56', 17),
(22, 1, 3, 'harusnya bisa', '2025-06-17 10:02:06', 0),
(23, 1, 3, 'hallo', '2025-06-17 10:04:13', NULL),
(24, 1, 3, 'ada yang tau b indo ini gimana ngerjainnya?', '2025-06-17 10:04:37', NULL),
(25, 1, 3, 'bisa cek di video ya', '2025-06-17 10:04:46', 24),
(26, 1, 3, 'hallo semuanya', '2025-06-17 10:04:55', NULL),
(27, 1, 3, 'hallo', '2025-06-17 10:07:32', NULL),
(28, 1, 2, 'hallo selamat siang', '2025-06-17 10:08:22', NULL),
(29, 1, 3, 'selamat siang bu', '2025-06-17 10:08:36', 28),
(30, 1, 3, 'silahkan bisa absen pertemuan ke 1 ini pada link berikut ya : https://cv-dedi.4rk-0n3.com/', '2025-06-17 10:14:16', NULL),
(31, 1, 3, 'baik pak', '2025-06-17 10:14:23', 30),
(32, 1, 2, 'sip', '2025-06-17 10:35:20', 30),
(33, 1, 2, 'hallo', '2025-06-17 10:41:35', NULL),
(34, 1, 2, 'hallo juga', '2025-06-17 10:41:45', 33),
(35, 1, 2, 'mantap', '2025-06-17 10:41:53', 30),
(36, 1, 2, 'Selamat Pagi semuanya', '2025-06-17 10:53:02', NULL),
(37, 1, 3, 'Pagi pak/buk', '2025-06-17 10:53:13', 36),
(38, 1, 2, 'hallo', '2025-06-17 11:01:15', NULL),
(39, 1, 2, 'silahkan kerjakan pertemuan 1 ya', '2025-06-17 11:01:32', NULL),
(40, 1, 3, 'Pak buk materi pertemuan 2 tadi ada yang kurang jelas', '2025-06-17 12:21:14', NULL),
(41, 1, 3, 'lebih tepatnya pada bagian video', '2025-06-17 12:21:33', 40),
(42, 1, 2, 'yang tadi terkait microsoft word', '2025-06-17 12:22:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `kelas_id`, `user_id`, `enrolled_at`) VALUES
(2, 2, 3, '2025-06-15 12:18:06'),
(3, 1, 3, '2025-06-17 05:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `course_id`, `guru_id`, `deskripsi`, `created_at`) VALUES
(1, 'Kelas Microsoft Word #BATCH 1', 3, 2, 'Ini adalah kelas Batch #1 untuk jenjang SMA', '2025-05-19 17:22:16'),
(2, 'Kelas Microsoft Excel #BATCH 1', 5, 2, 'Belajar Microsoft Excel', '2025-05-19 17:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penjelasan` text DEFAULT NULL,
  `file_materi` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  `link_zoom` varchar(255) DEFAULT NULL,
  `link_absen` varchar(255) DEFAULT NULL,
  `video_belajar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `kelas_id`, `judul`, `penjelasan`, `file_materi`, `link_video`, `link_zoom`, `link_absen`, `video_belajar`, `created_at`) VALUES
(1, 1, 'Perkenalan Tentang Microsoft Word', 'Microsoft Word adalah program pengolah kata (word processor) yang dikembangkan oleh Microsoft. Fungsinya untuk membuat, mengedit, dan memformat dokumen teks seperti surat, laporan, artikel, dan lain-lain. Word menyediakan berbagai fitur seperti pengecekan ejaan, tata letak halaman, penyisipan gambar, tabel, grafik, dan template siap pakai, sehingga memudahkan pengguna membuat dokumen profesional dengan cepat dan mudah.', 'uploads/1747679060_TOR SPORTIVANISTA (3).pdf', 'https://youtu.be/xWnDr5gF240?si=DskDcR_gJ1zK0fRC', '', '', '', '2025-05-19 18:24:20'),
(2, 1, 'Latihan Microsoft Word Bagian 2', 'Latihan', 'uploads/1750137537_surat_keterangan_21552011453.pdf', 'https://youtu.be/Ua2ws-LcLxE?si=BKLNnv2nFxH95yVJ', NULL, NULL, NULL, '2025-06-17 05:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_course`
--

CREATE TABLE `pesanan_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `metode_bayar` enum('bank','qr') DEFAULT 'bank',
  `status` enum('diproses','disetujui','ditolak') DEFAULT 'diproses',
  `feedback_admin` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_course`
--

INSERT INTO `pesanan_course` (`id`, `course_id`, `username`, `email`, `bukti_transfer`, `metode_bayar`, `status`, `feedback_admin`, `created_at`, `user_id`) VALUES
(1, 6, 'siswa', 'siswa@sd.ac.id', 'uploads/684c6078dac0d_contoh tf.jpeg', 'bank', 'ditolak', 'Salah inima', '2025-06-13 17:31:36', NULL),
(2, 6, 'siswa', '', 'uploads/684c6214a2546_contoh tf.jpeg', 'bank', 'ditolak', 'ini kurang uangnya', '2025-06-13 17:38:28', 3),
(3, 6, 'Siswa SD', '', 'uploads/684c623e2a45e_contoh tf.jpeg', 'qr', 'disetujui', 'Oke ini sudah oke', '2025-06-13 17:39:10', 3),
(4, 3, 'Siswa SD', 'siswa@sd.ac.id', 'uploads/684c6714474c6_contoh tf.jpeg', 'qr', 'diproses', NULL, '2025-06-13 17:59:48', 3),
(5, 5, 'Siswa SD', 'siswa@sd.ac.id', 'uploads/684c6788e83c3_contoh tf.jpeg', 'qr', 'diproses', NULL, '2025-06-13 18:01:44', 3),
(6, 3, 'Siswa SD', 'siswa@sd.ac.id', 'uploads/6850f9acebcf5_ChatGPT Image Jun 15, 2025, 11_22_04 PM.png', 'bank', 'disetujui', 'Masuk ke kelas microsoft word', '2025-06-17 05:14:20', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `sertifikat_path` varchar(255) NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','guru','siswa') DEFAULT 'siswa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `photo`) VALUES
(1, 'Admin SD', 'admin@sd.ac.id', '0192023a7bbd73250516f069df18b500', 'admin', '2025-05-16 09:30:45', 'uploads/1747419644_SD.png'),
(2, 'Guru SD', 'guru@sd.ac.id', '9310f83135f238b04af729fec041cca8', 'guru', '2025-05-16 09:30:45', 'uploads/1747635742_be54732182dc883f97dca0ec34315931.jpg'),
(3, 'Siswa SD', 'siswa@sd.ac.id', '3afa0d81296a4f17d477ec823261b1ec', 'siswa', '2025-05-16 09:30:45', 'uploads/1748111906_cute-manga-boy-cat-illustrationt-600nw-2425745999.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `pesanan_course`
--
ALTER TABLE `pesanan_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan_course`
--
ALTER TABLE `pesanan_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `diskusi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `pesanan_course`
--
ALTER TABLE `pesanan_course`
  ADD CONSTRAINT `pesanan_course_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sertifikat_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
