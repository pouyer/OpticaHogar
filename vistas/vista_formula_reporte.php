<?php
/**
 * Vista de Reporte de Fórmula Médica
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formula_Medica_<?php echo htmlspecialchars($cita['paciente_identificacion'] ?? ''); ?>_<?php echo $cita['id'] ?? ''; ?></title>
    <link rel="stylesheet" href="../css/estilos.css">
    <?php include('../headIconos.php'); ?>
    <style>
        body { background-color: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.4; margin: 0; padding: 0; }
        .formula-container { width: 95%; max-width: 800px; margin: 20px auto; padding: 30px; border: 1px solid #eee; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .header { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #8d1111; padding-bottom: 15px; margin-bottom: 20px; }
        .logo-area img { max-height: 70px; }
        .company-info { text-align: right; }
        .company-info h2 { margin: 0; color: #8d1111; font-size: 22px; }
        .info-bar { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; background: #f9f9f9; padding: 10px 15px; border-radius: 5px; margin-bottom: 25px; font-size: 0.95em; }
        .section-title { color: #8d1111; font-weight: bold; text-transform: uppercase; margin-top: 25px; margin-bottom: 10px; font-size: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 0.95em; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .data-table th { background-color: #f4f4f4; color: #555; }
        .findings-box { background: #fff; padding: 15px; border: 1px solid #eee; border-radius: 5px; margin-top: 10px; }
        .findings-item { margin-bottom: 15px; }
        .findings-label { font-weight: bold; color: #444; display: block; margin-bottom: 4px; }
        .findings-value { color: #555; }
        .next-control { margin-top: 30px; font-weight: bold; color: #8d1111; font-size: 1.1em; border-top: 1px solid #f0f0f0; padding-top: 15px; }
        .footer-note { margin-top: 50px; text-align: center; font-size: 10px; color: #aaa; font-style: italic; }
        .no-print { margin-bottom: 20px; text-align: center; }
        @media print { .no-print { display: none; } .formula-container { border: none; margin: 0; width: 100%; padding: 0; box-shadow: none; } }
    </style>
</head>
<body>
    <div class="no-print" style="padding: 20px; background: #f4f4f4;">
        <?php if (isset($permisos['exp']) && $permisos['exp']): ?>
            <button onclick="window.print()" class="btn btn-primary"><i class="icon-print"></i> Imprimir Fórmula / PDF</button>
        <?php endif; ?>
        <button onclick="window.close()" class="btn btn-secondary">Cerrar</button>
    </div>

    <div class="formula-container">
        <div class="header">
            <div class="logo-area">
                <img src="<?php echo defined('APP_LOGO') ? APP_LOGO : '../assets/img/logo.png'; ?>" alt="Logo">
            </div>
            <div class="company-info">
                <h2><?php echo defined('APP_NAME') ? APP_NAME : 'Optica Hogar'; ?></h2>
                <p>Fórmula de Optometría</p>
                <p>Cita No: <strong><?php echo $cita['id'] ?? ''; ?></strong> | Fecha: <strong><?php echo isset($cita['fecha_cita']) ? date('d/m/Y', strtotime($cita['fecha_cita'])) : ''; ?></strong></p>
            </div>
        </div>

        <div class="info-bar">
            <div><strong>Paciente:</strong> <?php echo htmlspecialchars($cita['paciente_nombre'] ?? ''); ?></div>
            <div><strong>Identificación:</strong> <?php echo htmlspecialchars($cita['paciente_identificacion'] ?? ''); ?></div>
        </div>

        <div class="section-title">Rx Final / Fórmula Prescrita:</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Ojo</th>
                    <th>Esférico / Cilíndrico / Eje</th>
                    <th>Adición</th>
                    <th>AV Final</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Derecho (OD)</strong></td>
                    <td><?php echo $cita['esferico_Cyl_eje_od'] ?: '-'; ?></td>
                    <td><?php echo $cita['lentes_adicion_od'] ?: '-'; ?></td>
                    <td><?php echo $cita['resultado_final_od'] ?: '-'; ?></td>
                </tr>
                <tr>
                    <td><strong>Izquierdo (OI)</strong></td>
                    <td><?php echo $cita['esferico_Cyl_eje_oi'] ?: '-'; ?></td>
                    <td><?php echo $cita['lentes_adicion_oi'] ?: '-'; ?></td>
                    <td><?php echo $cita['resultado_final_oi'] ?: '-'; ?></td>
                </tr>
            </tbody>
        </table>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; font-size: 0.9em;">
            <div><strong>Lente:</strong> <?php echo htmlspecialchars(($cita['lentes_tipo_nombre'] ?? '-') . ' / ' . ($cita['lentes_material_nombre'] ?? '-')); ?></div>
            <div><strong>Uso:</strong> <?php echo htmlspecialchars($cita['uso_lentes_nombre'] ?? '-'); ?></div>
            <div style="grid-column: span 2;"><strong>Tratamientos / Otros:</strong> <?php echo htmlspecialchars($cita['lentes_tratamientos'] ?: 'Ninguno'); ?><?php echo !empty($cita['filtro_color']) ? ' | ' . htmlspecialchars($cita['filtro_color']) : ''; ?></div>
        </div>

        <div class="section-title">Tratamiento y Recomendaciones:</div>
        <div class="findings-box">
            <?php if (!empty($cita['tratamiento'])): ?>
            <div class="findings-item">
                <span class="findings-label">Tratamiento:</span>
                <div class="findings-value"><?php echo nl2br(htmlspecialchars($cita['tratamiento'])); ?></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($cita['recomendaciones'])): ?>
            <div class="findings-item">
                <span class="findings-label">Recomendaciones:</span>
                <div class="findings-value"><?php echo nl2br(htmlspecialchars($cita['recomendaciones'])); ?></div>
            </div>
            <?php endif; ?>

            <?php if (!empty($cita['lentes_tratamientos'])): ?>
            <div class="findings-item">
                <span class="findings-label">Tratamientos Lentes:</span>
                <div class="findings-value"><?php echo htmlspecialchars($cita['lentes_tratamientos']); ?></div>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($cita['proximo_control'])): ?>
        <div class="next-control">
            Próximo Control: <?php echo date('d/m/Y', strtotime($cita['proximo_control'])); ?> 
            <?php echo !empty($cita['proximo_control_motivo']) ? ' - ' . htmlspecialchars($cita['proximo_control_motivo']) : ''; ?>
        </div>
        <?php endif; ?>

        <div style="margin-top: 60px; display: flex; justify-content: space-between;">
            <div style="width: 250px; border-top: 1px solid #333; text-align: center; padding-top: 5px; font-size: 0.9em;">
                Firma del Profesional<br>
                <?php echo htmlspecialchars($cita['profesional_nombre'] ?? ''); ?>
            </div>
            <div style="width: 250px; text-align: center; padding-top: 5px; font-size: 0.9em;">
                <br>Sello
            </div>
        </div>

        <div class="footer-note">
            Este documento representa la fórmula óptica prescrita al paciente y no reemplaza la consulta clínica completa.
        </div>
    </div>
</body>
</html>
