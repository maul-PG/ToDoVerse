<?php
session_start();
require_once '../config/db.php';

$error = '';
$success = '';
$invalidToken = false;

// Ambil token dari POST (saat form disubmit) atau dari GET (saat pertama kali buka)
$token = $_POST['token'] ?? $_GET['token'] ?? '';

// Cek apakah token kosong
if (empty($token)) {
    $invalidToken = true;
    $error ='Token tidak ditemukan. Silahkan request password kembali. ';
} else {

// Verifikasi token dan masa berlaku
$stmt = $conn->prepare("SELECT id, reset_token_expiry FROM users WHERE reset_token =?");
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt ->get_result();

if ($result->num_rows !== 1) {
    $invalidToken = true;
    $error = 'Token tidak valid. Silakan request reset password kembali.';
} else {
    $user = $result ->fetch_assoc();
    $expiry = strtotime($user['reset_token_expiry']);

    if($expiry < time()){
        $invalidToken =true;
        $error = 'Token tidak valid. Silakan request reset password kembali.';

        // Bersihkan token yg kadaluarsa
        $cleanup = $conn->prepare("UPDATE users SET reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        $cleanup->bind_param('i', $user['id']);
        $cleanup->execute();
        $cleanup->close();
        
        }
    }
    $stmt -> close();
}

// Proses reset password jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($password) || empty($confirm_password)) {
        $error = 'Semua field harus diisi.';
    } elseif ($password !== $confirm_password) {
        $error = 'Password tidak cocok.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        // Ambil user_id dari token yang sudah diverifikasi sebelumnya
        // Pastikan token valid dan user sudah diambil
        if (!isset($user) || !isset($user['id'])) {
            $error = 'Token tidak valid atau user tidak ditemukan.';
        } else {
            $user_id = $user['id'];
            // Hash dan simpan password baru
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
            $update->bind_param('si', $hashed_password, $user_id);

            if ($update->execute()) {
                $success = 'Password berhasil direset! Anda akan diarahkan ke halaman login dalam 5 detik.';
                header("refresh:5;url=login.php");
            } else {
                $error = 'Gagal mengupdate password.';
            }
            $update->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | ToDoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            margin-top: 80px;
        }
        .toggle {
            font-size: 0.9rem;
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="text-center mb-4">Reset Password</h4>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php elseif ($success): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                    <?php else: ?>
                        <form method="post">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                                <small class="toggle" onclick="togglePass('password')">👁️ Lihat Password</small>
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                <small class="toggle" onclick="togglePass('confirm_password')">👁️ Lihat Konfirmasi</small>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        </form>
                    <?php endif; ?>

                    <div class="text-center mt-3">
                        <a href="login.php">Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePass(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
