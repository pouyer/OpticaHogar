<?php
/**
 * Vista del Reporte de Historia Clínica Histórica
 * Esta vista es utilizada tanto para visualización web como para generación de PDF
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>HC_<?php echo htmlspecialchars($paciente['nombre_completo']) . '_' . date('YmdHi'); ?></title>
    <link rel="stylesheet" href="../css/estilos.css">
    <?php include('../headIconos.php'); ?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .report-container {
            width: 95%;
            max-width: 1000px;
            margin: 10px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #8d1111;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo-area img {
            max-height: 80px;
        }
        .company-info {
            text-align: right;
        }
        .company-info h2 {
            margin: 0;
            color: #8d1111;
            font-size: 24px;
        }
        .section-title {
            background: #f4f4f4;
            padding: 8px 15px;
            color: #8d1111;
            font-weight: bold;
            text-transform: uppercase;
            border-left: 5px solid #8d1111;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .data-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px 15px;
        }
        .data-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px 15px;
        }
        .data-item {
            margin-bottom: 5px;
        }
        .data-label {
            font-weight: bold;
            color: #666;
            font-size: 0.9em;
        }
        .data-value {
            border-bottom: 1px dotted #ccc;
            padding-bottom: 2px;
        }
        
        /* Timeline Styles */
        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
        }
        .timeline:before {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50px;
            width: 2px;
            background: #ddd;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 50px;
            padding-left: 80px;
        }
        .timeline-date {
            position: absolute;
            left: 0;
            width: 50px;
            text-align: center;
        }
        .timeline-date .day {
            font-size: 18px;
            font-weight: bold;
            display: block;
            color: #8d1111;
        }
        .timeline-date .month {
            font-size: 12px;
            text-transform: uppercase;
            color: #999;
        }
        .timeline-badge {
            position: absolute;
            left: 41px;
            top: 5px;
            width: 20px;
            height: 20px;
            background: #8d1111;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .timeline-content {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        .timeline-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .timeline-header h4 {
            margin: 0;
            color: #333;
        }
        .professional-name {
            font-style: italic;
            color: #777;
            font-size: 0.9em;
        }

        .consultation-box {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .findings-label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-top: 10px;
            font-size: 0.85em;
        }
        .findings-value {
            background: #fdfdfd;
            padding: 8px;
            border-radius: 4px;
            font-size: 0.95em;
            border: 1px solid #f0f0f0;
        }
        .data-table-mini {
            width: 100%;
            font-size: 0.85em;
            margin-top: 5px;
            border-collapse: collapse;
        }
        .data-table-mini th, .data-table-mini td {
            border: 1px solid #eee;
            padding: 4px;
            text-align: center;
        }
        .data-table-mini th {
            background: #f9f9f9;
            color: #666;
        }

        @media print {
            @page {
                size: letter;
                margin: 1.5cm;
            }
            body { background: #fff; }
            .report-container { 
                box-shadow: none; 
                margin: 0; 
                padding: 0; 
                width: 100%; 
                max-width: 100%; 
            }
            .no-print { display: none; }
            .timeline:before { left: 50px; }
            
            /* Pie de página fijo en impresión */
            .print-footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 10px;
                color: #777;
                border-top: 1px solid #eee;
                padding-top: 5px;
                background: white;
            }
            .page-number:after {
                content: "Página " counter(page);
            }
            /* Solo evitar saltos dentro de bloques pequeños o tablas */
            .consultation-box, .data-grid, .data-grid-4, .data-table-mini {
                page-break-inside: avoid;
            }
            /* Las consultas largas (timeline-item) pueden romperse entre páginas si es necesario */
            .timeline-item {
                page-break-inside: auto;
            }
            .section-title {
                page-break-after: avoid !important;
                break-after: avoid !important;
            }
            /* Reducir margen superior de la línea de tiempo para ganar espacio */
            .timeline {
                margin-top: 0 !important;
                padding-top: 5px !important;
            }
        }

        /* Estilo oculto en pantalla para el footer de impresión */
        .print-footer {
            display: none;
        }

        /* Botones Base */
        .btn-action {
            padding: 12px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        /* Estilos Responsivos para Móvil */
        @media (max-width: 768px) {
            .report-container {
                width: 100%;
                padding: 15px;
                margin: 0;
                border-radius: 0;
            }
            .data-grid, .data-grid-4 {
                grid-template-columns: 1fr 1fr;
            }
            .consultation-box {
                grid-template-columns: 1fr;
            }
            .btn-action {
                display: flex;
                width: 100%;
                margin-bottom: 10px;
                border-radius: 8px;
                position: static !important;
            }
            .no-print-mobile {
                display: none !important;
            }
            .logo-area img {
                max-height: 50px;
            }
            .company-info h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <?php if (!isset($esEmail) || !$esEmail): ?>
    <div class="no-print" style="position: fixed; bottom: 20px; width: 100%; z-index: 1000; padding: 0 20px; pointer-events: none;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; max-width: 1000px; margin: 0 auto;">
            <a href="../vistas/vista_pacientes.php" class="btn-action pointer-events-auto" style="background: #6c757d; color: #fff;">
                <i class="icon-left-open"></i> <span class="no-print-mobile">Volver</span>
            </a>
            
            <div style="display: flex; gap: 10px;" class="pointer-events-auto">
                <a href="../controladores/controlador_cita.php?action=crear&paciente_id=<?php echo $paciente['id']; ?>" class="btn-action btn-new-cita no-print-mobile" style="background: #ffc107; color: #000;">
                    <i class="icon-plus"></i> Nueva Consulta
                </a>

                <button class="btn-action btn-email" data-bs-toggle="modal" data-bs-target="#modalEmail" style="background: #198754; color: #fff;">
                    <i class="icon-mail"></i> <span class="no-print-mobile">Enviar por Correo</span>
                </button>

                <button class="btn-action btn-print no-print-mobile" onclick="prepararImpresion();" style="background: #8d1111; color: #fff;">
                    <i class="icon-print"></i> <span class="no-print-mobile">Imprimir / PDF</span>
                </button>
            </div>
        </div>
    </div>
    <style>.pointer-events-auto { pointer-events: auto; }</style>
    <?php endif; ?>

    <div class="report-container">
        <!-- Header -->
        <div class="report-header">
            <div class="logo-area">
                <img src="<?php echo $logoUrl ?? '../assets/img/logo.png'; ?>" alt="Logo" style="max-width: 150px;" onerror="this.src='https://via.placeholder.com/150x80?text=Optica+Hogar'">
            </div>
            <div class="company-info">
                <h2><?php echo APP_NAME; ?></h2>
                <p>Reporte de Historia Clínica Consolidada<br>
                Fecha del reporte: <?php echo date('d/m/Y H:i'); ?></p>
            </div>
        </div>

        <!-- Paciente -->
        <div class="section-title">Información del Paciente</div>
        <div class="data-grid">
            <div class="data-item">
                <span class="data-label">Nombre Completo:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['nombre_completo']); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Identificación:</span>
                <div class="data-value"><?php echo htmlspecialchars(($paciente['tipo_identificacion_nombre'] ?? '') . ' ' . $paciente['identificacion']); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Fecha de Nacimiento:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['fecha_nacimiento']); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Edad:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['paciente_edad'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Género:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['genero_nombre'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Email:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['email'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Teléfono:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['telefono_principal'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">EPS:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['eps_nombre'] ?? 'Particular'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Ocupación:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['ocupacion_nombre'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Estado Civil:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['estado_civil_nombre'] ?? 'N/A'); ?></div>
            </div>
            <div class="data-item">
                <span class="data-label">Grupo Sanguíneo:</span>
                <div class="data-value"><?php echo htmlspecialchars($paciente['grupo_sanguineo_nombre'] ?? 'N/A'); ?></div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
            <div>
                <span class="data-label">Dirección y Localización:</span>
                <div class="data-value">
                    <?php echo htmlspecialchars($paciente['direccion'] ?? ''); ?><br>
                    <?php echo htmlspecialchars(($paciente['localidad'] ? $paciente['localidad'] . ', ' : '') . ($paciente['ciudad'] ?? '') . ' (' . ($paciente['departamento'] ?? '') . ')'); ?>
                </div>
            </div>
            <div>
                <span class="data-label">Contacto de Emergencia / Acompañante:</span>
                <div class="data-value">
                    <strong><?php echo htmlspecialchars(($paciente['acompaniante_nombres'] ?? '') . ' ' . ($paciente['acompaniante_apellidos'] ?? '')); ?></strong>
                    <?php echo $paciente['parentesco_nombre'] ? ' (' . htmlspecialchars($paciente['parentesco_nombre']) . ')' : ''; ?><br>
                    <?php if($paciente['identificacion_acompaniante']): ?>
                        Doc: <?php echo htmlspecialchars($paciente['identificacion_acompaniante']); ?> | 
                    <?php endif; ?>
                    Tel: <?php echo htmlspecialchars($paciente['acompaniante_telefono'] ?? 'N/A'); ?>
                </div>
            </div>
        </div>

        <!-- Anamnesis -->
        <div class="section-title">Anamnesis y Antecedentes</div>
        <?php if ($anamnesis): ?>
            <!-- Antecedentes Oftalmológicos (Booleanos en 4 columnas) -->
            <div class="data-grid-4">
                <div class="data-item">
                    <span class="data-label">Glaucoma:</span>
                    <div class="data-value"><?php echo $anamnesis['glaucoma'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">Catarata:</span>
                    <div class="data-value"><?php echo $anamnesis['catarata'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">Estrabismo:</span>
                    <div class="data-value"><?php echo $anamnesis['estrabismo'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">Ojo Vago:</span>
                    <div class="data-value"><?php echo $anamnesis['ojo_vago'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">D. Retina:</span>
                    <div class="data-value"><?php echo $anamnesis['desprendimiento_retina'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">Conj. Alérgica:</span>
                    <div class="data-value"><?php echo $anamnesis['conjuntivitis_alergica'] ? 'SÍ' : 'NO'; ?></div>
                </div>
                <div class="data-item">
                    <span class="data-label">Cx. Catarata:</span>
                    <div class="data-value"><?php echo $anamnesis['fecha_cirugia_catarata'] ?: 'N/A'; ?></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
                <div>
                    <span class="data-label">Otros Antecedentes Oftalmológicos:</span>
                    <div class="data-value"><?php echo htmlspecialchars($anamnesis['otros_antecedentes_oftalmologicos'] ?: 'Ninguno'); ?></div>
                </div>
                <div>
                    <span class="data-label">Antecedentes Familiares:</span>
                    <div class="data-value"><?php echo htmlspecialchars($anamnesis['familiares_otros'] ?: 'Ninguno'); ?></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
                <div>
                    <span class="data-label">Antecedentes Quirúrgicos:</span>
                    <div class="data-value"><?php echo htmlspecialchars($anamnesis['antecedentes_quirurgicos'] ?: 'Ninguno'); ?></div>
                </div>
                <div>
                    <span class="data-label">Otras Enfermedades Sistémicas:</span>
                    <div class="data-value"><?php echo htmlspecialchars($anamnesis['otras_enfermedades'] ?: 'Ninguna'); ?></div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
                <div>
                    <span class="data-label">Alergias a Medicamentos:</span>
                    <div class="data-value"><?php echo htmlspecialchars($anamnesis['alergias_medicamentos'] ?: 'Ninguna'); ?></div>
                </div>
                <div>
                    <span class="data-label">Medicamentos Actuales y Dosis:</span>
                    <div class="data-value">
                        <?php if($anamnesis['medicamentos_actuales']): ?>
                            <strong>Med:</strong> <?php echo htmlspecialchars($anamnesis['medicamentos_actuales']); ?><br>
                            <strong>Dosis:</strong> <?php echo htmlspecialchars($anamnesis['dosis_medicamentos'] ?: 'No especificada'); ?>
                        <?php else: ?>
                            Ninguno
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div style="margin-top: 10px;">
                <span class="data-label">Observaciones de Anamnesis:</span>
                <div class="data-value"><?php echo htmlspecialchars($anamnesis['observaciones'] ?: 'Sin observaciones'); ?></div>
            </div>
        <?php else: ?>
            <p>No se registra anamnesis para este paciente.</p>
        <?php endif; ?>

        <!-- Historial / Evolución -->
        <div class="section-title">Evolución de Consultas</div>
        <div class="timeline">
            <?php if (!empty($historial)): ?>
                <?php foreach ($historial as $cita): 
                    $fecha = strtotime($cita['fecha_cita']);
                    $day = date('d', $fecha);
                    $month = date('M', $fecha);
                ?>
                    <div class="timeline-item">
                        <div class="timeline-date">
                            <span class="day"><?php echo $day; ?></span>
                            <span class="month"><?php echo $month; ?></span>
                            <span style="font-size: 10px; color: #ccc;"><?php echo date('Y', $fecha); ?></span>
                        </div>
                        <div class="timeline-badge"></div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h4><?php echo htmlspecialchars($cita['tipo_consulta_nombre']); ?></h4>
                                <span class="professional-name">Dr(a). <?php echo htmlspecialchars($cita['profesional_nombre']); ?></span>
                            </div>
                            
                            <div class="consultation-detail">
                                <span class="findings-label">Motivo de Consulta:</span>
                                <div class="findings-value"><?php echo htmlspecialchars($cita['motivo_consulta'] ?: 'Control rutinario'); ?></div>
                                
                                <div class="consultation-box">
                                    <div>
                                        <span class="findings-label">Agudeza Visual (Lejos/Cerca):</span>
                                        <table class="data-table-mini">
                                            <tr>
                                                <th>Vía</th>
                                                <th>Tipo</th>
                                                <th>OD</th>
                                                <th>OI</th>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" style="vertical-align: middle;">Sin Corr.</td>
                                                <td>Lejos</td>
                                                <td><?php echo $cita['av_sc_lejos_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['av_sc_lejos_oi'] ?: '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Cerca</td>
                                                <td><?php echo $cita['av_sc_cerca_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['av_sc_cerca_oi'] ?: '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" style="vertical-align: middle;">Con Corr.</td>
                                                <td>Lejos</td>
                                                <td><?php echo $cita['av_cc_lejos_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['av_cc_lejos_oi'] ?: '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Cerca</td>
                                                <td><?php echo $cita['av_cc_cerca_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['av_cc_cerca_oi'] ?: '-'; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div>
                                        <span class="findings-label">Refracción y Resultados:</span>
                                        <table class="data-table-mini">
                                            <tr>
                                                <th>Prueba</th>
                                                <th>OD</th>
                                                <th>OI</th>
                                            </tr>
                                            <tr>
                                                <td>Retinoscopía</td>
                                                <td><?php echo $cita['retinoscopia_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['retinoscopia_oi'] ?: '-'; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Subjetivo</td>
                                                <td><?php echo $cita['subjetivo_od'] ?: '-'; ?></td>
                                                <td><?php echo $cita['subjetivo_oi'] ?: '-'; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <span class="findings-label">Rx Final / Fórmula Prescrita:</span>
                                <table class="data-table-mini">
                                    <tr>
                                        <th>Ojo</th>
                                        <th>Esférico / Cilíndrico / Eje</th>
                                        <th>Adición</th>
                                        <th>AV Final</th>
                                    </tr>
                                    <tr>
                                        <td>Derecho</td>
                                        <td><?php echo $cita['esferico_Cyl_eje_od'] ?: '-'; ?></td>
                                        <td><?php echo $cita['lentes_adicion_od'] ?: '-'; ?></td>
                                        <td><?php echo $cita['resultado_final_od'] ?: '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Izquierdo</td>
                                        <td><?php echo $cita['esferico_Cyl_eje_oi'] ?: '-'; ?></td>
                                        <td><?php echo $cita['lentes_adicion_oi'] ?: '-'; ?></td>
                                        <td><?php echo $cita['resultado_final_oi'] ?: '-'; ?></td>
                                    </tr>
                                </table>
                                
                                <div style="margin-top: 5px; font-size: 0.85em; display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                    <div><strong>Lente:</strong> <?php echo htmlspecialchars(($cita['lentes_tipo_nombre'] ?? '-') . ' / ' . ($cita['lentes_material_nombre'] ?? '-')); ?></div>
                                    <div><strong>Uso:</strong> <?php echo htmlspecialchars($cita['uso_lentes_nombre'] ?? '-'); ?></div>
                                    <div style="grid-column: span 2;"><strong>Tratamientos / Otros:</strong> <?php echo htmlspecialchars(($cita['lentes_tratamientos'] ?: 'Ninguno') . ($cita['filtro_color'] ? ' | ' . $cita['filtro_color'] : '')); ?></div>
                                </div>

                                <div class="consultation-box">
                                    <div>
                                        <span class="findings-label">Hallazgos Examen Físico:</span>
                                        <div class="findings-value">
                                            <p style="margin-bottom: 5px;"><small><strong>Ext:</strong> <?php echo ($cita['examen_externo_od'] ?: '-') . ' / ' . ($cita['examen_externo_oi'] ?: '-'); ?></small></p>
                                            <p style="margin-bottom: 5px;"><small><strong>Oft:</strong> <?php echo ($cita['oftalmoscopia_od'] ?: '-') . ' / ' . ($cita['oftalmoscopia_oi'] ?: '-'); ?></small></p>
                                            <p style="margin-bottom: 0;"><small><strong>Motor:</strong> PPC: <?php echo $cita['ppc'] ?: '-'; ?> / VL: <?php echo $cita['cover_test_vl'] ?: '-'; ?></small></p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="findings-label">Diagnóstico (CIE-10 / Principal):</span>
                                        <div class="findings-value">
                                            <?php if($cita['cie10_codigo']): ?>
                                                <strong><?php echo htmlspecialchars($cita['cie10_codigo']); ?></strong> 
                                                <small><?php echo htmlspecialchars($cita['cie10_descripcion']); ?></small>
                                                <?php if($cita['diagnostico_principal']): ?>
                                                    <br><small><strong>Princ:</strong> <?php echo htmlspecialchars($cita['diagnostico_principal']); ?></small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <strong><?php echo htmlspecialchars($cita['diagnostico_principal'] ?: 'Sin diagnóstico'); ?></strong>
                                            <?php endif; ?>
                                            
                                            <?php if($cita['diagnostico_secundario']): ?>
                                                <br><small><strong>Sec:</strong> <?php echo htmlspecialchars($cita['diagnostico_secundario']); ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="consultation-box">
                                    <div>
                                        <span class="findings-label">Pruebas Motoras y DP:</span>
                                        <div class="findings-value">
                                            <small><strong>PPC:</strong> <?php echo $cita['ppc'] ?: '-'; ?> | <strong>DP:</strong> <?php echo $cita['dp'] ?: '-'; ?></small>
                                        </div>
                                    </div>
                                    <?php if($cita['queratometria_od'] || $cita['queratometria_oi']): ?>
                                    <div>
                                        <span class="findings-label">Queratometría:</span>
                                        <div class="findings-value">
                                            <small><strong>OD:</strong> <?php echo $cita['queratometria_od'] ?: '-'; ?></small><br>
                                            <small><strong>OI:</strong> <?php echo $cita['queratometria_oi'] ?: '-'; ?></small>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <span class="findings-label">Tratamiento y Recomendaciones:</span>
                                <div class="findings-value">
                                    <?php if($cita['tratamiento']): ?>
                                        <p><strong>Tratamiento:</strong><br><?php echo nl2br(htmlspecialchars($cita['tratamiento'])); ?></p>
                                    <?php endif; ?>
                                    <?php if($cita['medicamentos_prescritos']): ?>
                                        <p><strong>Medicamentos:</strong><br><?php echo nl2br(htmlspecialchars($cita['medicamentos_prescritos'])); ?></p>
                                    <?php endif; ?>
                                    <?php if($cita['recomendaciones']): ?>
                                        <p><strong>Recomendaciones:</strong><br><?php echo nl2br(htmlspecialchars($cita['recomendaciones'])); ?></p>
                                    <?php endif; ?>
                                    <?php if(!$cita['tratamiento'] && !$cita['medicamentos_prescritos'] && !$cita['recomendaciones']): ?>
                                        Sin especificación
                                    <?php endif; ?>
                                    <?php if($cita['lentes_tratamientos']): ?>
                                        <p style="margin-bottom: 0;"><small><strong>Tratamientos Lentes:</strong> <?php echo htmlspecialchars($cita['lentes_tratamientos']); ?></small></p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($cita['observaciones_generales']): ?>
                                    <span class="findings-label">Observaciones Generales:</span>
                                    <div class="findings-value"><?php echo nl2br(htmlspecialchars($cita['observaciones_generales'])); ?></div>
                                <?php endif; ?>
                                
                                <?php if($cita['proximo_control']): ?>
                                    <div style="margin-top: 10px; font-weight: bold; color: #8d1111;">
                                        Próximo Control: <?php echo date('d/m/Y', strtotime($cita['proximo_control'])); ?>
                                        <?php echo $cita['proximo_control_motivo'] ? ' - ' . htmlspecialchars($cita['proximo_control_motivo']) : ''; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">No se registran consultas previas en el sistema.</div>
            <?php endif; ?>
        </div>

        <!-- Footer del Reporte (Solo visible en pantalla al final) -->
        <div class="no-print" style="margin-top: 50px; text-align: center; font-size: 11px; color: #aaa; border-top: 1px solid #eee; padding-top: 10px;">
            Este documento es un resumen de la historia clínica digital del paciente. Su uso es estrictamente profesional y confidencial.
        </div>

        <!-- Pie de página fijo para impresión (Repetido en cada hoja) -->
        <div class="print-footer">
            <div>Historia Clínica - <?php echo htmlspecialchars($paciente['nombre_completo']); ?></div>
            <div style="font-weight: bold;">Estrictamente Confidencial - Generado por <?php echo APP_NAME; ?></div>
            <div class="page-number"></div>
        </div>
    </div>

    <?php if (!isset($esEmail) || !$esEmail): ?>
    <!-- Modal Enviar Correo -->
    <div class="modal fade no-print" id="modalEmail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enviar Historia Clínica por Correo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEmail">
                        <input type="hidden" name="paciente_id" value="<?php echo $paciente['id']; ?>">
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="checkPaciente" checked>
                            <label class="form-check-label" for="checkPaciente">
                                Enviar al correo del paciente: <strong><?php echo htmlspecialchars($paciente['email'] ?: 'No registrado'); ?></strong>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="otrosDestinos" class="form-label">Otros destinatarios (separados por coma):</label>
                            <textarea class="form-control" id="otrosDestinos" rows="2" placeholder="ejemplo@correo.com, otro@correo.com"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnConfirmarEnvio">
                        <i class="icon-mail"></i> Confirmar y Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function prepararImpresion() {
        // Título deseado para el PDF
        var tituloReporte = document.title;
        
        // Si el reporte está dentro de un iframe (como es el caso),
        // el navegador suele usar el título de la página principal (Padre) para el nombre del archivo.
        if (window.self !== window.top) {
            try {
                // Guardamos el título original del padre para restaurarlo luego
                var tituloOriginalPadre = window.top.document.title;
                // Cambiamos el título del padre al título del reporte
                window.top.document.title = tituloReporte;
                
                // Chrome necesita un pequeño retraso para capturar el cambio de título del padre
                setTimeout(function() {
                    window.print();
                    // Restauramos el título original después de un tiempo prudente
                    setTimeout(function() {
                        window.top.document.title = tituloOriginalPadre;
                    }, 5000); // 5 segundos para que el usuario interactúe con el diálogo
                }, 250);
            } catch (e) {
                // Si hay error de seguridad (CORS), usamos el print normal
                window.print();
            }
        } else {
            window.print();
        }
    }

    $(document).ready(function() {
        $('#btnConfirmarEnvio').click(function() {
            let emails = [];
            
            // Si está chequeado el del paciente
            if ($('#checkPaciente').is(':checked')) {
                let mailPaciente = "<?php echo $paciente['email']; ?>";
                if (mailPaciente && mailPaciente.trim() !== '') {
                    emails.push(mailPaciente);
                }
            }

            // Otros destinatarios
            let otros = $('#otrosDestinos').val().trim();
            if (otros !== '') {
                emails.push(otros);
            }

            if (emails.length === 0) {
                Swal.fire('Atención', 'Por favor especifique al menos un destinatario válido.', 'warning');
                return;
            }

            const destinatarios = emails.join(',');

            Swal.fire({
                title: 'Enviando...',
                text: 'Por favor espere mientras procesamos el envío.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: '../controladores/controlador_reporte_historia.php?action=enviar&id=<?php echo $paciente['id']; ?>',
                type: 'POST',
                data: { destinatarios: destinatarios },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Enviado', response.mensaje, 'success');
                        $('#modalEmail').modal('hide');
                        $('#otrosDestinos').val('');
                    } else {
                        Swal.fire('Error', response.error || 'No se pudo completar el envío.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error de comunicación con el servidor.', 'error');
                }
            });
        });
    });
    </script>
    <?php endif; ?>
</body>
</html>
