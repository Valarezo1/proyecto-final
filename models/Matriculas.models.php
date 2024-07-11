<?php

require_once('../config/conexion.php');

class Clase_Matricula
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM matriculas";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $matriculas = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $matriculas[] = $fila;
            }
            
            return $matriculas;
        } catch (Exception $e) {
            error_log("Error en la consulta todos() de matriculas: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($id_alumno, $id_clase, $fecha_matricula)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO matriculas (id_alumno, id_clase, fecha_matricula) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("iis", $id_alumno, $id_clase, $fecha_matricula);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar matricula: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id_matricula, $id_alumno, $id_clase, $fecha_matricula)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE matriculas SET id_alumno=?, id_clase=?, fecha_matricula=? WHERE id_matricula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("iisi", $id_alumno, $id_clase, $fecha_matricula, $id_matricula);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar matricula: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id_matricula)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM matriculas WHERE id_matricula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_matricula);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar matricula: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id_matricula)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM matriculas WHERE id_matricula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_matricula);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $matricula = $resultado->fetch_assoc();
                return $matricula;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener matricula por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>
