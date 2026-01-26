<?php
// views/vista_cita.php
require_once '../accesos/verificar_sesion.php';
// La zona horaria ya se establece en conexion.php desde el .env

// Cargar permisos para este programa
$mi_programa = 'vista_cita.php';
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

// Si estamos en modo listado, mostrar tabla
if (isset($registros) && isset($action) && $action === 'listar'):
    include 'vista_cita_listado.php';
    exit;
endif;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($cita) ? 'Editar Control Optométrico' : 'Nuevo Control Optométrico' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 30px 15px; background-color: #f8f9fa; }
        .accordion-button { font-weight: 600; color: #0d6efd; }
        .accordion-button:not(.collapsed) { background-color: #0d6efd; color: white; }
        .nav-tabs .nav-link.active { background-color: #0d6efd; color: white; }
        .od-bg { background-color: #e3f2fd; border-radius: 8px; padding: 15px; }
        .oi-bg { background-color: #fff3e0; border-radius: 8px; padding: 15px; }
        .section-content { padding: 2rem; }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-5 fw-bold"><?= isset($cita) ? 'Editar Control Optométrico' : 'Nuevo Control Optométrico' ?></h1>

    <?php if (isset($mensaje)): ?>
        <div class="alert alert-<?= $tipo_alerta ?> alert-dismissible fade show">
            <?= htmlspecialchars($mensaje) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="accordion" id="citaAccordion">

            <!-- 1. Información de la Cita -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sec1" aria-expanded="true">
                        1. Información de la Cita
                    </button>
                </h2>
                <div id="sec1" class="accordion-collapse collapse show" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Buscar Paciente <span class="text-danger">*</span></label>
                                <input type="text" id="buscar_paciente" class="form-control" placeholder="ID, documento o nombre..." autocomplete="off" 
                                    <?= (isset($cita) || isset($paciente_precargado)) ? 'readonly' : 'required' ?> 
                                    value="<?= isset($cita) ? htmlspecialchars($cita['paciente_identificacion'] . ' - ' . $cita['paciente_nombre']) : (isset($paciente_precargado) ? htmlspecialchars($paciente_precargado['identificacion'] . ' - ' . $paciente_precargado['nombre']) : '') ?>">
                                <div id="sugerencias" class="list-group position-absolute w-100 mt-1" style="z-index:1000; max-height:300px; overflow-y:auto; display:none;"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="info_paciente" class="mt-4" style="<?= (isset($cita) || isset($paciente_precargado)) ? 'display:block;' : 'display:none;' ?>">
                                    <input type="hidden" name="paciente_id" id="paciente_id" required value="<?= isset($cita) ? $cita['paciente_id'] : (isset($paciente_precargado) ? $paciente_precargado['id'] : '') ?>">
                                    <?php if (isset($cita) || isset($paciente_precargado)): 
                                        $p_nombre = $cita['paciente_nombre'] ?? $paciente_precargado['nombre'];
                                        $p_doc    = $cita['paciente_identificacion'] ?? $paciente_precargado['identificacion'];
                                        $p_tel    = $cita['paciente_telefono'] ?? $paciente_precargado['telefono'];
                                        $p_edad   = $cita['paciente_edad'] ?? $paciente_precargado['edad'];
                                    ?>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                document.getElementById('nombre_paciente').textContent = '<?= htmlspecialchars($p_nombre) ?>';
                                                document.getElementById('doc_paciente').textContent = '<?= htmlspecialchars($p_doc) ?>';
                                                document.getElementById('tel_paciente').textContent = '<?= htmlspecialchars($p_tel ?? 'No registrado') ?>';
                                                document.getElementById('edad_paciente').textContent = '<?= htmlspecialchars($p_edad ?? 'No registrada') ?>';
                                            });
                                        </script>
                                    <?php endif; ?>
                                    <div class="card border-primary">
                                        <div class="card-body py-3">
                                            <h6 class="card-title mb-2" id="nombre_paciente"></h6>
                                            <p class="small mb-1"><strong>Documento:</strong> <span id="doc_paciente"></span></p>
                                            <p class="small mb-1"><strong>Teléfono:</strong> <span id="tel_paciente"></span></p>
                                            <p class="small mb-0"><strong>Edad:</strong> <span id="edad_paciente"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col-md-4"><label>Fecha</label><input type="date" name="fecha_cita" class="form-control" value="<?= isset($cita) ? $cita['fecha_cita'] : date('Y-m-d') ?>"></div>
                            <div class="col-md-4"><label>Hora</label><input type="time" name="hora_cita" class="form-control" value="<?= isset($cita) ? substr($cita['hora_cita'], 0, 5) : date('H:i') ?>"></div>
                            <div class="col-md-4"><label>Tipo Consulta <span class="text-danger">*</span></label>
                                <select name="tipo_consulta_id" class="form-select" required>
                                    <option value="">Seleccione...</option>
                                    <?php if (isset($tiposConsulta) && is_array($tiposConsulta)): ?>
                                        <?php foreach ($tiposConsulta as $tc): 
                                            $selected = '';
                                            if (isset($cita) && $cita['tipo_consulta_id'] == $tc['id']) $selected = 'selected';
                                            else if (isset($tipo_consulta_sugerido) && $tipo_consulta_sugerido == $tc['id']) $selected = 'selected';
                                        ?>
                                            <option value="<?= $tc['id'] ?>" <?= $selected ?>><?= htmlspecialchars($tc['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-12"><label>Motivo de Consulta</label><textarea name="motivo_consulta" class="form-control" rows="2"><?= isset($cita) ? htmlspecialchars($cita['motivo_consulta'] ?? '') : '' ?></textarea></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Agudeza Visual -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec2">
                        2. Agudeza Visual
                    </button>
                </h2>
                <div id="sec2" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <h5 class="mb-3">Sin Corrección (SC)</h5>
                        <div class="row g-2 mb-4">
                            <div class="col-md-3 od-bg">
                                <label class="small fw-bold">OD - Lejos</label>
                                <input type="text" name="av_sc_lejos_od" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_sc_lejos_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="small fw-bold">OI - Lejos</label>
                                <input type="text" name="av_sc_lejos_oi" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_sc_lejos_oi'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 od-bg">
                                <label class="small fw-bold">OD - Cerca</label>
                                <input type="text" name="av_sc_cerca_od" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_sc_cerca_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="small fw-bold">OI - Cerca</label>
                                <input type="text" name="av_sc_cerca_oi" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_sc_cerca_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Con Corrección (CC)</h5>
                        <div class="row g-2">
                            <div class="col-md-3 od-bg">
                                <label class="small fw-bold">OD - Lejos</label>
                                <input type="text" name="av_cc_lejos_od" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_cc_lejos_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="small fw-bold">OI - Lejos</label>
                                <input type="text" name="av_cc_lejos_oi" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_cc_lejos_oi'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 od-bg">
                                <label class="small fw-bold">OD - Cerca</label>
                                <input type="text" name="av_cc_cerca_od" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_cc_cerca_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="small fw-bold">OI - Cerca</label>
                                <input type="text" name="av_cc_cerca_oi" class="form-control form-control-sm" placeholder="20/..." value="<?= isset($cita) ? htmlspecialchars($cita['av_cc_cerca_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Examen Externo y Cover Test -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec3">
                        3. Examen Externo y Cover Test
                    </button>
                </h2>
                <div id="sec3" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">Examen Externo OD</label>
                                <textarea name="examen_externo_od" class="form-control" rows="3" placeholder="Descripción del examen externo..."><?= isset($cita) ? htmlspecialchars($cita['examen_externo_od'] ?? '') : '' ?></textarea>
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">Examen Externo OI</label>
                                <textarea name="examen_externo_oi" class="form-control" rows="3" placeholder="Descripción del examen externo..."><?= isset($cita) ? htmlspecialchars($cita['examen_externo_oi'] ?? '') : '' ?></textarea>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Cover Test VP (Visión Próxima)</label>
                                <input type="text" name="cover_test_vp" class="form-control" placeholder="Ej: Ortoforia" value="<?= isset($cita) ? htmlspecialchars($cita['cover_test_vp'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Cover Test VL (Visión Lejana)</label>
                                <input type="text" name="cover_test_vl" class="form-control" placeholder="Ej: Ortoforia" value="<?= isset($cita) ? htmlspecialchars($cita['cover_test_vl'] ?? '') : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. FPC, DP y Oftalmoscopia -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec4">
                        4. FPC, DP y Oftalmoscopia
                    </button>
                </h2>
                <div id="sec4" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>FPC (Fijación Preferencial de la Conjunta)</label>
                                <input type="text" name="fpc" class="form-control" placeholder="Ej: Alternante" value="<?= isset($cita) ? htmlspecialchars($cita['fpc'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label>DP (Distancia Pupilar)</label>
                                <input type="text" name="dp" class="form-control" placeholder="Ej: 64mm" value="<?= isset($cita) ? htmlspecialchars($cita['dp'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">Oftalmoscopia OD</label>
                                <textarea name="oftalmoscopia_od" class="form-control" rows="3" placeholder="Hallazgos oftalmoscópicos..."><?= isset($cita) ? htmlspecialchars($cita['oftalmoscopia_od'] ?? '') : '' ?></textarea>
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">Oftalmoscopia OI</label>
                                <textarea name="oftalmoscopia_oi" class="form-control" rows="3" placeholder="Hallazgos oftalmoscópicos..."><?= isset($cita) ? htmlspecialchars($cita['oftalmoscopia_oi'] ?? '') : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Queratometría, Retinoscopía y Subjetivo -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec5">
                        5. Queratometría, Retinoscopía y Subjetivo
                    </button>
                </h2>
                <div id="sec5" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <h5 class="mb-3">Queratometría</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">OD</label>
                                <input type="text" name="queratometria_od" class="form-control" placeholder="Ej: 42.50 / 43.00 @ 90" value="<?= isset($cita) ? htmlspecialchars($cita['queratometria_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">OI</label>
                                <input type="text" name="queratometria_oi" class="form-control" placeholder="Ej: 42.50 / 43.00 @ 90" value="<?= isset($cita) ? htmlspecialchars($cita['queratometria_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Retinoscopía</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">OD</label>
                                <input type="text" name="retinoscopia_od" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['retinoscopia_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">OI</label>
                                <input type="text" name="retinoscopia_oi" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['retinoscopia_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Subjetivo</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">OD</label>
                                <input type="text" name="subjetivo_od" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['subjetivo_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">OI</label>
                                <input type="text" name="subjetivo_oi" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['subjetivo_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Resultado Final</h5>
                        <div class="row g-3">
                            <div class="col-md-6 od-bg">
                                <label class="fw-bold">OD</label>
                                <input type="text" name="resultado_final_od" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['resultado_final_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6 oi-bg">
                                <label class="fw-bold">OI</label>
                                <input type="text" name="resultado_final_oi" class="form-control" placeholder="Ej: -1.50 -0.50 x 180" value="<?= isset($cita) ? htmlspecialchars($cita['resultado_final_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Prescripción de Lentes y Diagnóstico -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec6">
                        6. Prescripción de Lentes y Diagnóstico
                    </button>
                </h2>
                <div id="sec6" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <h5 class="mb-3">Prescripción de Lentes</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label>Tipo de Lentes</label>
                                <select name="lentes_tipo_id" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <?php if (isset($tiposLente) && is_array($tiposLente)): ?>
                                        <?php foreach ($tiposLente as $tl): ?>
                                            <option value="<?= $tl['id'] ?>" <?= (isset($cita) && isset($cita['lentes_tipo_id']) && $cita['lentes_tipo_id'] == $tl['id']) ? 'selected' : '' ?>><?= htmlspecialchars($tl['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Material</label>
                                <select name="lentes_material_id" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <?php if (isset($materiales) && is_array($materiales)): ?>
                                        <?php foreach ($materiales as $mat): ?>
                                            <option value="<?= $mat['id'] ?>" <?= (isset($cita) && isset($cita['lentes_material_id']) && $cita['lentes_material_id'] == $mat['id']) ? 'selected' : '' ?>><?= htmlspecialchars($mat['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3 od-bg">
                                <label class="fw-bold">Esférico OD</label>
                                <input type="text" name="lentes_esferico_od" class="form-control" placeholder="Ej: -1.50" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_esferico_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="fw-bold">Esférico OI</label>
                                <input type="text" name="lentes_esferico_oi" class="form-control" placeholder="Ej: -1.50" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_esferico_oi'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 od-bg">
                                <label class="fw-bold">Cilíndrico OD</label>
                                <input type="text" name="lentes_cilindrico_od" class="form-control" placeholder="Ej: -0.50" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_cilindrico_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="fw-bold">Cilíndrico OI</label>
                                <input type="text" name="lentes_cilindrico_oi" class="form-control" placeholder="Ej: -0.50" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_cilindrico_oi'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3 od-bg">
                                <label class="fw-bold">Eje OD</label>
                                <input type="text" name="lentes_eje_od" class="form-control" placeholder="Ej: 180" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_eje_od'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3 oi-bg">
                                <label class="fw-bold">Eje OI</label>
                                <input type="text" name="lentes_eje_oi" class="form-control" placeholder="Ej: 180" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_eje_oi'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <label>Adición</label>
                                <input type="text" name="lentes_adicion" class="form-control" placeholder="Ej: +2.00" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_adicion'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <label>Uso de Lentes</label>
                                <select name="uso_lentes_id" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <?php if (isset($usos) && is_array($usos)): ?>
                                        <?php foreach ($usos as $uso): ?>
                                            <option value="<?= $uso['id'] ?>" <?= (isset($cita) && isset($cita['uso_lentes_id']) && $cita['uso_lentes_id'] == $uso['id']) ? 'selected' : '' ?>><?= htmlspecialchars($uso['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>Tratamientos</label>
                                <input type="text" name="lentes_tratamientos" class="form-control" placeholder="Ej: Antirreflejo, Filtro UV" value="<?= isset($cita) ? htmlspecialchars($cita['lentes_tratamientos'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Filtro y/o Color</label>
                                <input type="text" name="filtro_color" class="form-control" placeholder="Ej: Fotosensible" value="<?= isset($cita) ? htmlspecialchars($cita['filtro_color'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Próximo Control</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>Fecha Próximo Control</label>
                                <input type="date" name="proximo_control" class="form-control" value="<?= isset($cita) ? htmlspecialchars($cita['proximo_control'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Motivo Próximo Control</label>
                                <textarea name="proximo_control_motivo" class="form-control" rows="2" placeholder="Motivo del próximo control..."><?= isset($cita) ? htmlspecialchars($cita['proximo_control_motivo'] ?? '') : '' ?></textarea>
                            </div>
                        </div>
                        <h5 class="mb-3">Origen de la Enfermedad o Accidente</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label>Tipo de Origen</label>
                                <select name="tipo_origen_id" class="form-select">
                                    <option value="">Seleccione...</option>
                                    <?php if (isset($tiposOrigen) && is_array($tiposOrigen)): ?>
                                        <?php foreach ($tiposOrigen as $to): ?>
                                            <option value="<?= $to['id'] ?>" <?= (isset($cita) && isset($cita['tipo_origen_id']) && $cita['tipo_origen_id'] == $to['id']) ? 'selected' : '' ?>><?= htmlspecialchars($to['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Fecha Inicio Síntomas</label>
                                <input type="date" name="fecha_inicio_sintomas" class="form-control" value="<?= isset($cita) ? htmlspecialchars($cita['fecha_inicio_sintomas'] ?? '') : '' ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Descripción del Origen</label>
                                <textarea name="origen_enfermedad" class="form-control" rows="2" placeholder="Descripción del origen..."><?= isset($cita) ? htmlspecialchars($cita['origen_enfermedad'] ?? '') : '' ?></textarea>
                            </div>
                        </div>
                        <h5 class="mb-3">Diagnóstico</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label>Buscar Diagnóstico CIE-10</label>
                                <input type="text" id="buscar_cie10" class="form-control" placeholder="Código o descripción..." autocomplete="off" value="<?= isset($cita) && isset($cita['cie10_id']) ? 'Cargando...' : '' ?>">
                                <div id="sugerencias_cie10" class="list-group position-absolute w-100 mt-1" style="z-index:1000; max-height:300px; overflow-y:auto; display:none;"></div>
                                <input type="hidden" name="cie10_id" id="cie10_id" value="<?= isset($cita) ? ($cita['cie10_id'] ?? '') : '' ?>">
                                <div id="info_cie10" class="mt-2" style="<?= (isset($cita) && isset($cita['cie10_id']) && $cita['cie10_id']) ? 'display:block;' : 'display:none;' ?>">
                                    <div class="alert alert-info py-2 mb-0">
                                        <small id="cie10_seleccionado"><?= isset($cita) && isset($cita['cie10_id']) ? 'Cargando diagnóstico...' : '' ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Diagnóstico Principal</label>
                                <input type="text" name="diagnostico_principal" class="form-control" placeholder="Diagnóstico principal..." value="<?= isset($cita) ? htmlspecialchars($cita['diagnostico_principal'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label>Diagnóstico Secundario</label>
                                <input type="text" name="diagnostico_secundario" class="form-control" placeholder="Diagnóstico secundario..." value="<?= isset($cita) ? htmlspecialchars($cita['diagnostico_secundario'] ?? '') : '' ?>">
                            </div>
                        </div>
                        <h5 class="mb-3">Tratamiento</h5>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label>Tratamiento Indicado</label>
                                <textarea name="tratamiento" class="form-control" rows="3" placeholder="Descripción del tratamiento..."><?= isset($cita) ? htmlspecialchars($cita['tratamiento'] ?? '') : '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Medicamentos Prescritos</label>
                                <textarea name="medicamentos_prescritos" class="form-control" rows="3" placeholder="Lista de medicamentos..."><?= isset($cita) ? htmlspecialchars($cita['medicamentos_prescritos'] ?? '') : '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label>Recomendaciones</label>
                                <textarea name="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente..."><?= isset($cita) ? htmlspecialchars($cita['recomendaciones'] ?? '') : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 7. Profesional y Observaciones -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sec7">
                        7. Profesional y Observaciones
                    </button>
                </h2>
                <div id="sec7" class="accordion-collapse collapse" data-bs-parent="#citaAccordion">
                    <div class="accordion-body section-content">
                        <div class="row g-3 mb-4 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Profesional que atiende</label>
                                <div class="p-3 bg-light border rounded">
                                    <?php if (isset($profesional_logueado) && is_array($profesional_logueado)): ?>
                                        <strong><?= htmlspecialchars($profesional_logueado['nombre_completo'] ?? (($profesional_logueado['primer_nombre'] ?? '') . ' ' . ($profesional_logueado['primer_apellido'] ?? ''))) ?></strong>
                                        <br><small><?= htmlspecialchars($profesional_logueado['especialidad'] ?? 'Optómetra') ?> - Reg: <?= htmlspecialchars($profesional_logueado['registro_profesional'] ?? 'N/A') ?></small>
                                        <input type="hidden" name="profesional_id" value="<?= $profesional_logueado['id'] ?? 0 ?>">
                                    <?php else: ?>
                                        <strong class="text-danger">No hay profesional asignado</strong>
                                        <br><small>Contacte al administrador</small>
                                        <input type="hidden" name="profesional_id" value="0">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Asistente</label>
                                <select name="asistente_id" class="form-select">
                                    <option value="">Ninguno</option>
                                    <?php if (isset($asistentes) && is_array($asistentes)): ?>
                                        <?php foreach ($asistentes as $asist): ?>
                                            <option value="<?= $asist['id'] ?>" <?= (isset($cita) && isset($cita['asistente_id']) && $cita['asistente_id'] == $asist['id']) ? 'selected' : '' ?>><?= htmlspecialchars($asist['nombre_completo']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Estado Cita</label>
                                <select name="estado_cita_id" class="form-select">
                                    <?php if (isset($estadosCita) && is_array($estadosCita)): ?>
                                        <?php foreach ($estadosCita as $ec): ?>
                                            <option value="<?= $ec['id'] ?>" <?= (isset($cita) && isset($cita['estado_cita_id']) && $cita['estado_cita_id'] == $ec['id']) ? 'selected' : (($ec['id'] == 1 && !isset($cita)) ? 'selected' : '') ?>><?= htmlspecialchars($ec['nombre']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label>Observaciones Generales</label>
                            <textarea name="observaciones_generales" class="form-control" rows="4"><?= isset($cita) ? htmlspecialchars($cita['observaciones_generales'] ?? '') : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <?php if (isset($cita)): ?>
                <input type="hidden" name="id" value="<?= $cita['id'] ?>">
                <a href="?action=listar" class="btn btn-secondary btn-lg px-4 me-2">Regresar</a>
            <?php endif; ?>
            <?php if (!isset($cita) || (isset($cita) && $cita['estado_cita_id'] != 2)): ?>
                <button type="submit" class="btn btn-primary btn-lg px-5"><?= isset($cita) ? 'Actualizar' : 'Guardar' ?> Control Optométrico</button>
            <?php else: ?>
                <div class="alert alert-warning d-inline-block px-5">
                    <strong>Cita Finalizada:</strong> Los controles realizados no pueden ser modificados.
                </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Autocompletado de paciente
const inputBuscar = document.getElementById('buscar_paciente');
const sugerencias = document.getElementById('sugerencias');
const infoPaciente = document.getElementById('info_paciente');
const pacienteId = document.getElementById('paciente_id');
const nombrePaciente = document.getElementById('nombre_paciente');
const docPaciente = document.getElementById('doc_paciente');
const telPaciente = document.getElementById('tel_paciente');
const edadPaciente = document.getElementById('edad_paciente');

let timeout = null;

inputBuscar.addEventListener('input', function() {
    clearTimeout(timeout);
    const query = this.value.trim();

    if (query.length < 2) {
        sugerencias.innerHTML = ''; sugerencias.style.display = 'none'; return;
    }

    timeout = setTimeout(() => {
        fetch(`../public/buscar_pacientes.php?q=${encodeURIComponent(query)}`)
            .then(r => r.json())
            .then(data => {
                sugerencias.innerHTML = '';
                if (data.length === 0) { sugerencias.style.display = 'none'; return; }

                data.forEach(p => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'list-group-item list-group-item-action';
                    item.innerHTML = `<strong>${p.texto}</strong><br><small class="text-muted">${p.edad || ''} • ${p.telefono || 'Sin teléfono'}</small>`;
                    item.onclick = () => {
                        pacienteId.value = p.id;
                        nombrePaciente.textContent = p.nombre_completo;
                        docPaciente.textContent = p.documento;
                        telPaciente.textContent = p.telefono || 'No registrado';
                        edadPaciente.textContent = p.edad || 'No disponible';
                        infoPaciente.style.display = 'block';
                        sugerencias.style.display = 'none';
                        inputBuscar.value = p.texto;
                        
                        // Lógica de auto-selección de tipo de consulta
                        const selectTipo = document.querySelector('select[name="tipo_consulta_id"]');
                        if (selectTipo) {
                            fetch(`../controladores/controlador_cita.php?action=verificar_citas&paciente_id=${p.id}`)
                                .then(r => r.json())
                                .then(res => {
                                    if (res.tiene_citas) {
                                        selectTipo.value = "2"; // 2 = CONTROL
                                    } else {
                                        selectTipo.value = "1"; // 1 = PRIMERA
                                    }
                                });
                        }
                    };
                    sugerencias.appendChild(item);
                });
                sugerencias.style.display = 'block';
            });
    }, 300);
});

document.addEventListener('click', e => {
    if (!inputBuscar.contains(e.target) && !sugerencias.contains(e.target)) {
        sugerencias.style.display = 'none';
    }
});

// Autocompletado de diagnóstico CIE-10
const inputBuscarCIE10 = document.getElementById('buscar_cie10');
const sugerenciasCIE10 = document.getElementById('sugerencias_cie10');
const infoCIE10 = document.getElementById('info_cie10');
const cie10Id = document.getElementById('cie10_id');
const cie10Seleccionado = document.getElementById('cie10_seleccionado');

let timeoutCIE10 = null;

if (inputBuscarCIE10) {
    inputBuscarCIE10.addEventListener('input', function() {
        clearTimeout(timeoutCIE10);
        const query = this.value.trim();

        if (query.length < 2) {
            sugerenciasCIE10.innerHTML = '';
            sugerenciasCIE10.style.display = 'none';
            return;
        }

        timeoutCIE10 = setTimeout(() => {
            fetch(`../public/buscar_diagnosticos_cie10.php?q=${encodeURIComponent(query)}`)
                .then(r => r.json())
                .then(data => {
                    sugerenciasCIE10.innerHTML = '';
                    if (data.length === 0) {
                        sugerenciasCIE10.style.display = 'none';
                        return;
                    }

                    data.forEach(d => {
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.className = 'list-group-item list-group-item-action';
                        item.innerHTML = `<strong>${d.codigo}</strong> - ${d.descripcion}<br><small class="text-muted">${d.categoria || ''}</small>`;
                        item.onclick = () => {
                            cie10Id.value = d.id;
                            cie10Seleccionado.textContent = `${d.codigo} - ${d.descripcion}`;
                            infoCIE10.style.display = 'block';
                            sugerenciasCIE10.style.display = 'none';
                            inputBuscarCIE10.value = d.texto;
                        };
                        sugerenciasCIE10.appendChild(item);
                    });
                    sugerenciasCIE10.style.display = 'block';
                });
        }, 300);
    });
}

document.addEventListener('click', e => {
    if (inputBuscarCIE10 && !inputBuscarCIE10.contains(e.target) && !sugerenciasCIE10.contains(e.target)) {
        sugerenciasCIE10.style.display = 'none';
    }
});

// Cargar diagnóstico CIE-10 si estamos en modo edición
<?php if (isset($cita) && isset($cita['cie10_id']) && $cita['cie10_id']): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const cie10IdValue = <?= $cita['cie10_id'] ?>;
        const cie10Codigo = <?= isset($cita['cie10_codigo']) ? json_encode($cita['cie10_codigo']) : 'null' ?>;
        const cie10Descripcion = <?= isset($cita['cie10_descripcion']) ? json_encode($cita['cie10_descripcion']) : 'null' ?>;
        
        if (cie10IdValue && cie10Codigo && cie10Descripcion) {
            cie10Id.value = cie10IdValue;
            cie10Seleccionado.textContent = cie10Codigo + ' - ' + cie10Descripcion;
            inputBuscarCIE10.value = cie10Codigo + ' - ' + cie10Descripcion;
            infoCIE10.style.display = 'block';
        }
    });

    // Deshabilitar formulario si la cita está realizada
    <?php if (isset($cita) && $cita['estado_cita_id'] == 2): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        if (form) {
            const elements = form.querySelectorAll('input, select, textarea');
            elements.forEach(el => {
                if (el.id !== 'buscar_paciente') { // Mantener búsqueda libre si se quisiera, aunque aquí está en edición
                    el.disabled = true;
                }
            });
        }
    });
    <?php endif; ?>
<?php endif; ?>
</script>
</body>
</html>