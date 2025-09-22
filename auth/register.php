<?php
include '../config/db.php';
session_start();

$_SESSION['page'] = 'register';

// Proses form register jika ada POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = $_POST['password'];

    // Validasi sederhana
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['register_error'] = "Semua field harus diisi.";
    } else {
        // Cek apakah username atau email sudah ada
        $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email' LIMIT 1");
        if (mysqli_num_rows($cek) > 0) {
            $_SESSION['register_error'] = "Username atau email sudah terdaftar.";
        } else {
            // Hash password
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed')");
            if ($insert) {
                // Auto login setelah register
                $user_id = mysqli_insert_id($conn);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                header("Location: ../dashboard/index.php");
                exit();
            } else {
                $_SESSION['register_error'] = "Gagal mendaftar. Silakan coba lagi.";
            }
        }
    }
    // Redirect kembali ke halaman register agar pesan error muncul
    header("Location: register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - ToDoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS untuk tampilan interaktif */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #6a11cb, #2575fc, #ec008c, #fc6767);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card dengan warna putih solid */
        .card {
            background: #ffffff; /* Latar belakang diubah menjadi putih solid */
            border: none; /* Menghapus border transparan sebelumnya */
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15); /* Bayangan yang lebih soft */
            color: #333; /* Warna teks utama di dalam card menjadi gelap */
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            background-color: #f3f4f6; /* Latar belakang input abu-abu muda */
            border: 1px solid #d1d5db;
            color: #333; /* Warna teks input menjadi gelap */
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #2575fc; /* Warna border biru saat input aktif */
            box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.2);
            color: #333;
        }

        .btn-primary {
            background: linear-gradient(45deg, #ec008c, #fc6767);
            border: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Style untuk tombol "show password" agar kontras */
        .input-group .btn {
            background-color: #f3f4f6;
            border-color: #d1d5db;
            color: #6b7280;
        }
        
        .input-group .btn:hover {
             background-color: #e5e7eb;
        }

        .card a {
            color: #2575fc; /* Warna link diubah menjadi biru */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .card a:hover {
            color: #6a11cb;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="card p-4 p-md-5" style="max-width: 450px; width: 100%;">
    <h3 class="text-center mb-4">Buat Akun ToDoVerse</h3>

    <?php if (isset($_SESSION['register_error'])) : ?>
      <div class="alert alert-danger">
        <?= $_SESSION['register_error']; unset($_SESSION['register_error']); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" id="password" required>
          <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
            👁️
          </button>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" name="register" class="btn btn-primary">Daftar</button>
      </div>
    </form>

    <p class="text-center mt-4 mb-0">Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </div>
</div>

<script>
  function togglePassword() {
    const pw = document.getElementById("password");
    pw.type = pw.type === "password" ? "text" : "password";
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>