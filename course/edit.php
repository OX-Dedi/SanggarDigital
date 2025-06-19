<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/db.php';
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';

$id = $_GET['id'] ?? 0;
$data = $conn->query("SELECT * FROM course WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama_course'];
  $jenjang = $_POST['jenjang'];
  $ringkasan = $_POST['ringkasan'];
  $status = $_POST['status'];
  $periode = $_POST['periode'];
  $harga = $_POST['harga'];

  if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $foto);
  } else {
    $foto = $data['foto'];
  }

  $conn->query("UPDATE course SET 
    nama_course='$nama',
    jenjang='$jenjang',
    ringkasan='$ringkasan',
    foto='$foto',
    status='$status',
    periode='$periode',
    harga='$harga' WHERE id=$id");

  header("Location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Course</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #1e1e2f;
      color: #eee;
      margin: 0;
      padding: 0;
    }
    .main-content {
      margin-left: 250px; 
      padding: 40px 30px 60px 30px;
      min-height: 100vh;
    }
    h2 {
      font-weight: 600;
      font-size: 2rem;
      margin-bottom: 30px;
      color: #fff;
      text-shadow: 0 0 8px #2563eb;
    }
    form {
      background: #2a2a3b;
      padding: 30px 25px;
      border-radius: 10px;
      max-width: 600px;
      box-shadow: 0 0 15px rgba(37, 99, 235, 0.6);
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #cbd5e1;
    }
    input[type="text"],
    input[type="number"],
    textarea,
    select {
      width: 100%;
      padding: 10px 14px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: none;
      font-size: 1rem;
      background-color: #3a3a4f;
      color: #eee;
      box-shadow: inset 0 0 6px rgba(0,0,0,0.6);
      transition: background-color 0.3s ease;
      resize: vertical;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus,
    select:focus {
      outline: none;
      background-color: #45455f;
      box-shadow: 0 0 8px #2563eb;
      color: #fff;
    }
    textarea {
      min-height: 100px;
      font-family: inherit;
    }
    input[type="file"] {
      margin-bottom: 25px;
      color: #ddd;
    }
    button {
      background-color: #2563eb;
      border: none;
      color: white;
      padding: 12px 24px;
      font-size: 1.1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 0 15px rgba(37, 99, 235, 0.7);
    }
    button:hover {
      background-color: #1e40af;
    }
    .current-photo {
      margin-bottom: 20px;
    }
    .current-photo img {
      max-width: 150px;
      border-radius: 8px;
      box-shadow: 0 0 10px #2563eb;
      display: block;
    }
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
      form {
        max-width: 100%;
        padding: 20px;
      }
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
    td ul {
      list-style-type: disc;
      padding-left: 20px;
      margin: 0;
      max-height: 80px; 
      overflow: hidden;
    }

    @media (max-width: 768px) {
      main {
        margin-left: 0;
        margin-top: 120px;
        padding: 1rem 1.5rem;
      }
      footer {
        left: 0;
        width: 100%;
      }
      ul.dashboard-menu {
        flex-direction: column;
        gap: 1rem;
      }
      ul.dashboard-menu li {
        width: 100%;
        text-align: center;
      }

      .main-content {
        margin-left: 0 !important;
        padding: 20px 15px;
        padding-top: 100px;
      }
    }
  </style>
</head>
<body>
  <div class="main-content">
    <h2>Edit Course</h2>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
      <label for="nama_course">Nama Course</label>
      <input type="text" id="nama_course" name="nama_course" value="<?= htmlspecialchars($data['nama_course']) ?>" required>

      <label for="jenjang">Jenjang</label>
      <input type="text" id="jenjang" name="jenjang" value="<?= htmlspecialchars($data['jenjang']) ?>">

      <label for="ringkasan">Ringkasan (pisahkan dengan tanda titik koma ; )</label>
      <textarea id="ringkasan" name="ringkasan"><?= htmlspecialchars($data['ringkasan']) ?></textarea>

      <label>Foto Saat Ini</label>
      <div class="current-photo">
        <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Course">
      </div>

      <label for="foto">Ganti Foto (opsional)</label>
      <input type="file" id="foto" name="foto" accept="image/*">

      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="dibuka" <?= $data['status'] == 'dibuka' ? 'selected' : '' ?>>Dibuka</option>
        <option value="belum dibuka" <?= $data['status'] == 'belum dibuka' ? 'selected' : '' ?>>Belum Dibuka</option>
      </select>

      <label for="periode">Periode</label>
      <input type="text" id="periode" name="periode" value="<?= htmlspecialchars($data['periode']) ?>">

      <label for="harga">Harga (Rp)</label>
      <input type="number" id="harga" name="harga" value="<?= (int)$data['harga'] ?>" required min="0" step="1000">

      <button type="submit">Update</button>
    </form>
  </div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
