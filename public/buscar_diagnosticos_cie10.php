<?php
// public/buscar_diagnosticos_cie10.php
session_start();

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

// Cabecera JSON
header('Content-Type: application/json; charset=utf-8');

// Incluir conexión y modelo
require_once '../conexion.php';
require_once '../modelos/modelo_cita.php';

// Validar que haya un término de búsqueda
if (!isset($_GET['q']) || trim($_GET['q']) === '') {
    echo json_encode([]);
    exit;
}

$termino = trim($_GET['q']);

// Buscar diagnósticos
$modelo = new ModeloCita();
$resultados = $modelo->buscarDiagnosticosCIE10($termino);

// Preparar respuesta JSON
$diagnosticos = [];
foreach ($resultados as $d) {
    $diagnosticos[] = [
        'id'          => (int)$d['id'],
        'codigo'      => $d['codigo'],
        'descripcion' => $d['descripcion'],
        'categoria'   => $d['categoria'] ?? '',
        'texto'       => $d['codigo'] . ' - ' . $d['descripcion']
    ];
}

// Devolver resultados
echo json_encode($diagnosticos);
exit;
?>

