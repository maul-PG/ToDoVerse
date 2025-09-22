<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/db.php";

// Update status saran jika ada permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = (int) $_POST['id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE saran SET status = '$status' WHERE id = $id");
}

// Ambil semua saran
$result = mysqli_query($conn, "SELECT s.*, u.username FROM saran s 
                               JOIN users u ON s.user_id = u.id 
                               ORDER BY s.created_at DESC");
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container py-4">
    <h2>Kelola Saran Pengguna</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>Pengguna</th>
                <th>Isi Saran</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['isi']) ?></td>
                    <td>
                        <span class="badge 
                            <?= $row['status'] == 'baru' ? 'bg-secondary' : 
                                ($row['status'] == 'ditinjau' ? 'bg-warning' : 'bg-success') ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <form action="" method="POST" class="d-flex gap-1">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <select name="status" class="form-select form-select-sm">
                                <option value="baru" <?= $row['status'] == 'baru' ? 'selected' : '' ?>>Baru</option>
                                <option value="ditinjau" <?= $row['status'] == 'ditinjau' ? 'selected' : '' ?>>Ditinjau</option>
                                <option value="selesai" <?= $row['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
