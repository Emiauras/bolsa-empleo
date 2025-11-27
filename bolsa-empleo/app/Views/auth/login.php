<?php 
// Importamos el Helper para generar las rutas correctas
use App\Core\UrlHelper; 
// Recuperamos datos antiguos si hubo error
$oldInput = $data['old_input'] ?? [];
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center mb-4" style="color: var(--color-primary);">Iniciar Sesión</h2>
                
                <form action="<?= UrlHelper::base('/login') ?>" method="POST">
                    <div class="mb-3">
                        <label for="username_or_email" class="form-label">Usuario o Email</label>
                        <input type="text" class="form-control" id="username_or_email" name="username_or_email" required
                               value="<?= htmlspecialchars($oldInput['username_or_email'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>

                <p class="text-center mt-3">
                    ¿No tienes cuenta? 
                    <a href="<?= UrlHelper::base('/registro') ?>">Regístrate aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>