<?php
require_once '../config/config.php';
require_once '../modelos/modelo_reporte_historia.php';
if (file_exists('../modelos/modelo_acc_log.php')) {
    require_once '../modelos/modelo_acc_log.php';
} elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
    require_once '../accesos/modelos/modelo_acc_log.php';
}

class ControladorReporteHistoria {
    private $modelo;
    private $modeloLog;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->modelo = new ModeloReporteHistoria();
        $this->modeloLog = new ModeloAcc_log();
    }

    private function verificarPermiso() {
        // El programa para el cual verificaremos permisos es 'vista_historia_clinica_reporte.php'
        $permisos = $_SESSION['permisos']['vista_historia_clinica_reporte.php'] ?? null;
        if (!$permisos) {
            die("No tiene permisos para acceder a este reporte.");
        }
    }

    public function verReporte($paciente_id, $formato = 'html') {
        $this->verificarPermiso();

        $paciente = $this->modelo->obtenerDatosPaciente($paciente_id);
        if (!$paciente) {
            die("Paciente no encontrado.");
        }

        $anamnesis = $this->modelo->obtenerAnamnesis($paciente_id);
        $historial = $this->modelo->obtenerHistorialConsultas($paciente_id);

        $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'REPORT', 'pacientes', 'Generó reporte de historia clínica para paciente ID: ' . $paciente_id);

        if ($formato === 'pdf') {
            $this->generarPDF($paciente, $anamnesis, $historial);
        } else {
            // Cargar la vista pasándole los datos
            include '../vistas/vista_historia_clinica_reporte.php';
        }
    }

    public function enviarPorEmail($paciente_id, $destinatarios) {
        try {
            $this->verificarPermiso();
            require_once '../include/SimpleSMTP.php';

            $paciente = $this->modelo->obtenerDatosPaciente($paciente_id);
            $anamnesis = $this->modelo->obtenerAnamnesis($paciente_id);
            $historial = $this->modelo->obtenerHistorialConsultas($paciente_id);

            // Generar el cuerpo del correo (HTML del reporte)
            $esEmail = true;
            // Construir URL base para recursos (Logo)
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $script = $_SERVER['PHP_SELF'];
            $dir = dirname(dirname($script)); 
            $baseUrl = $protocol . "://" . $host . ($dir === DIRECTORY_SEPARATOR ? "" : $dir) . "/";
            
            // Usar logo desde .env
            $appLogo = getenv('APP_LOGO') ?: 'assets/img/logo.png';
            $logoUrl = $baseUrl . $appLogo;

            ob_start();
            include '../vistas/vista_historia_clinica_reporte.php';
            $cuerpo = ob_get_clean();

            // Configurar SMTP desde el .env
            $smtp = new SimpleSMTP(
                getenv('SMTP_HOST'),
                getenv('SMTP_USER'),
                getenv('SMTP_PASS'),
                getenv('SMTP_PORT') ?: 587
            );

            $asunto = "Historia Clínica - " . ($paciente['nombre_completo'] ?? $paciente['identificacion']);
            
            // Loop de destinatarios (pueden ser múltiples separados por coma)
            $lista = explode(',', $destinatarios);
            $exitos = 0;
            foreach ($lista as $email) {
                $email = trim($email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($smtp->send($email, $asunto, $cuerpo, APP_NAME)) {
                        $exitos++;
                    }
                }
            }

            if ($exitos > 0) {
                $this->modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'EMAIL', 'pacientes', 'Envió historia clínica por correo a: ' . $destinatarios);
                return ['success' => true, 'mensaje' => "Reporte enviado exitosamente a $exitos destinatario(s)."];
            } else {
                return ['success' => false, 'error' => "No se pudo enviar el correo a los destinatarios especificados."];
            }

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    private function generarPDF($paciente, $anamnesis, $historial) {
        ob_start();
        include '../vistas/vista_historia_clinica_reporte.php';
        $html = ob_get_clean();

        echo $html;
        // Pequeño retraso para asegurar que el DOM y el Título estén listos antes de llamar a print
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            });
        </script>";
    }
}

// Lógica de ruteo básica para el controlador
if (isset($_GET['action'])) {
    $controlador = new ControladorReporteHistoria();
    $paciente_id = $_GET['id'] ?? null;
    $action = $_GET['action'];

    if ($action === 'ver' && $paciente_id) {
        $formato = $_GET['formato'] ?? 'html';
        $controlador->verReporte($paciente_id, $formato);
    } elseif ($action === 'enviar' && $paciente_id) {
        $destinos = $_POST['destinatarios'] ?? '';
        header('Content-Type: application/json');
        echo json_encode($controlador->enviarPorEmail($paciente_id, $destinos));
        exit;
    }
}
