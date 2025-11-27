<?php 
use App\Core\UrlHelper; 

// Recuperamos los datos del perfil si ya existen (para edición)
// $perfil viene del controlador, que a su vez lo trajo del servicio -> repositorio -> factoría
$datosPersonales = $data['perfil']['datos_personales'] ?? null; // Objeto Persona
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="mb-4" style="color: var(--color-primary);">🌸 Completar Perfil: Persona</h2>
                <p class="text-muted mb-4">Cuéntanos un poco más sobre ti para que las empresas puedan conocerte.</p>
                
                <form action="<?= UrlHelper::base('/postulantes/guardar-perfil') ?>?tipo=1" method="POST">
                    
                    <h5 class="mt-4 text-secondary border-bottom pb-2">Información Personal</h5>
                    
                    <div class="row mt-3">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required
                                   value="<?= $datosPersonales ? ($datosPersonales->getFechaNacimiento() ? $datosPersonales->getFechaNacimiento()->format('Y-m-d') : '') : '' ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="telefono" class="form-label">Teléfono de Contacto</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required
                                   value="<?= $datosPersonales ? htmlspecialchars($datosPersonales->getTelefono() ?? '') : '' ?>">
                        </div>
                    </div>

                    <h5 class="mt-4 text-secondary border-bottom pb-2">Ubicación</h5>

                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion"
                                   value="<?= $datosPersonales ? htmlspecialchars($datosPersonales->getDireccion() ?? '') : '' ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="localidad" class="form-label">Localidad</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" required
                                   value="<?= $datosPersonales ? htmlspecialchars($datosPersonales->getLocalidad() ?? '') : '' ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required
                                   value="<?= $datosPersonales ? htmlspecialchars($datosPersonales->getProvincia() ?? '') : '' ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="pais" class="form-label">País</label>
                            <input type="text" class="form-control" id="pais" name="pais" value="Argentina" readonly>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg" style="background-color: var(--color-success); border: none;">
                            Guardar y Finalizar Perfil ✨
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>