<?php
/**
 * GeneraCRUDphp - Vista Generada
 */
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_antecedentes_medicos.php'; // Debe coincidir con el nombre_archivo en acc_programa
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antecedentes_medicos</title>

    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #1e3c72;
            --primary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            --accent-color: #ff9800;
        }
        body { background-color: #f4f7fa; font-family: 'Inter', sans-serif; }
        .main-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; background: white; margin-top: 2rem; }
        .card-header-custom { background: var(--primary-gradient); color: white; padding: 1.5rem; border: none; }
        .btn-premium { border-radius: 10px; padding: 0.6rem 1.2rem; font-weight: 600; transition: all 0.3s; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-premium:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }
        .table thead th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; color: #495057; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; }
        .table tbody tr { transition: all 0.2s; }
        .table tbody tr:hover { background-color: rgba(30, 60, 114, 0.03); }
        .badge-status { border-radius: 30px; padding: 0.4em 0.8em; }
        .pagination .page-link { border-radius: 8px; margin: 0 3px; border: none; color: var(--primary-color); font-weight: 600; }
        .pagination .page-item.active .page-link { background: var(--primary-gradient); }
        .search-box { border-radius: 10px 0 0 10px; border: 1px solid #dee2e6; }
        .search-btn { border-radius: 0 10px 10px 0; background: var(--primary-color); color: white; }
    </style>
</head>
<body>
    <div class="container pb-5">
        
        <div class="main-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0"><i class="icon-table me-2"></i> Antecedentes_medicos</h3>
                    <small class="opacity-75">Gestión de Registros</small>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($permisos['exp']): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-premium dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="icon-export me-1"></i> Exportar
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="../controladores/controlador_antecedentes_medicos.php?action=exportar&formato=excel&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-excel text-success me-2"></i> Excel</a></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_antecedentes_medicos.php?action=exportar&formato=csv&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-text text-primary me-2"></i> CSV</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_antecedentes_medicos.php?action=exportar&formato=txt&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-doc-text-inv text-secondary me-2"></i> TXT</a></li>
                        </ul>
                    </div>
                    <?php endif; ?>

                                        <?php if ($permisos['ins']): ?>
                    <button type="button" class="btn btn-premium btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        <i class="icon-plus me-1"></i> Nuevo Registro
                    </button>
                    <?php endif; ?>
                                    </div>
            </div>

            <div class="card-body p-4">
                <!-- Buscador -->
                <form method="GET" action="vista_antecedentes_medicos.php" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control search-box p-2" placeholder="Buscar por cualquier campo..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                        <input type="hidden" name="action" value="buscar">
                        <input type="hidden" name="registrosPorPagina" value="<?= $registrosPorPagina ?>">
                        <button type="submit" class="btn search-btn px-4"><i class="icon-search"></i></button>
                        <?php if(isset($_GET['busqueda']) && $_GET['busqueda'] !== ''): ?>
                            <a href="vista_antecedentes_medicos.php" class="btn btn-outline-danger d-flex align-items-center"><i class="icon-cancel"></i></a>
                        <?php endif; ?>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
<?php
$sort = $_GET['sort'] ?? "`antecedentes_medicos`.`id`";
$dir = $_GET['dir'] ?? 'DESC';
$nextDir = ($dir === 'ASC') ? 'DESC' : 'ASC';
?>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`pacientes`.`primer_apellido`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        paciente_id                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`pacientes`.`primer_apellido`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`hipertension_arterial`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        hipertension_arterial                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`hipertension_arterial`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`diabetes`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        diabetes                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`diabetes`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`tipos_diabetes`.`nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        diabetes_tipo_id                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`tipos_diabetes`.`nombre`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`tiempo_diabetes`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        tiempo_diabetes                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`tiempo_diabetes`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`enfermedades_cardiacas`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        enfermedades_cardiacas                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`enfermedades_cardiacas`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`enfermedades_renales`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        enfermedades_renales                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`enfermedades_renales`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`enfermedades_hepaticas`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        enfermedades_hepaticas                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`enfermedades_hepaticas`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`enfermedades_autoimunes`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        enfermedades_autoimunes                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`enfermedades_autoimunes`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`cancer`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        cancer                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`cancer`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`vih`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        vih                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`vih`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`antecedentes_medicos`.`observaciones`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        observaciones                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`antecedentes_medicos`.`observaciones`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../modelos/modelo_antecedentes_medicos.php';
                            if (file_exists('../modelos/modelo_acc_log.php')) {
                                require_once '../modelos/modelo_acc_log.php';
                            } elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
                                require_once '../accesos/modelos/modelo_acc_log.php';
                            }
                            $modelo = new ModeloAntecedentes_medicos();
                            $modeloLog = new ModeloAcc_log();
                            $modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'VIEW', 'antecedentes_medicos', 'Acceso a la pantalla de listado');
                            $termino = $_GET['busqueda'] ?? '';
                            $campoFiltro = $_GET['campo'] ?? '';
                            $registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
                            $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                            $offset = ($paginaActual - 1) * $registrosPorPagina;

                            if (isset($_GET['action']) && $_GET['action'] === 'buscar') {
                                if (!empty($campoFiltro) && !empty($termino)) {
                                     // Búsqueda avanzada por campo
                                     $totalRegistros = $modelo->contarPorCampo($campoFiltro, $termino);
                                     $registros = $modelo->buscarPorCampo($campoFiltro, $termino, $registrosPorPagina, $offset, $sort, $dir);
                                } else {
                                     // Búsqueda general
                                     $totalRegistros = $modelo->contarRegistrosPorBusqueda($termino);
                                     $registros = $modelo->buscar($termino, $registrosPorPagina, $offset, $sort, $dir);
                                }
                            } else {
                                $totalRegistros = $modelo->contarRegistros();
                                $registros = $modelo->obtenerTodos($registrosPorPagina, $offset, $sort, $dir);
                            }

                            if ($registros):
                                foreach ($registros as $registro):
                            ?>
                <tr>
                    <td><?php echo htmlspecialchars($registro['paciente_id_display'] ?? $registro['paciente_id']); ?></td>
                    <td><?php $isChecked = ($registro['hipertension_arterial'] == 1 || $registro['hipertension_arterial'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['diabetes'] == 1 || $registro['diabetes'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php echo htmlspecialchars($registro['diabetes_tipo_id_display'] ?? $registro['diabetes_tipo_id']); ?></td>
                    <td><?php echo htmlspecialchars($registro['tiempo_diabetes']); ?></td>
                    <td><?php $isChecked = ($registro['enfermedades_cardiacas'] == 1 || $registro['enfermedades_cardiacas'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['enfermedades_renales'] == 1 || $registro['enfermedades_renales'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['enfermedades_hepaticas'] == 1 || $registro['enfermedades_hepaticas'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['enfermedades_autoimunes'] == 1 || $registro['enfermedades_autoimunes'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['cancer'] == 1 || $registro['cancer'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php $isChecked = ($registro['vih'] == 1 || $registro['vih'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td><?php echo htmlspecialchars($registro['observaciones']); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                        <?php if ($permisos['upd']): ?>
                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalActualizar" data-idActualizar="<?php echo $registro['id']; ?>"
                           data-id="<?php echo htmlspecialchars($registro['id']); ?>"
                           data-paciente_id="<?php echo htmlspecialchars($registro['paciente_id']); ?>"
                           data-hipertension_arterial="<?php echo htmlspecialchars($registro['hipertension_arterial']); ?>"
                           data-diabetes="<?php echo htmlspecialchars($registro['diabetes']); ?>"
                           data-diabetes_tipo_id="<?php echo htmlspecialchars($registro['diabetes_tipo_id']); ?>"
                           data-tiempo_diabetes="<?php echo htmlspecialchars($registro['tiempo_diabetes']); ?>"
                           data-enfermedades_cardiacas="<?php echo htmlspecialchars($registro['enfermedades_cardiacas']); ?>"
                           data-enfermedades_renales="<?php echo htmlspecialchars($registro['enfermedades_renales']); ?>"
                           data-enfermedades_hepaticas="<?php echo htmlspecialchars($registro['enfermedades_hepaticas']); ?>"
                           data-enfermedades_autoimunes="<?php echo htmlspecialchars($registro['enfermedades_autoimunes']); ?>"
                           data-cancer="<?php echo htmlspecialchars($registro['cancer']); ?>"
                           data-vih="<?php echo htmlspecialchars($registro['vih']); ?>"
                           data-tuberculosis="<?php echo htmlspecialchars($registro['tuberculosis']); ?>"
                           data-epilepsia="<?php echo htmlspecialchars($registro['epilepsia']); ?>"
                           data-asma="<?php echo htmlspecialchars($registro['asma']); ?>"
                           data-otras_enfermedades="<?php echo htmlspecialchars($registro['otras_enfermedades']); ?>"
                           data-glaucoma="<?php echo htmlspecialchars($registro['glaucoma']); ?>"
                           data-familia_glaucoma="<?php echo htmlspecialchars($registro['familia_glaucoma']); ?>"
                           data-catarata="<?php echo htmlspecialchars($registro['catarata']); ?>"
                           data-fecha_cirugia_catarata="<?php echo htmlspecialchars($registro['fecha_cirugia_catarata']); ?>"
                           data-desprendimiento_retina="<?php echo htmlspecialchars($registro['desprendimiento_retina']); ?>"
                           data-estrabismo="<?php echo htmlspecialchars($registro['estrabismo']); ?>"
                           data-ojo_vago="<?php echo htmlspecialchars($registro['ojo_vago']); ?>"
                           data-conjuntivitis_alergica="<?php echo htmlspecialchars($registro['conjuntivitis_alergica']); ?>"
                           data-otros_antecedentes_oftalmologicos="<?php echo htmlspecialchars($registro['otros_antecedentes_oftalmologicos']); ?>"
                           data-medicamentos_actuales="<?php echo htmlspecialchars($registro['medicamentos_actuales']); ?>"
                           data-dosis_medicamentos="<?php echo htmlspecialchars($registro['dosis_medicamentos']); ?>"
                           data-alergias_medicamentos="<?php echo htmlspecialchars($registro['alergias_medicamentos']); ?>"
                           data-antecedentes_quirurgicos="<?php echo htmlspecialchars($registro['antecedentes_quirurgicos']); ?>"
                           data-fuma="<?php echo htmlspecialchars($registro['fuma']); ?>"
                           data-cigarrillos_dia="<?php echo htmlspecialchars($registro['cigarrillos_dia']); ?>"
                           data-alcohol="<?php echo htmlspecialchars($registro['alcohol']); ?>"
                           data-frecuencia_alcohol_id="<?php echo htmlspecialchars($registro['frecuencia_alcohol_id']); ?>"
                           data-drogas="<?php echo htmlspecialchars($registro['drogas']); ?>"
                           data-tipo_drogas="<?php echo htmlspecialchars($registro['tipo_drogas']); ?>"
                           data-familiares_ceguera="<?php echo htmlspecialchars($registro['familiares_ceguera']); ?>"
                           data-familiares_glaucoma="<?php echo htmlspecialchars($registro['familiares_glaucoma']); ?>"
                           data-familiares_retinopatia_diabetica="<?php echo htmlspecialchars($registro['familiares_retinopatia_diabetica']); ?>"
                           data-familiares_otros="<?php echo htmlspecialchars($registro['familiares_otros']); ?>"
                           data-observaciones="<?php echo htmlspecialchars($registro['observaciones']); ?>"
                           data-usuario_id_inserto="<?php echo htmlspecialchars($registro['usuario_id_inserto']); ?>"
                           data-fecha_insercion="<?php echo htmlspecialchars($registro['fecha_insercion']); ?>"
                           data-usuario_id_actualizo="<?php echo htmlspecialchars($registro['usuario_id_actualizo']); ?>"
                           data-fecha_actualizacion="<?php echo htmlspecialchars($registro['fecha_actualizacion']); ?>"
                        > <i class="icon-edit"></i></button>
                        <?php endif; ?>

                        <?php if ($permisos['del']): ?>
                        <button class="btn btn-sm btn-outline-danger" onclick="eliminar('<?php echo htmlspecialchars($registro['id']); ?>')"> <i class="icon-trash-2"></i></button>
                        <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                                <tr><td colspan="13">No hay registros disponibles.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="mb-3">
            <form method="GET" class="d-flex">
                <label for="registrosPorPagina" class="mr-2">Registros por página:</label>
                <select id="registrosPorPagina" name="registrosPorPagina" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="15" <?= $registrosPorPagina == 15 ? 'selected' : '' ?>>15</option>
                    <option value="30" <?= $registrosPorPagina == 30 ? 'selected' : '' ?>>30</option>
                    <option value="50" <?= $registrosPorPagina == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $registrosPorPagina == 100 ? 'selected' : '' ?>>100</option>
                </select>
                <input type="hidden" name="pagina" value="<?= $paginaActual ?>">
                <?php if(isset($_GET['action']) && $_GET['action'] == 'buscar'): ?>                    <input type="hidden" name="action" value="buscar">
                    <input type="hidden" name="busqueda" value="<?= htmlspecialchars($termino) ?>">
                    <input type="hidden" name="campo" value="<?= htmlspecialchars($campoFiltro) ?>">
                <?php endif; ?>            </form>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                // Cálculo de páginas ya realizado arriba
                $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                for ($i = 1; $i <= $totalPaginas; $i++):
                ?>
                    <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?> ">
                        <a class="page-link" href="?pagina=<?= $i ?>&registrosPorPagina=<?= $registrosPorPagina ?>&action=<?= $_GET['action'] ?? '' ?>&busqueda=<?= urlencode($termino) ?>&campo=<?= urlencode($campoFiltro) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

        <!-- Modal para crear -->
        <div class="modal fade shadow" id="modalCrear" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px;">
                    <div class="modal-header text-white" style="background: var(--primary-gradient);">
                        <h5 class="modal-title fw-bold"><i class="icon-plus-circle me-2"></i>Nuevo Registro</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="formCrear" method="post">
                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="paciente_id">paciente_id:</label>
                                    <select class="form-select" id="paciente_id" name="paciente_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_paciente_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="hipertension_arterial">hipertension_arterial:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="hipertension_arterial" value="0">
                                        <input class="form-check-input" type="checkbox" id="hipertension_arterial" name="hipertension_arterial" value="1">
                                        <label class="form-check-label" for="hipertension_arterial">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="diabetes">diabetes:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="diabetes" value="0">
                                        <input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1">
                                        <label class="form-check-label" for="diabetes">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="diabetes_tipo_id">diabetes_tipo_id:</label>
                                    <select class="form-select" id="diabetes_tipo_id" name="diabetes_tipo_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_diabetes_tipo_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="tiempo_diabetes">tiempo_diabetes:</label>
                                    <input type="text" class="form-control" id="tiempo_diabetes" name="tiempo_diabetes">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="enfermedades_cardiacas">enfermedades_cardiacas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_cardiacas" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_cardiacas" name="enfermedades_cardiacas" value="1">
                                        <label class="form-check-label" for="enfermedades_cardiacas">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="enfermedades_renales">enfermedades_renales:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_renales" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_renales" name="enfermedades_renales" value="1">
                                        <label class="form-check-label" for="enfermedades_renales">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="enfermedades_hepaticas">enfermedades_hepaticas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_hepaticas" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_hepaticas" name="enfermedades_hepaticas" value="1">
                                        <label class="form-check-label" for="enfermedades_hepaticas">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="enfermedades_autoimunes">enfermedades_autoimunes:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_autoimunes" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_autoimunes" name="enfermedades_autoimunes" value="1">
                                        <label class="form-check-label" for="enfermedades_autoimunes">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cancer">cancer:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="cancer" value="0">
                                        <input class="form-check-input" type="checkbox" id="cancer" name="cancer" value="1">
                                        <label class="form-check-label" for="cancer">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="vih">vih:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="vih" value="0">
                                        <input class="form-check-input" type="checkbox" id="vih" name="vih" value="1">
                                        <label class="form-check-label" for="vih">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="tuberculosis">tuberculosis:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="tuberculosis" value="0">
                                        <input class="form-check-input" type="checkbox" id="tuberculosis" name="tuberculosis" value="1">
                                        <label class="form-check-label" for="tuberculosis">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="epilepsia">epilepsia:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="epilepsia" value="0">
                                        <input class="form-check-input" type="checkbox" id="epilepsia" name="epilepsia" value="1">
                                        <label class="form-check-label" for="epilepsia">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="asma">asma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="asma" value="0">
                                        <input class="form-check-input" type="checkbox" id="asma" name="asma" value="1">
                                        <label class="form-check-label" for="asma">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="otras_enfermedades">otras_enfermedades:</label>
                                    <input type="text" class="form-control" id="otras_enfermedades" name="otras_enfermedades">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="glaucoma">glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="glaucoma" name="glaucoma" value="1">
                                        <label class="form-check-label" for="glaucoma">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="familia_glaucoma">familia_glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familia_glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="familia_glaucoma" name="familia_glaucoma" value="1">
                                        <label class="form-check-label" for="familia_glaucoma">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="catarata">catarata:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="catarata" value="0">
                                        <input class="form-check-input" type="checkbox" id="catarata" name="catarata" value="1">
                                        <label class="form-check-label" for="catarata">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_cirugia_catarata">fecha_cirugia_catarata:</label>
                                    <input type="date" class="form-control" id="fecha_cirugia_catarata" name="fecha_cirugia_catarata">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="desprendimiento_retina">desprendimiento_retina:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="desprendimiento_retina" value="0">
                                        <input class="form-check-input" type="checkbox" id="desprendimiento_retina" name="desprendimiento_retina" value="1">
                                        <label class="form-check-label" for="desprendimiento_retina">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="estrabismo">estrabismo:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="estrabismo" value="0">
                                        <input class="form-check-input" type="checkbox" id="estrabismo" name="estrabismo" value="1">
                                        <label class="form-check-label" for="estrabismo">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ojo_vago">ojo_vago:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="ojo_vago" value="0">
                                        <input class="form-check-input" type="checkbox" id="ojo_vago" name="ojo_vago" value="1">
                                        <label class="form-check-label" for="ojo_vago">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="conjuntivitis_alergica">conjuntivitis_alergica:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="conjuntivitis_alergica" value="0">
                                        <input class="form-check-input" type="checkbox" id="conjuntivitis_alergica" name="conjuntivitis_alergica" value="1">
                                        <label class="form-check-label" for="conjuntivitis_alergica">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="otros_antecedentes_oftalmologicos">otros_antecedentes_oftalmologicos:</label>
                                    <input type="text" class="form-control" id="otros_antecedentes_oftalmologicos" name="otros_antecedentes_oftalmologicos">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="medicamentos_actuales">medicamentos_actuales:</label>
                                    <input type="text" class="form-control" id="medicamentos_actuales" name="medicamentos_actuales">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="dosis_medicamentos">dosis_medicamentos:</label>
                                    <input type="text" class="form-control" id="dosis_medicamentos" name="dosis_medicamentos">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="alergias_medicamentos">alergias_medicamentos:</label>
                                    <input type="text" class="form-control" id="alergias_medicamentos" name="alergias_medicamentos">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="antecedentes_quirurgicos">antecedentes_quirurgicos:</label>
                                    <input type="text" class="form-control" id="antecedentes_quirurgicos" name="antecedentes_quirurgicos">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="fuma">fuma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="fuma" value="0">
                                        <input class="form-check-input" type="checkbox" id="fuma" name="fuma" value="1">
                                        <label class="form-check-label" for="fuma">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cigarrillos_dia">cigarrillos_dia:</label>
                                    <input type="number" class="form-control" id="cigarrillos_dia" name="cigarrillos_dia">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="alcohol">alcohol:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="alcohol" value="0">
                                        <input class="form-check-input" type="checkbox" id="alcohol" name="alcohol" value="1">
                                        <label class="form-check-label" for="alcohol">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="frecuencia_alcohol_id">frecuencia_alcohol_id:</label>
                                    <select class="form-select" id="frecuencia_alcohol_id" name="frecuencia_alcohol_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_frecuencia_alcohol_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="drogas">drogas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="drogas" value="0">
                                        <input class="form-check-input" type="checkbox" id="drogas" name="drogas" value="1">
                                        <label class="form-check-label" for="drogas">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="tipo_drogas">tipo_drogas:</label>
                                    <input type="text" class="form-control" id="tipo_drogas" name="tipo_drogas">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="familiares_ceguera">familiares_ceguera:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_ceguera" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_ceguera" name="familiares_ceguera" value="1">
                                        <label class="form-check-label" for="familiares_ceguera">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="familiares_glaucoma">familiares_glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_glaucoma" name="familiares_glaucoma" value="1">
                                        <label class="form-check-label" for="familiares_glaucoma">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="familiares_retinopatia_diabetica">familiares_retinopatia_diabetica:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_retinopatia_diabetica" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_retinopatia_diabetica" name="familiares_retinopatia_diabetica" value="1">
                                        <label class="form-check-label" for="familiares_retinopatia_diabetica">Si/No</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="familiares_otros">familiares_otros:</label>
                                    <input type="text" class="form-control" id="familiares_otros" name="familiares_otros">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="observaciones">observaciones:</label>
                                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                                </div>
                            </div>                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-light btn-premium me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-premium btn-primary px-5"><i class="icon-ok-2 me-1"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para actualizar -->
        <div class="modal fade shadow" id="modalActualizar" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px;">
                    <div class="modal-header text-white" style="background: var(--primary-gradient);">
                        <h5 class="modal-title fw-bold"><i class="icon-edit me-2"></i>Editar Registro</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                    <form id="formActualizar" method="post">
                     <div class="modal-header">
                         <div class="row">
                             <div class="form-group col-md-8">
                               <h5 class="modal-title">Actualizar Antecedentes_medicos - ID: </h5>
                             </div>
                             <div class="form-group col-md-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <input type="text" class="form-control" id="id" name="id" readonly>
                                </div>
                             </div>
                         </div>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                     </div>
                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="paciente_id">paciente_id:</label>
                                    <select class="form-select" id="paciente_id" name="paciente_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_paciente_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="hipertension_arterial">hipertension_arterial:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="hipertension_arterial" value="0">
                                        <input class="form-check-input" type="checkbox" id="hipertension_arterial" name="hipertension_arterial" value="1">
                                        <label class="form-check-label" for="hipertension_arterial">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="diabetes">diabetes:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="diabetes" value="0">
                                        <input class="form-check-input" type="checkbox" id="diabetes" name="diabetes" value="1">
                                        <label class="form-check-label" for="diabetes">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="diabetes_tipo_id">diabetes_tipo_id:</label>
                                    <select class="form-select" id="diabetes_tipo_id" name="diabetes_tipo_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_diabetes_tipo_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="tiempo_diabetes">tiempo_diabetes:</label>
                                     <input type="text" class="form-control" id="tiempo_diabetes" name="tiempo_diabetes">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="enfermedades_cardiacas">enfermedades_cardiacas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_cardiacas" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_cardiacas" name="enfermedades_cardiacas" value="1">
                                        <label class="form-check-label" for="enfermedades_cardiacas">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="enfermedades_renales">enfermedades_renales:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_renales" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_renales" name="enfermedades_renales" value="1">
                                        <label class="form-check-label" for="enfermedades_renales">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="enfermedades_hepaticas">enfermedades_hepaticas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_hepaticas" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_hepaticas" name="enfermedades_hepaticas" value="1">
                                        <label class="form-check-label" for="enfermedades_hepaticas">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="enfermedades_autoimunes">enfermedades_autoimunes:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enfermedades_autoimunes" value="0">
                                        <input class="form-check-input" type="checkbox" id="enfermedades_autoimunes" name="enfermedades_autoimunes" value="1">
                                        <label class="form-check-label" for="enfermedades_autoimunes">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="cancer">cancer:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="cancer" value="0">
                                        <input class="form-check-input" type="checkbox" id="cancer" name="cancer" value="1">
                                        <label class="form-check-label" for="cancer">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="vih">vih:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="vih" value="0">
                                        <input class="form-check-input" type="checkbox" id="vih" name="vih" value="1">
                                        <label class="form-check-label" for="vih">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="tuberculosis">tuberculosis:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="tuberculosis" value="0">
                                        <input class="form-check-input" type="checkbox" id="tuberculosis" name="tuberculosis" value="1">
                                        <label class="form-check-label" for="tuberculosis">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="epilepsia">epilepsia:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="epilepsia" value="0">
                                        <input class="form-check-input" type="checkbox" id="epilepsia" name="epilepsia" value="1">
                                        <label class="form-check-label" for="epilepsia">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="asma">asma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="asma" value="0">
                                        <input class="form-check-input" type="checkbox" id="asma" name="asma" value="1">
                                        <label class="form-check-label" for="asma">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="otras_enfermedades">otras_enfermedades:</label>
                                     <input type="text" class="form-control" id="otras_enfermedades" name="otras_enfermedades">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="glaucoma">glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="glaucoma" name="glaucoma" value="1">
                                        <label class="form-check-label" for="glaucoma">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="familia_glaucoma">familia_glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familia_glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="familia_glaucoma" name="familia_glaucoma" value="1">
                                        <label class="form-check-label" for="familia_glaucoma">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="catarata">catarata:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="catarata" value="0">
                                        <input class="form-check-input" type="checkbox" id="catarata" name="catarata" value="1">
                                        <label class="form-check-label" for="catarata">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="fecha_cirugia_catarata">fecha_cirugia_catarata:</label>
                                     <input type="date" class="form-control" id="fecha_cirugia_catarata" name="fecha_cirugia_catarata">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="desprendimiento_retina">desprendimiento_retina:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="desprendimiento_retina" value="0">
                                        <input class="form-check-input" type="checkbox" id="desprendimiento_retina" name="desprendimiento_retina" value="1">
                                        <label class="form-check-label" for="desprendimiento_retina">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="estrabismo">estrabismo:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="estrabismo" value="0">
                                        <input class="form-check-input" type="checkbox" id="estrabismo" name="estrabismo" value="1">
                                        <label class="form-check-label" for="estrabismo">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="ojo_vago">ojo_vago:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="ojo_vago" value="0">
                                        <input class="form-check-input" type="checkbox" id="ojo_vago" name="ojo_vago" value="1">
                                        <label class="form-check-label" for="ojo_vago">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="conjuntivitis_alergica">conjuntivitis_alergica:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="conjuntivitis_alergica" value="0">
                                        <input class="form-check-input" type="checkbox" id="conjuntivitis_alergica" name="conjuntivitis_alergica" value="1">
                                        <label class="form-check-label" for="conjuntivitis_alergica">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="otros_antecedentes_oftalmologicos">otros_antecedentes_oftalmologicos:</label>
                                     <input type="text" class="form-control" id="otros_antecedentes_oftalmologicos" name="otros_antecedentes_oftalmologicos">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="medicamentos_actuales">medicamentos_actuales:</label>
                                     <input type="text" class="form-control" id="medicamentos_actuales" name="medicamentos_actuales">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="dosis_medicamentos">dosis_medicamentos:</label>
                                     <input type="text" class="form-control" id="dosis_medicamentos" name="dosis_medicamentos">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="alergias_medicamentos">alergias_medicamentos:</label>
                                     <input type="text" class="form-control" id="alergias_medicamentos" name="alergias_medicamentos">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="antecedentes_quirurgicos">antecedentes_quirurgicos:</label>
                                     <input type="text" class="form-control" id="antecedentes_quirurgicos" name="antecedentes_quirurgicos">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="fuma">fuma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="fuma" value="0">
                                        <input class="form-check-input" type="checkbox" id="fuma" name="fuma" value="1">
                                        <label class="form-check-label" for="fuma">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="cigarrillos_dia">cigarrillos_dia:</label>
                                     <input type="number" class="form-control" id="cigarrillos_dia" name="cigarrillos_dia">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="alcohol">alcohol:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="alcohol" value="0">
                                        <input class="form-check-input" type="checkbox" id="alcohol" name="alcohol" value="1">
                                        <label class="form-check-label" for="alcohol">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="frecuencia_alcohol_id">frecuencia_alcohol_id:</label>
                                    <select class="form-select" id="frecuencia_alcohol_id" name="frecuencia_alcohol_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_frecuencia_alcohol_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="drogas">drogas:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="drogas" value="0">
                                        <input class="form-check-input" type="checkbox" id="drogas" name="drogas" value="1">
                                        <label class="form-check-label" for="drogas">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="tipo_drogas">tipo_drogas:</label>
                                     <input type="text" class="form-control" id="tipo_drogas" name="tipo_drogas">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="familiares_ceguera">familiares_ceguera:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_ceguera" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_ceguera" name="familiares_ceguera" value="1">
                                        <label class="form-check-label" for="familiares_ceguera">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="familiares_glaucoma">familiares_glaucoma:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_glaucoma" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_glaucoma" name="familiares_glaucoma" value="1">
                                        <label class="form-check-label" for="familiares_glaucoma">Si/No</label>
                                    </div>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="familiares_retinopatia_diabetica">familiares_retinopatia_diabetica:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="familiares_retinopatia_diabetica" value="0">
                                        <input class="form-check-input" type="checkbox" id="familiares_retinopatia_diabetica" name="familiares_retinopatia_diabetica" value="1">
                                        <label class="form-check-label" for="familiares_retinopatia_diabetica">Si/No</label>
                                    </div>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="familiares_otros">familiares_otros:</label>
                                     <input type="text" class="form-control" id="familiares_otros" name="familiares_otros">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="observaciones">observaciones:</label>
                                     <input type="text" class="form-control" id="observaciones" name="observaciones">
                                </div>
                            </div>                                 <input type="hidden" id="idActualizar" name="idActualizar">
                                 <div class="text-end mt-4">
                                     <button type="button" class="btn btn-light btn-premium me-2" data-bs-dismiss="modal">Cancelar</button>
                                     <button type="submit" class="btn btn-premium btn-warning text-white px-5"><i class="icon-ok-2 me-1"></i> Actualizar</button>
                                 </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModalCreate = new bootstrap.Modal(document.getElementById('modalCrear'));
            var myModalUpdate = new bootstrap.Modal(document.getElementById('modalActualizar'));

            // Manejador para el botón crear
            var btnCrear = document.querySelector('[data-bs-target="#modalCrear"]');
            if(btnCrear){
                btnCrear.addEventListener('click', function() {
                    myModalCreate.show();
                });
            }

            // Manejador del formulario crear
            document.getElementById('formCrear').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('../controladores/controlador_antecedentes_medicos.php?action=crear', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if(data) {
                        myModalCreate.hide();
                        location.reload();
                    } else {
                        alert('Error al crear el registro.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
                });
            });

            // Inicializar el modal de actualización
            var modalActualizarElement = document.getElementById('modalActualizar');
            var modalActualizar = new bootstrap.Modal(modalActualizarElement);

            modalActualizarElement.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var modal = this;

                // Cargar el ID para actualizar
                var idActualizar = button.getAttribute('data-idActualizar');
                modal.querySelector('#idActualizar').value = idActualizar;

                var valorid = button.getAttribute('data-id');
                var inputid = modal.querySelector('#id');
                if(inputid) {
                    if (inputid.type === 'checkbox') {
                        inputid.checked = (valorid === 'activo');
                    } else {
                        inputid.value = valorid;
                    }
                }
                var valorpaciente_id = button.getAttribute('data-paciente_id');
                var inputpaciente_id = modal.querySelector('#paciente_id');
                if(inputpaciente_id) {
                    if (inputpaciente_id.type === 'checkbox') {
                        inputpaciente_id.checked = (valorpaciente_id === 'activo');
                    } else {
                        inputpaciente_id.value = valorpaciente_id;
                    }
                }
                var valorhipertension_arterial = button.getAttribute('data-hipertension_arterial');
                var inputhipertension_arterial = modal.querySelector('#hipertension_arterial');
                if(inputhipertension_arterial) {
                    if (inputhipertension_arterial.type === 'checkbox') {
                        inputhipertension_arterial.checked = (valorhipertension_arterial == '1' || valorhipertension_arterial == 'true');
                    } else {
                        inputhipertension_arterial.value = valorhipertension_arterial;
                    }
                }
                var valordiabetes = button.getAttribute('data-diabetes');
                var inputdiabetes = modal.querySelector('#diabetes');
                if(inputdiabetes) {
                    if (inputdiabetes.type === 'checkbox') {
                        inputdiabetes.checked = (valordiabetes == '1' || valordiabetes == 'true');
                    } else {
                        inputdiabetes.value = valordiabetes;
                    }
                }
                var valordiabetes_tipo_id = button.getAttribute('data-diabetes_tipo_id');
                var inputdiabetes_tipo_id = modal.querySelector('#diabetes_tipo_id');
                if(inputdiabetes_tipo_id) {
                    if (inputdiabetes_tipo_id.type === 'checkbox') {
                        inputdiabetes_tipo_id.checked = (valordiabetes_tipo_id === 'activo');
                    } else {
                        inputdiabetes_tipo_id.value = valordiabetes_tipo_id;
                    }
                }
                var valortiempo_diabetes = button.getAttribute('data-tiempo_diabetes');
                var inputtiempo_diabetes = modal.querySelector('#tiempo_diabetes');
                if(inputtiempo_diabetes) {
                    if (inputtiempo_diabetes.type === 'checkbox') {
                        inputtiempo_diabetes.checked = (valortiempo_diabetes === 'activo');
                    } else {
                        inputtiempo_diabetes.value = valortiempo_diabetes;
                    }
                }
                var valorenfermedades_cardiacas = button.getAttribute('data-enfermedades_cardiacas');
                var inputenfermedades_cardiacas = modal.querySelector('#enfermedades_cardiacas');
                if(inputenfermedades_cardiacas) {
                    if (inputenfermedades_cardiacas.type === 'checkbox') {
                        inputenfermedades_cardiacas.checked = (valorenfermedades_cardiacas == '1' || valorenfermedades_cardiacas == 'true');
                    } else {
                        inputenfermedades_cardiacas.value = valorenfermedades_cardiacas;
                    }
                }
                var valorenfermedades_renales = button.getAttribute('data-enfermedades_renales');
                var inputenfermedades_renales = modal.querySelector('#enfermedades_renales');
                if(inputenfermedades_renales) {
                    if (inputenfermedades_renales.type === 'checkbox') {
                        inputenfermedades_renales.checked = (valorenfermedades_renales == '1' || valorenfermedades_renales == 'true');
                    } else {
                        inputenfermedades_renales.value = valorenfermedades_renales;
                    }
                }
                var valorenfermedades_hepaticas = button.getAttribute('data-enfermedades_hepaticas');
                var inputenfermedades_hepaticas = modal.querySelector('#enfermedades_hepaticas');
                if(inputenfermedades_hepaticas) {
                    if (inputenfermedades_hepaticas.type === 'checkbox') {
                        inputenfermedades_hepaticas.checked = (valorenfermedades_hepaticas == '1' || valorenfermedades_hepaticas == 'true');
                    } else {
                        inputenfermedades_hepaticas.value = valorenfermedades_hepaticas;
                    }
                }
                var valorenfermedades_autoimunes = button.getAttribute('data-enfermedades_autoimunes');
                var inputenfermedades_autoimunes = modal.querySelector('#enfermedades_autoimunes');
                if(inputenfermedades_autoimunes) {
                    if (inputenfermedades_autoimunes.type === 'checkbox') {
                        inputenfermedades_autoimunes.checked = (valorenfermedades_autoimunes == '1' || valorenfermedades_autoimunes == 'true');
                    } else {
                        inputenfermedades_autoimunes.value = valorenfermedades_autoimunes;
                    }
                }
                var valorcancer = button.getAttribute('data-cancer');
                var inputcancer = modal.querySelector('#cancer');
                if(inputcancer) {
                    if (inputcancer.type === 'checkbox') {
                        inputcancer.checked = (valorcancer == '1' || valorcancer == 'true');
                    } else {
                        inputcancer.value = valorcancer;
                    }
                }
                var valorvih = button.getAttribute('data-vih');
                var inputvih = modal.querySelector('#vih');
                if(inputvih) {
                    if (inputvih.type === 'checkbox') {
                        inputvih.checked = (valorvih == '1' || valorvih == 'true');
                    } else {
                        inputvih.value = valorvih;
                    }
                }
                var valortuberculosis = button.getAttribute('data-tuberculosis');
                var inputtuberculosis = modal.querySelector('#tuberculosis');
                if(inputtuberculosis) {
                    if (inputtuberculosis.type === 'checkbox') {
                        inputtuberculosis.checked = (valortuberculosis == '1' || valortuberculosis == 'true');
                    } else {
                        inputtuberculosis.value = valortuberculosis;
                    }
                }
                var valorepilepsia = button.getAttribute('data-epilepsia');
                var inputepilepsia = modal.querySelector('#epilepsia');
                if(inputepilepsia) {
                    if (inputepilepsia.type === 'checkbox') {
                        inputepilepsia.checked = (valorepilepsia == '1' || valorepilepsia == 'true');
                    } else {
                        inputepilepsia.value = valorepilepsia;
                    }
                }
                var valorasma = button.getAttribute('data-asma');
                var inputasma = modal.querySelector('#asma');
                if(inputasma) {
                    if (inputasma.type === 'checkbox') {
                        inputasma.checked = (valorasma == '1' || valorasma == 'true');
                    } else {
                        inputasma.value = valorasma;
                    }
                }
                var valorotras_enfermedades = button.getAttribute('data-otras_enfermedades');
                var inputotras_enfermedades = modal.querySelector('#otras_enfermedades');
                if(inputotras_enfermedades) {
                    if (inputotras_enfermedades.type === 'checkbox') {
                        inputotras_enfermedades.checked = (valorotras_enfermedades === 'activo');
                    } else {
                        inputotras_enfermedades.value = valorotras_enfermedades;
                    }
                }
                var valorglaucoma = button.getAttribute('data-glaucoma');
                var inputglaucoma = modal.querySelector('#glaucoma');
                if(inputglaucoma) {
                    if (inputglaucoma.type === 'checkbox') {
                        inputglaucoma.checked = (valorglaucoma == '1' || valorglaucoma == 'true');
                    } else {
                        inputglaucoma.value = valorglaucoma;
                    }
                }
                var valorfamilia_glaucoma = button.getAttribute('data-familia_glaucoma');
                var inputfamilia_glaucoma = modal.querySelector('#familia_glaucoma');
                if(inputfamilia_glaucoma) {
                    if (inputfamilia_glaucoma.type === 'checkbox') {
                        inputfamilia_glaucoma.checked = (valorfamilia_glaucoma == '1' || valorfamilia_glaucoma == 'true');
                    } else {
                        inputfamilia_glaucoma.value = valorfamilia_glaucoma;
                    }
                }
                var valorcatarata = button.getAttribute('data-catarata');
                var inputcatarata = modal.querySelector('#catarata');
                if(inputcatarata) {
                    if (inputcatarata.type === 'checkbox') {
                        inputcatarata.checked = (valorcatarata == '1' || valorcatarata == 'true');
                    } else {
                        inputcatarata.value = valorcatarata;
                    }
                }
                var valorfecha_cirugia_catarata = button.getAttribute('data-fecha_cirugia_catarata');
                var inputfecha_cirugia_catarata = modal.querySelector('#fecha_cirugia_catarata');
                if(inputfecha_cirugia_catarata) {
                    if (inputfecha_cirugia_catarata.type === 'checkbox') {
                        inputfecha_cirugia_catarata.checked = (valorfecha_cirugia_catarata === 'activo');
                    } else {
                        inputfecha_cirugia_catarata.value = valorfecha_cirugia_catarata;
                    }
                }
                var valordesprendimiento_retina = button.getAttribute('data-desprendimiento_retina');
                var inputdesprendimiento_retina = modal.querySelector('#desprendimiento_retina');
                if(inputdesprendimiento_retina) {
                    if (inputdesprendimiento_retina.type === 'checkbox') {
                        inputdesprendimiento_retina.checked = (valordesprendimiento_retina == '1' || valordesprendimiento_retina == 'true');
                    } else {
                        inputdesprendimiento_retina.value = valordesprendimiento_retina;
                    }
                }
                var valorestrabismo = button.getAttribute('data-estrabismo');
                var inputestrabismo = modal.querySelector('#estrabismo');
                if(inputestrabismo) {
                    if (inputestrabismo.type === 'checkbox') {
                        inputestrabismo.checked = (valorestrabismo == '1' || valorestrabismo == 'true');
                    } else {
                        inputestrabismo.value = valorestrabismo;
                    }
                }
                var valorojo_vago = button.getAttribute('data-ojo_vago');
                var inputojo_vago = modal.querySelector('#ojo_vago');
                if(inputojo_vago) {
                    if (inputojo_vago.type === 'checkbox') {
                        inputojo_vago.checked = (valorojo_vago == '1' || valorojo_vago == 'true');
                    } else {
                        inputojo_vago.value = valorojo_vago;
                    }
                }
                var valorconjuntivitis_alergica = button.getAttribute('data-conjuntivitis_alergica');
                var inputconjuntivitis_alergica = modal.querySelector('#conjuntivitis_alergica');
                if(inputconjuntivitis_alergica) {
                    if (inputconjuntivitis_alergica.type === 'checkbox') {
                        inputconjuntivitis_alergica.checked = (valorconjuntivitis_alergica == '1' || valorconjuntivitis_alergica == 'true');
                    } else {
                        inputconjuntivitis_alergica.value = valorconjuntivitis_alergica;
                    }
                }
                var valorotros_antecedentes_oftalmologicos = button.getAttribute('data-otros_antecedentes_oftalmologicos');
                var inputotros_antecedentes_oftalmologicos = modal.querySelector('#otros_antecedentes_oftalmologicos');
                if(inputotros_antecedentes_oftalmologicos) {
                    if (inputotros_antecedentes_oftalmologicos.type === 'checkbox') {
                        inputotros_antecedentes_oftalmologicos.checked = (valorotros_antecedentes_oftalmologicos === 'activo');
                    } else {
                        inputotros_antecedentes_oftalmologicos.value = valorotros_antecedentes_oftalmologicos;
                    }
                }
                var valormedicamentos_actuales = button.getAttribute('data-medicamentos_actuales');
                var inputmedicamentos_actuales = modal.querySelector('#medicamentos_actuales');
                if(inputmedicamentos_actuales) {
                    if (inputmedicamentos_actuales.type === 'checkbox') {
                        inputmedicamentos_actuales.checked = (valormedicamentos_actuales === 'activo');
                    } else {
                        inputmedicamentos_actuales.value = valormedicamentos_actuales;
                    }
                }
                var valordosis_medicamentos = button.getAttribute('data-dosis_medicamentos');
                var inputdosis_medicamentos = modal.querySelector('#dosis_medicamentos');
                if(inputdosis_medicamentos) {
                    if (inputdosis_medicamentos.type === 'checkbox') {
                        inputdosis_medicamentos.checked = (valordosis_medicamentos === 'activo');
                    } else {
                        inputdosis_medicamentos.value = valordosis_medicamentos;
                    }
                }
                var valoralergias_medicamentos = button.getAttribute('data-alergias_medicamentos');
                var inputalergias_medicamentos = modal.querySelector('#alergias_medicamentos');
                if(inputalergias_medicamentos) {
                    if (inputalergias_medicamentos.type === 'checkbox') {
                        inputalergias_medicamentos.checked = (valoralergias_medicamentos === 'activo');
                    } else {
                        inputalergias_medicamentos.value = valoralergias_medicamentos;
                    }
                }
                var valorantecedentes_quirurgicos = button.getAttribute('data-antecedentes_quirurgicos');
                var inputantecedentes_quirurgicos = modal.querySelector('#antecedentes_quirurgicos');
                if(inputantecedentes_quirurgicos) {
                    if (inputantecedentes_quirurgicos.type === 'checkbox') {
                        inputantecedentes_quirurgicos.checked = (valorantecedentes_quirurgicos === 'activo');
                    } else {
                        inputantecedentes_quirurgicos.value = valorantecedentes_quirurgicos;
                    }
                }
                var valorfuma = button.getAttribute('data-fuma');
                var inputfuma = modal.querySelector('#fuma');
                if(inputfuma) {
                    if (inputfuma.type === 'checkbox') {
                        inputfuma.checked = (valorfuma == '1' || valorfuma == 'true');
                    } else {
                        inputfuma.value = valorfuma;
                    }
                }
                var valorcigarrillos_dia = button.getAttribute('data-cigarrillos_dia');
                var inputcigarrillos_dia = modal.querySelector('#cigarrillos_dia');
                if(inputcigarrillos_dia) {
                    if (inputcigarrillos_dia.type === 'checkbox') {
                        inputcigarrillos_dia.checked = (valorcigarrillos_dia === 'activo');
                    } else {
                        inputcigarrillos_dia.value = valorcigarrillos_dia;
                    }
                }
                var valoralcohol = button.getAttribute('data-alcohol');
                var inputalcohol = modal.querySelector('#alcohol');
                if(inputalcohol) {
                    if (inputalcohol.type === 'checkbox') {
                        inputalcohol.checked = (valoralcohol == '1' || valoralcohol == 'true');
                    } else {
                        inputalcohol.value = valoralcohol;
                    }
                }
                var valorfrecuencia_alcohol_id = button.getAttribute('data-frecuencia_alcohol_id');
                var inputfrecuencia_alcohol_id = modal.querySelector('#frecuencia_alcohol_id');
                if(inputfrecuencia_alcohol_id) {
                    if (inputfrecuencia_alcohol_id.type === 'checkbox') {
                        inputfrecuencia_alcohol_id.checked = (valorfrecuencia_alcohol_id === 'activo');
                    } else {
                        inputfrecuencia_alcohol_id.value = valorfrecuencia_alcohol_id;
                    }
                }
                var valordrogas = button.getAttribute('data-drogas');
                var inputdrogas = modal.querySelector('#drogas');
                if(inputdrogas) {
                    if (inputdrogas.type === 'checkbox') {
                        inputdrogas.checked = (valordrogas == '1' || valordrogas == 'true');
                    } else {
                        inputdrogas.value = valordrogas;
                    }
                }
                var valortipo_drogas = button.getAttribute('data-tipo_drogas');
                var inputtipo_drogas = modal.querySelector('#tipo_drogas');
                if(inputtipo_drogas) {
                    if (inputtipo_drogas.type === 'checkbox') {
                        inputtipo_drogas.checked = (valortipo_drogas === 'activo');
                    } else {
                        inputtipo_drogas.value = valortipo_drogas;
                    }
                }
                var valorfamiliares_ceguera = button.getAttribute('data-familiares_ceguera');
                var inputfamiliares_ceguera = modal.querySelector('#familiares_ceguera');
                if(inputfamiliares_ceguera) {
                    if (inputfamiliares_ceguera.type === 'checkbox') {
                        inputfamiliares_ceguera.checked = (valorfamiliares_ceguera == '1' || valorfamiliares_ceguera == 'true');
                    } else {
                        inputfamiliares_ceguera.value = valorfamiliares_ceguera;
                    }
                }
                var valorfamiliares_glaucoma = button.getAttribute('data-familiares_glaucoma');
                var inputfamiliares_glaucoma = modal.querySelector('#familiares_glaucoma');
                if(inputfamiliares_glaucoma) {
                    if (inputfamiliares_glaucoma.type === 'checkbox') {
                        inputfamiliares_glaucoma.checked = (valorfamiliares_glaucoma == '1' || valorfamiliares_glaucoma == 'true');
                    } else {
                        inputfamiliares_glaucoma.value = valorfamiliares_glaucoma;
                    }
                }
                var valorfamiliares_retinopatia_diabetica = button.getAttribute('data-familiares_retinopatia_diabetica');
                var inputfamiliares_retinopatia_diabetica = modal.querySelector('#familiares_retinopatia_diabetica');
                if(inputfamiliares_retinopatia_diabetica) {
                    if (inputfamiliares_retinopatia_diabetica.type === 'checkbox') {
                        inputfamiliares_retinopatia_diabetica.checked = (valorfamiliares_retinopatia_diabetica == '1' || valorfamiliares_retinopatia_diabetica == 'true');
                    } else {
                        inputfamiliares_retinopatia_diabetica.value = valorfamiliares_retinopatia_diabetica;
                    }
                }
                var valorfamiliares_otros = button.getAttribute('data-familiares_otros');
                var inputfamiliares_otros = modal.querySelector('#familiares_otros');
                if(inputfamiliares_otros) {
                    if (inputfamiliares_otros.type === 'checkbox') {
                        inputfamiliares_otros.checked = (valorfamiliares_otros === 'activo');
                    } else {
                        inputfamiliares_otros.value = valorfamiliares_otros;
                    }
                }
                var valorobservaciones = button.getAttribute('data-observaciones');
                var inputobservaciones = modal.querySelector('#observaciones');
                if(inputobservaciones) {
                    if (inputobservaciones.type === 'checkbox') {
                        inputobservaciones.checked = (valorobservaciones === 'activo');
                    } else {
                        inputobservaciones.value = valorobservaciones;
                    }
                }
                var valorusuario_id_inserto = button.getAttribute('data-usuario_id_inserto');
                var inputusuario_id_inserto = modal.querySelector('#usuario_id_inserto');
                if(inputusuario_id_inserto) {
                    if (inputusuario_id_inserto.type === 'checkbox') {
                        inputusuario_id_inserto.checked = (valorusuario_id_inserto === 'activo');
                    } else {
                        inputusuario_id_inserto.value = valorusuario_id_inserto;
                    }
                }
                var valorfecha_insercion = button.getAttribute('data-fecha_insercion');
                var inputfecha_insercion = modal.querySelector('#fecha_insercion');
                if(inputfecha_insercion) {
                    if (inputfecha_insercion.type === 'checkbox') {
                        inputfecha_insercion.checked = (valorfecha_insercion === 'activo');
                    } else {
                        inputfecha_insercion.value = valorfecha_insercion;
                    }
                }
                var valorusuario_id_actualizo = button.getAttribute('data-usuario_id_actualizo');
                var inputusuario_id_actualizo = modal.querySelector('#usuario_id_actualizo');
                if(inputusuario_id_actualizo) {
                    if (inputusuario_id_actualizo.type === 'checkbox') {
                        inputusuario_id_actualizo.checked = (valorusuario_id_actualizo === 'activo');
                    } else {
                        inputusuario_id_actualizo.value = valorusuario_id_actualizo;
                    }
                }
                var valorfecha_actualizacion = button.getAttribute('data-fecha_actualizacion');
                var inputfecha_actualizacion = modal.querySelector('#fecha_actualizacion');
                if(inputfecha_actualizacion) {
                    if (inputfecha_actualizacion.type === 'checkbox') {
                        inputfecha_actualizacion.checked = (valorfecha_actualizacion === 'activo');
                    } else {
                        inputfecha_actualizacion.value = valorfecha_actualizacion;
                    }
                }
            });

            document.getElementById('formActualizar').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('../controladores/controlador_antecedentes_medicos.php?action=actualizar', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if(data) {
                        modalActualizar.hide();
                        location.reload();
                    } else {
                        alert('Error al actualizar el registro.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
                });
            });
        });

        function eliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                fetch('../controladores/controlador_antecedentes_medicos.php?action=eliminar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(id)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el registro.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar el registro: ' + error.message);
                });
            }
        }
    </script>

    <style>
        .modal-backdrop { z-index: 1040; }
        .modal { z-index: 1050; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
    </div>
</body>
</html>
