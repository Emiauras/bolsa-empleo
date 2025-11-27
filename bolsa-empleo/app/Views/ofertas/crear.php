<?php use App\Core\UrlHelper; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-body p-5">
                <h3 class="mb-4" style="color: var(--color-primary);">✨ Crear Nueva Oferta</h3>
                
                <form action="<?= UrlHelper::base('/ofertas/guardar') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Título del Puesto</label>
                        <input type="text" class="form-control" name="titulo" required placeholder="Ej: Community Manager">
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Rubro</label>
                            <select class="form-select" name="rubro">
                                <option value="1">Tecnología</option>
                                <option value="2">Administración</option>
                                <option value="3">Ventas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Salario Base (Opcional)</label>
                            <input type="number" class="form-control" name="salario_desde" placeholder="$">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción Detallada</label>
                        <textarea class="form-control" name="descripcion" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Requisitos</label>
                        <textarea class="form-control" name="requisitos" rows="3" placeholder="Ej: Inglés avanzado, Excel..."></textarea>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg text-white">Publicar Oferta 📢</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>