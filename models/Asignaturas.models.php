<?php

require_once('../config/conexion.php');

class Clase_Asignaturas
{
    public function todas()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM asignaturas";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $asignaturas = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $asignaturas[] = $fila;
            }
            
            return $asignaturas;
        } catch (Exception $e) {
            error_log("Error en la consulta todas() de asignaturas: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($nombre_asignatura, $creditos)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO asignaturas (nombre_asignatura, creditos) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("si", $nombre_asignatura, $creditos);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar asignatura: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id_asignatura, $nombre_asignatura, $creditos)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE asignaturas SET nombre_asignatura=?, creditos=? WHERE id_asignatura=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sii", $nombre_asignatura, $creditos, $id_asignatura);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar asignatura: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function eliminar($id_asignatura)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM asignaturas WHERE id_asignatura=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_asignatura);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar asignatura: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function obtenerPorId($id_asignatura)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM asignaturas WHERE id_asignatura=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_asignatura);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $asignatura = $resultado->fetch_assoc();
                return $asignatura;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener asignatura por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}
?>
