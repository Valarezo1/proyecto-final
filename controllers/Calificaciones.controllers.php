<?php
require_once("../config/cors.php");
require_once("../models/Calificaciones.models.php");
error_reporting(0);

$Calificaciones = new Calificaciones;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Calificaciones->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_calificacion"];
            $sub_array[] = $row["id_matricula"];
            $sub_array[] = $row["nota"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_calificacion"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_calificacion"].')" class="btn btn-outline-danger">Eliminar</button>';
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
        $id_calificacion = $_POST["id_calificacion"];
        $datos = $Calificaciones->uno($id_calificacion);
        echo json_encode($datos);
        break;

    case 'insertar':
        $id_matricula = $_POST["id_matricula"];
        $nota = $_POST["nota"];
        $datos = $Calificaciones->Insertar($id_matricula, $nota);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_calificacion = $_POST["id_calificacion"];
        $id_matricula = $_POST["id_matricula"];
        $nota = $_POST["nota"];
        $datos = $Calificaciones->Actualizar($id_calificacion, $id_matricula, $nota);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_calificacion = $_POST["id_calificacion"];
        $datos = $Calificaciones->Eliminar($id_calificacion);
        echo json_encode($datos);
        break;
}