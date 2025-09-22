<?php
session_start();
require_once '../config/db.php';

// Inisialisasi variabel error
$login_err = '';
$register_err = '';
$showReset = false;

// === Logika Proses Login (Tidak Diubah) ===
if (isset($_POST['login'])) {
    $email = trim($_POST['email_login']);
    $password = trim($_POST['password_login']);

    if ($email !== '' && $password !== '') {
        $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($res->num_rows === 1) {
                $user = $res->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    header("Location: " . ($user['role'] === 'admin' ? "../admin/index.php" : "../dashboard/index.php"));
                    exit;
                } else {
                    $login_err = "Email atau password salah!";
                    $showReset = true;
                }
            } else {
                $login_err = "Email atau password salah!";
            }
            $stmt->close();
        } else {
            $login_err = "Database error: " . $conn->error;
        }
    } else {
        $login_err = "Email dan password wajib diisi.";
    }
}

// === Logika Proses Registrasi (Tidak Diubah) ===
if (isset($_POST['register'])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username_register']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email_register']));
    $password = $_POST['password_register'];

    if (empty($username) || empty($email) || empty($password)) {
        $register_err = "Semua field harus diisi.";
    } else {
        $cek_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        if ($cek_stmt) {
            $cek_stmt->bind_param("ss", $username, $email);
            $cek_stmt->execute();
            $cek_res = $cek_stmt->get_result();

            if (mysqli_num_rows($cek_res) > 0) {
                $register_err = "Username atau email sudah terdaftar.";
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
                if ($insert_stmt) {
                    $insert_stmt->bind_param("sss", $username, $email, $hashed);
                    if ($insert_stmt->execute()) {
                        $_SESSION['user_id'] = $insert_stmt->insert_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = 'user';
                        header("Location: ../dashboard/index.php");
                        exit();
                    } else {
                        $register_err = "Gagal mendaftar. Silakan coba lagi.";
                    }
                    $insert_stmt->close();
                } else {
                    $register_err = "Database error.";
                }
            }
            $cek_stmt->close();
        } else {
            $register_err = "Database error.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Daftar - ToDoVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #a1c4fd, #c2e9fb, #ffffff, #a8edea);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .auth-container {
            position: relative;
            width: 90%;
            max-width: 900px;
            min-height: 550px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
        }

        .image-panel {
            flex: 0 0 40%;
            background-size: cover;
            background-position: center;
            transition: background-image 0.6s ease-in-out;
            position: relative;
            z-index: 10;
            border-radius: 20px 0 0 20px;
        }
        .image-panel.left { background-image: url('../assets/img/login1.jpg'); }
        .image-panel.right { background-image: url('../assets/img/login2.jpg'); }

        .form-panel {
            flex: 0 0 60%;
            position: relative;
            padding: 40px;
            color: #2d3748;
            animation: slideInFromBehind 1s ease-out forwards;
        }

        @keyframes slideInFromBehind {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .auth-toggle-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 5px;
            position: relative; 
            z-index: 20;
        }
        .auth-toggle-buttons button {
            flex: 1; padding: 10px 15px; border: none; border-radius: 8px;
            background-color: transparent; color: #4a5568; font-weight: 600;
            cursor: pointer; transition: all 0.3s ease;
        }
        .auth-toggle-buttons button.active {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            color: #fff; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-content-wrapper { position: relative; flex-grow: 1; min-height: 350px; }
        .form-content {
            position: absolute; width: 100%; top: 50%; left: 50%;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
        }
        .form-content.login-form { transform: translate(-50%, -50%); opacity: 1; z-index: 2; }
        .form-content.register-form { transform: translate(150%, -50%); opacity: 0; z-index: 1; }
        .form-content.slide-left { transform: translate(-150%, -50%); opacity: 0; }
        .form-content.slide-right { transform: translate(-50%, -50%); opacity: 1; }

        .form-control {
            background-color: rgba(255, 255, 255, 0.5); border: 1px solid rgba(255, 255, 255, 0.7);
            color: #2d3748; border-radius: 10px; transition: all 0.3s ease;
        }
        .form-control::placeholder { color: #718096; }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.8); border-color: #4facfe;
            box-shadow: 0 0 0 0.25rem rgba(79, 172, 254, 0.3); color: #2d3748;
        }
        .btn-primary {
            background: linear-gradient(45deg, #4facfe, #00f2fe); border: none;
            padding: 12px; font-weight: bold; border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); }
        .form-title { font-weight: 700; color: #1a202c; margin-bottom: 25px; }
        .input-group-text {
            background-color: rgba(255, 255, 255, 0.5); border: 1px solid rgba(255, 255, 255, 0.7);
            border-left: none; cursor: pointer; color: #4a5568;
        }
        a { color: #2b6cb0; text-decoration: none; font-weight: bold; transition: color 0.3s ease; }
        a:hover { color: #00f2fe; text-decoration: underline; }

        .alert-custom {
            background: rgba(224, 49, 49, 0.1);
            border: 1px solid rgba(224, 49, 49, 0.2);
            backdrop-filter: blur(2px);
            color: #c53030;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
        }

        @media (max-width: 850px) {
            .auth-container { flex-direction: column; height: auto; width: 95%; }
            .image-panel { display: none; }
            .form-panel { flex: 1; animation: none; }
            .form-content-wrapper { min-height: auto; }
            .form-content { position: static; transform: none; width: 100%; }
            .form-content.register-form { display: none; }
        }
    </style>
</head>
<body>

<div class="auth-container">
    <div class="image-panel left" id="imagePanel"></div>
    <div class="form-panel">
        <div class="auth-toggle-buttons">
            <button id="showLoginBtn" class="active">Login</button>
            <button id="showRegisterBtn">Register</button>
        </div>
        <div class="form-content-wrapper">
            <div id="loginForm" class="form-content login-form">
                <h4 class="text-center form-title">Login ke ToDoVerse</h4>
                <?php if ($login_err) : ?>
                    <div class="alert-custom text-center mb-3"><?php echo $login_err; ?></div>
                <?php endif; ?>
                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="email_login" class="form-label">Email</label>
                        <input type="email" name="email_login" id="email_login" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_login" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password_login" id="password_login" class="form-control" placeholder="Masukkan password" required>
                            <span class="input-group-text" onclick="togglePassword('password_login')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>
                    <?php if ($showReset): ?>
                        <div class="text-center mt-2"><a href="lupa_password.php">Lupa password?</a></div>
                    <?php endif; ?>
                </form>
            </div>
            <div id="registerForm" class="form-content register-form">
                <h4 class="text-center form-title">Buat Akun ToDoVerse</h4>
                <?php if ($register_err) : ?>
                    <div class="alert-custom text-center mb-3"><?php echo $register_err; ?></div>
                <?php endif; ?>
                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="username_register" class="form-label">Username</label>
                        <input type="text" name="username_register" id="username_register" class="form-control" placeholder="Pilih username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_register" class="form-label">Email</label>
                        <input type="email" name="email_register" id="email_register" class="form-control" placeholder="Masukkan email" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_register" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password_register" id="password_register" class="form-control" placeholder="Buat password" required>
                            <span class="input-group-text" onclick="togglePassword('password_register')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100 mb-3">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const showLoginBtn = document.getElementById('showLoginBtn');
    const showRegisterBtn = document.getElementById('showRegisterBtn');
    const imagePanel = document.getElementById('imagePanel');

    function showForm(formToShow, formToHide, activeBtn, inactiveBtn) {
        formToHide.classList.add('slide-left');
        formToHide.classList.remove('slide-right');
        
        formToHide.style.zIndex = 1;
        formToShow.style.zIndex = 2;

        if (formToShow === loginForm) {
            imagePanel.classList.add('left');
            imagePanel.classList.remove('right');
        } else {
            imagePanel.classList.add('right');
            imagePanel.classList.remove('left');
        }

        setTimeout(() => {
            formToHide.style.display = 'none';
            formToShow.style.display = 'block';
            
            setTimeout(() => {
                formToShow.classList.remove('slide-left');
                formToShow.classList.add('slide-right');
            }, 10);

        }, 600); 

        activeBtn.classList.add('active');
        inactiveBtn.classList.remove('active');
    }

    window.onload = function() {
        if ("<?php echo $register_err; ?>") {
            showRegisterBtn.click();
        }
    }

    showLoginBtn.addEventListener('click', () => {
        if (!showLoginBtn.classList.contains('active')) {
            showForm(loginForm, registerForm, showLoginBtn, showRegisterBtn);
        }
    });

    // PERBAIKAN TYPO ADA DI SINI
    showRegisterBtn.addEventListener('click', () => {
        if (!showRegisterBtn.classList.contains('active')) {
            // Sebelumnya: showForm(registerForm, loginForm, showRegisterBtn, showRegisterBtn)
            // Seharusnya:
            showForm(registerForm, loginForm, showRegisterBtn, showLoginBtn);
        }
    });

    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
</body>
</html>