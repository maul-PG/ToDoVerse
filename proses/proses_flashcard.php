<?php
include '../config/db.php';
session_start();

// Cek jika user belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Tambah flashcard
if (isset($_POST['tambah'])) {
    $user_id = $_SESSION['user_id'];
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];

    $query = "INSERT INTO flashcards (user_id, pertanyaan, jawaban) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $pertanyaan, $jawaban);
    $stmt->execute();

    header("Location: ../dashboard/flashcard.php?msg=berhasil_tambah");
    exit;
}

// Edit flashcard
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];

    $query = "UPDATE flashcards SET pertanyaan = ?, jawaban = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $pertanyaan, $jawaban, $id);
    $stmt->execute();

    header("Location: ../dashboard/flashcard.php?msg=berhasil_edit");
    exit;
}

// Hapus flashcard
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $query = "DELETE FROM flashcards WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../dashboard/flashcard.php?msg=berhasil_hapus");
    exit;
}
?>
