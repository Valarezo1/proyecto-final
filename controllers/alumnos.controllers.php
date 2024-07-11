<?php
require_once('../models/Alumnos.models.php'); // Assuming this file defines Alumno_Model
$alumno = new Clase_Alumno(); // Instantiate your Alumno model

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $alumno->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron alumnos.");
            }
            break;
        case "insertar":
            if (isset($_POST["nombre"], $_POST["apellido"], $_POST["fecha_nacimiento"])) {
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $fecha_nacimiento = $_POST["fecha_nacimiento"];
                $resultado = $alumno->insertar($nombre, $apellido, $fecha_nacimiento);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar el alumno: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar el alumno.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_alumno"], $_POST["nombre"], $_POST["apellido"], $_POST["fecha_nacimiento"])) {
                $id_alumno = $_POST["id_alumno"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $fecha_nacimiento = $_POST["fecha_nacimiento"];
                $resultado = $alumno->actualizar($id_alumno, $nombre, $apellido, $fecha_nacimiento);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados del alumno
                    $alumnoActualizado = $alumno->obtenerPorId($id_alumno);
                    if ($alumnoActualizado) {
                        echo json_encode($alumnoActualizado);
                    } else {
                        echo json_encode("Error al obtener el alumno actualizado.");
                    }
                } else {
                    echo json_encode("Error al actualizar el alumno: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar el alumno.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_alumno"])) {
                $id_alumno = $_POST["id_alumno"];
                $resultado = $alumno->eliminar($id_alumno);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar el alumno: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar el alumno.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_alumno"])) {
                $id_alumno = $_GET["id_alumno"];
                $alumnoDetalle = $alumno->obtenerPorId($id_alumno);
                if ($alumnoDetalle) {
                    echo json_encode($alumnoDetalle);
                } else {
                    echo json_encode("No se encontró el alumno.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle del alumno.");
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
