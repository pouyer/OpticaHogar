<?php
/**
 * Vista de listado de citas
 */
require_once '../accesos/verificar_sesion.php';

// Cargar permisos
$mi_programa = 'vista_cita.php';
$permisos = $_SESSION['permisos'][$mi_programa] ?? ['ins' => 0, 'upd' => 0, 'del' => 0, 'exp' => 0];

$registrosPorPagina = isset($_GET['registrosPorPagina']) ? (int)$_GET['registrosPorPagina'] : 15;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Parámetros de ordenamiento
$sort = $_GET['sort'] ?? '`cc`.`id`';
$dir = $_GET['dir'] ?? 'DESC';
$nextDir = ($dir === 'ASC') ? 'DESC' : 'ASC';

// Lógica para cargar datos si se accede directamente
if (!isset($registros) || !isset($totalRegistros)) {
    if (file_exists('../modelos/modelo_cita.php')) {
        require_once '../modelos/modelo_cita.php';
        $modelo = new ModeloCita();
        $totalRegistros = $modelo->contarRegistros();
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $registros = $modelo->obtenerTodos($registrosPorPagina, $offset, $sort, $dir);
    } else {
        $registros = [];
        $totalRegistros = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Citas</title>
    <?php include('../headIconos.php'); ?>
    <link rel="stylesheet" href="../css/estilos.css">
    <style>
        :root {
            --primary-color: #8d1111;
            --primary-gradient: linear-gradient(135deg, #8d1111 0%, #2a5298 100%);
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
    </style>
</head>
<body>
    <div class="container pb-5">
        <div class="main-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0"><i class="icon-calendar me-2"></i> Citas de Control</h3>
                    <small class="opacity-75">Gestión de Citas Optométricas</small>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($permisos['ins']): ?>
                    <a href="../controladores/controlador_cita.php?action=crear" class="btn btn-premium btn-warning text-white">
                        <i class="icon-plus me-1"></i> Nueva Cita
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`cc`.`id`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        ID
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`cc`.`id`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`cc`.`fecha_cita`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Fecha
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`cc`.`fecha_cita`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`cc`.`hora_cita`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Hora
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`cc`.`hora_cita`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`p`.`identificacion`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Paciente
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`p`.`identificacion`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`tc`.`nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Tipo Consulta
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`tc`.`nombre`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`ps`.`primer_nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Profesional
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`ps`.`primer_nombre`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="?<?php echo http_build_query(array_merge($_GET, ['sort' => "`ec`.`nombre`", 'dir' => $nextDir])); ?>" class="text-decoration-none text-muted">
                                        Estado
                                        <?php if (str_replace(['`',' '], '', $sort) === str_replace(['`',' '], '', "`ec`.`nombre`")): ?>
                                            <i class="icon-<?php echo ($dir === 'ASC') ? 'up-dir' : 'down-dir'; ?> ms-1"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($registros)): ?>
                                <?php foreach ($registros as $cita): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita['id']) ?></td>
                                    <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                                    <td><?= htmlspecialchars(substr($cita['hora_cita'], 0, 5)) ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($cita['paciente_nombre']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($cita['paciente_identificacion']) ?></small>
                                    </td>
                                    <td><?= htmlspecialchars($cita['tipo_consulta_nombre'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($cita['profesional_nombre'] ?? 'N/A') ?></td>
                                    <td>
                                        <?php if (isset($cita['estado_cita_color'])): ?>
                                            <span class="badge badge-status" style="background-color: <?= htmlspecialchars($cita['estado_cita_color']) ?>; color: white;">
                                                <?= htmlspecialchars($cita['estado_cita_nombre'] ?? 'N/A') ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-status bg-secondary">
                                                <?= htmlspecialchars($cita['estado_cita_nombre'] ?? 'N/A') ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if ($permisos['upd']): ?>
                                            <a href="../controladores/controlador_cita.php?action=editar&id=<?= $cita['id'] ?>" class="btn btn-sm btn-outline-warning">
                                                <i class="icon-edit"></i>
                                            </a>
                                            <?php endif; ?>
                                            <?php if ($permisos['del']): ?>
                                            <button class="btn btn-sm btn-outline-danger" onclick="eliminar(<?= $cita['id'] ?>)">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="8" class="text-center">No hay citas registradas.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mb-3">
                    <form method="GET" class="d-flex">
                        <label for="registrosPorPagina" class="mr-2">Registros por página:</label>
                        <select id="registrosPorPagina" name="registrosPorPagina" class="form-control mr-2" onchange="this.form.submit()">
                            <option value="15" <?= $registrosPorPagina == 15 ? 'selected' : '' ?>>15</option>
                            <option value="30" <?= $registrosPorPagina == 30 ? 'selected' : '' ?>>30</option>
                            <option value="50" <?= $registrosPorPagina == 50 ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= $registrosPorPagina == 100 ? 'selected' : '' ?>>100</option>
                        </select>
                        <input type="hidden" name="action" value="listar">
                        <input type="hidden" name="pagina" value="<?= $paginaActual ?>">
                    </form>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php
                        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                        for ($i = 1; $i <= $totalPaginas; $i++):
                        ?>
                            <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['pagina' => $i, 'action' => 'listar'])); ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function eliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta cita?')) {
                fetch('../controladores/controlador_cita.php?action=eliminar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(id)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al eliminar la cita.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar la cita: ' + error.message);
                });
            }
        }
    </script>
</body>
</html>
