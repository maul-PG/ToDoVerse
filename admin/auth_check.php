<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Jika tidak login atau bukan admin, alihkan ke login
    header("Location: ../auth/login.php");
    exit();
}
