<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html>
<body>
    <h1>Bienvenida, <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p>Estás logueada. ID: <?= (int)$_SESSION['user_id'] ?></p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
