<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Eliminar cliente si se envía por GET
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM clientes WHERE id = $id");
    echo "<script>alert('Cliente eliminado correctamente'); window.location='listar_clientes.php';</script>";
}

$resultado = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
    <style>
        body {
            background-color: #1e1e1e;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .contenedor {
            max-width: 1000px;
            margin: 60px auto;
            padding: 30px 40px;
            background-color: #2c2c2c;
            border-radius: 15px;
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
            border-collapse: collapse;
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
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

        .eliminar {
            color: #ff4d4d;
            font-weight: bold;
            text-decoration: none;
        }

        .eliminar:hover {
            color: #fff;
        }

        .volver {
            text-align: center;
            margin-top: 25px;
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
    <h2>📋 Listado de Clientes</h2>

    <div class="tabla-container">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Eliminar</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['cedula'] ?></td>
                <td><?= $row['correo'] ?></td>
                <td><?= $row['direccion'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td><a class="eliminar" href="?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">🗑️</a></td>
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
