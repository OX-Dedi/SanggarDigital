<?php
include '../config/db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    die("Akses ditolak.");
}

$guru_id = $_SESSION['user_id'];
$kelas_result = mysqli_query($conn, "SELECT * FROM kelas WHERE guru_id = $guru_id");

while ($kelas = mysqli_fetch_assoc($kelas_result)):
    $kelas_id = $kelas['id'];
    $materi_result = mysqli_query($conn, "SELECT * FROM materi WHERE kelas_id = $kelas_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Materi Futuristik</title>
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

        .kelas-box {
            background: #2a2a3d;
            border-radius: 15px;
            box-shadow: 0 0 12px rgba(0,188,212,0.3);
            margin-bottom: 40px;
            padding: 20px 30px;
        }

        .kelas-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }

        .kelas-header h3 {
            margin: 0;
            color: #00bcd4;
        }

        .btn-tambah {
            background: #00bcd4;
            color: #1e1e2f;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #00acc1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 14px 10px;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        th {
            background: #00bcd4;
            color: #1e1e2f;
        }

        tr:hover {
            background: rgba(0, 188, 212, 0.1);
        }

        a.link, .btn-edit, .btn-hapus {
            color: #00e5ff;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-edit:hover {
            color: #4dd0e1;
        }

        .btn-hapus {
            color: #ff5252;
        }

        .btn-hapus:hover {
            color: #ff867c;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                color: #bbb;
            }

            th {
                display: none;
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
<body>
<a href="../dashboard/guru.php" class="btn-futuristic">
    <span>← Kembali</span>
</a>

<h2>📚 Daftar Materi Anda</h2>


<div class="kelas-box">
    <div class="kelas-header">
        <h3><?= htmlspecialchars($kelas['nama_kelas']) ?></h3>
        <a href="materi_tambah.php?id=<?= $kelas['id'] ?>" class="btn-tambah">+ Tambah Materi</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penjelasan</th>
                <th>File</th>
                <th>Video</th>
                <th>Zoom</th>
                <th>Absen</th>
                <th>Belajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($materi = mysqli_fetch_assoc($materi_result)): ?>
            <tr>
                <td data-label="Judul"><?= htmlspecialchars($materi['judul']) ?></td>
                <td data-label="Penjelasan"><?= nl2br(htmlspecialchars($materi['penjelasan'])) ?></td>
                <td data-label="File">
                    <?= $materi['file_materi'] ? "<a class='link' href='{$materi['file_materi']}' target='_blank'>📄</a>" : "-" ?>
                </td>
                <td data-label="Video">
                    <?= $materi['link_video'] ? "<a class='link' href='{$materi['link_video']}' target='_blank'>▶️</a>" : "-" ?>
                </td>
                <td data-label="Zoom">
                    <?= $materi['link_zoom'] ? "<a class='link' href='{$materi['link_zoom']}' target='_blank'>💻</a>" : "-" ?>
                </td>
                <td data-label="Absen">
                    <?= $materi['link_absen'] ? "<a class='link' href='{$materi['link_absen']}' target='_blank'>📝</a>" : "-" ?>
                </td>
                <td data-label="Belajar">
                    <?= $materi['video_belajar'] ? "<a class='link' href='{$materi['video_belajar']}' target='_blank'>🎥</a>" : "-" ?>
                </td>
                <td data-label="Aksi">
                    <a class="btn-edit" href="materi_edit.php?id=<?= $materi['id'] ?>">✏️</a> |
                    <a class="btn-hapus" href="materi_delete.php?id=<?= $materi['id'] ?>&kelas_id=<?= $kelas_id ?>" onclick="return confirm('Yakin ingin menghapus materi ini?')">🗑️</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php endwhile; ?>

</body>
</html>
