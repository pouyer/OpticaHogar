<?php
/**
 * Endpoint AJAX para cargar ubicaciones geográficas
 * Maneja la carga dinámica de departamentos, municipios y localidades
 */

// Evitar que warnings rompan la respuesta JSON
ini_set('display_errors', '0');
error_reporting(E_ERROR | E_PARSE);

header('Content-Type: application/json; charset=utf-8');
require_once '../conexion.php';

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'departamentos':
            $pais_id = (int)($_GET['pais_id'] ?? 0);
            
            if ($pais_id <= 0) {
                echo json_encode(['error' => 'ID de país inválido']);
                exit;
            }
            
            $sql = "SELECT id, Nombre 
                    FROM departamento 
                    WHERE id_pais = ? AND estado = 'activo'
                    ORDER BY Nombre ASC";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $pais_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $departamentos = [];
            while ($row = $result->fetch_assoc()) {
                $departamentos[] = [
                    'id' => $row['id'],
                    'nombre' => $row['Nombre']
                ];
            }
            
            echo json_encode(['success' => true, 'data' => $departamentos]);
            break;
            
        case 'municipios':
            $departamento_id = (int)($_GET['departamento_id'] ?? 0);
            
            if ($departamento_id <= 0) {
                echo json_encode(['error' => 'ID de departamento inválido']);
                exit;
            }
            
            $sql = "SELECT id, Nombre 
                    FROM municipio 
                    WHERE id_departamento = ? AND estado = 'activo'
                    ORDER BY Nombre ASC";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $departamento_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $municipios = [];
            while ($row = $result->fetch_assoc()) {
                $municipios[] = [
                    'id' => $row['id'],
                    'nombre' => $row['Nombre']
                ];
            }
            
            echo json_encode(['success' => true, 'data' => $municipios]);
            break;
            
        case 'localidades':
            $municipio_id = (int)($_GET['municipio_id'] ?? 0);
            
            if ($municipio_id <= 0) {
                echo json_encode(['error' => 'ID de municipio inválido']);
                exit;
            }
            
            $sql = "SELECT id, nombre 
                    FROM localidad 
                    WHERE id_municipio = ? AND estado = 'activo'
                    ORDER BY nombre ASC";
            
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $municipio_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $localidades = [];
            while ($row = $result->fetch_assoc()) {
                $localidades[] = [
                    'id' => $row['id'],
                    'nombre' => $row['nombre']
                ];
            }
            
            echo json_encode(['success' => true, 'data' => $localidades]);
            break;
            
        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
    
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conexion->close();
?>
