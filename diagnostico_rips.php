<?php
require_once 'conexion.php';

header('Content-Type: text/plain');

echo "--- Diagnóstico de Tipos de Consulta ---\n";
$sql = "SELECT id, codigo, descripcion FROM tipos_consulta";
$res = $conexion->query($sql);
if ($res) {
    while ($row = $res->fetch_assoc()) {
        echo "ID: " . $row['id'] . " | Codigo: " . $row['codigo'] . " | Descripcion: " . $row['descripcion'] . "\n";
    }
} else {
    echo "Error consultando tipos_consulta: " . $conexion->error . "\n";
}

echo "\n--- Muestra de vw_rips_consultas (Limit 5) ---\n";
$sql2 = "SELECT cita_id, cod_consulta, finalidad_consulta FROM vw_rips_consultas LIMIT 5";
$res2 = $conexion->query($sql2);
if ($res2) {
    while ($row = $res2->fetch_assoc()) {
        echo "Cita ID: " . $row['cita_id'] . " | CodConsulta: " . $row['cod_consulta'] . "\n";
    }
} else {
    echo "Error consultando vista: " . $conexion->error . "\n";
}
?>
