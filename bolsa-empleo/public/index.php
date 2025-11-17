<?php
declare(strict_types=1);

session_start();

require __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\Database;

try {
    $pdo = Database::getConnection();
    echo "<h1>Bolsa de Empleo - Backend (Rol A)</h1>";
    echo "<p>Conexión a la base de datos OK ✅</p>";
} catch (Throwable $e) {
    echo "<h1>Error</h1>";
    echo "<p>No se pudo conectar: " . htmlspecialchars($e->getMessage()) . "</p>";
}
