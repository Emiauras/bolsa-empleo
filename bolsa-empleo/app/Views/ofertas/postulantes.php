<?php use App\Core\UrlHelper; ?>

<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 style="color: var(--color-primary);">👥 Candidatos Postulados</h2>
            <p class="text-muted">Gestiona los talentos interesados en tu oferta.</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= UrlHelper::base('/ofertas') ?>" class="btn btn-outline-secondary">
                ⬅ Volver a mis Ofertas
            </a>
        </div>
    </div>

    <?php if ($msg = App\Core\SessionHelper::getFlash('success')): ?>
        <div class="alert alert-success text-center shadow-sm mb-4"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <?php if ($err = App\Core\SessionHelper::getFlash('error')): ?>
        <div class="alert alert-danger text-center shadow-sm mb-4"><?= htmlspecialchars($err) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if (empty($data['candidatos'])): ?>
                
                <div class="text-center py-5">
                    <div style="font-size: 3rem;">📭</div>
                    <h5 class="text-muted mt-3">Aún no hay postulantes para esta oferta.</h5>
                    <p class="text-muted small">¡Paciencia! Pronto llegarán los talentos.</p>
                </div>

            <?php else: ?>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="ps-4">Candidato</th>
                                <th>Contacto</th>
                                <th>Fecha Postulación</th>
                                <th>Mensaje / Carta</th>
                                <th class="text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['candidatos'] as $c): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold" style="color: var(--color-primary);">
                                            <?= htmlspecialchars($c['nombre'] . ' ' . $c['apellido']) ?>
                                        </div>
                                        <small class="text-muted">DNI: <?= htmlspecialchars($c['dni']) ?></small>
                                    </td>
                                    
                                    <td>
                                        <div>📧 <?= htmlspecialchars($c['email_contacto']) ?></div>
                                        <div class="small text-muted">📞 <?= htmlspecialchars($c['telefono'] ?? 'Sin teléfono') ?></div>
                                    </td>
                                    
                                    <td>
                                        <?= date('d/m/Y', strtotime($c['fecha_postulacion'])) ?>
                                        <br>
                                        <small class="text-muted"><?= date('H:i', strtotime($c['fecha_postulacion'])) ?> hs</small>
                                    </td>
                                    
                                    <td style="max-width: 250px;">
                                        <span class="d-inline-block text-truncate" style="max-width: 240px;" title="<?= htmlspecialchars($c['mensaje_postulante'] ?? '') ?>">
                                            <?= htmlspecialchars($c['mensaje_postulante'] ?? 'Sin mensaje adjunto.') ?>
                                        </span>
                                    </td>
                                    
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group">
                                            <a href="<?= UrlHelper::base('/ofertas/gestionar-candidato') ?>?id=<?= $c['id_postulacion'] ?>&estado=4&oferta=<?= $data['id_oferta'] ?>" 
                                               class="btn btn-sm btn-success text-white" 
                                               title="Preseleccionar para entrevista">
                                               ✅
                                            </a>

                                            <a href="<?= UrlHelper::base('/ofertas/gestionar-candidato') ?>?id=<?= $c['id_postulacion'] ?>&estado=3&oferta=<?= $data['id_oferta'] ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               title="Descartar candidato"
                                               onclick="return confirm('¿Estás seguro de descartar a este candidato?');">
                                               ❌
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>