<?php
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Arahkan berdasarkan peran
if ($_SESSION['role'] === 'admin') {
    header("Location: ../admin/index.php");
    exit();
} else {
    header("Location: ../dashboard/index.php");
    exit();
}
