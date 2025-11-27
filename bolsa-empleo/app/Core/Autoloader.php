<?php
// app/Core/Autoloader.php

spl_autoload_register(function ($class) {
    
    // Define el prefijo del namespace de la aplicación y la carpeta base
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../'; 

    // Comprueba si la clase usa el prefijo 'App\'
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Obtiene el nombre relativo de la clase (ej: Controllers\AuthController)
    $relative_class = substr($class, $len); 

    // Convierte el namespace a ruta de archivo
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

    // Carga el archivo si existe
    if (file_exists($file)) {
        require $file;
    } 
});
// ¡IMPORTANTE! No hay etiqueta de cierre para evitar problemas de headers.