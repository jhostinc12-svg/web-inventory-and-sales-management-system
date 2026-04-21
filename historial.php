<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Eliminar registro individual
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM historial WHERE id = $id");
    echo "<script>alert('Cotización eliminada'); window.location='historial.php';</script>";
}

// Eliminar todo el historial
if (isset($_POST['borrar'])) {
    $conn->query("TRUNCATE TABLE historial");
    echo "<script>alert('Historial eliminado correctamente'); window.location='historial.php';</script>";
}

$resultado = $conn->query("SELECT * FROM historial ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Cotizaciones</title>
    <style>
        body {
            background-color: #1e1e1e;
            font-family: Arial, sans-serif;
            margin: 0;
            color: #fff;
        }

        .contenedor {
            max-width: 1000px;
            margin: 60px auto;
            padding: 30px 40px;
            background-color: #2c2c2c;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255,255,255,0.03);
        }

        h2 {
            text-align: center;
            color: #00d8ff;
            margin-bottom: 25px;
        }

        .acciones {
            text-align: center;
            margin-bottom: 15px;
        }

        .boton {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .boton:hover {
            background-color: #ffffff;
            color: #000;
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
            color: #ffffff;
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
    <h2>📜 Historial de Cotizaciones</h2>

    <div class="acciones">
        <form method="POST">
            <button type="submit" name="borrar" class="boton" onclick="return confirm('¿Deseas eliminar todo el historial?');">
                🗑️ Borrar Todo
            </button>
        </form>
    </div>

    <div class="tabla-container">
        <table>
            <tr>
                <th>Cliente</th>
                <th>Cédula</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Eliminar</th>
            </tr>
            <?php if ($resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['cliente_nombre'] ?></td>
                    <td><?= $row['cliente_cedula'] ?></td>
                    <td><?= $row['cliente_direccion'] ?></td>
                    <td><?= $row['cliente_telefono'] ?></td>
                    <td><?= $row['producto'] ?></td>
                    <td><?= $row['cantidad'] ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td>$<?= number_format($row['total'], 2) ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($row['fecha'])) ?></td>
                    <td>
                        <a class="eliminar" href="?eliminar=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar esta cotización?')">🗑️</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="10" style="text-align: center;">No hay cotizaciones registradas.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="volver">
        <a href="menu.php">← Volver al Menú</a>
    </div>
</div>
</body>
</html>


