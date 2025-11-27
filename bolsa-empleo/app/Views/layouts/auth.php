<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Empleo - Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/bolsa-empleo/public/assets/css/app.css"> 
</head>
<body class="auth-page"> 
    <div class="container auth-container">
        <?php if ($success = App\Core\SessionHelper::getFlash('success')): ?>
            <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error = App\Core\SessionHelper::getFlash('error')): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php echo $content; ?>
    </div>
</body>
</html>