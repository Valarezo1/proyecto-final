<?php
require_once("../config/cors.php");
require_once("../models/Clases.models.php");
error_reporting(0);

$Clases = new Clases;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Clases->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_clase"];
            $sub_array[] = $row["id_asignatura"];
            $sub_array[] = $row["id_profesor"];
            $sub_array[] = $row["horario"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_clase"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_clase"].')" class="btn btn-outline-danger">Eliminar</button>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case 'uno':
        $id_clase = $_POST["id_clase"];
        $datos = $Clases->uno($id_clase);
        echo json_encode($datos);
        break;

    case 'insertar':
        $id_asignatura = $_POST["id_asignatura"];
        $id_profesor = $_POST["id_profesor"];
        $horario = $_POST["horario"];
        $datos = $Clases->Insertar($id_asignatura, $id_profesor, $horario);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_clase = $_POST["id_clase"];
        $id_asignatura = $_POST["id_asignatura"];
        $id_profesor = $_POST["id_profesor"];
        $horario = $_POST["horario"];
        $datos = $Clases->Actualizar($id_clase, $id_asignatura, $id_profesor, $horario);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_clase = $_POST["id_clase"];
        $datos = $Clases->Eliminar($id_clase);
        echo json_encode($datos);
        break;
}

