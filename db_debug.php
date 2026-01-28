<?php
require_once 'conexion.php';
$sql = "SELECT id, nombre, restringe_nueva_cita, estado FROM estados_cita";
$res = $conexion->query($sql);
while($row = $res->fetch_assoc()) {
    printf("ID:%d|Nombre:%s|Restringe:%d|Estado:%s\n", $row['id'], $row['nombre'], $row['restringe_nueva_cita'], $row['estado']);
}
$sql_citas = "SELECT id, paciente_id, estado_cita_id FROM citas_control WHERE paciente_id IN (SELECT id FROM pacientes WHERE primer_nombre LIKE 'Claudia%')";
$res_citas = $conexion->query($sql_citas);
while($c = $res_citas->fetch_assoc()) {
    printf("CitaID:%d|PacID:%d|EstID:%d\n", $c['id'], $c['paciente_id'], $c['estado_cita_id']);
}
?>
