<?php
require_once("../config/cors.php");
require_once("../models/Profesores.models.php");
error_reporting(0);

$Profesores = new Profesores;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Profesores->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_profesor"];
            $sub_array[] = $row["nombre"];
            $sub_array[] = $row["apellido"];
            $sub_array[] = $row["especialidad"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_profesor"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_profesor"].')" class="btn btn-outline-danger">Eliminar</button>';
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
        $id_profesor = $_POST["id_profesor"];
        $datos = $Profesores->uno($id_profesor);
        echo json_encode($datos);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $datos = $Profesores->Insertar($nombre, $apellido, $especialidad);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_profesor = $_POST["id_profesor"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $especialidad = $_POST["especialidad"];
        $datos = $Profesores->Actualizar($id_profesor, $nombre, $apellido, $especialidad);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_profesor = $_POST["id_profesor"];
        $datos = $Profesores->Eliminar($id_profesor);
        echo json_encode($datos);
        break;
}