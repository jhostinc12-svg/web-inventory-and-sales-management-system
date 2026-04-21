<?php
include("conexion.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $username;
    header("Location: menu.php");
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');window.location='login.php';</script>";
}
?>
