<?php
// Asegurar que la conexión esté disponible
require_once '../conexion.php';
require_once '../modelos/modelo_cita.php';
if (file_exists('../modelos/modelo_acc_log.php')) {
    require_once '../modelos/modelo_acc_log.php';
} elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
    require_once '../accesos/modelos/modelo_acc_log.php';
}

class ControladorCita {
    private $modelo;
    private $modeloLog;
    private $permisos;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->modelo = new ModeloCita();
        $this->modeloLog = new ModeloAcc_log();
        
        // Cargar permisos
        $this->permisos = $_SESSION['permisos']['vista_cita.php'] ?? ['ins' => 1, 'upd' => 1, 'del' => 1, 'exp' => 1];
    }

    private function verificarPermiso($clave) {
        if (!isset($this->permisos[$clave]) || !$this->permisos[$clave]) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No tiene permisos para realizar esta acción']);
            exit;
        }
    }

    // Método para crear un nuevo registro
    public function crear() {
        $this->verificarPermiso('ins');
        
        // Inicializar todas las variables necesarias primero
        try {
            $datos = [
                'tiposConsulta' => $this->modelo->getTiposConsulta(),
                'tiposLente' => $this->modelo->getTiposLentes(),
                'materiales' => $this->modelo->getMaterialesLentes(),
                'usos' => $this->modelo->getUsosLentes(),
                'tiposOrigen' => $this->modelo->getTiposOrigenEnfermedad(),
                'estadosCita' => $this->modelo->getEstadosCita(),
                'asistentes' => $this->modelo->getAsistentes(),
            ];
        } catch (Exception $e) {
            error_log("Error cargando catálogos: " . $e->getMessage());
            // Inicializar arrays vacíos para evitar errores
            $datos = [
                'tiposConsulta' => [],
                'tiposLente' => [],
                'materiales' => [],
                'usos' => [],
                'tiposOrigen' => [],
                'estadosCita' => [],
                'asistentes' => [],
            ];
        }
        
        // Verificar que el usuario esté asociado a un profesional
        $profesional = $this->modelo->getProfesionalByUsuario($_SESSION['usuario_id'] ?? 0);
        if (!$profesional) {
            $datos['error'] = 'El usuario no está asociado a un profesional activo. Contacte al administrador.';
            // Crear profesional por defecto para evitar errores en la vista
            $datos['profesional_logueado'] = [
                'id' => 0,
                'primer_nombre' => 'No',
                'primer_apellido' => 'Asignado',
                'especialidad' => 'N/A'
            ];
            return $datos;
        }

        $datos['profesional_logueado'] = $profesional;

        // --- PRE-CARGA DE PACIENTE (Desde Reporte) ---
        if (isset($_GET['paciente_id']) && !isset($cita)) {
            $pac_id = (int)$_GET['paciente_id'];
            $sql_pac = "SELECT id, identificacion, CONCAT(primer_nombre, ' ', COALESCE(segundo_nombre,''), ' ', primer_apellido, ' ', COALESCE(segundo_apellido,'')) as nombre_completo, telefono_principal, f_anos(fecha_nacimiento) as edad_texto FROM pacientes WHERE id = ?";
            $stmt_pac = $this->modelo->getConexion()->prepare($sql_pac);
            $stmt_pac->bind_param('i', $pac_id);
            $stmt_pac->execute();
            $res_pac = $stmt_pac->get_result()->fetch_assoc();
            
            if ($res_pac) {
                // Simular estructura de cita para que la vista lo reconozca como pre-cargado
                $datos['paciente_precargado'] = [
                    'id' => $res_pac['id'],
                    'nombre' => $res_pac['nombre_completo'],
                    'identificacion' => $res_pac['identificacion'],
                    'telefono' => $res_pac['telefono_principal'],
                    'edad' => $res_pac['edad_texto']
                ];
                
                // Determinar tipo de consulta automáticamente
                $datos['tipo_consulta_sugerido'] = $this->modelo->tieneCitasPrevias($pac_id) ? 2 : 1; // 2=Control, 1=Primera
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['id'])) {
            $post = $_POST;
            $post['profesional_id'] = $profesional['id'];
            $post['usuario_id_inserto'] = $_SESSION['usuario_id'] ?? 0;
            // Estado por defecto: 6 (EN_PROCESO)
            $post['estado_cita_id'] = !empty($post['estado_cita_id']) ? $post['estado_cita_id'] : 6;

            // Campos que pueden ser NULL
            $nullables = ['asistente_id', 'lentes_tipo_id', 'lentes_material_id', 'uso_lentes_id', 'tipo_origen_id', 'cie10_id'];
            foreach ($nullables as $campo) {
                $post[$campo] = empty($post[$campo]) ? null : $post[$campo];
            }

            try {
                if ($this->modelo->guardarCita($post)) {
                    $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'CREATE', 'citas_control', 'Nueva cita creada - Paciente ID: ' . $post['paciente_id']);
                    $datos['mensaje'] = "Control optométrico guardado exitosamente.";
                    $datos['tipo_alerta'] = "success";
                } else {
                    $datos['mensaje'] = "Error al guardar el control.";
                    $datos['tipo_alerta'] = "danger";
                }
            } catch (Exception $e) {
                $datos['mensaje'] = "Error: " . $e->getMessage();
                $datos['tipo_alerta'] = "danger";
            }
        }

        return $datos;
    }

    // Método para verificar si un paciente tiene citas previas (AJAX)
    public function verificarCitas($paciente_id) {
        $tiene = $this->modelo->tieneCitasPrevias($paciente_id);
        header('Content-Type: application/json');
        echo json_encode(['tiene_citas' => $tiene]);
        exit;
    }

    // Método para actualizar un registro
    public function actualizar($id, $datos) {
        $this->verificarPermiso('upd');
        
        // Verificar estado actual de la cita antes de actualizar
        $citaActual = $this->modelo->obtenerPorId($id);
        if ($citaActual && $citaActual['estado_cita_id'] == 2) { // 2 = REALIZADA
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No se puede modificar una cita que ya ha sido REALIZADA.']);
            exit;
        }

        $datos['usuario_id_actualizo'] = $_SESSION['usuario_id'] ?? 0;
        
        // Campos que pueden ser NULL
        $nullables = ['asistente_id', 'lentes_tipo_id', 'lentes_material_id', 'uso_lentes_id', 'tipo_origen_id', 'cie10_id'];
        foreach ($nullables as $campo) {
            if (isset($datos[$campo])) {
                $datos[$campo] = empty($datos[$campo]) ? null : $datos[$campo];
            }
        }

        try {
            $resultado = $this->modelo->actualizar($id, $datos);
            if ($resultado) {
                $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'UPDATE', 'citas_control', 'Cita actualizada ID: ' . $id);
            }
            return $resultado;
        } catch (Exception $e) {
            error_log('Error al actualizar cita: ' . $e->getMessage());
            return false;
        }
    }

    // Método para eliminar un registro
    public function eliminar($id) {
        $this->verificarPermiso('del');
        
        try {
            $resultado = $this->modelo->eliminar($id);
            if ($resultado) {
                $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'DELETE', 'citas_control', 'Cita eliminada ID: ' . $id);
            }
            return $resultado;
        } catch (Exception $e) {
            error_log('Error al eliminar cita: ' . $e->getMessage());
            return false;
        }
    }

    // Método para obtener todos los registros
    public function obtenerTodos($registrosPorPagina, $pagina) {
        $offset = ($pagina - 1) * $registrosPorPagina;
        return $this->modelo->obtenerTodos($registrosPorPagina, $offset);
    }

    // Método para obtener un registro por ID
    public function obtenerPorId($id) {
        return $this->modelo->obtenerPorId($id);
    }

    // Método para verificar si la cita es editable
    public function esEditable($id) {
        $cita = $this->modelo->obtenerPorId($id);
        return ($cita && $cita['estado_cita_id'] != 2); // != REALIZADA
    }

    // Método para obtener datos para editar
    public function editar($id) {
        $this->verificarPermiso('upd');
        
        $cita = $this->modelo->obtenerPorId($id);
        if (!$cita) {
            return ['error' => 'Cita no encontrada'];
        }

        try {
            $datos = [
                'cita' => $cita,
                'tiposConsulta' => $this->modelo->getTiposConsulta(),
                'tiposLente' => $this->modelo->getTiposLentes(),
                'materiales' => $this->modelo->getMaterialesLentes(),
                'usos' => $this->modelo->getUsosLentes(),
                'tiposOrigen' => $this->modelo->getTiposOrigenEnfermedad(),
                'estadosCita' => $this->modelo->getEstadosCita(),
                'asistentes' => $this->modelo->getAsistentes(),
                'profesional_logueado' => $this->modelo->getProfesionalByUsuario($_SESSION['usuario_id'] ?? 0)
            ];
        } catch (Exception $e) {
            error_log("Error cargando catálogos en editar: " . $e->getMessage());
            // Inicializar arrays vacíos para evitar errores
            $datos = [
                'cita' => $cita,
                'tiposConsulta' => [],
                'tiposLente' => [],
                'materiales' => [],
                'usos' => [],
                'tiposOrigen' => [],
                'estadosCita' => [],
                'asistentes' => [],
                'profesional_logueado' => null
            ];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $post = $_POST;
            $postId = $post['id'];
            unset($post['id']);
            $post['usuario_id_actualizo'] = $_SESSION['usuario_id'] ?? 0;

            // Campos que pueden ser NULL
            $nullables = ['asistente_id', 'lentes_tipo_id', 'lentes_material_id', 'uso_lentes_id', 'tipo_origen_id', 'cie10_id'];
            foreach ($nullables as $campo) {
                if (isset($post[$campo])) {
                    $post[$campo] = empty($post[$campo]) ? null : $post[$campo];
                }
            }

            try {
                // Verificar si es editable antes de intentar actualizar
                if (!$this->esEditable($postId)) {
                     $datos['mensaje'] = "No se puede actualizar una cita en estado REALIZADA.";
                     $datos['tipo_alerta'] = "danger";
                } else if ($this->modelo->actualizar($postId, $post)) {
                    $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'UPDATE', 'citas_control', 'Cita actualizada ID: ' . $postId);
                    $datos['mensaje'] = "Cita actualizada exitosamente.";
                    $datos['tipo_alerta'] = "success";
                    // Recargar datos actualizados
                    $datos['cita'] = $this->modelo->obtenerPorId($postId);
                    // Asegurar que profesional_logueado esté presente
                    if (!isset($datos['profesional_logueado']) || !$datos['profesional_logueado']) {
                        $datos['profesional_logueado'] = $this->modelo->getProfesionalByUsuario($_SESSION['usuario_id'] ?? 0);
                    }
                } else {
                    $datos['mensaje'] = "Error al actualizar la cita.";
                    $datos['tipo_alerta'] = "danger";
                }
            } catch (Exception $e) {
                $datos['mensaje'] = "Error: " . $e->getMessage();
                $datos['tipo_alerta'] = "danger";
            }
        }

        // Asegurar que profesional_logueado siempre esté presente
        if (!isset($datos['profesional_logueado']) || !$datos['profesional_logueado']) {
            $profesional = $this->modelo->getProfesionalByUsuario($_SESSION['usuario_id'] ?? 0);
            if ($profesional) {
                $datos['profesional_logueado'] = $profesional;
            } else {
                // Si no hay profesional, crear uno por defecto para evitar errores
                $datos['profesional_logueado'] = [
                    'id' => 0,
                    'primer_nombre' => 'No',
                    'primer_apellido' => 'Asignado',
                    'especialidad' => 'N/A'
                ];
            }
        }

        return $datos;
    }

    // Método para listar citas
    public function listar() {
        $registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
        $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        
        $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'VIEW', 'citas_control', 'Acceso a la pantalla de listado de citas');
        
        return [
            'registros' => $this->obtenerTodos($registrosPorPagina, $paginaActual),
            'totalRegistros' => $this->modelo->contarRegistros(),
            'registrosPorPagina' => $registrosPorPagina,
            'paginaActual' => $paginaActual
        ];
    }
}

