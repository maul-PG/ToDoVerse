<?php
session_start();
require_once '../config/db.php';

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $konfirmasi = mysqli_real_escape_string($conn, $_POST['konfirmasi']);

    // Validasi
    if (empty($username) || empty($email) || empty($password) || empty($konfirmasi)) {
        $_SESSION['error'] = "Semua field harus diisi.";
        header("Location: ../auth/register.php");
        exit();
    }

    if ($password !== $konfirmasi) {
        $_SESSION['error'] = "Konfirmasi password tidak cocok.";
        header("Location: ../auth/register.php");
        exit();
    }

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "Email sudah digunakan.";
        header("Location: ../auth/register.php");
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke database
    $query = "INSERT INTO users (username, email, password) 
              VALUES ('$username', '$email', '$password_hash')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
        header("Location: ../auth/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Registrasi gagal. Coba lagi.";
        header("Location: ../auth/register.php");
        exit();
    }
} else {
    // Jika akses langsung
    header("Location: ../auth/register.php");
    exit();
}
