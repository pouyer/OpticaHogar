<?php
require_once '../config/config.php';
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_crear_anamnesis.php'; 
$permisos = $_SESSION['permisos'][$mi_programa] ?? $_SESSION['permisos']['vista_anamnesis.php'] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

if (!$permisos['ins']) {
    header('Location: ../index.php');
    exit;
}

$paciente_id = isset($_GET['paciente_id']) ? (int)$_GET['paciente_id'] : null;
$source = isset($_GET['source']) ? $_GET['source'] : '';
$paciente_nombre = '';

// Definir URL de retorno según el origen
$url_retorno = 'vista_pacientes.php';
if ($source === 'edit' && $paciente_id) {
    $url_retorno = "vista_pacientes.php?modal_edit_id=$paciente_id";
}

if ($paciente_id) {
    require_once '../modelos/modelo_pacientes.php';
    require_once '../modelos/modelo_anamnesis.php'; // Asegurar carga del modelo
    $modeloPacientes = new ModeloPacientes();
    $paciente = $modeloPacientes->obtenerPorId($paciente_id);
    if ($paciente) {
        $paciente_nombre = htmlspecialchars($paciente['primer_nombre'] . ' ' . ($paciente['segundo_nombre'] ?? '') . ' ' . $paciente['primer_apellido'] . ' ' . ($paciente['segundo_apellido'] ?? ''));
    } else {
        $paciente_id = null;
    }
}

