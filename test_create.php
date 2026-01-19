<?php
chdir(__DIR__ . '/controladores');
$_SESSION['usuario_id'] = 1;
$_SESSION['permisos']['vista_pacientes.php'] = ['ins' => 1, 'upd' => 1, 'del' => 1, 'exp' => 1];
$_GET['action'] = 'crear';
$_POST = [
    'tipo_identificacion_id' => 1,
    'identificacion' => 'TEST' . time(),
    'fecha_ingreso' => date('Y-m-d'),
    'primer_nombre' => 'Test',
    'primer_apellido' => 'User',
    'fecha_nacimiento' => '1990-01-01',
    'genero_id' => 1
];

ob_start();
require_once 'controlador_pacientes.php';
$output = ob_get_clean();

echo "OUTPUT: " . $output . "\n";
?>
