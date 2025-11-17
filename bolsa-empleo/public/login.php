<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/../app/Core/Autoloader.php';

use App\Controllers\AuthController;

$controller = new AuthController();
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $controller->loginHandler($_POST);
    if ($result['success']) {
        header('Location: protected.php');
        exit;
    } else {
        $message = ['type' => 'danger', 'text' => $result['error']];
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
    <h1>Login</h1>
    <?php if ($message): ?>
        <div style="color: red"><?= htmlspecialchars($message['text']) ?></div>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label>Email o Usuario: <input name="email_or_username" required></label><br>
        <label>Contraseña: <input name="password" type="password" required></label><br>
        <button type="submit">Ingresar</button>
    </form>
    <p><a href="register.php">Registrarse</a></p>
</body>
</html>
