<?php use App\Core\UrlHelper; ?>

<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 style="color: var(--color-primary);">🚀 Emprendimientos Destacados</h2>
        <p class="text-muted">Descubre proyectos innovadores de nuestra comunidad.</p>
    </div>
</div>

<div class="row">
    <?php if (empty($data['emprendimientos'])): ?>
        <div class="col-12 text-center py-5">
            <h4 class="text-muted">Aún no hay emprendimientos registrados 🌱</h4>
        </div>
    <?php else: ?>
        <?php foreach ($data['emprendimientos'] as $emp): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: var(--color-primary);">
                            <?= htmlspecialchars($emp->getNombre()) ?>
                        </h5>
                        <p class="card-text"><?= htmlspecialchars($emp->getDescripcion()) ?></p>
                        <button class="btn btn-sm btn-outline-secondary">Ver Proyecto</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>