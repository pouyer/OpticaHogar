<?php
require_once '../config/config.php';
require_once '../modelos/modelo_cita.php';
if (file_exists('../modelos/modelo_acc_log.php')) {
    require_once '../modelos/modelo_acc_log.php';
} elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
    require_once '../accesos/modelos/modelo_acc_log.php';
}

class ControladorFormulaMedica {
    private $modelo;
    private $modeloLog;
    private $permisos;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->modelo = new ModeloCita();
        $this->modeloLog = new ModeloAcc_log();
        
        // El programa para el cual verificaremos permisos es 'vista_formula_reporte.php'
        $this->permisos = $_SESSION['permisos']['vista_formula_reporte.php'] ?? null;
    }

    private function verificarPermiso() {
        if (!$this->permisos) {
            die("No tiene permisos para acceder a esta fórmula médica.");
        }
    }

    public function verReporte($cita_id, $formato = 'html') {
        $this->verificarPermiso();

        $cita = $this->modelo->obtenerPorId($cita_id);
        if (!$cita) {
            die("Cita no encontrada.");
        }

        // Verificar si el estado permite mostrar en HC (seguridad adicional)
        if (!$cita['mostrar_en_hc']) {
            die("Esta cita no está en un estado que permita generar fórmula médica.");
        }

        // Obtener nombres de catálogos que obtenerPorId no trae por defecto
        $sql_extras = "SELECT tl.nombre as lentes_tipo_nombre, 
                              ml.nombre as lentes_material_nombre, 
                              ul.nombre as uso_lentes_nombre
                       FROM citas_control cc
                       LEFT JOIN tipos_lentes tl ON cc.lentes_tipo_id = tl.id
                       LEFT JOIN materiales_lentes ml ON cc.lentes_material_id = ml.id
                       LEFT JOIN usos_lentes ul ON cc.uso_lentes_id = ul.id
                       WHERE cc.id = ?";
        $stmt = $this->modelo->getConexion()->prepare($sql_extras);
        $stmt->bind_param('i', $cita_id);
        $stmt->execute();
        $extras = $stmt->get_result()->fetch_assoc();
        
        if ($extras) {
            $cita = array_merge($cita, $extras);
        }

        // Definir variables para la vista
        $permisos = $this->permisos;

        $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'REPORT', 'citas', 'Generó fórmula médica para cita ID: ' . $cita_id);

        if ($formato === 'pdf') {
            $this->generarPDF($cita);
        } else {
            include '../vistas/vista_formula_reporte.php';
        }
    }

    private function generarPDF($cita) {
        ob_start();
        include '../vistas/vista_formula_reporte.php';
        $html = ob_get_clean();

        echo $html;
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            });
        </script>";
    }
}

// Ruteo
if (isset($_GET['action'])) {
    $controlador = new ControladorFormulaMedica();
    $cita_id = $_GET['id'] ?? null;
    $action = $_GET['action'];

    if ($action === 'ver' && $cita_id) {
        $formato = $_GET['formato'] ?? 'html';
        $controlador->verReporte($cita_id, $formato);
    }
}
?>
