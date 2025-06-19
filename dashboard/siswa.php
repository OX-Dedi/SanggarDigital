<?php 
include __DIR__ . '/../partials/navbardashboardsiswa.php';
include __DIR__ . '/../partials/sidebarsiswa.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Siswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
      color: inherit;
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
      color: #333;
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

    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    @media (max-width: 768px) {
      main {
        margin-left: 0 !important;
      }
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

    main.dark .card p,
    main.dark .card a {
      color: #bbb;
    }

    main.dark .card a:hover {
      color: #88c0ff;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<main id="mainContent">
  <button id="darkModeToggle" aria-label="Toggle Dark Mode">🌙 Dark Mode</button>

  <div class="dashboard-title">Dashboard Siswa</div>

  <div class="card-grid">
    <div class="card fade-in">
      <h3>Course Terdaftar</h3>
      <p>Lihat semua course yang kamu ikuti dan pelajari secara progresif.</p>
      <a href="#">Lihat Course</a>
    </div>

    <div class="card fade-in">
      <h3>Progres Belajar</h3>
      <p>Pantau perkembangan belajarmu, lihat progress dan capaian materi.</p>
      <a href="#">Lihat Progres</a>
    </div>

    <div class="card fade-in">
      <h3>Sertifikat & Peringkat</h3>
      <p>Lihat sertifikat yang kamu peroleh dan posisi kamu di leaderboard.</p>
      <a href="#">Lihat Sertifikat</a>
    </div>
  </div>
</main>

<script>
  const faders = document.querySelectorAll('.fade-in');

  const appearOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.1 });

  faders.forEach(fade => {
    appearOnScroll.observe(fade);
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
