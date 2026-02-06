<?php
require 'conexion.php';
$sql = "CREATE OR REPLACE VIEW vw_rips_consultas AS 
SELECT
    cc.id AS cita_id,
    YEAR(cc.fecha_cita) AS anio,
    MONTH(cc.fecha_cita) AS mes,

    -- Prestador
    ps.codigo_prestador_minsalud AS cod_prestador,
    CONCAT(
        ps.primer_nombre, ' ',
        IFNULL(ps.segundo_nombre, ''), ' ',
        ps.primer_apellido, ' ',
        IFNULL(ps.segundo_apellido, '')
    ) AS razon_social_prestador,
    'PN' AS tipo_prestador,
    ps.identificacion AS num_doc_prestador,

    -- Paciente
    ti.codigo AS tipo_doc_paciente,
    p.identificacion AS num_doc_paciente,
    CONCAT(p.primer_nombre, ' ', IFNULL(p.segundo_nombre,''), ' ', p.primer_apellido, ' ', IFNULL(p.segundo_apellido,'')) AS nombre_paciente,
    p.fecha_nacimiento,
    g.codigo AS sexo,
    d.codigo_dane AS cod_departamento_residencia,
    m.codigo_dane AS cod_municipio_residencia,
    p.zona_residencia,
    r.codigo AS regimen,
    e.codigo AS eps_codigo,

    -- Consulta
    cc.fecha_cita AS fecha_inicio_atencion,
    tc.codigo AS cod_consulta,
    fc.codigo AS finalidad_consulta,
    ce.codigo AS causa_externa,
    dx.codigo AS cie10_principal,
    'I' AS tipo_diagnostico_principal,

    -- Valores
    cc.valor_consulta,
    cc.valor_cuota_moderadora,
    cc.valor_neto_pagar

FROM citas_control cc
JOIN pacientes p ON p.id = cc.paciente_id
JOIN profesionales_salud ps ON ps.id = cc.profesional_id
JOIN tipos_identificacion ti ON ti.id = p.tipo_identificacion_id
JOIN generos g ON g.id = p.genero_id
LEFT JOIN eps e ON e.id = p.eps_id
LEFT JOIN regimen r ON r.id = p.id_regimen
LEFT JOIN municipio m ON m.id = p.municipio_id
LEFT JOIN departamento d ON d.id = p.departamento_id
JOIN tipos_consulta tc ON tc.id = cc.tipo_consulta_id
JOIN diagnosticos_cie10 dx ON dx.id = cc.cie10_id
LEFT JOIN causa_externa ce ON ce.id = cc.causa_externa_id
LEFT JOIN finalidad_consulta fc ON fc.id = cc.finalidad_consulta_id
JOIN estados_cita EC ON  EC.id = cc.estado_cita_id 
WHERE EC.mostrar_en_hc = TRUE";

if ($conexion->query($sql)) {
    echo "Vista actualizada con éxito";
} else {
    echo "Error: " . $conexion->error;
}
?>
