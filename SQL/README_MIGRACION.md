# 📋 Guía de Migración - Módulo RIPS

## ⚠️ IMPORTANTE - Antes de Comenzar

1. **HACER BACKUP** de la base de datos completa
2. Verificar que está conectado a la base de datos correcta
3. Tener acceso de administrador a la base de datos

## 🚀 Método 1: Ejecutar desde PHP (Recomendado para Producción)

### Pasos:

1. **Subir archivos al servidor**
   - Copiar toda la carpeta `SQL/` al servidor de producción
   - Asegurarse de que `ejecutar_migracion.php` esté en la carpeta `SQL/`

2. **Configurar la clave de seguridad**
   - Abrir `ejecutar_migracion.php`
   - Cambiar la línea: `define('CLAVE_MIGRACION', 'RIPS_2024_SEGURA');`
   - Usar una clave única y segura

3. **Ejecutar la migración**
   - Abrir en el navegador: `http://tu-servidor.com/OpticaHogar/SQL/ejecutar_migracion.php?clave=TU_CLAVE_SEGURA`
   - Reemplazar `TU_CLAVE_SEGURA` con la clave que configuraste

4. **Verificar resultados**
   - Revisar el reporte en pantalla
   - Verificar que no haya errores críticos

5. **ELIMINAR el archivo de migración**
   ```bash
   rm SQL/ejecutar_migracion.php
   ```
   O eliminarlo manualmente por FTP/SSH por seguridad

## 🔧 Método 2: Ejecutar desde MySQL/phpMyAdmin

### Opción A: phpMyAdmin

1. Acceder a phpMyAdmin
2. Seleccionar la base de datos
3. Ir a la pestaña "SQL"
4. Hacer clic en "Importar archivo"
5. Seleccionar y ejecutar en orden:
   - `crear_tablas_rips.sql`
   - `actualizar_para_RIPS.sql`

### Opción B: Línea de comandos MySQL

```bash
# Conectar a MySQL
mysql -u usuario -p nombre_base_datos

# Ejecutar scripts en orden
source /ruta/completa/crear_tablas_rips.sql;
source /ruta/completa/actualizar_para_RIPS.sql;
```

### Opción C: Comando directo

```bash
mysql -u usuario -p nombre_base_datos < crear_tablas_rips.sql
mysql -u usuario -p nombre_base_datos < actualizar_para_RIPS.sql
```

## ✅ Verificación Post-Migración

Ejecutar estas consultas para verificar que todo se creó correctamente:

```sql
-- Verificar tablas nuevas
SHOW TABLES LIKE 'rips_%';

-- Verificar vista
SHOW CREATE VIEW vw_rips_consultas;

-- Verificar datos de prueba
SELECT COUNT(*) FROM vw_rips_consultas;
```

## 📦 Archivos de Migración

1. **crear_tablas_rips.sql**
   - Crea las tablas: `rips_generados` y `rips_generados_detalles`
   - Tablas para el historial de generaciones

2. **actualizar_para_RIPS.sql**
   - Crea/actualiza la vista `vw_rips_consultas`
   - Incluye todos los campos necesarios para RIPS

## 🔍 Solución de Problemas

### Error: "Table already exists"
- **Solución**: Normal si ya ejecutó el script antes. Puede ignorarse.

### Error: "Access denied"
- **Solución**: Verificar permisos del usuario de base de datos
- Necesita permisos: CREATE, ALTER, DROP, INSERT, SELECT

### Error: "Unknown column"
- **Solución**: Verificar que la tabla `citas_control` tenga todos los campos necesarios
- Ejecutar primero las migraciones anteriores del sistema

### Error de conexión
- **Solución**: Verificar archivo `conexion.php`
- Verificar credenciales de base de datos

## 🔐 Seguridad

- ✅ Cambiar la clave de seguridad en producción
- ✅ Eliminar `ejecutar_migracion.php` después de usarlo
- ✅ No compartir la clave de migración
- ✅ Hacer backup antes de ejecutar

## 📞 Soporte

Si encuentra problemas durante la migración:
1. Revisar los logs de error de MySQL
2. Verificar que todas las tablas dependientes existan
3. Contactar al administrador del sistema
