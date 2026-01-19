<?php
require_once 'conexion.php';
$res = $conexion->query("DESCRIBE pacientes");
$fields = [];
while($row = $res->fetch_assoc()) {
    $fields[] = $row;
}
echo json_encode($fields, JSON_PRETTY_PRINT);
?>
