phpCopy<?php
require_once("../config/cors.php");
require_once("../models/Aulas.models.php");
error_reporting(0);

$Aulas = new Aulas;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Aulas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_aula"];
            $sub_array[] = $row["nombre_aula"];
            $sub_array[] = $row["capacidad"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_aula"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_aula"].')" class="btn btn-outline-danger">Eliminar</button>';
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
        $id_aula = $_POST["id_aula"];
        $datos = $Aulas->uno($id_aula);
        echo json_encode($datos);
        break;

    case 'insertar':
        $nombre_aula = $_POST["nombre_aula"];
        $capacidad = $_POST["capacidad"];
        $datos = $Aulas->Insertar($nombre_aula, $capacidad);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_aula = $_POST["id_aula"];
        $nombre_aula = $_POST["nombre_aula"];
        $capacidad = $_POST["capacidad"];
        $datos = $Aulas->Actualizar($id_aula, $nombre_aula, $capacidad);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_aula = $_POST["id_aula"];
        $datos = $Aulas->Eliminar($id_aula);
        echo json_encode($datos);
        break;
}