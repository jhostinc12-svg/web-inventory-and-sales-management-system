<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener datos
$clientes = $conn->query("SELECT * FROM clientes");
$productos = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Cotización</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        select, input[type='number'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            border: none;
            background-color: #444;
            color: #fff;
        }

        .separador {
            margin: 30px 0 15px;
            border-top: 2px dashed #555;
            padding-top: 10px;
            font-weight: bold;
            color: #ccc;
        }

        table {
            width: 100%;
            margin-top: 20px;
            background-color: #333;
            color: #fff;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #555;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #444;
        }

        .boton {
            background-color: #00d8ff;
            color: #000;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .boton:hover {
            background-color: #ffffff;
        }

        .no-print {
            text-align: center;
            margin-top: 30px;
        }

        .no-print a {
            color: #00d8ff;
            text-decoration: none;
            font-weight: bold;
        }

        .no-print a:hover {
            color: #ffffff;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            body * {
                visibility: hidden;
            }
            .factura, .factura * {
                visibility: visible;
            }
            .factura {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>Generar Cotización / Factura</h2>

    <form method="POST">
        <div>
            <label>Seleccionar Cliente:</label>
            <select name="cliente_id" required>
                <option value="">-- Seleccione --</option>
                <?php while ($c = $clientes->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?> - <?= $c['correo'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="separador">Productos y Cantidades:</div>
        <?php
        $productos = $conn->query("SELECT * FROM productos");
        while ($p = $productos->fetch_assoc()):
            $sinStock = $p['stock'] <= 0;
        ?>
            <div style="margin-bottom: 10px; border-bottom: 1px dashed #555; padding-bottom: 10px; opacity: <?= $sinStock ? '0.5' : '1' ?>;">
                <label>
                    <input type="checkbox" name="productos[<?= $p['id'] ?>]" value="<?= $p['id'] ?>" <?= $sinStock ? 'disabled' : '' ?>>
                    <?= $p['nombre'] ?> - $<?= $p['precio'] ?> (<?= $sinStock ? '<span style="color:red;">Sin stock</span>' : 'Stock: '.$p['stock'] ?>)
                </label>
                <input type="number" name="cantidades[<?= $p['id'] ?>]" min="1" placeholder="Cantidad" <?= $sinStock ? 'disabled' : '' ?>>
            </div>
        <?php endwhile; ?>

        <div class="no-print">
            <button type="submit" class="boton">Generar Cotización</button>
        </div>
    </form>

    <div class="no-print">
        <a href="menu.php">← Volver al Menú</a>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productos'])) {
    $cliente_id = $_POST['cliente_id'];
    $cantidades = $_POST['cantidades'];
    $cliente = $conn->query("SELECT * FROM clientes WHERE id=$cliente_id")->fetch_assoc();

    $errores = [];
    foreach ($_POST['productos'] as $id) {
        $cantidad = isset($cantidades[$id]) ? intval($cantidades[$id]) : 1;
        $producto = $conn->query("SELECT * FROM productos WHERE id=$id")->fetch_assoc();
        if ($cantidad > $producto['stock']) {
            $errores[] = "La cantidad de '{$producto['nombre']}' excede el stock disponible ({$producto['stock']}).";
        }
    }

    if (!empty($errores)) {
        echo "<div style='margin-top: 20px; background-color: #440000; padding: 20px; border-radius: 10px; color: #fff;'>";
        echo "<h3 style='color: #ff4d4d;'>❌ Error al generar cotización:</h3><ul>";
        foreach ($errores as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul></div>";
    } else {
        echo "<div class='factura'>";
        echo "<h2 style='text-align: center;'>TechZone - Cotización / Factura</h2>";
        echo "<p style='text-align: center; font-size: 16px; color: #ccc;'>Fecha: " . date("d/m/Y H:i") . "</p>";
        echo "<hr style='border: 1px solid #555;'>";

        echo "<div style='margin-top: 20px; line-height: 1.7;'>";
        echo "<p><strong>Nombre:</strong> {$cliente['nombre']}</p>";
        echo "<p><strong>Cédula / RUC:</strong> {$cliente['cedula']}</p>";
        echo "<p><strong>Correo:</strong> {$cliente['correo']}</p>";
        echo "<p><strong>Teléfono:</strong> {$cliente['telefono']}</p>";
        echo "<p><strong>Dirección:</strong> {$cliente['direccion']}</p>";
        echo "</div>";

        echo "<table>
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>";

        $total = 0;
        foreach ($_POST['productos'] as $id) {
            $cantidad = isset($cantidades[$id]) ? intval($cantidades[$id]) : 1;
            $producto = $conn->query("SELECT * FROM productos WHERE id=$id")->fetch_assoc();
            $subtotal = $producto['precio'] * $cantidad;
            $total += $subtotal;

            // Restar stock
            $nuevo_stock = $producto['stock'] - $cantidad;
            $conn->query("UPDATE productos SET stock = $nuevo_stock WHERE id = $id");
// Guardar en historial
$conn->query("INSERT INTO historial 
    (cliente_nombre, cliente_cedula, cliente_direccion, cliente_correo, cliente_telefono, 
     producto, cantidad, precio, total)
    VALUES (
        '{$cliente['nombre']}',
        '{$cliente['cedula']}',
        '{$cliente['direccion']}',
        '{$cliente['correo']}',
        '{$cliente['telefono']}',
        '{$producto['nombre']}',
        $cantidad,
        {$producto['precio']},
        $subtotal
    )");


            echo "<tr>
                    <td>{$producto['nombre']}</td>
                    <td>$ {$producto['precio']}</td>
                    <td>$cantidad</td>
                    <td>$ $subtotal</td>
                  </tr>";
        }

        echo "<tr style='background-color: #444; font-weight: bold;'>
                <td colspan='3' style='text-align: right;'>Total a Pagar:</td>
                <td>$ $total</td>
              </tr>";
        echo "</table>";
        echo "</div>";

        echo "<div class='no-print' style='text-align: center; margin-top: 20px;'>
                <button onclick='window.print()' class='boton'>🖨️ Imprimir Cotización</button>
              </div>";
    }
}
?>
</div>
</body>
</html>

