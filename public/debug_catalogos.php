<?php
/**
 * Script de depuración para verificar catálogos
 */
session_start();
require_once '../conexion.php';
require_once '../modelos/modelo_cita.php';

header('Content-Type: text/html; charset=utf-8');

echo "<h2>Depuración de Catálogos</h2>";

try {
    $modelo = new ModeloCita();
    
    echo "<h3>1. Tipos de Consulta</h3>";
    $tiposConsulta = $modelo->getTiposConsulta();
    echo "<pre>" . print_r($tiposConsulta, true) . "</pre>";
    echo "Total: " . count($tiposConsulta) . "<br><br>";
    
    echo "<h3>2. Tipos de Lentes</h3>";
    $tiposLente = $modelo->getTiposLentes();
    echo "<pre>" . print_r($tiposLente, true) . "</pre>";
    echo "Total: " . count($tiposLente) . "<br><br>";
    
    echo "<h3>3. Materiales de Lentes</h3>";
    $materiales = $modelo->getMaterialesLentes();
    echo "<pre>" . print_r($materiales, true) . "</pre>";
    echo "Total: " . count($materiales) . "<br><br>";
    
    echo "<h3>4. Usos de Lentes</h3>";
    $usos = $modelo->getUsosLentes();
    echo "<pre>" . print_r($usos, true) . "</pre>";
    echo "Total: " . count($usos) . "<br><br>";
    
    echo "<h3>5. Tipos de Origen Enfermedad</h3>";
    $tiposOrigen = $modelo->getTiposOrigenEnfermedad();
    echo "<pre>" . print_r($tiposOrigen, true) . "</pre>";
    echo "Total: " . count($tiposOrigen) . "<br><br>";
    
    echo "<h3>6. Estados de Cita</h3>";
    $estadosCita = $modelo->getEstadosCita();
    echo "<pre>" . print_r($estadosCita, true) . "</pre>";
    echo "Total: " . count($estadosCita) . "<br><br>";
    
    echo "<h3>7. Asistentes</h3>";
    $asistentes = $modelo->getAsistentes();
    echo "<pre>" . print_r($asistentes, true) . "</pre>";
    echo "Total: " . count($asistentes) . "<br><br>";
    
    echo "<h3>8. Verificar Conexión</h3>";
    global $conexion;
    if ($conexion) {
        echo "Conexión: OK<br>";
        echo "Base de datos: " . $conexion->query("SELECT DATABASE()")->fetch_row()[0] . "<br>";
    } else {
        echo "Conexión: ERROR<br>";
    }
    
} catch (Exception $e) {
    echo "<h3 style='color:red'>Error:</h3>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>

