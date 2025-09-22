<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>ToDoVerse</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    
</head> 
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">

<?php include 'includes/navbar.php'; ?>

<!-- Hero Section -->
<section id="hero" data-aos="fade-down" data-aos-duration="1200" class="hero-section d-flex align-items-center justify-content-center text-center text-white parallax" style="background: url('assets/img/bghero.png') center center/cover no-repeat; min-height: 100vh; position: relative;">
  <div class="overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(12, 101, 107, 0.51);z-index:1;"></div>
  <div class="container position-relative z-2" data-aos="fade-up" style="z-index:2;">
    <h1 class="display-4 fw-bold">Selamat Datang di <span class="text-warning">ToDoVerse</span></h1>
    <p class="lead mb-4">Catat tugasmu, lacak mood, dan belajar bareng dari satu tempat!</p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="auth/auth.php" class="btn btn-warning btn-lg shadow">Mulai Sekarang <i class="bi bi-arrow-right-circle ms-2"></i></a>
      <a href="auth/auth.php" class="btn btn-outline-light btn-lg shadow">Daftar Gratis</a>
    </div>
  </div>
</section>

<!-- Mengapa ToDoVerse Section -->
<section id="mengapa" data-aos-duration="1000" class="bg-light py-5 section-fullscreen" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center">
      <!-- Kiri: Dua Card Gambar (foto dan card penjelasan di-center, tinggi otomatis mengikuti foto, gambar tidak terpotong, tetap proporsional) -->
      <div class="col-md-6 d-flex flex-column gap-4 align-items-center justify-content-center">
        <div class="card shadow-sm border-0 overflow-hidden d-flex align-items-center justify-content-center p-2" style="border-radius: 1.2rem; background: #f8f9fa; width: 100%; max-width: 370px;">
          <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 220px;">
        <img src="assets/img/visualfitur1.jpg" class="img-fluid d-block mx-auto" alt="Fitur Visual 1" style="max-width:100%; height:auto; object-fit:contain; border-radius: 1.2rem;">
          </div>
        </div>
        <div class="card shadow-sm border-0 overflow-hidden d-flex align-items-center justify-content-center p-2" style="border-radius: 1.2rem; background: #f8f9fa; width: 100%; max-width: 370px;">
          <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 220px;">
        <img src="assets/img/visualfitur2.jpg" class="img-fluid d-block mx-auto" alt="Fitur Visual 2" style="max-width:100%; height:auto; object-fit:contain; border-radius: 1.2rem;">
          </div>
        </div>
      </div>
      <!-- Kanan: Card Penjelasan di-center -->
      <div class="col-md-6 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg border-0 p-4 d-flex flex-column justify-content-center align-items-center h-100" style="min-height: 460px; border-radius: 1.2rem; max-width: 420px; margin: auto;">
          <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 220px;">
            <img src="assets/img/visualfitur3.jpg" class="img-fluid d-block mx-auto" alt="Fitur Visual 3" style="max-width:100%; height:auto; object-fit:contain; border-radius: 1.2rem;">
          </div>
        </div>
      </div>
        </div>
      </div>

      <!-- Kanan: Card Penjelasan -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card shadow-lg border-0 p-4 d-flex flex-column justify-content-center h-100" style="min-height: 460px; border-radius: 1.2rem;">
          <h3 class="fw-bold mb-3">Kenapa Ada Fitur Ini?</h3>
          <p class="text-muted">ToDoVerse hadir karena kami paham kamu butuh platform yang menyatukan pencatatan tugas, pemantauan mood, dan akses belajar — semua dalam satu tempat.</p>
          <p>Kami ingin bantu kamu tetap produktif, fokus, dan merasa didukung dalam perjalanan belajarmu.</p>
          <button class="btn btn-warning mt-3 align-self-start" data-bs-toggle="modal" data-bs-target="#fiturModal">
            Daftar Sekarang <i class="bi bi-arrow-right-circle ms-2"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Penjelasan Fitur -->
