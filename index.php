<?php 
include 'partials/navbar.php';
include 'config/db.php';  

$query = "SELECT * FROM course WHERE status = 'dibuka' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);


session_start();
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
    <div class="btn-container">
      <a href="register.php" class="btn-register">Daftar Sekarang</a>
    </div>
  </div>
</main>

<div class="login-modal" id="loginModal">
  <div class="login-box">
    <button class="close-btn" onclick="closeModal()">×</button>
    <h2 class="neon-text">
      <span>P</span><span>o</span><span>r</span><span>t</span><span>a</span><span>l</span>
    </h2>
    <h2 class="neon-text">
      <span>S</span><span>a</span><span>n</span><span>g</span><span>g</span><span>a</span><span>r</span>
      <span>D</span><span>i</span><span>g</span><span>i</span><span>t</span><span>a</span><span>l</span>
    </h2>

    <form action="proses_login.php" method="POST">
      <input type="text" name="username" placeholder="Username or Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    
    <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
  </div>
</div>



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
            <?php if(isset($_SESSION['user'])): ?>
              <form action="ikuti_course.php" method="POST">
                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                <button type="submit" class="btn-follow">Ikuti Sekarang</button>
              </form>
            <?php else: ?>
              <a href="register.php" class="btn-register">Daftar & Ikuti</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="width: 100%; text-align: center; font-size: 1.2rem; color: #ff6f61;">Belum ada paket course yang tersedia.</p>
    <?php endif; ?>
  </div>
</section>



<!-- Script -->
<script>
  const btnLogin = document.getElementById("btnShowLogin");
  const loginModal = document.getElementById("loginModal");
  const closeBtn = loginModal.querySelector(".close-btn");

  btnLogin.addEventListener("click", function (e) {
    e.preventDefault();
    loginModal.classList.add("show");
    loginModal.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");
  });

  function closeLogin() {
    loginModal.classList.remove("show");
    loginModal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("modal-open");
  }

  closeBtn.addEventListener("click", closeLogin);

  window.addEventListener("click", function (e) {
    if (e.target === loginModal) {
      closeLogin();
    }
  });

  window.addEventListener("keydown", function(e) {
    if(e.key === "Escape" && loginModal.classList.contains("show")) {
      closeLogin();
    }
  });
  
</script>
</body>
</html>

<?php include 'partials/footerluar.php'; ?>
