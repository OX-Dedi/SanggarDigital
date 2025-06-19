<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];
if ($user_role !== 'siswa') {
    die("Akses ditolak. Anda bukan siswa.");
}

$kelas_result = mysqli_query($conn, "
    SELECT k.*
    FROM enroll e
    JOIN kelas k ON e.kelas_id = k.id
    WHERE e.user_id = $user_id
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelas Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
       {
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1f2937; 
            margin: 0;
            padding: 60px 20px;
            overflow-x: hidden;
            position: relative;
            height: 100vh;
            color: #e0e7ff;
        }


        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background-color: #1f2937;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .kelas-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .kelas-card {
            background: linear-gradient(135deg, #ffffff, #f1f4f9);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            color: #34495e;
        }

        .kelas-card::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 100px;
            height: 100px;
            background: rgba(0, 123, 255, 0.15);
            border-radius: 50%;
            transition: transform 0.5s ease;
        }

        .kelas-card:hover::before {
            transform: scale(1.5);
        }

        .kelas-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.1);
        }

        .kelas-card h3 {
            margin-top: 0;
            font-size: 22px;
        }

        .kelas-card p {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .kelas-card a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .kelas-card a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        @media (max-width: 500px) {
            .kelas-card {
                padding: 20px;
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


        .empty-message {
            text-align: center;
            padding: 50px;
            font-size: 1.2rem;
            color: #94a3b8;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div id="particles-js"></div>

<a href="../dashboard/siswa.php" class="btn-futuristic">
    <span>← Kembali</span>
</a>

<h2>📘 Kelas yang Anda Ikuti</h2>

<?php if (mysqli_num_rows($kelas_result) === 0) { ?>
    <div class="empty-message">
        🚫 Belum ada kelas yang Anda ampu saat ini. Silakan buat kelas terlebih dahulu.
    </div>
<?php } else { ?>
    <div class="kelas-container">
        <?php while ($kelas = mysqli_fetch_assoc($kelas_result)) { ?>
            <div class="kelas-card">
                <h3><?= htmlspecialchars($kelas['nama_kelas']) ?></h3>
                <p><?= htmlspecialchars($kelas['deskripsi'] ?? 'Tanpa deskripsi') ?></p>
                <a href="../guru/kelas_detail_siswa.php?id=<?= $kelas['id'] ?>">Masuk Kelas</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
particlesJS('particles-js', {
  "particles": {
    "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
    "color": { "value": "#007bff" },
    "shape": { "type": "circle" },
    "opacity": { "value": 0.12, "random": true },
    "size": { "value": 4, "random": true },
    "line_linked": { "enable": true, "distance": 120, "color": "#007bff", "opacity": 0.15, "width": 1 },
    "move": { "enable": true, "speed": 2, "direction": "none", "random": true, "out_mode": "out" }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" } },
    "modes": { "grab": { "distance": 140, "line_linked": { "opacity": 0.25 } }, "push": { "particles_nb": 4 } }
  },
  "retina_detect": true
});
</script>

</body>
</html>
