<?php
session_start();
require_once '../config/db.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Tambah Materi
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $ditambahkan_oleh = $_SESSION['user_id'];

    $query = "INSERT INTO materi (judul, deskripsi, sumber, url, ditambahkan_oleh) 
              VALUES ('$judul', '$deskripsi', '$sumber', '$url', $ditambahkan_oleh)";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Materi berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan materi.";
    }

    header("Location: ../admin/kelola_materi.php");
    exit();
}

// Edit Materi
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);

    $query = "UPDATE materi 
              SET judul = '$judul', deskripsi = '$deskripsi', sumber = '$sumber', url = '$url'
              WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Materi berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal memperbarui materi.";
    }

    header("Location: ../admin/kelola_materi.php");
    exit();
}

// Hapus Materi
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);

    $query = "DELETE FROM materi WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Materi berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus materi.";
    }

    header("Location: ../admin/kelola_materi.php");
    exit();
}
