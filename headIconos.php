<?php
// Detectar ruta base para iconos-web (siempre en la raíz del proyecto)
$current_path = $_SERVER['PHP_SELF'];
$is_subfolder = (strpos($current_path, '/vistas/') !== false || 
                  strpos($current_path, '/controladores/') !== false || 
                  strpos($current_path, '/modelos/') !== false ||
                  strpos($current_path, '/accesos/') !== false);

$is_deep_subfolder = (strpos($current_path, '/accesos/vistas/') !== false || 
                      strpos($current_path, '/accesos/controladores/') !== false ||
                      strpos($current_path, '/accesos/modelos/') !== false);

if ($is_deep_subfolder) {
    $prefix = '../../';
} elseif ($is_subfolder) {
    $prefix = '../';
} else {
    $prefix = './';
}
?>
<!-- headIconos.php -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' rel='stylesheet'>
<?php
$favicon = getenv('APP_FAVICON');
if ($favicon) {
    echo "<link rel='icon' href='" . $prefix . $favicon . "' type='image/x-icon'>";
}
?>

<!-- Incluir estilos de iconos Fontello -->
<link href='<?= $prefix ?>iconos-web/css/fontello.css' rel='stylesheet' type='text/css'>
<link href='<?= $prefix ?>iconos-web/css/fontello-embedded.css' rel='stylesheet' type='text/css'>
<link href='<?= $prefix ?>iconos-web/css/animation.css' rel='stylesheet' type='text/css'>
<link href='<?= $prefix ?>iconos-web/css/fontello-codes.css' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='<?= $prefix ?>iconos-web/css/estiloIconos.css'>
