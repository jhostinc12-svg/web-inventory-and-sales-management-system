<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$resultado = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <style>
        body {
            background-color: #1e1e1e;
            font-family: Arial, sans-serif;
            margin: 0;
            color: #fff;
        }

        .contenedor {
            max-width: 800px;
            margin: 60px auto;
            padding: 30px 40px;
            background-color: #2c2c2c;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255,255,255,0.03);
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #00d8ff;
            margin-bottom: 25px;
        }

        .tabla-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background-color: #444;
            color: #00d8ff;
        }

        tr:nth-child(even) {
            background-color: #3a3a3a;
        }

        .volver {
            text-align: center;
            margin-top: 30px;
        }

        .volver a {
            color: #00d8ff;
            text-decoration: none;
            font-weight: bold;
        }

        .volver a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>📦 Listado de Productos</h2>

    <div class="tabla-container">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td>$<?= number_format($row['precio'], 2) ?></td>
                <td><?= $row['stock'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="volver">
        <a href="menu.php">← Volver al Menú</a>
    </div>
</div>
</body>
</html>