<!-- Modal Penjelasan Fitur dengan Carousel/Slide -->
<div class="modal fade" id="fiturModal" tabindex="-1" aria-labelledby="fiturModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="fiturModalLabel">Tentang Fitur ToDoVerse</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="fiturCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false" style="border-radius: 0.7rem; box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.08); background: #f8f9fa; padding: 2rem;">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-3 shadow" style="width:70px;height:70px;font-size:2rem;">
                  <i class="bi bi-check2-square"></i>
                </div>
                <h5 class="fw-bold mb-2">ToDo List</h5>
                <p class="text-muted mb-0">Catat & kelola tugas harianmu.</p>
              </div>
            </div>

            <div class="carousel-item">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mb-3 shadow" style="width:70px;height:70px;font-size:2rem;">
                  <i class="bi bi-emoji-smile"></i>
                </div>
                <h5 class="fw-bold mb-2">Mood Tracker</h5>
                <p class="text-muted mb-0">Pantau suasana hatimu setiap hari.</p>
              </div>
            </div>

            <div class="carousel-item">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mb-3 shadow" style="width:70px;height:70px;font-size:2rem;">
                  <i class="bi bi-journal-bookmark"></i>
                </div>
                <h5 class="fw-bold mb-2">BelajarBareng</h5>
                <p class="text-muted mb-0">Akses materi & link belajar.</p>
              </div>
            </div>

            <div class="carousel-item">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mb-3 shadow" style="width:70px;height:70px;font-size:2rem;">
                  <i class="bi bi-chat-left-text"></i>
                </div>
                <h5 class="fw-bold mb-2">Kotak Saran</h5>
                <p class="text-muted mb-0">Kirim ide & masukanmu.</p>
              </div>
            </div>

            <!-- Flash Card Feature -->
            <div class="carousel-item">
              <div class="d-flex flex-column align-items-center text-center">
                <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mb-3 shadow" style="width:70px;height:70px;font-size:2rem;">
                  <i class="bi bi-collection"></i>
                </div>
                <h5 class="fw-bold mb-2">Flash Card</h5>
                <p class="text-muted mb-0">Belajar cepat dengan flash card interaktif.</p>
              </div>
            </div>
            <!-- End Flash Card Feature -->

          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#fiturCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Sebelumnya</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#fiturCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            <span class="visually-hidden">Berikutnya</span>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <a href="auth/auth.php" class="btn btn-success">Daftar Sekarang</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- Fitur Section -->
