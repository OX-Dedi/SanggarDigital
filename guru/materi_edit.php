<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_role'] !== 'guru') die("Akses ditolak.");

$id = intval($_GET['id']);
$materi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM materi WHERE id = $id"));

if (!$materi) die("Materi tidak ditemukan.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $penjelasan = mysqli_real_escape_string($conn, $_POST['penjelasan']);
    $file_materi = mysqli_real_escape_string($conn, $_POST['file_materi']);
    $link_video = mysqli_real_escape_string($conn, $_POST['link_video']);
    $link_zoom = mysqli_real_escape_string($conn, $_POST['link_zoom']);
    $link_absen = mysqli_real_escape_string($conn, $_POST['link_absen']);
    $video_belajar = mysqli_real_escape_string($conn, $_POST['video_belajar']);

    $update = "
        UPDATE materi SET
        judul = '$judul',
        penjelasan = '$penjelasan',
        file_materi = '$file_materi',
        link_video = '$link_video',
        link_zoom = '$link_zoom',
        link_absen = '$link_absen',
        video_belajar = '$video_belajar'
        WHERE id = $id
    ";
    mysqli_query($conn, $update);
    header("Location: materi_guru.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Materi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #1e1e2f;
            color: #eee;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #00bcd4;
            margin-bottom: 30px;
            font-weight: 600;
        }

        form {
            background: #2a2a3d;
            border-radius: 15px;
            box-shadow: 0 0 12px rgba(0,188,212,0.3);
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #00bcd4;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            background: #1e1e2f;
            border: 1px solid #444;
            border-radius: 8px;
            color: #eee;
            margin-bottom: 20px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background: #00bcd4;
            color: #1e1e2f;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            display: block;
            margin: 0 auto;
        }

        button:hover {
            background: #00acc1;
        }

        a.back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #00e5ff;
            text-decoration: none;
        }

        a.back:hover {
            color: #4dd0e1;
        }
    </style>
</head>
<body>

<h2>✏️ Edit Materi</h2>

<form method="POST">
    <label for="judul">Judul:</label>
    <input type="text" name="judul" id="judul" value="<?= htmlspecialchars($materi['judul']) ?>" required>

    <label for="penjelasan">Penjelasan:</label>
    <textarea name="penjelasan" id="penjelasan" rows="5"><?= htmlspecialchars($materi['penjelasan']) ?></textarea>

    <label for="file_materi">File Materi (URL/Path):</label>
    <input type="text" name="file_materi" id="file_materi" value="<?= htmlspecialchars($materi['file_materi']) ?>">

    <label for="link_video">Link Video:</label>
    <input type="text" name="link_video" id="link_video" value="<?= htmlspecialchars($materi['link_video']) ?>">

    <label for="link_zoom">Link Zoom:</label>
    <input type="text" name="link_zoom" id="link_zoom" value="<?= htmlspecialchars($materi['link_zoom']) ?>">

    <label for="link_absen">Link Absen:</label>
    <input type="text" name="link_absen" id="link_absen" value="<?= htmlspecialchars($materi['link_absen']) ?>">

    <label for="video_belajar">Video Belajar:</label>
    <input type="text" name="video_belajar" id="video_belajar" value="<?= htmlspecialchars($materi['video_belajar']) ?>">

    <button type="submit">💾 Simpan Perubahan</button>
</form>

<a href="materi_guru.php" class="back">🔙 Kembali ke Daftar Materi</a>

</body>
</html>