// Token CSRF seguro
if (function_exists('generateCSRFToken')) {
    $csrf_token = generateCSRFToken();
} else {
    $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Anamnesis</title>

    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #8c288c;
            --primary-gradient: linear-gradient(135deg, #8c288c 0%, #2a5298 100%);
            --accent-color: #ff9800;
        }
        body { background-color: #f4f7fa; font-family: 'Inter', sans-serif; }
        .main-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; background: white; margin-top: 2rem; }
        .card-header-custom { background: var(--primary-gradient); color: white; padding: 1.5rem; border: none; }
        .btn-premium { border-radius: 10px; padding: 0.6rem 1.2rem; font-weight: 600; transition: all 0.3s; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-premium:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        .section-title { border-bottom: 2px solid var(--primary-color); padding-bottom: 0.5rem; margin-bottom: 1rem; color: var(--primary-color); font-weight: 600; }
    </style>
</head>
<body>
    <div class="container pb-5">
        <div class="main-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0"><i class="icon-plus me-2"></i> Crear Anamnesis</h3>
                    <small class="opacity-75">Registro de Antecedentes Médicos</small>
                </div>
                <div>
                    <a href="<?php echo $url_retorno; ?>" class="btn btn-light btn-premium"><i class="icon-left"></i> Volver</a>
                </div>
            </div>

            <div class="card-body p-4">
                <?php if ($paciente_id && $paciente_nombre): ?>
                <div class="alert alert-info">
                    <strong>Paciente:</strong> <?php echo $paciente_nombre; ?>
                </div>
                <?php endif; ?>

                <form id="formCrear" method="post" action="../controladores/controlador_anamnesis.php?action=crear">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <?php if ($paciente_id): ?>
                    <input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
                    <?php endif; ?>

                    <!-- Antecedentes Oftalmológicos -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-eye me-2"></i> Antecedentes Oftalmológicos</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="glaucoma" value="0">
                                    <input class="form-check-input" type="checkbox" id="glaucoma" name="glaucoma" value="1">
                                    <label class="form-check-label" for="glaucoma">Glaucoma</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="catarata" value="0">
                                    <input class="form-check-input" type="checkbox" id="catarata" name="catarata" value="1">
                                    <label class="form-check-label" for="catarata">Catarata</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_cirugia_catarata">Fecha Cirugía Catarata</label>
                                <input type="date" class="form-control" id="fecha_cirugia_catarata" name="fecha_cirugia_catarata">
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="desprendimiento_retina" value="0">
                                    <input class="form-check-input" type="checkbox" id="desprendimiento_retina" name="desprendimiento_retina" value="1">
                                    <label class="form-check-label" for="desprendimiento_retina">Desprendimiento de Retina</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="estrabismo" value="0">
                                    <input class="form-check-input" type="checkbox" id="estrabismo" name="estrabismo" value="1">
                                    <label class="form-check-label" for="estrabismo">Estrabismo</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="ojo_vago" value="0">
                                    <input class="form-check-input" type="checkbox" id="ojo_vago" name="ojo_vago" value="1">
                                    <label class="form-check-label" for="ojo_vago">Ojo Vago</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="conjuntivitis_alergica" value="0">
                                    <input class="form-check-input" type="checkbox" id="conjuntivitis_alergica" name="conjuntivitis_alergica" value="1">
                                    <label class="form-check-label" for="conjuntivitis_alergica">Conjuntivitis Alérgica</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="otros_antecedentes_oftalmologicos">Otros Antecedentes Oftalmológicos</label>
                                <textarea class="form-control" id="otros_antecedentes_oftalmologicos" name="otros_antecedentes_oftalmologicos" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Antecedentes Quirúrgicos -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-surgery me-2"></i> Antecedentes Quirúrgicos</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="antecedentes_quirurgicos">Antecedentes Quirúrgicos</label>
                                <textarea class="form-control" id="antecedentes_quirurgicos" name="antecedentes_quirurgicos" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Enfermedades Sistémicas -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-heart me-2"></i> Enfermedades Sistémicas</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="otras_enfermedades">Otras Enfermedades</label>
                                <textarea class="form-control" id="otras_enfermedades" name="otras_enfermedades" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Alergias Medicamentosas -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-allergy me-2"></i> Alergias Medicamentosas</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="alergias_medicamentos">Alergias a Medicamentos</label>
                                <textarea class="form-control" id="alergias_medicamentos" name="alergias_medicamentos" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Medicamentos Actuales -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-pill me-2"></i> Medicamentos Actuales</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="medicamentos_actuales">Medicamentos Actuales</label>
                                <textarea class="form-control" id="medicamentos_actuales" name="medicamentos_actuales" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dosis_medicamentos">Dosis de Medicamentos</label>
                                <textarea class="form-control" id="dosis_medicamentos" name="dosis_medicamentos" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Antecedentes Familiares -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-family me-2"></i> Antecedentes Familiares</h4>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="familiares_otros">Otros Antecedentes Familiares</label>
                                <textarea class="form-control" id="familiares_otros" name="familiares_otros" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones Generales -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-note me-2"></i> Observaciones Generales</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <?php if (!$paciente_id): ?>
                    <!-- Seleccionar Paciente si no viene por GET -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-user me-2"></i> Paciente</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="paciente_id">Paciente</label>
                                <select class="form-select" id="paciente_id" name="paciente_id" required>
                                    <option value="">-- Seleccionar Paciente --</option>
                                    <?php
                                    require_once '../modelos/modelo_anamnesis.php';
                                    $modelo = new ModeloAnamnesis();
                                    foreach ($modelo->obtenerRelacionado_paciente_id() as $opcion): ?>
                                    <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="text-end mt-4">
                        <a href="<?php echo $url_retorno; ?>" class="btn btn-light btn-premium me-2">Cancelar</a>
                        <button type="submit" class="btn btn-premium btn-primary px-5"><i class="icon-ok-2 me-1"></i> Guardar Anamnesis</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('formCrear').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('../controladores/controlador_anamnesis.php?action=crear', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data && data !== false && !data.error) {
                    alert('Anamnesis creada exitosamente.');
                    window.location.href = '<?php echo $url_retorno; ?>';
                } else {
                    const errorMsg = (data && data.error) ? data.error : 'Error al crear la anamnesis.';
                    alert('Error: ' + errorMsg);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud.');
            });
        });
    </script>
</body>
</html>