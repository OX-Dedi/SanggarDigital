<?php 
include '../config/db.php';
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama_course'];
  $jenjang = $_POST['jenjang'];
  $ringkasan = $_POST['ringkasan'];
  $status = $_POST['status'];
  $periode = $_POST['periode'];
  $harga = $_POST['harga'];

  $foto = $_FILES['foto']['name'];
  $tmp = $_FILES['foto']['tmp_name'];
  move_uploaded_file($tmp, "uploads/" . $foto);

  $conn->query("INSERT INTO course (nama_course, jenjang, ringkasan, foto, status, periode, harga)
    VALUES ('$nama', '$jenjang', '$ringkasan', '$foto', '$status', '$periode', '$harga')");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Course</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #1e1e2f;
      color: white;
      margin: 0;
      padding: 0;
    }
    .container {
      display: flex;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
      padding-top: 90px;
      min-height: calc(100vh - 60px);
      width: 100%;
    }

    .form-box {
      background-color: #2c2c3c;
      padding: 30px;
      border-radius: 12px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: white;
    }

    input, textarea, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #444;
      border-radius: 8px;
      font-size: 14px;
      background-color: #1f1f2e;
      color: white;
    }

    textarea {
      resize: vertical;
    }

    button {
      background-color: #2563eb;
      color: white;
      border: none;
      padding: 14px;
      width: 100%;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #1e40af;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 220px;
      height: 40px;
      width: calc(100% - 220px);
      background-color: #2563eb;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.9rem;
      box-sizing: border-box;
      user-select: none;
      transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0 !important;
        padding: 20px 15px;
        padding-top: 100px;
      }
      footer {
        left: 0;
        width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="main-content">
    <div class="form-box">
      <h2>Tambah Course</h2>
      <form method="post" enctype="multipart/form-data">
        <input name="nama_course" placeholder="Nama Course" required>
        <input name="jenjang" placeholder="Jenjang">
        <textarea name="ringkasan" placeholder="Ringkasan Bahasan"></textarea>
        <input type="file" name="foto" required>
        <select name="status">
          <option value="dibuka">Dibuka</option>
          <option value="belum dibuka">Belum Dibuka</option>
        </select>
        <input name="periode" placeholder="Periode Pembelajaran">
        <input type="number" name="harga" placeholder="Harga Course" required>
        <button type="submit">Simpan</button>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
