<?php
require_once('../models/Asignaturas.models.php'); // Assuming this file defines Clase_Asignatura
$asignatura = new Clase_Asignaturas(); // Instantiate your Asignatura model

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todas":
            $datos = $asignatura->todas();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron asignaturas.");
            }
            break;
        case "insertar":
            if (isset($_POST["nombre_asignatura"], $_POST["creditos"])) {
                $nombre_asignatura = $_POST["nombre_asignatura"];
                $creditos = $_POST["creditos"];
                $resultado = $asignatura->insertar($nombre_asignatura, $creditos);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar la asignatura: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar la asignatura.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_asignatura"], $_POST["nombre_asignatura"], $_POST["creditos"])) {
                $id_asignatura = $_POST["id_asignatura"];
                $nombre_asignatura = $_POST["nombre_asignatura"];
                $creditos = $_POST["creditos"];
                $resultado = $asignatura->actualizar($id_asignatura, $nombre_asignatura, $creditos);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados de la asignatura
                    $asignaturaActualizado = $asignatura->obtenerPorId($id_asignatura);
                    if ($asignaturaActualizado) {
                        echo json_encode($asignaturaActualizado);
                    } else {
                        echo json_encode("Error al obtener la asignatura actualizada.");
                    }
                } else {
                    echo json_encode("Error al actualizar la asignatura: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar la asignatura.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_asignatura"])) {
                $id_asignatura = $_POST["id_asignatura"];
                $resultado = $asignatura->eliminar($id_asignatura);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar la asignatura: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar la asignatura.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_asignatura"])) {
                $id_asignatura = $_GET["id_asignatura"];
                $asignaturaDetalle = $asignatura->obtenerPorId($id_asignatura);
                if ($asignaturaDetalle) {
                    echo json_encode($asignaturaDetalle);
                } else {
                    echo json_encode("No se encontró la asignatura.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle de la asignatura.");
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
