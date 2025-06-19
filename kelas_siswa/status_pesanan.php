<?php
session_start();
include '../config/db.php';
include __DIR__ . '/../partials/navbardashboardsiswa.php';
include __DIR__ . '/../partials/sidebarsiswa.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "
    SELECT p.*, c.nama_course 
    FROM pesanan_course p 
    JOIN course c ON p.course_id = c.id 
    WHERE p.user_id = ? 
    ORDER BY p.created_at DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Pesanan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        main {
            margin-top: 60px;
            margin-left: 220px;
            padding: 30px;
            min-height: 100vh;
            box-sizing: border-box;
            transition: margin-left 0.3s ease, background-color 0.3s ease;
            position: relative;
            background-color: #f4f6f8;
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
            color: #333;
        }

        .card h3 {
            font-size: 20px;
            color: #0066cc;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            color: inherit;
        }

        th {
            background-color: #0066cc;
            color: #fff;
            font-weight: bold;
        }

        .status-diproses { color: #facc15; font-weight: bold; }
        .status-disetujui { color: #22c55e; font-weight: bold; }
        .status-ditolak { color: #ef4444; font-weight: bold; }

        .empty-message {
            text-align: center;
            padding: 50px 20px;
            color: #777;
            font-size: 18px;
        }

    
        #darkModeToggle {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #0066cc;
            border: none;
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 102, 204, 0.4);
            transition: background-color 0.3s ease;
            user-select: none;
            z-index: 10;
        }
        #darkModeToggle:hover {
            background-color: #004a99;
        }


        body.dark {
            background-color: #121212;
            color: #eee;
        }
        main.dark {
            background-color: #1e1e1e;
        }
        main.dark .card {
            background-color: #2c2c2c;
            color: #ddd;
            box-shadow: 0 8px 15px rgba(255, 255, 255, 0.1);
        }
        main.dark .card h3 {
            color: #66aaff;
        }
        main.dark th {
            background-color: #1e40af;
            color: #fff;
        }
        main.dark td {
            color: #ddd;
            border-color: #333;
        }
        main.dark .empty-message {
            color: #aaa;
        }
    </style>
</head>

<body>

<main id="mainContent">
    <button id="darkModeToggle" aria-label="Toggle Dark Mode">🌙 Dark Mode</button>

    <div class="dashboard-title">Status Pesanan Anda</div>

    <div class="card">
        <h3>Daftar Pesanan</h3>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Feedback Admin</th>
                    <th>Tanggal Pesan</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama_course']) ?></td>
                        <td>
                            <?php 
                            if ($row['status'] === 'diproses') {
                                echo "<span class='status-diproses'>Diproses</span>";
                            } elseif ($row['status'] === 'disetujui') {
                                echo "<span class='status-disetujui'>Disetujui</span>";
                            } else {
                                echo "<span class='status-ditolak'>Ditolak</span>";
                            }
                            ?>
                        </td>
                        <td><?= htmlspecialchars($row['feedback_admin'] ?? '-') ?></td>
                        <td><?= date("d-m-Y H:i", strtotime($row['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <div class="empty-message">Belum ada pesanan.</div>
        <?php endif; ?>
    </div>
</main>

<script>
  const darkModeToggle = document.getElementById('darkModeToggle');
  const body = document.body;
  const main = document.getElementById('mainContent');

  if (localStorage.getItem('darkMode') === 'enabled') {
    body.classList.add('dark');
    main.classList.add('dark');
    darkModeToggle.textContent = '☀️ Light Mode';
  }

  darkModeToggle.addEventListener('click', () => {
    body.classList.toggle('dark');
    main.classList.toggle('dark');

    if (body.classList.contains('dark')) {
      localStorage.setItem('darkMode', 'enabled');
      darkModeToggle.textContent = '☀️ Light Mode';
    } else {
      localStorage.setItem('darkMode', 'disabled');
      darkModeToggle.textContent = '🌙 Dark Mode';
    }
  });
</script>

<?php include '../partials/footer.php'; ?>
</body>
</html>
