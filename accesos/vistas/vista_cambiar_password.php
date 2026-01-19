<?php
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
        header('Location: vista_login.php');
        exit();
    }

    // Obtener información del usuario
    $usuario_id = $_SESSION['usuario_id'] ?? 0;
    $usuario_nombre = $_SESSION['usuario_nombre'] ?? '';
    $usuario_username = $_SESSION['usuario_username'] ?? '';
    $cambio_obligatorio = $_SESSION['cambio_clave_obligatorio'] ?? false;

    // Obtener mensajes de sesión
    $password_error = $_SESSION['password_error'] ?? null;
    $password_exito = $_SESSION['password_exito'] ?? null;

    // Limpiar mensajes de sesión una vez utilizados
    unset($_SESSION['password_error']);
    unset($_SESSION['password_exito']);
    ?>
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Cambiar Contraseña</title>
        <?php include('../headIconos.php'); ?>
        <link rel='stylesheet' href='../css/estilos.css'>
        <style>
            .cambiar-container {
                max-width: 500px;
                margin: 50px auto;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                background-color: #fff;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .alert {
                margin-top: 15px;
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='cambiar-container'>
                <h2 class='text-center mb-4'>Cambiar Contraseña</h2>
                
                <?php if ($cambio_obligatorio): ?>
                    <div class='alert alert-warning'>
                        <strong>Atención:</strong> Es necesario que cambies tu contraseña para continuar.
                    </div>
                <?php endif; ?>
                
                <?php if ($password_error): ?>
                    <div class='alert alert-danger'><?php echo $password_error; ?></div>
                <?php endif; ?>
                
                <?php if ($password_exito): ?>
                    <div class='alert alert-success'><?php echo $password_exito; ?></div>
                <?php endif; ?>
                
                <?php if (!$password_exito): ?>
                <p>Usuario: <strong><?php echo htmlspecialchars($usuario_username); ?></strong></p>
                
                <form action='../controladores/controlador_login.php?action=cambiar_password' method='POST' id='formCambiar'>
                    <input type='hidden' name='source' value='<?php echo htmlspecialchars($_GET['source'] ?? ''); ?>'>
                    <div class='form-group'>
                        <label for='password_actual'>Contraseña Actual:</label>
                        <input type='password' class='form-control' id='password_actual' name='password_actual' required>
                    </div>
                    <div class='form-group'>
                        <label for='nueva_password'>Nueva Contraseña:</label>
                        <input type='password' class='form-control' id='nueva_password' name='nueva_password' required>
                    </div>
                    <div class='form-group'>
                        <label for='confirmar_password'>Confirmar Nueva Contraseña:</label>
                        <input type='password' class='form-control' id='confirmar_password' name='confirmar_password' required>
                    </div>
                    <button type='submit' class='btn btn-primary btn-block'>Cambiar Contraseña</button>
                </form>
                <?php endif; ?>
                
                <?php 
                // No mostrar volver al inicio si es cambio obligatorio o si viene del menú
                $es_menu = isset($_GET['source']) && $_GET['source'] === 'menu';
                if ($cambio_obligatorio != 1 && !$es_menu): ?>
                    <div class='text-center mt-3'>
                        <a href='../../index.php' class='btn btn-link'>Volver al inicio</a>
                    </div>
                <?php endif; ?>
                
                <?php if ($password_exito && ($cambio_obligatorio == 1 || $cambio_obligatorio === '1')): ?>
                    <div class='text-center mt-3'>
                        <a href='../../index.php' class='btn btn-success'>Continuar al Sistema</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
            <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
        <script>
            $(document).ready(function() {
                $('#formCambiar').on('submit', function(e) {
                    var password1 = $('#nueva_password').val();
                    var password2 = $('#confirmar_password').val();
                    
                    if (password1 !== password2) {
                        e.preventDefault();
                        alert('Las contraseñas nuevas no coinciden');
                    }
                });
            });
        </script>
    </body>
    </html> 
    