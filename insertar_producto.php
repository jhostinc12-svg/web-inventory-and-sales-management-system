<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];

    $sql = "INSERT INTO productos (nombre, precio, stock) VALUES ('$nombre', '$precio', '$stock')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto registrado correctamente');window.location='insertar_producto.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Producto</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .formulario {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #ccc;
            margin-bottom: -5px;
        }

        input[type="text"], input[type="number"] {
            padding: 12px;
            border-radius: 10px;
            border: none;
            background-color: #444;
            color: #fff;
            font-size: 16px;
        }

        .boton {
            background-color: #00d8ff;
            color: #000;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .boton:hover {
            background-color: #ffffff;
        }

        .enlace-volver {
            margin-top: 30px;
            text-align: center;
        }

        .enlace-volver a {
            color: #00d8ff;
            font-weight: bold;
            text-decoration: none;
        }

        .enlace-volver a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Registrar Nuevo Producto</h2>
        <form method="POST" class="formulario">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="precio">Precio ($):</label>
            <input type="number" step="0.01" name="precio" id="precio" required>

            <label for="stock">Cantidad en Stock:</label>
            <input type="number" name="stock" id="stock" required>

            <button type="submit" class="boton">Guardar Producto</button>
        </form>

        <div class="enlace-volver">
            <a href="menu.php">← Volver al Menú</a>
        </div>
    </div>
</body>
</html>

