<?php
$f = 'c:/xampp/htdocs/OpticaHogar/vistas/vista_tipos_consulta.php';
$c = file_get_contents($f);
$c = str_replace("modal.querySelector('#color')", "modal.querySelector('#codigo_cups')", $c);
file_put_contents($f, $c);
echo "JavaScript corregido.\n";
?>
