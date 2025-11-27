<?php use App\Core\UrlHelper; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <h2 class="text-center mb-4" style="color: var(--color-primary);">¡Registro Exitoso! Selecciona tu Perfil</h2>
        <p class="text-center text-muted">Elige el rol que mejor te describe para completar la información específica.</p>

        <?php 
        $tipos = $data['tipos'] ?? [];
        foreach ($tipos as $id => $nombre): 
            $clase_bg = ($id == 4) ? 'bg-info-subtle' : 'bg-light'; 
        ?>
        
            <div class="card mb-3 shadow-sm <?= $clase_bg ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($nombre) ?></h5>
                    
                    <a href="<?= UrlHelper::base('/postulantes/completar-perfil') ?>?tipo=<?= $id ?>" 
                       class="btn btn-sm" 
                       style="background-color: var(--color-success); color: white;">
                        Seleccionar <?= htmlspecialchars($nombre) ?>
                    </a>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>