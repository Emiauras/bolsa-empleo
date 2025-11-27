<?php use App\Core\UrlHelper; ?>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #8a2be2;">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= UrlHelper::base('/') ?>">🌸 Bolsa de Empleo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= UrlHelper::base('/ofertas') ?>">Ofertas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= UrlHelper::base('/emprendimientos') ?>">Emprendimientos</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if (App\Core\SessionHelper::get('user_id')): ?>
          <li class="nav-item">
            <span class="nav-link active">Hola, Usuario</span>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-sm btn-outline-light ms-2" href="<?= UrlHelper::base('/logout') ?>">Salir</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= UrlHelper::base('/login') ?>">Ingresar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>