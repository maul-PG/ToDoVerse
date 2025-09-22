<?php
session_start();
require_once '../config/db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Ambil data user dari database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$username = $user['username'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | ToDoVerse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/style_user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<?php include '../includes/navbar_user.php'; ?>

<section class="hero-section">
    <div class="hero-grid">
        <div class="hero-greeting glass-card tilt-card">
            <h1 id="greeting">Selamat Datang, <span><?= htmlspecialchars($username); ?></span></h1>
            <p>buatlah hidupmu lebih bermakna jika tidak jelaskanlah mengapa kamu hidup dan berkembang.</p>
        </div>
        <div class="hero-profile glass-card">
            <div class="profile-info">
                <img src="../assets/img/profile.jpg" alt="Foto User" class="hero-profile-img">
                <span><?= htmlspecialchars($username); ?></span>
            </div>
            <div class="today-focus-widget">
                <h4>Fokus Hari Ini</h4>
                <div class="focus-task-card">
                    <div class="focus-task-icon">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <div class="focus-task-details">
                        <h5>Selesaikan Laporan Bab 4</h5>
                        <p>Deadline: 17:00</p>
                    </div>
                </div>
                <button class="btn-primary focus-task-btn">Mulai Kerjakan</button>
            </div>
        </div>
        <div class="hero-stat-1 glass-card tilt-card">
            <h4>Materi Selesai</h4>
            <p class="stat-number">12</p>
        </div>
        <div class="hero-stat-2 glass-card tilt-card">
            <h4>Poin Kamu</h4>
            <p class="stat-number">1,250</p>
        </div>
    </div>
</section>

<section class="find-schedule-section">
    <div class="find-schedule-grid">
        <div class="find-title-card glass-card fade-in-up">
            <h2>Cari materimu dan jadwalkan</h2>
        </div>
        <div class="motivation-card glass-card tilt-card fade-in-up">
            <h3>Motivasi</h3>
            <blockquote id="motivasiText">"Setiap hari adalah kesempatan baru untuk belajar dan berkembang."</blockquote>
            <button id="motivasiBtn" class="btn-primary"><i class="bi bi-arrow-repeat"></i></button>
        </div>
        <div class="search-card glass-card fade-in-up">
            <h3>Cari Materimu</h3>
            <form id="searchForm">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari materi...">
                </div>
            </form>
        </div>
        <div class="calendar-card glass-card fade-in-up">
            <h3>Kalender Pintar</h3>
            <div id="mini-calendar"></div>
        </div>
        <div class="flashcard-card glass-card tilt-card fade-in-up">
            <div class="flashcard-icon"><i class="bi bi-stack"></i></div>
            <div class="flashcard-content">
                <h3>Coba Flashcard</h3>
                <p>Latih ingatan dengan kartu interaktif.</p>
            </div>
            <button class="btn-primary" id="start-flashcard-btn" style="margin-left: auto;">Mulai Main</button>
        </div>
    </div>
</section>

<section class="plan-section">
    <h2 class="fade-in-up">TENTUKAN RENCANAMU</h2>
    <div class="plan-carousel-wrapper fade-in-up">
        <div class="plan-carousel-track" id="planTrack">
            <div class="plan-card glass-card" data-plan-title="Travel">
                <div class="plan-icon"><i class="bi bi-airplane"></i></div>
                <h3>Travel</h3>
                <p>Bangun suasana bagus</p>
                <button class="plan-action-btn">Pilih Rencana</button>
            </div>
            <div class="plan-card glass-card" data-plan-title="Belajar">
                <div class="plan-icon"><i class="bi bi-book"></i></div>
                <h3>Belajar</h3>
                <p>Pelajari Hal Baru</p>
                <button class="plan-action-btn">Pilih Rencana</button>
            </div>
            <div class="plan-card glass-card" data-plan-title="Project">
                <div class="plan-icon"><i class="bi bi-rocket"></i></div>
                <h3>Project</h3>
                <p>Bangun Keahlian Mu</p>
                <button class="plan-action-btn">Pilih Rencana</button>
            </div>
        </div>
        <button id="planPrev" class="nav-arrow prev"><i class="bi bi-chevron-left"></i></button>
        <button id="planNext" class="nav-arrow next"><i class="bi bi-chevron-right"></i></button>
    </div>
