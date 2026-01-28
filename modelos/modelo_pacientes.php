<?php
    /**
     * Modelo para la tabla pacientes     */
require_once '../conexion.php';

class ModeloPacientes {
    private $conexion;
    private $llavePrimaria = 'id';
    private $es_vista = false;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function getConexion() {
        return $this->conexion;
    }

    // Métodos para obtener datos relacionados (Comboboxes)
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
    public function obtenerRelacionado_grupo_sanguineo_id() {
                $sql = "SELECT `id` as id, `codigo` as texto FROM `grupos_sanguineos`  WHERE estado = 'activo' ORDER BY `orden` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_eps_id() {
                $sql = "SELECT `id` as id, `nombre` as texto FROM `eps`  WHERE estado = 'activo' ORDER BY `nombre` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_ocupacion_id() {
                $sql = "SELECT `id` as id, `nombre` as texto FROM `ocupaciones`  WHERE estado = 'activo' ORDER BY `nombre` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_estado_civil_id() {
                $sql = "SELECT `id` as id, `nombre` as texto FROM `estados_civiles`  WHERE estado = 'activo' ORDER BY `orden` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_parentesco_id() {
                $sql = "SELECT `id` as id, `nombre` as texto FROM `parentescos`  WHERE estado = 'activo' ORDER BY `orden` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_estado_paciente_id() {
                $sql = "SELECT `id` as id, `codigo` as texto FROM `estados_paciente`  ORDER BY `orden` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function obtenerRelacionado_id_pais() {
        $sql = "SELECT `id` as id, `nombre_pais` as texto FROM `paises` WHERE estado = 'activo' ORDER BY `campo_ordenamiento` ASC, `nombre_pais` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Función para contar registros
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM pacientes";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM pacientes ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
        $query .= " WHERE ";
        $query .= "CONVERT(CONCAT_WS(' ', `pacientes`.`id`, `pacientes`.`tipo_identificacion_id`, `pacientes`.`identificacion`, `pacientes`.`fecha_ingreso`, `pacientes`.`primer_nombre`, `pacientes`.`segundo_nombre`, `pacientes`.`primer_apellido`, `pacientes`.`segundo_apellido`, `pacientes`.`fecha_nacimiento`, `pacientes`.`id_pais`, `pacientes`.`genero_id`, `pacientes`.`direccion`, `pacientes`.`ciudad`, `pacientes`.`localidad`, `pacientes`.`departamento`, `pacientes`.`telefono_principal`, `pacientes`.`telefono_secundario`, `pacientes`.`email`, `pacientes`.`eps_id`, `pacientes`.`ocupacion_id`, `pacientes`.`estado_civil_id`, `pacientes`.`identificacion_acompaniante`, `pacientes`.`acompaniante_nombres`, `pacientes`.`acompaniante_apellidos`, `pacientes`.`acompaniante_telefono`, `pacientes`.`acompañante_email`, `pacientes`.`parentesco_id`, `pacientes`.`grupo_sanguineo_id`, `pacientes`.`foto_ruta`, `pacientes`.`estado_paciente_id`, `pacientes`.`usuario_id_inserto`, `pacientes`.`fecha_insercion`, `pacientes`.`usuario_id_actualizo`, `pacientes`.`fecha_actualizacion`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `grupos_sanguineos`.`codigo`, `eps`.`nombre`, `ocupaciones`.`nombre`, `estados_civiles`.`nombre`, `parentescos`.`nombre`, `estados_paciente`.`codigo`, `paises`.`nombre_pais`) USING utf8mb4) LIKE ?";
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
        $allowedColumns = ['`pacientes`.`id`', '`pacientes`.`tipo_identificacion_id`', '`pacientes`.`identificacion`', '`pacientes`.`fecha_ingreso`', '`pacientes`.`primer_nombre`', '`pacientes`.`segundo_nombre`', '`pacientes`.`primer_apellido`', '`pacientes`.`segundo_apellido`', '`pacientes`.`fecha_nacimiento`', '`pacientes`.`id_pais`', '`pacientes`.`genero_id`', '`pacientes`.`direccion`', '`pacientes`.`ciudad`', '`pacientes`.`localidad`', '`pacientes`.`departamento`', '`pacientes`.`telefono_principal`', '`pacientes`.`telefono_secundario`', '`pacientes`.`email`', '`pacientes`.`eps_id`', '`pacientes`.`ocupacion_id`', '`pacientes`.`estado_civil_id`', '`pacientes`.`identificacion_acompaniante`', '`pacientes`.`acompaniante_nombres`', '`pacientes`.`acompaniante_apellidos`', '`pacientes`.`acompaniante_telefono`', '`pacientes`.`acompañante_email`', '`pacientes`.`parentesco_id`', '`pacientes`.`grupo_sanguineo_id`', '`pacientes`.`foto_ruta`', '`pacientes`.`estado_paciente_id`', '`pacientes`.`usuario_id_inserto`', '`pacientes`.`fecha_insercion`', '`pacientes`.`usuario_id_actualizo`', '`pacientes`.`fecha_actualizacion`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`grupos_sanguineos`.`codigo`', '`eps`.`nombre`', '`ocupaciones`.`nombre`', '`estados_civiles`.`nombre`', '`parentescos`.`nombre`', '`estados_paciente`.`codigo`', '`paises`.`nombre_pais`'];
        
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
            $orderSQL = " ORDER BY `pacientes`.`primer_apellido` ASC, `pacientes`.`primer_nombre` ASC, `pacientes`.`segundo_apellido` ASC ";
        }

