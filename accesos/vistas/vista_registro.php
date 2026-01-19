<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
    header('Location: ../../index.php');
    exit();
}

// Obtener mensajes de sesión
$registro_error = $_SESSION['registro_error'] ?? null;

// Limpiar mensajes de sesión una vez utilizados
unset($_SESSION['registro_error']);
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Registro de Usuario</title>
    <?php include('../headIconos.php'); ?>
    <link rel='stylesheet' href='../css/estilos.css'>
</head>
<body>
    <div class='container'>
        <div class='registro-container'>
            <h2 class='text-center mb-4'>Registro de Usuario</h2>
            
            <?php if ($registro_error): ?>
                <div class='alert alert-danger'><?php echo $registro_error; ?></div>
            <?php endif; ?>
            
            <form action='../controladores/controlador_login.php?action=registro' method='POST' id='formRegistro'>
                <div class='form-group'>
                    <label for='username'>Nombre de Usuario:</label>
                    <input type='text' class='form-control' id='username' name='username' required>
                </div>
                <div class='form-group'>
                    <label for='fullname'>Nombre Completo:</label>
                    <input type='text' class='form-control' id='fullname' name='fullname' required>
                </div>
                <div class='form-group'>
                    <label for='correo'>Correo Electrónico:</label>
                    <input type='email' class='form-control' id='correo' name='correo' required>
                </div>
                <div class='form-group'>
                    <label for='password'>Contraseña:</label>
                    <input type='password' class='form-control' id='password' name='password' required>
                </div>
                <div class='form-group'>
                    <label for='confirmar_password'>Confirmar Contraseña:</label>
                    <input type='password' class='form-control' id='confirmar_password' name='confirmar_password' required>
                </div>
                <button type='submit' class='btn btn-primary btn-block'>Registrarse</button>
            </form>
            
            <div class='text-center mt-3'>
                <a href='vista_login.php'>¿Ya tienes una cuenta? Inicia sesión aquí</a>
            </div>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#formRegistro').on('submit', function(e) {
                var password1 = $('#password').val();
                var password2 = $('#confirmar_password').val();
                
                if (password1 !== password2) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden');
                    return false;
                }
                
                // Validar correo electrónico
                var correo = $('#correo').val();
                var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!correoRegex.test(correo)) {
                    e.preventDefault();
                    alert('Por favor, introduce un correo electrónico válido');
                    return false;
                }
                
                // Validar longitud de la contraseña
                if (password1.length < 6) {
                    e.preventDefault();
                    alert('La contraseña debe tener al menos 6 caracteres');
                    return false;
                }
            });
        });
    </script>
</body>
</html> 

