<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Registros</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        table {
            width: 100%;
            margin-top: 20px;
            background-color: #333;
            color: #fff;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #666;
            padding: 10px;
        }
        th {
            background-color: #444;
        }
        a.btn {
            padding: 5px 10px;
            background-color: #00d8ff;
            color: #000;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Modificar Clientes</h2>
        <table>
            <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Acciones</th></tr>
            <?php
            $clientes = $conn->query("SELECT * FROM clientes");
            while($row = $clientes->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['correo']}</td>
                        <td>{$row['telefono']}</td>
                        <td><a class='btn' href='editar_cliente.php?id={$row['id']}'>Editar</a></td>
                      </tr>";
            }
            ?>
        </table>

        <h2 style="margin-top: 40px;">Modificar Productos</h2>
        <table>
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
            <?php
            $productos = $conn->query("SELECT * FROM productos");
            while($row = $productos->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['precio']}</td>
                        <td>{$row['stock']}</td>
                        <td><a class='btn' href='editar_producto.php?id={$row['id']}'>Editar</a></td>
                      </tr>";
            }
            ?>
        </table>
        <div style="text-align: center; margin-top: 30px;">
            <a href="menu.php">← Volver al Menú</a>
        </div>
    </div>
</body>
</html>