<section id="fitur" class="fitur-section py-5 bg-white text-dark">
  <div class="container text-center">
    <h2 class="mb-5 fw-bold" data-aos="fade-up">🚀 Fitur Unggulan</h2>
    <div class="row row-cols-1 row-cols-md-5 g-4 justify-content-center align-items-stretch">

      <?php
      $fitur = [
        [
          "icon" => "bi-check2-square",
          "judul" => "ToDo List",
          "deskripsi" => "Catat dan kelola tugas harianmu dengan mudah.",
          "detail" => "Fitur ToDo List memudahkan kamu mencatat, mengatur prioritas, dan menandai tugas yang sudah selesai. Semua tugas tersimpan rapi dan bisa diakses kapan saja."
        ],
        [
          "icon" => "bi-emoji-smile",
          "judul" => "Mood Tracker",
          "deskripsi" => "Lacak suasana hatimu untuk produktivitas maksimal.",
          "detail" => "Mood Tracker membantumu memantau suasana hati setiap hari. Dengan fitur ini, kamu bisa mengenali pola mood dan meningkatkan keseimbangan hidup."
        ],
        [
          "icon" => "bi-journal-bookmark",
          "judul" => "BelajarBareng",
          "deskripsi" => "Akses materi dan link belajar dari sumber terpercaya.",
          "detail" => "BelajarBareng menyediakan berbagai materi, link, dan sumber belajar yang dikurasi dari komunitas. Temukan inspirasi dan belajar bersama teman-teman."
        ],
        [
          "icon" => "bi-chat-left-text",
          "judul" => "Kotak Saran",
          "deskripsi" => "Berikan saran untuk pengembangan ToDoVerse.",
          "detail" => "Kotak Saran adalah tempat kamu menyampaikan ide, kritik, dan masukan untuk membuat ToDoVerse semakin baik dan sesuai kebutuhanmu."
        ],
        [
          "icon" => "bi-collection",
          "judul" => "Flash Card",
          "deskripsi" => "Belajar cepat dengan flash card interaktif.",
          "detail" => "Fitur Flash Card membantumu menghafal materi dengan cara yang menyenangkan dan interaktif. Cocok untuk belajar istilah, definisi, atau konsep penting secara efisien."
        ]
      ];
      foreach ($fitur as $i => $f) {
        $modalId = "fiturModalDetail" . $i;
        echo '
        <div class="col d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="'.($i * 100).'">
          <div class="card fitur-card h-100 shadow-lg border-0 hover-shadow d-flex flex-column align-items-center p-4 w-100" 
               style="min-height:400px; max-width:340px; margin:auto; border-radius:1.2rem; border:2px solid #0d6efd;">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-4 shadow" 
                 style="width:100px;height:100px;font-size:2.8rem; border:4px solid #fff;">
              <i class="bi '.$f["icon"].'"></i>
            </div>
            <h5 class="card-title mb-2 fw-bold text-primary" style="font-size:1.5rem; letter-spacing:0.5px;">'.$f["judul"].'</h5>
            <hr class="w-25 mx-auto my-2" style="border-top:2px solid #0d6efd; opacity:0.5;">
            <p class="mb-3 text-secondary" style="min-height:48px; font-size:1.08rem;">'.$f["deskripsi"].'</p>
            <button class="btn btn-outline-primary btn-lg mb-2 mt-auto px-4 fw-semibold" data-bs-toggle="modal" data-bs-target="#'.$modalId.'">Lihat Detail</button>
          </div>
        </div>
        <!-- Modal Detail Fitur -->
        <div class="modal fade" id="'.$modalId.'" tabindex="-1" aria-labelledby="'.$modalId.'Label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="'.$modalId.'Label">'.$f["judul"].'</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="d-flex align-items-center justify-content-center mb-3">
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow" style="width:70px;height:70px;font-size:2rem; border:3px solid #fff;">
                    <i class="bi '.$f["icon"].'"></i>
                  </div>
                </div>
                <p class="mb-0">'.$f["detail"].'</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        ';
      }
      ?>
    </div>
  </div>
</section>


<!-- Garis pemisah antar section -->
<hr class="my-5 border-3 border-primary opacity-50">

<!--statistik-->
<section>
  <div class="container py-5">
    <div class="row align-items-center justify-content-center" data-aos="slide-right" data-aos-duration="1200">
      <!-- Kiri: Card dengan Diagram Lingkaran -->
      <div class="col-md-5 mb-4 mb-md-0 d-flex justify-content-center">
        <div class="card shadow-lg border-0 p-4 text-center w-100" style="max-width:350px;">
          <h5 class="fw-bold mb-3">Pengguna ToDo List</h5>
          <canvas id="todoPieChart" width="180" height="180" style="margin:auto;"></canvas>
          <div class="mt-3">
            <span class="fw-semibold fs-4 text-primary" id="todoPercent">78%</span>
            <span class="text-muted">dari pengguna aktif</span>
          </div>
          <p class="text-muted mt-2 mb-0" style="font-size:0.95rem; text-align:justify;">Menggunakan fitur ToDo List secara rutin</p>
        </div>
      </div>
      <!-- Kanan: Penjelasan dan Statistik Gender -->
      <div class="col-md-7 d-flex flex-column align-items-center">
        <div style="max-width:600px; width:100%;">
          <h3 class="fw-bold mb-3 text-center">Mengapa Banyak Orang Memakai ToDo List?</h3>
          <p class="mb-4 text-muted" style="font-size:1.1rem; text-align:justify;">
            ToDo List membantu pengguna mengatur prioritas, meningkatkan produktivitas, dan mengurangi stres karena tugas yang menumpuk. Dengan pencatatan yang terstruktur, pengguna lebih mudah mencapai target harian dan menjaga keseimbangan hidup.
          </p>
          <!-- Statistik Gender -->
          <div class="bg-light rounded-4 shadow-sm p-4 d-flex align-items-center gap-4 justify-content-center mx-auto" style="max-width:420px;">
            <div class="flex-fill text-center">
              <div class="fw-bold fs-3 text-primary">55%</div>
              <div class="text-muted">Pria</div>
            </div>
            <div class="flex-fill text-center">
              <div class="fw-bold fs-3 text-danger">45%</div>
              <div class="text-muted">Wanita</div>
            </div>
          </div>
          <div class="mt-2 text-muted text-center" style="font-size:0.95rem;">Persentase pengguna ToDo List berdasarkan gender</div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Pie chart untuk persentase pengguna ToDo List
    const ctx = document.getElementById('todoPieChart').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Menggunakan', 'Tidak Menggunakan'],
        datasets: [{
          data: [78, 22],
          backgroundColor: ['#0d6efd', '#e9ecef'],
          borderWidth: 0
        }]
      },
      options: {
        cutout: '70%',
        plugins: {
          legend: { display: false }
        }
      }
    });
  </script>
