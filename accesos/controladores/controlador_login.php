<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once '../modelos/modelo_acc_usuario.php';
require_once '../modelos/modelo_acc_log.php';
require_once '../../include/SimpleSMTP.php'; // Incluir la clase SMTP

class ControladorLogin {
    private $modelo;
    private $modeloLog;

    public function __construct() {
        $this->modelo = new ModeloAcc_usuario();
        $this->modeloLog = new ModeloAcc_log();
    }

    /**
     * Envía un correo electrónico utilizando SimpleSMTP
     */
    private function enviarCorreo($destinatario, $asunto, $cuerpo) {
        $host = getenv('SMTP_HOST');
        $user = getenv('SMTP_USER');
        $pass = getenv('SMTP_PASS');
        $port = getenv('SMTP_PORT') ?: 587;
        $from = getenv('SMTP_FROM') ?: $user;

        // Si no hay configuración SMTP, intentamos mail() nativo o fallamos controladamente
        if (empty($host)) {
            // Intento básico con mail()
            $headers = "From: Sistema <no-reply@sistema.com>\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            return mail($destinatario, $asunto, $cuerpo, $headers);
        }

        $smtp = new SimpleSMTP($host, $user, $pass, $port);
        return $smtp->send($destinatario, $asunto, $cuerpo, 'Sistema de Usuarios');
    }

    public function iniciarSesion($username, $password) {
        $usuario = $this->modelo->verificarCredenciales($username, $password);
        
        if ($usuario) {
            // Iniciar sesión
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nombre'] = $usuario['fullname'];
            $_SESSION['usuario_username'] = $usuario['username'];
            $_SESSION['autenticado'] = true;
            
            // Obtener perfil del usuario (roles)
            $roles = $this->modelo->obtenerRolesPorUsuario($usuario['id_usuario']);
            $_SESSION['usuario_perfil'] = !empty($roles) ? $roles[0]['nombre_rol'] : 'Sin perfil';
            $_SESSION['cambio_clave_obligatorio'] = $usuario['cambio_clave_obligatorio'] ?? 0;
            // Cargar permisos granulares
            $permisos = [];
            foreach ($roles as $rol) {
                // Consultar permisos por rol
                $sqlPerm = "SELECT p.nombre_archivo, pr.permiso_insertar, pr.permiso_actualizar, pr.permiso_eliminar, pr.permiso_exportar 
                            FROM acc_programa_x_rol pr 
                            JOIN acc_programa p ON pr.id_programas = p.id_programas 
                            WHERE pr.id_rol = ?";
                $stmtPerm = $this->modelo->getConexion()->prepare($sqlPerm);
                $stmtPerm->bind_param('i', $rol['id_rol']);
                $stmtPerm->execute();
                $resPerm = $stmtPerm->get_result();
                while ($p = $resPerm->fetch_assoc()) {
                    $nombre = $p['nombre_archivo'];
                    if (!isset($permisos[$nombre])) {
                        $permisos[$nombre] = ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];
                    }
                    // El permiso más alto gana (OR lógico)
                    $permisos[$nombre]['ins'] = $permisos[$nombre]['ins'] | $p['permiso_insertar'];
                    $permisos[$nombre]['upd'] = $permisos[$nombre]['upd'] | $p['permiso_actualizar'];
                    $permisos[$nombre]['del'] = $permisos[$nombre]['del'] | $p['permiso_eliminar'];
                    $permisos[$nombre]['exp'] = $permisos[$nombre]['exp'] | $p['permiso_exportar'];
                }
            }
            $_SESSION['permisos'] = $permisos;
            
            // Registrar log de acceso
            $this->modeloLog->registrar($usuario['id_usuario'], 'LOGIN', 'acc_usuario', 'Inicio de sesión exitoso');
            
            if ($_SESSION['cambio_clave_obligatorio'] == 1 || $_SESSION['cambio_clave_obligatorio'] === '1') {
                return 'cambio_clave';
            }
            return true;
        }
        
