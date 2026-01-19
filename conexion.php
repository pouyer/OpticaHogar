<?php
    /**
     * Carga variables de entorno desde un archivo .env
     */
    if (!function_exists('cargar_env')) {
        function cargar_env($ruta) {
            if (!file_exists($ruta)) {
                return false;
            }
            $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lineas as $linea) {
                if (strpos(trim($linea), '#') === 0) continue;
                list($nombre, $valor) = explode('=', $linea, 2);
                $nombre = trim($nombre);
                $valor = trim($valor);
                putenv(sprintf('%s=%s', $nombre, $valor));
                $_ENV[$nombre] = $valor;
                $_SERVER[$nombre] = $valor;
            }
            return true;
        }
    }

    // Cargar variables del .env
    cargar_env(__DIR__ . '/.env');

    // Configurar Zona Horaria
    date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'UTC');

    $host = getenv('DB_HOST') ?: 'localhost';
    $usuario = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $database = getenv('DB_NAME');
    $puerto = getenv('DB_PORT') ?: 3306;

    $conexion = new mysqli($host, $usuario, $password, $database, $puerto);

    if ($conexion->connect_error) {
        die('Error en la conexión (' . $conexion->connect_errno . '): ' . $conexion->connect_error);
    }

    $conexion->set_charset('utf8mb4');

    // Sincronizar zona horaria con la base de datos
    $ahora = new DateTime();
    $offset = $ahora->format('P');
    $conexion->query("SET time_zone='$offset'");
?>