<?php
require_once("../config/conexion.php");

class Aulas {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::ConectarDB();
    }

    public function todos() {
        $query = "SELECT * FROM Aulas";
        return mysqli_query($this->conn, $query);
    }

    public function uno($id_aula) {
        $query = "SELECT * FROM Aulas WHERE id_aula = $id_aula";
        return mysqli_query($this->conn, $query);
    }

    public function Insertar($nombre_aula, $capacidad) {
        $query = "INSERT INTO Aulas (nombre_aula, capacidad) VALUES ('$nombre_aula', $capacidad)";
        return mysqli_query($this->conn, $query);
    }

    public function Actualizar($id_aula, $nombre_aula, $capacidad) {
        $query = "UPDATE Aulas SET nombre_aula = '$nombre_aula', capacidad = $capacidad WHERE id_aula = $id_aula";
        return mysqli_query($this->conn, $query);
    }

    public function Eliminar($id_aula) {
        $query = "DELETE FROM Aulas WHERE id_aula = $id_aula";
        return mysqli_query($this->conn, $query);
    }
}
?>