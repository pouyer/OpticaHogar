<?php
    /**
     * Modelo para la tabla anamnesis     */
require_once '../conexion.php';

class ModeloAnamnesis {
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
    public function obtenerRelacionado_paciente_id() {
        $sql = "SELECT `id` as id, `primer_apellido` as texto FROM `pacientes` ORDER BY `primer_apellido` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Función para contar registros
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM anamnesis";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM anamnesis ";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `anamnesis`.`id`, `anamnesis`.`paciente_id`, `anamnesis`.`glaucoma`, `anamnesis`.`catarata`, `anamnesis`.`fecha_cirugia_catarata`, `anamnesis`.`desprendimiento_retina`, `anamnesis`.`estrabismo`, `anamnesis`.`ojo_vago`, `anamnesis`.`conjuntivitis_alergica`, `anamnesis`.`otros_antecedentes_oftalmologicos`, `anamnesis`.`antecedentes_quirurgicos`, `anamnesis`.`otras_enfermedades`, `anamnesis`.`alergias_medicamentos`, `anamnesis`.`medicamentos_actuales`, `anamnesis`.`dosis_medicamentos`, `anamnesis`.`familiares_otros`, `anamnesis`.`observaciones`, `anamnesis`.`usuario_id_inserto`, `anamnesis`.`fecha_insercion`, `anamnesis`.`usuario_id_actualizo`, `anamnesis`.`fecha_actualizacion`, `pacientes`.`primer_apellido`) LIKE ?";
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
        $allowedColumns = ['`anamnesis`.`id`', '`anamnesis`.`paciente_id`', '`anamnesis`.`glaucoma`', '`anamnesis`.`catarata`', '`anamnesis`.`fecha_cirugia_catarata`', '`anamnesis`.`desprendimiento_retina`', '`anamnesis`.`estrabismo`', '`anamnesis`.`ojo_vago`', '`anamnesis`.`conjuntivitis_alergica`', '`anamnesis`.`otros_antecedentes_oftalmologicos`', '`anamnesis`.`antecedentes_quirurgicos`', '`anamnesis`.`otras_enfermedades`', '`anamnesis`.`alergias_medicamentos`', '`anamnesis`.`medicamentos_actuales`', '`anamnesis`.`dosis_medicamentos`', '`anamnesis`.`familiares_otros`', '`anamnesis`.`observaciones`', '`anamnesis`.`usuario_id_inserto`', '`anamnesis`.`fecha_insercion`', '`anamnesis`.`usuario_id_actualizo`', '`anamnesis`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`'];
        
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
            $orderSQL = " ORDER BY `anamnesis`.`id` DESC ";
        }

        $query = "SELECT `anamnesis`.* , `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
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
        $query = "SELECT `anamnesis`.* , `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
        $query .= " WHERE `anamnesis`.$this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc() : false;
    }

    // Obtener un registro por paciente_id
    public function obtenerPorPacienteId($paciente_id) {
        $query = "SELECT `anamnesis`.* , `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
        $query .= " WHERE `anamnesis`.`paciente_id` = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $paciente_id);
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

        if (!isset($datos['paciente_id']) || $datos['paciente_id'] === '') {
            throw new Exception('El campo paciente_id es requerido.');
        } elseif (isset($datos['paciente_id'])) {
            $campos[] = '`paciente_id`';
            $valores[] = '?';
            $params[] = $datos['paciente_id'];
            $tipos .= 'i';
                }
        if (isset($datos['glaucoma']) && $datos['glaucoma'] !== '') {
          if (isset($datos['glaucoma'])) {
            $campos[] = '`glaucoma`';
            $valores[] = '?';
            $params[] = $datos['glaucoma'];
            $tipos .= 'i';
          }        }
        if (isset($datos['catarata']) && $datos['catarata'] !== '') {
          if (isset($datos['catarata'])) {
            $campos[] = '`catarata`';
            $valores[] = '?';
            $params[] = $datos['catarata'];
            $tipos .= 'i';
          }        }
        if (isset($datos['fecha_cirugia_catarata']) && $datos['fecha_cirugia_catarata'] !== '') {
          if (isset($datos['fecha_cirugia_catarata'])) {
            $campos[] = '`fecha_cirugia_catarata`';
            $valores[] = '?';
            // Formatear fecha
            $params[] = !empty($datos['fecha_cirugia_catarata']) ? date('Y-m-d', strtotime($datos['fecha_cirugia_catarata'])) : null;
            $tipos .= 's';
          }        }
        if (isset($datos['desprendimiento_retina']) && $datos['desprendimiento_retina'] !== '') {
          if (isset($datos['desprendimiento_retina'])) {
            $campos[] = '`desprendimiento_retina`';
            $valores[] = '?';
            $params[] = $datos['desprendimiento_retina'];
            $tipos .= 'i';
          }        }
        if (isset($datos['estrabismo']) && $datos['estrabismo'] !== '') {
          if (isset($datos['estrabismo'])) {
            $campos[] = '`estrabismo`';
            $valores[] = '?';
            $params[] = $datos['estrabismo'];
            $tipos .= 'i';
          }        }
        if (isset($datos['ojo_vago']) && $datos['ojo_vago'] !== '') {
          if (isset($datos['ojo_vago'])) {
            $campos[] = '`ojo_vago`';
            $valores[] = '?';
            $params[] = $datos['ojo_vago'];
            $tipos .= 'i';
          }        }
        if (isset($datos['conjuntivitis_alergica']) && $datos['conjuntivitis_alergica'] !== '') {
          if (isset($datos['conjuntivitis_alergica'])) {
            $campos[] = '`conjuntivitis_alergica`';
            $valores[] = '?';
            $params[] = $datos['conjuntivitis_alergica'];
            $tipos .= 'i';
          }        }
        if (isset($datos['otros_antecedentes_oftalmologicos']) && $datos['otros_antecedentes_oftalmologicos'] !== '') {
          if (isset($datos['otros_antecedentes_oftalmologicos'])) {
            $campos[] = '`otros_antecedentes_oftalmologicos`';
            $valores[] = '?';
            $params[] = $datos['otros_antecedentes_oftalmologicos'];
            $tipos .= 's';
          }        }
        if (isset($datos['antecedentes_quirurgicos']) && $datos['antecedentes_quirurgicos'] !== '') {
          if (isset($datos['antecedentes_quirurgicos'])) {
            $campos[] = '`antecedentes_quirurgicos`';
            $valores[] = '?';
            $params[] = $datos['antecedentes_quirurgicos'];
            $tipos .= 's';
          }        }
        if (isset($datos['otras_enfermedades']) && $datos['otras_enfermedades'] !== '') {
          if (isset($datos['otras_enfermedades'])) {
            $campos[] = '`otras_enfermedades`';
            $valores[] = '?';
            $params[] = $datos['otras_enfermedades'];
            $tipos .= 's';
          }        }
        if (isset($datos['alergias_medicamentos']) && $datos['alergias_medicamentos'] !== '') {
          if (isset($datos['alergias_medicamentos'])) {
            $campos[] = '`alergias_medicamentos`';
            $valores[] = '?';
            $params[] = $datos['alergias_medicamentos'];
            $tipos .= 's';
          }        }
        if (isset($datos['medicamentos_actuales']) && $datos['medicamentos_actuales'] !== '') {
          if (isset($datos['medicamentos_actuales'])) {
            $campos[] = '`medicamentos_actuales`';
            $valores[] = '?';
            $params[] = $datos['medicamentos_actuales'];
            $tipos .= 's';
          }        }
        if (isset($datos['dosis_medicamentos']) && $datos['dosis_medicamentos'] !== '') {
          if (isset($datos['dosis_medicamentos'])) {
            $campos[] = '`dosis_medicamentos`';
            $valores[] = '?';
            $params[] = $datos['dosis_medicamentos'];
            $tipos .= 's';
          }        }
        if (isset($datos['familiares_otros']) && $datos['familiares_otros'] !== '') {
          if (isset($datos['familiares_otros'])) {
            $campos[] = '`familiares_otros`';
            $valores[] = '?';
            $params[] = $datos['familiares_otros'];
            $tipos .= 's';
          }        }
        if (isset($datos['observaciones']) && $datos['observaciones'] !== '') {
          if (isset($datos['observaciones'])) {
            $campos[] = '`observaciones`';
            $valores[] = '?';
            $params[] = $datos['observaciones'];
            $tipos .= 's';
          }        }
        if (!isset($datos['usuario_id_inserto']) || $datos['usuario_id_inserto'] === '') {
            throw new Exception('El campo usuario_id_inserto es requerido.');
        } elseif (isset($datos['usuario_id_inserto'])) {
            $campos[] = '`usuario_id_inserto`';
            $valores[] = '?';
            $params[] = $datos['usuario_id_inserto'];
            $tipos .= 'i';
                }
        if (isset($datos['fecha_insercion']) && $datos['fecha_insercion'] !== '') {
          if (isset($datos['fecha_insercion'])) {
            $campos[] = '`fecha_insercion`';
            $valores[] = '?';
            $params[] = $datos['fecha_insercion'];
            $tipos .= 's';
          }        }
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

        $query = "INSERT INTO anamnesis (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
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
        if (isset($datos['paciente_id'])) {
            if ($datos['paciente_id'] === '') {
                throw new Exception('El campo paciente_id es requerido.');
            }
            $actualizaciones[] = "`paciente_id` = ?";
            $params[] = $datos['paciente_id'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['glaucoma'])) {
            $actualizaciones[] = "`glaucoma` = ?";
            $params[] = $datos['glaucoma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['catarata'])) {
            $actualizaciones[] = "`catarata` = ?";
            $params[] = $datos['catarata'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['fecha_cirugia_catarata'])) {
            $actualizaciones[] = "`fecha_cirugia_catarata` = ?";
            // Formatear fecha
            $params[] = !empty($datos['fecha_cirugia_catarata']) ? date('Y-m-d', strtotime($datos['fecha_cirugia_catarata'])) : null;
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['desprendimiento_retina'])) {
            $actualizaciones[] = "`desprendimiento_retina` = ?";
            $params[] = $datos['desprendimiento_retina'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['estrabismo'])) {
            $actualizaciones[] = "`estrabismo` = ?";
            $params[] = $datos['estrabismo'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['ojo_vago'])) {
            $actualizaciones[] = "`ojo_vago` = ?";
            $params[] = $datos['ojo_vago'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['conjuntivitis_alergica'])) {
            $actualizaciones[] = "`conjuntivitis_alergica` = ?";
            $params[] = $datos['conjuntivitis_alergica'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['otros_antecedentes_oftalmologicos'])) {
            $actualizaciones[] = "`otros_antecedentes_oftalmologicos` = ?";
            $params[] = $datos['otros_antecedentes_oftalmologicos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['antecedentes_quirurgicos'])) {
            $actualizaciones[] = "`antecedentes_quirurgicos` = ?";
            $params[] = $datos['antecedentes_quirurgicos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['otras_enfermedades'])) {
            $actualizaciones[] = "`otras_enfermedades` = ?";
            $params[] = $datos['otras_enfermedades'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['alergias_medicamentos'])) {
            $actualizaciones[] = "`alergias_medicamentos` = ?";
            $params[] = $datos['alergias_medicamentos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['medicamentos_actuales'])) {
            $actualizaciones[] = "`medicamentos_actuales` = ?";
            $params[] = $datos['medicamentos_actuales'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['dosis_medicamentos'])) {
            $actualizaciones[] = "`dosis_medicamentos` = ?";
            $params[] = $datos['dosis_medicamentos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['familiares_otros'])) {
            $actualizaciones[] = "`familiares_otros` = ?";
            $params[] = $datos['familiares_otros'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['observaciones'])) {
            $actualizaciones[] = "`observaciones` = ?";
            $params[] = $datos['observaciones'];
            $tipos .= 's';
        }
        // Campo Requerido: Validar solo si está presente
        if (isset($datos['usuario_id_inserto'])) {
            if ($datos['usuario_id_inserto'] === '') {
                throw new Exception('El campo usuario_id_inserto es requerido.');
            }
            $actualizaciones[] = "`usuario_id_inserto` = ?";
            $params[] = $datos['usuario_id_inserto'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['fecha_insercion'])) {
            $actualizaciones[] = "`fecha_insercion` = ?";
            $params[] = $datos['fecha_insercion'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['usuario_id_actualizo'])) {
            $actualizaciones[] = "`usuario_id_actualizo` = ?";
            $params[] = $datos['usuario_id_actualizo'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['fecha_actualizacion']) && $datos['fecha_actualizacion'] !== '') {
            $actualizaciones[] = "`fecha_actualizacion` = ?";
            $params[] = $datos['fecha_actualizacion'];
            $tipos .= 's';
        } else {
            $actualizaciones[] = "`fecha_actualizacion` = NOW()";
        }

        $params[] = $id;
        $tipos .= $tipos_pk;
        $query = "UPDATE anamnesis SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) {
                 throw new Exception("Error preparando update: " . $this->conexion->error);
             }
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM anamnesis WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = null, $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`anamnesis`.`id`', '`anamnesis`.`paciente_id`', '`anamnesis`.`glaucoma`', '`anamnesis`.`catarata`', '`anamnesis`.`fecha_cirugia_catarata`', '`anamnesis`.`desprendimiento_retina`', '`anamnesis`.`estrabismo`', '`anamnesis`.`ojo_vago`', '`anamnesis`.`conjuntivitis_alergica`', '`anamnesis`.`otros_antecedentes_oftalmologicos`', '`anamnesis`.`antecedentes_quirurgicos`', '`anamnesis`.`otras_enfermedades`', '`anamnesis`.`alergias_medicamentos`', '`anamnesis`.`medicamentos_actuales`', '`anamnesis`.`dosis_medicamentos`', '`anamnesis`.`familiares_otros`', '`anamnesis`.`observaciones`', '`anamnesis`.`usuario_id_inserto`', '`anamnesis`.`fecha_insercion`', '`anamnesis`.`usuario_id_actualizo`', '`anamnesis`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`'];
        
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
            $orderSQL = " ORDER BY `anamnesis`.`id` DESC ";
        }

        $query = "SELECT `anamnesis`.* , `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
        // Agregar campos faltantes
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `anamnesis`.`id`, `anamnesis`.`paciente_id`, `anamnesis`.`glaucoma`, `anamnesis`.`catarata`, `anamnesis`.`fecha_cirugia_catarata`, `anamnesis`.`desprendimiento_retina`, `anamnesis`.`estrabismo`, `anamnesis`.`ojo_vago`, `anamnesis`.`conjuntivitis_alergica`, `anamnesis`.`otros_antecedentes_oftalmologicos`, `anamnesis`.`antecedentes_quirurgicos`, `anamnesis`.`otras_enfermedades`, `anamnesis`.`alergias_medicamentos`, `anamnesis`.`medicamentos_actuales`, `anamnesis`.`dosis_medicamentos`, `anamnesis`.`familiares_otros`, `anamnesis`.`observaciones`, `anamnesis`.`usuario_id_inserto`, `anamnesis`.`fecha_insercion`, `anamnesis`.`usuario_id_actualizo`, `anamnesis`.`fecha_actualizacion`, `pacientes`.`primer_apellido`) LIKE ?";
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
        $allowedColumns = ['`anamnesis`.`id`', '`anamnesis`.`paciente_id`', '`anamnesis`.`glaucoma`', '`anamnesis`.`catarata`', '`anamnesis`.`fecha_cirugia_catarata`', '`anamnesis`.`desprendimiento_retina`', '`anamnesis`.`estrabismo`', '`anamnesis`.`ojo_vago`', '`anamnesis`.`conjuntivitis_alergica`', '`anamnesis`.`otros_antecedentes_oftalmologicos`', '`anamnesis`.`antecedentes_quirurgicos`', '`anamnesis`.`otras_enfermedades`', '`anamnesis`.`alergias_medicamentos`', '`anamnesis`.`medicamentos_actuales`', '`anamnesis`.`dosis_medicamentos`', '`anamnesis`.`familiares_otros`', '`anamnesis`.`observaciones`', '`anamnesis`.`usuario_id_inserto`', '`anamnesis`.`fecha_insercion`', '`anamnesis`.`usuario_id_actualizo`', '`anamnesis`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'paciente_id', 'glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'antecedentes_quirurgicos', 'otras_enfermedades', 'alergias_medicamentos', 'medicamentos_actuales', 'dosis_medicamentos', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`anamnesis`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM anamnesis ";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
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
        $allowedColumns = ['`anamnesis`.`id`', '`anamnesis`.`paciente_id`', '`anamnesis`.`glaucoma`', '`anamnesis`.`catarata`', '`anamnesis`.`fecha_cirugia_catarata`', '`anamnesis`.`desprendimiento_retina`', '`anamnesis`.`estrabismo`', '`anamnesis`.`ojo_vago`', '`anamnesis`.`conjuntivitis_alergica`', '`anamnesis`.`otros_antecedentes_oftalmologicos`', '`anamnesis`.`antecedentes_quirurgicos`', '`anamnesis`.`otras_enfermedades`', '`anamnesis`.`alergias_medicamentos`', '`anamnesis`.`medicamentos_actuales`', '`anamnesis`.`dosis_medicamentos`', '`anamnesis`.`familiares_otros`', '`anamnesis`.`observaciones`', '`anamnesis`.`usuario_id_inserto`', '`anamnesis`.`fecha_insercion`', '`anamnesis`.`usuario_id_actualizo`', '`anamnesis`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`'];
        $simpleCols = ['id', 'paciente_id', 'glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'antecedentes_quirurgicos', 'otras_enfermedades', 'alergias_medicamentos', 'medicamentos_actuales', 'dosis_medicamentos', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`anamnesis`.`" . $campo . "`";
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
             $orderSQL = " ORDER BY `anamnesis`.`id` DESC ";
        }

        $query = "SELECT `anamnesis`.* , `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
        $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
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
            $query = "SELECT `anamnesis`.`id`, `anamnesis`.`paciente_id`, `anamnesis`.`glaucoma`, `anamnesis`.`catarata`, `anamnesis`.`fecha_cirugia_catarata`, `anamnesis`.`desprendimiento_retina`, `anamnesis`.`estrabismo`, `anamnesis`.`ojo_vago`, `anamnesis`.`conjuntivitis_alergica`, `anamnesis`.`otros_antecedentes_oftalmologicos`, `anamnesis`.`antecedentes_quirurgicos`, `anamnesis`.`otras_enfermedades`, `anamnesis`.`alergias_medicamentos`, `anamnesis`.`medicamentos_actuales`, `anamnesis`.`dosis_medicamentos`, `anamnesis`.`familiares_otros`, `anamnesis`.`observaciones`, `anamnesis`.`usuario_id_inserto`, `anamnesis`.`fecha_insercion`, `anamnesis`.`usuario_id_actualizo`, `anamnesis`.`fecha_actualizacion`, `pacientes`.`primer_apellido` as `paciente_id_display`  FROM anamnesis";
            $query .= " LEFT JOIN `pacientes` ON `anamnesis`.`paciente_id` = `pacientes`.`id` ";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`anamnesis`.`id`', '`anamnesis`.`paciente_id`', '`anamnesis`.`glaucoma`', '`anamnesis`.`catarata`', '`anamnesis`.`fecha_cirugia_catarata`', '`anamnesis`.`desprendimiento_retina`', '`anamnesis`.`estrabismo`', '`anamnesis`.`ojo_vago`', '`anamnesis`.`conjuntivitis_alergica`', '`anamnesis`.`otros_antecedentes_oftalmologicos`', '`anamnesis`.`antecedentes_quirurgicos`', '`anamnesis`.`otras_enfermedades`', '`anamnesis`.`alergias_medicamentos`', '`anamnesis`.`medicamentos_actuales`', '`anamnesis`.`dosis_medicamentos`', '`anamnesis`.`familiares_otros`', '`anamnesis`.`observaciones`', '`anamnesis`.`usuario_id_inserto`', '`anamnesis`.`fecha_insercion`', '`anamnesis`.`usuario_id_actualizo`', '`anamnesis`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`'];
                $simpleCols = ['id', 'paciente_id', 'glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'antecedentes_quirurgicos', 'otras_enfermedades', 'alergias_medicamentos', 'medicamentos_actuales', 'dosis_medicamentos', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`anamnesis`.`" . $campoFiltro . "`";
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
                $query .= "CONCAT_WS(' ', `anamnesis`.`id`, `anamnesis`.`paciente_id`, `anamnesis`.`glaucoma`, `anamnesis`.`catarata`, `anamnesis`.`fecha_cirugia_catarata`, `anamnesis`.`desprendimiento_retina`, `anamnesis`.`estrabismo`, `anamnesis`.`ojo_vago`, `anamnesis`.`conjuntivitis_alergica`, `anamnesis`.`otros_antecedentes_oftalmologicos`, `anamnesis`.`antecedentes_quirurgicos`, `anamnesis`.`otras_enfermedades`, `anamnesis`.`alergias_medicamentos`, `anamnesis`.`medicamentos_actuales`, `anamnesis`.`dosis_medicamentos`, `anamnesis`.`familiares_otros`, `anamnesis`.`observaciones`, `anamnesis`.`usuario_id_inserto`, `anamnesis`.`fecha_insercion`, `anamnesis`.`usuario_id_actualizo`, `anamnesis`.`fecha_actualizacion`, `pacientes`.`primer_apellido`) LIKE ?";
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
        $tabla = 'anamnesis';
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