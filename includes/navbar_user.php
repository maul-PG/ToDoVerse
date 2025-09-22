<?php
include '../config/db.php';
include '../includes/header.php';

// Add this function at the top of the file after session_start()
function isCurrentPage($path) {
    $currentFile = basename($_SERVER['PHP_SELF']);
    $currentDir = basename(dirname($_SERVER['PHP_SELF']));
    
    if (strpos($path, '/') !== false) {
        // For paths with subdirectories (e.g. 'ToDoList/index.php')
        list($dir, $file) = explode('/', $path);
        return $currentDir === $dir && $currentFile === $file;
    }
    
    // For direct files (e.g. 'index.php')
    return $currentFile === $path;
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT u.username, p.foto_profil AS foto FROM users u 
          LEFT JOIN profil p ON u.id = p.user_id 
          WHERE u.id = $user_id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

$username = $row['username'];
$foto = !empty($row['foto']) ? '../uploads/' . $row['foto'] : 'https://via.placeholder.com/40';

$tugas = [];
$limit_date = date('Y-m-d', strtotime('+3 days'));

$sql_notif = "SELECT id, judul_tugas, deadline FROM tugas 
              WHERE user_id = $user_id AND status = 'belum' 
              AND deadline <= '$limit_date' 
              ORDER BY deadline ASC LIMIT 5";

$notif_result = $conn->query($sql_notif);
if ($notif_result && $notif_result->num_rows > 0) {
    while ($row = $notif_result->fetch_assoc()) {
        $tugas[] = $row;
    }
}
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="../assets/img/LOGO.png" alt="Logo" width="32" height="32" class="me-2">
      ToDoVerse
    </a>
    <nav class="navbar-menu">
  <div class="nav-left">
    <a href="../dashboard/index.php" class="<?= isCurrentPage('index.php') ? 'navlink-active' : '' ?>">Beranda</a>
    <a href="../dashboard/ToDoList/index.php" class="<?= isCurrentPage('ToDoList/index.php') ? 'navlink-active' : '' ?>">ToDoList</a>
    <a href="../dashboard/MoodBoard/index.php" class="<?= isCurrentPage('MoodBoard/index.php') ? 'navlink-active' : '' ?>">MoodBoard</a>

    <!-- Dropdown BelajarBareng -->
    <div class="dropdown">
      <button class="dropbtn <?= (isCurrentPage('BelajarBareng/flashcard.php') || 
                               isCurrentPage('BelajarBareng/sumber.php') || 
                               isCurrentPage('BelajarBareng/kelas.php')) ? 'navlink-active' : '' ?>">
        BelajarBareng ▼
      </button>
      <div class="dropdown-content">
        <a href="../dashboard/BelajarBareng/flashcard.php" class="<?= isCurrentPage('BelajarBareng/flashcard.php') ? 'navlink-active' : '' ?>">📇 Flashcard</a>
        <a href="../dashboard/BelajarBareng/sumber.php" class="<?= isCurrentPage('BelajarBareng/sumber.php') ? 'navlink-active' : '' ?>">🔗 Sumber Belajar</a>
        <a href="../dashboard/BelajarBareng/kelas.php" class="<?= isCurrentPage('BelajarBareng/kelas.php') ? 'navlink-active' : '' ?>">🏫 Kelas & Materi</a>
      </div>
    </div>

    <a href="../dashboard/KotakSaran/index.php" class="<?= isCurrentPage('KotakSaran/index.php') ? 'navlink-active' : '' ?>">KotakSaran</a>
  </div>
</nav>


<style>

.navlink-active {
    color: #007bff !important;
    font-weight: 600;
    border-bottom: 2px solid #007bff;
    background-color: rgba(0, 123, 255, 0.1);
}

.dropdown .navlink-active {
    border-bottom: none;
    border-radius: 8px;
}

.dropdown-content .navlink-active {
    background-color: rgba(0, 123, 255, 0.1);
    color: #007bff !important;
    font-weight: 600;
}

.navbar-menu a,
.dropbtn {
  padding: 10px 16px;
  text-decoration: none;
  color: #333;
  font-weight: 500;
  border-radius: 8px;
  transition: background-color 0.3s ease;
  background: none;
  border: none;
  cursor: pointer;
}

.navbar-menu a:hover,
.dropbtn:hover {
  background-color: #f0f0f0;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #ffffff;
  min-width: 160px;
  border-radius: 10px;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.15);
  z-index: 1;
}

.dropdown-content a {
  color: #333;
  padding: 10px 14px;
  text-decoration: none;
  display: block;
  transition: background-color 0.2s ease;
}

.dropdown-content a:hover {
  background-color: #eeeeee;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-toggle::after {
    display: none;
}

