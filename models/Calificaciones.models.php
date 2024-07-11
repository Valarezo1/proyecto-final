<?php
require_once("../config/conexion.php");

class Calificaciones {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::ConectarDB();
    }

    public function todos() {
        $query = "SELECT * FROM Calificaciones";
        return mysqli_query($this->conn, $query);
    }

    public function uno($id_calificacion) {
        $query = "SELECT * FROM Calificaciones WHERE id_calificacion = $id_calificacion";
        return mysqli_query($this->conn, $query);
    }

    public function Insertar($id_matricula, $nota) {
        $query = "INSERT INTO Calificaciones (id_matricula, nota) VALUES ($id_matricula, $nota)";
        return mysqli_query($this->conn, $query);
    }

    public function Actualizar($id_calificacion, $id_matricula, $nota) {
        $query = "UPDATE Calificaciones SET id_matricula = $id_matricula, nota = $nota WHERE id_calificacion = $id_calificacion";
        return mysqli_query($this->conn, $query);
    }

    public function Eliminar($id_calificacion) {
        $query = "DELETE FROM Calificaciones WHERE id_calificacion = $id_calificacion";
        return mysqli_query($this->conn, $query);
    }
}
?>