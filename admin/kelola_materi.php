<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/db.php";

// Proses tambah materi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $sumber = mysqli_real_escape_string($conn, $_POST['sumber']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $admin_id = $_SESSION['user_id'];

    $query = "INSERT INTO materi (judul, deskripsi, sumber, url, ditambahkan_oleh) 
              VALUES ('$judul', '$deskripsi', '$sumber', '$url', $admin_id)";
    mysqli_query($conn, $query);
}

// Proses hapus materi
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM materi WHERE id = $id");
}

// Ambil semua materi
$result = mysqli_query($conn, "SELECT m.*, u.username 
                               FROM materi m 
                               JOIN users u ON m.ditambahkan_oleh = u.id 
                               ORDER BY m.created_at DESC");
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container py-4">
    <h2>Kelola Materi Belajar</h2>

    <form action="" method="POST" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="judul" class="form-control" placeholder="Judul Materi" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="sumber" class="form-control" placeholder="Sumber Materi">
            </div>
            <div class="col-md-4">
                <input type="url" name="url" class="form-control" placeholder="URL (opsional)">
            </div>
            <div class="col-12 mt-2">
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi Singkat" rows="2" required></textarea>
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success">Tambah Materi</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Sumber</th>
                <th>URL</th>
                <th>Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($materi = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($materi['judul']) ?></td>
                    <td><?= htmlspecialchars($materi['deskripsi']) ?></td>
                    <td><?= htmlspecialchars($materi['sumber']) ?></td>
                    <td>
                        <?php if ($materi['url']): ?>
                            <a href="<?= htmlspecialchars($materi['url']) ?>" target="_blank">Lihat</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($materi['username']) ?></td>
                    <td>
                        <a href="?hapus=<?= $materi['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
