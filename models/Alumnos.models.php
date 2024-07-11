<?php

require_once('../config/conexion.php');

class Clase_Alumno
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM alumnos";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $alumnos = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $alumnos[] = $fila;
            }
            
            return $alumnos;
        } catch (Exception $e) {
            error_log("Error en la consulta todos() de alumnos: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($nombre, $apellido, $fecha_nacimiento)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO alumnos (nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sss", $nombre, $apellido, $fecha_nacimiento);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar alumno: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id, $nombre, $apellido, $fecha_nacimiento)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE alumnos SET nombre=?, apellido=?, fecha_nacimiento=? WHERE id_alumno=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sssi", $nombre, $apellido, $fecha_nacimiento, $id);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar alumno: " . $e->getMessage());
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
            
            $consulta = "DELETE FROM alumnos WHERE id_alumno=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar alumno: " . $e->getMessage());
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
            
            $consulta = "SELECT * FROM alumnos WHERE id_alumno=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $alumno = $resultado->fetch_assoc();
                return $alumno;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener alumno por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>
