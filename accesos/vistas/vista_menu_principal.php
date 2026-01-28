<?php
/**
 * GeneraCRUDphp
 *
 * es desarrollada para ajilizar el desarrollo de aplicaciones PHP
 * permitir la administracion de tablas creando leer, actualizar, editar y elimar reguistros
 * Desarrollado por Carlos Mejia
 * 2024-12-06
 * Version 0.4.0
 *  
 */
require_once '../verificar_sesion.php';
require_once '../../config/config.php'; // Incluir archivo de configuración

// Cargar environment si existe
if (file_exists(__DIR__ . '/../../.env')) {
    $env = parse_ini_file(__DIR__ . '/../../.env');
    if ($env) {
        foreach ($env as $key => $value) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Administracion</title>
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../css/estiloMenu.css">
    <?php include('../headIconos.php'); // Incluir los elementos del encabezado iconos?>
</head>
<body>
<div class="app-wrapper">

<div class="header-container">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Columna Logo y Toggle: Alineada con el menú lateral -->
                <!-- Columna Logo y Toggle -->
                <div id="headerSidebar">
                    <button id="sidebarToggle" class="btn btn-link text-primary p-0" style="font-size: 1.5rem; text-decoration: none;">
                        <i class="icon-menu"></i>
                    </button>
                    <div class="logo-text text-center">
                        <?php 
                        $appLogo = getenv('APP_LOGO');
                        if ($appLogo && file_exists(__DIR__ . '/../../' . $appLogo)) {
                            echo '<img src="../../' . $appLogo . '" alt="Logo" style="max-height: 40px;">';
                        } else {
                            echo '<h5 class="m-0">' . APP_NAME . '</h5>';
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Columna Info Usuario -->
                <div id="headerContent">
                    <div class="user-info d-flex justify-content-between align-items-center">
                        <h2 class="welcome-text m-0">Bienvenido(a), <?php echo htmlspecialchars($usuario_nombre); ?></h2> 
                        <div class="d-flex gap-2">
                            <a href="vista_cambiar_password.php?source=menu" class="btn btn-warning" target="iframeTrabajo">
                                <i class="icon-lock"></i> Cambiar Contraseña
                            </a>
                            <a href="../controladores/controlador_login.php?action=logout" class="btn btn-danger logout-btn">
                                <i class="icon-logout"></i> Cerrar Sesión
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="main-content-row">
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
    <div id="mainSidebar" class="menu-fondo p-0">
            <div class="d-md-none text-end p-2">
                <button id="closeSidebar" class="btn btn-sm btn-light"><i class="icon-cancel"></i></button>
            </div>
            <h2 class="text-center">Óptica Hogar</h2>
            <ul class="list-group">
                <?php
                require_once '../modelos/modelo_menu_principal.php';
                require_once '../modelos/modelo_acc_log.php';
                $modelo = new ModeloMenu();
                $modeloLog = new ModeloAcc_log();
                $modeloLog->registrar($usuario_id, 'VIEW', 'ACC_MENU', 'Apertura del Menú Principal');
                $modulos = $modelo->obtenerModulos($usuario_id); // Método que obtiene los módulos

                foreach ($modulos as $index => $modulo): ?>
                    <li class="list-group-item">
                      <!--  <strong class="accordion-button" onclick="toggleMenu(this)"><?php echo htmlspecialchars($modulo['modulo']); ?></strong>  -->
                        <!-- Cambié el icono a un <i> para que se vea mejor -->
                        <strong class="accordion-button" onclick="toggleMenu(this)">
                            <i class="<?php echo htmlspecialchars($modulo['icono_modulo']); ?>">&nbsp;</i> <!-- Mostrar el icono -->
                            <span><?php echo htmlspecialchars($modulo['modulo']); ?></span>
                        </strong>
                        
                        <ul class="nested-nav">
                            <?php
                            // Obtener los menús para el módulo actual
                            $menus = $modelo->obtenerMenusPorModulo($modulo['modulo'], $usuario_id);
                            if (empty($menus)): ?>
                                <li>No hay menús disponibles para este módulo.</li>
                            <?php else:
                                foreach ($menus as $menu):
                                    $ruta = rtrim($menu['ruta_programa'], '/');
                                    $nombrePrograma = isset($menu['nombre_programaPHP']) ? $menu['nombre_programaPHP'] : 'programa_no_definido'; // Manejo de error
                                    $url = $ruta . '/' . $nombrePrograma;
                                    ?>
                                    <li>
                                        <a href="<?php echo htmlspecialchars($url); ?>" target="iframeTrabajo">
                                            <i class="<?php echo htmlspecialchars($menu['icono_programa']); ?>"> </i>
                                            <span><?php echo htmlspecialchars($menu['nombre_menu']); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach;
                            endif; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="mainContent" class="iframe-container">
            <iframe name="iframeTrabajo" src="vista_fondo.php"></iframe>
        </div>
    </div>


<footer class="footer">
    <div class="container">
        <span><?php echo htmlspecialchars(getVersionInfo()); ?></span>
    </div>
</footer>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script>
    function toggleMenu(button) {
        const parentLi = button.parentElement;
        parentLi.classList.toggle('active');
        const nestedNav = parentLi.querySelector('.nested-nav');
        if (nestedNav) {
            nestedNav.style.display = nestedNav.style.display === 'block' ? 'none' : 'block';
        }
    }

    // Lógica para colapsar menú lateral
    const sidebar = document.getElementById('mainSidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const wrapper = document.querySelector('.app-wrapper');

    function updateSidebarState(isCollapsed) {
        if (isCollapsed) {
            wrapper.classList.add('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', 'true');
        } else {
            wrapper.classList.remove('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', 'false');
        }
    }

    // Inicializar estado desde localStorage (solo para desktop)
    if (localStorage.getItem('sidebarCollapsed') === 'true' && window.innerWidth > 768) {
        updateSidebarState(true);
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            if (window.innerWidth <= 768) {
                // Modo Móvil: Abrir/Cerrar panel
                wrapper.classList.toggle('mobile-sidebar-open');
            } else {
                // Modo Desktop: Colapsar/Expandir (íconos)
                const isCollapsed = wrapper.classList.contains('sidebar-collapsed');
                updateSidebarState(!isCollapsed);
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            wrapper.classList.remove('mobile-sidebar-open');
        });
    }

    // Cerrar menú al hacer clic en un enlace (solo en móvil)
    sidebar.addEventListener('click', (e) => {
        if (e.target.closest('a') && window.innerWidth <= 768) {
            wrapper.classList.remove('mobile-sidebar-open');
        }
    });

    // Manejar el botón de cerrar interno si existe
    const closeBtn = document.getElementById('closeSidebar');
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            wrapper.classList.remove('mobile-sidebar-open');
        });
    }
</script>
</body>
</html>