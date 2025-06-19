<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['user_role'] ?? null;

$kelas_id = intval($_GET['id'] ?? 0);

$cek = mysqli_query($conn, "SELECT * FROM kelas WHERE id = $kelas_id AND guru_id = $user_id");
if (mysqli_num_rows($cek) == 0) {
    die("Akses ditolak.");
}

$materi = mysqli_query($conn, "SELECT * FROM materi WHERE kelas_id = $kelas_id ORDER BY created_at DESC");
?>

<h2>Daftar Materi Kelas</h2>
<a href="materi_tambah.php?id=<?= $kelas_id ?>">➕ Tambah Materi</a>
<table border="1" cellpadding="8">
    <tr>
        <th>Judul</th>
        <th>File</th>
        <th>Aksi</th>
    </tr>
    <?php while($m = mysqli_fetch_assoc($materi)): ?>
    <tr>
        <td><?= htmlspecialchars($m['judul']) ?></td>
        <td><?= $m['file_materi'] ? "<a href='{$m['file_materi']}' target='_blank'>Lihat</a>" : "-" ?></td>
        <td>
            <a href="materi_edit.php?id=<?= $m['id'] ?>">✏️ Edit</a> |
            <a href="materi_hapus.php?id=<?= $m['id'] ?>&kelas_id=<?= $kelas_id ?>" onclick="return confirm('Yakin?')">🗑 Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
