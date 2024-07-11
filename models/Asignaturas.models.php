<?php
require_once('../config/conexion.php'); // Requiere el archivo de configuración de conexión

class Asignaturas
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `asignaturas`";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function uno($id_asignatura)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `asignaturas` WHERE `id_asignatura`=$id_asignatura";
        $asignatura = mysqli_query($con, $cadena);
        $con->close();
        return $asignatura;
    }

    public function insertar($nombre_asignatura, $creditos)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `asignaturas`(`nombre_asignatura`, `creditos`) VALUES ('$nombre_asignatura', '$creditos')";
        if (mysqli_query($con, $cadena)) {
            $id_asignatura = mysqli_insert_id($con);
            $con->close();
            return $id_asignatura;
        } else {
            $con->close();
            return false;
        }
    }

    public function actualizar($id_asignatura, $nombre_asignatura, $creditos)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `asignaturas` SET `nombre_asignatura`='$nombre_asignatura', `creditos`='$creditos' WHERE `id_asignatura`=$id_asignatura";
        if (mysqli_query($con, $cadena)) {
            $con->close();
            return true;
        } else {
            $con->close();
            return false;
        }
    }

    public function eliminar($id_asignatura)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `asignaturas` WHERE `id_asignatura`=$id_asignatura";
        if (mysqli_query($con, $cadena)) {
            $con->close();
            return true;
        } else {
            $con->close();
            return false;
        }
    }
}
?>
