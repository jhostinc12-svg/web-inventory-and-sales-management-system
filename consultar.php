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
    <title>Consultar Registros</title>
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
            text-align: left;
        }
        th {
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Listado de Clientes</h2>
        <table>
            <tr>
                <th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th>
            </tr>
            <?php
            $clientes = $conn->query("SELECT * FROM clientes");
            while($fila = $clientes->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>{$fila['correo']}</td>
                        <td>{$fila['telefono']}</td>
                      </tr>";
            }
            ?>
        </table>

        <h2 style="margin-top: 40px;">Listado de Productos</h2>
        <table>
            <tr>
                <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th>
            </tr>
            <?php
            $productos = $conn->query("SELECT * FROM productos");
            while($fila = $productos->fetch_assoc()) {
                echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>{$fila['nombre']}</td>
                        <td>$ {$fila['precio']}</td>
                        <td>{$fila['stock']}</td>
                      </tr>";
            }
            ?>
        </table>

        <div style="margin-top: 30px; text-align: center;">
            <a href="menu.php">← Volver al Menú</a>
        </div>
    </div>
</body>
</html>
