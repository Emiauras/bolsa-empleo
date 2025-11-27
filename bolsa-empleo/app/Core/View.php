<?php
// app/Core/View.php

namespace App\Core; 

/**
 * Clase estática responsable de renderizar las vistas PHP (Presentación).
 */
class View // LINEA 10 (Aproximadamente)
{
    private const VIEW_PATH = __DIR__ . '/../Views/';

    public static function render(string $viewName, array $data = []): void // LINEA 16 (Aproximadamente)
    {
        // ... Contenido del método render() ...
        
        // 1. Convertir datos a variables locales (ej: $user, $error)
        extract($data); 
        
        // 2. Capturar el contenido de la vista específica (ej: auth/login.php)
        $viewFile = self::VIEW_PATH . $viewName . '.php';
        
        if (!file_exists($viewFile)) {
            die("Error: La vista no existe: " . htmlspecialchars($viewName)); 
        }
        
        ob_start();
        require $viewFile;
        $content = ob_get_clean(); 

        // 3. Determinar y Renderizar el Layout (ej: layouts/auth.php o layouts/main.php)
        $layoutName = (strpos($viewName, 'auth/') === 0) ? 'auth' : 'main';
        $layoutFile = self::VIEW_PATH . 'layouts/' . $layoutName . '.php';
        
        if (!file_exists($layoutFile)) { // LINEA 45 (Aproximadamente, donde puede faltar un '}')
             die("Error: El layout no existe: " . htmlspecialchars($layoutName));
        }

        // Renderiza el layout.
        require $layoutFile; 
        
    } // <-- DEBE ESTAR CERRADA LA FUNCIÓN render() aquí (Aprox. línea 55)

} // <-- DEBE ESTAR CERRADA LA CLASE View aquí (Aprox. línea 57)