</section>

<section class="feature-section">
    <div class="section-header fade-in-up">
        <h2>Jelajahi Fitur Lainnya</h2>
        <p>Maksimalkan produktivitas Anda dengan semua alat yang kami sediakan.</p>
    </div>
    <div class="feature-gallery">
        <div class="feature-item glass-card tilt-card fade-in-up" 
             data-title="BelajarBareng"
             data-icon-class="bi bi-people-fill"
             data-icon-bg="#e0f7fa"
             data-icon-color="#00796b"
             data-desc="Fitur BelajarBareng memungkinkan Anda untuk membuat atau bergabung dengan grup belajar virtual. Diskusikan materi, bagikan catatan, dan selesaikan tugas bersama teman-teman untuk pemahaman yang lebih mendalam."
             data-url="../dashboard/BelajarBareng/">
            <div class="feature-item-icon" style="background: #e0f7fa;">
                <i class="bi bi-people-fill" style="color: #00796b;"></i>
            </div>
            <h3>BelajarBareng</h3>
            <p>Temukan teman belajar dan diskusikan materi bersama dalam grup.</p>
        </div>
        <div class="feature-item glass-card tilt-card fade-in-up"
             data-title="Kotak Saran"
             data-icon-class="bi bi-lightbulb-fill"
             data-icon-bg="#fff3e0"
             data-icon-color="#f57c00"
             data-desc="Kami sangat menghargai masukan Anda. Gunakan Kotak Saran untuk mengirimkan ide, kritik, atau laporan bug agar kami bisa terus meningkatkan ToDoVerse menjadi lebih baik lagi."
             data-url="../dashboard/KotakSaran/">
            <div class="feature-item-icon" style="background: #fff3e0;">
                <i class="bi bi-lightbulb-fill" style="color: #f57c00;"></i>
            </div>
            <h3>Kotak Saran</h3>
            <p>Punya ide atau masukan? Sampaikan langsung kepada kami.</p>
        </div>
        <div class="feature-item glass-card tilt-card fade-in-up"
             data-title="MoodBoard"
             data-icon-class="bi bi-palette-fill"
             data-icon-bg="#f3e5f5"
             data-icon-color="#7b1fa2"
             data-desc="MoodBoard adalah kanvas digital Anda. Kumpulkan gambar, kutipan, dan tautan inspiratif untuk menjaga motivasi dan fokus pada tujuan besar Anda. Visualisasikan kesuksesan Anda!"
             data-url="../dashboard/MoodBoard/">
            <div class="feature-item-icon" style="background: #f3e5f5;">
                <i class="bi bi-palette-fill" style="color: #7b1fa2;"></i>
            </div>
            <h3>MoodBoard</h3>
            <p>Kumpulkan inspirasi visual untuk menjaga semangat dan kreativitas Anda.</p>
        </div>
        <div class="feature-item glass-card tilt-card fade-in-up"
             data-title="ToDoList"
             data-icon-class="bi bi-check2-square"
             data-icon-bg="#e8f5e9"
             data-icon-color="#388e3c"
             data-desc="Jangan biarkan tugas menumpuk. Dengan ToDoList yang simpel namun kuat, Anda bisa mengatur semua pekerjaan, menetapkan prioritas, dan melacak kemajuan harian Anda dengan mudah."
             data-url="../dashboard/ToDoList/">
            <div class="feature-item-icon" style="background: #e8f5e9;">
                <i class="bi bi-check2-square" style="color: #388e3c;"></i>
            </div>
            <h3>ToDoList</h3>
            <p>Atur semua tugas harian Anda dengan daftar tugas yang simpel & efektif.</p>
        </div>
    </div>
</section>

<section class="quiz-section">
    <div class="quiz-grid">
        <div class="quiz-image-container fade-in-left">
            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8d29ya3NwYWNlLHN0dWR5fHx8fHx8MTY4MTM4NjI5OQ&ixlib=rb-4.0.3&q=80&w=1080" alt="Tes Kemampuan" class="quiz-image">
        </div>
        <div class="quiz-content-container glass-card fade-in-up">
            <h2>Tes Kemampuanmu</h2>
            <p>Uji pemahaman dan lacak kemajuan belajarmu di sini.</p>
            <button class="btn-primary" id="startTestBtn">Mulai Tes</button>
        </div>
    </div>
