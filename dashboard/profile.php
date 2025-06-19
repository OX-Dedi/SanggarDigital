<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();

if (!$user) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

$role = $user['role'] ?? 'siswa'; 
switch ($role) {
    case 'admin':
        $dashboard_link = 'admin.php';
        break;
    case 'guru':
        $dashboard_link = 'guru.php';
        break;
    case 'siswa':
        $dashboard_link = 'siswa.php';
        break;
    default:
        $dashboard_link = 'index.php'; 
        break;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $photoName = $user['photo'];

    if (!empty($_FILES['photo']['name'])) {
        $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetPath = "../uploads/" . $fileName;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetPath)) {
            $photoName = "uploads/" . $fileName;
        }
    }

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, photo=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $photoName, $user_id);
    $stmt->execute();

    header("Location: " . $dashboard_link);
    exit;
}

$error_msg = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['change_password'])) {
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if (password_verify($old_pass, $user['password'])) {
        if ($new_pass === $confirm_pass) {
            $hashed = password_hash($new_pass, PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password='$hashed' WHERE id=$user_id");
            header("Location: " . $dashboard_link);
            exit;
        } else {
            $error_msg = "Konfirmasi password tidak cocok.";
        }
    } else {
        $error_msg = "Password lama salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Profil Pengguna - Modern Stylish</title>
<link rel="stylesheet" href="profile.css" />
</head>
<body>

<div class="container" role="main" aria-label="Profil Pengguna">
  <div class="tabs" role="tablist">
    <button class="tab-btn active" onclick="switchTab(event, 'profile')" role="tab" aria-selected="true" aria-controls="profile" id="tab-profile">Edit Profil</button>
    <button class="tab-btn" onclick="switchTab(event, 'password')" role="tab" aria-selected="false" aria-controls="password" id="tab-password">Ganti Password</button>
  </div>

  <!-- TAB PROFIL -->
<section id="profile" class="tab-content active" role="tabpanel" aria-labelledby="tab-profile">
  <h2>Profil Pengguna</h2>
  <form method="post" enctype="multipart/form-data" autocomplete="off" aria-describedby="profile-desc">
    <div class="center" id="profile-desc">
      <?php if ($user['photo']): ?>
        <img src="../<?= htmlspecialchars($user['photo']) ?>" class="profile-photo" alt="Foto Profil <?= htmlspecialchars($user['name']) ?>">
      <?php else: ?>
        <img src="https://via.placeholder.com/130?text=No+Photo" class="profile-photo" alt="Foto Profil Default">
      <?php endif; ?>
    </div>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Nama Lengkap" required aria-label="Nama lengkap" />
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required aria-label="Email" />
    <label for="photo" style="color:#dbeafe; font-weight:300; margin-bottom: 5px; display: block;">Unggah Foto Profil (optional)</label>
    <input type="file" name="photo" id="photo" accept="image/*" aria-label="Unggah foto profil" />
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
      <button type="submit" name="update_profile" aria-label="Simpan perubahan profil" style="padding: 12px 26px; font-weight:600; border-radius: 50px; background-color:#2563eb; color:#f1f5f9; border:none; cursor:pointer;">Simpan Profil</button>
      <a href="<?= htmlspecialchars($dashboard_link) ?>" class="back-btn" role="link" aria-label="Kembali ke dashboard" style="text-decoration:none; padding: 12px 26px; color:#f1f5f9; font-weight:600; border-radius: 50px; background-color:#374151; display:inline-block; cursor:pointer;">&larr; Kembali</a>
    </div>
  </form>
</section>

<section id="password" class="tab-content" role="tabpanel" aria-labelledby="tab-password">
  <h2>Ganti Password</h2>
  <?php if ($error_msg): ?>
    <p class="error" role="alert" style="color: #f87171; font-weight:600;"><?= htmlspecialchars($error_msg) ?></p>
  <?php endif; ?>
  <form method="post" autocomplete="off" aria-describedby="password-desc">
    <input type="password" name="old_password" placeholder="Password Lama" required aria-label="Password lama" />
    <input type="password" name="new_password" placeholder="Password Baru" required aria-label="Password baru" />
    <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required aria-label="Konfirmasi password baru" />
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
      <button type="submit" name="change_password" aria-label="Ubah password" style="padding: 12px 26px; font-weight:600; border-radius: 50px; background-color:#2563eb; color:#f1f5f9; border:none; cursor:pointer;">Ganti Password</button>
      <a href="<?= htmlspecialchars($dashboard_link) ?>" class="back-btn" role="link" aria-label="Kembali ke dashboard" style="text-decoration:none; padding: 12px 26px; color:#f1f5f9; font-weight:600; border-radius: 50px; background-color:#374151; display:inline-block; cursor:pointer;">&larr; Kembali</a>
    </div>
  </form>
</section>

</div>

<script>
  function switchTab(event, tabId) {
    const tabs = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(btn => {
      btn.classList.remove('active');
      btn.setAttribute('aria-selected', 'false');
    });
    contents.forEach(content => content.classList.remove('active'));

    event.currentTarget.classList.add('active');
    event.currentTarget.setAttribute('aria-selected', 'true');
    document.getElementById(tabId).classList.add('active');
  }
</script>

</body>
</html>
