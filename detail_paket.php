<?php 
include 'config/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if(!$id) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM course WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) === 0){
    echo "<h2 style='text-align:center; margin-top:3rem;'>Paket tidak ditemukan.</h2>";
    exit;
}
$course = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Paket - <?= htmlspecialchars($course['nama_course']) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="detail_paket.css" rel="stylesheet">
</head>
<body>
  <div class="main-container">
    <div class="tab-nav">
      <button class="tab-btn active" data-target="info">Info</button>
      <button class="tab-btn" data-target="ringkasan">Ringkasan</button>
    </div>
    
    <div class="card-container">
      <div class="card-content active" id="info">
        <h1><?= htmlspecialchars($course['nama_course']) ?></h1>
        <div class="info-grid">
          <div>
            <strong>Jenjang</strong>
            <?= htmlspecialchars($course['jenjang']) ?>
          </div>
          <div>
            <strong>Periode</strong>
            <?= htmlspecialchars($course['periode']) ?>
          </div>
          <div>
            <strong>Harga</strong>
            Rp <?= number_format($course['harga'], 0, ',', '.') ?>
          </div>
        </div>
      </div>

      <div class="card-content" id="ringkasan">
        <h2>Ringkasan</h2>
        <p><?= nl2br(htmlspecialchars($course['ringkasan'])) ?></p>
      </div>

      <a href="index.php" class="back">&larr; Kembali ke Daftar Paket</a>
    </div>
  </div>

  <script>
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.card-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(btn => btn.classList.remove('active'));
        contents.forEach(content => content.classList.remove('active'));

        tab.classList.add('active');
        document.getElementById(tab.dataset.target).classList.add('active');
      });
    });
  </script>
</body>
</html>
