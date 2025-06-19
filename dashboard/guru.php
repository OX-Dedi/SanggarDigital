<?php 
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebarguru.php';
?>

<link rel="stylesheet" href="guru.css">

<div class="guru-dashboard">
  <h2>Dashboard Guru</h2>
  <ul class="guru-menu">
    <li>
      <div class="guru-card" onclick="location.href='../guru/guru_kelas_saya.php'">
        <h3>Kelas Saya</h3>
        <p>Kelola kelas yang Anda ajar</p>
      </div>
    </li>
    <li>
      <div class="guru-card" onclick="location.href='../guru/materi_guru.php'">
        <h3>Tambah Materi</h3>
        <p>Upload materi baru untuk siswa</p>
      </div>
    </li>
  </ul>
</div>

<?php include '../partials/footer.php'; ?>
