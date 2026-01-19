<?php
require_once '../verificar_sesion.php';
require_once '../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #6c757d;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-card {
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }
        .welcome-card i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        .app-name {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <img src="../../<?= getenv('APP_LOGO') ?: 'iconos-web/img/logo.png' ?>" alt="Logo" class="img-fluid mb-4" style="max-height: 150px; opacity: 0.3;">
        <h1>Bienvenido a <span class="app-name"><?php echo APP_NAME; ?></span></h1>
        <p class="lead">Por favor, seleccione una opción del menú lateral para comenzar a trabajar.</p>
    </div>
</body>
</html>
