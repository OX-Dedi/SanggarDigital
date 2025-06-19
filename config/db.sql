

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



INSERT INTO `course` (`id`, `nama_course`, `jenjang`, `ringkasan`, `foto`, `status`, `periode`, `harga`, `created_at`) VALUES
(3, 'Microsoft Word', 'SMA', 'Belajar Operasional Microsoft Word \r\n1. Pengenalan Microsoft Word \r\n+) Fungsi, antarmuka, ribbon, menyimpan dokumen \r\n2. Pengetikan & Format Teks \r\n+) Bold, Italic, Underline, warna, font, alignment \r\n3. Paragraf dan Spasi Indentasi, spacing, bullets & numbering, borders \r\n+) Pengaturan Halaman Margin, orientasi, page break, header/footer, page number \r\n4. Menyisipkan Objek Gambar, shapes, SmartArt, text box, posisi objek Tabel di Word \r\n+) Membuat dan mengedit tabel, merge/split, desain tabel Penyuntingan & Review Find & Replace, spelling check, word count, track changes \r\n5. Heading & Daftar Isi Heading style\r\n+) multilevel list, membuat Table of Contents Mail Merge Menghubungkan dengan Excel, membuat surat masal \r\n6. Desain & Layout Dokumen Cover\r\n+)  themes, border halaman, kolom, watermark \r\n7. Pembuatan Dokumen Profesional \r\n+) Contoh CV, surat, makalah, simulasi tugas Proyek Akhir Pembuatan laporan lengkap, evaluasi\r\n', 'microsoft-word-now-and-then-260729887-16x9_0.webp', 'dibuka', '01 Juni s/d 1Agustus 2025', 50000.00, '2025-05-16 18:44:18'),
(5, 'Microsoft Excel', 'SMP', '1. Mengenal Antarmuka Excel\r\n•	Memahami Ribbon, Tab (Home, Insert, Page Layout, dsb.)\r\n•	Fungsi Cell, Sheet, Workbook\r\n________________________________________\r\n2. Penggunaan Dasar Cell\r\n•	Mengetik data, mengedit, menyalin, memindahkan\r\n•	Menggunakan Fill Handle untuk mengisi otomatis\r\n________________________________________\r\n3. Format Data\r\n•	Mengatur jenis data: angka, tanggal, teks\r\n•	Format cell: warna, border, align, currency, dll\r\n________________________________________\r\n4. Fungsi dan Rumus Dasar\r\n•	Penjumlahan (SUM), Rata-rata (AVERAGE), Maksimum (MAX), Minimum (MIN)\r\n•	Penggabungan teks (CONCATENATE / TEXTJOIN)\r\n________________________________________\r\n5. Fungsi Logika\r\n•	IF, AND, OR, IFERROR\r\n•	Contoh: =IF(A1>70, \"Lulus\", \"Tidak Lulus\")\r\n________________________________________\r\n6. Pengurutan dan Penyaringan Data\r\n•	Sortir data (A-Z, Z-A, berdasarkan nilai tertentu)\r\n•	Filter data untuk menampilkan hanya yang relevan\r\n________________________________________\r\n7. Tabel dan Format Tabel\r\n•	Mengubah data menjadi tabel (Insert > Table)\r\n•	Fitur auto-filter, pemformatan dinamis\r\n________________________________________\r\n8. Visualisasi Data\r\n•	Membuat grafik (bar, pie, line, dsb.)\r\n•	Menyesuaikan elemen grafik (judul, label, warna)\r\n________________________________________\r\n9. Penggunaan Fungsi Lookup\r\n•	VLOOKUP, HLOOKUP, XLOOKUP (untuk versi terbaru)\r\n•	INDEX dan MATCH untuk pencarian lanjutan\r\n________________________________________\r\n10. Pembuatan Pivot Table\r\n•	Meringkas dan menganalisis data besar\r\n•	Drag & drop field untuk membuat laporan dinamis\r\n\r\n', 'Microsoft-Excel-Emblem.png', 'dibuka', '01 Juni s/d 1Agustus 2025', 100000.00, '2025-05-17 11:26:23'),
(6, 'Microsoft PowerPoint', 'Kuliah', '🧠 Dasar-Dasar PowerPoint\r\n1.	Memahami Antarmuka PowerPoint\r\no	Ribbon (Home, Insert, Design, dll.)\r\no	Slide pane & thumbnail\r\no	Notes area (catatan pembicara)\r\n________________________________________\r\n🎨 Desain Slide yang Menarik\r\n2.	Menggunakan Template dan Tema\r\no	Pilih tema yang konsisten\r\no	Sesuaikan warna, font, dan background\r\n3.	Mengatur Tata Letak Slide (Layout)\r\no	Gunakan layout bawaan: Title Slide, Title and Content, dll.\r\no	Manfaatkan fitur \"Slide Master\" untuk konsistensi\r\n4.	Pemilihan Warna dan Font\r\no	Gunakan kombinasi warna yang kontras\r\no	Gunakan font profesional dan mudah dibaca\r\n________________________________________\r\n📊 Konten Visual\r\n5.	Menambahkan dan Mengatur Gambar, Ikon, dan Video\r\no	Insert → Pictures, Icons, Video\r\no	Gunakan crop, transparency, dan align tools\r\n6.	Membuat dan Mengedit Grafik & Diagram\r\no	Insert → Chart / SmartArt\r\no	Cocok untuk menjelaskan proses atau data statistik\r\n7.	Menerapkan Transisi dan Animasi\r\no	Transitions untuk berpindah slide\r\no	Animations untuk menghidupkan konten\r\n________________________________________\r\n🧩 Efisiensi dan Interaktivitas\r\n8.	Menambahkan Hyperlink dan Tombol Navigasi\r\no	Untuk membuat presentasi interaktif (non-linear)\r\no	Cocok untuk quiz, menu, atau peta presentasi\r\n9.	Gunakan Shortcut dan Tools Efisien\r\no	Ctrl + M (slide baru), Ctrl + D (duplikat), F5 (presentasi penuh)\r\no	Gunakan fitur “Designer” (PowerPoint 365) untuk saran desain otomatis\r\n________________________________________\r\n🎤 Presentasi dan Output\r\n10.	Mode Presentasi dan Export File\r\n•	Gunakan Presenter View (dengan catatan)\r\n•	Export sebagai PDF, video, atau handout\r\n\r\n', 'powerpoint.jpg', 'dibuka', '01 Juni s/d 1Agustus 2025', 80000.00, '2025-05-17 11:32:56');


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','guru','siswa') DEFAULT 'siswa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;


