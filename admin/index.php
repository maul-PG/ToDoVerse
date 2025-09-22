<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/db.php";

// Ambil ringkasan data
$total_user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_materi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM materi"))['total'];
$total_saran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM saran"))['total'];
$saran_baru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM saran WHERE status = 'baru'"))['total'];
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container py-4">
    <h2>Dashboard Admin</h2>
    <div class="row text-center mt-4 g-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h4><?= $total_user ?></h4>
                    <p>Pengguna Terdaftar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h4><?= $total_materi ?></h4>
                    <p>Materi Belajar</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h4><?= $total_saran ?></h4>
                    <p>Total Saran Masuk</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h4><?= $saran_baru ?></h4>
                    <p>Saran Belum Ditinjau</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5>Menu Admin Lainnya:</h5>
        <ul class="list-group">
            <li class="list-group-item"><a href="kelola_materi.php">Kelola Materi Belajar</a></li>
            <li class="list-group-item"><a href="kelola_user.php">Kelola Pengguna</a></li>
            <li class="list-group-item"><a href="kelola_saran.php">Tinjau Kotak Saran</a></li>
        </ul>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
