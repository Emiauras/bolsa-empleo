<?php use App\Core\UrlHelper; ?>

<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3" style="color: var(--color-primary);">🌸 Bolsa de Empleo Inteligente</h1>
            <p class="lead text-muted mb-5">
                Conectamos talento con oportunidades. Encuentra tu próximo desafío profesional o publica tu búsqueda hoy mismo.
            </p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="<?= UrlHelper::base('/ofertas') ?>" class="btn btn-primary btn-lg px-4 shadow-sm">
                    🔍 Ver Ofertas
                </a>
                
                <?php if (!App\Core\SessionHelper::get('user_id')): ?>
                    <a href="<?= UrlHelper::base('/registro') ?>" class="btn btn-outline-secondary btn-lg px-4">
                        ✨ Crear Cuenta
                    </a>
                <?php else: ?>
                    <a href="<?= UrlHelper::base('/perfil') ?>" class="btn btn-outline-success btn-lg px-4">
                        👤 Ir a mi Perfil
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="row mt-5 pt-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3" style="font-size: 3rem;">👩‍💼</div>
                <h3 class="text-primary">Personas</h3>
                <p class="text-muted">Carga tu CV y postúlate a las mejores ofertas del mercado.</p>
                <a href="<?= UrlHelper::base('/ofertas') ?>" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3" style="font-size: 3rem;">🏢</div>
                <h3 class="text-primary">Empresas</h3>
                <p class="text-muted">Publica avisos, gestiona postulantes y encuentra el perfil ideal.</p>
                <a href="<?= UrlHelper::base('/ofertas/publicar') ?>" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-effect">
                <div class="mb-3" style="font-size: 3rem;">🚀</div>
                <h3 class="text-primary">Emprendedores</h3>
                <p class="text-muted">Difunde tus proyectos y conecta con socios o inversores.</p>
                <a href="<?= UrlHelper::base('/emprendimientos') ?>" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-effect {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(138, 43, 226, 0.15) !important; /* Sombra lavanda */
        cursor: pointer;
    }
</style>