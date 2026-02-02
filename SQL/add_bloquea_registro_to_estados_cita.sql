-- Agregar campo bloquea_registro a la tabla estados_cita
ALTER TABLE estados_cita ADD COLUMN bloquea_registro TINYINT(1) DEFAULT 0 AFTER color;

-- Actualizar estados que deben bloquear el registro (Finalizado y Cancelado)
-- ID 2 suele ser REALIZADA/FINALIZADO según modelo_cita.php
UPDATE estados_cita SET bloquea_registro = 1 WHERE id = 2 OR nombre LIKE '%REALIZADA%' OR nombre LIKE '%FINALIZADO%';
UPDATE estados_cita SET bloquea_registro = 1 WHERE nombre LIKE '%CANCELADO%';
