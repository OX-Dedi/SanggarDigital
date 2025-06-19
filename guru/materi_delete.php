<?php
session_start();
include '../config/db.php';

if ($_SESSION['user_role'] !== 'guru') die("Akses ditolak.");

$id = intval($_GET['id']);
$kelas_id = intval($_GET['kelas_id'] ?? 0);

$materi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT file_materi FROM materi WHERE id = $id"));
if ($materi && $materi['file_materi'] && file_exists($materi['file_materi'])) {
    unlink($materi['file_materi']);
}

mysqli_query($conn, "DELETE FROM materi WHERE id = $id");

header("Location: materi_guru.php");
exit;
