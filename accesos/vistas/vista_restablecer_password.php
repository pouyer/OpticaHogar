<?php
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    // Obtener mensajes de sesión
    $restablecer_error = $_SESSION['restablecer_error'] ?? null;
    $restablecer_exito = $_SESSION['restablecer_exito'] ?? null;

    // Limpiar mensajes de sesión una vez utilizados
    unset($_SESSION['restablecer_error']);
    unset($_SESSION['restablecer_exito']);
    ?>
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Restablecer Contraseña</title>
        <?php include('../headIconos.php'); ?>
        <link rel='stylesheet' href='../css/estilos.css'>
    </head>
    <body>
        <div class='container'>
            <div class='restablecer-container'>
                <h2 class='text-center mb-4'>Restablecer Contraseña</h2>
                
                <?php if ($restablecer_error): ?>
                    <div class='alert alert-danger'><?php echo $restablecer_error; ?></div>
                <?php endif; ?>
                
                <?php if ($restablecer_exito): ?>
                    <div class='alert alert-success'><?php echo $restablecer_exito; ?></div>
                    <?php if (isset($_SESSION['debug_nueva_clave'])): ?>
                        <div class='alert alert-info'>
                            <p><strong>Información de desarrollo:</strong> Se generó la siguiente contraseña:</p>
                            <p>Usuario: <?php echo $_SESSION['debug_nueva_clave']['username']; ?></p>
                            <p>Nueva clave: <?php echo $_SESSION['debug_nueva_clave']['nueva_clave']; ?></p>
                        </div>
                        <?php unset($_SESSION['debug_nueva_clave']); ?>
                    <?php endif; ?>
                <?php endif; ?>
                
                <p class='text-center'>Ingrese su nombre de usuario o correo electrónico para restablecer su contraseña.</p>
                
                <form action='../controladores/controlador_login.php?action=restablecer' method='POST'>
                    <div class='form-group'>
                        <label for='usuario_o_correo'>Usuario o Correo Electrónico:</label>
                        <input type='text' class='form-control' id='usuario_o_correo' name='usuario_o_correo' required>
                    </div>
                    <button type='submit' class='btn btn-primary btn-block'>Restablecer Contraseña</button>
                </form>
                
                <div class='text-center mt-3'>
                    <a href='vista_login.php'>Volver al inicio de sesión</a>
                </div>
            </div>
        </div>
            <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>    </body>
    </html> 
    