<?php use App\Core\UrlHelper; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 style="color: var(--color-primary);">💼 Ofertas de Empleo</h2>
        <div class="card border-0 shadow-sm mb-4 bg-light">
    <div class="card-body">
        <form action="<?= UrlHelper::base('/ofertas') ?>" method="GET" class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="tipo" class="form-select">
                    <option value="titulo">Buscar por Título</option>
                    <option value="rubro">Buscar por Rubro (ID)</option>
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="q" class="form-control" placeholder="Ej: Diseñadora, Programador..." 
                       value="<?= htmlspecialchars($data['termino'] ?? '') ?>">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">🔍 Buscar</button>
            </div>
        </form>
    </div>
</div>
        <p class="text-muted">Encuentra tu oportunidad ideal entre las mejores empresas.</p>
    </div>
    <div class="col-md-4 text-end">
        <?php if (App\Core\SessionHelper::get('postulante_tipo') === 4): ?>
            <a href="<?= UrlHelper::base('/ofertas/publicar') ?>" class="btn btn-success text-white shadow-sm">
                + Publicar Nueva Oferta
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <?php if (empty($data['ofertas'])): ?>
        <div class="col-12 text-center py-5 bg-white rounded shadow-sm">
            <h4 class="text-muted">Aún no hay ofertas disponibles 😢</h4>
            <p>Vuelve más tarde o sé el primero en publicar.</p>
        </div>
    <?php else: ?>
        <?php foreach ($data['ofertas'] as $oferta): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-left: 5px solid var(--color-primary) !important;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="color: #333;"><?= htmlspecialchars($oferta->getTitulo()) ?></h5>
                        <h6 class="card-subtitle mb-3 text-muted">
                            📅 Publicado: <?= $oferta->getFechaPublicacion() ? $oferta->getFechaPublicacion()->format('d/m/Y') : 'Hoy' ?>
                        </h6>
                        <p class="card-text text-truncate"><?= htmlspecialchars($oferta->getDescripcion()) ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <span class="badge bg-light text-dark border">
                                💰 <?= $oferta->getRangoSalarialDesde() ? '$'.$oferta->getRangoSalarialDesde() : 'A convenir' ?>
                            </span>
                            <button class="btn btn-sm btn-outline-primary">Ver Detalles</button>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
    <span class="badge bg-light text-dark border">
        💰 <?= $oferta->getRangoSalarialDesde() ? '$'.$oferta->getRangoSalarialDesde() : 'A convenir' ?>
    </span>
    
    <?php if (App\Core\SessionHelper::get('postulante_tipo') !== 4 && App\Core\SessionHelper::get('user_id')): ?>
        
        <form action="<?= UrlHelper::base('/ofertas/postular') ?>" method="POST" style="display:inline;">
            <input type="hidden" name="id_oferta" value="<?= $oferta->getIdOferta() ?>">
            <button type="submit" class="btn btn-sm btn-primary">
                ✋ Postularme
            </button>
        </form>

    <?php elseif (!App\Core\SessionHelper::get('user_id')): ?>
        <a href="<?= UrlHelper::base('/login') ?>" class="btn btn-sm btn-outline-primary">Login para postular</a>
    <?php endif; ?>
</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>