<?php
require_once('../models/Matriculas.models.php'); // Assuming this file defines Clase_Matricula
$matricula = new Clase_Matricula(); // Instantiate your Matricula model

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $matricula->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron matriculas.");
            }
            break;
        case "insertar":
            if (isset($_POST["id_alumno"], $_POST["id_clase"], $_POST["fecha_matricula"])) {
                $id_alumno = $_POST["id_alumno"];
                $id_clase = $_POST["id_clase"];
                $fecha_matricula = $_POST["fecha_matricula"];
                $resultado = $matricula->insertar($id_alumno, $id_clase, $fecha_matricula);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar la matricula: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar la matricula.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_matricula"], $_POST["id_alumno"], $_POST["id_clase"], $_POST["fecha_matricula"])) {
                $id_matricula = $_POST["id_matricula"];
                $id_alumno = $_POST["id_alumno"];
                $id_clase = $_POST["id_clase"];
                $fecha_matricula = $_POST["fecha_matricula"];
                $resultado = $matricula->actualizar($id_matricula, $id_alumno, $id_clase, $fecha_matricula);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados de la matricula
                    $matriculaActualizada = $matricula->obtenerPorId($id_matricula);
                    if ($matriculaActualizada) {
                        echo json_encode($matriculaActualizada);
                    } else {
                        echo json_encode("Error al obtener la matricula actualizada.");
                    }
                } else {
                    echo json_encode("Error al actualizar la matricula: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar la matricula.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_matricula"])) {
                $id_matricula = $_POST["id_matricula"];
                $resultado = $matricula->eliminar($id_matricula);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar la matricula: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar la matricula.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_matricula"])) {
                $id_matricula = $_GET["id_matricula"];
                $matriculaDetalle = $matricula->obtenerPorId($id_matricula);
                if ($matriculaDetalle) {
                    echo json_encode($matriculaDetalle);
                } else {
                    echo json_encode("No se encontró la matricula.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle de la matricula.");
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
