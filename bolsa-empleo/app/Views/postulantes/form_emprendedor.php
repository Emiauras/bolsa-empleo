<?php use App\Core\UrlHelper; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="mb-4" style="color: var(--color-primary);">🚀 Perfil Emprendedor</h2>
                <p class="text-muted mb-4">Cuéntanos sobre ti para empezar a difundir tus proyectos.</p>
                
                <form action="<?= UrlHelper::base('/postulantes/guardar-perfil') ?>?tipo=3" method="POST">
                    
                    <h5 class="mt-4 text-secondary border-bottom pb-2">Datos de Contacto</h5>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono / WhatsApp</label>
                            <input type="text" class="form-control" name="telefono" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Localidad Base</label>
                            <input type="text" class="form-control" name="localidad" required>
                        </div>
                    </div>

                    <h5 class="mt-4 text-secondary border-bottom pb-2">Tu Proyecto Principal</h5>
                    <div class="mb-3 mt-3">
                        <label class="form-label">Nombre del Emprendimiento (Idea o Real)</label>
                        <input type="text" class="form-control" name="nombre_emprendimiento" placeholder="Ej: Velas Aromáticas S.A.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Breve Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" placeholder="¿De qué trata tu emprendimiento?"></textarea>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg" style="background-color: var(--color-success); border: none;">
                            Comenzar a Emprender 💡
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>