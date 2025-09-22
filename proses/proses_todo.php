<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Silakan login terlebih dahulu.";
    header("Location: ../dashboard/index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tambah to-do
    if (isset($_POST['tambah'])) {
        $isi = mysqli_real_escape_string($conn, $_POST['isi']);

        if (empty($isi)) {
            $_SESSION['error'] = "Isi to-do tidak boleh kosong.";
            header("Location: ../dashboard/index.php");
            exit();
        }

        $query = "INSERT INTO aktivitas (user_id, aksi) VALUES ('$user_id', '$isi')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "To-do berhasil ditambahkan.";
        } else {
            $_SESSION['error'] = "Gagal menambahkan to-do.";
        }
        header("Location: ../dashboard/index.php");
        exit();
    }

    // Hapus to-do
    if (isset($_POST['hapus']) && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $query = "DELETE FROM aktivitas WHERE id = '$id' AND user_id = '$user_id'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "To-do berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Gagal menghapus to-do.";
        }
        header("Location: ../dashboard/index.php");
        exit();
    }
} else {
    header("Location: ../dashboard/index.php");
    exit();
}