        $query = "SELECT `pacientes`.* , 
                         CONCAT(`pacientes`.primer_nombre, ' ', COALESCE(`pacientes`.segundo_nombre,''), ' ', `pacientes`.primer_apellido, ' ', COALESCE(`pacientes`.segundo_apellido,'')) AS nombre_completo,
                         `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `grupos_sanguineos`.`codigo` as `grupo_sanguineo_id_display` , `eps`.`nombre` as `eps_id_display` , `ocupaciones`.`nombre` as `ocupacion_id_display` , `estados_civiles`.`nombre` as `estado_civil_id_display` , `parentescos`.`nombre` as `parentesco_id_display` , `estados_paciente`.`codigo` as `estado_paciente_id_display` , `paises`.`nombre_pais` as `id_pais_display`  FROM pacientes";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
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
        $query = "SELECT `pacientes`.* , 
                         CONCAT(`pacientes`.primer_nombre, ' ', COALESCE(`pacientes`.segundo_nombre,''), ' ', `pacientes`.primer_apellido, ' ', COALESCE(`pacientes`.segundo_apellido,'')) AS nombre_completo,
                         `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `grupos_sanguineos`.`codigo` as `grupo_sanguineo_id_display` , `eps`.`nombre` as `eps_id_display` , `ocupaciones`.`nombre` as `ocupacion_id_display` , `estados_civiles`.`nombre` as `estado_civil_id_display` , `parentescos`.`nombre` as `parentesco_id_display` , `estados_paciente`.`codigo` as `estado_paciente_id_display`, `paises`.`nombre_pais` as `id_pais_display`  FROM pacientes";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
        $query .= " WHERE `pacientes`.$this->llavePrimaria = ?";
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
        // Campo: fecha_ingreso
        if (!isset($datos['fecha_ingreso']) || $datos['fecha_ingreso'] === '') {
            throw new Exception('El campo fecha_ingreso es requerido.');
        }
        if (array_key_exists('fecha_ingreso', $datos)) {
            $campos[] = '`fecha_ingreso`';
            $valores[] = '?';
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_ingreso'])) ? date('Y-m-d', strtotime($datos['fecha_ingreso'])) : null;
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
        if (!isset($datos['fecha_nacimiento']) || $datos['fecha_nacimiento'] === '') {
            throw new Exception('El campo fecha_nacimiento es requerido.');
        }
        if (array_key_exists('fecha_nacimiento', $datos)) {
            $campos[] = '`fecha_nacimiento`';
            $valores[] = '?';
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_nacimiento'])) ? date('Y-m-d', strtotime($datos['fecha_nacimiento'])) : null;
            $tipos .= 's';
        }
        // Campo: id_pais
        if (array_key_exists('id_pais', $datos)) {
            $campos[] = '`id_pais`';
            $valores[] = '?';
            $params[] = ($datos['id_pais'] === '' || $datos['id_pais'] === null) ? null : (int)$datos['id_pais'];
            $tipos .= 'i';
        }
        // Campo: genero_id
        if (!isset($datos['genero_id']) || $datos['genero_id'] === '') {
            throw new Exception('El campo genero_id es requerido.');
        }
        if (array_key_exists('genero_id', $datos)) {
            $campos[] = '`genero_id`';
            $valores[] = '?';
            $params[] = ($datos['genero_id'] === '' || $datos['genero_id'] === null) ? null : (int)$datos['genero_id'];
            $tipos .= 'i';
        }
        // Campo: direccion
        if (array_key_exists('direccion', $datos)) {
            $campos[] = '`direccion`';
            $valores[] = '?';
            $params[] = ($datos['direccion'] === '' || $datos['direccion'] === null) ? '' : $datos['direccion'];
            $tipos .= 's';
        }
        // Campo: ciudad
        if (array_key_exists('ciudad', $datos)) {
            $campos[] = '`ciudad`';
            $valores[] = '?';
            $params[] = ($datos['ciudad'] === '' || $datos['ciudad'] === null) ? '' : $datos['ciudad'];
            $tipos .= 's';
        }
        // Campo: localidad
        if (array_key_exists('localidad', $datos)) {
            $campos[] = '`localidad`';
            $valores[] = '?';
            $params[] = ($datos['localidad'] === '' || $datos['localidad'] === null) ? '' : $datos['localidad'];
            $tipos .= 's';
        }
        // Campo: departamento
        if (array_key_exists('departamento', $datos)) {
            $campos[] = '`departamento`';
            $valores[] = '?';
            $params[] = ($datos['departamento'] === '' || $datos['departamento'] === null) ? '' : $datos['departamento'];
            $tipos .= 's';
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
        // Campo: eps_id
        if (array_key_exists('eps_id', $datos)) {
            $campos[] = '`eps_id`';
            $valores[] = '?';
            $params[] = ($datos['eps_id'] === '' || $datos['eps_id'] === null) ? null : (int)$datos['eps_id'];
            $tipos .= 'i';
        }
        // Campo: ocupacion_id
        if (array_key_exists('ocupacion_id', $datos)) {
            $campos[] = '`ocupacion_id`';
            $valores[] = '?';
            $params[] = ($datos['ocupacion_id'] === '' || $datos['ocupacion_id'] === null) ? null : (int)$datos['ocupacion_id'];
            $tipos .= 'i';
        }
        // Campo: estado_civil_id
        if (array_key_exists('estado_civil_id', $datos)) {
            $campos[] = '`estado_civil_id`';
            $valores[] = '?';
            $params[] = ($datos['estado_civil_id'] === '' || $datos['estado_civil_id'] === null) ? null : (int)$datos['estado_civil_id'];
            $tipos .= 'i';
        }
        // Campo: identificacion_acompaniante
        if (array_key_exists('identificacion_acompaniante', $datos)) {
            $campos[] = '`identificacion_acompaniante`';
            $valores[] = '?';
            $params[] = ($datos['identificacion_acompaniante'] === '' || $datos['identificacion_acompaniante'] === null) ? '' : $datos['identificacion_acompaniante'];
            $tipos .= 's';
        }
        // Campo: acompaniante_nombres
        if (array_key_exists('acompaniante_nombres', $datos)) {
            $campos[] = '`acompaniante_nombres`';
            $valores[] = '?';
            $params[] = ($datos['acompaniante_nombres'] === '' || $datos['acompaniante_nombres'] === null) ? '' : $datos['acompaniante_nombres'];
            $tipos .= 's';
        }
        // Campo: acompaniante_apellidos
        if (array_key_exists('acompaniante_apellidos', $datos)) {
            $campos[] = '`acompaniante_apellidos`';
            $valores[] = '?';
            $params[] = ($datos['acompaniante_apellidos'] === '' || $datos['acompaniante_apellidos'] === null) ? '' : $datos['acompaniante_apellidos'];
            $tipos .= 's';
        }
        // Campo: acompaniante_telefono
        if (array_key_exists('acompaniante_telefono', $datos)) {
            $campos[] = '`acompaniante_telefono`';
            $valores[] = '?';
            $params[] = ($datos['acompaniante_telefono'] === '' || $datos['acompaniante_telefono'] === null) ? '' : $datos['acompaniante_telefono'];
            $tipos .= 's';
        }
        // Campo: acompañante_email
        if (array_key_exists('acompañante_email', $datos)) {
            $campos[] = '`acompañante_email`';
            $valores[] = '?';
            $params[] = ($datos['acompañante_email'] === '' || $datos['acompañante_email'] === null) ? '' : $datos['acompañante_email'];
            $tipos .= 's';
        }
        // Campo: parentesco_id
        if (array_key_exists('parentesco_id', $datos)) {
            $campos[] = '`parentesco_id`';
            $valores[] = '?';
            $params[] = ($datos['parentesco_id'] === '' || $datos['parentesco_id'] === null) ? null : (int)$datos['parentesco_id'];
            $tipos .= 'i';
        }
        // Campo: grupo_sanguineo_id
        if (array_key_exists('grupo_sanguineo_id', $datos)) {
            $campos[] = '`grupo_sanguineo_id`';
            $valores[] = '?';
            $params[] = ($datos['grupo_sanguineo_id'] === '' || $datos['grupo_sanguineo_id'] === null) ? null : (int)$datos['grupo_sanguineo_id'];
            $tipos .= 'i';
        }
        // Campo: foto_ruta
        if (array_key_exists('foto_ruta', $datos)) {
            $campos[] = '`foto_ruta`';
            $valores[] = '?';
            $params[] = ($datos['foto_ruta'] === '' || $datos['foto_ruta'] === null) ? '' : $datos['foto_ruta'];
            $tipos .= 's';
        }
        // Campo: estado_paciente_id
        if (array_key_exists('estado_paciente_id', $datos)) {
            $campos[] = '`estado_paciente_id`';
            $valores[] = '?';
            $params[] = ($datos['estado_paciente_id'] === '' || $datos['estado_paciente_id'] === null) ? null : (int)$datos['estado_paciente_id'];
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

        $query = "INSERT INTO pacientes (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando insert: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar insert: " . $stmt->error);
        }
        return $this->conexion->insert_id;
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
        // Campo: fecha_ingreso
        if (array_key_exists('fecha_ingreso', $datos) && $datos['fecha_ingreso'] === '') {
            throw new Exception('El campo fecha_ingreso es requerido.');
        }
        if (array_key_exists('fecha_ingreso', $datos)) {
            $actualizaciones[] = "`fecha_ingreso` = ?";
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_ingreso'])) ? date('Y-m-d', strtotime($datos['fecha_ingreso'])) : null;
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
        if (array_key_exists('fecha_nacimiento', $datos) && $datos['fecha_nacimiento'] === '') {
            throw new Exception('El campo fecha_nacimiento es requerido.');
        }
        if (array_key_exists('fecha_nacimiento', $datos)) {
            $actualizaciones[] = "`fecha_nacimiento` = ?";
            // Formatear fecha o dejar nulo si está vacío
            $params[] = (!empty($datos['fecha_nacimiento'])) ? date('Y-m-d', strtotime($datos['fecha_nacimiento'])) : null;
            $tipos .= 's';
        }
        // Campo: id_pais
        if (array_key_exists('id_pais', $datos)) {
            $actualizaciones[] = "`id_pais` = ?";
            $params[] = ($datos['id_pais'] === '' || $datos['id_pais'] === null) ? null : (int)$datos['id_pais'];
            $tipos .= 'i';
        }
        // Campo: genero_id
        if (array_key_exists('genero_id', $datos) && $datos['genero_id'] === '') {
            throw new Exception('El campo genero_id es requerido.');
        }
        if (array_key_exists('genero_id', $datos)) {
            $actualizaciones[] = "`genero_id` = ?";
            $params[] = ($datos['genero_id'] === '' || $datos['genero_id'] === null) ? null : (int)$datos['genero_id'];
            $tipos .= 'i';
        }
        // Campo: direccion
        if (array_key_exists('direccion', $datos)) {
            $actualizaciones[] = "`direccion` = ?";
            $params[] = ($datos['direccion'] === '' || $datos['direccion'] === null) ? '' : $datos['direccion'];
            $tipos .= 's';
        }
        // Campo: ciudad
        if (array_key_exists('ciudad', $datos)) {
            $actualizaciones[] = "`ciudad` = ?";
            $params[] = ($datos['ciudad'] === '' || $datos['ciudad'] === null) ? '' : $datos['ciudad'];
            $tipos .= 's';
        }
        // Campo: localidad
        if (array_key_exists('localidad', $datos)) {
            $actualizaciones[] = "`localidad` = ?";
            $params[] = ($datos['localidad'] === '' || $datos['localidad'] === null) ? '' : $datos['localidad'];
            $tipos .= 's';
        }
        // Campo: departamento
        if (array_key_exists('departamento', $datos)) {
            $actualizaciones[] = "`departamento` = ?";
            $params[] = ($datos['departamento'] === '' || $datos['departamento'] === null) ? '' : $datos['departamento'];
            $tipos .= 's';
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
        // Campo: eps_id
        if (array_key_exists('eps_id', $datos)) {
            $actualizaciones[] = "`eps_id` = ?";
            $params[] = ($datos['eps_id'] === '' || $datos['eps_id'] === null) ? null : (int)$datos['eps_id'];
            $tipos .= 'i';
        }
        // Campo: ocupacion_id
        if (array_key_exists('ocupacion_id', $datos)) {
            $actualizaciones[] = "`ocupacion_id` = ?";
            $params[] = ($datos['ocupacion_id'] === '' || $datos['ocupacion_id'] === null) ? null : (int)$datos['ocupacion_id'];
            $tipos .= 'i';
        }
        // Campo: estado_civil_id
        if (array_key_exists('estado_civil_id', $datos)) {
            $actualizaciones[] = "`estado_civil_id` = ?";
            $params[] = ($datos['estado_civil_id'] === '' || $datos['estado_civil_id'] === null) ? null : (int)$datos['estado_civil_id'];
            $tipos .= 'i';
        }
        // Campo: identificacion_acompaniante
        if (array_key_exists('identificacion_acompaniante', $datos)) {
            $actualizaciones[] = "`identificacion_acompaniante` = ?";
            $params[] = ($datos['identificacion_acompaniante'] === '' || $datos['identificacion_acompaniante'] === null) ? '' : $datos['identificacion_acompaniante'];
            $tipos .= 's';
        }
        // Campo: acompaniante_nombres
        if (array_key_exists('acompaniante_nombres', $datos)) {
            $actualizaciones[] = "`acompaniante_nombres` = ?";
            $params[] = ($datos['acompaniante_nombres'] === '' || $datos['acompaniante_nombres'] === null) ? '' : $datos['acompaniante_nombres'];
            $tipos .= 's';
        }
        // Campo: acompaniante_apellidos
        if (array_key_exists('acompaniante_apellidos', $datos)) {
            $actualizaciones[] = "`acompaniante_apellidos` = ?";
            $params[] = ($datos['acompaniante_apellidos'] === '' || $datos['acompaniante_apellidos'] === null) ? '' : $datos['acompaniante_apellidos'];
            $tipos .= 's';
        }
        // Campo: acompaniante_telefono
        if (array_key_exists('acompaniante_telefono', $datos)) {
            $actualizaciones[] = "`acompaniante_telefono` = ?";
            $params[] = ($datos['acompaniante_telefono'] === '' || $datos['acompaniante_telefono'] === null) ? '' : $datos['acompaniante_telefono'];
            $tipos .= 's';
        }
        // Campo: acompañante_email
        if (array_key_exists('acompañante_email', $datos)) {
            $actualizaciones[] = "`acompañante_email` = ?";
            $params[] = ($datos['acompañante_email'] === '' || $datos['acompañante_email'] === null) ? '' : $datos['acompañante_email'];
            $tipos .= 's';
        }
        // Campo: parentesco_id
        if (array_key_exists('parentesco_id', $datos)) {
            $actualizaciones[] = "`parentesco_id` = ?";
            $params[] = ($datos['parentesco_id'] === '' || $datos['parentesco_id'] === null) ? null : (int)$datos['parentesco_id'];
            $tipos .= 'i';
        }
        // Campo: grupo_sanguineo_id
        if (array_key_exists('grupo_sanguineo_id', $datos)) {
            $actualizaciones[] = "`grupo_sanguineo_id` = ?";
            $params[] = ($datos['grupo_sanguineo_id'] === '' || $datos['grupo_sanguineo_id'] === null) ? null : (int)$datos['grupo_sanguineo_id'];
            $tipos .= 'i';
        }
        // Campo: foto_ruta
        if (array_key_exists('foto_ruta', $datos)) {
            $actualizaciones[] = "`foto_ruta` = ?";
            $params[] = ($datos['foto_ruta'] === '' || $datos['foto_ruta'] === null) ? '' : $datos['foto_ruta'];
            $tipos .= 's';
        }
        // Campo: estado_paciente_id
        if (array_key_exists('estado_paciente_id', $datos)) {
            $actualizaciones[] = "`estado_paciente_id` = ?";
            $params[] = ($datos['estado_paciente_id'] === '' || $datos['estado_paciente_id'] === null) ? null : (int)$datos['estado_paciente_id'];
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

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE pacientes SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar update: " . $stmt->error);
        }
        return true;
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM pacientes WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar delete: " . $stmt->error);
        }
        return true;
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`pacientes`.`id`', '`pacientes`.`tipo_identificacion_id`', '`pacientes`.`identificacion`', '`pacientes`.`fecha_ingreso`', '`pacientes`.`primer_nombre`', '`pacientes`.`segundo_nombre`', '`pacientes`.`primer_apellido`', '`pacientes`.`segundo_apellido`', '`pacientes`.`fecha_nacimiento`', '`pacientes`.`id_pais`', '`pacientes`.`genero_id`', '`pacientes`.`direccion`', '`pacientes`.`ciudad`', '`pacientes`.`localidad`', '`pacientes`.`departamento`', '`pacientes`.`telefono_principal`', '`pacientes`.`telefono_secundario`', '`pacientes`.`email`', '`pacientes`.`eps_id`', '`pacientes`.`ocupacion_id`', '`pacientes`.`estado_civil_id`', '`pacientes`.`identificacion_acompaniante`', '`pacientes`.`acompaniante_nombres`', '`pacientes`.`acompaniante_apellidos`', '`pacientes`.`acompaniante_telefono`', '`pacientes`.`acompañante_email`', '`pacientes`.`parentesco_id`', '`pacientes`.`grupo_sanguineo_id`', '`pacientes`.`foto_ruta`', '`pacientes`.`estado_paciente_id`', '`pacientes`.`usuario_id_inserto`', '`pacientes`.`fecha_insercion`', '`pacientes`.`usuario_id_actualizo`', '`pacientes`.`fecha_actualizacion`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`grupos_sanguineos`.`codigo`', '`eps`.`nombre`', '`ocupaciones`.`nombre`', '`estados_civiles`.`nombre`', '`parentescos`.`nombre`', '`paises`.`nombre_pais`', '`estados_paciente`.`codigo`'];
        
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
            $orderSQL = " ORDER BY `pacientes`.`primer_apellido` ASC, `pacientes`.`primer_nombre` ASC, `pacientes`.`segundo_apellido` ASC ";
        }

        $query = "SELECT `pacientes`.* , 
                         CONCAT(`pacientes`.primer_nombre, ' ', COALESCE(`pacientes`.segundo_nombre,''), ' ', `pacientes`.primer_apellido, ' ', COALESCE(`pacientes`.segundo_apellido,'')) AS nombre_completo,
                         `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `grupos_sanguineos`.`codigo` as `grupo_sanguineo_id_display` , `eps`.`nombre` as `eps_id_display` , `ocupaciones`.`nombre` as `ocupacion_id_display` , `estados_civiles`.`nombre` as `estado_civil_id_display` , `parentescos`.`nombre` as `parentesco_id_display` , `estados_paciente`.`codigo` as `estado_paciente_id_display`, `paises`.`nombre_pais` as `id_pais_display`  FROM pacientes";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
        $query .= " WHERE ";
        $query .= "CONVERT(CONCAT_WS(' ', `pacientes`.`id`, `pacientes`.`tipo_identificacion_id`, `pacientes`.`identificacion`, `pacientes`.`fecha_ingreso`, `pacientes`.`primer_nombre`, `pacientes`.`segundo_nombre`, `pacientes`.`primer_apellido`, `pacientes`.`segundo_apellido`, `pacientes`.`fecha_nacimiento`, `pacientes`.`id_pais`, `pacientes`.`genero_id`, `pacientes`.`direccion`, `pacientes`.`ciudad`, `pacientes`.`localidad`, `pacientes`.`departamento`, `pacientes`.`telefono_principal`, `pacientes`.`telefono_secundario`, `pacientes`.`email`, `pacientes`.`eps_id`, `pacientes`.`ocupacion_id`, `pacientes`.`estado_civil_id`, `pacientes`.`identificacion_acompaniante`, `pacientes`.`acompaniante_nombres`, `pacientes`.`acompaniante_apellidos`, `pacientes`.`acompaniante_telefono`, `pacientes`.`acompañante_email`, `pacientes`.`parentesco_id`, `pacientes`.`grupo_sanguineo_id`, `pacientes`.`foto_ruta`, `pacientes`.`estado_paciente_id`, `pacientes`.`usuario_id_inserto`, `pacientes`.`fecha_insercion`, `pacientes`.`usuario_id_actualizo`, `pacientes`.`fecha_actualizacion`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `grupos_sanguineos`.`codigo`, `eps`.`nombre`, `ocupaciones`.`nombre`, `estados_civiles`.`nombre`, `parentescos`.`nombre`, `estados_paciente`.`codigo`, `paises`.`nombre_pais`) USING utf8mb4) LIKE ?";
        $query .= $orderSQL;
        $query .= " LIMIT ? OFFSET ?";
        
        $stmt = $this->conexion->prepare($query);
        if (!$stmt) return false;
        $termino = "%" . $termino . "%";
        $stmt->bind_param('sii', $termino, $registrosPorPagina, $offset);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : false;
    }

    // --- Métodos para Vistas (Búsqueda por Campo) ---

    public function contarPorCampo($campo, $valor) {
        $allowedColumns = ['`pacientes`.`id`', '`pacientes`.`tipo_identificacion_id`', '`pacientes`.`identificacion`', '`pacientes`.`fecha_ingreso`', '`pacientes`.`primer_nombre`', '`pacientes`.`segundo_nombre`', '`pacientes`.`primer_apellido`', '`pacientes`.`segundo_apellido`', '`pacientes`.`fecha_nacimiento`', '`pacientes`.`id_pais`', '`pacientes`.`genero_id`', '`pacientes`.`direccion`', '`pacientes`.`ciudad`', '`pacientes`.`localidad`', '`pacientes`.`departamento`', '`pacientes`.`telefono_principal`', '`pacientes`.`telefono_secundario`', '`pacientes`.`email`', '`pacientes`.`eps_id`', '`pacientes`.`ocupacion_id`', '`pacientes`.`estado_civil_id`', '`pacientes`.`identificacion_acompaniante`', '`pacientes`.`acompaniante_nombres`', '`pacientes`.`acompaniante_apellidos`', '`pacientes`.`acompaniante_telefono`', '`pacientes`.`acompañante_email`', '`pacientes`.`parentesco_id`', '`pacientes`.`grupo_sanguineo_id`', '`pacientes`.`foto_ruta`', '`pacientes`.`estado_paciente_id`', '`pacientes`.`usuario_id_inserto`', '`pacientes`.`fecha_insercion`', '`pacientes`.`usuario_id_actualizo`', '`pacientes`.`fecha_actualizacion`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`grupos_sanguineos`.`codigo`', '`eps`.`nombre`', '`ocupaciones`.`nombre`', '`estados_civiles`.`nombre`', '`parentescos`.`nombre`', '`estados_paciente`.`codigo`', '`paises`.`nombre_pais`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'fecha_ingreso', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'id_pais', 'genero_id', 'direccion', 'ciudad', 'localidad', 'departamento', 'telefono_principal', 'telefono_secundario', 'email', 'eps_id', 'ocupacion_id', 'estado_civil_id', 'identificacion_acompaniante', 'acompaniante_nombres', 'acompaniante_apellidos', 'acompaniante_telefono', 'acompañante_email', 'parentesco_id', 'grupo_sanguineo_id', 'foto_ruta', 'estado_paciente_id', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`pacientes`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM pacientes ";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
        $query .= " WHERE CONVERT(" . $columnaSQL . " USING utf8mb4) LIKE ?";
        
        $stmt = $this->conexion->prepare($query);
        if (!$stmt) return 0;
        $valor = "%" . $valor . "%";
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        return (int)$fila['total'];
    }

    public function buscarPorCampo($campo, $valor, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validación de campo idéntica a contarPorCampo
        $allowedColumns = ['`pacientes`.`id`', '`pacientes`.`tipo_identificacion_id`', '`pacientes`.`identificacion`', '`pacientes`.`fecha_ingreso`', '`pacientes`.`primer_nombre`', '`pacientes`.`segundo_nombre`', '`pacientes`.`primer_apellido`', '`pacientes`.`segundo_apellido`', '`pacientes`.`fecha_nacimiento`', '`pacientes`.`id_pais`', '`pacientes`.`genero_id`', '`pacientes`.`direccion`', '`pacientes`.`ciudad`', '`pacientes`.`localidad`', '`pacientes`.`departamento`', '`pacientes`.`telefono_principal`', '`pacientes`.`telefono_secundario`', '`pacientes`.`email`', '`pacientes`.`eps_id`', '`pacientes`.`ocupacion_id`', '`pacientes`.`estado_civil_id`', '`pacientes`.`identificacion_acompaniante`', '`pacientes`.`acompaniante_nombres`', '`pacientes`.`acompaniante_apellidos`', '`pacientes`.`acompaniante_telefono`', '`pacientes`.`acompañante_email`', '`pacientes`.`parentesco_id`', '`pacientes`.`grupo_sanguineo_id`', '`pacientes`.`foto_ruta`', '`pacientes`.`estado_paciente_id`', '`pacientes`.`usuario_id_inserto`', '`pacientes`.`fecha_insercion`', '`pacientes`.`usuario_id_actualizo`', '`pacientes`.`fecha_actualizacion`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`grupos_sanguineos`.`codigo`', '`eps`.`nombre`', '`ocupaciones`.`nombre`', '`estados_civiles`.`nombre`', '`parentescos`.`nombre`', '`estados_paciente`.`codigo`', '`paises`.`nombre_pais`'];
        $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'fecha_ingreso', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'id_pais', 'genero_id', 'direccion', 'ciudad', 'localidad', 'departamento', 'telefono_principal', 'telefono_secundario', 'email', 'eps_id', 'ocupacion_id', 'estado_civil_id', 'identificacion_acompaniante', 'acompaniante_nombres', 'acompaniante_apellidos', 'acompaniante_telefono', 'acompañante_email', 'parentesco_id', 'grupo_sanguineo_id', 'foto_ruta', 'estado_paciente_id', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`pacientes`.`" . $campo . "`";
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
             $orderSQL = " ORDER BY `pacientes`.`primer_apellido` ASC, `pacientes`.`primer_nombre` ASC, `pacientes`.`segundo_apellido` ASC ";
        }

        $query = "SELECT `pacientes`.* , 
                         CONCAT(`pacientes`.primer_nombre, ' ', COALESCE(`pacientes`.segundo_nombre,''), ' ', `pacientes`.primer_apellido, ' ', COALESCE(`pacientes`.segundo_apellido,'')) AS nombre_completo,
                         `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `grupos_sanguineos`.`codigo` as `grupo_sanguineo_id_display` , `eps`.`nombre` as `eps_id_display` , `ocupaciones`.`nombre` as `ocupacion_id_display` , `estados_civiles`.`nombre` as `estado_civil_id_display` , `parentescos`.`nombre` as `parentesco_id_display` , `estados_paciente`.`codigo` as `estado_paciente_id_display`, `paises`.`nombre_pais` as `id_pais_display`  FROM pacientes";
        $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
        $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
        $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
        $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
        $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
        $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
        $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
        $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
        $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
        $query .= " WHERE CONVERT(" . $columnaSQL . " USING utf8mb4) LIKE ?";
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
            $query = "SELECT `pacientes`.*, 
                             CONCAT(`pacientes`.primer_nombre, ' ', COALESCE(`pacientes`.segundo_nombre,''), ' ', `pacientes`.primer_apellido, ' ', COALESCE(`pacientes`.segundo_apellido,'')) AS nombre_completo,
                             `tipos_identificacion`.`codigo` as `tipo_identificacion_id_display` , `generos`.`nombre` as `genero_id_display` , `grupos_sanguineos`.`codigo` as `grupo_sanguineo_id_display` , `eps`.`nombre` as `eps_id_display` , `ocupaciones`.`nombre` as `ocupacion_id_display` , `estados_civiles`.`nombre` as `estado_civil_id_display` , `parentescos`.`nombre` as `parentesco_id_display` , `estados_paciente`.`codigo` as `estado_paciente_id_display`, `paises`.`nombre_pais` as `id_pais_display`  FROM pacientes";
            $query .= " LEFT JOIN `tipos_identificacion` ON `pacientes`.`tipo_identificacion_id` = `tipos_identificacion`.`id` ";
            $query .= " LEFT JOIN `generos` ON `pacientes`.`genero_id` = `generos`.`id` ";
            $query .= " LEFT JOIN `grupos_sanguineos` ON `pacientes`.`grupo_sanguineo_id` = `grupos_sanguineos`.`id` ";
            $query .= " LEFT JOIN `eps` ON `pacientes`.`eps_id` = `eps`.`id` ";
            $query .= " LEFT JOIN `ocupaciones` ON `pacientes`.`ocupacion_id` = `ocupaciones`.`id` ";
            $query .= " LEFT JOIN `estados_civiles` ON `pacientes`.`estado_civil_id` = `estados_civiles`.`id` ";
            $query .= " LEFT JOIN `parentescos` ON `pacientes`.`parentesco_id` = `parentescos`.`id` ";
            $query .= " LEFT JOIN `estados_paciente` ON `pacientes`.`estado_paciente_id` = `estados_paciente`.`id` ";
            $query .= " LEFT JOIN `paises` ON `pacientes`.`id_pais` = `paises`.`id` ";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`pacientes`.`id`', '`pacientes`.`tipo_identificacion_id`', '`pacientes`.`identificacion`', '`pacientes`.`fecha_ingreso`', '`pacientes`.`primer_nombre`', '`pacientes`.`segundo_nombre`', '`pacientes`.`primer_apellido`', '`pacientes`.`segundo_apellido`', '`pacientes`.`fecha_nacimiento`', '`pacientes`.`id_pais`', '`pacientes`.`genero_id`', '`pacientes`.`direccion`', '`pacientes`.`ciudad`', '`pacientes`.`localidad`', '`pacientes`.`departamento`', '`pacientes`.`telefono_principal`', '`pacientes`.`telefono_secundario`', '`pacientes`.`email`', '`pacientes`.`eps_id`', '`pacientes`.`ocupacion_id`', '`pacientes`.`estado_civil_id`', '`pacientes`.`identificacion_acompaniante`', '`pacientes`.`acompaniante_nombres`', '`pacientes`.`acompaniante_apellidos`', '`pacientes`.`acompaniante_telefono`', '`pacientes`.`acompañante_email`', '`pacientes`.`parentesco_id`', '`pacientes`.`grupo_sanguineo_id`', '`pacientes`.`foto_ruta`', '`pacientes`.`estado_paciente_id`', '`pacientes`.`usuario_id_inserto`', '`pacientes`.`fecha_insercion`', '`pacientes`.`usuario_id_actualizo`', '`pacientes`.`fecha_actualizacion`', '`tipos_identificacion`.`codigo`', '`generos`.`nombre`', '`grupos_sanguineos`.`codigo`', '`eps`.`nombre`', '`ocupaciones`.`nombre`', '`estados_civiles`.`nombre`', '`parentescos`.`nombre`', '`estados_paciente`.`codigo`', '`paises`.`nombre_pais`'];
                $simpleCols = ['id', 'tipo_identificacion_id', 'identificacion', 'fecha_ingreso', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nacimiento', 'id_pais', 'genero_id', 'direccion', 'ciudad', 'localidad', 'departamento', 'telefono_principal', 'telefono_secundario', 'email', 'eps_id', 'ocupacion_id', 'estado_civil_id', 'identificacion_acompaniante', 'acompaniante_nombres', 'acompaniante_apellidos', 'acompaniante_telefono', 'acompañante_email', 'parentesco_id', 'grupo_sanguineo_id', 'foto_ruta', 'estado_paciente_id', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`pacientes`.`" . $campoFiltro . "`";
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
                $query .= "CONVERT(CONCAT_WS(' ', `pacientes`.`id`, `pacientes`.`tipo_identificacion_id`, `pacientes`.`identificacion`, `pacientes`.`fecha_ingreso`, `pacientes`.`primer_nombre`, `pacientes`.`segundo_nombre`, `pacientes`.`primer_apellido`, `pacientes`.`segundo_apellido`, `pacientes`.`fecha_nacimiento`, `pacientes`.`id_pais`, `pacientes`.`genero_id`, `pacientes`.`direccion`, `pacientes`.`ciudad`, `pacientes`.`localidad`, `pacientes`.`departamento`, `pacientes`.`telefono_principal`, `pacientes`.`telefono_secundario`, `pacientes`.`email`, `pacientes`.`eps_id`, `pacientes`.`ocupacion_id`, `pacientes`.`estado_civil_id`, `pacientes`.`identificacion_acompaniante`, `pacientes`.`acompaniante_nombres`, `pacientes`.`acompaniante_apellidos`, `pacientes`.`acompaniante_telefono`, `pacientes`.`acompañante_email`, `pacientes`.`parentesco_id`, `pacientes`.`grupo_sanguineo_id`, `pacientes`.`foto_ruta`, `pacientes`.`estado_paciente_id`, `pacientes`.`usuario_id_inserto`, `pacientes`.`fecha_insercion`, `pacientes`.`usuario_id_actualizo`, `pacientes`.`fecha_actualizacion`, `tipos_identificacion`.`codigo`, `generos`.`nombre`, `grupos_sanguineos`.`codigo`, `eps`.`nombre`, `ocupaciones`.`nombre`, `estados_civiles`.`nombre`, `parentescos`.`nombre`, `estados_paciente`.`codigo`, `paises`.`nombre_pais`) USING utf8mb4) LIKE ?";
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
        } catch (Throwable $e) {
            error_log('Error crítico en exportarDatos: ' . $e->getMessage());
            throw new Exception("Error de base de datos: " . $e->getMessage());
        }
    }

    public function obtenerEstados() {
        $tabla = 'pacientes';
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