</section>
<!-- Garis pemisah antar section -->
<hr class="my-5 border-3 border-primary opacity-50">

<!--diagram batang-->
<section data-aos="fade-up" data-aos-duration="1000">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 p-4" style="min-height:340px;">
          <h4 class="fw-bold mb-3 text-center">Penggunaan ToDo List Pria & Wanita (2020-2025)</h4>
          <div style="height:220px;">
            <canvas id="todoBarChartGender" height="180"></canvas>
          </div>
          <div class="mt-3 text-muted text-center" style="font-size:0.97rem;">
            Persentase pengguna aktif ToDo List pria & wanita setiap tahun
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</section>
<hr class="my-5 border-3 border-primary opacity-50">

<!--ajakan untuk daftar sejarang-->
<section>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 p-5 text-center">
          <h2 class="fw-bold mb-3 text-primary">Kenapa Harus Join ToDoVerse?</h2>
          <p class="lead mb-4">
            ToDoVerse bukan sekadar aplikasi pencatat tugas. Kami hadir sebagai solusi lengkap untuk kamu yang ingin lebih produktif, terorganisir, dan tetap menjaga kesehatan mental. Dengan fitur ToDo List, Mood Tracker, dan BelajarBareng, kamu bisa mengelola tugas harian, memantau suasana hati, serta mendapatkan akses ke sumber belajar berkualitas. Semua fitur ini dirancang agar kamu tidak hanya menyelesaikan tugas, tapi juga memahami pola kerja dan belajar dengan cara yang menyenangkan. Komunitas ToDoVerse juga siap mendukungmu dengan inspirasi, tips, dan ruang berbagi pengalaman. Jadikan ToDoVerse teman setia dalam perjalanan meraih impian dan targetmu!
          </p>
          <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
            <a href="auth/auth.php" class="btn btn-warning btn-lg shadow">Daftar Sekarang</a>
            <a href="auth/auth.php" class="btn btn-outline-primary btn-lg shadow">Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Garis pemisah antar section -->
<hr class="my-5 border-3 border-primary opacity-50">

