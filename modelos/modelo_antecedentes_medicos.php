<?php
    /**
     * Modelo para la tabla antecedentes_medicos     */

require_once '../conexion.php';

class ModeloAntecedentes_medicos {
    private $conexion;
    private $llavePrimaria = 'id';
    private $es_vista = false;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    // Métodos para obtener datos relacionados (Comboboxes)
    public function obtenerRelacionado_paciente_id() {
        $sql = "SELECT `id` as id, `primer_apellido` as texto FROM `pacientes` ORDER BY `primer_apellido` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_diabetes_tipo_id() {
        $sql = "SELECT `id` as id, `nombre` as texto FROM `tipos_diabetes` ORDER BY `nombre` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }
    public function obtenerRelacionado_frecuencia_alcohol_id() {
        $sql = "SELECT `id` as id, `nombre` as texto FROM `frecuencias_consumo` ORDER BY `nombre` ASC";
        $resultado = $this->conexion->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Función para contar registros
    public function contarRegistros() {
        $query = "SELECT COUNT(*) as total FROM antecedentes_medicos";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado ? $resultado->fetch_assoc()['total'] : 0;
    }

    // Función de contarRegistrosPorBusqueda
    public function contarRegistrosPorBusqueda($termino) {
        $query = "SELECT COUNT(*) as total FROM antecedentes_medicos ";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `antecedentes_medicos`.`id`, `antecedentes_medicos`.`paciente_id`, `antecedentes_medicos`.`hipertension_arterial`, `antecedentes_medicos`.`diabetes`, `antecedentes_medicos`.`diabetes_tipo_id`, `antecedentes_medicos`.`tiempo_diabetes`, `antecedentes_medicos`.`enfermedades_cardiacas`, `antecedentes_medicos`.`enfermedades_renales`, `antecedentes_medicos`.`enfermedades_hepaticas`, `antecedentes_medicos`.`enfermedades_autoimunes`, `antecedentes_medicos`.`cancer`, `antecedentes_medicos`.`vih`, `antecedentes_medicos`.`tuberculosis`, `antecedentes_medicos`.`epilepsia`, `antecedentes_medicos`.`asma`, `antecedentes_medicos`.`otras_enfermedades`, `antecedentes_medicos`.`glaucoma`, `antecedentes_medicos`.`familia_glaucoma`, `antecedentes_medicos`.`catarata`, `antecedentes_medicos`.`fecha_cirugia_catarata`, `antecedentes_medicos`.`desprendimiento_retina`, `antecedentes_medicos`.`estrabismo`, `antecedentes_medicos`.`ojo_vago`, `antecedentes_medicos`.`conjuntivitis_alergica`, `antecedentes_medicos`.`otros_antecedentes_oftalmologicos`, `antecedentes_medicos`.`medicamentos_actuales`, `antecedentes_medicos`.`dosis_medicamentos`, `antecedentes_medicos`.`alergias_medicamentos`, `antecedentes_medicos`.`antecedentes_quirurgicos`, `antecedentes_medicos`.`fuma`, `antecedentes_medicos`.`cigarrillos_dia`, `antecedentes_medicos`.`alcohol`, `antecedentes_medicos`.`frecuencia_alcohol_id`, `antecedentes_medicos`.`drogas`, `antecedentes_medicos`.`tipo_drogas`, `antecedentes_medicos`.`familiares_ceguera`, `antecedentes_medicos`.`familiares_glaucoma`, `antecedentes_medicos`.`familiares_retinopatia_diabetica`, `antecedentes_medicos`.`familiares_otros`, `antecedentes_medicos`.`observaciones`, `antecedentes_medicos`.`usuario_id_inserto`, `antecedentes_medicos`.`fecha_insercion`, `antecedentes_medicos`.`usuario_id_actualizo`, `antecedentes_medicos`.`fecha_actualizacion`, `pacientes`.`primer_apellido`, `tipos_diabetes`.`nombre`, `frecuencias_consumo`.`nombre`) LIKE ?";
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
        $allowedColumns = ['`antecedentes_medicos`.`id`', '`antecedentes_medicos`.`paciente_id`', '`antecedentes_medicos`.`hipertension_arterial`', '`antecedentes_medicos`.`diabetes`', '`antecedentes_medicos`.`diabetes_tipo_id`', '`antecedentes_medicos`.`tiempo_diabetes`', '`antecedentes_medicos`.`enfermedades_cardiacas`', '`antecedentes_medicos`.`enfermedades_renales`', '`antecedentes_medicos`.`enfermedades_hepaticas`', '`antecedentes_medicos`.`enfermedades_autoimunes`', '`antecedentes_medicos`.`cancer`', '`antecedentes_medicos`.`vih`', '`antecedentes_medicos`.`tuberculosis`', '`antecedentes_medicos`.`epilepsia`', '`antecedentes_medicos`.`asma`', '`antecedentes_medicos`.`otras_enfermedades`', '`antecedentes_medicos`.`glaucoma`', '`antecedentes_medicos`.`familia_glaucoma`', '`antecedentes_medicos`.`catarata`', '`antecedentes_medicos`.`fecha_cirugia_catarata`', '`antecedentes_medicos`.`desprendimiento_retina`', '`antecedentes_medicos`.`estrabismo`', '`antecedentes_medicos`.`ojo_vago`', '`antecedentes_medicos`.`conjuntivitis_alergica`', '`antecedentes_medicos`.`otros_antecedentes_oftalmologicos`', '`antecedentes_medicos`.`medicamentos_actuales`', '`antecedentes_medicos`.`dosis_medicamentos`', '`antecedentes_medicos`.`alergias_medicamentos`', '`antecedentes_medicos`.`antecedentes_quirurgicos`', '`antecedentes_medicos`.`fuma`', '`antecedentes_medicos`.`cigarrillos_dia`', '`antecedentes_medicos`.`alcohol`', '`antecedentes_medicos`.`frecuencia_alcohol_id`', '`antecedentes_medicos`.`drogas`', '`antecedentes_medicos`.`tipo_drogas`', '`antecedentes_medicos`.`familiares_ceguera`', '`antecedentes_medicos`.`familiares_glaucoma`', '`antecedentes_medicos`.`familiares_retinopatia_diabetica`', '`antecedentes_medicos`.`familiares_otros`', '`antecedentes_medicos`.`observaciones`', '`antecedentes_medicos`.`usuario_id_inserto`', '`antecedentes_medicos`.`fecha_insercion`', '`antecedentes_medicos`.`usuario_id_actualizo`', '`antecedentes_medicos`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`', '`tipos_diabetes`.`nombre`', '`frecuencias_consumo`.`nombre`'];
        
        // Limpiar el nombre de la columna para la validación
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `antecedentes_medicos`.`id` DESC ";

        $query = "SELECT `antecedentes_medicos`.* , `pacientes`.`primer_apellido` as `paciente_id_display` , `tipos_diabetes`.`nombre` as `diabetes_tipo_id_display` , `frecuencias_consumo`.`nombre` as `frecuencia_alcohol_id_display`  FROM antecedentes_medicos";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
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
        $query = "SELECT `antecedentes_medicos`.* , `pacientes`.`primer_apellido` as `paciente_id_display` , `tipos_diabetes`.`nombre` as `diabetes_tipo_id_display` , `frecuencias_consumo`.`nombre` as `frecuencia_alcohol_id_display`  FROM antecedentes_medicos";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
        $query .= " WHERE `antecedentes_medicos`.$this->llavePrimaria = ?";
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

        if (!isset($datos['paciente_id']) || $datos['paciente_id'] === '') {
            throw new Exception('El campo paciente_id es requerido.');
        } elseif (isset($datos['paciente_id'])) {
            $campos[] = '`paciente_id`';
            $valores[] = '?';
            $params[] = $datos['paciente_id'];
            $tipos .= 'i';
                }
        if (isset($datos['hipertension_arterial']) && $datos['hipertension_arterial'] !== '') {
          if (isset($datos['hipertension_arterial'])) {
            $campos[] = '`hipertension_arterial`';
            $valores[] = '?';
            $params[] = $datos['hipertension_arterial'];
            $tipos .= 'i';
          }        }
        if (isset($datos['diabetes']) && $datos['diabetes'] !== '') {
          if (isset($datos['diabetes'])) {
            $campos[] = '`diabetes`';
            $valores[] = '?';
            $params[] = $datos['diabetes'];
            $tipos .= 'i';
          }        }
        if (isset($datos['diabetes_tipo_id']) && $datos['diabetes_tipo_id'] !== '') {
          if (isset($datos['diabetes_tipo_id'])) {
            $campos[] = '`diabetes_tipo_id`';
            $valores[] = '?';
            $params[] = $datos['diabetes_tipo_id'];
            $tipos .= 'i';
          }        }
        if (isset($datos['tiempo_diabetes']) && $datos['tiempo_diabetes'] !== '') {
          if (isset($datos['tiempo_diabetes'])) {
            $campos[] = '`tiempo_diabetes`';
            $valores[] = '?';
            $params[] = $datos['tiempo_diabetes'];
            $tipos .= 's';
          }        }
        if (isset($datos['enfermedades_cardiacas']) && $datos['enfermedades_cardiacas'] !== '') {
          if (isset($datos['enfermedades_cardiacas'])) {
            $campos[] = '`enfermedades_cardiacas`';
            $valores[] = '?';
            $params[] = $datos['enfermedades_cardiacas'];
            $tipos .= 'i';
          }        }
        if (isset($datos['enfermedades_renales']) && $datos['enfermedades_renales'] !== '') {
          if (isset($datos['enfermedades_renales'])) {
            $campos[] = '`enfermedades_renales`';
            $valores[] = '?';
            $params[] = $datos['enfermedades_renales'];
            $tipos .= 'i';
          }        }
        if (isset($datos['enfermedades_hepaticas']) && $datos['enfermedades_hepaticas'] !== '') {
          if (isset($datos['enfermedades_hepaticas'])) {
            $campos[] = '`enfermedades_hepaticas`';
            $valores[] = '?';
            $params[] = $datos['enfermedades_hepaticas'];
            $tipos .= 'i';
          }        }
        if (isset($datos['enfermedades_autoimunes']) && $datos['enfermedades_autoimunes'] !== '') {
          if (isset($datos['enfermedades_autoimunes'])) {
            $campos[] = '`enfermedades_autoimunes`';
            $valores[] = '?';
            $params[] = $datos['enfermedades_autoimunes'];
            $tipos .= 'i';
          }        }
        if (isset($datos['cancer']) && $datos['cancer'] !== '') {
          if (isset($datos['cancer'])) {
            $campos[] = '`cancer`';
            $valores[] = '?';
            $params[] = $datos['cancer'];
            $tipos .= 'i';
          }        }
        if (isset($datos['vih']) && $datos['vih'] !== '') {
          if (isset($datos['vih'])) {
            $campos[] = '`vih`';
            $valores[] = '?';
            $params[] = $datos['vih'];
            $tipos .= 'i';
          }        }
        if (isset($datos['tuberculosis']) && $datos['tuberculosis'] !== '') {
          if (isset($datos['tuberculosis'])) {
            $campos[] = '`tuberculosis`';
            $valores[] = '?';
            $params[] = $datos['tuberculosis'];
            $tipos .= 'i';
          }        }
        if (isset($datos['epilepsia']) && $datos['epilepsia'] !== '') {
          if (isset($datos['epilepsia'])) {
            $campos[] = '`epilepsia`';
            $valores[] = '?';
            $params[] = $datos['epilepsia'];
            $tipos .= 'i';
          }        }
        if (isset($datos['asma']) && $datos['asma'] !== '') {
          if (isset($datos['asma'])) {
            $campos[] = '`asma`';
            $valores[] = '?';
            $params[] = $datos['asma'];
            $tipos .= 'i';
          }        }
        if (isset($datos['otras_enfermedades']) && $datos['otras_enfermedades'] !== '') {
          if (isset($datos['otras_enfermedades'])) {
            $campos[] = '`otras_enfermedades`';
            $valores[] = '?';
            $params[] = $datos['otras_enfermedades'];
            $tipos .= 's';
          }        }
        if (isset($datos['glaucoma']) && $datos['glaucoma'] !== '') {
          if (isset($datos['glaucoma'])) {
            $campos[] = '`glaucoma`';
            $valores[] = '?';
            $params[] = $datos['glaucoma'];
            $tipos .= 'i';
          }        }
        if (isset($datos['familia_glaucoma']) && $datos['familia_glaucoma'] !== '') {
          if (isset($datos['familia_glaucoma'])) {
            $campos[] = '`familia_glaucoma`';
            $valores[] = '?';
            $params[] = $datos['familia_glaucoma'];
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
        if (isset($datos['alergias_medicamentos']) && $datos['alergias_medicamentos'] !== '') {
          if (isset($datos['alergias_medicamentos'])) {
            $campos[] = '`alergias_medicamentos`';
            $valores[] = '?';
            $params[] = $datos['alergias_medicamentos'];
            $tipos .= 's';
          }        }
        if (isset($datos['antecedentes_quirurgicos']) && $datos['antecedentes_quirurgicos'] !== '') {
          if (isset($datos['antecedentes_quirurgicos'])) {
            $campos[] = '`antecedentes_quirurgicos`';
            $valores[] = '?';
            $params[] = $datos['antecedentes_quirurgicos'];
            $tipos .= 's';
          }        }
        if (isset($datos['fuma']) && $datos['fuma'] !== '') {
          if (isset($datos['fuma'])) {
            $campos[] = '`fuma`';
            $valores[] = '?';
            $params[] = $datos['fuma'];
            $tipos .= 'i';
          }        }
        if (isset($datos['cigarrillos_dia']) && $datos['cigarrillos_dia'] !== '') {
          if (isset($datos['cigarrillos_dia'])) {
            $campos[] = '`cigarrillos_dia`';
            $valores[] = '?';
            $params[] = $datos['cigarrillos_dia'];
            $tipos .= 'i';
          }        }
        if (isset($datos['alcohol']) && $datos['alcohol'] !== '') {
          if (isset($datos['alcohol'])) {
            $campos[] = '`alcohol`';
            $valores[] = '?';
            $params[] = $datos['alcohol'];
            $tipos .= 'i';
          }        }
        if (isset($datos['frecuencia_alcohol_id']) && $datos['frecuencia_alcohol_id'] !== '') {
          if (isset($datos['frecuencia_alcohol_id'])) {
            $campos[] = '`frecuencia_alcohol_id`';
            $valores[] = '?';
            $params[] = $datos['frecuencia_alcohol_id'];
            $tipos .= 'i';
          }        }
        if (isset($datos['drogas']) && $datos['drogas'] !== '') {
          if (isset($datos['drogas'])) {
            $campos[] = '`drogas`';
            $valores[] = '?';
            $params[] = $datos['drogas'];
            $tipos .= 'i';
          }        }
        if (isset($datos['tipo_drogas']) && $datos['tipo_drogas'] !== '') {
          if (isset($datos['tipo_drogas'])) {
            $campos[] = '`tipo_drogas`';
            $valores[] = '?';
            $params[] = $datos['tipo_drogas'];
            $tipos .= 's';
          }        }
        if (isset($datos['familiares_ceguera']) && $datos['familiares_ceguera'] !== '') {
          if (isset($datos['familiares_ceguera'])) {
            $campos[] = '`familiares_ceguera`';
            $valores[] = '?';
            $params[] = $datos['familiares_ceguera'];
            $tipos .= 'i';
          }        }
        if (isset($datos['familiares_glaucoma']) && $datos['familiares_glaucoma'] !== '') {
          if (isset($datos['familiares_glaucoma'])) {
            $campos[] = '`familiares_glaucoma`';
            $valores[] = '?';
            $params[] = $datos['familiares_glaucoma'];
            $tipos .= 'i';
          }        }
        if (isset($datos['familiares_retinopatia_diabetica']) && $datos['familiares_retinopatia_diabetica'] !== '') {
          if (isset($datos['familiares_retinopatia_diabetica'])) {
            $campos[] = '`familiares_retinopatia_diabetica`';
            $valores[] = '?';
            $params[] = $datos['familiares_retinopatia_diabetica'];
            $tipos .= 'i';
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

        $query = "INSERT INTO antecedentes_medicos (" . implode(', ', $campos) . ") VALUES (" . implode(', ', $valores) . ")";
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
        if (isset($datos['hipertension_arterial']) && ($datos['hipertension_arterial'] !== '' || $datos['hipertension_arterial'] === 0)) {
            $actualizaciones[] = "`hipertension_arterial` = ?";
            $params[] = $datos['hipertension_arterial'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['diabetes']) && ($datos['diabetes'] !== '' || $datos['diabetes'] === 0)) {
            $actualizaciones[] = "`diabetes` = ?";
            $params[] = $datos['diabetes'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['diabetes_tipo_id']) && ($datos['diabetes_tipo_id'] !== '' || $datos['diabetes_tipo_id'] === 0)) {
            $actualizaciones[] = "`diabetes_tipo_id` = ?";
            $params[] = $datos['diabetes_tipo_id'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['tiempo_diabetes']) && ($datos['tiempo_diabetes'] !== '' || $datos['tiempo_diabetes'] === 0)) {
            $actualizaciones[] = "`tiempo_diabetes` = ?";
            $params[] = $datos['tiempo_diabetes'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['enfermedades_cardiacas']) && ($datos['enfermedades_cardiacas'] !== '' || $datos['enfermedades_cardiacas'] === 0)) {
            $actualizaciones[] = "`enfermedades_cardiacas` = ?";
            $params[] = $datos['enfermedades_cardiacas'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['enfermedades_renales']) && ($datos['enfermedades_renales'] !== '' || $datos['enfermedades_renales'] === 0)) {
            $actualizaciones[] = "`enfermedades_renales` = ?";
            $params[] = $datos['enfermedades_renales'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['enfermedades_hepaticas']) && ($datos['enfermedades_hepaticas'] !== '' || $datos['enfermedades_hepaticas'] === 0)) {
            $actualizaciones[] = "`enfermedades_hepaticas` = ?";
            $params[] = $datos['enfermedades_hepaticas'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['enfermedades_autoimunes']) && ($datos['enfermedades_autoimunes'] !== '' || $datos['enfermedades_autoimunes'] === 0)) {
            $actualizaciones[] = "`enfermedades_autoimunes` = ?";
            $params[] = $datos['enfermedades_autoimunes'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['cancer']) && ($datos['cancer'] !== '' || $datos['cancer'] === 0)) {
            $actualizaciones[] = "`cancer` = ?";
            $params[] = $datos['cancer'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['vih']) && ($datos['vih'] !== '' || $datos['vih'] === 0)) {
            $actualizaciones[] = "`vih` = ?";
            $params[] = $datos['vih'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['tuberculosis']) && ($datos['tuberculosis'] !== '' || $datos['tuberculosis'] === 0)) {
            $actualizaciones[] = "`tuberculosis` = ?";
            $params[] = $datos['tuberculosis'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['epilepsia']) && ($datos['epilepsia'] !== '' || $datos['epilepsia'] === 0)) {
            $actualizaciones[] = "`epilepsia` = ?";
            $params[] = $datos['epilepsia'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['asma']) && ($datos['asma'] !== '' || $datos['asma'] === 0)) {
            $actualizaciones[] = "`asma` = ?";
            $params[] = $datos['asma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['otras_enfermedades']) && ($datos['otras_enfermedades'] !== '' || $datos['otras_enfermedades'] === 0)) {
            $actualizaciones[] = "`otras_enfermedades` = ?";
            $params[] = $datos['otras_enfermedades'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['glaucoma']) && ($datos['glaucoma'] !== '' || $datos['glaucoma'] === 0)) {
            $actualizaciones[] = "`glaucoma` = ?";
            $params[] = $datos['glaucoma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['familia_glaucoma']) && ($datos['familia_glaucoma'] !== '' || $datos['familia_glaucoma'] === 0)) {
            $actualizaciones[] = "`familia_glaucoma` = ?";
            $params[] = $datos['familia_glaucoma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['catarata']) && ($datos['catarata'] !== '' || $datos['catarata'] === 0)) {
            $actualizaciones[] = "`catarata` = ?";
            $params[] = $datos['catarata'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['fecha_cirugia_catarata']) && ($datos['fecha_cirugia_catarata'] !== '' || $datos['fecha_cirugia_catarata'] === 0)) {
            $actualizaciones[] = "`fecha_cirugia_catarata` = ?";
            // Formatear fecha
            $params[] = !empty($datos['fecha_cirugia_catarata']) ? date('Y-m-d', strtotime($datos['fecha_cirugia_catarata'])) : null;
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['desprendimiento_retina']) && ($datos['desprendimiento_retina'] !== '' || $datos['desprendimiento_retina'] === 0)) {
            $actualizaciones[] = "`desprendimiento_retina` = ?";
            $params[] = $datos['desprendimiento_retina'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['estrabismo']) && ($datos['estrabismo'] !== '' || $datos['estrabismo'] === 0)) {
            $actualizaciones[] = "`estrabismo` = ?";
            $params[] = $datos['estrabismo'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['ojo_vago']) && ($datos['ojo_vago'] !== '' || $datos['ojo_vago'] === 0)) {
            $actualizaciones[] = "`ojo_vago` = ?";
            $params[] = $datos['ojo_vago'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['conjuntivitis_alergica']) && ($datos['conjuntivitis_alergica'] !== '' || $datos['conjuntivitis_alergica'] === 0)) {
            $actualizaciones[] = "`conjuntivitis_alergica` = ?";
            $params[] = $datos['conjuntivitis_alergica'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['otros_antecedentes_oftalmologicos']) && ($datos['otros_antecedentes_oftalmologicos'] !== '' || $datos['otros_antecedentes_oftalmologicos'] === 0)) {
            $actualizaciones[] = "`otros_antecedentes_oftalmologicos` = ?";
            $params[] = $datos['otros_antecedentes_oftalmologicos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['medicamentos_actuales']) && ($datos['medicamentos_actuales'] !== '' || $datos['medicamentos_actuales'] === 0)) {
            $actualizaciones[] = "`medicamentos_actuales` = ?";
            $params[] = $datos['medicamentos_actuales'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['dosis_medicamentos']) && ($datos['dosis_medicamentos'] !== '' || $datos['dosis_medicamentos'] === 0)) {
            $actualizaciones[] = "`dosis_medicamentos` = ?";
            $params[] = $datos['dosis_medicamentos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['alergias_medicamentos']) && ($datos['alergias_medicamentos'] !== '' || $datos['alergias_medicamentos'] === 0)) {
            $actualizaciones[] = "`alergias_medicamentos` = ?";
            $params[] = $datos['alergias_medicamentos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['antecedentes_quirurgicos']) && ($datos['antecedentes_quirurgicos'] !== '' || $datos['antecedentes_quirurgicos'] === 0)) {
            $actualizaciones[] = "`antecedentes_quirurgicos` = ?";
            $params[] = $datos['antecedentes_quirurgicos'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['fuma']) && ($datos['fuma'] !== '' || $datos['fuma'] === 0)) {
            $actualizaciones[] = "`fuma` = ?";
            $params[] = $datos['fuma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['cigarrillos_dia']) && ($datos['cigarrillos_dia'] !== '' || $datos['cigarrillos_dia'] === 0)) {
            $actualizaciones[] = "`cigarrillos_dia` = ?";
            $params[] = $datos['cigarrillos_dia'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['alcohol']) && ($datos['alcohol'] !== '' || $datos['alcohol'] === 0)) {
            $actualizaciones[] = "`alcohol` = ?";
            $params[] = $datos['alcohol'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['frecuencia_alcohol_id']) && ($datos['frecuencia_alcohol_id'] !== '' || $datos['frecuencia_alcohol_id'] === 0)) {
            $actualizaciones[] = "`frecuencia_alcohol_id` = ?";
            $params[] = $datos['frecuencia_alcohol_id'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['drogas']) && ($datos['drogas'] !== '' || $datos['drogas'] === 0)) {
            $actualizaciones[] = "`drogas` = ?";
            $params[] = $datos['drogas'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['tipo_drogas']) && ($datos['tipo_drogas'] !== '' || $datos['tipo_drogas'] === 0)) {
            $actualizaciones[] = "`tipo_drogas` = ?";
            $params[] = $datos['tipo_drogas'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['familiares_ceguera']) && ($datos['familiares_ceguera'] !== '' || $datos['familiares_ceguera'] === 0)) {
            $actualizaciones[] = "`familiares_ceguera` = ?";
            $params[] = $datos['familiares_ceguera'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['familiares_glaucoma']) && ($datos['familiares_glaucoma'] !== '' || $datos['familiares_glaucoma'] === 0)) {
            $actualizaciones[] = "`familiares_glaucoma` = ?";
            $params[] = $datos['familiares_glaucoma'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['familiares_retinopatia_diabetica']) && ($datos['familiares_retinopatia_diabetica'] !== '' || $datos['familiares_retinopatia_diabetica'] === 0)) {
            $actualizaciones[] = "`familiares_retinopatia_diabetica` = ?";
            $params[] = $datos['familiares_retinopatia_diabetica'];
            $tipos .= 'i';
        }
        // Campo No Requerido
        if (isset($datos['familiares_otros']) && ($datos['familiares_otros'] !== '' || $datos['familiares_otros'] === 0)) {
            $actualizaciones[] = "`familiares_otros` = ?";
            $params[] = $datos['familiares_otros'];
            $tipos .= 's';
        }
        // Campo No Requerido
        if (isset($datos['observaciones']) && ($datos['observaciones'] !== '' || $datos['observaciones'] === 0)) {
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
        $query = "UPDATE antecedentes_medicos SET " . implode(', ', $actualizaciones) . " WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        if (!empty($params)) {
             if(!$stmt) throw new Exception("Error preparando update: " . $this->conexion->error);
            $stmt->bind_param($tipos, ...$params);
        }
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar($id) {
        $query = "DELETE FROM antecedentes_medicos WHERE $this->llavePrimaria = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Función de búsqueda (reutilizada)
    public function buscar($termino, $registrosPorPagina, $offset, $orderBy = 'id', $orderDir = 'DESC') {
        // Validar columnas permitidas
        $allowedColumns = ['`antecedentes_medicos`.`id`', '`antecedentes_medicos`.`paciente_id`', '`antecedentes_medicos`.`hipertension_arterial`', '`antecedentes_medicos`.`diabetes`', '`antecedentes_medicos`.`diabetes_tipo_id`', '`antecedentes_medicos`.`tiempo_diabetes`', '`antecedentes_medicos`.`enfermedades_cardiacas`', '`antecedentes_medicos`.`enfermedades_renales`', '`antecedentes_medicos`.`enfermedades_hepaticas`', '`antecedentes_medicos`.`enfermedades_autoimunes`', '`antecedentes_medicos`.`cancer`', '`antecedentes_medicos`.`vih`', '`antecedentes_medicos`.`tuberculosis`', '`antecedentes_medicos`.`epilepsia`', '`antecedentes_medicos`.`asma`', '`antecedentes_medicos`.`otras_enfermedades`', '`antecedentes_medicos`.`glaucoma`', '`antecedentes_medicos`.`familia_glaucoma`', '`antecedentes_medicos`.`catarata`', '`antecedentes_medicos`.`fecha_cirugia_catarata`', '`antecedentes_medicos`.`desprendimiento_retina`', '`antecedentes_medicos`.`estrabismo`', '`antecedentes_medicos`.`ojo_vago`', '`antecedentes_medicos`.`conjuntivitis_alergica`', '`antecedentes_medicos`.`otros_antecedentes_oftalmologicos`', '`antecedentes_medicos`.`medicamentos_actuales`', '`antecedentes_medicos`.`dosis_medicamentos`', '`antecedentes_medicos`.`alergias_medicamentos`', '`antecedentes_medicos`.`antecedentes_quirurgicos`', '`antecedentes_medicos`.`fuma`', '`antecedentes_medicos`.`cigarrillos_dia`', '`antecedentes_medicos`.`alcohol`', '`antecedentes_medicos`.`frecuencia_alcohol_id`', '`antecedentes_medicos`.`drogas`', '`antecedentes_medicos`.`tipo_drogas`', '`antecedentes_medicos`.`familiares_ceguera`', '`antecedentes_medicos`.`familiares_glaucoma`', '`antecedentes_medicos`.`familiares_retinopatia_diabetica`', '`antecedentes_medicos`.`familiares_otros`', '`antecedentes_medicos`.`observaciones`', '`antecedentes_medicos`.`usuario_id_inserto`', '`antecedentes_medicos`.`fecha_insercion`', '`antecedentes_medicos`.`usuario_id_actualizo`', '`antecedentes_medicos`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`', '`tipos_diabetes`.`nombre`', '`frecuencias_consumo`.`nombre`'];
        
        $orderByClean = str_replace(['`', ' '], '', $orderBy);
        $isValid = false;
        foreach($allowedColumns as $ac) {
            if (str_replace(['`', ' '], '', $ac) === $orderByClean) {
                $isValid = true;
                break;
            }
        }
        
        $orderSQL = $isValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `antecedentes_medicos`.`id` DESC ";

        $query = "SELECT `antecedentes_medicos`.* , `pacientes`.`primer_apellido` as `paciente_id_display` , `tipos_diabetes`.`nombre` as `diabetes_tipo_id_display` , `frecuencias_consumo`.`nombre` as `frecuencia_alcohol_id_display`  FROM antecedentes_medicos";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
        $query .= " WHERE ";
        $query .= "CONCAT_WS(' ', `antecedentes_medicos`.`id`, `antecedentes_medicos`.`paciente_id`, `antecedentes_medicos`.`hipertension_arterial`, `antecedentes_medicos`.`diabetes`, `antecedentes_medicos`.`diabetes_tipo_id`, `antecedentes_medicos`.`tiempo_diabetes`, `antecedentes_medicos`.`enfermedades_cardiacas`, `antecedentes_medicos`.`enfermedades_renales`, `antecedentes_medicos`.`enfermedades_hepaticas`, `antecedentes_medicos`.`enfermedades_autoimunes`, `antecedentes_medicos`.`cancer`, `antecedentes_medicos`.`vih`, `antecedentes_medicos`.`tuberculosis`, `antecedentes_medicos`.`epilepsia`, `antecedentes_medicos`.`asma`, `antecedentes_medicos`.`otras_enfermedades`, `antecedentes_medicos`.`glaucoma`, `antecedentes_medicos`.`familia_glaucoma`, `antecedentes_medicos`.`catarata`, `antecedentes_medicos`.`fecha_cirugia_catarata`, `antecedentes_medicos`.`desprendimiento_retina`, `antecedentes_medicos`.`estrabismo`, `antecedentes_medicos`.`ojo_vago`, `antecedentes_medicos`.`conjuntivitis_alergica`, `antecedentes_medicos`.`otros_antecedentes_oftalmologicos`, `antecedentes_medicos`.`medicamentos_actuales`, `antecedentes_medicos`.`dosis_medicamentos`, `antecedentes_medicos`.`alergias_medicamentos`, `antecedentes_medicos`.`antecedentes_quirurgicos`, `antecedentes_medicos`.`fuma`, `antecedentes_medicos`.`cigarrillos_dia`, `antecedentes_medicos`.`alcohol`, `antecedentes_medicos`.`frecuencia_alcohol_id`, `antecedentes_medicos`.`drogas`, `antecedentes_medicos`.`tipo_drogas`, `antecedentes_medicos`.`familiares_ceguera`, `antecedentes_medicos`.`familiares_glaucoma`, `antecedentes_medicos`.`familiares_retinopatia_diabetica`, `antecedentes_medicos`.`familiares_otros`, `antecedentes_medicos`.`observaciones`, `antecedentes_medicos`.`usuario_id_inserto`, `antecedentes_medicos`.`fecha_insercion`, `antecedentes_medicos`.`usuario_id_actualizo`, `antecedentes_medicos`.`fecha_actualizacion`, `pacientes`.`primer_apellido`, `tipos_diabetes`.`nombre`, `frecuencias_consumo`.`nombre`) LIKE ?";
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
        $allowedColumns = ['`antecedentes_medicos`.`id`', '`antecedentes_medicos`.`paciente_id`', '`antecedentes_medicos`.`hipertension_arterial`', '`antecedentes_medicos`.`diabetes`', '`antecedentes_medicos`.`diabetes_tipo_id`', '`antecedentes_medicos`.`tiempo_diabetes`', '`antecedentes_medicos`.`enfermedades_cardiacas`', '`antecedentes_medicos`.`enfermedades_renales`', '`antecedentes_medicos`.`enfermedades_hepaticas`', '`antecedentes_medicos`.`enfermedades_autoimunes`', '`antecedentes_medicos`.`cancer`', '`antecedentes_medicos`.`vih`', '`antecedentes_medicos`.`tuberculosis`', '`antecedentes_medicos`.`epilepsia`', '`antecedentes_medicos`.`asma`', '`antecedentes_medicos`.`otras_enfermedades`', '`antecedentes_medicos`.`glaucoma`', '`antecedentes_medicos`.`familia_glaucoma`', '`antecedentes_medicos`.`catarata`', '`antecedentes_medicos`.`fecha_cirugia_catarata`', '`antecedentes_medicos`.`desprendimiento_retina`', '`antecedentes_medicos`.`estrabismo`', '`antecedentes_medicos`.`ojo_vago`', '`antecedentes_medicos`.`conjuntivitis_alergica`', '`antecedentes_medicos`.`otros_antecedentes_oftalmologicos`', '`antecedentes_medicos`.`medicamentos_actuales`', '`antecedentes_medicos`.`dosis_medicamentos`', '`antecedentes_medicos`.`alergias_medicamentos`', '`antecedentes_medicos`.`antecedentes_quirurgicos`', '`antecedentes_medicos`.`fuma`', '`antecedentes_medicos`.`cigarrillos_dia`', '`antecedentes_medicos`.`alcohol`', '`antecedentes_medicos`.`frecuencia_alcohol_id`', '`antecedentes_medicos`.`drogas`', '`antecedentes_medicos`.`tipo_drogas`', '`antecedentes_medicos`.`familiares_ceguera`', '`antecedentes_medicos`.`familiares_glaucoma`', '`antecedentes_medicos`.`familiares_retinopatia_diabetica`', '`antecedentes_medicos`.`familiares_otros`', '`antecedentes_medicos`.`observaciones`', '`antecedentes_medicos`.`usuario_id_inserto`', '`antecedentes_medicos`.`fecha_insercion`', '`antecedentes_medicos`.`usuario_id_actualizo`', '`antecedentes_medicos`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`', '`tipos_diabetes`.`nombre`', '`frecuencias_consumo`.`nombre`'];
        // También permitir columnas simples sin prefijo de tabla (para el select de la vista)
        $simpleCols = ['id', 'paciente_id', 'hipertension_arterial', 'diabetes', 'diabetes_tipo_id', 'tiempo_diabetes', 'enfermedades_cardiacas', 'enfermedades_renales', 'enfermedades_hepaticas', 'enfermedades_autoimunes', 'cancer', 'vih', 'tuberculosis', 'epilepsia', 'asma', 'otras_enfermedades', 'glaucoma', 'familia_glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'medicamentos_actuales', 'dosis_medicamentos', 'alergias_medicamentos', 'antecedentes_quirurgicos', 'fuma', 'cigarrillos_dia', 'alcohol', 'frecuencia_alcohol_id', 'drogas', 'tipo_drogas', 'familiares_ceguera', 'familiares_glaucoma', 'familiares_retinopatia_diabetica', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        // Mapear input simple a columna calificada
        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`antecedentes_medicos`.`" . $campo . "`";
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

        $query = "SELECT COUNT(*) as total FROM antecedentes_medicos ";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
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
         $allowedColumns = ['`antecedentes_medicos`.`id`', '`antecedentes_medicos`.`paciente_id`', '`antecedentes_medicos`.`hipertension_arterial`', '`antecedentes_medicos`.`diabetes`', '`antecedentes_medicos`.`diabetes_tipo_id`', '`antecedentes_medicos`.`tiempo_diabetes`', '`antecedentes_medicos`.`enfermedades_cardiacas`', '`antecedentes_medicos`.`enfermedades_renales`', '`antecedentes_medicos`.`enfermedades_hepaticas`', '`antecedentes_medicos`.`enfermedades_autoimunes`', '`antecedentes_medicos`.`cancer`', '`antecedentes_medicos`.`vih`', '`antecedentes_medicos`.`tuberculosis`', '`antecedentes_medicos`.`epilepsia`', '`antecedentes_medicos`.`asma`', '`antecedentes_medicos`.`otras_enfermedades`', '`antecedentes_medicos`.`glaucoma`', '`antecedentes_medicos`.`familia_glaucoma`', '`antecedentes_medicos`.`catarata`', '`antecedentes_medicos`.`fecha_cirugia_catarata`', '`antecedentes_medicos`.`desprendimiento_retina`', '`antecedentes_medicos`.`estrabismo`', '`antecedentes_medicos`.`ojo_vago`', '`antecedentes_medicos`.`conjuntivitis_alergica`', '`antecedentes_medicos`.`otros_antecedentes_oftalmologicos`', '`antecedentes_medicos`.`medicamentos_actuales`', '`antecedentes_medicos`.`dosis_medicamentos`', '`antecedentes_medicos`.`alergias_medicamentos`', '`antecedentes_medicos`.`antecedentes_quirurgicos`', '`antecedentes_medicos`.`fuma`', '`antecedentes_medicos`.`cigarrillos_dia`', '`antecedentes_medicos`.`alcohol`', '`antecedentes_medicos`.`frecuencia_alcohol_id`', '`antecedentes_medicos`.`drogas`', '`antecedentes_medicos`.`tipo_drogas`', '`antecedentes_medicos`.`familiares_ceguera`', '`antecedentes_medicos`.`familiares_glaucoma`', '`antecedentes_medicos`.`familiares_retinopatia_diabetica`', '`antecedentes_medicos`.`familiares_otros`', '`antecedentes_medicos`.`observaciones`', '`antecedentes_medicos`.`usuario_id_inserto`', '`antecedentes_medicos`.`fecha_insercion`', '`antecedentes_medicos`.`usuario_id_actualizo`', '`antecedentes_medicos`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`', '`tipos_diabetes`.`nombre`', '`frecuencias_consumo`.`nombre`'];
        $simpleCols = ['id', 'paciente_id', 'hipertension_arterial', 'diabetes', 'diabetes_tipo_id', 'tiempo_diabetes', 'enfermedades_cardiacas', 'enfermedades_renales', 'enfermedades_hepaticas', 'enfermedades_autoimunes', 'cancer', 'vih', 'tuberculosis', 'epilepsia', 'asma', 'otras_enfermedades', 'glaucoma', 'familia_glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'medicamentos_actuales', 'dosis_medicamentos', 'alergias_medicamentos', 'antecedentes_quirurgicos', 'fuma', 'cigarrillos_dia', 'alcohol', 'frecuencia_alcohol_id', 'drogas', 'tipo_drogas', 'familiares_ceguera', 'familiares_glaucoma', 'familiares_retinopatia_diabetica', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
        
        $campoLimpio = str_replace(['`', ' '], '', $campo);
        $esValido = false;
        $columnaSQL = '';

        foreach ($simpleCols as $idx => $sc) {
            if ($sc === $campo) {
                 $esValido = true;
                 $columnaSQL = "`antecedentes_medicos`.`" . $campo . "`";
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
        $orderSQL = $orderValid ? " ORDER BY $orderBy $orderDir " : " ORDER BY `antecedentes_medicos`.`id` DESC ";

        $query = "SELECT `antecedentes_medicos`.* , `pacientes`.`primer_apellido` as `paciente_id_display` , `tipos_diabetes`.`nombre` as `diabetes_tipo_id_display` , `frecuencias_consumo`.`nombre` as `frecuencia_alcohol_id_display`  FROM antecedentes_medicos";
        $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
        $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
        $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
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
            $query = "SELECT `antecedentes_medicos`.`id`, `antecedentes_medicos`.`paciente_id`, `antecedentes_medicos`.`hipertension_arterial`, `antecedentes_medicos`.`diabetes`, `antecedentes_medicos`.`diabetes_tipo_id`, `antecedentes_medicos`.`tiempo_diabetes`, `antecedentes_medicos`.`enfermedades_cardiacas`, `antecedentes_medicos`.`enfermedades_renales`, `antecedentes_medicos`.`enfermedades_hepaticas`, `antecedentes_medicos`.`enfermedades_autoimunes`, `antecedentes_medicos`.`cancer`, `antecedentes_medicos`.`vih`, `antecedentes_medicos`.`tuberculosis`, `antecedentes_medicos`.`epilepsia`, `antecedentes_medicos`.`asma`, `antecedentes_medicos`.`otras_enfermedades`, `antecedentes_medicos`.`glaucoma`, `antecedentes_medicos`.`familia_glaucoma`, `antecedentes_medicos`.`catarata`, `antecedentes_medicos`.`fecha_cirugia_catarata`, `antecedentes_medicos`.`desprendimiento_retina`, `antecedentes_medicos`.`estrabismo`, `antecedentes_medicos`.`ojo_vago`, `antecedentes_medicos`.`conjuntivitis_alergica`, `antecedentes_medicos`.`otros_antecedentes_oftalmologicos`, `antecedentes_medicos`.`medicamentos_actuales`, `antecedentes_medicos`.`dosis_medicamentos`, `antecedentes_medicos`.`alergias_medicamentos`, `antecedentes_medicos`.`antecedentes_quirurgicos`, `antecedentes_medicos`.`fuma`, `antecedentes_medicos`.`cigarrillos_dia`, `antecedentes_medicos`.`alcohol`, `antecedentes_medicos`.`frecuencia_alcohol_id`, `antecedentes_medicos`.`drogas`, `antecedentes_medicos`.`tipo_drogas`, `antecedentes_medicos`.`familiares_ceguera`, `antecedentes_medicos`.`familiares_glaucoma`, `antecedentes_medicos`.`familiares_retinopatia_diabetica`, `antecedentes_medicos`.`familiares_otros`, `antecedentes_medicos`.`observaciones`, `antecedentes_medicos`.`usuario_id_inserto`, `antecedentes_medicos`.`fecha_insercion`, `antecedentes_medicos`.`usuario_id_actualizo`, `antecedentes_medicos`.`fecha_actualizacion`, `pacientes`.`primer_apellido` as `paciente_id_display` , `tipos_diabetes`.`nombre` as `diabetes_tipo_id_display` , `frecuencias_consumo`.`nombre` as `frecuencia_alcohol_id_display`  FROM antecedentes_medicos";
            $query .= " LEFT JOIN `pacientes` ON `antecedentes_medicos`.`paciente_id` = `pacientes`.`id` ";
            $query .= " LEFT JOIN `tipos_diabetes` ON `antecedentes_medicos`.`diabetes_tipo_id` = `tipos_diabetes`.`id` ";
            $query .= " LEFT JOIN `frecuencias_consumo` ON `antecedentes_medicos`.`frecuencia_alcohol_id` = `frecuencias_consumo`.`id` ";
            $query .= " WHERE ";
            
            $usarFiltroCampo = false;
            $columnaSQL = '';

            if (!empty($campoFiltro)) {
                 // Validar campo
                $allowedColumns = ['`antecedentes_medicos`.`id`', '`antecedentes_medicos`.`paciente_id`', '`antecedentes_medicos`.`hipertension_arterial`', '`antecedentes_medicos`.`diabetes`', '`antecedentes_medicos`.`diabetes_tipo_id`', '`antecedentes_medicos`.`tiempo_diabetes`', '`antecedentes_medicos`.`enfermedades_cardiacas`', '`antecedentes_medicos`.`enfermedades_renales`', '`antecedentes_medicos`.`enfermedades_hepaticas`', '`antecedentes_medicos`.`enfermedades_autoimunes`', '`antecedentes_medicos`.`cancer`', '`antecedentes_medicos`.`vih`', '`antecedentes_medicos`.`tuberculosis`', '`antecedentes_medicos`.`epilepsia`', '`antecedentes_medicos`.`asma`', '`antecedentes_medicos`.`otras_enfermedades`', '`antecedentes_medicos`.`glaucoma`', '`antecedentes_medicos`.`familia_glaucoma`', '`antecedentes_medicos`.`catarata`', '`antecedentes_medicos`.`fecha_cirugia_catarata`', '`antecedentes_medicos`.`desprendimiento_retina`', '`antecedentes_medicos`.`estrabismo`', '`antecedentes_medicos`.`ojo_vago`', '`antecedentes_medicos`.`conjuntivitis_alergica`', '`antecedentes_medicos`.`otros_antecedentes_oftalmologicos`', '`antecedentes_medicos`.`medicamentos_actuales`', '`antecedentes_medicos`.`dosis_medicamentos`', '`antecedentes_medicos`.`alergias_medicamentos`', '`antecedentes_medicos`.`antecedentes_quirurgicos`', '`antecedentes_medicos`.`fuma`', '`antecedentes_medicos`.`cigarrillos_dia`', '`antecedentes_medicos`.`alcohol`', '`antecedentes_medicos`.`frecuencia_alcohol_id`', '`antecedentes_medicos`.`drogas`', '`antecedentes_medicos`.`tipo_drogas`', '`antecedentes_medicos`.`familiares_ceguera`', '`antecedentes_medicos`.`familiares_glaucoma`', '`antecedentes_medicos`.`familiares_retinopatia_diabetica`', '`antecedentes_medicos`.`familiares_otros`', '`antecedentes_medicos`.`observaciones`', '`antecedentes_medicos`.`usuario_id_inserto`', '`antecedentes_medicos`.`fecha_insercion`', '`antecedentes_medicos`.`usuario_id_actualizo`', '`antecedentes_medicos`.`fecha_actualizacion`', '`pacientes`.`primer_apellido`', '`tipos_diabetes`.`nombre`', '`frecuencias_consumo`.`nombre`'];
                $simpleCols = ['id', 'paciente_id', 'hipertension_arterial', 'diabetes', 'diabetes_tipo_id', 'tiempo_diabetes', 'enfermedades_cardiacas', 'enfermedades_renales', 'enfermedades_hepaticas', 'enfermedades_autoimunes', 'cancer', 'vih', 'tuberculosis', 'epilepsia', 'asma', 'otras_enfermedades', 'glaucoma', 'familia_glaucoma', 'catarata', 'fecha_cirugia_catarata', 'desprendimiento_retina', 'estrabismo', 'ojo_vago', 'conjuntivitis_alergica', 'otros_antecedentes_oftalmologicos', 'medicamentos_actuales', 'dosis_medicamentos', 'alergias_medicamentos', 'antecedentes_quirurgicos', 'fuma', 'cigarrillos_dia', 'alcohol', 'frecuencia_alcohol_id', 'drogas', 'tipo_drogas', 'familiares_ceguera', 'familiares_glaucoma', 'familiares_retinopatia_diabetica', 'familiares_otros', 'observaciones', 'usuario_id_inserto', 'fecha_insercion', 'usuario_id_actualizo', 'fecha_actualizacion'];
                
                $campoLimpio = str_replace(['`', ' '], '', $campoFiltro);
                
                foreach ($simpleCols as $idx => $sc) {
                    if ($sc === $campoFiltro) {
                         $usarFiltroCampo = true;
                         $columnaSQL = "`antecedentes_medicos`.`" . $campoFiltro . "`";
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
                $query .= "CONCAT_WS(' ', `antecedentes_medicos`.`id`, `antecedentes_medicos`.`paciente_id`, `antecedentes_medicos`.`hipertension_arterial`, `antecedentes_medicos`.`diabetes`, `antecedentes_medicos`.`diabetes_tipo_id`, `antecedentes_medicos`.`tiempo_diabetes`, `antecedentes_medicos`.`enfermedades_cardiacas`, `antecedentes_medicos`.`enfermedades_renales`, `antecedentes_medicos`.`enfermedades_hepaticas`, `antecedentes_medicos`.`enfermedades_autoimunes`, `antecedentes_medicos`.`cancer`, `antecedentes_medicos`.`vih`, `antecedentes_medicos`.`tuberculosis`, `antecedentes_medicos`.`epilepsia`, `antecedentes_medicos`.`asma`, `antecedentes_medicos`.`otras_enfermedades`, `antecedentes_medicos`.`glaucoma`, `antecedentes_medicos`.`familia_glaucoma`, `antecedentes_medicos`.`catarata`, `antecedentes_medicos`.`fecha_cirugia_catarata`, `antecedentes_medicos`.`desprendimiento_retina`, `antecedentes_medicos`.`estrabismo`, `antecedentes_medicos`.`ojo_vago`, `antecedentes_medicos`.`conjuntivitis_alergica`, `antecedentes_medicos`.`otros_antecedentes_oftalmologicos`, `antecedentes_medicos`.`medicamentos_actuales`, `antecedentes_medicos`.`dosis_medicamentos`, `antecedentes_medicos`.`alergias_medicamentos`, `antecedentes_medicos`.`antecedentes_quirurgicos`, `antecedentes_medicos`.`fuma`, `antecedentes_medicos`.`cigarrillos_dia`, `antecedentes_medicos`.`alcohol`, `antecedentes_medicos`.`frecuencia_alcohol_id`, `antecedentes_medicos`.`drogas`, `antecedentes_medicos`.`tipo_drogas`, `antecedentes_medicos`.`familiares_ceguera`, `antecedentes_medicos`.`familiares_glaucoma`, `antecedentes_medicos`.`familiares_retinopatia_diabetica`, `antecedentes_medicos`.`familiares_otros`, `antecedentes_medicos`.`observaciones`, `antecedentes_medicos`.`usuario_id_inserto`, `antecedentes_medicos`.`fecha_insercion`, `antecedentes_medicos`.`usuario_id_actualizo`, `antecedentes_medicos`.`fecha_actualizacion`, `pacientes`.`primer_apellido`, `tipos_diabetes`.`nombre`, `frecuencias_consumo`.`nombre`) LIKE ?";
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
        $tabla = 'antecedentes_medicos';
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