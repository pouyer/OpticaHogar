<?php
/** 
 * Modelo para la tabla citas_control
 */

require_once '../conexion.php';

class ModeloCita {
    private $conexion;
    private $llavePrimaria = 'id';

    public function __construct() {
        global $conexion;
        if (!isset($conexion) || !$conexion) {
            throw new Exception("Error: No hay conexión a la base de datos disponible");
        }
        $this->conexion = $conexion;
    }

    public function getConexion() {
        return $this->conexion;
    }

    // Obtener profesional asociado al usuario logueado
    public function getProfesionalByUsuario($usuario_id) {
        $sql = "SELECT ps.*, 
                       CONCAT(ps.primer_nombre, ' ', COALESCE(ps.segundo_nombre,''), ' ', ps.primer_apellido, ' ', COALESCE(ps.segundo_apellido,'')) AS nombre_completo
                FROM profesionales_salud ps 
                WHERE ps.usuario_id = ? 
                  AND ps.disponible = TRUE
                LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            error_log("Error preparando consulta getProfesionalByUsuario: " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param('i', $usuario_id);
        if (!$stmt->execute()) {
            error_log("Error ejecutando consulta getProfesionalByUsuario: " . $stmt->error);
            return false;
        }
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    // Verificar si un paciente tiene citas previas
    public function tieneCitasPrevias($paciente_id) {
        $sql = "SELECT COUNT(*) as total FROM citas_control WHERE paciente_id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            error_log("Error preparando consulta tieneCitasPrevias: " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return ($resultado['total'] > 0);
    }

    /**
     * Verifica si el paciente tiene una cita activa en un estado que restringe nuevas citas.
     * @param int $paciente_id
     * @return array|null Datos de la cita restringida o null si no tiene.
     */
    public function getCitaRestringida($paciente_id) {
        $sql = "SELECT c.id, e.nombre as estado_nombre 
                FROM citas_control c
                JOIN estados_cita e ON c.estado_cita_id = e.id
                WHERE c.paciente_id = ? 
                AND e.restringe_nueva_cita = 1
                LIMIT 1";
        
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            error_log("Error preparando consulta getCitaRestringida: " . $this->conexion->error);
            return null;
        }
        
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado;
    }

    // Buscar pacientes con autocompletado + edad usando f_anos()
    public function buscarPacientes($termino) {
        $termino = '%' . $termino . '%';
        $sql = "SELECT 
                    p.id,
                    CONCAT(p.identificacion, ' - ', p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS texto,
                    CONCAT(p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS nombre_completo,
                    p.identificacion AS documento,
                    p.telefono_principal AS telefono,
                    f_anos(p.fecha_nacimiento) AS edad_texto
                FROM pacientes p
                WHERE p.identificacion LIKE ?
                   OR CONCAT(p.primer_nombre, ' ', p.primer_apellido) LIKE ?
                   OR CAST(p.id AS CHAR) LIKE ?
                ORDER BY p.primer_apellido, p.primer_nombre
                LIMIT 15";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('sss', $termino, $termino, $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $pacientes = [];
        while ($row = $resultado->fetch_assoc()) {
            $pacientes[] = $row;
        }
        return $pacientes;
    }

    // Buscar diagnósticos CIE-10
    public function buscarDiagnosticosCIE10($termino) {
        $termino = '%' . $termino . '%';
        $sql = "SELECT id, codigo, descripcion, categoria
                FROM diagnosticos_cie10
                WHERE estado = 'activo'
                  AND (codigo LIKE ? OR descripcion LIKE ? OR categoria LIKE ?)
                ORDER BY codigo
                LIMIT 20";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('sss', $termino, $termino, $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $diagnosticos = [];
        while ($row = $resultado->fetch_assoc()) {
            $diagnosticos[] = $row;
        }
        return $diagnosticos;
    }

    // Catálogos
    public function getTiposConsulta() {
        $sql = "SELECT id, nombre FROM tipos_consulta WHERE estado = 'activo' ORDER BY orden, nombre";
        $resultado = $this->conexion->query($sql);
        $tipos = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $tipos[] = $row;
            }
        } else {
            error_log("Error en getTiposConsulta: " . $this->conexion->error);
        }
        return $tipos;
    }

    public function getTiposLentes() {
        $sql = "SELECT id, nombre FROM tipos_lentes WHERE estado = 'activo' ORDER BY nombre";
        $resultado = $this->conexion->query($sql);
        $tipos = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $tipos[] = $row;
            }
        } else {
            error_log("Error en getTiposLentes: " . $this->conexion->error);
        }
        return $tipos;
    }

    public function getMaterialesLentes() {
        $sql = "SELECT id, nombre FROM materiales_lentes WHERE estado = 'activo' ORDER BY nombre";
        $resultado = $this->conexion->query($sql);
        $materiales = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $materiales[] = $row;
            }
        } else {
            error_log("Error en getMaterialesLentes: " . $this->conexion->error);
        }
        return $materiales;
    }

    public function getUsosLentes() {
        $sql = "SELECT id, nombre FROM usos_lentes WHERE estado = 'activo' ORDER BY nombre";
        $resultado = $this->conexion->query($sql);
        $usos = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $usos[] = $row;
            }
        } else {
            error_log("Error en getUsosLentes: " . $this->conexion->error);
        }
        return $usos;
    }

    public function getTiposOrigenEnfermedad() {
        $sql = "SELECT id, nombre FROM tipos_origen_enfermedad WHERE estado = 'activo' ORDER BY nombre";
        $resultado = $this->conexion->query($sql);
        $tipos = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $tipos[] = $row;
            }
        } else {
            error_log("Error en getTiposOrigenEnfermedad: " . $this->conexion->error);
        }
        return $tipos;
    }

    public function getEstadosCita() {
        $sql = "SELECT id, nombre, color FROM estados_cita WHERE estado = 'activo' ORDER BY orden , nombre";
        $resultado = $this->conexion->query($sql);
        $estados = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $estados[] = $row;
            }
        } else {
            error_log("Error en getEstadosCita: " . $this->conexion->error);
        }
        return $estados;
    }

    public function getAsistentes() {
        $sql = "SELECT ps.id, CONCAT(ps.primer_nombre, ' ', ps.primer_apellido) AS nombre_completo
                FROM profesionales_salud ps
                JOIN tipos_profesional tp ON ps.tipo_profesional_id = tp.id
                WHERE tp.codigo = 'ASISTENTE' AND ps.disponible = TRUE
                ORDER BY ps.primer_apellido, ps.primer_nombre";
        $resultado = $this->conexion->query($sql);
        $asistentes = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $asistentes[] = $row;
            }
        } else {
            error_log("Error en getAsistentes: " . $this->conexion->error);
        }
        return $asistentes;
    }

    // Guardar cita
    public function guardarCita($datos) {
        $campos = [];
        $valores = [];
        $tipos = '';
        $params = [];

        // Campos requeridos
        $campos[] = '`paciente_id`';
        $valores[] = '?';
        $params[] = $datos['paciente_id'];
        $tipos .= 'i';

        $campos[] = '`fecha_cita`';
        $valores[] = '?';
        $params[] = $datos['fecha_cita'] ?? date('Y-m-d');
        $tipos .= 's';

        $campos[] = '`hora_cita`';
        $valores[] = '?';
        $params[] = $datos['hora_cita'] ?? date('H:i:s');
        $tipos .= 's';

        $campos[] = '`tipo_consulta_id`';
        $valores[] = '?';
        $params[] = $datos['tipo_consulta_id'];
        $tipos .= 'i';

        $campos[] = '`profesional_id`';
        $valores[] = '?';
        $params[] = $datos['profesional_id'];
        $tipos .= 'i';

        $campos[] = '`usuario_id_inserto`';
        $valores[] = '?';
        $params[] = $datos['usuario_id_inserto'];
        $tipos .= 'i';

        $campos[] = '`estado_cita_id`';
        $valores[] = '?';
        $params[] = $datos['estado_cita_id'] ?? 1;
        $tipos .= 'i';

        // Campos opcionales
        $camposOpcionales = [
            'motivo_consulta', 'av_sc_lejos_od', 'av_sc_lejos_oi', 'av_sc_cerca_od', 'av_sc_cerca_oi',
            'av_cc_lejos_od', 'av_cc_lejos_oi', 'av_cc_cerca_od', 'av_cc_cerca_oi',
            'examen_externo_od', 'examen_externo_oi', 'cover_test_vp', 'cover_test_vl',
            'fpc', 'dp', 'oftalmoscopia_od', 'oftalmoscopia_oi',
            'queratometria_od', 'queratometria_oi', 'retinoscopia_od', 'retinoscopia_oi',
            'subjetivo_od', 'subjetivo_oi', 'resultado_final_od', 'resultado_final_oi',
            'lentes_esferico_od', 'lentes_esferico_oi', 'lentes_cilindrico_od', 'lentes_cilindrico_oi',
            'lentes_eje_od', 'lentes_eje_oi', 'lentes_adicion', 'lentes_tratamientos',
            'filtro_color', 'proximo_control', 'proximo_control_motivo', 'origen_enfermedad',
            'fecha_inicio_sintomas', 'diagnostico_principal', 'diagnostico_secundario',
            'tratamiento', 'medicamentos_prescritos', 'recomendaciones',
            'observaciones_generales'
        ];

        // Pre-procesar fechas opcionales para evitar error de Incorrect date value: ''
        $camposFechas = ['proximo_control', 'fecha_inicio_sintomas'];
        foreach ($camposFechas as $f) {
            if (isset($datos[$f]) && $datos[$f] === '') {
                $datos[$f] = null;
            }
        }

        foreach ($camposOpcionales as $campo) {
            if (isset($datos[$campo]) && $datos[$campo] !== '') {
                $campos[] = "`$campo`";
                $valores[] = '?';
                $params[] = $datos[$campo];
                $tipos .= 's';
            }
        }

        // Campos opcionales que pueden ser NULL (IDs)
        $camposNullables = [
            'asistente_id' => 'i',
            'lentes_tipo_id' => 'i',
            'lentes_material_id' => 'i',
            'uso_lentes_id' => 'i',
            'tipo_origen_id' => 'i',
            'cie10_id' => 'i'
        ];

        foreach ($camposNullables as $campo => $tipo) {
            if (isset($datos[$campo])) {
                $campos[] = "`$campo`";
                $valores[] = '?';
                $params[] = empty($datos[$campo]) ? null : $datos[$campo];
                $tipos .= $tipo;
            }
        }

        $query = "INSERT INTO citas_control (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error preparando insert: " . $this->conexion->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($tipos, ...$params);
        }
        
        if ($stmt->execute()) {
            return $this->conexion->insert_id;
        }
        return false;
    }

    // Obtener una cita por ID
    public function obtenerPorId($id) {
        $sql = "SELECT cc.*, 
                       p.identificacion AS paciente_identificacion,
                       CONCAT(p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS paciente_nombre,
                       p.telefono_principal AS paciente_telefono,
                       f_anos(p.fecha_nacimiento) AS paciente_edad,
                       CONCAT(ps.primer_nombre, ' ', COALESCE(ps.segundo_nombre,''), ' ', ps.primer_apellido, ' ', COALESCE(ps.segundo_apellido,'')) AS profesional_nombre,
                       d.codigo AS cie10_codigo,
                       d.descripcion AS cie10_descripcion
                FROM citas_control cc
                JOIN pacientes p ON cc.paciente_id = p.id
                JOIN profesionales_salud ps ON cc.profesional_id = ps.id
                LEFT JOIN diagnosticos_cie10 d ON cc.cie10_id = d.id
                WHERE cc.id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            error_log("Error preparando consulta obtenerPorId: " . $this->conexion->error);
            return false;
        }
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            error_log("Error ejecutando consulta obtenerPorId: " . $stmt->error);
            return false;
        }
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    // Obtener todas las citas con paginación
    public function obtenerTodos($registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        $allowedColumns = ['`cc`.`id`', '`cc`.`fecha_cita`', '`cc`.`hora_cita`', '`p`.`identificacion`', '`p`.`primer_nombre`', '`tc`.`nombre`', '`ps`.`primer_nombre`', '`ec`.`nombre`'];
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `cc`.`id` DESC ";

        $sql = "SELECT cc.*, 
                       p.identificacion AS paciente_identificacion,
                       CONCAT(p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS paciente_nombre,
                       CONCAT(ps.primer_nombre, ' ', COALESCE(ps.segundo_nombre,''), ' ', ps.primer_apellido, ' ', COALESCE(ps.segundo_apellido,'')) AS profesional_nombre,
                       tc.nombre AS tipo_consulta_nombre,
                       ec.nombre AS estado_cita_nombre,
                       ec.color AS estado_cita_color
                FROM citas_control cc
                JOIN pacientes p ON cc.paciente_id = p.id
                JOIN profesionales_salud ps ON cc.profesional_id = ps.id
                LEFT JOIN tipos_consulta tc ON cc.tipo_consulta_id = tc.id
                LEFT JOIN estados_cita ec ON cc.estado_cita_id = ec.id
                $orderSQL
                LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('ii', $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $citas = [];
        while ($row = $resultado->fetch_assoc()) {
            $citas[] = $row;
        }
        return $citas;
    }

    // Contar total de citas
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM citas_control";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    public function contarRegistrosPorBusqueda($termino = '') {
        if (empty($termino)) return $this->contarRegistros();
        
        $sql = "SELECT COUNT(*) as total 
                FROM citas_control cc
                JOIN pacientes p ON cc.paciente_id = p.id
                JOIN profesionales_salud ps ON cc.profesional_id = ps.id
                LEFT JOIN tipos_consulta tc ON cc.tipo_consulta_id = tc.id
                LEFT JOIN estados_cita ec ON cc.estado_cita_id = ec.id
                WHERE CONVERT(CONCAT_WS(' ', 
                    cc.id, 
                    cc.fecha_cita, 
                    p.identificacion, 
                    p.primer_nombre, 
                    p.primer_apellido,
                    ps.primer_nombre,
                    ps.primer_apellido,
                    tc.nombre,
                    ec.nombre
                ) USING utf8mb4) LIKE ?";
        
        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $termino . '%';
        $stmt->bind_param('s', $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        $allowedColumns = ['`cc`.`id`', '`cc`.`fecha_cita`', '`cc`.`hora_cita`', '`p`.`identificacion`', '`p`.`primer_nombre`', '`tc`.`nombre`', '`ps`.`primer_nombre`', '`ec`.`nombre`'];
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `cc`.`id` DESC ";

        $sql = "SELECT cc.*, 
                       p.identificacion AS paciente_identificacion,
                       CONCAT(p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS paciente_nombre,
                       CONCAT(ps.primer_nombre, ' ', COALESCE(ps.segundo_nombre,''), ' ', ps.primer_apellido, ' ', COALESCE(ps.segundo_apellido,'')) AS profesional_nombre,
                       tc.nombre AS tipo_consulta_nombre,
                       ec.nombre AS estado_cita_nombre,
                       ec.color AS estado_cita_color
                FROM citas_control cc
                JOIN pacientes p ON cc.paciente_id = p.id
                JOIN profesionales_salud ps ON cc.profesional_id = ps.id
                LEFT JOIN tipos_consulta tc ON cc.tipo_consulta_id = tc.id
                LEFT JOIN estados_cita ec ON cc.estado_cita_id = ec.id
                WHERE CONVERT(CONCAT_WS(' ', 
                    cc.id, 
                    cc.fecha_cita, 
                    p.identificacion, 
                    p.primer_nombre, 
                    p.primer_apellido,
                    ps.primer_nombre,
                    ps.primer_apellido,
                    tc.nombre,
                    ec.nombre
                ) USING utf8mb4) LIKE ?
                $orderSQL
                LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $termino . '%';
        $stmt->bind_param('sii', $termino, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $citas = [];
        while ($row = $resultado->fetch_assoc()) {
            $citas[] = $row;
        }
        return $citas;
    }

    // Actualizar cita
    public function actualizar($id, $datos) {
        $actualizaciones = [];
        $tipos = '';
        $params = [];

        // Campos que siempre se actualizan
        if (isset($datos['fecha_cita'])) {
            $actualizaciones[] = "`fecha_cita` = ?";
            $params[] = $datos['fecha_cita'];
            $tipos .= 's';
        }

        if (isset($datos['hora_cita'])) {
            $actualizaciones[] = "`hora_cita` = ?";
            $params[] = $datos['hora_cita'];
            $tipos .= 's';
        }

        if (isset($datos['tipo_consulta_id'])) {
            $actualizaciones[] = "`tipo_consulta_id` = ?";
            $params[] = $datos['tipo_consulta_id'];
            $tipos .= 'i';
        }

        if (isset($datos['estado_cita_id'])) {
            $actualizaciones[] = "`estado_cita_id` = ?";
            $params[] = $datos['estado_cita_id'];
            $tipos .= 'i';
        }

        if (isset($datos['usuario_id_actualizo'])) {
            $actualizaciones[] = "`usuario_id_actualizo` = ?";
            $params[] = $datos['usuario_id_actualizo'];
            $tipos .= 'i';
        }

        // Todos los demás campos opcionales
        $camposOpcionales = [
            'motivo_consulta', 'av_sc_lejos_od', 'av_sc_lejos_oi', 'av_sc_cerca_od', 'av_sc_cerca_oi',
            'av_cc_lejos_od', 'av_cc_lejos_oi', 'av_cc_cerca_od', 'av_cc_cerca_oi',
            'examen_externo_od', 'examen_externo_oi', 'cover_test_vp', 'cover_test_vl',
            'fpc', 'dp', 'oftalmoscopia_od', 'oftalmoscopia_oi',
            'queratometria_od', 'queratometria_oi', 'retinoscopia_od', 'retinoscopia_oi',
            'subjetivo_od', 'subjetivo_oi', 'resultado_final_od', 'resultado_final_oi',
            'lentes_esferico_od', 'lentes_esferico_oi', 'lentes_cilindrico_od', 'lentes_cilindrico_oi',
            'lentes_eje_od', 'lentes_eje_oi', 'lentes_adicion', 'lentes_tratamientos',
            'filtro_color', 'proximo_control', 'proximo_control_motivo', 'origen_enfermedad',
            'fecha_inicio_sintomas', 'diagnostico_principal', 'diagnostico_secundario',
            'tratamiento', 'medicamentos_prescritos', 'recomendaciones',
            'observaciones_generales'
        ];

        // Pre-procesar fechas opcionales
        $camposFechas = ['proximo_control', 'fecha_inicio_sintomas'];
        foreach ($camposFechas as $f) {
            if (isset($datos[$f]) && $datos[$f] === '') {
                $datos[$f] = null;
            }
        }

        foreach ($camposOpcionales as $campo) {
            if (isset($datos[$campo])) {
                $actualizaciones[] = "`$campo` = ?";
                $params[] = $datos[$campo];
                $tipos .= 's';
            }
        }

        // Campos nullables
        $camposNullables = [
            'asistente_id' => 'i',
            'lentes_tipo_id' => 'i',
            'lentes_material_id' => 'i',
            'uso_lentes_id' => 'i',
            'tipo_origen_id' => 'i',
            'cie10_id' => 'i'
        ];

        foreach ($camposNullables as $campo => $tipo) {
            if (isset($datos[$campo])) {
                $actualizaciones[] = "`$campo` = ?";
                $params[] = empty($datos[$campo]) ? null : $datos[$campo];
                $tipos .= $tipo;
            }
        }

        if (empty($actualizaciones)) {
            return false;
        }

        $params[] = $id;
        $tipos .= 'i';

        $query = "UPDATE citas_control SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error preparando update: " . $this->conexion->error);
        }

        $stmt->bind_param($tipos, ...$params);
        return $stmt->execute();
    }

    // Eliminar cita
    public function eliminar($id) {
        $query = "DELETE FROM citas_control WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>
