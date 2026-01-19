<?php
/**
 * GeneraCRUDphp - Vista Generada
 */
require_once '../accesos/verificar_sesion.php';

// Cargar permisos para este programa
$mi_programa = 'vista_acc_programa.php'; // Debe coincidir con el nombre_archivo en acc_programa
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acc_programa</title>

    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #d747c3;
            --primary-gradient: linear-gradient(135deg, #d747c3 0%, #2a5298 100%);
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
                    <h3 class="mb-0"><i class="icon-table me-2"></i> Acc_programa</h3>
                    <small class="opacity-75">Gestión de Registros</small>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($permisos['exp']): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-premium dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="icon-export me-1"></i> Exportar
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="../controladores/controlador_acc_programa.php?action=exportar&formato=excel&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-excel text-success me-2"></i> Excel</a></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_acc_programa.php?action=exportar&formato=csv&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-file-text text-primary me-2"></i> CSV</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../controladores/controlador_acc_programa.php?action=exportar&formato=txt&busqueda=<?php echo isset($_GET['busqueda']) ? urlencode($_GET['busqueda']) : ''; ?>&campo=<?php echo isset($_GET['campo']) ? urlencode($_GET['campo']) : ''; ?>"><i class="icon-doc-text-inv text-secondary me-2"></i> TXT</a></li>
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
                <form method="GET" action="vista_acc_programa.php" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control search-box p-2" placeholder="Buscar por cualquier campo..." value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
                        <input type="hidden" name="action" value="buscar">
                        <input type="hidden" name="registrosPorPagina" value="<?= $registrosPorPagina ?>">
                        <button type="submit" class="btn search-btn px-4"><i class="icon-search"></i></button>
                        <?php if(isset($_GET['busqueda']) && $_GET['busqueda'] !== ''): ?>
                            <a href="vista_acc_programa.php" class="btn btn-outline-danger d-flex align-items-center"><i class="icon-cancel"></i></a>
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
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`id_programas`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        id_programas                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`id_programas`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_modulo`.`nombre_modulo`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        id_modulo                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_modulo`.`nombre_modulo`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`nombre_menu`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        nombre_menu                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`nombre_menu`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`icono`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        icono                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`icono`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`ruta`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        ruta                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`ruta`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`nombre_archivo`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        nombre_archivo                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`nombre_archivo`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`orden`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        orden                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`orden`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`acc_programa`.`estado`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        estado                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`acc_programa`.`estado`")): ?>                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>                                    </a>
                                </th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../modelos/modelo_acc_programa.php';
                            if (file_exists('../modelos/modelo_acc_log.php')) {
                                require_once '../modelos/modelo_acc_log.php';
                            } elseif (file_exists('../accesos/modelos/modelo_acc_log.php')) {
                                require_once '../accesos/modelos/modelo_acc_log.php';
                            }
                            $modelo = new ModeloAcc_programa();
                            $modeloLog = new ModeloAcc_log();
                            $modeloLog->registrar($_SESSION['usuario_id'] ?? 0, 'VIEW', 'acc_programa', 'Acceso a la pantalla de listado');
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
                    <td><?php echo htmlspecialchars($registro['id_programas']); ?></td>
                    <td><?php echo htmlspecialchars($registro['id_modulo_display'] ?? $registro['id_modulo']); ?></td>
                    <td><?php echo htmlspecialchars($registro['nombre_menu']); ?></td>
                    <td><?php echo htmlspecialchars($registro['icono']); ?></td>
                    <td><?php echo htmlspecialchars($registro['ruta']); ?></td>
                    <td><?php echo htmlspecialchars($registro['nombre_archivo']); ?></td>
                    <td><?php echo htmlspecialchars($registro['orden']); ?></td>
                    <td><?php echo htmlspecialchars($registro['estado']); ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                        <?php if ($permisos['upd']): ?>
                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalActualizar" data-idActualizar="<?php echo $registro['id_programas']; ?>"
                           data-id_programas="<?php echo htmlspecialchars($registro['id_programas']); ?>"
                           data-id_modulo="<?php echo htmlspecialchars($registro['id_modulo']); ?>"
                           data-nombre_menu="<?php echo htmlspecialchars($registro['nombre_menu']); ?>"
                           data-icono="<?php echo htmlspecialchars($registro['icono']); ?>"
                           data-ruta="<?php echo htmlspecialchars($registro['ruta']); ?>"
                           data-nombre_archivo="<?php echo htmlspecialchars($registro['nombre_archivo']); ?>"
                           data-orden="<?php echo htmlspecialchars($registro['orden']); ?>"
                           data-estado="<?php echo htmlspecialchars($registro['estado']); ?>"
                           data-fecha_creacion="<?php echo htmlspecialchars($registro['fecha_creacion']); ?>"
                           data-fecha_actualiza="<?php echo htmlspecialchars($registro['fecha_actualiza']); ?>"
                        > <i class="icon-edit"></i></button>
                        <?php endif; ?>

                        <?php if ($permisos['del']): ?>
                        <button class="btn btn-sm btn-outline-danger" onclick="eliminar('<?php echo htmlspecialchars($registro['id_programas']); ?>')"> <i class="icon-trash-2"></i></button>
                        <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                                <tr><td colspan="9">No hay registros disponibles.</td></tr>
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
                            <div class="row">                                <div class="col-md-4 mb-3">
                                    <label for="id_modulo">id_modulo:</label>
                                    <select class="form-select" id="id_modulo" name="id_modulo">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_id_modulo() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nombre_menu">nombre_menu:</label>
                                    <input type="text" class="form-control" id="nombre_menu" name="nombre_menu">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="icono">icono:</label>
                                    <input type="text" class="form-control" id="icono" name="icono">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-4 mb-3">
                                    <label for="ruta">ruta:</label>
                                    <input type="text" class="form-control" id="ruta" name="ruta">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nombre_archivo">nombre_archivo:</label>
                                    <input type="text" class="form-control" id="nombre_archivo" name="nombre_archivo">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="orden">orden:</label>
                                    <input type="number" class="form-control" id="orden" name="orden">
                                </div>
                            </div>                            <div class="row">                                <div class="col-md-4 mb-3">
                                    <label for="estado">estado:</label>
                                    <input type="text" class="form-control" id="estado" name="estado">
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
                               <h5 class="modal-title">Actualizar Acc_programa - ID: </h5>
                             </div>
                             <div class="form-group col-md-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <input type="text" class="form-control" id="id_programas" name="id_programas" readonly>
                                </div>
                             </div>
                         </div>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                         </button>
                     </div>
                            <div class="row">                                 <div class="col-md-4 mb-3">
                                     <label for="id_modulo">id_modulo:</label>
                                    <select class="form-select" id="id_modulo" name="id_modulo">
                                        <?php if('YES' == 'YES'): ?>                                        <option value="">-- Seleccionar --</option>
                                        <?php endif; ?>                                        <?php foreach ($modelo->obtenerRelacionado_id_modulo() as $opcion): ?>                                        <option value="<?= $opcion['id'] ?>"><?= htmlspecialchars($opcion['texto']) ?></option>
                                        <?php endforeach; ?>                                    </select>
                                </div>
                                 <div class="col-md-4 mb-3">
                                     <label for="nombre_menu">nombre_menu:</label>
                                     <input type="text" class="form-control" id="nombre_menu" name="nombre_menu">
                                </div>
                                 <div class="col-md-4 mb-3">
                                     <label for="icono">icono:</label>
                                     <input type="text" class="form-control" id="icono" name="icono">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-4 mb-3">
                                     <label for="ruta">ruta:</label>
                                     <input type="text" class="form-control" id="ruta" name="ruta">
                                </div>
                                 <div class="col-md-4 mb-3">
                                     <label for="nombre_archivo">nombre_archivo:</label>
                                     <input type="text" class="form-control" id="nombre_archivo" name="nombre_archivo">
                                </div>
                                 <div class="col-md-4 mb-3">
                                     <label for="orden">orden:</label>
                                     <input type="number" class="form-control" id="orden" name="orden">
                                </div>
                            </div>                            <div class="row">                                 <div class="col-md-4 mb-3">
                                     <label for="estado">estado:</label>
                                     <input type="text" class="form-control" id="estado" name="estado">
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
                fetch('../controladores/controlador_acc_programa.php?action=crear', {
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

                var valorid_programas = button.getAttribute('data-id_programas');
                var inputid_programas = modal.querySelector('#id_programas');
                if(inputid_programas) {
                    if (inputid_programas.type === 'checkbox') {
                        inputid_programas.checked = (valorid_programas === 'activo');
                    } else {
                        inputid_programas.value = valorid_programas;
                    }
                }
                var valorid_modulo = button.getAttribute('data-id_modulo');
                var inputid_modulo = modal.querySelector('#id_modulo');
                if(inputid_modulo) {
                    if (inputid_modulo.type === 'checkbox') {
                        inputid_modulo.checked = (valorid_modulo === 'activo');
                    } else {
                        inputid_modulo.value = valorid_modulo;
                    }
                }
                var valornombre_menu = button.getAttribute('data-nombre_menu');
                var inputnombre_menu = modal.querySelector('#nombre_menu');
                if(inputnombre_menu) {
                    if (inputnombre_menu.type === 'checkbox') {
                        inputnombre_menu.checked = (valornombre_menu === 'activo');
                    } else {
                        inputnombre_menu.value = valornombre_menu;
                    }
                }
                var valoricono = button.getAttribute('data-icono');
                var inputicono = modal.querySelector('#icono');
                if(inputicono) {
                    if (inputicono.type === 'checkbox') {
                        inputicono.checked = (valoricono === 'activo');
                    } else {
                        inputicono.value = valoricono;
                    }
                }
                var valorruta = button.getAttribute('data-ruta');
                var inputruta = modal.querySelector('#ruta');
                if(inputruta) {
                    if (inputruta.type === 'checkbox') {
                        inputruta.checked = (valorruta === 'activo');
                    } else {
                        inputruta.value = valorruta;
                    }
                }
                var valornombre_archivo = button.getAttribute('data-nombre_archivo');
                var inputnombre_archivo = modal.querySelector('#nombre_archivo');
                if(inputnombre_archivo) {
                    if (inputnombre_archivo.type === 'checkbox') {
                        inputnombre_archivo.checked = (valornombre_archivo === 'activo');
                    } else {
                        inputnombre_archivo.value = valornombre_archivo;
                    }
                }
                var valororden = button.getAttribute('data-orden');
                var inputorden = modal.querySelector('#orden');
                if(inputorden) {
                    if (inputorden.type === 'checkbox') {
                        inputorden.checked = (valororden === 'activo');
                    } else {
                        inputorden.value = valororden;
                    }
                }
                var valorestado = button.getAttribute('data-estado');
                var inputestado = modal.querySelector('#estado');
                if(inputestado) {
                    if (inputestado.type === 'checkbox') {
                        inputestado.checked = (valorestado === 'activo');
                    } else {
                        inputestado.value = valorestado;
                    }
                }
                var valorfecha_creacion = button.getAttribute('data-fecha_creacion');
                var inputfecha_creacion = modal.querySelector('#fecha_creacion');
                if(inputfecha_creacion) {
                    if (inputfecha_creacion.type === 'checkbox') {
                        inputfecha_creacion.checked = (valorfecha_creacion === 'activo');
                    } else {
                        inputfecha_creacion.value = valorfecha_creacion;
                    }
                }
                var valorfecha_actualiza = button.getAttribute('data-fecha_actualiza');
                var inputfecha_actualiza = modal.querySelector('#fecha_actualiza');
                if(inputfecha_actualiza) {
                    if (inputfecha_actualiza.type === 'checkbox') {
                        inputfecha_actualiza.checked = (valorfecha_actualiza === 'activo');
                    } else {
                        inputfecha_actualiza.value = valorfecha_actualiza;
                    }
                }
            });

            document.getElementById('formActualizar').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                fetch('../controladores/controlador_acc_programa.php?action=actualizar', {
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
                fetch('../controladores/controlador_acc_programa.php?action=eliminar', {
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
