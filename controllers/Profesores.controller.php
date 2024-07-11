<?php
require_once('../models/Profesores.models.php'); // Suponiendo que este archivo define Profesor_Model
$profesor = new Clase_Profesor(); // Instancia tu modelo Profesor

if (isset($_GET['op'])) {
    switch ($_GET['op']) {
        case "todos":
            $datos = $profesor->todos();
            if ($datos !== false) {
                echo json_encode($datos);
            } else {
                echo json_encode("No se encontraron profesores.");
            }
            break;
        case "insertar":
            if (isset($_POST["nombre"], $_POST["apellido"], $_POST["especialidad"])) {
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $especialidad = $_POST["especialidad"];
                $resultado = $profesor->insertar($nombre, $apellido, $especialidad);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al insertar el profesor: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para insertar el profesor.");
            }
            break;
        case "actualizar":
            if (isset($_POST["id_profesor"], $_POST["nombre"], $_POST["apellido"], $_POST["especialidad"])) {
                $id_profesor = $_POST["id_profesor"];
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $especialidad = $_POST["especialidad"];
                $resultado = $profesor->actualizar($id_profesor, $nombre, $apellido, $especialidad);
                if ($resultado === "ok") {
                    // Obtener los datos actualizados del profesor
                    $profesorActualizado = $profesor->obtenerPorId($id_profesor);
                    if ($profesorActualizado) {
                        echo json_encode($profesorActualizado);
                    } else {
                        echo json_encode("Error al obtener el profesor actualizado.");
                    }
                } else {
                    echo json_encode("Error al actualizar el profesor: " . $resultado);
                }
            } else {
                echo json_encode("Faltan parámetros para actualizar el profesor.");
            }
            break;
        case "eliminar":
            if (isset($_POST["id_profesor"])) {
                $id_profesor = $_POST["id_profesor"];
                $resultado = $profesor->eliminar($id_profesor);
                if ($resultado === "ok") {
                    echo json_encode("ok");
                } else {
                    echo json_encode("Error al eliminar el profesor: " . $resultado);
                }
            } else {
                echo json_encode("Falta el parámetro ID para eliminar el profesor.");
            }
            break;
        case "detalle":
            if (isset($_GET["id_profesor"])) {
                $id_profesor = $_GET["id_profesor"];
                $profesorDetalle = $profesor->obtenerPorId($id_profesor);
                if ($profesorDetalle) {
                    echo json_encode($profesorDetalle);
                } else {
                    echo json_encode("No se encontró el profesor.");
                }
            } else {
                echo json_encode("Falta el parámetro ID para obtener el detalle del profesor.");
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
