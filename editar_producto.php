<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM productos WHERE id=$id");
$producto = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $conn->query("UPDATE productos SET nombre='$nombre', precio='$precio', stock='$stock' WHERE id=$id");
    header("Location: modificar.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h2>Editar Producto</h2>
        <form method="POST">
            <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>
            <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>
            <input type="number" name="stock" value="<?= $producto['stock'] ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
