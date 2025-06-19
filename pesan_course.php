<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$id_course = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = mysqli_query($conn, "SELECT * FROM course WHERE id = $id_course");
$course = mysqli_fetch_assoc($result);

if (!$course) {
    echo "Course tidak ditemukan.";
    exit;
}

$pesanan_sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $metode_bayar = htmlspecialchars($_POST['metode_bayar']);

    $bukti_path = '';
    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $filename = uniqid() . "_" . basename($_FILES['bukti_transfer']['name']);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file)) {
            $bukti_path = $target_file;
        }
    }

    $stmt = $conn->prepare("INSERT INTO pesanan_course (user_id, course_id, username, email, bukti_transfer, metode_bayar) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $user_id, $id_course, $username, $email, $bukti_path, $metode_bayar);
    $stmt->execute();

    $pesanan_sukses = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('bgori1.png') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .container {
            background-color: rgba(31, 41, 55, 0.95);
            max-width: 600px;
            margin: 80px auto;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px #2563eb88;
        }
        h2 {
            color: #3b82f6;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            width: 100%;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid #374151;
            border-radius: 8px;
            background-color: #1f2937;
            color: white;
            font-size: 1rem;
        }
        .total-harga {
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #22c55e;
        }
        .switch-payment {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 10px;
        }
        .switch-payment button {
            flex: 1;
            padding: 15px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #2563eb;
            color: white;
            transition: background-color 0.3s ease;
        }
        .switch-payment button.active {
            background-color: #3b82f6;
            box-shadow: 0 0 10px #3b82f6;
        }
        .info-bayar, .qris-container {
            background: #111827;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            border: 1px solid #374151;
            text-align: center;
        }
        .qris-container img {
            width: 250px;
            max-width: 80%;
            border-radius: 8px;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-submit {
            background-color: #22c55e;
            padding: 15px;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .btn-submit:hover {
            background-color: #16a34a;
        }
        .btn-back {
            display: inline-block;
            color: #3b82f6;
            font-weight: bold;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #2563eb;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.5);
        }
        @media (max-width: 600px) {
            .container {
                margin: 30px 10px;
                padding: 30px 20px;
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>

    <script>
        function pilihBayar(metode) {
            document.getElementById('metode_bayar').value = metode;
            document.getElementById('bankBtn').classList.remove('active');
            document.getElementById('qrBtn').classList.remove('active');
            document.getElementById(metode + 'Btn').classList.add('active');

            document.getElementById('bankInfo').style.display = (metode === 'bank') ? 'block' : 'none';
            document.getElementById('qrInfo').style.display = (metode === 'qr') ? 'block' : 'none';
        }
    </script>
</head>

<body>

<div class="container">
    <h2>Pesan Course: <?= htmlspecialchars($course['nama_course']) ?></h2>

    <div class="total-harga">
        Total Bayar: Rp <?= number_format($course['harga'], 0, ',', '.') ?>
    </div>

    <form method="POST" enctype="multipart/form-data">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Metode Pembayaran</label>
        <div class="switch-payment">
            <button type="button" id="bankBtn" class="active" onclick="pilihBayar('bank')">Transfer Bank</button>
            <button type="button" id="qrBtn" onclick="pilihBayar('qr')">QR Code</button>
        </div>

        <input type="hidden" name="metode_bayar" id="metode_bayar" value="bank">

        <div class="info-bayar" id="bankInfo">
            Transfer ke BCA 123456789 a/n PT Belajar Coding.
        </div>

        <div class="qris-container" id="qrInfo" style="display: none;">
            <p>Silakan scan QRIS berikut untuk melakukan pembayaran:</p>
            <img src="qris.jpeg" alt="QR Code">
        </div>

        <label>Bukti Pembayaran</label>
        <input type="file" name="bukti_transfer" accept="image/*" required>

        <button type="submit" class="btn-submit">Kirim Pesanan</button>
    </form>

    <a href="index2.php" class="btn-back">← Kembali</a>
</div>

<div class="modal" id="successModal" style="display: none;">
    <div class="modal-overlay" style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;">
        <div class="modal-content" style="
            background: #1f2937;
            color: white;
            padding: 40px 30px;
            border-radius: 15px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 20px #3b82f6;
            animation: fadeIn 0.5s ease;">
            <h3>✅ Pesanan Berhasil!</h3>
            <p>Pesanan kamu sedang diproses oleh admin.</p>
            <button onclick="redirectHome()" style="
                margin-top: 30px;
                background-color: #22c55e;
                border: none;
                padding: 12px 30px;
                font-weight: bold;
                font-size: 1rem;
                border-radius: 8px;
                cursor: pointer;">OK</button>
        </div>
    </div>
</div>

<script>
    function redirectHome() {
        window.location.href = 'index2.php';
    }

    <?php if ($pesanan_sukses): ?>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("successModal").style.display = "block";
    });
    <?php endif; ?>
</script>

</body>
</html>
