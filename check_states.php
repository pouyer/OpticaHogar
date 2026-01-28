<?php
require_once 'conexion.php';
$ids = [3, 6];
foreach($ids as $id) {
    $sql = "SELECT id, nombre, restringe_nueva_cita, estado FROM estados_cita WHERE id = $id";
    $res = $conexion->query($sql);
    if($row = $res->fetch_assoc()) {
        printf("ID:%d|Nombre:%s|Restringe:%d|Estado:%s\n", $row['id'], $row['nombre'], $row['restringe_nueva_cita'], $row['estado']);
    } else {
        echo "ID:$id no encontrado\n";
    }
}
?>
