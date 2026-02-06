<?php
require 'conexion.php';
$res = $conexion->query('DESCRIBE profesionales_salud');
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . "\n";
}
?>
