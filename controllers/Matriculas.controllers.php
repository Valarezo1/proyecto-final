<?php
require_once("../config/cors.php");
require_once("../models/Matriculas.models.php");
error_reporting(0);

$Matriculas = new Matriculas;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Matriculas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_matricula"];
            $sub_array[] = $row["id_alumno"];
            $sub_array[] = $row["id_clase"];
            $sub_array[] = $row["fecha_matricula"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_matricula"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_matricula"].')" class="btn btn-outline-danger">Eliminar</button>';
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
        $id_matricula = $_POST["id_matricula"];
        $datos = $Matriculas->uno($id_matricula);
        echo json_encode($datos);
        break;

    case 'insertar':
        $id_alumno = $_POST["id_alumno"];
        $id_clase = $_POST["id_clase"];
        $fecha_matricula = $_POST["fecha_matricula"];
        $datos = $Matriculas->Insertar($id_alumno, $id_clase, $fecha_matricula);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_matricula = $_POST["id_matricula"];
        $id_alumno = $_POST["id_alumno"];
        $id_clase = $_POST["id_clase"];
        $fecha_matricula = $_POST["fecha_matricula"];
        $datos = $Matriculas->Actualizar($id_matricula, $id_alumno, $id_clase, $fecha_matricula);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_matricula = $_POST["id_matricula"];
        $datos = $Matriculas->Eliminar($id_matricula);
        echo json_encode($datos);
        break;
}