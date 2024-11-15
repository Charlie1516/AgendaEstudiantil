<?php
include_once __DIR__ . "/../controller/AuthController.php";
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="./">AGENDA ESTUDIANTIL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">INICIO</a>
        </li>
      </ul>
      <div class="d-flex">
        <?php if (AuthController::isAuth()) : ?>
          <li><a class="btn btn-primary" href="./profile.php">PERFIL</a></li>
          <li><a class="btn btn-danger" href="./logout.php">SALIR</a></li>
        <?php else : ?>
          <li><a class="btn btn-outline-secondary" href="./register.php">REGISTRO</a></li>
          <li><a class="btn btn-primary" href="./login.php">LOGIN</a></li>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>