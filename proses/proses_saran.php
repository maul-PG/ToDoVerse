<?php
session_start();
require_once '../config/db.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Silakan login terlebih dahulu.";
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);

    if (empty($isi)) {
        $_SESSION['error'] = "Isi saran tidak boleh kosong.";
        header("Location: ../dashboard/kotaksaran.php");
        exit();
    }

    $query = "INSERT INTO saran (user_id, isi) VALUES ('$user_id', '$isi')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Saran berhasil dikirim!";
    } else {
        $_SESSION['error'] = "Gagal mengirim saran.";
    }

    header("Location: ../dashboard/kotaksaran.php");
    exit();
} else {
    // Jika akses tidak melalui POST
    header("Location: ../dashboard/kotaksaran.php");
    exit();
}
