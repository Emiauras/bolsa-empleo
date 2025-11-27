<?php
// app/Core/UrlHelper.php

namespace App\Core;

class UrlHelper
{
    /**
     * Genera una URL absoluta con la ruta FIJA del proyecto.
     */
    public static function base(string $path = '/'): string
    {
        // 1. Definir el protocolo (http)
        $protocol = "http://"; // En local suele ser http
        
        // 2. Definir el servidor (localhost)
        $host = "localhost";
        
        // 3. *** LA PARTE CRÍTICA: TU CARPETA EXACTA ***
        // Como tu proyecto está en htdocs/bolsa-empleo/public, ponemos esto:
        $subDir = '/bolsa-empleo/public'; 
        
        // 4. Limpiar la ruta que pides (ej: /login)
        $cleanPath = '/' . ltrim($path, '/');
        
        // Resultado: http://localhost/bolsa-empleo/public/login
        return $protocol . $host . $subDir . $cleanPath;
    }
}