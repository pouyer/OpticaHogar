<?php
$conn = new mysqli('localhost', 'root', 'root', 'opticaApp', 3308);
if ($conn->connect_error) {
    // Intentar sin puerto o con puerto estándar si falla el 3308
    $conn = new mysqli('localhost', 'root', 'root', 'opticaApp');
}
if ($conn->connect_error) die("Error: " . $conn->connect_error);

ob_start();
echo "--- ESTRUCTURA PAISES ---\n";
$res = $conn->query("DESCRIBE paises");
while($row = $res->fetch_assoc()) print_r($row);

echo "\n--- ESTRUCTURA DEPARTAMENTO ---\n";
$res = $conn->query("DESCRIBE departamento");
while($row = $res->fetch_assoc()) print_r($row);

echo "\n--- PAISES (Colombia) ---\n";
$res = $conn->query("SELECT * FROM paises WHERE nombre_pais LIKE 'Colombia%'");
while($row = $res->fetch_assoc()) print_r($row);

echo "\n--- DEPARTAMENTOS (Estado para ID 44) ---\n";
$res = $conn->query("SELECT id, id_pais, Nombre, estado FROM departamento WHERE id_pais = 44 LIMIT 10");
while($row = $res->fetch_assoc()) print_r($row);

$out = ob_get_clean();
file_put_contents('debug_output.txt', $out);
echo $out;

$conn->close();
?>
