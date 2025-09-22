# 🚀 ToDoVerse

[![PHP](https://img.shields.io/badge/PHP-8.0+-8892BF?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Contributions welcome](https://img.shields.io/badge/Contributions-Welcome-blue)](#-kontribusi)
[![Open Source](https://img.shields.io/badge/Open%20Source-Yes-brightgreen)](LICENSE)

---

> **ToDoVerse** adalah aplikasi manajemen aktivitas & pembelajaran modern: catat rencana, belajar dengan flashcard, mood board, kotak saran, kalender pintar, dan banyak lagi!  
> Dibangun dengan **PHP**, **MySQL/MariaDB**, **Bootstrap**, dan **JavaScript**.  
>  
> 💡 **ToDoVerse adalah proyek open source** — kode sumbernya bebas diakses, digunakan, dan dikembangkan bersama komunitas!

---

## ✨ Fitur Utama

- 🔑 **Autentikasi**  
    - Login & Register  
    - Reset Password via email (token link)  
    - Role-based access (Admin & User)
- 👨‍💼 **Admin**  
    - Kelola user (hapus/ubah role)
- 🧑‍💻 **User**  
    - Dashboard interaktif  
    - Flashcard belajar  
    - Kalender pintar  
    - Motivasi harian  
    - Kotak Saran  
    - MoodBoard  
    - ToDoList  
    - BelajarBareng (sumber belajar terpercaya)

---

## 🖼️ Screenshot Demo

<p align="center">
    <img src="assets/img/screenshot.png" alt="Demo Screenshot" width="700"/>
</p>

---

## 📂 Struktur Direktori

```text
ToDoVerse/
├── auth/
│   ├── login.php
│   ├── register.php
│   ├── lupa_password.php
│   ├── reset_password.php
├── admin/
│   └── index.php
├── dashboard/
│   └── index.php
├── includes/
│   ├── header.php
│   ├── navbar_user.php
├── config/
│   ├── db.php
│   └── mail.php
├── assets/
│   ├── css/
│   │   ├── style.css
│   │   └── style_user.css
│   ├── js/
│   │   └── dashboard.js
│   └── img/
└── README.md
```

---

## ⚙️ Instalasi Cepat

1. **Clone repository**
     ```bash
     git clone https://github.com/username/ToDoVerse.git
     ```

2. **Import database**
     ```sql
     CREATE DATABASE todoverse;
     USE todoverse;

     CREATE TABLE users (
             id INT AUTO_INCREMENT PRIMARY KEY,
             username VARCHAR(50) NOT NULL,
             email VARCHAR(100) UNIQUE NOT NULL,
             password VARCHAR(255) NOT NULL,
             role ENUM('user','admin') DEFAULT 'user',
             reset_token VARCHAR(100) DEFAULT NULL,
             reset_expires DATETIME DEFAULT NULL,
             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Konfigurasi database** (`config/db.php`)
     ```php
     <?php
     $conn = new mysqli("localhost", "root", "", "todoverse");
     if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

4. **Konfigurasi email SMTP** (`config/mail.php`)
     ```php
     <?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

     require '../vendor/autoload.php';

     function sendResetEmail($email, $token) {
             $mail = new PHPMailer(true);
             try {
                     $mail->isSMTP();
                     $mail->Host       = 'smtp.gmail.com';
                     $mail->SMTPAuth   = true;
                     $mail->Username   = 'todoverse.dev@gmail.com';
                     $mail->Password   = 'your-app-password';
                     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                     $mail->Port       = 587;

                     $mail->setFrom('todoverse.dev@gmail.com', 'ToDoVerse');
                     $mail->addAddress($email);

                     $mail->isHTML(true);
                     $mail->Subject = 'Reset Password ToDoVerse';
                     $mail->Body    = "Klik link berikut untuk reset password: <a href='http://localhost/ToDoVerse/auth/reset_password.php?token=$token'>Reset Password</a>";

                     $mail->send();
             } catch (Exception $e) {
                     error_log("Mailer Error: {$mail->ErrorInfo}");
             }
     }
     ?>
     ```

5. **Jalankan project:**  
     👉 [http://localhost/ToDoVerse/](http://localhost/ToDoVerse/)

---

## 🔄 Reset Password Flow

1. User klik **"Lupa Password"**
2. Sistem membuat `reset_token` & `reset_expires`
3. Link dikirim via email (PHPMailer)
4. User klik link → `reset_password.php` → buat password baru

---

## 🛠️ Development

- PHP 8+
- MySQL/MariaDB
- Bootstrap 5
- PHPMailer (via Composer)

Install dependency:
```bash
composer require phpmailer/phpmailer
```

---

## 🔒 Keamanan

- Password terenkripsi (`password_hash()`)
- Validasi input form
- Token reset password ada masa berlaku

---

## 🤝 Kontribusi

1. Fork repo ini
2. Buat branch fitur baru
     ```bash
     git checkout -b fitur-anda
     ```
3. Commit perubahan
     ```bash
     git commit -m "Tambah fitur X"
     ```
4. Push ke branch
     ```bash
     git push origin fitur-anda
     ```
5. Buat Pull Request

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** dan bersifat **open source** — silakan gunakan, modifikasi, dan kontribusi!

---

## 📬 Kontak

- 📧 Email: **[todoverse.dev@gmail.com](mailto:todoverse.dev@gmail.com)**
- 🐙 GitHub: *maul-PG*

---

⚡ Nikmati pengalaman manajemen aktivitas yang lebih produktif & fun bersama **ToDoVerse** — dan jangan ragu untuk berkontribusi di proyek open source ini!
