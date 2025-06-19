<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    $username = 'Admin';
    $photo = 'assets/profile.jpg';
} else {
    $user_id = $_SESSION['user_id'];
    $query = $conn->prepare("SELECT name, photo FROM users WHERE id = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = htmlspecialchars($user['name']);
        $photo = !empty($user['photo']) ? $user['photo'] : 'assets/profile.jpg';
    } else {
        $username = 'Admin';
        $photo = 'assets/profile.jpg';
    }
}
?>

<nav style="
  background-color: #2563eb;
  padding: 1rem 2rem;
  color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 60px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 1000;
  box-sizing: border-box;
">
  <div style="display: flex; align-items: center; gap: 10px;">
    <img src="../logo.png" alt="Logo" style="height: 40px; object-fit: contain;">
    <div style="font-weight: 700; font-size: 1.5rem;">
      SANGGAR DIGITAL
    </div>
  </div>

  <div style="display: flex; align-items: center; position: relative;">
    <button id="profileToggle" style="
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
    ">
      <img src="/sanggardigital/<?= htmlspecialchars($photo) ?>" alt="Profile"
        style="width:35px; height:35px; border-radius:50%; margin-right:10px; object-fit: cover;">
      <span style="font-weight:600; user-select:none;"><?= $username ?></span>
    </button>

    <div id="profileDropdown" style="
      display: none;
      position: absolute;
      top: 60px;
      right: 0;
      background-color: white;
      color: #333;
      box-shadow: 0 2px 10px rgba(0,0,0,0.15);
      border-radius: 8px;
      overflow: hidden;
      min-width: 150px;
      z-index: 1001;
    ">
      <a href="/sanggardigital/dashboard/profile.php"
         style="display: block; padding: 10px 15px; text-decoration: none; color: #333; font-weight:500;">Profile</a>
         <a href="/sanggardigital/index2.php"
         style="display: block; padding: 10px 15px; text-decoration: none; color: #333; font-weight:500;">Landing Page</a>
      <a href="/sanggardigital/logout.php"
         style="display: block; padding: 10px 15px; text-decoration: none; color: #e11d48; font-weight:500;">Logout</a>
    </div>
  </div>
</nav>

<script>
  const profileToggle = document.getElementById("profileToggle");
  const profileDropdown = document.getElementById("profileDropdown");

  profileToggle.addEventListener("click", function (e) {
    e.stopPropagation(); 
    profileDropdown.style.display = profileDropdown.style.display === "block" ? "none" : "block";
  });

  window.addEventListener("click", function (e) {
    if (!profileDropdown.contains(e.target) && !profileToggle.contains(e.target)) {
      profileDropdown.style.display = "none";
    }
  });
</script>
