<?php
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';  
include '../config/db.php';

$kelas_id = (int)$_GET['id'];

$siswa = mysqli_query($conn, "SELECT * FROM users WHERE role='siswa'");

$enrolled = mysqli_query($conn, "
  SELECT users.id, users.name FROM enroll 
  JOIN users ON enroll.user_id = users.id 
  WHERE enroll.kelas_id = $kelas_id
");
?>3

<link rel="stylesheet" href="admin_kelas_enroll.css" />

<div class="main-content">
  <div class="container">
    <h2>Enroll Siswa ke Kelas</h2>

    <form action="admin_kelas_enroll_proses.php" method="POST">
      <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">

      <label for="user_id">Pilih Siswa:</label>
      <select id="user_id" name="user_id" required>
        <?php while ($s = mysqli_fetch_assoc($siswa)) { ?>
          <option value="<?= htmlspecialchars($s['id']) ?>"><?= htmlspecialchars($s['name']) ?></option>
        <?php } ?>
      </select>

      <button type="submit">Enroll</button>
    </form>

    <h3>Siswa Sudah Terdaftar</h3>
    <ul>
      <?php while ($e = mysqli_fetch_assoc($enrolled)) { ?>
        <li>
          <?= htmlspecialchars($e['name']) ?>
          <form action="admin_kelas_enroll_hapus.php" method="POST" style="display:inline;">
            <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($e['id']) ?>">
            <button type="submit" onclick="return confirm('Yakin ingin menghapus siswa ini dari kelas?')">Un-Enroll</button>
          </form>
        </li>
      <?php } ?>
    </ul>

  </div>
</div>

<?php
include __DIR__ . '/../partials/footer.php';
?>
