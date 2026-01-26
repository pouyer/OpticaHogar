# Óptica Hogar - Sistema de Gestión

Este proyecto es una aplicación web para la gestión integral de una óptica, incluyendo el registro de pacientes, anamnesis (historias clínicas), control de citas y administración de parámetros.

## 🛠️ Tecnologías Utilizadas

- **Lenguaje:** PHP 8.x
- **Base de Datos:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript (Vanilla), Bootstrap 5
- **Iconografía:** Fontello
- **Arquitectura:** Modelo-Vista-Controlador (MVC) simple.

## 📁 Estructura del Proyecto

- `/accesos`: Gestión de seguridad, sesiones, roles y permisos de usuario.
- `/assets`: Recursos estáticos como imágenes y logos.
- `/config`: Archivos de configuración global de la aplicación.
- `/controladores`: Lógica de negocio y manejo de peticiones.
- `/css`: Estilos personalizados de la interfaz.
- `/modelos`: Interacción directa con la base de datos (Consultas SQL).
- `/vistas`: Interfaces de usuario (archivos PHP con HTML).
- `conexion.php`: Configuración de la conexión a la base de datos mediante variables de entorno.

## 🚀 Instalación y Configuración

1. **Servidor Local:** Se recomienda el uso de **XAMPP** o **Laragon** en Windows.
2. **Base de Datos:** 
   - Importar el archivo SQL proporcionado en el entorno.
   - La base de datos principal se denomina `opticaApp` (según configuración `.env`).
3. **Variables de Entorno:**
   - Crear un archivo `.env` en la raíz basado en `.env.example`.
   - Configurar los parámetros de conexión (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_PORT`).
4. **Acceso:** Abrir el navegador en `http://localhost/OpticaHogar`.

## 📋 Funcionalidades Principales

- **Gestión de Pacientes:** Registro detallado con secciones de Identificación, Ubicación y contacto de Acompañante.
- **Anamnesis:** Creación y seguimiento de historias clínicas oftalmológicas.
- **Parametrización:** Gestión de maestros como Países, EPS, Ocupaciones, Géneros, etc.
- **Seguridad:** Control de acceso por programas basado en los permisos asignados al rol del usuario.
- **Exportación:** Capacidad de exportar listados a Excel, CSV y TXT.

## 📝 Notas de Versión Recientes

- Implementación de selector de países vinculado dinámicamente.
- Reorganización de formularios de pacientes en secciones temáticas.
- Mejoras en la robustez de las búsquedas y exportaciones (Corrección de conflictos de Collation).
- Control de visibilidad de botones según permisos específicos por programa.

---
# autor: Carlos Mejía
© 2026 Óptica Hogar - Gestión Profesional.
