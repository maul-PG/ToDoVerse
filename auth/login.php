<?php
session_start();
require_once '../config/db.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$err = '';
$showReset = false;

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email !== '' && $password !== '') {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 1) {
                $user = $res->fetch_assoc();

                // Cek apakah sedang proses reset password
                if (!empty($user['reset_token']) && strtotime($user['reset_expires']) > time()) {
                    $err = "Akun Anda sedang dalam proses reset password. Silakan cek email Anda atau tunggu hingga token kedaluwarsa.";
                    $showReset = true;
                } elseif (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: " . ($user['role'] === 'admin' ? "../admin/index.php" : "../dashboard/index.php"));
                    exit;
                } else {
                    $err = "Password salah!";
                    $showReset = true;
                }
            } else {
                $err = "Akun tidak ditemukan.";
            }
        } else {
            $err = "Database error: " . $conn->error;
        }
    } else {
        $err = "Email dan password wajib diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ToDoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS disamakan dengan halaman registrasi */
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

        /* Menggunakan .login-card agar sesuai dengan HTML Anda */
        .login-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            color: #333;
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
            transition: box-shadow 0.3s ease-in-out;
        }

        .login-card:hover {
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.2);
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            color: #333;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #2575fc;
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
        
        /* Style untuk tombol "show password" disesuaikan */
        .toggle-password {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 15px;
            cursor: pointer;
            color: #6b7280;
        }

        a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #6a11cb;
            text-decoration: underline;
        }
        
        .login-title {
            font-weight: 700;
            color: #333;
        }
    </style>
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100 p-3">
    <div class="login-card">
        <h4 class="text-center mb-4 login-title">Login ke ToDoVerse</h4>

        <?php if ($err) : ?>
            <div class="alert alert-danger text-center"><?php echo $err; ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" required class="form-control" placeholder="Masukkan email">
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" required class="form-control" id="password" placeholder="Masukkan password">
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100 mb-2">Login</button>
            <?php if ($showReset): ?>
                <div class="text-center mt-2">
                    <a href="lupa_password.php">Lupa atau ingin ubah password?</a>
                </div>
            <?php endif; ?>
            <p class="text-center mt-3 mb-0">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.querySelector('.toggle-password');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = '🙈';
    } else {
        input.type = 'password';
        icon.textContent = '👁️';
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>