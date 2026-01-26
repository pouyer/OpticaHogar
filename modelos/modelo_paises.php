<?php
    /**
     * Modelo para la tabla paises     */
require_once '../conexion.php';

class ModeloPaises {
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
        $query = "SELECT COUNT(*) as total FROM paises";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM paises ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `paises`.`id`, `paises`.`codigo_pais`, `paises`.`indicativo`, `paises`.`nombre_pais`, `paises`.`campo_ordenamiento`, `paises`.`estado`, `paises`.`usuario_id_inserto`, `paises`.`fecha_insercion`, `paises`.`usuario_id_actualizo`, `paises`.`fecha_actualizacion`) LIKE ?";
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
        $allowedColumns = ['`paises`.`id`', '`paises`.`codigo_pais`', '`paises`.`indicativo`', '`paises`.`nombre_pais`', '`paises`.`campo_ordenamiento`', '`paises`.`estado`', '`paises`.`usuario_id_inserto`', '`paises`.`fecha_insercion`', '`paises`.`usuario_id_actualizo`', '`paises`.`fecha_actualizacion`'];
        
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
            $orderSQL = " ORDER BY `paises`.`estado` ASC, `paises`.`campo_ordenamiento` ASC, `paises`.`nombre_pais` ASC ";
        }

        $query = "SELECT `paises`.*  FROM paises";
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
        $query = "SELECT `paises`.*  FROM paises";
        $query .= " WHERE `paises`.$this->llavePrimaria = ?";
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

        // Campo: codigo_pais
        if (array_key_exists('codigo_pais', $datos)) {
            $campos[] = '`codigo_pais`';
            $valores[] = '?';
            $params[] = ($datos['codigo_pais'] === '' || $datos['codigo_pais'] === null) ? '' : $datos['codigo_pais'];
            $tipos .= 's';
        }
        // Campo: indicativo
        if (array_key_exists('indicativo', $datos)) {
            $campos[] = '`indicativo`';
            $valores[] = '?';
            $params[] = ($datos['indicativo'] === '' || $datos['indicativo'] === null) ? '' : $datos['indicativo'];
            $tipos .= 's';
        }
        // Campo: nombre_pais
        if (!isset($datos['nombre_pais']) || $datos['nombre_pais'] === '') {
            throw new Exception('El campo nombre_pais es requerido.');
        }
        if (array_key_exists('nombre_pais', $datos)) {
            $campos[] = '`nombre_pais`';
            $valores[] = '?';
            $params[] = ($datos['nombre_pais'] === '' || $datos['nombre_pais'] === null) ? '' : $datos['nombre_pais'];
            $tipos .= 's';
        }
        // Campo: campo_ordenamiento
        if (array_key_exists('campo_ordenamiento', $datos)) {
            $campos[] = '`campo_ordenamiento`';
            $valores[] = '?';
            $params[] = ($datos['campo_ordenamiento'] === '' || $datos['campo_ordenamiento'] === null) ? null : (int)$datos['campo_ordenamiento'];
            $tipos .= 'i';
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

        $query = "INSERT INTO paises (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
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

        // Campo: codigo_pais
        if (array_key_exists('codigo_pais', $datos)) {
            $actualizaciones[] = "`codigo_pais` = ?";
            $params[] = ($datos['codigo_pais'] === '' || $datos['codigo_pais'] === null) ? '' : $datos['codigo_pais'];
            $tipos .= 's';
        }
        // Campo: indicativo
        if (array_key_exists('indicativo', $datos)) {
            $actualizaciones[] = "`indicativo` = ?";
            $params[] = ($datos['indicativo'] === '' || $datos['indicativo'] === null) ? '' : $datos['indicativo'];
            $tipos .= 's';
        }
        // Campo: nombre_pais
        if (array_key_exists('nombre_pais', $datos) && $datos['nombre_pais'] === '') {
            throw new Exception('El campo nombre_pais es requerido.');
        }
        if (array_key_exists('nombre_pais', $datos)) {
            $actualizaciones[] = "`nombre_pais` = ?";
            $params[] = ($datos['nombre_pais'] === '' || $datos['nombre_pais'] === null) ? '' : $datos['nombre_pais'];
            $tipos .= 's';
        }
        // Campo: campo_ordenamiento
        if (array_key_exists('campo_ordenamiento', $datos)) {
            $actualizaciones[] = "`campo_ordenamiento` = ?";
            $params[] = ($datos['campo_ordenamiento'] === '' || $datos['campo_ordenamiento'] === null) ? null : (int)$datos['campo_ordenamiento'];
            $tipos .= 'i';
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

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE paises SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM paises WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`paises`.`id`', '`paises`.`codigo_pais`', '`paises`.`indicativo`', '`paises`.`nombre_pais`', '`paises`.`campo_ordenamiento`', '`paises`.`estado`', '`paises`.`usuario_id_inserto`', '`paises`.`fecha_insercion`', '`paises`.`usuario_id_actualizo`', '`paises`.`fecha_actualizacion`'];
        
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
            $orderSQL = " ORDER BY `paises`.`estado` ASC, `paises`.`campo_ordenamiento` ASC, `paises`.`nombre_pais` ASC ";
        }

        $query = "SELECT `paises`.*  FROM paises";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `paises`.`id`, `paises`.`codigo_pais`, `paises`.`indicativo`, `paises`.`nombre_pais`, `paises`.`campo_ordenamiento`, `paises`.`estado`, `paises`.`usuario_id_inserto`, `paises`.`fecha_insercion`, `paises`.`usuario_id_actualizo`, `paises`.`fecha_actualizacion`) LIKE ?";
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
        $allowedColumns = ['`paises`.`id`', '`paises`.`codigo_pais`', '`paises`.`indicativo`', '`paises`.`nombre_pais`', '`paises`.`campo_ordenamiento`', '`paises`.`estado`', '`paises`.`usuario_id_inserto`', '`paises`.`fecha_insercion`', '`paises`.`usuario_id_actualizo`', '`paises`.`fecha_actualizacion`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'codigo_pais', 'indicativo', 'nombre_pais', 'campo_ordenamiento', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`paises`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM paises ";
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
        $allowedColumns = ['`paises`.`id`', '`paises`.`codigo_pais`', '`paises`.`indicativo`', '`paises`.`nombre_pais`', '`paises`.`campo_ordenamiento`', '`paises`.`estado`', '`paises`.`usuario_id_inserto`', '`paises`.`fecha_insercion`', '`paises`.`usuario_id_actualizo`', '`paises`.`fecha_actualizacion`'];
        $simpleCols = ['id', 'codigo_pais', 'indicativo', 'nombre_pais', 'campo_ordenamiento', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`paises`.`" . $campo . "`";
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
             $orderSQL = " ORDER BY `paises`.`estado` ASC, `paises`.`campo_ordenamiento` ASC, `paises`.`nombre_pais` ASC ";
        }

        $query = "SELECT `paises`.*  FROM paises";
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
            $query = "SELECT `paises`.`codigo_pais`, `paises`.`indicativo`, `paises`.`nombre_pais`, `paises`.`campo_ordenamiento`, `paises`.`estado`, `paises`.`usuario_id_inserto`, `paises`.`fecha_insercion`, `paises`.`usuario_id_actualizo`, `paises`.`fecha_actualizacion` FROM paises";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`paises`.`id`', '`paises`.`codigo_pais`', '`paises`.`indicativo`', '`paises`.`nombre_pais`', '`paises`.`campo_ordenamiento`', '`paises`.`estado`', '`paises`.`usuario_id_inserto`', '`paises`.`fecha_insercion`', '`paises`.`usuario_id_actualizo`', '`paises`.`fecha_actualizacion`'];
                $simpleCols = ['id', 'codigo_pais', 'indicativo', 'nombre_pais', 'campo_ordenamiento', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`paises`.`" . $campoFiltro . "`";
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
                $query .= "CONCAT_WS(' ', `paises`.`id`, `paises`.`codigo_pais`, `paises`.`indicativo`, `paises`.`nombre_pais`, `paises`.`campo_ordenamiento`, `paises`.`estado`, `paises`.`usuario_id_inserto`, `paises`.`fecha_insercion`, `paises`.`usuario_id_actualizo`, `paises`.`fecha_actualizacion`) LIKE ?";
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
        $tabla = 'paises';
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