<?php
/**
 * Configuración global para evitar warnings en respuestas AJAX
 * Incluir este archivo al inicio de todos los controladores AJAX
 */

// Desactivar display de errores para evitar que rompan las respuestas JSON
ini_set('display_errors', '0');

// Pero mantener el logging de errores
ini_set('log_errors', '1');

// Configurar nivel de reporte (solo errores fatales, no warnings)
error_reporting(E_ERROR | E_PARSE);

// Limpiar cualquier output buffer previo
if (ob_get_level()) {
    ob_end_clean();
}

// Iniciar nuevo buffer
ob_start();
?>
