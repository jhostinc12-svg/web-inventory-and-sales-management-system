<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM clientes WHERE id=$id");
$cliente = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $conn->query("UPDATE clientes SET nombre='$nombre', correo='$correo', telefono='$telefono' WHERE id=$id");
    header("Location: modificar.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h2>Editar Cliente</h2>
        <form method="POST">
            <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>" required>
            <input type="email" name="correo" value="<?= $cliente['correo'] ?>" required>
            <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
