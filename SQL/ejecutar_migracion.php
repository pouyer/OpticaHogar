<?php
/**
 * Script de Migración de Base de Datos para Producción
 * 
 * IMPORTANTE: 
 * - Este script debe ejecutarse UNA SOLA VEZ en producción
 * - Hacer backup de la base de datos ANTES de ejecutar
 * - Verificar la conexión a la base de datos correcta
 */

// Configuración de seguridad
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Clave de seguridad - CAMBIAR ESTO en producción
define('CLAVE_MIGRACION', 'RIPS_2024_SEGURA');

// Verificar clave de seguridad
if (!isset($_GET['clave']) || $_GET['clave'] !== CLAVE_MIGRACION) {
    die('Acceso denegado. Clave de seguridad incorrecta.');
}

// Incluir conexión
require_once '../conexion.php';

// Archivos SQL a ejecutar en orden
$archivos_sql = [
    'crear_tablas_rips.sql',
    'actualizar_para_RIPS.sql'
];

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Migración Base de Datos - RIPS</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .log-success { color: #28a745; }
        .log-error { color: #dc3545; }
        .log-warning { color: #ffc107; }
        .log-info { color: #17a2b8; }
    </style>
</head>
<body>
<div class='container'>
    <h1 class='mb-4'>🚀 Migración de Base de Datos - Módulo RIPS</h1>
    <div class='alert alert-warning'>
        <strong>⚠️ ADVERTENCIA:</strong> Este proceso modificará la base de datos. Asegúrese de tener un backup.
    </div>
";

$errores_totales = 0;
$exitos_totales = 0;

foreach ($archivos_sql as $archivo) {
    $ruta_completa = __DIR__ . '/' . $archivo;
    
    echo "<div class='card mb-3'>
            <div class='card-header bg-primary text-white'>
                <h5 class='mb-0'>📄 Procesando: $archivo</h5>
            </div>
            <div class='card-body'>";
    
    if (!file_exists($ruta_completa)) {
        echo "<p class='log-error'>❌ ERROR: Archivo no encontrado: $ruta_completa</p>";
        $errores_totales++;
        echo "</div></div>";
        continue;
    }
    
    // Leer contenido del archivo
    $sql_completo = file_get_contents($ruta_completa);
    
    if ($sql_completo === false) {
        echo "<p class='log-error'>❌ ERROR: No se pudo leer el archivo</p>";
        $errores_totales++;
        echo "</div></div>";
        continue;
    }
    
    echo "<p class='log-info'>📖 Archivo leído correctamente (" . number_format(strlen($sql_completo)) . " bytes)</p>";
    
    // Usar multi_query para ejecutar todo el archivo de una vez
    // Esto maneja correctamente procedimientos, triggers y delimitadores
    echo "<p class='log-info'>⚙️ Ejecutando sentencias SQL...</p>";
    
    if ($conexion->multi_query($sql_completo)) {
        $sentencias_ejecutadas = 0;
        $errores_archivo = 0;
        
        do {
            $sentencias_ejecutadas++;
            
            // Obtener resultado si existe
            if ($result = $conexion->store_result()) {
                $result->free();
            }
            
            // Verificar si hay errores
            if ($conexion->errno) {
                $error_msg = $conexion->error;
                
                // Ignorar ciertos errores comunes que no son críticos
                $errores_ignorables = [
                    'Table already exists',
                    'Duplicate column name',
                    'already exists',
                    'Unknown table'
                ];
                
                $es_ignorable = false;
                foreach ($errores_ignorables as $patron) {
                    if (stripos($error_msg, $patron) !== false) {
                        $es_ignorable = true;
                        break;
                    }
                }
                
                if (!$es_ignorable) {
                    echo "<p class='log-error'>❌ ERROR: " . htmlspecialchars($error_msg) . "</p>";
                    $errores_archivo++;
                }
            }
            
            // Avanzar al siguiente resultado
            if (!$conexion->more_results()) {
                break;
            }
        } while ($conexion->next_result());
        
        // Limpiar cualquier resultado pendiente
        while ($conexion->more_results()) {
            $conexion->next_result();
            if ($result = $conexion->store_result()) {
                $result->free();
            }
        }
        
        $exitos_archivo = $sentencias_ejecutadas - $errores_archivo;
        
        echo "<hr>";
        echo "<p class='log-success'><strong>✅ Sentencias procesadas: $sentencias_ejecutadas</strong></p>";
        if ($errores_archivo > 0) {
            echo "<p class='log-error'><strong>❌ Errores encontrados: $errores_archivo</strong></p>";
        } else {
            echo "<p class='log-success'><strong>✅ Todas las sentencias se ejecutaron correctamente</strong></p>";
        }
        
        $exitos_totales += $exitos_archivo;
        $errores_totales += $errores_archivo;
        
    } else {
        echo "<p class='log-error'>❌ ERROR al iniciar ejecución: " . htmlspecialchars($conexion->error) . "</p>";
        $errores_totales++;
    }
    
    echo "</div></div>";
}

// Resumen final
echo "<div class='card border-" . ($errores_totales > 0 ? 'warning' : 'success') . "'>
        <div class='card-header bg-" . ($errores_totales > 0 ? 'warning' : 'success') . " text-white'>
            <h4 class='mb-0'>📊 Resumen de Migración</h4>
        </div>
        <div class='card-body'>
            <p class='log-success'><strong>✅ Total de sentencias exitosas: $exitos_totales</strong></p>
            <p class='log-error'><strong>❌ Total de errores: $errores_totales</strong></p>";

if ($errores_totales === 0) {
    echo "<div class='alert alert-success mt-3'>
            <h5>🎉 ¡Migración completada exitosamente!</h5>
            <p>Todos los cambios se aplicaron correctamente a la base de datos.</p>
            <p><strong>Próximos pasos:</strong></p>
            <ul>
                <li>Verificar que las tablas se crearon correctamente</li>
                <li>Probar el módulo RIPS</li>
                <li><strong>ELIMINAR este archivo (ejecutar_migracion.php) por seguridad</strong></li>
            </ul>
          </div>";
} else {
    echo "<div class='alert alert-warning mt-3'>
            <h5>⚠️ Migración completada con advertencias</h5>
            <p>Algunos errores pueden ser normales si ya ejecutó este script anteriormente.</p>
            <p>Revise los errores arriba para asegurarse de que no sean críticos.</p>
          </div>";
}

echo "    </div>
      </div>
      
      <div class='mt-4 text-center'>
        <a href='../vistas/vista_rips.php' class='btn btn-primary'>Ir al Módulo RIPS</a>
      </div>
</div>
</body>
</html>";

$conexion->close();
?>
