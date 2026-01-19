<?php
require_once '../config/config.php';
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_crear_anamnesis.php'; 
$permisos = $_SESSION['permisos'][$mi_programa] ?? null;

// Si no tiene permisos de actualización, verificar si al menos tiene permiso de visualización (por ejemplo para el listado)
// Asumimos que si llegó aquí es porque tiene el programa. 
// El modo lectura se activa si no tiene 'upd'
$es_lectura = (!$permisos || !$permisos['upd']);

// Determinar si puede ver los botones de acción
$puede_guardar = ($permisos && $permisos['upd']);

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$source = isset($_GET['source']) ? $_GET['source'] : '';
$anamnesis = null;
$paciente_nombre = '';
$paciente_id = null;

// Definir URL de retorno base
$url_retorno = 'vista_pacientes.php';

if ($id) {
    require_once '../modelos/modelo_anamnesis.php';
    require_once '../modelos/modelo_pacientes.php';
    $modeloAnamnesis = new ModeloAnamnesis();
    $modeloPacientes = new ModeloPacientes();
    
    $anamnesis = $modeloAnamnesis->obtenerPorId($id);
    if ($anamnesis) {
        $paciente = $modeloPacientes->obtenerPorId($anamnesis['paciente_id']);
        if ($paciente) {
            $paciente_id = $paciente['id'];
            $paciente_nombre = htmlspecialchars($paciente['primer_nombre'] . ' ' . $paciente['primer_apellido']);
            
            // Si el origen es 'edit', ajustar la URL de retorno
            if ($source === 'edit') {
                $url_retorno = "vista_pacientes.php?modal_edit_id=$paciente_id";
            }
        }
    } else {
        header('Location: vista_pacientes.php');
        exit;
    }
} else {
    header('Location: vista_pacientes.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anamnesis</title>

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
                    <h3 class="mb-0"><i class="icon-edit me-2"></i> Editar Anamnesis</h3>
                    <small class="opacity-75">Actualización de Antecedentes Médicos</small>
                </div>
                <div>
                    <a href="<?php echo $url_retorno; ?>" class="btn btn-light btn-premium"><i class="icon-left"></i> Volver</a>
                </div>
            </div>

            <?php if ($es_lectura): ?>
            <div class="alert alert-warning m-3 mb-0">
                <i class="icon-info-circled me-2"></i> <strong>Modo Lectura:</strong> No tiene permisos para modificar esta información.
            </div>
            <?php endif; ?>

            <div class="card-body p-4">
                <div class="alert alert-info">
                    <strong>Paciente:</strong> <?php echo $paciente_nombre; ?>
                </div>

                <form id="formEditar" method="post" action="../controladores/controlador_anamnesis.php?action=actualizar">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="paciente_id" value="<?php echo $anamnesis['paciente_id']; ?>">

                    <!-- Antecedentes Oftalmológicos -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-eye me-2"></i> Antecedentes Oftalmológicos</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="glaucoma" value="0">
                                    <input class="form-check-input" type="checkbox" id="glaucoma" name="glaucoma" value="1" <?php echo $anamnesis['glaucoma'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="glaucoma">Glaucoma</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="catarata" value="0">
                                    <input class="form-check-input" type="checkbox" id="catarata" name="catarata" value="1" <?php echo $anamnesis['catarata'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="catarata">Catarata</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_cirugia_catarata">Fecha Cirugía Catarata</label>
                                <input type="date" class="form-control" id="fecha_cirugia_catarata" name="fecha_cirugia_catarata" value="<?php echo $anamnesis['fecha_cirugia_catarata']; ?>" <?php echo $es_lectura ? 'readonly' : ''; ?>>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="desprendimiento_retina" value="0">
                                    <input class="form-check-input" type="checkbox" id="desprendimiento_retina" name="desprendimiento_retina" value="1" <?php echo $anamnesis['desprendimiento_retina'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="desprendimiento_retina">Desprendimiento de Retina</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="estrabismo" value="0">
                                    <input class="form-check-input" type="checkbox" id="estrabismo" name="estrabismo" value="1" <?php echo $anamnesis['estrabismo'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="estrabismo">Estrabismo</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="ojo_vago" value="0">
                                    <input class="form-check-input" type="checkbox" id="ojo_vago" name="ojo_vago" value="1" <?php echo $anamnesis['ojo_vago'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="ojo_vago">Ojo Vago</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="conjuntivitis_alergica" value="0">
                                    <input class="form-check-input" type="checkbox" id="conjuntivitis_alergica" name="conjuntivitis_alergica" value="1" <?php echo $anamnesis['conjuntivitis_alergica'] ? 'checked' : ''; ?> <?php echo $es_lectura ? 'disabled' : ''; ?>>
                                    <label class="form-check-label" for="conjuntivitis_alergica">Conjuntivitis Alérgica</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="otros_antecedentes_oftalmologicos">Otros Antecedentes Oftalmológicos</label>
                                <textarea class="form-control" id="otros_antecedentes_oftalmologicos" name="otros_antecedentes_oftalmologicos" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['otros_antecedentes_oftalmologicos']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Antecedentes Quirúrgicos -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-surgery me-2"></i> Antecedentes Quirúrgicos</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="antecedentes_quirurgicos">Antecedentes Quirúrgicos</label>
                                <textarea class="form-control" id="antecedentes_quirurgicos" name="antecedentes_quirurgicos" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['antecedentes_quirurgicos']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Enfermedades Sistémicas -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-heart me-2"></i> Enfermedades Sistémicas</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="otras_enfermedades">Otras Enfermedades</label>
                                <textarea class="form-control" id="otras_enfermedades" name="otras_enfermedades" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['otras_enfermedades']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Alergias Medicamentosas -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-allergy me-2"></i> Alergias Medicamentosas</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="alergias_medicamentos">Alergias a Medicamentos</label>
                                <textarea class="form-control" id="alergias_medicamentos" name="alergias_medicamentos" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['alergias_medicamentos']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Medicamentos Actuales -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-pill me-2"></i> Medicamentos Actuales</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="medicamentos_actuales">Medicamentos Actuales</label>
                                <textarea class="form-control" id="medicamentos_actuales" name="medicamentos_actuales" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['medicamentos_actuales']); ?></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dosis_medicamentos">Dosis de Medicamentos</label>
                                <textarea class="form-control" id="dosis_medicamentos" name="dosis_medicamentos" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['dosis_medicamentos']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Antecedentes Familiares -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-family me-2"></i> Antecedentes Familiares</h4>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="familiares_otros">Otros Antecedentes Familiares</label>
                                <textarea class="form-control" id="familiares_otros" name="familiares_otros" rows="3" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['familiares_otros']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones Generales -->
                    <div class="mb-4">
                        <h4 class="section-title"><i class="icon-note me-2"></i> Observaciones Generales</h4>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4" <?php echo $es_lectura ? 'readonly' : ''; ?>><?php echo htmlspecialchars($anamnesis['observaciones']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <a href="<?php echo $url_retorno; ?>" class="btn btn-light btn-premium me-2">Regresar</a>
                        <?php if (!$es_lectura): ?>
                        <button type="submit" class="btn btn-premium btn-warning text-white px-5"><i class="icon-ok-2 me-1"></i> Actualizar Anamnesis</button>
                        <?php endif; ?>
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
        document.getElementById('formEditar').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('../controladores/controlador_anamnesis.php?action=actualizar', {
                method: 'POST',
                body: formData // Usar FormData directamente es más robusto para multipart
            })
            .then(response => response.json())
            .then(data => {
                if(data && data !== false && !data.error) {
                    alert('Anamnesis actualizada exitosamente.');
                    window.location.href = '<?php echo $url_retorno; ?>';
                } else {
                    const errorMsg = (data && data.error) ? data.error : 'Error al actualizar la anamnesis.';
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
