
-- CORRECCIÓN DE CÓDIGOS CUPS EN TABLA TIPOS_CONSULTA
-- El validador RIPS requiere códigos numéricos (ej. 890207), no textos como 'PRIMERA'

UPDATE tipos_consulta SET codigo = '890207' WHERE descripcion LIKE '%PRIMERA%' OR codigo = 'PRIMERA';
UPDATE tipos_consulta SET codigo = '890307' WHERE descripcion LIKE '%CONTROL%' OR codigo = 'CONTROL';
UPDATE tipos_consulta SET codigo = '890208' WHERE descripcion LIKE '%URGENCIA%' OR codigo = 'URGENCIA';

-- Verificación
SELECT * FROM tipos_consulta;
