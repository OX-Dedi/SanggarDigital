<?php
include '../config/db.php'; 

$nama_kelas = $_POST['nama_kelas'];
$course_id = $_POST['course_id'];
$guru_id = $_POST['guru_id'];
$deskripsi = $_POST['deskripsi'];

$query = "INSERT INTO kelas (nama_kelas, course_id, guru_id, deskripsi) 
          VALUES ('$nama_kelas', '$course_id', '$guru_id', '$deskripsi')";
mysqli_query($conn, $query);

header("Location: admin_kelas_list.php");
