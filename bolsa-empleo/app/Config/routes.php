<?php
// app/Config/routes.php

// Validar que la variable $router exista
if (!isset($router)) {
    return;
}

// ----------------------------------------------------
// RUTAS DE INICIO Y AUTENTICACIÓN
// ----------------------------------------------------

// Página de inicio (Landing)
$router->get('/', 'HomeController@index');

// Login
$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');

// Registro
$router->get('/registro', 'AuthController@showRegisterForm');
$router->post('/registro', 'AuthController@register');

// Cerrar sesión
$router->get('/logout', 'AuthController@logout');

// ----------------------------------------------------
// RUTAS DE PERFIL (Postulantes)
// ----------------------------------------------------

// Redirección general al perfil
$router->get('/perfil', 'PostulanteController@seleccionarTipo');

// Pantalla de selección de tipo (Paso 2 del registro)
$router->get('/postulantes/seleccionar-tipo', 'PostulanteController@seleccionarTipo');

// Formulario de completado de perfil
// NOTA: El tipo se pasa como query param: /postulantes/completar-perfil?tipo=1
$router->get('/postulantes/completar-perfil', 'PostulanteController@showProfileForm');

// Procesar guardado del perfil
$router->post('/postulantes/guardar-perfil', 'PostulanteController@storeProfile');

// ...
$router->get('/perfil', 'PostulanteController@miPerfil'); 
// ...

// ----------------------------------------------------
// RUTAS DE OFERTAS
$router->get('/ofertas', 'OfertaController@index');
$router->get('/ofertas/publicar', 'OfertaController@create');
$router->post('/ofertas/guardar', 'OfertaController@store');
$router->post('/ofertas/postular', 'PostulacionController@store');
$router->get('/emprendimientos', 'EmprendimientoController@index');

// Ruta para subir documentos
$router->post('/documentos/subir', 'DocumentoController@subir');

$router->get('/ofertas/gestionar-candidato', 'OfertaController@gestionarCandidato');