<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $cedula = $_POST["cedula"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    $sql = "INSERT INTO clientes (nombre, cedula, correo, direccion, telefono) 
            VALUES ('$nombre', '$cedula', '$correo', '$direccion', '$telefono')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente registrado correctamente');window.location='insertar_cliente.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1e1e1e;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .contenedor {
            width: 100%;
            max-width: 700px;
            margin: 60px auto;
            padding: 30px 40px;
            background-color: #2c2c2c;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
        }

        h2 {
            text-align: center;
            color: #00d8ff;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 15px 20px;
            align-items: center;
        }

        label {
            font-weight: bold;
            color: #ccc;
            text-align: right;
        }

        input, textarea {
            padding: 10px 15px;
            font-size: 15px;
            border: none;
            border-radius: 10px;
            background-color: #444;
            color: #fff;
            width: 100%;
            box-sizing: border-box;
            resize: none;
        }

        .boton {
            grid-column: 1 / 3;
            margin-top: 20px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            background-color: #00d8ff;
            color: #000;
            cursor: pointer;
            transition: 0.3s;
        }

        .boton:hover {
            background-color: #ffffff;
            color: #000;
        }

        .volver {
            text-align: center;
            margin-top: 30px;
        }

        .volver a {
            color: #00d8ff;
            font-weight: bold;
            text-decoration: none;
        }

        .volver a:hover {
            color: #ffffff;
        }

        @media screen and (max-width: 600px) {
            form {
                grid-template-columns: 1fr;
            }

            label {
                text-align: left;
            }

            .boton {
                grid-column: 1 / 2;
            }
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Registrar Nuevo Cliente</h2>

        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="cedula">Cédula / RUC:</label>
            <input type="text" name="cedula" id="cedula" required>

            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" id="correo" required>

            <label for="direccion">Dirección:</label>
            <textarea name="direccion" id="direccion" rows="3" required></textarea>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required>

            <button type="submit" class="boton">Guardar Cliente</button>
        </form>

        <div class="volver">
            <a href="menu.php">← Volver al Menú</a>
        </div>
    </div>
</body>
</html>


