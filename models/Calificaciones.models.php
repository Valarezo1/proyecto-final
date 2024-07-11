<?php

require_once('../config/conexion.php');

class Clase_Calificacion
{
    public function todas()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM calificaciones";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $calificaciones = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $calificaciones[] = $fila;
            }
            
            return $calificaciones;
        } catch (Exception $e) {
            error_log("Error en la consulta todas() de calificaciones: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($id_matricula, $nota)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO calificaciones (id_matricula, nota) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("ii", $id_matricula, $nota);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar calificación: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id_calificacion, $id_matricula, $nota)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE calificaciones SET id_matricula=?, nota=? WHERE id_calificacion=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("iii", $id_matricula, $nota, $id_calificacion);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar calificación: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id_calificacion)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM calificaciones WHERE id_calificacion=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_calificacion);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar calificación: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id_calificacion)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM calificaciones WHERE id_calificacion=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_calificacion);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $calificacion = $resultado->fetch_assoc();
                return $calificacion;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener calificación por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>
