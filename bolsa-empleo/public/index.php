<?php
// public/index.php

// 1. Configuración de Errores (Para ver si falla algo en el Perfil)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Buffer de Salida (CRÍTICO: Evita errores de headers/redirección)
ob_start();

// --- CARGA DE ARCHIVOS ---
require __DIR__ . '/../app/Core/Autoloader.php'; 
require __DIR__ . '/../app/Config/config.php'; 

use App\Core\Router;
use App\Core\Container; 
use App\Core\SessionHelper; 

try {
    // --- INICIO DE LA APLICACIÓN ---
    SessionHelper::start(); 

    $container = new Container(); 
    $router = new Router($container); 

    require __DIR__ . '/../app/Config/routes.php';        

    // Ejecutar la acción
    $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

} catch (Throwable $e) {
    // Si algo explota, limpiamos la pantalla y mostramos el error bonito
    ob_clean();
    echo "<div style='font-family:sans-serif; background:#ffebee; color:#c62828; padding:20px; border:2px solid red;'>";
    echo "<h1>🔥 Error Fatal del Sistema</h1>";
    echo "<h3>" . $e->getMessage() . "</h3>";
    echo "<p>Archivo: " . $e->getFile() . " (Línea " . $e->getLine() . ")</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}

// Enviar todo al navegador
ob_end_flush();