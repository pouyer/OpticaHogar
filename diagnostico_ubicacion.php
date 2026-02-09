<?php
/**
 * Script de Diagnóstico - Sincronización Geográfica
 * 
 * Este script ayuda a diagnosticar problemas con la carga de departamentos/municipios
 * Ejecutar en: http://tu-servidor.com/OpticaHogar/diagnostico_ubicacion.php
 */

header('Content-Type: text/html; charset=utf-8');
require_once 'conexion.php';

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Diagnóstico - Ubicaciones Geográficas</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='p-4'>
<div class='container'>
    <h1>🔍 Diagnóstico de Ubicaciones Geográficas</h1>
    <hr>
";

// Test 1: Verificar conexión
echo "<div class='card mb-3'>
        <div class='card-header bg-primary text-white'><h5>Test 1: Conexión a Base de Datos</h5></div>
        <div class='card-body'>";

if ($conexion->connect_error) {
    echo "<p class='text-danger'>❌ ERROR: " . $conexion->connect_error . "</p>";
} else {
    echo "<p class='text-success'>✅ Conexión exitosa</p>";
    echo "<p>Servidor: " . $conexion->host_info . "</p>";
}
echo "</div></div>";

// Test 2: Verificar tablas
echo "<div class='card mb-3'>
        <div class='card-header bg-info text-white'><h5>Test 2: Verificar Tablas</h5></div>
        <div class='card-body'>";

$tablas = ['pais', 'departamento', 'municipio', 'localidad'];
foreach ($tablas as $tabla) {
    $result = $conexion->query("SHOW TABLES LIKE '$tabla'");
    if ($result && $result->num_rows > 0) {
        $count = $conexion->query("SELECT COUNT(*) as total FROM $tabla")->fetch_assoc()['total'];
        echo "<p class='text-success'>✅ Tabla <code>$tabla</code> existe ($count registros)</p>";
    } else {
        echo "<p class='text-danger'>❌ Tabla <code>$tabla</code> NO existe</p>";
    }
}
echo "</div></div>";

// Test 3: Verificar datos de Colombia
echo "<div class='card mb-3'>
        <div class='card-header bg-success text-white'><h5>Test 3: Datos de Colombia</h5></div>
        <div class='card-body'>";

$pais = $conexion->query("SELECT * FROM pais WHERE nombre LIKE '%Colombia%' LIMIT 1");
if ($pais && $pais->num_rows > 0) {
    $pais_data = $pais->fetch_assoc();
    echo "<p class='text-success'>✅ País encontrado: " . $pais_data['nombre'] . " (ID: " . $pais_data['id'] . ")</p>";
    
    $pais_id = $pais_data['id'];
    $deptos = $conexion->query("SELECT COUNT(*) as total FROM departamento WHERE id_pais = $pais_id");
    if ($deptos) {
        $total_deptos = $deptos->fetch_assoc()['total'];
        echo "<p class='text-success'>✅ Departamentos de Colombia: $total_deptos</p>";
        
        // Mostrar algunos departamentos
        $sample = $conexion->query("SELECT id, Nombre FROM departamento WHERE id_pais = $pais_id ORDER BY Nombre LIMIT 5");
        echo "<p><strong>Ejemplos:</strong></p><ul>";
        while ($row = $sample->fetch_assoc()) {
            echo "<li>{$row['Nombre']} (ID: {$row['id']})</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p class='text-danger'>❌ No se encontró Colombia en la tabla pais</p>";
}
echo "</div></div>";

// Test 4: Probar endpoint AJAX
echo "<div class='card mb-3'>
        <div class='card-header bg-warning'><h5>Test 4: Endpoint AJAX</h5></div>
        <div class='card-body'>";

$endpoint_files = [
    'controladores/controlador_ubicacion.php',
    'controladores/controlador_pacientes.php',
    'ajax/ubicaciones.php',
    'ajax/cargar_ubicaciones.php'
];

$found = false;
foreach ($endpoint_files as $file) {
    if (file_exists($file)) {
        echo "<p class='text-success'>✅ Encontrado: <code>$file</code></p>";
        $found = true;
    }
}

if (!$found) {
    echo "<p class='text-danger'>❌ No se encontró ningún endpoint para cargar ubicaciones</p>";
    echo "<p class='text-warning'>⚠️ Necesitas crear un endpoint AJAX para cargar departamentos/municipios</p>";
}

echo "</div></div>";

// Test 5: Verificar estructura de columnas
echo "<div class='card mb-3'>
        <div class='card-header bg-secondary text-white'><h5>Test 5: Estructura de Tablas</h5></div>
        <div class='card-body'>";

$estructura = $conexion->query("DESCRIBE departamento");
if ($estructura) {
    echo "<p><strong>Columnas de tabla 'departamento':</strong></p><ul>";
    while ($col = $estructura->fetch_assoc()) {
        echo "<li><code>{$col['Field']}</code> ({$col['Type']})</li>";
    }
    echo "</ul>";
}

echo "</div></div>";

// Test 6: Probar consulta de departamentos
echo "<div class='card mb-3'>
        <div class='card-header bg-dark text-white'><h5>Test 6: Consulta de Prueba</h5></div>
        <div class='card-body'>";

$test_query = "SELECT id, Nombre FROM departamento WHERE id_pais = 1 ORDER BY Nombre LIMIT 10";
echo "<p><strong>Consulta:</strong> <code>$test_query</code></p>";

$result = $conexion->query($test_query);
if ($result && $result->num_rows > 0) {
    echo "<p class='text-success'>✅ Consulta exitosa ($result->num_rows resultados)</p>";
    echo "<table class='table table-sm'><thead><tr><th>ID</th><th>Nombre</th></tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['Nombre']}</td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='text-danger'>❌ La consulta no devolvió resultados</p>";
    echo "<p>Error: " . $conexion->error . "</p>";
}

echo "</div></div>";

// Recomendaciones
echo "<div class='card mb-3 border-info'>
        <div class='card-header bg-info text-white'><h5>📋 Recomendaciones</h5></div>
        <div class='card-body'>";

echo "<ol>";
echo "<li>Verificar que exista un archivo para manejar las peticiones AJAX de ubicaciones</li>";
echo "<li>Revisar la consola del navegador (F12) para ver errores JavaScript</li>";
echo "<li>Verificar que las rutas en el código JavaScript sean correctas (Linux es case-sensitive)</li>";
echo "<li>Comprobar permisos de archivos en el servidor Linux</li>";
echo "<li>Revisar logs de Apache/Nginx para errores 404 o 500</li>";
echo "</ol>";

echo "</div></div>";

echo "</div>
</body>
</html>";

$conexion->close();
?>
