<?php
require_once("../config/conexion.php");

class Clases {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::ConectarDB();
    }

    public function todos() {
        $query = "SELECT * FROM Clases";
        return mysqli_query($this->conn, $query);
    }

    public function uno($id_clase) {
        $query = "SELECT * FROM Clases WHERE id_clase = $id_clase";
        return mysqli_query($this->conn, $query);
    }

    public function Insertar($id_asignatura, $id_profesor, $horario) {
        $query = "INSERT INTO Clases (id_asignatura, id_profesor, horario) VALUES ($id_asignatura, $id_profesor, '$horario')";
        return mysqli_query($this->conn, $query);
    }

    public function Actualizar($id_clase, $id_asignatura, $id_profesor, $horario) {
        $query = "UPDATE Clases SET id_asignatura = $id_asignatura, id_profesor = $id_profesor, horario = '$horario' WHERE id_clase = $id_clase";
        return mysqli_query($this->conn, $query);
    }

    public function Eliminar($id_clase) {
        $query = "DELETE FROM Clases WHERE id_clase = $id_clase";
        return mysqli_query($this->conn, $query);
    }
}
?>