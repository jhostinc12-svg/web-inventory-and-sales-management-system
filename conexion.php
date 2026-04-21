<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "techzone";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
