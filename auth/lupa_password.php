<?php
session_start();
require_once '../config/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error = 'Email harus diisi.';
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $token = bin2hex(random_bytes(16));
            $expiry = date("Y-m-d H:i:s", time() + 3600); // 1 jam

            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();

            $update = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE id = ?");
            $update->bind_param("ssi", $token, $expiry, $user_id);
            $update->execute();
            $update->close();

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'todoverse.dev@gmail.com';
                $mail->Password   = 'dndoylognzxjidfe'; // Ganti ke app password milikmu
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('todoverse.dev@gmail.com', 'ToDoVerse Support');
                $mail->addAddress($email);

                $resetLink = "http://localhost/ToDoVerse/auth/reset_password.php?token=" . $token;

                $mail->isHTML(true);
                $mail->Subject = 'Reset Password Anda';
                $mail->Body = "
                    <h3>Reset Password</h3>
                    <p>Klik tombol di bawah ini untuk mereset password Anda:</p>
                    <a href='$resetLink' style='
                        display: inline-block;
                        padding: 10px 20px;
                        background: #0d6efd;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;'>Reset Password</a>
                    <p>Link ini akan kadaluarsa dalam 1 jam.</p>
                ";

                $mail->send();
                $success = 'Link reset telah dikirim ke email Anda.';
            } catch (Exception $e) {
                $error = "Email gagal dikirim. {$mail->ErrorInfo}";
            }
        } else {
            $error = 'Email tidak ditemukan.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | ToDoVerse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
<div class="card shadow-lg p-4 border-0" style="max-width: 400px; width: 100%;">
    <h4 class="text-center mb-3">Lupa Password</h4>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" name="email" id="email" required placeholder="Masukkan email Anda">
        </div>
        <button type="submit" class="btn btn-primary w-100">Kirim Link Reset</button>
    </form>

    <div class="text-center mt-3">
        <a href="login.php">Kembali ke Login</a>
    </div>
</div>
</body>
</html>
