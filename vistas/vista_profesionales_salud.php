<?php
/**
 * GeneraCRUDphp - Vista Generada
 */
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_profesionales_salud.php'; // Debe coincidir con el nombre_archivo en acc_programa
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesionales_salud</title>

    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #3cc8c8;
            --primary-gradient: linear-gradient(135deg, #3cc8c8 0%, #2a5298 100%);
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
                    <h3 class="mb-0"><i class="icon-table me-2"></i> Profesionales_salud</h3>
                    <small class="opacity-75">Gestión de Registros</small>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($permisos['exp']): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-premium dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="icon-export me-1"></i> Exportar
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="../controladores/controlador_profesionales_salud.php?action=exportar&formato=excel&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-excel text-success me-2"></i> Excel</a></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_profesionales_salud.php?action=exportar&formato=csv&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-text text-primary me-2"></i> CSV</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_profesionales_salud.php?action=exportar&formato=txt&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-doc-text-inv text-secondary me-2"></i> TXT</a></li>
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
                <form method="GET" action="vista_profesionales_salud.php" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control search-box p-2" placeholder="Buscar por cualquier campo..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                        <input type="hidden" name="action" value="buscar">
                        <input type="hidden" name="registrosPorPagina" value="<?= $registrosPorPagina ?>">
                        <button type="submit" class="btn search-btn px-4"><i class="icon-search"></i></button>
                        <?php if(isset($_GET['busqueda']) && $_GET['busqueda'] !== ''): ?>
                            <a href="vista_profesionales_salud.php" class="btn btn-outline-danger d-flex align-items-center"><i class="icon-cancel"></i></a>
                        <?php endif; ?>
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
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`identificacion`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        identificacion                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`identificacion`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`primer_nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        primer_nombre                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`primer_nombre`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`segundo_nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        segundo_nombre                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`segundo_nombre`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`primer_apellido`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        primer_apellido                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`primer_apellido`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`segundo_apellido`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        segundo_apellido                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`segundo_apellido`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`tipos_profesional`.`codigo`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        tipo_profesional_id                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`tipos_profesional`.`codigo`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`especialidad`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        especialidad                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`especialidad`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`telefono_principal`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        telefono_principal                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`telefono_principal`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`email`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        email                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`email`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_usuario`.`fullname`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        usuario_id                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_usuario`.`fullname`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`profesionales_salud`.`disponible`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        disponible                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`profesionales_salud`.`disponible`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../modelos/modelo_profesionales_salud.php';
                            if (file_exists('../modelos/modelo_acc_log.php')) {
                                require_once '../modelos/modelo_acc_log.php';
                            } elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
                                require_once '../accesos/modelos/modelo_acc_log.php';
                            }
                            $modelo = new ModeloProfesionales_salud();
                            $modeloLog = new ModeloAcc_log();
                            $modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'VIEW', 'profesionales_salud', 'Acceso a la pantalla de listado');
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
                    <td><?php echo htmlspecialchars($registro['identificacion']); ?></td>
                    <td><?php echo htmlspecialchars($registro['primer_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($registro['segundo_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($registro['primer_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($registro['segundo_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($registro['tipo_profesional_id_display'] ?? $registro['tipo_profesional_id']); ?></td>
                    <td><?php echo htmlspecialchars($registro['especialidad']); ?></td>
                    <td><?php echo htmlspecialchars($registro['telefono_principal']); ?></td>
                    <td><?php echo htmlspecialchars($registro['email']); ?></td>
                    <td><?php echo htmlspecialchars($registro['usuario_id_display'] ?? $registro['usuario_id']); ?></td>
                    <td><?php $isChecked = ($registro['disponible'] == 1 || $registro['disponible'] === true) ? 'checked' : ''; ?><div class="form-check form-switch d-flex justify-content-center ps-0"><input class="form-check-input" type="checkbox" disabled <?php echo $isChecked; ?>></div></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                        <?php if ($permisos['upd']): ?>
                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalActualizar" data-idActualizar="<?php echo $registro['id']; ?>"
                           data-id="<?php echo htmlspecialchars($registro['id']); ?>"
                           data-tipo_identificacion_id="<?php echo htmlspecialchars($registro['tipo_identificacion_id']); ?>"
                           data-identificacion="<?php echo htmlspecialchars($registro['identificacion']); ?>"
                           data-primer_nombre="<?php echo htmlspecialchars($registro['primer_nombre']); ?>"
                           data-segundo_nombre="<?php echo htmlspecialchars($registro['segundo_nombre']); ?>"
                           data-primer_apellido="<?php echo htmlspecialchars($registro['primer_apellido']); ?>"
                           data-segundo_apellido="<?php echo htmlspecialchars($registro['segundo_apellido']); ?>"
                           data-fecha_nacimiento="<?php echo htmlspecialchars($registro['fecha_nacimiento']); ?>"
                           data-genero_id="<?php echo htmlspecialchars($registro['genero_id']); ?>"
                           data-tipo_profesional_id="<?php echo htmlspecialchars($registro['tipo_profesional_id']); ?>"
                           data-especialidad="<?php echo htmlspecialchars($registro['especialidad']); ?>"
                           data-registro_profesional="<?php echo htmlspecialchars($registro['registro_profesional']); ?>"
                           data-codigo_prestador_minsalud="<?php echo htmlspecialchars($registro['codigo_prestador_minsalud']); ?>"
                           data-universidad="<?php echo htmlspecialchars($registro['universidad']); ?>"
                           data-anio_graduacion="<?php echo htmlspecialchars($registro['anio_graduacion']); ?>"
                           data-telefono_principal="<?php echo htmlspecialchars($registro['telefono_principal']); ?>"
                           data-telefono_secundario="<?php echo htmlspecialchars($registro['telefono_secundario']); ?>"
                           data-email="<?php echo htmlspecialchars($registro['email']); ?>"
                           data-direccion="<?php echo htmlspecialchars($registro['direccion']); ?>"
                           data-fecha_ingreso="<?php echo htmlspecialchars($registro['fecha_ingreso']); ?>"
                           data-jornada="<?php echo htmlspecialchars($registro['jornada']); ?>"
                           data-usuario_id="<?php echo htmlspecialchars($registro['usuario_id']); ?>"
                           data-disponible="<?php echo htmlspecialchars($registro['disponible']); ?>"
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
                                <tr><td colspan="12">No hay registros disponibles.</td></tr>
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
                                    <label for="tipo_identificacion_id">tipo_identificacion_id:</label>
                                    <select class="form-select" id="tipo_identificacion_id" name="tipo_identificacion_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_tipo_identificacion_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="identificacion">identificacion:</label>
                                    <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="primer_nombre">primer_nombre:</label>
                                    <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_nombre">segundo_nombre:</label>
                                    <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="primer_apellido">primer_apellido:</label>
                                    <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="segundo_apellido">segundo_apellido:</label>
                                    <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_nacimiento">fecha_nacimiento:</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="genero_id">genero_id:</label>
                                    <select class="form-select" id="genero_id" name="genero_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_genero_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="tipo_profesional_id">tipo_profesional_id:</label>
                                    <select class="form-select" id="tipo_profesional_id" name="tipo_profesional_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_tipo_profesional_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="especialidad">especialidad:</label>
                                    <input type="text" class="form-control" id="especialidad" name="especialidad">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="registro_profesional">registro_profesional:</label>
                                    <input type="text" class="form-control" id="registro_profesional" name="registro_profesional">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="codigo_prestador_minsalud">Código Prestador Minsalud:</label>
                                    <input type="text" class="form-control" id="codigo_prestador_minsalud" name="codigo_prestador_minsalud">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="universidad">universidad:</label>
                                    <input type="text" class="form-control" id="universidad" name="universidad">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="anio_graduacion">anio_graduacion:</label>
                                    <input type="text" class="form-control" id="anio_graduacion" name="anio_graduacion">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_principal">telefono_principal:</label>
                                    <input type="text" class="form-control" id="telefono_principal" name="telefono_principal">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="telefono_secundario">telefono_secundario:</label>
                                    <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="email">email:</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="direccion">direccion:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="fecha_ingreso">fecha_ingreso:</label>
                                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="jornada">jornada:</label>
                                    <input type="text" class="form-control" id="jornada" name="jornada">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="usuario_id">usuario_id:</label>
                                    <select class="form-select" id="usuario_id" name="usuario_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_usuario_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-3 mb-3">
                                    <label for="disponible">disponible:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="disponible" value="0">
                                        <input class="form-check-input" type="checkbox" id="disponible" name="disponible" value="1">
                                        <label class="form-check-label" for="disponible">Si/No</label>
                                    </div>
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
                               <h5 class="modal-title">Actualizar Profesionales_salud - ID: </h5>
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
                                     <label for="tipo_identificacion_id">tipo_identificacion_id:</label>
                                    <select class="form-select" id="tipo_identificacion_id" name="tipo_identificacion_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_tipo_identificacion_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="identificacion">identificacion:</label>
                                     <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="primer_nombre">primer_nombre:</label>
                                     <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="segundo_nombre">segundo_nombre:</label>
                                     <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="primer_apellido">primer_apellido:</label>
                                     <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" required>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="segundo_apellido">segundo_apellido:</label>
                                     <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="fecha_nacimiento">fecha_nacimiento:</label>
                                     <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="genero_id">genero_id:</label>
                                    <select class="form-select" id="genero_id" name="genero_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_genero_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="tipo_profesional_id">tipo_profesional_id:</label>
                                    <select class="form-select" id="tipo_profesional_id" name="tipo_profesional_id" required>
                                        <?php if('NO' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_tipo_profesional_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="especialidad">especialidad:</label>
                                     <input type="text" class="form-control" id="especialidad" name="especialidad">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="registro_profesional">registro_profesional:</label>
                                     <input type="text" class="form-control" id="registro_profesional" name="registro_profesional">
                                </div>
                                  <div class="col-md-3 mb-3">
                                      <label for="codigo_prestador_minsalud">Código Prestador Minsalud:</label>
                                      <input type="text" class="form-control" id="codigo_prestador_minsalud" name="codigo_prestador_minsalud">
                                  </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="universidad">universidad:</label>
                                     <input type="text" class="form-control" id="universidad" name="universidad">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="anio_graduacion">anio_graduacion:</label>
                                     <input type="text" class="form-control" id="anio_graduacion" name="anio_graduacion">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="telefono_principal">telefono_principal:</label>
                                     <input type="text" class="form-control" id="telefono_principal" name="telefono_principal">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="telefono_secundario">telefono_secundario:</label>
                                     <input type="text" class="form-control" id="telefono_secundario" name="telefono_secundario">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="email">email:</label>
                                     <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="direccion">direccion:</label>
                                     <input type="text" class="form-control" id="direccion" name="direccion">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="fecha_ingreso">fecha_ingreso:</label>
                                     <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="jornada">jornada:</label>
                                     <input type="text" class="form-control" id="jornada" name="jornada">
                                </div>
                                 <div class="col-md-3 mb-3">
                                     <label for="usuario_id">usuario_id:</label>
                                    <select class="form-select" id="usuario_id" name="usuario_id">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_usuario_id() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-3 mb-3">
                                     <label for="disponible">disponible:</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="disponible" value="0">
                                        <input class="form-check-input" type="checkbox" id="disponible" name="disponible" value="1">
                                        <label class="form-check-label" for="disponible">Si/No</label>
                                    </div>
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
                fetch('../controladores/controlador_profesionales_salud.php?action=crear', {
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
                var valortipo_identificacion_id = button.getAttribute('data-tipo_identificacion_id');
                var inputtipo_identificacion_id = modal.querySelector('#tipo_identificacion_id');
                if(inputtipo_identificacion_id) {
                    if (inputtipo_identificacion_id.type === 'checkbox') {
                        inputtipo_identificacion_id.checked = (valortipo_identificacion_id === 'activo');
                    } else {
                        inputtipo_identificacion_id.value = valortipo_identificacion_id;
                    }
                }
                var valoridentificacion = button.getAttribute('data-identificacion');
                var inputidentificacion = modal.querySelector('#identificacion');
                if(inputidentificacion) {
                    if (inputidentificacion.type === 'checkbox') {
                        inputidentificacion.checked = (valoridentificacion === 'activo');
                    } else {
                        inputidentificacion.value = valoridentificacion;
                    }
                }
                var valorprimer_nombre = button.getAttribute('data-primer_nombre');
                var inputprimer_nombre = modal.querySelector('#primer_nombre');
                if(inputprimer_nombre) {
                    if (inputprimer_nombre.type === 'checkbox') {
                        inputprimer_nombre.checked = (valorprimer_nombre === 'activo');
                    } else {
                        inputprimer_nombre.value = valorprimer_nombre;
                    }
                }
                var valorsegundo_nombre = button.getAttribute('data-segundo_nombre');
                var inputsegundo_nombre = modal.querySelector('#segundo_nombre');
                if(inputsegundo_nombre) {
                    if (inputsegundo_nombre.type === 'checkbox') {
                        inputsegundo_nombre.checked = (valorsegundo_nombre === 'activo');
                    } else {
                        inputsegundo_nombre.value = valorsegundo_nombre;
                    }
                }
                var valorprimer_apellido = button.getAttribute('data-primer_apellido');
                var inputprimer_apellido = modal.querySelector('#primer_apellido');
                if(inputprimer_apellido) {
                    if (inputprimer_apellido.type === 'checkbox') {
                        inputprimer_apellido.checked = (valorprimer_apellido === 'activo');
                    } else {
                        inputprimer_apellido.value = valorprimer_apellido;
                    }
                }
                var valorsegundo_apellido = button.getAttribute('data-segundo_apellido');
                var inputsegundo_apellido = modal.querySelector('#segundo_apellido');
                if(inputsegundo_apellido) {
                    if (inputsegundo_apellido.type === 'checkbox') {
                        inputsegundo_apellido.checked = (valorsegundo_apellido === 'activo');
                    } else {
                        inputsegundo_apellido.value = valorsegundo_apellido;
                    }
                }
                var valorfecha_nacimiento = button.getAttribute('data-fecha_nacimiento');
                var inputfecha_nacimiento = modal.querySelector('#fecha_nacimiento');
                if(inputfecha_nacimiento) {
                    if (inputfecha_nacimiento.type === 'checkbox') {
                        inputfecha_nacimiento.checked = (valorfecha_nacimiento === 'activo');
                    } else {
                        inputfecha_nacimiento.value = valorfecha_nacimiento;
                    }
                }
                var valorgenero_id = button.getAttribute('data-genero_id');
                var inputgenero_id = modal.querySelector('#genero_id');
                if(inputgenero_id) {
                    if (inputgenero_id.type === 'checkbox') {
                        inputgenero_id.checked = (valorgenero_id === 'activo');
                    } else {
                        inputgenero_id.value = valorgenero_id;
                    }
                }
                var valortipo_profesional_id = button.getAttribute('data-tipo_profesional_id');
                var inputtipo_profesional_id = modal.querySelector('#tipo_profesional_id');
                if(inputtipo_profesional_id) {
                    if (inputtipo_profesional_id.type === 'checkbox') {
                        inputtipo_profesional_id.checked = (valortipo_profesional_id === 'activo');
                    } else {
                        inputtipo_profesional_id.value = valortipo_profesional_id;
                    }
                }
                var valorespecialidad = button.getAttribute('data-especialidad');
                var inputespecialidad = modal.querySelector('#especialidad');
                if(inputespecialidad) {
                    if (inputespecialidad.type === 'checkbox') {
                        inputespecialidad.checked = (valorespecialidad === 'activo');
                    } else {
                        inputespecialidad.value = valorespecialidad;
                    }
                }
                var valorregistro_profesional = button.getAttribute('data-registro_profesional');
                var inputregistro_profesional = modal.querySelector('#registro_profesional');
                if(inputregistro_profesional) {
                    if (inputregistro_profesional.type === 'checkbox') {
                        inputregistro_profesional.checked = (valorregistro_profesional === 'activo');
                    } else {
                        inputregistro_profesional.value = valorregistro_profesional;
                    }
                }
                var valorcodigo_prestador_minsalud = button.getAttribute('data-codigo_prestador_minsalud');
                var inputcodigo_prestador_minsalud = modal.querySelector('#codigo_prestador_minsalud');
                if(inputcodigo_prestador_minsalud) {
                    if (inputcodigo_prestador_minsalud.type === 'checkbox') {
                        inputcodigo_prestador_minsalud.checked = (valorcodigo_prestador_minsalud === 'activo');
                    } else {
                        inputcodigo_prestador_minsalud.value = valorcodigo_prestador_minsalud;
                    }
                }
                var valoruniversidad = button.getAttribute('data-universidad');
                var inputuniversidad = modal.querySelector('#universidad');
                if(inputuniversidad) {
                    if (inputuniversidad.type === 'checkbox') {
                        inputuniversidad.checked = (valoruniversidad === 'activo');
                    } else {
                        inputuniversidad.value = valoruniversidad;
                    }
                }
                var valoranio_graduacion = button.getAttribute('data-anio_graduacion');
                var inputanio_graduacion = modal.querySelector('#anio_graduacion');
                if(inputanio_graduacion) {
                    if (inputanio_graduacion.type === 'checkbox') {
                        inputanio_graduacion.checked = (valoranio_graduacion === 'activo');
                    } else {
                        inputanio_graduacion.value = valoranio_graduacion;
                    }
                }
                var valortelefono_principal = button.getAttribute('data-telefono_principal');
                var inputtelefono_principal = modal.querySelector('#telefono_principal');
                if(inputtelefono_principal) {
                    if (inputtelefono_principal.type === 'checkbox') {
                        inputtelefono_principal.checked = (valortelefono_principal === 'activo');
                    } else {
                        inputtelefono_principal.value = valortelefono_principal;
                    }
                }
                var valortelefono_secundario = button.getAttribute('data-telefono_secundario');
                var inputtelefono_secundario = modal.querySelector('#telefono_secundario');
                if(inputtelefono_secundario) {
                    if (inputtelefono_secundario.type === 'checkbox') {
                        inputtelefono_secundario.checked = (valortelefono_secundario === 'activo');
                    } else {
                        inputtelefono_secundario.value = valortelefono_secundario;
                    }
                }
                var valoremail = button.getAttribute('data-email');
                var inputemail = modal.querySelector('#email');
                if(inputemail) {
                    if (inputemail.type === 'checkbox') {
                        inputemail.checked = (valoremail === 'activo');
                    } else {
                        inputemail.value = valoremail;
                    }
                }
                var valordireccion = button.getAttribute('data-direccion');
                var inputdireccion = modal.querySelector('#direccion');
                if(inputdireccion) {
                    if (inputdireccion.type === 'checkbox') {
                        inputdireccion.checked = (valordireccion === 'activo');
                    } else {
                        inputdireccion.value = valordireccion;
                    }
                }
                var valorfecha_ingreso = button.getAttribute('data-fecha_ingreso');
                var inputfecha_ingreso = modal.querySelector('#fecha_ingreso');
                if(inputfecha_ingreso) {
                    if (inputfecha_ingreso.type === 'checkbox') {
                        inputfecha_ingreso.checked = (valorfecha_ingreso === 'activo');
                    } else {
                        inputfecha_ingreso.value = valorfecha_ingreso;
                    }
                }
                var valorjornada = button.getAttribute('data-jornada');
                var inputjornada = modal.querySelector('#jornada');
                if(inputjornada) {
                    if (inputjornada.type === 'checkbox') {
                        inputjornada.checked = (valorjornada === 'activo');
                    } else {
                        inputjornada.value = valorjornada;
                    }
                }
                var valorusuario_id = button.getAttribute('data-usuario_id');
                var inputusuario_id = modal.querySelector('#usuario_id');
                if(inputusuario_id) {
                    if (inputusuario_id.type === 'checkbox') {
                        inputusuario_id.checked = (valorusuario_id === 'activo');
                    } else {
                        inputusuario_id.value = valorusuario_id;
                    }
                }
                var valordisponible = button.getAttribute('data-disponible');
                var inputdisponible = modal.querySelector('#disponible');
                if(inputdisponible) {
                    if (inputdisponible.type === 'checkbox') {
                        inputdisponible.checked = (valordisponible == '1' || valordisponible == 'true');
                    } else {
                        inputdisponible.value = valordisponible;
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
                fetch('../controladores/controlador_profesionales_salud.php?action=actualizar', {
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
                fetch('../controladores/controlador_profesionales_salud.php?action=eliminar', {
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
