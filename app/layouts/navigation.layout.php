<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/">POS System</a>

    <button class="navbar-toggler text-black" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-black"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="?page=login&action=logout" class="btn btn-warning">Logout</a>
        </li>
        <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
          <li class="nav-item">
            <a href="?page=admin" class="btn btn-primary ms-2">Dashboard</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>