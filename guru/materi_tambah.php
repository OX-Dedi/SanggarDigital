<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['user_role'] ?? null;

if ($user_role !== 'guru') {
    die("Akses ditolak.");
}

$kelas_id = intval($_GET['id'] ?? 0);

$cek_kelas = mysqli_query($conn, "SELECT * FROM kelas WHERE id = $kelas_id AND guru_id = $user_id");
if (mysqli_num_rows($cek_kelas) == 0) {
    die("Anda tidak memiliki akses ke kelas ini.");
}

if (isset($_POST['submit_materi'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penjelasan = mysqli_real_escape_string($conn, $_POST['penjelasan']);
    $link_video = mysqli_real_escape_string($conn, $_POST['link_video']);
    $link_zoom = mysqli_real_escape_string($conn, $_POST['link_zoom']);
    $link_absen = mysqli_real_escape_string($conn, $_POST['link_absen']);
    $video_belajar = mysqli_real_escape_string($conn, $_POST['video_belajar']);
    $file_materi = null;

    if (!empty($_FILES['file_materi']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $file_name = time() . "_" . basename($_FILES['file_materi']['name']);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["file_materi"]["tmp_name"], $target_file)) {
            $file_materi = $target_file;
        }
    }

    $query = "INSERT INTO materi (kelas_id, judul, penjelasan, file_materi, link_video, link_zoom, link_absen, video_belajar) VALUES (
        $kelas_id,
        '$judul',
        '$penjelasan',
        " . ($file_materi ? "'$file_materi'" : "NULL") . ",
        " . ($link_video ? "'$link_video'" : "NULL") . ",
        " . ($link_zoom ? "'$link_zoom'" : "NULL") . ",
        " . ($link_absen ? "'$link_absen'" : "NULL") . ",
        " . ($video_belajar ? "'$video_belajar'" : "NULL") . "
    )";

    mysqli_query($conn, $query);
    header("Location: materi_list.php?id=$kelas_id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambah Materi - Course Profesional</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    background: #121217;
    font-family: 'Inter', sans-serif;
    color: #E0E0E0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 40px 20px;
    min-height: 100vh;
  }

  form {
    background: #1F1F2E;
    max-width: 650px;
    width: 100%;
    padding: 40px 50px;
    border-radius: 16px;
    box-shadow:
      0 4px 20px rgba(0, 188, 212, 0.15),
      inset 0 0 15px #00BCD4;
    transition: box-shadow 0.3s ease;
  }
  form:hover {
    box-shadow:
      0 6px 30px rgba(0, 188, 212, 0.3),
      inset 0 0 20px #00BCD4;
  }

  h2 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #00BCD4;
    text-align: center;
    letter-spacing: 1px;
  }

  label {
    display: block;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 8px;
    color: #00BCD4;
    user-select: none;
  }

  input[type="text"],
  input[type="url"],
  input[type="file"],
  textarea {
    width: 100%;
    background: #121217;
    border: 2px solid #333;
    padding: 14px 18px;
    margin-bottom: 25px;
    border-radius: 12px;
    color: #E0E0E0;
    font-size: 1rem;
    font-weight: 400;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    outline-offset: 0;
  }

  input[type="text"]:focus,
  input[type="url"]:focus,
  input[type="file"]:focus,
  textarea:focus {
    border-color: #00BCD4;
    box-shadow: 0 0 10px #00BCD4;
    outline: none;
  }

  textarea {
    min-height: 140px;
    resize: vertical;
  }

  button[type="submit"] {
    width: 100%;
    background: linear-gradient(90deg, #00BCD4 0%, #0097A7 100%);
    border: none;
    border-radius: 14px;
    padding: 16px 0;
    font-size: 1.15rem;
    font-weight: 700;
    color: #121217;
    cursor: pointer;
    box-shadow: 0 8px 15px rgba(0, 188, 212, 0.5);
    transition: background 0.3s ease, box-shadow 0.3s ease;
    user-select: none;
  }

  button[type="submit"]:hover {
    background: linear-gradient(90deg, #0097A7 0%, #007B83 100%);
    box-shadow: 0 12px 25px rgba(0, 151, 167, 0.7);
  }

  @media (max-width: 700px) {
    form {
      padding: 30px 25px;
    }
  }

        .btn-futuristic {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #00ffff, #0077ff);
            clip-path: polygon(100% 50%, 0 0, 0 100%);
            cursor: pointer;
            transition: width 0.4s ease, clip-path 0.4s ease, background 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 0 15px #00ffffaa;
            z-index: 10;
            text-decoration: none;
            user-select: none;
        }

        .btn-futuristic:hover {
            width: 180px;
            clip-path: polygon(5% 10%, 95% 10%, 95% 90%, 5% 90%);
            border-radius: 12px;
            background: linear-gradient(135deg, #00ffff, #0055cc);
            box-shadow: 0 0 20px #00ffffee;
        }

        .btn-futuristic span {
            color: #121212;
            font-weight: 700;
            font-size: 16px;
            opacity: 0;
            transform: translateX(-10px);
            transition: opacity 0.3s ease 0.25s, transform 0.3s ease 0.25s;
            white-space: nowrap;
        }

        .btn-futuristic:hover span {
            opacity: 1;
            transform: translateX(0);
        }

        .btn-futuristic::before {
            content: "";
            position: absolute;
            left: 14px;
            width: 12px;
            height: 12px;
            background: #121212;
            clip-path: polygon(100% 50%, 0 0, 0 100%);
            transition: background 0.4s ease;
            z-index: 2;
        }

        .btn-futuristic:hover::before {
            background: #00ffff;
        }
</style>
</head>
<a href="../guru/materi_guru.php" class="btn-futuristic">
    <span>← Kembali</span>
</a>
<body>
  

<form method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
    <h2>Tambah Materi untuk Kelas</h2>

    <input type="hidden" name="kelas_id" value="<?= $kelas_id ?>">

    <label for="judul">Judul Materi</label>
    <input type="text" name="judul" id="judul" placeholder="Masukkan judul materi" required>

    <label for="penjelasan">Penjelasan</label>
    <textarea name="penjelasan" id="penjelasan" placeholder="Tulis penjelasan materi di sini..." required></textarea>

    <label for="file_materi">File Materi (opsional)</label>
    <input type="file" name="file_materi" id="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar,.jpg,.png">

    <label for="link_video">Link Video</label>
    <input type="url" name="link_video" id="link_video" placeholder="https://">

    <label for="link_zoom">Link Zoom</label>
    <input type="url" name="link_zoom" id="link_zoom" placeholder="https://">

    <label for="link_absen">Link Absen</label>
    <input type="url" name="link_absen" id="link_absen" placeholder="https://">

    <label for="video_belajar">Video Belajar</label>
    <input type="url" name="video_belajar" id="video_belajar" placeholder="https://">

    <button type="submit" name="submit_materi">💾 Simpan Materi</button>
</form>

</body>
</html>