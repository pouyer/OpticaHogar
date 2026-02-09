<?php
/**
 * GeneraCRUDphp - Vista Generada
 */
require_once '../config/config.php';
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_pacientes.php'; // Debe coincidir con el nombre_archivo en acc_programa
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

// Cargar permisos para el programa de anamnesis para controlar la visibilidad del botón
$programa_crea_anamnesis = 'vista_crear_anamnesis.php';
$permisos_crea_anamnesis = $_SESSION['permisos'][$programa_crea_anamnesis] ?? null;

// Generar Token CSRF de forma segura para evitar Fatal Errors en la vista
if (function_exists('generateCSRFToken')) {
    $csrf_token = generateCSRFToken();
} else {
    $csrf_token = $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
}

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$verTodos = (isset($_GET['verTodos']) && $_GET['verTodos'] == '1');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>

    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #32c8c8;
            --primary-gradient: linear-gradient(135deg, #32c8c8 0%, #2a5298 100%);
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
                    <h3 class="mb-0"><i class="icon-table me-2"></i> Pacientes</h3>
                    <small class="opacity-75">Gestión de Registros</small>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($permisos['exp']): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-premium dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="icon-export me-1"></i> Exportar
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="../controladores/controlador_pacientes.php?action=exportar&formato=excel&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>&verTodos=<?php echo $verTodos ? '1' : '0'; ?>"><i class="icon-file-excel text-success me-2"></i> Excel</a></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_pacientes.php?action=exportar&formato=csv&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>&verTodos=<?php echo $verTodos ? '1' : '0'; ?>"><i class="icon-file-text text-primary me-2"></i> CSV</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_pacientes.php?action=exportar&formato=txt&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>&verTodos=<?php echo $verTodos ? '1' : '0'; ?>"><i class="icon-doc-text-inv text-secondary me-2"></i> TXT</a></li>
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
                <form method="GET" action="vista_pacientes.php" class="mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" name="busqueda" class="form-control search-box p-2" placeholder="Buscar por cualquier campo..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                                <input type="hidden" name="action" value="buscar">
                                <input type="hidden" name="registrosPorPagina" value="<?= $registrosPorPagina ?>">
                                <button type="submit" class="btn search-btn px-4"><i class="icon-search"></i></button>
                                <?php if(isset($_GET['busqueda']) && $_GET['busqueda'] !== ''): ?>
                                    <a href="vista_pacientes.php" class="btn btn-outline-danger d-flex align-items-center"><i class="icon-cancel"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-check form-switch d-flex align-items-center mb-0">
                                <input class="form-check-input" type="checkbox" name="verTodos" id="verTodos" value="1" <?php echo $verTodos ? 'checked' : ''; ?> onchange="this.form.submit()" style="cursor: pointer; width: 3em; height: 1.5em;">
                                <label class="form-check-label ms-2 fw-bold text-muted" for="verTodos" style="cursor: pointer;">Ver todos los estados</label>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
<?php
$sort = $_GET['sort'] ?? null;
$dir = $_GET['dir'] ?? 'DESC';
$nextDir = ($dir === 'ASC') ? 'DESC' : 'ASC';
?>
                                <th>ID</th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`pacientes`.`fecha_ingreso`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Fecha Ingreso                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`pacientes`.`fecha_ingreso`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>

                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`pacientes`.`primer_nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Paciente                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`pacientes`.`primer_nombre`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`pacientes`.`telefono_principal`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Teléfono                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`pacientes`.`telefono_principal`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`pacientes`.`email`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Email                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`pacientes`.`email`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`estados_paciente`.`codigo`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Estado                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`estados_paciente`.`codigo`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../modelos/modelo_pacientes.php';
                            if (file_exists('../modelos/modelo_acc_log.php')) {
                                require_once '../modelos/modelo_acc_log.php';
                            } elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
                                require_once '../accesos/modelos/modelo_acc_log.php';
                            }
                            $modelo = new ModeloPacientes();
                            $modeloLog = new ModeloAcc_log();
                            $modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'VIEW', 'pacientes', 'Acceso a la pantalla de listado');
                            $termino = $_GET['busqueda'] ?? '';
                            $campoFiltro = $_GET['campo'] ?? '';
                            $registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
                            $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                            $offset = ($paginaActual - 1) * $registrosPorPagina;

                            if (isset($_GET['action']) && $_GET['action'] === 'buscar') {
                                if (!empty($campoFiltro) && !empty($termino)) {
                                     // Búsqueda avanzada por campo
                                     $totalRegistros = $modelo->contarPorCampo($campoFiltro, $termino, $verTodos);
                                     $registros = $modelo->buscarPorCampo($campoFiltro, $termino, $registrosPorPagina, $offset, $sort, $dir, $verTodos);
                                } else {
                                     // Búsqueda general
                                     $totalRegistros = $modelo->contarRegistrosPorBusqueda($termino, $verTodos);
                                     $registros = $modelo->buscar($termino, $registrosPorPagina, $offset, $sort, $dir, $verTodos);
                                }
                            } else {
                                $totalRegistros = $modelo->contarRegistros($verTodos);
                                $registros = $modelo->obtenerTodos($registrosPorPagina, $offset, $sort, $dir, $verTodos);
                            }

                            if ($registros):
                                // Obtener información de anamnesis para los pacientes listados
                                $pacientes_con_anamnesis = [];
                                if (!empty($registros)) {
                                    $ids = implode(',', array_column($registros, 'id'));
                                    $sqlAnam = "SELECT paciente_id, id FROM anamnesis WHERE paciente_id IN ($ids)";
                                    $resAnam = $modelo->getConexion()->query($sqlAnam);
                                    if ($resAnam) {
                                        while ($rowA = $resAnam->fetch_assoc()) {
                                            $pacientes_con_anamnesis[$rowA['paciente_id']] = $rowA['id'];
                                        }
                                    }
                                }

                                foreach ($registros as $registro):
                            ?>
                <tr>
                    <td><?php echo htmlspecialchars($registro['id']); ?></td>
                    <td><?php echo htmlspecialchars($registro['fecha_ingreso']); ?></td>

                    <td>
                        <strong><?php echo htmlspecialchars($registro['nombre_completo']); ?></strong><br>
                        <small class="text-muted"><?php echo htmlspecialchars(($registro['tipo_identificacion_id_display'] ?? '') . ': ' . $registro['identificacion']); ?></small>
                    </td>
                    <td><?php echo htmlspecialchars($registro['telefono_principal']); ?></td>
                    <td><?php echo htmlspecialchars($registro['email']); ?></td>
                    <td>
                        <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle rounded-pill">
                            <?php echo htmlspecialchars($registro['estado_paciente_id_display'] ?? $registro['estado_paciente_id']); ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                        <?php if ($permisos['upd']): 
                            $anamnesis_id = $pacientes_con_anamnesis[$registro['id']] ?? null;
                            $permiso_reporte = $_SESSION['permisos']['vista_historia_clinica_reporte.php'] ?? null;
                         ?>
                        <button type="button" class="btn btn-sm btn-outline-warning btn-editar-registro" 
                           data-id="<?php echo htmlspecialchars($registro['id']); ?>"
                           data-anamnesis-id="<?php echo htmlspecialchars($anamnesis_id); ?>"
                           data-tipo_identificacion_id="<?php echo htmlspecialchars($registro['tipo_identificacion_id']); ?>"
                           data-identificacion="<?php echo htmlspecialchars($registro['identificacion']); ?>"
                           data-fecha_ingreso="<?php echo htmlspecialchars($registro['fecha_ingreso']); ?>"
                           data-primer_nombre="<?php echo htmlspecialchars($registro['primer_nombre']); ?>"
                           data-segundo_nombre="<?php echo htmlspecialchars($registro['segundo_nombre']); ?>"
                           data-primer_apellido="<?php echo htmlspecialchars($registro['primer_apellido']); ?>"
                           data-segundo_apellido="<?php echo htmlspecialchars($registro['segundo_apellido']); ?>"
                           data-fecha_nacimiento="<?php echo htmlspecialchars($registro['fecha_nacimiento']); ?>"
                           data-id_pais="<?php echo htmlspecialchars($registro['id_pais']); ?>"
                           data-genero_id="<?php echo htmlspecialchars($registro['genero_id']); ?>"
                           data-grupo_sanguineo_id="<?php echo htmlspecialchars($registro['grupo_sanguineo_id']); ?>"
                           data-pais_residencia_id="<?php echo htmlspecialchars($registro['pais_residencia_id']); ?>"
                           data-departamento_id="<?php echo htmlspecialchars($registro['departamento_id']); ?>"
                           data-municipio_id="<?php echo htmlspecialchars($registro['municipio_id']); ?>"
                           data-localidad_id="<?php echo htmlspecialchars($registro['localidad_id']); ?>"
                           data-zona_residencia="<?php echo htmlspecialchars($registro['zona_residencia']); ?>"
                           data-telefono_principal="<?php echo htmlspecialchars($registro['telefono_principal']); ?>"
                           data-telefono_secundario="<?php echo htmlspecialchars($registro['telefono_secundario']); ?>"
                           data-email="<?php echo htmlspecialchars($registro['email']); ?>"
                           data-eps_id="<?php echo htmlspecialchars($registro['eps_id']); ?>"
                           data-id_regimen="<?php echo htmlspecialchars($registro['id_regimen']); ?>"
                           data-id_tipo_usuario="<?php echo htmlspecialchars($registro['id_tipo_usuario']); ?>"
                           data-ocupacion_id="<?php echo htmlspecialchars($registro['ocupacion_id']); ?>"
                           data-estado_civil_id="<?php echo htmlspecialchars($registro['estado_civil_id']); ?>"
                           data-identificacion_acompaniante="<?php echo htmlspecialchars($registro['identificacion_acompaniante']); ?>"
                           data-acompaniante_nombres="<?php echo htmlspecialchars($registro['acompaniante_nombres']); ?>"
                           data-acompaniante_apellidos="<?php echo htmlspecialchars($registro['acompaniante_apellidos']); ?>"
                           data-acompaniante_telefono="<?php echo htmlspecialchars($registro['acompaniante_telefono']); ?>"
                           data-acompañante_email="<?php echo htmlspecialchars($registro['acompañante_email']); ?>"
                           data-parentesco_id="<?php echo htmlspecialchars($registro['parentesco_id']); ?>"
                           data-foto_ruta="<?php echo htmlspecialchars($registro['foto_ruta']); ?>"
                           data-estado_paciente_id="<?php echo htmlspecialchars($registro['estado_paciente_id']); ?>"
                           data-usuario_id_inserto="<?php echo htmlspecialchars($registro['usuario_id_inserto']); ?>"
                           data-fecha_insercion="<?php echo htmlspecialchars($registro['fecha_insercion']); ?>"
                           data-usuario_id_actualizo="<?php echo htmlspecialchars($registro['usuario_id_actualizo']); ?>"
                           data-fecha_actualizacion="<?php echo htmlspecialchars($registro['fecha_actualizacion']); ?>"
                        > <i class="icon-edit"></i></button>

                        <?php if ($permiso_reporte): ?>
                        <a href="../controladores/controlador_reporte_historia.php?action=ver&id=<?php echo $registro['id']; ?>" 
                           class="btn btn-sm btn-outline-info" 
                           title="Ver Historia Clínica Histórica">
                            <i class="icon-doc-text-inv"></i>
                        </a>
                        <?php endif; ?>

                        <?php endif; ?>

                        <?php
                        // Mostrar botón Anamnesis si tiene el programa crea_anamnesis
                        if ($permisos_crea_anamnesis):
                            // El anamnesis_id ya fue calculado arriba para el botón de edición
                            if ($anamnesis_id):
                                // Si ya tiene anamnesis -> Editar (si tiene permiso de actualizar o insertar)
                                if ($permisos_crea_anamnesis['upd'] || $permisos_crea_anamnesis['ins']): ?>
                                    <a href="vista_editar_anamnesis.php?id=<?php echo $anamnesis_id; ?>" class="btn btn-sm btn-outline-info" title="Editar Anamnesis"><i class="icon-edit"></i> Anamnesis</a>
                                <?php endif;
                            else:
                                // Si no tiene anamnesis -> Crear (si tiene permiso de insertar)
                                if ($permisos_crea_anamnesis['ins']): ?>
                                    <a href="vista_crear_anamnesis.php?paciente_id=<?php echo $registro['id']; ?>" class="btn btn-sm btn-outline-info" title="Crear Anamnesis"><i class="icon-plus"></i> Anamnesis</a>
                                <?php endif;
                            endif;

                            // Opción de eliminar si tiene permiso
                            if ($anamnesis_id && $permisos_crea_anamnesis['del']): ?>
                                <button class="btn btn-sm btn-outline-danger" onclick="eliminarAnamnesis('<?php echo $anamnesis_id; ?>')" title="Eliminar Anamnesis"><i class="icon-trash"></i></button>
                            <?php endif;
                        endif; ?>


                        <?php if ($permisos['del']): ?>
                        <button class="btn btn-sm btn-outline-danger" onclick="eliminar('<?php echo htmlspecialchars($registro['id']); ?>')"> <i class="icon-trash-2"></i></button>
                        <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                                <tr><td colspan="7">No hay registros disponibles.</td></tr>
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
                        <a class="page-link" href="?pagina=<?= $i ?>&registrosPorPagina=<?= $registrosPorPagina ?>&action=<?= $_GET['action'] ?? '' ?>&busqueda=<?= urlencode($termino) ?>&campo=<?= urlencode($campoFiltro) ?>&verTodos=<?= $verTodos ? '1' : '0' ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

        <!-- Modal para crear -->
        <div class="modal fade shadow" id="modalCrear" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 overflow-hidden" style="border-radius: 20px;">
                    <div class="modal-header text-white d-flex justify-content-between align-items-center" style="background: var(--primary-gradient);">
                        <h5 class="modal-title fw-bold"><i class="icon-plus me-2"></i>Nuevo Registro</h5>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                    <div class="modal-body p-4">
                        <form id="formCrear" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_identificacion_id">Tipo ID:</label>
                                    <select class="form-select" id="tipo_identificacion_id" name="tipo_identificacion_id" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_tipo_identificacion_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="identificacion">Identificación:</label>
                                    <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_ingreso">Fecha Ingreso:</label>
                                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="primer_nombre">Primer Nombre:</label>
                                    <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_nombre">Segundo Nombre:</label>
                                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="primer_apellido">Primer Apellido:</label>
                                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_apellido">Segundo Apellido:</label>
                                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_pais">Nacionalidad:</label>
                                    <select class="form-select" id="id_pais" name="id_pais">
                                        <option value="">-- Seleccionar --</option>
                                        <?php
                                        $paises_nac = $modelo->obtenerRelacionado_id_pais();
                                        foreach ($paises_nac as $idx => $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>" <?= $idx === 0 ? 'selected' : '' ?>><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="genero_id">Género:</label>
                                    <select class="form-select" id="genero_id" name="genero_id" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_genero_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="grupo_sanguineo_id">Grupo Sanguíneo:</label>
                                    <select class="form-select" id="grupo_sanguineo_id" name="grupo_sanguineo_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_grupo_sanguineo_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Sección 2: Ubicación y Localización -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="border-bottom pb-2 text-primary">Ubicación y Localización</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="pais_residencia_id">País Residencia:</label>
                                    <select class="form-select" id="pais_residencia_id" name="pais_residencia_id" required onchange="cargarDepartamentos(this.value, 'departamento_id', 'municipio_id', 'localidad_id')">
                                        <option value="">-- Seleccionar --</option>
                                        <?php 
                                        $paises_res = $modelo->obtenerRelacionado_id_pais();
                                        foreach ($paises_res as $idx => $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>" <?= $idx === 0 ? 'selected' : '' ?>><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="departamento_id">Departamento:</label>
                                    <select class="form-select" id="departamento_id" name="departamento_id" required onchange="cargarMunicipios(this.value, 'municipio_id', 'localidad_id')">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="municipio_id">Municipio:</label>
                                    <select class="form-select" id="municipio_id" name="municipio_id" required onchange="cargarLocalidades(this.value, 'localidad_id')">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="localidad_id">Localidad:</label>
                                    <select class="form-select" id="localidad_id" name="localidad_id">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="zona_residencia">Zona Residencia:</label>
                                    <select class="form-select" id="zona_residencia" name="zona_residencia" required>
                                        <option value="U" selected>Urbana</option>
                                        <option value="R">Rural</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_principal">Teléfono Principal:</label>
                                    <input type="text" class="form-control" id="telefono_principal" name="telefono_principal">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_secundario">Teléfono Secundario:</label>
                                    <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="eps_id">EPS:</label>
                                    <select class="form-select" id="eps_id" name="eps_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_eps_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_regimen">Régimen:</label>
                                    <select class="form-select" id="id_regimen" name="id_regimen" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php 
                                        $regimenes = $modelo->obtenerRelacionado_id_regimen();
                                        foreach ($regimenes as $index => $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>" <?= $index === 0 ? 'selected' : '' ?>><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_tipo_usuario">Tipo Usuario:</label>
                                    <select class="form-select" id="id_tipo_usuario" name="id_tipo_usuario" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php 
                                        $tipos_u = $modelo->obtenerRelacionado_id_tipo_usuario();
                                        foreach ($tipos_u as $index => $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>" <?= $index === 0 ? 'selected' : '' ?>><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ocupacion_id">Ocupación:</label>
                                    <select class="form-select" id="ocupacion_id" name="ocupacion_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_ocupacion_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado_civil_id">Estado Civil:</label>
                                    <select class="form-select" id="estado_civil_id" name="estado_civil_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_estado_civil_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Sección 3: Acompañante/Responsable -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="border-bottom pb-2 text-primary">Datos de acompañante/Responsable</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="identificacion_acompaniante">ID_acompañante:</label>
                                    <input type="text" class="form-control" id="identificacion_acompaniante" name="identificacion_acompaniante">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="acompaniante_nombres">Nombres:</label>
                                    <input type="text" class="form-control" id="acompaniante_nombres" name="acompaniante_nombres">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="acompaniante_apellidos">Apellidos:</label>
                                    <input type="text" class="form-control" id="acompaniante_apellidos" name="acompaniante_apellidos">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="parentesco_id">Parentesco:</label>
                                    <select class="form-select" id="parentesco_id" name="parentesco_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_parentesco_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="acompaniante_telefono">Teléfono:</label>
                                    <input type="text" class="form-control" id="acompaniante_telefono" name="acompaniante_telefono">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="acompañante_email">Email:</label>
                                    <input type="text" class="form-control" id="acompañante_email" name="acompañante_email">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="estado_paciente_id">Estado del Paciente:</label>
                                    <select class="form-select" id="estado_paciente_id" name="estado_paciente_id">
                                        <?php foreach ($modelo->obtenerRelacionado_estado_paciente_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>" <?= ($opcion['texto'] == 'ACTIVO') ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($opcion['texto']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" id="foto_ruta" name="foto_ruta">
                            </div>
                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-light btn-premium me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" id="btnSaveExit" class="btn btn-premium btn-primary px-3"><i class="icon-ok-2 me-1"></i> Guardar y salir</button>
                                <?php if ($permisos_crea_anamnesis && $permisos_crea_anamnesis['ins']): ?>
                                <button type="submit" id="btnSaveContinue" class="btn btn-premium btn-info text-white px-3"><i class="icon-right-open me-1"></i> Guardar & Continuar</button>
                                <?php endif; ?>
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
                    <div class="modal-header text-white d-flex justify-content-between align-items-center" style="background: var(--primary-gradient);">
                        <h5 class="modal-title fw-bold"><i class="icon-edit me-2"></i>Editar Registro</h5>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                    <div class="modal-body p-4">
                    <form id="formActualizar" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                     <div class="mb-3 border-bottom pb-2">
                         <div class="row">
                             <div class="form-group col-md-8">
                               <h5 class="text-primary">Actualizar Paciente</h5>
                             </div>
                             <div class="form-group col-md-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <label class="me-2">ID:</label>
                                    <input type="text" class="form-control form-control-sm" id="id_u" name="id" readonly style="width: 80px;">
                                </div>
                             </div>
                         </div>
                     </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_identificacion_id_u">Tipo ID:</label>
                                    <select class="form-select" id="tipo_identificacion_id_u" name="tipo_identificacion_id" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_tipo_identificacion_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="identificacion_u">Identificación:</label>
                                    <input type="text" class="form-control" id="identificacion_u" name="identificacion" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_ingreso_u">Fecha Ingreso:</label>
                                    <input type="date" class="form-control" id="fecha_ingreso_u" name="fecha_ingreso" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="primer_nombre_u">Primer Nombre:</label>
                                    <input type="text" class="form-control" id="primer_nombre_u" name="primer_nombre" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_nombre_u">Segundo Nombre:</label>
                                    <input type="text" class="form-control" id="segundo_nombre_u" name="segundo_nombre">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="primer_apellido_u">Primer Apellido:</label>
                                    <input type="text" class="form-control" id="primer_apellido_u" name="primer_apellido" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_apellido_u">Segundo Apellido:</label>
                                    <input type="text" class="form-control" id="segundo_apellido_u" name="segundo_apellido">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_nacimiento_u">Fecha Nacimiento:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_u" name="fecha_nacimiento" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_pais_u">País:</label>
                                    <select class="form-select" id="id_pais_u" name="id_pais">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_id_pais() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="genero_id_u">Género:</label>
                                    <select class="form-select" id="genero_id_u" name="genero_id" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_genero_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="grupo_sanguineo_id_u">Grupo Sanguíneo:</label>
                                    <select class="form-select" id="grupo_sanguineo_id_u" name="grupo_sanguineo_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_grupo_sanguineo_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Sección 2: Ubicación y Localización -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="border-bottom pb-2 text-primary">Ubicación y Localización</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="pais_residencia_id_u">País Residencia:</label>
                                    <select class="form-select" id="pais_residencia_id_u" name="pais_residencia_id" required onchange="cargarDepartamentos(this.value, 'departamento_id_u', 'municipio_id_u', 'localidad_id_u')">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_id_pais() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="departamento_id_u">Departamento:</label>
                                    <select class="form-select" id="departamento_id_u" name="departamento_id" required onchange="cargarMunicipios(this.value, 'municipio_id_u', 'localidad_id_u')">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="municipio_id_u">Municipio:</label>
                                    <select class="form-select" id="municipio_id_u" name="municipio_id" required onchange="cargarLocalidades(this.value, 'localidad_id_u')">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="localidad_id_u">Localidad:</label>
                                    <select class="form-select" id="localidad_id_u" name="localidad_id">
                                        <option value="">-- Seleccionar --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="zona_residencia_u">Zona Residencia:</label>
                                    <select class="form-select" id="zona_residencia_u" name="zona_residencia" required>
                                        <option value="U">Urbana</option>
                                        <option value="R">Rural</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_principal_u">Teléfono Principal:</label>
                                    <input type="text" class="form-control" id="telefono_principal_u" name="telefono_principal">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_secundario_u">Teléfono Secundario:</label>
                                    <input type="text" class="form-control" id="telefono_secundario_u" name="telefono_secundario">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="email_u">Email:</label>
                                    <input type="email" class="form-control" id="email_u" name="email">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="eps_id_u">EPS:</label>
                                    <select class="form-select" id="eps_id_u" name="eps_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_eps_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_regimen_u">Régimen:</label>
                                    <select class="form-select" id="id_regimen_u" name="id_regimen" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_id_regimen() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="id_tipo_usuario_u">Tipo Usuario:</label>
                                    <select class="form-select" id="id_tipo_usuario_u" name="id_tipo_usuario" required>
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_id_tipo_usuario() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ocupacion_id_u">Ocupación:</label>
                                    <select class="form-select" id="ocupacion_id_u" name="ocupacion_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_ocupacion_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado_civil_id_u">Estado Civil:</label>
                                    <select class="form-select" id="estado_civil_id_u" name="estado_civil_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_estado_civil_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Sección 3: Acompañante/Responsable -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="border-bottom pb-2 text-primary">Datos de acompañante/Responsable</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="identificacion_acompaniante_u">ID_acompañante:</label>
                                    <input type="text" class="form-control" id="identificacion_acompaniante_u" name="identificacion_acompaniante">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="acompaniante_nombres_u">Nombres:</label>
                                    <input type="text" class="form-control" id="acompaniante_nombres_u" name="acompaniante_nombres">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="acompaniante_apellidos_u">Apellidos:</label>
                                    <input type="text" class="form-control" id="acompaniante_apellidos_u" name="acompaniante_apellidos">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="parentesco_id_u">Parentesco:</label>
                                    <select class="form-select" id="parentesco_id_u" name="parentesco_id">
                                        <option value="">-- Seleccionar --</option>
                                        <?php foreach ($modelo->obtenerRelacionado_parentesco_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="acompaniante_telefono_u">Teléfono:</label>
                                    <input type="text" class="form-control" id="acompaniante_telefono_u" name="acompaniante_telefono">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="acompañante_email_u">Email:</label>
                                    <input type="text" class="form-control" id="acompañante_email_u" name="acompañante_email">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="estado_paciente_id_u">Estado del Paciente:</label>
                                    <select class="form-select" id="estado_paciente_id_u" name="estado_paciente_id">
                                        <?php foreach ($modelo->obtenerRelacionado_estado_paciente_id() as $opcion): ?>
                                        <option value="<?= $opcion['id'] ?>">
                                            <?= htmlspecialchars($opcion['texto']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" id="foto_ruta_u" name="foto_ruta">
                            </div>
                                 <input type="hidden" id="idActualizar" name="idActualizar">
                                 <div class="text-end mt-4">
                                     <button type="button" class="btn btn-light btn-premium me-2" data-bs-dismiss="modal">Cancelar</button>
                                     <span id="anamnesis_btn_container_u"></span>
                                     <button type="submit" id="btnUpdateSave" class="btn btn-premium btn-warning text-white px-3"><i class="icon-ok-2 me-1"></i> Guardar y salir</button>
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
        // Definir constantes de URL para los controladores - CORRECCIÓN DE ERROR DE GUARDADO
        // HEMOS ELIMINADO LAS VARIABLES GLOBALES PARA EVITAR CONFLICTOS
        // Las rutas ahora están hardcodeadas en cada fetch: '../controladores/controlador_pacientes.php'

        const permisosAnamnesis = <?php echo json_encode($permisos_crea_anamnesis); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar modales
            const myModalCreate = new bootstrap.Modal(document.getElementById('modalCrear'));
            const modalElActualizar = document.getElementById('modalActualizar');
            const myModalActualizar = new bootstrap.Modal(modalElActualizar);

            let actionType = 'exit'; // 'exit' o 'continue'

            const btnSaveExit = document.getElementById('btnSaveExit');
            if (btnSaveExit) {
                btnSaveExit.addEventListener('click', () => { actionType = 'exit'; });
            }
            
            const btnSaveContinue = document.getElementById('btnSaveContinue');
            if (btnSaveContinue) {
                btnSaveContinue.addEventListener('click', () => { actionType = 'continue'; });
            }

            // Manejador del formulario crear
            document.getElementById('formCrear').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // Usamos ruta directa para evitar conflictos de variables globales
                fetch('../controladores/controlador_pacientes.php?action=crear', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    // Si data es un número (ID) o tiene success: true
                    const success = (typeof data === 'number' || data > 0 || data.success === true);
                    const newId = (typeof data === 'number') ? data : (data.id || null);

                    if(success) {
                        if (actionType === 'continue' && newId) {
                            window.location.href = `vista_crear_anamnesis.php?paciente_id=${newId}&source=edit`;
                        } else {
                            myModalCreate.hide();
                            location.reload();
                        }
                    } else if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        alert('Error al crear el registro: ' + JSON.stringify(data));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
                });
            });

            // Delegación de eventos para el botón editar (más robusto)
            document.body.addEventListener('click', function(event) {
                var button = event.target.closest('.btn-editar-registro');
                if (!button) return;

                // Inicializar modal bajo demanda para evitar conflictos
                var modalEl = document.getElementById('modalActualizar');
                // Usamos la instancia ya creada arriba si es posible
                var modalActualizar = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);

                // Cargar el ID para actualizar
                var idActualizar = button.getAttribute('data-id');
                var inputIdHidden = document.getElementById('idActualizar');
                if(inputIdHidden) inputIdHidden.value = idActualizar;

                // Lógica del botón Anamnesis en el modal
                const anamnesisId = button.getAttribute('data-anamnesis-id');
                const btnContainer = document.getElementById('anamnesis_btn_container_u');
                if (btnContainer && permisosAnamnesis) {
                    let btnHtml = '';
                    if (anamnesisId && anamnesisId !== '') {
                        if (permisosAnamnesis.upd || permisosAnamnesis.ins) {
                            btnHtml += `<a href="vista_editar_anamnesis.php?id=${anamnesisId}&source=edit" class="btn btn-sm btn-info text-white" title="Editar Anamnesis"><i class="icon-edit"></i> Anamnesis</a>`;
                        }
                        if (permisosAnamnesis.del) {
                            btnHtml += `<button type="button" class="btn btn-sm btn-danger ms-1" onclick="eliminarAnamnesis('${anamnesisId}')" title="Eliminar Anamnesis"><i class="icon-trash"></i></button>`;
                        }
                    } else {
                        if (permisosAnamnesis.ins) {
                            btnHtml += `<a href="vista_crear_anamnesis.php?paciente_id=${idActualizar}&source=edit" class="btn btn-sm btn-info text-white" title="Crear Anamnesis"><i class="icon-plus"></i> Anamnesis</a>`;
                        }
                    }
                    btnContainer.innerHTML = btnHtml;
                }

                var valorid = button.getAttribute('data-id');
                var inputid = document.getElementById('id_u');
                if(inputid) {
                    if (inputid.type === 'checkbox') {
                        inputid.checked = (valorid === 'activo');
                    } else {
                        inputid.value = valorid;
                    }
                }
                var valortipo_identificacion_id = button.getAttribute('data-tipo_identificacion_id');
                var inputtipo_identificacion_id = document.getElementById('tipo_identificacion_id_u');
                if(inputtipo_identificacion_id) {
                    if (inputtipo_identificacion_id.type === 'checkbox') {
                        inputtipo_identificacion_id.checked = (valortipo_identificacion_id === 'activo');
                    } else {
                        inputtipo_identificacion_id.value = valortipo_identificacion_id;
                    }
                }
                var valoridentificacion = button.getAttribute('data-identificacion');
                var inputidentificacion = document.getElementById('identificacion_u');
                if(inputidentificacion) {
                    if (inputidentificacion.type === 'checkbox') {
                        inputidentificacion.checked = (valoridentificacion === 'activo');
                    } else {
                        inputidentificacion.value = valoridentificacion;
                    }
                }
                var valorfecha_ingreso = button.getAttribute('data-fecha_ingreso');
                var inputfecha_ingreso = document.getElementById('fecha_ingreso_u');
                if(inputfecha_ingreso) {
                    if (inputfecha_ingreso.type === 'checkbox') {
                        inputfecha_ingreso.checked = (valorfecha_ingreso === 'activo');
                    } else {
                        inputfecha_ingreso.value = valorfecha_ingreso;
                    }
                }
                var valorprimer_nombre = button.getAttribute('data-primer_nombre');
                var inputprimer_nombre = document.getElementById('primer_nombre_u');
                if(inputprimer_nombre) {
                    if (inputprimer_nombre.type === 'checkbox') {
                        inputprimer_nombre.checked = (valorprimer_nombre === 'activo');
                    } else {
                        inputprimer_nombre.value = valorprimer_nombre;
                    }
                }
                var valorsegundo_nombre = button.getAttribute('data-segundo_nombre');
                var inputsegundo_nombre = document.getElementById('segundo_nombre_u');
                if(inputsegundo_nombre) {
                    if (inputsegundo_nombre.type === 'checkbox') {
                        inputsegundo_nombre.checked = (valorsegundo_nombre === 'activo');
                    } else {
                        inputsegundo_nombre.value = valorsegundo_nombre;
                    }
                }
                var valorprimer_apellido = button.getAttribute('data-primer_apellido');
                var inputprimer_apellido = document.getElementById('primer_apellido_u');
                if(inputprimer_apellido) {
                    if (inputprimer_apellido.type === 'checkbox') {
                        inputprimer_apellido.checked = (valorprimer_apellido === 'activo');
                    } else {
                        inputprimer_apellido.value = valorprimer_apellido;
                    }
                }
                var valorsegundo_apellido = button.getAttribute('data-segundo_apellido');
                var inputsegundo_apellido = document.getElementById('segundo_apellido_u');
                if(inputsegundo_apellido) {
                    if (inputsegundo_apellido.type === 'checkbox') {
                        inputsegundo_apellido.checked = (valorsegundo_apellido === 'activo');
                    } else {
                        inputsegundo_apellido.value = valorsegundo_apellido;
                    }
                }
                var valorfecha_nacimiento = button.getAttribute('data-fecha_nacimiento');
                var inputfecha_nacimiento = document.getElementById('fecha_nacimiento_u');
                if(inputfecha_nacimiento) {
                    if (inputfecha_nacimiento.type === 'checkbox') {
                        inputfecha_nacimiento.checked = (valorfecha_nacimiento === 'activo');
                    } else {
                        inputfecha_nacimiento.value = valorfecha_nacimiento;
                    }
                }
                var valorid_pais = button.getAttribute('data-id_pais');
                var inputid_pais = document.getElementById('id_pais_u');
                if(inputid_pais) {
                    if (inputid_pais.type === 'checkbox') {
                        inputid_pais.checked = (valorid_pais === 'activo');
                    } else {
                        inputid_pais.value = valorid_pais;
                    }
                }
                var valorgenero_id = button.getAttribute('data-genero_id');
                var inputgenero_id = document.getElementById('genero_id_u');
                if(inputgenero_id) {
                    if (inputgenero_id.type === 'checkbox') {
                        inputgenero_id.checked = (valorgenero_id === 'activo');
                    } else {
                        inputgenero_id.value = valorgenero_id;
                    }
                }
                var valorgrupo_sanguineo_id = button.getAttribute('data-grupo_sanguineo_id');
                var inputgrupo_sanguineo_id = document.getElementById('grupo_sanguineo_id_u');
                if(inputgrupo_sanguineo_id) {
                    if (inputgrupo_sanguineo_id.type === 'checkbox') {
                        inputgrupo_sanguineo_id.checked = (valorgrupo_sanguineo_id === 'activo');
                    } else {
                        inputgrupo_sanguineo_id.value = valorgrupo_sanguineo_id;
                    }
                }
                var valorpais_residencia_id = button.getAttribute('data-pais_residencia_id');
                var valordepartamento_id = button.getAttribute('data-departamento_id');
                var valormunicipio_id = button.getAttribute('data-municipio_id');
                var valorlocalidad_id = button.getAttribute('data-localidad_id');
                var valorzona_residencia = button.getAttribute('data-zona_residencia');

                var inputpais_residencia_id = document.getElementById('pais_residencia_id_u');
                if(inputpais_residencia_id) {
                    inputpais_residencia_id.value = valorpais_residencia_id;
                    // Cargar cascada de forma asíncrona pero secuencial
                    cargarDepartamentos(valorpais_residencia_id, 'departamento_id_u', 'municipio_id_u', 'localidad_id_u', valordepartamento_id)
                    .then(() => cargarMunicipios(valordepartamento_id, 'municipio_id_u', 'localidad_id_u', valormunicipio_id))
                    .then(() => cargarLocalidades(valormunicipio_id, 'localidad_id_u', valorlocalidad_id));
                }
                var inputzona_residencia = document.getElementById('zona_residencia_u');
                if(inputzona_residencia) inputzona_residencia.value = valorzona_residencia;
                var valortelefono_principal = button.getAttribute('data-telefono_principal');
                var inputtelefono_principal = document.getElementById('telefono_principal_u');
                if(inputtelefono_principal) {
                    if (inputtelefono_principal.type === 'checkbox') {
                        inputtelefono_principal.checked = (valortelefono_principal === 'activo');
                    } else {
                        inputtelefono_principal.value = valortelefono_principal;
                    }
                }
                var valortelefono_secundario = button.getAttribute('data-telefono_secundario');
                var inputtelefono_secundario = document.getElementById('telefono_secundario_u');
                if(inputtelefono_secundario) {
                    if (inputtelefono_secundario.type === 'checkbox') {
                        inputtelefono_secundario.checked = (valortelefono_secundario === 'activo');
                    } else {
                        inputtelefono_secundario.value = valortelefono_secundario;
                    }
                }
                var valoremail = button.getAttribute('data-email');
                var inputemail = document.getElementById('email_u');
                if(inputemail) {
                    if (inputemail.type === 'checkbox') {
                        inputemail.checked = (valoremail === 'activo');
                    } else {
                        inputemail.value = valoremail;
                    }
                }
                var valoreps_id = button.getAttribute('data-eps_id');
                var inputeps_id = document.getElementById('eps_id_u');
                if(inputeps_id) inputeps_id.value = valoreps_id;

                var valorid_regimen = button.getAttribute('data-id_regimen');
                var inputid_regimen = document.getElementById('id_regimen_u');
                if(inputid_regimen) inputid_regimen.value = valorid_regimen;

                var valorid_tipo_usuario = button.getAttribute('data-id_tipo_usuario');
                var inputid_tipo_usuario = document.getElementById('id_tipo_usuario_u');
                if(inputid_tipo_usuario) inputid_tipo_usuario.value = valorid_tipo_usuario;
                var valorocupacion_id = button.getAttribute('data-ocupacion_id');
                var inputocupacion_id = document.getElementById('ocupacion_id_u');
                if(inputocupacion_id) {
                    if (inputocupacion_id.type === 'checkbox') {
                        inputocupacion_id.checked = (valorocupacion_id === 'activo');
                    } else {
                        inputocupacion_id.value = valorocupacion_id;
                    }
                }
                var valorestado_civil_id = button.getAttribute('data-estado_civil_id');
                var inputestado_civil_id = document.getElementById('estado_civil_id_u');
                if(inputestado_civil_id) {
                    if (inputestado_civil_id.type === 'checkbox') {
                        inputestado_civil_id.checked = (valorestado_civil_id === 'activo');
                    } else {
                        inputestado_civil_id.value = valorestado_civil_id;
                    }
                }
                var valoridentificacion_acompaniante = button.getAttribute('data-identificacion_acompaniante');
                var inputidentificacion_acompaniante = document.getElementById('identificacion_acompaniante_u');
                if(inputidentificacion_acompaniante) {
                    if (inputidentificacion_acompaniante.type === 'checkbox') {
                        inputidentificacion_acompaniante.checked = (valoridentificacion_acompaniante === 'activo');
                    } else {
                        inputidentificacion_acompaniante.value = valoridentificacion_acompaniante;
                    }
                }
                var valoracompaniante_nombres = button.getAttribute('data-acompaniante_nombres');
                var inputacompaniante_nombres = document.getElementById('acompaniante_nombres_u');
                if(inputacompaniante_nombres) {
                    if (inputacompaniante_nombres.type === 'checkbox') {
                        inputacompaniante_nombres.checked = (valoracompaniante_nombres === 'activo');
                    } else {
                        inputacompaniante_nombres.value = valoracompaniante_nombres;
                    }
                }
                var valoracompaniante_apellidos = button.getAttribute('data-acompaniante_apellidos');
                var inputacompaniante_apellidos = document.getElementById('acompaniante_apellidos_u');
                if(inputacompaniante_apellidos) {
                    if (inputacompaniante_apellidos.type === 'checkbox') {
                        inputacompaniante_apellidos.checked = (valoracompaniante_apellidos === 'activo');
                    } else {
                        inputacompaniante_apellidos.value = valoracompaniante_apellidos;
                    }
                }
                var valoracompaniante_telefono = button.getAttribute('data-acompaniante_telefono');
                var inputacompaniante_telefono = document.getElementById('acompaniante_telefono_u');
                if(inputacompaniante_telefono) {
                    if (inputacompaniante_telefono.type === 'checkbox') {
                        inputacompaniante_telefono.checked = (valoracompaniante_telefono === 'activo');
                    } else {
                        inputacompaniante_telefono.value = valoracompaniante_telefono;
                    }
                }
                var valoracompañante_email = button.getAttribute('data-acompañante_email');
                var inputacompañante_email = document.getElementById('acompañante_email_u');
                if(inputacompañante_email) {
                    if (inputacompañante_email.type === 'checkbox') {
                        inputacompañante_email.checked = (valoracompañante_email === 'activo');
                    } else {
                        inputacompañante_email.value = valoracompañante_email;
                    }
                }
                var valorparentesco_id = button.getAttribute('data-parentesco_id');
                var inputparentesco_id = document.getElementById('parentesco_id_u');
                if(inputparentesco_id) {
                    if (inputparentesco_id.type === 'checkbox') {
                        inputparentesco_id.checked = (valorparentesco_id === 'activo');
                    } else {
                        inputparentesco_id.value = valorparentesco_id;
                    }
                }
                var valorfoto_ruta = button.getAttribute('data-foto_ruta');
                var inputfoto_ruta = document.getElementById('foto_ruta_u');
                if(inputfoto_ruta) {
                    if (inputfoto_ruta.type === 'checkbox') {
                        inputfoto_ruta.checked = (valorfoto_ruta === 'activo');
                    } else {
                        inputfoto_ruta.value = valorfoto_ruta;
                    }
                }
                var valorestado_paciente_id = button.getAttribute('data-estado_paciente_id');
                var inputestado_paciente_id = document.getElementById('estado_paciente_id_u');
                if(inputestado_paciente_id) {
                    if (inputestado_paciente_id.type === 'checkbox') {
                        inputestado_paciente_id.checked = (valorestado_paciente_id === 'activo');
                    } else {
                        inputestado_paciente_id.value = valorestado_paciente_id;
                    }
                }
                var valorusuario_id_inserto = button.getAttribute('data-usuario_id_inserto');
                var inputusuario_id_inserto = modalEl.querySelector('#usuario_id_inserto');
                if(inputusuario_id_inserto) {
                    if (inputusuario_id_inserto.type === 'checkbox') {
                        inputusuario_id_inserto.checked = (valorusuario_id_inserto === 'activo');
                    } else {
                        inputusuario_id_inserto.value = valorusuario_id_inserto;
                    }
                }
                var valorfecha_insercion = button.getAttribute('data-fecha_insercion');
                var inputfecha_insercion = modalEl.querySelector('#fecha_insercion');
                if(inputfecha_insercion) {
                    if (inputfecha_insercion.type === 'checkbox') {
                        inputfecha_insercion.checked = (valorfecha_insercion === 'activo');
                    } else {
                        inputfecha_insercion.value = valorfecha_insercion;
                    }
                }
                var valorusuario_id_actualizo = button.getAttribute('data-usuario_id_actualizo');
                var inputusuario_id_actualizo = modalEl.querySelector('#usuario_id_actualizo');
                if(inputusuario_id_actualizo) {
                    if (inputusuario_id_actualizo.type === 'checkbox') {
                        inputusuario_id_actualizo.checked = (valorusuario_id_actualizo === 'activo');
                    } else {
                        inputusuario_id_actualizo.value = valorusuario_id_actualizo;
                    }
                }
                var valorfecha_actualizacion = button.getAttribute('data-fecha_actualizacion');
                var inputfecha_actualizacion = modalEl.querySelector('#fecha_actualizacion');
                if(inputfecha_actualizacion) {
                    if (inputfecha_actualizacion.type === 'checkbox') {
                        inputfecha_actualizacion.checked = (valorfecha_actualizacion === 'activo');
                    } else {
                        inputfecha_actualizacion.value = valorfecha_actualizacion;
                    }
                }

                // Mostrar el modal manualmente
                modalActualizar.show();
            });

            document.getElementById('formActualizar').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // Usamos ruta directa para evitar conflictos
                fetch('../controladores/controlador_pacientes.php?action=actualizar', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if(data === true || data.success === true) {
                        // Cerrar modal y recargar
                        var modalEl = document.getElementById('modalActualizar');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        if(modal) modal.hide();
                        location.reload();
                    } else if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        alert('Error al actualizar el registro: ' + JSON.stringify(data));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
                });
            });

            // Lógica de auto-apertura de modal si viene el parámetro modal_edit_id
            const urlParams = new URLSearchParams(window.location.search);
            const modalEditId = urlParams.get('modal_edit_id');
            if (modalEditId) {
                // Buscamos el botón de edición para ese ID
                const editBtn = document.querySelector(`.btn-editar-registro[data-id="${modalEditId}"]`);
                if (editBtn) {
                    // Esperamos un momento a que todo esté cargado y disparamos el click
                    setTimeout(() => {
                        editBtn.click();
                    }, 500);
                }
            }
        });

        // Configuración dinámica de la URL del controlador
        <?php
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $uri = $_SERVER['PHP_SELF'];
            $project_name = 'OpticaHogar';
            $base_pos = strpos($uri, $project_name);
            if ($base_pos !== false) {
                $project_url = substr($uri, 0, $base_pos + strlen($project_name)) . '/';
            } else {
                $project_url = '/OpticaHogar/';
            }
            $controllerUrl = $project_url . 'controladores/controlador_pacientes.php';
        ?>
        const FIXED_CONTROLLER_URL = '<?php echo $controllerUrl; ?>';
        const FIXED_ANAMNESIS_URL = '<?php echo $project_url; ?>controladores/controlador_anamnesis.php';

        async function cargarDepartamentos(idPais, targetId, child1, child2, valSel = null) {
            console.log(`Cargando departamentos para pais: ${idPais}, target: ${targetId}, valSel: ${valSel}`);
            const target = document.getElementById(targetId);
            const c1 = document.getElementById(child1);
            const c2 = document.getElementById(child2);
            target.innerHTML = '<option value="">-- Seleccionar --</option>';
            if(c1) c1.innerHTML = '<option value="">-- Seleccionar --</option>';
            if(c2) c2.innerHTML = '<option value="">-- Seleccionar --</option>';

            try {
                // Usamos ruta directa
                const url = `../controladores/controlador_pacientes.php?action=getDepartamentos&id_pais=${idPais}`;
                console.log(`Fetch URL: ${url}`);
                
                // Retornar la promesa del fetch
                return fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(`Datos recibidos (depto):`, data);
                        data.forEach((item, index) => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.texto;
                            if(valSel) {
                                if(item.id == valSel) opt.selected = true;
                            } else if (index === 0) {
                                opt.selected = true;
                            }
                            target.appendChild(opt);
                        });
                        // Si no hay valor predefinido y hay datos, disparar el siguiente nivel
                        if (!valSel && data.length > 0) {
                            console.log(`Disparando cambio para ${targetId}`);
                            target.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(error => console.error('Error al cargar departamentos:', error));
            } catch (error) { 
                console.error('Error al cargar departamentos:', error); 
                return Promise.resolve(); // Retornar promesa vacía en error para no romper cadena
            }
        }

        function cargarMunicipios(idDepto, targetId, child1, valSel = null) {
            console.log(`Cargando municipios para depto: ${idDepto}, target: ${targetId}, valSel: ${valSel}`);
            const target = document.getElementById(targetId);
            const c1 = document.getElementById(child1);
            target.innerHTML = '<option value="">-- Seleccionar --</option>';
            if(c1) {
                c1.innerHTML = '<option value="">-- Seleccionar --</option>';
                c1.required = false; // Asegurar que no sea obligatorio al reiniciar
            }

            if(!idDepto) return Promise.resolve();

            try {
                // Usamos ruta directa
                const url = `../controladores/controlador_pacientes.php?action=getMunicipios&id_departamento=${idDepto}`;
                console.log(`Fetch URL: ${url}`);
                
                return fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(`Datos recibidos (mun):`, data);
                        data.forEach((item, index) => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.texto;
                            if(valSel) {
                                if(item.id == valSel) opt.selected = true;
                            } else if (index === 0) {
                                opt.selected = true;
                            }
                            target.appendChild(opt);
                        });
                        if (!valSel && data.length > 0) {
                            console.log(`Disparando cambio para ${targetId}`);
                            target.dispatchEvent(new Event('change'));
                        }
                    });
            } catch (error) { 
                console.error('Error al cargar municipios:', error); 
                return Promise.resolve();
            }
        }

        function cargarLocalidades(idMun, targetId, valSel = null) {
            console.log(`Cargando localidades para mun: ${idMun}, target: ${targetId}, valSel: ${valSel}`);
            const target = document.getElementById(targetId);
            target.innerHTML = '<option value="">-- Seleccionar --</option>';
            
            // Por defecto quitamos la obligatoriedad cuando cambia el municipio
            // Se reactivará solo si se encuentran localidades
            target.required = false;

            if(!idMun) return Promise.resolve();

            try {
                const url = `../controladores/controlador_pacientes.php?action=getLocalidades&id_municipio=${idMun}`;
                console.log(`Fetch URL: ${url}`);
                
                return fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(`Datos recibidos (loc):`, data);
                        // Si hay localidades, hacemos el campo obligatorio
                        if (data && data.length > 0) {
                            target.required = true;
                        } else {
                            target.required = false;
                        }

                        data.forEach((item, index) => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.textContent = item.texto;
                            if(valSel) {
                                if(item.id == valSel) opt.selected = true;
                            } else if (index === 0) {
                                opt.selected = true;
                            }
                            target.appendChild(opt);
                        });
                    });
            } catch (error) { 
                console.error('Error al cargar localidades:', error); 
                return Promise.resolve();
            }
        }

        // Inicializar cascada para formulario nuevo con un pequeño delay
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const paisNuevo = document.getElementById('pais_residencia_id');
                console.log("Iniciando auto-cascada. Pais detectado:", paisNuevo ? paisNuevo.value : 'no existe');
                if (paisNuevo && paisNuevo.value) {
                    cargarDepartamentos(paisNuevo.value, 'departamento_id', 'municipio_id', 'localidad_id');
                }
            }, 300);
        });

        function eliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                // Usamos ruta directa
                fetch(`../controladores/controlador_pacientes.php?action=eliminar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}&csrf_token=<?php echo $csrf_token; ?>`
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

        function eliminarAnamnesis(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro de anamnesis?')) {
                fetch(`${FIXED_ANAMNESIS_URL}?action=eliminar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(id)
                })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el registro de anamnesis.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud.');
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
            
            // Cargar departamentos automáticamente si hay un país seleccionado por defecto
            const paisSelect = document.getElementById('pais_residencia_id');
            if (paisSelect && paisSelect.value) {
                cargarDepartamentos(paisSelect.value, 'departamento_id', 'municipio_id', 'localidad_id')
                    .then(() => {
                        // Seleccionar primer departamento si existe
                        const deptoSelect = document.getElementById('departamento_id');
                        if (deptoSelect && deptoSelect.options.length > 1) {
                            deptoSelect.selectedIndex = 1; // Seleccionar el primer valor (índice 1, ya que 0 es "-- Seleccionar --")
                            return cargarMunicipios(deptoSelect.value, 'municipio_id', 'localidad_id');
                        }
                    })
                    .then(() => {
                        // Seleccionar primer municipio si existe
                        const muniSelect = document.getElementById('municipio_id');
                        if (muniSelect && muniSelect.options.length > 1) {
                            muniSelect.selectedIndex = 1;
                            return cargarLocalidades(muniSelect.value, 'localidad_id');
                        }
                    })
                    .then(() => {
                        // Seleccionar primera localidad si existe
                        const localSelect = document.getElementById('localidad_id');
                        if (localSelect && localSelect.options.length > 1) {
                            localSelect.selectedIndex = 1;
                        }
                    });
            }
        });
    </script>
    <script src="../js/ubicaciones.js"></script>
    </div>
</body>
</html>
