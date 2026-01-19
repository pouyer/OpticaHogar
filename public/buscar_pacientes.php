<?php
// public/buscar_pacientes.php
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

// Buscar pacientes
$modelo = new ModeloCita();
$resultados = $modelo->buscarPacientes($termino);

// Preparar respuesta JSON
$pacientes = [];
foreach ($resultados as $p) {
    $pacientes[] = [
        'id'              => (int)$p['id'],
        'texto'           => $p['texto'],
        'nombre_completo' => trim($p['nombre_completo']),
        'documento'       => $p['documento'],
        'telefono'        => $p['telefono'] ?? '',
        'edad'            => $p['edad_texto'] ?? 'No disponible'
    ];
}

// Devolver resultados
echo json_encode($pacientes);
exit;
?>
