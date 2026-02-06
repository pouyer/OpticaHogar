<?php
class ModeloRips {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener lista de optómetras disponibles
    public function obtenerOptometras() {
        $sql = "SELECT p.identificacion, 
                       CONCAT(p.primer_nombre, ' ', IFNULL(p.segundo_nombre, ''), ' ', p.primer_apellido, ' ', IFNULL(p.segundo_apellido, '')) AS NOMBRE
                FROM profesionales_salud p
                JOIN tipos_profesional tp ON (tp.id = p.tipo_profesional_id AND tp.codigo = 'OPTOMETRA')
                WHERE p.disponible = TRUE
                ORDER BY NOMBRE ASC";
        $resultado = $this->conexion->query($sql);
        $optometras = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $optometras[] = $row;
            }
        }
        return $optometras;
    }

    // Consultar datos de la vista RIPS filtrados por profesional y periodo
    public function consultarRips($num_doc_prestador, $anio, $mes) {
        $sql = "SELECT * FROM vw_rips_consultas 
                WHERE num_doc_prestador = ? 
                AND anio = ? 
                AND mes = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('sii', $num_doc_prestador, $anio, $mes);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = [];
        while ($row = $resultado->fetch_assoc()) {
            $datos[] = $row;
        }
        return $datos;
    }

    // Obtener los IDs de las citas marcadas en la última generación para un periodo
    public function obtenerUltimaSeleccion($num_doc_prestador, $anio, $mes) {
        $sql = "SELECT rd.cita_id 
                FROM rips_generados_detalles rd
                JOIN rips_generados r ON rd.rips_generado_id = r.id
                WHERE r.num_doc_prestador = ? 
                AND r.anio = ? 
                AND r.mes = ?
                AND r.id = (SELECT MAX(id) FROM rips_generados WHERE num_doc_prestador = ? AND anio = ? AND mes = ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('siisii', $num_doc_prestador, $anio, $mes, $num_doc_prestador, $anio, $mes);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $ids = [];
        while ($row = $resultado->fetch_assoc()) {
            $ids[] = $row['cita_id'];
        }
        return $ids;
    }

    // Guardar una nueva generación de RIPS y sus detalles
    public function guardarGeneracion($num_doc_prestador, $anio, $mes, $usuario_id, $formato, $citas_ids) {
        $this->conexion->begin_transaction();
        try {
            $sql = "INSERT INTO rips_generados (num_doc_prestador, anio, mes, usuario_id, formato) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('siiis', $num_doc_prestador, $anio, $mes, $usuario_id, $formato);
            $stmt->execute();
            $generacion_id = $this->conexion->insert_id;

            $sql_det = "INSERT INTO rips_generados_detalles (rips_generado_id, cita_id) VALUES (?, ?)";
            $stmt_det = $this->conexion->prepare($sql_det);
            foreach ($citas_ids as $cita_id) {
                $stmt_det->bind_param('ii', $generacion_id, $cita_id);
                $stmt_det->execute();
            }

            $this->conexion->commit();
            return $generacion_id;
        } catch (Exception $e) {
            $this->conexion->rollback();
            throw $e;
        }
    }

    public function validarConsultaRIPS(array $c): array {
        $errores = [];

        // --- Catálogos mínimos ---
        $finalidadesValidas = ['06','07','09','10','11'];
        $causasExternasValidas = ['10','13'];
        $tiposDiagnosticoValidos = ['I','C','R'];
        $cupsValidos = ['890207','890307'];

        // --- Campos obligatorios ---
        $obligatorios = [
            'fecha_inicio_atencion',
            'cod_prestador',
            'tipo_doc_paciente',
            'num_doc_paciente',
            'cod_consulta',
            'finalidad_consulta',
            'causa_externa',
            'cie10_principal',
            'tipo_diagnostico_principal',
            'valor_consulta',
            'valor_cuota_moderadora',
            'valor_neto_pagar'
        ];

        foreach ($obligatorios as $campo) {
            if (!isset($c[$campo]) || $c[$campo] === '' || $c[$campo] === null) {
                $errores[] = "Campo obligatorio vacío: $campo";
            }
        }

        // --- Fecha ---
        if (isset($c['fecha_inicio_atencion']) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $c['fecha_inicio_atencion'])) {
            $errores[] = "Fecha inválida (YYYY-MM-DD): {$c['fecha_inicio_atencion']}";
        }

        // --- Catálogos ---
        if (isset($c['finalidad_consulta']) && !in_array($c['finalidad_consulta'], $finalidadesValidas)) {
            $errores[] = "FinalidadConsulta inválida: {$c['finalidad_consulta']}";
        }

        if (isset($c['causa_externa']) && !in_array($c['causa_externa'], $causasExternasValidas)) {
            $errores[] = "CausaExterna inválida: {$c['causa_externa']}";
        }

        if (isset($c['tipo_diagnostico_principal']) && !in_array($c['tipo_diagnostico_principal'], $tiposDiagnosticoValidos)) {
            $errores[] = "TipoDiagnosticoPrincipal inválido: {$c['tipo_diagnostico_principal']}";
        }

        if (isset($c['cod_consulta']) && !in_array($c['cod_consulta'], $cupsValidos)) {
            $errores[] = "CUPS no permitido: {$c['cod_consulta']}";
        }

        // --- CIE-10 ---
        if (isset($c['cie10_principal']) && !preg_match('/^[A-Z]\d{2}\.\d$/', $c['cie10_principal'])) {
            $errores[] = "CIE-10 mal formado: {$c['cie10_principal']}";
        }

        // --- Valores ---
        if (isset($c['valor_consulta']) && isset($c['valor_cuota_moderadora'])) {
            if ($c['valor_consulta'] < 0 || $c['valor_cuota_moderadora'] < 0) {
                $errores[] = "Valores económicos no pueden ser negativos";
            }

            $netoCalculado = $c['valor_consulta'] - $c['valor_cuota_moderadora'];
            if (isset($c['valor_neto_pagar']) && $netoCalculado != $c['valor_neto_pagar']) {
                $errores[] = "ValorNetoPagar incorrecto. Esperado: $netoCalculado, Recibido: {$c['valor_neto_pagar']}";
            }
        }

        return $errores;
    }
}
?>
