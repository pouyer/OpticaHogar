-- Agregar columna 'visible' a la tabla 'estados_paciente'
-- Esta columna controlará si los pacientes con este estado se muestran por defecto en el listado.

ALTER TABLE `estados_paciente` 
ADD COLUMN `visible` TINYINT(1) NOT NULL DEFAULT 1 AFTER `orden`;

-- Comentario para documentación
ALTER TABLE `estados_paciente` 
MODIFY COLUMN `visible` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '0: Oculto por defecto, 1: Visible por defecto';
