<?php
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php'; 
include '../config/db.php'; 

// Ambil course & guru
$course = mysqli_query($conn, "SELECT * FROM course WHERE status='dibuka'");
$guru = mysqli_query($conn, "SELECT * FROM users WHERE role='guru'");
?>

<style>
  body {
    background-color: #1f2937; 
    color: #e0e0e0;
    font-family: Arial, sans-serif;
    padding-top: 70px; 
  }
  .container {
    max-width: 600px;
    margin: 30px auto;
    padding: 20px;
    background-color: #374151; 
    border-radius: 8px;
    box-shadow: 0 0 12px rgba(0,0,0,0.6);
  }
  h2 {
    color: #f9fafb; 
    margin-bottom: 20px;
    font-weight: 700;
    text-align: center;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #d1d5db; 
  }
  input[type="text"], select, textarea {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 16px;
    border: none;
    border-radius: 6px;
    background-color: #1f2937;
    color: #e0e0e0;
    font-size: 15px;
    box-shadow: inset 0 0 5px #111827;
    transition: background-color 0.3s ease;
  }
  input[type="text"]:focus, select:focus, textarea:focus {
    background-color: #2563eb;
    color: white;
    outline: none;
  }
  textarea {
    min-height: 80px;
    resize: vertical;
  }
  button {
    background-color: #3b82f6;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #2563eb;
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
  <h2>Tambah Kelas</h2>
  <form action="admin_kelas_tambah_proses.php" method="POST">
    <label>Nama Kelas:</label>
    <input type="text" name="nama_kelas" required>

    <label>Course:</label>
    <select name="course_id" required>
      <?php while ($c = mysqli_fetch_assoc($course)) { ?>
        <option value="<?= htmlspecialchars($c['id']) ?>"><?= htmlspecialchars($c['nama_course']) ?></option>
      <?php } ?>
    </select>

    <label>Guru Pengampu:</label>
    <select name="guru_id" required>
      <?php while ($g = mysqli_fetch_assoc($guru)) { ?>
        <option value="<?= htmlspecialchars($g['id']) ?>"><?= htmlspecialchars($g['name']) ?></option>
      <?php } ?>
    </select>

    <label>Deskripsi (opsional):</label>
    <textarea name="deskripsi"></textarea>

    <button type="submit">Simpan</button>
  </form>
</div>

<?php
include __DIR__ . '/../partials/footer.php';
?>
