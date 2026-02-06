<?php
    /**
     * Modelo para la tabla profesionales_salud     */
require_once '../conexion.php';

class ModeloProfesionales_salud {
    private $conexion;
    private $llavePrimaria = 'id';
    private $es_vista = false;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    // Métodos para obtener datos relacionados (Comboboxes)
    public function obtenerRelacionado_usuario_id() {
                $sql = "SELECT `id_usuario` as id, `fullname` as texto FROM `acc_usuario`  WHERE estado = 'activo' ORDER BY `fullname` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_tipo_identificacion_id() {
                $sql = "SELECT `id` as id, `codigo` as texto FROM `tipos_identificacion`  WHERE estado = 'activo' ORDER BY `orden` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_genero_id() {
                $sql = "SELECT `id` as id, `nombre` as texto FROM `generos`  WHERE estado = 'activo' ORDER BY `nombre` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_tipo_profesional_id() {
                $sql = "SELECT `id` as id, `codigo` as texto FROM `tipos_profesional`  WHERE estado = 'activo' ORDER BY `codigo` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Función para contar registros
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM profesionales_salud";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM profesionales_salud ";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `profesionales_salud`.`id`, `profesionales_salud`.`tipo_identificacion_id`, `profesionales_salud`.`identificacion`, `profesionales_salud`.`primer_nombre`, `profesionales_salud`.`segundo_nombre`, `profesionales_salud`.`primer_apellido`, `profesionales_salud`.`segundo_apellido`, `profesionales_salud`.`fecha_nacimiento`, `profesionales_salud`.`genero_id`, `profesionales_salud`.`tipo_profesional_id`, `profesionales_salud`.`especialidad`, `profesionales_salud`.`registro_profesional`, `profesionales_salud`.`codigo_prestador_minsalud`, `profesionales_salud`.`universidad`, `profesionales_salud`.`anio_graduacion`, `profesionales_salud`.`telefono_principal`, `profesionales_salud`.`telefono_secundario`, `profesionales_salud`.`email`, `profesionales_salud`.`direccion`, `profesionales_salud`.`fecha_ingreso`, `profesionales_salud`.`jornada`, `profesionales_salud`.`disponible`, `profesionales_salud`.`usuario_id_inserto`, `profesionales_salud`.`fecha_insercion`, `profesionales_salud`.`usuario_id_actualizo`, `profesionales_salud`.`fecha_actualizacion`, `profesionales_salud`.`usuario_id`, `acc_usuario`.`fullname`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `tipos_profesional`.`codigo`) LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $termino = "%" . $termino . "%";
        $stmt->bind_param('s', $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : false;
    }

    // Obtener todos los registros
    public function obtenerTodos($registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas para evitar inyección SQL
        $allowedColumns = ['`profesionales_salud`.`id`', '`profesionales_salud`.`tipo_identificacion_id`', '`profesionales_salud`.`identificacion`', '`profesionales_salud`.`primer_nombre`', '`profesionales_salud`.`segundo_nombre`', '`profesionales_salud`.`primer_apellido`', '`profesionales_salud`.`segundo_apellido`', '`profesionales_salud`.`fecha_nacimiento`', '`profesionales_salud`.`genero_id`', '`profesionales_salud`.`tipo_profesional_id`', '`profesionales_salud`.`especialidad`', '`profesionales_salud`.`registro_profesional`', '`profesionales_salud`.`codigo_prestador_minsalud`', '`profesionales_salud`.`universidad`', '`profesionales_salud`.`anio_graduacion`', '`profesionales_salud`.`telefono_principal`', '`profesionales_salud`.`telefono_secundario`', '`profesionales_salud`.`email`', '`profesionales_salud`.`direccion`', '`profesionales_salud`.`fecha_ingreso`', '`profesionales_salud`.`jornada`', '`profesionales_salud`.`disponible`', '`profesionales_salud`.`usuario_id_inserto`', '`profesionales_salud`.`fecha_insercion`', '`profesionales_salud`.`usuario_id_actualizo`', '`profesionales_salud`.`fecha_actualizacion`', '`profesionales_salud`.`usuario_id`', '`acc_usuario`.`fullname`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`tipos_profesional`.`codigo`'];
        
        $orderSQL = "";
        $esValidoOrden = false;
        if (!empty($orderBy)) {
            $orderByClean = str_replace(['`', ' '], '', $orderBy);
            foreach($allowedColumns as $ac) {
                if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                    $esValidoOrden = true;
                    break;
                }
            }
            if ($esValidoOrden) {
                $orderSQL = " ORDER BY $orderBy $orderDir ";
            }
        }

        if (empty($orderSQL)) {
            // Usar ordenamiento predeterminado (hasta 3 niveles)
            $orderSQL = " ORDER BY `profesionales_salud`.`primer_nombre` ASC, `profesionales_salud`.`primer_apellido` ASC, `profesionales_salud`.`segundo_nombre` ASC ";
        }

