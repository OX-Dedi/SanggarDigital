<?php

include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';
include __DIR__ . '/../config/db.php';

$sqlCourse = "SELECT status, COUNT(*) as total FROM course GROUP BY status";
$resultCourse = $conn->query($sqlCourse);
$courseData = ['dibuka' => 0, 'belum dibuka' => 0];
while($row = $resultCourse->fetch_assoc()) {
  $courseData[$row['status']] = (int)$row['total'];
}

$sqlUser = "SELECT role, COUNT(*) as total FROM users GROUP BY role";
$resultUser = $conn->query($sqlUser);
$userData = ['admin' => 0, 'guru' => 0, 'siswa' => 0];
while($row = $resultUser->fetch_assoc()) {
  $userData[$row['role']] = (int)$row['total'];
}
?>


<style>
  * {
    box-sizing: border-box;
  }

  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #1f2937; 
    color: white;
  }

  .layout {
    display: flex;
    height: 100vh;
    overflow: hidden;
  }

  main {
    flex-grow: 1;
    padding: 2rem;
    margin-left: 220px; 
    transition: all 0.3s ease;
    margin-top: 60px; 
    min-height: calc(100vh - 60px);
    overflow-y: auto;
  }

  h2 {
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    border-left: 6px solid #3b82f6;
    padding-left: 1rem;
    color: #3b82f6;
  }

  ul.dashboard-menu {
    list-style: none;
    padding-left: 0;
    display: flex;
    gap: 1.5rem;
  }

  ul.dashboard-menu li {
    background: #2563eb;
    padding: 1rem 2rem;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.4);
    transition: background-color 0.3s ease, transform 0.2s ease;
    display: flex;
    align-items: center;
  }

  ul.dashboard-menu li:hover {
    background-color: #1e40af;
    transform: translateY(-3px);
  }

  ul.dashboard-menu li a {
    color: white;
    text-decoration: none;
    display: block;
    width: 100%;
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
  }
    .charts-container {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
    flex-wrap: wrap;
  }
  .chart-box {
    flex: 1 1 300px;
    background-color: #111827;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 0 15px #2563ebaa;
    color: white;
  }
  .chart-box h3 {
    margin-bottom: 1rem;
    color: #3b82f6;
  }
</style>

<div class="layout">
  <main>
    <h2>Admin Dashboard</h2>
    <ul class="dashboard-menu">
      <li><a href="../course/index.php">Kelola Course</a></li>
      <li><a href="../users/manage_user.php">Kelola Pengguna</a></li>
    </ul>
      
    <div class="charts-container">
      <div class="chart-box">
        <h3>Statistik Course</h3>
        <canvas id="courseChart"></canvas>
      </div>
      <div class="chart-box">
        <h3>Statistik Pengguna</h3>
        <canvas id="userChart"></canvas>
      </div>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const courseCtx = document.getElementById('courseChart').getContext('2d');
  const userCtx = document.getElementById('userChart').getContext('2d');

  const courseData = {
    labels: ['Dibuka', 'Belum Dibuka'],
    datasets: [{
      label: 'Jumlah Course',
      data: [<?= $courseData['dibuka'] ?>, <?= $courseData['belum dibuka'] ?>],
      borderColor: '#2563eb',
      backgroundColor: 'rgba(37, 99, 235, 0.3)',
      fill: true,
      tension: 0.3,
      pointRadius: 6,
      pointHoverRadius: 8,
      borderWidth: 3,
    }]
  };

  const userData = {
    labels: ['Admin', 'Guru', 'Siswa'],
    datasets: [{
      label: 'Jumlah Pengguna',
      data: [<?= $userData['admin'] ?>, <?= $userData['guru'] ?>, <?= $userData['siswa'] ?>],
      borderColor: '#f87171',
      backgroundColor: 'rgba(248, 113, 113, 0.3)',
      fill: true,
      tension: 0.3,
      pointRadius: 6,
      pointHoverRadius: 8,
      borderWidth: 3,
    }]
  };

  const options = {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom',
        labels: { color: 'white', font: { size: 14 } }
      },
      tooltip: { enabled: true }
    },
    scales: {
      y: {
        beginAtZero: true,
        ticks: { color: 'white', stepSize: 1 },
        grid: { color: '#374151' }
      },
      x: {
        ticks: { color: 'white' },
        grid: { color: '#374151' }
      }
    }
  };

  new Chart(courseCtx, {
    type: 'line',
    data: courseData,
    options: options
  });

  new Chart(userCtx, {
    type: 'line',
    data: userData,
    options: options
  });
</script>

<?php
include __DIR__ . '/../partials/footer.php';
?>
