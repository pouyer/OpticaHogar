<?php
// Simular una petición al controlador
$_GET['action'] = 'getDepartamentos';
$_GET['id_pais'] = 44;

ob_start();
include 'controladores/controlador_pacientes.php';
$output = ob_get_clean();

echo "Respuesta para getDepartamentos (ID 44):\n";
echo $output;
echo "\n--- FIN ---\n";
?>
