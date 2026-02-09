-- Script simplificado para crear solo las tablas y vista RIPS
-- Ejecutar este archivo si el script PHP no funcionó correctamente

-- ================================================
-- PASO 1: Crear tablas de historial RIPS
-- ================================================

CREATE TABLE IF NOT EXISTS `rips_generados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_doc_prestador` varchar(20) DEFAULT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `formato` enum('JSON','EXCEL') NOT NULL,
  `fecha_generacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_periodo` (`anio`,`mes`),
  KEY `idx_prestador` (`num_doc_prestador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `rips_generados_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rips_generado_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rips_generado` (`rips_generado_id`),
  KEY `fk_cita` (`cita_id`),
  CONSTRAINT `fk_rips_generado` FOREIGN KEY (`rips_generado_id`) REFERENCES `rips_generados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ================================================
-- PASO 2: Crear/Actualizar vista RIPS
-- ================================================

DROP VIEW IF EXISTS `vw_rips_consultas`;

CREATE VIEW `vw_rips_consultas` AS
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
JOIN estados_cita EC ON EC.id = cc.estado_cita_id 
WHERE EC.mostrar_en_hc = TRUE;

-- ================================================
-- VERIFICACIÓN
-- ================================================
-- Ejecutar estas consultas para verificar:

-- SELECT COUNT(*) FROM rips_generados;
-- SELECT COUNT(*) FROM rips_generados_detalles;
-- SELECT COUNT(*) FROM vw_rips_consultas;
-- SHOW CREATE VIEW vw_rips_consultas;
