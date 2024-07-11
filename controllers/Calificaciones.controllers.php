<?php
require_once('../models/Calificaciones.models.php'); // Assuming this file defines Calificacion_Model
$calificacion = new Clase_Calificacion(); // Instantiate your Calificacion model

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todas":
            $datos = $calificacion->todas();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron calificaciones.");
            }
            break;
        case "insertar":
            if (isset($_POST["id_matricula"], $_POST["nota"])) {
                $id_matricula = $_POST["id_matricula"];
                $nota = $_POST["nota"];
                $resultado = $calificacion->insertar($id_matricula, $nota);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar la calificación: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar la calificación.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_calificacion"], $_POST["id_matricula"], $_POST["nota"])) {
                $id_calificacion = $_POST["id_calificacion"];
                $id_matricula = $_POST["id_matricula"];
                $nota = $_POST["nota"];
                $resultado = $calificacion->actualizar($id_calificacion, $id_matricula, $nota);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados de la calificación
                    $calificacionActualizada = $calificacion->obtenerPorId($id_calificacion);
                    if ($calificacionActualizada) {
                        echo json_encode($calificacionActualizada);
                    } else {
                        echo json_encode("Error al obtener la calificación actualizada.");
                    }
                } else {
                    echo json_encode("Error al actualizar la calificación: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar la calificación.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_calificacion"])) {
                $id_calificacion = $_POST["id_calificacion"];
                $resultado = $calificacion->eliminar($id_calificacion);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar la calificación: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar la calificación.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_calificacion"])) {
                $id_calificacion = $_GET["id_calificacion"];
                $calificacionDetalle = $calificacion->obtenerPorId($id_calificacion);
                if ($calificacionDetalle) {
                    echo json_encode($calificacionDetalle);
                } else {
                    echo json_encode("No se encontró la calificación.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle de la calificación.");
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
