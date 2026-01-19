<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Cargar environment si existe
if (file_exists(__DIR__ . '/../../.env')) {
    $env = parse_ini_file(__DIR__ . '/../../.env');
    if ($env) {
        foreach ($env as $key => $value) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    // Si está autenticado pero tiene cambio obligatorio de clave, redirigir a cambiar contraseña
    if (isset($_SESSION['cambio_clave_obligatorio']) && $_SESSION['cambio_clave_obligatorio'] === true) {
        header('Location: vista_cambiar_password.php');
        exit();
    }
    // Si está autenticado y no tiene cambio obligatorio, redirigir al índice
    header('Location: ../../index.php');
    exit();
}

// Obtener mensajes de sesión
$login_error = $_SESSION['login_error'] ?? null;
$registro_exito = $_SESSION['registro_exito'] ?? null;
$restablecer_exito = $_SESSION['restablecer_exito'] ?? null;

// Limpiar mensajes de sesión una vez utilizados
unset($_SESSION['login_error']);
unset($_SESSION['registro_exito']);
unset($_SESSION['restablecer_exito']);
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Iniciar Sesión</title>
    <?php include('../headIconos.php'); ?>
    <link rel='stylesheet' href='../css/estilos.css'>
    <?php
    $loginBg = getenv('LOGIN_BG');
    if ($loginBg) {
        echo "<style>
            body {
                background: url('../../$loginBg') no-repeat center center fixed;
                background-size: cover;
            }
            .login-container {
                background: rgba(255, 255, 255, 0.95);
                box-shadow: 0 0 20px rgba(0,0,0,0.2);
            }
        </style>";
    }
    ?>
</head>
<body>
    <div class='container'>
        <div class='login-container'>
            <h2 class='text-center mb-4'>Iniciar Sesión</h2>
            
            <?php if ($login_error): ?>
                <div class='alert alert-danger'><?php echo $login_error; ?></div>
            <?php endif; ?>
            
            <?php if ($registro_exito): ?>
                <div class='alert alert-success'><?php echo $registro_exito; ?></div>
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
            
            <form action='../controladores/controlador_login.php?action=login' method='POST'>
                <div class='form-group'>
                    <label for='username'>Usuario:</label>
                    <input type='text' class='form-control' id='username' name='username' required>
                </div>
                <div class='form-group'>
                    <label for='password'>Contraseña:</label>
                    <input type='password' class='form-control' id='password' name='password' required>
                </div>
                <button type='submit' class='btn btn-primary btn-block'>Iniciar Sesión</button>
            </form>
            
            <div class='text-center mt-3'>
                <a href='vista_restablecer_password.php'>¿Olvidaste tu contraseña?</a>
            </div>
            
            <div class='text-center mt-3'>
                <p>¿No tienes una cuenta? <a href='vista_registro.php'>Regístrate aquí</a></p>
            </div>
        </div>
    </div>
        <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
</body>
</html> 
    