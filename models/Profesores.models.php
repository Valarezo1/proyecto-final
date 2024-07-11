<?php

require_once('../config/conexion.php');

class Clase_Profesor
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM profesores";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $profesores = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $profesores[] = $fila;
            }
            
            return $profesores;
        } catch (Exception $e) {
            error_log("Error en la consulta todos() de profesores: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($nombre, $apellido, $especialidad)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO profesores (nombre, apellido, especialidad) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sss", $nombre, $apellido, $especialidad);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar profesor: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id, $nombre, $apellido, $especialidad)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE profesores SET nombre=?, apellido=?, especialidad=? WHERE id_profesor=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sssi", $nombre, $apellido, $especialidad, $id);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar profesor: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM profesores WHERE id_profesor=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar profesor: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM profesores WHERE id_profesor=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $profesor = $resultado->fetch_assoc();
                return $profesor;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener profesor por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>
