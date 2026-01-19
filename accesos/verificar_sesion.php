<?php
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    // Determinar la ruta relativa al login de forma dinámica
    $script_path = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
    $accesos_pos = strpos($script_path, '/accesos/');
    
    if ($accesos_pos !== false) {
        // Si estamos dentro de subcarpetas de accesos
        $depth = substr_count(substr($script_path, $accesos_pos + 9), '/');
        $prefix = str_repeat('../', $depth + 1);
    } else {
        // Raíz o subcarpetas fuera de accesos
        $prefix = './';
        if (strpos($script_path, '/vistas/') !== false) $prefix = '../';
    }

    $ruta_login = $prefix . 'accesos/vistas/vista_login.php';
    $ruta_cambiar_password = $prefix . 'accesos/vistas/vista_cambiar_password.php';

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: $ruta_login");
        exit;
    }

    // Verificar cambio de clave obligatorio
    if (isset($_SESSION['cambio_clave_obligatorio']) && ($_SESSION['cambio_clave_obligatorio'] == 1 || $_SESSION['cambio_clave_obligatorio'] === '1')) {
        if (basename($_SERVER['PHP_SELF']) !== 'vista_cambiar_password.php') {
            header("Location: $ruta_cambiar_password");
            exit;
        }
    }

    $usuario_id = $_SESSION['usuario_id'] ?? 0;
    $usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
    $usuario_perfil = $_SESSION['usuario_perfil'] ?? '';

    // Cargar variables de entorno (marca, logo, etc)
    if (file_exists($prefix . '.env')) {
        $env = parse_ini_file($prefix . '.env');
        if ($env) {
            foreach ($env as $key => $value) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }
    }
    ?>