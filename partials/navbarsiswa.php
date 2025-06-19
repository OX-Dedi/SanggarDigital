<?php 
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


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

    $username = 'User';
    $photo = 'assets/profile.jpg';
}
?>

<style>
  nav {
    background: #4f46e5;
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    position: relative;
  }

  nav h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    display: flex;
    align-items: center;
  }

  nav h2 img {
    height: 30px;
    margin-right: 10px;
    vertical-align: middle;
  }

  .profile-container {
    display: flex;
    align-items: center;
    position: relative;
  }

  .profile-button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
  }

  .profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
    border: 2px solid white;
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    top: 60px;
    right: 0;
    background-color: white;
    color: #333;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    border-radius: 8px;
    overflow: hidden;
    min-width: 160px;
    z-index: 1001;
  }

  .dropdown-menu a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: background 0.2s;
  }

  .dropdown-menu a:hover {
    background: #f0f0f0;
  }
</style>

<nav>
  <h2>
    <img src="logo.png" alt="Logo">
    SANGGAR DIGITAL
  </h2>

  <div class="profile-container">
    <button id="profileToggle" class="profile-button">
      <img src="<?= htmlspecialchars($photo) ?>" alt="Profile" class="profile-image">
      <span style="font-weight:600; user-select:none;"><?= $username ?></span>
    </button>

    <div id="profileDropdown" class="dropdown-menu">
      <a href="dashboard/siswa.php">Dashboard</a>
      <a href="logout.php" style="color: #e11d48;">Logout</a>
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
