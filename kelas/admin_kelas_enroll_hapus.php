<?php
include '../config/db.php';

$kelas_id = (int)$_POST['kelas_id'];
$user_id = (int)$_POST['user_id'];

mysqli_query($conn, "DELETE FROM enroll WHERE kelas_id = $kelas_id AND user_id = $user_id");

header("Location: admin_kelas_enroll.php?id=$kelas_id");
exit;
?>
