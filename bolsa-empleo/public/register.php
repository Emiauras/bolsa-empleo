<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/../app/Core/Autoloader.php';

use App\Controllers\AuthController;

$controller = new AuthController();
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->registrarHandler($_POST);
    if ($result['success']) {
        $message = ['type' => 'success', 'text' => 'Registro OK. Podés iniciar sesión.'];
    } else {
        $message = ['type' => 'danger', 'text' => $result['error']];
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Registro</title></head>
<body>
    <h1>Registro</h1>
    <?php if ($message): ?>
        <div style="color: <?= $message['type']==='success' ? 'green' : 'red' ?>">
            <?= htmlspecialchars($message['text']) ?>
        </div>
    <?php endif; ?>
    <form method="post" action="register.php">
        <label>Usuario (username): <input name="username" required></label><br>
        <label>Email: <input name="email" type="email" required></label><br>
        <label>Contraseña: <input name="password" type="password" required></label><br>
        <button type="submit">Registrar</button>
    </form>
    <p><a href="login.php">Iniciar sesión</a></p>
</body>
</html>
