<?php
require_once("../config/conexion.php");

class Matriculas {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::ConectarDB();
    }

    public function todos() {
        $query = "SELECT * FROM Matriculas";
        return mysqli_query($this->conn, $query);
    }

    public function uno($id_matricula) {
        $query = "SELECT * FROM Matriculas WHERE id_matricula = $id_matricula";
        return mysqli_query($this->conn, $query);
    }

    public function Insertar($id_alumno, $id_clase, $fecha_matricula) {
        $query = "INSERT INTO Matriculas (id_alumno, id_clase, fecha_matricula) VALUES ($id_alumno, $id_clase, '$fecha_matricula')";
        return mysqli_query($this->conn, $query);
    }

    public function Actualizar($id_matricula, $id_alumno, $id_clase, $fecha_matricula) {
        $query = "UPDATE Matriculas SET id_alumno = $id_alumno, id_clase = $id_clase, fecha_matricula = '$fecha_matricula' WHERE id_matricula = $id_matricula";
        return mysqli_query($this->conn, $query);
    }

    public function Eliminar($id_matricula) {
        $query = "DELETE FROM Matriculas WHERE id_matricula = $id_matricula";
        return mysqli_query($this->conn, $query);
    }
}
?>