// Manejo de las acciones
$accion = $_GET['action'] ?? '';
$controlador = new ControladorCita();

switch ($accion) {
    case 'crear':
        $datos = $controlador->crear();
        extract($datos);
        include '../vistas/vista_cita.php';
        break;

    case 'editar':
        $id = $_GET['id'] ?? 0;
        if (!$id) {
            header('Location: vista_cita.php?action=listar');
            exit;
        }
        $datos = $controlador->editar($id);
        extract($datos);
        include '../vistas/vista_cita.php';
        break;

    case 'actualizar':
        $id = $_POST['id'];
        $datos = $_POST;
        unset($datos['id']);
        $resultado = $controlador->actualizar($id, $datos);
        echo json_encode(['success' => $resultado]);
        break;

    case 'eliminar':
        $id = $_POST['id'];
        $resultado = $controlador->eliminar($id);
        echo json_encode(['success' => $resultado]);
        break;

    case 'verificar_citas':
        $id = $_GET['paciente_id'] ?? 0;
        $controlador->verificarCitas($id);
        break;

    case 'listar':
        $datos = $controlador->listar();
        extract($datos);
        $action = 'listar';
        include '../vistas/vista_cita.php';
        break;

    default:
        // Por defecto mostrar formulario de creación
        $datos = $controlador->crear();
        extract($datos);
        include '../vistas/vista_cita.php';
        break;
}
?>
