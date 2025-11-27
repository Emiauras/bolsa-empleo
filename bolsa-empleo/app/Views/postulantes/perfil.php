<?php 
use App\Core\UrlHelper; 
use App\Core\SessionHelper;

$tipo = SessionHelper::get('postulante_tipo');
$datos = $data['perfil']['datos_personales'] ?? null; // Puede ser Persona o Empresa
?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 text-center p-4">
            <div class="mb-3">
                <div style="width: 100px; height: 100px; background-color: <?= $tipo == 4 ? '#ffe4e1' : '#e6e6fa' ?>; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    <?= $tipo == 4 ? '🏢' : '👤' ?>
                </div>
            </div>
            
            <h4 style="color: var(--color-primary);">
                <?php 
                if ($datos) {
                    // Si es empresa usa Razon Social, sino Nombre + Apellido
                    // CORRECCIÓN: Usamos ?? '' para evitar errores si es null
                    echo htmlspecialchars(($tipo == 4) ? ($datos->getRazonSocial() ?? '') : ($datos->getNombre() ?? '') . ' ' . ($datos->getApellido() ?? ''));
                } else {
                    echo 'Usuario Nuevo';
                }
                ?>
            </h4>
            <p class="text-muted">
                <?= htmlspecialchars($datos ? ($datos->getEmailContacto() ?? '') : '') ?>
            </p>
            
            <div class="d-grid gap-2 mt-3">
                <a href="<?= UrlHelper::base('/postulantes/completar-perfil') ?>?tipo=<?= $tipo ?>" class="btn btn-outline-primary btn-sm">
                    ✏️ Editar mis Datos
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <?php if ($tipo == 4): ?>
            <div class="card shadow-sm border-0 mb-4 border-start border-5 border-success">
                <div class="card-body p-4">
                    <h3>📢 Gestión de Ofertas</h3>
                    <p>Publica nuevos avisos de trabajo para encontrar talento.</p>
                    <a href="<?= UrlHelper::base('/ofertas/publicar') ?>" class="btn btn-success text-white">
                        + Publicar Nueva Oferta
                    </a>
                    <a href="<?= UrlHelper::base('/ofertas') ?>" class="btn btn-outline-secondary ms-2">
                        Ver mis Ofertas
                    </a>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 pt-4 ps-4">
                    <h5 style="color: var(--color-primary);">🏢 Datos de la Empresa</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">CUIT:</div>
                        <div class="col-sm-8 fw-bold"><?= htmlspecialchars($datos ? ($datos->getCuit() ?? '-') : '-') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Web:</div>
                        <div class="col-sm-8"><?= htmlspecialchars($datos ? ($datos->getSitioWeb() ?? '-') : '-') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-muted">Ubicación:</div>
                        <div class="col-sm-8">
                            <?php 
                                $loc = $datos ? ($datos->getLocalidad() ?? '') : '';
                                $dir = $datos ? ($datos->getDireccion() ?? '') : '';
                                echo htmlspecialchars($loc . ($loc && $dir ? ', ' : '') . $dir);
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 pt-4 ps-4">
                    <h5 style="color: var(--color-primary);">📌 Información Personal</h5>
                </div>
                <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 pt-4 ps-4 d-flex justify-content-between">
        <h5 style="color: var(--color-primary);">📄 Mis Documentos</h5>
    </div>
    <div class="card-body px-4 pb-4">
        
        <form action="<?= UrlHelper::base('/documentos/subir') ?>" method="POST" enctype="multipart/form-data" class="mb-3">
            <div class="input-group">
                <input type="file" class="form-control" name="archivo" accept=".pdf,.doc,.docx,.jpg" required>
                <button class="btn btn-outline-primary" type="submit">Subir CV</button>
            </div>
            <div class="form-text">Formatos aceptados: PDF, Word, JPG. Máx 5MB.</div>
        </form>

        </div>
</div>
                <div class="card-body px-4 pb-4">
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">DNI:</div>
                        <div class="col-sm-8"><?= htmlspecialchars($datos ? ($datos->getDni() ?? '-') : '-') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 text-muted">Teléfono:</div>
                        <div class="col-sm-8"><?= htmlspecialchars($datos ? ($datos->getTelefono() ?? '-') : '-') ?></div>
                    </div>
                </div>
            </div>
            
            <div class="d-grid">
                <a href="<?= UrlHelper::base('/ofertas') ?>" class="btn btn-primary btn-lg shadow-sm">
                    🔍 Buscar Trabajo
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>