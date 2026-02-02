<?php
require_once '../config/config.php';
require_once '../modelos/modelo_pacientes.php';
if (file_exists('../modelos/modelo_acc_log.php')) {
    require_once '../modelos/modelo_acc_log.php';
} elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
    require_once '../accesos/modelos/modelo_acc_log.php';
}

class ControladorPacientes {
    private $modelo;
    private $modeloLog;
    private $es_vista;

    // Constructor
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->modelo = new ModeloPacientes();
        $this->modeloLog = new ModeloAcc_log();
        $this->es_vista = false;
        
        // Cargar permisos
        $this->permisos = $_SESSION['permisos']['vista_pacientes.php'] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];
    }

    private function verificarPermiso($clave) {
        if (!isset($this->permisos[$clave]) || !$this->permisos[$clave]) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No tiene permisos para realizar esta acción']);
            exit;
        }
    }

    // Método para crear un nuevo registro    
    public function crear($datos) {
        try {
            file_put_contents(dirname(__FILE__) . '/debug_pacientes.log', "[" . date('Y-m-d H:i:s') . "] Intentando crear con datos: " . json_encode($datos) . "\n", FILE_APPEND);
            $this->verificarPermiso('ins');
            $resultado = $this->modelo->crear($datos);
            file_put_contents(dirname(__FILE__) . '/debug_pacientes.log', "[" . date('Y-m-d H:i:s') . "] Resultado del modelo: " . var_export($resultado, true) . "\n", FILE_APPEND);
            if ($resultado !== false && $resultado !== null) {
                $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'CREATE', 'pacientes', 'Nuevo registro creado');
                return ['success' => true, 'id' => $resultado];
            }
            return false;
        } catch (Throwable $e) {
            file_put_contents(dirname(__FILE__) . '/debug_pacientes.log', "[" . date('Y-m-d H:i:s') . "] EXCEPTION en crear: " . $e->getMessage() . "\n", FILE_APPEND);
            error_log("Error en ControladorPacientes::crear: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    // Método para actualizar un registro
    public function actualizar($id, $datos) {
        try {
            $this->verificarPermiso('upd');
            $resultado = $this->modelo->actualizar($id, $datos);
            if ($resultado) {
                $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'UPDATE', 'pacientes', 'Registro actualizado ID: ' . $id);
                return ['success' => true];
            }
            return false;
        } catch (Throwable $e) {
            error_log("Error en ControladorPacientes::actualizar: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    // Método para eliminar un registro
    public function eliminar($id) {
        $this->verificarPermiso('del');
        $resultado = $this->modelo->eliminar($id);
        if ($resultado) {
            $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'DELETE', 'pacientes', 'Registro eliminado ID: ' . $id);
        }
        return $resultado;
    }

    // Método para obtener todos los registros
    public function obtenerTodos($registrosPorPagina, $pagina, $orderBy = null, $orderDir = 'DESC', $verTodos = false) {
        $offset = ($pagina - 1) * $registrosPorPagina;
        return $this->modelo->obtenerTodos($registrosPorPagina, $offset, $orderBy, $orderDir, $verTodos);
    }

    // Método para obtener un registro por ID
    public function obtenerPorId($id) {
        return $this->modelo->obtenerPorId($id);
    }

    // Método para buscar registros
    public function buscar($termino, $registrosPorPagina, $offset, $verTodos = false) {
        return $this->modelo->buscar($termino, $registrosPorPagina, $offset, null, 'DESC', $verTodos);
    }

    // Método para contar registros encontrados en la busqueda
    public function contarRegistrosPorBusqueda($termino, $verTodos = false) {
         return $this->modelo->contarRegistrosPorBusqueda($termino, $verTodos);
    }

    public function contarPorCampo($campo, $valor, $verTodos = false) {
        return $this->modelo->contarPorCampo($campo, $valor, $verTodos);
    }

    public function buscarPorCampo($campo, $valor, $registrosPorPagina, $offset, $verTodos = false) {
        return $this->modelo->buscarPorCampo($campo, $valor, $registrosPorPagina, $offset, null, 'DESC', $verTodos);
    }

    // funcion exportar en formatos Exel, CSV, TXT
    public function exportar($formato) {
        $this->verificarPermiso('exp');
        try {
            $termino = $_GET['busqueda'] ?? '';
            $campo = $_GET['campo'] ?? '';
            $verTodos = (isset($_GET['verTodos']) && $_GET['verTodos'] == '1');
            
            $logMsg = "Exportación a formato: $formato";
            if ($campo && $termino) {
                $logMsg .= " (Filtro: $campo = $termino)";
            } elseif ($termino) {
                $logMsg .= " (Búsqueda general: $termino)";
            }
            if ($verTodos) $logMsg .= " (Ver todos los estados)";
            
            $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'EXPORT', 'pacientes', $logMsg);
            
            $datos = $this->modelo->exportarDatos($termino, $campo, $verTodos);
            if ($datos === false) {
                throw new Exception('Error al obtener los datos para exportar');
            }
            if (empty($datos)) {
                throw new Exception('No hay datos para exportar');
            }

            $timestamp = date('Y-m-d_H-i-s');
            $filename = "pacientes_export_{$timestamp}";
            if (!empty($termino)) {
                $filename .= "_busqueda_" . preg_replace('/[^a-zA-Z0-9]/', '_', $termino);
            }

            switch ($formato) {
                case 'excel':
                    header('Content-Type: application/vnd.ms-excel');
                    header("Content-Disposition: attachment; filename=\"$filename.xls\"");
                    $this->exportarExcel($datos);
                    break;

                case 'csv':
                    header('Content-Type: text/csv; charset=utf-8');
                    header("Content-Disposition: attachment; filename=\"$filename.csv\"");
                    $this->exportarCSV($datos);
                    break;

                case 'txt':
                    header('Content-Type: text/plain; charset=utf-8');
                    header("Content-Disposition: attachment; filename=\"$filename.txt\"");
                    $this->exportarTXT($datos);
                    break;
                default:
                    throw new Exception('Formato de exportación no válido');
            }
        } catch (Exception $e) {
            error_log('Error en exportación: ' . $e->getMessage());
            echo 'Error: ' . $e->getMessage();
            exit;
        }
        exit;
    }

    private function exportarExcel($datos) {
        // El formato Unicode UTF-16LE es el más compatible con Excel para caracteres especiales
        if (!empty($datos)) {
            $columnas = array_keys($datos[0]);
            $salida = implode("\t", $columnas) . "\n";
            
            foreach ($datos as $fila) {
                $salida .= implode("\t", $fila) . "\n";
            }
            
            // Enviamos el BOM para UTF-16LE
            echo "\xFF\xFE";
            // Convertimos la cadena de UTF-8 a UTF-16LE
            echo mb_convert_encoding($salida, 'UTF-16LE', 'UTF-8');
        }
    }

    private function exportarCSV($datos) {
        echo "\xEF\xBB\xBF"; // Add BOM for Excel UTF-8
        $output = fopen('php://output', 'w');
        if (!empty($datos)) {
            fputcsv($output, array_keys($datos[0]));
        }
        foreach ($datos as $fila) {
            fputcsv($output, $fila);
        }
        fclose($output);
    }

    private function exportarTXT($datos) {
        echo "\xEF\xBB\xBF"; // Add BOM for Excel UTF-8
        if (!empty($datos)) {
            echo implode("\t", array_keys($datos[0])) . "\n";
            foreach ($datos as $fila) {
                echo implode("\t", $fila) . "\n";
            }
        }
    }
}

// Manejo de las acciones
$accion = $_GET['action'] ?? '';
$controlador = new ControladorPacientes();

switch ($accion) {
    case 'crear':
        file_put_contents(dirname(__FILE__) . '/debug_pacientes.log', "[" . date('Y-m-d H:i:s') . "] ACCION CREAR RECIBIDA. POST: " . json_encode($_POST) . "\n", FILE_APPEND);
        /* if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            echo json_encode(['error' => 'Token CSRF inválido']);
            exit;
        } */
        $datos = $_POST;
        unset($datos['csrf_token']);
        
        $datos['usuario_id_inserto'] = $_SESSION['usuario_id'] ?? 0;
        $datos['usuario_id_actualizo'] = $_SESSION['usuario_id'] ?? 0;
        
        $resultado = $controlador->crear($datos);
        
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
        break;

    case 'actualizar':
        /* if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            echo json_encode(['error' => 'Token CSRF inválido']);
            exit;
        } */
        $id = $_POST['idActualizar'] ?? $_POST['id'];
        $datos = $_POST;
        unset($datos['csrf_token'], $datos['id'], $datos['idActualizar']);
        
        $datos['usuario_id_actualizo'] = $_SESSION['usuario_id'] ?? 0;
        $resultado = $controlador->actualizar($id, $datos);
        
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
        break;

    case 'eliminar':
        /* if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            echo json_encode(['error' => 'Token CSRF inválido']);
            exit;
        } */
        $id = $_POST['id'];
        $resultado = $controlador->eliminar($id);
        echo json_encode($resultado);
        break;

    case 'buscar':
        $termino = $_GET['busqueda'] ?? '';
        $campoFiltro = $_GET['campo'] ?? '';
        $registrosPorPagina = $_GET['registrosPorPagina'] ?? 10;
        $paginaActual = $_GET['pagina'] ?? 1;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        
        $verTodos = (isset($_GET['verTodos']) && $_GET['verTodos'] == '1');
        
        if (!empty($campoFiltro) && !empty($termino)) {
            $totalRegistros = $controlador->contarPorCampo($campoFiltro, $termino, $verTodos);
            $resultado = $controlador->buscarPorCampo($campoFiltro, $termino, $registrosPorPagina, $offset, $verTodos);
        } else {
            $totalRegistros = $controlador->contarRegistrosPorBusqueda($termino, $verTodos);
            $resultado = $controlador->buscar($termino, $registrosPorPagina, $offset, $verTodos);
        }
        
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        // Aquí debes incluir la vista con los resultados
        include '../vistas/vista_pacientes.php';
        break;

    case 'exportar':
        $formato = $_GET['formato'] ?? 'excel';
        $controlador->exportar($formato);
        break;

    default:
        $registrosPorPagina = (int)($_GET['registrosPorPagina'] ?? 15);
        $paginaActual = (int)($_GET['pagina'] ?? 1);
        $sort = $_GET['sort'] ?? null;
        $dir = $_GET['dir'] ?? 'DESC';
        $verTodos = (isset($_GET['verTodos']) && $_GET['verTodos'] == '1');
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $registros = $controlador->obtenerTodos($registrosPorPagina, $paginaActual, $sort, $dir, $verTodos);
        $totalRegistros = $controlador->modelo->contarRegistros($verTodos);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        include '../vistas/vista_pacientes.php';
        break;
}
