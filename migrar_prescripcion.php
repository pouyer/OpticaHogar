<?php
require_once 'conexion.php';

try {
    // 1. Renombrar campos esféricos
    $sql1 = "ALTER TABLE citas_control CHANGE lentes_esferico_od esferico_Cyl_eje_od VARCHAR(100) NULL";
    $sql2 = "ALTER TABLE citas_control CHANGE lentes_esferico_oi esferico_Cyl_eje_oi VARCHAR(100) NULL";
    
    // 2. Eliminar campos de cilindro y eje
    $sql3 = "ALTER TABLE citas_control DROP COLUMN lentes_cilindrico_od, DROP COLUMN lentes_eje_od";
    $sql4 = "ALTER TABLE citas_control DROP COLUMN lentes_cilindrico_oi, DROP COLUMN lentes_eje_oi";

    if ($conexion->query($sql1) === TRUE) echo "Campo esferico_Cyl_eje_od renombrado correctamente.\n";
    if ($conexion->query($sql2) === TRUE) echo "Campo esferico_Cyl_eje_oi renombrado correctamente.\n";
    if ($conexion->query($sql3) === TRUE) echo "Campos cilindrico/eje OD eliminados correctamente.\n";
    if ($conexion->query($sql4) === TRUE) echo "Campos cilindrico/eje OI eliminados correctamente.\n";

} catch (Exception $e) {
    echo "Error en la migración: " . $e->getMessage();
}
?>
