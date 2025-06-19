<?php
include '../config/db.php';
include __DIR__ . '/../partials/auth_check.php';
include __DIR__ . '/../partials/navbaradmin.php';
include __DIR__ . '/../partials/sidebaradmin.php';

if (isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    mysqli_query($conn, $query);
    header("Location: manage_user.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header("Location: manage_user.php");
    exit;
}

$edit_user = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $edit_user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: manage_user.php");
    exit;
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Manajemen User - Dark Mode</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #1e1e1e;
    color: #f0f0f0;
}

.main-content {
    margin-left: 250px;
    padding: 80px 30px 40px 30px;
    min-height: 100vh;
}

.main-content h2 {
    margin-bottom: 20px;
    font-size: 28px;
    color: #fff;
}

form {
    background-color: #2a2a2a;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 40px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

form label {
    display: block;
    margin-top: 10px;
    color: #ccc;
    font-weight: 500;
}

form input,
form select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #444;
    background-color: #1f1f1f;
    color: white;
    font-size: 14px;
}

form button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #4caf50;
    border: none;
    color: white;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: background 0.3s;
}

form button:hover {
    background-color: #43a047;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #2a2a2a;
    border-radius: 10px;
    overflow: hidden;
}

table th,
table td {
    padding: 12px 15px;
    border-bottom: 1px solid #444;
    text-align: left;
    font-size: 14px;
}

table th {
    background-color: #333;
    color: #fff;
}

table tr:hover {
    background-color: #3a3a3a;
}

td.action a {
    margin-right: 10px;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 13px;
}

td.action a:hover {
    opacity: 0.8;
}

td.action a.danger {
    background-color: #e53935;
    color: white;
}

td.action a:not(.danger) {
    background-color: #1976d2;
    color: white;
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
</head>
<body>

<div class="main-content">
    <h2>Manajemen User</h2>

    <form method="POST" autocomplete="off">
        <input type="hidden" name="id" value="<?= htmlspecialchars($edit_user['id'] ?? '') ?>">

        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($edit_user['name'] ?? '') ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($edit_user['email'] ?? '') ?>" required <?= $edit_user ? 'readonly' : '' ?>>

        <?php if (!$edit_user): ?>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        <?php endif; ?>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin" <?= ($edit_user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="guru" <?= ($edit_user['role'] ?? '') === 'guru' ? 'selected' : '' ?>>Guru</option>
            <option value="siswa" <?= ($edit_user['role'] ?? '') === 'siswa' ? 'selected' : '' ?>>Siswa</option>
        </select>

        <button type="submit" name="<?= $edit_user ? 'update' : 'tambah' ?>">
            <?= $edit_user ? 'Update User' : 'Tambah User' ?>
        </button>
    </form>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while($user = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td><?= htmlspecialchars($user['created_at']) ?></td>
                <td class="action">
                    <a href="?edit=<?= $user['id'] ?>">Edit</a>
                    <a href="?hapus=<?= $user['id'] ?>" class="danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
include __DIR__ . '/../partials/footer.php';
?>