.nav-item.dropdown .dropdown-menu {
    margin-top: 0.5rem;
    min-width: 300px;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.nav-item.dropdown .dropdown-menu .dropdown-item {
    padding: 0.5rem 1rem;
}
</style>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto"></ul>

      <div class="d-flex align-items-center gap-3">
        <!-- Search -->
        <form id="searchFormNav" class="d-flex align-items-center" style="height: 40px; margin-top: 20px;">
  <div class="input-group align-items-center" style="height: 36px;">
    <input type="search" id="navbarSearchInput" class="form-control border border-secondary rounded-start-pill" placeholder="Cari..." style="height: 100%; font-size: 14px; padding-top: 4px; padding-bottom: 4px;">
    <button type="submit" class="btn btn-outline-primary border border-secondary rounded-end-pill" style="height: 100%; padding: 0 12px;">
      <i class="bi bi-search"></i>
    </button>
  </div>
</form>




<style>
  #searchFormNav .form-control,
  #searchFormNav .btn {
    height: 36px !important;
    font-size: 14px;
    padding-top: 2px;
    padding-bottom: 8px;
  }

  .d-flex.align-items-center.gap-3 {
    display: flex !important;
    align-items: center !important;
    gap: 18px !important;
    flex-direction: row !important;
  }

  #searchFormNav {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
  }

  .navbar .dropdown > button {
    height: 36px;
    display: flex;
    align-items: center;
  }

  .navbar .dropdown img {
    object-fit: cover;
    height: 36px;
    width: 36px;
  }
</style>


        <!-- Notifikasi -->
        <div class="nav-item dropdown">
    <button class="btn btn-link dropdown-toggle bg-transparent border-0 position-relative p-0" 
            type="button" 
            id="notificationDropdown"
            data-bs-toggle="dropdown" 
            aria-expanded="false">
        <i class="bi bi-bell text-secondary fs-5"></i>
        <?php if (count($tugas) > 0): ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= count($tugas) ?>
        </span>
        <?php endif; ?>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
        <li><h6 class="dropdown-header">Notifikasi Tugas</h6></li>
        <li><hr class="dropdown-divider"></li>
        <?php if (count($tugas) > 0): ?>
            <?php foreach ($tugas as $t): ?>
            <li>
                <a class="dropdown-item text-wrap" href="detail_tugas.php?id=<?= $t['id'] ?>">
                    <div class="d-flex align-items-center">
                        <div class="me-2">
                            <i class="bi bi-calendar-event text-primary"></i>
                        </div>
                        <div>
                            <?= htmlspecialchars($t['judul_tugas']) ?><br>
                            <small class="text-muted">Deadline: <?= date('d M Y', strtotime($t['deadline'])) ?></small>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li><span class="dropdown-item text-muted">Tidak ada tugas mendesak.</span></li>
        <?php endif; ?>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-center text-primary" href="notifikasi.php">Lihat Semua</a></li>
    </ul>
</div>

        <!-- Profil Dropdown -->
        <div class="dropdown">
          <button class="btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $foto ?>" alt="Foto Profil" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
          </button>
          <ul class="dropdown-menu dropdown-menu-end text-center">
            <li><span class="dropdown-item-text fw-semibold"><?= htmlspecialchars($username) ?></span></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="edit_profil.php"><i class="bi bi-person-circle me-1"></i> Edit Profil</a></li>
            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Modal Search -->
<div class="modal fade" id="searchModalNav" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Pencarian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Hasil untuk: <span id="searchQueryNav"></span></p>
        <div id="searchResults" class="mb-3 text-center text-secondary">Belum ada hasil.</div>
        <a href="#" id="lihatLainnyaLink" class="btn btn-link w-100 text-primary">Lihat lainnya</a>
      </div>
    </div>
  </div>
</div>


<!-- JS untuk modal search -->
<script>
function showSearchModal() {
  var query = document.getElementById('navbarSearchInput').value.trim();
  if (!query) return;
  document.getElementById('searchQueryNav').textContent = query;
  document.getElementById('lihatLainnyaLink').href = 'search.php?q=' + encodeURIComponent(query);
  var modal = new bootstrap.Modal(document.getElementById('searchModalNav'));
  modal.show();
}
document.getElementById('searchFormNav').addEventListener('submit', function(e) {
  e.preventDefault();
  showSearchModal();
});
</script>

<!-- Bootstrap Icons & Animate.css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap dropdowns
    const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
    const dropdowns = [...dropdownElementList].map(dropdownToggle => new bootstrap.Dropdown(dropdownToggle));
    
    // Add click handler for notification dropdown
    const notifButton = document.getElementById('notificationDropdown');
    if (notifButton) {
        notifButton.addEventListener('click', function(e) {
            const dropdown = bootstrap.Dropdown.getOrCreateInstance(this);
            dropdown.toggle();
        });
    }
});
</script>
