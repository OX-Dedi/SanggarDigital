<?php 
include __DIR__ . '/../partials/navbardashboardsiswa.php';
include __DIR__ . '/../partials/sidebarsiswa.php';
include __DIR__ . '/../config/db.php';
session_start();


$user_id = $_SESSION['user_id'];

$query = "SELECT s.id, k.nama_kelas, s.sertifikat_path, s.tanggal_selesai
          FROM sertifikat s
          JOIN kelas k ON s.kelas_id = k.id
          WHERE s.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Sertifikat Saya</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
      height: 100vh;
      box-sizing: border-box;
      background-color: #f4f6f8;
      transition: background-color 0.3s ease;
    }
    .dashboard-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 25px;
    }
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .card {
      background-color: white;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.07);
      transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }
    .card h3 {
      font-size: 20px;
      color: #0066cc;
      margin-bottom: 10px;
    }
    .card p {
      color: #666;
      font-size: 14px;
    }
    .card a {
      display: inline-block;
      margin-top: 10px;
      color: #0066cc;
      text-decoration: none;
      font-weight: bold;
    }
    .card a:hover {
      text-decoration: underline;
    }
    .section-title {
      font-size: 22px;
      font-weight: bold;
      margin: 40px 0 20px 0;
    }
    /* DataTable Styling */
    table.dataTable {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    table.dataTable thead {
      background-color: #0066cc;
      color: white;
    }
    table.dataTable tbody tr:hover {
      background-color: #f0f8ff;
    }
    #darkModeToggle {
  position: fixed;
  top: 80px; 
  right: 30px; 
  background-color: #0066cc;
  border: none;
  color: white;
  padding: 10px 14px;
  border-radius: 8px;
  font-size: 14px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 102, 204, 0.4);
  z-index: 9999;
  transition: background-color 0.3s ease;
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
    main.dark .card p,
    main.dark .card a {
      color: #bbb;
    }
    main.dark .card a:hover {
      color: #88c0ff;
    }
    main.dark table.dataTable {
      background-color: #2c2c2c;
      color: #ddd;
    }
    main.dark table.dataTable thead {
      background-color: #444;
    }
    main.dark table.dataTable tbody tr:hover {
      background-color: #333;
    }
    @media (max-width: 768px) {
      main {
        margin-left: 0 !important;
      }
    }
  </style>
</head>
<body>

<main id="mainContent">
  <button id="darkModeToggle">🌙 Dark Mode</button>

  <div class="dashboard-title">Sertifikat Saya</div>

  <div class="card-grid">
    <div class="card">
      <h3>Course Terdaftar</h3>
      <p>Lihat semua course yang kamu ikuti dan pelajari secara progresif.</p>
      <a href="#">Lihat Course</a>
    </div>

    <div class="card">
      <h3>Progres Belajar</h3>
      <p>Pantau perkembangan belajarmu, lihat progress dan capaian materi.</p>
      <a href="#">Lihat Progres</a>
    </div>

    <div class="card">
      <h3>Sertifikat & Peringkat</h3>
      <p>Lihat sertifikat yang kamu peroleh dan posisi kamu di leaderboard.</p>
      <a href="#">Lihat Sertifikat</a>
    </div>
  </div>

  <div class="section-title">Sertifikat Saya</div>

  <table id="sertifikatTable" class="display">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Tanggal Selesai</th>
        <th>File Sertifikat</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>{$row['nama_kelas']}</td>";
        echo "<td>".date('d-m-Y', strtotime($row['tanggal_selesai']))."</td>";
        echo "<td><a href='/path/to/sertifikat/{$row['sertifikat_path']}' target='_blank'>Lihat Sertifikat</a></td>";
        echo "</tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#sertifikatTable').DataTable();
  });

 
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
