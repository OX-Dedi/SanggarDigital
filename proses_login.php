<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email dan password harus diisi.";
        header("Location: index.php");
        exit;
    }

    $password_md5 = md5($password);

    $sql = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password_md5);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['logged_in'] = true;

        switch ($user['role']) {
            case 'admin':
                header("Location: dashboard/admin.php");
                exit;
            case 'guru':
                header("Location: dashboard/guru.php");
                exit;
            case 'siswa':
                header("Location: index2.php");
                exit;
            default:
                session_destroy();
                $_SESSION['error'] = "Role pengguna tidak valid.";
                header("Location: index.php");
                exit;
        }
    } else {
        $_SESSION['error'] = "Email atau password salah.";
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