        return false;
    }
    
    public function cerrarSesion() {
        // Eliminar todas las variables de sesión
        $_SESSION = array();
        
        // Destruir la sesión
        session_destroy();
        
        return true;
    }
    
    public function restablecerPassword($usuario_o_correo) {
        $resultado = $this->modelo->restablecerPassword($usuario_o_correo);
        
        if ($resultado) {
            // Enviar correo con la nueva contraseña
            $asunto = 'Restablecimiento de Contraseña';
            $cuerpo = "
            <html>
            <body>
                <h2>Hola, {$resultado['username']}</h2>
                <p>Se ha solicitado un restablecimiento de contraseña para tu cuenta.</p>
                <p>Tu nueva contraseña temporal es: <strong>{$resultado['nueva_clave']}</strong></p>
                <p>Por favor, inicia sesión y cámbiala lo antes posible.</p>
            </body>
            </html>
            ";
            
            $envio = $this->enviarCorreo($resultado['correo'], $asunto, $cuerpo);
            
            if ($envio) {
                return ['exito' => true, 'mensaje' => 'Se ha enviado una nueva contraseña a su correo.'];
            } else {
                // Fallback si falla el correo
                return ['exito' => true, 'mensaje' => 'Contraseña restablecida, pero no se pudo enviar el correo. Contacte al admin.'];
            }
        }
        
        return false;
    }
    
    public function cambiarPassword($id_usuario, $password_actual, $nueva_password, $confirmar_password) {
        // Obtener usuario para verificar la contraseña actual
        $usuario = $this->modelo->obtenerPorId($id_usuario);
        
        if (!$usuario || !password_verify($password_actual, $usuario['password'])) {
            return ['exito' => false, 'mensaje' => 'La contraseña actual es incorrecta'];
        }
        
        if ($nueva_password !== $confirmar_password) {
            return ['exito' => false, 'mensaje' => 'Las contraseñas nuevas no coinciden'];
        }
        
        // Cambiar la contraseña
        $resultado = $this->modelo->cambiarPassword($id_usuario, $nueva_password);
        
        if ($resultado) {
            // Opcional: Enviar correo de confirmación
            return ['exito' => true, 'mensaje' => 'Contraseña actualizada correctamente'];
        } else {
            return ['exito' => false, 'mensaje' => 'Error al actualizar la contraseña'];
        }
    }
    
    public function registrarUsuario($datos) {
        // Verificar si el usuario ya existe
        $usuario_existente = $this->modelo->obtenerPorUsername($datos['username']);
        if ($usuario_existente) {
            return ['exito' => false, 'mensaje' => 'El nombre de usuario ya está en uso'];
        }
        
        // Verificar si el correo ya existe
        if (!empty($datos['correo'])) {
            $correo_existente = $this->modelo->obtenerPorCorreo($datos['correo']);
            if ($correo_existente) {
                return ['exito' => false, 'mensaje' => 'El correo electrónico ya está registrado'];
            }
        }
        
        // Registrar el nuevo usuario
        try {
            $resultado = $this->modelo->crear($datos);
            if ($resultado) {
                // Enviar correo de bienvenida
                if (!empty($datos['correo'])) {
                    $asunto = 'Bienvenido al Sistema';
                    $cuerpo = "
                    <html>
                    <body>
                        <h2>¡Bienvenido, {$datos['fullname']}!</h2>
                        <p>Tu cuenta ha sido creada exitosamente.</p>
                        <p>Usuario: <strong>{$datos['username']}</strong></p>
                        <p>Contraseña: (La que definiste al registrarte)</p>
                    </body>
                    </html>
                    ";
                    $this->enviarCorreo($datos['correo'], $asunto, $cuerpo);
                }

                return ['exito' => true, 'mensaje' => 'Usuario registrado correctamente'];
            } else {
                return ['exito' => false, 'mensaje' => 'Error al registrar el usuario'];
            }
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
}

// Manejar las solicitudes
if (isset($_GET['action'])) {
    $controlador = new ControladorLogin();
    $action = $_GET['action'];
    
    switch ($action) {
        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                
                $resultado = $controlador->iniciarSesion($username, $password);
                
                if ($resultado === true) {
                    // Redireccionar al índice
                    header('Location: ../../index.php');
                    exit();
                } elseif ($resultado === 'cambio_clave') {
                    // Redireccionar a la página de cambio de clave
                    header('Location: ../vistas/vista_cambiar_password.php');
                    exit();
                } else {
                    // Redireccionar al login con mensaje de error
                    $_SESSION['login_error'] = 'Credenciales inválidas';
                    header('Location: ../vistas/vista_login.php');
                    exit();
                }
            }
            break;
            
        case 'logout':
            $controlador->cerrarSesion();
            header('Location: ../vistas/vista_login.php');
            exit();
            break;
            
        case 'restablecer':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario_o_correo = $_POST['usuario_o_correo'] ?? '';
                
                $resultado = $controlador->restablecerPassword($usuario_o_correo);
                
                if (is_array($resultado) && $resultado['exito']) {
                    $_SESSION['restablecer_exito'] = $resultado['mensaje'];
                } else {
                    $_SESSION['restablecer_error'] = 'No se encontró el usuario o correo electrónico';
                }
                
                header('Location: ../vistas/vista_restablecer_password.php');
                exit();
            }
            break;
            
        case 'cambiar_password':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_usuario = $_SESSION['usuario_id'] ?? 0;
                $password_actual = $_POST['password_actual'] ?? '';
                $nueva_password = $_POST['nueva_password'] ?? '';
                $confirmar_password = $_POST['confirmar_password'] ?? '';
                
                $resultado = $controlador->cambiarPassword(
                    $id_usuario, 
                    $password_actual, 
                    $nueva_password, 
                    $confirmar_password
                );
                
                if ($resultado['exito']) {
                    $_SESSION['cambio_clave_obligatorio'] = 0;
                    $_SESSION['password_exito'] = $resultado['mensaje'];
                    $source = $_POST['source'] ?? '';
                    $url = '../vistas/vista_cambiar_password.php?success=1' . ($source ? '&source=' . urlencode($source) : '');
                    header("Location: $url");
                } else {
                    $_SESSION['password_error'] = $resultado['mensaje'];
                    header('Location: ../vistas/vista_cambiar_password.php');
                }
                exit();
            }
            break;
            
        case 'registro':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $datos = [
                    'username' => $_POST['username'] ?? '',
                    'fullname' => $_POST['fullname'] ?? '',
                    'correo' => $_POST['correo'] ?? '',
                    'password' => $_POST['password'] ?? '',
                    'estado' => 'activo', // Por defecto activo
                    'cambio_clave_obligatorio' => 0 // No obligatorio para nuevos registros
                ];
                
                $resultado = $controlador->registrarUsuario($datos);
                
                if ($resultado['exito']) {
                    $_SESSION['registro_exito'] = $resultado['mensaje'];
                    header('Location: ../vistas/vista_login.php');
                } else {
                    $_SESSION['registro_error'] = $resultado['mensaje'];
                    header('Location: ../vistas/vista_registro.php');
                }
                exit();
            }
            break;
    }
}
?> 
    