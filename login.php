<?php
session_start();

// Leer cookie si existe
$usuarioRecordado = isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '';
$hayError = isset($_GET['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - TechZone</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #1e1e1e, #2c2c2c);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contenedor {
            background-color: #2b2b2b;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #00d8ff;
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            background-color: #444;
            color: #fff;
            font-size: 16px;
        }

        input::placeholder {
            color: #aaa;
        }

        .checkbox {
            display: flex;
            align-items: center;
            justify-content: left;
            margin-bottom: 15px;
            color: #ccc;
            font-size: 14px;
        }

        .checkbox input {
            margin-right: 10px;
        }

        button {
            width: 100%;
            background-color: #00d8ff;
            color: #000;
            padding: 12px;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #fff;
            color: #000;
        }

        .error-box {
            background-color: #ff4d4d;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 14px;
        }

        .emoji-input {
            text-align: left;
            color: #aaa;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>🔐 TechZone - Iniciar Sesión</h2>

    <form action="validar_login.php" method="POST">
        <div class="emoji-input">👤 Usuario</div>
        <input type="text" name="username" placeholder="Ingrese su usuario" value="<?= htmlspecialchars($usuarioRecordado) ?>" required>

        <div class="emoji-input">🔒 Contraseña</div>
        <input type="password" name="password" placeholder="Ingrese su contraseña" required>

        <div class="checkbox">
            <input type="checkbox" name="recordar" <?= $usuarioRecordado ? "checked" : "" ?>> Recordar usuario
        </div>

        <button type="submit">🚀 Entrar</button>
    </form>

    <?php if ($hayError): ?>
        <div class="error-box">❌ Usuario o contraseña incorrectos</div>
    <?php endif; ?>

    <div class="footer">
        © 2025 TechZone | Proyecto Final
    </div>
</div>
</body>
</html>

