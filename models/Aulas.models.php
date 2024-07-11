<?php

require_once('../config/conexion.php');

class Clase_Aula
{
    public function todos()
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM aulas";
            $resultado = mysqli_query($conexion, $consulta);
            
            if ($resultado === false) {
                throw new Exception(mysqli_error($conexion));
            }
            
            $aulas = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $aulas[] = $fila;
            }
            
            return $aulas;
        } catch (Exception $e) {
            error_log("Error en la consulta todos() de aulas: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function insertar($nombre_aula, $capacidad)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO aulas (nombre_aula, capacidad) VALUES (?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("si", $nombre_aula, $capacidad);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al insertar aula: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }

    public function actualizar($id, $nombre_aula, $capacidad)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE aulas SET nombre_aula=?, capacidad=? WHERE id_aula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sii", $nombre_aula, $capacidad, $id);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al actualizar aula: " . $e->getMessage());
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
            
            $consulta = "DELETE FROM aulas WHERE id_aula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return "ok";
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al eliminar aula: " . $e->getMessage());
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
            
            $consulta = "SELECT * FROM aulas WHERE id_aula=?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $resultado = $stmt->get_result();
                $aula = $resultado->fetch_assoc();
                return $aula;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            error_log("Error al obtener aula por ID: " . $e->getMessage());
            return false;
        } finally {
            if (isset($conexion)) {
                $conexion->close();
            }
        }
    }
}

?>
