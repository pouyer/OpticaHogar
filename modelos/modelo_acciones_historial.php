<?php
    /**
     * Modelo para la tabla acciones_historial     */

require_once '../conexion.php';

class ModeloAcciones_historial {
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
        $query = "SELECT COUNT(*) as total FROM acciones_historial";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM acciones_historial ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `acciones_historial`.`id`, `acciones_historial`.`codigo`, `acciones_historial`.`nombre`, `acciones_historial`.`descripcion`, `acciones_historial`.`icono`, `acciones_historial`.`estado`, `acciones_historial`.`usuario_id_inserto`, `acciones_historial`.`fecha_insercion`, `acciones_historial`.`usuario_id_actualizo`, `acciones_historial`.`fecha_actualizacion`) LIKE ?";
        $stmt = $this->conexion->prepare($query);
        $termino = "%" . $termino . "%";
        $stmt->bind_param('s', $termino);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : false;
    }

    // Obtener todos los registros
    public function obtenerTodos($registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        // Validar columnas permitidas para evitar inyección SQL
        $allowedColumns = ['`acciones_historial`.`id`', '`acciones_historial`.`codigo`', '`acciones_historial`.`nombre`', '`acciones_historial`.`descripcion`', '`acciones_historial`.`icono`', '`acciones_historial`.`estado`', '`acciones_historial`.`usuario_id_inserto`', '`acciones_historial`.`fecha_insercion`', '`acciones_historial`.`usuario_id_actualizo`', '`acciones_historial`.`fecha_actualizacion`'];
        
        // Limpiar el nombre de la columna para la validación
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `acciones_historial`.`id` DESC ";

        $query = "SELECT `acciones_historial`.*  FROM acciones_historial";
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
        $query = "SELECT `acciones_historial`.*  FROM acciones_historial";
        $query .= " WHERE `acciones_historial`.$this->llavePrimaria = ?";
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

        if (!isset($datos['codigo']) || $datos['codigo'] === '') {
            throw new Exception('El campo codigo es requerido.');
        } elseif (isset($datos['codigo'])) {
            $campos[] = '`codigo`';
            $valores[] = '?';
            $params[] = $datos['codigo'];
            $tipos .= 's';
                }
        if (!isset($datos['nombre']) || $datos['nombre'] === '') {
            throw new Exception('El campo nombre es requerido.');
        } elseif (isset($datos['nombre'])) {
            $campos[] = '`nombre`';
            $valores[] = '?';
            $params[] = $datos['nombre'];
            $tipos .= 's';
                }
        if (isset($datos['descripcion']) && $datos['descripcion'] !== '') {
          if (isset($datos['descripcion'])) {
            $campos[] = '`descripcion`';
            $valores[] = '?';
            $params[] = $datos['descripcion'];
            $tipos .= 's';
          }        }
        if (isset($datos['icono']) && $datos['icono'] !== '') {
          if (isset($datos['icono'])) {
            $campos[] = '`icono`';
            $valores[] = '?';
            $params[] = $datos['icono'];
            $tipos .= 's';
          }        }
        if (isset($datos['estado']) && $datos['estado'] !== '') {
          if (isset($datos['estado'])) {
            $campos[] = '`estado`';
            $valores[] = '?';
            $params[] = $datos['estado'];
            $tipos .= 's';
          }        }
        // Campo de auditoria - Se inyecta desde el controlador
        if (isset($datos['usuario_id_inserto']) && $datos['usuario_id_inserto'] !== '') {
            $campos[] = '`usuario_id_inserto`';
            $valores[] = '?';
            $params[] = $datos['usuario_id_inserto'];
            $tipos .= 'i';
                }
        if (isset($datos['usuario_id_actualizo']) && $datos['usuario_id_actualizo'] !== '') {
          if (isset($datos['usuario_id_actualizo'])) {
            $campos[] = '`usuario_id_actualizo`';
            $valores[] = '?';
            $params[] = $datos['usuario_id_actualizo'];
            $tipos .= 'i';
          }        }
        if (isset($datos['fecha_actualizacion']) && $datos['fecha_actualizacion'] !== '') {
          if (isset($datos['fecha_actualizacion'])) {
            $campos[] = '`fecha_actualizacion`';
            $valores[] = '?';
            $params[] = $datos['fecha_actualizacion'];
            $tipos .= 's';
          }        }

        $query = "INSERT INTO acciones_historial (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
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

        // Campo Requerido: Validar solo si está presente
        if (isset($datos['codigo'])) {
            if ($datos['codigo'] === '') {
                throw new Exception('El campo codigo es requerido.');
            }
            $actualizaciones[] = "`codigo` = ?";
            $params[] = $datos['codigo'];
            $tipos .= 's';
        }
        // Campo Requerido: Validar solo si está presente
        if (isset($datos['nombre'])) {
            if ($datos['nombre'] === '') {
                throw new Exception('El campo nombre es requerido.');
            }
            $actualizaciones[] = "`nombre` = ?";
            $params[] = $datos['nombre'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['descripcion']) && ($datos['descripcion'] !== '' || $datos['descripcion'] === 0)) {
            $actualizaciones[] = "`descripcion` = ?";
            $params[] = $datos['descripcion'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['icono']) && ($datos['icono'] !== '' || $datos['icono'] === 0)) {
            $actualizaciones[] = "`icono` = ?";
            $params[] = $datos['icono'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['estado']) && ($datos['estado'] !== '' || $datos['estado'] === 0)) {
            $actualizaciones[] = "`estado` = ?";
            $params[] = $datos['estado'];
            $tipos .= 's';
        }
        // Campo de auditoria (Usuario Inserta) - No se requiere en actualización
        if (isset($datos['usuario_id_inserto']) && $datos['usuario_id_inserto'] !== '') {
            $actualizaciones[] = "`usuario_id_inserto` = ?";
            $params[] = $datos['usuario_id_inserto'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['usuario_id_actualizo']) && ($datos['usuario_id_actualizo'] !== '' || $datos['usuario_id_actualizo'] === 0)) {
            $actualizaciones[] = "`usuario_id_actualizo` = ?";
            $params[] = $datos['usuario_id_actualizo'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['fecha_actualizacion']) && ($datos['fecha_actualizacion'] !== '' || $datos['fecha_actualizacion'] === 0)) {
            $actualizaciones[] = "`fecha_actualizacion` = ?";
            $params[] = $datos['fecha_actualizacion'];
            $tipos .= 's';
        }

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE acciones_historial SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM acciones_historial WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`acciones_historial`.`id`', '`acciones_historial`.`codigo`', '`acciones_historial`.`nombre`', '`acciones_historial`.`descripcion`', '`acciones_historial`.`icono`', '`acciones_historial`.`estado`', '`acciones_historial`.`usuario_id_inserto`', '`acciones_historial`.`fecha_insercion`', '`acciones_historial`.`usuario_id_actualizo`', '`acciones_historial`.`fecha_actualizacion`'];
        
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `acciones_historial`.`id` DESC ";

        $query = "SELECT `acciones_historial`.*  FROM acciones_historial";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `acciones_historial`.`id`, `acciones_historial`.`codigo`, `acciones_historial`.`nombre`, `acciones_historial`.`descripcion`, `acciones_historial`.`icono`, `acciones_historial`.`estado`, `acciones_historial`.`usuario_id_inserto`, `acciones_historial`.`fecha_insercion`, `acciones_historial`.`usuario_id_actualizo`, `acciones_historial`.`fecha_actualizacion`) LIKE ?";
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
        $allowedColumns = ['`acciones_historial`.`id`', '`acciones_historial`.`codigo`', '`acciones_historial`.`nombre`', '`acciones_historial`.`descripcion`', '`acciones_historial`.`icono`', '`acciones_historial`.`estado`', '`acciones_historial`.`usuario_id_inserto`', '`acciones_historial`.`fecha_insercion`', '`acciones_historial`.`usuario_id_actualizo`', '`acciones_historial`.`fecha_actualizacion`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'icono', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`acciones_historial`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM acciones_historial ";
        $query .= " WHERE " . $columnaSQL . " LIKE ?";
        
        $stmt = $this->conexion->prepare($query);
        $valor = "%" . $valor . "%";
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    public function buscarPorCampo($campo, $valor, $registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        // Validación de campo idéntica a contarPorCampo
         $allowedColumns = ['`acciones_historial`.`id`', '`acciones_historial`.`codigo`', '`acciones_historial`.`nombre`', '`acciones_historial`.`descripcion`', '`acciones_historial`.`icono`', '`acciones_historial`.`estado`', '`acciones_historial`.`usuario_id_inserto`', '`acciones_historial`.`fecha_insercion`', '`acciones_historial`.`usuario_id_actualizo`', '`acciones_historial`.`fecha_actualizacion`'];
        $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'icono', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`acciones_historial`.`" . $campo . "`";
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
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $orderValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $orderValid = true;
                break;
            }
        }
        $orderSQL = $orderValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `acciones_historial`.`id` DESC ";

        $query = "SELECT `acciones_historial`.*  FROM acciones_historial";
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
            $query = "SELECT `acciones_historial`.`codigo`, `acciones_historial`.`nombre`, `acciones_historial`.`descripcion`, `acciones_historial`.`icono`, `acciones_historial`.`estado`, `acciones_historial`.`usuario_id_inserto`, `acciones_historial`.`fecha_insercion`, `acciones_historial`.`usuario_id_actualizo`, `acciones_historial`.`fecha_actualizacion` FROM acciones_historial";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`acciones_historial`.`id`', '`acciones_historial`.`codigo`', '`acciones_historial`.`nombre`', '`acciones_historial`.`descripcion`', '`acciones_historial`.`icono`', '`acciones_historial`.`estado`', '`acciones_historial`.`usuario_id_inserto`', '`acciones_historial`.`fecha_insercion`', '`acciones_historial`.`usuario_id_actualizo`', '`acciones_historial`.`fecha_actualizacion`'];
                $simpleCols = ['id', 'codigo', 'nombre', 'descripcion', 'icono', 'estado', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`acciones_historial`.`" . $campoFiltro . "`";
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
                $query .= "CONCAT_WS(' ', `acciones_historial`.`id`, `acciones_historial`.`codigo`, `acciones_historial`.`nombre`, `acciones_historial`.`descripcion`, `acciones_historial`.`icono`, `acciones_historial`.`estado`, `acciones_historial`.`usuario_id_inserto`, `acciones_historial`.`fecha_insercion`, `acciones_historial`.`usuario_id_actualizo`, `acciones_historial`.`fecha_actualizacion`) LIKE ?";
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
        $tabla = 'acciones_historial';
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