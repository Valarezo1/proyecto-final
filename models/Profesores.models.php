<?php
require_once("../config/conexion.php");

class Profesores {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::ConectarDB();
    }

    public function todos() {
        $query = "SELECT * FROM Profesores";
        return mysqli_query($this->conn, $query);
    }

    public function uno($id_profesor) {
        $query = "SELECT * FROM Profesores WHERE id_profesor = $id_profesor";
        return mysqli_query($this->conn, $query);
    }

    public function Insertar($nombre, $apellido, $especialidad) {
        $query = "INSERT INTO Profesores (nombre, apellido, especialidad) VALUES ('$nombre', '$apellido', '$especialidad')";
        return mysqli_query($this->conn, $query);
    }

    public function Actualizar($id_profesor, $nombre, $apellido, $especialidad) {
        $query = "UPDATE Profesores SET nombre = '$nombre', apellido = '$apellido', especialidad = '$especialidad' WHERE id_profesor = $id_profesor";
        return mysqli_query($this->conn, $query);
    }

    public function Eliminar($id_profesor) {
        $query = "DELETE FROM Profesores WHERE id_profesor = $id_profesor";
        return mysqli_query($this->conn, $query);
    }
}
?>