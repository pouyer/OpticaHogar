-- Tablas para el módulo de generación de RIPS

CREATE TABLE IF NOT EXISTS `rips_generados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_doc_prestador` varchar(20) NOT NULL,
  `anio` int(4) NOT NULL,
  `mes` int(2) NOT NULL,
  `fecha_generacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `formato` enum('JSON', 'EXCEL') NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rips_periodo` (`num_doc_prestador`, `anio`, `mes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

CREATE TABLE IF NOT EXISTS `rips_generados_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rips_generado_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rips_detalles_id` (`rips_generado_id`),
  CONSTRAINT `fk_rips_detalles_id` FOREIGN KEY (`rips_generado_id`) REFERENCES `rips_generados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
