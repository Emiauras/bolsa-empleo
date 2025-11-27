<?php use App\Core\UrlHelper; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="mb-4" style="color: var(--color-primary);">🏢 Perfil de Empresa</h2>
                <p class="text-muted mb-4">Registra los datos de tu organización para publicar ofertas.</p>
                
                <form action="<?= UrlHelper::base('/postulantes/guardar-perfil') ?>?tipo=4" method="POST">
                    
                    <h5 class="mt-4 text-secondary border-bottom pb-2">Datos Fiscales y Generales</h5>
                    <div class="row mt-3">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Razón Social / Nombre de la Empresa</label>
                            <input type="text" class="form-control" name="razon_social" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CUIT</label>
                            <input type="text" class="form-control" name="cuit" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rubro / Sector</label>
                            <select class="form-select" name="rubro">
                                <option value="">Seleccionar...</option>
                                <option value="1">Tecnología</option>
                                <option value="2">Comercio</option>
                                <option value="3">Servicios</option>
                                <option value="4">Industria</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sitio Web (Opcional)</label>
                            <input type="url" class="form-control" name="sitio_web" placeholder="https://...">
                        </div>
                    </div>

                    <h5 class="mt-4 text-secondary border-bottom pb-2">Ubicación y Contacto</h5>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dirección Fiscal</label>
                            <input type="text" class="form-control" name="direccion">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Institucional</label>
                            <input type="email" class="form-control" name="email_contacto">
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg" style="background-color: var(--color-success); border: none;">
                            Registrar Empresa 🤝
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>