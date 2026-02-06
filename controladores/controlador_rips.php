<?php
require_once '../conexion.php';
require_once '../modelos/modelo_rips.php';

require_once '../accesos/verificar_sesion.php';

class ControladorRips {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new ModeloRips($conexion);
    }

    public function index() {
        $optometras = $this->modelo->obtenerOptometras();
        $anios = range(date('Y'), date('Y') - 5);
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        include '../vistas/vista_rips.php';
    }

    public function consultar() {
        header('Content-Type: application/json');
        try {
            $num_doc = $_POST['profesional'] ?? '';
            $anio = $_POST['anio'] ?? date('Y');
            $mes = $_POST['mes'] ?? date('n');

            if (empty($num_doc)) {
                echo json_encode(['error' => 'Debe seleccionar un profesional']);
                return;
            }

            $registros = $this->modelo->consultarRips($num_doc, $anio, $mes);
            $ultima_seleccion = $this->modelo->obtenerUltimaSeleccion($num_doc, $anio, $mes);

            echo json_encode([
                'success' => true,
                'registros' => $registros,
                'ultima_seleccion' => $ultima_seleccion
            ]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function validar() {
        header('Content-Type: application/json');
        try {
            $num_doc = $_POST['profesional'] ?? '';
            $anio = $_POST['anio'] ?? date('Y');
            $mes = $_POST['mes'] ?? date('n');
            $citas_ids = $_POST['citas'] ?? [];

            if (empty($citas_ids)) {
                echo json_encode(['error' => 'Debe seleccionar al menos una consulta']);
                return;
            }

            $registros = $this->modelo->consultarRips($num_doc, $anio, $mes);
            $filtrados = array_filter($registros, function($r) use ($citas_ids) {
                return in_array($r['cita_id'], $citas_ids);
            });

            $erroresPorCita = [];
            foreach ($filtrados as $registro) {
                $errores = $this->modelo->validarConsultaRIPS($registro);
                if (!empty($errores)) {
                    $erroresPorCita[] = [
                        'cita_id' => $registro['cita_id'],
                        'paciente' => $registro['nombre_paciente'] ?? $registro['num_doc_paciente'],
                        'fecha' => $registro['fecha_inicio_atencion'],
                        'errores' => $errores
                    ];
                }
            }

            if (empty($erroresPorCita)) {
                echo json_encode(['success' => true, 'mensaje' => 'Todos los registros son válidos']);
            } else {
                echo json_encode([
                    'success' => false,
                    'errores' => $erroresPorCita,
                    'total_errores' => count($erroresPorCita),
                    'total_registros' => count($filtrados)
                ]);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function generarJson() {
        header('Content-Type: application/json');
        try {
            $num_doc = $_POST['profesional'] ?? '';
            $anio = (int)($_POST['anio'] ?? date('Y'));
            $mes = (int)($_POST['mes'] ?? date('n'));
            $citas_ids = $_POST['citas'] ?? [];

            if (empty($citas_ids)) {
                echo json_encode(['error' => 'Debe seleccionar al menos una consulta']);
                return;
            }

            $registros = $this->modelo->consultarRips($num_doc, $anio, $mes);
            $filtrados = array_filter($registros, function($r) use ($citas_ids) {
                return in_array($r['cita_id'], $citas_ids);
            });

            if (empty($filtrados)) {
                echo json_encode(['error' => 'No se encontraron los registros seleccionados']);
                return;
            }

            // Tomar datos del prestador del primer registro
            $primer = reset($filtrados);
            
            $json_data = [
                "prestador" => [
                    "codPrestador" => $primer['cod_prestador'],
                    "razonSocialPrestador" => $primer['razon_social_prestador'],
                    "tipoPrestador" => $primer['tipo_prestador'],
                    "numDocumentoPrestador" => $primer['num_doc_prestador'],
                    "codDepartamentoPrestador" => $primer['cod_departamento_residencia'], // Simplificación para el ejemplo
                    "codMunicipioPrestador" => $primer['cod_municipio_residencia']
                ],
                "periodo" => [
                    "anio" => $anio,
                    "mes" => $mes
                ],
                "consultas" => []
            ];

            foreach ($filtrados as $f) {
                $json_data['consultas'][] = [
                    "fechaInicioAtencion" => $f['fecha_inicio_atencion'],
                    "codPrestador" => $f['cod_prestador'],
                    "tipoDocumentoIdentificacion" => $f['tipo_doc_paciente'],
                    "numDocumentoIdentificacion" => $f['num_doc_paciente'],
                    "codConsulta" => $f['cod_consulta'],
                    "finalidadConsulta" => $f['finalidad_consulta'],
                    "causaExterna" => $f['causa_externa'],
                    "codDiagnosticoPrincipal" => $f['cie10_principal'],
                    "codDiagnosticoRelacionado1" => null,
                    "codDiagnosticoRelacionado2" => null,
                    "codDiagnosticoRelacionado3" => null,
                    "tipoDiagnosticoPrincipal" => $f['tipo_diagnostico_principal'],
                    "valorConsulta" => (float)$f['valor_consulta'],
                    "valorCuotaModeradora" => (float)$f['valor_cuota_moderadora'],
                    "valorNetoPagar" => (float)$f['valor_neto_pagar']
                ];
            }

            // Guardar en histórico
            $this->modelo->guardarGeneracion($num_doc, $anio, $mes, $_SESSION['usuario_id'] ?? 0, 'JSON', $citas_ids);

            echo json_encode([
                'success' => true,
                'json' => $json_data,
                'filename' => "RIPS_{$num_doc}_{$anio}_{$mes}.json"
            ]);

        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function generarExcel() {
        try {
            $num_doc = $_POST['profesional'] ?? '';
            $anio = (int)($_POST['anio'] ?? date('Y'));
            $mes = (int)($_POST['mes'] ?? date('n'));
            $citas_ids = $_POST['citas'] ?? [];

            if (empty($citas_ids)) {
                echo json_encode(['error' => 'Debe seleccionar al menos una consulta']);
                return;
            }

            $registros = $this->modelo->consultarRips($num_doc, $anio, $mes);
            $filtrados = array_filter($registros, function($r) use ($citas_ids) {
                return in_array($r['cita_id'], $citas_ids);
            });

            if (empty($filtrados)) {
                echo json_encode(['error' => 'No se encontraron los registros seleccionados']);
                return;
            }

            // Guardar en histórico
            $this->modelo->guardarGeneracion($num_doc, $anio, $mes, $_SESSION['usuario_id'] ?? 0, 'EXCEL', $citas_ids);

            // Generar CSV para Excel (Estructura EXACTA Res. 2275)
            $filename = "RIPS_CONSULTAS_{$num_doc}_{$anio}_{$mes}.csv";
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            
            $output = fopen('php://output', 'w');
            // BOM para compatibilidad con Excel Windows
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Encabezados Oficiales (Res. 2275)
            fputcsv($output, [
                'TIPO_DOCUMENTO_IDENTIFICACION',
                'NUMERO_DOCUMENTO_IDENTIFICACION',
                'FECHA_CONSULTA',
                'CODIGO_PRESTADOR',
                'CODIGO_CONSULTA',
                'FINALIDAD_CONSULTA',
                'CAUSA_EXTERNA',
                'CODIGO_DIAGNOSTICO_PRINCIPAL',
                'CODIGO_DIAGNOSTICO_RELACIONADO_1',
                'CODIGO_DIAGNOSTICO_RELACIONADO_2',
                'CODIGO_DIAGNOSTICO_RELACIONADO_3',
                'TIPO_DIAGNOSTICO_PRINCIPAL',
                'VALOR_CONSULTA',
                'VALOR_CUOTA_MODERADORA',
                'VALOR_NETO_PAGAR'
            ], ';');

            foreach ($filtrados as $f) {
                fputcsv($output, [
                    $f['tipo_doc_paciente'],
                    $f['num_doc_paciente'],
                    $f['fecha_inicio_atencion'],
                    $f['cod_prestador'],
                    $f['cod_consulta'],
                    $f['finalidad_consulta'],
                    $f['causa_externa'],
                    $f['cie10_principal'],
                    '', // Relacionado 1
                    '', // Relacionado 2
                    '', // Relacionado 3
                    $f['tipo_diagnostico_principal'],
                    number_format((float)$f['valor_consulta'], 0, '.', ''),
                    number_format((float)$f['valor_cuota_moderadora'], 0, '.', ''),
                    number_format((float)$f['valor_neto_pagar'], 0, '.', '')
                ], ';');
            }
            fclose($output);
            exit;
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

// Enrutamiento básico
$controlador = new ControladorRips($conexion);
$action = $_GET['action'] ?? 'index';

if (method_exists($controlador, $action)) {
    $controlador->$action();
}
?>
