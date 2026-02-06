<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "--- PRUEBA DE INCLUSIÓN ---\n";

$file_to_test = 'controladores/controlador_pacientes.php';
if (!file_exists($file_to_test)) {
    die("ERROR: No se encuentra el archivo $file_to_test\n");
}

try {
    // Definir variables que el controlador podría esperar
    $_GET['action'] = 'getDepartamentos';
    $_GET['id_pais'] = 44;
    
    // Simular sesión si es necesario
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['usuario_id'] = 1;
    $_SESSION['permisos']['vista_pacientes.php'] = ['ins' => 1, 'upd' => 1, 'del' => 1, 'exp' => 1];

    echo "Incluyendo controlador...\n";
    include $file_to_test;
    echo "\nInclusión completada con éxito.\n";
} catch (Throwable $e) {
    echo "\nERROR CAPTURADO:\n";
    echo $e->getMessage() . "\n";
    echo "En " . $e->getFile() . " línea " . $e->getLine() . "\n";
}
?>
