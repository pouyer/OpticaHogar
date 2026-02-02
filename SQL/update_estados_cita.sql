
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

-- Actualiza la tabla eps
-- deshabilita las claves foraneas
SET FOREIGN_KEY_CHECKS = 0;
-- elimina datos actuales de la tabla eps
truncate table `eps`;
-- agrega columnas regimen y orden a la tabla eps
ALTER TABLE `eps` 
ADD COLUMN `regimen` varchar(50) DEFAULT null AFTER nombre,
ADD COLUMN `orden` int DEFAULT null AFTER email; 
-- inserta datos en la tabla eps

INSERT INTO `eps` (codigo,nombre,regimen,nit,telefono,email,estado,usuario_id_inserto) VALUES 
('EPS001', 'ALIANSALUD EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS002', 'SALUD TOTAL EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS005', 'EPS SANITAS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS008', 'COMPENSAR EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS010', 'EPS SURA', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS012', 'COMFENALCO VALLE EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS017', 'FAMISANAR EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS018', 'SERVICIO OCCIDENTAL DE SALUD EPS SOS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS023', 'CRUZ BLANCA EPS', 'Contributivo', NULL,NULL,NULL,'activo',1),
('EPS037', 'NUEVA EPS', 'Mixto', NULL,NULL,NULL,'activo',1),
('ESS024', 'COOSALUD EPS', 'Mixto', NULL,NULL,NULL,'activo',1),
('ESS207', 'MUTUAL SER EPS', 'Mixto', NULL,NULL,NULL,'activo',1),
('CCFC55', 'CAJACOPI ATLANTICO EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPS025', 'CAPRESOCA EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('CCFC20', 'COMFACHOCO EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('CCFC50', 'COMFAORIENTE EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('CCFC33', 'EPS FAMILIAR DE COLOMBIA', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('ESS062', 'ASMET SALUD EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('ESS118', 'EMSSANAR EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSS34', 'CAPITAL SALUD EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSS40', 'SAVIA SALUD EPS', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSIC1', 'DUSAKAWI EPSI', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSIC3', 'ASOCIACION INDIGENA DEL CAUCA EPSI', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSIC4', 'ANAS WAYUU EPSI', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSIC5', 'MALLAMAS EPSI', 'Subsidiado', NULL,NULL,NULL,'activo',1),
('EPSIC6', 'PIJAOS SALUD EPSI', 'Subsidiado', NULL,NULL,NULL,'activo',1);

-- habilita las claves foraneas
 SET FOREIGN_KEY_CHECKS = 1;