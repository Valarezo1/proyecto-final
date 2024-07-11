<?php
require_once('../models/Clases.models.php');
$clase = new Clases_Model();

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $clase->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron clases.");
            }
            break;
        case "insertar":
            if (isset($_POST["id_asignatura"], $_POST["id_profesor"], $_POST["horario"])) {
                $id_asignatura = $_POST["id_asignatura"];
                $id_profesor = $_POST["id_profesor"];
                $horario = $_POST["horario"];
                $resultado = $clase->insertar($id_asignatura, $id_profesor, $horario);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar la clase: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar la clase.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_clase"], $_POST["id_asignatura"], $_POST["id_profesor"], $_POST["horario"])) {
                $id_clase = $_POST["id_clase"];
                $id_asignatura = $_POST["id_asignatura"];
                $id_profesor = $_POST["id_profesor"];
                $horario = $_POST["horario"];
                $resultado = $clase->actualizar($id_clase, $id_asignatura, $id_profesor, $horario);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados de la clase
                    $claseActualizada = $clase->obtenerPorId($id_clase);
                    if ($claseActualizada) {
                        echo json_encode($claseActualizada);
                    } else {
                        echo json_encode("Error al obtener la clase actualizada.");
                    }
                } else {
                    echo json_encode("Error al actualizar la clase: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar la clase.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_clase"])) {
                $id_clase = $_POST["id_clase"];
                $resultado = $clase->eliminar($id_clase);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar la clase: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar la clase.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_clase"])) {
                $id_clase = $_GET["id_clase"];
                $claseDetalle = $clase->obtenerPorId($id_clase);
                if ($claseDetalle) {
                    echo json_encode($claseDetalle);
                } else {
                    echo json_encode("No se encontró la clase.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle de la clase.");
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
