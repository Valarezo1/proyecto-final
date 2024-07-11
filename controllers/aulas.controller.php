<?php
require_once('../models/Aulas.models.php'); // Asumiendo que este archivo define Aula_Model
$aula = new Clase_Aula(); // Instancia del modelo de Aula

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $aula->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron aulas.");
            }
            break;
        case "insertar":
            if (isset($_POST["nombre_aula"], $_POST["capacidad"])) {
                $nombre_aula = $_POST["nombre_aula"];
                $capacidad = $_POST["capacidad"];
                $resultado = $aula->insertar($nombre_aula, $capacidad);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar el aula: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar el aula.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_aula"], $_POST["nombre_aula"], $_POST["capacidad"])) {
                $id_aula = $_POST["id_aula"];
                $nombre_aula = $_POST["nombre_aula"];
                $capacidad = $_POST["capacidad"];
                $resultado = $aula->actualizar($id_aula, $nombre_aula, $capacidad);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados del aula
                    $aulaActualizada = $aula->obtenerPorId($id_aula);
                    if ($aulaActualizada) {
                        echo json_encode($aulaActualizada);
                    } else {
                        echo json_encode("Error al obtener el aula actualizada.");
                    }
                } else {
                    echo json_encode("Error al actualizar el aula: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar el aula.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_aula"])) {
                $id_aula = $_POST["id_aula"];
                $resultado = $aula->eliminar($id_aula);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar el aula: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar el aula.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_aula"])) {
                $id_aula = $_GET["id_aula"];
                $aulaDetalle = $aula->obtenerPorId($id_aula);
                if ($aulaDetalle) {
                    echo json_encode($aulaDetalle);
                } else {
                    echo json_encode("No se encontró el aula.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle del aula.");
            }
            break;
        default:
            echo json_encode("Operación no válida.");
            break;
    }
} else {
    echo json_encode("No se especificó la operación.");
}
?>
