<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/db.php";

// Validasi input
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'] === 'admin' ? 'admin' : 'user';
echo password_hash('admin123', PASSWORD_DEFAULT);


// Cek email sudah ada atau belum
$cek = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = "Email sudah digunakan.";
    header("Location: kelola_user.php");
    exit();
}

// Simpan ke database
$query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
mysqli_query($conn, $query);

$_SESSION['success'] = "Pengguna berhasil ditambahkan.";
header("Location: kelola_user.php");
exit();
