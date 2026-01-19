<?php
/**
        * Archivo de configuración global
        * Contiene constantes y variables de configuración del sistema
        */
       
       // Información de versión
       define('APP_VERSION', '1.0.2');
       define('APP_VERSION_DATE', '2026-01-14 ');
       define('APP_NAME', 'Óptica del Hogar');
       
       // Otras configuraciones globales pueden agregarse aquí
       // define('BASE_URL', 'http://localhost/opticahogar/');
       // define('DEBUG_MODE', false);
       
       /**
        * Función para obtener información completa de la versión
        * @return string Información formateada de la versión
        */
       function getVersionInfo() {
           return APP_NAME . ' v' . APP_VERSION . ' (' . APP_VERSION_DATE . ')';
       }

       /**
        * Generar token CSRF
        * @return string Token CSRF
        */
       function generateCSRFToken() {
           if (empty($_SESSION['csrf_token'])) {
               $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
           }
           return $_SESSION['csrf_token'];
       }

       /**
        * Verificar token CSRF
        * @param string $token Token a verificar
        * @return bool True si es válido
        */
       function verifyCSRFToken($token) {
           return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
       }