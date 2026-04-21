<?php
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
    <title>Menú Principal - TechZone</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1f1f1f;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        .contenedor {
            max-width: 800px;
            margin: 60px auto;
            padding: 30px 40px;
            background-color: #2a2a2a;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255,255,255,0.03);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #00d8ff;
            margin-bottom: 40px;
            font-weight: normal;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            justify-content: center;
        }

        .boton-menu {
            display: block;
            padding: 12px 15px;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 10px;
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .boton-menu:hover {
            background-color: #00d8ff;
            color: #000;
            border-color: #00d8ff;
        }

        .cerrar-sesion {
            margin-top: 35px;
        }

        .cerrar-sesion a {
            color: #ff4d4d;
            text-decoration: none;
            font-size: 14px;
        }

        .cerrar-sesion a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h1>Bienvenido - TechZone</h1>

    <div class="menu-grid">
        <a class="boton-menu" href="insertar_cliente.php">🧍‍♂️ Insertar Cliente</a>
        <a class="boton-menu" href="insertar_producto.php">📦 Insertar Producto</a>
        <a class="boton-menu" href="listar_clientes.php">📋 Listar Clientes</a>
        <a class="boton-menu" href="listar_productos.php">📦📋 Listar Productos</a>
        <a class="boton-menu" href="modificar_cliente.php">✏️ Modificar Cliente</a>
        <a class="boton-menu" href="modificar_producto.php">🛠️ Modificar Producto</a>
        <a class="boton-menu" href="cotizacion.php">🧾 Generar Cotización</a>
        <a class="boton-menu" href="historial.php">🕓 Historial de Cotizaciones</a>
    </div>

    <div class="cerrar-sesion">
        <a href="logout.php">← Cerrar sesión</a>
    </div>
</div>
<footer style="text-align: center; margin-top: 40px; padding: 20px 10px; font-size: 13px; color: #777;">
    <hr style="border: none; height: 1px; background-color: #444; margin: 30px 0;">
    Página creada por <strong>Jhostin Casas</strong> | Cédula: <strong>8-975-1964</strong><br>
    © 2025 TechZone Corporation. Todos los derechos reservados. Proyecto final - Programación Web.
</footer>
</body>
</html>
