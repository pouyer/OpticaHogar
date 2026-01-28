<?php
require_once 'conexion.php';

$sql = "SELECT id, nombre FROM estados_cita where mostrar_en_hc = 1 ORDER BY id";
$result = $conexion->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Nombre: " . $row['nombre'] . "\n";
    }
} else {
    echo "Error: " . $conexion->error;
}
?>