<!--about website-->
<!-- SECTION ABOUT WEBSITE -->
<section data-aos="slide-left" data-aos-duration="1200">
  <div class="container py-5">
    <div class="row align-items-center">
      <!-- Kolom Kiri -->
      <div class="col-lg-7 mb-4 mb-lg-0 d-flex flex-column align-items-center align-items-lg-start">
        <!-- Judul Oval -->
        <div class="mb-4 w-100 d-flex justify-content-center justify-content-lg-start">
          <div class="bg-primary text-white px-5 py-3 rounded-pill shadow text-center" style="font-size:1.5rem; min-width:260px;">
            <i class="bi bi-info-circle me-2"></i> About Website
          </div>
        </div>
        <!-- Alasan Website Dibuat -->
        <div class="mb-4 w-100">
          <p class="fs-5 text-justify" style="text-align: justify;">
            Website ini dibuat untuk membantu pelajar dan mahasiswa dalam mengelola tugas, memantau mood, serta mendapatkan akses belajar yang terintegrasi dalam satu platform. Kami ingin menciptakan ekosistem produktif yang mendukung perkembangan akademik dan kesejahteraan mental.
          </p>
        </div>
        <!-- Tombol Kontak Lengkap -->
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#kontakLengkapModal">
          <i class="bi bi-people-fill me-2"></i> Lihat Kontak Lengkap
        </button>
      </div>

      <!-- Kolom Kanan -->
      <div class="col-lg-5 d-flex justify-content-center">
        <div class="card shadow-lg border-0" style="width:100%; max-width:370px;">
          <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-map-fill me-2"></i> Lokasi Web Dibuat
          </div>
          <div class="card-body p-0">
            <div style="width:100%;height:300px;overflow:hidden;border-radius:.5rem;">
              <iframe 
                src="https://www.google.com/maps?q=-7.782889,110.367083&hl=id&z=15&output=embed"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi ToDoVerse"
              ></iframe>
            </div>
            <div class="p-3">
              <div class="text-muted" style="font-size:0.97rem;">
                Jl. Mawar No. 123, Kota Pelajar, Indonesia
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL KONTAK (dipisahkan dari section agar tidak terpengaruh animasi) -->
<div class="modal fade" id="kontakLengkapModal" tabindex="-1" aria-labelledby="kontakLengkapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="backdrop-filter: blur(6px); background: rgba(255,255,255,0.95); border: none;">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="kontakLengkapModalLabel">
          <i class="bi bi-info-circle-fill me-2"></i>Kontak & Media Sosial
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Kolom Kontak -->
          <div class="col-md-6 mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Jl. Mawar No. 123, Kota Pelajar, Indonesia 12345</li>
              <li class="list-group-item"><i class="bi bi-envelope-fill text-primary me-2"></i>todoverse.dev@gmail.com</li>
              <li class="list-group-item"><i class="bi bi-telephone-fill text-success me-2"></i>+62 812-3456-7890</li>
              <li class="list-group-item"><i class="bi bi-instagram text-danger me-2"></i>
                <a href="https://instagram.com/todoverse" target="_blank" class="text-decoration-none">@todoverse</a>
              </li>
              <li class="list-group-item"><i class="bi bi-twitter-x text-dark me-2"></i>
                <a href="https://twitter.com/todoverse" target="_blank" class="text-decoration-none">@todoverse</a>
              </li>
              <li class="list-group-item"><i class="bi bi-facebook text-primary me-2"></i>
                <a href="https://facebook.com/todoverse" target="_blank" class="text-decoration-none">ToDoVerse</a>
              </li>
            </ul>
          </div>

          <!-- Kolom Map Mini (optional jika ingin juga di modal) -->
          <div class="col-md-6">
            <div class="rounded overflow-hidden shadow-sm mb-2" style="height: 250px;">
              <iframe 
                src="https://www.google.com/maps?q=-7.782889,110.367083&hl=id&z=15&output=embed"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi ToDoVerse"
              ></iframe>
            </div>
            <p class="text-muted small mb-0">Jl. Mawar No. 123, Kota Pelajar, Indonesia</p>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <small class="text-muted">Terima kasih telah mendukung ToDoVerse 💙</small>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>



<!-- Garis pemisah antar section -->
<hr class="my-5 border-3 border-primary opacity-50">

