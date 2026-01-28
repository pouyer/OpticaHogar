<?php
require_once 'conexion.php';
$paciente_id = 12; // ID de Claudia

$sql = "SELECT c.id, e.nombre as estado_nombre, e.estado, e.restringe_nueva_cita
        FROM citas_control c
        JOIN estados_cita e ON c.estado_cita_id = e.id
        WHERE c.paciente_id = $paciente_id";

$res = $conexion->query($sql);
echo "Citas encontradas para paciente $paciente_id:\n";
while($row = $res->fetch_assoc()) {
    printf("CitaID:%d|EstNombre:%s|EstEstado:%s|Restrin:%d\n", 
           $row['id'], $row['estado_nombre'], $row['estado'], $row['restringe_nueva_cita']);
}

// Probar consulta completa tal cual está en el modelo
$sql_model = "SELECT c.id, e.nombre as estado_nombre 
        FROM citas_control c
        JOIN estados_cita e ON c.estado_cita_id = e.id
        WHERE c.paciente_id = ? 
        AND e.estado = 'activo' 
        AND e.restringe_nueva_cita = 1
        LIMIT 1";

$stmt = $conexion->prepare($sql_model);
$stmt->bind_param('i', $paciente_id);
$stmt->execute();
$res_model = $stmt->get_result()->fetch_assoc();

echo "\nResultado de la consulta del modelo:\n";
if($res_model) {
    print_r($res_model);
} else {
    echo "No se encontró cita restringida.\n";
}
?>
