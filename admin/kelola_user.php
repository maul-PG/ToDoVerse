<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/db.php";

// Hapus user
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header("Location: kelola_user.php");
    exit();
}

// Update role user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['role'])) {
    $id = (int) $_POST['id'];
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user';
    mysqli_query($conn, "UPDATE users SET role = '$role' WHERE id = $id");
    header("Location: kelola_user.php");
    exit();
}

// Ambil semua user
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container py-4">
    <h2>Kelola Pengguna</h2>

    <h4 class="mt-4 mb-2">Tambah Pengguna Baru</h4>
<form method="POST" action="proses_tambah_user.php" class="mb-4 row g-2">
    <div class="col-md-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>
    <div class="col-md-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="col-md-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="col-md-2">
        <select name="role" class="form-select">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="col-md-1">
        <button class="btn btn-success w-100">Tambah</button>
    </div>
</form>


    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <select name="role" class="form-select form-select-sm">
                                <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <button class="btn btn-sm btn-primary">Ubah</button>
                        </form>
                    </td>
                    <td><?= $user['created_at'] ?></td>
                    <td>
                        <?php if ($_SESSION['user_id'] != $user['id']): ?>
                            <a href="?delete=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus pengguna ini?')">Hapus</a>
                        <?php else: ?>
                            <span class="text-muted">Tidak bisa hapus diri sendiri</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