</section>

<div class="modal" id="planModal">
    <div class="modal-content glass-card">
        <span class="close-modal" id="closePlanModal">&times;</span>
        <h3 id="modalPlanTitle">Isi Rencana</h3>
        <form id="planForm">
            <input type="text" class="modal-input" id="planInput" placeholder="Tulis detail rencanamu..." required>
            <button type="submit" class="btn-primary modal-submit-btn">Simpan ke Kalender</button>
        </form>
    </div>
</div>

<div class="modal" id="testModal">
    <div class="modal-content glass-card">
        <span class="close-modal" id="closeTestModal">&times;</span>
        <div class="test-modal-slider-wrapper">
            <div class="test-modal-slider" id="testModalSlider">
                <div class="test-modal-slide">
                    <h3>Pilih Jenis Tes</h3>
                    <p>Pilih salah satu tes di bawah ini untuk memulai.</p>
                    <div class="test-choices">
                        <div class="test-choice-card"><i class="bi bi-card-checklist"></i><h4>Kuis Singkat</h4><p>Jawab beberapa pertanyaan pilihan ganda.</p></div>
                        <div class="test-choice-card"><i class="bi bi-file-earmark-code"></i><h4>Mini Project</h4><p>Kerjakan proyek kecil untuk menguji skill.</p></div>
                    </div>
                </div>
                <div class="test-modal-slide">
                    <h3>Kotak Saran</h3>
                    <p>Ada masukan untuk kami? Tulis di bawah ini.</p>
                    <form id="saranFormModal"><textarea class="modal-textarea" placeholder="Saran Anda sangat berarti..." required></textarea><button type="submit" class="btn-primary">Kirim Saran</button></form>
                    <p class="saran-redirect">Ingin memberi saran lebih detail? <a href="#">Kunjungi halaman Kotak Saran</a>.</p>
                </div>
            </div>
        </div>
        <div class="slider-nav">
            <button class="slider-dot active" data-slide-to="0"></button>
            <button class="slider-dot" data-slide-to="1"></button>
        </div>
    </div>
</div>

<div class="modal" id="flashcardModal">
    <div class="flashcard-modal-content">
        <span class="close-modal" id="closeFlashcardModal">&times;</span>
        <div class="flashcard-header">
            <h3>Flashcard: Pengetahuan Umum</h3>
            <div class="flashcard-progress-container"><div class="flashcard-progress-bar" id="flashcardProgressBar"></div></div>
        </div>
        <div class="flashcard-game-area">
            <div class="flashcard" id="flashcard">
                <div class="flashcard-face flashcard-front"><p id="flashcard-question">Pertanyaan akan muncul di sini.</p></div>
                <div class="flashcard-face flashcard-back"><h4 id="flashcard-answer-title">Jawaban</h4><p id="flashcard-answer-text">Penjelasan jawaban akan muncul di sini.</p></div>
            </div>
        </div>
        <div class="flashcard-controls">
            <div class="answer-options" id="answerOptions"></div>
            <div class="action-buttons">
                <button class="btn-secondary" id="revealAnswerBtn">Lihat Jawaban</button>
                <button class="btn-primary" id="nextQuestionBtn" style="display: none;">Lanjut <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="featureDetailModal">
    <div class="modal-content glass-card feature-modal-content">
        <span class="close-modal" id="closeFeatureDetailModal">&times;</span>
        <div class="feature-modal-header">
            <div id="modalFeatureIconWrapper" class="feature-item-icon"><i id="modalFeatureIcon" class="bi"></i></div>
            <h2 id="modalFeatureTitle">Nama Fitur</h2>
        </div>
        <p id="modalFeatureDesc">Deskripsi detail fitur akan muncul di sini.</p>
        <a href="#" id="modalFeatureLink" class="btn-primary">Kunjungi Halaman Fitur</a>
    </div>
</div>

<footer class="footer">
    <span>&copy; <?= date('Y'); ?> ToDoVerse. All rights reserved.</span>
</footer>

<script src="../assets/js/dashboard.js"></script>
</body>
</html>