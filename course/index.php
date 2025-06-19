<?php 
include '../config/db.php';
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php'; // navbar fixed di atas
include __DIR__ . '/../partials/sidebaradmin.php'; // sidebar fixed di kiri
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Daftar Course</title>
  <style>
    {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #1e1e2f;
      color: white;
      margin: 0;
      padding: 0;
    }
    
    .main-content {
      margin-left: 250px; 
      padding: 30px;
      padding-top: 90px; 
      min-height: calc(100vh - 60px); 
      transition: margin-left 0.3s ease; 
    }
    h2 {
      margin-top: 0;
      margin-bottom: 20px;
    }
    .btn-add {
      display: inline-block;
      background-color: #4CAF50;
      color: white;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 20px;
      transition: background-color 0.2s ease;
    }
    .btn-add:hover {
      background-color: #45a049;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #2c2c3c;
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      vertical-align: top; 
    }
    th {
      background-color: #33334d;
      color: #ffffff;
    }
    tr:nth-child(even) {
      background-color: #2a2a3b;
    }
    tr:hover {
      background-color: #3a3a4f;
    }
    img {
      border-radius: 5px;
    }
    .aksi a {
      color: #00bfff;
      margin-right: 10px;
      text-decoration: none;
    }
    .aksi a:hover {
      text-decoration: underline;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 220px;
      height: 40px;
      width: calc(100% - 220px);
      background-color: #2563eb;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.9rem;
      box-sizing: border-box;
      user-select: none;
      transition: all 0.3s ease;
    }

    td ul {
      list-style-type: disc;
      padding-left: 20px;
      margin: 0;
      max-height: 80px;
      overflow: hidden;
    }

    @media (max-width: 768px) {
      main {
        margin-left: 0;
        margin-top: 120px; 
        padding: 1rem 1.5rem;
      }
      footer {
        left: 0;
        width: 100%;
      }
      ul.dashboard-menu {
        flex-direction: column;
        gap: 1rem;
      }
      ul.dashboard-menu li {
        width: 100%;
        text-align: center;
      }

      .main-content {
        margin-left: 0 !important;
        padding: 20px 15px;
        padding-top: 100px;
      }
    }
  </style>
</head>
<body>

  <div class="main-content">
    <a href="add.php" class="btn-add">+ Tambah Course</a>
    <h2>Daftar Course</h2>

    <table>
      <tr>
        <th>Nama</th>
        <th>Jenjang</th>
        <th>Ringkasan</th>
        <th>Foto</th>
        <th>Status</th>
        <th>Periode</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
      <?php
      $result = $conn->query("SELECT * FROM course");
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
          <td>{$row['nama_course']}</td>
          <td>{$row['jenjang']}</td>
          <td>";
            $points = explode(';', $row['ringkasan']);
            echo "<ul>";
            $count = 0;
            foreach ($points as $point) {
              if ($count++ >= 5) {
                echo "<li>...</li>";
                break;
              }
              echo "<li>" . htmlspecialchars(trim($point)) . "</li>";
            }
            echo "</ul>";
        echo "</td>
          <td><img src='uploads/{$row['foto']}' width='80'></td>
          <td>{$row['status']}</td>
          <td>{$row['periode']}</td>
          <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
          <td class='aksi'>
            <a href='edit.php?id={$row['id']}'>Edit</a>
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Hapus?\")'>Hapus</a>
          </td>
        </tr>";
      }
      ?>
    </table>
  </div>

  <?php include __DIR__ . '/../partials/footer.php'; ?>

  <script>
    const sidebar = document.getElementById('sidebaradmin');
    const mainContent = document.querySelector('.main-content');
    const footer = document.querySelector('footer');

    function updateMainContentMargin() {
      if (!sidebar) return;
      const isSidebarHidden = sidebar.classList.contains('hide') || window.innerWidth <= 768;

      if (isSidebarHidden) {
        mainContent.style.marginLeft = '0';
        footer.style.left = '0';
        footer.style.width = '100%';
        sidebar.style.display = window.innerWidth <= 768 ? 'none' : 'block';
      } else {
        sidebar.style.display = 'block';
        mainContent.style.marginLeft = '250px';
        footer.style.left = '220px';
        footer.style.width = 'calc(100% - 220px)';
      }
    }

    updateMainContentMargin();

    const btnToggleSidebar = document.getElementById('btnToggleSidebar');
    if (btnToggleSidebar) {
      btnToggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('hide');
        updateMainContentMargin();
      });
    }

    window.addEventListener('resize', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.add('hide');
      } else {
        sidebar.classList.remove('hide');
      }
      updateMainContentMargin();
    });
  </script>

</body>
</html>
