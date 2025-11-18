<?php 
$title = 'Registrarse';
include __DIR__ . '/../layouts/header.php'; 
include __DIR__ . '/../layouts/navbar.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="bi bi-person-plus"></i> Crear Cuenta
                    </h2>
                    
                    <!-- Mensaje de error (el backend lo mostrará dinámicamente) -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="/register" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Juan Pérez" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="usuario@ejemplo.com" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Mínimo 8 caracteres" required minlength="8">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password_confirm" 
                                       name="password_confirm" placeholder="Repetí tu contraseña" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tipo_postulante" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="tipo_postulante" name="tipo_postulante" required>
                                <option value="">Seleccioná una opción...</option>
                                <option value="persona">Persona (Postulante básico)</option>
                                <option value="profesional">Profesional</option>
                                <option value="emprendedor">Emprendedor</option>
                                <option value="empresa">Empresa</option>
                            </select>
                            <small class="text-muted">Esto determinará las funciones disponibles en tu cuenta</small>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terminos" name="terminos" required>
                            <label class="form-check-label" for="terminos">
                                Acepto los <a href="/terminos">términos y condiciones</a>
                            </label>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus"></i> Crear Cuenta
                            </button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="mb-0">¿Ya tenés cuenta? 
                            <a href="/login">Iniciá sesión</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>