CREATE TABLE `kelas` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_kelas` VARCHAR(255) NOT NULL,
  `course_id` INT NOT NULL,
  `guru_id` INT NOT NULL,
  `deskripsi` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`course_id`) REFERENCES course(`id`),
  FOREIGN KEY (`guru_id`) REFERENCES users(`id`)
);

CREATE TABLE `enroll` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kelas_id` INT NOT NULL,
  `user_id` INT NOT NULL, 
  `enrolled_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`kelas_id`) REFERENCES kelas(`id`),
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
);

CREATE TABLE `materi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kelas_id` INT NOT NULL,
  `judul` VARCHAR(255) NOT NULL,
  `penjelasan` TEXT,
  `file_materi` VARCHAR(255),  
  `link_video` VARCHAR(255),      
  `link_zoom` VARCHAR(255),      
  `link_absen` VARCHAR(255),     
  `video_belajar` VARCHAR(255),   
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`kelas_id`) REFERENCES kelas(`id`)
);

CREATE TABLE diskusi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kelas_id INT,
    user_id INT,
    isi TEXT,
    waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE sertifikat ( id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, kelas_id INT NOT NULL, sertifikat_path VARCHAR(255) NOT NULL, tanggal_selesai DATE NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (user_id) REFERENCES users(id), FOREIGN KEY (kelas_id) REFERENCES kelas(id) );

CREATE TABLE `pesanan_course` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `course_id` INT(11) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `bukti_transfer` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('diproses','disetujui','ditolak') DEFAULT 'diproses',
  `feedback_admin` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`course_id`) REFERENCES `course`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


