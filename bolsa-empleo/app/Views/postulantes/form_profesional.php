<?php use App\Core\UrlHelper; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="mb-4" style="color: var(--color-primary);">🎓 Perfil Profesional</h2>
                <p class="text-muted mb-4">Completa tus datos académicos y de matrícula.</p>
                
                <form action="<?= UrlHelper::base('/postulantes/guardar-perfil') ?>?tipo=2" method="POST">
                    
                    <h5 class="mt-4 text-secondary border-bottom pb-2">Datos Personales</h5>
                    <div class="row mt-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha Nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Localidad</label>
                            <input type="text" class="form-control" name="localidad" required>
                        </div>
                    </div>

                    <h5 class="mt-4 text-secondary border-bottom pb-2">Información Académica</h5>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Título Profesional</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Ej: Abogado, Ing. en Sistemas" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Institución / Universidad</label>
                            <input type="text" class="form-control" name="institucion" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado_titulo">
                                <option value="graduado">Graduado</option>
                                <option value="en_curso">En Curso</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Matrícula (Opcional)</label>
                            <input type="text" class="form-control" name="matricula">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Año de Graduación</label>
                            <input type="number" class="form-control" name="anio_graduacion" min="1950" max="2030">
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg" style="background-color: var(--color-success); border: none;">
                            Guardar Perfil Profesional ✨
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>