<?php 
use App\Core\UrlHelper; 
$oldInput = $data['old_input'] ?? [];
?>

<div class="container d-flex justify-content-center">
    <div class="row w-100">
        <div class="col-12 d-flex justify-content-center">
            
            <div class="login-card-pinterest">
                
                <div class="icon-pinterest-circle mb-5">
                    <span>✨</span> 
                </div>

                <h2 class="mb-3">Bienvenida</h2>
                <p class="text-muted mb-5" style="font-family: 'Dancing Script', cursive; font-size: 1.5rem; color: var(--color-text-soft);">
                    ¡Tu mundo de oportunidades te espera!
                </p>

                <form action="<?= UrlHelper::base('/login') ?>" method="POST">
                    
                    <div class="mb-4 text-start">
                        <label for="username" class="form-label">Usuario o Email</label>
                        <input type="text" class="form-control form-control-pinterest" id="username" name="username_or_email" 
                               placeholder="Tu.Email@ejemplo.com" required
                               value="<?= htmlspecialchars($oldInput['username_or_email'] ?? '') ?>">
                    </div>

                    <div class="mb-5 text-start">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-control-pinterest" id="password" name="password" 
                               placeholder="••••••••••••" required>
                    </div>
                    
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg btn-login-pinterest shadow-sm">
                            Ingresar
                        </button>
                    </div>
                </form>

                <div class="mt-4">
                    <p class="text-muted small">¿Aún no tienes cuenta?</p>
                    <a href="<?= UrlHelper::base('/registro') ?>" class="link-pinterest">
                        Crea tu perfil ahora ✨
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>