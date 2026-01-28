
-- Agregar columnas para control de citas
ALTER TABLE `estados_cita` 
ADD COLUMN `restringe_nueva_cita` boolean DEFAULT 0 COMMENT 'Indica si este estado impide crear nuevas citas',
ADD COLUMN `mostrar_en_hc` boolean DEFAULT 1 COMMENT 'Indica si las citas en este estado se muestran en la Historia Clínica';

-- Actualizar estados conocidos (IDS basados en análisis previo: 6=EN_PROCESO, 2=REALIZADA/PROGRAMADA - SE ASUME 2 COMO FINALIZADA SI NO HAY OTRO)
-- Si 6 es EN_PROCESO, debe restringir nueva cita y NO mostrarse en HC (o sí, depende del flujo).
-- Según requerimiento: "mientras el doctor esta digitando... en estado en proceso... cuando finaliza... pasa a programada"
-- "El sistema no debe permitir crear una nueva cita... si tiene citas en estados diferentes a cancelado, realizadas, no asistio"
-- O sea, EN_PROCESO restringe. PROGRAMADA (si es diferente a realizada) también restringiría si no está en la lista de excepciones.
-- Asumiremos IDs típicos o buscaremos confirmar. 
-- Por seguridad, haremos updates basados en nombres si es posible o asumiremos los IDs estándar.

-- Configuración inicial sugerida:
-- EN_PROCESO (ID 6): Restringe = 1, Mostrar en HC = 0 (o 1 si se quiere ver incompleta)
UPDATE `estados_cita` SET `restringe_nueva_cita` = 1, `mostrar_en_hc` = 1 WHERE `nombre` LIKE '%Proceso%';

-- PROGRAMADA (ID ?): Restringe = 1, Mostrar en HC = 1
UPDATE `estados_cita` SET `restringe_nueva_cita` = 1, `mostrar_en_hc` = 1 WHERE `nombre` LIKE '%Programada%';

-- REALIZADA (ID 2): Restringe = 0 (Permite nueva), Mostrar en HC = 1
UPDATE `estados_cita` SET `restringe_nueva_cita` = 0, `mostrar_en_hc` = 1 WHERE `nombre` LIKE '%Realizada%';

-- CANCELADA (ID ?): Restringe = 0, Mostrar en HC = 0
UPDATE `estados_cita` SET `restringe_nueva_cita` = 0, `mostrar_en_hc` = 0 WHERE `nombre` LIKE '%Cancelada%';

-- NO ASISTIO (ID ?): Restringe = 0, Mostrar en HC = 0
UPDATE `estados_cita` SET `restringe_nueva_cita` = 0, `mostrar_en_hc` = 0 WHERE `nombre` LIKE '%Asistio%';

