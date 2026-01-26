-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: optica.serverltda.com    Database: opticaApp
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acc_configuracion_objeto`
--

DROP TABLE IF EXISTS `acc_configuracion_objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_configuracion_objeto` (
  `id_config` int NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(150) DEFAULT NULL,
  `nombre_objeto` varchar(150) NOT NULL,
  `tipo_objeto` varchar(20) DEFAULT 'TABLE',
  `configuracion_json` longtext NOT NULL,
  `fecha_actualizacion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_config`),
  UNIQUE KEY `u_proyecto_objeto` (`nombre_proyecto`,`nombre_objeto`)
) ENGINE=InnoDB AUTO_INCREMENT=649 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_configuracion_objeto`
--

LOCK TABLES `acc_configuracion_objeto` WRITE;
/*!40000 ALTER TABLE `acc_configuracion_objeto` DISABLE KEYS */;
INSERT INTO `acc_configuracion_objeto` VALUES (1,'Optica Hogar','anamnesis','TABLE','{\"relaciones\":{\"paciente_id\":{\"display\":\"primer_apellido\",\"sort_by\":\"primer_apellido\",\"parent\":\"pacientes\",\"parentid\":\"id\",\"nullable\":false}},\"columns\":\"3\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"paciente_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"glaucoma\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"catarata\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"fecha_cirugia_catarata\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":4},\"desprendimiento_retina\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"estrabismo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"ojo_vago\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":7},\"conjuntivitis_alergica\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":8},\"otros_antecedentes_oftalmologicos\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":9},\"antecedentes_quirurgicos\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":10},\"otras_enfermedades\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":11},\"alergias_medicamentos\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":12},\"medicamentos_actuales\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":13},\"dosis_medicamentos\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":14},\"familiares_otros\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":15},\"observaciones\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":16},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":17},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":18},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":19},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":20}},\"sort\":[],\"tema\":\"azul\",\"color\":\"#8c288c\",\"icono\":\"icon-table\"}','2026-01-12 00:13:11'),(2,'Optica Hogar','pacientes','TABLE','{\"relaciones\":{\"tipo_identificacion_id\":{\"display\":\"codigo\",\"sort_by\":\"orden\",\"where\":\"estado = \'activo\'\",\"parent\":\"tipos_identificacion\",\"parentid\":\"id\",\"nullable\":false},\"genero_id\":{\"display\":\"nombre\",\"sort_by\":\"nombre\",\"where\":\"estado = \'activo\'\",\"parent\":\"generos\",\"parentid\":\"id\",\"nullable\":false},\"grupo_sanguineo_id\":{\"display\":\"codigo\",\"sort_by\":\"orden\",\"where\":\"estado = \'activo\'\",\"parent\":\"grupos_sanguineos\",\"parentid\":\"id\",\"nullable\":true},\"eps_id\":{\"display\":\"nombre\",\"sort_by\":\"nombre\",\"where\":\"estado = \'activo\'\",\"parent\":\"eps\",\"parentid\":\"id\",\"nullable\":true},\"ocupacion_id\":{\"display\":\"nombre\",\"sort_by\":\"nombre\",\"where\":\"estado = \'activo\'\",\"parent\":\"ocupaciones\",\"parentid\":\"id\",\"nullable\":true},\"estado_civil_id\":{\"display\":\"nombre\",\"sort_by\":\"orden\",\"where\":\"estado = \'activo\'\",\"parent\":\"estados_civiles\",\"parentid\":\"id\",\"nullable\":true},\"parentesco_id\":{\"display\":\"nombre\",\"sort_by\":\"orden\",\"where\":\"estado = \'activo\'\",\"parent\":\"parentescos\",\"parentid\":\"id\",\"nullable\":true},\"estado_paciente_id\":{\"display\":\"codigo\",\"sort_by\":\"orden\",\"where\":\"\",\"parent\":\"estados_paciente\",\"parentid\":\"id\",\"nullable\":true}},\"columns\":\"4\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"tipo_identificacion_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"identificacion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"fecha_ingreso\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"primer_nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"segundo_nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"primer_apellido\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"segundo_apellido\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":7},\"fecha_nacimiento\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8},\"genero_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9},\"grupo_sanguineo_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":10},\"alergias\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":11},\"departamento\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":12},\"ciudad\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":13},\"localidad\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":14},\"direccion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":15},\"telefono_principal\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":16},\"telefono_secundario\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":17},\"email\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":18},\"eps_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":19},\"ocupacion_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":20},\"estado_civil_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":21},\"identificacion_acompaniante\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":22},\"acompaniante_nombres\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":23},\"acompaniante_apellidos\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":24},\"acompaniante_telefono\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":25},\"acompa\\u00f1ante_email\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":26},\"parentesco_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":27},\"foto_ruta\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":28},\"estado_paciente_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":29},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":30},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":31},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":32},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":33}},\"sort\":[{\"field\":\"primer_apellido\",\"dir\":\"ASC\"},{\"field\":\"primer_nombre\",\"dir\":\"ASC\"},{\"field\":\"segundo_apellido\",\"dir\":\"ASC\"}],\"tema\":\"purpura\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:41:01'),(5,'Optica Hogar','parentescos','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":4},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":6},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:41:06'),(9,'Optica Hogar','tipos_identificacion','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:31:06'),(14,'Optica Hogar','tipos_consulta','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"color\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":7},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":9},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":10}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:33:34'),(20,'Optica Hogar','ocupaciones','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":5},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":7},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:27:18'),(27,'Optica Hogar','estados_civiles','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":4},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":6},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:30:23'),(42,'Optica Hogar','citas_control','TABLE','{\"relaciones\":[],\"columns\":2,\"fields\":[]}','2026-01-12 00:15:03'),(43,'Optica Hogar','eps','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"nit\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"telefono\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"email\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":7},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":9},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":10}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"purpura\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:29:23'),(53,'Optica Hogar','estados_cita','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"color\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":7},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":9},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":10}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:29:45'),(64,'Optica Hogar','tipos_lentes','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:36:29'),(76,'Optica Hogar','usos_lentes','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:48:57'),(89,'Optica Hogar','tipos_profesional','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":5},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":7},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:32:17'),(103,'Optica Hogar','tipos_origen_enfermedad','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":5},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":6},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":7},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:32:53'),(118,'Optica Hogar','materiales_lentes','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:38:52'),(134,'Optica Hogar','diagnosticos_cie10','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"codigo_categoria\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"categoria\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"codigo_categoria\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"},{\"field\":\"descripcion\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:10:37'),(151,'Optica Hogar','antecedentes_medicos','TABLE','{\"relaciones\":[],\"columns\":2,\"fields\":[]}','2026-01-12 00:24:45'),(152,'Optica Hogar','estados_paciente','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:29:55'),(171,'Optica Hogar','generos','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":4},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":6},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:27:56'),(191,'Optica Hogar','grupos_sanguineos','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 20:28:30'),(457,'Óptica Hogar','frecuencias_consumo','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:31:06'),(476,'Óptica Hogar','tipos_diabetes','TABLE','{\"relaciones\":[],\"columns\":\"2\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"codigo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"descripcion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"orden\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":6},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":8},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":9}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"orden\",\"dir\":\"ASC\"},{\"field\":\"codigo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:32:22'),(536,'Óptica Hogar','medicamentos','TABLE','{\"relaciones\":[],\"columns\":\"3\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":1},\"principio_activo\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"concentracion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"presentacion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"via_administracion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"indicaciones\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"contraindicaciones\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":7},\"estado\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":8},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":9},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":10},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"update\",\"order\":11},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":12}},\"sort\":[{\"field\":\"estado\",\"dir\":\"ASC\"},{\"field\":\"nombre\",\"dir\":\"ASC\"},{\"field\":\"principio_activo\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#32c8c8\",\"icono\":\"icon-table\"}','2026-01-14 21:40:20'),(579,'Óptica Hogar','profesionales_salud','TABLE','{\"relaciones\":{\"usuario_id\":{\"display\":\"fullname\",\"sort_by\":\"fullname\",\"where\":\"estado = \'activo\'\",\"parent\":\"acc_usuario\",\"parentid\":\"id_usuario\",\"nullable\":true},\"tipo_identificacion_id\":{\"display\":\"codigo\",\"sort_by\":\"orden\",\"where\":\"estado = \'activo\'\",\"parent\":\"tipos_identificacion\",\"parentid\":\"id\",\"nullable\":false},\"genero_id\":{\"display\":\"nombre\",\"sort_by\":\"nombre\",\"where\":\"estado = \'activo\'\",\"parent\":\"generos\",\"parentid\":\"id\",\"nullable\":true},\"tipo_profesional_id\":{\"display\":\"codigo\",\"sort_by\":\"codigo\",\"where\":\"estado = \'activo\'\",\"parent\":\"tipos_profesional\",\"parentid\":\"id\",\"nullable\":false}},\"columns\":\"4\",\"fields\":{\"id\":{\"list\":false,\"export\":false,\"audit\":\"\",\"order\":0},\"tipo_identificacion_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":1},\"identificacion\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":2},\"primer_nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":3},\"segundo_nombre\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":4},\"primer_apellido\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":5},\"segundo_apellido\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":6},\"fecha_nacimiento\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":7},\"genero_id\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":8},\"tipo_profesional_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":9},\"especialidad\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":10},\"registro_profesional\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":11},\"universidad\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":12},\"anio_graduacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":13},\"telefono_principal\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":14},\"telefono_secundario\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":15},\"email\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":16},\"direccion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":17},\"fecha_ingreso\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":18},\"jornada\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":19},\"usuario_id\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":20},\"disponible\":{\"list\":true,\"export\":true,\"audit\":\"\",\"order\":21},\"usuario_id_inserto\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":22},\"fecha_insercion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":23},\"usuario_id_actualizo\":{\"list\":false,\"export\":true,\"audit\":\"insert\",\"order\":24},\"fecha_actualizacion\":{\"list\":false,\"export\":true,\"audit\":\"\",\"order\":25}},\"sort\":[{\"field\":\"primer_nombre\",\"dir\":\"ASC\"},{\"field\":\"primer_apellido\",\"dir\":\"ASC\"},{\"field\":\"segundo_nombre\",\"dir\":\"ASC\"}],\"tema\":\"azul\",\"color\":\"#3cc8c8\",\"icono\":\"icon-table\"}','2026-01-14 22:53:10');
/*!40000 ALTER TABLE `acc_configuracion_objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_estado`
--

DROP TABLE IF EXISTS `acc_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `tabla` varchar(254) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `nombre_estado` varchar(254) DEFAULT NULL,
  `visible` tinyint DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_estado`),
  UNIQUE KEY `indx_tabla` (`tabla`,`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_estado`
--

LOCK TABLES `acc_estado` WRITE;
/*!40000 ALTER TABLE `acc_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `acc_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_log_accion`
--

DROP TABLE IF EXISTS `acc_log_accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_log_accion` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `accion` varchar(1024) DEFAULT NULL,
  `tabla` varchar(128) DEFAULT NULL,
  `detalles` text,
  `ip` varchar(45) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `log_id_usuario_fk` (`id_usuario`),
  CONSTRAINT `log_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `acc_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_log_accion`
--

LOCK TABLES `acc_log_accion` WRITE;
/*!40000 ALTER TABLE `acc_log_accion` DISABLE KEYS */;
INSERT INTO `acc_log_accion` VALUES (1,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-14 20:39:14'),(2,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 20:39:14'),(3,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 20:39:29'),(4,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 20:39:31'),(5,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 20:39:33'),(6,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 22:31:29'),(7,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-14 22:31:47'),(8,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 22:31:50'),(9,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 22:31:51'),(10,1,'CREAR','acc_rol','Rol creado: auxiliar','200.118.16.189','2026-01-14 22:32:58'),(11,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 22:37:01'),(12,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 22:38:57'),(13,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 22:39:01'),(14,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 23:00:20'),(15,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:00:32'),(16,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-14 23:02:20'),(17,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:02:20'),(18,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-14 23:02:36'),(19,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:02:36'),(20,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-14 23:02:50'),(21,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:02:51'),(22,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-14 23:59:43'),(23,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:59:47'),(24,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-14 23:59:56'),(25,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-14 23:59:56'),(26,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-15 00:00:09'),(27,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 00:00:09'),(28,1,'UPDATE','eps','Registro actualizado ID: 10','200.118.16.189','2026-01-15 00:00:18'),(29,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 00:00:18'),(30,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 00:00:59'),(31,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-15 00:01:19'),(32,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-15 00:01:26'),(33,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 00:01:37'),(34,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-15 00:01:53'),(35,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 01:34:09'),(36,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:34:59'),(37,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:35:04'),(38,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:35:05'),(39,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:35:05'),(40,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:35:21'),(41,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:35:27'),(42,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 01:37:17'),(43,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:37:21'),(44,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:38:22'),(45,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:38:46'),(46,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:41:10'),(47,1,'UPDATE','ocupaciones','Registro actualizado ID: 11','200.118.16.189','2026-01-15 01:41:51'),(48,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:41:51'),(49,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:41:55'),(50,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:42:18'),(51,1,'ACTUALIZAR','acc_rol','Rol ID 3 actualizado','200.118.16.189','2026-01-15 01:46:33'),(52,1,'CREAR','acc_rol','Rol creado: Doctor','200.118.16.189','2026-01-15 01:47:07'),(53,1,'CREAR','acc_modulo','Módulo creado: Administrador','200.118.16.189','2026-01-15 01:49:16'),(54,1,'CREAR','acc_modulo','Módulo creado: Parametros','200.118.16.189','2026-01-15 01:49:46'),(55,1,'ACTUALIZAR','acc_modulo','Módulo ID 103 actualizado','200.118.16.189','2026-01-15 01:50:14'),(56,1,'CREAR','acc_modulo','Módulo creado: Registro Pacientes','200.118.16.189','2026-01-15 01:53:35'),(57,1,'ACTUALIZAR','acc_modulo','Módulo ID 104 actualizado','200.118.16.189','2026-01-15 01:54:10'),(58,1,'CREAR','acc_modulo','Módulo creado: Control Citas','200.118.16.189','2026-01-15 01:54:46'),(59,1,'CREAR','acc_modulo','Módulo creado: Reportes','200.118.16.189','2026-01-15 01:56:05'),(60,1,'ACTUALIZAR','acc_programa','Programa ID 24 actualizado','200.118.16.189','2026-01-15 01:57:31'),(61,1,'ACTUALIZAR','acc_programa','Programa ID 23 actualizado','200.118.16.189','2026-01-15 01:58:12'),(62,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 01:58:33'),(63,1,'ACTUALIZAR','acc_programa','Programa ID 17 actualizado','200.118.16.189','2026-01-15 01:59:25'),(64,1,'ACTUALIZAR','acc_programa','Programa ID 29 actualizado','200.118.16.189','2026-01-15 02:02:17'),(65,1,'ACTUALIZAR','acc_programa','Programa ID 32 actualizado','200.118.16.189','2026-01-15 02:04:05'),(66,1,'ACTUALIZAR','acc_programa','Programa ID 27 actualizado','200.118.16.189','2026-01-15 02:04:40'),(67,1,'ACTUALIZAR','acc_programa','Programa ID 31 actualizado','200.118.16.189','2026-01-15 02:05:14'),(68,1,'ACTUALIZAR','acc_programa','Programa ID 30 actualizado','200.118.16.189','2026-01-15 02:05:48'),(69,1,'ACTUALIZAR','acc_programa','Programa ID 28 actualizado','200.118.16.189','2026-01-15 02:06:19'),(70,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:06:41'),(71,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:06:46'),(72,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:06:54'),(73,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:06:56'),(74,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:06:57'),(75,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:07'),(76,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:14'),(77,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:19'),(78,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:25'),(79,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:29'),(80,1,'UPDATE','tipos_identificacion','Registro actualizado ID: 6','200.118.16.189','2026-01-15 02:07:42'),(81,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:42'),(82,1,'UPDATE','tipos_identificacion','Registro actualizado ID: 7','200.118.16.189','2026-01-15 02:07:49'),(83,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:07:49'),(84,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:04'),(85,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:25'),(86,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:27'),(87,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:28'),(88,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:29'),(89,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:31'),(90,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:33'),(91,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:35'),(92,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:37'),(93,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:38'),(94,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:39'),(95,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:40'),(96,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:41'),(97,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:42'),(98,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:08:44'),(99,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:09:04'),(100,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:09:05'),(101,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:09:06'),(102,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:09:07'),(103,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:10:31'),(104,1,'ACTUALIZAR','acc_programa','Programa ID 16 actualizado','200.118.16.189','2026-01-15 02:12:15'),(105,1,'ACTUALIZAR','acc_programa','Programa ID 15 actualizado','200.118.16.189','2026-01-15 02:12:43'),(106,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:12:58'),(107,1,'VIEW','acciones_historial','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:13:11'),(108,1,'ACTUALIZAR','acc_programa','Programa ID 11 actualizado','200.118.16.189','2026-01-15 02:13:56'),(109,1,'ACTUALIZAR','acc_programa','Programa ID 12 actualizado','200.118.16.189','2026-01-15 02:14:49'),(110,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:14:59'),(111,1,'VIEW','acciones_historial','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:15:56'),(112,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:16:03'),(113,1,'VIEW','antecedentes_medicos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:16:06'),(114,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:16:08'),(115,1,'VIEW','antecedentes_medicos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:16:14'),(116,1,'ACTUALIZAR','acc_programa','Programa ID 10 actualizado','200.118.16.189','2026-01-15 02:16:29'),(117,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:16:35'),(118,1,'ACTUALIZAR','acc_programa','Programa ID 13 actualizado','200.118.16.189','2026-01-15 02:17:15'),(119,1,'ACTUALIZAR','acc_programa','Programa ID 14 actualizado','200.118.16.189','2026-01-15 02:18:05'),(120,1,'ACTUALIZAR','acc_programa','Programa ID 18 actualizado','200.118.16.189','2026-01-15 02:18:28'),(121,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:18:37'),(122,1,'UPDATE','generos','Registro actualizado ID: 3','200.118.16.189','2026-01-15 02:18:44'),(123,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:18:44'),(124,1,'ACTUALIZAR','acc_programa','Programa ID 19 actualizado','200.118.16.189','2026-01-15 02:19:37'),(125,1,'ACTUALIZAR','acc_programa','Programa ID 33 actualizado','200.118.16.189','2026-01-15 02:20:16'),(126,1,'ACTUALIZAR','acc_programa','Programa ID 20 actualizado','200.118.16.189','2026-01-15 02:21:15'),(127,1,'ACTUALIZAR','acc_programa','Programa ID 25 actualizado','200.118.16.189','2026-01-15 02:21:41'),(128,1,'ACTUALIZAR','acc_programa','Programa ID 9 actualizado','200.118.16.189','2026-01-15 02:22:17'),(129,1,'VIEW','acciones_historial','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:22:23'),(130,1,'ACTUALIZAR','acc_programa','Programa ID 8 actualizado','200.118.16.189','2026-01-15 02:22:32'),(131,1,'ACTUALIZAR','acc_programa','Programa ID 22 actualizado','200.118.16.189','2026-01-15 02:22:53'),(132,1,'ACTUALIZAR','acc_programa','Programa ID 26 actualizado','200.118.16.189','2026-01-15 02:23:41'),(133,1,'ACTUALIZAR','acc_programa','Programa ID 21 actualizado','200.118.16.189','2026-01-15 02:24:19'),(134,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:24:24'),(135,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:25:39'),(136,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:25:53'),(137,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:25:58'),(138,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:00'),(139,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:03'),(140,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:29'),(141,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:33'),(142,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:34'),(143,1,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:35'),(144,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:37'),(145,1,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:40'),(146,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:42'),(147,1,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:43'),(148,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:45'),(149,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:47'),(150,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:50'),(151,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:51'),(152,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:26:53'),(153,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:02'),(154,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:25'),(155,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:26'),(156,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:27'),(157,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:28'),(158,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:30'),(159,1,'UPDATE','grupos_sanguineos','Registro actualizado ID: 9','200.118.16.189','2026-01-15 02:27:48'),(160,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:27:48'),(161,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:28'),(162,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:44'),(163,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:44'),(164,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:46'),(165,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:47'),(166,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:49'),(167,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:50'),(168,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:51'),(169,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:53'),(170,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:58'),(171,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:28:59'),(172,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:01'),(173,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:03'),(174,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:04'),(175,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:05'),(176,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:06'),(177,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:29:07'),(178,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:32:35'),(179,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:39'),(180,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:40'),(181,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:41'),(182,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:43'),(183,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:44'),(184,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:46'),(185,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:47'),(186,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:32:48'),(187,1,'ACTUALIZAR','acc_programa','Programa ID 16 actualizado','200.118.16.189','2026-01-15 02:35:32'),(188,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:35:35'),(189,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:42'),(190,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:44'),(191,1,'VIEW','generos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:46'),(192,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:47'),(193,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:48'),(194,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:50'),(195,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:51'),(196,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:52'),(197,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:35:58'),(198,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:08'),(199,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:11'),(200,1,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:12'),(201,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:13'),(202,1,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:15'),(203,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:17'),(204,1,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:18'),(205,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:20'),(206,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:22'),(207,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:23'),(208,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:25'),(209,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:26'),(210,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:48'),(211,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:49'),(212,1,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:50'),(213,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:36:52'),(214,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:03'),(215,1,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:04'),(216,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:10'),(217,1,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:10'),(218,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:19'),(219,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:26'),(220,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:28'),(221,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:30'),(222,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:32'),(223,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:37:59'),(224,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:43:11'),(225,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:43:17'),(226,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:49:26'),(227,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:30'),(228,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:31'),(229,1,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:33'),(230,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:34'),(231,1,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:36'),(232,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:38'),(233,1,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:39'),(234,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:41'),(235,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:43'),(236,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:44'),(237,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:46'),(238,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:49:48'),(239,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 16','200.118.16.189','2026-01-15 02:53:57'),(240,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 3. Total programas: 4','200.118.16.189','2026-01-15 02:54:57'),(241,1,'VIEW','acciones_historial','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 02:56:21'),(242,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 02:58:22'),(243,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:58:22'),(244,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 02:59:21'),(245,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 02:59:21'),(246,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 03:00:26'),(247,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 03:00:26'),(248,2,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:00:51'),(249,2,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:00:59'),(250,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:03'),(251,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:25'),(252,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:27'),(253,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:29'),(254,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:31'),(255,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:01:33'),(256,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 03:14:06'),(257,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 03:14:06'),(258,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:14:19'),(259,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:14:45'),(260,2,'UPDATE','estados_cita','Registro actualizado ID: 3','200.118.16.189','2026-01-15 03:14:57'),(261,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:14:57'),(262,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:15:06'),(263,2,'UPDATE','profesionales_salud','Registro actualizado ID: 2','200.118.16.189','2026-01-15 03:43:35'),(264,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:43:35'),(265,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 03:53:29'),(266,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:53:34'),(267,2,'UPDATE','profesionales_salud','Registro actualizado ID: 2','200.118.16.189','2026-01-15 03:53:52'),(268,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:53:52'),(269,2,'UPDATE','profesionales_salud','Registro actualizado ID: 3','200.118.16.189','2026-01-15 03:54:32'),(270,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:54:32'),(271,2,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:55:03'),(272,2,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:55:34'),(273,2,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:56:20'),(274,2,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:56:23'),(275,2,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:56:37'),(276,2,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:56:40'),(277,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 03:57:20'),(278,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 03:58:13'),(279,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 03:58:13'),(280,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 16','200.118.16.189','2026-01-15 03:58:40'),(281,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 16','200.118.16.189','2026-01-15 03:58:42'),(282,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 03:58:56'),(283,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 03:58:56'),(284,1,'ACTUALIZAR','acc_programa','Programa ID 11 actualizado','200.118.16.189','2026-01-15 04:00:11'),(285,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:00:21'),(286,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:00:54'),(287,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 04:01:24'),(288,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:01:24'),(289,1,'ACTUALIZAR','acc_programa','Programa ID 11 actualizado','200.118.16.189','2026-01-15 04:01:53'),(290,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:02:04'),(291,1,'ACTUALIZAR','acc_programa','Programa ID 11 actualizado','200.118.16.189','2026-01-15 04:02:40'),(292,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 17','200.118.16.189','2026-01-15 04:02:58'),(293,1,'ACTUALIZAR','acc_programa','Programa ID 11 actualizado','200.118.16.189','2026-01-15 04:03:15'),(294,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:03:20'),(295,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:03:22'),(296,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:03:22'),(297,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 04:03:41'),(298,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 04:03:41'),(299,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 04:06:45'),(300,2,'EXPORT','pacientes','Exportación a formato: excel','200.118.16.189','2026-01-15 04:06:58'),(301,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 12:58:15'),(302,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 12:58:53'),(303,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 12:58:54'),(304,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 13:00:03'),(305,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 13:09:46'),(306,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 13:09:55'),(307,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 13:10:09'),(308,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 13:10:47'),(309,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 13:14:07'),(310,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 13:14:22'),(311,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 20:16:17'),(312,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 20:42:24'),(313,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:42:27'),(314,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:02'),(315,1,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:04'),(316,1,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:05'),(317,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:06'),(318,1,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:09'),(319,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:10'),(320,1,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:11'),(321,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:13'),(322,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:14'),(323,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:15'),(324,1,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:18'),(325,1,'VIEW','usos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 20:43:20'),(326,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 21:09:58'),(327,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:10:01'),(328,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:10:12'),(329,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:10:24'),(330,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-15 21:10:36'),(331,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 21:10:36'),(332,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:11:19'),(333,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:11:34'),(334,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:13:32'),(335,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:13:36'),(336,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:19:24'),(337,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:19:41'),(338,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:19:47'),(339,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:20:12'),(340,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 21:26:02'),(341,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:26:04'),(342,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-15 21:26:14'),(343,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-15 21:27:09'),(344,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:20:20'),(345,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:20:26'),(346,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-16 02:20:42'),(347,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:20:56'),(348,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:21:35'),(349,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:21:54'),(350,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:21:54'),(351,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:29:40'),(352,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:29:46'),(353,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:30:07'),(354,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:30:07'),(355,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','200.118.16.189','2026-01-16 02:30:42'),(356,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','200.118.16.189','2026-01-16 02:30:47'),(357,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:31:47'),(358,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:31:47'),(359,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:31:52'),(360,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:31:57'),(361,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:32:08'),(362,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:32:08'),(363,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:32:10'),(364,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:33:18'),(365,1,'ACTUALIZAR','acc_programa','Programa ID 9 actualizado','200.118.16.189','2026-01-16 02:34:06'),(366,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:34:17'),(367,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:34:31'),(368,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:35:51'),(369,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:37:30'),(370,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:46:57'),(371,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:46:57'),(372,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:47:01'),(373,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:51:34'),(374,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:51:37'),(375,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 02:52:07'),(376,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 02:52:07'),(377,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:52:10'),(378,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:52:18'),(379,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:53:09'),(380,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 02:56:56'),(381,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 03:17:08'),(382,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 03:17:10'),(383,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 03:47:57'),(384,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 03:48:00'),(385,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 03:48:14'),(386,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 03:48:17'),(387,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:03:33'),(388,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:03:33'),(389,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:03:51'),(390,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:10'),(391,1,'VIEW','eps','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:16'),(392,1,'VIEW','estados_cita','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:19'),(393,1,'VIEW','materiales_lentes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:24'),(394,1,'VIEW','eps','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:27'),(395,1,'VIEW','medicamentos','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:32'),(396,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:37'),(397,1,'VIEW','parentescos','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:40'),(398,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:42'),(399,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:44'),(400,1,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:45'),(401,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:04:47'),(402,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:05:41'),(403,1,'UPDATE','tipos_identificacion','Registro actualizado ID: 6','10.1.10.129','2026-01-16 04:06:14'),(404,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:06:14'),(405,1,'UPDATE','tipos_identificacion','Registro actualizado ID: 6','10.1.10.129','2026-01-16 04:06:31'),(406,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:06:31'),(407,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:06:46'),(408,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:06:50'),(409,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:06:53'),(410,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:07:12'),(411,1,'UPDATE','profesionales_salud','Registro actualizado ID: 3','10.1.10.129','2026-01-16 04:07:52'),(412,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:07:52'),(413,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:09:38'),(414,1,'VIEW','tipos_lentes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:09:40'),(415,1,'VIEW','ocupaciones','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:09:43'),(416,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:09:55'),(417,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:16:58'),(418,2,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:16:59'),(419,2,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:17:15'),(420,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:17:55'),(421,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:17:55'),(422,1,'CREAR','acc_usuario','Usuario creado: sara','10.1.10.129','2026-01-16 04:18:49'),(423,3,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:20:21'),(424,3,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:20:21'),(425,3,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:20:25'),(426,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:21:14'),(427,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:21:14'),(428,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 3. Total programas: 4','10.1.10.129','2026-01-16 04:21:45'),(429,3,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:21:54'),(430,3,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:21:54'),(431,3,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 04:21:57'),(432,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 04:42:54'),(433,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 04:42:54'),(434,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 05:28:03'),(435,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 05:30:26'),(436,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 05:30:32'),(437,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 05:30:51'),(438,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-16 05:30:56'),(439,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-16 05:30:56'),(440,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-16 05:31:02'),(441,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:12:50'),(442,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:12:50'),(443,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:12:53'),(444,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:13:19'),(445,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:13:19'),(446,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:13:22'),(447,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:19:48'),(448,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:19:50'),(449,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:21:00'),(450,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:21:00'),(451,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:21:02'),(452,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:21:24'),(453,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:21:42'),(454,1,'UPDATE','tipos_identificacion','Registro actualizado ID: 6','200.118.16.189','2026-01-16 06:21:59'),(455,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:21:59'),(456,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:22:31'),(457,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:27:25'),(458,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:27:28'),(459,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:27:41'),(460,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:28:07'),(461,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:32:22'),(462,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:32:24'),(463,1,'UPDATE','anamnesis','Registro actualizado ID: 1','200.118.16.189','2026-01-16 06:33:14'),(464,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:33:17'),(465,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:33:27'),(466,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:33:47'),(467,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:33:47'),(468,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:33:50'),(469,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:35:43'),(470,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:35:43'),(471,1,'ACTUALIZAR','acc_usuario','Usuario ID  actualizado','200.118.16.189','2026-01-16 06:36:04'),(472,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','200.118.16.189','2026-01-16 06:36:29'),(473,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:37:06'),(474,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:37:06'),(475,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:37:08'),(476,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:43:44'),(477,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:43:44'),(478,1,'ACTUALIZAR','acc_programa','Programa ID 12 actualizado','200.118.16.189','2026-01-16 06:44:18'),(479,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:44:21'),(480,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:46:08'),(481,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:46:13'),(482,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 06:47:26'),(483,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:47:26'),(484,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:47:29'),(485,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:47:58'),(486,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:48:41'),(487,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 06:52:44'),(488,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 06:52:46'),(489,2,'CREATE','pacientes','Nuevo registro creado','200.118.16.189','2026-01-16 06:57:04'),(490,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:21:33'),(491,2,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:22:28'),(492,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:22:32'),(493,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:22:44'),(494,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:23:00'),(495,2,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:23:08'),(496,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:23:31'),(497,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:44:43'),(498,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:45:02'),(499,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:45:10'),(500,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:46:34'),(501,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 07:47:07'),(502,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 07:47:07'),(503,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:47:09'),(504,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:47:18'),(505,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 07:49:45'),(506,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 07:49:46'),(507,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:49:50'),(508,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:49:55'),(509,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:49:59'),(510,1,'UPDATE','anamnesis','Registro actualizado ID: 1','200.118.16.189','2026-01-16 07:50:22'),(511,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:50:26'),(512,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:50:39'),(513,1,'CREATE','pacientes','Nuevo registro creado','200.118.16.189','2026-01-16 07:52:42'),(514,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 07:53:08'),(515,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 15:37:33'),(516,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:37:35'),(517,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:37:56'),(518,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:38:02'),(519,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:38:22'),(520,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:38:40'),(521,1,'CREATE','pacientes','Nuevo registro creado','200.118.16.189','2026-01-16 15:46:05'),(522,1,'CREATE','anamnesis','Nuevo registro creado','200.118.16.189','2026-01-16 15:46:59'),(523,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:47:02'),(524,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:47:22'),(525,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:47:33'),(526,1,'UPDATE','anamnesis','Registro actualizado ID: 2','200.118.16.189','2026-01-16 15:48:03'),(527,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:48:05'),(528,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:50:36'),(529,1,'CREATE','anamnesis','Nuevo registro creado','200.118.16.189','2026-01-16 15:52:46'),(530,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:52:48'),(531,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:53:45'),(532,1,'CREATE','anamnesis','Nuevo registro creado','200.118.16.189','2026-01-16 15:56:36'),(533,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 15:56:37'),(534,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 16:02:58'),(535,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:03:01'),(536,1,'UPDATE','anamnesis','Registro actualizado ID: 3','200.118.16.189','2026-01-16 16:03:18'),(537,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:03:21'),(538,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:03:32'),(539,1,'UPDATE','anamnesis','Registro actualizado ID: 4','200.118.16.189','2026-01-16 16:04:14'),(540,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:04:16'),(541,1,'DELETE','anamnesis','Registro eliminado ID: 4','200.118.16.189','2026-01-16 16:04:40'),(542,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:04:40'),(543,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:15:22'),(544,1,'DELETE','anamnesis','Registro eliminado ID: 3','200.118.16.189','2026-01-16 16:15:35'),(545,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:15:35'),(546,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:16:13'),(547,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:16:20'),(548,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:16:29'),(549,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:16:59'),(550,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:18:28'),(551,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 16:26:39'),(552,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:26:49'),(553,1,'CREATE','anamnesis','Nuevo registro creado','200.118.16.189','2026-01-16 16:27:15'),(554,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:27:16'),(555,1,'CREATE','anamnesis','Nuevo registro creado','200.118.16.189','2026-01-16 16:27:49'),(556,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:27:51'),(557,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:28:03'),(558,1,'UPDATE','pacientes','Registro actualizado ID: 7','200.118.16.189','2026-01-16 16:28:15'),(559,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 16:28:15'),(560,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 19:08:18'),(561,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:08:18'),(562,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:08:21'),(563,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:08:56'),(564,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:09:41'),(565,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-16 19:10:04'),(566,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:10:04'),(567,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-16 19:10:26'),(568,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:10:26'),(569,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:10:55'),(570,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:26:58'),(571,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:27:23'),(572,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:29:07'),(573,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 19:29:51'),(574,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:29:51'),(575,1,'CREAR','acc_rol','Rol creado: Administrar Usuarios','200.118.16.189','2026-01-16 19:30:32'),(576,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 5. Total programas: 1','200.118.16.189','2026-01-16 19:30:57'),(577,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 19:32:28'),(578,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:32:29'),(579,2,'CREATE','citas_control','Nueva cita creada - Paciente ID: 2','200.118.16.189','2026-01-16 19:38:47'),(580,2,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','200.118.16.189','2026-01-16 19:41:00'),(581,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-16 19:41:22'),(582,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:41:22'),(583,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:41:53'),(584,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:45:18'),(585,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:45:22'),(586,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:45:56'),(587,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:46:01'),(588,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:46:52'),(589,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 19:55:05'),(590,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:55:07'),(591,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:55:47'),(592,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 19:56:10'),(593,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:20:21'),(594,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:23'),(595,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:25'),(596,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:26'),(597,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:27'),(598,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:28'),(599,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:28'),(600,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:29'),(601,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:29'),(602,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:20:30'),(603,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:20:38'),(604,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:21:02'),(605,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-16 21:21:21'),(606,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:21:21'),(607,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:21:30'),(608,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:24:18'),(609,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:25:58'),(610,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:26:10'),(611,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:36:46'),(612,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:37:43'),(613,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:38:00'),(614,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:39:13'),(615,2,'UPDATE','anamnesis','Registro actualizado ID: 2','200.118.16.189','2026-01-16 21:39:35'),(616,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:39:37'),(617,2,'UPDATE','anamnesis','Registro actualizado ID: 2','200.118.16.189','2026-01-16 21:39:51'),(618,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:39:52'),(619,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-16 21:39:57'),(620,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:39:57'),(621,2,'UPDATE','anamnesis','Registro actualizado ID: 6','200.118.16.189','2026-01-16 21:41:16'),(622,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:41:17'),(623,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:41:46'),(624,2,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 21:48:51'),(625,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-16 21:57:39'),(626,2,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 22:11:29'),(627,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-16 22:32:46'),(628,2,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 02:48:07'),(629,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 02:48:11'),(630,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 02:48:24'),(631,2,'CREATE','citas_control','Nueva cita creada - Paciente ID: 1','200.118.16.189','2026-01-17 02:54:07'),(632,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 02:54:41'),(633,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 02:55:34'),(634,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:08:29'),(635,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:09:11'),(636,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:09:22'),(637,2,'UPDATE','pacientes','Registro actualizado ID: 2','200.118.16.189','2026-01-17 03:09:42'),(638,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:09:42'),(639,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:17:54'),(640,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:19:53'),(641,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:24:23'),(642,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:28:43'),(643,2,'UPDATE','citas_control','Cita actualizada ID: 1','200.118.16.189','2026-01-17 03:29:05'),(644,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:29:18'),(645,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:29:40'),(646,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:31:44'),(647,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:33:04'),(648,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:35:25'),(649,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:41:00'),(650,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:41:03'),(651,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:41:16'),(652,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:41:28'),(653,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:45:34'),(654,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 03:45:38'),(655,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:45:41'),(656,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:46:29'),(657,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:46:37'),(658,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:46:43'),(659,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 03:46:52'),(660,2,'UPDATE','citas_control','Cita actualizada ID: 1','200.118.16.189','2026-01-17 03:48:47'),(661,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:49:37'),(662,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-17 03:50:03'),(663,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:50:06'),(664,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-17 03:50:16'),(665,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:50:18'),(666,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-17 03:50:31'),(667,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:50:33'),(668,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-17 03:50:47'),(669,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:50:49'),(670,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-17 03:52:04'),(671,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-17 03:52:05'),(672,2,'VIEW','pacientes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 13:49:21'),(673,2,'VIEW','pacientes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 13:49:22'),(674,2,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','179.19.95.31','2026-01-17 13:50:08'),(675,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','179.19.95.31','2026-01-17 13:50:46'),(676,2,'VIEW','ACC_MENU','Apertura del Menú Principal','179.19.95.31','2026-01-17 13:50:46'),(677,2,'VIEW','pacientes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 13:50:50'),(678,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 13:54:01'),(679,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 13:59:26'),(680,2,'EXPORT','diagnosticos_cie10','Exportación a formato: excel','179.19.95.31','2026-01-17 14:02:59'),(681,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:03:56'),(682,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 50','179.19.95.31','2026-01-17 14:04:09'),(683,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:09'),(684,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 51','179.19.95.31','2026-01-17 14:04:14'),(685,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:14'),(686,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 52','179.19.95.31','2026-01-17 14:04:19'),(687,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:19'),(688,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 53','179.19.95.31','2026-01-17 14:04:23'),(689,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:23'),(690,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 54','179.19.95.31','2026-01-17 14:04:32'),(691,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:32'),(692,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 54','179.19.95.31','2026-01-17 14:04:32'),(693,2,'UPDATE','diagnosticos_cie10','Registro actualizado ID: 55','179.19.95.31','2026-01-17 14:04:39'),(694,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:04:39'),(695,2,'VIEW','pacientes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:05:36'),(696,2,'VIEW','ACC_MENU','Apertura del Menú Principal','179.19.95.31','2026-01-17 14:08:38'),(697,2,'VIEW','pacientes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:03'),(698,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:24'),(699,2,'VIEW','estados_cita','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:38'),(700,2,'VIEW','materiales_lentes','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:41'),(701,2,'VIEW','ocupaciones','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:44'),(702,2,'VIEW','parentescos','Acceso a la pantalla de listado','179.19.95.31','2026-01-17 14:09:46'),(703,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 19:16:26'),(704,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:17:02'),(705,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:17:53'),(706,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:17:58'),(707,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:04'),(708,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:10'),(709,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:23'),(710,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:28'),(711,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:43'),(712,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:57'),(713,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:18:59'),(714,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:19:00'),(715,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:19:03'),(716,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:19:04'),(717,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:32:55'),(718,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:33:02'),(719,2,'UPDATE','pacientes','Registro actualizado ID: 2','200.118.16.189','2026-01-17 19:33:23'),(720,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:33:23'),(721,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:33:31'),(722,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:33:34'),(723,2,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 5. Total programas: 1','200.118.16.189','2026-01-17 19:34:18'),(724,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-17 19:34:54'),(725,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-17 19:35:57'),(726,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-17 19:35:58'),(727,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-18 13:12:55'),(728,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-18 13:13:00'),(729,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-18 13:13:03'),(730,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:14:15'),(731,2,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:17:53'),(732,2,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:18:06'),(733,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:18:41'),(734,2,'VIEW','materiales_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:18:48'),(735,2,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:18:55'),(736,2,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:19:07'),(737,2,'UPDATE','ocupaciones','Registro actualizado ID: 11','200.118.16.189','2026-01-18 13:19:25'),(738,2,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:19:25'),(739,2,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:20:55'),(740,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:21:01'),(741,2,'VIEW','tipos_lentes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:22:15'),(742,2,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:22:33'),(743,2,'VIEW','tipos_profesional','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:23:28'),(744,2,'VIEW','tipos_consulta','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:23:44'),(745,2,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:23:49'),(746,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:24:02'),(747,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-18 13:24:37'),(748,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:24:37'),(749,2,'UPDATE','anamnesis','Registro actualizado ID: 2','200.118.16.189','2026-01-18 13:25:39'),(750,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:25:43'),(751,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:25:57'),(752,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:26:16'),(753,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:26:39'),(754,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:26:52'),(755,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 13:27:31'),(756,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:31:12'),(757,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:32:11'),(758,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:33:12'),(759,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:04'),(760,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:06'),(761,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:07'),(762,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:09'),(763,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:12'),(764,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:28'),(765,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:37'),(766,2,'UPDATE','pacientes','Registro actualizado ID: 7','200.118.16.189','2026-01-18 22:34:50'),(767,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 22:34:50'),(768,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-18 23:43:50'),(769,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-18 23:44:25'),(770,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-18 23:49:46'),(771,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-18 23:51:24'),(772,2,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-18 23:51:37'),(773,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 13:37:53'),(774,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-19 21:23:26'),(775,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-19 21:23:27'),(776,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-19 21:23:29'),(777,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-19 21:23:30'),(778,1,'VIEW','diagnosticos_cie10','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:23:59'),(779,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:24:41'),(780,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:35:38'),(781,1,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:47:40'),(782,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:47:54'),(783,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:48:01'),(784,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 1. Total programas: 34','200.118.16.189','2026-01-19 21:48:33'),(785,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-19 21:48:49'),(786,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-19 21:48:49'),(787,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:49:07'),(788,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 21:49:50'),(789,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-19 21:52:39'),(790,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-19 21:52:39'),(791,1,'VIEW','citas_control','Acceso a la pantalla de listado de citas','200.118.16.189','2026-01-19 21:59:20'),(792,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-19 21:59:57'),(793,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-19 21:59:57'),(794,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 22:00:27'),(795,2,'VIEW','medicamentos','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 22:04:04'),(796,2,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-19 22:04:06'),(797,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-22 02:26:24'),(798,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-22 02:26:25'),(799,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-22 02:26:49'),(800,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-22 02:27:11'),(801,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-22 02:29:03'),(802,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-22 02:29:30'),(803,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 03:45:44'),(804,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 03:45:45'),(805,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 04:18:29'),(806,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 04:18:29'),(807,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 04:18:47'),(808,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 04:30:50'),(809,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 04:31:50'),(810,2,'UPDATE','estados_cita','Registro actualizado ID: 2','200.118.16.189','2026-01-24 04:33:08'),(811,2,'VIEW','estados_cita','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 04:33:08'),(812,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 05:46:42'),(813,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 05:46:46'),(814,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 05:46:52'),(815,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 05:51:45'),(816,1,'CREAR','acc_programa','Programa creado: Historia Clínica','200.118.16.189','2026-01-24 05:55:09'),(817,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 1. Total programas: 35','200.118.16.189','2026-01-24 05:55:37'),(818,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 19','200.118.16.189','2026-01-24 05:56:09'),(819,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 05:56:49'),(820,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 05:56:59'),(821,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 05:57:18'),(822,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 05:57:18'),(823,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 05:57:23'),(824,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 05:58:15'),(825,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 06:06:09'),(826,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:06:14'),(827,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 06:06:26'),(828,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 7','200.118.16.189','2026-01-24 06:08:24'),(829,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 06:15:36'),(830,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:15:46'),(831,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 7','200.118.16.189','2026-01-24 06:15:52'),(832,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:19:35'),(833,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 06:19:40'),(834,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:20:37'),(835,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:21:47'),(836,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 8','200.118.16.189','2026-01-24 06:21:51'),(837,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:23:55'),(838,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 06:24:00'),(839,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 06:30:07'),(840,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:30:11'),(841,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 8','200.118.16.189','2026-01-24 06:30:14'),(842,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:30:22'),(843,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 06:30:26'),(844,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:31:43'),(845,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 06:31:46'),(846,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:32:09'),(847,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:33:05'),(848,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 06:33:12'),(849,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:38:20'),(850,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 06:38:24'),(851,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:38:39'),(852,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 06:38:46'),(853,1,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-24 06:47:07'),(854,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 06:47:27'),(855,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 06:47:37'),(856,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 07:04:30'),(857,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:04:33'),(858,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 07:04:38'),(859,1,'EMAIL','pacientes','Envió historia clínica por correo a: carloseduardomejia@gmail.com,pouyer01@gmail.com, pouyer07@gmail.com','200.118.16.189','2026-01-24 07:07:32'),(860,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:10:37'),(861,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:10:42'),(862,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:10:52'),(863,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 18','200.118.16.189','2026-01-24 07:12:20'),(864,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 07:12:35'),(865,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 07:12:35'),(866,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:12:39'),(867,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 07:12:54'),(868,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 07:12:54'),(869,1,'ACTUALIZAR','roles_x_programa','Permisos actualizados para Rol ID 4. Total programas: 19','200.118.16.189','2026-01-24 07:13:12'),(870,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 07:13:29'),(871,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 07:13:29'),(872,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:13:33'),(873,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:16:36'),(874,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:16:43'),(875,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:17:34'),(876,2,'CREATE','citas_control','Nueva cita creada - Paciente ID: 2','200.118.16.189','2026-01-24 07:27:07'),(877,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:27:25'),(878,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:27:28'),(879,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:29:47'),(880,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:33:10'),(881,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:33:14'),(882,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:33:41'),(883,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:33:43'),(884,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:34:14'),(885,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:34:22'),(886,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 07:40:21'),(887,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 07:40:21'),(888,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:40:38'),(889,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:40:56'),(890,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:41:05'),(891,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 07:41:08'),(892,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:41:13'),(893,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:42:58'),(894,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 07:43:03'),(895,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:45:55'),(896,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:46:22'),(897,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:46:57'),(898,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:47:07'),(899,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:47:24'),(900,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:48:35'),(901,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:48:46'),(902,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:49:13'),(903,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:50:29'),(904,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 07:50:34'),(905,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 07:50:41'),(906,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:15:24'),(907,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:15:27'),(908,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 08:15:33'),(909,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:15:56'),(910,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:16:04'),(911,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 08:16:08'),(912,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:18:52'),(913,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:18:56'),(914,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 08:18:59'),(915,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:19:30'),(916,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 08:19:34'),(917,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:20:43'),(918,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 8','200.118.16.189','2026-01-24 08:20:48'),(919,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:21:17'),(920,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:21:17'),(921,1,'ACTUALIZAR','acc_usuario','Usuario ID  actualizado','200.118.16.189','2026-01-24 08:21:31'),(922,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:21:59'),(923,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:21:59'),(924,1,'ACTUALIZAR','acc_usuario','Usuario ID  actualizado','200.118.16.189','2026-01-24 08:22:18'),(925,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:23:32'),(926,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:23:32'),(927,1,'ACTUALIZAR','acc_usuario','Usuario ID  actualizado','200.118.16.189','2026-01-24 08:23:51'),(928,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:31:42'),(929,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:31:43'),(930,1,'ACTUALIZAR','acc_usuario','Usuario ID 3 actualizado','200.118.16.189','2026-01-24 08:31:55'),(931,3,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:32:14'),(932,3,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:32:14'),(933,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:32:17'),(934,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 08:32:55'),(935,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 08:32:55'),(936,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:33:14'),(937,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 08:34:10'),(938,2,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:36:21'),(939,3,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:37:00'),(940,3,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:37:09'),(941,3,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:37:18'),(942,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 08:37:30'),(943,3,'UPDATE','pacientes','Registro actualizado ID: 7','200.118.16.189','2026-01-24 14:19:48'),(944,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:19:48'),(945,3,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:21:39'),(946,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:21:40'),(947,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:22:12'),(948,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:22:22'),(949,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:23:13'),(950,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:23:56'),(951,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 8','200.118.16.189','2026-01-24 14:24:46'),(952,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:26:18'),(953,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 14:26:23'),(954,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:33:23'),(955,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:34:21'),(956,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 14:34:25'),(957,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:40:14'),(958,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:40:15'),(959,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:40:16'),(960,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:40:16'),(961,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:40:18'),(962,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 14:40:21'),(963,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:48:41'),(964,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:48:42'),(965,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:48:44'),(966,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 14:48:47'),(967,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 14:51:34'),(968,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 14:51:36'),(969,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 15:29:58'),(970,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 15:30:01'),(971,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 15:30:04'),(972,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 15:30:07'),(973,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 15:32:50'),(974,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 15:36:27'),(975,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 15:36:30'),(976,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 15:39:19'),(977,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 15:39:22'),(978,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 15:39:24'),(979,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:00:40'),(980,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:00:43'),(981,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:00:48'),(982,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:07:36'),(983,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:07:38'),(984,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:07:41'),(985,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:12:26'),(986,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:12:29'),(987,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 16:12:36'),(988,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:13:11'),(989,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:13:11'),(990,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:13:14'),(991,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 16:13:16'),(992,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:13:55'),(993,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 16:14:10'),(994,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:14:10'),(995,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:14:15'),(996,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-24 16:14:17'),(997,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:15:05'),(998,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:15:24'),(999,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-24 16:18:00'),(1000,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:18:01'),(1001,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:18:07'),(1002,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 7','200.118.16.189','2026-01-24 16:18:13'),(1003,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:21:47'),(1004,2,'UPDATE','anamnesis','Registro actualizado ID: 6','200.118.16.189','2026-01-24 16:22:08'),(1005,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:22:11'),(1006,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 7','200.118.16.189','2026-01-24 16:22:14'),(1007,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyerdev@gmail.com,pouyer01@gmail.com','200.118.16.189','2026-01-24 16:24:26'),(1008,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyerdev@gmail.com,pouyer01@gmail.com','200.118.16.189','2026-01-24 16:29:27'),(1009,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyerdev@gmail.com','200.118.16.189','2026-01-24 16:32:17'),(1010,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:32:50'),(1011,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:32:55'),(1012,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:33:00'),(1013,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:33:11'),(1014,2,'UPDATE','pacientes','Registro actualizado ID: 2','200.118.16.189','2026-01-24 16:33:27'),(1015,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:33:27'),(1016,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:33:33'),(1017,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyer07@gmail.com,pouyer01@gmail.com','200.118.16.189','2026-01-24 16:33:56'),(1018,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:43:49'),(1019,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:43:54'),(1020,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:44:14'),(1021,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyer07@gmail.com,pouyer01@gmail.com','200.118.16.189','2026-01-24 16:44:34'),(1022,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:48:58'),(1023,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:49:01'),(1024,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 7','200.118.16.189','2026-01-24 16:49:06'),(1025,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyerdev@gmail.com','200.118.16.189','2026-01-24 16:49:14'),(1026,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-24 16:55:53'),(1027,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:55:55'),(1028,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:55:58'),(1029,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-24 16:56:18'),(1030,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-24 16:56:24'),(1031,2,'EMAIL','pacientes','Envió historia clínica por correo a: pouyer07@gmail.com,pouyer01@gmail.com','200.118.16.189','2026-01-24 16:56:40'),(1032,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:02:36'),(1033,2,'UPDATE','pacientes','Registro actualizado ID: 2','200.118.16.189','2026-01-25 23:04:46'),(1034,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:04:47'),(1035,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-25 23:05:01'),(1036,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:06:22'),(1037,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:06:23'),(1038,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:10:23'),(1039,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:10:31'),(1040,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-25 23:16:33'),(1041,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-25 23:16:34'),(1042,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-25 23:27:29'),(1043,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:27:33'),(1044,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:27:57'),(1045,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:28:07'),(1046,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-25 23:55:38'),(1047,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-25 23:55:44'),(1048,2,'UPDATE','pacientes','Registro actualizado ID: 1','200.118.16.189','2026-01-26 00:01:23'),(1049,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 00:01:23'),(1050,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 00:02:46'),(1051,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 00:08:51'),(1052,2,'UPDATE','anamnesis','Registro actualizado ID: 1','200.118.16.189','2026-01-26 00:10:47'),(1053,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 00:10:53'),(1054,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-26 00:11:03'),(1055,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-26 00:25:10'),(1056,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-26 00:33:16'),(1057,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-26 00:33:16'),(1058,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-26 01:25:43'),(1059,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-26 01:25:43'),(1060,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:26:20'),(1061,2,'UPDATE','citas_control','Cita actualizada ID: 2','200.118.16.189','2026-01-26 01:26:45'),(1062,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 01:27:04'),(1063,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-26 01:27:17'),(1064,2,'VIEW','profesionales_salud','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 01:30:18'),(1065,1,'VIEW','generos','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:30:39'),(1066,1,'VIEW','tipos_identificacion','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:30:43'),(1067,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:30:51'),(1068,1,'VIEW','tipos_diabetes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:07'),(1069,1,'VIEW','tipos_consulta','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:10'),(1070,1,'VIEW','grupos_sanguineos','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:13'),(1071,1,'VIEW','generos','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:16'),(1072,1,'VIEW','frecuencias_consumo','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:18'),(1073,1,'VIEW','estados_paciente','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:20'),(1074,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:24'),(1075,1,'VIEW','estados_civiles','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 01:31:27'),(1076,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','10.1.10.129','2026-01-26 02:00:03'),(1077,1,'VIEW','ACC_MENU','Apertura del Menú Principal','10.1.10.129','2026-01-26 02:00:03'),(1078,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 02:00:32'),(1079,1,'CREATE','pacientes','Nuevo registro creado','10.1.10.129','2026-01-26 02:04:36'),(1080,1,'CREATE','anamnesis','Nuevo registro creado','10.1.10.129','2026-01-26 02:05:08'),(1081,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 02:05:11'),(1082,1,'UPDATE','pacientes','Registro actualizado ID: 9','10.1.10.129','2026-01-26 02:05:18'),(1083,1,'VIEW','pacientes','Acceso a la pantalla de listado','10.1.10.129','2026-01-26 02:05:18'),(1084,1,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 9','10.1.10.129','2026-01-26 02:05:29'),(1085,1,'EMAIL','pacientes','Envió historia clínica por correo a: ftorres_e@hotmail.com,t_donado@hotmail.com','10.1.10.129','2026-01-26 02:07:09'),(1086,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 17:09:13'),(1087,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 17:09:15'),(1088,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:09:22'),(1089,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 1','200.118.16.189','2026-01-26 17:11:01'),(1090,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:11:08'),(1091,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 9','200.118.16.189','2026-01-26 17:12:24'),(1092,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:13:23'),(1093,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 17:32:19'),(1094,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:32:20'),(1095,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 17:36:38'),(1096,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:36:44'),(1097,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 17:51:50'),(1098,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:51:55'),(1099,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:54:48'),(1100,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 8','200.118.16.189','2026-01-26 17:54:57'),(1101,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:55:06'),(1102,2,'UPDATE','pacientes','Registro actualizado ID: 9','200.118.16.189','2026-01-26 17:55:21'),(1103,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:55:23'),(1104,2,'UPDATE','pacientes','Registro actualizado ID: 8','200.118.16.189','2026-01-26 17:55:49'),(1105,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:55:49'),(1106,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 9','200.118.16.189','2026-01-26 17:56:34'),(1107,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 17:57:02'),(1108,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:32:33'),(1109,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 18:45:41'),(1110,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 18:45:41'),(1111,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:45:59'),(1112,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:46:26'),(1113,1,'UPDATE','paises','Registro actualizado ID: 98','200.118.16.189','2026-01-26 18:46:53'),(1114,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:46:53'),(1115,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:47:19'),(1116,1,'UPDATE','paises','Registro actualizado ID: 110','200.118.16.189','2026-01-26 18:47:27'),(1117,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:47:27'),(1118,1,'UPDATE','paises','Registro actualizado ID: 227','200.118.16.189','2026-01-26 18:47:33'),(1119,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:47:33'),(1120,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:48:53'),(1121,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:48:55'),(1122,1,'VIEW','paises','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:49:02'),(1123,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:49:47'),(1124,1,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:50:00'),(1125,1,'VIEW','anamnesis','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:50:10'),(1126,1,'ACTUALIZAR','acc_programa','Programa ID 38 actualizado','200.118.16.189','2026-01-26 18:51:58'),(1127,1,'ACTUALIZAR','acc_programa','Programa ID 38 actualizado','200.118.16.189','2026-01-26 18:52:28'),(1128,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 18:52:34'),(1129,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 18:55:14'),(1130,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 18:55:14'),(1131,3,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 18:57:12'),(1132,3,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 18:57:13'),(1133,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 18:57:24'),(1134,3,'CREATE','pacientes','Nuevo registro creado','200.118.16.189','2026-01-26 19:02:58'),(1135,3,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:03:00'),(1136,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:03:12'),(1137,2,'ACTUALIZAR','acc_usuario','Usuario ID 3 actualizado','200.118.16.189','2026-01-26 19:06:17'),(1138,3,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:09:32'),(1139,2,'ACTUALIZAR','acc_usuario','Usuario ID 3 actualizado','200.118.16.189','2026-01-26 19:10:19'),(1140,3,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 19:10:38'),(1141,3,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:10:38'),(1142,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:27:19'),(1143,3,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:27:20'),(1144,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:27:25'),(1145,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:27:34'),(1146,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:27:44'),(1147,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:27:46'),(1148,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 10','200.118.16.189','2026-01-26 19:49:06'),(1149,1,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 19:50:04'),(1150,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:50:04'),(1151,1,'ACTUALIZAR','acc_modulo','Módulo ID 101 actualizado','200.118.16.189','2026-01-26 19:50:25'),(1152,1,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:50:29'),(1153,2,'LOGIN','acc_usuario','Inicio de sesión exitoso','200.118.16.189','2026-01-26 19:50:51'),(1154,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 19:50:51'),(1155,2,'VIEW','tipos_origen_enfermedad','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:52:03'),(1156,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:52:34'),(1157,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 9','200.118.16.189','2026-01-26 19:52:38'),(1158,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:53:28'),(1159,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:53:33'),(1160,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:53:52'),(1161,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:53:54'),(1162,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:54:02'),(1163,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:54:06'),(1164,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:54:18'),(1165,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:54:21'),(1166,2,'EXPORT','pacientes','Exportación a formato: excel','200.118.16.189','2026-01-26 19:54:55'),(1167,3,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:56:46'),(1168,3,'VIEW','eps','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:56:47'),(1169,3,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:56:51'),(1170,3,'VIEW','ocupaciones','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:57:47'),(1171,3,'VIEW','parentescos','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 19:57:50'),(1172,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:22:15'),(1173,3,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:22:29'),(1174,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:22:45'),(1175,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-26 20:22:54'),(1176,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:25:21'),(1177,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:25:26'),(1178,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 20:45:56'),(1179,2,'EXPORT','pacientes','Exportación a formato: excel','200.118.16.189','2026-01-26 20:46:03'),(1180,2,'VIEW','ACC_MENU','Apertura del Menú Principal','200.118.16.189','2026-01-26 21:01:19'),(1181,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 21:01:21'),(1182,2,'EXPORT','pacientes','Exportación a formato: excel','200.118.16.189','2026-01-26 21:01:24'),(1183,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-26 21:03:54'),(1184,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 21:04:39'),(1185,2,'REPORT','pacientes','Generó reporte de historia clínica para paciente ID: 2','200.118.16.189','2026-01-26 21:04:45'),(1186,2,'VIEW','pacientes','Acceso a la pantalla de listado','200.118.16.189','2026-01-26 21:06:44');
/*!40000 ALTER TABLE `acc_log_accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_modulo`
--

DROP TABLE IF EXISTS `acc_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_modulo` (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(125) DEFAULT NULL,
  `icono` varchar(125) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_modulo`
--

LOCK TABLES `acc_modulo` WRITE;
/*!40000 ALTER TABLE `acc_modulo` DISABLE KEYS */;
INSERT INTO `acc_modulo` VALUES (1,'Seguridad y Accesos','icon-lock-filled',100,'activo',NULL,'2026-01-14 20:38:06',NULL,NULL),(101,'Nuevos CRUDs','icon-plus-circled',999,'inactivo',NULL,'2026-01-14 20:38:14',1,'2026-01-26 19:50:24'),(102,'Administrador','icon-flow-parallel',30,'activo',1,'2026-01-15 01:49:16',NULL,NULL),(103,'Parametros','icon-params',40,'activo',1,'2026-01-15 01:49:46',1,'2026-01-15 01:50:14'),(104,'Registro Pacientes','icon-address-book-1',10,'activo',1,'2026-01-15 01:53:35',1,'2026-01-15 01:54:10'),(105,'Control Citas','icon-glasses',20,'activo',1,'2026-01-15 01:54:46',NULL,NULL),(106,'Reportes','icon-newspaper-1',50,'activo',1,'2026-01-15 01:56:05',NULL,NULL);
/*!40000 ALTER TABLE `acc_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_programa`
--

DROP TABLE IF EXISTS `acc_programa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_programa` (
  `id_programas` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int DEFAULT NULL,
  `nombre_menu` varchar(128) DEFAULT NULL,
  `icono` varchar(125) DEFAULT NULL,
  `ruta` varchar(250) DEFAULT NULL,
  `nombre_archivo` varchar(150) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_programas`),
  KEY `programas_id_modulo_fk` (`id_modulo`),
  CONSTRAINT `programas_id_modulo_fk` FOREIGN KEY (`id_modulo`) REFERENCES `acc_modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_programa`
--

LOCK TABLES `acc_programa` WRITE;
/*!40000 ALTER TABLE `acc_programa` DISABLE KEYS */;
INSERT INTO `acc_programa` VALUES (1,1,'Modulos','icon-cubes','/opticahogar/accesos/vistas','vista_acc_modulo.php',1,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(2,1,'Roles','icon-users','/opticahogar/accesos/vistas','vista_acc_rol.php',2,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(3,1,'Usuarios','icon-vcard','/opticahogar/accesos/vistas','vista_acc_usuario.php',3,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(4,1,'Programas','icon-desktop','/opticahogar/accesos/vistas','vista_acc_programa.php',4,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-26 18:45:03'),(5,1,'Programas por Rol','icon-th-list-outline','/opticahogar/accesos/vistas','vista_roles_programas.php',5,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(6,1,'Estados','icon-check-outline','/opticahogar/accesos/vistas','vista_acc_estado.php',6,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(7,1,'Log de Acciones','icon-history','/opticahogar/accesos/vistas','vista_acc_log.php',7,'activo',NULL,'2026-01-14 20:38:07',NULL,'2026-01-14 20:38:13'),(8,101,'Acciones Historial','icon-dot-circled','/opticahogar/vistas','vista_acciones_historial.php',NULL,'inactivo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 02:22:32'),(9,101,'Anamnesis','icon-dot-circled','/opticahogar/vistas','vista_anamnesis.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-16 02:34:06'),(10,101,'Antecedentes Medicos','icon-dot-circled','/opticahogar/vistas','vista_antecedentes_medicos.php',NULL,'inactivo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 02:16:29'),(11,101,'Cita','icon-dot-circled','/opticahogar/vistas','vista_cita.php',NULL,'inactivo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 04:03:15'),(12,105,'Examen Fisico','icon-glasses','/opticahogar/vistas','vista_cita_listado.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-16 06:44:18'),(13,102,'Diagnosticos Cie10','icon-align-left','/opticahogar/vistas','vista_diagnosticos_cie10.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(14,102,'Eps','icon-medkit','/opticahogar/vistas','vista_eps.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(15,102,'Estados Cita','icon-list-nested','/opticahogar/vistas','vista_estados_cita.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(16,103,'Estados Civiles','icon-american-sign-language-interpreting','/opticahogar/vistas','vista_estados_civiles.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(17,103,'Estados Paciente','icon-dot-circled','/opticahogar/vistas','vista_estados_paciente.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(18,103,'Frecuencias Consumo','icon-dot-circled','/opticahogar/vistas','vista_frecuencias_consumo.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(19,103,'Generos','icon-transgender','/opticahogar/vistas','vista_generos.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(20,103,'Grupos Sanguineos','icon-universal-access-1','/opticahogar/vistas','vista_grupos_sanguineos.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(21,102,'Materiales Lentes','icon-magnet-1','/opticahogar/vistas','vista_materiales_lentes.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(22,102,'Medicamentos','icon-medkit','/opticahogar/vistas','vista_medicamentos.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(23,102,'Ocupaciones','icon-user-woman','/opticahogar/vistas','vista_ocupaciones.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:10'),(24,104,'Pacientes','icon-adult','/opticahogar/vistas','vista_pacientes.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(25,102,'Parentescos','icon-500px','/opticahogar/vistas','vista_parentescos.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(26,102,'Profesionales Salud','icon-graduation-cap-2','/opticahogar/vistas','vista_profesionales_salud.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(27,103,'Tipos Consulta','icon-dot-circled','/opticahogar/vistas','vista_tipos_consulta.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(28,103,'Tipos Diabetes','icon-dot-circled','/opticahogar/vistas','vista_tipos_diabetes.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(29,103,'Tipos Identificacion','icon-info-1','/opticahogar/vistas','vista_tipos_identificacion.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(30,102,'Tipos Lentes','icon-emo-sunglasses','/opticahogar/vistas','vista_tipos_lentes.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(31,102,'Tipos Origen Enfermedad','icon-hospital','/opticahogar/vistas','vista_tipos_origen_enfermedad.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(32,102,'Tipos Profesional','icon-pinterest-circled-2','/opticahogar/vistas','vista_tipos_profesional.php',NULL,'activo',NULL,'2026-01-14 20:38:14',1,'2026-01-15 20:42:11'),(33,102,'Usos Lentes','icon-emo-sunglasses','/opticahogar/vistas','vista_usos_lentes.php',NULL,'activo',NULL,'2026-01-14 20:38:15',1,'2026-01-15 20:42:11'),(34,101,'Crear Anamnesis','icon-dot-circled','/opticahogar/vistas','vista_crear_anamnesis.php',NULL,'activo',NULL,'2026-01-15 13:12:44',NULL,'2026-01-15 13:12:44'),(35,101,'Historia Clínica','icon-medkit','/opticahogar/vistas','vista_historia_clinica_reporte.php',1,'activo',1,'2026-01-24 05:55:08',NULL,NULL),(36,101,'Editar Anamnesis','icon-dot-circled','/opticahogar/vistas','vista_editar_anamnesis.php',NULL,'activo',NULL,'2026-01-26 18:45:02',NULL,NULL),(37,101,'Pacientes20260124','icon-dot-circled','/opticahogar/vistas','vista_pacientes20260124.php',NULL,'activo',NULL,'2026-01-26 18:45:02',NULL,NULL),(38,103,'Paises','icon-globe-6','/opticahogar/vistas','vista_paises.php',NULL,'activo',NULL,'2026-01-26 18:45:02',1,'2026-01-26 18:52:28');
/*!40000 ALTER TABLE `acc_programa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_programa_x_rol`
--

DROP TABLE IF EXISTS `acc_programa_x_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_programa_x_rol` (
  `id_programas` int NOT NULL,
  `id_rol` int NOT NULL,
  `permiso_insertar` tinyint DEFAULT '0',
  `permiso_actualizar` tinyint DEFAULT '0',
  `permiso_eliminar` tinyint DEFAULT '0',
  `permiso_exportar` tinyint DEFAULT '0',
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_programas`,`id_rol`),
  KEY `programa_x_rol_id_rol_fk` (`id_rol`),
  CONSTRAINT `programa_x_rol_id_programas_fk` FOREIGN KEY (`id_programas`) REFERENCES `acc_programa` (`id_programas`),
  CONSTRAINT `programa_x_rol_id_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `acc_rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_programa_x_rol`
--

LOCK TABLES `acc_programa_x_rol` WRITE;
/*!40000 ALTER TABLE `acc_programa_x_rol` DISABLE KEYS */;
INSERT INTO `acc_programa_x_rol` VALUES (1,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(1,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(2,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(2,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(3,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(3,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(3,5,1,1,0,1,2,'2026-01-17 19:34:18',NULL,NULL),(4,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(4,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(5,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(5,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(6,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(6,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(7,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(7,2,1,1,1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(8,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(9,1,1,1,0,1,1,'2026-01-24 05:55:36',NULL,NULL),(10,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(11,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(11,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(12,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(12,4,1,0,0,1,1,'2026-01-24 07:13:12',NULL,NULL),(13,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(13,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(14,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(14,3,1,1,0,1,1,'2026-01-16 04:21:45',NULL,NULL),(14,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(15,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(15,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(16,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(17,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(18,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(19,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(20,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(21,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(21,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(22,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(22,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(23,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(23,3,1,1,1,1,1,'2026-01-16 04:21:45',NULL,NULL),(23,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(24,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(24,3,1,1,0,1,1,'2026-01-16 04:21:45',NULL,NULL),(24,4,1,1,0,1,1,'2026-01-24 07:13:12',NULL,NULL),(25,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(25,3,1,1,1,1,1,'2026-01-16 04:21:45',NULL,NULL),(25,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(26,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(26,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(27,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(27,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(28,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(28,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(29,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(30,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(30,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(31,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(31,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(32,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(32,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(33,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(33,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(34,1,1,1,0,1,1,'2026-01-24 05:55:36',NULL,NULL),(34,4,1,1,0,1,1,'2026-01-24 07:13:12',NULL,NULL),(35,1,1,1,1,1,1,'2026-01-24 05:55:36',NULL,NULL),(35,4,1,1,1,1,1,'2026-01-24 07:13:12',NULL,NULL),(36,1,1,1,1,1,NULL,'2026-01-26 18:45:02',NULL,NULL),(37,1,1,1,1,1,NULL,'2026-01-26 18:45:02',NULL,NULL),(38,1,1,1,1,1,NULL,'2026-01-26 18:45:02',NULL,NULL);
/*!40000 ALTER TABLE `acc_programa_x_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_rol`
--

DROP TABLE IF EXISTS `acc_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(125) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_rol`
--

LOCK TABLES `acc_rol` WRITE;
/*!40000 ALTER TABLE `acc_rol` DISABLE KEYS */;
INSERT INTO `acc_rol` VALUES (1,'Super Administrador','activo',NULL,'2026-01-14 20:38:07',NULL,NULL),(2,'Administrador Accesos','activo',NULL,'2026-01-14 20:38:07',NULL,NULL),(3,'Auxiliar','activo',1,'2026-01-14 22:32:58',1,'2026-01-15 01:46:33'),(4,'Doctor','activo',1,'2026-01-15 01:47:07',NULL,NULL),(5,'Administrar Usuarios','activo',1,'2026-01-16 19:30:32',NULL,NULL);
/*!40000 ALTER TABLE `acc_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_rol_x_usuario`
--

DROP TABLE IF EXISTS `acc_rol_x_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_rol_x_usuario` (
  `id_usuario` int NOT NULL,
  `id_rol` int NOT NULL,
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`,`id_rol`),
  KEY `rol_x_usuario_id_rol_fk` (`id_rol`),
  CONSTRAINT `rol_x_usuario_id_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `acc_rol` (`id_rol`),
  CONSTRAINT `rol_x_usuario_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `acc_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_rol_x_usuario`
--

LOCK TABLES `acc_rol_x_usuario` WRITE;
/*!40000 ALTER TABLE `acc_rol_x_usuario` DISABLE KEYS */;
INSERT INTO `acc_rol_x_usuario` VALUES (1,1,NULL,'2026-01-14 20:38:07',NULL,NULL),(1,2,NULL,'2026-01-14 20:38:07',NULL,NULL),(2,4,NULL,'2026-01-15 02:59:54',NULL,NULL),(2,5,NULL,'2026-01-26 18:54:02',NULL,NULL),(3,3,NULL,'2026-01-16 04:20:02',NULL,NULL);
/*!40000 ALTER TABLE `acc_rol_x_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acc_usuario`
--

DROP TABLE IF EXISTS `acc_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acc_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `cambio_clave_obligatorio` tinyint(1) NOT NULL DEFAULT '0',
  `usuario_id_inserto` int DEFAULT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acc_usuario`
--

LOCK TABLES `acc_usuario` WRITE;
/*!40000 ALTER TABLE `acc_usuario` DISABLE KEYS */;
INSERT INTO `acc_usuario` VALUES (1,'admin','Super Administrador','optica@serverltda.com','$2y$10$AhsLgpc5QK005zmYUnZibOONn92tcXJoHS6Hq0jKlITPrqcEcVv7m','activo',0,NULL,'2026-01-14 20:38:07',NULL,'2026-01-26 01:56:07'),(2,'lulito','Luz Dary Forero','pouyer07@gmail.com','$2y$10$FvBx158aQxmUJ1Lq6YzQUeOZjRlR1z3hjx44YiLQy/qxKh6syC6g6','activo',0,NULL,'2026-01-15 02:58:06',NULL,NULL),(3,'sara','sara','fernando@serverltda.com','$2y$10$./KaEmJ.KXnFE63BPEZ3vetote7YtH4S62rP2uxEl1cZ55bvmmiJm','activo',0,1,'2026-01-16 04:18:49',2,'2026-01-26 19:10:18');
/*!40000 ALTER TABLE `acc_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acciones_historial`
--

DROP TABLE IF EXISTS `acciones_historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acciones_historial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `icono` varchar(550) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acciones_historial`
--

LOCK TABLES `acciones_historial` WRITE;
/*!40000 ALTER TABLE `acciones_historial` DISABLE KEYS */;
INSERT INTO `acciones_historial` VALUES (1,'CREACION','Creación','Creación de registro','add','activo',1,'2026-01-08 23:02:32',NULL,NULL),(2,'MODIFICACION','Modificación','Modificación de registro','edit','activo',1,'2026-01-08 23:02:32',NULL,NULL),(3,'CANCELACION','Cancelación','Cancelación de registro','cancel','activo',1,'2026-01-08 23:02:32',NULL,NULL),(4,'REALIZACION','Realización','Registro realizado','check','activo',1,'2026-01-08 23:02:32',NULL,NULL),(5,'ELIMINACION','Eliminación','Eliminación de registro','delete','activo',1,'2026-01-08 23:02:32',NULL,NULL),(6,'REPROGRAMACION','Reprogramación','Reprogramación de cita','schedule','activo',1,'2026-01-08 23:02:32',NULL,NULL),(7,'ASIGNACION','Asignación','Asignación de recurso','assignment','activo',1,'2026-01-08 23:02:32',NULL,NULL),(8,'LIBERACION','Liberación','Liberación de recurso','clear','activo',1,'2026-01-08 23:02:32',NULL,NULL);
/*!40000 ALTER TABLE `acciones_historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anamnesis`
--

DROP TABLE IF EXISTS `anamnesis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anamnesis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paciente_id` int NOT NULL,
  `glaucoma` tinyint(1) DEFAULT '0',
  `catarata` tinyint(1) DEFAULT '0',
  `fecha_cirugia_catarata` date DEFAULT NULL,
  `desprendimiento_retina` tinyint(1) DEFAULT '0',
  `estrabismo` tinyint(1) DEFAULT '0',
  `ojo_vago` tinyint(1) DEFAULT '0',
  `conjuntivitis_alergica` tinyint(1) DEFAULT '0',
  `otros_antecedentes_oftalmologicos` text,
  `antecedentes_quirurgicos` text,
  `otras_enfermedades` text,
  `alergias_medicamentos` text,
  `medicamentos_actuales` text,
  `dosis_medicamentos` text,
  `familiares_otros` text,
  `observaciones` text,
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_paciente` (`paciente_id`),
  KEY `idx_glaucoma` (`glaucoma`),
  CONSTRAINT `anamnesis_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anamnesis`
--

LOCK TABLES `anamnesis` WRITE;
/*!40000 ALTER TABLE `anamnesis` DISABLE KEYS */;
INSERT INTO `anamnesis` VALUES (1,1,0,0,NULL,0,0,0,0,'','terigio ojo izquierdo','Paciente transplantado','','','','Hay inquietud en el Senado Galáctico. Varios miles de sistemas solares han declarado sus intenciones de abandonar la República.\r\n\r\nEl movimiento separatista, bajo el liderazgo del misterioso Conde Dooku, ha hecho difícil que el número limitado de Caballeros Jedi mantengan la paz y el orden en la galaxia.\r\n\r\nLa Senadora Amidala, la ex reina de Naboo, va a regresar al Senado Galáctico para votar sobre la cuestión crítica de formar un EJÉRCITO DE \r\nLA REPÚBLICA para ayudar a los abrumados Jedi....','Herper optico ojo derecho en 2020.',1,'2026-01-12 13:09:35',2,'2026-01-26 00:10:47'),(2,8,0,0,NULL,0,0,1,0,'','nueva cirugías de extracción ojo derecho ','','','','','','prueba de OSAMA.la quinta\r\nes la vencida',1,'2026-01-16 15:46:59',2,'2026-01-18 13:25:39'),(5,2,0,0,NULL,0,0,0,0,'prueba 001',NULL,NULL,NULL,NULL,NULL,NULL,'prueba 001',1,'2026-01-16 16:27:14',1,NULL),(6,7,0,0,NULL,0,0,1,1,'Ojo Rojo','','','','','','Es un periodo de guerras civiles en la galaxia. Una valiente alianza de luchadores por la libertad clandestinos ha desafiado la tiranía y opresión del impresionante IMPERIO GALÁCTICO.\r\n\r\nAtacando desde una fortaleza oculta entre los mil millones de estrellas de la galaxia, las naves espaciales rebeldes han logrado su primera victoria en una batalla contra la poderosa Flota Estelar Imperial. El IMPERIO teme que otra derrota pueda llevar a mil sistemas solares más a unirse a la rebelión, y el control Imperial sobre la galaxia se perdería para siempre.\r\n\r\nPara aplastar la rebelión de una vez por todas, el IMPERIO está construyendo una siniestra nueva estación de combate. Lo suficientemente poderosa como para destruir un planeta entero, su finalización significa la perdición segura para los campeones de la libertad.','EAMM',1,'2026-01-16 16:27:49',2,'2026-01-24 16:22:08'),(7,9,0,0,NULL,0,1,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2026-01-26 02:05:08',1,NULL);
/*!40000 ALTER TABLE `anamnesis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `antecedentes_medicos`
--

DROP TABLE IF EXISTS `antecedentes_medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `antecedentes_medicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paciente_id` int NOT NULL,
  `hipertension_arterial` tinyint(1) DEFAULT '0',
  `diabetes` tinyint(1) DEFAULT '0',
  `diabetes_tipo_id` int DEFAULT NULL,
  `tiempo_diabetes` varchar(50) DEFAULT NULL,
  `enfermedades_cardiacas` tinyint(1) DEFAULT '0',
  `enfermedades_renales` tinyint(1) DEFAULT '0',
  `enfermedades_hepaticas` tinyint(1) DEFAULT '0',
  `enfermedades_autoimunes` tinyint(1) DEFAULT '0',
  `cancer` tinyint(1) DEFAULT '0',
  `vih` tinyint(1) DEFAULT '0',
  `tuberculosis` tinyint(1) DEFAULT '0',
  `epilepsia` tinyint(1) DEFAULT '0',
  `asma` tinyint(1) DEFAULT '0',
  `otras_enfermedades` text,
  `glaucoma` tinyint(1) DEFAULT '0',
  `familia_glaucoma` tinyint(1) DEFAULT '0',
  `catarata` tinyint(1) DEFAULT '0',
  `fecha_cirugia_catarata` date DEFAULT NULL,
  `desprendimiento_retina` tinyint(1) DEFAULT '0',
  `estrabismo` tinyint(1) DEFAULT '0',
  `ojo_vago` tinyint(1) DEFAULT '0',
  `conjuntivitis_alergica` tinyint(1) DEFAULT '0',
  `otros_antecedentes_oftalmologicos` text,
  `medicamentos_actuales` text,
  `dosis_medicamentos` text,
  `alergias_medicamentos` text,
  `antecedentes_quirurgicos` text,
  `fuma` tinyint(1) DEFAULT '0',
  `cigarrillos_dia` int DEFAULT '0',
  `alcohol` tinyint(1) DEFAULT '0',
  `frecuencia_alcohol_id` int DEFAULT NULL,
  `drogas` tinyint(1) DEFAULT '0',
  `tipo_drogas` varchar(500) DEFAULT NULL,
  `familiares_ceguera` tinyint(1) DEFAULT '0',
  `familiares_glaucoma` tinyint(1) DEFAULT '0',
  `familiares_retinopatia_diabetica` tinyint(1) DEFAULT '0',
  `familiares_otros` text,
  `observaciones` text,
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_paciente` (`paciente_id`),
  KEY `idx_diabetes` (`diabetes`),
  KEY `idx_glaucoma` (`glaucoma`),
  KEY `diabetes_tipo_id` (`diabetes_tipo_id`),
  KEY `frecuencia_alcohol_id` (`frecuencia_alcohol_id`),
  CONSTRAINT `antecedentes_medicos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `antecedentes_medicos_ibfk_2` FOREIGN KEY (`diabetes_tipo_id`) REFERENCES `tipos_diabetes` (`id`),
  CONSTRAINT `antecedentes_medicos_ibfk_3` FOREIGN KEY (`frecuencia_alcohol_id`) REFERENCES `frecuencias_consumo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antecedentes_medicos`
--

LOCK TABLES `antecedentes_medicos` WRITE;
/*!40000 ALTER TABLE `antecedentes_medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `antecedentes_medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas_control`
--

DROP TABLE IF EXISTS `citas_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas_control` (
  `id` int NOT NULL AUTO_INCREMENT,
  `paciente_id` int NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `motivo_consulta` text,
  `tipo_consulta_id` int NOT NULL,
  `av_sc_lejos_od` varchar(20) DEFAULT NULL,
  `av_sc_lejos_oi` varchar(20) DEFAULT NULL,
  `av_sc_cerca_od` varchar(20) DEFAULT NULL,
  `av_sc_cerca_oi` varchar(20) DEFAULT NULL,
  `av_cc_lejos_od` varchar(20) DEFAULT NULL,
  `av_cc_lejos_oi` varchar(20) DEFAULT NULL,
  `av_cc_cerca_od` varchar(20) DEFAULT NULL,
  `av_cc_cerca_oi` varchar(20) DEFAULT NULL,
  `examen_externo_od` text,
  `examen_externo_oi` text,
  `cover_test_vp` varchar(50) DEFAULT NULL,
  `cover_test_vl` varchar(50) DEFAULT NULL,
  `fpc` varchar(50) DEFAULT NULL,
  `dp` varchar(50) DEFAULT NULL,
  `oftalmoscopia_od` text,
  `oftalmoscopia_oi` text,
  `queratometria_od` varchar(100) DEFAULT NULL,
  `queratometria_oi` varchar(100) DEFAULT NULL,
  `retinoscopia_od` varchar(100) DEFAULT NULL,
  `retinoscopia_oi` varchar(100) DEFAULT NULL,
  `subjetivo_od` varchar(100) DEFAULT NULL,
  `subjetivo_oi` varchar(100) DEFAULT NULL,
  `resultado_final_od` varchar(100) DEFAULT NULL,
  `resultado_final_oi` varchar(100) DEFAULT NULL,
  `lentes_tipo_id` int DEFAULT NULL,
  `lentes_esferico_od` varchar(20) DEFAULT NULL,
  `lentes_esferico_oi` varchar(20) DEFAULT NULL,
  `lentes_cilindrico_od` varchar(20) DEFAULT NULL,
  `lentes_cilindrico_oi` varchar(20) DEFAULT NULL,
  `lentes_eje_od` varchar(20) DEFAULT NULL,
  `lentes_eje_oi` varchar(20) DEFAULT NULL,
  `lentes_adicion` varchar(20) DEFAULT NULL,
  `lentes_material_id` int DEFAULT NULL,
  `lentes_tratamientos` varchar(255) DEFAULT NULL,
  `filtro_color` varchar(100) DEFAULT NULL,
  `uso_lentes_id` int DEFAULT NULL,
  `proximo_control` date DEFAULT NULL,
  `proximo_control_motivo` text,
  `origen_enfermedad` text,
  `tipo_origen_id` int DEFAULT NULL,
  `fecha_inicio_sintomas` date DEFAULT NULL,
  `diagnostico_principal` varchar(255) DEFAULT NULL,
  `diagnostico_secundario` varchar(255) DEFAULT NULL,
  `cie10_id` int DEFAULT NULL,
  `tratamiento` text,
  `medicamentos_prescritos` text,
  `recomendaciones` text,
  `profesional_id` int NOT NULL,
  `asistente_id` int DEFAULT NULL,
  `estado_cita_id` int DEFAULT '1',
  `observaciones_generales` text,
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_paciente` (`paciente_id`),
  KEY `idx_fecha_cita` (`fecha_cita`),
  KEY `idx_profesional` (`profesional_id`),
  KEY `idx_estado_cita` (`estado_cita_id`),
  KEY `idx_tipo_consulta` (`tipo_consulta_id`),
  KEY `idx_asistente` (`asistente_id`),
  KEY `lentes_tipo_id` (`lentes_tipo_id`),
  KEY `lentes_material_id` (`lentes_material_id`),
  KEY `uso_lentes_id` (`uso_lentes_id`),
  KEY `tipo_origen_id` (`tipo_origen_id`),
  KEY `cie10_id` (`cie10_id`),
  CONSTRAINT `citas_control_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `citas_control_ibfk_10` FOREIGN KEY (`cie10_id`) REFERENCES `diagnosticos_cie10` (`id`),
  CONSTRAINT `citas_control_ibfk_2` FOREIGN KEY (`tipo_consulta_id`) REFERENCES `tipos_consulta` (`id`),
  CONSTRAINT `citas_control_ibfk_3` FOREIGN KEY (`lentes_tipo_id`) REFERENCES `tipos_lentes` (`id`),
  CONSTRAINT `citas_control_ibfk_4` FOREIGN KEY (`lentes_material_id`) REFERENCES `materiales_lentes` (`id`),
  CONSTRAINT `citas_control_ibfk_5` FOREIGN KEY (`uso_lentes_id`) REFERENCES `usos_lentes` (`id`),
  CONSTRAINT `citas_control_ibfk_6` FOREIGN KEY (`tipo_origen_id`) REFERENCES `tipos_origen_enfermedad` (`id`),
  CONSTRAINT `citas_control_ibfk_7` FOREIGN KEY (`estado_cita_id`) REFERENCES `estados_cita` (`id`),
  CONSTRAINT `citas_control_ibfk_8` FOREIGN KEY (`profesional_id`) REFERENCES `profesionales_salud` (`id`),
  CONSTRAINT `citas_control_ibfk_9` FOREIGN KEY (`asistente_id`) REFERENCES `profesionales_salud` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_control`
--

LOCK TABLES `citas_control` WRITE;
/*!40000 ALTER TABLE `citas_control` DISABLE KEYS */;
INSERT INTO `citas_control` VALUES (1,2,'2026-01-16','14:33:00','control de pruebas Daniel Mejia',1,'15','15','15','15','19','19','19','19','','','','','fpc','pupilar','Oftalmoscopi','oftal OI','Querato','','','','','','','',6,'','','','','','','',3,'','',1,NULL,'','',8,NULL,'Diag Primario','Diog secun',96,'tt1','','usar permanentemente',2,NULL,2,'aber otro ajuste',2,'2026-01-16 19:38:47',2,'2026-01-17 03:48:47'),(2,1,'2026-01-16','21:49:00','pruebas de refactoria del examen fisico',1,'11','12','13','14','15','16','17','18','TExto Examen EXT OD','TExto Examen EXT OI','Cover respuesta','respuesta Cover Test VL','respuesta FPC','68mm','respuesta Oftalmoscopia OD','respuesta Oftalmoscopia OI','21','22','23','24','31','32','41','42',1,'1','2','3','4','5','6','+7',3,'respuesta tratamiento','respuesta filtro/Color',2,'2026-01-16','','Respuesta Descripción del Origen',6,'2026-01-24','Respuesta Diagnóstico Principal','respuesta Diagnóstico Secundario',252,'Respuesta del Tratamiento\r\nHay inquietud en el Senado\r\nGaláctico. Varios miles de\r\nsistemas solares han declarado\r\nsus intenciones de abandonar \r\nla República.\r\n\r\nEl movimiento separatista,\r\nbajo el liderazgo del misterioso\r\nConde Dooku, ha hecho difícil\r\nque el número limitado de \r\nCaballeros Jedi mantengan la \r\npaz y el orden en la galaxia.\r\n\r\nLa Senadora Amidala, la ex\r\nreina de Naboo, va a regresar \r\nal Senado Galáctico para \r\nvotar sobre la cuestión crítica \r\nde formar un EJÉRCITO DE \r\nLA REPÚBLICA para ayudar a \r\nlos abrumados Jedi....','respuesta de Medicamentos','Respuesta de Recomendaciones',2,NULL,6,'rwerwerwer',2,'2026-01-17 02:54:06',2,'2026-01-26 01:26:45'),(3,2,'2026-01-24','02:19:00','primer control despues de la primera cita',2,'61','62','63','64','71','72','73','74','Respuesta 2 Examen Externo OD','respuesta 2 Examen Externo OI','respuesta 2 Cover Test VP (Visión Próxima)','respuesta 2 Cover Test VL (Visión Lejana)','respuesta 2 FPC ','respuesta 2 (Distancia Pupilar)','respuesta 2 Oftalmoscopia OD','respuesta 2 Oftalmoscopia OI','81','82','91','92','98','99','R10','R11',6,'1.55','1.56','2.50','2.56','3.50','350','+3',5,'respuesta 2 tratamiento ','respuesta 2 filtro/Color',3,NULL,NULL,'RESPUESTA 2 Descripción del Origen',2,'2026-01-24','Respuesta 2 Diagnóstico Principal','respuesta 2 Diagnóstico Secundario',NULL,'RESPUESTA 2 Tratamiento Indicado','RESPUESTA 2  Medicamentos Prescritos','RESPUESTA 2 DE TODAS LAS RECOMENDACIONES QUE SUGIERA EL PROFESIONAL',2,NULL,1,'RESPUESTA 2 DE LAS OBSERVACIONES GENERALES',2,'2026-01-24 07:27:07',NULL,NULL);
/*!40000 ALTER TABLE `citas_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosticos_cie10`
--

DROP TABLE IF EXISTS `diagnosticos_cie10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diagnosticos_cie10` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(25) NOT NULL,
  `descripcion` text NOT NULL,
  `codigo_categoria` varchar(25) DEFAULT NULL,
  `categoria` text,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosticos_cie10`
--

LOCK TABLES `diagnosticos_cie10` WRITE;
/*!40000 ALTER TABLE `diagnosticos_cie10` DISABLE KEYS */;
INSERT INTO `diagnosticos_cie10` VALUES (1,'H000','ORZUELO Y OTRAS INFLAMACIONES PROFUNDAS DEL PARPADO','H00','ORZUELO Y CALACIO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(2,'H001','CALACIO [CHALAZION]','H00','ORZUELO Y CALACIO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(3,'H010','BLEFARITIS','H01','OTRAS INFLAMACIONES DEL PARPADO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(4,'H011','DERMATOSIS NO INFECCIOSA DEL PARPADO','H01','OTRAS INFLAMACIONES DEL PARPADO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(5,'H018','OTRAS INFLAMACIONES ESPECIFICADAS DEL PARPADO','H01','OTRAS INFLAMACIONES DEL PARPADO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(6,'H019','INFLAMACION DEL PARPADO, NO ESPECIFICADA','H01','OTRAS INFLAMACIONES DEL PARPADO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(7,'H020','ENTROPION Y TRIQUIASIS PALPEBRAL','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(8,'H021','ECTROPION DEL PARPADO','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(9,'H022','LAGOFTALMOS','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(10,'H023','BLEFAROCALASIA','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(11,'H024','BLEFAROPTOSIS','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(12,'H025','OTROS TRASTORNOS FUNCIONALES DEL PARPADO','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(13,'H026','XANTELASMA DEL PARPADO','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(14,'H027','OTROS TRASTORNOS DEGENERATIVOS DEL PARPADO Y DEL AREA PERIOCULAR','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(15,'H028','OTROS TRASTORNOS ESPECIFICADOS DEL PARPADO','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(16,'H029','TRASTORNOS DEL PARPADO, NO ESPECIFICADO','H02','OTROS TRASTORNOS DE LOS PARPADOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(17,'H030*','INFECCION E INFESTACION PARASITARIAS DEL PARPADO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H03*','TRASTORNOS DEL PARPADO EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(18,'H031*','COMPROMISO DEL PARPADO EN ENFERMEDADES INFECCIOSAS CLASIFICADAS EN OTRA PARTE','H03*','TRASTORNOS DEL PARPADO EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(19,'H038*','COMPROMISO DEL PARPADO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H03*','TRASTORNOS DEL PARPADO EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(20,'H040','DACRIOADENITIS','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(21,'H041','OTROS TRASTORNOS DE LA GLANDULA LAGRIMAL','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(22,'H042','EPIFORA','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(23,'H043','INFLAMACION AGUDA Y LA NO ESPECIFICADA DE LAS VIAS LAGRIMALES','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(24,'H044','INFLAMACION CRONICA DE LAS VIAS LAGRIMALES','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(25,'H045','ESTENOSIS E INSUFICIENCIA DE LAS VIAS LAGRIMALES','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(26,'H046','OTROS CAMBIOS DE LAS VIAS LAGRIMALES','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(27,'H048','OTROS TRASTORNOS ESPECIFICADOS DEL APARATO LAGRIMAL','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(28,'H049','TRASTORNO DEL APARATO LAGRIMAL, NO ESPECIFICADO','H04','TRASTORNOS DEL APARATO LAGRIMAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(29,'H050','INFLAMACION AGUDA DE LA ORBITA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(30,'H051','TRASTORNOS INFLAMATORIOS CRONICOS DE LA ORBITA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(31,'H052','AFECCIONES EXOFTALMICAS','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(32,'H053','DEFORMIDAD DE LA ORBITA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(33,'H054','ENOFTALMIA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(34,'H055','RETENCION DE CUERPO EXTRAÑO (ANTIGUO), CONSECUTIVA A HERIDA PENETRANTE DE LA ORBITA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(35,'H058','OTROS TRASTORNOS DE LA ORBITA','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(36,'H059','TRASTORNO DE LA ORBITA, NO ESPECIFICADO','H05','TRASTORNOS DE LA ORBITA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(37,'H060*','TRASTORNOS DEL APARATO LAGRIMAL EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H06*','TRASTORNOS DEL APARATO LAGRIMAL Y DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(38,'H061*','INFECCION O INFESTACION PARASITARIA DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H06*','TRASTORNOS DEL APARATO LAGRIMAL Y DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(39,'H062*','EXOFTALMIA HIPERTIROIDEA (E05.-†)','H06*','TRASTORNOS DEL APARATO LAGRIMAL Y DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(40,'H063*','OTROS TRASTORNOS DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H06*','TRASTORNOS DEL APARATO LAGRIMAL Y DE LA ORBITA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(41,'H100','CONJUNTIVITIS MUCOPURULENTA','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(42,'H101','CONJUNTIVITIS ATOPICA AGUDA','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(43,'H102','OTRAS CONJUNTIVITIS AGUDAS','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(44,'H103','CONJUNTIVITIS AGUDA, NO ESPECIFICADA','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(45,'H104','CONJUNTIVITIS CRONICA','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(46,'H105','BLEFAROCONJUNTIVITIS','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(47,'H108','OTRAS CONJUNTIVITIS','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(48,'H109','CONJUNTIVITIS, NO ESPECIFICADA','H10','CONJUNTIVITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(49,'H110','PTERIGION','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(50,'H111','DEGENERACIONES Y DEPOSITOS CONJUNTIVALES','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:09'),(51,'H112','CICATRICES CONJUNTIVALES','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:14'),(52,'H113','HEMORRAGIA CONJUNTIVAL','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:18'),(53,'H114','OTROS TRASTORNOS VASCULARES Y QUISTES CONJUNTIVALES','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:23'),(54,'H118','OTROS TRASTORNOS ESPECIFICADOS DE LA CONJUNTIVA','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:32'),(55,'H119','TRASTORNO DE LA CONJUNTIVA, NO ESPECIFICADO','H11','OTROS TRASTORNOS DE LA CONJUNTIVA','activo',1,'2026-01-08 23:05:36',2,'2026-01-17 14:04:39'),(56,'H130*','INFECCION FILARICA DE LA CONJUNTIVA (B74.-†)','H13*','TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(57,'H131*','CONJUNTIVITIS EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE','H13*','TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(58,'H132*','CONJUNTIVITIS EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H13*','TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(59,'H133*','PENFIGOIDE OCULAR (L12.-†)','H13*','TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(60,'H138*','OTROS TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H13*','TRASTORNOS DE LA CONJUNTIVA EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(61,'H150','ESCLERITIS','H15','TRASTORNOS DE LA ESCLEROTICA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(62,'H151','EPISCLERITIS','H15','TRASTORNOS DE LA ESCLEROTICA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(63,'H158','OTROS TRASTORNOS DE LA ESCLEROTICA','H15','TRASTORNOS DE LA ESCLEROTICA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(64,'H159','TRASTORNOS DE LA ESCLEROTICA, NO ESPECIFICADO','H15','TRASTORNOS DE LA ESCLEROTICA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(65,'H160','ULCERA DE LA CORNEA','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(66,'H161','OTRAS QUERATITIS SUPERFICIALES SIN CUNJUNTIVITIS','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(67,'H162','QUERATOCONJUNTIVITIS','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(68,'H163','QUERATITIS INTERSTICIAL Y PROFUNDA','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(69,'H164','NEOVASCULARIZACION DE LA CORNEA','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(70,'H168','OTRAS QUERATITIS','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(71,'H169','QUERATITIS, NO ESPECIFICADA','H16','QUERATITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(72,'H170','LEUCOMA ADHERENTE','H17','OPACIDADES Y CICATRICES CORNEALES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(73,'H171','OTRAS OPACIDADES CENTRALES DE LA CORNEA','H17','OPACIDADES Y CICATRICES CORNEALES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(74,'H178','OTRAS OPACIDADES O CICATRICES DE LA CORNEA','H17','OPACIDADES Y CICATRICES CORNEALES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(75,'H179','CICATRIZ U OPACIDAD DE LA CORNEA, NO ESPECIFICADA','H17','OPACIDADES Y CICATRICES CORNEALES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(76,'H180','PIGMENTACIONES Y DEPOSITOS EN LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(77,'H181','QUERATOPATIA VESICULAR','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(78,'H182','OTROS EDEMAS DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(79,'H183','CAMBIOS EN LAS MEMBRANAS DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(80,'H184','DEGENERACION DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(81,'H185','DISTROFIA HEREDITARIA DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(82,'H186','QUERATOCONO','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(83,'H187','OTRAS DEFORMIDADES DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(84,'H188','OTROS TRASTORNOS ESPECIFICADOS DE LA CORNEA','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(85,'H189','TRASTORNO DE LA CORNEA, NO ESPECIFICADO','H18','OTROS TRASTORNOS DE LA CORNEA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(86,'H190*','ESCLERITIS Y EPISCLERITIS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H19*','TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(87,'H191*','QUERATITIS Y QUERATOCONJUNTIVITIS POR HERPES SIMPLE (B00.5†)','H19*','TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(88,'H192*','QUERATITIS Y QUERATOCONJUNTIVITIS EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS, CLASIFICADAS EN OTRA PARTE','H19*','TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(89,'H193*','QUERATITIS Y QUERATOCONJUNTIVITIS EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H19*','TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(90,'H198*','OTROS TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H19*','TRASTORNOS DE LA ESCLEROTICA Y DE LA CORNEA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(91,'H200','IRIDOCICLITIS AGUDA Y SUBAGUDA','H20','IRIDOCICLITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(92,'H201','IRIDOCICLITIS CRONICA','H20','IRIDOCICLITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(93,'H202','IRIDOCICLITIS INDUCIDA POR TRASTORNO DEL CRISTALINO','H20','IRIDOCICLITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(94,'H208','OTRAS IRIDOCICLITIS ESPECIFICADAS','H20','IRIDOCICLITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(95,'H209','IRIDOCICLITIS, NO ESPECIFICADA','H20','IRIDOCICLITIS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(96,'H210','HIFEMA','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(97,'H211','OTROS TRASTORNOS VASCULARES DEL IRIS Y DEL CUERPO CILIAR','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(98,'H212','DEGENERACION DEL IRIS Y DEL CUERPO CILIAR','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(99,'H213','QUISTE DEL IRIS, DEL CUERPO CILIAR Y DE LA CAMARA ANTERIOR','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(100,'H214','MEMBRANAS PUPILARES','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(101,'H215','OTRAS ADHERENCIAS Y DESGARROS DEL IRIS Y DEL CUERPO CILIAR','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(102,'H218','OTROS TRASTORNOS ESPECIFICADOS DEL IRIS Y DEL CUERPO CILIAR','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(103,'H219','DEL IRIS Y DEL CUERPO CILIAR, NO ESPECIFICADO','H21','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(104,'H220*','IRIDOCICLITIS EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE','H22*','TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(105,'H221*','IRIDOCICLITIS EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H22*','TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(106,'H228*','OTROS TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H22*','TRASTORNOS DEL IRIS Y DEL CUERPO CILIAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(107,'H250','CATARATA SENIL INCIPIENTE','H25','CATARATA SENIL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(108,'H251','CATARATA SENIL NUCLEAR','H25','CATARATA SENIL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(109,'H252','CATARATA SENIL, TIPO MORGAGNIAN','H25','CATARATA SENIL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(110,'H258','OTRAS CATARATAS SENILES','H25','CATARATA SENIL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(111,'H259','CATARATA SENIL, NO ESPECIFICADA','H25','CATARATA SENIL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(112,'H260','CATARATA INFANTIL, JUVENIL Y PRESENIL','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(113,'H261','CATARATA TRAUMATICA','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(114,'H262','CATARATA COMPLICADA','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(115,'H263','CATARATA INDUCIDA POR DROGAS','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(116,'H264','CATARATA RESIDUAL','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(117,'H268','OTRAS FORMAS ESPECIFICADAS DE CATARATA','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(118,'H269','CATARATA, NO ESPECIFICADA','H26','OTRAS CATARATAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(119,'H270','AFAQUIA','H27','OTROS TRASTORNOS DEL CRISTALINO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(120,'H271','LUXACION DEL CRISTALINO','H27','OTROS TRASTORNOS DEL CRISTALINO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(121,'H278','OTROS TRASTORNOS ESPECIFICADOS DEL CRISTALINO','H27','OTROS TRASTORNOS DEL CRISTALINO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(122,'H279','TRASTORNO DEL CRISTALINO, NO ESPECIFICADO','H27','OTROS TRASTORNOS DEL CRISTALINO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(123,'H280*','CATARATA DIABETICA (E10-E14† CON CUARTO CARACTER COMUN .3)','H28*','CATARATA Y OTROS TRASTORNOS DEL CRISTALINO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(124,'H281*','CATARATA EN OTRAS ENFERMEDADES ENDOCRINAS, NUTRICIONALES Y METABOLICAS CLASIFICADAS EN OTRA PARTE','H28*','CATARATA Y OTROS TRASTORNOS DEL CRISTALINO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(125,'H282*','CATARATA EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H28*','CATARATA Y OTROS TRASTORNOS DEL CRISTALINO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(126,'H288*','OTROS TRASTORNOS DEL CRISTALINO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H28*','CATARATA Y OTROS TRASTORNOS DEL CRISTALINO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(127,'H300','CORIORRETINITIS FOCAL','H30','INFLAMACION CORIORRETINIANA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(128,'H301','CORIORRETINITIS DISEMINADA','H30','INFLAMACION CORIORRETINIANA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(129,'H302','CICLITIS POSTERIOR','H30','INFLAMACION CORIORRETINIANA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(130,'H308','OTRAS CORIORRETINITIS','H30','INFLAMACION CORIORRETINIANA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(131,'H309','CORIORRETINITIS, NO ESPECIFICADA','H30','INFLAMACION CORIORRETINIANA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(132,'H310','CICATRICES CORIORRETINIANAS','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(133,'H311','DESGENERACION COROIDEA','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(134,'H312','DISTROFIA COROIDEA HEREDITARIA','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(135,'H313','HEMORRAGIA Y RUPTURA DE LA COROIDES','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(136,'H314','DESPRENDIMIENTO DE LA COROIDES','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(137,'H318','OTROS TRASTORNOS ESPECIFICADOS DE LA COROIDES','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(138,'H319','TRASTORNO DE LA COROIDES, NO ESPECIFICADO','H31','OTROS TRASTORNOS DE LA COROIDES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(139,'H320*','INFLAMACION CORIORRETINIANA EN ENFERMEDADES INFECCIOSAS Y PARASITARIAS CLASIFICADAS EN OTRA PARTE','H32*','TRASTORNOS CORIORRETINIANOS EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(140,'H328*','OTROS TRASTORNOS CORIORRETINIANOS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H32*','TRASTORNOS CORIORRETINIANOS EN ENFERMEDADES CLASIFICADAS OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(141,'H330','DESPRENDIMIENTO DE LA RETINA CON RUPTURA','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(142,'H331','RETINOSQUISIS Y QUISTES DE LA RETINA','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(143,'H332','DESPRENDIMIENTO SEROSO DE LA RETINA','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(144,'H333','DESGARRO DE LA RETINA SIN DESPRENDIMIENTO','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(145,'H334','DESPRENDIMIENTO DE LA RETINA POR TRACCION','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(146,'H335','OTROS DESPRENDIMIENTO DE LA RETINA','H33','DESPRENDIMIENTO Y DESGARRO DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(147,'H340','OCLUSION ARTERIAL TRANSITORIA DE LA RETINA','H34','OCLUSION VASCULAR DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(148,'H341','OCLUSION DE LA ARTERIA CENTRAL DE LA RETINA','H34','OCLUSION VASCULAR DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(149,'H342','OTRAS FORMAS DE OCLUSION DE LA ARTERIA DE LA RETINA','H34','OCLUSION VASCULAR DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(150,'H348','OTRAS OCLUSIONES VASCULARES RETINIANAS','H34','OCLUSION VASCULAR DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(151,'H349','OCLUSION VASCULAR RETINIANA, SIN OTRA ESPECIFICACION','H34','OCLUSION VASCULAR DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(152,'H350','RETINOPATIAS DEL FONDO Y CAMBIOS VASCULARES RETINIANOS','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(153,'H351','RETINOPATIA DE LA PREMATURIDAD','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(154,'H352','OTRAS RETINOPATIAS PROLIFERATIVAS','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(155,'H353','DEGENERACION DE LA MACULA Y DEL POLO POSTERIOR DEL OJO','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(156,'H354','DEGENERACION PERIFERICA DE LA RETINA','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(157,'H355','DISTROFIA HEREDITARIA DE LA RETINA','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(158,'H356','HEMORRAGIA RETINIANA','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(159,'H357','SEPARACION DE LAS CASPAS DE LA RETINA','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(160,'H358','OTROS TRASTORNOS ESPECIFICADOS DE LA RETINA','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(161,'H359','TRASTORNO DE LA RETINA, NO ESPECIFICADO','H35','OTROS TRASTORNOS DE LA RETINA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(162,'H360*','RETINOPATIA DIABETICA (E10-E14† CON CUARTO CARACTER COMUN .3)','H36*','TRASTORNOS DE LA RETINA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(163,'H368*','OTROS TRASTORNOS DE LA RETINA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H36*','TRASTORNOS DE LA RETINA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(164,'H400','SOSPECHA DE GLAUCOMA','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(165,'H401','GLAUCOMA PRIMARIO DE ANGULO ABIERTO','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(166,'H402','GLAUCOMA PRIMARIO DE ANGULO CERRADO','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(167,'H403','GLAUCOMA SECUNDARIO A TRAUMATISMO OCULAR','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(168,'H404','GLAUCOMA SECUNDARIO A INFLAMACION OCULAR','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(169,'H405','GLAUCOMA SECUNDARIO A OTROS TRASTORNOS DEL OJO','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(170,'H406','GLAUCOMA SECUNDARIO A DROGAS','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(171,'H408','OTROS GLAUCOMAS','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(172,'H409','GLAUCOMA, NO ESPECIFICADO','H40','GLAUCOMA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(173,'H420*','GLAUCOMA EN ENFERMEDADES ENDOCRINAS, NUTRICIONALES Y METABOLICAS, CLASIFICADAS EN OTRA PARTE','H42*','GLAUCOMA EN ENFERMEDADES CLASIFICADASIF EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(174,'H428*','GLAUCOMA EN OTRAS ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H42*','GLAUCOMA EN ENFERMEDADES CLASIFICADASIF EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(175,'H430','PROLAPSO DEL VITREO','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(176,'H431','HEMORRAGIA DEL VITREO','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(177,'H432','DEPOSITOS CRISTALINOS EN EL CUERPO VITREO','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(178,'H433','OTRAS OPACIDADES VITREAS','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(179,'H438','OTROS TRASTORNOS DEL CUERPO VITREO','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(180,'H439','TRASTORNOS DEL CUERPO VITREO, NO ESPECIFICADO','H43','TRASTORNOS DEL CUERPO VITREO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(181,'H440','ENDOFTALMITIS PURULENTA','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(182,'H441','OTRAS ENDOFTALMITIS','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(183,'H442','MIOPIA DEGENERATIVA','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(184,'H443','OTROS TRASTORNOS DEGENERATIVOS DEL GLOBO OCULAR','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(185,'H444','HIPOTONIA OCULAR','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(186,'H445','AFECCIONES DEGENERATIVAS DEL GLOBO OCULAR','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(187,'H446','RETENCION INTRAOCULAR DE CUERPO EXTRAÑO MAGNETICO (ANTIGUO)','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(188,'H447','RETENCION INTRAOCULAR DE CUERPO EXTRAÑO NO MAGNETICO (ANTIGUO)','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(189,'H448','OTROS TRASTORNOS DEL GLOBO OCULAR','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(190,'H449','TRASTORNO DEL GLOBO OCULAR, NO ESPECIFICADO','H44','TRASTORNOS DEL GLOBO OCULAR','activo',1,'2026-01-08 23:05:36',NULL,NULL),(191,'H450*','HEMORRAGIA DEL VITREO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H45*','TRASTORNOS DEL CUERP VITREO Y DEL GLOBO OCULAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(192,'H451*','ENDOFTALMITIS EN ENFERNEDADES CLASIFICADAS EN OTRA PARTE','H45*','TRASTORNOS DEL CUERP VITREO Y DEL GLOBO OCULAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(193,'H458*','OTROS TRASTORNOS DEL CUERPO VITREO Y DEL GLOBO OCULAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H45*','TRASTORNOS DEL CUERP VITREO Y DEL GLOBO OCULAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(194,'H46','NEURITIS OPTICA','H46','NEURITIS OPTICA','activo',1,'2026-01-08 23:05:36',NULL,NULL),(195,'H470','TRASTORNOS DEL NERVIO OPTICO, NO CLASIFICADOS EN OTRA PARTE','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(196,'H471','PAPILEDEMA, NO ESPECIFICADO','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(197,'H472','ATROFIA OPTICA','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(198,'H473','OTROS TRASTORNOS DEL DISCO OPTICO','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(199,'H474','TRASTORNOS DEL QUIASMA OPTICO','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(200,'H475','TRASTORNOS DE OTRAS VIAS OPTICAS','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(201,'H476','TRASTORNOS DE LA CORTEZA VISUAL','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(202,'H477','TRASTORNOS DE LAS VIAS OPTICAS, NO ESPECIFICADO','H47','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(203,'H480*','ATROFIA OPTICA EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H48*','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(204,'H481*','NEURITIS RETROBULBAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H48*','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(205,'H488*','OTROS TRASTORNOS DEL NERVIO OPTICO Y DE LAS VIAS OPTICAS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H48*','OTROS TRASTORNOS DEL NERVIO OPTICO [ II PAR ] Y DE LAS VIAS OPTICAS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(206,'H490','PARALISIS DEL NERVIO MOTOR OCULAR COMUN [III PAR]','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(207,'H491','PARALISIS DEL NERVIO PATETICO [IV PAR]','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(208,'H492','PARALISIS DEL NERVIO MOTOR OCULAR EXTERNO [VI PAR]','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(209,'H493','OFTALMOPLEJIA TOTAL (EXTERNA)','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(210,'H494','OFTALMOPLEJIA EXTERNA PROGRESIVA','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(211,'H498','OTROS ESTRABISMOS PARALITICOS','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(212,'H499','ESTRABISMO PARALITICO, NO ESPECIFICADO','H49','ESTRABISMO PARALITICO','activo',1,'2026-01-08 23:05:36',NULL,NULL),(213,'H500','ESTRABISMO CONCOMITANTE CONVERGENTE','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(214,'H501','ESTRABISMO CONCOMITANTE DIVERGENTE','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(215,'H502','ESTRABISMO VERTICAL','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(216,'H503','HETEROTROPIA INTERMITENTE','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(217,'H504','OTRAS HETEROTROPIAS O LAS NO ESPECIFICADAS','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(218,'H505','HETEROFORIA','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(219,'H506','ESTRABISMO MECANICO','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(220,'H508','OTROS ESTRABISMOS ESPECIFICADOS','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(221,'H509','ESTRABISMO, NO ESPECIFICADO','H50','OTROS ESTRABISMOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(222,'H510','PARALISIS DE LA CONJUGACION DE LA MIRADA','H51','OTROS TRASTORNOS DE LOS MOVIMIENTOS BINOCULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(223,'H511','EXCESO E INSUFICIENCIA DE LA CONVERGENCIA OCULAR','H51','OTROS TRASTORNOS DE LOS MOVIMIENTOS BINOCULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(224,'H512','OFTALMOPLEJIA INTERNUCLEAR','H51','OTROS TRASTORNOS DE LOS MOVIMIENTOS BINOCULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(225,'H518','OTROS TRASTORNOS ESPECIFICADOS DE LOS MOVIMIENTOS BINOCULARES','H51','OTROS TRASTORNOS DE LOS MOVIMIENTOS BINOCULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(226,'H519','TRASTORNOS DEL MOVIMIENTO BINOCULAR, NO ESPECIFICADO','H51','OTROS TRASTORNOS DE LOS MOVIMIENTOS BINOCULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(227,'H520','HIPERMETROPIA','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(228,'H521','MIOPIA','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(229,'H522','ASTIGMATISMO','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(230,'H523','ANISOMETROPIA Y ANISEICONIA','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(231,'H524','PRESBICIA','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(232,'H525','TRASTORNOS DE LA ACOMODACION','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(233,'H526','OTROS TRASTORNOS DE LA REFRACCION','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(234,'H527','TRASTORNO DE LA REFRACCION, NO ESPECIFICADO','H52','TRASTORNOS DE LA ACOMODACION Y DE LA REFRACCION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(235,'H530','AMBLIOPIA EX ANOPSIA','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(236,'H531','ALTERACIONES VISUALES SUBJETIVAS','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(237,'H532','DIPLOPIA','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(238,'H533','OTROS TRASTORNOS DE LA VISION BINOCULAR','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(239,'H534','DEFECTOS DEL CAMPO VISUAL','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(240,'H535','DEFICIENCIAS DE LA VISION CROMATICA','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(241,'H536','CEGUERA NOCTURNA','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(242,'H538','OTRAS ALTERACIONES VISUALES','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(243,'H539','ALTERACION VISUAL, NO ESPECIFICADA','H53','ALTERACIONES DE LA VISION','activo',1,'2026-01-08 23:05:36',NULL,NULL),(244,'H540','CEGUERA DE AMBOS OJOS','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(245,'H541','CEGUERA DE UN OJO, VISION SUBNORMAL DEL OTRO','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(246,'H542','VISION SUBNORMAL DE AMBOS OJOS','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(247,'H543','DISMINUCION INDETERMINADA DE LA AGUDEZA VISUAL EN AMBOS OJOS','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(248,'H544','CEGUERA DE UN OJO','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(249,'H545','VISION SUBNORMAL DE UN OJO','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(250,'H546','DISMINUCION INDETERMINADA DE LA AGUDEZA VISUAL DE UN OJO','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(251,'H547','DISMINUCION DE LA AGUDEZA VISUAL, SIN ESPECIFICACION','H54','CEGUERA Y DISMINUCION DE LA AGUDEZA VISUAL','activo',1,'2026-01-08 23:05:36',NULL,NULL),(252,'H55','NISTAGMO Y OTROS MOVIMIENTOS OCULARES IRREGULARES','H55','NISTAGMO Y OTROS MOVIMIENTOS OCULARES IRREGULARES','activo',1,'2026-01-08 23:05:36',NULL,NULL),(253,'H570','ANOMALIAS DE LA FUNCION PUPILAR','H57','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(254,'H571','DOLOR OCULAR','H57','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(255,'H578','OTROS TRASTORNOS ESPECIFICADOS DEL OJO Y SUS ANEXOS','H57','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(256,'H579','TRASTORNO DEL OJO Y SUS ANEXOS, NO ESPECIFICADO','H57','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS','activo',1,'2026-01-08 23:05:36',NULL,NULL),(257,'H580*','ANOMALIAS DE LA FUNCION PUPILAR EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H58*','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(258,'H581*','ALTERACIONES DE LA VISION EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H58*','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(259,'H588*','OTROS TRASTORNOS ESPECIFICADOS DEL OJO EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','H58*','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS EN ENFERMEDADES CLASIFICADAS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(260,'H590','SINDROME VITREO CONSECUTIVO A CIRUGIA DE CATARATA','H59','TRASTORNOS DEL OJO Y SUS ANEXOS CONSECUTIVOS A PROCEDIMIENTOS, NO CLASIFICADOS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(261,'H598','OTROS TRASTORNOS DEL OJO Y SUS ANEXOS, CONSECUTIVOS A PROCEDIMIENTOS','H59','TRASTORNOS DEL OJO Y SUS ANEXOS CONSECUTIVOS A PROCEDIMIENTOS, NO CLASIFICADOS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL),(262,'H599','TRASTORNO NO ESPECIFICADO DEL OJO Y SUS ANEXOS, CONSECUTIVO A PROCEDIMIENTOS','H59','TRASTORNOS DEL OJO Y SUS ANEXOS CONSECUTIVOS A PROCEDIMIENTOS, NO CLASIFICADOS EN OTRA PARTE','activo',1,'2026-01-08 23:05:36',NULL,NULL);
/*!40000 ALTER TABLE `diagnosticos_cie10` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eps`
--

DROP TABLE IF EXISTS `eps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eps`
--

LOCK TABLES `eps` WRITE;
/*!40000 ALTER TABLE `eps` DISABLE KEYS */;
INSERT INTO `eps` VALUES (1,'EPS001','SURA',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(2,'EPS002','NUEVA EPS',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(3,'EPS003','SANITAS',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(4,'EPS004','COOMEVA',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(5,'EPS005','MEDIMÁS',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(6,'EPS006','SALUD TOTAL',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(7,'EPS007','FAMISANAR',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(8,'EPS008','CAFESALUD',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(9,'EPS009','COMPENSAR',NULL,NULL,NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL),(10,'EPS010','PARTICULAR','','','','activo',1,'2026-01-08 23:02:29',1,'2026-01-15 00:00:18');
/*!40000 ALTER TABLE `eps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_cita`
--

DROP TABLE IF EXISTS `estados_cita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados_cita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_cita`
--

LOCK TABLES `estados_cita` WRITE;
/*!40000 ALTER TABLE `estados_cita` DISABLE KEYS */;
INSERT INTO `estados_cita` VALUES (1,'PROGRAMADA','Programada','Cita programada','#3498db','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(2,'REALIZADA','Realizada','Cita realizada','#e61e17','activo',1,'2026-01-08 23:02:32',2,'2026-01-24 04:33:08',NULL),(3,'CANCELADA','Cancelada','Cita cancelada','#e74c3a','activo',1,'2026-01-08 23:02:32',2,'2026-01-15 03:14:57',NULL),(4,'NO_ASISTIO','No asistió','Paciente no asistió','#f39c12','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(5,'REPROGRAMADA','Reprogramada','Cita reprogramada','#9b59b6','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(6,'EN_PROCESO','En proceso','Cita en curso','#1abc9c','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL);
/*!40000 ALTER TABLE `estados_cita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_civiles`
--

DROP TABLE IF EXISTS `estados_civiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados_civiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_civiles`
--

LOCK TABLES `estados_civiles` WRITE;
/*!40000 ALTER TABLE `estados_civiles` DISABLE KEYS */;
INSERT INTO `estados_civiles` VALUES (1,'Soltero(a)','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 12:31:17',1),(2,'Casado(a)','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 12:31:33',2),(3,'Unión libre','activo',1,'2026-01-08 23:02:30',1,'2026-01-10 14:47:38',3),(6,'Viudo(a)','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 12:31:56',4);
/*!40000 ALTER TABLE `estados_civiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados_paciente`
--

DROP TABLE IF EXISTS `estados_paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados_paciente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados_paciente`
--

LOCK TABLES `estados_paciente` WRITE;
/*!40000 ALTER TABLE `estados_paciente` DISABLE KEYS */;
INSERT INTO `estados_paciente` VALUES (1,'ACTIVO','Activo','Paciente activo en el sistema','activo',1,'2026-01-08 23:02:30',NULL,NULL,NULL),(2,'INACTIVO','Inactivo','Paciente inactivo temporalmente','activo',1,'2026-01-08 23:02:30',NULL,NULL,NULL),(3,'ARCHIVADO','Archivado','Paciente archivado','activo',1,'2026-01-08 23:02:30',NULL,NULL,NULL),(4,'FALLECIDO','Fallecido','Paciente fallecido','activo',1,'2026-01-08 23:02:30',NULL,NULL,NULL);
/*!40000 ALTER TABLE `estados_paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frecuencias_consumo`
--

DROP TABLE IF EXISTS `frecuencias_consumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `frecuencias_consumo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frecuencias_consumo`
--

LOCK TABLES `frecuencias_consumo` WRITE;
/*!40000 ALTER TABLE `frecuencias_consumo` DISABLE KEYS */;
INSERT INTO `frecuencias_consumo` VALUES (1,'OCASIONAL','Ocasional','Consumo ocasional','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(2,'SEMANAL','Semanal','Consumo semanal','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(3,'DIARIO','Diario','Consumo diario','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(4,'NUNCA','Nunca','No consume','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(5,'EX_FUMADOR','Ex-fumador','Consumió en el pasado','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL);
/*!40000 ALTER TABLE `frecuencias_consumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
INSERT INTO `generos` VALUES (1,'M','Masculino','activo',1,'2026-01-08 23:02:28',NULL,NULL),(2,'F','Femenino','activo',1,'2026-01-08 23:02:28',NULL,NULL),(3,'OTRO','Otro','inactivo',1,'2026-01-08 23:02:28',1,'2026-01-15 02:18:44');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupos_sanguineos`
--

DROP TABLE IF EXISTS `grupos_sanguineos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupos_sanguineos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupos_sanguineos`
--

LOCK TABLES `grupos_sanguineos` WRITE;
/*!40000 ALTER TABLE `grupos_sanguineos` DISABLE KEYS */;
INSERT INTO `grupos_sanguineos` VALUES (1,'A+','A Positivo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(2,'A-','A Negativo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(3,'B+','B Positivo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(4,'B-','B Negativo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(5,'AB+','AB Positivo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(6,'AB-','AB Negativo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(7,'O+','O Positivo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(8,'O-','O Negativo',NULL,'activo',1,'2026-01-08 23:02:29',NULL,NULL,NULL),(9,'DESC','Desconocido','','inactivo',1,'2026-01-08 23:02:29',1,'2026-01-15 02:27:48',NULL);
/*!40000 ALTER TABLE `grupos_sanguineos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_citas`
--

DROP TABLE IF EXISTS `historial_citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cita_id` int NOT NULL,
  `paciente_id` int NOT NULL,
  `accion_id` int NOT NULL,
  `descripcion` text,
  `datos_anteriores` json DEFAULT NULL,
  `datos_nuevos` json DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `fecha_accion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cita` (`cita_id`),
  KEY `idx_paciente` (`paciente_id`),
  KEY `idx_fecha` (`fecha_accion`),
  KEY `idx_accion` (`accion_id`),
  KEY `idx_usuario` (`usuario_id`),
  CONSTRAINT `historial_citas_ibfk_1` FOREIGN KEY (`cita_id`) REFERENCES `citas_control` (`id`) ON DELETE CASCADE,
  CONSTRAINT `historial_citas_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`),
  CONSTRAINT `historial_citas_ibfk_3` FOREIGN KEY (`accion_id`) REFERENCES `acciones_historial` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_citas`
--

LOCK TABLES `historial_citas` WRITE;
/*!40000 ALTER TABLE `historial_citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales_lentes`
--

DROP TABLE IF EXISTS `materiales_lentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiales_lentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales_lentes`
--

LOCK TABLES `materiales_lentes` WRITE;
/*!40000 ALTER TABLE `materiales_lentes` DISABLE KEYS */;
INSERT INTO `materiales_lentes` VALUES (1,'ORGANICO','Orgánico','Material orgánico (plástico)','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(2,'MINERAL','Mineral','Material mineral (vidrio)','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(3,'POLICARB','Policarbonato','Policarbonato - Resistente a impactos','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(4,'TRIVEX','Trivex','Trivex - Más delgado y resistente','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(5,'ALTA_INDICE','Alta índice','Alto índice de refracción - Más delgado','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL);
/*!40000 ALTER TABLE `materiales_lentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medicamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `principio_activo` varchar(150) DEFAULT NULL,
  `concentracion` varchar(150) DEFAULT NULL,
  `presentacion` varchar(150) DEFAULT NULL,
  `via_administracion` varchar(150) DEFAULT NULL,
  `indicaciones` text,
  `contraindicaciones` text,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocupaciones`
--

DROP TABLE IF EXISTS `ocupaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ocupaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocupaciones`
--

LOCK TABLES `ocupaciones` WRITE;
/*!40000 ALTER TABLE `ocupaciones` DISABLE KEYS */;
INSERT INTO `ocupaciones` VALUES (1,'Estudiante',NULL,'activo',1,'2026-01-08 23:02:29',1,'2026-01-12 12:52:36',3),(8,'Jubilado',NULL,'activo',1,'2026-01-08 23:02:29',1,'2026-01-12 12:52:51',4),(9,'Ama de casa',NULL,'activo',1,'2026-01-08 23:02:29',1,'2026-01-12 12:53:59',6),(10,'Desempleado',NULL,'activo',1,'2026-01-08 23:02:29',1,'2026-01-12 12:53:49',5),(11,'Otro','','activo',1,'2026-01-08 23:02:29',2,'2026-01-18 13:19:24',7),(12,'Independiente','Independiente','activo',3,'2026-01-10 16:56:29',1,'2026-01-12 12:53:26',2),(13,'Empleado',NULL,'activo',3,'2026-01-10 16:57:57',1,'2026-01-12 12:52:23',1);
/*!40000 ALTER TABLE `ocupaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_identificacion_id` int NOT NULL,
  `identificacion` varchar(50) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_pais` int DEFAULT NULL,
  `genero_id` int NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `telefono_principal` varchar(20) DEFAULT NULL,
  `telefono_secundario` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `eps_id` int DEFAULT NULL,
  `ocupacion_id` int DEFAULT NULL,
  `estado_civil_id` int DEFAULT NULL,
  `identificacion_acompaniante` varchar(50) DEFAULT NULL,
  `acompaniante_nombres` varchar(150) DEFAULT NULL,
  `acompaniante_apellidos` varchar(150) DEFAULT NULL,
  `acompaniante_telefono` varchar(20) DEFAULT NULL,
  `acompañante_email` varchar(255) DEFAULT NULL,
  `parentesco_id` int DEFAULT NULL,
  `grupo_sanguineo_id` int DEFAULT NULL,
  `foto_ruta` varchar(255) DEFAULT NULL,
  `estado_paciente_id` int DEFAULT '1',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  KEY `idx_identificacion` (`identificacion`),
  KEY `idx_nombres` (`primer_nombre`,`segundo_nombre`,`primer_apellido`,`segundo_apellido`),
  KEY `idx_fecha_nacimiento` (`fecha_nacimiento`),
  KEY `idx_eps` (`eps_id`),
  KEY `idx_usuario_inserto` (`usuario_id_inserto`),
  KEY `idx_estado_paciente` (`estado_paciente_id`),
  KEY `tipo_identificacion_id` (`tipo_identificacion_id`),
  KEY `genero_id` (`genero_id`),
  KEY `grupo_sanguineo_id` (`grupo_sanguineo_id`),
  KEY `ocupacion_id` (`ocupacion_id`),
  KEY `estado_civil_id` (`estado_civil_id`),
  KEY `parentesco_id` (`parentesco_id`),
  KEY `fk_pacientes_paises` (`id_pais`),
  CONSTRAINT `fk_pacientes_paises` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`tipo_identificacion_id`) REFERENCES `tipos_identificacion` (`id`),
  CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`),
  CONSTRAINT `pacientes_ibfk_3` FOREIGN KEY (`grupo_sanguineo_id`) REFERENCES `grupos_sanguineos` (`id`),
  CONSTRAINT `pacientes_ibfk_4` FOREIGN KEY (`eps_id`) REFERENCES `eps` (`id`),
  CONSTRAINT `pacientes_ibfk_5` FOREIGN KEY (`ocupacion_id`) REFERENCES `ocupaciones` (`id`),
  CONSTRAINT `pacientes_ibfk_6` FOREIGN KEY (`estado_civil_id`) REFERENCES `estados_civiles` (`id`),
  CONSTRAINT `pacientes_ibfk_7` FOREIGN KEY (`parentesco_id`) REFERENCES `parentescos` (`id`),
  CONSTRAINT `pacientes_ibfk_8` FOREIGN KEY (`estado_paciente_id`) REFERENCES `estados_paciente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,1,'16788965','2026-01-12','Carlos','Eduardo','Mejía','Ortiz','1970-11-29',NULL,1,'Bella suiza','Bogota','Usaquen','Cunddinamarca','3154444444','','carloseduardomejia@gmail.com',1,13,2,'','','','','',NULL,7,'',1,1,'2026-01-12 13:02:23',2,'2026-01-26 00:01:23'),(2,1,'1000149472','2026-01-16','Daniel','','Mejia','Forero','2003-01-08',NULL,1,'Carrera 7d # 127 - 10','BOGOTA','BOGOTA','cundinamarca','318555555','','pouyer07@gmail.com',1,1,1,'35511358','Claudia','Forero Manrique','315888888','claudiavivian@gmail.com',2,7,'',1,2,'2026-01-16 06:57:04',2,'2026-01-25 23:04:46'),(7,1,'262626','2026-01-16','Eduardo','antonio','Mejia','','1939-01-01',NULL,1,'Calle 123 #45-67','cali','comuna 11','valle','1234567890','','pouyerdev@gmail.com',2,12,6,'','','','','',NULL,7,'',4,1,'2026-01-16 07:52:42',3,'2026-01-24 14:19:48'),(8,1,'55555','2026-01-16','OSAMA','bin','laden','','1940-01-01',1,1,'','','','guajira','333333333','','pouyer07@gmail.com',9,8,3,'','','','','',NULL,1,'',1,1,'2026-01-16 15:46:05',2,'2026-01-26 17:55:49'),(9,1,'79424266','2026-01-25','Fernando','','Torres','Escobar','1967-10-01',44,1,'Cll 116a 70c 71','Bogota','suba','','6018691104','','ftorres_e@hotmail.com',7,13,3,'','','','','',NULL,7,'',1,1,'2026-01-26 02:04:35',2,'2026-01-26 17:55:21'),(10,3,'111222333','2026-01-26','niño','','prueba','','2021-01-01',44,1,'','Tabio','','cundinamarca','1231231234','','papa@gmail.com',2,11,1,'777888777','papa','prueba niño','1112223334','e',1,6,'',1,3,'2026-01-26 19:02:57',3,NULL);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_pais` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `indicativo` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre_pais` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `campo_ordenamiento` int DEFAULT '0',
  `estado` enum('activo','inactivo') COLLATE utf8mb4_spanish_ci DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'AFG','+93','Afganistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(2,'ALB','+355','Albania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(3,'DEU','+49','Alemania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(4,'AND','+376','Andorra',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(5,'AGO','+244','Angola',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(6,'AIA','+1 264','Anguila',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(7,'ATA','+672','Antártida',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(8,'ATG','+1 268','Antigua y Barbuda',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(9,'SAU','+966','Arabia Saudita',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(10,'DZA','+213','Argelia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(11,'ARG','+54','Argentina',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(12,'ARM','+374','Armenia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(13,'ABW','+297','Aruba',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(14,'AUS','+61','Australia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(15,'AUT','+43','Austria',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(16,'AZE','+994','Azerbaiyán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(17,'BEL','+32','Bélgica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(18,'BHS','+1 242','Bahamas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(19,'BHR','+973','Bahrein',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(20,'BGD','+880','Bangladesh',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(21,'BRB','+1 246','Barbados',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(22,'BLZ','+501','Belice',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(23,'BEN','+229','Benín',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(24,'BTN','+975','Bhután',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(25,'BLR','+375','Bielorrusia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(26,'MMR','+95','Birmania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(27,'BOL','+591','Bolivia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(28,'BIH','+387','Bosnia y Herzegovina',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(29,'BWA','+267','Botsuana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(30,'BRA','+55','Brasil',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(31,'BRN','+673','Brunéi',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(32,'BGR','+359','Bulgaria',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(33,'BFA','+226','Burkina Faso',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(34,'BDI','+257','Burundi',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(35,'CPV','+238','Cabo Verde',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(36,'KHM','+855','Camboya',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(37,'CMR','+237','Camerún',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(38,'CAN','+1','Canadá',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(39,'TCD','+235','Chad',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(40,'CHL','+56','Chile',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(41,'CHN','+86','China',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(42,'CYP','+357','Chipre',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(43,'VAT','+39','Ciudad del Vaticano',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(44,'COL','+57','Colombia',1,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(45,'COM','+269','Comoras',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(46,'COG','+242','República del Congo',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(47,'COD','+243','República Democrática del Congo',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(48,'PRK','+850','Corea del Norte',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(49,'KOR','+82','Corea del Sur',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(50,'CIV','+225','Costa de Marfil',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(51,'CRI','+506','Costa Rica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(52,'HRV','+385','Croacia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(53,'CUB','+53','Cuba',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(54,'CWU','+5999','Curazao',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(55,'DNK','+45','Dinamarca',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(56,'DMA','+1 767','Dominica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(57,'ECU','+593','Ecuador',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(58,'EGY','+20','Egipto',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(59,'SLV','+503','El Salvador',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(60,'ARE','+971','Emiratos Árabes Unidos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(61,'ERI','+291','Eritrea',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(62,'SVK','+421','Eslovaquia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(63,'SVN','+386','Eslovenia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(64,'ESP','+34','España',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(65,'USA','+1','Estados Unidos de América',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(66,'EST','+372','Estonia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(67,'ETH','+251','Etiopía',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(68,'PHL','+63','Filipinas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(69,'FIN','+358','Finlandia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(70,'FJI','+679','Fiyi',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(71,'FRA','+33','Francia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(72,'GAB','+241','Gabón',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(73,'GMB','+220','Gambia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(74,'GEO','+995','Georgia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(75,'GHA','+233','Ghana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(76,'GIB','+350','Gibraltar',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(77,'GRD','+1 473','Granada',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(78,'GRC','+30','Grecia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(79,'GRL','+299','Groenlandia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(80,'GLP','+590','Guadalupe',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(81,'GUM','+1 671','Guam',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(82,'GTM','+502','Guatemala',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(83,'GUF','+594','Guayana Francesa',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(84,'GGY','+44','Guernsey',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(85,'GIN','+224','Guinea',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(86,'GNQ','+240','Guinea Ecuatorial',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(87,'GNB','+245','Guinea-Bissau',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(88,'GUY','+592','Guyana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(89,'HTI','+509','Haití',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(90,'HND','+504','Honduras',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(91,'HKG','+852','Hong kong',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(92,'HUN','+36','Hungría',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(93,'IND','+91','India',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(94,'IDN','+62','Indonesia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(95,'IRN','+98','Irán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(96,'IRQ','+964','Irak',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(97,'IRL','+353','Irlanda',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(98,'BVT','','Isla Bouvet',100,'activo',1,'2026-01-26 15:19:10',1,'2026-01-26 18:46:53'),(99,'IMN','+44','Isla de Man',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(100,'CXR','+61','Isla de Navidad',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(101,'NFK','+672','Isla Norfolk',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(102,'ISL','+354','Islandia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(103,'BMU','+1 441','Islas Bermudas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(104,'CYM','+1 345','Islas Caimán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(105,'CCK','+61','Islas Cocos (Keeling)',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(106,'COK','+682','Islas Cook',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(107,'ALA','+358','Islas de Åland',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(108,'FRO','+298','Islas Feroe',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(109,'SGS','+500','Islas Georgias del Sur y Sandwich del Sur',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(110,'HMD','','Islas Heard y McDonald',100,'activo',1,'2026-01-26 15:19:10',1,'2026-01-26 18:47:27'),(111,'MDV','+960','Islas Maldivas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(112,'FLK','+500','Islas Malvinas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(113,'MNP','+1 670','Islas Marianas del Norte',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(114,'MHL','+692','Islas Marshall',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(115,'PCN','+870','Islas Pitcairn',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(116,'SLB','+677','Islas Salomón',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(117,'TCA','+1 649','Islas Turcas y Caicos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(118,'UMI','+246','Islas Ultramarinas Menores de Estados Unidos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(119,'VGB','+1 284','Islas Vírgenes Británicas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(120,'VIR','+1 340','Islas Vírgenes de los Estados Unidos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(121,'ISR','+972','Israel',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(122,'ITA','+39','Italia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(123,'JAM','+1 876','Jamaica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(124,'JPN','+81','Japón',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(125,'JEY','+44','Jersey',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(126,'JOR','+962','Jordania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(127,'KAZ','+7','Kazajistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(128,'KEN','+254','Kenia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(129,'KGZ','+996','Kirguistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(130,'KIR','+686','Kiribati',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(131,'KWT','+965','Kuwait',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(132,'LBN','+961','Líbano',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(133,'LAO','+856','Laos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(134,'LSO','+266','Lesoto',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(135,'LVA','+371','Letonia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(136,'LBR','+231','Liberia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(137,'LBY','+218','Libia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(138,'LIE','+423','Liechtenstein',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(139,'LTU','+370','Lituania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(140,'LUX','+352','Luxemburgo',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(141,'MEX','+52','México',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(142,'MCO','+377','Mónaco',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(143,'MAC','+853','Macao',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(144,'MKD','+389','Macedônia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(145,'MDG','+261','Madagascar',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(146,'MYS','+60','Malasia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(147,'MWI','+265','Malawi',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(148,'MLI','+223','Mali',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(149,'MLT','+356','Malta',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(150,'MAR','+212','Marruecos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(151,'MTQ','+596','Martinica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(152,'MUS','+230','Mauricio',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(153,'MRT','+222','Mauritania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(154,'MYT','+262','Mayotte',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(155,'FSM','+691','Micronesia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(156,'MDA','+373','Moldavia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(157,'MNG','+976','Mongolia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(158,'MNE','+382','Montenegro',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(159,'MSR','+1 664','Montserrat',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(160,'MOZ','+258','Mozambique',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(161,'NAM','+264','Namibia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(162,'NRU','+674','Nauru',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(163,'NPL','+977','Nepal',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(164,'NIC','+505','Nicaragua',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(165,'NER','+227','Niger',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(166,'NGA','+234','Nigeria',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(167,'NIU','+683','Niue',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(168,'NOR','+47','Noruega',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(169,'NCL','+687','Nueva Caledonia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(170,'NZL','+64','Nueva Zelanda',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(171,'OMN','+968','Omán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(172,'NLD','+31','Países Bajos',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(173,'PAK','+92','Pakistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(174,'PLW','+680','Palau',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(175,'PSE','+970','Palestina',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(176,'PAN','+507','Panamá',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(177,'PNG','+675','Papúa Nueva Guinea',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(178,'PRY','+595','Paraguay',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(179,'PER','+51','Perú',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(180,'PYF','+689','Polinesia Francesa',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(181,'POL','+48','Polonia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(182,'PRT','+351','Portugal',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(183,'PRI','+1','Puerto Rico',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(184,'QAT','+974','Qatar',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(185,'GBR','+44','Reino Unido',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(186,'CAF','+236','República Centroafricana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(187,'CZE','+420','República Checa',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(188,'DOM','+1 809','República Dominicana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(189,'SSD','+211','República de Sudán del Sur',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(190,'REU','+262','Reunión',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(191,'RWA','+250','Ruanda',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(192,'ROU','+40','Rumanía',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(193,'RUS','+7','Rusia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(194,'ESH','+212','Sahara Occidental',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(195,'WSM','+685','Samoa',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(196,'ASM','+1 684','Samoa Americana',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(197,'BLM','+590','San Bartolomé',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(198,'KNA','+1 869','San Cristóbal y Nieves',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(199,'SMR','+378','San Marino',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(200,'MAF','+1 599','San Martín (Francia)',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(201,'SPM','+508','San Pedro y Miquelón',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(202,'VCT','+1 784','San Vicente y las Granadinas',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(203,'SHN','+290','Santa Elena',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(204,'LCA','+1 758','Santa Lucía',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(205,'STP','+239','Santo Tomé y Príncipe',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(206,'SEN','+221','Senegal',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(207,'SRB','+381','Serbia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(208,'SYC','+248','Seychelles',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(209,'SLE','+232','Sierra Leona',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(210,'SGP','+65','Singapur',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(211,'SMX','+1 721','Sint Maarten',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(212,'SYR','+963','Siria',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(213,'SOM','+252','Somalia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(214,'LKA','+94','Sri lanka',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(215,'ZAF','+27','Sudáfrica',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(216,'SDN','+249','Sudán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(217,'SWE','+46','Suecia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(218,'CHE','+41','Suiza',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(219,'SUR','+597','Surinám',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(220,'SJM','+47','Svalbard y Jan Mayen',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(221,'SWZ','+268','Swazilandia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(222,'TJK','+992','Tayikistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(223,'THA','+66','Tailandia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(224,'TWN','+886','Taiwán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(225,'TZA','+255','Tanzania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(226,'IOT','+246','Territorio Británico del Océano Índico',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(227,'ATF','','Territorios Australes y Antárticas Franceses',100,'activo',1,'2026-01-26 15:19:10',1,'2026-01-26 18:47:33'),(228,'TLS','+670','Timor Oriental',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(229,'TGO','+228','Togo',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(230,'TKL','+690','Tokelau',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(231,'TON','+676','Tonga',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(232,'TTO','+1 868','Trinidad y Tobago',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(233,'TUN','+216','Tunez',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(234,'TKM','+993','Turkmenistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(235,'TUR','+90','Turquía',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(236,'TUV','+688','Tuvalu',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(237,'UKR','+380','Ucrania',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(238,'UGA','+256','Uganda',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(239,'URY','+598','Uruguay',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(240,'UZB','+998','Uzbekistán',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(241,'VUT','+678','Vanuatu',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(242,'VEN','+58','Venezuela',10,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(243,'VNM','+84','Vietnam',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(244,'WLF','+681','Wallis y Futuna',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(245,'YEM','+967','Yemen',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(246,'DJI','+253','Yibuti',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(247,'ZMB','+260','Zambia',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL),(248,'ZWE','+263','Zimbabue',100,'activo',1,'2026-01-26 15:19:10',NULL,NULL);
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentescos`
--

DROP TABLE IF EXISTS `parentescos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parentescos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentescos`
--

LOCK TABLES `parentescos` WRITE;
/*!40000 ALTER TABLE `parentescos` DISABLE KEYS */;
INSERT INTO `parentescos` VALUES (1,'Padre','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:42:51',2),(2,'Madre','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:42:20',1),(4,'Familiar','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:46:27',6),(5,'Esposo(a)','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:43:15',3),(8,'Abuelo(a)','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:43:29',4),(10,'Otro','activo',1,'2026-01-08 23:02:30',1,'2026-01-12 13:47:01',7);
/*!40000 ALTER TABLE `parentescos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesionales_salud`
--

DROP TABLE IF EXISTS `profesionales_salud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profesionales_salud` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_identificacion_id` int NOT NULL,
  `identificacion` varchar(50) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero_id` int DEFAULT NULL,
  `tipo_profesional_id` int NOT NULL,
  `especialidad` varchar(150) DEFAULT NULL,
  `registro_profesional` varchar(150) DEFAULT NULL,
  `universidad` varchar(255) DEFAULT NULL,
  `anio_graduacion` year DEFAULT NULL,
  `telefono_principal` varchar(20) DEFAULT NULL,
  `telefono_secundario` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `jornada` varchar(50) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `uniq_usuario_id` (`usuario_id`),
  KEY `idx_identificacion` (`identificacion`),
  KEY `idx_nombres` (`primer_nombre`,`primer_apellido`),
  KEY `idx_tipo_profesional` (`tipo_profesional_id`),
  KEY `idx_disponible` (`disponible`),
  KEY `tipo_identificacion_id` (`tipo_identificacion_id`),
  KEY `genero_id` (`genero_id`),
  CONSTRAINT `fk_profesional_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `acc_usuario` (`id_usuario`),
  CONSTRAINT `profesionales_salud_ibfk_1` FOREIGN KEY (`tipo_identificacion_id`) REFERENCES `tipos_identificacion` (`id`),
  CONSTRAINT `profesionales_salud_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`),
  CONSTRAINT `profesionales_salud_ibfk_3` FOREIGN KEY (`tipo_profesional_id`) REFERENCES `tipos_profesional` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesionales_salud`
--

LOCK TABLES `profesionales_salud` WRITE;
/*!40000 ALTER TABLE `profesionales_salud` DISABLE KEYS */;
INSERT INTO `profesionales_salud` VALUES (1,1,'987654321','Carlos',NULL,'Gómez',NULL,NULL,1,2,'Córnea y Segmento Anterior','12345',NULL,NULL,'3101234567',NULL,'carlos.gomez@clinica.com',NULL,NULL,NULL,1,1,'2026-01-08 23:05:36',2,'2026-01-10 15:10:23',NULL),(2,1,'35555555','Luz','Dary','Forero','Forero','1986-01-01',2,2,'','12346','Universidad la salle',NULL,'3101234568','','LuzDary@clinica.com','','2000-01-03','',1,1,'2026-01-08 23:05:36',NULL,'2026-01-15 03:53:51',2),(3,1,'987654323','Luisa','','Martínez','',NULL,2,3,'Baja Visión','12347','',NULL,'3101234569','','luis.martinez@clinica.com','',NULL,'',1,1,'2026-01-08 23:05:36',NULL,'2026-01-16 04:07:52',NULL);
/*!40000 ALTER TABLE `profesionales_salud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_consulta`
--

DROP TABLE IF EXISTS `tipos_consulta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_consulta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_consulta`
--

LOCK TABLES `tipos_consulta` WRITE;
/*!40000 ALTER TABLE `tipos_consulta` DISABLE KEYS */;
INSERT INTO `tipos_consulta` VALUES (1,'PRIMERA','Primera vez','Primera consulta del paciente',NULL,'activo',1,'2026-01-08 23:02:31',1,'2026-01-12 13:31:27',1),(2,'CONTROL','Control','Consulta de control',NULL,'activo',1,'2026-01-08 23:02:31',1,'2026-01-12 13:31:35',2),(3,'URGENCIA','Urgencia','Consulta de urgencia',NULL,'activo',1,'2026-01-08 23:02:31',1,'2026-01-12 13:33:47',3);
/*!40000 ALTER TABLE `tipos_consulta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_diabetes`
--

DROP TABLE IF EXISTS `tipos_diabetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_diabetes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_diabetes`
--

LOCK TABLES `tipos_diabetes` WRITE;
/*!40000 ALTER TABLE `tipos_diabetes` DISABLE KEYS */;
INSERT INTO `tipos_diabetes` VALUES (1,'TIPO1','Tipo 1','Diabetes tipo 1','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(2,'TIPO2','Tipo 2','Diabetes tipo 2','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(3,'GESTACIONAL','Gestacional','Diabetes gestacional','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(4,'PREDIABETES','Prediabetes','Estado prediabético','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL),(5,'OTRO','Otro','Otro tipo de diabetes','activo',1,'2026-01-08 23:02:33',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tipos_diabetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_identificacion`
--

DROP TABLE IF EXISTS `tipos_identificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_identificacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_identificacion`
--

LOCK TABLES `tipos_identificacion` WRITE;
/*!40000 ALTER TABLE `tipos_identificacion` DISABLE KEYS */;
INSERT INTO `tipos_identificacion` VALUES (1,'CC','Cédula de Ciudadanía',NULL,'activo',1,'2026-01-08 23:02:28',1,'2026-01-12 12:34:25',1),(2,'CE','Cédula de Extranjería',NULL,'activo',1,'2026-01-08 23:02:28',1,'2026-01-12 12:35:28',3),(3,'TI','Tarjeta de Identidad',NULL,'activo',1,'2026-01-08 23:02:28',1,'2026-01-12 12:34:45',2),(4,'RC','Registro Civil',NULL,'activo',1,'2026-01-08 23:02:28',1,'2026-01-12 12:35:05',4),(5,'PA','Pasaporte',NULL,'activo',1,'2026-01-08 23:02:28',1,'2026-01-12 12:35:48',5),(6,'MS','Menor sin identificación','','inactivo',1,'2026-01-08 23:02:28',1,'2026-01-16 06:21:59',8),(7,'AS','Adulto sin identificación','','inactivo',1,'2026-01-08 23:02:28',1,'2026-01-15 02:07:49',7);
/*!40000 ALTER TABLE `tipos_identificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_lentes`
--

DROP TABLE IF EXISTS `tipos_lentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_lentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_lentes`
--

LOCK TABLES `tipos_lentes` WRITE;
/*!40000 ALTER TABLE `tipos_lentes` DISABLE KEYS */;
INSERT INTO `tipos_lentes` VALUES (1,'MONOFOCAL','Monofocal','Lentes monofocales','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(2,'BIFOCAL','Bifocal','Lentes bifocales','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(3,'PROGRESIVO','Progresivo','Lentes progresivos','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(4,'CONTACTO','Lentes de Contacto','Lentes de contacto','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(5,'FOTOSENSIBLE','Fotosensible','Lentes fotosensibles','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL),(6,'PROTECCION','Protección','Lentes de protección','activo',1,'2026-01-08 23:02:31',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tipos_lentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_origen_enfermedad`
--

DROP TABLE IF EXISTS `tipos_origen_enfermedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_origen_enfermedad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_origen_enfermedad`
--

LOCK TABLES `tipos_origen_enfermedad` WRITE;
/*!40000 ALTER TABLE `tipos_origen_enfermedad` DISABLE KEYS */;
INSERT INTO `tipos_origen_enfermedad` VALUES (1,'CONGENITO','Congénito','Presente desde el nacimiento','activo',1,'2026-01-08 23:02:32',NULL,NULL),(2,'TRAUMATICO','Traumático','Causado por trauma o accidente','activo',1,'2026-01-08 23:02:32',NULL,NULL),(3,'DEGENERATIVO','Degenerativo','Progresivo por edad o enfermedad','activo',1,'2026-01-08 23:02:32',NULL,NULL),(4,'INFECCIOSO','Infeccioso','Causado por infección','activo',1,'2026-01-08 23:02:32',NULL,NULL),(5,'METABOLICO','Metabólico','Relacionado con enfermedades metabólicas','activo',1,'2026-01-08 23:02:32',NULL,NULL),(6,'IDIOPATICO','Idiopático','Causa desconocida','activo',1,'2026-01-08 23:02:32',NULL,NULL),(7,'HEREDITARIO','Hereditario','Transmitido genéticamente','activo',1,'2026-01-08 23:02:32',NULL,NULL),(8,'AMBIENTAL','Ambiental','Factores ambientales','activo',1,'2026-01-08 23:02:32',NULL,NULL),(9,'OTRO','Otro','Otra causa','activo',1,'2026-01-08 23:02:32',NULL,NULL);
/*!40000 ALTER TABLE `tipos_origen_enfermedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_profesional`
--

DROP TABLE IF EXISTS `tipos_profesional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipos_profesional` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_profesional`
--

LOCK TABLES `tipos_profesional` WRITE;
/*!40000 ALTER TABLE `tipos_profesional` DISABLE KEYS */;
INSERT INTO `tipos_profesional` VALUES (1,'OFTALMOLOGO','Oftalmólogo',NULL,'activo',1,'2026-01-08 23:05:36',NULL,NULL),(2,'OPTOMETRA','Optómetra',NULL,'activo',1,'2026-01-08 23:05:36',NULL,NULL),(3,'ASISTENTE','Asistente',NULL,'activo',1,'2026-01-08 23:05:36',NULL,NULL),(4,'ENFERMERO','Enfermero',NULL,'activo',1,'2026-01-08 23:05:36',NULL,NULL);
/*!40000 ALTER TABLE `tipos_profesional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usos_lentes`
--

DROP TABLE IF EXISTS `usos_lentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usos_lentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `usuario_id_inserto` int NOT NULL,
  `fecha_insercion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id_actualizo` int DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usos_lentes`
--

LOCK TABLES `usos_lentes` WRITE;
/*!40000 ALTER TABLE `usos_lentes` DISABLE KEYS */;
INSERT INTO `usos_lentes` VALUES (1,'PERMANENTE','Permanente','Uso permanente','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(2,'LECTURA','Lectura','Solo para lectura','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(3,'COMPUTADOR','Computador','Uso para computador','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(4,'CONDUCCION','Conducción','Uso para conducir','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(5,'OCASIONAL','Ocasional','Uso ocasional','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL),(6,'DEPORTE','Deporte','Uso deportivo','activo',1,'2026-01-08 23:02:32',NULL,NULL,NULL);
/*!40000 ALTER TABLE `usos_lentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_acc_menu`
--

DROP TABLE IF EXISTS `v_acc_menu`;
/*!50001 DROP VIEW IF EXISTS `v_acc_menu`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_menu` AS SELECT 
 1 AS `nombre_menu`,
 1 AS `ruta_programa`,
 1 AS `nombre_programaPHP`,
 1 AS `username`,
 1 AS `id_usuario`,
 1 AS `modulo`,
 1 AS `icono_modulo`,
 1 AS `icono_programa`,
 1 AS `modulo_orden`,
 1 AS `programa_orden`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_modulo`
--

DROP TABLE IF EXISTS `v_acc_modulo`;
/*!50001 DROP VIEW IF EXISTS `v_acc_modulo`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_modulo` AS SELECT 
 1 AS `id_modulo`,
 1 AS `nombre_modulo`,
 1 AS `icono`,
 1 AS `orden`,
 1 AS `estado`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_programa`
--

DROP TABLE IF EXISTS `v_acc_programa`;
/*!50001 DROP VIEW IF EXISTS `v_acc_programa`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_programa` AS SELECT 
 1 AS `id_programas`,
 1 AS `nombre_menu`,
 1 AS `icono`,
 1 AS `ruta`,
 1 AS `nombre_archivo`,
 1 AS `id_modulo`,
 1 AS `orden`,
 1 AS `estado`,
 1 AS `nombre_modulo`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_programa_x_rol`
--

DROP TABLE IF EXISTS `v_acc_programa_x_rol`;
/*!50001 DROP VIEW IF EXISTS `v_acc_programa_x_rol`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_programa_x_rol` AS SELECT 
 1 AS `id_programas`,
 1 AS `nombre_programa`,
 1 AS `id_rol`,
 1 AS `nombre_rol`,
 1 AS `permiso_insertar`,
 1 AS `permiso_actualizar`,
 1 AS `permiso_eliminar`,
 1 AS `permiso_exportar`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_rol`
--

DROP TABLE IF EXISTS `v_acc_rol`;
/*!50001 DROP VIEW IF EXISTS `v_acc_rol`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_rol` AS SELECT 
 1 AS `id_rol`,
 1 AS `nombre_rol`,
 1 AS `estado`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_rol_x_usuario`
--

DROP TABLE IF EXISTS `v_acc_rol_x_usuario`;
/*!50001 DROP VIEW IF EXISTS `v_acc_rol_x_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_rol_x_usuario` AS SELECT 
 1 AS `id_usuario`,
 1 AS `fullname`,
 1 AS `username`,
 1 AS `id_rol`,
 1 AS `nombre_rol`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_acc_usuario`
--

DROP TABLE IF EXISTS `v_acc_usuario`;
/*!50001 DROP VIEW IF EXISTS `v_acc_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_acc_usuario` AS SELECT 
 1 AS `id_usuario`,
 1 AS `username`,
 1 AS `fullname`,
 1 AS `correo`,
 1 AS `password`,
 1 AS `estado`,
 1 AS `fecha_creacion`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'opticaApp'
--
/*!50003 DROP FUNCTION IF EXISTS `f_anos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`optica_usr`@`%` FUNCTION `f_anos`(fecha_inicio DATE) RETURNS varchar(100) CHARSET utf8mb4
    READS SQL DATA
BEGIN
    DECLARE total_meses INT;
    DECLARE v_anos INT; -- Evita usar 'años' (la ñ puede dar problemas de encoding)
    DECLARE v_meses INT;
    DECLARE resultado VARCHAR(100);

    -- Calculamos la diferencia total en meses
    SET total_meses = TIMESTAMPDIFF(MONTH, fecha_inicio, CURDATE());

    -- Si la fecha ingresada es mayor a la actual
    IF total_meses < 0 THEN
        RETURN 'La fecha ingresada es posterior a la actual';
    END IF;

    -- Obtenemos los años y meses
    SET v_anos = FLOOR(total_meses / 12);
    SET v_meses = total_meses % 12;

    -- Concatenamos el resultado
    SET resultado = CONCAT(v_anos, ' años y ', v_meses, ' meses');

    RETURN resultado;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `v_acc_menu`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`optica_usr`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_menu` AS select distinct `p`.`nombre_menu` AS `nombre_menu`,`p`.`ruta` AS `ruta_programa`,`p`.`nombre_archivo` AS `nombre_programaPHP`,`u`.`username` AS `username`,`u`.`id_usuario` AS `id_usuario`,`m`.`nombre_modulo` AS `modulo`,`m`.`icono` AS `icono_modulo`,`p`.`icono` AS `icono_programa`,`m`.`orden` AS `modulo_orden`,`p`.`orden` AS `programa_orden` from (((((`acc_usuario` `u` join `acc_rol_x_usuario` `ru` on((`ru`.`id_usuario` = `u`.`id_usuario`))) join `acc_programa_x_rol` `pr` on((`pr`.`id_rol` = `ru`.`id_rol`))) join `acc_rol` `r` on((`r`.`id_rol` = `pr`.`id_rol`))) join `acc_programa` `p` on((`p`.`id_programas` = `pr`.`id_programas`))) join `acc_modulo` `m` on((`m`.`id_modulo` = `p`.`id_modulo`))) where ((`u`.`estado` = 'activo') and (`p`.`estado` = 'activo') and (`r`.`estado` = 'activo') and (`m`.`estado` = 'activo')) order by `m`.`orden`,`m`.`nombre_modulo`,`p`.`orden`,`p`.`nombre_menu`,`u`.`username` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_modulo`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_modulo`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_modulo` AS select `m`.`id_modulo` AS `id_modulo`,`m`.`nombre_modulo` AS `nombre_modulo`,`m`.`icono` AS `icono`,`m`.`orden` AS `orden`,`m`.`estado` AS `estado`,`m`.`fecha_insercion` AS `fecha_creacion` from `acc_modulo` `m` order by `m`.`nombre_modulo` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_programa`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_programa`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_programa` AS select `p`.`id_programas` AS `id_programas`,`p`.`nombre_menu` AS `nombre_menu`,`p`.`icono` AS `icono`,`p`.`ruta` AS `ruta`,`p`.`nombre_archivo` AS `nombre_archivo`,`p`.`id_modulo` AS `id_modulo`,`p`.`orden` AS `orden`,`p`.`estado` AS `estado`,`m`.`nombre_modulo` AS `nombre_modulo`,`p`.`fecha_insercion` AS `fecha_creacion` from (`acc_programa` `p` left join `acc_modulo` `m` on((`m`.`id_modulo` = `p`.`id_modulo`))) order by `p`.`nombre_menu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_programa_x_rol`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_programa_x_rol`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_programa_x_rol` AS select `pr`.`id_programas` AS `id_programas`,`p`.`nombre_menu` AS `nombre_programa`,`pr`.`id_rol` AS `id_rol`,`r`.`nombre_rol` AS `nombre_rol`,`pr`.`permiso_insertar` AS `permiso_insertar`,`pr`.`permiso_actualizar` AS `permiso_actualizar`,`pr`.`permiso_eliminar` AS `permiso_eliminar`,`pr`.`permiso_exportar` AS `permiso_exportar`,`pr`.`fecha_insercion` AS `fecha_creacion` from ((`acc_programa_x_rol` `pr` join `acc_programa` `p` on((`p`.`id_programas` = `pr`.`id_programas`))) join `acc_rol` `r` on((`r`.`id_rol` = `pr`.`id_rol`))) order by `r`.`nombre_rol`,`p`.`nombre_menu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_rol`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_rol`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_rol` AS select `r`.`id_rol` AS `id_rol`,`r`.`nombre_rol` AS `nombre_rol`,`r`.`estado` AS `estado`,`r`.`fecha_insercion` AS `fecha_creacion` from `acc_rol` `r` order by `r`.`nombre_rol` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_rol_x_usuario`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_rol_x_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_rol_x_usuario` AS select `ru`.`id_usuario` AS `id_usuario`,`u`.`fullname` AS `fullname`,`u`.`username` AS `username`,`ru`.`id_rol` AS `id_rol`,`r`.`nombre_rol` AS `nombre_rol`,`ru`.`fecha_insercion` AS `fecha_creacion` from ((`acc_rol_x_usuario` `ru` join `acc_usuario` `u` on((`u`.`id_usuario` = `ru`.`id_usuario`))) join `acc_rol` `r` on((`r`.`id_rol` = `ru`.`id_rol`))) order by `u`.`fullname`,`u`.`username`,`r`.`nombre_rol` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_acc_usuario`
--

/*!50001 DROP VIEW IF EXISTS `v_acc_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acc_usuario` AS select `u`.`id_usuario` AS `id_usuario`,`u`.`username` AS `username`,`u`.`fullname` AS `fullname`,`u`.`correo` AS `correo`,`u`.`password` AS `password`,`u`.`estado` AS `estado`,`u`.`fecha_insercion` AS `fecha_creacion` from `acc_usuario` `u` order by `u`.`fullname` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-26 16:35:25
