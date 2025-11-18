<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <i class="bi bi-briefcase-fill"></i> Portal Empleo
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Usuario NO autenticado -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">
                            <i class="bi bi-person-plus"></i> Registrarse
                        </a>
                    </li>
                <?php else: ?>
                    <!-- Usuario autenticado -->
                    <?php
                    // Datos falsos para pruebas - el backend reemplazará esto con datos reales
                    $userType = $_SESSION['user_type'] ?? 'persona';
                    $userName = $_SESSION['user_name'] ?? 'Usuario';
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi bi-house"></i> Inicio
                        </a>
                    </li>
                    
                    <?php if ($userType === 'empresa'): ?>
                        <!-- Menú para EMPRESA -->
                        <li class="nav-item">
                            <a class="nav-link" href="/empresa/perfil">
                                <i class="bi bi-building"></i> Mi Empresa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ofertas/mis-ofertas">
                                <i class="bi bi-file-text"></i> Mis Ofertas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/postulaciones/recibidas">
                                <i class="bi bi-people"></i> Postulaciones
                            </a>
                        </li>
                        
                    <?php elseif ($userType === 'profesional'): ?>
                        <!-- Menú para PROFESIONAL -->
                        <li class="nav-item">
                            <a class="nav-link" href="/profesional/perfil">
                                <i class="bi bi-person-badge"></i> Mi Perfil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ofertas">
                                <i class="bi bi-search"></i> Buscar Ofertas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/postulaciones/mis-postulaciones">
                                <i class="bi bi-file-earmark-check"></i> Mis Postulaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/documentos">
                                <i class="bi bi-file-earmark-arrow-up"></i> Documentos
                            </a>
                        </li>
                        
                    <?php elseif ($userType === 'emprendedor'): ?>
                        <!-- Menú para EMPRENDEDOR -->
                        <li class="nav-item">
                            <a class="nav-link" href="/emprendedor/perfil">
                                <i class="bi bi-person-badge"></i> Mi Perfil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/emprendimientos">
                                <i class="bi bi-lightbulb"></i> Mis Emprendimientos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ofertas">
                                <i class="bi bi-search"></i> Buscar Ofertas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/documentos">
                                <i class="bi bi-file-earmark-arrow-up"></i> Documentos
                            </a>
                        </li>
                        
                    <?php else: ?>
                        <!-- Menú para PERSONA (postulante básico) -->
                        <li class="nav-item">
                            <a class="nav-link" href="/persona/perfil">
                                <i class="bi bi-person"></i> Mi Perfil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ofertas">
                                <i class="bi bi-search"></i> Buscar Ofertas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/postulaciones/mis-postulaciones">
                                <i class="bi bi-file-earmark-check"></i> Mis Postulaciones
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Dropdown de usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($userName); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/perfil/editar"><i class="bi bi-pencil"></i> Editar Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>