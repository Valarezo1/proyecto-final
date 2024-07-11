<?php
require_once("../models/Asignaturas.models.php");
error_reporting(0);

$Asignaturas = new Asignaturas;
switch ($_GET["op"]) {
    case 'todos':
        $data = array();
        $datos = $Asignaturas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $sub_array = array();
            $sub_array[] = $row["id_asignatura"];
            $sub_array[] = $row["nombre_asignatura"];
            $sub_array[] = $row["creditos"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["id_asignatura"].')" class="btn btn-outline-success">Editar</button>  <button type="button" onClick="eliminar('.$row["id_asignatura"].')" class="btn btn-outline-danger">Eliminar</button>';
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
        $id_asignatura = $_POST["id_asignatura"];
        $datos = $Asignaturas->uno($id_asignatura);
        echo json_encode($datos);
        break;

    case 'insertar':
        $nombre_asignatura = $_POST["nombre_asignatura"];
        $creditos = $_POST["creditos"];
        $datos = $Asignaturas->Insertar($nombre_asignatura, $creditos);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_asignatura = $_POST["id_asignatura"];
        $nombre_asignatura = $_POST["nombre_asignatura"];
        $creditos = $_POST["creditos"];
        $datos = $Asignaturas->Actualizar($id_asignatura, $nombre_asignatura, $creditos);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_asignatura = $_POST["id_asignatura"];
        $datos = $Asignaturas->Eliminar($id_asignatura);
        echo json_encode($datos);
        break;
}