<!--penutup web-->
<section>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-lg border-0 p-5 text-center bg-primary text-white">
          <h1 class="fw-bold mb-4 display-5">Ayo Mulai Perjalanan Produktifmu di ToDoVerse!</h1>
          <p class="lead mb-4 fs-4">
            Jangan biarkan tugas menumpuk dan mood tak terpantau. Bersama ToDoVerse, kamu bisa mengelola tugas, menjaga semangat, dan berkembang bersama komunitas yang saling mendukung. Jadikan setiap hari lebih teratur, penuh inspirasi, dan raih impianmu dengan langkah pasti. Daftar sekarang dan rasakan perubahan positif dalam hidupmu!
          </p>
          <a href="auth/auth.php" class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow mt-3">Gabung Sekarang</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- footer-->
 <footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="row text-center text-md-start">
            <div class="col-md-4 mb-4 mb-md-0">
              <h4 class="fw-bold mb-3">ToDoVerse</h4>
              <p>Platform all-in-one untuk tugas, mood, dan belajar bareng. Didesain untuk pelajar & mahasiswa Indonesia.</p>
              <div class="mt-3">
                <a href="https://instagram.com/todoverse" target="_blank" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                <a href="https://twitter.com/todoverse" target="_blank" class="text-white me-3 fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="https://facebook.com/todoverse" target="_blank" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
              </div>
            </div>
            <div class="col-md-2 mb-4 mb-md-0">
              <h5 class="fw-bold mb-3">Navigasi</h5>
              <ul class="list-unstyled">
                <li><a href="#hero" class="text-white text-decoration-none">Beranda</a></li>
                <li><a href="#fitur" class="text-white text-decoration-none">Fitur</a></li>
                <li><a href="#tentang" class="text-white text-decoration-none">Tentang</a></li>
                <li><a href="#kontak" class="text-white text-decoration-none">Kontak</a></li>
              </ul>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
              <h5 class="fw-bold mb-3">Fitur Unggulan</h5>
              <ul class="list-unstyled">
                <li><i class="bi bi-check2-square me-2"></i>ToDo List</li>
                <li><i class="bi bi-emoji-smile me-2"></i>Mood Tracker</li>
                <li><i class="bi bi-journal-bookmark me-2"></i>BelajarBareng</li>
                <li><i class="bi bi-chat-left-text me-2"></i>Kotak Saran</li>
              </ul>
            </div>
            <div class="col-md-3">
              <h5 class="fw-bold mb-3">Kontak & Lokasi</h5>
              <ul class="list-unstyled mb-2">
                <li><i class="bi bi-envelope-at-fill me-2"></i>todoverse.dev@gmail.com</li>
                <li><i class="bi bi-telephone-fill me-2"></i>+62 812-3456-7890</li>
                <li><i class="bi bi-geo-alt-fill me-2"></i>Jl. Mawar No. 123, Kota Pelajar</li>
              </ul>
              <div style="width:100%;height:100px;overflow:hidden;border-radius:.5rem;">
                <iframe 
                  src="https://www.google.com/maps?q=-7.782889,110.367083&hl=id&z=15&output=embed"
                  width="100%" height="100" style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  title="Lokasi ToDoVerse"
                ></iframe>
              </div>
            </div>
          </div>
          <hr class="my-4 border-light opacity-25">
          <div class="text-center small">
            &copy; 2025 ToDoVerse. All rights reserved. | Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> di Indonesia
          </div>
        </div>
      </div>
    </div>
  </footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-in-out',
        delay: 100,
        anchorPlacement: 'top-bottom',
        disable: window.innerWidth < 768 // Disable on mobile
    });

    // Refresh AOS on window load
    window.addEventListener('load', AOS.refresh);

    // Charts initialization
    document.addEventListener('DOMContentLoaded', function() {
        // Pie Chart
        const ctx = document.getElementById('todoPieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Menggunakan', 'Tidak Menggunakan'],
                datasets: [{
                    data: [78, 22],
                    backgroundColor: ['#0d6efd', '#e9ecef'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('todoBarChartGender').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024', '2025'],
                datasets: [{
                    label: 'Pria',
                    data: [25, 29, 33, 37, 41, 43],
                    backgroundColor: '#0d6efd',
                    borderRadius: 8,
                    maxBarThickness: 32
                }, {
                    label: 'Wanita',
                    data: [20, 23, 27, 31, 34, 35],
                    backgroundColor: '#dc3545',
                    borderRadius: 8,
                    maxBarThickness: 32
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 60,
                        ticks: {
                            callback: function(value) { return value + '%' }
                        }
                    }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Handle resize
        window.addEventListener('resize', function() {
            pieChart.resize();
            barChart.resize();
        });
    });
</script>
</body>
</html>
