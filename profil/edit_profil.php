<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$pesan_sukses = '';
$pesan_error = '';

// Proses form jika ada file yang di-upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_profil'])) {
    $file = $_FILES['foto_profil'];

    // Validasi file
    if ($file['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        // Pastikan direktori uploads ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($file_extension), $allowed_types)) {
            // Buat nama file unik untuk menghindari tumpang tindih
            $new_filename = 'user_' . $user_id . '_' . time() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                // Cek apakah user sudah punya data di tabel profil
                $stmt_cek = $conn->prepare("SELECT user_id FROM profil WHERE user_id = ?");
                $stmt_cek->bind_param("i", $user_id);
                $stmt_cek->execute();
                $res_cek = $stmt_cek->get_result();

                if ($res_cek->num_rows > 0) {
                    // Jika sudah ada, UPDATE
                    $stmt_update = $conn->prepare("UPDATE profil SET foto_profil = ? WHERE user_id = ?");
                    $stmt_update->bind_param("si", $new_filename, $user_id);
                    $stmt_update->execute();
                } else {
                    // Jika belum ada, INSERT
                    $stmt_insert = $conn->prepare("INSERT INTO profil (user_id, foto_profil) VALUES (?, ?)");
                    $stmt_insert->bind_param("is", $user_id, $new_filename);
                    $stmt_insert->execute();
                }
                $pesan_sukses = "Foto profil berhasil diperbarui!";
            } else {
                $pesan_error = "Gagal memindahkan file yang di-upload.";
            }
        } else {
            $pesan_error = "Tipe file tidak diizinkan. Harap upload file JPG, JPEG, PNG, atau GIF.";
        }
    } else {
        $pesan_error = "Terjadi kesalahan saat meng-upload file.";
    }
}

// Ambil data user dan profil terbaru untuk ditampilkan
$stmt = $conn->prepare("SELECT u.username, p.foto_profil FROM users u LEFT JOIN profil p ON u.id = p.user_id WHERE u.id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$username = $user['username'] ?? 'User';
$foto_profil = !empty($user['foto_profil']) ? '../uploads/' . $user['foto_profil'] : 'https://via.placeholder.com/150';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil | ToDoVerse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style_user.css">
</head>
<body>
<?php include '../includes/navbar_user.php'; ?>

<div class="container" style="padding-top: 2rem; padding-bottom: 2rem; max-width: 600px;">
    <div class="glass-card" style="padding: 2rem;">
        <h2 class="text-center mb-4">Edit Profil</h2>

        <?php if ($pesan_sukses): ?>
            <div class="alert alert-success"><?= $pesan_sukses; ?></div>
        <?php endif; ?>
        <?php if ($pesan_error): ?>
            <div class="alert alert-danger"><?= $pesan_error; ?></div>
        <?php endif; ?>

        <div class="text-center mb-4">
            <img src="<?= htmlspecialchars($foto_profil); ?>" alt="Foto Profil Saat Ini" class="rounded-circle" width="150" height="150" style="object-fit: cover;">
            <h4 class="mt-3"><?= htmlspecialchars($username); ?></h4>
        </div>

        <form action="edit_profil.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto_profil" class="form-label">Ganti Foto Profil</label>
                <input class="form-control" type="file" id="foto_profil" name="foto_profil" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>