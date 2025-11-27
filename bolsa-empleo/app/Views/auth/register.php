<?php 
use App\Core\UrlHelper; 
$oldInput = $data['old_input'] ?? []; 
?>

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center mb-4" style="color: var(--color-primary);">Registro de Postulante (Paso 1)</h2>
                <p class="text-center text-muted">Datos de acceso y personales básicos.</p>

                <form action="<?= UrlHelper::base('/registro') ?>" method="POST">
                    
                    <input type="hidden" name="id_tipo_postulante" value="1"> 

                    <h5 class="mt-4 text-secondary">Datos de Acceso</h5>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required 
                                   value="<?= htmlspecialchars($oldInput['username'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email (Contacto)</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                        </div>
                    </div>

                    <h5 class="mt-4 text-secondary">Datos Personales</h5>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                   value="<?= htmlspecialchars($oldInput['nombre'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required
                                   value="<?= htmlspecialchars($oldInput['apellido'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="dni" class="form-label">DNI / Identificación</label>
                            <input type="text" class="form-control" id="dni" name="dni" required
                                   value="<?= htmlspecialchars($oldInput['dni'] ?? '') ?>">
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">Registrar y Continuar</button>
                    </div>
                </form>

                <p class="text-center mt-3">
                    ¿Ya tienes cuenta? 
                    <a href="<?= UrlHelper::base('/login') ?>">Inicia Sesión</a>
                </p>
            </div>
        </div>
    </div>
</div>