<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: accesos/vistas/vista_login.php');
    exit();
}

// Redirigir a la vista del menú dinámico si está autenticado
header('Location: accesos/vistas/vista_menu_principal.php');
exit();