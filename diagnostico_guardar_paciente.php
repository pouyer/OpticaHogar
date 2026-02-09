<?php
/**
 * Script de diagnóstico para errores de guardado de pacientes
 * Ejecutar en: http://tu-servidor.com/OpticaHogar/diagnostico_guardar_paciente.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Diagnóstico - Guardar Paciente</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body class='p-4'>
<div class='container'>
    <h1>🔍 Diagnóstico - Guardar Paciente</h1>
    <hr>
";

// Test 1: Verificar conexión
echo "<div class='card mb-3'>
        <div class='card-header bg-primary text-white'><h5>Test 1: Conexión</h5></div>
        <div class='card-body'>";

require_once 'conexion.php';

if ($conexion->connect_error) {
    echo "<p class='text-danger'>❌ ERROR: " . $conexion->connect_error . "</p>";
} else {
    echo "<p class='text-success'>✅ Conexión exitosa</p>";
}
echo "</div></div>";

// Test 2: Verificar controlador
echo "<div class='card mb-3'>
        <div class='card-header bg-info text-white'><h5>Test 2: Controlador de Pacientes</h5></div>
        <div class='card-body'>";

$controlador_path = 'controladores/controlador_pacientes.php';
if (file_exists($controlador_path)) {
    echo "<p class='text-success'>✅ Archivo encontrado: $controlador_path</p>";
    
    // Verificar sintaxis
    $output = [];
    $return_var = 0;
    exec("php -l $controlador_path 2>&1", $output, $return_var);
    
    if ($return_var === 0) {
        echo "<p class='text-success'>✅ Sintaxis PHP correcta</p>";
    } else {
        echo "<p class='text-danger'>❌ Error de sintaxis:</p>";
        echo "<pre>" . implode("\n", $output) . "</pre>";
    }
} else {
    echo "<p class='text-danger'>❌ Archivo NO encontrado: $controlador_path</p>";
}

echo "</div></div>";

// Test 3: Verificar modelo
echo "<div class='card mb-3'>
        <div class='card-header bg-success text-white'><h5>Test 3: Modelo de Pacientes</h5></div>
        <div class='card-body'>";

$modelo_path = 'modelos/modelo_pacientes.php';
if (file_exists($modelo_path)) {
    echo "<p class='text-success'>✅ Archivo encontrado: $modelo_path</p>";
    
    try {
        require_once $modelo_path;
        echo "<p class='text-success'>✅ Modelo cargado correctamente</p>";
        
        if (class_exists('ModeloPacientes')) {
            echo "<p class='text-success'>✅ Clase ModeloPacientes existe</p>";
            
            $modelo = new ModeloPacientes();
            echo "<p class='text-success'>✅ Instancia creada correctamente</p>";
            
            // Verificar métodos
            if (method_exists($modelo, 'crear')) {
                echo "<p class='text-success'>✅ Método 'crear' existe</p>";
            } else {
                echo "<p class='text-danger'>❌ Método 'crear' NO existe</p>";
            }
        } else {
            echo "<p class='text-danger'>❌ Clase ModeloPacientes NO existe</p>";
        }
    } catch (Exception $e) {
        echo "<p class='text-danger'>❌ Error al cargar modelo: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p class='text-danger'>❌ Archivo NO encontrado: $modelo_path</p>";
}

echo "</div></div>";

// Test 4: Simular datos de prueba
echo "<div class='card mb-3'>
        <div class='card-header bg-warning'><h5>Test 4: Datos Mínimos Requeridos</h5></div>
        <div class='card-body'>";

echo "<p>Campos requeridos para crear un paciente:</p>";
echo "<ul>";
echo "<li>tipo_identificacion_id</li>";
echo "<li>identificacion</li>";
echo "<li>primer_nombre</li>";
echo "<li>primer_apellido</li>";
echo "<li>fecha_nacimiento</li>";
echo "<li>genero_id</li>";
echo "<li>pais_residencia_id</li>";
echo "<li>departamento_id</li>";
echo "<li>municipio_id</li>";
echo "<li>zona_residencia</li>";
echo "</ul>";

echo "<p class='text-info'>💡 Verifica que todos estos campos estén siendo enviados en el formulario</p>";

echo "</div></div>";

// Test 5: Verificar logs de errores
echo "<div class='card mb-3'>
        <div class='card-header bg-danger text-white'><h5>Test 5: Logs de Errores PHP</h5></div>
        <div class='card-body'>";

$error_log = ini_get('error_log');
echo "<p><strong>Ubicación del log:</strong> " . ($error_log ? $error_log : "No configurado") . "</p>";

echo "<p class='text-warning'>⚠️ Revisa los logs del servidor para ver el error exacto al intentar guardar</p>";
echo "<p>Ubicaciones comunes:</p>";
echo "<ul>";
echo "<li>/var/log/apache2/error.log (Linux)</li>";
echo "<li>/var/log/php-fpm/error.log (Linux con PHP-FPM)</li>";
echo "<li>C:\\xampp\\apache\\logs\\error.log (Windows XAMPP)</li>";
echo "</ul>";

echo "</div></div>";

echo "</div>
</body>
</html>";

$conexion->close();
?>
