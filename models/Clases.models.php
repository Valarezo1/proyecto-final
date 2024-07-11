<?php
require_once('../config/conexion.php');

class Clases_Model {
    public function todos() {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM clases";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $clases = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $clases[] = $fila;
            }
            
            return $clases;
        } catch (Exception $e) {
            error_log("Error en la consulta todos() de clases: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($id_asignatura, $id_profesor, $horario) {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO clases (id_asignatura, id_profesor, horario) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("iis", $id_asignatura, $id_profesor, $horario);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar clase: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id_clase, $id_asignatura, $id_profesor, $horario) {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE clases SET id_asignatura=?, id_profesor=?, horario=? WHERE id_clase=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("iisi", $id_asignatura, $id_profesor, $horario, $id_clase);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar clase: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id_clase) {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM clases WHERE id_clase=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_clase);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar clase: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id_clase) {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM clases WHERE id_clase=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_clase);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $clase = $resultado->fetch_assoc();
                return $clase;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener clase por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}
?>
