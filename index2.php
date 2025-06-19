<?php 
include 'partials/navbarsiswa.php'; 
include 'config/db.php'; 

$query = "SELECT * FROM course WHERE status = 'dibuka' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (isset($_SESSION['error'])) {
  echo '<p style="color: #ff5555; text-align:center;">'.htmlspecialchars($_SESSION['error']).'</p>';
  unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Course SanggarDigital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="index.css" />
</head>
<body>

<main class="hero">
  <div class="container">
    <h1>Selamat Datang di Course SanggarDigital</h1>
    <p>Belajar online bersama Mentor terbaik di SanggarDigital.</p>
  </div>
</main>

<div class="section-divider"></div>

<section class="paket-course">
  <h2>Pilihan Course</h2>

  <div class="course-list">
    <?php if(mysqli_num_rows($result) > 0): ?>
      <?php while($course = mysqli_fetch_assoc($result)): ?>
        <div class="course-card">
          <div class="course-image-container">
            <img src="<?= htmlspecialchars($course['foto'] ? 'course/uploads/' . $course['foto'] : 'default-course.jpg') ?>" 
              alt="<?= htmlspecialchars($course['nama_course']) ?>" />
            <a href="detail_paket.php?id=<?= $course['id'] ?>" class="detail-link">Lihat Detail</a>
          </div>

          <div class="course-content">
            <h3 class="course-title"><?= htmlspecialchars($course['nama_course']) ?></h3>

            <div class="tags">
              <span class="tag">🎓 <?= htmlspecialchars($course['jenjang']) ?></span>
              <span class="tag">🗓️ <?= htmlspecialchars($course['periode']) ?></span>
              <span class="tag price">💰 Rp <?= number_format($course['harga'], 0, ',', '.') ?></span>
            </div>

            <p class="summary">
              <?= nl2br(htmlspecialchars(substr($course['ringkasan'], 0, 80))) ?><?= (strlen($course['ringkasan']) > 80 ? '...' : '') ?>
            </p>
          </div>

          <div class="course-footer">
            <a href="pesan_course.php?id=<?= $course['id'] ?>" class="btn-follow">Pesan Paket</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="width: 100%; text-align: center; font-size: 1.2rem; color: #ff6f61;">Belum ada paket course yang tersedia.</p>
    <?php endif; ?>
  </div>
</section>

</body>
</html>

<?php include 'partials/footerluar.php'; ?>
