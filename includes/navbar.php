<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">
      <img src="assets/img/LOGO.png" alt="ToDoVerse Logo" width="40" class="me-2">
      ToDoVerse
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#tentangModal">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profilModal">Profil Pembuat</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal Tentang -->
<div class="modal fade" id="tentangModal" tabindex="-1" aria-labelledby="tentangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h5 class="modal-title" id="tentangModalLabel">Tentang ToDoVerse</h5>
        </div>
        <div class="card-body">
          <p>
            <strong>ToDoVerse</strong> adalah aplikasi manajemen tugas yang dirancang untuk membantu Anda mengelola aktivitas harian secara efektif dan terorganisir. Dengan antarmuka yang intuitif dan fitur yang lengkap, ToDoVerse memudahkan Anda dalam mencatat, memprioritaskan, serta memantau progres setiap tugas, sehingga produktivitas Anda tetap optimal.
          </p>
          <ul class="mb-0">
            <li>Mengelola dan mengelompokkan tugas dengan mudah</li>
            <li>Menetapkan prioritas dan tenggat waktu</li>
            <li>Memantau perkembangan tugas secara real-time</li>
            <li>Antarmuka modern dan responsif</li>
          </ul>
        </div>
        <div class="card-footer text-end">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Profil Pembuat -->
<div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
          <h5 class="modal-title mb-0" id="profilModalLabel">Profil Pengembang</h5>
        </div>
        <div class="card-body text-center">
          <img src="assets/img/profil.jpg" alt="Foto Profil" class="rounded-circle shadow mb-3" width="110" height="110">
          <h5 class="fw-bold">Rafi'i Maulana</h5>
          <p class="text-muted mb-2">Mahasiswa Sistem Informasi, UPN “Veteran” Yogyakarta</p>
          <p class="small mb-2">
            Fokus dalam pengembangan web dengan minat di bidang sistem informasi, front-end & back-end development.
          </p>
          <p class="small mb-2">
            <strong>Keahlian:</strong> PHP, MySQL, Laravel, JavaScript, HTML, CSS, Bootstrap.
          </p>
          <p class="small text-muted">
            Passionate in coding, learning new technologies, and building impactful digital products.
          </p>
        </div>
        <div class="card-footer d-flex flex-column align-items-center gap-2">
          <div>
            <i class="bi bi-envelope-fill me-2 text-primary"></i>
            <span>mayway576@gmail.com</span>
          </div>
          <div>
            <i class="bi bi-github me-2 text-dark"></i>
            <a href="https://github.com/rafiimaulana" target="_blank" class="text-decoration-none text-dark">
              github.com/rafiimaulana
            </a>
          </div>
          <button type="button" class="btn btn-outline-secondary btn-sm mt-3" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
</div>
