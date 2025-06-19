<?php
include '../config/db.php';
$id = $_GET['id'];

$data = $conn->query("SELECT foto FROM course WHERE id=$id")->fetch_assoc();
unlink("upload/" . $data['foto']); 

$conn->query("DELETE FROM course WHERE id=$id");
header("Location: index.php");
?>
