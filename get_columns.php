<?php
$c = new mysqli('localhost', 'root', 'root', 'opticaApp', 3308);
if ($c->connect_error) {
    die("Connection failed: " . $c->connect_error);
}
$res = $c->query('DESCRIBE profesionales_salud');
if (!$res) {
    die("Query failed: " . $c->error);
}
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . PHP_EOL;
}
?>
