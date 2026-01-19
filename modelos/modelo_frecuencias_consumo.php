<?php
    /**
     * Modelo para la tabla frecuencias_consumo     */
require_once '../conexion.php';

class ModeloFrecuencias_consumo {
    private $conexion;
    private $llavePrimaria = 'id';
    private $es_vista = false;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    // Métodos para obtener datos relacionados (Comboboxes)

    // Función para contar registros
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM frecuencias_consumo";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM frecuencias_consumo ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `frecuencias_consumo`.`id`, `frecuencias_consumo`.`codigo`, `frecuencias_consumo`.`nombre`, `frecuencias_consumo`.`descripcion`, `frecuencias_consumo`.`estado`, `frecuencias_consumo`.`usuario_id_inserto`, `frecuencias_consumo`.`fecha_insercion`, `frecuencias_consumo`.`usuario_id_actualizo`, `frecuencias_consumo`.`fecha_actualizacion`, `frecuencias_consumo`.`orden`) LIKE ?";
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
        $allowedColumns = ['`frecuencias_consumo`.`id`', '`frecuencias_consumo`.`codigo`', '`frecuencias_consumo`.`nombre`', '`frecuencias_consumo`.`descripcion`', '`frecuencias_consumo`.`estado`', '`frecuencias_consumo`.`usuario_id_inserto`', '`frecuencias_consumo`.`fecha_insercion`', '`frecuencias_consumo`.`usuario_id_actualizo`', '`frecuencias_consumo`.`fecha_actualizacion`', '`frecuencias_consumo`.`orden`'];
        
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
            $orderSQL = " ORDER BY `frecuencias_consumo`.`estado` ASC, `frecuencias_consumo`.`codigo` ASC, `frecuencias_consumo`.`nombre` ASC ";
        }

        $query = "SELECT `frecuencias_consumo`.*  FROM frecuencias_consumo";
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
        $query = "SELECT `frecuencias_consumo`.*  FROM frecuencias_consumo";
        $query .= " WHERE `frecuencias_consumo`.$this->llavePrimaria = ?";
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

        // Campo: codigo
        if (!isset($datos['codigo']) || $datos['codigo'] === '') {
            throw new Exception('El campo codigo es requerido.');
        }
        if (array_key_exists('codigo', $datos)) {
            $campos[] = '`codigo`';
            $valores[] = '?';
            $params[] = ($datos['codigo'] === '' || $datos['codigo'] === null) ? '' : $datos['codigo'];
            $tipos .= 's';
        }
        // Campo: nombre
        if (!isset($datos['nombre']) || $datos['nombre'] === '') {
            throw new Exception('El campo nombre es requerido.');
        }
        if (array_key_exists('nombre', $datos)) {
            $campos[] = '`nombre`';
            $valores[] = '?';
            $params[] = ($datos['nombre'] === '' || $datos['nombre'] === null) ? '' : $datos['nombre'];
            $tipos .= 's';
        }
        // Campo: descripcion
        if (array_key_exists('descripcion', $datos)) {
            $campos[] = '`descripcion`';
            $valores[] = '?';
            $params[] = ($datos['descripcion'] === '' || $datos['descripcion'] === null) ? '' : $datos['descripcion'];
            $tipos .= 's';
        }
        // Campo: estado
        if (array_key_exists('estado', $datos)) {
            $campos[] = '`estado`';
            $valores[] = '?';
            $params[] = ($datos['estado'] === '' || $datos['estado'] === null) ? '' : $datos['estado'];
            $tipos .= 's';
        }
        // Campo: usuario_id_inserto
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
        // Campo: orden
        if (array_key_exists('orden', $datos)) {
            $campos[] = '`orden`';
            $valores[] = '?';
            $params[] = ($datos['orden'] === '' || $datos['orden'] === null) ? null : (int)$datos['orden'];
            $tipos .= 'i';
        }

        $query = "INSERT INTO frecuencias_consumo (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
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

        // Campo: codigo
        if (array_key_exists('codigo', $datos) && $datos['codigo'] === '') {
            throw new Exception('El campo codigo es requerido.');
        }
        if (array_key_exists('codigo', $datos)) {
            $actualizaciones[] = "`codigo` = ?";
            $params[] = ($datos['codigo'] === '' || $datos['codigo'] === null) ? '' : $datos['codigo'];
            $tipos .= 's';
        }
        // Campo: nombre
        if (array_key_exists('nombre', $datos) && $datos['nombre'] === '') {
            throw new Exception('El campo nombre es requerido.');
        }
        if (array_key_exists('nombre', $datos)) {
            $actualizaciones[] = "`nombre` = ?";
            $params[] = ($datos['nombre'] === '' || $datos['nombre'] === null) ? '' : $datos['nombre'];
            $tipos .= 's';
        }
        // Campo: descripcion
        if (array_key_exists('descripcion', $datos)) {
            $actualizaciones[] = "`descripcion` = ?";
            $params[] = ($datos['descripcion'] === '' || $datos['descripcion'] === null) ? '' : $datos['descripcion'];
            $tipos .= 's';
        }
        // Campo: estado
        if (array_key_exists('estado', $datos)) {
            $actualizaciones[] = "`estado` = ?";
            $params[] = ($datos['estado'] === '' || $datos['estado'] === null) ? '' : $datos['estado'];
            $tipos .= 's';
        }
        // Campo: usuario_id_inserto
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
        // Campo: orden
        if (array_key_exists('orden', $datos)) {
            $actualizaciones[] = "`orden` = ?";
            $params[] = ($datos['orden'] === '' || $datos['orden'] === null) ? null : (int)$datos['orden'];
            $tipos .= 'i';
        }

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE frecuencias_consumo SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM frecuencias_consumo WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`frecuencias_consumo`.`id`', '`frecuencias_consumo`.`codigo`', '`frecuencias_consumo`.`nombre`', '`frecuencias_consumo`.`descripcion`', '`frecuencias_consumo`.`estado`', '`frecuencias_consumo`.`usuario_id_inserto`', '`frecuencias_consumo`.`fecha_insercion`', '`frecuencias_consumo`.`usuario_id_actualizo`', '`frecuencias_consumo`.`fecha_actualizacion`', '`frecuencias_consumo`.`orden`'];
        
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
            $orderSQL = " ORDER BY `frecuencias_consumo`.`estado` ASC, `frecuencias_consumo`.`codigo` ASC, `frecuencias_consumo`.`nombre` ASC ";
        }

        $query = "SELECT `frecuencias_consumo`.*  FROM frecuencias_consumo";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `frecuencias_consumo`.`id`, `frecuencias_consumo`.`codigo`, `frecuencias_consumo`.`nombre`, `frecuencias_consumo`.`descripcion`, `frecuencias_consumo`.`estado`, `frecuencias_consumo`.`usuario_id_inserto`, `frecuencias_consumo`.`fecha_insercion`, `frecuencias_consumo`.`usuario_id_actualizo`, `frecuencias_consumo`.`fecha_actualizacion`, `frecuencias_consumo`.`orden`) LIKE ?";
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
        $allowedColumns = ['`frecuencias_consumo`.`id`', '`frecuencias_consumo`.`codigo`', '`frecuencias_consumo`.`nombre`', '`frecuencias_consumo`.`descripcion`', '`frecuencias_consumo`.`estado`', '`frecuencias_consumo`.`usuario_id_inserto`', '`frecuencias_consumo`.`fecha_insercion`', '`frecuencias_consumo`.`usuario_id_actualizo`', '`frecuencias_consumo`.`fecha_actualizacion`', '`frecuencias_consumo`.`orden`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'orden'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`frecuencias_consumo`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM frecuencias_consumo ";
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
        $allowedColumns = ['`frecuencias_consumo`.`id`', '`frecuencias_consumo`.`codigo`', '`frecuencias_consumo`.`nombre`', '`frecuencias_consumo`.`descripcion`', '`frecuencias_consumo`.`estado`', '`frecuencias_consumo`.`usuario_id_inserto`', '`frecuencias_consumo`.`fecha_insercion`', '`frecuencias_consumo`.`usuario_id_actualizo`', '`frecuencias_consumo`.`fecha_actualizacion`', '`frecuencias_consumo`.`orden`'];
        $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'orden'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`frecuencias_consumo`.`" . $campo . "`";
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
             $orderSQL = " ORDER BY `frecuencias_consumo`.`estado` ASC, `frecuencias_consumo`.`codigo` ASC, `frecuencias_consumo`.`nombre` ASC ";
        }

        $query = "SELECT `frecuencias_consumo`.*  FROM frecuencias_consumo";
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
            $query = "SELECT `frecuencias_consumo`.`codigo`, `frecuencias_consumo`.`nombre`, `frecuencias_consumo`.`descripcion`, `frecuencias_consumo`.`estado`, `frecuencias_consumo`.`usuario_id_inserto`, `frecuencias_consumo`.`fecha_insercion`, `frecuencias_consumo`.`usuario_id_actualizo`, `frecuencias_consumo`.`fecha_actualizacion`, `frecuencias_consumo`.`orden` FROM frecuencias_consumo";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`frecuencias_consumo`.`id`', '`frecuencias_consumo`.`codigo`', '`frecuencias_consumo`.`nombre`', '`frecuencias_consumo`.`descripcion`', '`frecuencias_consumo`.`estado`', '`frecuencias_consumo`.`usuario_id_inserto`', '`frecuencias_consumo`.`fecha_insercion`', '`frecuencias_consumo`.`usuario_id_actualizo`', '`frecuencias_consumo`.`fecha_actualizacion`', '`frecuencias_consumo`.`orden`'];
                $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion', 'orden'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`frecuencias_consumo`.`" . $campoFiltro . "`";
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
                $query .= "CONCAT_WS(' ', `frecuencias_consumo`.`id`, `frecuencias_consumo`.`codigo`, `frecuencias_consumo`.`nombre`, `frecuencias_consumo`.`descripcion`, `frecuencias_consumo`.`estado`, `frecuencias_consumo`.`usuario_id_inserto`, `frecuencias_consumo`.`fecha_insercion`, `frecuencias_consumo`.`usuario_id_actualizo`, `frecuencias_consumo`.`fecha_actualizacion`, `frecuencias_consumo`.`orden`) LIKE ?";
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
        $tabla = 'frecuencias_consumo';
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