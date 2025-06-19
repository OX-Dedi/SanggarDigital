<?php
include '../config/db.php';

$kelas_id = $_POST['kelas_id'];
$user_id = $_POST['user_id'];

$cek = mysqli_query($conn, "SELECT * FROM enroll WHERE kelas_id=$kelas_id AND user_id=$user_id");
if (mysqli_num_rows($cek) == 0) {
  mysqli_query($conn, "INSERT INTO enroll (kelas_id, user_id) VALUES ($kelas_id, $user_id)");
}

header("Location: admin_kelas_enroll.php?id=$kelas_id");
