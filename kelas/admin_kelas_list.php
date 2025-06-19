<?php
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';
include '../config/db.php';

$kelas = mysqli_query($conn, "
  SELECT kelas.*, course.nama_course, users.name AS nama_guru 
  FROM kelas 
  JOIN course ON kelas.course_id = course.id 
  JOIN users ON kelas.guru_id = users.id
");
?>

<style>
  body {
    background-color: #1f2937; 
    color: #e0e0e0;
    font-family: Arial, sans-serif;
  }
  .container {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
  }
  h2 {
    color: #f9fafb; 
    margin-bottom: 15px;
    font-weight: 700;
  }
  a.btn-tambah {
    display: inline-block;
    margin-bottom: 15px;
    background-color: #3b82f6; 
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }
  a.btn-tambah:hover {
    background-color: #2563eb; 
  }
  table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    background-color: #374151; 
    border-radius: 8px;
    overflow: hidden;
  }
  th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #4b5563; 
    text-align: left;
  }
  th {
    background-color: #2563eb; 
    color: white;
    font-weight: 700;
  }
  tr:nth-child(even) {
    background-color: #4b5563; 
  }
  tr:hover {
    background-color: #2563eb;
    color: white;
  }
  a.action-link {
    color: #60a5fa; 
    text-decoration: none;
    font-weight: 600;
  }
  a.action-link:hover {
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

</style>

<div class="container">
  <h2>Daftar Kelas</h2>
  <a href="admin_kelas_tambah.php" class="btn-tambah">+ Tambah Kelas</a>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kelas</th>
        <th>Course</th>
        <th>Guru</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while ($k = mysqli_fetch_assoc($kelas)) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($k['nama_kelas']) ?></td>
          <td><?= htmlspecialchars($k['nama_course']) ?></td>
          <td><?= htmlspecialchars($k['nama_guru']) ?></td>
          <td><a href="admin_kelas_enroll.php?id=<?= $k['id'] ?>" class="action-link">Kelola Enroll</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
include __DIR__ . '/../partials/footer.php';
?>
