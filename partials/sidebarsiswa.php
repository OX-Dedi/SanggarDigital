<aside id="sidebar" style="
  width: 220px;
  background: linear-gradient(145deg, #0f172a, #1e293b);
  color: white;
  height: 100vh;
  position: fixed;
  top: 60px;
  left: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  box-sizing: border-box;
  overflow-y: auto;
  z-index: 999;
  transition: width 0.3s ease;
  display: flex;
  flex-direction: column;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.6);
">

<style>
  #toggleSidebarBtn {
    position: relative;
    background-color: rgba(255,255,255,0.05);
    color: #60a5fa;
    padding: 12px 15px;
    cursor: pointer;
    font-size: 1.5rem;
    border: none;
    text-align: left;
    width: auto;
    border-radius: 8px;
    overflow: hidden;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  #toggleSidebarBtn:hover {
    background-color: rgba(255,255,255,0.1);
  }
</style>

<div id="toggleSidebarBtn">☰</div>

<ul style="list-style: none; padding: 0; margin: 0; flex-grow: 1;">
  <li class="menu-item">
    <a href="../dashboard/siswa.php" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: white;">
      <span class="icon" style="margin-right: 10px;">🏠</span>
      <span class="label">Dashboard</span>
    </a>
  </li>

  <li class="menu-item has-dropdown" style="position: relative;">
    <a href="#" onclick="toggleDropdown(event)" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: white;">
      <span class="icon" style="margin-right: 10px;">🎓</span>
      <span class="label">Kelas</span>
    </a>
    <ul class="dropdown" style="display: none; list-style: none; margin: 0; padding: 0 0 0 20px;">
      <li>
        <a href="../kelas_siswa/kelas_saya.php" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
          <span class="icon" style="margin-right: 10px;">📚</span>
          <span class="label">Kelas Terdaftar</span>
        </a>
      </li>
      <li>
        <a href="../kelas_siswa/sertifikat_saya.php" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
          <span class="icon" style="margin-right: 10px;">📄</span>
          <span class="label">Sertifikat Kelas</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="menu-item has-dropdown" style="position: relative;">
  <a href="#" onclick="toggleDropdown(event)" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: white;">
    <span class="icon" style="margin-right: 10px;">📖</span>
    <span class="label">Course</span>
  </a>
  <ul class="dropdown" style="display: none; list-style: none; margin: 0; padding: 0 0 0 20px;">
    <li>
      <a href="#" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
        <span class="icon" style="margin-right: 10px;">📚</span>
        <span class="label">Course</span>
      </a>
    </li>
    <li>
      <a href="../index2.php" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
        <span class="icon" style="margin-right: 10px;">🛒</span>
        <span class="label">Beli Course</span>
      </a>
    </li>
    <li>
      <a href="../kelas_siswa/status_pesanan.php" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
        <span class="icon" style="margin-right: 10px;">📦</span>
        <span class="label">Status Pesanan</span>
      </a>
    </li>
  </ul>
</li>


  <li class="menu-item has-dropdown" style="position: relative;">
    <a href="#" onclick="toggleDropdown(event)" style="display: flex; align-items: center; padding: 10px; text-decoration: none; color: white;">
      <span class="icon" style="margin-right: 10px;">📅</span>
      <span class="label">Jadwal</span>
    </a>
    <ul class="dropdown" style="display: none; list-style: none; margin: 0; padding: 0 0 0 20px;">
      <li>
        <a href="../siswa/kalender.php" style="display: flex; align-items: center; padding: 8px 10px; text-decoration: none; color: white;">
          <span class="icon" style="margin-right: 10px;">🗓️</span>
          <span class="label">Kalender Pembelajaran</span>
        </a>
      </li>
    </ul>
  </li>
</ul>

<script>
  function toggleDropdown(e) {
    e.preventDefault();
    const parent = e.target.closest('.has-dropdown');
    const dropdown = parent.querySelector('.dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }
</script>

<style>
  #sidebar ul { padding: 0; }
  .menu-item { transition: all 0.3s ease; }
  .menu-item a {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    text-decoration: none;
    color: white;
    font-weight: 600;
    border-left: 4px solid transparent;
    transition: background 0.3s ease, transform 0.3s ease;
  }
  .menu-item:hover a {
    background-color: rgba(96, 165, 250, 0.1);
    border-left-color: #60a5fa;
    transform: translateX(5px);
  }
  .icon {
    margin-right: 10px;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
  }
  .menu-item:hover .icon {
    transform: scale(1.2);
  }
  .sidebar-collapsed {
    width: 60px !important;
  }
  .sidebar-collapsed .label {
    display: none;
  }
  .sidebar-collapsed #toggleSidebarBtn {
    text-align: center;
  }
  .sidebar-collapsed .icon {
    margin: 0 auto;
    display: flex;
    justify-content: center;
  }
</style>

</aside>

<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('toggleSidebarBtn');
  let isCollapsed = false;
  toggleBtn.addEventListener('click', () => {
    isCollapsed = !isCollapsed;
    if (isCollapsed) {
      sidebar.classList.add('sidebar-collapsed');
      document.querySelector('main')?.style.setProperty('margin-left', '60px');
      document.querySelector('footer')?.style.setProperty('left', '60px');
      document.querySelector('footer')?.style.setProperty('width', 'calc(100% - 60px)');
    } else {
      sidebar.classList.remove('sidebar-collapsed');
      document.querySelector('main')?.style.setProperty('margin-left', '220px');
      document.querySelector('footer')?.style.setProperty('left', '220px');
      document.querySelector('footer')?.style.setProperty('width', 'calc(100% - 220px)');
    }
  });
</script>