        $query = "SELECT `profesionales_salud`.* , `acc_usuario`.`fullname` as `usuario_id_display` , `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `tipos_profesional`.`codigo` as `tipo_profesional_id_display`  FROM profesionales_salud";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= $orderSQL;
        $query .= " LIMIT ? OFFSET ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ii', $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
    }

    // Obtener un registro por llave primaria
    public function obtenerPorId($id) {
        $query = "SELECT `profesionales_salud`.* , `acc_usuario`.`fullname` as `usuario_id_display` , `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `tipos_profesional`.`codigo` as `tipo_profesional_id_display`  FROM profesionales_salud";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= " WHERE `profesionales_salud`.$this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    // Crear un nuevo registro
    public function crear($datos) {
        $campos = [];
        $valores = [];
        $tipos = '';
        $params = [];

        // Campo: tipo_identificacion_id
        if (!isset($datos['tipo_identificacion_id']) || $datos['tipo_identificacion_id'] === '') {
            throw new Exception('El campo tipo_identificacion_id es requerido.');
        }
        if (array_key_exists('tipo_identificacion_id', $datos)) {
            $campos[] = '`tipo_identificacion_id`';
            $valores[] = '?';
            $params[] = ($datos['tipo_identificacion_id'] === '' || $datos['tipo_identificacion_id'] === null) ? null : (int)$datos['tipo_identificacion_id'];
            $tipos .= 'i';
        }
        // Campo: identificacion
        if (!isset($datos['identificacion']) || $datos['identificacion'] === '') {
            throw new Exception('El campo identificacion es requerido.');
        }
        if (array_key_exists('identificacion', $datos)) {
            $campos[] = '`identificacion`';
            $valores[] = '?';
            $params[] = ($datos['identificacion'] === '' || $datos['identificacion'] === null) ? '' : $datos['identificacion'];
            $tipos .= 's';
        }
        // Campo: primer_nombre
        if (!isset($datos['primer_nombre']) || $datos['primer_nombre'] === '') {
            throw new Exception('El campo primer_nombre es requerido.');
        }
        if (array_key_exists('primer_nombre', $datos)) {
            $campos[] = '`primer_nombre`';
            $valores[] = '?';
            $params[] = ($datos['primer_nombre'] === '' || $datos['primer_nombre'] === null) ? '' : $datos['primer_nombre'];
            $tipos .= 's';
        }
        // Campo: segundo_nombre
        if (array_key_exists('segundo_nombre', $datos)) {
            $campos[] = '`segundo_nombre`';
            $valores[] = '?';
            $params[] = ($datos['segundo_nombre'] === '' || $datos['segundo_nombre'] === null) ? '' : $datos['segundo_nombre'];
            $tipos .= 's';
        }
        // Campo: primer_apellido
        if (!isset($datos['primer_apellido']) || $datos['primer_apellido'] === '') {
            throw new Exception('El campo primer_apellido es requerido.');
        }
        if (array_key_exists('primer_apellido', $datos)) {
            $campos[] = '`primer_apellido`';
            $valores[] = '?';
            $params[] = ($datos['primer_apellido'] === '' || $datos['primer_apellido'] === null) ? '' : $datos['primer_apellido'];
            $tipos .= 's';
        }
        // Campo: segundo_apellido
        if (array_key_exists('segundo_apellido', $datos)) {
            $campos[] = '`segundo_apellido`';
            $valores[] = '?';
            $params[] = ($datos['segundo_apellido'] === '' || $datos['segundo_apellido'] === null) ? '' : $datos['segundo_apellido'];
            $tipos .= 's';
        }
        // Campo: fecha_nacimiento
        if (array_key_exists('fecha_nacimiento', $datos)) {
            $campos[] = '`fecha_nacimiento`';
            $valores[] = '?';
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_nacimiento'])) ? date('Y-m-d', strtotime($datos['fecha_nacimiento'])) : null;
            $tipos .= 's';
        }
        // Campo: genero_id
        if (array_key_exists('genero_id', $datos)) {
            $campos[] = '`genero_id`';
            $valores[] = '?';
            $params[] = ($datos['genero_id'] === '' || $datos['genero_id'] === null) ? null : (int)$datos['genero_id'];
            $tipos .= 'i';
        }
        // Campo: tipo_profesional_id
        if (!isset($datos['tipo_profesional_id']) || $datos['tipo_profesional_id'] === '') {
            throw new Exception('El campo tipo_profesional_id es requerido.');
        }
        if (array_key_exists('tipo_profesional_id', $datos)) {
            $campos[] = '`tipo_profesional_id`';
            $valores[] = '?';
            $params[] = ($datos['tipo_profesional_id'] === '' || $datos['tipo_profesional_id'] === null) ? null : (int)$datos['tipo_profesional_id'];
            $tipos .= 'i';
        }
        // Campo: especialidad
        if (array_key_exists('especialidad', $datos)) {
            $campos[] = '`especialidad`';
            $valores[] = '?';
            $params[] = ($datos['especialidad'] === '' || $datos['especialidad'] === null) ? '' : $datos['especialidad'];
            $tipos .= 's';
        }
        // Campo: registro_profesional
        if (array_key_exists('registro_profesional', $datos)) {
            $campos[] = '`registro_profesional`';
            $valores[] = '?';
            $params[] = ($datos['registro_profesional'] === '' || $datos['registro_profesional'] === null) ? '' : $datos['registro_profesional'];
            $tipos .= 's';
        }
        // Campo: codigo_prestador_minsalud
        if (array_key_exists('codigo_prestador_minsalud', $datos)) {
            $campos[] = '`codigo_prestador_minsalud`';
            $valores[] = '?';
            $params[] = ($datos['codigo_prestador_minsalud'] === '' || $datos['codigo_prestador_minsalud'] === null) ? '' : $datos['codigo_prestador_minsalud'];
            $tipos .= 's';
        }
        // Campo: universidad
        if (array_key_exists('universidad', $datos)) {
            $campos[] = '`universidad`';
            $valores[] = '?';
            $params[] = ($datos['universidad'] === '' || $datos['universidad'] === null) ? '' : $datos['universidad'];
            $tipos .= 's';
        }
        // Campo: anio_graduacion
        if (array_key_exists('anio_graduacion', $datos)) {
            $campos[] = '`anio_graduacion`';
            $valores[] = '?';
            $params[] = ($datos['anio_graduacion'] === '' || $datos['anio_graduacion'] === null) ? null : (int)$datos['anio_graduacion'];
            $tipos .= 'i';
        }
        // Campo: telefono_principal
        if (array_key_exists('telefono_principal', $datos)) {
            $campos[] = '`telefono_principal`';
            $valores[] = '?';
            $params[] = ($datos['telefono_principal'] === '' || $datos['telefono_principal'] === null) ? '' : $datos['telefono_principal'];
            $tipos .= 's';
        }
        // Campo: telefono_secundario
        if (array_key_exists('telefono_secundario', $datos)) {
            $campos[] = '`telefono_secundario`';
            $valores[] = '?';
            $params[] = ($datos['telefono_secundario'] === '' || $datos['telefono_secundario'] === null) ? '' : $datos['telefono_secundario'];
            $tipos .= 's';
        }
        // Campo: email
        if (array_key_exists('email', $datos)) {
            $campos[] = '`email`';
            $valores[] = '?';
            $params[] = ($datos['email'] === '' || $datos['email'] === null) ? '' : $datos['email'];
            $tipos .= 's';
        }
        // Campo: direccion
        if (array_key_exists('direccion', $datos)) {
            $campos[] = '`direccion`';
            $valores[] = '?';
            $params[] = ($datos['direccion'] === '' || $datos['direccion'] === null) ? '' : $datos['direccion'];
            $tipos .= 's';
        }
        // Campo: fecha_ingreso
        if (array_key_exists('fecha_ingreso', $datos)) {
            $campos[] = '`fecha_ingreso`';
            $valores[] = '?';
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_ingreso'])) ? date('Y-m-d', strtotime($datos['fecha_ingreso'])) : null;
            $tipos .= 's';
        }
        // Campo: jornada
        if (array_key_exists('jornada', $datos)) {
            $campos[] = '`jornada`';
            $valores[] = '?';
            $params[] = ($datos['jornada'] === '' || $datos['jornada'] === null) ? '' : $datos['jornada'];
            $tipos .= 's';
        }
        // Campo: disponible
        if (array_key_exists('disponible', $datos)) {
            $campos[] = '`disponible`';
            $valores[] = '?';
            $params[] = ($datos['disponible'] === '' || $datos['disponible'] === null) ? null : (int)$datos['disponible'];
            $tipos .= 'i';
        }
        // Campo: usuario_id_inserto
        if (!isset($datos['usuario_id_inserto']) || $datos['usuario_id_inserto'] === '') {
            throw new Exception('El campo usuario_id_inserto es requerido.');
        }
        if (array_key_exists('usuario_id_inserto', $datos)) {
            $campos[] = '`usuario_id_inserto`';
            $valores[] = '?';
            $params[] = ($datos['usuario_id_inserto'] === '' || $datos['usuario_id_inserto'] === null) ? null : (int)$datos['usuario_id_inserto'];
            $tipos .= 'i';
        }
        // Campo: fecha_insercion
        if (array_key_exists('fecha_insercion', $datos)) {
            $campos[] = '`fecha_insercion`';
            $valores[] = '?';
            $params[] = ($datos['fecha_insercion'] === '' || $datos['fecha_insercion'] === null) ? '' : $datos['fecha_insercion'];
            $tipos .= 's';
        }
        // Campo: usuario_id_actualizo
        if (array_key_exists('usuario_id_actualizo', $datos)) {
            $campos[] = '`usuario_id_actualizo`';
            $valores[] = '?';
            $params[] = ($datos['usuario_id_actualizo'] === '' || $datos['usuario_id_actualizo'] === null) ? null : (int)$datos['usuario_id_actualizo'];
            $tipos .= 'i';
        }
        // Campo: fecha_actualizacion
        if (array_key_exists('fecha_actualizacion', $datos)) {
            $campos[] = '`fecha_actualizacion`';
            $valores[] = '?';
            $params[] = ($datos['fecha_actualizacion'] === '' || $datos['fecha_actualizacion'] === null) ? '' : $datos['fecha_actualizacion'];
            $tipos .= 's';
        }
        // Campo: usuario_id
        if (array_key_exists('usuario_id', $datos)) {
            $campos[] = '`usuario_id`';
            $valores[] = '?';
            $params[] = ($datos['usuario_id'] === '' || $datos['usuario_id'] === null) ? null : (int)$datos['usuario_id'];
            $tipos .= 'i';
        }

        $query = "INSERT INTO profesionales_salud (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando insert: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    public function actualizar($id, $datos) {
        $actualizaciones = [];
        $tipos = '';
        $tipos_pk = 'i'; // Para la llave primaria
        $params = [];

        // Campo: tipo_identificacion_id
        if (array_key_exists('tipo_identificacion_id', $datos) && $datos['tipo_identificacion_id'] === '') {
            throw new Exception('El campo tipo_identificacion_id es requerido.');
        }
        if (array_key_exists('tipo_identificacion_id', $datos)) {
            $actualizaciones[] = "`tipo_identificacion_id` = ?";
            $params[] = ($datos['tipo_identificacion_id'] === '' || $datos['tipo_identificacion_id'] === null) ? null : (int)$datos['tipo_identificacion_id'];
            $tipos .= 'i';
        }
        // Campo: identificacion
        if (array_key_exists('identificacion', $datos) && $datos['identificacion'] === '') {
            throw new Exception('El campo identificacion es requerido.');
        }
        if (array_key_exists('identificacion', $datos)) {
            $actualizaciones[] = "`identificacion` = ?";
            $params[] = ($datos['identificacion'] === '' || $datos['identificacion'] === null) ? '' : $datos['identificacion'];
            $tipos .= 's';
        }
        // Campo: primer_nombre
        if (array_key_exists('primer_nombre', $datos) && $datos['primer_nombre'] === '') {
            throw new Exception('El campo primer_nombre es requerido.');
        }
        if (array_key_exists('primer_nombre', $datos)) {
            $actualizaciones[] = "`primer_nombre` = ?";
            $params[] = ($datos['primer_nombre'] === '' || $datos['primer_nombre'] === null) ? '' : $datos['primer_nombre'];
            $tipos .= 's';
        }
        // Campo: segundo_nombre
        if (array_key_exists('segundo_nombre', $datos)) {
            $actualizaciones[] = "`segundo_nombre` = ?";
            $params[] = ($datos['segundo_nombre'] === '' || $datos['segundo_nombre'] === null) ? '' : $datos['segundo_nombre'];
            $tipos .= 's';
        }
        // Campo: primer_apellido
        if (array_key_exists('primer_apellido', $datos) && $datos['primer_apellido'] === '') {
            throw new Exception('El campo primer_apellido es requerido.');
        }
        if (array_key_exists('primer_apellido', $datos)) {
            $actualizaciones[] = "`primer_apellido` = ?";
            $params[] = ($datos['primer_apellido'] === '' || $datos['primer_apellido'] === null) ? '' : $datos['primer_apellido'];
            $tipos .= 's';
        }
        // Campo: segundo_apellido
        if (array_key_exists('segundo_apellido', $datos)) {
            $actualizaciones[] = "`segundo_apellido` = ?";
            $params[] = ($datos['segundo_apellido'] === '' || $datos['segundo_apellido'] === null) ? '' : $datos['segundo_apellido'];
            $tipos .= 's';
        }
        // Campo: fecha_nacimiento
        if (array_key_exists('fecha_nacimiento', $datos)) {
            $actualizaciones[] = "`fecha_nacimiento` = ?";
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_nacimiento'])) ? date('Y-m-d', strtotime($datos['fecha_nacimiento'])) : null;
            $tipos .= 's';
        }
        // Campo: genero_id
        if (array_key_exists('genero_id', $datos)) {
            $actualizaciones[] = "`genero_id` = ?";
            $params[] = ($datos['genero_id'] === '' || $datos['genero_id'] === null) ? null : (int)$datos['genero_id'];
            $tipos .= 'i';
        }
        // Campo: tipo_profesional_id
        if (array_key_exists('tipo_profesional_id', $datos) && $datos['tipo_profesional_id'] === '') {
            throw new Exception('El campo tipo_profesional_id es requerido.');
        }
        if (array_key_exists('tipo_profesional_id', $datos)) {
            $actualizaciones[] = "`tipo_profesional_id` = ?";
            $params[] = ($datos['tipo_profesional_id'] === '' || $datos['tipo_profesional_id'] === null) ? null : (int)$datos['tipo_profesional_id'];
            $tipos .= 'i';
        }
        // Campo: especialidad
        if (array_key_exists('especialidad', $datos)) {
            $actualizaciones[] = "`especialidad` = ?";
            $params[] = ($datos['especialidad'] === '' || $datos['especialidad'] === null) ? '' : $datos['especialidad'];
            $tipos .= 's';
        }
        // Campo: registro_profesional
        if (array_key_exists('registro_profesional', $datos)) {
            $actualizaciones[] = "`registro_profesional` = ?";
            $params[] = ($datos['registro_profesional'] === '' || $datos['registro_profesional'] === null) ? '' : $datos['registro_profesional'];
            $tipos .= 's';
        }
        // Campo: codigo_prestador_minsalud
        if (array_key_exists('codigo_prestador_minsalud', $datos)) {
            $actualizaciones[] = "`codigo_prestador_minsalud` = ?";
            $params[] = ($datos['codigo_prestador_minsalud'] === '' || $datos['codigo_prestador_minsalud'] === null) ? '' : $datos['codigo_prestador_minsalud'];
            $tipos .= 's';
        }
        // Campo: universidad
        if (array_key_exists('universidad', $datos)) {
            $actualizaciones[] = "`universidad` = ?";
            $params[] = ($datos['universidad'] === '' || $datos['universidad'] === null) ? '' : $datos['universidad'];
            $tipos .= 's';
        }
        // Campo: anio_graduacion
        if (array_key_exists('anio_graduacion', $datos)) {
            $actualizaciones[] = "`anio_graduacion` = ?";
            $params[] = ($datos['anio_graduacion'] === '' || $datos['anio_graduacion'] === null) ? null : (int)$datos['anio_graduacion'];
            $tipos .= 'i';
        }
        // Campo: telefono_principal
        if (array_key_exists('telefono_principal', $datos)) {
            $actualizaciones[] = "`telefono_principal` = ?";
            $params[] = ($datos['telefono_principal'] === '' || $datos['telefono_principal'] === null) ? '' : $datos['telefono_principal'];
            $tipos .= 's';
        }
        // Campo: telefono_secundario
        if (array_key_exists('telefono_secundario', $datos)) {
            $actualizaciones[] = "`telefono_secundario` = ?";
            $params[] = ($datos['telefono_secundario'] === '' || $datos['telefono_secundario'] === null) ? '' : $datos['telefono_secundario'];
            $tipos .= 's';
        }
        // Campo: email
        if (array_key_exists('email', $datos)) {
            $actualizaciones[] = "`email` = ?";
            $params[] = ($datos['email'] === '' || $datos['email'] === null) ? '' : $datos['email'];
            $tipos .= 's';
        }
        // Campo: direccion
        if (array_key_exists('direccion', $datos)) {
            $actualizaciones[] = "`direccion` = ?";
            $params[] = ($datos['direccion'] === '' || $datos['direccion'] === null) ? '' : $datos['direccion'];
            $tipos .= 's';
        }
        // Campo: fecha_ingreso
        if (array_key_exists('fecha_ingreso', $datos)) {
            $actualizaciones[] = "`fecha_ingreso` = ?";
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_ingreso'])) ? date('Y-m-d', strtotime($datos['fecha_ingreso'])) : null;
            $tipos .= 's';
        }
        // Campo: jornada
        if (array_key_exists('jornada', $datos)) {
            $actualizaciones[] = "`jornada` = ?";
            $params[] = ($datos['jornada'] === '' || $datos['jornada'] === null) ? '' : $datos['jornada'];
            $tipos .= 's';
        }
        // Campo: disponible
        if (array_key_exists('disponible', $datos)) {
            $actualizaciones[] = "`disponible` = ?";
            $params[] = ($datos['disponible'] === '' || $datos['disponible'] === null) ? null : (int)$datos['disponible'];
            $tipos .= 'i';
        }
        // Campo: usuario_id_inserto
        if (array_key_exists('usuario_id_inserto', $datos) && $datos['usuario_id_inserto'] === '') {
            throw new Exception('El campo usuario_id_inserto es requerido.');
        }
        if (array_key_exists('usuario_id_inserto', $datos)) {
            $actualizaciones[] = "`usuario_id_inserto` = ?";
            $params[] = ($datos['usuario_id_inserto'] === '' || $datos['usuario_id_inserto'] === null) ? null : (int)$datos['usuario_id_inserto'];
            $tipos .= 'i';
        }
        // Campo: fecha_insercion
        if (array_key_exists('fecha_insercion', $datos)) {
            $actualizaciones[] = "`fecha_insercion` = ?";
            $params[] = ($datos['fecha_insercion'] === '' || $datos['fecha_insercion'] === null) ? '' : $datos['fecha_insercion'];
            $tipos .= 's';
        }
        // Campo: usuario_id_actualizo
        if (array_key_exists('usuario_id_actualizo', $datos)) {
            $actualizaciones[] = "`usuario_id_actualizo` = ?";
            $params[] = ($datos['usuario_id_actualizo'] === '' || $datos['usuario_id_actualizo'] === null) ? null : (int)$datos['usuario_id_actualizo'];
            $tipos .= 'i';
        }
        // Campo: fecha_actualizacion
        if (array_key_exists('fecha_actualizacion', $datos)) {
            $actualizaciones[] = "`fecha_actualizacion` = ?";
            $params[] = ($datos['fecha_actualizacion'] === '' || $datos['fecha_actualizacion'] === null) ? '' : $datos['fecha_actualizacion'];
            $tipos .= 's';
        }
        // Campo: usuario_id
        if (array_key_exists('usuario_id', $datos)) {
            $actualizaciones[] = "`usuario_id` = ?";
            $params[] = ($datos['usuario_id'] === '' || $datos['usuario_id'] === null) ? null : (int)$datos['usuario_id'];
            $tipos .= 'i';
        }

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE profesionales_salud SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM profesionales_salud WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`profesionales_salud`.`id`', '`profesionales_salud`.`tipo_identificacion_id`', '`profesionales_salud`.`identificacion`', '`profesionales_salud`.`primer_nombre`', '`profesionales_salud`.`segundo_nombre`', '`profesionales_salud`.`primer_apellido`', '`profesionales_salud`.`segundo_apellido`', '`profesionales_salud`.`fecha_nacimiento`', '`profesionales_salud`.`genero_id`', '`profesionales_salud`.`tipo_profesional_id`', '`profesionales_salud`.`especialidad`', '`profesionales_salud`.`registro_profesional`', '`profesionales_salud`.`codigo_prestador_minsalud`', '`profesionales_salud`.`universidad`', '`profesionales_salud`.`anio_graduacion`', '`profesionales_salud`.`telefono_principal`', '`profesionales_salud`.`telefono_secundario`', '`profesionales_salud`.`email`', '`profesionales_salud`.`direccion`', '`profesionales_salud`.`fecha_ingreso`', '`profesionales_salud`.`jornada`', '`profesionales_salud`.`disponible`', '`profesionales_salud`.`usuario_id_inserto`', '`profesionales_salud`.`fecha_insercion`', '`profesionales_salud`.`usuario_id_actualizo`', '`profesionales_salud`.`fecha_actualizacion`', '`profesionales_salud`.`usuario_id`', '`acc_usuario`.`fullname`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`tipos_profesional`.`codigo`'];
        
        $orderSQL = "";
        $esValidoOrden = false;
        if (!empty($orderBy)) {
            $orderByClean = str_replace(['`', ' '], '', $orderBy);
            foreach($allowedColumns as $ac) {
                if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                    $esValidoOrden = true;
                    break;
                }
            }
            if ($esValidoOrden) {
                $orderSQL = " ORDER BY $orderBy $orderDir ";
            }
        }

        if (empty($orderSQL)) {
            $orderSQL = " ORDER BY `profesionales_salud`.`primer_nombre` ASC, `profesionales_salud`.`primer_apellido` ASC, `profesionales_salud`.`segundo_nombre` ASC ";
        }

        $query = "SELECT `profesionales_salud`.* , `acc_usuario`.`fullname` as `usuario_id_display` , `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `tipos_profesional`.`codigo` as `tipo_profesional_id_display`  FROM profesionales_salud";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `profesionales_salud`.`id`, `profesionales_salud`.`tipo_identificacion_id`, `profesionales_salud`.`identificacion`, `profesionales_salud`.`primer_nombre`, `profesionales_salud`.`segundo_nombre`, `profesionales_salud`.`primer_apellido`, `profesionales_salud`.`segundo_apellido`, `profesionales_salud`.`fecha_nacimiento`, `profesionales_salud`.`genero_id`, `profesionales_salud`.`tipo_profesional_id`, `profesionales_salud`.`especialidad`, `profesionales_salud`.`registro_profesional`, `profesionales_salud`.`codigo_prestador_minsalud`, `profesionales_salud`.`universidad`, `profesionales_salud`.`anio_graduacion`, `profesionales_salud`.`telefono_principal`, `profesionales_salud`.`telefono_secundario`, `profesionales_salud`.`email`, `profesionales_salud`.`direccion`, `profesionales_salud`.`fecha_ingreso`, `profesionales_salud`.`jornada`, `profesionales_salud`.`disponible`, `profesionales_salud`.`usuario_id_inserto`, `profesionales_salud`.`fecha_insercion`, `profesionales_salud`.`usuario_id_actualizo`, `profesionales_salud`.`fecha_actualizacion`, `profesionales_salud`.`usuario_id`, `acc_usuario`.`fullname`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `tipos_profesional`.`codigo`) LIKE ?";
        $query .= $orderSQL;
        $query .= " LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($query);
        $termino = "%" . $termino . "%";
        $stmt->bind_param('sii', $termino, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
    }

    // --- Métodos para Vistas (Búsqueda por Campo) ---

    public function contarPorCampo($campo, $valor) {
        // Validar campo
        $allowedColumns = ['`profesionales_salud`.`id`', '`profesionales_salud`.`tipo_identificacion_id`', '`profesionales_salud`.`identificacion`', '`profesionales_salud`.`primer_nombre`', '`profesionales_salud`.`segundo_nombre`', '`profesionales_salud`.`primer_apellido`', '`profesionales_salud`.`segundo_apellido`', '`profesionales_salud`.`fecha_nacimiento`', '`profesionales_salud`.`genero_id`', '`profesionales_salud`.`tipo_profesional_id`', '`profesionales_salud`.`especialidad`', '`profesionales_salud`.`registro_profesional`', '`profesionales_salud`.`universidad`', '`profesionales_salud`.`anio_graduacion`', '`profesionales_salud`.`telefono_principal`', '`profesionales_salud`.`telefono_secundario`', '`profesionales_salud`.`email`', '`profesionales_salud`.`direccion`', '`profesionales_salud`.`fecha_ingreso`', '`profesionales_salud`.`jornada`', '`profesionales_salud`.`disponible`', '`profesionales_salud`.`usuario_id_inserto`', '`profesionales_salud`.`fecha_insercion`', '`profesionales_salud`.`usuario_id_actualizo`', '`profesionales_salud`.`fecha_actualizacion`', '`profesionales_salud`.`usuario_id`', '`acc_usuario`.`fullname`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`tipos_profesional`.`codigo`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'genero_id', 'tipo_profesional_id', 'especialidad', 'registro_profesional', 'universidad', 'anio_graduacion', 'telefono_principal', 'telefono_secundario', 'email', 'direccion', 'fecha_ingreso', 'jornada', 'disponible', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'usuario_id'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`profesionales_salud`.`" . $campo . "`";
                 break;
            }
        }
        if (!$esValido) {
             foreach($allowedColumns as $ac) {
                if (str_replace(['`', ' '], '', $ac) === $campoLimpio) {
                    $esValido = true;
                    $columnaSQL = $campo;
                    break;
                }
             }
        }

        if (!$esValido) return 0;

        $query = "SELECT COUNT(*) as total FROM profesionales_salud ";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= " WHERE " . $columnaSQL . " LIKE ?";
        
        $stmt = $this->conexion->prepare($query);
        $valor = "%" . $valor . "%";
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    public function buscarPorCampo($campo, $valor, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validación de campo idéntica a contarPorCampo
        $allowedColumns = ['`profesionales_salud`.`id`', '`profesionales_salud`.`tipo_identificacion_id`', '`profesionales_salud`.`identificacion`', '`profesionales_salud`.`primer_nombre`', '`profesionales_salud`.`segundo_nombre`', '`profesionales_salud`.`primer_apellido`', '`profesionales_salud`.`segundo_apellido`', '`profesionales_salud`.`fecha_nacimiento`', '`profesionales_salud`.`genero_id`', '`profesionales_salud`.`tipo_profesional_id`', '`profesionales_salud`.`especialidad`', '`profesionales_salud`.`registro_profesional`', '`profesionales_salud`.`universidad`', '`profesionales_salud`.`anio_graduacion`', '`profesionales_salud`.`telefono_principal`', '`profesionales_salud`.`telefono_secundario`', '`profesionales_salud`.`email`', '`profesionales_salud`.`direccion`', '`profesionales_salud`.`fecha_ingreso`', '`profesionales_salud`.`jornada`', '`profesionales_salud`.`disponible`', '`profesionales_salud`.`usuario_id_inserto`', '`profesionales_salud`.`fecha_insercion`', '`profesionales_salud`.`usuario_id_actualizo`', '`profesionales_salud`.`fecha_actualizacion`', '`profesionales_salud`.`usuario_id`', '`acc_usuario`.`fullname`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`tipos_profesional`.`codigo`'];
        $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'genero_id', 'tipo_profesional_id', 'especialidad', 'registro_profesional', 'universidad', 'anio_graduacion', 'telefono_principal', 'telefono_secundario', 'email', 'direccion', 'fecha_ingreso', 'jornada', 'disponible', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'usuario_id'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`profesionales_salud`.`" . $campo . "`";
                 break;
            }
        }
        if (!$esValido) {
             foreach($allowedColumns as $ac) {
                if (str_replace(['`', ' '], '', $ac) === $campoLimpio) {
                    $esValido = true;
                    $columnaSQL = $campo;
                    break;
                }
             }
        }
        if (!$esValido) return [];

        // Validación OrderBy
        $orderSQL = "";
        $esValidoOrden = false;
        if (!empty($orderBy)) {
            $orderByClean = str_replace(['`', ' '], '', $orderBy);
            foreach($allowedColumns as $ac) {
                if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                    $esValidoOrden = true;
                    break;
                }
            }
            if ($esValidoOrden) {
                $orderSQL = " ORDER BY $orderBy $orderDir ";
            }
        }
        
        if (empty($orderSQL)) {
             $orderSQL = " ORDER BY `profesionales_salud`.`primer_nombre` ASC, `profesionales_salud`.`primer_apellido` ASC, `profesionales_salud`.`segundo_nombre` ASC ";
        }

        $query = "SELECT `profesionales_salud`.* , `acc_usuario`.`fullname` as `usuario_id_display` , `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `tipos_profesional`.`codigo` as `tipo_profesional_id_display`  FROM profesionales_salud";
        $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
        $query .= " WHERE " . $columnaSQL . " LIKE ?";
        $query .= $orderSQL;
        $query .= " LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($query);
        $valor = "%" . $valor . "%";
        $stmt->bind_param('sii', $valor, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
    }

    // Funcion de exportar datos
    public function exportarDatos($termino = '', $campoFiltro = '') {
        try {
            $query = "SELECT `profesionales_salud`.`id`, `profesionales_salud`.`tipo_identificacion_id`, `profesionales_salud`.`identificacion`, `profesionales_salud`.`primer_nombre`, `profesionales_salud`.`segundo_nombre`, `profesionales_salud`.`primer_apellido`, `profesionales_salud`.`segundo_apellido`, `profesionales_salud`.`fecha_nacimiento`, `profesionales_salud`.`genero_id`, `profesionales_salud`.`tipo_profesional_id`, `profesionales_salud`.`especialidad`, `profesionales_salud`.`registro_profesional`, `profesionales_salud`.`universidad`, `profesionales_salud`.`anio_graduacion`, `profesionales_salud`.`telefono_principal`, `profesionales_salud`.`telefono_secundario`, `profesionales_salud`.`email`, `profesionales_salud`.`direccion`, `profesionales_salud`.`fecha_ingreso`, `profesionales_salud`.`jornada`, `profesionales_salud`.`disponible`, `profesionales_salud`.`usuario_id_inserto`, `profesionales_salud`.`fecha_insercion`, `profesionales_salud`.`usuario_id_actualizo`, `profesionales_salud`.`fecha_actualizacion`, `profesionales_salud`.`usuario_id`, `acc_usuario`.`fullname` as `usuario_id_display` , `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `tipos_profesional`.`codigo` as `tipo_profesional_id_display`  FROM profesionales_salud";
            $query .= " LEFT JOIN `acc_usuario` ON `profesionales_salud`.`usuario_id` = `acc_usuario`.`id_usuario` ";
            $query .= " LEFT JOIN `tipos_identificacion` ON `profesionales_salud`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
            $query .= " LEFT JOIN `generos` ON `profesionales_salud`.`genero_id` = `generos`.`id` ";
            $query .= " LEFT JOIN `tipos_profesional` ON `profesionales_salud`.`tipo_profesional_id` = `tipos_profesional`.`id` ";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`profesionales_salud`.`id`', '`profesionales_salud`.`tipo_identificacion_id`', '`profesionales_salud`.`identificacion`', '`profesionales_salud`.`primer_nombre`', '`profesionales_salud`.`segundo_nombre`', '`profesionales_salud`.`primer_apellido`', '`profesionales_salud`.`segundo_apellido`', '`profesionales_salud`.`fecha_nacimiento`', '`profesionales_salud`.`genero_id`', '`profesionales_salud`.`tipo_profesional_id`', '`profesionales_salud`.`especialidad`', '`profesionales_salud`.`registro_profesional`', '`profesionales_salud`.`universidad`', '`profesionales_salud`.`anio_graduacion`', '`profesionales_salud`.`telefono_principal`', '`profesionales_salud`.`telefono_secundario`', '`profesionales_salud`.`email`', '`profesionales_salud`.`direccion`', '`profesionales_salud`.`fecha_ingreso`', '`profesionales_salud`.`jornada`', '`profesionales_salud`.`disponible`', '`profesionales_salud`.`usuario_id_inserto`', '`profesionales_salud`.`fecha_insercion`', '`profesionales_salud`.`usuario_id_actualizo`', '`profesionales_salud`.`fecha_actualizacion`', '`profesionales_salud`.`usuario_id`', '`acc_usuario`.`fullname`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`tipos_profesional`.`codigo`'];
                $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'genero_id', 'tipo_profesional_id', 'especialidad', 'registro_profesional', 'universidad', 'anio_graduacion', 'telefono_principal', 'telefono_secundario', 'email', 'direccion', 'fecha_ingreso', 'jornada', 'disponible', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'usuario_id'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`profesionales_salud`.`" . $campoFiltro . "`";
                         break;
                    }
                }
                if (!$usarFiltroCampo) {
                     foreach($allowedColumns as $ac) {
                        if (str_replace(['`', ' '], '', $ac) === $campoLimpio) {
                            $usarFiltroCampo = true;
                            $columnaSQL = $campoFiltro;
                            break;
                        }
                     }
                }
            }

            if ($usarFiltroCampo) {
                 $query .= $columnaSQL . " LIKE ?";
            } else {
                $query .= "CONCAT_WS(' ', `profesionales_salud`.`id`, `profesionales_salud`.`tipo_identificacion_id`, `profesionales_salud`.`identificacion`, `profesionales_salud`.`primer_nombre`, `profesionales_salud`.`segundo_nombre`, `profesionales_salud`.`primer_apellido`, `profesionales_salud`.`segundo_apellido`, `profesionales_salud`.`fecha_nacimiento`, `profesionales_salud`.`genero_id`, `profesionales_salud`.`tipo_profesional_id`, `profesionales_salud`.`especialidad`, `profesionales_salud`.`registro_profesional`, `profesionales_salud`.`universidad`, `profesionales_salud`.`anio_graduacion`, `profesionales_salud`.`telefono_principal`, `profesionales_salud`.`telefono_secundario`, `profesionales_salud`.`email`, `profesionales_salud`.`direccion`, `profesionales_salud`.`fecha_ingreso`, `profesionales_salud`.`jornada`, `profesionales_salud`.`disponible`, `profesionales_salud`.`usuario_id_inserto`, `profesionales_salud`.`fecha_insercion`, `profesionales_salud`.`usuario_id_actualizo`, `profesionales_salud`.`fecha_actualizacion`, `profesionales_salud`.`usuario_id`, `acc_usuario`.`fullname`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `tipos_profesional`.`codigo`) LIKE ?";
            }

            if (!$this->conexion) {
                throw new Exception('Error: No hay conexión a la base de datos');
            }

            $stmt = $this->conexion->prepare($query);
            if (!$stmt) {
                throw new Exception('Error preparando la consulta: ' . $this->conexion->error);
            }

            $terminoBusqueda = empty($termino) ? '%' : '%' . $termino . '%';
            $stmt->bind_param('s', $terminoBusqueda);
            if (!$stmt->execute()) {
                throw new Exception('Error ejecutando la consulta: ' . $stmt->error);
            }

            $resultado = $stmt->get_result();
            $datos = $resultado->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $datos;
        } catch (Exception $e) {
            error_log('Error en exportarDatos: ' . $e->getMessage());
            return false;
        }
    }

    public function obtenerEstados() {
        $tabla = 'profesionales_salud';
        $sql = "SELECT estado, nombre_estado FROM acc_estado where tabla = ? and visible = 1 order by orden";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param('s', $tabla);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $estados = [];

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $estados[] = $fila;
            }
        }
        return $estados;
    }
}
?>