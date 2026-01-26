<?php
/**
 * Modelo para el Reporte Consolidado de Historia Clínica
 */
require_once '../conexion.php';

class ModeloReporteHistoria {
    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    /**
     * Obtiene la información completa de un paciente
     */
    public function obtenerDatosPaciente($paciente_id) {
        $sql = "SELECT p.*, 
                       CONCAT(p.primer_nombre, ' ', COALESCE(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', COALESCE(p.segundo_apellido,'')) AS nombre_completo,
                       f_anos(p.fecha_nacimiento) AS paciente_edad,
                       ti.codigo as tipo_identificacion_nombre,
                       g.nombre as genero_nombre,
                       gs.nombre as grupo_sanguineo_nombre,
                       e.nombre as eps_nombre,
                       o.nombre as ocupacion_nombre,
                       ec.nombre as estado_civil_nombre,
                       pa.nombre as parentesco_nombre,
                       ep.nombre as estado_paciente_nombre
                FROM pacientes p
                LEFT JOIN tipos_identificacion ti ON p.tipo_identificacion_id = ti.id
                LEFT JOIN generos g ON p.genero_id = g.id
                LEFT JOIN grupos_sanguineos gs ON p.grupo_sanguineo_id = gs.id
                LEFT JOIN eps e ON p.eps_id = e.id
                LEFT JOIN ocupaciones o ON p.ocupacion_id = o.id
                LEFT JOIN estados_civiles ec ON p.estado_civil_id = ec.id
                LEFT JOIN parentescos pa ON p.parentesco_id = pa.id
                LEFT JOIN estados_paciente ep ON p.estado_paciente_id = ep.id
                WHERE p.id = ?";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    /**
     * Obtiene la anamnesis del paciente
     */
    public function obtenerAnamnesis($paciente_id) {
        $sql = "SELECT * FROM anamnesis WHERE paciente_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    /**
     * Obtiene el historial de consultas (Evolución)
     */
    public function obtenerHistorialConsultas($paciente_id) {
        $sql = "SELECT cc.*, 
                       tc.nombre as tipo_consulta_nombre,
                       CONCAT(ps.primer_nombre, ' ', COALESCE(ps.segundo_nombre,''), ' ', ps.primer_apellido, ' ', COALESCE(ps.segundo_apellido,'')) as profesional_nombre,
                       ec.nombre as estado_nombre,
                       ec.color as estado_color,
                       d.codigo as cie10_codigo,
                       d.descripcion as cie10_descripcion
                FROM citas_control cc
                LEFT JOIN tipos_consulta tc ON cc.tipo_consulta_id = tc.id
                LEFT JOIN profesionales_salud ps ON cc.profesional_id = ps.id
                LEFT JOIN estados_cita ec ON cc.estado_cita_id = ec.id
                LEFT JOIN diagnosticos_cie10 d ON cc.cie10_id = d.id
                WHERE cc.paciente_id = ?
                ORDER BY cc.fecha_cita ASC, cc.hora_cita ASC";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('i', $paciente_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $historial = [];
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                $historial[] = $row;
            }
        }
        return $historial;
    }
}
