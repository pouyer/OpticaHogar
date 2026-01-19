<?php
require_once 'c:/xampp/htdocs/OpticaHogar/conexion.php';

$data = [];

$query = "SELECT id, codigo, nombre FROM tipos_consulta";
$result = $conexion->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data['tipos_consulta'][] = $row;
    }
}

$query = "SELECT id, codigo, nombre FROM estados_cita";
$result = $conexion->query($query);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data['estados_cita'][] = $row;
    }
}

file_put_contents('c:/xampp/htdocs/OpticaHogar/ids_output.txt', json_encode($data, JSON_PRETTY_PRINT));
echo "DONE";
?>
