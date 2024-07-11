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

    public function insertar($nombre, $apellido, $fecha_nacimiento)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "INSERT INTO profesores (nombre, apellido, fecha_nacimiento) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sss", $nombre, $apellido, $fecha_nacimiento);
            
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

    public function actualizar($id_profesor, $nombre, $apellido, $fecha_nacimiento)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "UPDATE profesores SET nombre = ?, apellido = ?, fecha_nacimiento = ? WHERE id_profesor = ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("sssi", $nombre, $apellido, $fecha_nacimiento, $id_profesor);
            
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

    public function eliminar($id_profesor)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "DELETE FROM profesores WHERE id_profesor = ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_profesor);
            
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

    public function obtenerPorId($id_profesor)
    {
        try {
            $con = new Clase_Conectar();
            $conexion = $con->Procedimiento_Conectar();
            
            $consulta = "SELECT * FROM profesores WHERE id_profesor = ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("i", $id_profesor);
            
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

// Handle the URL parameters
if (isset($_GET['op'])) {
    $profesor = new Clase_Profesor();
    
    switch ($_GET['op']) {
        case 'todos':
            $resultados = $profesor->todos();
            if ($resultados !== false) {
                echo json_encode($resultados);
            } else {
                echo json_encode(array('error' => 'Error retrieving profesores.'));
            }
            break;
        
        case 'insertar':
            if (isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['fecha_nacimiento'])) {
                $nombre = $_GET['nombre'];
                $apellido = $_GET['apellido'];
                $fecha_nacimiento = $_GET['fecha_nacimiento'];
                
                $resultado = $profesor->insertar($nombre, $apellido, $fecha_nacimiento);
                
                if ($resultado === "ok") {
                    echo json_encode(array('mensaje' => 'Inserción exitosa.'));
                } else {
                    echo json_encode(array('error' => 'Error al insertar profesor.'));
                }
            } else {
                echo json_encode(array('error' => 'Parámetros insuficientes para la inserción.'));
            }
            break;
        
        case 'actualizar':
            if (isset($_GET['id_profesor']) && isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['fecha_nacimiento'])) {
                $id_profesor = $_GET['id_profesor'];
                $nombre = $_GET['nombre'];
                $apellido = $_GET['apellido'];
                $fecha_nacimiento = $_GET['fecha_nacimiento'];
                
                $resultado = $profesor->actualizar($id_profesor, $nombre, $apellido, $fecha_nacimiento);
                
                if ($resultado === "ok") {
                    echo json_encode(array('mensaje' => 'Actualización exitosa.'));
                } else {
                    echo json_encode(array('error' => 'Error al actualizar profesor.'));
                }
            } else {
                echo json_encode(array('error' => 'Parámetros insuficientes para la actualización.'));
            }
            break;
        
        case 'eliminar':
            if (isset($_GET['id_profesor'])) {
                $id_profesor = $_GET['id_profesor'];
                
                $resultado = $profesor->eliminar($id_profesor);
                
                if ($resultado === "ok") {
                    echo json_encode(array('mensaje' => 'Eliminación exitosa.'));
                } else {
                    echo json_encode(array('error' => 'Error al eliminar profesor.'));
                }
            } else {
                echo json_encode(array('error' => 'ID de profesor no especificado para eliminación.'));
            }
            break;
        
        case 'detalle':
            if (isset($_GET['id_profesor'])) {
                $id_profesor = $_GET['id_profesor'];
                
                $resultado = $profesor->obtenerPorId($id_profesor);
                
                if ($resultado !== false) {
                    echo json_encode($resultado);
                } else {
                    echo json_encode(array('error' => 'Error al obtener detalle del profesor.'));
                }
            } else {
                echo json_encode(array('error' => 'ID de profesor no especificado para detalle.'));
            }
            break;
        
        default:
            echo json_encode(array('error' => 'Operación no válida.'));
            break;
    }
} else {
    echo json_encode(array('error' => 'Operación no especificada.'));
}
?>