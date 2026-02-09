<?php
// vista_rips.php
if (!isset($optometras)) die('Acceso denegado');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de RIPS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; padding: 20px; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .btn-primary { border-radius: 8px; font-weight: 500; }
        .table-container { background: white; border-radius: 12px; padding: 20px; margin-top: 20px; }
        .status-badge { font-size: 0.8rem; padding: 4px 8px; border-radius: 6px; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <h2 class="mb-4 fw-bold"><i class="bi bi-file-earmark-code me-2"></i>Generación de RIPS</h2>

            <div class="card mb-4">
                <div class="card-body">
                    <form id="formFiltros" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Profesional (Optómetra)</label>
                            <select name="profesional" id="profesional" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($optometras as $opt): ?>
                                    <option value="<?= $opt['identificacion'] ?>"><?= htmlspecialchars($opt['NOMBRE']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Año</label>
                            <select name="anio" id="anio" class="form-select">
                                <?php foreach ($anios as $a): ?>
                                    <option value="<?= $a ?>" <?= $a == date('Y') ? 'selected' : '' ?>><?= $a ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Mes</label>
                            <select name="mes" id="mes" class="form-select">
                                <?php foreach ($meses as $num => $nombre): ?>
                                    <option value="<?= $num ?>" <?= $num == date('n') ? 'selected' : '' ?>><?= $nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnConsultar" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-search me-1"></i> Consultar Registros
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="loading" class="text-center d-none my-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-muted">Consultando registros...</p>
            </div>

            <div id="resultadoContainer" class="d-none">
                <div class="table-container shadow-sm">
                    <div class="row align-items-center mb-3">
                        <div class="col-md-6">
                            <h5 class="mb-0 fw-bold">Registros Encontrados</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex gap-2 justify-content-end">
                                <input type="text" id="busquedaTabla" class="form-control form-control-sm" placeholder="Buscar en resultados..." style="max-width: 200px;">
                                <div class="btn-group">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="toggleAll(true)">Marcar Todo</button>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="toggleAll(false)">Desmarcar Todo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive" style="max-height: 500px;">
                        <table class="table table-hover align-middle">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th width="40"><input type="checkbox" id="checkGlobal" onclick="toggleAll(this.checked)"></th>
                                    <th style="cursor: pointer;" onclick="ordenar('fecha_inicio_atencion')">Fecha <i class="bi bi-arrow-down-up text-muted"></i></th>
                                    <th style="cursor: pointer;" onclick="ordenar('nombre_paciente')">Paciente <i class="bi bi-arrow-down-up text-muted"></i></th>
                                    <th style="cursor: pointer;" onclick="ordenar('num_doc_paciente')">Identificación <i class="bi bi-arrow-down-up text-muted"></i></th>
                                    <th style="cursor: pointer;" onclick="ordenar('cita_id')">Num Cita <i class="bi bi-arrow-down-up text-muted"></i></th>
                                    <th class="text-end" style="cursor: pointer;" onclick="ordenar('valor_neto_pagar')">Valor Neto <i class="bi bi-arrow-down-up text-muted"></i></th>
                                </tr>
                            </thead>
                            <tbody id="tablaCitas">
                                <!-- Datos cargados por AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-warning px-4" onclick="validarRIPS()">
                            <i class="bi bi-check-circle me-1"></i> Validar Datos
                        </button>
                        <button class="btn btn-success px-4" onclick="generar('JSON')">
                            <i class="bi bi-filetype-json me-1"></i> Generar JSON
                        </button>
                        <button class="btn btn-info px-4 text-white" onclick="generar('EXCEL')">
                            <i class="bi bi-file-earmark-excel me-1"></i> Generar EXCEL
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Errores de Validación -->
<div class="modal fade" id="modalValidacion" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Errores de Validación RIPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalValidacionBody">
                <!-- Contenido dinámico -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let dataCitas = [];
let seleccionadosSet = new Set();
let ordenActual = { columna: 'fecha_inicio_atencion', dir: 'asc' };

document.getElementById('busquedaTabla').addEventListener('input', (e) => {
    renderTable();
});

document.getElementById('btnConsultar').addEventListener('click', async () => {
    const form = document.getElementById('formFiltros');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);
    const container = document.getElementById('resultadoContainer');
    const loading = document.getElementById('loading');
    const tbody = document.getElementById('tablaCitas');

    container.classList.add('d-none');
    loading.classList.remove('d-none');
    tbody.innerHTML = '';
    seleccionadosSet.clear(); // Limpiar selecciones al nueva consulta

    try {
        const response = await fetch('controlador_rips.php?action=consultar', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (result.success) {
            dataCitas = result.registros;
            
            // Cargar selecciones previas si existen
            if (result.ultima_seleccion && Array.isArray(result.ultima_seleccion)) {
                result.ultima_seleccion.forEach(id => seleccionadosSet.add(parseInt(id)));
            }
            
            if (dataCitas.length === 0) {
                Swal.fire('Información', 'No se encontraron registros para el periodo seleccionado', 'info');
            } else {
                renderTable();
                container.classList.remove('d-none');
            }
        } else {
            Swal.fire('Error', result.error || 'Falla al consultar datos', 'error');
        }
    } catch (e) {
        Swal.fire('Error', 'Error de conexión con el servidor', 'error');
    } finally {
        loading.classList.add('d-none');
    }
});

function ordenar(columna) {
    if (ordenActual.columna === columna) {
        ordenActual.dir = ordenActual.dir === 'asc' ? 'desc' : 'asc';
    } else {
        ordenActual.columna = columna;
        ordenActual.dir = 'asc';
    }
    renderTable();
}

function renderTable() {
    const tbody = document.getElementById('tablaCitas');
    const termino = document.getElementById('busquedaTabla').value.toLowerCase();
    tbody.innerHTML = '';

    // Filtrar
    let filtrados = dataCitas.filter(cita => {
        return cita.nombre_paciente.toLowerCase().includes(termino) ||
               cita.num_doc_paciente.includes(termino) ||
               cita.cita_id.toString().includes(termino);
    });

    // Ordenar
    filtrados.sort((a, b) => {
        let valA = a[ordenActual.columna];
        let valB = b[ordenActual.columna];

        if (ordenActual.columna === 'valor_neto_pagar') {
            valA = parseFloat(valA);
            valB = parseFloat(valB);
        }

        if (valA < valB) return ordenActual.dir === 'asc' ? -1 : 1;
        if (valA > valB) return ordenActual.dir === 'asc' ? 1 : -1;
        return 0;
    });

    filtrados.forEach(cita => {
        const id = parseInt(cita.cita_id);
        const isChecked = seleccionadosSet.has(id);
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="checkbox" class="checkCita" value="${id}" ${isChecked ? 'checked' : ''} onchange="toggleFila(${id}, this.checked)"></td>
            <td>${cita.fecha_inicio_atencion}</td>
            <td>${cita.nombre_paciente}</td>
            <td>${cita.tipo_doc_paciente} ${cita.num_doc_paciente}</td>
            <td><b>${cita.cita_id}</b></td>
            <td class="text-end fw-bold text-primary">$${parseFloat(cita.valor_neto_pagar).toLocaleString()}</td>
        `;
        tbody.appendChild(tr);
    });
    
    // Actualizar checkGlobal visualmente
    actualizarCheckGlobal();
}

function toggleFila(id, checked) {
    if (checked) seleccionadosSet.add(id);
    else seleccionadosSet.delete(id);
    actualizarCheckGlobal();
}

function actualizarCheckGlobal() {
    const checkboxes = document.querySelectorAll('.checkCita');
    if(checkboxes.length === 0) {
        document.getElementById('checkGlobal').checked = false;
        return;
    }
    const allChecked = Array.from(checkboxes).every(chk => chk.checked);
    document.getElementById('checkGlobal').checked = allChecked;
}

function toggleAll(status) {
    const termino = document.getElementById('busquedaTabla').value.toLowerCase();
    
    // Solo afectar a los visibles por el filtro
    dataCitas.forEach(cita => {
        // Misma lógica de filtro
        if (cita.nombre_paciente.toLowerCase().includes(termino) ||
            cita.num_doc_paciente.includes(termino) ||
            cita.cita_id.toString().includes(termino)) {
            
            if (status) seleccionadosSet.add(parseInt(cita.cita_id));
            else seleccionadosSet.delete(parseInt(cita.cita_id));
        }
    });

    renderTable(); // Re-renderizar para actualizar checkboxes visibles
}

async function generar(formato) {
    const seleccionados = Array.from(seleccionadosSet);
    
    if (seleccionados.length === 0) {
        Swal.fire('Atención', 'Seleccione al menos una cita para generar el RIPS', 'warning');
        return;
    }

    const form = document.getElementById('formFiltros');
    const formData = new FormData(form);
    seleccionados.forEach(id => formData.append('citas[]', id));

    try {
        const action = formato === 'JSON' ? 'generarJson' : 'generarExcel';
        const response = await fetch(`controlador_rips.php?action=${action}`, {
            method: 'POST',
            body: formData
        });

        if (formato === 'EXCEL') {
            if (response.ok) {
                const blob = await response.blob();
                const num_doc = document.getElementById('profesional').value;
                const anio = document.getElementById('anio').value;
                const mes = document.getElementById('mes').value;
                descargarArchivo(blob, `RIPS_${num_doc}_${anio}_${mes}.csv`, 'text/csv');
                Swal.fire('Éxito', 'Archivo Excel (CSV) generado correctamente', 'success');
            } else {
                throw new Error('Error al generar el archivo Excel');
            }
            return;
        }

        const result = await response.json();
        if (result.success) {
            if (formato === 'JSON') {
                descargarArchivo(JSON.stringify(result.json, null, 2), result.filename, 'application/json');
            }
            Swal.fire('Éxito', 'RIPS generado correctamente y guardado en el historial', 'success');
        } else {
            Swal.fire('Error', result.error, 'error');
        }
    } catch (e) {
        Swal.fire('Error', 'Error al procesar la solicitud: ' + e.message, 'error');
    }
}

async function validarRIPS() {
    const seleccionados = Array.from(seleccionadosSet);
    
    if (seleccionados.length === 0) {
        Swal.fire('Atención', 'Seleccione al menos una cita para validar', 'warning');
        return;
    }

    const form = document.getElementById('formFiltros');
    const formData = new FormData(form);
    seleccionados.forEach(id => formData.append('citas[]', id));

    try {
        const response = await fetch('controlador_rips.php?action=validar', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.error) {
            Swal.fire('Error', result.error, 'error');
            return;
        }

        if (result.success) {
            Swal.fire('Éxito', result.mensaje, 'success');
        } else {
            // Mostrar errores en modal
            mostrarErroresValidacion(result);
        }
    } catch (e) {
        Swal.fire('Error', 'Error al validar: ' + e.message, 'error');
    }
}

function mostrarErroresValidacion(resultado) {
    const modalBody = document.getElementById('modalValidacionBody');
    
    let html = `
        <div class="alert alert-warning">
            <strong>Se encontraron ${resultado.total_errores} registros con errores de ${resultado.total_registros} seleccionados.</strong>
        </div>
    `;

    resultado.errores.forEach((item, index) => {
        html += `
            <div class="card mb-3 border-danger">
                <div class="card-header bg-danger text-white">
                    <strong>Registro ${index + 1}:</strong> ${item.paciente} - Fecha: ${item.fecha}
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        ${item.errores.map(err => `<li class="text-danger">${err}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `;
    });

    modalBody.innerHTML = html;
    
    const modal = new bootstrap.Modal(document.getElementById('modalValidacion'));
    modal.show();
}

function descargarArchivo(contenido, nombre, tipo) {
    const blob = (contenido instanceof Blob) ? contenido : new Blob([contenido], { type: tipo });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = nombre;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}
</script>

</body>
</html>
